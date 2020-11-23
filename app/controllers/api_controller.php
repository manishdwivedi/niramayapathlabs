<?php 
ini_set("error_reporting",0);
class ApiController
{
    var $name = "Api";
	var $uses=array('ActivityLog','LabPincodeServicibility');
	var $helpers = array('JsonData','Utility');
	public $components = array('Utility');

	public $_allow = array();
	public $_content_type = "application/json";
	public $_cache_type = "no-cache";
	
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
	
	function beforeFilter(){
		
	}

	public function get_referer(){
		return $_SERVER['HTTP_REFERER'];
	}
	 
	function _activity_log($patient , $health, $action)
	{
		// To get page url to track activity
		$page_url = Router::url( $this->here, true );
		//echo json_encode($page_url);
		$this->ActivityLog = ClassRegistry::init('ActivityLog');
		$this->data['ActivityLog']['admin_id'] = "1";
		
		$this->data['ActivityLog']['patient_id'] = $patient;
		$this->data['ActivityLog']['health_id'] = $health;
		$this->data['ActivityLog']['page_url']= $page_url;
		$this->data['ActivityLog']['action']= $action;
		$this->data['ActivityLog']['creation'] = date('Y-m-d H:i:s');
		
//		echo json_encode($this->data);exit;
		if($this->ActivityLog->create($this->data))
		{
			$this->ActivityLog->save($this->data);
		}
	}
	
	public function response($data,$status){
		$this->_code = ($status)?$status:200;
		$result = array('code'=>$status,'message'=>$this->get_status_message(),'result'=>$data);
		$this->saveResponseData($result);
		$this->set_headers();
		echo json_encode($result);
		exit;
	}
	 
	private function get_status_message(){
		$status = array(
					100 => 'Continue',  
					101 => 'Invalid authorization code', 
					102 => 'Account Deactivated',	
					200 => 'OK',
					201 => 'Invalid Reference ID',  
					202 => 'Accepted',  
					203 => 'Non-Authoritative Information',  
					204 => 'No Content',  
					205 => 'Reset Content',  
					206 => 'Partial Content',  
					300 => 'Multiple Choices',  
					301 => 'Moved Permanently',  
					302 => 'Found',  
					303 => 'See Other',  
					304 => 'Not Modified',  
					305 => 'Use Proxy',  
					306 => 'Not Servicable',  
					307 => 'Temporary Redirect',  
					400 => 'Bad Request',  
					401 => 'Unauthorized',  
					402 => 'Payment Required',  
					403 => 'Forbidden',  
					404 => 'Not Found',  
					405 => 'Method Not Allowed',  
					406 => 'Not Acceptable',  
					407 => 'Proxy Authentication Required',  
					408 => 'Request Timeout',  
					409 => 'Conflict',  
					410 => 'Gone',  
					411 => 'Length Required',  
					412 => 'Precondition Failed',  
					413 => 'Request Entity Too Large',  
					414 => 'Request-URI Too Long',  
					415 => 'Unsupported Media Type',  
					416 => 'Requested Range Not Satisfiable',  
					417 => 'Header Failed',  
					500 => 'Internal Server Error',  
					501 => 'Not Implemented',  
					502 => 'Bad Gateway',  
					503 => 'Service Unavailable',  
					504 => 'Gateway Timeout',  
					505 => 'HTTP Version Not Supported',
					506 => 'Duplicate Order Reference Number');
		return ($status[$this->_code])?$status[$this->_code]:$status[500];
	}
	 
	public function get_request_method(){
		return $_SERVER['REQUEST_METHOD'];
	}
	 
		 
	private function cleanInputs($data){
		$clean_input = array();
		if(is_array($data)){
			foreach($data as $k => $v){
				$clean_input[$k] = $this->cleanInputs($v);
			}
		}else{
			if(get_magic_quotes_gpc()){
				$data = trim(stripslashes($data));
			}
			$data = strip_tags($data);
			$clean_input = trim($data);
		}
		return $clean_input;
	}       
	 
	private function set_headers(){
		//header("HTTP/1.1 ".$this->_code." ".$this->get_status_message());
		header("Content-Type:".$this->_content_type);
	}
	
	private function validateParam()
	{
		$method = $_SERVER;
		if($method['CONTENT_TYPE'] != $this->_content_type || $method['HTTP_CACHE_CONTROL'] != $this->_cache_type)
		{
			$this->response('',417);
		}
		
	}
	
	public function processApi(){
        $func = strtolower(trim(str_replace("api/","",$_REQUEST['url'])));
		
        if((int)method_exists($this,$func) > 0)
		{
			$this->validateParam();
			$this->$func();
		}
		else
		{
			$this->response($func.'-Error code 404, Page not found',404); 
		}
			
	}
	
	
    private function orderstatus()
	{
		switch($this->get_request_method())
		{
			case 'POST':
				$this->_request = json_decode($this->cleanInputs(file_get_contents('php://input')));
				$this->validateAuthorizationCode();
				$this->getTestResult();
				//$this->response($this->_request,200);
				break;
			default:
				$this->response('',405);
				break;
		}
		
	}
        
	private function checkOrderReference()
	{
		$this->Health = ClassRegistry::init("Health");
                
		$data = $this->Health->find("count",array("conditions"=>array("reference"=>$this->_request->order_reference,'created_by'=>$this->_lab_id)));

		if($data>0)
		{
			$this->response('',506);
		}
	}
    
	private function getTestResult()
	{
		$this->PhleboConfirmedNotify = ClassRegistry::init("PhleboConfirmedNotify");
		$this->Agent = ClassRegistry::init("Agent");
		$this->Health = ClassRegistry::init("Health");
		$this->ConfirmBooking = ClassRegistry::init("ConfirmBooking");
		$this->Test = ClassRegistry::init("Test");
		$this->RequestTest = ClassRegistry::init('RequestTest');
		$this->Health->bindModel(array(
			'hasOne'=>array(
				'Billing'=>array(
				'className'=>'Billing',
				'foreignKey'=>'request_id',
				'fields'=>array('Billing.order_id')
				)
			)
		));
		$data = $this->Health->find("first",array("conditions"=>array("reference"=>$this->_request->reference_id,"created_by"=>$this->_pcc_id)));	
		//print_R($data);die;
		if(isset($data['Health']['id']))
		{
			$this->_request->order_id = $data['Billing']['order_id'];
			$this->_request->request_status = $this->getRequestStatus($data['Health']['requ_status']);
						
			if($data['Health']['report_type']=='partial')
			{
				$this->_request->report_type = ($data['Health']['report_type'])? $data['Health']['report_type'] : "";
				
				$dec_rep_name = "";

				if (strpos($data['Health']['patient_report'], 'http:') !== false) { 
					$dec_rep_name = $data['Health']['patient_report_with_header'];
				}
				else{
					$dec_rep_name = "https://www.niramayahealthcare.com/tests/view_report/".base64_encode($data['Health']['patient_report']);			
				}

				$this->_request->report_url = $dec_rep_name;

				$completed_test = $this->RequestTest->find("all",array("conditions"=>array("health_id"=>$data['Health']['id'])));
				$completed_tests_list = array();
				$pending_tests_list= array();
				foreach($completed_test as $key=>$val)
				{
					$testResult = '';
					if(in_array($val['RequestTest']['type'], array('TE','PR','SR')))
					{
						$testResult = $this->Test->find('first',array("conditions"=>array("id"=>$val['RequestTest']['test_id'])));
						if($val['RequestTest']['reporting_status']==1)
							array_push($completed_tests_list, $testResult['Test']['test_parameter']);
						else
							array_push($pending_tests_list, $testResult['Test']['test_parameter']);
					}

					if($val['RequestTest']['type']=='PA')
					{
						$testResult = $this->Package->find('first',array("conditions"=>array("id"=>$val['RequestTest']['test_id'])));
						if($val['RequestTest']['reporting_status']==1)
							array_push($completed_tests_list, $testResult['Package']['package_name']);
						else
							array_push($pending_tests_list, $testResult['Package']['package_name']);
					}
					if($val['RequestTest']['type']=='OF')
					{
						$testResult = $this->Banner->find('first',array("conditions"=>array("id"=>$val['RequestTest']['test_id'])));
						if($val['RequestTest']['reporting_status']==1)
							array_push($completed_tests_list, $testResult['Banner']['banner_name']);
						else
							array_push($pending_tests_list, $testResult['Banner']['banner_name']);
					}
				}
				$this->_request->completed_test = $completed_tests_list;
				$this->_request->pending_test = $pending_tests_list;
			}
			else if($data['Health']['report_type']=='full')
			{
				$this->_request->report_type = ($data['Health']['report_type'])? $data['Health']['report_type'] : "";
				$dec_rep_name = "";

				if (strpos($data['Health']['patient_report'], 'http:') !== false) { 
					$dec_rep_name = $data['Health']['patient_report_with_header'];
				}
				else{
					$dec_rep_name = "https://www.niramayahealthcare.com/tests/view_report/".base64_encode($data['Health']['patient_report']);						
				}

				$this->_request->report_url = $dec_rep_name;
				//print_R('else');die;
				$this->Healthlabmateresponse = ClassRegistry::init('Healthlabmateresponse');
				$healthlabmate = $this->Healthlabmateresponse->find('first',array('conditions'=>array('Healthlabmateresponse.health_id'=>$data['Health']['id']),'order'=>array('id'=>'DESC')));
				//$this->response($healthlabmate,200);
				$resultSetLabmate = json_decode($healthlabmate['Healthlabmateresponse']['json_data']);
				$this->_request->digital_report = $healthlabmate['Healthlabmateresponse']['json_data'];
			}
			
			if($data['Health']['old_date'] != "0000-00-00")
			{
				$this->_request->reschedule = 1;
				$this->_request->old_date = $data['Health']['old_date'];
				$this->_request->new_date = $data['Health']['s_date'];
			}
			
			if($data['Health']['requ_status']==18)
			{
				$con_book = $this->ConfirmBooking->find('first',array('conditions'=>array('ConfirmBooking.health_id'=>$data['Health']['id'])));
				$this->_request->remark = $con_book['ConfirmBooking']['remarks'];
			}
			
			if($data['Health']['requ_status']==16)
			{
				$this->_request->specimen_date = $data['Health']['specimen_date'];
				$this->_request->specimen_time = $data['Health']['specimen_time'];
				$this->_request->specimen_remarks = $data['Health']['specimen_remarks'];
				$this->_request->specimen_by = $data['Health']['specimen_by'];
			}
			
			if($data['Health']['requ_status']==19)
			{
				$phlebodata = $this->PhleboConfirmedNotify->find('first',array('conditions'=>array('PhleboConfirmedNotify.health_id'=>$data['Health']['id'])));
				$this->_request->phlebo_name = $phlebodata['PhleboConfirmedNotify']['name'];
				$this->_request->phlebo_phone = $phlebodata['PhleboConfirmedNotify']['phone'];
			}
			
			if($data['Health']['requ_status']==4)
			{
				$phlebodata = $this->Agent->find('first',array('conditions'=>array('Agent.id'=>$data['Health']['agent_id'])));
				$this->_request->phlebo_name = $phlebodata['Agent']['name'];
				$this->_request->phlebo_phone = $phlebodata['Agent']['contact'];
			}
			
			unset($this->_request->authorization);
			$this->response($this->_request,200);
		}
		else
		{
			$this->response('',201);
		}
		
	}
	
	public function getRequestStatus($status_code=null)
	{
		$status = Configure::read('RequestStatus');
		return ($status[$status_code])?$status[$status_code]:'Unkwown';
	}
	
	private function searchtest()
	{
		$this->Test = ClassRegistry::init("Test");
		$this->_request = json_decode($this->cleanInputs(file_get_contents('php://input')));
		//print_R($this->_request->keyword);die;
		$search_data_keyword = array();
		$keyword = $this->_request->keyword;
		$search_keyword_1 = $this->Test->find('all',array('conditions'=>array('Test.test_parameter LIKE'=>'%'.$keyword.'%','LENGTH(Test.testcode) >= '=>1,'Test.status'=>1,'Test.p_type'=>1)));
		//print_R(json_encode($search_keyword_1));die;
		$count_1 = count($search_keyword_1);
		$k = 0;
		if(!empty($search_keyword_1))
		{
			foreach($search_keyword_1 as $key => $val)
			{
				$search_data_keyword[$k]['Search']['id'] = $val['Test']['id'];
				$search_data_keyword[$k]['Search']['test_code'] = $val['Test']['testcode'];
				$search_data_keyword[$k]['Search']['test_parameter'] = $val['Test']['test_parameter'];
				$search_data_keyword[$k]['Search']['reporting_time'] = $val['Test']['reporting'];
				$search_data_keyword[$k]['Search']['test_mrp'] = $val['Test']['mrp'];
				$k++;
			}	
		}
		print_R(json_encode($search_data_keyword));die;
	}
	
	function test_description()
	{
		$this->Test = ClassRegistry::init("Test");
		$this->Observation = ClassRegistry::init("Observation");
		$this->TestDetails = ClassRegistry::init("TestDetails");
		$this->Samplemaster = ClassRegistry::init("Samplemaster");
		$sample = $this->Samplemaster->find('list',array('fields'=>array('Samplemaster.sample_id','Samplemaster.type')));
		
		$this->_request = json_decode($this->cleanInputs(file_get_contents('php://input')));
		$testcode = '';
		
		if(isset($this->_request->testcode))
			$testcode = $this->_request->testcode;
		
		if(isset($this->_request->testid))
			$testcode = $this->_request->testid;	
		
		$description = $this->Test->find('first',array('conditions'=>array('Test.testcode'=>$testcode)));
		$testdetails = $this->TestDetails->find('first',array('conditions'=>array('TestDetails.test_id'=>$description['Test']['id'])));
		//print_R(json_encode($description));die;
		if($description['Test']['type']=='TEST')
		{
			$observation = $this->Observation->query("Select GROUP_CONCAT( observation_name ) as obsname from observations where observation_id in (".$description['Test']['observation_id'].")	");
			//print_R(json_encode($observation[0][0]['obsname']));die;
			$x['observation'] = $observation[0][0]['obsname'];
		}
		else
		{
			$testsname = $this->Test->query("Select GROUP_CONCAT(test_parameter) as testn from tests where id in (".$description['Test']['testscode'].")");
			//print_R(json_encode($testname));
			$x['tests'] = $testsname[0][0]['testn'];
		}
		
		if(!empty($description))
		{
			$x['success'] = 'success';
			$x['id'] = $description['Test']['id'];
			$x['type'] = $description['Test']['type'];
			$x['testcode'] = $description['Test']['testcode'];
			$x['test_parameter'] = $description['Test']['test_parameter'];
			$x['sample'] = $sample[$description['Test']['sample']];
			$x['fasting'] = $description['Test']['fasting_required'];
			$x['methodology'] = $description['Test']['methodology'];
			$x['temp'] = $description['Test']['temp'];
			$x['schedule'] = $description['Test']['schedule'];
			$x['reporting'] = $description['Test']['reporting'];
			$x['net'] = $description['Test']['net'];
			$x['mrp'] = $description['Test']['mrp'];
			$x['why_to'] = $testdetails['TestDetails']['why_to'];
			$x['when_to'] = $testdetails['TestDetails']['when_to'];
			if(!empty($description['Test']['file_name']))
			{
				$x['file_name'] = $description['Test']['file_name'];
			}	
			if(empty($description['Test']['file_name']))
			{
				$x['file_name'] = 'not_upload';
			}
			$m['description_info'] = $x;
		}
		echo json_encode($m);
		exit;
	}
	
