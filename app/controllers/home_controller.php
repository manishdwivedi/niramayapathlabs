<?php  
require "/home2/niramovh/lib/PHPMailer/class.phpmailer.php";
require "/home2/niramovh/lib/PHPMailer/class.smtp.php";
App::import('Vendor', '/fpdf/fpdf');
App::import('Vendor', '/fpdf/fpdi');

class HomeController extends AppController
{
	var $name = "Home";
	var $breadcrumb = array();
	var $uses=array('ItdoseTable','ActivityLog','JsonData','PrescriptionMaster','RunnerRequest','RunnerSampleData','LabRateList','Test','Lab','Billing','RequestTest','ProcessingLabs','Healthlabmateresponse','Health');
	public $components = array('Utility');

	public $_request = array();
	private $_method = "";      
	private $_code = 200;
	private $_pcc_id = "";
    private $_lab_id = "";
    private $_user_table_id = "";
    private $_health_table_id = "";
    private $_order_total_amt = 0;
    private $_test_ids = array();
    private $_profile_ids = array();
    private $_service_ids = array();
    private $_package_ids = array();
    private $_banner_ids = array();
	private $_order_id = "";

		function our_clients()
        {
            $this->layout='tests';
        }
		
		/*function to check which server is alive*/
		function GetServerStatus($site, $port)
		{
			$fp = @fsockopen($site, $port, $errno, $errstr, 2);
			if (!$fp)
			{
				return false;
			}
			else 
			{
				return true;
			}
		}

        function _activity_log($patient , $health, $action)
        {
	    $this->ActivityLog = ClassRegistry::init('ActivityLog');
            // To get page url to track activity
            $page_url = Router::url( $this->here, true );
            
            $this->data['ActivityLog']['admin_id'] = $this->Session->read('Admin.id');
            $this->data['ActivityLog']['patient_id'] = $patient;
            $this->data['ActivityLog']['health_id'] = $health;
            $this->data['ActivityLog']['page_url']= $page_url;
            $this->data['ActivityLog']['action']= $action;
            $this->data['ActivityLog']['creation'] = date('Y-m-d H:i:s');

            if($this->ActivityLog->create($this->data))
            {
                $this->ActivityLog->save($this->data);
            }
        }

		function print_report($rep_name=NULL)
		{
			//print_R('hello');die;
			$this->Health = ClassRegistry::init("Health");
            $this->Lab = ClassRegistry::init("Lab");
			if(empty($rep_name))
			{
				$this->redirect('/tests/my_account');
			}
			else
			{ 
				
				$dec_rep_name = "";
				$req_info = $this->Health->find('first',array('conditions'=>array('Health.patient_report'=>str_replace("@@@@","?",base64_decode($rep_name)))));
				$date = explode("-",$req_info['Health']['s_date']);
				$lastyear = date('Y-1-1');
				$lastyear = date('Y-m-d',(strtotime ( '-1 year' , strtotime ( $lastyear) ) ));			
			
				if(strtotime($req_info['Health']['s_date']) <= strtotime($lastyear))
				{
					$ftp_server = "npl.infosysmicro.com";
					$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
					$login = ftp_login($ftp_conn, 'niramya', 'abc123!@');
					
					$local_file = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['id'].".pdf";
					
					$server_file = "/files/reports/".$req_info['Health']['patient_report'];

					if(!ftp_get($ftp_conn, $local_file, $server_file, FTP_BINARY))
					{
						echo "not copied";
						die;
					}
					ftp_close($ftp_conn);
					$dec_rep_name = $local_file;
				}
				else{
					if (strpos($req_info['Health']['patient_report'], 'http:') !== false || strpos($req_info['Health']['patient_report'], 'https:') !== false) { 
						if(file_put_contents("/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf",file_get_contents($req_info['Health']['patient_report'])))
						{
							$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf";
						}	
						else
						{
							file_put_contents("/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf",file_get_contents("https://test.niramayahealthcare.com/home/print_report/".base64_encode(str_replace("?","@@@@",$req_info['Health']['patient_report']))));
							$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf";
						}
					}
					else{
						$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/".$req_info['Health']['patient_report'];			
					}
				}
				App::import('Vendor', '/fpdf/fpdf');
				App::import('Vendor', '/fpdf/fpdi');
				$pdf = new FPDI();
				$pdf->addPage();
				$pagecount = $pdf->setSourceFile($dec_rep_name);

				$lab_info = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$req_info['Health']['created_by'])));

				for ($i=1; $i <= $pagecount; $i++) {
					$tplidx = $pdf->ImportPage($i);
					$pdf->useTemplate($tplidx,0,0,0);
					//$pdf->Image('/home2/niramovh/public_html/app/webroot'.$header_image,0,0,$pdf->w,40);
					if($i != $pagecount)
					{
						$pdf->addPage();
					}
				}
				$pdf->Output("report.pdf", "I");
				exit;
			}
		}
		
        function get_sample_status($c=NULL)
        {
            $this->Health = ClassRegistry::init("Health");
            $this->Healthsample = ClassRegistry::init("Healthsample");
            $this->Lab = ClassRegistry::init("Lab");
			$this->Billing = ClassRegistry::init('Billing');
			$this->JsonData = ClassRegistry::init('JsonData');

            $today_date = date('Y-m-d');
            $today_date = date('Y-m-d',(strtotime ( '-10 days' , strtotime ( $today_date) ) ));

            if(!isset($c))
            {
            	$c = "s_date > '".$today_date."'";
            }

            $orders = $this->Health->query("SELECT healths.* 
            			FROM healths 
            			WHERE ".$c."
                        AND requ_status in ('14','12') 
                        AND assigned_lab != 145
                        Group By healths.id
                        ORDER BY `healths`.`id`");
						// and id = 558396  
            /*print_R("SELECT healths.* 
            			FROM healths 
            			WHERE ".$c."
                        AND requ_status in ('14','12') 
                        AND assigned_lab != 145
                        Group By healths.id
                        ORDER BY `healths`.`id`");
            echo "<br>";die;*/
            //print_R(count($orders));die;
            foreach($orders as $order_key=>$order_val)
            {
            	$json_check = $this->JsonData->find('all',array('conditions'=>array('JsonData.health_id'=>$value['healths']['id'],'JsonData.action'=>'LIS API NEW BOOKING')));
				//print_R($json_check);die;
				if(empty($json_check))
				{
					$this->_activity_log($order_val['healths']['user_id'], $order_val['healths']['id'],'running sample status update for '.$order_val['healths']['id']);
	                $test = $this->Health->find('first',array('conditions'=>array('Health.id'=>$order_val['healths']['id'])));
	                $pccDetail = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$test['Health']['created_by'])));
	                
					$billingDetails = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$order_val['healths']['id'])));
					
					$data = array(
	                        "APIKey"=> $pccDetail['Lab']['api_key'],
	                        "APIUser"=> $pccDetail['Lab']['api_user'],
	                        "CenterID"=> $pccDetail['Lab']['center_id'],
							"Order_id" => $test['Health']['reference'],
							"MRN_Id" => $test['Health']['medical_reference_number']
	                    );
						print_R(json_encode($data));
	                $ch = curl_init();
	                $curlConfig = array(
	                    CURLOPT_URL            => "http://lis.niramayapathlabs.com/live/design/jsonreceive/SampleStatus.aspx",
	                    CURLOPT_POST           => true,
	                    CURLOPT_RETURNTRANSFER => true,
	                    CURLOPT_POSTFIELDS     => json_encode($data),
	                    CURLOPT_HTTPHEADER => array(
	                        "cache-control: no-cache",
	                        "content-type: application/json"
	                    ),
	                );

	                curl_setopt_array($ch, $curlConfig);
	                $result = curl_exec($ch);
	                if(curl_error($ch))
					{
						print_R(curl_error($ch));
					}
	                curl_close($ch);
	 
	                $resultjson = json_decode($result);
					
					$this->_json_data($order_val['healths']['id'],date('Y-m-d h:i:s'),"sample status recieved ",json_encode($data),$result);
					
					print_R($resultjson);
					$rowcount = $this->Healthsample->find('count', array('conditions' => array('Healthsample.health_id'=>$order_val['healths']['id'])));
					$totalcount=$rowcount;
					$totalrecieved = 0;
					$totalrejected = 0;
					foreach($resultjson->SamplesReceived as $key=>$val)
					{
						$status = '';
						$totalcount++;
						if($val->SampleStatus=='Received'){
							$status = '1';
							$totalrecieved++;
						}
						if($val->SampleStatus=='Not Done' || $val->SampleStatus=='Pending'){
							$status = '3';
						}
						if($val->SampleStatus=='Reject'){
							$status = '2';
							$totalrejected++;

							if($this->Utility->check_push_notification_for_pcc($order_val['healths']['created_by'],$order_val['healths']['assigned_lab']) == 1)
							{
								$response = $this->Utility->send_reject_notification($order_val['healths']['id'],$val->SampleTypeID);
							}
						}
	                    $remark = $val->SampleRemark;
	                    $sampledatetime = '';
	                    if(!empty($val->SampleReceivedDateTime))
	                        $sampledatetime = date('Y-m-d h:i:s',strtotime($val->SampleReceivedDateTime));
	                    $sampledata = $this->Healthsample->find('first',array('conditions'=>array('Healthsample.health_id'=>$order_val['healths']['id'],'OR'=>array('Healthsample.sample_id'=>$val->SampleTypeID,'Healthsample.barcode_id'=>$val->BarcodeId))));
	                    $sample['Healthsample']['id'] = $sampledata['Healthsample']['id'];
	                    $sample['Healthsample'] = $sampledata['Healthsample'];
	                    $sample['Healthsample']['sample_status'] = $status;
	                    $sample['Healthsample']['sample_remark'] = $remark;
	                    $sample['Healthsample']['sample_recieved_datetime'] = $sampledatetime;
	                    $sample['Healthsample']['assigned_barcode_id'] = $val->BarcodeId;

	                    $sampleresult = $this->Healthsample->save($sample);
	                }
					$message_from_lab = '';
					if($resultjson->OrderStatus == 'Reject'){
					//if($totalrejected == $totalcount){	
						$test['Health']['requ_status']='11';
						$message_from_lab = 'All Samples rejected kindly contact Lab team for details - '.$sampledatetime;
						$test['Health']['order_sample_status'] = 'Samples Rejected';
					}
					else if($resultjson->OrderStatus == 'Partial Send To Lab'){
					//else if($totalrecieved < $totalcount && $totalrecieved >0){
						$test['Health']['requ_status']='12';
						$message_from_lab = 'One of more samples still pending kindly contact Lab team for details - '.$sampledatetime;
						$test['Health']['order_sample_status'] = 'Patial Send To Lab';
					}
					else if($resultjson->OrderStatus == 'Send To Lab'){
					//else if($totalrecieved == $totalcount){	
						$test['Health']['requ_status']='5';
						$message_from_lab = 'All Samples received & sent for testing - '.$sampledatetime;
						$test['Health']['order_sample_status'] = 'Send To Lab';
						
						if($order_val['healths']['created_by']=='143')
						{
							$this->Utility->visitapp_result($order_val['healths']['id'],$order_val['healths']['created_by'],"manual");
						}
					}
					else
						$test['Health']['requ_status']='14';
					
					$this->LabMessageMaster = ClassRegistry::init('LabMessageMaster');
					$this->LabMessageMaster->create();
					
					$this->data['LabMessageMaster']['request_id'] = $order_val['healths']['id'];
					$this->data['LabMessageMaster']['date'] = date('Y-m-d H:i:s');
					$this->data['LabMessageMaster']['message'] = $message_from_lab;
					
					$this->LabMessageMaster->save($this->data);
					//$test['Health']['lab_message']=$message_from_lab;
					$test['Health']['remarks']=$message_from_lab;		            
	             
	                $test['Health']['sent_pathcorp']='1';             
	                $test['Health']['order_sample_status'] = $resultjson->OrderStatus;
	                echo "<br><br>";
	                if($this->Health->save($test))
	                {
						if($this->Utility->check_push_notification_for_pcc($order_val['healths']['created_by'],$order_val['healths']['assigned_lab']) == 1)
						{
							$response = $this->Utility->send_notification($order_val['healths']['id']);
						}
						
	                    $this->_activity_log($order_val['healths']['user_id'], $order_val['healths']['id'],'successfully fetched sample status for '.$order_val['healths']['id']);
	                }
	                else
	                    $this->_activity_log($order_val['healths']['user_id'], $order_val['healths']['id'],'Failed in fetching status');
				}
                
            }
            echo "<br><br>";die;
        }

