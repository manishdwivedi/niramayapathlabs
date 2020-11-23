<?php

class TicketController extends AppController {
	
	var $name = "Ticket";

	var $breadcrumb = array();

	var $uses=array('Ticket','User','Admin','Billing','TicketTracking','TicketRecurring','Timelab','TaskCategory');

	var $helpers = array('Form','Html','Javascript', 'Ajax','Utility');

	public $components = array('RequestHandler','Cookie','Utility');

	public $paginate = array('maxLimit' => 10);

	function admin_index()
	{
		$this->User = ClassRegistry::init("User");
		$this->Admin = ClassRegistry::init("Admin");
		$this->Billing = ClassRegistry::init("Billing");
		$this->TaskCategory = ClassRegistry::init("TaskCategory");
		//print_R($users);die;
		$this->set('users',$users);
		$this->set('title_for_layout', 'View Sample Request');
		$this->set('title', '');
		$this->set('data_req_from_date', '');
		$this->set('data_req_to_date', '');
		$this->Ticket = ClassRegistry::init('Ticket');
		//$ticket = $this->Ticket->find('All',array('conditions'=>array('Health.id'=>$id)));
		$conditions = '';

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
		if(isset($this->params['named']['title']) && $this->params['named']['title']!='')
		{
			$this->data['Filter']['date_type'] = $this->params['named']['date_type'];
			$options['date_type'] = $this->params['named']['date_type'];
		}
		if(isset($this->params['named']['req_no']) && $this->params['named']['req_no']!='')
		{
			$this->data['Filter']['req_no'] = $this->params['named']['req_no'];
			$options['req_no'] = $this->params['named']['req_no'];
		}
		if(isset($this->params['named']['lab_no']) && $this->params['named']['lab_no']!='')
		{
			$this->data['Filter']['lab_no'] = $this->params['named']['lab_no'];
			$options['lab_no'] = $this->params['named']['lab_no'];
		}
		if(isset($this->params['named']['ticket_no']) && $this->params['named']['ticket_no']!='')
		{
			$this->data['Filter']['ticket_no'] = $this->params['named']['ticket_no'];
			$options['ticket_no'] = $this->params['named']['ticket_no'];
		}
		if(isset($this->params['named']['category']) && $this->params['named']['category']!='')
		{
			$this->data['Filter']['category'] = $this->params['named']['category'];
			$options['category'] = $this->params['named']['category'];
		}
		
		if(isset($this->params['named']['priority']) && $this->params['named']['priority']!='')
		{
			$this->data['Filter']['priority'] = $this->params['named']['priority'];
			$options['priority'] = $this->params['named']['priority'];
		}

		if(isset($this->params['named']['assigned_to']) && $this->params['named']['assigned_to']!='')
		{
			$this->data['Filter']['assigned_to'] = $this->params['named']['assigned_to'];
			$options['assigned_to'] = $this->params['named']['assigned_to'];
		}

		if(isset($this->params['named']['status']) && $this->params['named']['status']!='')
		{
			$this->data['Filter']['status'] = $this->params['named']['status'];
			$options['status'] = $this->params['named']['status'];
		}

		if(!empty($this->data))
		{
			//print_R($this->data);die;
			if(!empty($this->data['Filter']['req_from_date']))
			{
				if($this->data['Filter']['title']=="creation"){
					$conditions['Ticket.date >='] = date('Y-m-d 00:00:00',strtotime($this->data['Filter']['req_from_date']));
				}
				else
				{
					$conditions['Ticket.complete_by_date >='] = date('Y-m-d 00:00:00',strtotime($this->data['Filter']['req_from_date']));
				}
				
				$options['req_from_date'] =  date('Y-m-d',strtotime($this->data['Filter']['req_from_date']));
				$this->set('data_req_from_date',$this->data['Filter']['req_from_date']);
			}
			
			if(!empty($this->data['Filter']['req_to_date'])  && $this->data['Filter']['title']=="creation")
			{
				if($this->data['Filter']['title']=="creation"){
					$conditions['Ticket.date <='] = date('Y-m-d 23:59:59',strtotime($this->data['Filter']['req_to_date']));
				}
				else
				{
					$conditions['Ticket.complete_by_date <='] = date('Y-m-d 23:59:59',strtotime($this->data['Filter']['req_to_date']));	
				}
				$options['req_to_date'] =  date('Y-m-d',strtotime($this->data['Filter']['req_to_date']));
				$this->set('data_req_to_date',$this->data['Filter']['req_to_date']);
			}

			if(!empty($this->data['Filter']['date_type']))
			{
				$options['title'] = $this->data['Filter']['date_type'];
				$this->set('title',$this->data['Filter']['date_type']);
			}

			if(!empty($this->data['Filter']['assigned_to']))
			{
				$conditions['Ticket.assigned_to'] = $this->data['Filter']['assigned_to'];
				$options['assigned_to'] = $this->data['Filter']['assigned_to'];
				$this->set('assigned_to',$this->data['Filter']['assigned_to']);
			}

			if(!empty($this->data['Filter']['status']))
			{
				$conditions['Ticket.status'] = $this->data['Filter']['status'];
				$options['status'] = $this->data['Filter']['status'];
				$this->set('status_s',$this->data['Filter']['status']);
			}
			
			if(!empty($this->data['Filter']['req_no']))
			{
				$conditions['Ticket.request_id'] = $this->data['Filter']['req_no'];
				$options['req_no'] = $this->data['Filter']['req_no'];
				$this->set('req_no',$this->data['Filter']['req_no']);
			}

			if(!empty($this->data['Filter']['lab_no']))
			{
				$conditions['Ticket.lab_no'] = $this->data['Filter']['lab_no'];
				$options['lab_no'] = $this->data['Filter']['lab_no'];
				$this->set('lab_no',$this->data['Filter']['lab_no']);
			}

			if(!empty($this->data['Filter']['ticket_no']))
			{
				$conditions['Ticket.ticket_id LIKE'] = $this->data['Filter']['ticket_no'];
				$options['ticket_no'] = $this->data['Filter']['ticket_no'];
				$this->set('ticket_no',$this->data['Filter']['ticket_no']);
			}
			
			if(!empty($this->data['Filter']['category']))
			{
				$conditions['Ticket.category'] = $this->data['Filter']['category'];
				$options['category'] = $this->data['Filter']['category'];
				$this->set('data_category',$this->data['Filter']['category']);
			}
			
			if(!empty($this->data['Filter']['priority']))
			{
				$conditions['Ticket.priority'] = $this->data['Filter']['priority'];
				$options['priority'] = $this->data['Filter']['priority'];
				$this->set('data_priority',$this->data['Filter']['priority']);
			}
			//print_R($conditions);die;
			$this->set('options',$options);
		}

		$this->paginate = array('Ticket' => array('limit' =>'20','order'=>array('Ticket.id'=>'desc'),'conditions'=>$conditions));

		$ticketlist=$this->paginate('Ticket');
		$ticketData = array();
		$count = 0;
		
		foreach($ticketlist as $val)
		{
			$billing = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$val['Ticket']['request_id'])));
			$ticketData[$count]['Ticket']['id'] = $val['Ticket']['id'];
			$ticketData[$count]['Ticket']['ticket_id'] = $val['Ticket']['ticket_id'];

			$ticketData[$count]['Ticket']['request_id'] = "-";
			$ticketData[$count]['Ticket']['lab_no'] = "-";
			if(!empty($val['Ticket']['request_id']))
				$ticketData[$count]['Ticket']['request_id'] = $billing['Billing']['order_id'];

			if(!empty($val['Ticket']['lab_no']))
				$ticketData[$count]['Ticket']['lab_no'] = $val['Ticket']['lab_no'];

			$ticketData[$count]['Ticket']['title'] = $val['Ticket']['title'];
			$ticketData[$count]['Ticket']['date'] = $val['Ticket']['date'];
			$ticketData[$count]['Ticket']['last_edited'] = $val['Ticket']['last_edited'];
			$ticketData[$count]['Ticket']['category'] = $val['Ticket']['category'];
			$find_user = $this->Admin->find('first',array('conditions'=>array('Admin.id'=>$val['Ticket']['created_by'])));
			$ticketData[$count]['Ticket']['priority'] = $val['Ticket']['priority'];
			
			$ticketData[$count]['Ticket']['assigned_to'] = $val['Ticket']['assigned_to'];

			$ticketData[$count]['Ticket']['created_by']="-";
			if(!empty($val['Ticket']['created_by']))
				$ticketData[$count]['Ticket']['created_by'] = $find_user['Admin']['name'];
			
			$ticketData[$count]['Ticket']['status'] = $val['Ticket']['status'];
			$ticketData[$count]['Ticket']['number_type'] = $val['Ticket']['number_type'];
			//print_R($ticketData);die;
			$count++;
		}
		$users = $this->Admin->find('list',array('conditions'=>array('Admin.userType'=>array('A','BM')),'fields'=>array('id','name')));
		//print_R($users);die;
		$t_cat = $this->TaskCategory->find('list',array('fields'=>array('id','name')));

		$priority = array("1"=>"Low","2"=>"Moderate","3"=>"High","4"=>"Critical");
		//$category = array("2"=>"Report Related","3"=>"TAT Related","4"=>"Payment Related","5"=>"Special Request","6"=>"Sample Collected Related");
		$this->set('priority',$priority);
		$this->set('category',$t_cat);
		$this->set('ticketlist',$ticketData);
		$this->set('users',$users);
		$status = array("1"=>"New Ticket","2"=>"In Process","3"=>"Resolved","4"=>"Closed");
		$this->set('status',$status);
		//print_R($ticketlist);die;
	}
	
	function admin_edit_ticket($ticket_id=null)
	{
		$dec_ticket_id = base64_decode($ticket_id);
		$this->Ticket = ClassRegistry::init('Ticket');
		$this->TaskCategory = ClassRegistry::init('TaskCategory');
		$this->Admin = ClassRegistry::init("Admin");
		$users = $this->Admin->find('list',array('conditions'=>array('Admin.userType'=>array('A','BM')),'fields'=>array('id','name')));
		$this->set('users',$users);
		
		$this->TicketTracking = ClassRegistry::init('TicketTracking');
		$priority = array("1"=>"Low","2"=>"Moderate","3"=>"High","4"=>"Critical");
		$this->TaskCategory = ClassRegistry::init("TaskCategory");
		$t_cat = $this->TaskCategory->find('list',array('fields'=>array('id','name')));
		
		$this->set('priority',$priority);
		$this->set('category',$t_cat);
		$ticketdata = $this->Ticket->find('first',array('conditions'=>array('Ticket.id'=>$dec_ticket_id)));
		$task_category = $this->TaskCategory->find('first',array('conditions'=>array('TaskCategory.id'=>$ticketdata['Ticket']['category'])));

		$this->Billing = ClassRegistry::init("Billing");
		$billing = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$ticketdata['Ticket']['request_id'])));
		$this->set("req_num",$billing['Billing']['order_id']);
		$tickettracking = $this->TicketTracking->find('all',array('conditions'=>array('TicketTracking.ticket_id'=>$dec_ticket_id),'order'=>array('id desc')));
		$this->set('ticket_activity',$tickettracking);
		
		$this->Timelab = ClassRegistry::init('Timelab');
		$timelabs = $this->Timelab->find('list',array('conditions'=>array('Timelab.status'=>1),'fields'=>array('Timelab.sequence','Timelab.phlebo_time'),'order'=>'Timelab.sequence'));

		$timeorder = array();
		foreach($timelabs as $key=>$val)
		{
			$time = explode('-',$val);
			array_push($timeorder,$time[0]);
		}

		$this->set('time',$timeorder);

		//print_R($tickettracking);die;
		if(!empty($this->data))
		{
			$ticket = array();
			$ticket['id'] = $ticketdata['Ticket']['id'];
			$ticket['last_edited'] = date('Y-m-d h:i:s');
			$ticket['status'] = $this->data['Ticket']['status'];
			$ticket['assigned_to'] = $this->data['Ticket']['assigned_to'];
			$ticket['complete_by_time'] =  $this->data['Ticket']['complete_by_time'];
			$ticket['complete_by_date'] =  date('Y-m-d',strtotime($this->data['Ticket']['complete_by_date']));

			$checklist = explode("@@@",$task_category['TaskCategory']['checklist']);
			$doclist = explode("@@@",$task_category['TaskCategory']['required_docs']);

			$check_list = array();

			foreach($this->data['Ticket']['check'] as $key=>$val)
			{
				array_push($check_list,$checklist[$key]."#".$val); 
			}

			$doc_list = array();
			foreach($this->data['Ticket']['doc'] as $key=>$val)
			{
				$hfile = $this->File->uploadFile($val, PATIENT_TICKET_STORE_PATH, true,array('jpg','jpe','jpeg','gif','png','JPG','JPE','JPEG','GIF','PNG','PDF','pdf'));
				$tickettrack['img_url'] = $hfile['name'];
				array_push($doc_list,$doclist[$key]."#".$hfile['name']);
			}

			$update_query = '';
			//print_R("update ticket set priority='".$this->data['Ticket']['priority']."',assigned_to='".$ticket['assigned_to']."',last_edited='".$ticket['last_edited']."',status='".$ticket['status']."',complete_by_time='".$ticket['complete_by_time']."',complete_by_date='".$ticket['complete_by_date']."',checklist='".implode('@',$check_list)."' where id='".$ticket['id']."'");die;
			$update_query = $this->Ticket->query("update ticket set priority='".$this->data['Ticket']['priority']."',assigned_to='".$ticket['assigned_to']."',last_edited='".$ticket['last_edited']."',status='".$ticket['status']."',complete_by_time='".$ticket['complete_by_time']."',complete_by_date='".$ticket['complete_by_date']."',checklist='".implode('@',$check_list)."',documents='".implode('@',$doc_list)."' where id='".$ticket['id']."'");
			if($update_query)
			{
				if(!empty($this->data['Ticket']['image_upload']['name']))
					$this->tickettracking($ticketdata,$this->data,$this->data['Ticket']['image_upload']);
				
				$docs = explode("@@@",$task_category['TaskCategory']['required_docs']);

				$this->TicketTracking->save($tickettrack);
				
				$assigned_user = $this->Admin->find('first',array('conditions'=>array('Admin.id'=>$this->data['Ticket']['assigned_to'])));
				
				$message = "Hi ".$assigned_user['Admin']['name'].", 
						Ticket No - ".$ticketdata['Ticket']['id']." has been assigned to you with priority - ".$priority[$this->data['Ticket']['priority']].". Thanks";

				$this->__sms_message($assigned_user['Admin']['phone'],$message);
				
				$this->Session->setFlash('Ticket has been Updated.','flash_success');  
				$this->redirect('/admin/ticket/index/');
			}
			else
			{
				$this->Session->setFlash('Issue in Processing the Request.','flash_failure');                            
			}
		}
		else
		{
			$task_category = $this->TaskCategory->find('first',array('conditions'=>array('TaskCategory.id'=>$ticketdata['Ticket']['category'])));

			$status = array("1"=>"New Ticket","2"=>"In Process","3"=>"Resolved","4"=>"Closed");
			$this->set('status',$status);
			$ticketdata['Ticket']['check_list'] = explode("@@@",$task_category['TaskCategory']['checklist']);
			$ticketdata['Ticket']['docs'] = explode("@@@",$task_category['TaskCategory']['required_docs']);

			$ticketData[$count]['Ticket']['request_id'] = "-";
			$ticketData[$count]['Ticket']['lab_no'] = "-";
			
			if(!empty($ticketdata['Ticket']['request_id']))
				$ticketdata['Ticket']['request_id'] = $billing['Billing']['order_id'];

			if(!empty($ticketdata['Ticket']['lab_no']))
				$ticketdata['Ticket']['lab_no'] = $ticketdata['Ticket']['lab_no'];


			$ticketdata['Ticket']['date'] = date('d-m-Y',strtotime($ticketdata['Ticket']['date']));
			$ticketdata['Ticket']['last_edited'] = date('d-m-Y',strtotime($ticketdata['Ticket']['last_edited']));
			$ticketdata['Ticket']['complete_by_date'] = date('d-m-Y',strtotime($ticketdata['Ticket']['complete_by_date']));
			$ticket['complete_by_time'] =  $this->data['Ticket']['complete_by_time'];
			$imageArray = explode(',',$ticketdata['Ticket']['upload_url']);
			$this->set('imgarray',$imageArray);
			$this->data = $ticketdata;
			$checklist = explode('@',$ticketdata['Ticket']['checklist']);
			$this->set('checks',$checklist);
			$doclist = explode('@',$ticketdata['Ticket']['documents']);
			$this->set('docs',$doclist);
			//print_R($ticketdata);die;
		}
	}

	function admin_save_ticket($ticket_id=null)
	{
		$dec_ticket_id = base64_decode($ticket_id);
		$this->Ticket = ClassRegistry::init('Ticket');
		$this->Admin = ClassRegistry::init('Admin'); 
		$this->Billing = ClassRegistry::init("Billing");
		$billing = $this->Billing->find('first',array('conditions'=>array('Billing.order_id'=>$this->data['Ticket']['request_id'])));

		$ticket = $this->Ticket->create();
		$ticket['Ticket'] = $this->data['Ticket'];
		$ticket['Ticket']['request_id'] = $billing['Billing']['request_id'];
		$ticket['Ticket']['last_edited'] = date('Y-m-d h:i:s');

		//print_R($ticket);die;
		if($this->Ticket->save($ticket))
		{
			$assigned_user = $this->Admin->find('first',array('conditions'=>array('Admin.id'=>$this->data['Ticket']['assigned_to'])));
			
			$ticketdata = $this->Ticket->find('first',array('conditions'=>array('Ticket.id'=>$dec_ticket_id)));

			$message = "Hi ".$assigned_user['Admin']['name'].", Ticket No - ".$ticketdata['Ticket']['ticket_id']." has been assigned to you with priority - ".$priority[$this->data['Ticket']['priority']].". Thanks";

			$this->__sms_message($assigned_user['Admin']['phone'],$message);
			
			$this->Session->setFlash('Ticket Successfully Updated.','flash_success');  
		}
		else
		{
			$this->Session->setFlash('Issue in Updating the Ticket.','flash_failure');                            
		}
		$this->redirect('/admin/ticket/edit_ticket/'.$ticket_id);
	}	
	
	function tickettracking($ticketdata=NULL,$submit_data=NULL,$file_data=NULL)
	{
		$this->TicketTracking = ClassRegistry::init('TicketTracking');
		
		$tickettrack = $this->TicketTracking->create();

		$tickettrack['ticket_id'] = $ticketdata['Ticket']['id'];
		$tickettrack['assigned_to'] = $submit_data['Ticket']['assigned_to'];
		$tickettrack['description'] = $submit_data['Ticket']['description'];
		$tickettrack['date'] = date('Y-m-d h:i:s');
		$tickettrack['edited_by'] = $this->Session->read('Admin.id');					
		$hfile = $this->File->uploadFile($file_data, PATIENT_TICKET_STORE_PATH, true,array('jpg','jpe','jpeg','gif','png','JPG','JPE','JPEG','GIF','PNG','PDF','pdf','csv','CSV'));
		$tickettrack['img_url'] = $hfile['name'];
		
		if($hfile['name']!='P')
		{
			$check = $this->TicketTracking->save($tickettrack);
		}
	}

	function admin_mytask()
	{
		$this->User = ClassRegistry::init("User");
		$this->Admin = ClassRegistry::init("Admin");
		$this->Billing = ClassRegistry::init("Billing");
		//print_R($users);die;
		$this->set('users',$users);
		$this->set('title_for_layout', 'View Sample Request');
		$this->set('title', '');
		$this->set('data_req_from_date', '');
		$this->set('data_req_to_date', '');
		$this->Ticket = ClassRegistry::init('Ticket');
		//$ticket = $this->Ticket->find('All',array('conditions'=>array('Health.id'=>$id)));
		$conditions = array('Ticket.assigned_to'=>$this->Session->read('Admin.id'));
		
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
		if(isset($this->params['named']['title']) && $this->params['named']['title']!='')
		{
			$this->data['Filter']['date_type'] = $this->params['named']['date_type'];
			$options['date_type'] = $this->params['named']['date_type'];
		}
		if(isset($this->params['named']['req_no']) && $this->params['named']['req_no']!='')
		{
			$this->data['Filter']['req_no'] = $this->params['named']['req_no'];
			$options['req_no'] = $this->params['named']['req_no'];
		}
		if(isset($this->params['named']['lab_no']) && $this->params['named']['lab_no']!='')
		{
			$this->data['Filter']['lab_no'] = $this->params['named']['lab_no'];
			$options['lab_no'] = $this->params['named']['lab_no'];
		}
		if(isset($this->params['named']['ticket_no']) && $this->params['named']['ticket_no']!='')
		{
			$this->data['Filter']['ticket_no'] = $this->params['named']['ticket_no'];
			$options['ticket_no'] = $this->params['named']['ticket_no'];
		}
		if(isset($this->params['named']['category']) && $this->params['named']['category']!='')
		{
			$this->data['Filter']['category'] = $this->params['named']['category'];
			$options['category'] = $this->params['named']['category'];
		}
		
		if(isset($this->params['named']['priority']) && $this->params['named']['priority']!='')
		{
			$this->data['Filter']['priority'] = $this->params['named']['priority'];
			$options['priority'] = $this->params['named']['priority'];
		}

		if(isset($this->params['named']['assigned_to']) && $this->params['named']['assigned_to']!='')
		{
			$this->data['Filter']['assigned_to'] = $this->params['named']['assigned_to'];
			$options['assigned_to'] = $this->params['named']['assigned_to'];
		}

		if(isset($this->params['named']['status']) && $this->params['named']['status']!='')
		{
			$this->data['Filter']['status'] = $this->params['named']['status'];
			$options['status'] = $this->params['named']['status'];
		}

		if(!empty($this->data))
		{
			//print_R($this->data);die;
			if(!empty($this->data['Filter']['req_from_date']))
			{
				if($this->data['Filter']['title']=="creation"){
					$conditions['Ticket.date >='] = date('Y-m-d 00:00:00',strtotime($this->data['Filter']['req_from_date']));
				}
				else
				{
					$conditions['Ticket.complete_by_date >='] = date('Y-m-d 00:00:00',strtotime($this->data['Filter']['req_from_date']));
				}
				
				$options['req_from_date'] =  date('Y-m-d',strtotime($this->data['Filter']['req_from_date']));
				$this->set('data_req_from_date',$this->data['Filter']['req_from_date']);
			}
			
			if(!empty($this->data['Filter']['req_to_date'])  && $this->data['Filter']['title']=="creation")
			{
				if($this->data['Filter']['title']=="creation"){
					$conditions['Ticket.date <='] = date('Y-m-d 23:59:59',strtotime($this->data['Filter']['req_to_date']));
				}
				else
				{
					$conditions['Ticket.complete_by_date <='] = date('Y-m-d 23:59:59',strtotime($this->data['Filter']['req_to_date']));	
				}
				$options['req_to_date'] =  date('Y-m-d',strtotime($this->data['Filter']['req_to_date']));
				$this->set('data_req_to_date',$this->data['Filter']['req_to_date']);
			}

			if(!empty($this->data['Filter']['date_type']))
			{
				$options['title'] = $this->data['Filter']['date_type'];
				$this->set('title',$this->data['Filter']['date_type']);
			}

			if(!empty($this->data['Filter']['assigned_to']))
			{
				$conditions['Ticket.assigned_to'] = $this->data['Filter']['assigned_to'];
				$options['assigned_to'] = $this->data['Filter']['assigned_to'];
				$this->set('assigned_to',$this->data['Filter']['assigned_to']);
			}

			if(!empty($this->data['Filter']['status']))
			{
				$conditions['Ticket.status'] = $this->data['Filter']['status'];
				$options['status'] = $this->data['Filter']['status'];
				$this->set('status_s',$this->data['Filter']['status']);
			}
			
			if(!empty($this->data['Filter']['req_no']))
			{
				$conditions['Ticket.request_id'] = $this->data['Filter']['req_no'];
				$options['req_no'] = $this->data['Filter']['req_no'];
				$this->set('req_no',$this->data['Filter']['req_no']);
			}

			if(!empty($this->data['Filter']['lab_no']))
			{
				$conditions['Ticket.lab_no'] = $this->data['Filter']['lab_no'];
				$options['lab_no'] = $this->data['Filter']['lab_no'];
				$this->set('lab_no',$this->data['Filter']['lab_no']);
			}

			if(!empty($this->data['Filter']['ticket_no']))
			{
				$conditions['Ticket.ticket_id'] = $this->data['Filter']['ticket_no'];
				$options['ticket_no'] = $this->data['Filter']['ticket_no'];
				$this->set('ticket_no',$this->data['Filter']['ticket_no']);
			}
			
			if(!empty($this->data['Filter']['category']))
			{
				$conditions['Ticket.category'] = $this->data['Filter']['category'];
				$options['category'] = $this->data['Filter']['category'];
				$this->set('data_category',$this->data['Filter']['category']);
			}
			
			if(!empty($this->data['Filter']['priority']))
			{
				$conditions['Ticket.priority'] = $this->data['Filter']['priority'];
				$options['priority'] = $this->data['Filter']['priority'];
				$this->set('data_priority',$this->data['Filter']['priority']);
			}
			//print_R($conditions);die;
			$this->set('options',$options);
		}

		$this->paginate = array('Ticket' => array('limit' =>'20','order'=>array('Ticket.title'=>'ASC','Ticket.date'=>'ASC'),'conditions'=>$conditions));

		$ticketlist=$this->paginate('Ticket');
		$ticketData = array();
		$count = 0;
		
		foreach($ticketlist as $val)
		{
			$billing = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$val['Ticket']['request_id'])));
			$ticketData[$count]['Ticket']['id'] = $val['Ticket']['id'];
			$ticketData[$count]['Ticket']['ticket_id'] = $val['Ticket']['ticket_id'];

			$ticketData[$count]['Ticket']['request_id'] = "-";
			$ticketData[$count]['Ticket']['lab_no'] = "-";
			if(!empty($val['Ticket']['request_id']))
				$ticketData[$count]['Ticket']['request_id'] = $billing['Billing']['order_id'];

			if(!empty($val['Ticket']['lab_no']))
				$ticketData[$count]['Ticket']['lab_no'] = $val['Ticket']['lab_no'];

			$ticketData[$count]['Ticket']['title'] = $val['Ticket']['title'];
			$ticketData[$count]['Ticket']['date'] = $val['Ticket']['date'];
			$ticketData[$count]['Ticket']['last_edited'] = $val['Ticket']['last_edited'];
			$ticketData[$count]['Ticket']['category'] = $val['Ticket']['category'];
			$find_user = $this->Admin->find('first',array('conditions'=>array('Admin.id'=>$val['Ticket']['created_by'])));
			$ticketData[$count]['Ticket']['priority'] = $val['Ticket']['priority'];
			
			$ticketData[$count]['Ticket']['assigned_to'] = $val['Ticket']['assigned_to'];

			$ticketData[$count]['Ticket']['created_by']="-";
			if(!empty($val['Ticket']['created_by']))
				$ticketData[$count]['Ticket']['created_by'] = $find_user['Admin']['name'];
			
			$ticketData[$count]['Ticket']['status'] = $val['Ticket']['status'];
			$ticketData[$count]['Ticket']['number_type'] = $val['Ticket']['number_type'];
			//print_R($ticketData);die;
			$count++;
		}

		$users = $this->Admin->find('list',array('conditions'=>array('Admin.userType'=>array('A','BM')),'fields'=>array('id','name')));
		//print_R($users);die;
		$priority = array("1"=>"Low","2"=>"Moderate","3"=>"High","4"=>"Critical");
		$this->TaskCategory = ClassRegistry::init("TaskCategory");
		$t_cat = $this->TaskCategory->find('list',array('fields'=>array('id','name')));
		$this->set('priority',$priority);
		$this->set('category',$t_cat);
		$this->set('ticketlist',$ticketData);
		$this->set('users',$users);
		$status = array("1"=>"New Ticket","2"=>"In Process","3"=>"Resolved","4"=>"Closed");
		$this->set('status',$status);
		//print_R($ticketlist);die;
	}
	
	function admin_newtask()
	{
		$priority = array("1"=>"Low","2"=>"Moderate","3"=>"High","4"=>"Critical");
		
		$this->TaskCategory = ClassRegistry::init("TaskCategory");
		$t_cat = $this->TaskCategory->find('list',array('fields'=>array('id','name')));

		$this->Timelab = ClassRegistry::init('Timelab');
		$timelabs = $this->Timelab->find('list',array('conditions'=>array('Timelab.status'=>1),'fields'=>array('Timelab.sequence','Timelab.phlebo_time'),'order'=>'Timelab.sequence'));

		$timeorder = array();
		foreach($timelabs as $key=>$val)
		{
			$time = explode('-',$val);
			array_push($timeorder,$time[0]);
		}
		$recur_type = array("daily"=>"Daily","weekly"=>"Weekly","monthly"=>"Monthly");

		$this->set('recur_type',$recur_type);
		$this->set('time',$timeorder);
		$this->set('priority',$priority);
		$this->set('category',$t_cat);
	}
	
	function admin_ticketsubmit()
	{
		$this->Ticket = ClassRegistry::init('Ticket');
		$this->TicketTracking = ClassRegistry::init('TicketTracking');
		$this->Billing = ClassRegistry::init('Billing');

		$billing_data = $this->Billing->find('first',array('conditions'=>array('Billing.order_id'=>$_POST['data']['Ticket']['request_id'])));
		print_R($_POST);
		echo "<br>";
		print_R($billing_data);
		echo "<br>";
		$ticket = array();
		$ticket['number_type'] = $_POST['data']['Ticket']['number_type'];
		$ticket['category'] = $_POST['data']['Ticket']['category'];
		$ticket['priority'] = $_POST['data']['Ticket']['priority'];
		$ticket['date'] = date('Y-m-d h:i:s');
		$ticket['last_edited'] = date('Y-m-d h:i:s');
		$ticket['title'] = $_POST['data']['Ticket']['tickettitle'];
		$ticket['description'] = $_POST['data']['Ticket']['description'];
		
		if($_POST['data']['Ticket']['number_type']=="request")
		{
			$billing_data = $this->Billing->find('first',array('conditions'=>array('Billing.order_id'=>$_POST['data']['Ticket']['request_id'])));
			$ticket['request_id'] = $billing_data['Billing']['request_id'];  
			$ticket['lab_no'] = 0;  
		}

		if($_POST['data']['Ticket']['number_type']=="lab_no")
		{
			$billing_data = $this->Health->find('first',array('conditions'=>array('health.ref_num'=>$_POST['data']['Ticket']['request_id'])));
			$ticket['request_id'] = 0;  
			$ticket['lab_no'] = $_POST['data']['Ticket']['request_id'];  
		}
		
		$ticket['email'] = $_POST['data']['Ticket']['email'];
		$ticket['phone'] = $_POST['data']['Ticket']['phone'];
		$ticket['concern_raised'] = $_POST['data']['Ticket']['concern_raised'];
		$ticket['assigned_to'] = "296";
		$ticket['created_by'] = $this->Session->read('Admin.id');
		$ticket['status'] = 1;
		$ticket['complete_by_time'] = $_POST['data']['Ticket']['complete_by_time'];
		
		//print_R($ticket);
		//die;
		$priority = array("1"=>"Low","2"=>"Moderate","3"=>"High","4"=>"Critical");
		
		if(!in_array($_POST['data']['Ticket']['type'],array('r','i')))
		{
			$ticket['ticket_id'] = "T-".strtotime(date('Y-m-d H:i:s'));
			$ticket['complete_by_date'] = date('Y-m-d',strtotime($_POST['data']['Ticket']['complete_by_date']));

			if($this->Ticket->save($ticket)){
				$last_ticket_id = $this->Ticket->getLastInsertId();
				$tickettracking['assigned_to'] = "338";
				$tickettracking['date'] = date('Y-m-d h:i:s');
				$tickettracking['ticket_id'] = $last_ticket_id;
				$tickettracking['description'] = $_POST['data']['Ticket']['description'];
				$$tickettracking['img_url'] = "";

				if(!empty($this->data['Ticket']['image_upload']))
				{
					$hfile = $this->File->uploadFile($this->data['Ticket']['image_upload'], PATIENT_TICKET_STORE_PATH, true,array('jpg','jpe','jpeg','gif','png','JPG','JPE','JPEG','GIF','PNG','PDF','pdf'));
					$tickettracking['img_url'] = $hfile['name'];
				}

				if($this->TicketTracking->save($tickettracking)){
					
					$assigned_user = $this->Admin->find('first',array('conditions'=>array('Admin.id'=>'338')));
					
					$message = "Hi ".$assigned_user['Admin']['name'].", 
							Ticket No - ".$last_ticket_id." has been assigned to you with priority - ".$priority[$_POST['data']['Ticket']['priority']].". Thanks";

					$this->__sms_message($assigned_user['Admin']['phone'],$message);
					
					$this->Session->setFlash('Ticket has been raised.','flash_success');                            
					
					$this->redirect('/admin/ticket/index/');
				}
			}
			else {
				$this->Session->setFlash('unable to raise Ticket.','flash_failure');                            
			}
		}
		else
		{
			$ticket['ticket_id'] = "TR-".strtotime(date('Y-m-d H:i:s'));
			
			if($_POST['data']['Ticket']['type']=='r')	
			{
				$ticket['from_date'] = date('Y-m-d',strtotime($_POST['data']['Ticket']['from_date']));
				$ticket['to_date'] = date('Y-m-d',strtotime($_POST['data']['Ticket']['to_date']));
				$ticket['time_bound'] = 1;
			}
			
			$ticket['recurring_type'] = ($_POST['data']['Ticket']['type']=='i') ? "Infinite" : $_POST['data']['Ticket']['recurring_type'];

			$this->TicketRecurring->save($ticket);
			$this->Session->setFlash('Recurring Task has been saved.','flash_success');                            
			$this->redirect('/admin/ticket/task_recur/');
		}
		
	}

	public function admin_task_recur()
	{
		$this->User = ClassRegistry::init("User");
		$this->Admin = ClassRegistry::init("Admin");
		$this->Billing = ClassRegistry::init("Billing");
		//print_R($users);die;
		$this->set('users',$users);
		$this->set('title_for_layout', 'View Sample Request');
		$this->set('title', '');
		$this->set('data_req_from_date', '');
		$this->set('data_req_to_date', '');
		$this->TicketRecurring = ClassRegistry::init('TicketRecurring');
		//$ticket = $this->Ticket->find('All',array('conditions'=>array('Health.id'=>$id)));
		$conditions = '';
		
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
		if(isset($this->params['named']['title']) && $this->params['named']['title']!='')
		{
			$this->data['Filter']['date_type'] = $this->params['named']['date_type'];
			$options['date_type'] = $this->params['named']['date_type'];
		}
		
		if(isset($this->params['named']['ticket_no']) && $this->params['named']['ticket_no']!='')
		{
			$this->data['Filter']['ticket_no'] = $this->params['named']['ticket_no'];
			$options['ticket_no'] = $this->params['named']['ticket_no'];
		}

		if(isset($this->params['named']['category']) && $this->params['named']['category']!='')
		{
			$this->data['Filter']['category'] = $this->params['named']['category'];
			$options['category'] = $this->params['named']['category'];
		}
		
		if(isset($this->params['named']['priority']) && $this->params['named']['priority']!='')
		{
			$this->data['Filter']['priority'] = $this->params['named']['priority'];
			$options['priority'] = $this->params['named']['priority'];
		}

		if(!empty($this->data))
		{
			//print_R($this->data);die;
			if(!empty($this->data['Filter']['req_from_date']))
			{
				if($this->data['Filter']['title']=="creation"){
					$conditions['Ticket.date >='] = date('Y-m-d 00:00:00',strtotime($this->data['Filter']['req_from_date']));
				}
				else
				{
					$conditions['Ticket.complete_by_date >='] = date('Y-m-d 00:00:00',strtotime($this->data['Filter']['req_from_date']));
				}
				
				$options['req_from_date'] =  date('Y-m-d',strtotime($this->data['Filter']['req_from_date']));
				$this->set('data_req_from_date',$this->data['Filter']['req_from_date']);
			}
			
			if(!empty($this->data['Filter']['req_to_date'])  && $this->data['Filter']['title']=="creation")
			{
				if($this->data['Filter']['title']=="creation"){
					$conditions['Ticket.date <='] = date('Y-m-d 23:59:59',strtotime($this->data['Filter']['req_to_date']));
				}
				else
				{
					$conditions['Ticket.complete_by_date <='] = date('Y-m-d 23:59:59',strtotime($this->data['Filter']['req_to_date']));	
				}
				$options['req_to_date'] =  date('Y-m-d',strtotime($this->data['Filter']['req_to_date']));
				$this->set('data_req_to_date',$this->data['Filter']['req_to_date']);
			}

			if(!empty($this->data['Filter']['date_type']))
			{
				$options['title'] = $this->data['Filter']['date_type'];
				$this->set('title',$this->data['Filter']['date_type']);
			}

			if(!empty($this->data['Filter']['ticket_no']))
			{
				$conditions['Ticket.ticket_id LIKE'] = $this->data['Filter']['ticket_no'];
				$options['ticket_no'] = $this->data['Filter']['ticket_no'];
				$this->set('ticket_no',$this->data['Filter']['ticket_no']);
			}
			
			if(!empty($this->data['Filter']['category']))
			{
				$conditions['Ticket.category'] = $this->data['Filter']['category'];
				$options['category'] = $this->data['Filter']['category'];
				$this->set('data_category',$this->data['Filter']['category']);
			}
			
			if(!empty($this->data['Filter']['priority']))
			{
				$conditions['Ticket.priority'] = $this->data['Filter']['priority'];
				$options['priority'] = $this->data['Filter']['priority'];
				$this->set('data_priority',$this->data['Filter']['priority']);
			}
			//print_R($conditions);die;
			$this->set('options',$options);
		}

		$this->paginate = array('TicketRecurring' => array('limit' =>'20','order'=>array('TicketRecurring.id'=>'DESC'),'conditions'=>$conditions));

		$ticketlist=$this->paginate('TicketRecurring');
		$ticketData = array();
		$count = 0;
		
		foreach($ticketlist as $val)
		{
			$ticketData[$count]['TicketRecurring']['id'] = $val['TicketRecurring']['id'];
			$ticketData[$count]['TicketRecurring']['ticket_id'] = $val['TicketRecurring']['ticket_id'];
			$ticketData[$count]['TicketRecurring']['title'] = $val['TicketRecurring']['title'];
			$ticketData[$count]['TicketRecurring']['from_date'] = $val['TicketRecurring']['from_date'];
			$ticketData[$count]['TicketRecurring']['to_date'] = $val['TicketRecurring']['to_date'];
			$ticketData[$count]['TicketRecurring']['last_edited'] = $val['TicketRecurring']['last_edited'];
			$ticketData[$count]['TicketRecurring']['category'] = $val['TicketRecurring']['category'];
			$find_user = $this->Admin->find('first',array('conditions'=>array('Admin.id'=>$val['TicketRecurring']['created_by'])));
			//print_R($find_user);die;
			$ticketData[$count]['TicketRecurring']['priority'] = $val['TicketRecurring']['priority'];
			$ticketData[$count]['TicketRecurring']['concern_raised'] = $val['TicketRecurring']['concern_raised'];
			$ticketData[$count]['TicketRecurring']['created_by'] = $find_user['Admin']['name'];
			$ticketData[$count]['TicketRecurring']['recurring_type'] = $val['TicketRecurring']['recurring_type'];
			$count++;
		}
		$users = $this->Admin->find('list',array('conditions'=>array('Admin.userType'=>array('A','BM')),'fields'=>array('id','name')));
		//print_R($ticketData);die;
		$priority = array("1"=>"Low","2"=>"Moderate","3"=>"High","4"=>"Critical");
		$this->TaskCategory = ClassRegistry::init("TaskCategory");
		$t_cat = $this->TaskCategory->find('list',array('fields'=>array('id','name')));
		$recur_type = array("daily"=>"Daily","weekly"=>"Weekly","monthly"=>"Monthly","Infinite"=>'Infinite');

		$this->set('recur_type',$recur_type);
		$this->set('priority',$priority);
		$this->set('category',$t_cat);
		$this->set('ticketlist',$ticketData);
		$this->set('users',$users);
		$status = array("1"=>"New Ticket","2"=>"In Process","3"=>"Resolved","4"=>"Closed");
		$this->set('status',$status);
	}

	function admin_edit_task_recur($ticket_id=null)
	{
		$dec_ticket_id = base64_decode($ticket_id);
		//print_R($dec_ticket_id);die;
		$this->TicketRecurring = ClassRegistry::init('TicketRecurring');
		$this->Admin = ClassRegistry::init("Admin");
		$users = $this->Admin->find('list',array('conditions'=>array('Admin.userType'=>array('A','BM')),'fields'=>array('id','name')));
		$this->set('users',$users);
		
		$this->TicketTracking = ClassRegistry::init('TicketTracking');
		$priority = array("1"=>"Low","2"=>"Moderate","3"=>"High","4"=>"Critical");
		$this->TaskCategory = ClassRegistry::init("TaskCategory");
		$t_cat = $this->TaskCategory->find('list',array('fields'=>array('id','name')));
		$recur_type = array("daily"=>"Daily","weekly"=>"Weekly","monthly"=>"Monthly");

		$this->set('recur_type',$recur_type);
		$this->set('priority',$priority);
		$this->set('category',$t_cat);
		$ticketdata = $this->TicketRecurring->find('first',array('conditions'=>array('TicketRecurring.id'=>$dec_ticket_id)));
		$this->Billing = ClassRegistry::init("Billing");
		
		$this->set("req_num",$billing['Billing']['order_id']);
		$tickettracking = $this->TicketTracking->find('all',array('conditions'=>array('TicketTracking.ticket_id'=>$dec_ticket_id)));
		$this->set('ticket_activity',$tickettracking);

		$this->Timelab = ClassRegistry::init('Timelab');
		$timelabs = $this->Timelab->find('list',array('conditions'=>array('Timelab.status'=>1),'fields'=>array('Timelab.sequence','Timelab.phlebo_time'),'order'=>'Timelab.sequence'));

		$timeorder = array();
		foreach($timelabs as $key=>$val)
		{
			$time = explode('-',$val);
			array_push($timeorder,$time[0]);
		}

		$this->set('time',$timeorder);

		if(!empty($this->data))
		{
			$ticketdata['TicketRecurring']['id'] = $ticketdata['TicketRecurring']['id'];
			$ticketdata['TicketRecurring']['last_edited'] = date('Y-m-d h:i:s');
			$ticketdata['TicketRecurring']['from_date'] = date('Y-m-d',strtotime($this->data['TicketRecurring']['from_date']));
			$ticketdata['TicketRecurring']['to_date'] = date('Y-m-d',strtotime($this->data['TicketRecurring']['to_date']));
			$ticketdata['TicketRecurring']['description'] = $this->data['TicketRecurring']['description'];
			$ticketdata['TicketRecurring']['complete_by_date'] =  date('Y-m-d',strtotime($this->data['TicketRecurring']['complete_by']));
			//print_R($ticketdata);die;
			if($this->TicketRecurring->save($ticketdata))
			{
				$this->Session->setFlash('Recurring Task has been Updated.','flash_success');  
				$this->redirect('/admin/ticket/task_recur/');
			}
			else
			{
				$this->Session->setFlash('Changes Cannot be Saved.','flash_failure');  
			}					
		}
		else
		{
			$ticketdata['TicketRecurring']['from_date'] = date('d-m-Y',strtotime($ticketdata['TicketRecurring']['from_date']));
			$ticketdata['TicketRecurring']['to_date'] = date('d-m-Y',strtotime($ticketdata['TicketRecurring']['to_date']));
			$ticketdata['TicketRecurring']['last_edited'] = date('d-m-Y',strtotime($ticketdata['TicketRecurring']['last_edited']));
			$ticketdata['TicketRecurring']['complete_by_date'] = date('d-m-Y',strtotime($ticketdata['TicketRecurring']['complete_by_date']));
			
			$imageArray = explode(',',$ticketdata['TicketRecurring']['upload_url']);
			$this->set('imgarray',$imageArray);

			$this->data = $ticketdata;
		}
	}

	function admin_save_task_recur($ticket_id=null)
	{
		$dec_ticket_id = base64_decode($ticket_id);

		$this->TicketRecurring = ClassRegistry::init('TicketRecurring');
		$this->Admin = ClassRegistry::init("Admin");
		$users = $this->Admin->find('list',array('conditions'=>array('Admin.userType'=>array('A','BM')),'fields'=>array('id','name')));
		$this->set('users',$users);
		
		$ticketdata = $this->TicketRecurring->create();
		$ticketdata = $this->data;
		$ticketdata['TicketRecurring']['last_edited'] = date('Y-m-d h:i:s');
		$ticketdata['TicketRecurring']['from_date'] = date('Y-m-d',strtotime($this->data['TicketRecurring']['from_date']));
		$ticketdata['TicketRecurring']['to_date'] = date('Y-m-d',strtotime($this->data['TicketRecurring']['to_date']));
		$ticketdata['TicketRecurring']['complete_by_date'] = date('Y-m-d',strtotime($this->data['TicketRecurring']['complete_by_date']));
		//print_R($ticketdata);die;
		if($this->TicketRecurring->save($ticketdata))
		{
			$this->Session->setFlash('Recurring Task has been Updated.','flash_success');  
		}
		else
		{
			$this->Session->setFlash('Changes Cannot be Saved.','flash_failure');  
		}					
		$this->redirect('/admin/ticket/edit_task_recur/'.$ticket_id);
	}

	function admin_task_category()
	{
		$this->TaskCategory = ClassRegistry::init('TaskCategory');
		$this->paginate = array('TaskCategory' => array('limit' =>'20','order'=>array('TaskCategory.id'=>'DESC'),'conditions'=>$conditions));

		$task_cat=$this->paginate('TaskCategory');
		$this->set('task_cat',$task_cat);
	}

	function admin_add_task_category()
	{
		$this->TaskCategory = ClassRegistry::init('TaskCategory');

		$p_category = $this->TaskCategory->find('list',array('conditions'=>array('TaskCategory.parent_id'=>0),'fields'=>array('id','name')));
		$this->set('p_cat',$p_category);
		
		if($this->data)
		{
			$category = $this->TaskCategory->create();
			$category = $this->data;

			if($this->data['TaskCategory']['checklist']==1)
			{
				$category['TaskCategory']['checklist'] = implode('@@@',$_POST['check']['list']);
			}
			else
			{
				$category['TaskCategory']['checklist'] = "";
			}

			if($this->data['TaskCategory']['required_docs']==1)
			{
				$category['TaskCategory']['required_docs'] = implode('@@@',$_POST['doc']['list']);
			}
			else
			{
				$category['TaskCategory']['required_docs'] = "";
			}

			if($this->TaskCategory->save($category))
			{
				$this->Session->setFlash('Task Category Successfully Saved.','flash_success');                            
				$this->redirect('/admin/ticket/task_category/');
			}
			else
			{
				$this->Session->setFlash('Error Occured while Saving the Data.','flash_failure');                            
			}
		}
	}

	function admin_edit_task_category($id=NULL)
	{
		$this->TaskCategory = ClassRegistry::init('TaskCategory');
		if($this->data)
		{
			$category = $this->data;

			$category['TaskCategory']['id'] = base64_decode($id);

			if($this->data['TaskCategory']['checklist']==1 || !empty($this->data['TaskCategory']['checklist']))
			{
				$category['TaskCategory']['checklist'] = implode('@@@',$_POST['check']['list']);
			}
			else
			{
				$category['TaskCategory']['checklist'] = "";
			}

			if($this->data['TaskCategory']['required_docs']==1 || !empty($this->data['TaskCategory']['required_docs']))
			{
				$category['TaskCategory']['required_docs'] = implode('@@@',$_POST['doc']['list']);
			}
			else
			{
				$category['TaskCategory']['required_docs'] = "";
			}
			//print_R($category);die;
			if($this->TaskCategory->save($category))
			{
				$this->Session->setFlash('Task Category Successfully Saved.','flash_success');                            
				$this->redirect('/admin/ticket/task_category/');
			}
			else
			{
				$this->Session->setFlash('Error Occured while Saving the Data.','flash_failure');                            
			}
		}
		$taskcategory = $this->TaskCategory->find('first',array('conditions'=>array('TaskCategory.id'=>base64_decode($id))));
		$this->data = $taskcategory;
		$p_category = $this->TaskCategory->find('list',array('conditions'=>array('TaskCategory.parent_id'=>0),'fields'=>array('id','name')));
		$this->set('p_cat',$p_category);
	}

	function get_category_detail()
	{
		$this->TaskCategory = ClassRegistry::init('TaskCategory');
		$taskcategory = $this->TaskCategory->find('first',array('conditions'=>array('TaskCategory.id'=>$_REQUEST['cat'])));
		print_R(json_encode($taskcategory['TaskCategory']));die;
	}

	function cross_check()
	{
		$this->Health = ClassRegistry::init('Health');
		$this->Billing = ClassRegistry::init('Billing');

		$response=array();

		if($_REQUEST['type']=='request')
		{
			$response['type'] = "Request Number";
			$billing_detail = $this->Billing->find('first',array('conditions'=>array('Billing.order_id'=>$_REQUEST['value'])));
			if(!empty($billing_detail))
				$response['message'] = "success";
			else
				$response['message'] = "failure";
		}

		if($_REQUEST['type']=='lab_no')
		{
			$response['type'] = "Lab Number";
			$health_detail = $this->Health->find('first',array('conditions'=>array('Health.ref_num'=>$_REQUEST['value'])));
			if(!empty($health_detail))
				$response['message'] = "success";
			else
				$response['message'] = "failure";
		}	
		print_R(json_encode($response));die;
	}	
}