        private function addorder()
        {
            switch($this->get_request_method())
            {
                case 'POST':
                        $this->_request = json_decode($this->cleanInputs(file_get_contents('php://input')));
                        $this->validateAuthorizationCode();
			$this->checkOrderReference();
                        $test = $this->saveOrder();
//print_R($test);die;
                        $this->response($this->_order_id,200);
                        break;
                default:
                        $this->response('',405);
                        break;
            }
        }
        
        public function saveOrder()
        {
            /*saving to user table*/
            $this->createUser();
            
            /*saving to health table*/
            $this->createHealth();
            
            /*saving to  test request -> test and profile*/
            $this->createRequestTePr();
            
            /*update amount in health table*/
            $this->updateHealth();
            
            /*saving to billing*/
            $result = $this->createBilling();
//return $result;
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
		else
		{
			if(!empty($this->_request->Samples))
			{
				$this->processSampleBarcode();
				//$this->saveStl();
				$this->paydata['Paytrack']['pay_mode'] = 'btc';
				$this->paydata['Paytrack']['c_number'] = '';
				$this->paydata['Paytrack']['pay_install'] = !empty($this->_request->payment_recieved) ? $this->_request->payment_recieved :'0';
				$this->paydata['Paytrack']['type'] = 'Receive';
				$this->paydata['Paytrack']['admin_id'] = 1;
				
				$this->paydata['Paytrack']['request_id'] = $this->_health_table_id;
				$this->paydata['Paytrack']['receive_date'] = date('Y-m-d H:i:s');
				$this->Paytrack = ClassRegistry::init('Paytrack');
				$this->Paytrack->create();
				$this->Paytrack->save($this->paydata);

				$this->reg_in_lis($this->_health_table_id);
			}	
		}
    }
        
	private function processSampleBarcode()
	{
		foreach($this->_request->Samples as $val)
		{
			$this->Healthsample = ClassRegistry::init("Healthsample");
			$this->data['Healthsample']['health_id'] = $this->_health_table_id;
			$this->data['Healthsample']['sample_id'] = $val->SampleId;
			$this->data['Healthsample']['barcode_id'] = $val->BarcodeId;
			$this->Healthsample->create();
        		$this->Healthsample->save($this->data);
		}
		
	}

	private function saveStl()
	{

		$this->Health = ClassRegistry::init("Health");
		$health_detail = $this->Health->find('first',array('conditions'=>array('Health.id'=>$this->_health_table_id)));
		$user_detail = $this->User->find('first',array('conditions'=>array('User.id'=>$this->_user_table_id )));
	    $test_list = explode(',',$health_detail['Health']['test_id']);
	    $profile_list = explode(',',$health_detail['Health']['profile_id']);
	    $service_list = explode(',',$health_detail['Health']['service_id']);
	    $package_list = explode(',',$health_detail['Health']['package_id']);
	    $offer_list = explode(',',$health_detail['Health']['offer_id']);
	    $billing_detail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$this->_health_table_id)));

	    $testList = array();
	    $sampleList = array();
	    $count = 0;
	    if(!empty($health_detail['Health']['test_id']))
	    {
	        foreach($test_list as $key=>$val)
	        {
	            $test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
	            $testList[$count]['TestCode'] = $test_detail['Test']['testcode'];
	            $testList[$count]['HOrder_ID'] = $billing_detail['Billing']['order_id'];
	            $count++;
	        }
	    }
	    if(!empty($health_detail['Health']['profile_id']))
	    {
	        foreach($profile_list as $key=>$val)
	        {
	            $test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
	            $testList[$count]['TestCode'] = $test_detail['Test']['testcode'];
	            $testList[$count]['HOrder_ID'] = $billing_detail['Billing']['order_id'];
	            $count++;
	        }
	    }

	    if(!empty($health_detail['Health']['service_id']))
	    {
	        foreach($service_list as $key=>$val)
	        {
	            $test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
	            $testList[$count]['TestCode'] = $test_detail['Test']['testcode'];
	            $testList[$count]['HOrder_ID'] = $billing_detail['Billing']['order_id'];
	            $count++;
	        }
	    }
	    if(!empty($health_detail['Health']['package_id']))
	    {
	        foreach($package_list as $key=>$val)
	        {
	            $test_detail = $this->Package->find('first',array('conditions'=>array('Package.id'=>$val)));
	            $testList[$count]['TestCode'] = $test_detail['Package']['package_code'];
	            $testList[$count]['HOrder_ID'] = $billing_detail['Billing']['order_id'];
	            $count++;
	        }
	    }
	    if(!empty($health_detail['Health']['offer_id']))
	    {
	        foreach($offer_list as $key=>$val)
	        {
	            $test_detail = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$val)));
	            $testList[$count]['TestCode'] = $test_detail['Package']['banner_code'];
	            $testList[$count]['HOrder_ID'] = $billing_detail['Billing']['order_id'];
	            $count++;
	        }
	    }

		$sample_health = $this->Healthsample->find('all',array('conditions'=>array('Healthsample.health_id'=>$this->_health_table_id)));
	        
		if(!empty($sample_health))
	    {	$count1=0;
	        foreach($sample_health as $key=>$val)
	        {
	            $sampleList[$count1]['SrlNo'] = $count1+1;
	            $sampleList[$count1]['SampleId'] = $val['Healthsample']['sample_id'];
	            $sampleList[$count1]['BarcodeId'] = $val['Healthsample']['barcode_id'];
	            $count1++;
	        }
	    }
	    	    
	    $this->Timelab = ClassRegistry::init("Timelab");
		$timelabs = $this->Timelab->find('all',array('conditions'=>array('Timelab.status'=>1),'order'=>array('Timelab.sequence ASC')));
		$time=explode('-',$timelabs[$health_detail['Health']['sample_time1']]['Timelab']['name']);
//$this->response('hello there----',200);
		$this->Lab = ClassRegistry::init("Lab");
		$pccDetail = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$health_detail['Health']['created_by'])));
		

		$referred_by = $health_detail['Health']['remark'];
		if(empty($health_detail['Health']['remark']))
			$referred_by = $user_detail['User']['name'];

		$dateTime = explode(" ",$health_detail['Health']['sample_collected_date']);
			$date =  date('d-m-Y',strtotime($dateTime[0]));
			$s_date_new = date('Y-m-d',strtotime($dateTime[0]));
			$datetime = $dateTime[1];

		$date=date('Y/m/d', strtotime($s_date_new))." ".$datetime;

	        $reference = "NPL".$billing_detail['Billing']['order_id'];
	        if(!empty($health_detail['Health']['reference']))
	            $reference = $health_detail['Health']['reference'];
	    
	    $patientTitle = '1';
	    if($health_detail['Health']['gender']=='2')
	    	$patientTitle = '3';
		
		$customerId = $health_detail['Health']['user_id'];
		if(!empty($health_detail['Health']['medical_reference_number']))
	            $customerId = $health_detail['Health']['medical_reference_number'];
		$comment ='';
		if(!empty($health_detail['Health']['remarks']))
			$comment = $health_detail['Health']['remarks'];
		else
			$comment = $health_detail['Health']['discount_amount_reason'];
			
		$data = array(
	            "APIKey"=> "PSBIONWTYKQ1298RTYQSW",
	            "APIUser"=> "APWTYCOMTY19ANPWTRNR",
	            "AgeGroup"=>0,
	            "AgeY"=> $health_detail['Health']['age'],
	            "Agegroup"=> "1",
	            "BookingID"=> $reference,
	            "CustomerID"=> $customerId,
	            "ClientType"=>$pccDetail['Lab']['client_type'],
		    	"CenterID"=>$pccDetail['Lab']['center_id'],
		    	"RegNumber"=>$pccDetail['Lab']['registration_number'],
	            "Comment"=> $comment." Order Intiated via Nhcare",
	            "IsUrgent"=> $health_detail['Health']['is_urgent'],
	            "MobileNumber"=> $health_detail['Health']['landline'],
	            "Patientname"=> $health_detail['Health']['name'],
	            "Father_Husband"=>$referred_by,
	            "PinCode"=> $health_detail['Health']['pincode'],
	            "SampleCollectionDate"=> $date,
	            "Title"=> $patientTitle,
	            "address"=> $health_detail['Health']['address'],
	            "address1"=> $health_detail['Health']['address1'],
	            "sex"=> $health_detail['Health']['gender'],
	            "Email"=>$health_detail['Health']['email'],
	            "TestList"=>$testList,
	            "Samples"=>$sampleList
	        );
