<?php
class PaymentPaytmController extends AppController
{
	var $name = "PaymentPaytm";
	
	var $uses=array();
	var $helpers = array('Form','Html','Javascript', 'Ajax');

        function beforeFilter() {
            parent::beforeFilter();
            $this->layout='';
        }
        function beforeRender() {
            parent::beforeRender();
        }

        function process_payment($amt,$req_id,$order_id)
        {
            
            $amt=base64_decode($amt);
            //$amt=10;
            $req_id=base64_decode($req_id);
            $order_id=base64_decode($order_id);
            if(isset($amt) && !empty($amt) && $amt > 0 && isset($req_id) && !empty($req_id))
            {
                //finding patient information
                $this->User=ClassRegistry::init('User');
                $this->User->bindModel(array(
                    'belongsTo'=>array(
                        'City'=>array(
                            'className'=>'City',
                            'foreignKey'=>'city',
                        ),
                        'State'=>array(
                            'className'=>'State',
                            'foreignKey'=>'state',
                        )
                    )
                ));

                $this->Health=ClassRegistry::init('Health');
                $this->Health->bindModel(array(
                    'belongsTo'=>array(
                        'User'=>array(
                            'className'=>'User',
                            'foreignKey'=>'user_id',
                        )
                    )
                ));
                $this->Health->recursive=2;

                $patient_data=$this->Health->find('first',array('conditions'=>array('Health.id'=>$req_id)));
                
                //seting state as other in case empty
                $patient_data['State']['name']=isset($patient_data['State']['name'])?$patient_data['State']['name']:"Others";
                Configure::write('PayTM.amount', $amt);
                Configure::write('PayTM.order_number', 'NHCARE'.$order_id.'-'.strtotime(date('YmdHis')));
                Configure::write('PayTM.user_id', $patient_data['Health']['user_id']);

                App::import('Vendor', 'paytm', array('file' => 'encdec.php'));
                $encdec = new Enc_Dec();
                $checkSum = $encdec->getChecksumFromArray($this->getParams(),Configure::read('PayTM.merchant_key'));
                
                $this->set('patient_data',$patient_data);
                $this->set('checksum',$checkSum);

                $this->Session->write('UserProcessedOrder',array('request_id'=>$req_id));

            }
            else
            {
                //invalid transaction
                $this->redirect('/');
            }

        }

        function getParams()
        {
            $paramList = array();
            
            $paramList["MID"] = Configure::read('PayTM.mid');
            $paramList["ORDER_ID"] = Configure::read('PayTM.order_number');
            $paramList["CUST_ID"] = Configure::read('PayTM.user_id');
            $paramList["INDUSTRY_TYPE_ID"] =  Configure::read('PayTM.industry_type_id');
            $paramList["CHANNEL_ID"] = Configure::read('PayTM.channel_id');
            $paramList["TXN_AMOUNT"] = Configure::read('PayTM.amount');
            $paramList["WEBSITE"] = Configure::read('PayTM.website');
            return $paramList;
        }