/*		function repair_order()
		{
			$this->Health = ClassRegistry::init("Health");
			$health_orders = $this->Health->query("SELECT *
			FROM healths
			WHERE ref_num != ''
            and ref_num !=0
            and requ_status in (0,15,4,13,10)
			LIMIT 0 , 30");
			//print_R($health_orders);die;
			foreach($health_orders as $order_key=>$order_val)
			{
				$update_query = $this->Health->query("UPDATE healths SET requ_status='14',last_edited_date='".date('Y-m-d H:i:s')."' WHERE id='".$order_val['healths']['id']."'");
			}
			die;
		}
*/		
        function send_to_labmate()
		{
        $this->Health = ClassRegistry::init("Health");
        $this->User = ClassRegistry::init("User");
        $this->Billing = ClassRegistry::init('Billing');
        $this->Test = ClassRegistry::init('Test');
        $this->Package = ClassRegistry::init('Package');
        $this->Banner = ClassRegistry::init('Banner');
        $this->Healthsample = ClassRegistry::init("Healthsample");
        $today_date = date('Y-m-d');
        $today_date = date('Y-m-d',(strtotime ( '-7 days' , strtotime ( $today_date) ) ));

        $health_orders = $this->Health->query("SELECT *
			FROM healths
			WHERE s_date > '".$today_date."' 
			AND requ_status = '10'
			AND ref_num = ''
			ORDER BY `healths`.`id` ASC
			LIMIT 0 , 30");

        foreach($health_orders as $order_key=>$order_val)
        {
            print_R($order_val['healths']['id']."---------");
            $health_detail = $this->Health->find('first',array('conditions'=>array('Health.id'=>$order_val['healths']['id'])));

            $user_detail = $this->User->find('first',array('conditions'=>array('User.id'=>$health_detail['Health']['user_id'])));
            $test_list = explode(',',$health_detail['Health']['test_id']);
            $profile_list = explode(',',$health_detail['Health']['profile_id']);
            $service_list = explode(',',$health_detail['Health']['service_id']);
            $package_list = explode(',',$health_detail['Health']['package_id']);
            $offer_list = explode(',',$health_detail['Health']['offer_id']);
            $billing_detail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$order_val['healths']['id'])));

            $testList = array();
            $sampleList = array();
            $count = 0;
            if(!empty($health_detail['Health']['test_id']))
            {
                foreach($test_list as $key=>$val)
                {
					if($val!='')
					{
                    $test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
                    $testList[$count] = $test_detail['Test']['testcode'];
                    //$testList[$count]['HOrder_ID'] = //$billing_detail['Billing']['order_id'];
                    $count++;
					}
                }
            }
            if(!empty($health_detail['Health']['profile_id']))
            {
                foreach($profile_list as $key=>$val)
                {
					if($val!='')
					{
                    $test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
                    $testList[$count] = $test_detail['Test']['testcode'];
                    //$testList[$count]['HOrder_ID'] = //$billing_detail['Billing']['order_id'];
                    $count++;
					}
                }
            }
            if(!empty($health_detail['Health']['service_id']))
            {
                foreach($service_list as $key=>$val)
                {
					if($val!='')
					{
                    $test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
                    $testList[$count] = $test_detail['Test']['testcode'];
                    //$testList[$count]['HOrder_ID'] = //$billing_detail['Billing']['order_id'];
                    $count++;
					}
                }
            }
            if(!empty($health_detail['Health']['package_id']))
            {
                foreach($package_list as $key=>$val)
                {
					if($val!='')
					{
                    $test_detail = $this->Package->find('first',array('conditions'=>array('Package.id'=>$val)));
                    $testList[$count] = $test_detail['Package']['package_code'];
                    //$testList[$count]['HOrder_ID'] = //$billing_detail['Billing']['order_id'];
                    $count++;
					}
                }
            }
            if(!empty($health_detail['Health']['offer_id']))
            {
                foreach($offer_list as $key=>$val)
                {
					if($val!='')
					{
                    $test_detail = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$val)));
                    $testList[$count] = $test_detail['Package']['banner_code'];
                    //$testList[$count]['HOrder_ID'] = //$billing_detail['Billing']['order_id'];
                    $count++;
					}
                }
            }

            $sample_health = $this->Healthsample->find('all',array('conditions'=>array('Healthsample.health_id'=>$order_val['healths']['id'])));

            if(!empty($sample_health))
            {   $count1=0;
                foreach($sample_health as $key=>$val)
                {
                    $sampleList[$count1]['SampleId'] = $val['Healthsample']['sample_id'];
                    $sampleList[$count1]['BarcodeId'] = $val['Healthsample']['barcode_id'];
                    $count1++;
                }
            }

            $this->Timelab = ClassRegistry::init("Timelab");
            $timelabs = $this->Timelab->find('all',array('conditions'=>array('Timelab.status'=>1),'order'=>array('Timelab.sequence ASC')));
            $time=explode('-',$timelabs[$health_detail['Health']['sample_time1']]['Timelab']['name']);

            $this->Lab = ClassRegistry::init("Lab");
            $pccDetail = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$health_detail['Health']['created_by'])));
            $servicePccDetail = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$health_detail['Health']['assigned_lab'])));
            $referred_by = $health_detail['Health']['remark'];
            if(empty($health_detail['Health']['remark']))
                $referred_by = $user_detail['User']['name'];

            $dateTime = explode(" ",$health_detail['Health']['sample_collected_date']);
            $date =  date('d-m-Y',strtotime($dateTime[0]));
            $s_date_new = $dateTime[0];
            $datetime = $dateTime[1];

            $date=date('Y-m-d', strtotime($s_date_new))." ".$datetime;

            $reference = "NPL".$billing_detail['Billing']['order_id'];
            if(!empty($health_detail['Health']['reference']))
                $reference = $health_detail['Health']['reference'];

            $patientTitle = 'Mr.';
            $sex = 'male';
            $isurgent = 0;
            if($health_detail['Health']['is_urgent']=='true')
                $isurgent = 1;
                
            if($health_detail['Health']['gender']=='2')
            {
                $patientTitle = 'Mrs.';
                $sex = 'female';
            }
			
			$address = "";
			if(!empty($health_detail['Health']['address']) && $health_detail['Health']['address']!="")
				$address = $health_detail['Health']['address'];
			else
				$address = $health_detail['Health']['address1'];
			
            $customerId = $health_detail['Health']['user_id'];
            if(!empty($health_detail['Health']['medical_reference_number']))
                $customerId = $health_detail['Health']['medical_reference_number'];
            $comment ='';
            if(!empty($health_detail['Health']['remarks']))
                $comment = $health_detail['Health']['remarks'];
            else
                $comment = $health_detail['Health']['discount_amount_reason'];            
			
			$email="";
			if(!empty($health_detail['Health']['email']))
				$email = $health_detail['Health']['email'];
			else
				$email = ".";
			
			$data = array(
                "APIKey"=> $pccDetail['Lab']['api_key'],
                "APIUser"=> $pccDetail['Lab']['api_user'],
                "Title"=>$patientTitle,
                "PatientName"=> strtoupper($health_detail['Health']['name']),
                "LastName"=>".",
                "Referredby"=>$referred_by,
                "Sex"=> $sex,
                "Age"=> $health_detail['Health']['age'],
                "MobileNumber"=> $health_detail['Health']['landline'],
                "Address"=> $address,
                "PinCode"=> $health_detail['Health']['pincode'],
                "Landmark" => $health_detail['Health']['landmark'],
                "SampleCollectedDate"=> $date,
				"Order_id" => $health_detail['Health']['reference'],
				"MRN_Id" => $health_detail['Health']['medical_reference_number'],
                //"BookingID"=> $billing_detail['Billing']['order_id'],
                //"CustomerID"=> $customerId,
                "CenterID"=>$pccDetail['Lab']['center_id'],
                "PanelID"=>$pccDetail['Lab']['registration_number'],
                "IsUrgent"=>$isurgent,
                "Email"=>$email,
                "VisitType"=>"1",
                "ServiceBypanel"=>$servicePccDetail['Lab']['registration_number'],
                "Comment"=> $comment." Order Intiated via Nhcare",
                "TestList"=>$testList,
                "Samples"=>$sampleList
            );
            print_R(json_encode($data));
            $ch = curl_init();
            $curlConfig = array(
                CURLOPT_URL            => "http://lis.niramayapathlabs.com/live/Design/jsonreceive/Postorder.aspx",
                CURLOPT_POST           => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS     => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/json"
                ),
            );

            curl_setopt_array($ch, $curlConfig);
            $result = curl_exec($ch);
            //print_R(curl_getinfo($ch));
			if(curl_error($ch))
			{
				print_R(curl_error($ch));
			}
            curl_close($ch);
            $decoded_result = json_decode($result) ;
			$this->_json_data($health_detail['Health']['id'],date('Y-m-d h:i:s'),"Post Order Fired",json_encode($data),$result);

            if(isset($decoded_result->Labno) && $decoded_result->Labno!=0)
            {
            	$this->_activity_log($health_detail['Health']['user_id'],$health_detail['Health']['id'], 'Order sent to Labmate - Home');
                $update_query = $this->Health->query("UPDATE healths SET requ_status='14',ref_num='".$decoded_result->Labno."',sent_pathcorp='1',sent_pathcorp_admin='0' ,last_edited='0',last_edited_date='".date('Y-m-d H:i:s')."',netbilling='".$decoded_result->Netbilling."' WHERE id='".$order_val['healths']['id']."'");
                echo "success";
				print_R($decoded_result);
				echo "<br>";

				//$this->Utility->lis_payment_update($order_val['healths']['id'],"all");
				
				if($this->Utility->check_push_notification_for_pcc($order_val['healths']['created_by'],$order_val['healths']['assigned_lab']) == 1)
				{
					$response = $this->Utility->send_notification($order_val['healths']['id']);
				}

            }
            else
            {
                print_R($health_detail['Health']['user_id']."-----");
                print_R($order_val['healths']['id']."-----");
                echo "failed";
                echo "<br><br>";
                //$this->_activity_log($health_detail['Health']['user_id'], $order_val['healths']['id'],$decoded_result);
            }
			
		}
		die;
    }
    
	function trigger_visitapp()
	{
		$today_date = date('Y-m-d');

        $today_date = date('Y-m-d',(strtotime ( '-17 day' , strtotime ( $today_date) ) ));
		$conditions = array();
		$conditions['s_date >='] = $today_date;
		$conditions['requ_status'] = 6;
		$conditions['created_by'] = 143;
		$conditions['ref_num >'] = 0;
									
		$this->Health = ClassRegistry::init('Health');
		$data = $this->Health->find('all',array('conditions'=>$conditions));
		
		foreach($data as $key=>$value)
        {
			$this->Utility->visitapp_result($value['Health']['id'],$order_val['healths']['created_by'],"manual");
		}
		die;
	}
        //function to update patient reprot by cron call
    function update_patient_report($c=null)
	{
	    $today_date = date('Y-m-d');
	    $today_date = date('Y-m-d',(strtotime ( '-10 day' , strtotime ( $today_date) ) ));

	    $this->JsonData = ClassRegistry::init('JsonData');
		$this->Health = ClassRegistry::init('Health');
		$this->Lab = ClassRegistry::init("Lab");
		$this->Healthlabmateresponse = ClassRegistry::init('Healthlabmateresponse');

	    if(!isset($c))
	    {
	        $c = "s_date > '".$today_date."'";
	    }
	    
        $data = $this->Health->query("SELECT healths.* 
			FROM healths 
			WHERE ".$c."
            AND requ_status in ('12','5','7')
            AND ref_num > 0 
            AND assigned_lab != 145
            Group By healths.id
            ORDER BY `healths`.`id` ASC");
	 
		/*print_R("SELECT healths.* 
			FROM healths 
			WHERE ".$c."
            AND requ_status in ('12','5','7')
            AND ref_num > 0 
            AND assigned_lab != 145
            Group By healths.id
            ORDER BY `healths`.`id` ASC");die;*/

		if(count($data))
	    {
			$success_count=0;
	        $failure_count=0;
	        foreach($data as $key=>$value)
	        {
				//print_R($value);die;
				$json_check = $this->JsonData->find('all',array('conditions'=>array('JsonData.health_id'=>$value['healths']['id'],'JsonData.action'=>'LIS API NEW BOOKING')));
				//print_R($json_check);die;
				if(empty($json_check))
				{
					$pccDetail = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$value['healths']['created_by'])));
					$api_url="http://lis.niramayapathlabs.com/live/design/jsonreceive/RequestStatus.aspx";
					//print_R($pccDetail);die;
					$data = array(
						"APIKey"=> $pccDetail['Lab']['api_key'],
						"APIUser"=> $pccDetail['Lab']['api_user'],
						"Panel_ID" => $pccDetail['Lab']['registration_number'],
						"Centre_ID"=> $pccDetail['Lab']['center_id'],
						"Order_id" => $value['healths']['reference'],
						"MRN_Id" => $value['healths']['medical_reference_number']
					);
					print_R(json_encode($data));
					$ch = curl_init();

					$curlConfig = array(

						CURLOPT_URL            => $api_url,

						CURLOPT_CUSTOMREQUEST  => "POST",

						CURLOPT_RETURNTRANSFER => true,

						CURLOPT_POSTFIELDS     => json_encode($data),
						
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						
						CURLOPT_HTTPHEADER => array(

							"content-type: application/json",
							"cache-control: no-cache"

						),

					);
		             curl_setopt_array($ch, $curlConfig);
					$result = curl_exec($ch);

					for ($i = 0; $i <= 31; ++$i) { 
						$result = str_replace(chr($i), "", $result); 
					}
					$result = str_replace(chr(127), "", $result);
					
					if (0 === strpos(bin2hex($result), 'efbbbf')) {
					   $result = substr($result, 3);
					}
					
					$api_result = json_decode($result);
					print_R($api_result);echo "<br>";
					//print_R(json_last_error());echo "<br>";
					$filecontent=file_get_contents($api_result->ReportLinkWithHeader);

					if(preg_match("/^%PDF-1.4/", $filecontent)){
			            $this->_activity_log($value['healths']['user_id'], $value['healths']['id'],'Valid Report Url Recieved - '.$value['healths']['reference']);
			        			
						if($api_result->CurrentStatus == 'Completed')
						{
							$success_count++;
							$this->_json_data($value['healths']['id'],date('Y-m-d h:i:s'),"Full Report Mail executed",json_encode($data),$result);
							$this->Health->updateAll(array('Health.patient_report_with_header'=>"'".$api_result->ReportLinkWithHeader."'",'Health.patient_report'=>"'".$api_result->ReportLink."'",'Health.requ_status'=>6,'Health.report_type'=>"'".'full'."'",'Health.last_edited'=>0,'Health.last_edited_date'=>"'".date('Y-m-d H:i:s')."'"),array('Health.id'=>$value['healths']['id']));
							
							$this->Healthlabmateresponse->create();
							$this->data1['Healthlabmateresponse']['health_id'] = $value['healths']['id'];
							$this->data1['Healthlabmateresponse']['json_data'] = json_encode($api_result);
							$this->Healthlabmateresponse->save($this->data1);
							
							if($this->Utility->check_push_notification_for_pcc($value['healths']['created_by'],$value['healths']['assigned_lab']) == 1)
							{
								$response = $this->Utility->send_notification($value['healths']['id']);
							}
							
							$this->_auto_report_upload_notify($value['healths']['id']);
							
							if($pccDetail['Lab']['send_report_mail']==1)
								$this->_send_report_to_booked_pcc($value['healths']['id']);
							
							if($pccDetail['Lab']['send_report_mail_patient']==1)
								$this->_send_report_to_patient($value['healths']['id']);
							
							$call_health_api = $this->Utility->trigger_callhealth_results($value['healths']['id']);
							
							//$this->_activity_log($value['healths']['user_id'],$value['healths']['id'],'Updating patient report');
							$this->_activity_log($value['healths']['user_id'], $value['healths']['id'],'Complete Report Recieved');
						}
						elseif($api_result->CurrentStatus=='Partial')
						{
							$success_count++;
							$this->_json_data($value['healths']['id'],date('Y-m-d h:i:s'),"Partial Report Mail executed",json_encode($data),$result);
							$this->Health->updateAll(array('Health.patient_report_with_header'=>"'".$api_result->ReportLinkWithHeader."'",'Health.patient_report'=>"'".$api_result->ReportLink."'",'Health.requ_status'=>7,'Health.report_type'=>"'".'partial'."'",'Health.last_edited'=>0,'Health.last_edited_date'=>"'".date('Y-m-d H:i:s')."'"),array('Health.id'=>$value['healths']['id']));
							
							if($this->Utility->check_push_notification_for_pcc($value['healths']['created_by'],$value['healths']['assigned_lab']) == 1)
							{
								$response = $this->Utility->send_notification($value['healths']['id']);
							}
							
							$this->_activity_log($value['healths']['user_id'], $value['healths']['id'], 'Partial Report Recieved');
						}
						else{
							$this->_json_data($value['healths']['id'],date('Y-m-d h:i:s'),"Report Mail Failure",json_encode($data),$result);
							$this->_activity_log($value['healths']['user_id'],$value['healths']['id'],$api_result->CurrentStatus);
						}
						curl_close($ch);
						
					}else{
			           echo "Not Valid pdf";
			           $this->_activity_log($value['healths']['user_id'], $value['healths']['id'],'Invalid Report Url Recieved - '.$value['healths']['reference']);
			        }
				}
				
			}
	       
	        echo "<h1 align='center'>Sync Complete</h1>";
	        echo "<h2 align='center'>".$success_count." report synced successfully</h2>";

	    }
		die;
	    $this->render(false);
	    unlink('error_log');
	    exit;
	}

	function _auto_report_upload_notify($id=null)
    {
        if(isset($id) && !empty($id))
        {
            $this->Health = ClassRegistry::init('Health');
			$req_info = $this->Health->find('first',array('conditions'=>array('Health.id'=>$id)));
			$this->Lab = ClassRegistry::init('Lab');
			$lab_info = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$req_info['Health']['assigned_lab'])));
			$new_url = $this->get_tiny_url($req_info['Health']['patient_report_with_header']);
			$number = $req_info['Health']['landline'];
			if($req_info['Health']['gender'] == 1)
			{
				$title = 'Mr.';
			}

			if($req_info['Health']['gender'] == 2)
			{
				$title = 'Ms.';
			}
			
			$this->Billing = ClassRegistry::init('Billing');
			$get_req_number = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$req_info['Health']['id']))); //Report URL : '.$new_url.'.
			
			$balance = $req_info['Health']['total_amount'] - $req_info['Health']['recieved_amount'];
			
			$payment_link = $this->get_tiny_url("https://www.niramayahealthcare.com/home/checkbalance/".base64_encode($req_info['Health']['id']));
			
			$this->Lab = ClassRegistry::init('Lab');
		
			$lab_book = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$req_info['Health']['created_by'])));
			
			$message = 'Your test report for Test Req. No: ('.$get_req_number['Billing']['order_id'].') for Booked By '.$lab_book['Lab']['pcc_name'].' is published.';
			$message .= "\n";
			$balance = $req_info['Health']['total_amount'] - $req_info['Health']['received_amount'];
			//print_R($req_info['Health']['total_amount'] - $req_info['Health']['received_amount']);die;
			if($balance <= 0) //$balance
				$message .= 'Report URL : '.$new_url." \n";
			else
				$message .= 'As your payment of Rs.'.$balance.' is still due. kindly pay it using following link - '.$payment_link." for viewing Your Reports.\n ";
			
			$message .= 'For any Assistance call +91-9555009009 OR Visit www.NHcare.in';
			
			//print_R($message);
			
			if($this->Utility->check_sms_enable_for_pcc($req_info['Health']['created_by'],$req_info['Health']['assigned_lab']) == 1)
			{
				$this->__sms_message($number,$message);
				$this->_activity_log($req_info['Health']['user_id'], $this->data['Health']['id'],"Message sent to '".$number."'");
			}
            //$this->_activity_log($req_info['Health']['user_id'], $this->data['Health']['id'], $action = "Upload Report");
        }
    }


    //function to export patient data for busy soft Lis integration

    function lis_export($user=null,$format=null,$date=null)
    {

        // Define whether an HTTPS connection is required
        $HTTPS_required = FALSE;

        // Define whether user authentication is required
        $authentication_required = TRUE;

        // Define API response codes and their related HTTP response
        $api_response_code = array(
            0 => array('HTTP Response' => 400, 'Message' => 'Unknown Error'),
            1 => array('HTTP Response' => 200, 'Message' => 'Success'),
            2 => array('HTTP Response' => 403, 'Message' => 'HTTPS Required'),
            3 => array('HTTP Response' => 401, 'Message' => 'Authentication Required'),
            4 => array('HTTP Response' => 401, 'Message' => 'Authentication Failed'),
            5 => array('HTTP Response' => 404, 'Message' => 'Invalid Request'),
            6 => array('HTTP Response' => 400, 'Message' => 'Invalid Response Format')
        );

        // Set default HTTP response of 'ok'
        $response['code'] = 0;
        $response['status'] = 404;
        $response['data'] = NULL;

        // --- Step 2: Authorization

        // Optionally require connections to be made via HTTPS
        if( $HTTPS_required && $_SERVER['HTTPS'] != 'on' ){
            $response['code'] = 2;
            $response['status'] = $api_response_code[ $response['code'] ]['HTTP Response'];
            $response['data'] = $api_response_code[ $response['code'] ]['Message'];

            // Return Response to browser. This will exit the script.
            $this->deliver_response($_GET['format'], $response);
        }

        // Optionally require user authentication
        if( $authentication_required ){

            if( empty($_GET['username'])){
                $response['code'] = 3;
                $response['status'] = $api_response_code[ $response['code'] ]['HTTP Response'];
                $response['data'] = $api_response_code[ $response['code'] ]['Message'];

                // Return Response to browser
                $this->deliver_response($_GET['format'], $response);

            }

            // Return an error response if user fails authentication. This is a very simplistic example
            // that should be modified for security in a production environment
            elseif( $_GET['username'] != 'busysoft'){
                $response['code'] = 4;
                $response['status'] = $api_response_code[ $response['code'] ]['HTTP Response'];
                $response['data'] = $api_response_code[ $response['code'] ]['Message'];

                // Return Response to browser
                $this->deliver_response($_GET['format'], $response);

            }

        }

        //fetch data

        if($this->validateDate($_GET['date']) == 1){
            $response['code'] = 1;
            $response['status'] = $api_response_code[ $response['code'] ]['HTTP Response'];
            //$response['data'] = 'Hello World';
            $this->Health = ClassRegistry::init('Health');
            $this->Health->bindModel(array(
                'hasOne'=>array(
                    'Billing'=>array(
                        'className'=>'Billing',
                        'foreignKey'=>'request_id',
                        'fields'=>array('request_id','sub_total')
                    )
                )
            ));
            $data1 = $this->Health->find('all',array('conditions'=>array('Health.s_date'=>$_GET['date']),'limit'=>1));

            foreach($data1 as $key1=>$data){
                $response_data[$key1]['data']= $data;

                $test_id=!empty($data['Health']['test_id']) ? explode(",",$data['Health']['test_id']) : "";
                $profile_id=!empty($data['Health']['profile_id']) ? explode(",",$data['Health']['profile_id']) : "";
                $offer_id=!empty($data['Health']['offer_id']) ? explode(",",$data['Health']['offer_id']) : "";
                $package_id=!empty($data['Health']['package_id']) ? explode(",",$data['Health']['package_id']) : "";
                $service_id=!empty($data['Health']['service_id']) ? explode(",",$data['Health']['service_id']) : "";
                if(!empty($test_id))
                {
                    $this->Test = ClassRegistry::init('Test');
                    $test = $this->Test->find('all',array('fields'=>array('testcode','test_parameter','mrp'),'conditions'=>array('Test.id'=>$test_id)));
                    foreach($test as $key=>$value)
                    {
                     $response_data[$key1]['Test'][] = $value['Test'];
                    }
                }
                else
                {
                    $response_data[$key1]['Test'] = "";
                }

                if(!empty($profile_id))
                {
                    $this->Test = ClassRegistry::init('Test');
                    $test = $this->Test->find('all',array('fields'=>array('testcode','test_parameter','mrp'),'conditions'=>array('Test.id'=>$profile_id)));
                    foreach($test as $key=>$value)
                    {
                     $response_data[$key1]['Profile'][] = $value['Test'];
                    }
                }
                else
                {
                    $response_data[$key1]['Profile'] = "";
                }
                if(!empty($offer_id))
                {
                    $this->Banner = ClassRegistry::init('Banner');
                    $test = $this->Banner->find('all',array('fields'=>array('banner_name','banner_code','banner_mrp'),'conditions'=>array('Banner.id'=>$offer_id)));
                    foreach($test as $key=>$value)
                    {
                     $response_data[$key1]['Offer'][] = $value['Banner'];
                    }
                }
                else
                {
                    $response_data[$key1]['Offer'] = "";
                }
                if(!empty($package_id))
                {
                    $this->Package = ClassRegistry::init('Package');
                    $test = $this->Package->find('all',array('fields'=>array('package_code','package_name','package_mrp'),'conditions'=>array('Package.id'=>$package_id)));
                    foreach($test as $key=>$value)
                    {
                     $response_data[$key1]['Package'][] = $value['Package'];
                    }
                }
                else
                {
                    $response_data[$key1]['Package'] = "";
                }
                if(!empty($service_id))
                {
                    $this->Test = ClassRegistry::init('Test');
                    $test = $this->Test->find('all',array('fields'=>array('testcode','test_parameter','mrp'),'conditions'=>array('Test.id'=>$profile_id)));
                    foreach($test as $key=>$value)
                    {
                     $response_data[$key1]['Service'][] = $value['Test'];
                    }
                }
                else
                {
                    $response_data[$key1]['Service'] = "";
                }

            }//end of foreach


        }
        foreach($response_data as $key=>$value)
        {
            $response['data'][$key]['Patient'] = $value['data']['Health'];
            $response['data'][$key]['Patient']['request_id'] = $value['data']['Billing']['request_id'];
            $response['data'][$key]['Patient']['sub_total'] = $value['data']['Billing']['sub_total'];
            $response['data'][$key]['Test'] = $value['Test'];
            $response['data'][$key]['Profile'] = $value['Profile'];
            $response['data'][$key]['Offer'] = $value['Offer'];
            $response['data'][$key]['Package'] = $value['Package'];
            $response['data'][$key]['Service'] = $value['Service'];
        }

        $this->deliver_response($_GET['format'], $response);
    }

    function validateDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') == $date;
    }

    function deliver_response($format, $api_response){

        // Define HTTP responses
        $http_response_code = array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found'
        );

        // Set HTTP Response
        header('HTTP/1.1 '.$api_response['status'].' '.$http_response_code[ $api_response['status'] ]);

        // Process different content types
        if( strcasecmp($format,'json') == 0 ){

            // Set HTTP Response Content Type
            header('Content-Type: application/json; charset=utf-8');

            // Format data into a JSON response
            $json_response = json_encode($api_response);

            // Deliver formatted data
            echo $json_response;

        }elseif( strcasecmp($format,'xml') == 0 ){

            // Set HTTP Response Content Type
            header('Content-Type: application/xml; charset=utf-8');

            $xml = new XMLWriter();
            $xml->openURI('php://output');
            $xml->startDocument('1.0','UTF-8');
            $xml->startElement("root");
            $xml->writeElement('code',$api_response['code']);
            $xml->writeElement('status',$api_response['status']);

            foreach($api_response['data'] as $key=>$value)
            {
                $xml->startElement("node");
                    $xml->startElement("patient");
                    foreach($value['Patient'] as $key1=>$value1)
                    {
                        $xml->writeElement($key1,$value1);
                    }
                    $xml->endElement();
                    //test
                    $xml->startElement("tests");
                    foreach($value['Test'] as $key1=>$value1)
                    {
                        $xml->startElement("test");
                        foreach($value1 as $key2=>$value2){
                            $xml->writeElement($key2,$value2);
                        }
                        $xml->endElement();
                    }
                    $xml->endElement();
                    //profile
                    $xml->startElement("profiles");
                    foreach($value['Profile'] as $key1=>$value1)
                    {
                        $xml->startElement("profile");
                        foreach($value1 as $key2=>$value2){
                            $xml->writeElement($key2,$value2);
                        }
                        $xml->endElement();
                    }
                    $xml->endElement();
                    //offer
                    $xml->startElement("offers");
                    foreach($value['Offer'] as $key1=>$value1)
                    {
                        $xml->startElement("offer");
                        foreach($value1 as $key2=>$value2){
                            $xml->writeElement($key2,$value2);
                        }
                        $xml->endElement();
                    }
                    $xml->endElement();
                    //package
                    $xml->startElement("packages");
                    foreach($value['Package'] as $key1=>$value1)
                    {
                        $xml->startElement("package");
                        foreach($value1 as $key2=>$value2){
                            $xml->writeElement($key2,$value2);
                        }
                        $xml->endElement();
                    }
                    $xml->endElement();
                $xml->endElement();
            }
            $xml->endElement();
            $xml->endDocument();


            // Deliver formatted data
            //echo $xml_response;

        }else{

            // Set HTTP Response Content Type (This is only good at handling string data, not arrays)
            header('Content-Type: text/html; charset=utf-8');

            // Deliver formatted data
            echo $api_response['data'];

        }

        // End script process
        exit;

    }
	
	function get_tiny_url($url)  {  
		$ch = curl_init();  
		$timeout = 5;  
		curl_setopt($ch,CURLOPT_URL,'https://tinyurl.com/api-create.php?url='.$url);  
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
		$data = curl_exec($ch);  
		curl_close($ch);  
		return $data;  
	}
	
	function _send_report_to_patient($id=null)
    { 				
        //echo "send report";
        if(isset($id) && !empty($id))
        {
			$this->writelog($id);
			$this->RequestTest = ClassRegistry::init('RequestTest');
			$this->RequestTest->updateAll(array('RequestTest.reporting_status'=>1),array('RequestTest.health_id'=>$id));
			
			$test_status = $this->Utility->get_test_completed_status($id);
			
            $this->Health = ClassRegistry::init('Health');
            $this->Health->bindModel(array('belongsTo'=>array(
                'Lab'=>array(
                    'className'=>'Lab',
                    'foreignKey'=>'created_by'
                )),
                'hasOne'=>array(
                    'Billing'=>array(
                    'className'=>'Billing',
                    'foreignKey'=>'request_id'
                )
            )));
            $req_info = $this->Health->find('first',array('conditions'=>array('Health.id'=>$id)));

            //if(isset($req_info['Lab']['pcc_email']) && !empty($req_info['Lab']['pcc_email']) && $req_info['Lab']['send_report_mail']==1)
			if(isset($req_info['Health']['email']) && !empty($req_info['Health']['email']))
            {
                //updating pdf
                if (strpos($req_info['Health']['patient_report'], 'http:') !== false || strpos($req_info['Health']['patient_report'], 'https:') !== false) { 
					file_put_contents("/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf",file_get_contents($req_info['Health']['patient_report']));
					$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf";
				}
				else{
					$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/".$req_info['Health']['patient_report'];			
				}
			
			/*if($this->Utility->check_whatsapp_enable_for_pcc($req_info['Health']['created_by'],$req_info['Health']['assigned_lab']) == 1)
			{
				$this->send_report_whatsapp($req_info['Health']['id']);
				$this->_activity_log($req_info['Health']['user_id'], $req_info['Health']['id'],"Report has been Whatsapp on '".$req_info['Health']['landline']."'");
			}*/
			
			//	App::import('Vendor', '/fpdf/fpdf');
			//App::import('Vendor', '/fpdf/fpdi');
			// echo "send report 3";
            $pdf = new FPDI();
            // echo "send report 1";
            $pdf->addPage();
            $pagecount = $pdf->setSourceFile($dec_rep_name);
							
			$lab_info_booked = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$req_info['Health']['created_by'])));
			//print_R(json_encode($lab_info_booked));die;
			$header_image='';
			
            if($lab_info_booked['Lab']['custom_header_status']=='1')
				$header_image = '/files/header/'.$lab_info_booked['Lab']['custom_header'];
			else
				$header_image = '/fpdf/nirAmaya_Report_Header.jpg';
			
			//rint_R(json_encode($header_image));		die;		
            for ($i=1; $i <= $pagecount; $i++) {
                    $tplidx = $pdf->ImportPage($i);
                    $pdf->useTemplate($tplidx,0,0,0);
                    $pdf->Image('/home2/niramovh/public_html/app/webroot'.$header_image,0,0,$pdf->w,30);
                    //$pdf->Image('/home/wwwdemoi/public_html/NH/app/webroot/fpdf/footer.jpg',10,273,196,6.5);
                    if($i != $pagecount)
                    {
                            $pdf->addPage();
                    }
            }
			
            $pdf->Output("/home2/niramovh/public_html/app/webroot/report_mail.pdf", "F");

             //echo "send report 2";
			if(!empty($req_info['Health']['patient_report_with_header']))
				$new_url = $this->get_tiny_url($req_info['Health']['patient_report_with_header']);
			/*start of sending email*/
            $mrn='';
            if(isset($req_info['Health']['medical_reference_number']))
			    $mrn = $req_info['Health']['medical_reference_number'];
			$email_stage = 'complete';
			$this->writelog("\n");
			$this->writelog($req_info['Health']['email']);
			$this->writelog("\n");
			$this->writelog(date("Y-m-d h:i:s"));
			$this->writelog("\n");
			$mail = new PHPMailer(); // create a new object
			//				print_R(json_encode($mail));die;
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465; // or 587
			$mail->IsHTML(true);
			$mail->setFrom('lab.reports@niramayapathlabs.com', 'NirAmaya PathLabs');
			$mail->AddAddress($req_info['Health']['email'], $req_info['Health']['name']);
			$mail->addCC($req_info['Lab']['pcc_email'], $req_info['Lab']['pcc_name']);
			
			$mail->Username = 'lab.reports@niramayapathlabs.com';
			$mail->Password = 'Lab@Reports';
							//print_R(json_encode($mail));die;
			$mail->Subject = "Complete Report of ".strtoupper($req_info['Health']['name']).' MRN-'.$mrn;
			$mail->addAttachment(WWW_ROOT . 'report_mail.pdf','report.pdf');
			$mail->Body = "<table width='600' border='0' cellspacing='0' cellpadding='0' align='left'>
								<tr>
									<td>
										Dear ".$req_info['Health']['name']."
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
									<td>
										Bill Date: ".date('d M Y',strtotime($req_info['Health']['s_date'])).' T'.date('H:i:s',strtotime($req_info['Health']['book_date']))."
									</td>
								</tr>
								<tr>
									<td>
										Bill Number: ";
										$mail->Body .= 'NPL'.!empty($req_info['Health']['ref_num'])?$req_info['Health']['ref_num'] : $req_info['Billing']['order_id'];
										$mail->Body .="
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
								<td>
									Completed Tests:
									<ul style='list-style:none; margin:0px; padding:0px;'>";
									 
										$pending_test_count = 0;
										foreach($test_status as $key=>$value)
										{
											if($value['reporting_status'] == 1)
											{
												$mail->Body .= "<li style='margin:0px;'>*".$value['test_name']."</li>";
											}
											else
											{
												$pending_test_count++;
											}
										}
									$mail->Body .="
									</ul>
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>";
									$mail->Body .= "Pending Tests: <br/>";
									if($pending_test_count == 0){
									$mail->Body .= "*No Pending Tests.";
									} else {
									$mail->Body .= "<ul style='list-style:none; margin:0px; padding:0px;'>";
									
										foreach($test_status as $key=>$value)
										{
											if($value['reporting_status'] == 0)
											{
												$mail->Body .= "<li style='margin:0px;'>*".$value['test_name']."</li>";
											}
										}
									
									$mail->Body .= "</ul>";
									 }
								$mail->Body .= "</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>";
							
							if(!empty($new_url))
							{
								$this->Billing = ClassRegistry::init('Billing');
								$get_req_number = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$req_info['Health']['id'])));
								
								$balance = $req_info['Health']['total_amount'] - $req_info['Health']['recieved_amount'];
								$payment_link = $this->get_tiny_url("https://www.niramayahealthcare.com/home/checkbalance/".base64_encode($req_info['Health']['id']));
								
								if($req_info['Health']['balance_amount'] <= 0)
								{
									$mail->Body .= "<tr>
									<td>
										You can view your report here - ".$new_url."
									</td>
								</tr>";
								}
								else
								{
									$mail->Body .= "<tr>
									<td>
										As your payment of Rs.".$balance." is still due. kindly pay it using following link - ".$payment_link." To view Your Reports.
									</td>
								</tr>";
								}
							}
							
							$mail->Body .= "<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							
							<tr>
								<td>
									Thank you for choosing NirAmaya PathLabs. 
									<br/>
									<br/>
									"; 
									if(!empty($req_info['Health']['partial_reason']) && $email_stage =='partial'){
										$mail->Body .= "Note:- ".$req_info['Health']['partial_reason'];
									}
									
									$mail->Body .= "<br/>
									Please do not reply to this message. Replies to this message are routed to an unmonitored mailbox.
									<br/>
									kindly write back to helpline@niramayapathlabs.com or You may also call us at +91-7042191851
									<br/><br/>
									Best Regards,
									<br/>
									Lab Director
									<br/>
									Niramaya Pathlabs
								</td>
							</tr>
						</table>
							";

			/*$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;*/
			$mail->isHTML(true);

			/*$mail->AltBody = "Email Test\r\nThis email was sent through the 
				Amazon SES SMTP interface using the PHPMailer class.";
			*/

			if(!$mail->send()) {
				if($req_info['Health']['created_by'] != '146' && $req_info['Health']['created_by'] != '153')
				{
					$this->writelog("Email Not Sent");
					$this->writelog("\n");
					$this->writelog("----------------------------------------------------------------------------------------------------");
					print_R("Email Not Sent");
				}
				$this->_activity_log($req_info['Health']['user_id'], $req_info['Health']['id'],"Error Sending Report");
			} else {
				if($req_info['Health']['created_by'] != '146' && $req_info['Health']['created_by'] != '153')
				{
					$this->writelog("Email Sent!");
					$this->writelog("\n");
					$this->writelog("----------------------------------------------------------------------------------------------------");
					print_R("Email Sent!");
				}
				$this->_activity_log($req_info['Health']['user_id'],$req_info['Health']['id'],"Report has been mailed on '".$req_info['Health']['email']."','".$req_info['Lab']['pcc_email']."'");
			}
			//die;
			/*end of sending mail*/
				
            }

        }

    }

    function _send_report_to_booked_pcc($id=null)
    { 				
        //echo "send report";
        if(isset($id) && !empty($id))
        {
			$this->writelog($id);
			$this->RequestTest = ClassRegistry::init('RequestTest');
			$this->RequestTest->updateAll(array('RequestTest.reporting_status'=>1),array('RequestTest.health_id'=>$id));
			
			$test_status = $this->Utility->get_test_completed_status($id);
			
            $this->Health = ClassRegistry::init('Health');
            $this->Health->bindModel(array('belongsTo'=>array(
                'Lab'=>array(
                    'className'=>'Lab',
                    'foreignKey'=>'created_by'
                )),
                'hasOne'=>array(
                    'Billing'=>array(
                    'className'=>'Billing',
                    'foreignKey'=>'request_id'
                )
            )));
            $req_info = $this->Health->find('first',array('conditions'=>array('Health.id'=>$id)));

            //if(isset($req_info['Lab']['pcc_email']) && !empty($req_info['Lab']['pcc_email']) && $req_info['Lab']['send_report_mail']==1)
			if(isset($req_info['Lab']['pcc_email']) && !empty($req_info['Lab']['pcc_email']))
            {
                //updating pdf
                if (strpos($req_info['Health']['patient_report'], 'http:') !== false || strpos($req_info['Health']['patient_report'], 'https:') !== false) { 
					file_put_contents("/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf",file_get_contents($req_info['Health']['patient_report']));
					$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf";
				}
				else{
					$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/".$req_info['Health']['patient_report'];			
				}
				
				/*if($this->Utility->check_whatsapp_enable_for_pcc($req_info['Health']['created_by'],$req_info['Health']['assigned_lab']) == 1)
				{
					$this->send_report_whatsapp($req_info['Health']['id']);
					$this->_activity_log($req_info['Health']['user_id'], $req_info['Health']['id'],"Report has been Whatsapp on '".$req_info['Health']['landline']."'");
				}*/
				
			//	App::import('Vendor', '/fpdf/fpdf');
			//App::import('Vendor', '/fpdf/fpdi');
			// echo "send report 3";
            $pdf = new FPDI();
            // echo "send report 1";
            $pdf->addPage();
            $pagecount = $pdf->setSourceFile($dec_rep_name);
							
			$lab_info_booked = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$req_info['Health']['created_by'])));
			//print_R(json_encode($lab_info_booked));die;
			$header_image='';
			
            if($lab_info_booked['Lab']['custom_header_status']=='1')
				$header_image = '/files/header/'.$lab_info_booked['Lab']['custom_header'];
			else
				$header_image = '/fpdf/nirAmaya_Report_Header.jpg';
			
			//rint_R(json_encode($header_image));		die;		
            for ($i=1; $i <= $pagecount; $i++) {
                    $tplidx = $pdf->ImportPage($i);
                    $pdf->useTemplate($tplidx,0,0,0);
                    $pdf->Image('/home2/niramovh/public_html/app/webroot'.$header_image,0,0,$pdf->w,30);
                    //$pdf->Image('/home/wwwdemoi/public_html/NH/app/webroot/fpdf/footer.jpg',10,273,196,6.5);
                    if($i != $pagecount)
                    {
                            $pdf->addPage();
                    }
            }
			
            $pdf->Output("/home2/niramovh/public_html/app/webroot/report_mail.pdf", "F");

             //echo "send report 2";
			if(!empty($req_info['Health']['patient_report_with_header']))
				$new_url = $this->get_tiny_url($req_info['Health']['patient_report_with_header']);
			/*start of sending email*/
            $mrn='';
            if(isset($req_info['Health']['medical_reference_number']))
			    $mrn = $req_info['Health']['medical_reference_number'];
			$email_stage = 'complete';
			$this->writelog("\n");
			$this->writelog($req_info['Lab']['pcc_email']);
			$this->writelog("\n");
			$this->writelog(date("Y-m-d h:i:s"));
			$this->writelog("\n");
			$mail = new PHPMailer(); // create a new object
			//				print_R(json_encode($mail));die;
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465; // or 587
			$mail->IsHTML(true);
			$mail->setFrom('lab.reports@niramayapathlabs.com', 'NirAmaya PathLabs');
			$mail->addAddress($req_info['Lab']['pcc_email'], $req_info['Lab']['pcc_name']);
			
			$mail->Username = 'lab.reports@niramayapathlabs.com';
			$mail->Password = 'Lab@Reports';
							//print_R(json_encode($mail));die;
			$mail->Subject = "Complete Report of ".strtoupper($req_info['Health']['name']).' MRN-'.$mrn;
			$mail->addAttachment(WWW_ROOT . 'report_mail.pdf','report.pdf');
			$mail->Body = "<table width='600' border='0' cellspacing='0' cellpadding='0' align='left'>
								<tr>
									<td>
										Dear ".$req_info['Lab']['pcc_name']."
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
									<td>
										Bill Date: ".date('d M Y',strtotime($req_info['Health']['s_date'])).' T'.date('H:i:s',strtotime($req_info['Health']['book_date']))."
									</td>
								</tr>
								<tr>
									<td>
										Bill Number: ";
										$mail->Body .= 'NPL'.!empty($req_info['Health']['ref_num'])?$req_info['Health']['ref_num'] : $req_info['Billing']['order_id'];
										$mail->Body .="
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
								<td>
									Completed Tests:
									<ul style='list-style:none; margin:0px; padding:0px;'>";
									 
										$pending_test_count = 0;
										foreach($test_status as $key=>$value)
										{
											if($value['reporting_status'] == 1)
											{
												$mail->Body .= "<li style='margin:0px;'>*".$value['test_name']."</li>";
											}
											else
											{
												$pending_test_count++;
											}
										}
									$mail->Body .="
									</ul>
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>";
									$mail->Body .= "Pending Tests: <br/>";
									if($pending_test_count == 0){
									$mail->Body .= "*No Pending Tests.";
									} else {
									$mail->Body .= "<ul style='list-style:none; margin:0px; padding:0px;'>";
									
										foreach($test_status as $key=>$value)
										{
											if($value['reporting_status'] == 0)
											{
												$mail->Body .= "<li style='margin:0px;'>*".$value['test_name']."</li>";
											}
										}
									
									$mail->Body .= "</ul>";
									 }
								$mail->Body .= "</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>";
							
							if(!empty($new_url))
							{
								$this->Billing = ClassRegistry::init('Billing');
								$get_req_number = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$req_info['Health']['id'])));
								
								$balance = $req_info['Health']['total_amount'] - $req_info['Health']['recieved_amount'];
								$payment_link = $this->get_tiny_url("https://www.niramayahealthcare.com/home/checkbalance/".base64_encode($req_info['Health']['id']));
								
								if($req_info['Health']['balance_amount'] <= 0)
								{
									$mail->Body .= "<tr>
									<td>
										You can view your report here - ".$new_url."
									</td>
								</tr>";
								}
								else
								{
									$mail->Body .= "<tr>
									<td>
										As your payment of Rs.".$balance." is still due. kindly pay it using following link - ".$payment_link." To view Your Reports.
									</td>
								</tr>";
								}
							}
							
							$mail->Body .= "<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							
							<tr>
								<td>
									Thank you for choosing NirAmaya PathLabs. 
									<br/>
									<br/>
									"; 
									if(!empty($req_info['Health']['partial_reason']) && $email_stage =='partial'){
										$mail->Body .= "Note:- ".$req_info['Health']['partial_reason'];
									}
									
									$mail->Body .= "<br/>
									Please do not reply to this message. Replies to this message are routed to an unmonitored mailbox.
									<br/>
									kindly write back to helpline@niramayapathlabs.com or You may also call us at +91-7042191851
									<br/><br/>
									Best Regards,
									<br/>
									Lab Director
									<br/>
									Niramaya Pathlabs
								</td>
							</tr>
						</table>
							";

			/*$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;*/
			$mail->isHTML(true);

			/*$mail->AltBody = "Email Test\r\nThis email was sent through the 
				Amazon SES SMTP interface using the PHPMailer class.";
			*/
			if(!$mail->send()) {
				$this->_json_data($value['Health']['id'],date('Y-m-d h:i:s'),"Full Report Mail executed",json_encode($data),$result);
				if($req_info['Health']['created_by'] != '146' && $req_info['Health']['created_by'] != '153')
				{
					$this->writelog("Email Not Sent");
					$this->writelog("\n");
					$this->writelog("----------------------------------------------------------------------------------------------------");
					print_R("Email Not Sent");
				}
				$this->_activity_log($health_detail['Health']['user_id'], $health_detail['Health']['id'],"Error Sending Report");
			} else {
				if($req_info['Health']['created_by'] != '146' && $req_info['Health']['created_by'] != '153')
				{
					$this->writelog("Email Sent!");
					$this->writelog("\n");
					$this->writelog("----------------------------------------------------------------------------------------------------");
					print_R("Email Sent!");
				}
				$this->_activity_log($req_info['Health']['user_id'],$req_info['Health']['id'],"Report has been mailed on '".$req_info['Lab']['pcc_email']."'");
			}
			//die;
			/*end of sending mail*/
				
            }

        }

    }

	public function sendsmstest()
    {

        $smsmessage='Dear '.'aa'.' '.'Ravindra'.' your test report is now available online. Visit www.NHcare.in (User Name: Regd Ph. No: & Password: Test Req. No.) or call 9555009009';

		$messageurl =  urlencode($smsmessage);

        $number="9818319425";

       //  $messageurl = "test";
      
            echo $_SERVER['REMOTE_ADDR'];
      // change by ravindra

		$url_sms='http://103.233.79.246//submitsms.jsp?user=nirAmaya&key=e2ceeba388XX&mobile='.$number.'&message='.$messageurl.'&senderid=NHCare&accusage=1';


      
      $ch_sms = curl_init();
      curl_setopt($ch_sms, CURLOPT_URL, $url_sms);
      curl_setopt($ch_sms, CURLOPT_FOLLOWLOCATION, TRUE);
      curl_setopt($ch_sms, CURLOPT_MAXREDIRS, 3);
      curl_setopt($ch_sms, CURLOPT_RETURNTRANSFER, TRUE);
      $data_sms = curl_exec($ch_sms);
      echo "<pre>"; print_r($data_sms); exit;
    }
	
    function writelog($content){
		$file = '/home2/niramovh/public_html/app/webroot/files/log/dailylog.txt';
		file_put_contents($file,$content, FILE_APPEND);
	}
	
	function deletetemp()
	{
		$folder = '/home2/niramovh/public_html/app/webroot/files/reports/temp';
 
		//Get a list of all of the file names in the folder.
		$files = glob($folder . '/*');
		 
		//Loop through the file list.
		foreach($files as $file){
			//Make sure that this is a file and not a directory.
			if(is_file($file)){
				//Use the unlink function to delete the file.
				print_R($file);
				echo "<br>";
				unlink($file);
			}
		}
		die;
	}
	
	function uploadReport()
	{
		//error_reporting(E_ALL);
		//ini_set("display_errors", 1);
		$this->Health = ClassRegistry::init("Health");

		$today_date = date('Y-m-d');
        $today_date = date('Y-m-d',(strtotime ( '-1 year' , strtotime ( $today_date) ) ));
		$lastyear = date('Y-1-1');
		$lastyear = date('Y-m-d',(strtotime ( '-1 year' , strtotime ( $lastyear) ) ));
		$orders = $this->Health->query("SELECT *
                        FROM healths
                        WHERE s_date <= '".$today_date."' 
                        AND s_date >= '".$lastyear."'
                        AND patient_report !=''
                        ORDER BY `healths`.`id` ASC limit 100");
		print_R($orders);
		$ftp_server = "npl.infosysmicro.com";
		$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
		$login = ftp_login($ftp_conn, 'niramya', 'abc123!@');
		foreach($orders as $val)
		{
			echo $local_file = "/home2/niramovh/public_html/app/webroot/files/reports/".$val['healths']['patient_report'];
		
			$server_file = "/files/reports/".$val['healths']['patient_report'];

			if(!ftp_put($ftp_conn,$server_file,$local_file,FTP_BINARY))
			{
				echo "not copied";
			}
			else{
				echo "copied";
				unlink($local_file);
			}
			echo "<br>";
		}
		ftp_close($ftp_conn);die;
	}
	
	function check()
	{
		//$ch = curl_init("http://182.73.179.75:99");    // initialize curl handle
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		//$data = curl_exec($ch);
		print(phpinfo()); die;
	}
	
	function _json_data($healthid,$date,$action,$request,$response)
	{
		$this->JsonData = ClassRegistry::init("JsonData");
		$this->data['JsonData']['health_id'] = $healthid;
		$this->data['JsonData']['date'] = $date;
		$this->data['JsonData']['action'] = $action;
		$this->data['JsonData']['request_data']= $request;
		$this->data['JsonData']['response_data']= $response;
		//print_R($this->data);
		if($this->JsonData->create($this->data))
		{
			$this->JsonData->save($this->data);
		}
	}
	
	function database_backup($tables = '*')
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		//connect & select the database
		$db = new mysqli('localhost', 'niramovh_live', 'niramaya@123','niramovh_live'); 

		//get all of the tables
		if($tables == '*'){
			$tables = array();
			$result = $db->query("SHOW TABLES");
			while($row = $result->fetch_row()){
				$tables[] = $row[0];
			}
		}else{
			$tables = is_array($tables)?$tables:explode(',',$tables);
		}
$return = "";
		//loop through the tables
		foreach($tables as $table){
			print_R($table);
			$result = $db->query("SELECT * FROM $table");
			$numColumns = $result->field_count;

			$return .= "DROP TABLE $table;";
			
			$result2 = $db->query("SHOW CREATE TABLE $table");
			$row2 = $result2->fetch_row();

			$return .= "\n\n".$row2[1].";\n\n";

			for($i = 0; $i < $numColumns; $i++){
				while($row = $result->fetch_row()){
					$return .= "INSERT INTO $table VALUES(";
					for($j=0; $j < $numColumns; $j++){
						$row[$j] = addslashes($row[$j]);
						$row[$j] = preg_replace("/\n/","\\n",$row[$j]);
						if (isset($row[$j])) { $return .= '"'.$row[$j].'"' ; } else { $return .= '""'; }
						if ($j < ($numColumns-1)) { $return.= ','; }
					}
					$return .= ");\n";
				}
			}

			$return .= "\n\n\n";
			//print_R($return);die;
			echo "<br>";
		}
		
		//save file
		$handle = fopen('/home2/niramovh/public_html/db-backup-'.time().'.sql','w+');
		fwrite($handle,$return);
		fclose($handle);
	}
	
	function send_message()
	{
		$this->Health = ClassRegistry::init('Health');
		$req_info = $this->Health->find('all',array('conditions'=>array('Health.created_by'=>'144','Health.requ_status'=>'6','Health.s_date >='=>'2019-06-01')));
		
		//print_R($req_info);die;
		foreach($req_info as $val)
		{
			if($val['Health']['gender'] == 1)
			{
				$title = 'Mr.';
			}

			if($val['Health']['gender'] == 2)
			{
				$title = 'Ms.';
			}
			$number = $val['Health']['landline'];
			$message = 'Dear '.$title.' '.strtoupper($val['Health']['name']).' your test report is now available online. Visit www.NHcare.in (User Name: Regd Ph. No: & Password: Test Req. No.) or call 9555009009';
			print_R($message);
			echo "<br><br>";
			$this->__sms_message($number,$message);
		} die;
	}
	
	function droplet_api()
	{
		//print_R('hello');die;
		$this->Health = ClassRegistry::init("Health");
		$today_date = date('Y-m-d');
        
        $health_orders = $this->Health->query("SELECT *
			FROM healths
			WHERE s_date >= '".$today_date."' 
			AND requ_status in ('0','15','13','18')
			ORDER BY `healths`.`id` ASC
			LIMIT 0 , 50");
			/* "SELECT *
			FROM healths
			WHERE s_date >= '".$today_date."' 
			AND requ_status in ('0','15','13')
			ORDER BY `healths`.`id` ASC
			LIMIT 0 , 30" */
		$this->Lab = ClassRegistry::init("Lab");
		//print_R($health_orders);die;
		foreach($health_orders as $key)
		{
			$lab_data = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$key['healths']['created_by'])));
			
			if($key['healths']['assigned_lab'] == 'Home' && $lab_data['Lab']['auto_assign_phlebo']==1)
			{
				print_R($key['healths']['assigned_lab']);
				echo "-------------";
				print_R($key['healths']['id']);
				echo "------------------";
				print_R($lab_data['Lab']['pcc_name']);
				echo "-------------triggered droplet API------------------";
				$check = $this->Utility->dropletapi($key['healths']['id'],$lab_data['Lab']['pcc_name'],"cron");
				echo "<br><br>";
			}
			
			if(in_array($key['healths']['assigned_lab'],array('121')))
			{
				print_R($key['healths']['assigned_lab']);
				echo "-------------";
				print_R($key['healths']['id']);
				echo "------------------";
				print_R($lab_data['Lab']['pcc_name']);
				echo "-------------triggered droplet API------------------";
				
				$check = $this->Utility->dropletapi($key['healths']['id'],$lab_data['Lab']['pcc_name'],"cron");
				echo "<br><br>";
			}
			
		}
		die;
	}
	
	function test_observation()
	{
		$this->Test = ClassRegistry::init('Test');
		$test = $this->Test->query("select * from tests where type='TEST' and observation_id=''");
		foreach($test as $val)
		{
			print_R($val);
			$this->Observation = ClassRegistry::init('Observation');
			$observation = $this->Observation->find('first',array('conditions'=>array('Observation.observation_name'=>$val['tests']['test_parameter'])));
			
			if(empty($observation))
			{
				$this->data['Observation']['observation_name'] = $val['tests']['test_parameter'];
				$this->data['Observation']['method'] = $val['tests']['methodology'];
				$this->data['Observation']['machine'] = "AU480";
				$this->data['Observation']['gender'] = "B";
				$this->data['Observation']['os_inhouse'] = "NPL";  
				$this->data['Observation']['department'] = "Biochemistry";  
				$this->data['Observation']['nabl'] = "";  
				$this->data['Observation']['active'] = 1;  
				$this->data['Observation']['sample_type'] = $val['tests']['sample'];  
				
				print_R($this->data);
				$this->Observation->create();
				$this->Observation->save($this->data);
				
				$observation_id = $this->Observation->getLastInsertId();
				
				$this->Test->query("update tests set observation_id='".$observation_id."' where id='".$val['tests']['id']."'");
			}
			echo "<br>";
		}
		die;
	}
	
	function get_reports()
	{
		$this->Health = ClassRegistry::init("Health");
		$this->Billing = ClassRegistry::init('Billing');
				        
        $health_orders = $this->Health->query("SELECT *
			FROM healths
			WHERE s_date = '2019-07-28'
			and created_by = 143
			");
			
		foreach($health_orders as $val)
		{
//			print_R($val['healths']['patient_report_with_header']);
//			echo "<br>";
			if(!empty($val['healths']['patient_report_with_header']))
			{
				$billingDetails = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$val['healths']['id'])));
				file_put_contents("/home2/niramovh/public_html/app/webroot/files/reports/visit_camp/".$billingDetails['Billing']['order_id'].".pdf",file_get_contents($val['healths']['patient_report_with_header']));
			}
		}
		die;
	}
	
	function __searchForId($id, $array) {
		//echo $id."<br>";
		//echo "<pre>"; print_r($array); exit;
	   foreach ($array as $key => $val) {
	   	if($id != 'P159' && $id != 'P160' && $id != 'P161')
		{
		   if ($val['Cart']['test_code'] === $id) {
			   return 'Yes';
		   }
		  }
	   }
	   return null;
	}
	
	public function book_estimate($req_id=null)
	{
		$estimate = base64_decode($req_id);
		
		$this->Test = ClassRegistry::init('Test');
		$this->PrescriptionMaster = ClassRegistry::init('PrescriptionMaster');
		$prescription = $this->PrescriptionMaster->find('first',array('conditions'=>array('PrescriptionMaster.id'=>$estimate)));
		//$this->Session->delete('book_mess');
		$count_test = 0;
	//	print_R($prescription);  
		$testdata = explode(',',$prescription['PrescriptionMaster']['tests']);
		//	print_R($testdata);  
		foreach($testdata as $key)
		{
			//print_R($key);
			$this->Session->write('prescription',$prescription);
			$find_test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$key)));
			$id = $this->__searchForId($find_test_detail['Test']['testcode'], $this->Session->read('session_test'));
			if(empty($id))
			{
				$this->Session->write('session_test.'.$count_test.'.Cart.test_id',$find_test_detail['Test']['id']);
				$this->Session->write('session_test.'.$count_test.'.Cart.test_code',$find_test_detail['Test']['testcode']);
				$this->Session->write('session_test.'.$count_test.'.Cart.test_parameter',$find_test_detail['Test']['test_parameter']);
				$this->Session->write('session_test.'.$count_test.'.Cart.test_reporting',$find_test_detail['Test']['reporting']);
				$this->Session->write('session_test.'.$count_test.'.Cart.test_mrp',$find_test_detail['Test']['mrp']);
				$this->Session->write('session_test.'.$count_test.'.Cart.test_type',$find_test_detail['Test']['type']);
			}
			$count_test++;
		}
		//print_R('hello');
		$this->redirect('/tests/my_cart');
		
	}
	
	public function push_tests_plab()
	{
		$this->Test = ClassRegistry::init('Test');
		$this->PlabTests = ClassRegistry::init('PlabTests');
		$all_test = $this->Test->find('all',array('conditions'=>array('Test.assigned_lab'=>'1')));
		foreach($all_test as $val)
		{
			$this->data = $this->PlabTests->create();
			$this->data['PlabTests']['lab_id'] = '1';
			$this->data['PlabTests']['test_id'] = $val['Test']['id'];
			$this->data['PlabTests']['mrp'] = $val['Test']['mrp'];
			$this->data['PlabTests']['net_rate'] = $val['Test']['mrp'];
			$this->data['PlabTests']['tescode'] = $val['Test']['testcode'];
			$this->data['PlabTests']['tat'] = $val['Test']['tat'];
			
			$this->PlabTests->save($this->data);
		}
		print_R($all_test);die;
	}
	
	public function generate_runner_request()
	{
		$this->RunnerRequest = ClassRegistry::init("RunnerRequest");
		$this->RunnerService = ClassRegistry::init("RunnerService");
		$this->Zone = ClassRegistry::init("Zone");
		$runner_service = $this->RunnerService->find('all');
		$date = date('Y-m-d');
		$new_date = date('Y-m-d', strtotime($date. ' +1 days'));
		$counter =0;
		//print_R($runner_service);die;
		foreach($runner_service as $val)
		{
			if(strtotime($val['RunnerService']['to_date']) >= strtotime($new_date))
			{
				$counter++;
				
				$working_day = explode(',',$val['RunnerService']['working_day']);
				if(in_array(date('w',strtotime($new_date)),$working_day))
				{
					$agent_id = 0;
					if($val['RunnerService']['time_slot'] < 15)
					{
						$zone_check = $this->Zone->query("select * from zone as z inner join zone_loc as zc on z.id=zc.zone_id where zc.location_id='".$val['RunnerService']['pick_loc_id']."' and z.time_of_day='morning'");
						
						$agent_id = $zone_check['0']['z']['runner_id'];
					}
					else
					{
						$zone_check = $this->Zone->query("select * from zone as z inner join zone_loc as zc on z.id=zc.zone_id where zc.location_id='".$val['RunnerService']['pick_loc_id']."' and z.time_of_day='evening'");	
						
						$agent_id = $zone_check['0']['z']['runner_id'];
					}

					$this->data = $this->RunnerRequest->create();
					$this->data['RunnerRequest'] = $val['RunnerService'];
					unset($this->data['RunnerRequest']['id']);
					unset($this->data['RunnerRequest']['to_date']);
					unset($this->data['RunnerRequest']['from_date']);
					
					$req_id = strtotime(date('Y-m-d h:i:s')) + $counter;
					
					$this->data['RunnerRequest']['runner_request_id'] = 'R-'.$req_id;
					$this->data['RunnerRequest']['date'] = $new_date;
					$this->data['RunnerRequest']['agent_id'] = $agent_id;
					if(empty($val['RunnerService']['drop_loc_id']))
						$this->data['RunnerRequest']['status'] = '10';
					else
						$this->data['RunnerRequest']['status'] = '11';
					
					if($this->RunnerRequest->save($this->data))
					{
						$last_runner_request_id = $this->RunnerRequest->getLastInsertId();
						$this->runnerlog("Success");
						$this->runnerlog("\n");
						$this->runnerlog("Runner Service Id - ".$val['RunnerService']['id']);
						$this->runnerlog("\n");
						$this->runnerlog("Runner Request Id - ".$last_runner_request_id);
						$this->runnerlog("\n");
						$this->runnerlog("Request for - ".$new_date);
						$this->runnerlog("\n");
						$this->runnerlog("----------------------------------------------------------------------------------------------------");
					}
					else
					{
						$last_runner_request_id = $this->RunnerRequest->getLastInsertId();
						$this->runnerlog("Failed");
						$this->runnerlog("\n");
						$this->runnerlog("Runner Service Id - ".$val['RunnerService']['id']);
						$this->runnerlog("\n");
						$this->runnerlog("----------------------------------------------------------------------------------------------------");
					}
				}
				echo "<br>";
			}
		}
		die;
	}
	
	function runnerlog($content){
		$file = '/home2/niramovh/public_html/app/webroot/files/log/runnerdaily.txt';
		file_put_contents($file,$content, FILE_APPEND);
	}
	
	public function runner_schedule()
	{
		$this->RunnerRequest = ClassRegistry::init("RunnerRequest");
		
		$date = date('Y-m-d');
		$new_date = date('Y-m-d', strtotime($date. ' + 0 days'));
		//print_R($new_date);
		$runnerdata = $this->RunnerRequest->query('select distinct(agent_id) from runner_request where date = "'.$new_date.'"');
		print_R('select distinct(agent_id) from runner_request where date = "'.$new_date.'"');
		print_R($runnerdata); //die;
		foreach($runnerdata as $val)
		{
			$this->Agent = ClassRegistry::init('Agent');
			$agentdata = $this->Agent->find('first',array('conditions'=>array('Agent.id'=>$val['runner_request']['agent_id'])));
			
			$runner_link = $this->get_tiny_url("https://www.niramayahealthcare.com/pages/runner_schedule/".base64_encode($val['runner_request']['agent_id'])."/".base64_encode($new_date));

			$this->RunnerRequest->query('update runner_request set runner_schedule_url="'.$runner_link.'" where date = "'.$new_date.'" and agent_id="'.$val['runner_request']['agent_id'].'"');

			$messagebody = "Your Schedule for ".$new_date." can be viewed on ".$runner_link."";
			echo "<br>";
			print_R($messagebody);
			echo "<br>";
			print_R($agentdata);
			$this->__sms_message($agentdata['Agent']['contact'],$messagebody);
			echo "<br>";
		}
		die;
	}
	
	public function profile_check()
	{
		$this->Test = ClassRegistry::init('Test');
		
		$tests = $this->Test->find('all',array('conditions'=>array('Test.type'=>'PROFILE')));
		
		$count=0;
		
		foreach($tests as $val)
		{
			//print_R($val['Test']['testcode']."-------------");
			$testcodes = explode(',',$val['Test']['testscode']);
			//print_R($testcodes);
			foreach($testcodes as $val1)
			{
				//print_R($val1);
				$check_test = $this->Test->find('all',array('conditions'=>array('Test.id'=>$val1)));
				if(!$check_test)
				{
					print_R($val1);
					echo "<br> Not Exist<br><br>";
					echo "<br>----------------------------------------------------------<br>";
				}
			}
			
			$count++;
		}
		echo $count;
		die;
	}
	
	function sendmailtopcc()
	{
		//print_R($_POST);die;
		$this->Health = ClassRegistry::init('Health');
		
		$healthdata = $this->Health->find('all',array('conditions'=>array('Health.id >'=>'322329','Health.created_by'=>'11122','Health.s_date >'=>date('2019-10-22'),'Health.requ_status'=>'6'),'order'=>array('Health.id ASC')));
		foreach($healthdata as $val)
		{
			//print_R($val);
			echo "<br>";

			$this->RequestTest = ClassRegistry::init('RequestTest');
			$this->RequestTest->updateAll(array('RequestTest.reporting_status'=>1),array('RequestTest.health_id'=>$val['Health']['id']));
			
			$test_status = $this->Utility->get_test_completed_status($val['Health']['id']);
			
			
			$this->Health->bindModel(array('belongsTo'=>array(
				'Lab'=>array(
					'className'=>'Lab',
					'foreignKey'=>'created_by'
				)),
				'hasOne'=>array(
					'Billing'=>array(
					'className'=>'Billing',
					'foreignKey'=>'request_id'
				)
			)));
			
			$req_info = $this->Health->find('first',array('conditions'=>array('Health.id'=>$val['Health']['id'])));
			$lab_info_booked = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$req_info['Health']['created_by'])));
			//print_R($req_info);die;	
			$header_image='';
			if($lab_info_booked['Lab']['custom_header_status']=='1')
				$header_image = '/files/header/'.$lab_info_booked['Lab']['custom_header'];
			else
				$header_image = '/fpdf/nirAmaya_Report_Header.jpg';
			
			print_R("patient email -------------".$req_info['Health']['email']);
			print_R($req_info['Health']['patient_report']."--------");
			print_R($req_info['Health']['id']."--------");
			echo "<br>";
			
			if(isset($req_info['Health']['email']) && !empty($req_info['Health']['email']))
			{
				
				if (strpos($req_info['Health']['patient_report'], 'http:') !== false || strpos($req_info['Health']['patient_report'], 'https:') !== false) { 
					file_put_contents("/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf",file_get_contents($req_info['Health']['patient_report']));
					$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf";
				}
				else{
					$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/".$req_info['Health']['patient_report'];			
				}
//				App::import('Vendor', '/fpdf/fpdf');
//				App::import('Vendor', '/fpdf/fpdi');
				$pdf = new FPDI();
				$pdf->addPage();
				$pagecount = $pdf->setSourceFile($dec_rep_name);

				for ($i=1; $i <= $pagecount; $i++) {
						$tplidx = $pdf->ImportPage($i);
						$pdf->useTemplate($tplidx,0,0,0);
						$pdf->Image('/home2/niramovh/public_html/app/webroot'.$header_image,0,0,$pdf->w,30);

						if($i != $pagecount)
						{
								$pdf->addPage();
						}
				}
				
				$pdf->Image('/home2/niramovh/public_html/app/webroot/fpdf/nirAmaya_Report_Back.jpg', 0, 0, $pdf->w, $pdf->h);

				$pdf->Output("/home2/niramovh/public_html/app/webroot/report_mail.pdf", "F");

				
				
			/*start of sending email*/
			$mrn='';
			if(isset($req_info['Health']['medical_reference_number']))
				$mrn = $req_info['Health']['medical_reference_number'];
			$email_stage = 'complete';
			//print_R($req_info);die;
			$mail = new PHPMailer(); // create a new object
							//print_R($mail);die;
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465; // or 587
			$mail->IsHTML(true);
			$mail->setFrom('lab.reports@niramayapathlabs.com', 'NirAmaya PathLabs');
			$mail->addAddress($req_info['Lab']['pcc_email'], $req_info['Lab']['pcc_name']);
			$mail->Username = 'lab.reports@niramayapathlabs.com';
			$mail->Password = 'Lab@Reports';
							//print_R(json_encode($mail));die;
			$mail->Subject = "Complete Report of ".strtoupper($req_info['Health']['name']).' MRN-'.$mrn;
			$mail->addAttachment(WWW_ROOT . 'report_mail.pdf','report.pdf');
			$mail->Body = "<table width='600' border='0' cellspacing='0' cellpadding='0' align='left'>
								<tr>
									<td>
										Dear ".$req_info['Lab']['pcc_name']."
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
									<td>
										Bill Date: ".date('d M Y',strtotime($req_info['Health']['s_date'])).' T'.date('H:i:s',strtotime($req_info['Health']['book_date']))."
									</td>
								</tr>
								<tr>
									<td>
										Bill Number: ";
										$mail->Body .= 'NPL'.!empty($req_info['Health']['ref_num'])?$req_info['Health']['ref_num'] : $req_info['Billing']['order_id'];
										$mail->Body .="
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
								<td>
									Completed Tests:
									<ul style='list-style:none; margin:0px; padding:0px;'>";
									 
										$pending_test_count = 0;
										foreach($test_status as $key=>$value)
										{
											if($value['reporting_status'] == 1)
											{
												$mail->Body .= "<li style='margin:0px;'>*".$value['test_name']."</li>";
											}
											else
											{
												$pending_test_count++;
											}
										}
									$mail->Body .="
									</ul>
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>";
									$mail->Body .= "Pending Tests: <br/>";
									if($pending_test_count == 0){
									$mail->Body .= "*No Pending Tests.";
									} else {
									$mail->Body .= "<ul style='list-style:none; margin:0px; padding:0px;'>";
									
										foreach($test_status as $key=>$value)
										{
											if($value['reporting_status'] == 0)
											{
												$mail->Body .= "<li style='margin:0px;'>*".$value['test_name']."</li>";
											}
										}
									
									$mail->Body .= "</ul>";
									 }
								$mail->Body .= "</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							
							<tr>
								<td>
									Thank you for choosing NirAmaya PathLabs. 
									<br/>
									<br/>
									"; 
									if(!empty($req_info['Health']['partial_reason']) && $email_stage =='partial'){
										$mail->Body .= "Note:- ".$req_info['Health']['partial_reason'];
									}
									
									$mail->Body .= "<br/>
									Please do not reply to this message. Replies to this message are routed to an unmonitored mailbox.
									<br/>
									kindly write back to helpline@niramayapathlabs.com or You may also call us at +91-7042191851
									<br/><br/>
									Best Regards,
									<br/>
									Lab Director
									<br/>
									Niramaya Pathlabs
								</td>
							</tr>
						</table>
							";

			/*$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;*/
			$mail->isHTML(true);
			print_R($mail->send());
			//$mail->send()				
			}
			else
			{
				echo "mail id not available <br>";
			}
			
		}
		die;
	}
	
	public function check_message()
	{
		$this->Health = ClassRegistry::init("Health");
		$healthdata = $this->Health->find('first',array('conditions'=>array('Health.reference'=>'188903-1572526007')));
		$message = 'Your test report for Test Req. No: ('.$get_req_number['Billing']['order_id'].') is published. For any Assistance call +91-9555009009 OR Visit www.NHcare.in';

		if($this->Utility->check_sms_enable_for_pcc($healthdata['Health']['created_by'],$healthdata['Health']['assigned_lab']) == 1)
		{
			$this->__sms_message('8826822855',$message);
		}		
		else
			echo "error";
		
		die;
	}
	
	public function check_auto_report()
	{
		$this->Health = ClassRegistry::init('Health');
		$req_info = $this->Health->find('first',array('conditions'=>array('Health.id'=>'281821')));
		$this->Lab = ClassRegistry::init('Lab');
		$lab_info = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$req_info['Health']['assigned_lab'])));
		$new_url = $this->get_tiny_url($req_info['Health']['patient_report_with_header']);
		$number = $req_info['Health']['landline'];
		if($req_info['Health']['gender'] == 1)
		{
			$title = 'Mr.';
		}

		if($req_info['Health']['gender'] == 2)
		{
			$title = 'Ms.';
		}
		
		$this->Billing = ClassRegistry::init('Billing');
		$get_req_number = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$req_info['Health']['id']))); //Report URL : '.$new_url.'.
		
		$balance = $req_info['Health']['total_amount'] - $req_info['Health']['recieved_amount'];
		
		$payment_link = $this->get_tiny_url("https://www.niramayahealthcare.com/home/checkbalance/".base64_encode($req_info['Health']['id']));
		
		// "https://www.niramayahealthcare.com/payment_paytm/process_payment/".base64_encode($balance)."/".base64_encode($get_req_number['Billing']['order_id'])
		$this->Lab = ClassRegistry::init('Lab');
			
		$lab_book = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$req_info['Health']['created_by'])));
		
		$message = 'Your test report for Test Req. No: ('.$get_req_number['Billing']['order_id'].') for Booked By '.$lab_book['Lab']['pcc_name'].' is published.';
		$message .= "\n";
		if($balance < 0)
			$message .= 'Report URL : '.$new_url." \n";
		else
			$message .= 'As your payment of Rs.'.$balance.' is still due. kindly pay it using following link - '.$payment_link." \n ";
		
		$message .= 'For any Assistance call +91-9555009009 OR Visit www.NHcare.in';
		
		//print_R($message);
		
		if($this->Utility->check_sms_enable_for_pcc($req_info['Health']['created_by'],$req_info['Health']['assigned_lab']) == 1)
		{
			$this->__sms_message('8826822855',$message);
		}
		die;
	}
	
	public function checkbalance($id)
	{
		$h_id = base64_decode($id);
		$this->Health = ClassRegistry::init('Health');
		$this->User = ClassRegistry::init('User');

		$req_info = $this->Health->find('first',array('conditions'=>array('Health.id'=>$h_id)));

		$find_user = $this->User->find('first',array('conditions'=>array('User.id'=>$req_info['Health']['user_id'])));
				
		$this->Session->write('UserDetail',$find_user);
		
		$this->Billing = ClassRegistry::init('Billing');
		$get_req_number = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$req_info['Health']['id'])));
		
		$balance = $req_info['Health']['total_amount'] - $req_info['Health']['received_amount'];
		//print_R($balance);die;
		if($balance < 1)
		{
			//echo $req_info['Health']['patient_report_with_header'];
			header("Location: ".$req_info['Health']['patient_report_with_header']);
		}
		else
		{
			//echo "https://www.niramayahealthcare.com/payment_paytm/process_payment/".base64_encode($balance)."/".base64_encode($get_req_number['Billing']['order_id']);
			header("Location: https://www.niramayahealthcare.com/payment_paytm/process_payment/".base64_encode($balance)."/".base64_encode($req_info['Health']['id'])."/".base64_encode($get_req_number['Billing']['order_id']));
		}
			
		die;
		//print_R(base64_decode($id));die;
	}
	
	public function send_report_whatsapp($id)
	{
		$this->Health = ClassRegistry::init('Health');
		$req_info = $this->Health->find('first',array('conditions'=>array('Health.id'=>$id)));
		
		$number = $req_info['Health']['landline'];
		
		$dec_rep_name = "";
		
		if (strpos($req_info['Health']['patient_report_with_header'], 'http:') !== false) { 
			file_put_contents("/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf",file_get_contents($req_info['Health']['patient_report_with_header']));
			$dec_rep_name = "https://www.niramayahealthcare.com/files/reports/temp/".$req_info['Health']['ref_num'].".pdf";
		}
		else{
			$dec_rep_name = "https://www.niramayahealthcare.com/files/reports/".$req_info['Health']['patient_report_with_header'];			
		}
		
		$balance = $req_info['Health']['total_amount'] - $req_info['Health']['received_amount'];
		//print_R($req_info['Health']['total_amount'] - $req_info['Health']['received_amount']);die;

		if($balance <= 0)
		{
			$ch = curl_init();
			$curlConfig = array(
				CURLOPT_URL => "https://www.wtsapi.com/api/sendQuickMsg?token=ef6e126a849b23e7257f12593c076b3c66b602fe30b26c61af&phone=91".$number."&type=pdf&link=".$dec_rep_name,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_HTTPHEADER => array(
					"content-type: application/json",
					"cache-control: no-cache"
				),
			);
			 curl_setopt_array($ch, $curlConfig);
			$result = curl_exec($ch);

			$file = '/home2/niramovh/public_html/app/webroot/files/log/whatsapp_report.txt';
			file_put_contents($file,$req_info['Health']['ref_num']."\n", FILE_APPEND);
			file_put_contents($file,$result."\n", FILE_APPEND);
			file_put_contents($file,"\n\n", FILE_APPEND);
			
			curl_close($ch);
			//$balance
		}
	}
	
	public function send_message_whatsapp($number,$message)
	{	
		$ch = curl_init();
		$curlConfig = array(
			CURLOPT_URL => "https://www.wtsapi.com/api/sendQuickMsg?token=ef6e126a849b23e7257f12593c076b3c66b602fe30b26c61af&phone=91".$number."&type=text&message=".urlencode($message),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_USERAGENT => 'wtsapi',
		);
		 curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		
	}
	
	public function dummy_send_message_whatsapp($number,$message)
	{
		$this->Health = ClassRegistry::init('Health');
		$req_info = $this->Health->find('first',array('conditions'=>array('Health.id'=>'236342')));
		
		$number = $req_info['Health']['landline'];
		
		$new_url = $this->get_tiny_url($req_info['Health']['patient_report_with_header']);
		
		$this->Billing = ClassRegistry::init('Billing');
		$get_req_number = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$req_info['Health']['id']))); //Report URL : '.$new_url.'.
		
		$payment_link = $this->get_tiny_url("https://www.niramayahealthcare.com/home/checkbalance/".base64_encode($req_info['Health']['id']));
		
		$message = 'Your test report for Test Request No '.$get_req_number['Billing']['order_id'].' is published.';

		$balance = $req_info['Health']['total_amount'] - $req_info['Health']['received_amount'];
		//print_R($req_info['Health']['total_amount'] - $req_info['Health']['received_amount']);die;

		if($balance <= 0) //$balance
			$message .= 'Report URL '.$new_url.'';
		else
			$message .= 'As your payment of Rs.'.$balance.' is still due. kindly pay it using following link - '.$payment_link.' for viewing Your Reports. ';		
		
		$ch = curl_init();
		$curlConfig = array(
			CURLOPT_URL => "https://www.wtsapi.com/api/sendQuickMsg?token=ef6e126a849b23e7257f12593c076b3c66b602fe30b26c61af&phone=91".$number."&type=text&message=".urlencode($message),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_USERAGENT => 'wtsapi',
		);
		 curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		
	}
	
	public function exceldownload()
	{
		//print_R('Hello');die;
		$this->Health = ClassRegistry::init('Health');
		//$conditions = "";
		$find_request = $this->Health->find('all');
		print_R($find_request);die;
		$reports = array();

		$k = 0;

		$s_no = 1;

		foreach($find_request as $sl_ky => $sl_vl)

		{

			$parameter_count = 0;

			$count_expl_test = 0;

			$count_expl_profile = 0;

			$count_expl_offer = 0;

			$count_expl_package= 0;

			

			$pcc_name = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$sl_vl['Health']['assigned_lab'])));
								$pcc_name1 = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$sl_vl['Health']['created_by'])));

			$agent_name = $this->Agent->find('first',array('conditions'=>array('Agent.id'=>$sl_vl['Health']['agent_id'])));

			$requestNum = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$sl_vl['Health']['id'])));

			$test_amt = 0;

			$test_code_arr = array();

			$test_name_arr = array();

			if(!empty($sl_vl['Health']['test_id']))

			{

				$expl_test = explode(',',$sl_vl['Health']['test_id']);

				$cnt_test = 0; 

				foreach($expl_test as $test_key => $test_val)

				{

					if(!empty($test_val))

					{

						$cnt_test++;

					}

					$test_code = $this->Test->find('first',array('conditions'=>array('Test.id'=>$test_val)));

					$test_code_arr[] = $test_code['Test']['testcode'];

					$test_name_arr[] = $test_code['Test']['test_parameter'];

					$test_amt = ($test_code['Test']['mrp']+$test_amt);

				}

				$count_expl_test = $cnt_test;

			}

								if(!empty($sl_vl['Health']['profile_id']))

			{

				$expl_test = explode(',',$sl_vl['Health']['profile_id']);

				$cnt_test = 0; 

				foreach($expl_test as $test_key => $test_val)

				{

					if(!empty($test_val))

					{

						$cnt_test++;

					}

					$test_code = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$sl_vl['Health']['id'],'RequestTest.test_id'=>$test_val)));

					$test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$test_val)));

					$test_code_arr[] = $test_detail['Test']['testcode'];

					$test_name_arr[] = $test_detail['Test']['test_parameter'];

					$test_amt = ($test_code['RequestTest']['mrp']+$test_amt);

				}

				$count_expl_test = $cnt_test;

			}

			if(!empty($sl_vl['Health']['offer_id']))

			{

				$expl_offer = explode(',',$sl_vl['Health']['offer_id']);

				$cnt_offr = 0;

				foreach($expl_offer as $offer_key => $offer_val)

				{

					if(!empty($offer_val))

					{

						$cnt_offr++;

					}

					$offer_code = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$offer_val)));

					$test_code_arr[] = $offer_code['Banner']['banner_code'];

					$test_name_arr[] = $offer_code['Banner']['banner_name'];

					$test_amt = ($offer_code['Banner']['banner_mrp']+$test_amt);

				}

				$count_expl_offer = count($cnt_offr);

			}

			

			if(!empty($sl_vl['Health']['package_id']))

			{

				$expl_package = explode(',',$sl_vl['Health']['package_id']);

				$cnt_pck = 0;

				foreach($expl_package as $package_key => $package_val)

				{

					if(!empty($package_val))

					{

						$cnt_pck++;

					}

					$package_code = $this->Package->find('first',array('conditions'=>array('Package.id'=>$package_val)));

					$test_code_arr[] = $package_code['Package']['package_code'];

					$test_name_arr[] = $package_code['Package']['package_name'];

					$test_amt = ($package_code['Package']['package_mrp']+$test_amt);

				}

				$count_expl_package = $cnt_pck;

			}

			

			$parameter_count = ($count_expl_test+$count_expl_profile+$count_expl_offer+$count_expl_package);

			$implode_parameter_code = implode(', ',$test_code_arr);

			$implode_parameter_name = implode(', ',$test_name_arr);

	

			if($sl_vl['Health']['gender'] == 1)

			{

				$gender = 'M';

			}

			if($sl_vl['Health']['gender'] == 2)

			{

				$gender = 'F';



			}

			if($sl_vl['Health']['discount_id'] != 0)

			{

				$fix_dicount = $this->Discount->find('first',array('conditions'=>array('Discount.id'=>$sl_vl['Health']['discount_id'])));

				if($fix_dicount['Discount']['type'] == 'Percent')

				{

					$fix_discount = $fix_dicount['Discount']['amount'].'%';

				}

				if($fix_dicount['Discount']['type'] == 'Rupees')

				{

					$fix_discount = 'Rs. '.$fix_dicount['Discount']['amount'];

				}

			}

			else

			{

				$fix_discount = 'N/A';

			}

			if($sl_vl['Health']['discount_amount'] != 0)

			{

				$disc_amt = $sl_vl['Health']['discount_amount'];

			}

			else

			{

				$disc_amt = 'N/A';

			}

			if(!empty($sl_vl['Health']['remark']))

			{

				$refer_by = $sl_vl['Health']['remark'];

			}

			else
			{

				$refer_by = 'N/A';

			}

			

			$reports[$k]['s_no'] = $s_no;

			$reports[$k]['book_date'] = date('d-M-Y',strtotime($sl_vl['Health']['s_date']));

			$reports[$k]['req_num'] = $requestNum['Billing']['order_id'];

			
								$reports[$k]['pcc_name1'] = !empty($pcc_name1['Lab']['pcc_name']) ? $pcc_name1['Lab']['pcc_name'] : 'NPL';
								$reports[$k]['pcc_name'] = !empty($pcc_name['Lab']['pcc_name']) ? $pcc_name['Lab']['pcc_name'] : 'NPL';
								$reports[$k]['medical_reference_number'] = $sl_vl['Health']['medical_reference_number'];
			$reports[$k]['booked_by_user'] = isset($user_list[$sl_vl['Health']['created_by_agent']])?$user_list[$sl_vl['Health']['created_by_agent']]:'-';
								$reports[$k]['patient_name'] = strtoupper($sl_vl['Health']['name']);

			$reports[$k]['patient_gender'] = $gender.'/'.$sl_vl['Health']['age'];

			//$reports[$k]['patient_contact'] = $sl_vl['Health']['landline'];
			$reports[$k]['patient_contact'] = $this->Utility->show_mobile_hide($sl_vl['Health']['landline'],$sl_vl['Health']['s_date']);
			

			$reports[$k]['patient_email'] = $this->Utility->show_mobile_hide($sl_vl['Health']['email'],$sl_vl['Health']['s_date']);

			$reports[$k]['refer_by'] = $refer_by;

			$reports[$k]['agent_name'] = $agent_name['Agent']['name'];

			$reports[$k]['parameter_count'] = $parameter_count;

			$reports[$k]['parameter_name'] = $implode_parameter_name;

			$reports[$k]['parameter_code'] = $implode_parameter_code;

			$reports[$k]['test_amount'] = $test_amt;

			$reports[$k]['fix_discount'] = $fix_discount;

			$reports[$k]['disc_amt'] = $disc_amt;


			

			if($sl_vl['Health']['cancelled_status'] == 1)

			{ 

			$reports[$k]['net_payble'] = ($sl_vl['Health']['received_amount']+$sl_vl['Health']['balance_amount']);

			$reports[$k]['receive_payment'] = $sl_vl['Health']['received_amount'];

			$reports[$k]['balance_payment'] = $sl_vl['Health']['balance_amount'];

			}

			else

			{

			$reports[$k]['net_payble'] = ($sl_vl['Health']['received_amount']+$sl_vl['Health']['balance_amount']);

			if($sl_vl['Health']['received_amount']+$sl_vl['Health']['balance_amount'] == 0)

				$reports[$k]['net_payble']=$sl_vl['Health']['total_amount'];

			$reports[$k]['receive_payment'] = $sl_vl['Health']['received_amount'];

			$reports[$k]['balance_payment'] = $reports[$k]['net_payble']-$sl_vl['Health']['received_amount'];

			}

			$reports[$k]['test_ref_num'] = $sl_vl['Health']['ref_num'];
			$reports[$k]['reference'] = $sl_vl['Health']['reference'];
			$reports[$k]['request_status']="";

			if($sl_vl['Health']['requ_status'] == 4)

				$reports[$k]['request_status']="Phlebo Assigned";

			else if($sl_vl['Health']['requ_status'] == 5)

				$reports[$k]['request_status']="Sent to Lab";

			else if($sl_vl['Health']['requ_status'] == 6)

				$reports[$k]['request_status']="Report";

			else if($sl_vl['Health']['requ_status'] == 7)

				$reports[$k]['request_status']="Partial Report";

			else if($sl_vl['Health']['requ_status'] == 8)

				$reports[$k]['request_status']="Test Cancelled";
				
			else if($sl_vl['Health']['requ_status'] == 10)

				$reports[$k]['request_status']="Sample Collected";

			else if($sl_vl['Health']['requ_status'] == 12)

				$reports[$k]['request_status']="Partial Sent to Lab";
				
			else if($sl_vl['Health']['requ_status'] == 14)

				$reports[$k]['request_status']="Reg. in LIS";	
			
			else if($sl_vl['Health']['requ_status'] == 11)

				$reports[$k]['request_status']="Sample Rejected";	
				
			else if($sl_vl['Health']['requ_status'] == 13)

				$reports[$k]['request_status']="Rescheduled";
				
			else if($sl_vl['Health']['requ_status'] == 15)

				$reports[$k]['request_status']="Api New Booking";
				
			else if($sl_vl['Health']['requ_status'] == 16)

				$reports[$k]['request_status']="Specimen Drawn";
			
			else if($sl_vl['Health']['requ_status'] == 9)
				$reports[$k]['request_status']="Closed";
				
			else if($sl_vl['Health']['requ_status'] == 0)

				$reports[$k]['request_status']="New Booking";
			else if($sl_vl['Health']['requ_status'] == 1)

				$reports[$k]['request_status']="Slot Not Available";
				
			else if($sl_vl['Health']['requ_status'] == 2)

				$reports[$k]['request_status']="Slot Blocked";
				
			else if($sl_vl['Health']['requ_status'] == 3)

				$reports[$k]['request_status']="Follow Up";
				
			else if($sl_vl['Health']['requ_status'] == 17)

				$reports[$k]['request_status']="Partial Closed";
				
			else if($sl_vl['Health']['requ_status'] == 18)

				$reports[$k]['request_status']="Booking Confirmed";
				
			else if($sl_vl['Health']['requ_status'] == 19)

				$reports[$k]['request_status']="Phlebo Confirmed";
				
			else if($sl_vl['Health']['requ_status'] == 20)

				$reports[$k]['request_status']="Phlebo Tracking";
				
			else if($sl_vl['Health']['requ_status'] == 21)

				$reports[$k]['request_status']="Specimen On Hold";
				
			else 

				$reports[$k]['request_status']="Pending";

			$s_no++;

			$k++;

		}

		

		$total_records = $this->Health->find('all',array('conditions'=>$conditions));

		$net_pay = 0;

		$net_rec = 0;

		$net_bal = 0;

		$total_test = 0;

		foreach($total_records as $tr_ky => $tr_vl)
		{


			if(!empty($tr_vl['Health']['test_id']))

			{

				$expl_test = explode(',',$tr_vl['Health']['test_id']);

				$cnt_1 = 0;

				foreach($expl_test as $k_1 => $v_1)

				{

					if(!empty($v_1))

					{

						$cnt_1++;

					}

				}

			}

			if(!empty($tr_vl['Health']['profile_id']))

			{

				$expl_prf = explode(',',$tr_vl['Health']['test_id']);

				$cnt_2 = 0;

				foreach($expl_test as $k_2 => $v_2)

				{

					if(!empty($v_2))

					{

						$cnt_2++;

					}

				}

			}

			if(!empty($tr_vl['Health']['offer_id']))

			{

				$expl_offer = explode(',',$tr_vl['Health']['test_id']);

				$cnt_3 = 0;

				foreach($expl_test as $k_3 => $v_3)

				{

					if(!empty($v_3))

					{

						$cnt_3++;

					}

				}

			}

			if(!empty($tr_vl['Health']['package_id']))

			{

				$expl_pck = explode(',',$tr_vl['Health']['test_id']);

				$cnt_4 = 0;

				foreach($expl_test as $k_4 => $v_4)

				{

					if(!empty($v_4))

					{

						$cnt_4++;

					}

				}

			}

			$total_test_now = ($cnt_1+$cnt_2+$cnt_3+$cnt_4);
			


			$total_test = ($total_test_now+$total_test);

			

			$net_rec = ($tr_vl['Health']['received_amount']+$net_rec);

			//$net_bal = ($tr_vl['Health']['balance_amount']+$net_bal);

			if($tr_vl['Health']['cancelled_status'] == 1)

			{

				$net_bal = ($tr_vl['Health']['balance_amount']+$net_bal);

			}

			else

			{

				$net_pay_amt= ($tr_vl['Health']['received_amount']+$tr_vl['Health']['balance_amount']);

				if($net_pay_amt == 0)

					$net_pay_amt=$tr_vl['Health']['total_amount'];

				$net_bal_amt=$net_pay_amt-$tr_vl['Health']['received_amount'];

				$net_bal = ($net_bal_amt+$net_bal);

			}

			$net_pay = ($net_rec+$net_bal);

		}

		$total_no_records = count($total_records);

		$total_no_test = $total_test;

		$total_net_pay = $net_pay;

		$total_net_rec = $net_rec;

		$total_net_bal = $net_bal;



		header('Content-Type: text/csv; charset=utf-8');

		header('Content-Disposition: attachment; filename=sales_report.csv');

		$output = fopen('php://output', 'w');

		fputcsv($output, array('Total No. of Requests', 'Total No. of Tests', 'Total Net Payable','Total Received Amount', 'Total Balance Due'));

		fputcsv($output, array($total_no_records,$total_no_test,$total_net_pay,$total_net_rec,$total_net_bal));

		fputcsv($output, array());

		

		fputcsv($output, array('S.No.', 'Date', 'ReqNo','Booked By PCC','Service By PCC','Medical Reference Number','Booked By User' ,'Patient Name' ,'Gender/Age', 'Phone No.', 'Email','Reffered By','Agent Name','No. of Test', 'Test Names','Test Codes','Test Amount(Rs)', 'Discount%','Discount Amount(Rs)','Net Payble(Rs)','Payment Received(Rs)','Balance Due(Rs)','Lab Refrence No.','Reference','Request Status'));

		foreach ($reports as $keys => $values) 

		{

			if(($values['fix_discount'] != 'N/A') && ($values['fix_discount'] == '100%'))

			{

				$values['test_amount'] = $values['test_amount'];

				$values['fix_discount'] = $values['fix_discount'];

				$values['disc_amt'] = $values['test_amount'];

				$values['net_payble'] = $values['net_payble'];

			}

			else

			{

				$values['test_amount'] = $values['test_amount'];

				$values['fix_discount'] = $values['fix_discount'];

				$values['disc_amt'] = $values['disc_amt'];

				$values['net_payble'] = $values['net_payble'];

			}

			fputcsv($output, $values);

		}

		die;

	}
	
	function itwoh_api()
	{

		$this->Health = ClassRegistry::init("Health");
		$today_date = date('Y-m-d');
		$today_date = date('Y-m-d',(strtotime ( '-1 days' , strtotime ( $today_date) ) ));
        
        $health_orders = $this->Health->query("SELECT *
			FROM healths
			WHERE s_date >= '".$today_date."' 
			AND requ_status in ('0','15','13','18')
			AND assigned_lab = '82'
			ORDER BY `healths`.`id` ASC
			LIMIT 0 , 50");
			
		//// AND id='333611'
	/*print_R("SELECT *
			FROM healths
			WHERE s_date >= '".$today_date."' 
			AND requ_status in ('0','15','13','18')
			AND assigned_lab = '82'
			ORDER BY `healths`.`id` ASC
			LIMIT 0 , 50");
		print_R($health_orders);die;*/
		
		$this->Lab = ClassRegistry::init("Lab");
		foreach($health_orders as $key)
		{
			$lab_data = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$key['healths']['created_by'])));
			
			print_R($key['healths']['assigned_lab']);
			echo "-------------";
			print_R($key['healths']['id']);
			echo "------------------";
			print_R($lab_data['Lab']['pcc_name']);
			echo "-------------triggered i2h API------------------";
			
			$check = $this->Utility->itwohapi($key['healths']['id'],"cron");
			
			echo "<br><br>";
			
		}
		die;	}
	
	function testi()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "3.133.211.205:9000/rest/v1/token",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
			"api-key: NIRAMAYA",
			"api-secret: 10885454"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}
		die;
	}
	
	function daily_request_report()
	{
		$this->Health = ClassRegistry::init('Health');
		$this->Lab = ClassRegistry::init('Lab');
		$this->Agent = ClassRegistry::init('Agent');
		$this->Billing = ClassRegistry::init('Billing');
		$this->RequestTest = ClassRegistry::init('RequestTest');
		$this->PaymentType = ClassRegistry::init('PaymentType');

		$payment_type = $this->PaymentType->find('list',array('fields'=>array('PaymentType.id','PaymentType.type')));//

		$requestStatus = Configure::read('RequestStatus');
		
		$today_date = date('Y-m-d');
		$export_s_date = date('Y-m-d',(strtotime ('-1 days',strtotime($today_date)))); 
		$healthlab = $this->Health->query('Select distinct(created_by) from healths where book_date >= "'.date('Y-1-1 00:00:00').'" and book_date <= "'.date('Y-m-d 23:59:59',strtotime($export_s_date)).'"');
		
		$sentEmail = 0;
		foreach($healthlab as $val)
		{
			$export_lab_id = $val['healths']['created_by'];
			
			$pcc1 = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$export_lab_id)));
			
			if($pcc1['Lab']['send_daily_request_report']==1)
			{
				if(!empty($export_s_date) && $export_s_date != '')
				{
					$conditions['Health.book_date >='] = date('Y-1-1 00:00:00');
					$conditions['Health.book_date <='] = date('Y-m-d 23:59:59',strtotime($export_s_date));
				}
				if(!empty($export_lab_id) && $export_lab_id != '')
				{
					$conditions['Health.created_by'] = $export_lab_id;
				}
				
				print_R($conditions);
				echo "-------------->";

				$conditions['Health.status'] = 1;
				$find_request = $this->Health->find('all',array('conditions'=>$conditions,'order'=>'Health.book_date DESC'));
				
				$reports = array();
				$k = 0;
				$s_no = 1;
				foreach($find_request as $sl_ky => $sl_vl)
				{
					$parameter_count = 0;
					$count_expl_test = 0;
					$count_expl_profile = 0;
					$count_expl_offer = 0;
					$count_expl_package= 0;
					$pcc_name = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$sl_vl['Health']['assigned_lab'])));
					$pcc_name1 = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$sl_vl['Health']['created_by'])));
					$agent_name = $this->Agent->find('first',array('conditions'=>array('Agent.id'=>$sl_vl['Health']['agent_id'])));
					$requestNum = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$sl_vl['Health']['id'])));
					$test_amt = 0;
					$test_code_arr = array();
					$test_name_arr = array();
					if(!empty($sl_vl['Health']['test_id']))
					{
				$expl_test = explode(',',$sl_vl['Health']['test_id']);
				$cnt_test = 0; 
				foreach($expl_test as $test_key => $test_val)
				{
					if(!empty($test_val))
					{
						$cnt_test++;
					}
					$test_code = $this->Test->find('first',array('conditions'=>array('Test.id'=>$test_val)));
					$test_code_arr[] = $test_code['Test']['testcode'];
					$test_name_arr[] = $test_code['Test']['test_parameter'];
					$test_amt = ($test_code['Test']['mrp']+$test_amt);
				}
				$count_expl_test = $cnt_test;
					}
				if(!empty($sl_vl['Health']['profile_id']))
					{
				$expl_test = explode(',',$sl_vl['Health']['profile_id']);
				$cnt_test = 0; 
				foreach($expl_test as $test_key => $test_val)
				{
					if(!empty($test_val))
					{
						$cnt_test++;
					}
					$test_code = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$sl_vl['Health']['id'],'RequestTest.test_id'=>$test_val)));
					$test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$test_val)));
					$test_code_arr[] = $test_detail['Test']['testcode'];
					$test_name_arr[] = $test_detail['Test']['test_parameter'];
					$test_amt = ($test_code['RequestTest']['mrp']+$test_amt);
				}
				$count_expl_test = $cnt_test;
					}
					if(!empty($sl_vl['Health']['offer_id']))
					{
						$expl_offer = explode(',',$sl_vl['Health']['offer_id']);
						$cnt_offr = 0;
						foreach($expl_offer as $offer_key => $offer_val)
						{
							if(!empty($offer_val))
							{
								$cnt_offr++;
							}
							$offer_code = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$offer_val)));
							$test_code_arr[] = $offer_code['Banner']['banner_code'];
							$test_name_arr[] = $offer_code['Banner']['banner_name'];
							$test_amt = ($offer_code['Banner']['banner_mrp']+$test_amt);
						}
						$count_expl_offer = count($cnt_offr);
					}
				if(!empty($sl_vl['Health']['package_id']))
					{
				$expl_package = explode(',',$sl_vl['Health']['package_id']);
				$cnt_pck = 0;
				foreach($expl_package as $package_key => $package_val)
				{
					if(!empty($package_val))
					{
				$cnt_pck++;
					}
					$package_code = $this->Package->find('first',array('conditions'=>array('Package.id'=>$package_val)));
					$test_code_arr[] = $package_code['Package']['package_code'];
					$test_name_arr[] = $package_code['Package']['package_name'];
					$test_amt = ($package_code['Package']['package_mrp']+$test_amt);
				}
				$count_expl_package = $cnt_pck;
					}
				$parameter_count = ($count_expl_test+$count_expl_profile+$count_expl_offer+$count_expl_package);
					$implode_parameter_code = implode(', ',$test_code_arr);
					$implode_parameter_name = implode(', ',$test_name_arr);
				if($sl_vl['Health']['gender'] == 1)
					{
				$gender = 'M';
					}
					if($sl_vl['Health']['gender'] == 2)
					{
				$gender = 'F';
					}
					if(!empty($sl_vl['Health']['remark']))
					{
				$refer_by = $sl_vl['Health']['remark'];
					}
					else
					{
				$refer_by = 'N/A';
					}

					$booking_from = substr($sl_vl['Health']['flags'], 0, 1);
					$booking_mode = 'N/A';
					
					/*if($booking_from == "1")
						$booking_mode = 'Online';*/
					if($booking_from == "2" || $booking_from == "1")
						$booking_mode = 'Manual';
					if($booking_from == "3")
						$booking_mode = 'Excel';
					if($booking_from == "4")
						$booking_mode = 'API';
					
					$reports[$k]['s_no'] = $s_no;
					$reports[$k]['s_date'] = date('d-M-Y',strtotime($sl_vl['Health']['book_date']));
					$reports[$k]['req_num'] = $requestNum['Billing']['order_id'];
					$reports[$k]['booking_mode'] = $booking_mode;
					$reports[$k]['reference'] = $sl_vl['Health']['reference'];
					$reports[$k]['medical_reference_number'] = $sl_vl['Health']['medical_reference_number'];
					$reports[$k]['pincode'] = $sl_vl['Health']['pincode'];
					$reports[$k]['sample_collected_date'] = date('d-M-Y',strtotime($sl_vl['Health']['sample_date1']));
					$reports[$k]['sample_collected_time'] = Configure::read('TimeSlot.'.$sl_vl['Health']['sample_time1']);;
					$reports[$k]['pcc_name1'] = $pcc_name1['Lab']['pcc_name'];
					$reports[$k]['pcc_name'] = $pcc_name['Lab']['pcc_name'];
					$reports[$k]['patient_name'] = strtoupper($sl_vl['Health']['name']);
					$reports[$k]['patient_gender'] = $gender."/".$sl_vl['Health']['age'];
					$reports[$k]['parameter_name'] = $implode_parameter_name;
					$reports[$k]['parameter_code'] = $implode_parameter_code;
					if($sl_vl['Health']['cancelled_status'] == 1)
					{ 
				$reports[$k]['net_payble'] = ($sl_vl['Health']['received_amount']+$sl_vl['Health']['balance_amount']);
				$reports[$k]['balance_payment'] = $sl_vl['Health']['balance_amount'];
					}
					else
					{
						$reports[$k]['net_payble'] = ($sl_vl['Health']['received_amount']+$sl_vl['Health']['balance_amount']);
						
						if($sl_vl['Health']['received_amount']+$sl_vl['Health']['balance_amount'] == 0)
							$reports[$k]['net_payble']=$sl_vl['Health']['total_amount'];
						
						$reports[$k]['balance_payment'] = $reports[$k]['net_payble']-$sl_vl['Health']['received_amount'];
					}
					if($sl_vl['Health']['payment_type']==4)
					{
						$sl_vl['Health']['payment_type']=1;
							
					}

					$reports[$k]['payment_type'] = !empty($payment_type[$sl_vl['Health']['payment_type']])?$payment_type[$sl_vl['Health']['payment_type']]:'N/A';
					$reports[$k]['amount_collected'] = $sl_vl['Health']['amount_collected'];
					$reports[$k]['amount_to_be_collected'] = $sl_vl['Health']['amount_to_be_collected'];
					$reports[$k]['requ_status'] = $requestStatus[$sl_vl['Health']['requ_status']];
					$reports[$k]['test_ref_num'] = $sl_vl['Health']['ref_num'];
					$s_no++;
					$k++;
				}
				
				$total_records = $this->Health->find('all',array('conditions'=>$conditions));
				
				$net_pay = 0;
				$net_rec = 0;
				$net_bal = 0;
				$total_test = 0;
				foreach($total_records as $tr_ky => $tr_vl)
				{
					if(!empty($tr_vl['Health']['test_id']))
					{
				$expl_test = explode(',',$tr_vl['Health']['test_id']);
				$cnt_1 = 0;
				foreach($expl_test as $k_1 => $v_1)
				{
					if(!empty($v_1))
					{
				$cnt_1++;
					}
				}
					}
					if(!empty($tr_vl['Health']['profile_id']))
					{
				$expl_prf = explode(',',$tr_vl['Health']['test_id']);
				$cnt_2 = 0;
				foreach($expl_test as $k_2 => $v_2)
				{
					if(!empty($v_2))
					{
				$cnt_2++;
					}
				}
					}
					if(!empty($tr_vl['Health']['offer_id']))
					{
				$expl_offer = explode(',',$tr_vl['Health']['test_id']);
				$cnt_3 = 0;
				foreach($expl_test as $k_3 => $v_3)
				{
					if(!empty($v_3))
					{
				$cnt_3++;
					}
				}
					}
					if(!empty($tr_vl['Health']['package_id']))
					{
				$expl_pck = explode(',',$tr_vl['Health']['test_id']);
				$cnt_4 = 0;
				foreach($expl_test as $k_4 => $v_4)
				{
					if(!empty($v_4))
					{
				$cnt_4++;
					}
				}
					}
					$total_test_now = ($cnt_1+$cnt_2+$cnt_3+$cnt_4);
				$total_test = ($total_test_now+$total_test);
				$net_rec = ($tr_vl['Health']['received_amount']+$net_rec);
				if($tr_vl['Health']['cancelled_status'] == 1)
					{
				$net_bal = ($tr_vl['Health']['balance_amount']+$net_bal);
					}
					else
					{
				$net_pay_amt= ($tr_vl['Health']['received_amount']+$tr_vl['Health']['balance_amount']);
				if($net_pay_amt == 0)
					$net_pay_amt=$tr_vl['Health']['total_amount'];
				$net_bal_amt=$net_pay_amt-$tr_vl['Health']['received_amount'];
				$net_bal = ($net_bal_amt+$net_bal);
					}
					$net_pay = ($net_rec+$net_bal);
				}
				$total_no_records = count($total_records);
				$total_no_test = $total_test;
				$total_net_pay = $net_pay;
				$total_net_rec = $net_rec;
				$total_net_bal = $net_bal;
				
				$output = fopen('/home2/niramovh/public_html/app/webroot/files/daily_reports/request_status_report_'.date('d-m-Y').'.csv', 'w');
				fputcsv($output, array('Total No. of Requests', 'Total No. of Tests', 'Total Net Payable','Total Received Amount', 'Total Balance Due'));
				fputcsv($output, array($total_no_records,$total_no_test,$total_net_pay,$total_net_rec,$total_net_bal));
				fputcsv($output, array());
				fputcsv($output, array('S.No.', 'Date', 'ReqNo','Booking From','Reference No','Mrn No.','Pincode','Collection Date','Collection Time','Booked By PCC','Service By PCC','Patient Name' ,'Gender/Age','Test Names','Test Codes','Net Payble(Rs)','Balance Due(Rs)','Payment Type','Amount Collected By Pcc','Amount To Be Collected By NPL','Request Status','Lab Refrence No.'));
				foreach ($reports as $keys => $values) 
				{
					if(($values['fix_discount'] != 'N/A') && ($values['fix_discount'] == '100%'))
					{
				$values['test_amount'] = $values['test_amount'];
				$values['fix_discount'] = $values['fix_discount'];
				$values['disc_amt'] = $values['test_amount'];
				$values['net_payble'] = $values['net_payble'];
					}
					else
					{
				$values['test_amount'] = $values['test_amount'];
				$values['fix_discount'] = $values['fix_discount'];
				$values['disc_amt'] = $values['disc_amt'];
				$values['net_payble'] = $values['net_payble'];
					}
					fputcsv($output, $values);
				}
				
				print_R($pcc1['Lab']['pcc_name']);
				echo "<br>";
				$pie_url = $this->get_tiny_url("https://www.niramayahealthcare.com/home/daily_pie_data/".base64_encode($pcc_name1['Lab']['id'])."/".base64_encode($export_s_date));
				//print_R(date('d-m-Y h:i:s'));
				$this->send_daily_report($pcc_name1['Lab']['id'],'request_status_report_'.date('d-m-Y').".csv",$pie_url,$export_s_date);
				$sentEmail++;
			}
		}
		echo "<label style='font-size:13px;'><b style='margin-left:35%;'>";
		print_R($sentEmail." Daily Reports Have been Sent.");
		echo "</b></label>";
		die;
	}
	
	function daily_pie_data($lab_id = null ,$export_s_date = null)
	{
		$export_s_date = base64_decode($export_s_date);
		$lab_id = base64_decode($lab_id);
		$this->Health = ClassRegistry::init('Health');
		$conditions = array();
		
		if(!empty($export_s_date) && $export_s_date != ' ')
		{
			$conditions['Health.book_date >='] = date('Y-m-d 00:00:00',strtotime($export_s_date));
			$conditions['Health.book_date <='] = date('Y-m-d 23:59:59',strtotime($export_s_date));
		}

		if(!empty($lab_id) && $lab_id != ' ')
		{
			$conditions['Health.created_by'] = $lab_id;
		}
		
		//print_R($conditions);die;
		
		$requestStatus = Configure::read('RequestStatus');
		$lab_list = $this->Lab->find('list',array('fields'=>array('id','pcc_name')));
		
		$pcc_name1 = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$lab_id)));
		$this->set('pcc_name',$pcc_name1['Lab']['pcc_name']);
		$this->set('export_date',$export_s_date);
		
		$total_records = $this->Health->find('all',array('conditions'=>$conditions));
		
		$monthly_conditions = $conditions;
		$monthly_conditions['Health.book_date >='] = date('Y-m-1 00:00:00',strtotime($export_s_date));
		$monthly_conditions['Health.book_date <='] = date('Y-m-d h:i:s',strtotime($export_s_date));
		
		$yearly_conditions = $conditions;
		$yearly_conditions['Health.book_date >='] = date('Y-1-1 00:00:00',strtotime($export_s_date));
		$yearly_conditions['Health.book_date <='] = date('Y-m-d 23:59:59',strtotime($export_s_date));
		
		$monthly_total_records = $this->Health->find('all',array('conditions'=>$monthly_conditions));
		$yearly_total_records = $this->Health->find('all',array('conditions'=>$yearly_conditions));
		//print_R($yearly_conditions);die;
		$request_status_req = array();
		$booked_by_total_req = array();
		$monthly_request_status_req = array();
		$monthly_booked_by_total_req = array();
		$yearly_request_status_req = array();
		$yearly_booked_by_total_req = array();
		
		foreach($total_records as $tr_ky => $tr_vl)
		{
			if(!is_array($booked_by_total_req[$tr_vl['Health']['created_by']]))
				$booked_by_total_req[$tr_vl['Health']['created_by']] = array();
			
			array_push($booked_by_total_req[$tr_vl['Health']['created_by']],$tr_vl['Health']['id']);
			
			if(!is_array($request_status_req[$tr_vl['Health']['requ_status']]))
				$request_status_req[$tr_vl['Health']['requ_status']] = array();
			
			array_push($request_status_req[$tr_vl['Health']['requ_status']],$tr_vl['Health']['id']);
		}
		
		foreach($monthly_total_records as $tr_ky => $tr_vl)
		{
			if(!is_array($monthly_booked_by_total_req[$tr_vl['Health']['created_by']]))
				$monthly_booked_by_total_req[$tr_vl['Health']['created_by']] = array();
			
			array_push($monthly_booked_by_total_req[$tr_vl['Health']['created_by']],$tr_vl['Health']['id']);
			
			if(!is_array($monthly_request_status_req[$tr_vl['Health']['requ_status']]))
				$monthly_request_status_req[$tr_vl['Health']['requ_status']] = array();
			
			array_push($monthly_request_status_req[$tr_vl['Health']['requ_status']],$tr_vl['Health']['id']);
		}
		
		foreach($yearly_total_records as $tr_ky => $tr_vl)
		{
			if(!is_array($yearly_booked_by_total_req[$tr_vl['Health']['created_by']]))
				$yearly_booked_by_total_req[$tr_vl['Health']['created_by']] = array();
			
			array_push($yearly_booked_by_total_req[$tr_vl['Health']['created_by']],$tr_vl['Health']['id']);
			
			if(!is_array($yearly_request_status_req[$tr_vl['Health']['requ_status']]))
				$yearly_request_status_req[$tr_vl['Health']['requ_status']] = array();
			
			array_push($yearly_request_status_req[$tr_vl['Health']['requ_status']],$tr_vl['Health']['id']);
		}
		
		$request_status_total = array();
		$booked_by_total = array();
		$monthly_request_status_total = array();
		$monthly_booked_by_total = array();
		$yearly_request_status_total = array();
		$yearly_booked_by_total = array();
				
		$agent_total = array();
		
		array_push($booked_by_total,array('Booked by','count'));
		array_push($request_status_total,array('Request Status','count'));
		array_push($monthly_booked_by_total,array('Booked by','count'));
		array_push($monthly_request_status_total,array('Request Status','count'));
		array_push($yearly_booked_by_total,array('Booked by','count'));
		array_push($yearly_request_status_total,array('Request Status','count'));
				
		foreach($monthly_booked_by_total_req as $key=>$val)
		{
			array_push($monthly_booked_by_total,array($lab_list[$key]." - ".count($monthly_booked_by_total_req[$key]),count($monthly_booked_by_total_req[$key])));
		}
		
		foreach($monthly_request_status_req as $key=>$val)
		{
			array_push($monthly_request_status_total,array($requestStatus[$key]." - ".count($monthly_request_status_req[$key]),count($monthly_request_status_req[$key])));
		}
		
		foreach($yearly_booked_by_total_req as $key=>$val)
		{
			array_push($yearly_booked_by_total,array($lab_list[$key]." - ".count($yearly_booked_by_total_req[$key]),count($yearly_booked_by_total_req[$key])));
		}
		
		foreach($yearly_request_status_req as $key=>$val)
		{
			array_push($yearly_request_status_total,array($requestStatus[$key]." - ".count($yearly_request_status_req[$key]),count($yearly_request_status_req[$key])));
		}
				
		foreach($booked_by_total_req as $key=>$val)
		{
			array_push($booked_by_total,array($lab_list[$key]." - ".count($booked_by_total_req[$key]),count($booked_by_total_req[$key])));
		}
		foreach($request_status_req as $key=>$val)
		{
			array_push($request_status_total,array($requestStatus[$key]." - ".count($request_status_req[$key]),count($request_status_req[$key])));
		}
		
		$bookedbytotal = json_encode($booked_by_total);
		$requeststatustotal = json_encode($request_status_total);
		$monthlybookedbytotal = json_encode($monthly_booked_by_total);
		$monthlyrequeststatustotal = json_encode($monthly_request_status_total);
		
		$this->set('monthly_booked_by_total',json_encode($monthly_booked_by_total));
		$this->set('monthly_request_status_total',json_encode($monthly_request_status_total));
		$this->set('yearly_booked_by_total',json_encode($yearly_booked_by_total));
		$this->set('yearly_request_status_total',json_encode($yearly_request_status_total));
		$this->set('yearly_total_records',count($yearly_total_records));
				
		$this->set('booked_by_total',json_encode($booked_by_total));
		$this->set('request_status_total',json_encode($request_status_total));
		$this->set('total_records',count($total_records));
		$this->set('monthly_total_records',count($monthly_total_records));
		
		$this->layout = false;
		/*$html = "
			<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
			<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
			<script type='text/javascript'>
			// Load google charts
			</script>

			<script type='text/javascript'>
			$(function() {	
				var booked_by_pie = $('#booked_by_pie_data').val();
				var request_status_pie = $('#request_status_pie_data').val();
				var monthly_booked_by_pie = $('#monthly_booked_by_pie_data').val();
				var monthly_request_status_pie = $('#monthly_request_status_pie_data').val();
				
				if(booked_by_pie!='')
				{
					var booked_by_pie_data = JSON.parse(booked_by_pie);
					
					console.log(booked_by_pie_data);
					
					google.charts.load('current', {'packages':['corechart']});
					google.charts.setOnLoadCallback(drawChart);

					// Draw the chart and set the chart values
					function drawChart() {
					  var data = google.visualization.arrayToDataTable(booked_by_pie_data);

					  // Optional; add a title and set the width and height of the chart
					  var options = {'title':'Booked By Data', 'width':550, 'height':400};

					  // Display the chart inside the <div> element with id='piechart'
					  var chart = new google.visualization.PieChart(document.getElementById('booked_by_piechart'));
					  chart.draw(data, options);
					}
				}
				
				if(request_status_pie_data!='')
				{
					var request_status_pie_data = JSON.parse(request_status_pie);
					
					google.charts.load('current', {'packages':['corechart']});
					google.charts.setOnLoadCallback(drawChart);

					// Draw the chart and set the chart values
					function drawChart() {
					  var data = google.visualization.arrayToDataTable(request_status_pie_data);

					  // Optional; add a title and set the width and height of the chart
					  var options = {'title':'Total Payable Data', 'width':550, 'height':400};

					  // Display the chart inside the <div> element with id='piechart'
					  var chart = new google.visualization.PieChart(document.getElementById('request_status_piechart'));
					  chart.draw(data, options);
					}
				}
				
				if(monthly_booked_by_pie!='')
				{
					var monthly_booked_by_pie_data = JSON.parse(monthly_booked_by_pie);
					
					google.charts.load('current', {'packages':['corechart']});
					google.charts.setOnLoadCallback(drawChart);

					// Draw the chart and set the chart values
					function drawChart() {
					  var data = google.visualization.arrayToDataTable(monthly_booked_by_pie_data);

					  // Optional; add a title and set the width and height of the chart
					  var options = {'title':'Booked By Data (Monthly)', 'width':550, 'height':400};

					  // Display the chart inside the <div> element with id='piechart'
					  var chart = new google.visualization.PieChart(document.getElementById('monthly_booked_by_piechart'));
					  chart.draw(data, options);
					}
				}
				
				if(monthly_request_status_pie_data!='')
				{
					var monthly_request_status_pie_data = JSON.parse(monthly_request_status_pie);
					
					google.charts.load('current', {'packages':['corechart']});
					google.charts.setOnLoadCallback(drawChart);

					// Draw the chart and set the chart values
					function drawChart() {
					  var data = google.visualization.arrayToDataTable(monthly_request_status_pie_data);

					  // Optional; add a title and set the width and height of the chart
					  var options = {'title':'Total Payable Data (Monthly)', 'width':550, 'height':400};

					  // Display the chart inside the <div> element with id='piechart'
					  var chart = new google.visualization.PieChart(document.getElementById('monthly_request_status_piechart'));
					  chart.draw(data, options);
					}
				}
			});


			</script>
			<table border='0' cellspacing='2' cellpadding='0' align='center' width='100%'>
				<thead>
					<tr class='pie' >
						<td>
							<div style='text-align: center;'><h2>Total Request (Today) - ".count($total_records)."</h2></div>
							<div id='booked_by_piechart'></div>
						</td>
						<td>
							<div style='text-align: center;'><h2>Request Status Count (Today) - ".count($total_records)."</h2></div>
							<div id='request_status_piechart'></div>
						</td>
					</tr>	
					<tr class='pie' >
						<td>
							<div style='text-align: center;'><h2>Total Request (Monthly) - ".count($monthly_total_records)."</h2></div>
							<div id='monthly_booked_by_piechart'></div>
			0			</td>
						<td>
							<div style='text-align: center;'><h2>Request Status Count (Monthly) - ".count($monthly_total_records)."</h2></div>
							<div id='monthly_request_status_piechart'></div>
						</td>
					</tr>
				</thead>
			</table>
			<input id='booked_by_pie_data' value='".json_encode($booked_by_total)."' type='hidden'>
			<input id='request_status_pie_data' value='".json_encode($request_status_total)."' type='hidden'>
			<input id='monthly_booked_by_pie_data' value='".json_encode($monthly_booked_by_total)."' type='hidden'>
			<input id='monthly_request_status_pie_data' value='".json_encode($monthly_request_status_total)."' type='hidden'>";
		
		
		
		return $html;*/
	}
	
	function send_daily_report($lab_id=null,$filename=null,$pie_url=null,$date=null)
	{
		$this->Lab = ClassRegistry::init('Lab');
		$lab_id = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$lab_id)));
		
		$cc_emails = explode(',',$lab_id['Lab']['mis_report_email']);
		
		$mail = new PHPMailer(); // create a new object
							//print_R($mail);die;
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465; // or 587
			$mail->IsHTML(true);
			$mail->setFrom('lab.reports@niramayapathlabs.com', 'NirAmaya PathLabs');
			//$mail->addAddress($lab_id['Lab']['pcc_email'], $lab_id['Lab']['pcc_name']);
			foreach($cc_emails as $val)
			{
				$mail->addAddress($val, $val);
				//$mail->addCC($val, $val);
			}
			//$mail->addAddress('itsupport@niramayapathlabs.com');
			$mail->Username = 'lab.reports@niramayapathlabs.com';
			$mail->Password = 'Lab@Reports';
							//print_R(json_encode($mail));die;
			$mail->Subject = "Daily Request Report from ".date('1-m-Y')." to ".date('d-m-Y',strtotime($date));
			$mail->addAttachment('/home2/niramovh/public_html/app/webroot/files/daily_reports/'.$filename,$filename);
			$mail->Body = "<table width='600' border='0' cellspacing='0' cellpadding='0' align='left'>
								<tr>
									<td>
										Dear ".$lab_id['Lab']['pcc_name']."
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
									<td>
										Visual Representation for the Request Data for Month from ".date('1-m-Y')." till - ".date('d-m-Y',strtotime($date))." can be viewed by clicking below link:- 
									</td>
								</tr>
								<tr>
									<td>
										URL - ".$pie_url."
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
								</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							
							<tr>
								<td>
									Thank you for choosing NirAmaya PathLabs. 
									<br/>
									<br/>
									"; 			
							$mail->Body .= "<br/>
									Please do not reply to this message. Replies to this message are routed to an unmonitored mailbox.
									<br/>
									kindly write back to helpline@niramayapathlabs.com or You may also call us at +91-7042191851
									<br/><br/>
									Best Regards,
									<br/>
									Lab Director
									<br/>it
									Niramaya Pathlabs
								</td>
							</tr>
						</table>
							";
			$mail->isHTML(true);
			//print_R($mail);die;
			print_R($lab_id['Lab']['pcc_name']);
			echo "--------------";
			print_R($mail->send());
			echo "<br>";
			
	}
	
	public function timezone()
	{
		$this->Timelabs = ClassRegistry::init('Timelabs');
		$timeslot = $this->Timelabs->find('list',array('fields'=>array('Timelabs.id','Timelabs.name')));
		
		foreach($timeslot as $val)
		{
			date_default_timezone_set("Asia/Calcutta");
			print_R(date_default_timezone_get());
			$slots = explode('-',$val);
			$current_date = strtotime(date('d-m-Y')." ".$slots[0]);
			echo "<br>";
			print_R(date('d-m-Y H:i:s',$current_date));
			echo "<br>";
			date_default_timezone_set("UTC");
			$timezone_date = date("Y-m-d\TH:i:s", $current_date);
			print_R(date_default_timezone_get());
			echo "<br>";
			print_R($timezone_date);
			echo "<br><br>";
		}
		die;
	}
	
	public function medimojo_api()
	{
		$this->Health = ClassRegistry::init("Health");
		$this->Lab = ClassRegistry::init("Lab");
		$this->Samplemaster = ClassRegistry::init("Samplemaster");
		$this->Billing = ClassRegistry::init('Billing');
		$this->City = ClassRegistry::init("City");
		$this->State = ClassRegistry::init("State");
		$this->Timelabs = ClassRegistry::init("Timelabs");
		$this->ProcessingLabs = ClassRegistry::init("ProcessingLabs");
		
		$today_date = date('Y-m-d');
		$today_date = date('Y-m-d',(strtotime ( '-1 days' , strtotime ( $today_date) ) ));
        
        $health_orders = $this->Health->query("SELECT *
			FROM healths
			WHERE s_date >= '".$today_date."' 
			AND requ_status in ('0','15','13','18')
			AND assigned_lab = '145'
			ORDER BY `healths`.`id` ASC
			LIMIT 0 , 50");
		//print_R($health_orders);die;
		
		$get_collection_time_info1 = Configure::read('TimeSlot');
		
		$labs = $this->Lab->find('list',array('fields'=>array('Lab.id','Lab.pcc_name')));
		$city = $this->City->find('list',array('fields'=>array('City.id','City.name')));
		$state = $this->State->find('list',array('fields'=>array('State.id','State.name')));
		$plab = $this->ProcessingLabs->find('list',array('fields'=>array('ProcessingLabs.id','ProcessingLabs.name')));
		$get_collection_time_info1 = $this->Timelabs->find('list',array('fields'=>array('Timelabs.id','Timelabs.name')));
		//print_R($plab);die;
		
		foreach($health_orders as $val)
		{
			//print_R($val);
			echo "<br>";
			$billingdetail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$val['healths']['id'])));
			
			$testRemarks = array();
			$testIds = array();
			$sampleType = array();
			//print_R($val['healths']['test_id']);
			$t_ids = explode(',',$val['healths']['test_id']);
			$this->Test = ClassRegistry::init('Test');
            $tests = $this->Test->find('all',array('conditions'=>array('Test.id '=>$t_ids)));
			//print_R($tests);die;
			/*$this->Package = ClassRegistry::init('Package');
            $packages = $this->Package->find('all',array('conditions'=>array('Package.package_code'=>$val['healths']['package_id'])));
			$this->Banner = ClassRegistry::init('Banner');
            $offer = $this->Banner->find('all',array('conditions'=>array('Banner.banner_code'=>$val['healths']['offer_id'])));*/
			
			$fasting_required = "";
			
			foreach($tests as $test_val)
			{
				array_push($testRemarks,$test_val['Test']['test_parameter']);
				array_push($testIds,array('testId'=>$test_val['Test']['id'],'testName'=>$test_val['Test']['test_parameter'],'price'=>$test_val['Test']['mrp']));
				
				if($test_val['Test']['fasting_required']!="NO" || $test_val['Test']['fasting_required']!=NULL || $test_val['Test']['fasting_required']!=" ")
					$fasting_required = 'Fasting';
				$samples = $this->Samplemaster->find('all',array('conditions'=>array('Samplemaster.sample_id'=>$test_val['Test']['sample'])));
				//print_R($samples);die;
				foreach($samples as $sample_val)
				{
					array_push($sampleType,array('sampleId'=>$sample_val['Samplemaster']['sample_id'],'sampleType'=>$sample_val['Samplemaster']['type']));
				}
			}
			
			/*foreach($packages as $pac_val)
			{
				array_push($testRemarks,$pac_val['Package']['test_parameter']);
				array_push($testIds,array('testId'=>$pac_val['Package']['id'],'price'=>$pac_val['Package']['mrp']));
			}
			
			foreach($offer as $offer_val)
			{
				array_push($testRemarks,$offer_val['Banner']['test_parameter']);
				array_push($testIds,array('testId'=>$offer_val['Banner']['id'],'price'=>$offer_val['Banner']['banner_mrp']));
			}*/
			
			$payment_type="";
			if($val['healths']['received_amount']==0 || $val['healths']['received_amount']=="")
			{
				$payment_type = 3;
			}
			
			if(($val['healths']['total_amount'] - $val['healths']['received_amount'])==0)
			{
				$payment_type = 1;
			}
			
			if($val['healths']['balance_amount']!=0 && $val['healths']['received_amount']!=0)
			{
				$payment_type = 2;
			}
			
			$emergency="";
			if($val['healths']['is_urgent']=='false')
				$emergency="No";
			else
				$emergency="Yes";
			
			$gender="";
			if($val['healths']['gender']=='1')
				$gender = "Male";
			else
				$gender = "Female";
			
			$data = array(
				"source"=> $labs[$val['healths']['created_by']],
				"processingLab"=>$plab[$val['healths']['processing_lab']],
				"collectionId"=> $val['healths']['reference'],
				"gender"=> $gender,
				"ageInYears"=> $val['healths']['age'],
				"patientId"=> $val['healths']['medical_reference_number'],
				"name"=> $val['healths']['name'],
				"mobile"=> $val['healths']['landline'],
				"phone"=> $val['healths']['mobile'],
				"collectionDate"=> date('Y-m-d',strtotime($val['healths']['sample_date1'])),
				"collectionTime"=> $get_collection_time_info1[$val['healths']['sample_time1']],
				"testRemarks"=> $testRemarks,
				"conditionStatus"=> $fasting_required,
				"closetCenter"=> $labs[$val['healths']['assigned_lab']],
				"netAmount"=> $val['healths']['total_amount'],
				"amountCollected"=> $val['healths']['received_amount'],
				"distance"=> "0",
				"visitNo"=> $billingdetail['Billing']['order_id'],
				"collectionCharges"=> "0",
				"paymentType"=> $payment_type,
				"amountToBeCollected"=> $val['healths']['total_amount'] - $val['healths']['received_amount'],
				"address"=> $val['healths']['address'],
				"locality"=> str_replace('_'," ",$val['healths']['locality']),
				"landmark"=> $val['healths']['landmark'],
				"pincode"=> $val['healths']['pincode'],
				"city"=> $city[$val['healths']['city_id']],
				"state"=> $state[$val['healths']['state']],
				"status"=> "Open",
				"isEmergency"=> $emergency,
				"testIds"=> $testIds,
				"sampleType"=> array_unique($sampleType, SORT_REGULAR)
			);
			//print_R(json_encode($data));die;
			$ch = curl_init();
			$curlConfig = array(
				CURLOPT_URL            => "https://niramaya.medimojo.co/api/v2/call-center-request",
				CURLOPT_POST           => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POSTFIELDS     => json_encode($data),
				CURLOPT_HTTPHEADER => array(
					"authorization: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTEsImVtYWlsIjoiYXBpLnBhdGhraW5kQHBhdGhraW5kbGFicy5jb20iLCJvcmdUeXBlIjoibGFiIiwidGltZSI6IjIwMTctMDktMThUMTg6MDQ6MjMuOTc2WiIsIm9yZ0lkIjoicGF0aGtpbmQiLCJpYXQiOjE1MDU3NTc4NjMsImV4cCI6MTUwNjM2MjY2M30.5vGZpr0jHT0fR9IjGE8wv3K5WNfWxZL-hKqS7qXOocQI",
					"cache-control: no-cache",
					"content-type: application/json"
				),
			);
			
			curl_setopt_array($ch, $curlConfig);
			$response = curl_exec($ch);
			
			$err = curl_error($ch);
			curl_close($ch);
			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
				echo "<br>".$response;
			  $this->Health->query('update healths set agent_id="83",requ_status=4,assigned_lab=124,lab_message="Medimojo Response - '.$response.'" where id="'.$val['healths']['id'].'"');
			}
			echo "<br><br>";
			//die;
		}
		die;
	}

	function smart_report()
	{
		$this->Health = ClassRegistry::init("Health");
		$this->Lab = ClassRegistry::init('Lab');
		$today_date = date('Y-m-d');
		$today_date = date('Y-m-d',(strtotime ( '-2 days' , strtotime ( $today_date) ) ));
        
        $smart_lab = $this->Lab->find('list',array('fields'=>array('Lab.id'),'conditions'=>array('Lab.auto_smart_report'=>1)));
        //print_R(implode(',',$smart_lab));die;

        $health_orders = $this->Health->query("SELECT *
			FROM healths
			WHERE 
			s_date >= '".$today_date."'
			AND requ_status = '6'
			AND created_by in (".implode(',',$smart_lab).")
			AND smart_report in (NULL,'')
			AND test_id NOT IN (120039,120042,120045)
			AND profile_id NOT IN (120014,120015,120016,120017)
			ORDER BY `healths`.`id` ASC");
			
			////'".$today_date."' 

			//s_date >= '".$today_date."' 
			//AND requ_status = '6'
			//AND created_by in ('11124','11122','31') '31','11122',

		$smart_report_count = 0;
		foreach($health_orders as $val)
		{
			print_R($val['healths']['id']);
			$this->Healthlabmateresponse = ClassRegistry::init('Healthlabmateresponse');
			$healthlabmate = $this->Healthlabmateresponse->find('first',array('conditions'=>array('Healthlabmateresponse.health_id'=>$val['healths']['id'])));
			//print_R($healthlabmate);		
			if(!empty($healthlabmate['Healthlabmateresponse']['json_data']))
			{
				$this->Billing = ClassRegistry::init('Billing');
	                        
	            $checkdata = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$val['healths']['id'])));
	            //print_R($checkdata);die;

				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://q2j8fegpu4.execute-api.ap-south-1.amazonaws.com/test/npl",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => json_encode($healthlabmate['Healthlabmateresponse']['json_data']),
				  CURLOPT_HTTPHEADER => array(
					"Content-Type: application/json"
				  ),
				));

				$response = curl_exec($curl);
							
				$string = str_replace('"','', $response);
							
				if($string!="no smart report")
				{
					$this->Health->query('update healths set smart_report="'.$string.'" where id="'.$val['healths']['id'].'"');
					echo "<br>";

					$new_url = $this->get_tiny_url($string);
					$auth_report = $this->get_tiny_url($val['healths']['patient_report_with_header']);

					$message = 'Your Smart Report for '.$checkdata['Billing']['order_id'].' for '.$val['healths']['name'].' dated '.date('d-m-Y',strtotime($val['healths']['s_date'])).' is ready & can be viewed on '.$new_url.' along with Authorised report '.$auth_report.' Niramaya Pathlabs +91-9555009009';

					if($labdata['Lab']['send_sms_to_patient'] == 1)
					{
						$messageurl =  urlencode($message);
						$url_sms1='http://103.233.79.246//submitsms.jsp?user=nirAmaya&key=e2ceeba388XX&mobile='.$val['healths']['landline'].'&message='.$messageurl.'&senderid=NHCare&accusage=1';

						$ch_sms = curl_init();
						curl_setopt($ch_sms, CURLOPT_URL, $url_sms1);
						curl_setopt($ch_sms, CURLOPT_FOLLOWLOCATION, TRUE);
						curl_setopt($ch_sms, CURLOPT_MAXREDIRS, 3);
						curl_setopt($ch_sms, CURLOPT_RETURNTRANSFER, TRUE);
						$data_sms = curl_exec($ch_sms);
					}
					$smart_report_count++;
				}
			}
		}
		echo "<br>";
		print_R($smart_report_count." Smart Reports Fetched");
		die;
	}

	public function serviced_by_api()
	{
		$this->Health = ClassRegistry::init("Health");
		$this->Lab = ClassRegistry::init('Lab');
		$today_date = date('Y-m-d');
		$today_date = date('Y-m-d',(strtotime ( '-2 days' , strtotime ( $today_date) ) ));
        
        $health_orders = $this->Health->query("SELECT *
			FROM healths
			WHERE s_date >= '".$today_date."' 
			AND requ_status in ('0','15','13','18')
			ORDER BY `healths`.`id` ASC
		");
		
		//print_R($health_orders);die;
		foreach($health_orders as $val)
		{
			$lab_data = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$val['healths']['assigned_lab'])));
			
			if($lab_data['Lab']['serviced_by_api']!=0)
			{
				$lab = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$val['healths']['assigned_lab'])));

				$this->ServicedByApi = ClassRegistry::init('ServicedByApi');
				$sba = $this->ServicedByApi->find('first',array('conditions'=>array('ServicedByApi.id'=>$lab['Lab']['serviced_by_api'])));
				$this->Utility->$sba['ServicedByApi']['api_url']($val['healths']['id'],$lab_data['Lab']['pcc_name'],"cron");
			}
		}
		die;
	}	

	function billing_detail()
	{
		$this->_health_table_id = '337525';

		$this->JsonData = ClassRegistry::init('JsonData');
		$json = $this->JsonData->find('first',array('conditions'=>array("JsonData.health_id"=>$this->_health_table_id)));
		
		$this->_request = json_decode($json['JsonData']['request_data']);
		
		$this->RequestTest = ClassRegistry::init('RequestTest');
		$request_test = $this->RequestTest->query("select Group_concat(test_id) as test_id,sum(mrp) as total_amt from request_test where health_id='".$this->_health_table_id."'");
		
		$this->_test_ids = explode(",",$request_test[0][0]['test_id']);
		$this->_request->net_amount = $request_test[0][0]['total_amt'];
		
		$this->updateHealth();
            
        $result = $this->createBilling();

		$this->lab = ClassRegistry::init("Lab");
		$labs = $this->lab->find('first',array('conditions'=>array('Lab.id'=>$this->_lab_id)));
		
		if($this->_request->payment_type==1 || $this->_request->payment_type == 2)
		{
			$this->paydata['Paytrack']['c_number'] = '';
			$this->paydata['Paytrack']['pay_mode'] = 'paymenttopcc';
			$this->paydata['Paytrack']['pay_install'] = !empty($this->_request->amount_collected) ? $this->_request->amount_collected :'0';
			$this->paydata['Paytrack']['remarks'] = "Amount  Rs. ".$this->_request->amount_collected.' Received by '.$labs['Lab']['pcc_name'].' at the time of Booking ';
			$this->paydata['Paytrack']['type'] = 'Receive';
			$this->paydata['Paytrack']['admin_id'] = 1;
			
			$this->paydata['Paytrack']['request_id'] = $this->_health_table_id;
			$this->paydata['Paytrack']['receive_date'] = date('Y-m-d H:i:s');
			$this->Paytrack = ClassRegistry::init('Paytrack');
					$this->Paytrack->create();
			$this->Paytrack->save($this->paydata);
		}
		print_R($this->_order_id);die;
	}

	private function updateHealth()
        {
        	//print_R("update health");die;
            $this->Health = ClassRegistry::init('Health');
			$this->Lab = ClassRegistry::init('Lab');
			
            if(count($this->_test_ids) > 0)
            {
                $this->_test_ids = implode(",",$this->_test_ids);
            }
            else
            {
                $this->_test_ids = "";
            }
            if(count($this->_profile_ids) > 0)
            {
                $this->_profile_ids = implode(",",$this->_profile_ids);
            }
            else
            {
                $this->_profile_ids = "";
            }
            if(count($this->_service_ids) > 0)
            {
                $this->_service_ids = implode(",",$this->_service_ids);
            }
            else
            {
                $this->_service_ids = "";
            }
            if(count($this->_package_ids) > 0)
            {
                $this->_package_ids = implode(",",$this->_package_ids);
            }
            else
            {
                $this->_package_ids = "";
            }
            if(count($this->_banner_ids) > 0)
            {
                $this->_banner_ids = implode(",",$this->_banner_ids);
            }
            else
            {
                $this->_banner_ids = "";
            }
            
            if(!empty($this->data['Health']['discount_amount']) && $this->data['Health']['discount_amount'] >0)
            {
                $this->_order_total_amt -= $this->data['Health']['discount_amount'];
            }
			
			$health = $this->Health->find('first',array('conditions'=>array('Health.id'=>$this->_health_table_id)));
			
			$lab = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$health['Health']['created_by'])));
			
			if(isset($this->_request->net_amount))
            	$this->_order_total_amt = $this->_request->net_amount;
			
			if($health['Health']['received_amount']==0 || $health['Health']['received_amount']=="")
			{
				$this->data['Health']['payment_type'] = 3;
				$this->data['Health']['amount_to_be_collected'] = $this->_request->amount_to_be_collected;

				$this->data['Health']['amount_collected'] = $health['Health']['received_amount'];
			}
			
			if(($health['Health']['total_amount'] - $health['Health']['received_amount'])==0)
			{
				$this->data['Health']['payment_type'] = 1;
				$this->data['Health']['amount_to_be_collected'] = $health['Health']['balance_amount'];
				$this->data['Health']['amount_collected'] = $this->_request->net_amount;
			}
			
			if($health['Health']['balance_amount']!=0 && $health['Health']['received_amount']!=0)
			{
				$this->data['Health']['payment_type'] = 2;
				$this->data['Health']['amount_to_be_collected'] = $health['Health']['balance_amount'];
				$this->data['Health']['amount_collected'] = $health['Health']['received_amount'];
			}
			
			$this->data['Health']['id'] = $this->_health_table_id;
			$this->data['Health']['test_id'] = $this->_test_ids;
			$this->data['Health']['profile_id'] = $this->_profile_ids;
			$this->data['Health']['package_id'] = $this->_package_ids;
			$this->data['Health']['offer_id'] = $this->_banner_ids;
			$this->data['Health']['service_id'] = $this->_service_ids;
			$this->data['Health']['total_amount'] = $this->_order_total_amt;
			
			if(!$this->Health->save($this->data))
			{
				echo 'Health Updation Failed';die;
			}
            
            $health = $this->Health->find('first',array('conditions'=>array('Health.id'=>$this->_health_table_id)));
			$this->_user_table_id = $health['Health']['user_id'];
			if($lab['Lab']['auto_btc']==1)
			{
				$this->Paytrack = ClassRegistry::init('Paytrack');
				$this->Paytrack->create();
				
				$this->data1['Paytrack']['type'] = 'Receive';
				$this->data1['Paytrack']['admin_id'] = 1;
				$this->data1['Paytrack']['request_id'] = $health['Health']['id'];
				$this->data1['Paytrack']['pay_mode'] = "btcnopayment";
				$this->data1['Paytrack']['pay_install'] = $this->_request->net_amount;
				$this->data1['Paytrack']['c_number'] = '';
				//print_R($this->data1);die;
				if(!$this->Paytrack->save($this->data1))
				{
					echo 'Payment Data Incomplete'; die;	
				}
				
				if(isset($this->_request->net_amount))
				{
					$update_amt = $this->Health->query("UPDATE healths SET amount_collected='".$this->_request->net_amount."',amount_to_be_collected='0',received_amount='".$this->_request->net_amount."',balance_amount='0',btc_no_payment_remark=''".",pay_status='1',btc_no_payment_bill_to_company='".$lab['Lab']['pcc_name']."',last_edited_date='".date('Y-m-d H:i:s')."' WHERE id='".$health['Health']['id']."'");
				}
				else
				{
					$update_amt = $this->Health->query("UPDATE healths SET amount_collected='".$health['Health']['total_amount']."',amount_to_be_collected='0',received_amount='".$health['Health']['total_amount']."',balance_amount='0',btc_no_payment_remark=''".",pay_status='1',btc_no_payment_bill_to_company='".$lab['Lab']['pcc_name']."',last_edited_date='".date('Y-m-d H:i:s')."' WHERE id='".$health['Health']['id']."'");
				}

			}
        }
        
        private function createBilling()
        {
        	//print_R("create billing");die;
        	$this->Health = ClassRegistry::init('Health');
        	$this->data = $this->Health->find('first',array('conditions'=>array('Health.id'=>$this->_health_table_id)));

        	$this->User = ClassRegistry::init('User');
        	$this->data1 = $this->User->find('first',array('conditions'=>array('User.id'=>$this->_user_table_id)));

            $this->Billing = ClassRegistry::init('Billing');
            $data = $this->Billing->find('first',array('fields'=>array('Billing.order_id'),'order'=>array('Billing.id DESC')));
            $this->_order_id = $data['Billing']['order_id']+1;
            
            $checkdata = $this->Billing->find('first',array('conditions'=>array('Billing.order_id'=>$this->_order_id)));

            if(isset($checkdata['Billing']['order_id']))
            {
            	$this->_order_id = $checkdata['Billing']['order_id']+1;
            }

            print_R($this->_test_ids);

            $this->data['Billing']['order_id'] = $this->_order_id;
            $this->data['Billing']['request_id'] = $this->_health_table_id;
            $this->data['Billing']['user_id'] = $this->_user_table_id;
            $this->data['Billing']['test_id'] = $this->_test_ids;
            $this->data['Billing']['profile_id'] = $this->_profile_ids;
            $this->data['Billing']['offer_id'] = $this->_banner_ids;
            $this->data['Billing']['package_id'] = $this->_package_ids;
            $this->data['Billing']['service_id'] = $this->_service_ids;
            $this->data['Billing']['first_name'] = $this->data1['User']['name'];
            $this->data['Billing']['contact'] = $this->data['Health']['landline'];
            $this->data['Billing']['address'] = $this->data['Health']['address'];
            $this->data['Billing']['locality'] = $this->data['Health']['locality'];
            $this->Pincodemaster = ClassRegistry::init("PincodeMaster");
            $this->data['Billing']['zip'] = $this->data['Health']['pincode'];
            if($this->data['Health']['pincode'])
            {
            	$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$this->data['Health']['pincode'])));
            	$this->data['Billing']['city'] = $pincodeMaster['PincodeMaster']['city'];
            	$this->data['Billing']['state'] = $pincodeMaster['PincodeMaster']['state'];	
            }
            else{
            	$this->data['Billing']['city'] = !empty($this->_request->city) ? $this->_request->city :'0';
            	$this->data['Billing']['state'] = !empty($this->_request->state) ? $this->_request->state :'0';	
            }
            $this->data['Billing']['landmark'] = $this->data['Health']['landmark'];
            $this->data['Billing']['book_date'] = date('Y-m-d H:i:s');
            if(isset($this->_request->net_amount))
            	$this->_order_total_amt = $this->_request->net_amount;
            $this->data['Billing']['sub_total'] = $this->_order_total_amt;
            $this->Billing->create();
            
            print_R($this->data);

            if(!$this->Billing->save($this->data))
            {
            	echo 'Incomplete Billing Data';	
            }

			$number = $this->data['Health']['landline'];
			
			$get_collection_time_info1 = Configure::read('TimeSlot.'.$this->data['Health']['sample_time1']);
			
			$this->Lab = ClassRegistry::init('Lab');
			$labdata = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$this->data['Health']['created_by'])));
			//return $data['Lab']['send_sms_to_patient'];
			$message = 'Thank you for booking your tests with nirAmaya. Req. No:'.$this->_order_id.' on '.$this->data['Health']['sample_date1'].' '.$get_collection_time_info1.' for Booked By '.$labdata['Lab']['pcc_name'].'.  For any Assistance call 9555009009 or visit www.NHcare.in ';

			if($labdata['Lab']['send_sms_to_patient'] == 1)
			{
				$messageurl =  urlencode($message);
				$url_sms1='http://103.233.79.246//submitsms.jsp?user=nirAmaya&key=e2ceeba388XX&mobile='.$number.'&message='.$messageurl.'&senderid=NHCare&accusage=1';

				$ch_sms = curl_init();
				curl_setopt($ch_sms, CURLOPT_URL, $url_sms1);
				curl_setopt($ch_sms, CURLOPT_FOLLOWLOCATION, TRUE);
				curl_setopt($ch_sms, CURLOPT_MAXREDIRS, 3);
				curl_setopt($ch_sms, CURLOPT_RETURNTRANSFER, TRUE);
				$data_sms = curl_exec($ch_sms);
			}
			
			/*if($labdata['Lab']['send_whatsapp_to_patient'] == 1)
			{
				$ch = curl_init();
				$curlConfig = array(
					CURLOPT_URL => "https://www.wtsapi.com/api/sendQuickMsg?token=ef6e126a849b23e7257f12593c076b3c66b602fe30b26c61af&phone=91".$number."&type=text&message=".urlencode($message),
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_USERAGENT => 'wtsapi',
				);
				curl_setopt_array($ch, $curlConfig);
			}*/
        }

        function callhealth_email()
        {
            //echo "send report";
            $this->Health = ClassRegistry::init('Health');
            $healthdata = $this->Health->find('all',array('conditions'=>array('Health.created_by'=>'153','Health.s_date'=>'2020-03-07','Health.requ_status'=>'6','Health.entry_status'=>0)));
            //print_R($healthdata);die;
            foreach($healthdata as $val)
            {
            	print_R($val['Health']['id']."----------");
				$this->writelog($val['Health']['id']);
				$this->RequestTest = ClassRegistry::init('RequestTest');
				$this->RequestTest->updateAll(array('RequestTest.reporting_status'=>1),array('RequestTest.health_id'=>$val['Health']['id']));
				
				$test_status = $this->Utility->get_test_completed_status($val['Health']['id']);
				
                $this->Health = ClassRegistry::init('Health');
                $this->Health->bindModel(array('belongsTo'=>array(
                    'Lab'=>array(
                        'className'=>'Lab',
                        'foreignKey'=>'created_by'
                    )),
                    'hasOne'=>array(
                        'Billing'=>array(
                        'className'=>'Billing',
                        'foreignKey'=>'request_id'
                    )
                )));
                $req_info = $this->Health->find('first',array('conditions'=>array('Health.id'=>$val['Health']['id'])));
                
                if (strpos($req_info['Health']['patient_report'], 'http:') !== false || strpos($req_info['Health']['patient_report'], 'https:') !== false) { 
					file_put_contents("/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf",file_get_contents($req_info['Health']['patient_report']));
					$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf";
				}
				else{
					$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/".$req_info['Health']['patient_report'];			
				}
			//print_R($dec_rep_name);die;
                $pdf = new FPDI();
                // echo "send report 1";
                $pdf->addPage();
                $pagecount = $pdf->setSourceFile($dec_rep_name);
								
				$lab_info_booked = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$req_info['Health']['created_by'])));
				//print_R(json_encode($lab_info_booked));die;
				$header_image='';
				
                if($lab_info_booked['Lab']['custom_header_status']=='1')
					$header_image = '/files/header/'.$lab_info_booked['Lab']['custom_header'];
				else
					$header_image = '/fpdf/nirAmaya_Report_Header.jpg';
				
				//rint_R(json_encode($header_image));		die;		
                for ($i=1; $i <= $pagecount; $i++) {
                    $tplidx = $pdf->ImportPage($i);
                    $pdf->useTemplate($tplidx,0,0,0);
                    $pdf->Image('/home2/niramovh/public_html/app/webroot'.$header_image,0,0,$pdf->w,30);
                    //$pdf->Image('/home/wwwdemoi/public_html/NH/app/webroot/fpdf/footer.jpg',10,273,196,6.5);
                    if($i != $pagecount)
                    {
                            $pdf->addPage();
                    }
                }
				
                $pdf->Output("/home2/niramovh/public_html/app/webroot/report_mail.pdf", "F");

                 //echo "send report 2";
				if(!empty($req_info['Health']['patient_report_with_header']))
					$new_url = $this->get_tiny_url($req_info['Health']['patient_report_with_header']);
				/*start of sending email*/
                $mrn='';
                if(isset($req_info['Health']['medical_reference_number']))
				    $mrn = $req_info['Health']['medical_reference_number'];
				$email_stage = 'complete';
				$this->writelog("\n");
				$this->writelog("crmo@callhealth.com,sourabh.singh@callhealth.com");
				$this->writelog("\n");
				$this->writelog(date("Y-m-d h:i:s"));
				$this->writelog("\n");
				$mail = new PHPMailer(); // create a new object
				//				print_R(json_encode($mail));die;
				$mail->IsSMTP(); // enable SMTP
				$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
				$mail->SMTPAuth = true; // authentication enabled
				$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
				$mail->Host = "smtp.gmail.com";
				$mail->Port = 465; // or 587
				$mail->IsHTML(true);
				$mail->setFrom('lab.reports@niramayapathlabs.com', 'NirAmaya PathLabs');
				$mail->AddAddress('crmo@callhealth.com', 'Callhealth');
				$mail->addCC('sourabh.singh@callhealth.com', 'Callhealth');
				//$mail->addCC($req_info['Lab']['pcc_email'], $req_info['Lab']['pcc_name']);
				
				$mail->Username = 'lab.reports@niramayapathlabs.com';
				$mail->Password = 'Lab@Reports';
								//print_R(json_encode($mail));die;
				$mail->Subject = "Complete Report of ".strtoupper($req_info['Health']['name']).' MRN-'.$mrn;
				$mail->addAttachment(WWW_ROOT . 'report_mail.pdf','report.pdf');
				$mail->Body = "<table width='600' border='0' cellspacing='0' cellpadding='0' align='left'>
									<tr>
										<td>
											Dear ".$req_info['Health']['name']."
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;
										</td>
									</tr>
									<tr>
										<td>
											Bill Date: ".date('d M Y',strtotime($req_info['Health']['s_date'])).' T'.date('H:i:s',strtotime($req_info['Health']['book_date']))."
										</td>
									</tr>
									<tr>
										<td>
											Bill Number: ";
											$mail->Body .= 'NPL'.!empty($req_info['Health']['ref_num'])?$req_info['Health']['ref_num'] : $req_info['Billing']['order_id'];
											$mail->Body .="
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;
										</td>
									</tr>
									<tr>
									<td>
										Completed Tests:
										<ul style='list-style:none; margin:0px; padding:0px;'>";
										 
											$pending_test_count = 0;
											foreach($test_status as $key=>$value)
											{
												if($value['reporting_status'] == 1)
												{
													$mail->Body .= "<li style='margin:0px;'>*".$value['test_name']."</li>";
												}
												else
												{
													$pending_test_count++;
												}
											}
										$mail->Body .="
										</ul>
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
									<td>";
										$mail->Body .= "Pending Tests: <br/>";
										if($pending_test_count == 0){
										$mail->Body .= "*No Pending Tests.";
										} else {
										$mail->Body .= "<ul style='list-style:none; margin:0px; padding:0px;'>";
										
											foreach($test_status as $key=>$value)
											{
												if($value['reporting_status'] == 0)
												{
													$mail->Body .= "<li style='margin:0px;'>*".$value['test_name']."</li>";
												}
											}
										
										$mail->Body .= "</ul>";
										 }
									$mail->Body .= "</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
								</tr>";
								
								if(!empty($new_url))
								{
									$this->Billing = ClassRegistry::init('Billing');
									$get_req_number = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$req_info['Health']['id'])));
									
									$balance = $req_info['Health']['total_amount'] - $req_info['Health']['recieved_amount'];
									$payment_link = $this->get_tiny_url("https://www.niramayahealthcare.com/home/checkbalance/".base64_encode($req_info['Health']['id']));
									
									if($req_info['Health']['balance_amount'] <= 0)
									{
										$mail->Body .= "<tr>
										<td>
											You can view your report here - ".$new_url."
										</td>
									</tr>";
									}
									else
									{
										$mail->Body .= "<tr>
										<td>
											As your payment of Rs.".$balance." is still due. kindly pay it using following link - ".$payment_link." To view Your Reports.
										</td>
									</tr>";
									}
								}
								
								$mail->Body .= "<tr>
									<td>
										&nbsp;
									</td>
								</tr>
								
								<tr>
									<td>
										Thank you for choosing NirAmaya PathLabs. 
										<br/>
										<br/>
										"; 
										if(!empty($req_info['Health']['partial_reason']) && $email_stage =='partial'){
											$mail->Body .= "Note:- ".$req_info['Health']['partial_reason'];
										}
										
										$mail->Body .= "<br/>
										Please do not reply to this message. Replies to this message are routed to an unmonitored mailbox.
										<br/>
										kindly write back to helpline@niramayapathlabs.com or You may also call us at +91-7042191851
										<br/><br/>
										Best Regards,
										<br/>
										Lab Director
										<br/>
										Niramaya Pathlabs
									</td>
								</tr>
							</table>
								";

				$mail->isHTML(true);
				//print_R($mail);die;
				if(!$mail->send()) {
					$this->writelog("Email Not Sent");
					$this->writelog("\n");
					$this->writelog("----------------------------------------------------------------------------------------------------");
					print_R("Email Not Sent");
					$this->_activity_log($req_info['Health']['user_id'], $req_info['Health']['id'],"Error Sending Report");
				} else {
					$this->writelog("Email Sent!");
					$this->writelog("\n");
					$this->writelog("----------------------------------------------------------------------------------------------------");

					$this->_activity_log($req_info['Health']['user_id'],$req_info['Health']['id'],"Report has been mailed on '".$req_info['Health']['email']."','".$req_info['Lab']['pcc_email']."'");
					print_R("Email Sent <br>");
					$this->Health->query("update healths set entry_status=1 where id='".$val['Health']['id']."'");
				}
				//die;
				/*end of sending mail*/
			}
            die;
        }

    function writelog_p($content){
		$file = '/home2/niramovh/public_html/app/webroot/files/log/panasoniclog.txt';
		file_put_contents($file,$content, FILE_APPEND);
	}

	function panasonic_result()
	{
		$id="361098";
		$this->send_report_whatsapp($id);
		/*$this->writelog_p(PHP_EOL );
		$this->writelog_p(date('d-m-Y h:i:s'));
		$this->writelog_p(PHP_EOL );
		$this->writelog_p($id);
		$this->writelog_p(PHP_EOL );
		$this->writelog_p('entry to panasonic result');
		$this->writelog_p(PHP_EOL );
		$this->Test = ClassRegistry::init('Test');
		$this->Package = ClassRegistry::init('Package');
		$this->Banner = ClassRegistry::init('Banner');
		
		$this->Health = ClassRegistry::init('Health');
		$health = $this->Health->find('first',array('conditions'=>array('Health.id'=>$id),'order'=>array('id'=>'DESC')));
		$this->User = ClassRegistry::init('User');
		$user = $this->User->find('first',array('conditions'=>array('User.id'=>$health['Health']['user_id']),'order'=>array('id'=>'DESC')));
		$this->City = ClassRegistry::init('City');
		$city = $this->City->find('first',array('conditions'=>array('City.id'=>$user['User']['city']),'order'=>array('id'=>'DESC')));
		$this->State = ClassRegistry::init('State');
		$state = $this->State->find('first',array('conditions'=>array('State.id'=>$health['Health']['state']),'order'=>array('id'=>'DESC')));
		
		$this->Billing = ClassRegistry::init('Billing');
		$billing_detail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$id)));
		
		$dateTime = explode(" ",$health['Health']['sample_collected_date']);
		$date =  date('d-m-Y',strtotime($dateTime[0]));
		$s_date_new = $dateTime[0];
		$datetime = $dateTime[1];

		$test_list = explode(',',$health['Health']['test_id']);
		$profile_list = explode(',',$health['Health']['profile_id']);
		$service_list = explode(',',$health['Health']['service_id']);
		$package_list = explode(',',$health['Health']['package_id']);
		$offer_list = explode(',',$health['Health']['offer_id']);
		
		$testList = array();
		$testnamelist = array();
		$count = 0;
		if(!empty($health['Health']['test_id']))
		{
			foreach($test_list as $key=>$val)
			{
				if(!empty($val))
				{
					$test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
					$testList[$count] = $test_detail['Test']['testcode'];
					$testnamelist[$count] = $test_detail['Test']['test_parameter'];
					$count++;
				}
			}
		}
		if(!empty($health['Health']['profile_id']))
		{
			foreach($profile_list as $key=>$val)
			{
				if(!empty($val))
				{
					$test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
					$testList[$count] = $test_detail['Test']['testcode'];
					$testnamelist[$count] = $test_detail['Test']['test_parameter'];
					$count++;
				}
			}
		}
		if(!empty($health['Health']['service_id']))
		{
			foreach($service_list as $key=>$val)
			{
				if(!empty($val))
				{
					$test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
					$testList[$count] = $test_detail['Test']['testcode'];
					$testnamelist[$count] = $test_detail['Test']['test_parameter'];
					$count++;
				}
			}
		}
		if(!empty($health['Health']['package_id']))
		{
			foreach($package_list as $key=>$val)
			{
				if(!empty($val))
				{
					$test_detail = $this->Package->find('first',array('conditions'=>array('Package.id'=>$val)));
					$testList[$count] = $test_detail['Package']['package_code'];
					$testnamelist[$count] = $test_detail['Package']['package_name'];
					$count++;
				}
			}
		}
		if(!empty($health['Health']['offer_id']))
		{
			foreach($offer_list as $key=>$val)
			{
				if(!empty($val))
				{
					$test_detail = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$val)));
					$testList[$count] = $test_detail['Banner']['banner_code'];
					$testnamelist[$count] = $test_detail['Banner']['banner_name'];
					$count++;
				}
			}
		}
		
		$date=date('Y/m/d', strtotime($s_date_new))." ".$datetime;
		
		if($health['Health']['gender']==2)
			$gender = 'Female';
		else
			$gender = 'Male';
		$email = $user['User']['email'];
		if(empty($email))
			$email = ".";
		$last_name = $user['User']['last_name'];
		if(empty($last_name)&& $last_name=='')
			$last_name = '.';
		$data = array(
			"FirstName"=> $health['Health']['name'],
			"LastName"=>".",
			"Gender"=> $gender,
			"ContactNumber"=> $health['Health']['landline'],
			"Age"=> $health['Health']['age'],
			"Address"=> $health['Health']['address'],
			"Locality"=>$health['Health']['address1'],
			"City"=>$city['City']['name'],
			"State"=>$state['State']['name'],
			"ZipCode"=> $health['Health']['pincode'],
			"Landmark"=> $health['Health']['landmark'],
			"SampleCollectionDate"=> $date,
			"OrderReference"=> $health['Health']['reference'],
			"Email"=>$email,
			"DiscountAmount"=> $health['Health']['discount_amount'],
			"Remark"=> $health['Health']['discount_amount_reason'],
			"TestCode"=> implode(',',$testList),
			"MRN"=> $health['Health']['medical_reference_number'],
			"OrderID"=> $billing_detail['Billing']['order_id'],
			"OrderAmount"=> $billing_detail['Billing']['sub_total'],
			"TestName"=>implode(',',$testnamelist),
			"ReportUrl"=>$health['Health']['patient_report_with_header'],
			"ReportStatus"=>$health['Health']['report_type'],
			"ReportID"=>$health['Health']['ref_num']
		);
		
		$this->writelog_p(json_encode($data));
		$this->writelog_p(PHP_EOL );

		$formattedData = '';
		foreach($data as $key=>$val){
			if($formattedData=='')
				$formattedData= $key."=".$val;
			else
				$formattedData.= "&".$key."=".$val;
		}
	    $ch = curl_init();
		$curlConfig = array();
		$curlConfig = array(
			CURLOPT_URL            => "http://janaidapi.janaid.com/api/AddLabOrderWithReport",
			CURLOPT_POST           => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYHOST=>false,
			CURLOPT_SSL_VERIFYPEER=>false,
			CURLOPT_POSTFIELDS     => $formattedData,
			CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/x-www-form-urlencoded",
			"merchant_key:PkloNirAmaya@09242018",
			),
		);     
		curl_setopt_array($ch, $curlConfig);
		$callHealthResult = curl_exec($ch);
		curl_close($ch);
		
		$this->writelog_p($callHealthResult);
		$this->writelog_p(PHP_EOL );
		$this->writelog_p('----------------------------------------------------------------------------------------------------------------------------------------');
		$this->writelog_p('----------------------------------------------------------------------------------------------------------------------------------------');
*/
		die;//return $callHealthResult;
	}

	function populate_itdose()
	{
		print_R("hello");
		$this->ItdoseTable = ClassRegistry::init("ItdoseTable");
		$this->Health = ClassRegistry::init('Health');
		$this->Billing = ClassRegistry::init('Billing');

		$itdose = $this->ItdoseTable->find('all',array('conditions'=>array('ItdoseTable.is_done'=>0),'limit'=>1000)); //
		//print_R($itdose);die;
		foreach($itdose as $val)
		{
			$health = $this->Health->find('first',array('conditions'=>array('Health.reference'=>$val['ItdoseTable']['order_id'])));
			//print_R($val);
			if($health)
			{
				$order = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$health['Health']['id'])));

				//echo $val['ItdoseTable']['id'].",".$health['Health']['ref_num'].",".$health['Health']['name'].",".$health['Health']['age'].",".$health['Health']['gender'].",".$val['ItdoseTable']['order_id'].",".$val['ItdoseTable']['mrn'].",".$order['Billing']['order_id']."<br>";
				$this->ItdoseTable->query('update itdose_table set is_done=1,request_no="'.$order['Billing']['order_id'].'",lab_no="'.$health['Health']['ref_num'].'" where order_id="'.$val['ItdoseTable']['order_id'].'"');
			}
			else
			{
				//echo $val['ItdoseTable']['id'].",".$val['ItdoseTable']['lab_no'].",".$val['ItdoseTable']['pname'].",".$val['ItdoseTable']['age'].",".$val['ItdoseTable']['gender'].",".$val['ItdoseTable']['order_id'].",".$val['ItdoseTable']['mrn'].",0<br>";
				$this->ItdoseTable->query('update itdose_table set is_done=1 where order_id="'.$val['ItdoseTable']['order_id'].'"');
			}
		}
		die;
	}

	function check_digital_data($req_id='530338')
	{
		//print_R(json_decode($healthlabmate['Healthlabmateresponse']['json_data']));
		$this->send_receipt($req_id);
		die;
	}

	function cancel_pending_request()
	{
		$this->Health = ClassRegistry::init("Health");
		$today_date = date('Y-m-d');
        
        $health_orders = $this->Health->query("SELECT *
			FROM healths
			WHERE requ_status = 22
			ORDER BY `healths`.`id` ASC
			LIMIT 0 , 50");
			
		$this->Lab = ClassRegistry::init("Lab");
		//print_R($health_orders);die;
		foreach($health_orders as $val)
		{
			$this->Health->query('UPDATE healths set requ_status=8 where id="'.$val['healths']['id'].'"');
		}
		die;
	}

	function check_api()
	{
		//echo phpinfo();die;
		$curl = curl_init();
		$verbose = fopen('error-curl.txt', 'w+'); 

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://lis.niramayapathlabs.com/live/design/jsonreceive/SampleStatus.aspx",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_VERBOSE => true,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_STDERR => $verbose,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>"{\"APIKey\":\"WL5VT6LN5D3ZPX04\",\"APIUser\":\"Z34EC4C0C5PTD5WS\",\"CenterID\":\"C141\",\"Order_id\":\"1014-MT01734\",\"MRN_Id\":\"8595400567\"}",
		  CURLOPT_HTTPHEADER => array(
		    "Content-Type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		if ( $response === FALSE ) {
			echo "curl info : "; 
			print_R(curl_getinfo($curl));
            echo "curl_exec returns FALSE <br/>";
            echo "curl_error is :" . curl_error($curl) . " <br/>";
 
            rewind($verbose);
            $verboseLog = stream_get_contents($verbose);
            echo "Verbose information:<br/><pre>" . htmlspecialchars($verboseLog) .  "</pre><br/> ";
        }
        fclose($verbose);

		curl_close($curl);
		echo $response;
die;

	}


	function send_receipt($req_id=NULL)
	{
		$file = '/home2/niramovh/public_html/app/webroot/files/log/sendnotification.txt';
		file_put_contents($file,date('Y-m-d H:i:s'), FILE_APPEND);

		$this->Health = ClassRegistry::init("Health");
		$this->Health->bindModel(array(
			'hasOne'=>array(
				'Billing'=>array(
				'className'=>'Billing',
				'foreignKey'=>'request_id',
				'fields'=>array('Billing.order_id')
				)
			)
		));
		$data = $this->Health->find("first",array('conditions'=>array('Health.id'=>$req_id)));	
		$lab_data = $this->Lab->find("first",array('conditions'=>array('Lab.id'=>$data['Health']['created_by'])));

		$statusdata['order_id'] = $data['Billing']['order_id'];
		$statusdata['reference_id'] = $data['Health']['reference'];
		$statusdata['request_status'] = 'Receipt Generated';
		$statusdata['authorization'] = $lab_data['Lab']['auth_code_notification'];
		$statusdata['receipt_url'] = SITE_URL.'tests/print_user_receipt_new/'.base64_encode($data['Health']['id']).'/'.base64_encode($data['Billing']['order_id']);
		
		file_put_contents($file,json_encode($statusdata)."\n", FILE_APPEND);
		
		$ch = curl_init();
		$curlConfig = array(
			CURLOPT_URL            => $lab_data['Lab']['call_url_notification'],
			CURLOPT_POST           => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS     => json_encode($statusdata),
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json"
			),
		);

		curl_setopt_array($ch, $curlConfig);
		
		$result = curl_exec($ch);

		file_put_contents($file,$result, FILE_APPEND);
		file_put_contents($file,"\n\n", FILE_APPEND);
		
		//print_R(curl_error($ch));
		if(curl_error($ch))
		{
			print_R(curl_error($ch));die;
		}
	}
	/*function request_test()
	{
		$health_id = '546867';
		$this->Health = ClassRegistry::init('Health');
		$this->Test = ClassRegistry::init('Test');
		$this->RequestTest = ClassRegistry::init('RequestTest');
		$healthdata = $this->Health->find('first',array('conditions'=>array('Health.id'=>$health_id)));

		$tests = explode(',',$healthdata['Health']['test_id']);

		foreach($tests as $val)
		{
			$test_data = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
			$check_requesttest = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.test_id'=>$val,'RequestTest.health_id'=>$health_id)));
			if(empty($check_requesttest))
			{
				$requesttest = $this->RequestTest->create();

				$requesttest['RequestTest']['type'] = $test_data['Test']['type'];
				$requesttest['RequestTest']['health_id'] = $health_id;
				$requesttest['RequestTest']['test_id'] = $val;
				$requesttest['RequestTest']['mrp'] = $test_data['Test']['mrp'];
				$requesttest['RequestTest']['test_book_date'] = '2020-09-07 09:01:32';
				$requesttest['RequestTest']['reporting_status'] = '0';
				$requesttest['RequestTest']['status'] = '1';

				print_R($requesttest);
				echo "<br><br>";
				$this->RequestTest->save($requesttest);
			}
		}
		die;
	}*/

	function bulk_update_patient_report($lab_ref_no=null)
    { 
    	$today_date = date('Y-m-d');
	    $today_date = date('Y-m-d',(strtotime ( '-10 day' , strtotime ( $today_date) ) ));
	    print_R($today_date);	
		$conditions = array();
		$conditions['s_date >='] = $today_date;
        //$conditions['requ_status'] = 5;
        $conditions['ref_num >'] = 0;
		//$conditions['ref_num'] = '1412010040001';
		$conditions['OR'] = array(
							array(
								'requ_status'=>12,
								),
							array(
								'requ_status'=>5,
								),
							array(
								'requ_status'=>7,'report_type'=>'partial'
							)
						);
		//print_R($conditions);
		$this->Health = ClassRegistry::init('Health');
		$this->Lab = ClassRegistry::init("Lab");
		$this->Healthlabmateresponse = ClassRegistry::init('Healthlabmateresponse');
        if(isset($lab_ref_no) && !empty($lab_ref_no))
        {
            $data = $this->Health->find('all',array('fields'=>array('id','ref_num'),'conditions'=>array('Health.ref_num'=>$lab_ref_no)));
        }
        else
        {
            $data = $this->Health->find('all',array('conditions'=>$conditions,'limit'=>'75'));
        }
		//print_R($data);die;
		if(count($data))
        {
			$success_count=0;
            $failure_count=0;
            foreach($data as $key=>$value)
            {
				//print_R($value);die;
				$pccDetail = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$value['Health']['created_by'])));
				$api_url="http://lis.niramayapathlabs.com/live/design/jsonreceive/RequestStatus.aspx";
				//print_R($pccDetail);die;
				$data = array(
					"APIKey"=> $pccDetail['Lab']['api_key'],
					"APIUser"=> $pccDetail['Lab']['api_user'],
					"Panel_ID" => $pccDetail['Lab']['registration_number'],
					"Centre_ID"=> $pccDetail['Lab']['center_id'],
					"Order_id" => $value['Health']['reference'],
					"MRN_Id" => $value['Health']['medical_reference_number']
				);
				print_R(json_encode($data));
				$ch = curl_init();

				$curlConfig = array(

					CURLOPT_URL            => $api_url,

					CURLOPT_CUSTOMREQUEST  => "POST",

					CURLOPT_RETURNTRANSFER => true,

					CURLOPT_POSTFIELDS     => json_encode($data),
					
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					
					CURLOPT_HTTPHEADER => array(

						"content-type: application/json",
						"cache-control: no-cache"

					),

				);
                 curl_setopt_array($ch, $curlConfig);
				$result = curl_exec($ch);

				for ($i = 0; $i <= 31; ++$i) { 
					$result = str_replace(chr($i), "", $result); 
				}
				$result = str_replace(chr(127), "", $result);
				
				if (0 === strpos(bin2hex($result), 'efbbbf')) {
				   $result = substr($result, 3);
				}
				
				$api_result = json_decode($result);
				print_R($api_result);echo "<br>";
				
				$filecontent=file_get_contents($api_result->ReportLinkWithHeader);
				//print_R($filecontent);die;
				if(preg_match("/^%PDF-1.4/", $filecontent) || $filecontent == 'Credit Limit Exceeds Please Contact To Admin..!'){
					$success_count++;
		            $this->_activity_log($value['Health']['user_id'], $value['Health']['id'],'Valid Report Url Recieved - '.$value['Health']['reference']);
		        			
					if($api_result->CurrentStatus == 'Completed')
					{
						$this->_json_data($value['Health']['id'],date('Y-m-d h:i:s'),"Full Report Mail executed",json_encode($data),$result);
						$this->Health->updateAll(array('Health.patient_report_with_header'=>"'".$api_result->ReportLinkWithHeader."'",'Health.patient_report'=>"'".$api_result->ReportLink."'",'Health.requ_status'=>6,'Health.report_type'=>"'".'full'."'",'Health.last_edited'=>0,'Health.last_edited_date'=>"'".date('Y-m-d H:i:s')."'"),array('Health.id'=>$value['Health']['id']));
						
						$this->Healthlabmateresponse->create();
						$this->data1['Healthlabmateresponse']['health_id'] = $value['Health']['id'];
						$this->data1['Healthlabmateresponse']['json_data'] = json_encode($api_result);
						$this->Healthlabmateresponse->save($this->data1);
						
						if($this->Utility->check_push_notification_for_pcc($value['Health']['created_by'],$value['Health']['assigned_lab']) == 1)
						{
							$response = $this->Utility->send_notification($value['Health']['id']);
						}
						
						$this->_auto_report_upload_notify($value['Health']['id']);
						
						if($pccDetail['Lab']['send_report_mail']==1)
							$this->_send_report_to_booked_pcc($value['Health']['id']);
						
						if($pccDetail['Lab']['send_report_mail_patient']==1)
							$this->_send_report_to_patient($value['Health']['id']);
						
						$call_health_api = $this->Utility->trigger_callhealth_results($value['Health']['id']);
						
						//$this->_activity_log($value['Health']['user_id'],$value['Health']['id'],'Updating patient report');
						$this->_activity_log($value['Health']['user_id'], $value['Health']['id'],'Complete Report Recieved');
						
					}
					elseif($api_result->CurrentStatus=='Partial')
					{
						$this->_json_data($value['Health']['id'],date('Y-m-d h:i:s'),"Partial Report Mail executed",json_encode($data),$result);
						$this->Health->updateAll(array('Health.patient_report_with_header'=>"'".$api_result->ReportLinkWithHeader."'",'Health.patient_report'=>"'".$api_result->ReportLink."'",'Health.requ_status'=>7,'Health.report_type'=>"'".'partial'."'",'Health.last_edited'=>0,'Health.last_edited_date'=>"'".date('Y-m-d H:i:s')."'"),array('Health.id'=>$value['Health']['id']));
						
						if($this->Utility->check_push_notification_for_pcc($value['Health']['created_by'],$value['Health']['assigned_lab']) == 1)
						{
							$response = $this->Utility->send_notification($value['Health']['id']);
						}
						
						$this->_activity_log($value['Health']['user_id'], $value['Health']['id'], 'Partial Report Recieved');
					}
					else{
						$this->_json_data($value['Health']['id'],date('Y-m-d h:i:s'),"Report Mail Failure",json_encode($data),$result);
						$this->_activity_log($value['Health']['user_id'],$value['Health']['id'],$api_result->CurrentStatus);
					}
					curl_close($ch);
				}else{
		           echo "Not Valid pdf";
		           $this->_activity_log($value['Health']['user_id'], $value['Health']['id'],'Invalid Report Url Recieved - '.$value['Health']['reference']);
		        }
			}
           
            echo "<h1 align='center'>Sync Complete</h1>";
            echo "<h2 align='center'>".$success_count." report synced successfully</h2>";

        }
		die;
        $this->render(false);
        unlink('error_log');
        exit;
    }

    function bulk_get_sample_status()
    {
        $this->Health = ClassRegistry::init("Health");
        $this->Healthsample = ClassRegistry::init("Healthsample");
        $this->Lab = ClassRegistry::init("Lab");
		$this->Billing = ClassRegistry::init('Billing');
		
        $orders = $this->Health->query("SELECT *
                    FROM healths
                    WHERE requ_status = '14'
                    OR requ_status = '12'
                    ORDER BY `healths`.`id` ASC limit 10000");
					// and id = 558396  
        //print_R(count($orders));die;
        foreach($orders as $order_key=>$order_val)
        {
            $this->_activity_log($order_val['healths']['user_id'], $order_val['healths']['id'],'running sample status update for '.$order_val['healths']['id']);
            $test = $this->Health->find('first',array('conditions'=>array('Health.id'=>$order_val['healths']['id'])));
            $pccDetail = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$test['Health']['created_by'])));
            
			$billingDetails = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$order_val['healths']['id'])));
			
			$data = array(
                    "APIKey"=> $pccDetail['Lab']['api_key'],
                    "APIUser"=> $pccDetail['Lab']['api_user'],
                    "CenterID"=> $pccDetail['Lab']['center_id'],
					"Order_id" => $test['Health']['reference'],
					"MRN_Id" => $test['Health']['medical_reference_number']
                );
				print_R(json_encode($data));
            $ch = curl_init();
            $curlConfig = array(
                CURLOPT_URL            => "http://lis.niramayapathlabs.com/live/design/jsonreceive/SampleStatus.aspx",
                CURLOPT_POST           => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS     => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
            );

            curl_setopt_array($ch, $curlConfig);
            $result = curl_exec($ch);
            if(curl_error($ch))
			{
				print_R(curl_error($ch));
			}
            curl_close($ch);

            $resultjson = json_decode($result);
			
			$this->_json_data($order_val['healths']['id'],date('Y-m-d h:i:s'),"sample status recieved ",json_encode($data),$result);
			
			print_R($resultjson);
			$rowcount = $this->Healthsample->find('count', array('conditions' => array('Healthsample.health_id'=>$order_val['healths']['id'])));
			$totalcount=$rowcount;
			$totalrecieved = 0;
			$totalrejected = 0;
			foreach($resultjson->SamplesReceived as $key=>$val)
			{
				$status = '';
				$totalcount++;
				if($val->SampleStatus=='Received'){
					$status = '1';
					$totalrecieved++;
				}
				if($val->SampleStatus=='Not Done' || $val->SampleStatus=='Pending'){
					$status = '3';
				}
				if($val->SampleStatus=='Reject'){
					$status = '2';
					$totalrejected++;

					if($this->Utility->check_push_notification_for_pcc($order_val['healths']['created_by'],$order_val['healths']['assigned_lab']) == 1)
					{
						$response = $this->Utility->send_reject_notification($order_val['healths']['id'],$val->SampleTypeID);
					}
				}
                $remark = $val->SampleRemark;
                $sampledatetime = '';
                if(!empty($val->SampleReceivedDateTime))
                    $sampledatetime = date('Y-m-d h:i:s',strtotime($val->SampleReceivedDateTime));
                $sampledata = $this->Healthsample->find('first',array('conditions'=>array('Healthsample.health_id'=>$order_val['healths']['id'],'OR'=>array('Healthsample.sample_id'=>$val->SampleTypeID,'Healthsample.barcode_id'=>$val->BarcodeId))));
                $sample['Healthsample']['id'] = $sampledata['Healthsample']['id'];
                $sample['Healthsample'] = $sampledata['Healthsample'];
                $sample['Healthsample']['sample_status'] = $status;
                $sample['Healthsample']['sample_remark'] = $remark;
                $sample['Healthsample']['sample_recieved_datetime'] = $sampledatetime;
                $sample['Healthsample']['assigned_barcode_id'] = $val->BarcodeId;

                $sampleresult = $this->Healthsample->save($sample);
            }
			$message_from_lab = '';
			if($resultjson->OrderStatus == 'Reject'){
			//if($totalrejected == $totalcount){	
				$test['Health']['requ_status']='11';
				$message_from_lab = 'All Samples rejected kindly contact Lab team for details - '.$sampledatetime;
				$test['Health']['order_sample_status'] = 'Samples Rejected';
			}
			else if($resultjson->OrderStatus == 'Partial Send To Lab'){
			//else if($totalrecieved < $totalcount && $totalrecieved >0){
				$test['Health']['requ_status']='12';
				$message_from_lab = 'One of more samples still pending kindly contact Lab team for details - '.$sampledatetime;
				$test['Health']['order_sample_status'] = 'Patial Send To Lab';
			}
			else if($resultjson->OrderStatus == 'Send To Lab'){
			//else if($totalrecieved == $totalcount){	
				$test['Health']['requ_status']='5';
				$message_from_lab = 'All Samples received & sent for testing - '.$sampledatetime;
				$test['Health']['order_sample_status'] = 'Send To Lab';
				
				if($order_val['healths']['created_by']=='143')
				{
					$this->Utility->visitapp_result($order_val['healths']['id'],$order_val['healths']['created_by'],"manual");
				}
			}
			else
				$test['Health']['requ_status']='14';
			
			$this->LabMessageMaster = ClassRegistry::init('LabMessageMaster');
			$this->LabMessageMaster->create();
			
			$this->data['LabMessageMaster']['request_id'] = $order_val['healths']['id'];
			$this->data['LabMessageMaster']['date'] = date('Y-m-d H:i:s');
			$this->data['LabMessageMaster']['message'] = $message_from_lab;
			
			$this->LabMessageMaster->save($this->data);
			//$test['Health']['lab_message']=$message_from_lab;
			$test['Health']['remarks']=$message_from_lab;		            
         
            $test['Health']['sent_pathcorp']='1';             
            $test['Health']['order_sample_status'] = $resultjson->OrderStatus;
            echo "<br><br>";
            if($this->Health->save($test))
            {
				if($this->Utility->check_push_notification_for_pcc($order_val['healths']['created_by'],$order_val['healths']['assigned_lab']) == 1)
				{
					$response = $this->Utility->send_notification($order_val['healths']['id']);
				}
				
                $this->_activity_log($order_val['healths']['user_id'], $order_val['healths']['id'],'successfully fetched sample status for '.$order_val['healths']['id']);
            }
            else
                $this->_activity_log($order_val['healths']['user_id'], $order_val['healths']['id'],'Failed in fetching status');
        }
        echo "<br><br>";die;
    }

	function phpinfo()
	{
		echo phpinfo();die;
	}

	function check_ally()
	{
		$this->Utility->lis_payment_update('574774',"one");die;
	}

	function generate_task()
	{
		$this->TicketRecurring = ClassRegistry::init("TicketRecurring");
		$this->Ticket = ClassRegistry::init("Ticket");
		$this->Admin = ClassRegistry::init("Admin");

		$task_service = $this->TicketRecurring->find('all');
		$date = date('Y-m-d');
		$new_date = date('Y-m-d', strtotime($date. ' +1 days'));
		$counter =0;

		foreach($task_service as $val)
		{
			if(strtotime($val['TicketRecurring']['to_date']) >= strtotime($new_date) || date('d-m-Y',strtotime($val['TicketRecurring']['to_date']))=="30-11--0001")
			{
				$counter++;
				
				$counter++;
				
				$this->data = $this->Ticket->create();
				$this->data['Ticket'] = $val['TicketRecurring'];

				unset($this->data['Ticket']['id']);
				unset($this->data['Ticket']['to_date']);
				unset($this->data['Ticket']['from_date']);

				$this->data['Ticket']['ticket_id'] = "T-".strtotime(date('Y-m-d H:i:s'));
				$this->data['Ticket']['complete_by_date'] = $new_date;
				$this->data['Ticket']['date'] = $new_date;
				$this->data['Ticket']['request_id'] = "0";
				$this->data['Ticket']['assigned_to'] = "296";
				$this->data['Ticket']['status'] = 1;
//print_R(json_encode($this->data));die;
				if($this->Ticket->save($this->data))
				{
					$last_ticket_id = $this->Ticket->getLastInsertId();
					$assigned_user = $this->Admin->find('first',array('conditions'=>array('Admin.id'=>'296')));
					$message = "Hi ".$assigned_user['Admin']['name'].", 
							Ticket No - ".$this->data['Ticket']['ticket_id']." has been assigned to you with priority - ".$priority[$this->data['Ticket']['priority']].". Thanks";

					$this->__sms_message($assigned_user['Admin']['phone'],$message);
				}
			}
		}
		die;
	}

	public function task_schedule()
	{
		$this->Ticket = ClassRegistry::init("Ticket");
		
		$date = date('Y-m-d');
		$new_date = date('Y-m-d', strtotime($date. ' + 0 days'));
		//print_R($new_date);
		$ticketdata = $this->Ticket->query('select distinct(assigned_to) from ticket where date = "'.$new_date.'"');
		//print_R('select distinct(assigned_to) from ticket where date = "'.$new_date.'"');die;
		//print_R($ticketdata); die;
		foreach($ticketdata as $val)
		{
			$this->Admin = ClassRegistry::init('Admin');
			$agentdata = $this->Admin->find('first',array('conditions'=>array('Admin.id'=>$val['ticket']['assigned_to'])));
			
			$task_link = $this->get_tiny_url("https://live.niramayahealthcare.com/pages/task_schedule/".base64_encode($val['ticket']['assigned_to'])."/".base64_encode($new_date));

			$this->Ticket->query('update ticket set task_url="'.$task_link.'" where date = "'.$new_date.'" and assigned_to="'.$val['ticket']['assigned_to'].'"');

			$messagebody = "Your Tasks for ".$new_date." can be viewed on ".$task_link."";
			echo "<br>";
			print_R($messagebody);
			$this->__sms_message($agentdata['Admin']['phone'],$messagebody);
			echo "<br>";
		}
		die;
	}

	function update_ticket()
	{
		$this->Ticket = ClassRegistry::init('Ticket');

		$ticket = $this->Ticket->find('all',array('conditions'=>array('Ticket.ticket_id'=>'')));

		foreach($ticket as $val)
		{
			$u_ticket = $val;
			$u_ticket['Ticket']['ticket_id'] = "T-".strtotime($val['Ticket']['date']);
			print_R($u_ticket);
			echo "<br><br>";
			$this->Ticket->save($u_ticket);
		}
		die;
	}

	public function admin_report_status()
	{
		$this->Lab = ClassRegistry::init('Lab');
		$lab_list = $this->Lab->find('list',array('fields'=>array('id','pcc_name')));
		$this->set('labs',$lab_list);

		if($_POST)
		{
			$conditions = array();
			
			if(!empty($_POST['req_to_date']))
			{
				array_push($conditions,"s_date <= '".date('Y-m-d',(strtotime($_POST['req_to_date']) ))."'");
			}
			if(!empty($_POST['req_from_date']))
			{
				array_push($conditions,"s_date >= '".date('Y-m-d',(strtotime($_POST['req_from_date']) ))."'");
			}
			if(!empty($_POST['Pcc']))
			{
				array_push($conditions,"created_by = ".$_POST['Pcc']);
			}
			//print_R($conditions);die;

			$this->update_patient_report(implode(' and ',$conditions));
		}
	}

	public function admin_sample_status()
	{
		$this->Lab = ClassRegistry::init('Lab');
		$lab_list = $this->Lab->find('list',array('fields'=>array('id','pcc_name')));
		$this->set('labs',$lab_list);

		if($_POST)
		{
			$conditions = array();
			
			if(!empty($_POST['req_to_date']))
			{
				array_push($conditions,"s_date <= '".date('Y-m-d',(strtotime($_POST['req_to_date']) ))."'");
			}
			if(!empty($_POST['req_from_date']))
			{
				array_push($conditions,"s_date >= '".date('Y-m-d',(strtotime($_POST['req_from_date']) ))."'");
			}
			if(!empty($_POST['Pcc']))
			{
				array_push($conditions,"created_by = ".$_POST['Pcc']);
			}
			//print_R(implode(' and ',$conditions));die;

			$this->get_sample_status(implode(' and ',$conditions));
		}
	}

	public function populate_billing()
    {
    	$this->_health_table_id = '573851';

        $this->Billing = ClassRegistry::init('Billing');
        $this->Health = ClassRegistry::init('Health');
        $this->User = ClassRegistry::init('User');
     	
     	$health = $this->Health->find('first',array('conditions'=>array('Health.id'=>$this->_health_table_id)));
     	$user = $this->User->find('first',array('conditions'=>array('User.id'=>$health['Health']['user_id'])));

        $this->_order_id = $this->_health_table_id * 2;

        $this->data['Billing']['order_id'] = $this->_health_table_id * 2;
        $this->data['Billing']['request_id'] = $this->_health_table_id;
        $this->data['Billing']['user_id'] = $health['Health']['user_id'];
        $this->data['Billing']['test_id'] = $health['Health']['test_id'];
        $this->data['Billing']['profile_id'] = $health['Health']['profile_id'];
        $this->data['Billing']['offer_id'] = $health['Health']['offer_id'];
        $this->data['Billing']['package_id'] = $health['Health']['package_id'];
        $this->data['Billing']['service_id'] = $health['Health']['service_id'];
        $this->data['Billing']['first_name'] = $user['User']['name'];
        $this->data['Billing']['contact'] = $health['Health']['landline'];
        $this->data['Billing']['address'] = $health['Health']['address'];
        $this->data['Billing']['locality'] = $health['Health']['locality'];

        $this->Pincodemaster = ClassRegistry::init("PincodeMaster");
        $this->data['Billing']['zip'] = $health['Health']['pincode'];

        if($health['Health']['pincode'])
        {
        	$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$health['Health']['pincode'])));
        	$this->data['Billing']['city'] = $pincodeMaster['PincodeMaster']['city'];
        	$this->data['Billing']['state'] = $pincodeMaster['PincodeMaster']['state'];	
        }
        else{
        	$this->data['Billing']['city'] = '0';
        	$this->data['Billing']['state'] = '0';	
        }
        $this->data['Billing']['landmark'] = $health['Health']['landmark'];
        $this->data['Billing']['book_date'] = date('Y-m-d H:i:s');
        
        $this->data['Billing']['sub_total'] = $health['Health']['total_amount'];

        $this->Billing->create();
        //print_R($this->data);die;
        if(!$this->Billing->save($this->data))
        {
        	$this->response('Incomplete Billing Data',406);	
        }
        die;
    }

    public function populate_user()
    {
    	$this->_health_table_id = '573851';
        $this->User = ClassRegistry::init("User");
        $this->Health = ClassRegistry::init('Health');

        $this->LabPincodeServicibility = ClassRegistry::init("LabPincodeServicibility");
        $health = $this->Health->find('first',array('conditions'=>array('Health.id'=>$this->_health_table_id)));

        $this->Pincodemaster = ClassRegistry::init("PincodeMaster");
		
		$parent_id = $this->User->find('first',array('conditions'=>array('User.associated_pcc'=> $health['Health']['created_by'],'User.parent_child'=>'parent')));

		if($parent_id)
		{
			$this->data['User']['type'] = $parent_id['User']['type'];
			$this->data['User']['parent_id'] = $parent_id['User']['parent_id'];
			$this->data['User']['parent_child'] = "child";
		}
		
		$this->data['User']['associated_pcc'] = $parent_id['User']['associated_pcc'];

		$this->data['User']['email'] = $health['Health']['email'];
		$this->data['User']['alternate_email'] = "";
		$this->data['User']['status'] = 1;
		$this->data['User']['first_name'] = $health['Health']['name'];
		$this->data['User']['last_name'] = "";
		$this->data['User']['name'] = $health['Health']['name'];

		$this->data['User']['gender'] = $health['Health']['gender'];
		$this->data['User']['age'] = $health['Health']['age'];
		$this->data['User']['contact'] = $health['Health']['landline'];
		$this->data['User']['alternate_contact'] = $health['Health']['mobile'];
		$this->data['User']['address'] = $health['Health']['address'];
		$this->data['User']['locality'] = $health['Health']['locality'];
		$this->data['User']['username'] = strtolower(str_replace(' ','',$health['Health']['name'])).mt_rand(1000,9999);
		$this->data['User']['passwd'] = substr(strtolower($health['Health']['name']),0,1).substr($health['Health']['landline'],-4,4);
		$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
		$this->data['User']['pincode'] = !empty($this->_request->zip_code) ? $this->_request->zip_code :'';

		$this->data['User']['city'] = $health['Health']['city_id'];
		$this->data['User']['state'] = $health['Health']['state'];	

		$this->data['User']['landmark'] = !empty($health['Health']['landmark']) ? $health['Health']['landmark'] :'';
		$this->data['User']['created_by'] = $health['Health']['created_by'];
		$this->User->create();
		print_R($this->data);
		if($this->User->save($this->data))
			echo $this->_user_table_id = $this->User->getLastInsertId();
		else
			echo 'User Data Incomplete';
		die;
    }

    function send_to_labmate_manual()
	{
        $this->Health = ClassRegistry::init("Health");
        $this->User = ClassRegistry::init("User");
        $this->Billing = ClassRegistry::init('Billing');
        $this->Test = ClassRegistry::init('Test');
        $this->Package = ClassRegistry::init('Package');
        $this->Banner = ClassRegistry::init('Banner');
        $this->Healthsample = ClassRegistry::init("Healthsample");
        $today_date = date('Y-m-d');
        $today_date = date('Y-m-d',(strtotime ( '-7 days' , strtotime ( $today_date) ) ));

        $health_orders = $this->Health->query("SELECT *
			FROM healths
			WHERE id in ('574771','574772','574773','574774')");
        //print_R($health_orders);die;
        foreach($health_orders as $order_key=>$order_val)
        {
            print_R($order_val['healths']['id']."---------");
            $health_detail = $this->Health->find('first',array('conditions'=>array('Health.id'=>$order_val['healths']['id'])));

            $user_detail = $this->User->find('first',array('conditions'=>array('User.id'=>$health_detail['Health']['user_id'])));
            $test_list = explode(',',$health_detail['Health']['test_id']);
            $profile_list = explode(',',$health_detail['Health']['profile_id']);
            $service_list = explode(',',$health_detail['Health']['service_id']);
            $package_list = explode(',',$health_detail['Health']['package_id']);
            $offer_list = explode(',',$health_detail['Health']['offer_id']);
            $billing_detail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$order_val['healths']['id'])));

            $testList = array();
            $sampleList = array();
            $count = 0;
            if(!empty($health_detail['Health']['test_id']))
            {
                foreach($test_list as $key=>$val)
                {
					if($val!='')
					{
                    $test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
                    $testList[$count] = $test_detail['Test']['testcode'];
                    //$testList[$count]['HOrder_ID'] = //$billing_detail['Billing']['order_id'];
                    $count++;
					}
                }
            }
            if(!empty($health_detail['Health']['profile_id']))
            {
                foreach($profile_list as $key=>$val)
                {
					if($val!='')
					{
                    $test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
                    $testList[$count] = $test_detail['Test']['testcode'];
                    //$testList[$count]['HOrder_ID'] = //$billing_detail['Billing']['order_id'];
                    $count++;
					}
                }
            }
            if(!empty($health_detail['Health']['service_id']))
            {
                foreach($service_list as $key=>$val)
                {
					if($val!='')
					{
                    $test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
                    $testList[$count] = $test_detail['Test']['testcode'];
                    //$testList[$count]['HOrder_ID'] = //$billing_detail['Billing']['order_id'];
                    $count++;
					}
                }
            }
            if(!empty($health_detail['Health']['package_id']))
            {
                foreach($package_list as $key=>$val)
                {
					if($val!='')
					{
                    $test_detail = $this->Package->find('first',array('conditions'=>array('Package.id'=>$val)));
                    $testList[$count] = $test_detail['Package']['package_code'];
                    //$testList[$count]['HOrder_ID'] = //$billing_detail['Billing']['order_id'];
                    $count++;
					}
                }
            }
            if(!empty($health_detail['Health']['offer_id']))
            {
                foreach($offer_list as $key=>$val)
                {
					if($val!='')
					{
                    $test_detail = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$val)));
                    $testList[$count] = $test_detail['Package']['banner_code'];
                    //$testList[$count]['HOrder_ID'] = //$billing_detail['Billing']['order_id'];
                    $count++;
					}
                }
            }

            $sample_health = $this->Healthsample->find('all',array('conditions'=>array('Healthsample.health_id'=>$order_val['healths']['id'])));

            if(!empty($sample_health))
            {   $count1=0;
                foreach($sample_health as $key=>$val)
                {
                    $sampleList[$count1]['SampleId'] = $val['Healthsample']['sample_id'];
                    $sampleList[$count1]['BarcodeId'] = $val['Healthsample']['barcode_id'];
                    $count1++;
                }
            }

            $this->Timelab = ClassRegistry::init("Timelab");
            $timelabs = $this->Timelab->find('all',array('conditions'=>array('Timelab.status'=>1),'order'=>array('Timelab.sequence ASC')));
            $time=explode('-',$timelabs[$health_detail['Health']['sample_time1']]['Timelab']['name']);

            $this->Lab = ClassRegistry::init("Lab");
            $pccDetail = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$health_detail['Health']['created_by'])));
            $servicePccDetail = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$health_detail['Health']['assigned_lab'])));
            $referred_by = $health_detail['Health']['remark'];
            if(empty($health_detail['Health']['remark']))
                $referred_by = $user_detail['User']['name'];

            $dateTime = explode(" ",$health_detail['Health']['sample_collected_date']);
            $date =  date('d-m-Y',strtotime($dateTime[0]));
            $s_date_new = $dateTime[0];
            $datetime = $dateTime[1];

            $date=date('Y-m-d', strtotime($s_date_new))." ".$datetime;

            $reference = "NPL".$billing_detail['Billing']['order_id'];
            if(!empty($health_detail['Health']['reference']))
                $reference = $health_detail['Health']['reference'];

            $patientTitle = 'Mr.';
            $sex = 'male';
            $isurgent = 0;
            if($health_detail['Health']['is_urgent']=='true')
                $isurgent = 1;
                
            if($health_detail['Health']['gender']=='2')
            {
                $patientTitle = 'Mrs.';
                $sex = 'female';
            }
			
			$address = "";
			if(!empty($health_detail['Health']['address']) && $health_detail['Health']['address']!="")
				$address = $health_detail['Health']['address'];
			else
				$address = $health_detail['Health']['address1'];
			
            $customerId = $health_detail['Health']['user_id'];
            if(!empty($health_detail['Health']['medical_reference_number']))
                $customerId = $health_detail['Health']['medical_reference_number'];
            $comment ='';
            if(!empty($health_detail['Health']['remarks']))
                $comment = $health_detail['Health']['remarks'];
            else
                $comment = $health_detail['Health']['discount_amount_reason'];            
			
			$email="";
			if(!empty($health_detail['Health']['email']))
				$email = $health_detail['Health']['email'];
			else
				$email = ".";
			
			$data = array(
                "APIKey"=> $pccDetail['Lab']['api_key'],
                "APIUser"=> $pccDetail['Lab']['api_user'],
                "Title"=>$patientTitle,
                "PatientName"=> strtoupper($health_detail['Health']['name']),
                "LastName"=>".",
                "Referredby"=>$referred_by,
                "Sex"=> $sex,
                "Age"=> $health_detail['Health']['age'],
                "MobileNumber"=> $health_detail['Health']['landline'],
                "Address"=> $address,
                "PinCode"=> $health_detail['Health']['pincode'],
                "Landmark" => $health_detail['Health']['landmark'],
                "SampleCollectedDate"=> $date,
				"Order_id" => $health_detail['Health']['reference'],
				"MRN_Id" => $health_detail['Health']['medical_reference_number'],
                //"BookingID"=> $billing_detail['Billing']['order_id'],
                //"CustomerID"=> $customerId,
                "CenterID"=>$pccDetail['Lab']['center_id'],
                "PanelID"=>$pccDetail['Lab']['registration_number'],
                "IsUrgent"=>$isurgent,
                "Email"=>$email,
                "VisitType"=>"1",
                "ServiceBypanel"=>$servicePccDetail['Lab']['registration_number'],
                "Comment"=> $comment." Order Intiated via Nhcare",
                "TestList"=>$testList,
                "Samples"=>$sampleList
            );
            print_R(json_encode($data));
            $ch = curl_init();
            $curlConfig = array(
                CURLOPT_URL            => "http://lis.niramayapathlabs.com/live/Design/jsonreceive/Postorder.aspx",
                CURLOPT_POST           => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS     => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/json"
                ),
            );

            curl_setopt_array($ch, $curlConfig);
            $result = curl_exec($ch);
            //print_R(curl_getinfo($ch));
			if(curl_error($ch))
			{
				print_R(curl_error($ch));
			}
            curl_close($ch);
            $decoded_result = json_decode($result) ;
			$this->_json_data($health_detail['Health']['id'],date('Y-m-d h:i:s'),"Post Order Fired",json_encode($data),$result);

            if(isset($decoded_result->Labno) && $decoded_result->Labno!=0)
            {
            	$this->_activity_log($health_detail['Health']['user_id'],$health_detail['Health']['id'], 'Order sent to Labmate - Home');
                $update_query = $this->Health->query("UPDATE healths SET requ_status='14',ref_num='".$decoded_result->Labno."',sent_pathcorp='1',sent_pathcorp_admin='0' ,last_edited='0',last_edited_date='".date('Y-m-d H:i:s')."',netbilling='".$decoded_result->Netbilling."' WHERE id='".$order_val['healths']['id']."'");
                echo "success";
				print_R($decoded_result);
				echo "<br>";

				//$this->Utility->lis_payment_update($order_val['healths']['id'],"all");
				
				if($this->Utility->check_push_notification_for_pcc($order_val['healths']['created_by'],$order_val['healths']['assigned_lab']) == 1)
				{
					$response = $this->Utility->send_notification($order_val['healths']['id']);
				}

            }
            else
            {
                print_R($health_detail['Health']['user_id']."-----");
                print_R($order_val['healths']['id']."-----");
                echo "failed";
                echo "<br><br>";
                //$this->_activity_log($health_detail['Health']['user_id'], $order_val['healths']['id'],$decoded_result);
            }
			
		}
		die;
    }
}
?>