//print_R(json_encode($data));die;
	        $ch = curl_init();
	        $curlConfig = array(
	            CURLOPT_URL            => "http://103.48.196.204:99/Nhcare/labmateservice.svc/Postorder",
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
	        curl_close($ch);
			$decoded_result = json_decode($result) ;

			
			$patient_id = $decoded_result->PatientId;
			if(!isset($patient_id) || empty($patient_id))
			{
				$this->response('API : Internal Server Error',500);
			}
			else
			{
				$update_query = $this->Health->query("UPDATE healths SET ref_num='".$patient_id."',sent_pathcorp='1',sent_pathcorp_admin='".$id."',last_edited='".$id."',last_edited_date='".date('Y-m-d H:i:s')."',netbilling='".$decoded_result->Netbilling."' WHERE id='".$this->_health_table_id."'");
			}
	}

        private function createUser()
        {
            $this->User = ClassRegistry::init("User");
            $this->LabPincodeServicibility = ClassRegistry::init("LabPincodeServicibility");
            $this->Pincodemaster = ClassRegistry::init("PincodeMaster");
   			/*$userDetail = $this->User->find('first',array('conditions'=>array('User.contact'=>$this->_request->contact_number)));
			if(!empty($userDetail))
			{
				$this->_user_table_id = $userDetail['User']['id'];
			}
			else
			{*/
				$parent_id = $this->User->find('first',array('conditions'=>array('User.associated_pcc'=> $this->_lab_id,'User.parent_child'=>'parent')));

				if($parent_id)
				{
					$this->data['User']['type'] = $parent_id['User']['type'];
					$this->data['User']['parent_id'] = $parent_id['User']['parent_id'];
					$this->data['User']['parent_child'] = "child";
				}
				
				$this->data['User']['associated_pcc'] = $parent_id['User']['associated_pcc'];

				$this->data['User']['email'] = !empty($this->_request->email) ? $this->_request->email : "";
				$this->data['User']['alternate_email'] = !empty($this->_request->alternate_email) ? $this->_request->alternate_email : "";
				$this->data['User']['status'] = 1;
				$this->data['User']['first_name'] = !empty($this->_request->first_name) ? $this->_request->first_name : "";
				$this->data['User']['last_name'] = !empty($this->_request->last_name) ? $this->_request->last_name : "";
				$this->data['User']['name'] = $this->data['User']['first_name']." ".$this->data['User']['last_name'];
				$gender_pre = substr(strtolower($this->_request->gender),0,1);
				if($gender_pre == 'm')
					$gender = 1;
				else
					$gender = 2;
				$this->data['User']['gender'] = $gender;
				$this->data['User']['age'] = $this->_request->age;
				$this->data['User']['contact'] = $this->_request->contact_number;
				$this->data['User']['alternate_contact'] = !empty($this->_request->alternate_contact) ? $this->_request->alternate_contact : "";
				$this->data['User']['address'] = $this->_request->address;
				$this->data['User']['locality'] = $this->_request->locality;
				$this->data['User']['username'] = strtolower($this->data['User']['first_name']).mt_rand(1000,9999);
				$this->data['User']['passwd'] = substr(strtolower($this->data['User']['first_name']),0,1).substr($this->data['User']['contact'],-4,4);
				$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
				$this->data['User']['pincode'] = !empty($this->_request->zip_code) ? $this->_request->zip_code :'';

				if($this->_request->zip_code)
				{
					$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$this->_request->zip_code)));
					if(empty($pincodeMaster))
					{
						$this->response('Invalid Pincode',406);
					}
					else
					{
						if($pincodeMaster['PincodeMaster']['servicable']!=1)
						{
							$this->response('Non Servicable Pincode',406);
						}
						else
						{
							$this->data['User']['city'] = $pincodeMaster['PincodeMaster']['city'];
							$this->data['User']['state'] = $pincodeMaster['PincodeMaster']['state'];	
						}
					}
				}
				else{
					if(empty($this->_request->zip_code))
					{
						$this->response('Empty Pincode',406);
					}
					else
					{
						$this->data['User']['city'] = !empty($this->_request->city) ? $this->_request->city :'0';
						$this->data['User']['state'] = !empty($this->_request->state) ? $this->_request->state :'0';	
					}
				}
				$this->data['User']['landmark'] = !empty($this->_request->landmark) ? $this->_request->landmark :'';
				$this->data['User']['created_by'] = $this->_lab_id;
				$this->User->create();

				if($this->User->save($this->data))
					$this->_user_table_id = $this->User->getLastInsertId();
				else
					$this->response('User Data Incomplete',406);
			//}
        }
        
        private function createHealth()
        {
        	$date = '';
			$time = '';
			$s_date_new = '';
			if(!isset($this->_request->sample_date))
			{
				$dateTime = explode(" ",$this->_request->sample_collected_date);
				$date =  date('d-m-Y',strtotime($dateTime[0]));
				$s_date_new = $dateTime[0];
				$time = $dateTime[1];
			}
			else
			{
				$date = date('d-m-Y',strtotime($this->_request->sample_date));
				$s_date_new = date('Y-m-d',strtotime($this->_request->sample_date));
			}

			if(!empty($this->_request->test_code))
			{
				$this->data['Health']['agent_id'] = 0;
				$this->data['Health']['user_id'] = $this->_user_table_id;
				$this->data['Health']['ref_num'] = '';
				$this->data['Health']['medical_reference_number'] = !empty($this->_request->mrn) ? $this->_request->mrn :0;
				$this->data['Health']['discount_id'] = 0;
				$this->data['Health']['discount_amount'] = !empty($this->_request->discount_amt) ? $this->_request->discount_amt :0;
				$this->data['Health']['discount_amount_reason'] = !empty($this->_request->remarks) ? $this->_request->remarks :'';
				$this->data['Health']['name'] = $this->data['User']['name'];
				$this->data['Health']['reference'] = !empty($this->_request->order_reference) ? $this->_request->order_reference :'';
				$gender_pre = substr(strtolower($this->_request->gender),0,1);
				if($gender_pre == 'm')
					$gender = 1;
				else
					$gender = 2;
				$this->data['Health']['gender'] = $gender;
				$this->data['Health']['age'] = $this->_request->age;       
				$this->data['Health']['landline'] = $this->_request->contact_number;
				$this->data['Health']['mobile'] = "";
				$this->data['Health']['email'] = !empty($this->_request->email) ? $this->_request->email : "";
				$this->data['Health']['address'] = $this->_request->address;
				$this->data['Health']['address1'] = $this->_request->address;
				$this->data['Health']['locality'] = $this->data['User']['locality'];
				
				$this->data['Health']['refered_by'] = !empty($this->_request->refered_by) ? $this->_request->refered_by :'';
				$this->data['Health']['market_value'] = !empty($this->_request->market_value) ? $this->_request->market_value :0;
				
				$this->data['Health']['prescription_url'] = !empty($this->_request->prescription_url) ? $this->_request->prescription_url :0;
				
				$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
				$this->data['Health']['pincode'] = !empty($this->_request->zip_code) ? $this->_request->zip_code :'';
				if($this->_request->zip_code)
				{
					$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$this->_request->zip_code)));
					$this->data['Health']['city_id'] = $pincodeMaster['PincodeMaster']['city'];
					$this->data['Health']['state'] = $pincodeMaster['PincodeMaster']['state'];	
					$this->data['Health']['visit_pat_city'] = $pincodeMaster['PincodeMaster']['city'];
				}
				else{
					$this->data['Health']['city_id'] = !empty($this->_request->city) ? $this->_request->city :'0';
					$this->data['Health']['state'] = !empty($this->_request->state) ? $this->_request->state :'0';	
					$this->data['Health']['visit_pat_city'] = !empty($this->_request->city) ? $this->_request->city :'0';
				}
				$this->data['Health']['landmark'] = !empty($this->_request->landmark) ? $this->_request->landmark :'0';
				$this->data['Health']['city'] = "";
				$this->data['Health']['s_date'] = $s_date_new;
				$this->data['Health']['test_id'] = "";
				$this->data['Health']['profile_id'] = "";
				$this->data['Health']['offer_id'] =      "";   
				$this->data['Health']['package_id'] =   "";
				$this->data['Health']['service_id'] = "";
				$this->data['Health']['sample_date'] = "";
				$this->data['Health']['sample_date1'] = $date;
				$this->data['Health']['sample_time'] = "";
				$this->data['Health']['sample_time1'] = !empty($this->_request->sample_time) ? $this->_request->sample_time :'1';
				$this->data['Health']['pay_status'] = 0;
				$this->data['Health']['total_amount'] = !empty($this->_request->net_amount) ? $this->_request->net_amount :0;
				$this->data['Health']['received_amount'] = !empty($this->_request->amount_collected) ? $this->_request->amount_collected :0;
				$this->data['Health']['balance_amount'] = 0;
				$this->data['Health']['balance_refund'] = 0;
				$this->data['Health']['refund_status'] = 0;
				$this->data['Health']['adj_reason'] = "";
				$this->data['Health']['btc_reason'] = "";
				$this->data['Health']['sent_pathcorp_admin'] = "";
				$this->data['Health']['agent_confirm'] = 0;
				$this->data['Health']['home_report'] = 0;
				$this->data['Health']['requ_status'] = 2;
				$this->data['Health']['status'] = 1;
				$this->data['Health']['created_by'] = $this->_lab_id;
				$this->data['Health']['patient_report'] = "";
				$this->data['Health']['assigned_lab'] = "";
				$this->data['Health']['message_status'] = "";
				$this->data['Health']['lab_message'] = "";
				$this->data['Health']['cod_status'] = "";
				$this->data['Health']['report_type'] = "";
				$this->data['Health']['partial_reason'] = "";
				$this->data['Health']['entry_status'] = 0;
				$this->data['Health']['last_edited'] = 0;
				$this->data['Health']['sent_pathcorp_admin'] = 0;
				$this->data['Health']['last_edited_date'] = "0000-00-00";
				$this->data['Health']['message_status'] = 0;
				$this->data['Health']['cod_status'] = 0;
				$this->data['Health']['remarks'] = "";
				$this->data['Health']['remark'] = "";
				$this->data['Health']['print_status'] = 0;
				$this->data['Health']['trf_status'] = 0;
				$this->data['Health']['register_sample'] = 0;
				$this->data['Health']['sent_pathcorp'] = 0;
				$this->data['Health']['receive_pathcorp'] = 0;
				$this->data['Health']['reschduled'] = 0;
				$this->data['Health']['cancelled_status'] = 0;
				$this->data['Health']['cancelled_reason'] = '';
				$this->data['Health']['published'] = 0;
				$this->data['Health']['published_reason'] = '';
				$this->data['Health']['old_date'] = '0000-00-00';
				$this->data['Health']['old_time'] = '';
				$this->data['Health']['book_date'] = date('Y-m-d H:i:s');
				$this->data['Health']['is_urgent'] = "false";

				$this->lab = ClassRegistry::init("Lab");
				$labs = $this->lab->find('first',array('conditions'=>array('Lab.id'=>$this->_lab_id)));
				
				$this->data['Health']['btc_no_payment_bill_to_company'] = $labs['Lab']['pcc_name'];
				if(isset($this->_request->serviced_pcc)&& $this->_request->serviced_pcc!='')
					$this->data['Health']['assigned_lab'] = $this->_request->serviced_pcc;
				else
					$this->data['Health']['assigned_lab'] = 'Home';
				$this->data['Health']['btc_reason'] = '';
				
				if(!empty($this->_request->payment_type))
				{
					$this->data['Health']['payment_type'] = $this->_request->payment_type;
					$this->data['Health']['amount_collected'] = $this->_request->amount_collected;
					$this->data['Health']['amount_to_be_collected'] = $this->_request->amount_to_be_collected;
					
					$this->data['Health']['balance_amount'] = !empty($this->_request->amount_to_be_collected) ? $this->_request->amount_to_be_collected :'0';
					$this->data['Health']['received_amount'] = !empty($this->_request->amount_collected) ? $this->_request->amount_collected :'0';
				}
				else
				{
					$this->data['Health']['balance_amount'] = 0;
					$this->data['Health']['received_amount'] = !empty($this->_request->payment_recieved) ? $this->_request->payment_recieved :'0';
				}
				
				$this->data['Health']['balance_refund'] = 0;
				$this->data['Health']['pay_status'] = 1;
					
				if(!empty($this->_request->Samples))
				{
					$this->data['Health']['agent_id'] = '83	';
					$this->data['Health']['requ_status'] = 10;
				}
				else
				{
					$this->data['Health']['requ_status'] = 15;
				}
				$sample_collected_date ='';
				if($time=='')
				{
					$this->Timelab = ClassRegistry::init("Timelab");
					$timelabs = $this->Timelab->find('all',array('conditions'=>array('Timelab.status'=>1),'order'=>array('Timelab.sequence ASC')));
					$time=explode('-',$timelabs[$this->data['Health']['sample_time1']]['Timelab']['name']);
					$sample_collected_date = $this->data['Health']['sample_date1']." ".$time[1];
				}
				else
					$sample_collected_date = $this->data['Health']['sample_date1']." ".$time;    

				$this->data['Health']['sample_collected_date'] = $sample_collected_date;

				if(!isset($this->_request->booking_mode))
					$this->_request->booking_mode = "4";
				else
					$this->_request->booking_mode = $this->_request->booking_mode;					

				$this->data['Health']['flags'] = $this->_request->booking_mode."000000000";
				
				$this->Health = ClassRegistry::init('Health');
				$this->Health->create();
	            //$this->response($this->data,200);
				if($this->Health->save($this->data))
				{
					$this->_health_table_id = $this->Health->getLastInsertId();
					$this->_json_data($this->_health_table_id,date('Y-m-d h:i:s'),"API NEW BOOKING",json_encode($this->_request),"-----");
					
					$this->_activity_log($this->_user_table_id,$this->_health_table_id,"New Order Added");
				}
				else
					$this->response('Health Data Incomplete',406);
			}
			else
				$this->response('Test Code cannot be empty',406);
        }
        
	private function createRequestTePr()
        {
            $this->Test = ClassRegistry::init('Test');
            $data = $this->Test->find('all',array('fields'=>array('id','type','mrp'),'conditions'=>array('Test.testcode'=>$this->_request->test_code,'Test.status'=>1)));
            if(count($data) > 0)
            {
                $this->RequestTest = ClassRegistry::init('RequestTest');
                foreach($data as $key=>$value)
                {
                    if($value['Test']['type'] == 'TEST')
                    {
                        $this->_test_ids[] = $value['Test']['id'];
                        $this->data['RequestTest']['type'] = 'TE';
                    }
                    elseif($value['Test']['type'] == 'PROFILE')
                    {
                        $this->_profile_ids[] = $value['Test']['id'];
                        $this->data['RequestTest']['type'] = 'PR';
                    }
                    else
                    {
                        $this->_service_ids[] = $value['Test']['id'];
                        $this->data['RequestTest']['type'] = 'SR';
                    }
                    $this->data['RequestTest']['health_id'] = $this->_health_table_id;
                    $this->data['RequestTest']['test_id'] = $value['Test']['id'];
                    $this->data['RequestTest']['mrp'] = $value['Test']['mrp'];
                    $this->data['RequestTest']['test_book_date'] = date('Y-m-d H:i:s');
                    $this->data['RequestTest']['status'] = 1;  
                    $this->_order_total_amt += $value['Test']['mrp'];
                    $this->RequestTest->create();
                    //$this->RequestTest->save($this->data);
                    if(!$this->RequestTest->save($this->data))
		            	$this->response('Request Test Data Incomplete',406);

                }
            }
            
            /*for package*/
            $this->Package = ClassRegistry::init('Package');
            $data = $this->Package->find('all',array('fields'=>array('id','package_mrp'),'conditions'=>array('Package.package_code'=>$this->_request->test_code,'Package.status'=>1)));
            if(count($data) > 0)
            {
                $this->RequestTest = ClassRegistry::init('RequestTest');
                foreach($data as $key=>$value)
                {
                    $this->_package_ids[] = $value['Package']['id'];
                    $this->data['RequestTest']['type'] = 'PA';
                                        
                    $this->data['RequestTest']['health_id'] = $this->_health_table_id;
                    $this->data['RequestTest']['test_id'] = $value['Package']['id'];
                    $this->data['RequestTest']['mrp'] = $value['Package']['package_mrp'];
                    $this->data['RequestTest']['test_book_date'] = date('Y-m-d H:i:s');
                    $this->data['RequestTest']['status'] = 1;  
                    $this->_order_total_amt += $value['Package']['package_mrp'];
                    $this->RequestTest->create();
                    //$this->RequestTest->save($this->data);
                    if(!$this->RequestTest->save($this->data))
		            	$this->response('Request Package Data Incomplete',406);
                }
            }
            
            /*for offers/banners*/
            $this->Banner = ClassRegistry::init('Banner');
            $data = $this->Banner->find('all',array('fields'=>array('id','banner_mrp'),'conditions'=>array('Banner.banner_code'=>$this->_request->test_code,'Banner.status'=>1)));
            if(count($data) > 0)
            {
                $this->RequestTest = ClassRegistry::init('RequestTest');
                foreach($data as $key=>$value)
                {
                    $this->_banner_ids[] = $value['Banner']['id'];
                    $this->data['RequestTest']['type'] = 'OF';
                                        
                    $this->data['RequestTest']['health_id'] = $this->_health_table_id;
                    $this->data['RequestTest']['test_id'] = $value['Banner']['id'];
                    $this->data['RequestTest']['mrp'] = $value['Banner']['banner_mrp'];
                    $this->data['RequestTest']['test_book_date'] = date('Y-m-d H:i:s');
                    $this->data['RequestTest']['status'] = 1;  
                    $this->_order_total_amt += $value['Banner']['banner_mrp'];
                    $this->RequestTest->create();
                    //$this->RequestTest->save($this->data);
                    if(!$this->RequestTest->save($this->data))
		            	$this->response('Request Banner Data Incomplete',406);
                }
            }
            
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
				if(isset($this->_request->amount_to_be_collected))
					$this->data['Health']['amount_to_be_collected'] = $this->_request->amount_to_be_collected;
				else
					$this->data['Health']['amount_to_be_collected'] = $health['Health']['total_amount'];

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
				$this->response('Health Updation Failed',406);
			}

			$health = $this->Health->find('first',array('conditions'=>array('Health.id'=>$this->_health_table_id)));
			
			if($lab['Lab']['auto_btc']==1 || $this->data['Health']['payment_type'] == 4)
			{
				$this->Paytrack = ClassRegistry::init('Paytrack');
				$this->Paytrack->create();
				
				$this->data1['Paytrack']['type'] = 'Receive';
				$this->data1['Paytrack']['admin_id'] = 1;
				$this->data1['Paytrack']['request_id'] = $health['Health']['id'];
				$this->data1['Paytrack']['pay_mode'] = "btcnopayment";
				$this->data1['Paytrack']['pay_install'] = $this->_request->net_amount;
				$this->data1['Paytrack']['c_number'] = '';
				$this->paydata['Paytrack']['receive_date'] = date('Y-m-d H:i:s');
				//print_R($this->data1);die;
				if(!$this->Paytrack->save($this->data1))
				{
					$this->response('Payment Data Incomplete',406);	
				}
				
				if(isset($this->_request->net_amount))
				{
					$update_amt = $this->Health->query("UPDATE healths SET payment_type='4',amount_collected='".$this->_request->net_amount."',amount_to_be_collected='0',received_amount='".$this->_request->net_amount."',balance_amount='0',btc_no_payment_remark=''".",pay_status='1',btc_no_payment_bill_to_company='".$lab['Lab']['pcc_name']."',last_edited_date='".date('Y-m-d H:i:s')."' WHERE id='".$health['Health']['id']."'");
				}
				else
				{
					$update_amt = $this->Health->query("UPDATE healths SET payment_type='4',amount_collected='".$health['Health']['total_amount']."',amount_to_be_collected='0',received_amount='".$health['Health']['total_amount']."',balance_amount='0',btc_no_payment_remark=''".",pay_status='1',btc_no_payment_bill_to_company='".$lab['Lab']['pcc_name']."',last_edited_date='".date('Y-m-d H:i:s')."' WHERE id='".$health['Health']['id']."'");
				}

			}
            //$this->Health->updateAll(array('Health.total_amount'=>$this->_order_total_amt,'Health.test_id'=>"'".$this->_test_ids."'",'Health.profile_id'=>"'".$this->_profile_ids."'",'Health.offer_id'=>"'".$this->_banner_ids."'",'Health.package_id'=>"'".$this->_package_ids."'",'Health.service_id'=>"'".$this->_service_ids."'"),array('Health.id'=>$this->_health_table_id));
        }
        
        private function createBilling()
        {
        	//print_R("create billing");die;
            $this->Billing = ClassRegistry::init('Billing');
            /*$data = $this->Billing->find('first',array('fields'=>array('Billing.order_id'),'order'=>array('Billing.order_id DESC')));
            $this->_order_id = $data['Billing']['order_id']+1;
            
            $checkdata = $this->Billing->find('first',array('conditions'=>array('Billing.order_id'=>$this->_order_id)));

            if(isset($checkdata['Billing']['order_id']))
            {
            	$this->_order_id = $checkdata['Billing']['order_id']+1;
            }*/
            $this->_order_id = $this->_health_table_id * 2;

            $this->data['Billing']['order_id'] = $this->_health_table_id * 2;
            $this->data['Billing']['request_id'] = $this->_health_table_id;
            $this->data['Billing']['user_id'] = $this->_user_table_id;
            $this->data['Billing']['test_id'] = $this->_test_ids;
            $this->data['Billing']['profile_id'] = $this->_profile_ids;
            $this->data['Billing']['offer_id'] = $this->_banner_ids;
            $this->data['Billing']['package_id'] = $this->_package_ids;
            $this->data['Billing']['service_id'] = $this->_service_ids;
            $this->data['Billing']['first_name'] = $this->data['User']['name'];
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
            
            if(!$this->Billing->save($this->data))
            {
            	$this->response('Incomplete Billing Data',406);	
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
        
    public function validateAuthorizationCode()
	{
		$this->Api = ClassRegistry::init("Api");
                $this->Api->bindModel(array(
			'belongsTo'=>array(
				'Lab'=>array(
				'className'=>'Lab',
				'foreignKey'=>'pcc_id',
				'fields'=>array('Lab.id')
				)
			)
		));
		$data = $this->Api->find("first",array("conditions"=>array("authorization"=>$this->_request->authorization)));
                
		if(isset($data['Api']['id']) && !empty($data['Api']['id']))
		{
			if($data['Api']['status_id'] != 1)
			{ 
				$this->response('',102);
			}
			else
			{
				$this->_pcc_id = $data['Api']['pcc_id'];
                                $this->_lab_id = $data['Lab']['id'];
			}
			
		}
		else
		{ 
			$this->response('',101);
		}
		
	}
	
	private function saveResponseData($response)
	{
		$this->ApiResponse = ClassRegistry::init("ApiResponse");
		$this->data['ApiResponse']['response'] = serialize($response);
		$this->data['ApiResponse']['pcc_id'] = $this->_pcc_id;
		$this->data['ApiResponse']['request'] = serialize($this->_request);
		$this->data['ApiResponse']['remote_ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
		$this->data['ApiResponse']['created_on'] = date('Y-m-d H:i:s');
		$this->ApiResponse->create();
		$this->ApiResponse->save($this->data);
	}
	
	private function dropletnotification()
	{
		$this->_request = json_decode($this->cleanInputs(file_get_contents('php://input')));

		/*$headers=array();
		foreach (getallheaders() as $name => $value) {
			$headers[$name] = $value;
		} */
		//print_R($_SERVER);die;
		//$this->Api = ClassRegistry::init("Api");
		//$data = $this->Api->find("first",array("conditions"=>array("authorization"=>$headers['Authorization'])));
		
		/*if($data['Api']['pcc_id']=="121")
		{*/
			$this->Health = ClassRegistry::init('Health');
			$health_detail = $this->Health->find('first',array('conditions'=>array('Health.reference'=>$this->_request->order_reference_id)));
			
			$this->PhleboConfirmedNotify = ClassRegistry::init('PhleboConfirmedNotify');
			
			$lab_message='';
			
			if($this->_request->call_type=='schedule')
			{
				$this->PhleboConfirmedNotify->query("delete from phlebo_confirmed_notify where health_id='".$health_detail['Health']['id']."'");
				
				$lab_message = "Droplet Id - ".$this->_request->order_id." <br> Phelbo Name - ".$this->_request->fe_name."<br> Phelbo Number - ".$this->_request->fe_mobile_number."<br>Collection Time - ".date('d-m-Y h:i:s',$this->_request->collection_time);
				$this->PhleboConfirmedNotify->create();
				$this->data['PhleboConfirmedNotify']['health_id'] =  $health_detail['Health']['id'];
				$this->data['PhleboConfirmedNotify']['name'] =  $this->_request->fe_name;
				$this->data['PhleboConfirmedNotify']['phone'] =  $this->_request->fe_mobile_number;
				$this->data['PhleboConfirmedNotify']['tracking_url'] =  "";
				$this->data['PhleboConfirmedNotify']['date'] =  date('Y-m-d h:i:s');
				
				$this->PhleboConfirmedNotify->save($this->data);
				
				$this->Health->query("update healths set requ_status='19' where id='".$health_detail['Health']['id']."'");
			}
			
			if($this->_request->call_type=='sample_collected')
			{
				$lab_message = "Droplet Id - ".$this->_request->order_id." Specimen Collected";
				$this->Health->query("update healths set requ_status='16' where id='".$health_detail['Health']['id']."'");
			}
			
			if($this->_request->call_type=='cancelled')
			{
				$lab_message = "Droplet Id - ".$this->_request->order_id." Cancelled by Droplet {".$this->_request->cancel_reason."}";
			}
			
			if($this->_request->call_type=='delivered')
			{
				$lab_message = "Droplet Id - ".$this->_request->order_id." Delivered By Droplet";
			}
			
			if($this->_request->call_type=='ReportUpload')
			{
				$lab_message = "Droplet Id - ".$this->_request->order_id." Report Uploaded";
			}
			
			if($this->_request->call_type=='PatientDetail')
			{
				if($this->_request->gender == "female")
					$gender = 2;
				else
					$gender = 1;
				
				$lab_message = "Droplet Id - ".$this->_request->order_id." Updated Patient Details as Per JSON";	
				$this->Health->query("update healths set gender='".$gender."',name='".$this->_request->patient_name."',age='".$this->_request->age."',landline='".$this->_request->mobile_number."' where id='".$health_detail['Health']['id']."'");
			}
			
			if($this->_request->call_type=='PreferDateChange')
			{
				$lab_message = "Droplet Id - ".$this->_request->order_id." Preferred Date Changed";	
				
				$collect_time = Configure::read('TimeSlot');
				$sample_time = date('H:i:s',$this->_request->collection_time);
				$new_date = date('d-m-Y',$this->_request->collection_time);
				
				$new_time = "";
				
				foreach($collect_time as $key=>$val)
				{
					$time = explode(" - ",$val);
					if(strtotime($time[0])<strtotime($sample_time) && strtotime($time[1])> strtotime($sample_time))
						$new_time = $key;
				}
				$this->Health->query("update healths set sample_date1='".$new_date."',sample_time1=".$new_time.",requ_status='13' where id='".$health_detail['Health']['id']."'");
			}
			
			if($this->_request->call_type=='EditOrder')
			{
				$lab_message = "Droplet Id - ".$this->_request->order_id." Updated Order Details as Per JSON";			
			}
			
			if($this->_request->call_type=='TrackingPhlebo')
			{
				$lab_message = "Droplet Id - ".$this->_request->order_id." Tracking Phelbo Url - ".$this->_request->trackLink;			
				
				$this->PhleboConfirmedNotify->query("update phlebo_confirmed_notify set tracking_url='".$this->_request->trackLink."' where health_id='".$health_detail['Health']['id']."'");
				$this->Health->query("update healths set requ_status='20' where id='".$health_detail['Health']['id']."'");
			}
			
			if($this->_request->call_type=='sent_to_lab')
			{
				$lab_message = "Droplet Id - ".$this->_request->order_id." Sent To Lab";			
			}
			
			if($this->_request->call_type=='specimen_hold')
			{
				$lab_message = "Droplet Id - ".$this->_request->order_id." Specimen Holded";
				$this->Health->query("update healths set requ_status='21' where id='".$health_detail['Health']['id']."'");
			}
			
			if($this->_request->call_type=='BarcodeEntry')
			{
				$lab_message = "Droplet Id - ".$this->_request->order_id." Barcode Entered";
			}
			
			$this->LabMessageMaster = ClassRegistry::init('LabMessageMaster');
			$this->LabMessageMaster->create();
			
			$this->data['LabMessageMaster']['request_id'] = $health_detail['Health']['id'];
			$this->data['LabMessageMaster']['date'] = date('Y-m-d H:i:s');
			$this->data['LabMessageMaster']['message'] = $lab_message;
			$this->data['LabMessageMaster']['json'] = json_encode($this->_request);
			$this->data['LabMessageMaster']['user'] = 'Droplet';
			
			$this->LabMessageMaster->save($this->data);
			
			$this->Health->query("update healths set lab_message='".$lab_message."' where id='".$health_detail['Health']['id']."'");
			
			$this->Lab = ClassRegistry::init('Lab');

			$lab_data = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$health_detail['Health']['created_by'])));

			if($lab_data['Lab']['send_push_notification'] == 1)
			{
				$response = $this->send_notification($health_detail['Health']['id']);
			}

			$this->response('Success',200);
		/*}
		else
		{
			$this->response('',101);
		}*/
	}
	
	private function addprescription()
	{
		$this->Api = ClassRegistry::init("Api");
		$data = $this->Api->find("first",array("conditions"=>array("authorization"=>$this->_request->authorization)));
		
		$this->_request = json_decode($this->cleanInputs(file_get_contents('php://input')));
		$this->PrescriptionMaster = ClassRegistry::init("PrescriptionMaster");
		$this->PrescriptionMaster->create();
		$this->data['PrescriptionMaster']['prescription_id'] = 'P-'.strtotime(date('Y-m-d h:i:s'));
		$this->data['PrescriptionMaster']['first_name'] = $this->_request->first_name;
		$this->data['PrescriptionMaster']['last_name'] = $this->_request->last_name;
		$this->data['PrescriptionMaster']['gender`'] = $this->_request->gender;
		$this->data['PrescriptionMaster']['age'] = $this->_request->age;
		$this->data['PrescriptionMaster']['contact_number'] = $this->_request->contact_number;
		$this->data['PrescriptionMaster']['alternate_contact'] = $this->_request->alternate_contact;
		$this->data['PrescriptionMaster']['mrn'] = $this->_request->mrn;
		$this->data['PrescriptionMaster']['email'] = $this->_request->email;
		$this->data['PrescriptionMaster']['estimate_reference'] = $this->_request->estimate_reference;
		$this->data['PrescriptionMaster']['referred_by'] = $this->_request->referred_by;
		$this->data['PrescriptionMaster']['prescription_url'] = $this->_request->prescription_url;
		$this->data['PrescriptionMaster']['remarks'] = $this->_request->remarks;
		$this->data['PrescriptionMaster']['created_by'] = $data['Api']['pcc_id']; // id of pcc will be here
		$this->data['PrescriptionMaster']['status'] = 1;
		$this->data['PrescriptionMaster']['date'] = date('Y-m-d h:i:s');
		$this->data['PrescriptionMaster']['order_type'] = 'Online';
		
		if($this->PrescriptionMaster->save($this->data))
		{
			$this->response($this->data['PrescriptionMaster']['prescription_id'],200);
		}
		else
		{
			$this->response('Unable to Save',500);
		}			
		
		print_R(json_encode($this->_request));die;
	}
	
	public function verifyAuth($auth)
	{
		//print_R($_GET);die;
		$this->Api = ClassRegistry::init("Api");
        $this->Api->bindModel(array(
			'belongsTo'=>array(
				'Lab'=>array(
				'className'=>'Lab',
				'foreignKey'=>'pcc_id',
				'fields'=>array('Lab.id')
				)
			)
		));
		$data = $this->Api->find("first",array("conditions"=>array("authorization"=>$auth)));
                //print_R($data);die;
		if(isset($data['Api']['id']) && !empty($data['Api']['id']))
		{
			if($data['Api']['status_id'] != 1)
			{ 
				$this->response('',102);
			}
			else
			{
				$this->_pcc_id = $data['Api']['pcc_id'];
                $this->_lab_id = $data['Lab']['id'];
			}
			
		}
		else
		{ 
			$this->response('',101);
		}
	}		
	
	private function getpincode()
	{
		//$this->response($this->get_request_method(),302);
		switch($this->get_request_method())
            {
                case 'GET':
                        $this->_request = json_decode($this->cleanInputs(file_get_contents('php://input')));
                        
                        if(empty($this->_request->authorization))
                        	$this->_request->authorization = $_GET['authorization'];
                        if(empty($this->_request->pincode))
                        	$this->_request->pincode = $_GET['pincode'];

                        $this->validateAuthorizationCode();
						$data = $this->search_pincode();
                        break;
                default:
                        $this->response('',405);
                        break;
            }
	}
	
	public function search_pincode()
	{
		//return $this->_request->pincode;
		$this->PlabPincodeMaster = ClassRegistry::init('PlabPincodeMaster');
		$this->PincodeMaster = ClassRegistry::init('PincodeMaster');
		$this->PincodeReport = ClassRegistry::init('PincodeReport');
		$this->State = ClassRegistry::init("State");
		$this->City = ClassRegistry::init("City");
		
		$pincode = $this->PincodeMaster->find("first",array('conditions'=>array('PincodeMaster.pincode'=>$this->_request->pincode)));
		
		$pincode_report = $this->PincodeReport->create();
		
		$pincode_report['PincodeReport']['created_on'] = date('Y-m-d H:i:s');
		$pincode_report['PincodeReport']['pincode'] = $this->_request->pincode;
		$pincode_report['PincodeReport']['lab_id'] = $this->_lab_id;
		
		$result = array();
		if($pincode)
		{
			$city = $this->City->find('first',array('conditions'=>array('City.id'=>$pincode['PincodeMaster']['city'])));
			$state = $this->State->find('first',array('conditions'=>array('State.id'=>$pincode['PincodeMaster']['state'])));
			//$selectedpincode = $this->PlabPincodeMaster->find("first",array('conditions'=>array('PlabPincodeMaster.pincode_id'=>$this->_request->pincode)));

			if($pincode['PincodeMaster']['servicable']==1)//$selectedpincode
			{
				$this->_code = 200;
				$pincode_report['PincodeReport']['pin_status'] = 'Active';
				$result = array('code'=>$this->_code,'message'=>$this->get_status_message(),'pincode'=>$this->_request->pincode,'city'=>$city['City']['name'],'state'=>$state['State']['name']);
			}
			else
			{
				$this->_code = 306;
				$pincode_report['PincodeReport']['pin_status'] = 'Not Servicable';
				$result = array('code'=>$this->_code,'message'=>$this->get_status_message(),'result'=>'Pincode Not Servicable');
			}
		}
		else
		{
			$this->_code = 406;
			$pincode_report['PincodeReport']['pin_status'] = 'Incorrect Pincode';
			$result = array('code'=>$this->_code,'message'=>$this->get_status_message(),'result'=>'Incorrect Pincode');
		}
		
		$pincode_report['PincodeReport']['status_code'] = $this->_code;
		
		$this->PincodeReport->save($pincode_report);
		
		$this->saveResponseData($result);
		$this->set_headers();
		echo json_encode($result);
		exit;
	}
	
	/*private function getpincode()
	{
		switch($this->get_request_method())
            {
                case 'GET':
                      	$this->verifyAuth($_GET['authorization']);
						$data = $this->search_pincode($_GET['pincode']);
                        break;
                default:
                        $this->response('',405);
                        break;
            }
	}
	
	public function search_pincode($pin)
	{
		//return $this->_request->pincode;
		$this->PlabPincodeMaster = ClassRegistry::init('PlabPincodeMaster');
		$this->PincodeMaster = ClassRegistry::init('PincodeMaster');
		$this->PincodeReport = ClassRegistry::init('PincodeReport');
		$this->State = ClassRegistry::init("State");
		$this->City = ClassRegistry::init("City");
		
		$pincode = $this->PincodeMaster->find("first",array('conditions'=>array('PincodeMaster.pincode'=>$pin)));
		
		$pincode_report = $this->PincodeReport->create();
		
		$pincode_report['PincodeReport']['created_on'] = date('Y-m-d H:i:s');
		$pincode_report['PincodeReport']['pincode'] = $pin;
		$pincode_report['PincodeReport']['lab_id'] = $this->_lab_id;
		//print_R($pincode_report);die;
		$result = array();
		if($pincode)
		{
			$city = $this->City->find('first',array('conditions'=>array('City.id'=>$pincode['PincodeMaster']['city'])));
			$state = $this->State->find('first',array('conditions'=>array('State.id'=>$pincode['PincodeMaster']['state'])));
			//$selectedpincode = $this->PlabPincodeMaster->find("first",array('conditions'=>array('PlabPincodeMaster.pincode_id'=>$this->_request->pincode)));
			
			if($pincode['PincodeMaster']['servicable']==1)//$selectedpincode
			{
				$this->_code = 200;
				$pincode_report['PincodeReport']['pin_status'] = 'Active';
				$result = array('code'=>$this->_code,'message'=>$this->get_status_message(),'pincode'=>$pin,'city'=>$city['City']['name'],'state'=>$state['State']['name']);
			}
			else
			{
				$this->_code = 306;
				$pincode_report['PincodeReport']['pin_status'] = 'Not Servicable';
				$result = array('code'=>$this->_code,'message'=>$this->get_status_message(),'result'=>'Pincode Not Servicable');
			}
		}
		else
		{
			$this->_code = 406;
			$pincode_report['PincodeReport']['pin_status'] = 'Incorrect Pincode';
			$result = array('code'=>$this->_code,'message'=>$this->get_status_message(),'result'=>'Incorrect Pincode');
		}
		
		$pincode_report['PincodeReport']['status_code'] = $this->_code;
		
		$this->PincodeReport->save($pincode_report);
		
		$this->saveResponseData($result);
		$this->set_headers();
		echo json_encode($result);
		exit;
	}*/
	
	function _json_data($healthid,$date,$action,$request,$response)
	{
		$this->JsonData = ClassRegistry::init("JsonData");
		$this->data['JsonData']['health_id'] = $healthid;
		$this->data['JsonData']['date'] = $date;
		$this->data['JsonData']['action'] = $action;
		$this->data['JsonData']['request_data']= $request;
		$this->data['JsonData']['response_data']= $response;
		if($this->JsonData->create($this->data))
		{
			$this->JsonData->save($this->data);
		}
	}
	
	function writelog($content){
		$file = '/home2/niramovh/public_html/app/webroot/files/log/itwohnotification.txt';
		file_put_contents($file,$content, FILE_APPEND);
	}
	
	private function itwoh_notification()
	{
		$this->_request = $this->cleanInputs(file_get_contents('php://input'));
		
		$this->_request = trim($this->_request, '[');
		$this->_request = trim($this->_request, ']');
		$this->_request = json_decode($this->_request);
		$this->writelog(date('d-m-Y h:i:s'));
		$this->writelog("-------");
		$this->writelog(json_encode($this->_request));
		$this->writelog("-------");
		$this->writelog($this->_request->sealNbr);
		$this->writelog("\n");
		
		$this->Health = ClassRegistry::init('Health');
		$health_detail = $this->Health->find('first',array('conditions'=>array('Health.reference'=>$this->_request->sealNbr)));
		
		$this->PhleboConfirmedNotify = ClassRegistry::init('PhleboConfirmedNotify');
		
		$lab_message='';
		
		if($this->_request->status=='Load Assigned')
		{
			$lab_message = "Load Assigned(".$this->_request->statusCode.") I2H Id - ".$this->_request->sealNbr." <br> Phelbo Name - ".$this->_request->agentAssignedPersonName."<br> Phelbo Number - ".$this->_request->agentAssignedMobileNumber."<br>Collection Time - ".date('d-m-Y h:i:s',$this->_request->statusChangeDate/1000);
			$this->PhleboConfirmedNotify->create();
			$this->data['PhleboConfirmedNotify']['health_id'] =  $health_detail['Health']['id'];
			$this->data['PhleboConfirmedNotify']['name'] =  $this->_request->agentAssignedPersonName;
			$this->data['PhleboConfirmedNotify']['phone'] =  $this->_request->agentAssignedMobileNumber;
			$this->data['PhleboConfirmedNotify']['tracking_url'] =  "";
			$this->data['PhleboConfirmedNotify']['date'] =  date('Y-m-d h:i:s');
			
			$this->PhleboConfirmedNotify->save($this->data);
			
			$this->Health->query("update healths set requ_status='19' where id='".$health_detail['Health']['id']."'");
		}
		
		if($this->_request->status=='Stop Arrival')
		{
			$lab_message = "Stop Arrival(".$this->_request->statusCode.") I2H Id - ".$this->_request->sealNbr." <br> Phelbo Name - ".$this->_request->agentAssignedPersonName."<br> Phelbo Number - ".$this->_request->agentAssignedMobileNumber."<br>Collection Time - ".date('d-m-Y h:i:s',$this->_request->statusChangeDate/1000);
			$this->PhleboConfirmedNotify->create();
			$this->data['PhleboConfirmedNotify']['health_id'] =  $health_detail['Health']['id'];
			$this->data['PhleboConfirmedNotify']['name'] =  $this->_request->agentAssignedPersonName;
			$this->data['PhleboConfirmedNotify']['phone'] =  $this->_request->agentAssignedMobileNumber;
			$this->data['PhleboConfirmedNotify']['tracking_url'] =  "";
			$this->data['PhleboConfirmedNotify']['date'] =  date('Y-m-d h:i:s');
			
			$this->PhleboConfirmedNotify->save($this->data);
			
		}
		
		if($this->_request->status=='Signature Confirmation')
		{
			$lab_message = "Signature Confirmation(".$this->_request->statusCode.") I2H Id - ".$this->_request->sealNbr." <br> Phelbo Name - ".$this->_request->agentAssignedPersonName."<br> Phelbo Number - ".$this->_request->agentAssignedMobileNumber."<br>Collection Time - ".date('d-m-Y h:i:s',$this->_request->statusChangeDate/1000);
			$this->PhleboConfirmedNotify->create();
			$this->data['PhleboConfirmedNotify']['health_id'] =  $health_detail['Health']['id'];
			$this->data['PhleboConfirmedNotify']['name'] =  $this->_request->agentAssignedPersonName;
			$this->data['PhleboConfirmedNotify']['phone'] =  $this->_request->agentAssignedMobileNumber;
			$this->data['PhleboConfirmedNotify']['tracking_url'] =  "";
			$this->data['PhleboConfirmedNotify']['date'] =  date('Y-m-d h:i:s');
			
			$this->PhleboConfirmedNotify->save($this->data);
			
		}
		
		if($this->_request->status=='Stop Departure')
		{
			$lab_message = "Stop Departure(".$this->_request->statusCode.") I2H Id - ".$this->_request->sealNbr." <br> Phelbo Name - ".$this->_request->agentAssignedPersonName."<br> Phelbo Number - ".$this->_request->agentAssignedMobileNumber."<br>Collection Time - ".date('d-m-Y h:i:s',$this->_request->statusChangeDate/1000);
			$this->PhleboConfirmedNotify->create();
			$this->data['PhleboConfirmedNotify']['health_id'] =  $health_detail['Health']['id'];
			$this->data['PhleboConfirmedNotify']['name'] =  $this->_request->agentAssignedPersonName;
			$this->data['PhleboConfirmedNotify']['phone'] =  $this->_request->agentAssignedMobileNumber;
			$this->data['PhleboConfirmedNotify']['tracking_url'] =  "";
			$this->data['PhleboConfirmedNotify']['date'] =  date('Y-m-d h:i:s');
			
			$this->PhleboConfirmedNotify->save($this->data);
			
		}
		
		if($this->_request->status=='Stop Confirmation')
		{
			$lab_message = "Stop Confirmation(".$this->_request->statusCode.") I2H Id - ".$this->_request->sealNbr." <br> Phelbo Name - ".$this->_request->agentAssignedPersonName."<br> Phelbo Number - ".$this->_request->agentAssignedMobileNumber."<br>Collection Time - ".date('d-m-Y h:i:s',$this->_request->statusChangeDate/1000);
			$this->PhleboConfirmedNotify->create();
			$this->data['PhleboConfirmedNotify']['health_id'] =  $health_detail['Health']['id'];
			$this->data['PhleboConfirmedNotify']['name'] =  $this->_request->agentAssignedPersonName;
			$this->data['PhleboConfirmedNotify']['phone'] =  $this->_request->agentAssignedMobileNumber;
			$this->data['PhleboConfirmedNotify']['tracking_url'] =  "";
			$this->data['PhleboConfirmedNotify']['date'] =  date('Y-m-d h:i:s');
			
			$this->PhleboConfirmedNotify->save($this->data);
			
			$spec_date = date('Y-m-d h:i:s',(strtotime($this->_request->statusChangeDate/1000)));
			$datetime = explode(" ",$spec_date);
			$this->Health->query('update healths set requ_status="16" ,specimen_date="'.$datetime[0].'",specimen_time="'.$datetime[1].'",specimen_by="'.$this->_request->agentAssignedPersonName.'",specimen_remarks="'.$this->_request->stopDetails.'" where id="'.$health_detail['Health']['id'].'"');				
		}
		
		if($this->_request->status=='Stop Closed')
		{
			$lab_message = "Stop Closed(".$this->_request->statusCode.") I2H Id - ".$this->_request->sealNbr." <br> Phelbo Name - ".$this->_request->agentAssignedPersonName."<br> Phelbo Number - ".$this->_request->agentAssignedMobileNumber."<br>Collection Time - ".date('d-m-Y h:i:s',$this->_request->statusChangeDate/1000)."<br>Closed Reason - ".$this->_request->closedReason."<br>Common - ".$this->_request->comment;
			$this->PhleboConfirmedNotify->create();
			$this->data['PhleboConfirmedNotify']['health_id'] =  $health_detail['Health']['id'];
			$this->data['PhleboConfirmedNotify']['name'] =  $this->_request->agentAssignedPersonName;
			$this->data['PhleboConfirmedNotify']['phone'] =  $this->_request->agentAssignedMobileNumber;
			$this->data['PhleboConfirmedNotify']['tracking_url'] =  "";
			$this->data['PhleboConfirmedNotify']['date'] =  date('Y-m-d h:i:s');
			
			$this->PhleboConfirmedNotify->save($this->data);
			
			$this->Health->query("update healths set requ_status='22' where id='".$health_detail['Health']['id']."'");
		}
		
		if($this->_request->status=='Rejected By Carrier')
		{
			$lab_message = "Rejected By Carrier(".$this->_request->statusCode.") I2H Id - ".$this->_request->sealNbr." <br> Phelbo Name - ".$this->_request->agentAssignedPersonName."<br> Phelbo Number - ".$this->_request->agentAssignedMobileNumber."<br>Collection Time - ".date('d-m-Y h:i:s',$this->_request->statusChangeDate/1000)."<br>Rejected Reason - ".$this->_request->rejectedReason;
			$this->PhleboConfirmedNotify->create();
			$this->data['PhleboConfirmedNotify']['health_id'] =  $health_detail['Health']['id'];
			$this->data['PhleboConfirmedNotify']['name'] =  $this->_request->agentAssignedPersonName;
			$this->data['PhleboConfirmedNotify']['phone'] =  $this->_request->agentAssignedMobileNumber;
			$this->data['PhleboConfirmedNotify']['tracking_url'] =  "";
			$this->data['PhleboConfirmedNotify']['date'] =  date('Y-m-d h:i:s');
			
			$this->PhleboConfirmedNotify->save($this->data);
			
			$this->Health->query("update healths set requ_status='23' where id='".$health_detail['Health']['id']."'");
		}
		
		$this->LabMessageMaster = ClassRegistry::init('LabMessageMaster');
		$this->LabMessageMaster->create();
		
		$this->data['LabMessageMaster']['request_id'] = $health_detail['Health']['id'];
		$this->data['LabMessageMaster']['date'] = date('Y-m-d H:i:s');
		$this->data['LabMessageMaster']['message'] = $lab_message;
		$this->data['LabMessageMaster']['json'] = json_encode($this->_request);
		$this->data['LabMessageMaster']['user'] = 'I2H API';
		
		if($this->LabMessageMaster->save($this->data))
		{
			$this->Health->query("update healths set lab_message='".$lab_message."' where id='".$health_detail['Health']['id']."'");
			$this->response('Success',200);
		}
		else
		{
			$this->response('Failure',400);
		}
	}
	
	function lab_message($health_detail,$lab_message,$request_data,$lab_name)
	{
		$this->LabMessageMaster = ClassRegistry::init('LabMessageMaster');
		$this->LabMessageMaster->create();
		
		$this->data['LabMessageMaster']['request_id'] = $health_detail['Health']['id'];
		$this->data['LabMessageMaster']['date'] = date('Y-m-d H:i:s');
		$this->data['LabMessageMaster']['message'] = $lab_message;
		$this->data['LabMessageMaster']['json'] = json_encode($request_data);
		$this->data['LabMessageMaster']['user'] = $lab_name.' API';
		
		if($this->LabMessageMaster->save($this->data))
		{
			$this->Health->query("update healths set lab_message='".$lab_message."' where id='".$health_detail['Health']['id']."'");
			$this->response('Success',200);
		}
		else
		{
			$this->response('Failure',400);
		}
	}
	
	private function pcc_notification()
	{
		$this->_request = json_decode($this->cleanInputs(file_get_contents('php://input')));
		
		$file = '/home2/niramovh/public_html/app/webroot/files/log/pcc_notification.txt';
		file_put_contents($file,"\n", FILE_APPEND);
		file_put_contents($file,date('Y-m-d H:i:s')."\n", FILE_APPEND);
		file_put_contents($file,json_encode($this->_request), FILE_APPEND);
		file_put_contents($file,"\n\n", FILE_APPEND);

		$this->validateAuthorizationCode();
		
		$this->Lab = ClassRegistry::init('Lab');
		$lab_detail = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$this->_pcc_id)));
		
		$this->Health = ClassRegistry::init('Health');
		$health_detail = $this->Health->find('first',array('conditions'=>array('Health.reference'=>$this->_request->reference)));
		//print_R(json_encode($lab_detail));die;
		if(empty($health_detail))
			$this->response('No Order Found with Reference Number - '.$this->_request->reference,400);
		
		$this->PhleboConfirmedNotify = ClassRegistry::init('PhleboConfirmedNotify');
		
		$lab_message='';
		
		if($this->_request->status=="Request Cancelled")
		{
			if($health_detail['Health']['requ_status']!=22)
			{
				$lab_message = "Order Cancelled, Lab Name - ".$lab_detail['Lab']['pcc_name']." Reference Id - ".$this->_request->reference." <br>Closed Reason - ".$this->_request->closedReason;
				$this->Health->query("update healths set requ_status='22' where id='".$health_detail['Health']['id']."'");
			}
			else
				$this->response('Order Already Cancelled',400);
		}

		if($this->_request->status=="Request Rescheduled")
		{
			$collect_time = Configure::read('TimeSlot');
			$sample_time = date('H:i:s',$this->_request->new_date);
			$new_date = date('d-m-Y',$this->_request->new_date);
			
			$new_time = "";
			
			foreach($collect_time as $key=>$val)
			{
				$time = explode(" - ",$val);
				if(strtotime($time[0])<strtotime($sample_time) && strtotime($time[1])> strtotime($sample_time))
					$new_time = $key;
			}
			
			$lab_message = "Order Rescheduled, Lab Name - ".$lab_detail['Lab']['pcc_name']." Reference Id - ".$this->_request->reference." <br> Old Date - ".date('d-m-Y H:i:s',$this->_request->old_date)."<br> New date - ".$new_date." ".$new_time;
			
			$this->Health->query("update healths set sample_date1='".$new_date."',sample_time1=".$new_time.",requ_status='13' where id='".$health_detail['Health']['id']."'");
		}
		
		if($this->_request->status=='Phlebo Assigned')
		{
			$this->PhleboConfirmedNotify->query("delete from phlebo_confirmed_notify where health_id='".$health_detail['Health']['id']."'");
			
			if(isset($this->_request->collection_time))
			{
				$lab_message = $lab_detail['Lab']['pcc_name']." Ref Id - ".$this->_request->reference." <br> Phelbo Name - ".$this->_request->fe_name."<br> Phelbo Number - ".$this->_request->fe_mobile_number."<br>Collection Time - ".date('d-m-Y h:i:s',$this->_request->collection_time/1000)." Phlebo Assigned";
			}
			else
			{
				$lab_message = $lab_detail['Lab']['pcc_name']." Ref Id - ".$this->_request->reference." <br> Phelbo Name - ".$this->_request->fe_name."<br> Phelbo Number - ".$this->_request->fe_mobile_number."<br>Collection Time - ".date('d-m-Y h:i:s')." Phlebo Assigned";	
			}
			$this->PhleboConfirmedNotify->create();
			$this->data['PhleboConfirmedNotify']['health_id'] =  $health_detail['Health']['id'];
			$this->data['PhleboConfirmedNotify']['name'] =  $this->_request->fe_name;
			$this->data['PhleboConfirmedNotify']['phone'] =  $this->_request->fe_mobile_number;
			$this->data['PhleboConfirmedNotify']['tracking_url'] =  "";
			$this->data['PhleboConfirmedNotify']['date'] =  date('Y-m-d h:i:s');
			
			$this->PhleboConfirmedNotify->save($this->data);
			
			$this->Health->query("update healths set requ_status='4' where id='".$health_detail['Health']['id']."'");
		}

		if($this->_request->status=='Phlebo Confirmed')
		{
			$this->PhleboConfirmedNotify->query("delete from phlebo_confirmed_notify where health_id='".$health_detail['Health']['id']."'");
			
			$lab_message = $lab_detail['Lab']['pcc_name']." Ref Id - ".$this->_request->reference." <br> Phelbo Name - ".$this->_request->fe_name."<br> Phelbo Number - ".$this->_request->fe_mobile_number."<br>Collection Time - ".date('d-m-Y h:i:s',$this->_request->collection_time/1000)." Phlebo Confirmed with otp".$this->_request->otp."";
			
			$this->Health->query("update healths set requ_status='19' where id='".$health_detail['Health']['id']."'");
		}
		
		if($this->_request->status=='Sample Collected')
		{
			$lab_message = $lab_detail['Lab']['pcc_name']." Ref Id - ".$this->_request->reference." Specimen Collected";
			$this->Health->query("update healths set requ_status='16' where id='".$health_detail['Health']['id']."'");
		}
		
		if($this->_request->status=='Delivered')
		{
			$lab_message = $lab_detail['Lab']['pcc_name']." Ref Id - ".$this->_request->reference." Delivered By ".$lab_detail['Lab']['pcc_name'];
		}
		
		if($this->_request->status=='ReportUpload')
		{
			$lab_message = $lab_detail['Lab']['pcc_name']." Ref Id - ".$this->_request->reference." Report Uploaded";
		}
		
		if($this->_request->status=='PatientDetail')
		{
			if($this->_request->gender == "female")
				$gender = 2;
			else
				$gender = 1;
			
			$lab_message = $lab_detail['Lab']['pcc_name']." Ref Id - ".$this->_request->reference." Updated Patient Details as Per JSON";	
			$this->Health->query("update healths set gender='".$gender."',name='".$this->_request->patient_name."',age='".$this->_request->age."',landline='".$this->_request->mobile_number."' where id='".$health_detail['Health']['id']."'");
		}
		
		if($this->_request->status=='EditOrder')
		{
			$lab_message = $lab_detail['Lab']['pcc_name']." Ref Id - ".$this->_request->reference." Updated Order Details as Per JSON";			
		}
		
		if($this->_request->status=='TrackingPhlebo' || $this->_request->status=='Phlebo Tracking')
		{
			$lab_message = $lab_detail['Lab']['pcc_name']." Ref Id - ".$this->_request->reference." Tracking Phelbo Url - ".$this->_request->trackLink;			
			
			$this->PhleboConfirmedNotify->query("update phlebo_confirmed_notify set tracking_url='".$this->_request->trackLink."' where health_id='".$health_detail['Health']['id']."'");
			$this->Health->query("update healths set requ_status='20' where id='".$health_detail['Health']['id']."'");
		}
		
		if($this->_request->status=='sent_to_lab')
		{
			$lab_message = $lab_detail['Lab']['pcc_name']." Ref Id - ".$this->_request->reference." Sent To Lab";			
		}
		
		if($this->_request->status=='specimen_hold')
		{
			$lab_message = $lab_detail['Lab']['pcc_name']." Ref Id - ".$this->_request->reference." Specimen Holded";
			$this->Health->query("update healths set requ_status='21' where id='".$health_detail['Health']['id']."'");
		}

		if($this->_request->status=='Job Completed')
		{
			$lab_message = $lab_detail['Lab']['pcc_name']." Ref Id - ".$this->_request->reference." Job Completed, Payment Type-".$this->_request->payment_type." Amount ".$this->_request->amount." Collected by - ".$this->_request->name."(".$this->_request->contact.")";
		}
		
		if($this->_request->status=='Sample Submitted')
		{
			$lab_message = $lab_detail['Lab']['pcc_name']." Ref Id - ".$this->_request->reference." Sample Submitted";
			
			$this->Healthsample = ClassRegistry::init("Healthsample");

			$this->Healthsample->query("DELETE from health_sample where health_id='".$health_detail['Health']['id']."'");

			foreach($this->_request->sampleData as $s_val)
			{
				$this->data['Healthsample']['health_id'] = $health_detail['Health']['id'];
				$this->data['Healthsample']['sample_id'] = $s_val->sampleId;
				$this->data['Healthsample']['barcode_id'] = $s_val->barcode;
				$this->data['Healthsample']['sample_recieved_datetime'] = date('d-m-Y h:i:s',$this->_request->collection_time/1000);
				$this->Healthsample->create();
	        		$this->Healthsample->save($this->data);			
			}
			$this->Health->query("update healths set requ_status='10',sample_collected_date='".date('d-m-Y h:i:s',$this->_request->collection_time/1000)."' where id='".$health_detail['Health']['id']."'");
		}
		
		if($this->_request->status=='TRF Generated')
		{
			$date = explode(" ",date('Y-m-d H:i:s'));

			$lab_message = $lab_detail['Lab']['pcc_name']." TRF Pdf Link - ".$this->_request->pdf_link;

			$this->Health->query("update healths set requ_status='16',specimen_date='".$date[0]."',specimen_time='".$date[1]."',specimen_by='NPL Phlebo App',specimen_remarks='".$this->_request->pdf_link."' where id='".$health_detail['Health']['id']."'");
		}
		
		$this->Lab = ClassRegistry::init('Lab');

		$lab_data = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$health_detail['Health']['created_by'])));

		if($lab_data['Lab']['send_push_notification'] == 1)
		{
			$response = $this->send_notification($health_detail['Health']['id']);
		}

		$this->lab_message($health_detail,$lab_message,$this->_request,$lab_detail['Lab']['pcc_name']);
	}

	private function check_labno()
	{
		$this->_request = json_decode($this->cleanInputs(file_get_contents('php://input')));
				
		if($this->_request->authorization!='09DEYFX57TT52')
		{
			$this->response('Invalid Authorization',101);			
		}
		
		$this->Health = ClassRegistry::init('Health');
		$health_detail = $this->Health->find('first',array('conditions'=>array('Health.ref_num'=>$this->_request->labNo)));

		$this->Billing = ClassRegistry::init('Billing');
		$order = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$health_detail['Health']['id'])));

		if($order){
			$this->response($order['Billing']['order_id'],200);	
		}
		else
		{
			$this->response('No Order Found',406);		
		}
        exit;
	}

	private function addorder_lis()
	{
		$this->_request = json_decode($this->cleanInputs(file_get_contents('php://input')));
		
		if($this->_request->authorization!='09DEYFX57TT52')
		{
			$this->response('Invalid Authorization',101);			
		}

		$this->checkOrderRef();

		$this->user_lis();

		$this->health_lis();

		$this->createRequestTePr_lis();
            
        $this->updateHealth_lis();
        
        $result = $this->createBilling_lis();

        $this->response($this->_order_id,200);
	}

	private function checkOrderRef()
	{
		$this->Health = ClassRegistry::init("Health");
		$this->Lab = ClassRegistry::init("Lab");

		$created_by = $this->Lab->find('first',array('conditions'=>array('Lab.registration_number'=>$this->_request->PanelID,'Lab.client_type'=>'C')));
		
		if(!isset($created_by))
			$this->response("Lab Doesn't Exist",406);

		$data = $this->Health->find("count",array("conditions"=>array("reference"=>$this->_request->Order_id,"ref_num"=>$this->_request->labNo,'created_by'=>$created_by['Lab']['id'])));

		if($data>0)
		{
			$this->response('Duplicate Order Id Or Lab No',506);
		}
	}

	function user_lis()
	{
		$this->User = ClassRegistry::init("User");
        
        $this->user = $this->User->create();		
		
		$userDetail = $this->User->find('first',array('conditions'=>array('OR'=>array('User.contact'=>$this->_request->MobileNumber,'User.alternate_contact'=>$this->_request->MobileNumber))));

		if(!empty($userDetail))
		{
			$this->_user_table_id = $userDetail['User']['id'];
			//$this->response($userDetail,200);
		}
		else
		{
			$created_by = $this->Lab->find('first',array('conditions'=>array('Lab.registration_number'=>$this->_request->PanelID,'Lab.client_type'=>'C')));
			
			$parent_id = $this->User->find('first',array('conditions'=>array('User.associated_pcc'=> $created_by['Lab']['id'],'User.parent_child'=>'parent')));

			if($parent_id)
			{
				$this->user['User']['type'] = $parent_id['User']['type'];
				$this->user['User']['parent_id'] = $parent_id['User']['parent_id'];
				$this->user['User']['parent_child'] = "child";
			}

			$this->user['User']['associated_pcc'] = $parent_id['User']['associated_pcc'];

			$this->user['User']['email'] = "";
			$this->user['User']['alternate_email'] = !empty($this->_request->alternate_email) ? $this->_request->alternate_email : "";
			$this->user['User']['status'] = 1;
			$this->user['User']['first_name'] = !empty($this->_request->PatientName) ? $this->_request->PatientName : "";
			$this->user['User']['last_name'] = !empty($this->_request->LastName) ? $this->_request->LastName : "";
			$this->user['User']['name'] = $this->user['User']['first_name']." ".$this->user['User']['last_name'];
			
			$gender_pre = substr(strtolower($this->_request->Sex),0,1);
			
			if($gender_pre == 'm')
				$gender = 1;
			else
				$gender = 2;
			
			$this->user['User']['gender'] = $gender;
			$this->user['User']['age'] = $this->_request->Age;
			$this->user['User']['contact'] = $this->_request->MobileNumber;
			$this->user['User']['alternate_contact'] = "";
			$this->user['User']['address'] = $this->_request->Address;
			$this->user['User']['locality'] = "";
			$this->user['User']['username'] = strtolower($this->user['User']['first_name']).mt_rand(1000,9999);
			$this->user['User']['passwd'] = substr(strtolower($this->user['User']['first_name']),0,1).substr($this->user['User']['contact'],-4,4);
			
			$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
			
			$this->user['User']['pincode'] = !empty($this->_request->PinCode) ? $this->_request->PinCode :'';

			if($this->_request->PinCode)
			{
				$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$this->_request->PinCode)));
				$this->user['User']['city'] = $pincodeMaster['PincodeMaster']['city'];
				$this->user['User']['state'] = $pincodeMaster['PincodeMaster']['state'];	
			}
			else{
				if(empty($this->_request->zip_code))
				{
					$this->response('Empty Pincode',406);
				}
				else
				{
					$this->user['User']['city'] = '0';
					$this->user['User']['state'] = '0';	
				}
			}
			$this->user['User']['landmark'] = !empty($this->_request->Landmark) ? $this->_request->Landmark :'';
			$this->user['User']['created_by'] = $created_by['Lab']['id'];
			
			//print_R(json_encode($this->user));die;

			if($this->User->save($this->user))
			{
				$this->_user_table_id = $this->User->getLastInsertId();
				//$this->response($this->_user_table_id,200);
			}
			else
				$this->response('User Data Incomplete',406);
		}
	}

	private function health_lis()
    {
    	$date = '';
		$time = '';
		$s_date_new = '';
		$time_slot_id = "";

		$dateTime = explode(" ",$this->_request->SampleCollectedDate);
		$date =  date('d-m-Y',strtotime($dateTime[0]));
		$s_date_new = date('Y-m-d',strtotime($dateTime[0]));
		$time = $dateTime[1];
		
		$this->Lab = ClassRegistry::init("Lab");
		$this->Timelab = ClassRegistry::init("Timelab");
		$timelabs = $this->Timelab->find('all',array('conditions'=>array('Timelab.status'=>1),'order'=>array('Timelab.sequence ASC')));

		foreach($timelabs as $key=>$val)
		{
			$log = explode("-",$val['Timelab']['name']);
			$s_time = explode(":",$log[0]);
			$l_time = explode(":",$log[1]);
			$check_time = explode(':',$time);

			$start_time = $s_time[0]*60 + $s_time[1];
			$end_time = $l_time[0]*60 + $l_time[1];
			$c_time = $check_time[0]*60 + $check_time[1];

			if($start_time <= $c_time && $end_time >=$c_time)
			{
				$time_slot_id = $key;
			}
		}

		$this->data['Health']['agent_id'] = 0;
		$this->data['Health']['user_id'] = $this->_user_table_id;
		$this->data['Health']['ref_num'] = $this->_request->labNo;
		$this->data['Health']['medical_reference_number'] = !empty($this->_request->MRN_Id) ? $this->_request->MRN_Id :0;
		$this->data['Health']['discount_id'] = 0;
		$this->data['Health']['discount_amount'] = 0;
		$this->data['Health']['discount_amount_reason'] = '';
		$this->data['Health']['name'] = $this->_request->PatientName." ".$this->_request->LastName;
		$this->data['Health']['reference'] = !empty($this->_request->Order_id) ? $this->_request->Order_id :'';

		$gender_pre = substr(strtolower($this->_request->Sex),0,1);
		if($gender_pre == 'm')
			$gender = 1;
		else
			$gender = 2;
		
		$this->data['Health']['gender'] = $gender;
		$this->data['Health']['age'] = $this->_request->Age;       
		$this->data['Health']['landline'] = $this->_request->MobileNumber;
		$this->data['Health']['mobile'] = "";
		$this->data['Health']['email'] = !empty($this->_request->Email) ? $this->_request->Email : "";
		$this->data['Health']['address'] = $this->_request->Address;
		$this->data['Health']['address1'] = ".";
		$this->data['Health']['locality'] = ".";
		
		$this->data['Health']['refered_by'] = '';
		$this->data['Health']['market_value'] = !empty($this->_request->market_value) ? $this->_request->market_value :0;
		
		$this->data['Health']['prescription_url'] = 0;

		$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
		$this->data['Health']['pincode'] = !empty($this->_request->PinCode) ? $this->_request->PinCode :'';
		
		if($this->_request->PinCode)
		{
			$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$this->_request->PinCode)));
			$this->data['Health']['city_id'] = $pincodeMaster['PincodeMaster']['city'];
			$this->data['Health']['state'] = $pincodeMaster['PincodeMaster']['state'];	
			$this->data['Health']['visit_pat_city'] = $pincodeMaster['PincodeMaster']['city'];
		}
		else{
			$this->data['Health']['city_id'] = !empty($this->_request->city) ? $this->_request->city :'0';
			$this->data['Health']['state'] = !empty($this->_request->state) ? $this->_request->state :'0';	
			$this->data['Health']['visit_pat_city'] = !empty($this->_request->city) ? $this->_request->city :'0';
		}

		$created_by = $this->Lab->find('first',array('conditions'=>array('Lab.registration_number'=>$this->_request->PanelID,'Lab.client_type'=>'C')));
		$assigned_lab = $this->Lab->find('first',array('conditions'=>array('Lab.registration_number'=>$this->_request->ServiceBypanel,'Lab.client_type'=>'C')));

		$this->data['Health']['landmark'] = !empty($this->_request->landmark) ? $this->_request->Landmark :'0';
		$this->data['Health']['city'] = "";
		$this->data['Health']['s_date'] = $s_date_new;
		$this->data['Health']['test_id'] = "";
		$this->data['Health']['profile_id'] = "";
		$this->data['Health']['offer_id'] =      "";   
		$this->data['Health']['package_id'] =   "";
		$this->data['Health']['service_id'] = "";
		$this->data['Health']['sample_date'] = "";
		$this->data['Health']['sample_date1'] = $date;
		$this->data['Health']['sample_time'] = "";
		$this->data['Health']['sample_time1'] = $time_slot_id;
		$this->data['Health']['pay_status'] = 0;
		$this->data['Health']['total_amount'] = !empty($this->_request->net_amount) ? $this->_request->net_amount :0;
		$this->data['Health']['received_amount'] = !empty($this->_request->amount_collected) ? $this->_request->amount_collected :0;
		$this->data['Health']['balance_amount'] = !empty($this->_request->amount_to_be_collected) ? $this->_request->amount_to_be_collected :0;
		$this->data['Health']['balance_refund'] = 0;
		$this->data['Health']['refund_status'] = 0;
		$this->data['Health']['adj_reason'] = "";
		$this->data['Health']['btc_reason'] = "";
		$this->data['Health']['sent_pathcorp_admin'] = "";
		$this->data['Health']['agent_confirm'] = 0;
		$this->data['Health']['home_report'] = 0;
		$this->data['Health']['requ_status'] = 14;
		$this->data['Health']['status'] = 1;
		$this->data['Health']['created_by'] = $created_by['Lab']['id'];
		$this->data['Health']['patient_report'] = "";
		$this->data['Health']['assigned_lab'] = $assigned_lab['Lab']['id'];
		$this->data['Health']['message_status'] = "";
		$this->data['Health']['lab_message'] = "";
		$this->data['Health']['cod_status'] = "";
		$this->data['Health']['report_type'] = "";
		$this->data['Health']['partial_reason'] = "";
		$this->data['Health']['entry_status'] = 0;
		$this->data['Health']['last_edited'] = 0;
		$this->data['Health']['sent_pathcorp_admin'] = 0;
		$this->data['Health']['last_edited_date'] = "0000-00-00";
		$this->data['Health']['message_status'] = 0;
		$this->data['Health']['cod_status'] = 0;
		$this->data['Health']['remarks'] = "";
		$this->data['Health']['remark'] = "";
		$this->data['Health']['print_status'] = 0;
		$this->data['Health']['trf_status'] = 0;
		$this->data['Health']['register_sample'] = 0;
		$this->data['Health']['sent_pathcorp'] = 0;
		$this->data['Health']['receive_pathcorp'] = 0;
		$this->data['Health']['reschduled'] = 0;
		$this->data['Health']['cancelled_status'] = 0;
		$this->data['Health']['cancelled_reason'] = '';
		$this->data['Health']['published'] = 0;
		$this->data['Health']['published_reason'] = '';
		$this->data['Health']['old_date'] = '0000-00-00';
		$this->data['Health']['old_time'] = '';
		$this->data['Health']['book_date'] = date('Y-m-d H:i:s');
		$this->data['Health']['is_urgent'] = "false";

		$this->data['Health']['btc_no_payment_bill_to_company'] = $created_by['Lab']['pcc_name'];
		$this->data['Health']['btc_reason'] = '';
		
		$this->data['Health']['payment_type'] = $this->_request->payment_type;
		
		$this->data['Health']['balance_refund'] = 0;
		$this->data['Health']['pay_status'] = 1;
		$this->data['Health']['flags'] = "5000000000";

		if(!empty($this->_request->Samples))
		{
			$this->data['Health']['agent_id'] = '83';
		}
		
		$sample_collected_date ='';
		if($time=='')
		{
			$this->Timelab = ClassRegistry::init("Timelab");
			$timelabs = $this->Timelab->find('all',array('conditions'=>array('Timelab.status'=>1),'order'=>array('Timelab.sequence ASC')));
			$time=explode('-',$timelabs[$this->data['Health']['sample_time1']]['Timelab']['name']);
			$sample_collected_date = $this->data['Health']['sample_date1']." ".$time[1];
		}
		else
			$sample_collected_date = $this->data['Health']['sample_date1']." ".$time;    

		$this->data['Health']['sample_collected_date'] = $sample_collected_date;
		$this->Health = ClassRegistry::init('Health');
		$this->Health->create();

		if($this->Health->save($this->data))
		{
			$this->_health_table_id = $this->Health->getLastInsertId();
			//$this->response($this->_health_table_id,200);
			$this->_json_data($this->_health_table_id,date('Y-m-d h:i:s'),"LIS API NEW BOOKING",json_encode($this->_request),"-----");
			
			$this->_activity_log($this->_user_table_id,$this->_health_table_id,"New Order Added from LIS");
		}
		else
			$this->response('Health Data Incomplete',406);
    }

    private function createRequestTePr_lis()
    {
        $this->Test = ClassRegistry::init('Test');
        $data = $this->Test->find('all',array('fields'=>array('id','type','mrp'),'conditions'=>array('Test.testcode'=>$this->_request->TestList,'Test.status'=>1)));
        
        if(count($data) > 0)
        {
            $this->RequestTest = ClassRegistry::init('RequestTest');
            foreach($data as $key=>$value)
            {
                if($value['Test']['type'] == 'TEST')
                {
                    $this->_test_ids[] = $value['Test']['id'];
                    $this->data['RequestTest']['type'] = 'TE';
                }
                elseif($value['Test']['type'] == 'PROFILE')
                {
                    $this->_profile_ids[] = $value['Test']['id'];
                    $this->data['RequestTest']['type'] = 'PR';
                }
                else
                {
                    $this->_service_ids[] = $value['Test']['id'];
                    $this->data['RequestTest']['type'] = 'SR';
                }
                $this->data['RequestTest']['health_id'] = $this->_health_table_id;
                $this->data['RequestTest']['test_id'] = $value['Test']['id'];
                $this->data['RequestTest']['mrp'] = $value['Test']['mrp'];
                $this->data['RequestTest']['test_book_date'] = date('Y-m-d H:i:s');
                $this->data['RequestTest']['status'] = 1;  
                $this->_order_total_amt += $value['Test']['mrp'];
                $this->RequestTest->create();
                //$this->RequestTest->save($this->data);
                if(!$this->RequestTest->save($this->data))
	            	$this->response('Request Test Data Incomplete',406);

            }
        }
        
        /*for package*/
        $this->Package = ClassRegistry::init('Package');
        $data = $this->Package->find('all',array('fields'=>array('id','package_mrp'),'conditions'=>array('Package.package_code'=>$this->_request->test_code,'Package.status'=>1)));
        if(count($data) > 0)
        {
            $this->RequestTest = ClassRegistry::init('RequestTest');
            foreach($data as $key=>$value)
            {
                $this->_package_ids[] = $value['Package']['id'];
                $this->data['RequestTest']['type'] = 'PA';
                                    
                $this->data['RequestTest']['health_id'] = $this->_health_table_id;
                $this->data['RequestTest']['test_id'] = $value['Package']['id'];
                $this->data['RequestTest']['mrp'] = $value['Package']['package_mrp'];
                $this->data['RequestTest']['test_book_date'] = date('Y-m-d H:i:s');
                $this->data['RequestTest']['status'] = 1;  
                $this->_order_total_amt += $value['Package']['package_mrp'];
                $this->RequestTest->create();
                //$this->RequestTest->save($this->data);
                if(!$this->RequestTest->save($this->data))
	            	$this->response('Request Package Data Incomplete',406);
            }
        }
        
        /*for offers/banners*/
        $this->Banner = ClassRegistry::init('Banner');
        $data = $this->Banner->find('all',array('fields'=>array('id','banner_mrp'),'conditions'=>array('Banner.banner_code'=>$this->_request->test_code,'Banner.status'=>1)));
        if(count($data) > 0)
        {
            $this->RequestTest = ClassRegistry::init('RequestTest');
            foreach($data as $key=>$value)
            {
                $this->_banner_ids[] = $value['Banner']['id'];
                $this->data['RequestTest']['type'] = 'OF';
                                    
                $this->data['RequestTest']['health_id'] = $this->_health_table_id;
                $this->data['RequestTest']['test_id'] = $value['Banner']['id'];
                $this->data['RequestTest']['mrp'] = $value['Banner']['banner_mrp'];
                $this->data['RequestTest']['test_book_date'] = date('Y-m-d H:i:s');
                $this->data['RequestTest']['status'] = 1;  
                $this->_order_total_amt += $value['Banner']['banner_mrp'];
                $this->RequestTest->create();
                //$this->RequestTest->save($this->data);
                if(!$this->RequestTest->save($this->data))
	            	$this->response('Request Banner Data Incomplete',406);
            }
        }
        
    }
    
    private function updateHealth_lis()
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
		
		if(isset($this->_request->TotalAmount))
        	$this->_order_total_amt = $this->_request->TotalAmount;
		
		$this->data['Health']['amount_to_be_collected'] = $health['Health']['balance_amount'];
		$this->data['Health']['amount_collected'] = $health['Health']['received_amount'];
		$this->data['Health']['id'] = $this->_health_table_id;
		$this->data['Health']['test_id'] = $this->_test_ids;
		$this->data['Health']['profile_id'] = $this->_profile_ids;
		$this->data['Health']['package_id'] = $this->_package_ids;
		$this->data['Health']['offer_id'] = $this->_banner_ids;
		$this->data['Health']['service_id'] = $this->_service_ids;
		$this->data['Health']['total_amount'] = $this->_order_total_amt;
		
		if(!$this->Health->save($this->data))
		{
			$this->response('Health Updation Failed',406);
		}

		$health = $this->Health->find('first',array('conditions'=>array('Health.id'=>$this->_health_table_id)));
		
		if($this->_request->payment_type==4)
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
				$this->response('Payment Data Incomplete',406);	
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
    
    private function createBilling_lis()
    {
    	//print_R("create billing");die;
        $this->Billing = ClassRegistry::init('Billing');
        /*$data = $this->Billing->find('first',array('fields'=>array('Billing.order_id'),'order'=>array('Billing.order_id DESC')));
        $this->_order_id = $data['Billing']['order_id']+1;
        
        $checkdata = $this->Billing->find('first',array('conditions'=>array('Billing.order_id'=>$this->_order_id)));

        if(isset($checkdata['Billing']['order_id']))
        {
        	$this->_order_id = $checkdata['Billing']['order_id']+1;
        }*/
        
        $this->_order_id = $this->_health_table_id * 2;
        $this->data['Billing']['order_id'] = $this->_health_table_id * 2;
        $this->data['Billing']['request_id'] = $this->_health_table_id;
        $this->data['Billing']['user_id'] = $this->_user_table_id;
        $this->data['Billing']['test_id'] = $this->_test_ids;
        $this->data['Billing']['profile_id'] = $this->_profile_ids;
        $this->data['Billing']['offer_id'] = $this->_banner_ids;
        $this->data['Billing']['package_id'] = $this->_package_ids;
        $this->data['Billing']['service_id'] = $this->_service_ids;
        $this->data['Billing']['first_name'] = $this->_request->PatientName;
        $this->data['Billing']['contact'] = $this->data['Health']['landline'];
        $this->data['Billing']['address'] = $this->data['Health']['address'];
        $this->data['Billing']['locality'] = $this->data['Health']['locality'];
        $this->Pincodemaster = ClassRegistry::init("PincodeMaster");
        $this->data['Billing']['zip'] = $this->data['Health']['pincode'];
        
    	$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$this->data['Health']['pincode'])));
    	$this->data['Billing']['city'] = $pincodeMaster['PincodeMaster']['city'];
    	$this->data['Billing']['state'] = $pincodeMaster['PincodeMaster']['state'];	
        
        $this->data['Billing']['landmark'] = $this->data['Health']['landmark'];
        $this->data['Billing']['book_date'] = date('Y-m-d H:i:s');
        
        if(isset($this->_request->net_amount))
        	$this->_order_total_amt = $this->_request->net_amount;

        $this->data['Billing']['sub_total'] = $this->_order_total_amt;
        $this->Billing->create();
        
        //$this->response($this->data,200);	

        if(!$this->Billing->save($this->data))
        {
        	$this->response('Incomplete Billing Data',406);	
        }
    }

    function send_notification($req_id=null)
	{
		$file = '/home2/niramovh/public_html/app/webroot/files/log/sendnotification.txt';
		file_put_contents($file,date('Y-m-d H:i:s'), FILE_APPEND);

		$this->Health = ClassRegistry::init("Health");
		$this->Agent = ClassRegistry::init("Agent");
		$this->Lab = ClassRegistry::init("Lab");
		$this->PhleboConfirmedNotify = ClassRegistry::init('PhleboConfirmedNotify');
		$this->Test = ClassRegistry::init("Test");
		$this->RequestTest = ClassRegistry::init('RequestTest');
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
		
		$check_status = substr($data['Health']['flags'],-2);
		
		if($data['Health']['requ_status']!=$check_status)
		{
			$lab_data = $this->Lab->find("first",array('conditions'=>array('Lab.id'=>$data['Health']['created_by'])));
			
			$statusdata = array();
			if(isset($data['Health']['id']))
			{
				$statusdata['order_id'] = $data['Billing']['order_id'];
				$statusdata['reference_id'] = $data['Health']['reference'];
				$statusdata['request_status'] = $this->getRequestStatus($data['Health']['requ_status']);
							
				if($data['Health']['report_type']=='partial')
				{
					$statusdata['report_type'] = ($data['Health']['report_type'])? $data['Health']['report_type'] : "";

					if (strpos($req_info['Health']['patient_report'], 'http:') !== false) { 
						$statusdata['report_url'] = ($data['Health']['patient_report_with_report'])?$data['Health']['patient_report_with_report'] : "";
					}
					else{
						$statusdata['report_url'] = SITE_URL."tests/view_report/".base64_encode(str_replace("?","@@@@",$data['Health']['patient_report']));			
					}
					
					$completed_test = $this->RequestTest->find("all",array("conditions"=>array("health_id"=>$data['Health']['id'])));
					$completed_tests_list = array();
					$pending_tests_list= array();
					foreach($completed_test as $key=>$val)
					{
						$testResult = '';
						if(in_array($val['RequestTest']['type'], array('TE','PR','SR')))
						{
							$testResult = $this->Test->find('first',array("conditions"=>array("id"=>$val['RequestTest']['test_id'])));
							if($val['RequestTest']['reporting_status']==1)
								array_push($completed_tests_list, $testResult['Test']['test_parameter']);
							else
								array_push($pending_tests_list, $testResult['Test']['test_parameter']);
						}

						if($val['RequestTest']['type']=='PA')
						{
							$testResult = $this->Package->find('first',array("conditions"=>array("id"=>$val['RequestTest']['test_id'])));
							if($val['RequestTest']['reporting_status']==1)
								array_push($completed_tests_list, $testResult['Package']['package_name']);
							else
								array_push($pending_tests_list, $testResult['Package']['package_name']);
						}
						if($val['RequestTest']['type']=='OF')
						{
							$testResult = $this->Banner->find('first',array("conditions"=>array("id"=>$val['RequestTest']['test_id'])));
							if($val['RequestTest']['reporting_status']==1)
								array_push($completed_tests_list, $testResult['Banner']['banner_name']);
							else
								array_push($pending_tests_list, $testResult['Banner']['banner_name']);
						}
					}
					$statusdata['completed_test'] = $completed_tests_list;
					$statusdata['pending_test'] = $pending_tests_list;
				}
				else if($data['Health']['report_type']=='full')
				{
					if(empty($data['Health']['smart_report']))
					{
						$statusdata['report_type'] = ($data['Health']['report_type'])? $data['Health']['report_type'] : "";
						

						if (strpos($req_info['Health']['patient_report'], 'http:') !== false) { 
							$statusdata['report_url'] = ($data['Health']['patient_report_with_report'])?$data['Health']['patient_report_with_report'] : "";
						}
						else{
							$statusdata['report_url'] = SITE_URL."tests/view_report/".base64_encode(str_replace("?","@@@@",$data['Health']['patient_report']));			
						}

						//print_R('else');die;
						$this->Healthlabmateresponse = ClassRegistry::init('Healthlabmateresponse');
						$healthlabmate = $this->Healthlabmateresponse->find('first',array('conditions'=>array('Healthlabmateresponse.health_id'=>$data['Health']['id'])));
						//$this->response($healthlabmate,200);
						$resultSetLabmate = json_decode($healthlabmate['Healthlabmateresponse']['json_data']);
						$statusdata['digital_report'] = $healthlabmate['Healthlabmateresponse']['json_data'];
					}
					else
					{
						$statusdata['request_status'] = "Smart Report";
						$statusdata['smart_report_url'] = $data['Health']['smart_report'];
					}
				}
				
				if($data['Health']['old_date'] != "0000-00-00" && $data['Health']['requ_status']==13)
				{
					$this->Timelabs = ClassRegistry::init('Timelabs');
					$timeslot = $this->Timelabs->find('first',array('conditions'=>array('Timelabs.id'=>$data['Health']['sample_time1'])));

					$slots = explode('-',$timeslot['Timelabs']['name']);

					$statusdata['reschedule'] = 1;
					$statusdata['old_date'] = strtotime($data['Health']['old_date']);
					$statusdata['new_date'] = strtotime($data['Health']['s_date']." ".$slots[0]);
				}
				
				if($data['Health']['requ_status']==19 || $data['Health']['requ_status']==4)
				{
					$agentDetail = $this->Agent->find('first',array('conditions'=>array('Agent.id'=>$data['Health']['agent_id'])));
					$statusdata['agent_name'] = $agentDetail['Agent']['name'];
					$statusdata['agent_contact'] = $agentDetail['Agent']['contact'];
				}

				if($data['Health']['requ_status']==20)
				{
					$track_url = $this->PhleboConfirmedNotify->find("first",array('conditions'=>array('PhleboConfirmedNotify.health_id'=>$data['Health']['id'])));
					$agentDetail = $this->Agent->find('first',array('conditions'=>array('Agent.id'=>$data['Health']['agent_id'])));
					$statusdata['agent_name'] = $agentDetail['Agent']['name'];
					$statusdata['agent_contact'] = $agentDetail['Agent']['contact'];
					$statusdata['tracking_url'] = $track_url['PhleboConfirmedNotify']['tracking_url'];
				}

				if($data['Health']['requ_status']==16)
				{
					if(filter_var($data['Health']['specimen_remarks'], FILTER_VALIDATE_URL))
					{
						$statusdata['request_status'] = "TRF Generated";
						$statusdata['trf_url'] = $data['Health']['specimen_remarks'];	
					}
				}

				if($data['Health']['requ_status']==14)
				{
					$statusdata['lab_no'] = $data['Health']['ref_num'];
				}
			}
			
			$statusdata['authorization'] = $lab_data['Lab']['auth_code_notification'];
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
			
			if(curl_error($ch))
			{
				print_R(curl_error($ch));die;
			}
			else
			{
				$len = strlen($data['Health']['requ_status']);
				$new_flag = '';

				if($len==1)
					$new_flag = substr_replace($data['Health']['flags'],"0".$data['Health']['requ_status'],-2);
				if($len==2)
					$new_flag = substr_replace($data['Health']['flags'],$data['Health']['requ_status'],-2);
		
				$this->Health->query("update healths set flags=".$new_flag." where id=".$data['Health']['id']);
			}
		}
	}

	public function reg_in_lis($health_id=null)
	{
		$health_id = $health_id;
		$this->Health = ClassRegistry::init("Health");
        $this->User = ClassRegistry::init("User");
        $this->Billing = ClassRegistry::init('Billing');
        $this->Test = ClassRegistry::init('Test');
        $this->Package = ClassRegistry::init('Package');
        $this->Banner = ClassRegistry::init('Banner');
        $this->Healthsample = ClassRegistry::init("Healthsample");
		$health_detail = $this->Health->find('first',array('conditions'=>array('Health.id'=>$health_id)));
        $user_detail = $this->User->find('first',array('conditions'=>array('User.id'=>$health_detail['Health']['user_id'])));
        $test_list = explode(',',$health_detail['Health']['test_id']);
        $profile_list = explode(',',$health_detail['Health']['profile_id']);
        $service_list = explode(',',$health_detail['Health']['service_id']);
        $package_list = explode(',',$health_detail['Health']['package_id']);
        $offer_list = explode(',',$health_detail['Health']['offer_id']);
        $billing_detail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$health_id)));
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
        $sample_health = $this->Healthsample->find('all',array('conditions'=>array('Healthsample.health_id'=>$health_id)));
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
        $referred_by = $health_detail['Health']['refered_by'];
        if(empty($health_detail['Health']['refered_by']))
            $referred_by = "Self";
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
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => "http://lis.niramayapathlabs.com/dev/design/jsonreceive/Postorder.aspx",
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
			print_R(curl_error($ch));die;
		}
        curl_close($ch);
        $decoded_result = json_decode($result);
		$this->_json_data($health_detail['Health']['id'],date('Y-m-d h:i:s'),"Post Order Fired",json_encode($data),$result);
        if(isset($decoded_result->Labno) && $decoded_result->Labno!=0)
        {
            $this->_activity_log($health_detail['Health']['user_id'],$health_detail['Health']['id'], 'Order sent to Labmate');
            $update_query = $this->Health->query("UPDATE healths SET requ_status='14',ref_num='".$decoded_result->Labno."',sent_pathcorp='1',sent_pathcorp_admin='0' ,last_edited='0',last_edited_date='".date('Y-m-d H:i:s')."',netbilling='".$decoded_result->Netbilling."' WHERE id='".$health_id."'");

            //$this->Utility->lis_payment_update($order_val['healths']['id'],"all");
			if($this->Utility->check_push_notification_for_pcc($health_detail['Health']['created_by'],$health_detail['Health']['assigned_lab']) == 1)
			{
				$response = $this->Utility->send_notification($health_id);
			}
			return "success";
        }
        else
        {
            $this->_activity_log($health_detail['Health']['user_id'], $health_id,'Send to Labmate Failed');

            $message_from_lab = $decoded_result->message;
            $this->LabMessageMaster = ClassRegistry::init('LabMessageMaster');
			$this->LabMessageMaster->create();
			
			$this->data['LabMessageMaster']['request_id'] = $health_id;
			$this->data['LabMessageMaster']['date'] = date('Y-m-d H:i:s');
			$this->data['LabMessageMaster']['message'] = $message_from_lab;
			
			$this->LabMessageMaster->save($this->data);
			
			$update_query = $this->Health->query("UPDATE healths SET remarks='".$message_from_lab."' WHERE id='".$health_id."'");

            return "failure";
        }
	}
}
$api = new ApiController;
$api->processApi();
?>
