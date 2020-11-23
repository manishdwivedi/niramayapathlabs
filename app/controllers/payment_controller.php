<?php
class PaymentController extends AppController
{
	var $name = "Payment";
	
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
            App::import('Vendor', 'crypt', array('file' => 'AES.php'));
            $aes = new Crypt_AES();
            $secret=base64_decode(Configure::read('DirectPayKey'));
            $aes->setKey($secret);


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
                Configure::write('DirectPay.amount', $amt);
                Configure::write('DirectPay.order_number', 'NHCARE'.$order_id);

                $requestParameter=$this->_getRequestParameter();
                $billingDtls=$this->_getbillingDtls($patient_data);
                $shippingDtls=$this->_getshippingDtls($patient_data);
                
                //encryption of fom data
                $requestParameter = base64_encode($aes->encrypt($requestParameter));
                $billingDtls  = base64_encode($aes->encrypt($billingDtls));
                $shippingDtls  = base64_encode($aes->encrypt($shippingDtls));
                
                $this->set('patient_data',$patient_data);
                $this->set('requestParameter',$requestParameter);
                $this->set('billingDtls',$billingDtls);
                $this->set('shippingDtls',$shippingDtls);

                $this->Session->write('UserProcessedOrder',array('request_id'=>$req_id));

            }
            else
            {
                //invalid transaction
                $this->redirect('/');
            }

        }

        function success()
        {
            $this->layout="default";
            if($this->Session->check('UserProcessedOrder')) {
                
                $direct_pay_response=$this->directPayResponse();
               
                if($direct_pay_response['flag'] == 'Y' && $direct_pay_response['transaction_status']=='SUCCESS')
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
                        $this->Health->updateAll(array('Health.received_amount' =>('Health.received_amount + '.$direct_pay_response['amount'])),array('Health.id' =>$direct_pay_response['request_id']));
                        $this->Health->updateAll(array('Health.balance_amount'=>('Health.total_amount - Health.received_amount')),array('Health.id' =>$direct_pay_response['request_id']));

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

                if($direct_pay_response['flag'] == 'N' && $direct_pay_response['transaction_status']=='FAIL')
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
            $responseParam=explode('|',$_REQUEST['responseparams']);
            $response['flag'] = isset($_REQUEST['flag'])?$_REQUEST['flag']:"N";
            $response['transaction_id'] = $responseParam[0];
            $response['transaction_status'] =$responseParam[1];
            $response['country']=$responseParam[2];
            $response['currency']=$responseParam[3];
            $response['other_details']=$responseParam[4];
            $response['order_number']=$responseParam[5];
            $response['amount']=$responseParam[6];
            $response['user_id']=$this->Session->read('UserDetail.User.id');
            $response['request_id']=$this->Session->read('UserProcessedOrder.request_id');
            return $response;
        }

        function _getRequestParameter()
        {
            $request_parameter="";
            foreach(Configure::read('DirectPay') as $key=>$value)
            {
                $request_parameter.=$value."|";
            }
            //removing last pipe
            return substr($request_parameter,0,strlen($request_parameter)-1);

        }

        function _getbillingDtls($patient_data)
        {
            return $patient_data['Health']['name']."|".$patient_data['User']['address']."|".$patient_data['User']['City']['name']."|".$patient_data['User']['State']['name']."|".$patient_data['User']['pincode']."|".Configure::read('DirectPayBillCountry')."|"."91"."|011"."|28000000"."|"."9313789068"."|".$patient_data['User']['email']."|"."notes";
        }

        function _getshippingDtls($patient_data)
        {
           return $patient_data['Health']['name']."|".$patient_data['User']['address']."|".$patient_data['User']['City']['name']."|".$patient_data['User']['State']['name']."|".$patient_data['User']['pincode']."|".Configure::read('DirectPayBillCountry')."|"."91"."|011"."|28000000"."|"."9313789068";
        }
}
?>