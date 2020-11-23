<?php
require "/home2/niramovh/lib/PHPMailer/class.phpmailer.php";
require "/home2/niramovh/lib/PHPMailer/class.smtp.php";
App::import('Vendor', '/fpdf/fpdf');
App::import('Vendor', '/fpdf/fpdi');

class RunnerController extends AppController {
	
	var $name = "Runner";

	var $breadcrumb = array();

	var $uses=array('RunnerRequest','RunnerSampleData','RunnerService','Lab','Agent','City','State','Admin','PincodeMaster','Samplemaster','DropLocations','RunnerTimeslot','PickupLocations','Zone','ZoneLoc');

	var $helpers = array('Form','Html','Javascript', 'Ajax','Utility');

	public $components = array('RequestHandler','Cookie','Utility');

	public $paginate = array('maxLimit' => 10);

	function admin_add_new_request()
	{
		$working_day = array('1'=>'Monday','2'=>'Tuesday','3'=>'Wednesday','4'=>'Thursday','5'=>'Friday','6'=>'Saturday','0'=>'Sunday');
		
		$this->Agent = ClassRegistry::init("Agent");
		$this->RunnerRequest = ClassRegistry::init("RunnerRequest");
		$this->RunnerService = ClassRegistry::init("RunnerService");
		
		$this->Lab = ClassRegistry::init("Lab");
		//print_R($this->Session);die;
		if($this->data)
		{
			//print_R($this->data);die;
			$this->runnerservicedata = $this->RunnerService->create();
			$this->runnerrequestdata = $this->RunnerRequest->create();
			
			if($this->data['Runner']['type']==1)
			{
				$this->data['Runner']['from_date'] = date('Y-m-d',strtotime($this->data['Runner']['from_date']));
				$this->data['Runner']['to_date'] = date('Y-m-d',strtotime($this->data['Runner']['to_date']));
				$this->data['Runner']['created_by'] = $this->Session->read('Admin.id');
				$this->data['Runner']['created_on'] = date('Y-m-d');
				
				$this->data['Runner']['working_day'] = implode(',',$this->data['Runner']['working_day']);
				$this->runnerservicedata['RunnerService'] = $this->data['Runner'];
				if($this->RunnerService->save($this->runnerservicedata))
				{
					$this->Session->setFlash('Runner Service Added.','flash_success');  
					$this->redirect('/admin/runner/runner_service/');
				}
				else
				{
					$this->Session->setFlash('Unable To  Create Runner Service.','flash_failure');  
					$this->redirect('/admin/runner/add_new_request/');
				}
			}
			else
			{
				$this->data['Runner']['runner_request_id'] = 'RUNNER-'.strtotime(date('Y-m-d h:i:s'));
				$this->data['Runner']['date'] = date('Y-m-d',strtotime($this->data['Runner']['date']));
				$this->data['Runner']['status'] = '1';
				$this->data['Runner']['created_by'] = $this->Session->read('Admin.id');
				$this->data['Runner']['created_on'] = date('Y-m-d');
				$this->runnerrequestdata['RunnerRequest'] = $this->data['Runner'];
				
				if($this->RunnerRequest->save($this->runnerrequestdata))
				{
					$this->Session->setFlash('Runner Request Added.','flash_success');  
					$this->redirect('/admin/runner/runner_request/');
				}
				else
				{
					$this->Session->setFlash('Unable To  Create Runner Request.','flash_failure');  
					$this->redirect('/admin/runner/add_new_request/');
				}
			}
		}
		$pcc_list = $this->Lab->find('list',array('conditions'=>array('Lab.status'=>1),'fields'=>array('Lab.id','Lab.pcc_name')));
		$agent_list = $this->Agent->find('list',array('conditions'=>array('Agent.status'=>1,'Agent.role'=>array('2','3')),'fields'=>array('Agent.id','Agent.name')));
		
		$this->RunnerTimeslot = ClassRegistry::init("RunnerTimeslot");
		$time_slot = $this->RunnerTimeslot->find('list',array('fields'=>array('RunnerTimeslot.id','RunnerTimeslot.slot_name')));
		
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));
		$state = $this->State->find('all',array('conditions'=>array('State.status'=>1)));
		$this->set('lab_list',$pcc_list);
		$this->set('working_day',$working_day);
		$this->set('time_slot',$time_slot);
		$this->set('city',$city);
		$this->set('state',$state);

		$this->dropLocations = ClassRegistry::init('DropLocations');
		$drop_loc = $this->dropLocations->find('list',array('fields'=>array('DropLocations.id','DropLocations.location_name')));
		$this->set('drop_loc',$drop_loc);
		
		$this->pickupLocations = ClassRegistry::init('PickupLocations');
		$pick_loc = $this->pickupLocations->find('list',array('fields'=>array('PickupLocations.id','PickupLocations.location_name')));
		$this->set('pick_loc',$pick_loc);
		//print_R($time_slot);die;
		//print_R($agent_list);die;
	}
	
	function admin_getcitystate()
	{
		$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
		$pincodeMaster = $this->Pincodemaster->find('all',array('conditions'=>array('PincodeMaster.pincode'=>$_REQUEST['pin'])));
		$localityArray = array();
		$localityArray['locality'] = array();
		foreach($pincodeMaster as $val)
		{
			$localityArray['city'] = $val['PincodeMaster']['city'];
			$localityArray['state'] = $val['PincodeMaster']['state'];
			array_push($localityArray['locality'],$val['PincodeMaster']['locality']);
		}
		print_R(json_encode($localityArray));die;
	}
	
	function admin_runner_service()
	{
		$this->RunnerService = ClassRegistry::init("RunnerService");
		$conditions = '';
		$this->paginate = array('RunnerService' => array('limit' =>'20','order'=>array('RunnerService.id'=>'DESC'),'conditions'=>$conditions));
		
		$runnerservicelist=$this->paginate('RunnerService');

		$pcc_list = $this->Lab->find('list',array('conditions'=>array('Lab.status'=>1),'fields'=>array('Lab.id','Lab.pcc_name')));
		
		$this->RunnerTimeslot = ClassRegistry::init("RunnerTimeslot");
		$time_slot = $this->RunnerTimeslot->find('list',array('fields'=>array('RunnerTimeslot.id','RunnerTimeslot.slot_name')));
		
		$users = $this->Admin->find('list',array('conditions'=>array('Admin.userType'=>array('A','BM')),'fields'=>array('id','name')));
		$this->set('runnerservicelist',$runnerservicelist);
		$this->set('pcc_list',$pcc_list);
		$this->set('time_slot',$time_slot);
		$this->set('users',$users);
		
		//print_R($runnerservicelist);die;
		$this->dropLocations = ClassRegistry::init('DropLocations');
		$drop_loc = $this->dropLocations->find('list',array('fields'=>array('DropLocations.id','DropLocations.location_name')));
		$this->set('drop_loc',$drop_loc);
		
		$this->pickupLocations = ClassRegistry::init('PickupLocations');
		$pick_loc = $this->pickupLocations->find('list',array('fields'=>array('PickupLocations.id','PickupLocations.location_name')));
		$this->set('pick_loc',$pick_loc);
		//print_R($pick_loc);die;
	}
	
	function admin_edit_runner_service($runner_service=null)
	{
		$working_day = array('1'=>'Monday','2'=>'Tuesday','3'=>'Wednesday','4'=>'Thursday','5'=>'Friday','6'=>'Saturday','0'=>'Sunday');
		$runner_service_id = base64_decode($runner_service);
		
		$this->Agent = ClassRegistry::init("Agent");
		$this->RunnerService = ClassRegistry::init("RunnerService");
		
		$this->Lab = ClassRegistry::init("Lab");
		
		if($this->data)
		{
			$this->runnerservicedata = $this->RunnerService->create($this->data);
			$this->data['Runner']['from_date'] = date('Y-m-d',strtotime($this->data['Runner']['from_date']));
			$this->data['Runner']['to_date'] = date('Y-m-d',strtotime($this->data['Runner']['to_date']));
			
			$this->data['Runner']['working_day'] = implode(',',$this->data['Runner']['working_day']);
			$this->runnerservicedata['RunnerService'] = $this->data['Runner'];

			if($this->RunnerService->save($this->runnerservicedata))
			{
				$this->Session->setFlash('Runner Service Updated Successfully.','flash_success');  
				$this->redirect('/admin/runner/edit_runner_service/'.base64_encode($this->data['Runner']['id']));
			}
			else
			{
				$this->Session->setFlash('Error On Updating Runner Service.','flash_failure');  
				$this->redirect('/admin/runner/edit_runner_service/'.base64_encode($this->data['Runner']['id']));
			}
		}
		
		$this->runnerservicedata = $this->RunnerService->find('first',array('conditions'=>array('RunnerService.id'=>$runner_service_id)));
		$this->runnerservicedata['RunnerService']['from_date'] = date('d-m-Y',strtotime($this->runnerservicedata['RunnerService']['from_date']));
		$this->runnerservicedata['RunnerService']['to_date'] = date('d-m-Y',strtotime($this->runnerservicedata['RunnerService']['to_date']));
		
		$pcc_list = $this->Lab->find('list',array('conditions'=>array('Lab.status'=>1),'fields'=>array('Lab.id','Lab.pcc_name')));
		
		$this->RunnerTimeslot = ClassRegistry::init("RunnerTimeslot");
		$time_slot = $this->RunnerTimeslot->find('list',array('fields'=>array('RunnerTimeslot.id','RunnerTimeslot.slot_name')));
		
		$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
		$pickupPincode = $this->Pincodemaster->find('all',array('conditions'=>array('PincodeMaster.pincode'=>$this->runnerservicedata['RunnerService']['pickup_pincode'])));
		$dropPincode = $this->Pincodemaster->find('all',array('conditions'=>array('PincodeMaster.pincode'=>$this->runnerservicedata['RunnerService']['drop_pincode'])));
		
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));
		$state = $this->State->find('all',array('conditions'=>array('State.status'=>1)));
		$this->set('lab_list',$pcc_list);
		$this->set('working_day',$working_day);
		$this->set('time_slot',$time_slot);
		$this->set('city',$city);
		$this->set('state',$state);
		$this->set('pickupPincode',$pickupPincode);
		$this->set('dropPincode',$dropPincode);
		$this->data['Runner'] = $this->runnerservicedata['RunnerService'];
		$this->dropLocations = ClassRegistry::init('DropLocations');
		$drop_loc = $this->dropLocations->find('list',array('fields'=>array('DropLocations.id','DropLocations.location_name')));
		$this->set('drop_loc',$drop_loc);
		
		$this->pickupLocations = ClassRegistry::init('PickupLocations');
		$pick_loc = $this->pickupLocations->find('list',array('fields'=>array('PickupLocations.id','PickupLocations.location_name')));
		$this->set('pick_loc',$pick_loc);
		//print_R($this->data);die;
	}
	
	function admin_runner_request()
	{
		$this->RunnerRequest = ClassRegistry::init("RunnerRequest");
		$conditions = '';
		//print_R($this->params);
		if(isset($this->params['named']['req_from_date']) && $this->params['named']['req_from_date']!='')
		{
			$this->data['Filter']['req_from_date'] = $this->params['named']['req_from_date'];
			$options['req_from_date'] = $this->params['named']['req_from_date'];
		}
		if(isset($this->params['named']['req_to_date']) && $this->params['named']['req_to_date']!='')
		{
			$this->data['Filter']['req_to_date'] = $this->params['named']['req_to_date'];
			$options['req_to_date'] = $this->params['named']['req_to_date'];
		}
		if(isset($this->params['named']['req_lab1']) && $this->params['named']['req_lab1']!='')
		{
			$this->data['Filter']['req_lab1'] = $this->params['named']['req_lab1'];
			$options['req_lab1'] = $this->params['named']['req_lab1'];
		}
		if(isset($this->params['named']['req_lab']) && $this->params['named']['req_lab']!='')
		{
			$form = $this->params['named']['req_lab'];
			$options['req_lab'] = $this->params['named']['req_lab'];
		}
		
		if(isset($this->params['named']['city']) && $this->params['named']['city']!='')
		{
			$form = $this->params['named']['city'];
			$options['city'] = $this->params['named']['city'];
		}
		
		if(isset($this->params['named']['status']) && $this->params['named']['status']!='')
		{
			$form = $this->params['named']['status'];
			$options['status'] = $this->params['named']['status'];
		}
			
		if(!empty($this->data))
		{
			//print_R($this->data);die;
			if(!empty($this->data['Filter']['req_from_date']))
			{
				$conditions['RunnerRequest.date >='] = date('Y-m-d',strtotime($this->data['Filter']['req_from_date']));
				$options['req_from_date'] =  date('Y-m-d',strtotime($this->data['Filter']['req_from_date']));
				$this->set('data_req_from_date',$this->data['Filter']['req_from_date']);
			}
			
			if(!empty($this->data['Filter']['req_to_date']))
			{
				$conditions['RunnerRequest.date <='] = date('Y-m-d',strtotime($this->data['Filter']['req_to_date']));
				$options['req_to_date'] =  date('Y-m-d',strtotime($this->data['Filter']['req_to_date']));
				$this->set('data_req_to_date',$this->data['Filter']['req_to_date']);
			}
			
			if(!empty($this->data['Filter']['req_lab1']))
			{
				$conditions['RunnerRequest.booked_by'] = $this->data['Filter']['req_lab1'];
				$options['req_lab1'] = $this->data['Filter']['req_lab1'];
				$this->set('data_req_lab1',$this->data['Filter']['req_lab1']);
			}
			
			if(!empty($this->data['Filter']['req_lab']))
			{
				$conditions['RunnerRequest.serviced_by'] = $this->data['Filter']['req_lab'];
				$options['req_lab'] = $this->data['Filter']['req_lab'];
				$this->set('data_req_lab',$this->data['Filter']['req_lab']);
			}
			
			if(!empty($this->data['Filter']['city']))
			{
				$conditions['RunnerRequest.pickup_city'] = $this->data['Filter']['city'];
				$options['city'] = $this->data['Filter']['city'];
				$this->set('data_req_city',$this->data['Filter']['city']);
			}
			
			if(!empty($this->data['Filter']['status']))
			{
				$conditions['RunnerRequest.status'] = $this->data['Filter']['status'];
				$options['status'] = $this->data['Filter']['status'];
				$this->set('data_req_status',$this->data['Filter']['status']);
			}
			
			if(!empty($this->data['Filter']['runner']))
			{
				$conditions['RunnerRequest.agent_id'] = $this->data['Filter']['runner'];
				$options['runner'] = $this->data['Filter']['status'];
				$this->set('data_req_runner',$this->data['Filter']['runner']);
			}
					//print_R($options);die;
			$this->set('options',$options);
		}

		if(empty($this->data['Filter']['req_from_date']) && empty($this->data['Filter']['req_to_date']))
		{
			$conditions['RunnerRequest.date'] = date('Y-m-d');
		}
		$this->paginate = array('RunnerRequest' => array('limit' =>'20','order'=>array('RunnerRequest.id'=>'DESC'),'conditions'=>$conditions,'order'=>'RunnerRequest.time_slot ASC'));
		$runnerservicelist=$this->paginate('RunnerRequest');
		$pcc_list = $this->Lab->find('list',array('conditions'=>array('Lab.status'=>1),'fields'=>array('Lab.id','Lab.pcc_name')));
		
		$this->RunnerTimeslot = ClassRegistry::init("RunnerTimeslot");
		$time_slot = $this->RunnerTimeslot->find('list',array('fields'=>array('RunnerTimeslot.id','RunnerTimeslot.slot_name')));
		
		$users = $this->Admin->find('list',array('conditions'=>array('Admin.userType'=>array('A','BM')),'fields'=>array('id','name')));
		$agent_list = $this->Agent->find('list',array('conditions'=>array('Agent.status'=>1,'Agent.role'=>array('2','3')),'fields'=>array('Agent.id','Agent.name')));
		$runner_status = Configure::read('RunnerStatus');
		$city = $this->City->find('list',array('conditions'=>array('City.status'=>1),'fields'=>array('City.id','City.name')));
		
		$this->set('city',$city);
		$this->set('runnerservicelist',$runnerservicelist);
		$this->set('agent_list',$agent_list);
		$this->set('pcc_list',$pcc_list);
		$this->set('time_slot',$time_slot);
		$this->set('users',$users);
		$this->set('runner_status',$runner_status);
		
		$this->dropLocations = ClassRegistry::init('DropLocations');
		$drop_loc = $this->dropLocations->find('list',array('fields'=>array('DropLocations.id','DropLocations.location_name')));
		$this->set('drop_loc',$drop_loc);
	}
	
	function admin_edit_runner_request($runner_service=null)
	{
		$working_day = array('1'=>'Monday','2'=>'Tuesday','3'=>'Wednesday','4'=>'Thursday','5'=>'Friday','6'=>'Saturday','0'=>'Sunday');
		$runner_service_id = base64_decode($runner_service);
		
		$this->Agent = ClassRegistry::init("Agent");
		$this->RunnerRequest = ClassRegistry::init("RunnerRequest");
		
		$this->Lab = ClassRegistry::init("Lab");
		$this->Samplemaster = ClassRegistry::init("Samplemaster");
		$this->runnerservicedata1 = $this->RunnerRequest->find('first',array('conditions'=>array('RunnerRequest.id'=>$runner_service_id)));
		
		if($this->data)
		{
			$this->runnerservicedata = $this->RunnerRequest->create($this->data);
			$this->data['Runner']['date'] = date('Y-m-d',strtotime($this->data['Runner']['date']));
			if(strtotime($this->runnerservicedata1['RunnerRequest']['date']) != strtotime($this->data['Runner']['date']))
				$this->data['Runner']['status'] = '8';
			
			$this->runnerservicedata['RunnerRequest'] = $this->data['Runner'];
							
			if($this->RunnerRequest->save($this->runnerservicedata))
			{
				$this->Session->setFlash('Runner Service Updated Successfully.','flash_success');  
				$this->redirect('/admin/runner/edit_runner_request/'.base64_encode($this->data['Runner']['id']));
			}
			else
			{
				$this->Session->setFlash('Error On Updating Runner Service.','flash_failure');  
				$this->redirect('/admin/runner/edit_runner_request/'.base64_encode($this->data['Runner']['id']));
			}
		}
		
		$this->runnerservicedata = $this->RunnerRequest->find('first',array('conditions'=>array('RunnerRequest.id'=>$runner_service_id)));
		$this->RunnerSampleData = ClassRegistry::init("RunnerSampleData");
		
		if($this->runnerservicedata['RunnerRequest']['status'] >='3')
		{
			$specific_sample = $this->Samplemaster->find('list',array('conditions'=>array('Samplemaster.to_be_shown'=>1),'fields'=>array('Samplemaster.type','Samplemaster.sample_id')));
			$other_sample = $this->Samplemaster->find('list',array('conditions'=>array('Samplemaster.to_be_shown'=>0),'fields'=>array('Samplemaster.type','Samplemaster.sample_id')));

			if($this->runnerservicedata['RunnerRequest']['status']>='4')
			{
				$pickup_sample_value = $this->RunnerSampleData->find('list',array('conditions'=>array('RunnerSampleData.runner_data_id'=>$runner_service_id,'RunnerSampleData.status'=>'0'),'fields'=>array('RunnerSampleData.sample_type','RunnerSampleData.no_of_vials')));
				$this->set('pickup_sample_value',$pickup_sample_value);
				if($this->runnerservicedata['RunnerRequest']['status']>='5')
				{
					$drop_sample_value = $this->RunnerSampleData->find('list',array('conditions'=>array('RunnerSampleData.runner_data_id'=>$runner_service_id,'RunnerSampleData.status'=>'1'),'fields'=>array('RunnerSampleData.sample_type','RunnerSampleData.no_of_vials')));
					//print_R($drop_sample_value);die;
					$this->set('drop_sample_value',$drop_sample_value);
				}
			}
			//print_R($specific_sample);die;
			$this->set('sample_specific',$specific_sample);
			$this->set('sample_others',$other_sample);
		}
		
		$this->runnerservicedata['RunnerRequest']['date'] = date('d-m-Y',strtotime($this->runnerservicedata['RunnerRequest']['date']));
		
		$pcc_list = $this->Lab->find('list',array('conditions'=>array('Lab.status'=>1),'fields'=>array('Lab.id','Lab.pcc_name')));
				
		$this->RunnerTimeslot = ClassRegistry::init("RunnerTimeslot");
		$time_slot = $this->RunnerTimeslot->find('list',array('fields'=>array('RunnerTimeslot.id','RunnerTimeslot.slot_name')));
		
		$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
		$pickupPincode = $this->Pincodemaster->find('all',array('conditions'=>array('PincodeMaster.pincode'=>$this->runnerservicedata['RunnerRequest']['pickup_pincode'])));
		$dropPincode = $this->Pincodemaster->find('all',array('conditions'=>array('PincodeMaster.pincode'=>$this->runnerservicedata['RunnerRequest']['drop_pincode'])));
		
		$sample_list = $this->Samplemaster->find('list',array('fields'=>array('Samplemaster.sample_id','Samplemaster.type')));
		//print_R($sample_list);die;
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));
		$state = $this->State->find('all',array('conditions'=>array('State.status'=>1)));
		$this->set('sample_list',$sample_list);
		$this->set('lab_list',$pcc_list);
		$this->set('working_day',$working_day);
		$this->set('time_slot',$time_slot);
		$this->set('city',$city);
		$this->set('state',$state);
		$this->set('pickupPincode',$pickupPincode);
		$this->set('dropPincode',$dropPincode);
		$this->data['Runner'] = $this->runnerservicedata['RunnerRequest'];
		
		$sampleColor = array("Sodium Citrate (Blue)"=>"lightblue",  "SERUM (SST or Plain)"=>"yellow" ,  "Sodium Heparin (Green)"=>"green",  "EDTA Whole Blood (Purple)"=>"purple",  "Glucose"=>"darkgrey","Urine"=>"#FFD700",  "Stool"=>"brown",  "Sputum"=>"white");
		$this->set('sample_color',$sampleColor);
		$this->dropLocations = ClassRegistry::init('DropLocations');
		$drop_loc = $this->dropLocations->find('list',array('fields'=>array('DropLocations.id','DropLocations.location_name')));
		$this->set('drop_loc',$drop_loc);
		
		$this->pickupLocations = ClassRegistry::init('PickupLocations');
		$pick_loc = $this->pickupLocations->find('list',array('fields'=>array('PickupLocations.id','PickupLocations.location_name')));
		$this->set('pick_loc',$pick_loc);
		//print_R($this->data);die;
	}
	
	function admin_assign_runner_agent()
	{
		$agent_value = $_REQUEST['agent'];

		$id = $_REQUEST['id'];
		$update = $this->RunnerRequest->query("UPDATE runner_request SET agent_id ='$agent_value',status='2' WHERE id='".$id."'");
		exit;
	}
	
	function admin_confirm_runner_agent()
	{
		$id = $_REQUEST['id'];
		$update = $this->RunnerRequest->query("UPDATE runner_request SET status='3' WHERE id='".$id."'");
		
		$runnerrequest = $this->RunnerRequest->find('first',array('conditions'=>array('RunnerRequest.id'=>$id)));

		$this->Agent = ClassRegistry::init('Agent');
		$agentdata = $this->Agent->find('first',array('conditions'=>array('Agent.id'=>$runnerrequest['RunnerRequest']['agent_id'])));

		$message = 'Dear '.strtoupper($agentdata['Agent']['name']).', Runner Request - '.$runnerrequest['RunnerRequest']['runner_request_id'].' has been assigned to you. Thanks';
		$this->__sms_message($agentdata['Agent']['contact'],$message);
		$this->send_mail_runner($agentdata,$runnerrequest);
		exit;
	}
	
	function admin_runner_pickup_data($runner_service=null)
	{
		//print_R($_POST);die;
		$pick_date = date('Y=m-d h:i:s');
		$runner_service_id = base64_decode($runner_service);
		$this->RunnerSampleData = ClassRegistry::init("RunnerSampleData");
		
		foreach($_POST['pickup_sample_value'] as $key=>$val)
		{
			if(!empty($_POST['pickup_sample_value'][$key]))
			{
				$this->runnersampledata = $this->RunnerSampleData->create();
				$this->runnersampledata['RunnerSampleData']['runner_data_id'] = $runner_service_id;
				$this->runnersampledata['RunnerSampleData']['sample_type'] = $key;
				$this->runnersampledata['RunnerSampleData']['no_of_vials'] = $_POST['pickup_sample_value'][$key];
				$this->runnersampledata['RunnerSampleData']['status'] = 0;
				$this->RunnerSampleData->save($this->runnersampledata);
			}
		}
		if(!empty($_POST['pickup_sample_others']))
		{
			$this->runnersampledata = $this->RunnerSampleData->create();
			$this->runnersampledata['RunnerSampleData']['runner_data_id'] = $runner_service_id;
			$this->runnersampledata['RunnerSampleData']['sample_type'] = "others";
			$this->runnersampledata['RunnerSampleData']['no_of_vials'] = $_POST['pickup_sample_others'];
			$this->runnersampledata['RunnerSampleData']['status'] = 0;
			$this->RunnerSampleData->save($this->runnersampledata);
		}
		
		$this->RunnerRequest->query("UPDATE runner_request SET recieved_amount='".$this->data['Runner_pickup']['recieved_amount']."',status='4',pickup_datetime='".$pick_date."',pickup_remark='".$_POST['pickup_remarks']."' WHERE id='".$runner_service_id."'");
		$this->Session->setFlash('Pick Up Data Updated Successfully.','flash_success');  
		$this->redirect('/admin/runner/edit_runner_request/'.base64_encode($runner_service_id));
	}
	
	function admin_runner_drop_data($runner_service=null)
	{
		$pick_date = date('Y=m-d h:i:s');
		$runner_service_id = base64_decode($runner_service);
		$this->RunnerSampleData = ClassRegistry::init("RunnerSampleData");
		
		foreach($_POST['drop_sample_value'] as $key=>$val)
		{
			if(!empty($_POST['drop_sample_value'][$key]))
			{
				$this->runnersampledata = $this->RunnerSampleData->create();
				$this->runnersampledata['RunnerSampleData']['runner_data_id'] = $runner_service_id;
				$this->runnersampledata['RunnerSampleData']['sample_type'] = $key;
				$this->runnersampledata['RunnerSampleData']['no_of_vials'] = $_POST['drop_sample_value'][$key];
				$this->runnersampledata['RunnerSampleData']['status'] = 1;
				$this->RunnerSampleData->save($this->runnersampledata);
			}
		}
		if(!empty($_POST['drop_sample_others']))
		{
			$this->runnersampledata = $this->RunnerSampleData->create();
			$this->runnersampledata['RunnerSampleData']['runner_data_id'] = $runner_service_id;
			$this->runnersampledata['RunnerSampleData']['sample_type'] = "others";
			$this->runnersampledata['RunnerSampleData']['no_of_vials'] = $_POST['drop_sample_others'];
			$this->runnersampledata['RunnerSampleData']['status'] = 1;
			$this->RunnerSampleData->save($this->runnersampledata);
		}
		
		$recieved_amount = "";
		if(isset($this->data['Runner_pickup']['recieved_amount']))
		{
			$recieved_amount = "recieved_amount='".$this->data['Runner_pickup']['recieved_amount']."',";
		}
		
		$this->RunnerRequest->query("UPDATE runner_request SET ".$recieved_amount." status='5',drop_datetime='".$pick_date."',drop_remark='".$_POST['drop_remarks']."' WHERE id='".$runner_service_id."'");
		$this->Session->setFlash('Drop Data Updated Successfully.','flash_success');  
		$this->redirect('/admin/runner/edit_runner_request/'.base64_encode($runner_service_id));
	}
	
	function admin_runner_confirm_data($runner_service=null)
	{
		$runner_service_id = base64_decode($runner_service);
		$this->RunnerRequest->query("UPDATE runner_request SET status='6',remarks='".$_POST['confirm_remark']."' WHERE id='".$runner_service_id."'");
		$this->redirect('/admin/runner/edit_runner_request/'.base64_encode($runner_service_id));
	}
	
	function admin_cancelrunner()
	{
		//$this->RunnerRequest->query("UPDATE runner_request SET status='7' WHERE id='".$_POST['id']."'");
		print_R(array('message'=>'success'));die;
	}
	
	function admin_closerunner()
	{
		$this->runnerservicedata = $this->RunnerRequest->find('first',array('conditions'=>array('RunnerRequest.id'=>$_POST['id'])));
		if($this->runnerservicedata['RunnerRequest']['runner_charges'] == $this->runnerservicedata['RunnerRequest']['recieved_amount'])
		{
			$this->RunnerRequest->query("UPDATE runner_request SET status='9' WHERE id='".$_POST['id']."'");
			print_R(json_encode(array('message'=>'success')));die;
		}
		else
		{
			print_R(json_encode(array('message'=>'failure','amount'=>($this->runnerservicedata['RunnerRequest']['runner_charges']-$this->runnerservicedata['RunnerRequest']['recieved_amount']))));die;
		}
	}
	
	function send_mail_runner($agent,$runner)
	{
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
		$mail->addAddress($agent['Agent']['email'],$agent['Agent']['name']);
		$mail->Username = 'lab.reports@niramayapathlabs.com';
		$mail->Password = 'Lab@Reports';
						//print_R(json_encode($mail));die;
		$mail->Subject = "Confirmation Mail For Sample Pickup";
		$mail->Body = "<table width='600' border='0' cellspacing='0' cellpadding='0' align='left'>
							<tr>
								<td>
									Dear ".$agent['Agent']['name']."
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									Runner Request : ".$runner['RunnerRequest']['runner_request_id']." has been assigned to You.
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
									<br/>
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
		$mail->send();
	}
	
	public function admin_add_drop_loc()
	{
		$this->City = ClassRegistry::init('City');
		$this->dropLocations = ClassRegistry::init('DropLocations');
		
		if($this->data)
		{
			//print_R($this->data);die;
			$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
			$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$this->data['DropLocations']['pincode'],'PincodeMaster.locality LIKE '=>"%".str_replace("_"," ",$this->data['DropLocations']['locality'])."%")));
			//print_R(str_replace("_"," ",$this->data['DropLocations']['locality']));
			$this->data['DropLocations']['city'] = $pincodeMaster['PincodeMaster']['city'];
			$this->data['DropLocations']['state'] = $pincodeMaster['PincodeMaster']['state'];
			//print_R($this->data);die;
			$this->dropLocations->create();
			if($this->dropLocations->save($this->data))
			{
				$this->Session->setFlash('Drop Location Added.','flash_success');  
				$this->redirect('/admin/runner/drop_loc_list/');
			}
			else
			{
				$this->Session->setFlash('Error Adding Drop Location.','flash_failure');  
				$this->redirect('/admin/runner/drop_loc_list/');
			}
		}
		
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));
		$state = $this->State->find('all',array('conditions'=>array('State.status'=>1)));

		$this->set('city',$city);
		$this->set('state',$state);
	}
	
	public function admin_edit_drop_loc($drop_loc=null)
	{
		$drop_loc_id = base64_decode($drop_loc);
		//print_R($drop_loc_id);die;
		$this->dropLocations = ClassRegistry::init('DropLocations');
		
		if($this->data)
		{
			//print_R($this->data);
			$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
			$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$this->data['DropLocations']['pincode'],'PincodeMaster.locality LIKE'=>"%".str_replace("_"," ",$this->data['DropLocations']['locality'])."%")));
			//print_R($pincodeMaster);die;
			$this->data['DropLocations']['id'] = $drop_loc_id;
			$this->data['DropLocations']['city'] = $pincodeMaster['PincodeMaster']['city'];
			$this->data['DropLocations']['state'] = $pincodeMaster['PincodeMaster']['state'];
			$this->dropLocations->create();
			$this->dropLocations->save($this->data);
			
			$this->Session->setFlash('Drop Location Updated.','flash_success');  
			$this->redirect('/admin/runner/drop_loc_list/');
		}
				
		$this->data = $this->dropLocations->find('first',array('conditions'=>array('DropLocations.id'=>$drop_loc_id)));
		$localityArray = array();
		
		$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
		$pincodeMaster = $this->Pincodemaster->find('all',array('conditions'=>array('PincodeMaster.pincode'=>$this->data['DropLocations']['pincode'])));
		foreach($pincodeMaster as $key=>$val)
		{
			$array_key = str_replace(" ","_",$val['PincodeMaster']['locality']);

			$localityArray[$array_key] = $val['PincodeMaster']['locality'];
		}
		//print_R($localityArray);die;
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));
		$state = $this->State->find('all',array('conditions'=>array('State.status'=>1)));
		
		$this->set('locality_array',$localityArray);
		$this->set('city',$city);
		$this->set('state',$state);
	}
	
	public function admin_drop_loc_list()
	{
		$this->dropLocations = ClassRegistry::init('DropLocations');
		$conditions="";
		if($this->data)
		{
			//print_R($this->data);die;
			$conditions['DropLocations.location_name LIKE'] = "%".$this->data['Filter']['loc_name']."%";
			$this->set('loc_name',$loc_name);
		}
		$this->paginate = array('DropLocations' => array('limit' =>'20','order'=>array('DropLocations.id'=>'DESC'),'conditions'=>$conditions));
		
		$drop_location=$this->paginate('DropLocations');
		$this->set('drop_location',$drop_location);
	}
	
	function admin_assign_drop()
	{
		$drop_value = $_REQUEST['drop_id'];

		$id = $_REQUEST['id'];
		$update = $this->RunnerRequest->query("UPDATE runner_request SET drop_loc_id ='$drop_value' WHERE id='".$id."'");
		exit;
	}
	
	function admin_get_loc_detail()
	{
		$loc_id = $_REQUEST['loc_id'];

		$this->PickupLocations = ClassRegistry::init('PickupLocations');
		$loc_detail = $this->PickupLocations->find('first',array('conditions'=>array('PickupLocations.id'=>$loc_id)));
		print_R(json_encode($loc_detail));die;
	}
	
	public function admin_add_pick_loc()
	{
		$this->City = ClassRegistry::init('City');
		$this->pickLocations = ClassRegistry::init('PickupLocations');
		$this->ZoneLoc = ClassRegistry::init('ZoneLoc');

		if($this->data)
		{
			//print_R($this->data);die;
			$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
			$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$this->data['PickupLocations']['pincode'],'PincodeMaster.locality LIKE '=>"%".str_replace("_"," ",$this->data['PickupLocations']['locality'])."%")));

			$this->data['PickupLocations']['city'] = $pincodeMaster['PincodeMaster']['city'];
			$this->data['PickupLocations']['state'] = $pincodeMaster['PincodeMaster']['state'];

			$this->pickLocations->create();
			if($this->pickLocations->save($this->data))
			{
				$loc_id = $this->pickupLocations->getLastInsertId();
				
				$zones = explode(',',$this->data['PickupLocations']['zones']);

				foreach($zones as $key=>$val)
				{
					$loc = $this->ZoneLoc->create();

					$loc['ZoneLoc']['zone_id'] = $val;
					$loc['ZoneLoc']['locations_id'] = $loc_id;
					
					$this->ZoneLoc->save($loc);
				}

				$this->Session->setFlash('Pickup Location Added.','flash_success');  
				$this->redirect('/admin/runner/pick_loc_list/');
			}
			else
			{
				$this->Session->setFlash('Error Adding Pickup Location.','flash_failure');  
				$this->redirect('/admin/runner/pick_loc_list/');
			}
		}
		
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));
		$state = $this->State->find('all',array('conditions'=>array('State.status'=>1)));

		$this->set('city',$city);
		$this->set('state',$state);
	}
	
	public function admin_edit_pick_loc($pick_loc=null)
	{
		$drop_loc_id = base64_decode($pick_loc);
		//print_R($drop_loc_id);die;
		$this->pickupLocations = ClassRegistry::init('PickupLocations');
		$this->ZoneLoc = ClassRegistry::init('ZoneLoc');
		
		if($this->data)
		{
			//print_R($this->data);
			$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
			$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$this->data['PickupLocations']['pincode'],'PincodeMaster.locality LIKE'=>"%".str_replace("_"," ",$this->data['PickupLocations']['locality'])."%")));
			//print_R($pincodeMaster);die;
			$this->data['PickupLocations']['id'] = $drop_loc_id;
			$this->data['PickupLocations']['city'] = $pincodeMaster['PincodeMaster']['city'];
			$this->data['PickupLocations']['state'] = $pincodeMaster['PincodeMaster']['state'];
			$this->pickupLocations->create();
			$this->pickupLocations->save($this->data);
			
			$this->ZoneLoc->query("Delete from zone_loc where location_id='".$drop_loc_id."'");
				
			$zones = explode(',',$this->data['PickupLocations']['zones']);

			foreach($zones as $key=>$val)
			{
				$loc = $this->ZoneLoc->create();

				$loc['ZoneLoc']['zone_id'] = $val;
				$loc['ZoneLoc']['locations_id'] = $drop_loc_id;
				
				$this->ZoneLoc->save($loc);
			}

			$this->Session->setFlash('Drop Location Updated.','flash_success');  
			$this->redirect('/admin/runner/drop_loc_list/');
		}
				
		$this->data = $this->pickupLocations->find('first',array('conditions'=>array('PickupLocations.id'=>$drop_loc_id)));

		$p_loc = $this->ZoneLoc->query("select group_concat(zone_id) as loc from zone_loc where location_id='".$drop_loc_id."'");

		$this->data['PickupLocations']['zones']= $p_loc[0][0][loc];
		//print_R($this->data);die;

		$localityArray = array();
		
		$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
		$pincodeMaster = $this->Pincodemaster->find('all',array('conditions'=>array('PincodeMaster.pincode'=>$this->data['PickupLocations']['pincode'])));
		foreach($pincodeMaster as $key=>$val)
		{
			$array_key = str_replace(" ","_",$val['PincodeMaster']['locality']);

			$localityArray[$array_key] = $val['PincodeMaster']['locality'];
		}
		//print_R($localityArray);die;
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));
		$state = $this->State->find('all',array('conditions'=>array('State.status'=>1)));
		
		$this->set('locality_array',$localityArray);
		$this->set('city',$city);
		$this->set('state',$state);
	}
	
	public function admin_pick_loc_list()
	{
		$this->pickupLocations = ClassRegistry::init('PickupLocations');
		$conditions="";
		if($this->data)
		{
			//print_R($this->data);die;
			$conditions['PickupLocations.location_name LIKE'] = "%".$this->data['Filter']['loc_name']."%";
			$this->set('loc_name',$loc_name);
		}
		$this->paginate = array('PickupLocations' => array('limit' =>'20','order'=>array('PickupLocations.id'=>'DESC'),'conditions'=>$conditions));
		
		$pick_location=$this->paginate('PickupLocations');
		$this->set('pick_locations',$pick_location);
	}

	public function admin_route_list()
	{
		$this->Zone = ClassRegistry::init('Zone');
		$this->Agent = ClassRegistry::init('Agent');
		$this->ZoneLoc = ClassRegistry::init('ZoneLoc');
		
		$this->PickupLocations = ClassRegistry::init('PickupLocations');
		$conditions="";

		$this->paginate = array('Zone' => array('limit' =>'20','order'=>array('Zone.id'=>'DESC'),'conditions'=>$conditions));

		$zone=$this->paginate('Zone');
		$count=0;

		foreach($zone as $key=>$val)
		{
			$selected_loc = $this->ZoneLoc->find('all',array('conditions'=>array('ZoneLoc.zone_id'=>$val['Zone']['id'])));
			$loc_name = "";
			foreach($selected_loc as $loc)
			{
				//echo $loc;
				$location_name = $this->PickupLocations->find('first',array('conditions'=>array('PickupLocations.id'=>$loc['ZoneLoc']['location_id'])));
				$loc_name .= $location_name['PickupLocations']['location_name']."<br>";
			}

			$zone[$count]['Zone']['location_name'] = $loc_name;
			$count++;
		}

		$agent_list = $this->Agent->find('list',array('conditions'=>array('Agent.status'=>1,'Agent.role'=>array('2','3')),'fields'=>array('Agent.id','Agent.name')));
		$this->set('zone',$zone);
		$this->set('agent',$agent_list);
	}

	public function admin_add_route()
	{
		$this->Zone = ClassRegistry::init('Zone');
		$this->ZoneLoc = ClassRegistry::init('ZoneLoc');

		if($this->data)
		{
			$this->data['Zone']['zone_id'] = "RO-".strtotime(date('Y-m-d'));
			$this->data['Zone']['status'] = 1;
			//print_R($this->data);die;
			if($this->Zone->save($this->data))
			{
				$zone_id = $this->Zone->getLastInsertId();
				$locations = explode(',',$this->data['Zone']['pickup_location']);
				foreach($locations as $key=>$val)
				{
					$loc = $this->ZoneLoc->Create();
					$loc['ZoneLoc']['zone_id'] = $zone_id;
					$loc['ZoneLoc']['location_id'] = $val;
					$this->ZoneLoc->save($loc);
				}

				$this->Session->setFlash('Zone Successfully Added.','flash_success');  
				$this->redirect('/admin/runner/route_list/');
			}
			else
			{
				$this->Session->setFlash('Error Adding Zone.','flash_failure');  
			}
		}
	}

	public function admin_edit_route($id=NULL)
	{
		$id = base64_decode($id);

		$this->Zone = ClassRegistry::init('Zone');
		$this->ZoneLoc = ClassRegistry::init('ZoneLoc');
		
		if($this->data)
		{
			$this->data['Zone']['id'] = $id;
			$this->data['Zone']['zone_id'] = "Z-".strtotime(date('Y-m-d'));
			$this->data['Zone']['status'] = 1;
			if($this->Zone->save($this->data))
			{
				$this->ZoneLoc->query("Delete from zone_loc where zone_id='".$id."'");

				$locations = explode(',',$this->data['Zone']['pickup_location']);
				foreach($locations as $key=>$val)
				{
					$loc = $this->ZoneLoc->Create();
					$loc['ZoneLoc']['zone_id'] = $id;
					$loc['ZoneLoc']['location_id'] = $val;
					$this->ZoneLoc->save($loc);
				}

				$this->Session->setFlash('Zone Successfully Updated.','flash_success');  
				$this->redirect('/admin/runner/route_list/');
			}
			else
			{
				$this->Session->setFlash('Error Uodating Zone.','flash_failure');  
			}
		}

		$this->data = $this->Zone->find('first',array('conditions'=>array('Zone.id'=>$id)));
		$p_loc = $this->ZoneLoc->query("select group_concat(location_id) as loc from zone_loc where zone_id='".$id."'");
		//print_R($p_loc);die;

		$this->data['Zone']['pickup_location'] = $p_loc[0][0][loc];
	}

	public function admin_get_location()
	{
		$this->PickupLocations = ClassRegistry::init('PickupLocations');

		$this->layout="";
		$s_l="";
		if(!empty($_POST['s_l']))
			$s_l = "and id NOT IN (".$_POST['s_l'].")";

		$location = $this->PickupLocations->query("Select * from pickup_locations where location_name LIKE '".$_POST['search']."%' ".$s_l);
		$content="";
//print_R($location);die;
		foreach($location as $key=>$val)
		{

			$content .= "<option value='".$val['pickup_locations']['id']."'>".$val['pickup_locations']['location_name']."</option>";
		}

		print_R($content);die;
		$this->render(false);
	}

	public function admin_loc_detail()
	{
		$this->PickupLocations = ClassRegistry::init('PickupLocations');

		$sel_loc = explode(',',$_POST['sel_loc']);

		if($_POST['sel_loc'][0]=='')
		{
			$sel_loc = array();
		}

		if(!empty($_POST['id']))
		{
			if(!in_array($_POST['id'],$sel_loc))
			{
				array_push($sel_loc,$_POST['id']);
			}
			else
			{
				echo "failure";die;
			}
		}

		$location_detail = $this->PickupLocations->query("Select * from pickup_locations where id in (".implode(',',$sel_loc).")");

		$content = "";
		$loc_id = array();
		foreach($location_detail as $val)
		{
			$content .= "<div id='loc".$val['pickup_locations']['id']."'>".$val['pickup_locations']['location_name']."<a href='javascript:void(0);' onclick='delete_loc(".$val['pickup_locations']['id'].")' style='font-weight:bold; color:#FF0000; text-decoration:none;'>[X]</a></div>";

			array_push($loc_id,$val['pickup_locations']['id']);
		}

		print_R($content."@@@@@".implode(',',$loc_id));die;
	}

	public function admin_get_zones()
	{
		$this->Zone = ClassRegistry::init('Zone');

		$this->layout="";
		$s_z="";
		if(!empty($_POST['s_z']))
			$s_z = "and id NOT IN (".$_POST['s_z'].")";

		$location = $this->Zone->query("Select * from zone where name LIKE '".$_POST['search']."%' ".$s_z);
		$content="";

		foreach($location as $key=>$val)
		{

			$content .= "<option value='".$val['zone']['id']."'>".$val['zone']['name']."</option>";
		}

		print_R($content);die;
	}

	public function admin_zone_detail()
	{
		$this->Zone = ClassRegistry::init('Zone');

		$sel_zone = explode(',',$_POST['sel_zone']);

		if($_POST['sel_zone'][0]=='')
		{
			$sel_zone = array();
		}

		if(!empty($_POST['id']))
		{
			if(!in_array($_POST['id'],$sel_zone))
			{
				array_push($sel_zone,$_POST['id']);
			}
			else
			{
				echo "failure";die;
			}
		}

		$zone_detail = $this->Zone->query("Select * from zone where id in (".implode(',',$sel_zone).")");

		$content = "";
		$zone_id = array();
		foreach($zone_detail as $val)
		{
			$content .= "<div id='loc".$val['zone']['id']."'>".$val['zone']['name']."<a href='javascript:void(0);' onclick='delete_loc(".$val['zone']['id'].")' style='font-weight:bold; color:#FF0000; text-decoration:none;'>[X]</a></div>";

			array_push($zone_id,$val['zone']['id']);
		}

		print_R($content."@@@@@".implode(',',$zone_id));die;
	}

	public function admin_assign_routerunner()
	{
		$this->Zone = ClassRegistry::init('Zone');
		$this->ZoneLoc = ClassRegistry::init('ZoneLoc');
		$this->RunnerRequest = ClassRegistry::init('RunnerRequest');
		$this->Agent = ClassRegistry::init('Agent');

		if($this->data)
		{
			//print_R($this->data);die;
			$runner_data = $this->RunnerRequest->find('all',array('conditions'=>array('RunnerRequest.date'=>date('Y-m-d',strtotime($this->data['Runner']['date'])))));
//print_R($runner_data);die;
			if(count($runner_data)>0)
			{
				foreach($this->data['Runner']['zone'] as $key=>$val)
				{
					$zone_data = $this->Zone->find('first',array('conditions'=>array('Zone.id'=>$key)));
					$this->Zone->query("Update zone set runner_id='".$val."' where id='".$key."'");

					$zoneloc_data = $this->ZoneLoc->query("Select group_concat(location_id) as loc_id from zone_loc where zone_id='".$key."'");

					if($zone_data['Zone']['time_of_day']=='morning')
					{
						$this->RunnerRequest->query("Update runner_request set agent_id='".$val."' where time_slot < 15 and pick_loc_id in (".$zoneloc_data[0][0]['loc_id'].") and date='".date('Y-m-d',strtotime($this->data['RunnerRequest']['date']))."'");
					}
					else
					{
						$this->RunnerRequest->query("Update runner_request set agent_id='".$val."' where time_slot > 15 and pick_loc_id in (".$zoneloc_data[0][0]['loc_id'].") and date='".date('Y-m-d',strtotime($this->data['RunnerRequest']['date']))."'");
					}
				}
				$this->Session->setFlash('Agent Assigned with Respect to Routes Successfully.','flash_success');  
				$this->redirect('/admin/runner/runner_request/');
			}
			else
			{
				$this->Session->setFlash('No Runner Request found for the Date '.$this->data['Runner']['date'],'flash_failure');  
				$this->redirect('/admin/runner/assign_routerunner/');
			}
		}

		$zone_list = $this->Zone->find('all');
		$agent_list = $this->Agent->find('list',array('conditions'=>array('Agent.status'=>1,'Agent.role'=>array('2','3')),'fields'=>array('Agent.id','Agent.name')));

		$this->set('zone',$zone_list);
		$this->set('agent',$agent_list);
	}
}