        function success()
        {
            $this->layout="default";
            if($this->Session->check('UserProcessedOrder')) {
                
                $direct_pay_response=$this->directPayResponse();
               
                if($direct_pay_response['flag'] == 'Y' && $direct_pay_response['transaction_status']=='TXN_SUCCESS')
                {
                    //insert into online_order table
                    $this->OnlineOrder=ClassRegistry::init('OnlineOrder');
                    $this->data['OnlineOrder']=$direct_pay_response;
                    $this->data['OnlineOrder']['date_created'] = date('Y-m-d H:i:s');
                    $this->OnlineOrder->create();
                    $this->OnlineOrder->save($this->data);

                    /*inserting into pay track*/
                    $this->Paytrack=ClassRegistry::init('Paytrack');
                    $this->data['Paytrack']['type'] = 'Receive';
                    $this->data['Paytrack']['admin_id'] = $direct_pay_response['user_id'];
                    $this->data['Paytrack']['request_id'] = $direct_pay_response['request_id'];
                    $this->data['Paytrack']['pay_mode']='online';
                    $this->data['Paytrack']['pay_install'] = $direct_pay_response['amount'];
                    $this->data['Paytrack']['c_number'] = '';
                    $this->data['Paytrack']['receive_date'] = date('Y-m-d H:i:s');
                    $this->Paytrack->create();
                    if($this->Paytrack->save($this->data))
                    {
                        /*updating health table*/

                        $this->Health=ClassRegistry::init('Health');
                        $this->Health->updateAll(array('Health.amount_collected'=>('Health.received_amount + '.$direct_pay_response['amount']),'Health.amount_to_be_collected'=>0,'Health.payment_type'=>1,'Health.received_amount' =>('Health.received_amount + '.$direct_pay_response['amount']),'Health.balance_amount'=>('Health.total_amount - '.$direct_pay_response['amount'])),array('Health.id' =>$direct_pay_response['request_id']));

                        //send mail for success transaction
                        $userData = $this->Session->read('UserDetail');
                        $this->set('userData',$userData);
                        $this->set('amount_received',$direct_pay_response['amount']);
                        $this->set('niramya_order_number',$direct_pay_response['order_number']);
                        
                        $this->Email->template = 'online_payment_confirmation';
                        $this->Email->from = 'info@niramayahealthcare.com';
                        $this->Email->fromName = 'Email from Niramaya Healthcare';
                        $this->Email->subject = 'Niramaya Payment Acknowledgement';
                        $this->Email->to = $userData['User']['email'];
                        $this->Email->replyTo = 'info@niramayahealthcare.com';
                        $this->Email->sendAs = 'html'; 
                        $this->Email->delivery = 'mail';
                        $this->Email->send();
                        
                    }
                    $this->Session->delete('UserProcessedOrder');
                    $this->Session->delete('session_test');
                    $this->Session->setFlash('Thank you for booking. Your payment is recieved.','flash_success');
                    $this->redirect(array('controller'=>'tests','action'=>'payment_history'));
                }
                
            } 
            else
            {
                $this->redirect('/');
            }
        }

        function failure()
        {
            if($this->Session->check('UserProcessedOrder')) {
                $direct_pay_response=$this->directPayResponse();

                if($direct_pay_response['transaction_status']=='TXN_FAILURE')
                {
                    //insert into online_order table
                    $this->OnlineOrder=ClassRegistry::init('OnlineOrder');
                    $this->data['OnlineOrder']=$direct_pay_response;
                    $this->data['OnlineOrder']['date_created'] = date('Y-m-d H:i:s');
                    $this->OnlineOrder->create();
                    $this->OnlineOrder->save($this->data);

                    //send mail for success transaction
                    $userData = $this->Session->read('UserDetail');
                    $this->set('userData',$userData);
                    $this->set('amount_received',$direct_pay_response['amount']);

                    $this->Email->template = 'online_payment_failure';
                    $this->Email->from = 'info@niramayahealthcare.com';
                    $this->Email->fromName = 'Email from Niramaya Healthcare';
                    $this->Email->subject = 'Niramaya: Transaction Failure';
                    $this->Email->to = $userData['User']['email'];
                    $this->Email->replyTo = 'info@niramayahealthcare.com';
                    $this->Email->sendAs = 'html';
                    $this->Email->delivery = 'mail';
                    $this->Email->send();
                }
            }
            $this->Session->delete('UserProcessedOrder');
            $this->Session->delete('session_test');
            $this->Session->setFlash('The payment has not been recieved and we request you to try the trancation again..','flash_success');
            $this->redirect(array('controller'=>'tests','action'=>'payment_history'));
        }

        function directPayResponse()
        {
            $response=array();
            
            $response['flag'] = "Y";//isset($_REQUEST['flag'])?$_REQUEST['flag']:"N";
            $response['transaction_id'] = $_REQUEST['TXNID'];
            $response['transaction_status'] =$_REQUEST['STATUS'];
            //$response['country']=$_REQUEST['STATUS'];
            $response['currency']=$_REQUEST['CURRENCY'];
            //$response['other_details']=$_REQUEST['STATUS'];
            $response['order_number']=$_REQUEST['ORDERID'];
            $response['amount']=$_REQUEST['TXNAMOUNT'];
            $response['user_id']=$this->Session->read('UserDetail.User.id');
            $response['request_id']=$this->Session->read('UserProcessedOrder.request_id');
            return $response;
        }

        
}
?>