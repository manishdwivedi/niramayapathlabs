<?php
class TestsController extends AppController
{
	var $name = "Tests";
	var $breadcrumb = array();
	var $uses=array('PrescriptionMaster','ActivityLog','LabMessageMaster','Tests','TestDetails','RequestTest','PincodeMaster','PackageType','Page','Pagelocale','Locale','Test','City','Sample','Time','AgeGroup','Timelab','Gender','Banner','User','Disease','Speciality','Symptoms','Health','Billing','State','City','Package','Lab','Discount','UserBmiBp','RequestTest','Paytrack','VoucherMaster','VoucherTransaction','RelationMaster');
	var $helpers = array('Form','Html','Javascript', 'Ajax');
	public $paginate = array('maxLimit' => 10);
	public $components = array('Email');	
	
	function admin_user_data()
	{
		//print_R("hello");die;
		$this->User = ClassRegistry::init("User");
		$this->Health = ClassRegistry::init("Health");
		$this->Billing = ClassRegistry::init("Billing");
		
		$contact = '8010962162';
		$first_users = $this->User->find('first',array('conditions'=>array('contact'=>$contact)));
		print_R($first_users);
		
		echo "<br><br>";
		$total_users = $this->User->find('all',array('conditions'=>array('contact'=>$contact)));
		foreach($total_users as $val)
		{
			$user = $this->Health->query("update healths set user_id='".$first_users['User']['id']."' where user_id='".$val['User']['id']."'");
			$billing = $this->Billing->query("update billings set user_id='".$first_users['User']['id']."' where user_id='".$val['User']['id']."'");
			print_R($val['User']['id']);echo "<br>";
			print_R($user);echo "<br>";
			print_R($billing);echo "<br>";
			echo "<br>";echo "<br>";
		}
		
		$this->User->query("delete from users where user_id!='".$first_users['User']['id']."' and contact='".$contact."'");
		print_R("delete from users where id!='".$first_users['User']['id']."' and contact='".$contact."'");
		die;
		$this->render(false);
		exit;
	}

	function email_test()
	{
		$to = 'tripathi.ashish2007@gmail.com';
		$subject = 'Home Collection';
		$message="Hi this is home collection request.";
		$from='puneet.agrawal88@gmail.com';
		$headers = "From: $from"."\r\n";
		$headers .= 'Content-type: text/html;';
		mail($to, $subject, $message, $headers);
		exit;
	}
	
	public function searchobservation()
	{
		$this->layout="";
		$this->Observation = ClassRegistry::init('Observation');
		$observations = $this->Observation->query("Select * from observations where observation_name Like '%".$_POST['search']."%' and sample_type in (".$_POST['sample'].") and active=1");
		//print_R("Select * from observations where observation_name Like '%".$_POST['search']."%' and sample_type='".$_POST['sample']."'");die;
		$content="";
		foreach($observations as $val)
		{
			$content .= "<option value='".$val['observations']['observation_id']."'>".$val['observations']['observation_name']."</option>";
		}
		print_R($content);
		$this->render(false);
	}
	
	public function searchtescode()
	{
		$this->layout="";
		$this->Test = ClassRegistry::init('Test');
		$tests = $this->Test->query("Select count(testcode) as count from tests where testcode Like '".$_POST['search']."'");
		print_R($tests[0][0]['count']);
		$this->render(false);
	}
	
	public function searchtesparameter()
	{
		$this->layout="";
		$this->Test = ClassRegistry::init('Test');
		$tests = $this->Test->query("Select count(test_parameter) as count from tests where test_parameter Like '".$_POST['search']."'");
		print_R($tests[0][0]['count']);
		$this->render(false);
	}
	
	public function getobservation()
	{
		$this->layout="";
		$this->Observation = ClassRegistry::init('Observation');
		
		$observations = $this->Observation->query("Select * from observations where observation_id in (".$_POST['id'].")");
		$count = 0;
		foreach($observations as $val)
		{
			$count++;
			$content .= "<div id='observation".$val['observations']['observation_id']."'>".$val['observations']['observation_name']."<a href='javascript:void(0);' onclick='delete_obs(".$val['observations']['observation_id'].")' style='font-weight:bold; color:#FF0000; text-decoration:none;'>[X]</a></div>";
		}
		print_R($content);
		$this->render(false);
	}
	
	public function getsamplename()
	{
		$this->layout="";
		$this->Sample = ClassRegistry::init('Sample');
		
		$sample = $this->Sample->query("Select * from sample_type_master where sample_id in (".$_POST['id'].")");
		$count = 0;
		foreach($sample as $val)
		{
			$count++;
			$content .= "<div id='test".$val['sample_type_master']['sample_id']."'>".$val['sample_type_master']['type']."<a href='javascript:void(0);' onclick='delete_sample(".$val['sample_type_master']['sample_id'].")' style='font-weight:bold; color:#FF0000; text-decoration:none;'>[X]</a></div>";
		}
		print_R($content);
		$this->render(false);
	}
	
	function profile()
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','profile');
		// to not show test records which has been already added to cart
		if(count($this->Session->read('session_test_type'))>0)
		{
			foreach($this->Session->read('session_test_type') as $type)
			{
				$exist_test_id[]= $type['test_id'];
			}
			$check_id = implode(",",$exist_test_id);
			
			//$this->paginate = array('Test' => array('limit' =>'10','order'=>array('Test.add_date'=>'DESC'),'conditions'=>array('Test.type'=>'PROFILE', 'Test.id NOT IN ('.$check_id.')')));
			
			$this->paginate = array('Test' => array('limit' =>'12','order'=>array('Test.sequence'=>'ASC'),'conditions'=>array('Test.type'=>'PROFILE', 'Test.id NOT IN ('.$check_id.')')));
			
		}else
		{
		//$this->paginate = array('Test' => array('limit' =>'10','order'=>array('Test.add_date'=>'DESC'),'conditions'=>array('Test.type'=>'PROFILE')));
		
			$this->paginate = array('Test' => array('limit' =>'12','order'=>array('Test.sequence'=>'ASC'),'conditions'=>array('Test.type'=>'PROFILE')));
		}
		//$this->paginate = array('Test' => array('limit' =>'10','order'=>array('Test.add_date'=>'DESC'),'conditions'=>array('Test.type'=>'PROFILE')));
		$testlisting=$this->paginate('Test');
		$this->set('testlisting',$testlisting);
		$this->Sample=ClassRegistry::init('Sample');
		
			if(!empty($this->data))
			{
				if($this->Sample->create($this->data))
				{
					
				//echo "<pre>"; print_r($this->data); exit;
				if($this->Sample->save($this->data,false))
				{
					
					$someOneArray = array();
					$someOneArray['Sample']['id'] = $this->data['Sample']['id'];
					$someOneArray['Sample']['name'] = $this->data['Sample']['name'];
					$someOneArray['Sample']['email'] = $this->data['Sample']['email'];
					$someOneArray['Sample']['mobile'] = $this->data['Sample']['mobile'];
					$someOneArray['Sample']['landline'] = $this->data['Sample']['landline'];
					$someOneArray['Sample']['city_id'] = $this->data['Sample']['city_id'];
					$someOneArray['Sample']['test_id'] = $this->data['Sample']['test_id'];
					$someOneArray['Sample']['sample_date'] = $this->data['Sample']['sample_date'];
					$someOneArray['Sample']['address'] = $this->data['Sample']['address'];
				
			    	$this->set('mailContent' , $someOneArray );
					$this->Email->template = 'home_collection';
					$this->Email->from = $this->data['Sample']['email'];
					$this->Email->fromName = 'Puneet Itcombine';
					$this->Email->subject = 'Home Collection';
					$this->Email->to = 'info@lotusfacilities.com,tripathi.ashish2007@gmail.com';
					$this->Email->sendAs = 'html'; // because we like to send pretty mail
					$this->Email->delivery = 'mail';
					if($this->Email->send())
					{
						
					}
	      		}
				
				}
			}
			$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));
			$tests = $this->Test->find('all',array('conditions'=>array('Test.status'=>1)));
			$this->set('city',$city);
			$this->set('tests',$tests);
			$this->data['Sample']['add_date'] = date('Y-m-d H:i:s');
			$this->data['Sample']['edit_date'] = '0000-00-00 00:00:00';
			$this->data['Sample']['status'] = 1;
			$this->data['Sample']['sample_date'] = date('Y-m-d',strtotime($this->data['Sample']['sample_date']));
			$time = $this->Time->find('all',array('conditions'=>array('Time.status'=>1)));
			$this->set('time',$time);
	}
	
	
	function individual_tests()
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','Cancer Screening Tests, Infection, Diabetes, Blood & Urine Tests at Home');
		$this->set('page_description','Book now your health test like Cancer Screening Test, Allergy Screening Tests, Infection Screening Test, Blood & Urine Tests at Home. Use NABL 20 to get discounted offers with certified Labs.');
		$this->set('page_keyword','Cancer Screening Test, Allergy Screening Tests, Infection Screening Test, Blood & Urine Tests, NABL Lab, individual tests');
		// to not show test records which has been already added to cart
		if(count($this->Session->read('session_test_type'))>0)
		{
			foreach($this->Session->read('session_test_type') as $type)
			{
				$exist_test_id[]= $type['test_id'];
			}
			$check_id = implode(",",$exist_test_id);
			//$this->paginate = array('Test' => array('limit' =>'10','order'=>array('Test.add_date'=>'DESC'),'conditions'=>array('Test.status'=>1,'Test.type'=>'TEST', 'Test.id NOT IN ('.$check_id.')')));
			
			$this->paginate = array('Test' => array('limit' =>'10','order'=>array('Test.sequence'=>'ASC'),'conditions'=>array('Test.status'=>1,'Test.type'=>'TEST', 'Test.id NOT IN ('.$check_id.')')));
			
			
		}else
		{
	//	$this->paginate = array('Test' => array('limit' =>'10','order'=>array('Test.add_date'=>'DESC'),'conditions'=>array('Test.status'=>1,'Test.type'=>'TEST')));
		
		$this->paginate = array('Test' => array('limit' =>'10','order'=>array('Test.sequence'=>'ASC'),'conditions'=>array('Test.status'=>1,'Test.type'=>'TEST')));
		}
		$testlisting=$this->paginate('Test');
		$this->set('testlisting',$testlisting);
		$this->Sample=ClassRegistry::init('Sample');
		
			if(!empty($this->data))
			{
				if($this->Sample->create($this->data))
				{
					
				//echo "<pre>"; print_r($this->data); exit;
				if($this->Sample->save($this->data,false))
				{
					
					$someOneArray = array();
					$someOneArray['Sample']['id'] = $this->data['Sample']['id'];
					$someOneArray['Sample']['name'] = $this->data['Sample']['name'];
					$someOneArray['Sample']['email'] = $this->data['Sample']['email'];
					$someOneArray['Sample']['mobile'] = $this->data['Sample']['mobile'];
					$someOneArray['Sample']['landline'] = $this->data['Sample']['landline'];
					$someOneArray['Sample']['city_id'] = $this->data['Sample']['city_id'];
					$someOneArray['Sample']['test_id'] = $this->data['Sample']['test_id'];
					$someOneArray['Sample']['sample_date'] = $this->data['Sample']['sample_date'];
					$someOneArray['Sample']['address'] = $this->data['Sample']['address'];
					
					$this->set('mailContent' , $someOneArray );
					$this->Email->template = 'home_collection';
					$this->Email->from = $this->data['Sample']['email'];
					$this->Email->fromName = $this->data['Sample']['name'];
					$this->Email->subject = 'Home Collection';
					//$this->Email->to = $this->data['Sample']['email'];
					$this->Email->to = 'info@lotusfacilities.com,tripathi.ashish2007@gmail.com';
					//Send as 'html', 'text' or 'both' (default is 'text')
					$this->Email->sendAs = 'html'; // because we like to send pretty mail
					$this->Email->delivery = 'mail';
					if($this->Email->send())
					{
						echo //"hiiiiiiiiiiiiiii"; exit;
						//$this->Session->setFlash('Sample request saved successfully.','flash_success');
						$this->redirect(array('controller'=>'tests','action'=>'individual_tests'));
					}
	      		}
				
				}
			}
			$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));
		$tests = $this->Test->find('all',array('conditions'=>array('Test.status'=>1)));
		$this->set('city',$city);
		$this->set('tests',$tests);
		$this->data['Sample']['add_date'] = date('Y-m-d H:i:s');
		$this->data['Sample']['edit_date'] = '0000-00-00 00:00:00';
		$this->data['Sample']['status'] = 1;
		$this->data['Sample']['sample_date'] = date('Y-m-d',strtotime($this->data['Sample']['sample_date']));
		$time = $this->Time->find('all',array('conditions'=>array('Time.status'=>1)));
		$this->set('time',$time);
			
			
	}
	function services()
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','Patientcare Services');
		// to not show test records which has been already added to cart
		if(count($this->Session->read('session_test_type'))>0)
		{
			foreach($this->Session->read('session_test_type') as $type)
			{
				$exist_test_id[]= $type['test_id'];
			}
			$check_id = implode(",",$exist_test_id);

			$this->paginate = array('Test' => array('limit' =>'10','order'=>array('Test.add_date'=>'DESC'),'conditions'=>array('Test.type'=>'SERVICE', 'Test.id NOT IN ('.$check_id.')')));
		}else
		{

		$this->paginate = array('Test' => array('limit' =>'10','order'=>array('Test.add_date'=>'DESC'),'conditions'=>array('Test.type'=>'SERVICE')));
		}
		//$this->paginate = array('Test' => array('limit' =>'10','order'=>array('Test.add_date'=>'DESC'),'conditions'=>array('Test.type'=>'SERVICE')));
		$testlisting=$this->paginate('Test');
		$this->set('testlisting',$testlisting);
	}
	function book_for_self()
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','Niramayahealth Care | Book Test(s)/Profile(s)');
		$this->Health=ClassRegistry::init('Health');
		if(!empty($this->data['Health']))
		{
			$this->data['Health']['status'] = 1;
			/*online request set lab id 3*/
			$this->data['Health']['created_by'] = 3;
			
			$session_tests = $this->Session->read('test_ids_array_book');
			$session_profiles = $this->Session->read('profile_ids_array_book');
			$session_offers = $this->Session->read('offer_ids_array_book');
			$session_packages = $this->Session->read('package_ids_array_book');
			$session_services = $this->Session->read('service_ids_array_book');
			
			if(!empty($session_tests))
			{
				$implode_test = implode(',',$session_tests);
				$this->data['Health']['test_id'] = $implode_test;
			}
			if(!empty($session_profiles))
			{
				$implode_profile = implode(',',$session_profiles);
				$this->data['Health']['profile_id'] = $implode_profile;
			}
			if(!empty($session_offers))
			{
				$implode_offer = implode(',',$session_offers);
				$this->data['Health']['offer_id'] = $implode_offer;
			}
			if(!empty($session_packages))
			{
				$implode_package = implode(',',$session_packages);
				$this->data['Health']['package_id'] = $implode_package;
			}
			if(!empty($session_services))
			{
				$implode_service = implode(',',$session_services);
				$this->data['Health']['service_id'] = $implode_service;
			}
			
			if($this->Health->create($this->data))
			{
				//$this->data['Health']['landline'] = '';
				$this->data['Health']['agent_id'] = 0;
				$this->data['Health']['pay_status'] = 0;
				$this->data['Health']['print_status'] = 0;
				$this->data['Health']['trf_status'] = 0;
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
				$UserDetail = $this->Session->read('UserDetail');
				$UserId = $UserDetail['User']['id'];
				if($this->data['Health']['city'] != '')
				{
					$this->data['Health']['city_id'] = 0;
					$this->data['Health']['assigned_lab'] = $this->data['Health']['city'];
					$this->data['Health']['address'] = '';
					$this->data['Health']['locality'] = '';
					$this->data['Health']['city_id'] = 0;
					$this->data['Health']['state'] = 0;
					$this->data['Health']['pincode'] = '';
					$this->data['Health']['landmark'] = '';
					$u_det = $this->User->find('first',array('conditions'=>array('User.id'=>$UserId)));
					$this->data['Health']['visit_pat_city'] = $u_det['User']['city'];
					$this->data['Health']['s_date'] = date('Y-m-d',strtotime($this->data['Health']['sample_date']));
					$this->data['Health']['requ_status'] = 1;
					$this->data['Health']['requ_type'] = 'visit_lab';
				}
				if(!empty($this->data['Health']['sample_time1']) && !empty($this->data['Health']['sample_date1']))
				{
					$this->data['Health']['assigned_lab'] = 'Home';
					if(!empty($this->data['Health']['address1']) && empty($this->data['Health']['address2']))
					{
						$this->data['Health']['address'] = $this->data['Health']['address1'];
					}
					if(!empty($this->data['Health']['address1']) && !empty($this->data['Health']['address2']))
					{
						$this->data['Health']['address'] = $this->data['Health']['address1'].'*'.$this->data['Health']['address2'];;
					}
					$this->data['Health']['locality'] = $this->data['Health']['locality'];
					$this->data['Health']['city_id'] = $this->data['Health']['city_id'];
					$this->data['Health']['state'] = $this->data['Health']['state'];
					$this->data['Health']['pincode'] = $this->data['Health']['pincode'];
					$this->data['Health']['landmark'] = $this->data['Health']['landmark'];
					$this->data['Health']['visit_pat_city'] = $this->data['Health']['city_id'];
                    if(isset($this->data['Health']['sample_date1']) && !empty($this->data['Health']['sample_date1']))
                        $this->data['Health']['s_date'] = date('Y-m-d',strtotime($this->data['Health']['sample_date1']));
                    else
                        $this->data['Health']['s_date'] = date('Y-m-d');
					$this->data['Health']['requ_status'] = 2;
					$this->data['Health']['requ_type'] = 'home_collection';
				}
				
				if($this->Health->save($this->data))
				{
					$last_insert_id = $this->Health->getLastInsertId();
					$find_req_details = $this->Health->find('first',array('conditions'=>array('Health.id'=>$last_insert_id)));
					$explode_test_ids_db = explode(',',$find_req_details['Health']['test_id']);
					if(!empty($explode_test_ids_db))
					{
						foreach($explode_test_ids_db as $k_test_db => $v_test_db)
						{
							$find_test_mrp = $this->Test->find('first',array('conditions'=>array('Test.id'=>$v_test_db)));
							$this->data['RequestTest']['type'] = 'TE';
							$this->data['RequestTest']['health_id'] = $last_insert_id;
							$this->data['RequestTest']['test_id'] = $v_test_db; 
							$this->data['RequestTest']['mrp'] =$find_test_mrp['Test']['mrp'];
							$this->data['RequestTest']['test_book_date'] =$find_req_details['Health']['book_date'];
							$this->data['RequestTest']['status'] =1;
							
							if($this->RequestTest->create($this->data))
							{
								$this->RequestTest->save($this->data);
							}
						}
					}
					$explode_profile_ids_db = explode(',',$find_req_details['Health']['profile_id']);
					if(!empty($explode_profile_ids_db))
					{
						foreach($explode_profile_ids_db as $k_profile_db => $v_profile_db)
						{
							$find_profile_mrp = $this->Test->find('first',array('conditions'=>array('Test.id'=>$v_profile_db)));
							$this->data['RequestTest']['type'] = 'PR';
							$this->data['RequestTest']['health_id'] = $last_insert_id;
							$this->data['RequestTest']['test_id'] = $v_profile_db; 
							$this->data['RequestTest']['mrp'] =$find_profile_mrp['Test']['mrp'];
							$this->data['RequestTest']['test_book_date'] =$find_req_details['Health']['book_date'];
							$this->data['RequestTest']['status'] =1;
							
							if($this->RequestTest->create($this->data))
							{
								$this->RequestTest->save($this->data);
							}
						}
					}
					$explode_offer_ids_db = explode(',',$find_req_details['Health']['offer_id']);
					if(!empty($explode_offer_ids_db))
					{
						foreach($explode_offer_ids_db as $k_offer_db => $v_offer_db)
						{
							$find_offer_mrp = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$v_offer_db)));
							$this->data['RequestTest']['type'] = 'OF';
							$this->data['RequestTest']['health_id'] = $last_insert_id;
							$this->data['RequestTest']['test_id'] = $v_offer_db; 
							$this->data['RequestTest']['mrp'] =$find_offer_mrp['Banner']['banner_mrp'];
							$this->data['RequestTest']['test_book_date'] =$find_req_details['Health']['book_date'];
							$this->data['RequestTest']['status'] =1;
							
							if($this->RequestTest->create($this->data))
							{
								$this->RequestTest->save($this->data);
							}
						}
					}
					$explode_package_ids_db = explode(',',$find_req_details['Health']['package_id']);
					if(!empty($explode_package_ids_db))
					{
						foreach($explode_package_ids_db as $k_package_db => $v_package_db)
						{
							$find_package_mrp = $this->Package->find('first',array('conditions'=>array('Package.id'=>$v_package_db)));
							$this->data['RequestTest']['type'] = 'PA';
							$this->data['RequestTest']['health_id'] = $last_insert_id;
							$this->data['RequestTest']['test_id'] = $v_package_db; 
							$this->data['RequestTest']['mrp'] =$find_package_mrp['Package']['package_mrp'];
							$this->data['RequestTest']['test_book_date'] =$find_req_details['Health']['book_date'];
							$this->data['RequestTest']['status'] =1;
							
							if($this->RequestTest->create($this->data))
							{
								$this->RequestTest->save($this->data);
							}
						}
					}
					$explode_service_ids_db = explode(',',$find_req_details['Health']['service_id']);
					if(!empty($explode_service_ids_db))
					{
						foreach($explode_service_ids_db as $k_service_db => $v_service_db)
						{
							$find_service_mrp = $this->Test->find('first',array('conditions'=>array('Test.id'=>$v_service_db)));
							$this->data['RequestTest']['type'] = 'SR';
							$this->data['RequestTest']['health_id'] = $last_insert_id;
							$this->data['RequestTest']['test_id'] = $v_service_db; 
							$this->data['RequestTest']['mrp'] =$find_service_mrp['Test']['mrp'];
							$this->data['RequestTest']['test_book_date'] =$find_req_details['Health']['book_date'];
							$this->data['RequestTest']['status'] =1;
							
							if($this->RequestTest->create($this->data))
							{
								$this->RequestTest->save($this->data);
							}
						}
					}
					$someOneArray = array();
					$someOneArray['Health']['name'] = $this->data['Health']['name'];
					if($this->data['Health']['gender'] == 1)
					{
						$someOneArray['Health']['gender'] = 'Male';
					}
					if($this->data['Health']['gender'] == 2)
					{
						$someOneArray['Health']['gender'] = 'Female';
					}
					$someOneArray['Health']['age'] = $this->data['Health']['age'];
					$someOneArray['Health']['email'] = $UserDetail['User']['email'];
					if(!empty($find_req_details['Health']['test_id']))
					{
						$explode_tests = explode(',',$implode_test);
						$count = count($explode_tests);
						if($count == 1)
	
						{
	
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
	
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'];
	
						}
	
						if($count == 2)
	
						{
	
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
	
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
	
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'];
	
						}
	
						if($count == 3)
	
						{
	
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
	
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
	
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
	
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'];
	
						}
	
						if($count == 4)
	
						{
	
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
	
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
	
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
	
							$find_test_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
	
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name3['Test']['mrp'].','.$find_test_name4['Test']['testcode'].' - '.$find_test_name4['Test']['test_parameter'].' - Rs.'.$find_test_name4['Test']['mrp'];
	
						}
	
						if($count == 5)
	
						{
	
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
	
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
	
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
	
							$find_test_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
	
							$find_test_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
	
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name3['Test']['mrp'].','.$find_test_name4['Test']['testcode'].' - '.$find_test_name4['Test']['test_parameter'].' - Rs.'.$find_test_name4['Test']['mrp'].','.$find_test_name5['Test']['testcode'].' - '.$find_test_name5['Test']['test_parameter'].' - Rs.'.$find_test_name5['Test']['mrp'];
	
						}
	
						if($count == 6)
	
						{
	
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
	
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
	
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
	
							$find_test_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
	
							$find_test_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
	
							$find_test_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
	
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name3['Test']['mrp'].','.$find_test_name4['Test']['testcode'].' - '.$find_test_name4['Test']['test_parameter'].' - Rs.'.$find_test_name4['Test']['mrp'].','.$find_test_name5['Test']['testcode'].' - '.$find_test_name5['Test']['test_parameter'].' - Rs.'.$find_test_name5['Test']['mrp'].','.$find_test_name6['Test']['testcode'].' - '.$find_test_name6['Test']['test_parameter'].' - Rs.'.$find_test_name6['Test']['mrp'];
	
						}
	
						if($count == 7)
	
						{
	
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
	
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
	
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
	
							$find_test_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
	
							$find_test_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
	
							$find_test_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
	
							$find_test_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
	
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name3['Test']['mrp'].','.$find_test_name4['Test']['testcode'].' - '.$find_test_name4['Test']['test_parameter'].' - Rs.'.$find_test_name4['Test']['mrp'].','.$find_test_name5['Test']['testcode'].' - '.$find_test_name5['Test']['test_parameter'].' - Rs.'.$find_test_name5['Test']['mrp'].','.$find_test_name6['Test']['testcode'].' - '.$find_test_name6['Test']['test_parameter'].' - Rs.'.$find_test_name6['Test']['mrp'].','.$find_test_name7['Test']['testcode'].' - '.$find_test_name7['Test']['test_parameter'].' - Rs.'.$find_test_name7['Test']['mrp'];
	
						}
	
						if($count == 8)
	
						{
	
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
	
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
	
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
	
							$find_test_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
	
							$find_test_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
	
							$find_test_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
	
							$find_test_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
	
							$find_test_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[7])));
	
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name3['Test']['mrp'].','.$find_test_name4['Test']['testcode'].' - '.$find_test_name4['Test']['test_parameter'].' - Rs.'.$find_test_name4['Test']['mrp'].','.$find_test_name5['Test']['testcode'].' - '.$find_test_name5['Test']['test_parameter'].' - Rs.'.$find_test_name5['Test']['mrp'].','.$find_test_name6['Test']['testcode'].' - '.$find_test_name6['Test']['test_parameter'].' - Rs.'.$find_test_name6['Test']['mrp'].','.$find_test_name7['Test']['testcode'].' - '.$find_test_name7['Test']['test_parameter'].' - Rs.'.$find_test_name7['Test']['mrp'].','.$find_test_name8['Test']['testcode'].' - '.$find_test_name8['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'];
	
						}
	
						if($count == 9)
	
						{
	
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
	
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
	
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
	
							$find_test_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
	
							$find_test_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
	
							$find_test_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
	
							$find_test_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
	
							$find_test_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[7])));
	
							$find_test_name9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[8])));
	
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name3['Test']['mrp'].','.$find_test_name4['Test']['testcode'].' - '.$find_test_name4['Test']['test_parameter'].' - Rs.'.$find_test_name4['Test']['mrp'].','.$find_test_name5['Test']['testcode'].' - '.$find_test_name5['Test']['test_parameter'].' - Rs.'.$find_test_name5['Test']['mrp'].','.$find_test_name6['Test']['testcode'].' - '.$find_test_name6['Test']['test_parameter'].' - Rs.'.$find_test_name6['Test']['mrp'].','.$find_test_name7['Test']['testcode'].' - '.$find_test_name7['Test']['test_parameter'].' - Rs.'.$find_test_name7['Test']['mrp'].','.$find_test_name8['Test']['testcode'].' - '.$find_test_name8['Test']['test_parameter'].' - Rs.'.$find_test_name8['Test']['mrp'].','.$find_test_name9['Test']['testcode'].' - '.$find_test_name9['Test']['test_parameter'].' - Rs.'.$find_test_name9['Test']['mrp'];
	
						}
	
						if($count == 10)
	
						{
	
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
	
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
	
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
	
							$find_test_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
	
							$find_test_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
	
							$find_test_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
	
							$find_test_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
	
							$find_test_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[7])));
	
							$find_test_name9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[8])));
	
							$find_test_name10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[9])));
	
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name3['Test']['mrp'].','.$find_test_name4['Test']['testcode'].' - '.$find_test_name4['Test']['test_parameter'].' - Rs.'.$find_test_name4['Test']['mrp'].','.$find_test_name5['Test']['testcode'].' - '.$find_test_name5['Test']['test_parameter'].' - Rs.'.$find_test_name5['Test']['mrp'].','.$find_test_name6['Test']['testcode'].' - '.$find_test_name6['Test']['test_parameter'].' - Rs.'.$find_test_name6['Test']['mrp'].','.$find_test_name7['Test']['testcode'].' - '.$find_test_name7['Test']['test_parameter'].' - Rs.'.$find_test_name7['Test']['mrp'].','.$find_test_name8['Test']['testcode'].' - '.$find_test_name8['Test']['test_parameter'].' - Rs.'.$find_test_name8['Test']['mrp'].','.$find_test_name9['Test']['testcode'].' - '.$find_test_name9['Test']['test_parameter'].' - Rs.'.$find_test_name9['Test']['mrp'].','.$find_test_name10['Test']['testcode'].' - '.$find_test_name10['Test']['test_parameter'].' - Rs.'.$find_test_name10['Test']['mrp'];
	
						}
					}
					$someOneArray['Health']['remark'] = $this->data['Health']['remark'];
					$someOneArray['Health']['remarks'] = $this->data['Health']['remarks'];
					$someOneArray['Health']['address'] = $this->data['Health']['address'];
					$someOneArray['Health']['city'] = $this->data['Health']['city'];
					$someOneArray['Health']['sample_date'] = $this->data['Health']['sample_date'];
					
					if(!empty($find_req_details['Health']['profile_id']))
					{
						$explode_profiles = explode(',',$implode_profile);
	
						$count_profile = count($explode_profiles);
	
						if($count_profile == 1)
	
						{
	
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
	
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'];
	
						}
	
						if($count_profile == 2)
	
						{
	
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
	
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
	
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'];
	
						}
	
						if($count_profile == 3)
	
						{
	
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
	
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
	
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
	
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'];
	
						}
	
						if($count_profile == 4)
	
						{
	
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
	
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
	
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
	
							$find_profile_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
	
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'].','.$find_profile_name4['Test']['testcode'].' - '.$find_profile_name4['Test']['test_parameter'].' - Rs.'.$find_profile_name4['Test']['mrp'];
	
						}
	
						if($count_profile == 5)
	
						{
	
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
	
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
	
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
	
							$find_profile_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
	
							$find_profile_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
	
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'].','.$find_profile_name4['Test']['testcode'].' - '.$find_profile_name4['Test']['test_parameter'].' - Rs.'.$find_profile_name4['Test']['mrp'].','.$find_profile_name5['Test']['testcode'].' - '.$find_profile_name5['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'];
	
						}
	
						if($count_profile == 6)
	
						{
	
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
	
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
	
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
	
							$find_profile_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
	
							$find_profile_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
	
							$find_profile_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
	
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'].','.$find_profile_name4['Test']['testcode'].' - '.$find_profile_name4['Test']['test_parameter'].' - Rs.'.$find_profile_name4['Test']['mrp'].','.$find_profile_name5['Test']['testcode'].' - '.$find_profile_name5['Test']['test_parameter'].' - Rs.'.$find_profile_name5['Test']['mrp'].','.$find_profile_name6['Test']['testcode'].' - '.$find_profile_name6['Test']['test_parameter'].' - Rs.'.$find_profile_name6['Test']['mrp'];
	
						}
	
						if($count_profile == 7)
	
						{
	
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
	
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
	
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
	
							$find_profile_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
	
							$find_profile_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
	
							$find_profile_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
	
							$find_profile_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
	
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'].','.$find_profile_name4['Test']['testcode'].' - '.$find_profile_name4['Test']['test_parameter'].' - Rs.'.$find_profile_name4['Test']['mrp'].','.$find_profile_name5['Test']['testcode'].' - '.$find_profile_name5['Test']['test_parameter'].' - Rs.'.$find_profile_name5['Test']['mrp'].','.$find_profile_name6['Test']['testcode'].' - '.$find_profile_name6['Test']['test_parameter'].' - Rs.'.$find_profile_name6['Test']['mrp'].','.$find_profile_name7['Test']['testcode'].' - '.$find_profile_name7['Test']['test_parameter'].' - Rs.'.$find_profile_name7['Test']['mrp'];
	
						}
	
						if($count_profile == 8)
	
						{
	
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
	
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
	
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
	
							$find_profile_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
	
							$find_profile_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
	
							$find_profile_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
	
							$find_profile_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
	
							$find_profile_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[7])));
	
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'].','.$find_profile_name4['Test']['testcode'].' - '.$find_profile_name4['Test']['test_parameter'].' - Rs.'.$find_profile_name4['Test']['mrp'].','.$find_profile_name5['Test']['testcode'].' - '.$find_profile_name5['Test']['test_parameter'].' - Rs.'.$find_profile_name5['Test']['mrp'].','.$find_profile_name6['Test']['testcode'].' - '.$find_profile_name6['Test']['test_parameter'].' - Rs.'.$find_profile_name6['Test']['mrp'].','.$find_profile_name7['Test']['testcode'].' - '.$find_profile_name7['Test']['test_parameter'].' - Rs.'.$find_profile_name7['Test']['mrp'].','.$find_profile_name8['Test']['testcode'].' - '.$find_profile_name8['Test']['test_parameter'].' - Rs.'.$find_profile_name8['Test']['mrp'];
	
						}
	
						if($count_profile == 9)
	
						{
	
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
	
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
	
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
	
							$find_profile_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
	
							$find_profile_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
	
							$find_profile_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
	
							$find_profile_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
	
							$find_profile_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[7])));
	
							$find_profile_name9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[8])));
	
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'].','.$find_profile_name4['Test']['testcode'].' - '.$find_profile_name4['Test']['test_parameter'].' - Rs.'.$find_profile_name4['Test']['mrp'].','.$find_profile_name5['Test']['testcode'].' - '.$find_profile_name5['Test']['test_parameter'].' - Rs.'.$find_profile_name5['Test']['mrp'].','.$find_profile_name6['Test']['testcode'].' - '.$find_profile_name6['Test']['test_parameter'].' - Rs.'.$find_profile_name6['Test']['mrp'].','.$find_profile_name7['Test']['testcode'].' - '.$find_profile_name7['Test']['test_parameter'].' - Rs.'.$find_profile_name7['Test']['mrp'].','.$find_profile_name8['Test']['testcode'].' - '.$find_profile_name8['Test']['test_parameter'].' - Rs.'.$find_profile_name8['Test']['mrp'].','.$find_profile_name9['Test']['testcode'].' - '.$find_profile_name9['Test']['test_parameter'].' - Rs.'.$find_profile_name9['Test']['mrp'];
	
						}
	
						if($count_profile == 10)
	
						{
	
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
	
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
	
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
	
							$find_profile_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
	
							$find_profile_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
	
							$find_profile_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
	
							$find_profile_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
	
							$find_profile_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[7])));
	
							$find_profile_name9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[8])));
	
							$find_profile_name10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[9])));
	
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'].','.$find_profile_name4['Test']['testcode'].' - '.$find_profile_name4['Test']['test_parameter'].' - Rs.'.$find_profile_name4['Test']['mrp'].','.$find_profile_name5['Test']['testcode'].' - '.$find_profile_name5['Test']['test_parameter'].' - Rs.'.$find_profile_name5['Test']['mrp'].','.$find_profile_name6['Test']['testcode'].' - '.$find_profile_name6['Test']['test_parameter'].' - Rs.'.$find_profile_name6['Test']['mrp'].','.$find_profile_name7['Test']['testcode'].' - '.$find_profile_name7['Test']['test_parameter'].' - Rs.'.$find_profile_name7['Test']['mrp'].','.$find_profile_name8['Test']['testcode'].' - '.$find_profile_name8['Test']['test_parameter'].' - Rs.'.$find_profile_name8['Test']['mrp'].','.$find_profile_name9['Test']['testcode'].' - '.$find_profile_name9['Test']['test_parameter'].' - Rs.'.$find_profile_name9['Test']['mrp'].','.$find_profile_name10['Test']['testcode'].' - '.$find_profile_name10['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'];
	
						}
					}
					
					if(!empty($find_req_details['Health']['offer_id']))
					{
						$explode_offers = explode(',',$implode_offer);
	
						$count_offer = count($explode_offers);
	
						if($count_offer == 1)
	
						{
	
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
	
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'];
	
						}
	
						if($count_offer == 2)
	
						{
	
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
	
							$find_offer_name2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
	
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'].','.$find_offer_name2['Banner']['banner_code'].' - '.$find_offer_name2['Banner']['banner_name'].' - Rs.'.$find_offer_name2['Banner']['banner_mrp'];
	
						}
	
						if($count_offer == 3)
	
						{
	
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
	
							$find_offer_name2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
	
							$find_offer_name3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
	
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'].','.$find_offer_name2['Banner']['banner_code'].' - '.$find_offer_name2['Banner']['banner_name'].' - Rs.'.$find_offer_name2['Banner']['banner_mrp'].','.$find_offer_name3['Banner']['banner_code'].' - '.$find_offer_name3['Banner']['banner_name'].' - Rs.'.$find_offer_name3['Banner']['banner_mrp'];
	
						}
	
						if($count_offer == 4)
	
						{
	
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
	
							$find_offer_name2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
	
							$find_offer_name3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
	
							$find_offer_name4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
	
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'].','.$find_offer_name2['Banner']['banner_code'].' - '.$find_offer_name2['Banner']['banner_name'].' - Rs.'.$find_offer_name2['Banner']['banner_mrp'].','.$find_offer_name3['Banner']['banner_code'].' - '.$find_offer_name3['Banner']['banner_name'].' - Rs.'.$find_offer_name3['Banner']['banner_mrp'].','.$find_offer_name4['Banner']['banner_code'].' - '.$find_test_name4['Banner']['banner_name'].' - Rs.'.$find_offer_name4['Banner']['banner_mrp'];
	
						}
	
						if($count_offer == 5)
	
						{
	
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
	
							$find_offer_name2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
	
							$find_offer_name3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
	
							$find_offer_name4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
	
							$find_offer_name5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
	
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'].','.$find_offer_name2['Banner']['banner_code'].' - '.$find_offer_name2['Banner']['banner_name'].' - Rs.'.$find_offer_name2['Banner']['banner_mrp'].','.$find_offer_name3['Banner']['banner_code'].' - '.$find_offer_name3['Banner']['banner_name'].' - Rs.'.$find_offer_name3['Banner']['banner_mrp'].','.$find_offer_name4['Banner']['banner_code'].' - '.$find_offer_name4['Banner']['banner_name'].' - Rs.'.$find_offer_name4['Banner']['banner_mrp'].','.$find_offer_name5['Banner']['banner_code'].' - '.$find_offer_name5['Banner']['banner_name'].' - Rs.'.$find_offer_name5['Banner']['banner_mrp'];
	
						}
	
						if($count_offer == 6)
	
						{
	
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
	
							$find_offer_name2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
	
							$find_offer_name3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
	
							$find_offer_name4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
	
							$find_offer_name5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
	
							$find_offer_name6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[5])));
	
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'].','.$find_offer_name2['Banner']['banner_code'].' - '.$find_offer_name2['Banner']['banner_name'].' - Rs.'.$find_offer_name2['Banner']['banner_mrp'].','.$find_offer_name3['Banner']['banner_code'].' - '.$find_offer_name3['Banner']['banner_name'].' - Rs.'.$find_offer_name3['Banner']['banner_mrp'].','.$find_offer_name4['Banner']['banner_code'].' - '.$find_offer_name4['Banner']['banner_name'].' - Rs.'.$find_offer_name4['Banner']['banner_mrp'].','.$find_offer_name5['Banner']['banner_code'].' - '.$find_offer_name5['Banner']['banner_name'].' - Rs.'.$find_offer_name5['Banner']['banner_mrp'].','.$find_offer_name6['Banner']['banner_code'].' - '.$find_offer_name6['Banner']['banner_name'].' - Rs.'.$find_offer_name6['Banner']['banner_mrp'];
	
						}
	
						if($count_offer == 7)
	
						{
	
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
	
							$find_offer_name2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
	
							$find_offer_name3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
	
							$find_offer_name4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
	
							$find_offer_name5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
	
							$find_offer_name6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[5])));
	
							$find_offer_name7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[6])));
	
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'].','.$find_offer_name2['Banner']['banner_code'].' - '.$find_offer_name2['Banner']['banner_name'].' - Rs.'.$find_offer_name2['Banner']['banner_mrp'].','.$find_offer_name3['Banner']['banner_code'].' - '.$find_offer_name3['Banner']['banner_name'].' - Rs.'.$find_offer_name3['Banner']['banner_mrp'].','.$find_offer_name4['Banner']['banner_code'].' - '.$find_offer_name4['Banner']['banner_name'].' - Rs.'.$find_offer_name4['Banner']['banner_mrp'].','.$find_offer_name5['Banner']['banner_code'].' - '.$find_offer_name5['Banner']['banner_name'].' - Rs.'.$find_offer_name5['Banner']['banner_mrp'].','.$find_offer_name6['Banner']['banner_code'].' - '.$find_offer_name6['Banner']['banner_name'].' - Rs.'.$find_offer_name6['Banner']['banner_mrp'].','.$find_offer_name7['Banner']['banner_code'].' - '.$find_offer_name7['Banner']['banner_name'].' - Rs.'.$find_offer_name7['Banner']['banner_mrp'];
	
						}
	
						if($count_offer == 8)
	
						{
	
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
	
							$find_offer_name2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
	
							$find_offer_name3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
	
							$find_offer_name4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
	
							$find_offer_name5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
	
							$find_offer_name6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[5])));
	
							$find_offer_name7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[6])));
	
							$find_offer_name8 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[7])));
	
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'].','.$find_offer_name2['Banner']['banner_code'].' - '.$find_offer_name2['Banner']['banner_name'].' - Rs.'.$find_offer_name2['Banner']['banner_mrp'].','.$find_offer_name3['Banner']['banner_code'].' - '.$find_offer_name3['Banner']['banner_name'].' - Rs.'.$find_offer_name3['Banner']['banner_mrp'].','.$find_offer_name4['Banner']['banner_code'].' - '.$find_offer_name4['Banner']['banner_name'].' - Rs.'.$find_offer_name4['Banner']['banner_mrp'].','.$find_offer_name5['Banner']['banner_code'].' - '.$find_offer_name5['Banner']['banner_name'].' - Rs.'.$find_offer_name5['Banner']['banner_mrp'].','.$find_offer_name6['Banner']['banner_code'].' - '.$find_offer_name6['Banner']['banner_name'].' - Rs.'.$find_offer_name6['Banner']['banner_mrp'].','.$find_offer_name7['Banner']['banner_code'].' - '.$find_offer_name7['Banner']['banner_name'].' - Rs.'.$find_offer_name7['Banner']['banner_mrp'].','.$find_offer_name8['Banner']['banner_code'].' - '.$find_offer_name8['Banner']['banner_name'].' - Rs.'.$find_offer_name8['Banner']['banner_mrp'];
	
						}
					}
					
					
					if(!empty($find_req_details['Health']['package_id']))
					{
						$explode_packages = explode(',',$implode_package);
	
						$count_package = count($explode_packages);
	
						if($count_package == 1)
	
						{
	
							$find_package_name = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
	
							$someOneArray['Health']['package_id'] = $find_package_name['Package']['package_name'].' - Rs.'.$find_package_name['Package']['package_mrp'];
	
						}
	
						if($count_package == 2)
	
						{
	
							$find_package_name = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
	
							$find_package_name2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
	
							$someOneArray['Health']['package_id'] = $find_package_name['Package']['package_name'].' - Rs.'.$find_package_name['Package']['package_mrp'].','.$find_package_name2['Package']['package_name'].' - Rs.'.$find_package_name2['Package']['package_mrp'];
	
						}
	
						if($count_package == 3)
	
						{
	
							$find_package_name = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
	
							$find_package_name2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
	
							$find_package_name3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[2])));
	
							$someOneArray['Health']['package_id'] = $find_package_name['Package']['package_name'].' - Rs.'.$find_package_name['Package']['package_mrp'].','.$find_package_name2['Package']['package_name'].' - Rs.'.$find_package_name2['Package']['package_mrp'].','.$find_package_name3['Package']['package_name'].' - Rs.'.$find_package_name3['Package']['package_mrp'];
	
						}
	
						if($count_package == 4)
	
						{
	
							$find_package_name = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
	
							$find_package_name2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
	
							$find_package_name3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[2])));
	
							$find_package_name4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[3])));
	
							$someOneArray['Health']['package_id'] = $find_package_name['Package']['package_name'].' - Rs.'.$find_package_name['Package']['package_mrp'].','.$find_package_name2['Package']['package_name'].' - Rs.'.$find_package_name2['Package']['package_mrp'].','.$find_package_name3['Package']['package_name'].' - Rs.'.$find_package_name3['Package']['package_mrp'].','.$find_package_name4['Package']['package_name'].' - Rs.'.$find_package_name4['Package']['package_mrp'];
	
						}
	
						if($count_package == 5)
	
						{
	
							$find_package_name = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
	
							$find_package_name2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
	
							$find_package_name3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[2])));
	
							$find_package_name4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[3])));
	
							$find_package_name5 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[4])));
	
							$someOneArray['Health']['package_id'] = $find_package_name['Package']['package_name'].' - Rs.'.$find_package_name['Package']['package_mrp'].','.$find_package_name2['Package']['package_name'].' - Rs.'.$find_package_name2['Package']['package_mrp'].','.$find_package_name3['Package']['package_name'].' - Rs.'.$find_package_name3['Package']['package_mrp'].','.$find_package_name4['Package']['package_name'].' - Rs.'.$find_package_name4['Package']['package_mrp'].','.$find_package_name5['Package']['package_name'].' - Rs.'.$find_package_name5['Package']['package_mrp'];
	
						}
					}
					
					if(!empty($find_req_details['Health']['service_id']))
					{
						$explode_service = explode(',',$implode_service);
						$count_service = count($explode_service);
						if($count_service == 1)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'];
						}
						if($count_service == 2)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'];
						}
						if($count_service == 3)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'];
						}
						if($count_service == 4)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$find_service_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'].','.$find_service_name4['Test']['testcode'].' - '.$find_service_name4['Test']['test_parameter'].' - Rs.'.$find_service_name4['Test']['mrp'];
						}
						if($count_service == 5)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$find_service_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
							$find_service_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'].','.$find_service_name4['Test']['testcode'].' - '.$find_service_name4['Test']['test_parameter'].' - Rs.'.$find_service_name4['Test']['mrp'].','.$find_service_name5['Test']['testcode'].' - '.$find_service_name5['Test']['test_parameter'].' - Rs.'.$find_service_name5['Test']['mrp'];
						}
						if($count_service == 6)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$find_service_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
							$find_service_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
							$find_service_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'].','.$find_service_name4['Test']['testcode'].' - '.$find_service_name4['Test']['test_parameter'].' - Rs.'.$find_service_name4['Test']['mrp'].','.$find_service_name5['Test']['testcode'].' - '.$find_service_name5['Test']['test_parameter'].' - Rs.'.$find_service_name5['Test']['mrp'].','.$find_service_name6['Test']['testcode'].' - '.$find_service_name6['Test']['test_parameter'].' - Rs.'.$find_service_name6['Test']['mrp'];
						}
						if($count_service == 7)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$find_service_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
							$find_service_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
							$find_service_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
							$find_service_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[6])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'].','.$find_service_name4['Test']['testcode'].' - '.$find_service_name4['Test']['test_parameter'].' - Rs.'.$find_service_name4['Test']['mrp'].','.$find_service_name5['Test']['testcode'].' - '.$find_service_name5['Test']['test_parameter'].' - Rs.'.$find_service_name5['Test']['mrp'].','.$find_service_name6['Test']['testcode'].' - '.$find_service_name6['Test']['test_parameter'].' - Rs.'.$find_service_name6['Test']['mrp'].','.$find_service_name7['Test']['testcode'].' - '.$find_service_name7['Test']['test_parameter'].' - Rs.'.$find_service_name7['Test']['mrp'];
						}
						if($count_service == 8)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$find_service_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
							$find_service_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
							$find_service_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
							$find_service_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[6])));
							$find_service_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[7])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'].','.$find_service_name4['Test']['testcode'].' - '.$find_service_name4['Test']['test_parameter'].' - Rs.'.$find_service_name4['Test']['mrp'].','.$find_service_name5['Test']['testcode'].' - '.$find_service_name5['Test']['test_parameter'].' - Rs.'.$find_service_name5['Test']['mrp'].','.$find_service_name6['Test']['testcode'].' - '.$find_service_name6['Test']['test_parameter'].' - Rs.'.$find_service_name6['Test']['mrp'].','.$find_service_name7['Test']['testcode'].' - '.$find_service_name7['Test']['test_parameter'].' - Rs.'.$find_service_name7['Test']['mrp'].','.$find_service_name8['Test']['testcode'].' - '.$find_service_name8['Test']['test_parameter'].' - Rs.'.$find_service_name8['Test']['mrp'];
						}
						if($count_service == 9)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$find_service_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
							$find_service_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
							$find_service_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
							$find_service_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[6])));
							$find_service_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[7])));
							$find_service_name9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[8])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'].','.$find_service_name4['Test']['testcode'].' - '.$find_service_name4['Test']['test_parameter'].' - Rs.'.$find_service_name4['Test']['mrp'].','.$find_service_name5['Test']['testcode'].' - '.$find_service_name5['Test']['test_parameter'].' - Rs.'.$find_service_name5['Test']['mrp'].','.$find_service_name6['Test']['testcode'].' - '.$find_service_name6['Test']['test_parameter'].' - Rs.'.$find_service_name6['Test']['mrp'].','.$find_service_name7['Test']['testcode'].' - '.$find_service_name7['Test']['test_parameter'].' - Rs.'.$find_service_name7['Test']['mrp'].','.$find_service_name8['Test']['testcode'].' - '.$find_service_name8['Test']['test_parameter'].' - Rs.'.$find_service_name8['Test']['mrp'].','.$find_service_name9['Test']['testcode'].' - '.$find_service_name9['Test']['test_parameter'].' - Rs.'.$find_service_name9['Test']['mrp'];
						}
						if($count_service == 10)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$find_service_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
							$find_service_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
							$find_service_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
							$find_service_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[6])));
							$find_service_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[7])));
							$find_service_name9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[8])));
							$find_service_name10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[9])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'].','.$find_service_name4['Test']['testcode'].' - '.$find_service_name4['Test']['test_parameter'].' - Rs.'.$find_service_name4['Test']['mrp'].','.$find_service_name5['Test']['testcode'].' - '.$find_service_name5['Test']['test_parameter'].' - Rs.'.$find_service_name5['Test']['mrp'].','.$find_service_name6['Test']['testcode'].' - '.$find_service_name6['Test']['test_parameter'].' - Rs.'.$find_service_name6['Test']['mrp'].','.$find_service_name7['Test']['testcode'].' - '.$find_service_name7['Test']['test_parameter'].' - Rs.'.$find_service_name7['Test']['mrp'].','.$find_service_name8['Test']['testcode'].' - '.$find_service_name8['Test']['test_parameter'].' - Rs.'.$find_service_name8['Test']['mrp'].','.$find_service_name9['Test']['testcode'].' - '.$find_service_name9['Test']['test_parameter'].' - Rs.'.$find_service_name9['Test']['mrp'].','.$find_service_name10['Test']['testcode'].' - '.$find_service_name10['Test']['test_parameter'].' - Rs.'.$find_service_name10['Test']['mrp'];
						}
					}
					
					if($this->data['Health']['sample_time'] == 1) {$someOneArray['Health']['sample_time'] = '7:00AM - 7:30AM';}
					if($this->data['Health']['sample_time'] == 2) {$someOneArray['Health']['sample_time'] = '7:30AM - 8:00AM';}
					if($this->data['Health']['sample_time'] == 3) {$someOneArray['Health']['sample_time'] = '8:00AM - 8:30AM';}
					if($this->data['Health']['sample_time'] == 4) {$someOneArray['Health']['sample_time'] = '8:30AM - 9:00AM';}
					if($this->data['Health']['sample_time'] == 5) {$someOneArray['Health']['sample_time'] = '9:00AM - 9:30AM';}
					if($this->data['Health']['sample_time'] == 6) {$someOneArray['Health']['sample_time'] = '9:30AM - 10:00AM';}
					if($this->data['Health']['sample_time'] == 7) {$someOneArray['Health']['sample_time'] = '10:00AM - 10:30AM';}
					if($this->data['Health']['sample_time'] == 8) {$someOneArray['Health']['sample_time'] = '10:30AM - 11:00AM';}
					if($this->data['Health']['sample_time'] == 9) {$someOneArray['Health']['sample_time'] = '11:00AM - 11:30AM';}
					if($this->data['Health']['sample_time'] == 10) {$someOneArray['Health']['sample_time'] = '11:30AM - 12:00PM';}
					if($this->data['Health']['sample_time'] == 11) {$someOneArray['Health']['sample_time'] = '12:00PM - 12:30PM';}
					if($this->data['Health']['sample_time'] == 12) {$someOneArray['Health']['sample_time'] = '12:30PM - 1:00PM';}
					if($this->data['Health']['sample_time'] == 13) {$someOneArray['Health']['sample_time'] = '1:00PM - 1:30PM';}
					if($this->data['Health']['sample_time'] == 14) {$someOneArray['Health']['sample_time'] = '1:30PM - 2:00PM';}
					if($this->data['Health']['sample_time'] == 15) {$someOneArray['Health']['sample_time'] = '2:00PM - 2:30PM';}
					if($this->data['Health']['sample_time'] == 16) {$someOneArray['Health']['sample_time'] = '2:30PM - 3:00PM';}
					if($this->data['Health']['sample_time'] == 17) {$someOneArray['Health']['sample_time'] = '3:00PM - 3:30PM';}
					if($this->data['Health']['sample_time'] == 18) {$someOneArray['Health']['sample_time'] = '3:30PM - 4:00PM';}
					if($this->data['Health']['sample_time'] == 19) {$someOneArray['Health']['sample_time'] = '4:00PM - 4:30PM';}
					if($this->data['Health']['sample_time'] == 20) {$someOneArray['Health']['sample_time'] = '4:30PM - 5:00PM';}
					if($this->data['Health']['sample_time'] == 21) {$someOneArray['Health']['sample_time'] = '5:00PM - 5:30PM';}
					if($this->data['Health']['sample_time'] == 22) {$someOneArray['Health']['sample_time'] = '5:30PM - 6:00PM';}
					if($this->data['Health']['sample_time'] == 23) {$someOneArray['Health']['sample_time'] = '6:00PM - 6:30PM';}
					if($this->data['Health']['sample_time'] == 24) {$someOneArray['Health']['sample_time'] = '6:30PM - 7:00PM';}
					
					if($this->data['Health']['sample_time1'] == 1) {$someOneArray['Health']['sample_time1'] = '7:00AM - 7:30AM';}
					if($this->data['Health']['sample_time1'] == 2) {$someOneArray['Health']['sample_time1'] = '7:30AM - 8:00AM';}
					if($this->data['Health']['sample_time1'] == 3) {$someOneArray['Health']['sample_time1'] = '8:00AM - 8:30AM';}
					if($this->data['Health']['sample_time1'] == 4) {$someOneArray['Health']['sample_time1'] = '8:30AM - 9:00AM';}
					if($this->data['Health']['sample_time1'] == 5) {$someOneArray['Health']['sample_time1'] = '9:00AM - 9:30AM';}
					if($this->data['Health']['sample_time1'] == 6) {$someOneArray['Health']['sample_time1'] = '9:30AM - 10:00AM';}
					if($this->data['Health']['sample_time1'] == 7) {$someOneArray['Health']['sample_time1'] = '10:00AM - 10:30AM';}
					if($this->data['Health']['sample_time1'] == 8) {$someOneArray['Health']['sample_time1'] = '10:30AM - 11:00AM';}
					if($this->data['Health']['sample_time1'] == 9) {$someOneArray['Health']['sample_time1'] = '11:00AM - 11:30AM';}
					if($this->data['Health']['sample_time1'] == 10) {$someOneArray['Health']['sample_time1'] = '11:30AM - 12:00PM';}
					if($this->data['Health']['sample_time1'] == 11) {$someOneArray['Health']['sample_time1'] = '12:00PM - 12:30PM';}
					if($this->data['Health']['sample_time1'] == 12) {$someOneArray['Health']['sample_time1'] = '12:30PM - 1:00PM';}
					if($this->data['Health']['sample_time1'] == 13) {$someOneArray['Health']['sample_time1'] = '1:00PM - 1:30PM';}
					if($this->data['Health']['sample_time1'] == 14) {$someOneArray['Health']['sample_time1'] = '1:30PM - 2:00PM';}
					if($this->data['Health']['sample_time1'] == 15) {$someOneArray['Health']['sample_time1'] = '2:00PM - 2:30PM';}
					if($this->data['Health']['sample_time1'] == 16) {$someOneArray['Health']['sample_time1'] = '2:30PM - 3:00PM';}
					if($this->data['Health']['sample_time1'] == 17) {$someOneArray['Health']['sample_time1'] = '3:00PM - 3:30PM';}
					if($this->data['Health']['sample_time1'] == 18) {$someOneArray['Health']['sample_time1'] = '3:30PM - 4:00PM';}
					if($this->data['Health']['sample_time1'] == 19) {$someOneArray['Health']['sample_time1'] = '4:00PM - 4:30PM';}
					if($this->data['Health']['sample_time1'] == 20) {$someOneArray['Health']['sample_time1'] = '4:30PM - 5:00PM';}
					if($this->data['Health']['sample_time1'] == 21) {$someOneArray['Health']['sample_time1'] = '5:00PM - 5:30PM';}
					if($this->data['Health']['sample_time1'] == 22) {$someOneArray['Health']['sample_time1'] = '5:30PM - 6:00PM';}
					if($this->data['Health']['sample_time1'] == 23) {$someOneArray['Health']['sample_time1'] = '6:00PM - 6:30PM';}
					if($this->data['Health']['sample_time1'] == 24) {$someOneArray['Health']['sample_time1'] = '6:30PM - 7:00PM';}
					$someOneArray['Health']['sample_date1'] = $this->data['Health']['sample_date1'];
					$someOneArray['Health']['address'] = $this->data['Health']['address1'].'*'.$this->data['Health']['address2'];
					$city_name = $this->City->find('first',array('conditions'=>array('City.id'=>$this->data['Health']['city_id'])));
					$state_name = $this->State->find('first',array('conditions'=>array('State.id'=>$this->data['Health']['state'])));
					$someOneArray['Health']['state'] = $state_name['State']['name'];
					$someOneArray['Health']['locality'] = $this->data['Health']['locality'];
					$someOneArray['Health']['pincode'] = $this->data['Health']['pincode'];
					$someOneArray['Health']['landmark'] = $this->data['Health']['landmark'];
					$someOneArray['Health']['remarks'] = $this->data['Health']['remarks'];
					$someOneArray['Health']['landline'] = $this->data['Health']['landline'];
					$find_pcc_email = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$this->data['Health']['city'])));
					if(!empty($this->data['Health']['city']))
					{
						$someOneArray['Health']['city'] = $find_pcc_email['Lab']['pcc_name'];
					}
					else
					{
						$someOneArray['Health']['city'] = $city_name['City']['name'];
					}
					//echo "<pre>"; print_r($this->data); exit;
					$this->set('mailContent' , $someOneArray );
					$this->Email->template = 'home_collection1';
					$this->Email->from = $this->data['Health']['email'];
					$this->Email->fromName = $this->data['Health']['name'];
					$this->Email->subject = 'Booking Request';
					
					//if($this->data['Health']['city'] == 'Crossing Republic')
					//{
						//$this->Email->to = 'crossingslab@niramayahealthcare.com,bookatest@niramayahealthcare.com,itcombinetesting@gmail.com';
						//$this->Email->to = 'puneet.agrawal88@gmail.com';
					//}
					//if($this->data['Health']['city'] == 'Indirapuram')
					//{
						//$this->Email->to = 'indirapuramlab@niramayahealthcare.com,bookatest@niramayahealthcare.com,itcombinetesting@gmail.com';
						//$this->Email->to = 'nisha.kathait@gmail.com';
					//}
					if($this->data['Health']['selecttype'] == 'homecollection')
					{
						$this->Email->to = 'homecollection@niramayahealthcare.com,bookatest@niramayahealthcare.com,itcombinetesting@gmail.com';
						//$this->Email->to = 'tripathi.ashish2007@gmail.com';
					}
					else
					{
						$this->Email->to = $find_pcc_email['Lab']['pcc_email'].',bookatest@niramayahealthcare.com,itcombinetesting@gmail.com';
					}
					//if($this->data['Health']['city'] == 'Noida')
					//{
						//$this->Email->to = 'sector31noida@niramayahealthcare.com,bookatest@niramayahealthcare.com,itcombinetesting@gmail.com';
						//$this->Email->to = 'surbhi.tandon07@gmail.com';
					//}
					$this->Email->sendAs = 'html';
					$this->Email->delivery = 'mail';
					if($this->Email->send())
					{
						$update_user_id = $this->Health->query("UPDATE healths SET user_id='".$UserId."' WHERE id='".$last_insert_id."'");
						if($this->data['Health']['requ_type'] == 'visit_lab')
						{
							$number = $this->data['Health']['landline'];
							$get_info_city = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$this->data['Health']['city'])));
							$message = 'Thank you for booking your tests with nirAmaya Healthcare powered by Pathcorp. You have opted for visiting our '.$get_info_city['Lab']['pcc_name'].' Centre '.$get_info_city['Lab']['pcc_address'].' for the tests. Kindly call +91-9555009009 or visit www.niramayahealthcare.com for your test request status updates in "My Account"';
						}
						if($this->data['Health']['requ_type'] == 'home_collection')
						{
							$number = $this->data['Health']['landline'];
							$message = 'Thank you for booking your tests with nirAmaya Healthcare powered by Pathcorp. You have opted for Home Sample collection. Kindly call +91-9555009009 or visit www.niramayahealthcare.com for your test request status updates in "My Account"';
						}
						//$this->__sms_message($number,$message);
						$this->redirect('/tests/checkout/'.$last_insert_id);
					}
					
				}
			}
		}
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));
		$tests = $this->Test->find('all',array('conditions'=>array('Test.status'=>1)));
		$time = $this->Time->find('list',array('conditions'=>array('Time.status'=>1),'fields'=>array('id','name')));
		$time1 = $this->Time->find('list',array('conditions'=>array('Time.status'=>1),'fields'=>array('id','name')));
		$gender = $this->Gender->find('all',array('conditions'=>array('Gender.status'=>1)));
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));
		$this->set('city',$city); 
		$state = $this->State->find('all',array('conditions'=>array('State.status'=>1)));
		$this->set('state',$state); 
		$userData = $this->Session->read('UserDetail');
		//$pcc = $this->Lab->find('all',array('conditions'=>array('Lab.status'=>1)));
                $pcc = $this->Lab->find('all',array('conditions'=>array('Lab.status'=>1,'Lab.show_to_world'=>1),'order'=>array('Lab.sequence'=>'asc')));
		$this->set('pcc',$pcc); 
		$this->set('userData',$userData); 
		$this->set('tests',$tests);
		$this->set('time',$time);
		$this->set('time1',$time1);
		$this->set('gender',$gender);
	}
	function edit_request($req_id = NULL)
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','Niramayahealth Care | Edit Booked Test(s)/Profile(s)');
		$find_req = $this->Health->find('first',array('conditions'=>array('Health.id'=>$req_id)));
		$this->set('find_req',$find_req);
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));
		$tests = $this->Test->find('all',array('conditions'=>array('Test.status'=>1)));
		$time = $this->Time->find('list',array('conditions'=>array('Time.status'=>1),'fields'=>array('id','name')));
		$time1 = $this->Time->find('list',array('conditions'=>array('Time.status'=>1),'fields'=>array('id','name')));
		$gender = $this->Gender->find('all',array('conditions'=>array('Gender.status'=>1)));
		$city = $this->City->find('list',array('conditions'=>array('City.status'=>1),'fields'=>array('id','name')));
		$this->set('city',$city); 
		$state = $this->State->find('list',array('conditions'=>array('State.status'=>1),'fields'=>array('id','name')));
		$this->set('state',$state); 
		$pcc = $this->Lab->find('all',array('conditions'=>array('Lab.status'=>1)));
		$this->set('pcc',$pcc);
		$this->set('time',$time);
		$this->set('time1',$time1);
		$this->set('gender',$gender);
		$this->data = $find_req;
	}
	function health_collection($request_id = NULL)
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','Niramayahealth Care | Book Test(s)/Profile(s)');
		$this->Health=ClassRegistry::init('Health');
		if(!empty($this->data['Health']))
		{
			$this->data['Health']['status'] = 1;
			$session_tests = $this->Session->read('test_ids_array_book');
			$session_profiles = $this->Session->read('profile_ids_array_book');
			$session_offers = $this->Session->read('offer_ids_array_book');
			$session_packages = $this->Session->read('package_ids_array_book');
			$session_services = $this->Session->read('service_ids_array_book');
			if(!empty($session_tests))
			{
				
				if(!empty($this->data['Health']['sample_time1']) && !empty($this->data['Health']['sample_date1']))
					{
						//if($_SERVER['REMOTE_ADDR']=='172.31.39.64' || $_SERVER['REMOTE_ADDR']=="171.79.71.209" || $_SERVER['REMOTE_ADDR']=="172.31.30.173")
						{
							
						
						
						if($this->data['Health']['sample_time1'] >=4){
					
								array_push($session_tests,905);
					//$services_test = $this->Test->find('first',array('conditions'=>array('Test.id'=>905)));
								}else{
									
									array_push($session_tests,904);
					//$services_test = $this->Test->find('first',array('conditions'=>array('Test.id'=>904)));
								}
								
							
						}
						
					}
				
				
				
				
				$implode_test = implode(',',$session_tests);
				
				
				$this->data['Health']['test_id'] = $implode_test;
			}
			if(!empty($session_profiles))
			{
				$implode_profile = implode(',',$session_profiles);
				$this->data['Health']['profile_id'] = $implode_profile;
			}
			if(!empty($session_offers))
			{
				$implode_offer = implode(',',$session_offers);
				$this->data['Health']['offer_id'] = $implode_offer;
			}
			if(!empty($session_packages))
			{
				$implode_package = implode(',',$session_packages);
				$this->data['Health']['package_id'] = $implode_package;
			}
			if($this->data['Health']['city'] == '')
			{
				$this->data['Health']['selecttype'] = 'homecollection';
			}
			if(!empty($session_services))
			{
				$implode_service = implode(',',$session_services);
				$this->data['Health']['service_id'] = $implode_service;
			}
			if($this->Health->create($this->data))
			{
				//$this->data['Health']['landline'] = '';
				$this->data['Health']['agent_id'] = 0;
				$this->data['Health']['pay_status'] = 0;
				$this->data['Health']['print_status'] = 0;
				$this->data['Health']['trf_status'] = 0;
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
				$UserDetail = $this->Session->read('UserDetail');
				$UserId = $UserDetail['User']['id'];
				if($this->data['Health']['city'] != '')
				{
					$this->data['Health']['city_id'] = 0;
					$this->data['Health']['assigned_lab'] = $this->data['Health']['city'];
					$this->data['Health']['address'] = '';
					$this->data['Health']['locality'] = '';
					$this->data['Health']['city_id'] = 0;
					$this->data['Health']['state'] = 0;
					$this->data['Health']['pincode'] = '';
					$this->data['Health']['landmark'] = '';
					$u_det = $this->User->find('first',array('conditions'=>array('User.id'=>$UserId)));
					$this->data['Health']['visit_pat_city'] = $u_det['User']['city'];
					$this->data['Health']['s_date'] = date('Y-m-d',strtotime($this->data['Health']['sample_date']));
					$this->data['Health']['requ_status'] = 1;
					$this->data['Health']['requ_type'] = 'visit_lab';
				}
				if(!empty($this->data['Health']['sample_time1']) && !empty($this->data['Health']['sample_date1']))
				{
					$this->data['Health']['assigned_lab'] = 'Home';
					if(!empty($this->data['Health']['address1']) && empty($this->data['Health']['address2']))
					{
						$this->data['Health']['address'] = $this->data['Health']['address1'];
					}
					if(!empty($this->data['Health']['address1']) && !empty($this->data['Health']['address2']))
					{
						$this->data['Health']['address'] = $this->data['Health']['address1'].'*'.$this->data['Health']['address2'];;
					}
					$this->data['Health']['locality'] = $this->data['Health']['locality'];
					$this->data['Health']['city_id'] = $this->data['Health']['city_id'];
					$this->data['Health']['state'] = $this->data['Health']['state'];
					$this->data['Health']['pincode'] = $this->data['Health']['pincode'];
					$this->data['Health']['landmark'] = $this->data['Health']['landmark'];
					$this->data['Health']['visit_pat_city'] = $this->data['Health']['city_id'];
					$this->data['Health']['s_date'] = date('Y-m-d',strtotime($this->data['Health']['sample_date1']));
					$this->data['Health']['requ_status'] = 2;
					$this->data['Health']['requ_type'] = 'home_collection';
				}
				
				if($this->Health->save($this->data))
				{
					if(empty($request_id))
					{
						$last_insert_id = $this->Health->getLastInsertId();
						$fetch_saved_detail = $this->Health->find('first',array('conditions'=>array('Health.id'=>$last_insert_id)));
						$explode_test_ids_db = explode(',',$fetch_saved_detail['Health']['test_id']);
						if(!empty($explode_test_ids_db))
						{
							foreach($explode_test_ids_db as $k_test_db => $v_test_db)
							{
								$find_test_mrp = $this->Test->find('first',array('conditions'=>array('Test.id'=>$v_test_db)));
								$this->data['RequestTest']['type'] = 'TE';
								$this->data['RequestTest']['health_id'] = $last_insert_id;
								$this->data['RequestTest']['test_id'] = $v_test_db; 
								$this->data['RequestTest']['mrp'] =$find_test_mrp['Test']['mrp'];
								$this->data['RequestTest']['test_book_date'] =$fetch_saved_detail['Health']['book_date'];
								$this->data['RequestTest']['status'] =1;
								
								if($this->RequestTest->create($this->data))
								{
									$this->RequestTest->save($this->data);
								}
							}
						}
						$explode_profile_ids_db = explode(',',$fetch_saved_detail['Health']['profile_id']);
						if(!empty($explode_profile_ids_db))
						{
							foreach($explode_profile_ids_db as $k_profile_db => $v_profile_db)
							{
								$find_profile_mrp = $this->Test->find('first',array('conditions'=>array('Test.id'=>$v_profile_db)));
								$this->data['RequestTest']['type'] = 'PR';
								$this->data['RequestTest']['health_id'] = $last_insert_id;
								$this->data['RequestTest']['test_id'] = $v_profile_db; 
								$this->data['RequestTest']['mrp'] =$find_profile_mrp['Test']['mrp'];
								$this->data['RequestTest']['test_book_date'] =$fetch_saved_detail['Health']['book_date'];
								$this->data['RequestTest']['status'] =1;
								
								if($this->RequestTest->create($this->data))
								{
									$this->RequestTest->save($this->data);
								}
							}
						}
						$explode_offer_ids_db = explode(',',$fetch_saved_detail['Health']['offer_id']);
						if(!empty($explode_offer_ids_db))
						{
							foreach($explode_offer_ids_db as $k_offer_db => $v_offer_db)
							{
								$find_offer_mrp = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$v_offer_db)));
								$this->data['RequestTest']['type'] = 'OF';
								$this->data['RequestTest']['health_id'] = $last_insert_id;
								$this->data['RequestTest']['test_id'] = $v_offer_db; 
								$this->data['RequestTest']['mrp'] =$find_offer_mrp['Banner']['banner_mrp'];
								$this->data['RequestTest']['test_book_date'] =$fetch_saved_detail['Health']['book_date'];
								$this->data['RequestTest']['status'] =1;
								
								if($this->RequestTest->create($this->data))
								{
									$this->RequestTest->save($this->data);
								}
							}
						}
						$explode_package_ids_db = explode(',',$fetch_saved_detail['Health']['package_id']);
						if(!empty($explode_package_ids_db))
						{
							foreach($explode_package_ids_db as $k_package_db => $v_package_db)
							{
								$find_package_mrp = $this->Package->find('first',array('conditions'=>array('Package.id'=>$v_package_db)));
								$this->data['RequestTest']['type'] = 'PA';
								$this->data['RequestTest']['health_id'] = $last_insert_id;
								$this->data['RequestTest']['test_id'] = $v_package_db; 
								$this->data['RequestTest']['mrp'] =$find_package_mrp['Package']['package_mrp'];
								$this->data['RequestTest']['test_book_date'] =$fetch_saved_detail['Health']['book_date'];
								$this->data['RequestTest']['status'] =1;
								
								if($this->RequestTest->create($this->data))
								{
									$this->RequestTest->save($this->data);
								}
							}
						}
						$explode_service_ids_db = explode(',',$fetch_saved_detail['Health']['service_id']);
						if(!empty($explode_service_ids_db))
						{
							foreach($explode_service_ids_db as $k_service_db => $v_service_db)
							{
								$find_service_mrp = $this->Test->find('first',array('conditions'=>array('Test.id'=>$v_service_db)));
								$this->data['RequestTest']['type'] = 'SR';
								$this->data['RequestTest']['health_id'] = $last_insert_id;
								$this->data['RequestTest']['test_id'] = $v_service_db; 
								$this->data['RequestTest']['mrp'] =$find_service_mrp['Test']['mrp'];
								$this->data['RequestTest']['test_book_date'] =$fetch_saved_detail['Health']['book_date'];
								$this->data['RequestTest']['status'] =1;
								
								if($this->RequestTest->create($this->data))
								{
									$this->RequestTest->save($this->data);
								}
							}
						}
					}
					if(!empty($request_id))
					{
						$last_insert_id = $request_id;
					}
					$someOneArray = array();
					$someOneArray['Health']['name'] = $this->data['Health']['name'];
					if($this->data['Health']['gender'] == 1)
					{
						$someOneArray['Health']['gender'] = 'Male';
					}
					if($this->data['Health']['gender'] == 2)
					{
						$someOneArray['Health']['gender'] = 'Female';
					}
					$someOneArray['Health']['age'] = $this->data['Health']['age'];
					$someOneArray['Health']['email'] = $this->data['Health']['email'];
					if(!empty($implode_test))
					{
						$explode_tests = explode(',',$implode_test);
						$count = count($explode_tests);
						if($count == 1)
						{
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'];
						}
						if($count == 2)
						{
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'];
						}
						if($count == 3)
						{
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'];
						}
						if($count == 4)
						{
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$find_test_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name3['Test']['mrp'].','.$find_test_name4['Test']['testcode'].' - '.$find_test_name4['Test']['test_parameter'].' - Rs.'.$find_test_name4['Test']['mrp'];
						}
						if($count == 5)
						{
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$find_test_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
							$find_test_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name3['Test']['mrp'].','.$find_test_name4['Test']['testcode'].' - '.$find_test_name4['Test']['test_parameter'].' - Rs.'.$find_test_name4['Test']['mrp'].','.$find_test_name5['Test']['testcode'].' - '.$find_test_name5['Test']['test_parameter'].' - Rs.'.$find_test_name5['Test']['mrp'];
						}
						if($count == 6)
						{
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$find_test_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
							$find_test_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
							$find_test_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name3['Test']['mrp'].','.$find_test_name4['Test']['testcode'].' - '.$find_test_name4['Test']['test_parameter'].' - Rs.'.$find_test_name4['Test']['mrp'].','.$find_test_name5['Test']['testcode'].' - '.$find_test_name5['Test']['test_parameter'].' - Rs.'.$find_test_name5['Test']['mrp'].','.$find_test_name6['Test']['testcode'].' - '.$find_test_name6['Test']['test_parameter'].' - Rs.'.$find_test_name6['Test']['mrp'];
						}
						if($count == 7)
						{
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$find_test_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
							$find_test_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
							$find_test_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
							$find_test_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name3['Test']['mrp'].','.$find_test_name4['Test']['testcode'].' - '.$find_test_name4['Test']['test_parameter'].' - Rs.'.$find_test_name4['Test']['mrp'].','.$find_test_name5['Test']['testcode'].' - '.$find_test_name5['Test']['test_parameter'].' - Rs.'.$find_test_name5['Test']['mrp'].','.$find_test_name6['Test']['testcode'].' - '.$find_test_name6['Test']['test_parameter'].' - Rs.'.$find_test_name6['Test']['mrp'].','.$find_test_name7['Test']['testcode'].' - '.$find_test_name7['Test']['test_parameter'].' - Rs.'.$find_test_name7['Test']['mrp'];
						}
						if($count == 8)
						{
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$find_test_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
							$find_test_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
							$find_test_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
							$find_test_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
							$find_test_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[7])));
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name3['Test']['mrp'].','.$find_test_name4['Test']['testcode'].' - '.$find_test_name4['Test']['test_parameter'].' - Rs.'.$find_test_name4['Test']['mrp'].','.$find_test_name5['Test']['testcode'].' - '.$find_test_name5['Test']['test_parameter'].' - Rs.'.$find_test_name5['Test']['mrp'].','.$find_test_name6['Test']['testcode'].' - '.$find_test_name6['Test']['test_parameter'].' - Rs.'.$find_test_name6['Test']['mrp'].','.$find_test_name7['Test']['testcode'].' - '.$find_test_name7['Test']['test_parameter'].' - Rs.'.$find_test_name7['Test']['mrp'].','.$find_test_name8['Test']['testcode'].' - '.$find_test_name8['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'];
						}
						if($count == 9)
						{
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$find_test_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
							$find_test_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
							$find_test_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
							$find_test_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
							$find_test_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[7])));
							$find_test_name9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[8])));
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name3['Test']['mrp'].','.$find_test_name4['Test']['testcode'].' - '.$find_test_name4['Test']['test_parameter'].' - Rs.'.$find_test_name4['Test']['mrp'].','.$find_test_name5['Test']['testcode'].' - '.$find_test_name5['Test']['test_parameter'].' - Rs.'.$find_test_name5['Test']['mrp'].','.$find_test_name6['Test']['testcode'].' - '.$find_test_name6['Test']['test_parameter'].' - Rs.'.$find_test_name6['Test']['mrp'].','.$find_test_name7['Test']['testcode'].' - '.$find_test_name7['Test']['test_parameter'].' - Rs.'.$find_test_name7['Test']['mrp'].','.$find_test_name8['Test']['testcode'].' - '.$find_test_name8['Test']['test_parameter'].' - Rs.'.$find_test_name8['Test']['mrp'].','.$find_test_name9['Test']['testcode'].' - '.$find_test_name9['Test']['test_parameter'].' - Rs.'.$find_test_name9['Test']['mrp'];
						}
						if($count == 10)
						{
							$find_test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$find_test_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$find_test_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$find_test_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
							$find_test_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
							$find_test_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
							$find_test_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
							$find_test_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[7])));
							$find_test_name9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[8])));
							$find_test_name10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[9])));
							$someOneArray['Health']['test_id'] = $find_test_name['Test']['testcode'].' - '.$find_test_name['Test']['test_parameter'].' - Rs.'.$find_test_name['Test']['mrp'].','.$find_test_name2['Test']['testcode'].' - '.$find_test_name2['Test']['test_parameter'].' - Rs.'.$find_test_name2['Test']['mrp'].','.$find_test_name3['Test']['testcode'].' - '.$find_test_name3['Test']['test_parameter'].' - Rs.'.$find_test_name3['Test']['mrp'].','.$find_test_name4['Test']['testcode'].' - '.$find_test_name4['Test']['test_parameter'].' - Rs.'.$find_test_name4['Test']['mrp'].','.$find_test_name5['Test']['testcode'].' - '.$find_test_name5['Test']['test_parameter'].' - Rs.'.$find_test_name5['Test']['mrp'].','.$find_test_name6['Test']['testcode'].' - '.$find_test_name6['Test']['test_parameter'].' - Rs.'.$find_test_name6['Test']['mrp'].','.$find_test_name7['Test']['testcode'].' - '.$find_test_name7['Test']['test_parameter'].' - Rs.'.$find_test_name7['Test']['mrp'].','.$find_test_name8['Test']['testcode'].' - '.$find_test_name8['Test']['test_parameter'].' - Rs.'.$find_test_name8['Test']['mrp'].','.$find_test_name9['Test']['testcode'].' - '.$find_test_name9['Test']['test_parameter'].' - Rs.'.$find_test_name9['Test']['mrp'].','.$find_test_name10['Test']['testcode'].' - '.$find_test_name10['Test']['test_parameter'].' - Rs.'.$find_test_name10['Test']['mrp'];
						}
					}
					$someOneArray['Health']['remark'] = $this->data['Health']['remark'];
					$someOneArray['Health']['remarks'] = $this->data['Health']['remarks'];
					$someOneArray['Health']['address'] = $this->data['Health']['address'];
					$find_pcc_email = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$this->data['Health']['city'])));
					if($this->data['Health']['city'] != '')
					{
						$someOneArray['Health']['city'] = $find_pcc_email['Lab']['pcc_name'];
					}
					$someOneArray['Health']['sample_date'] = $this->data['Health']['sample_date'];
					$someOneArray['Health']['email'] = $UserDetail['User']['email'];
					
					if(!empty($implode_profile))
					{
						$explode_profiles = explode(',',$implode_profile);
						$count_profile = count($explode_profiles);
						if($count_profile == 1)
						{
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'];
						}
						if($count_profile == 2)
						{
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'];
						}
						if($count_profile == 3)
						{
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'];
						}
						if($count_profile == 4)
						{
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$find_profile_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'].','.$find_profile_name4['Test']['testcode'].' - '.$find_profile_name4['Test']['test_parameter'].' - Rs.'.$find_profile_name4['Test']['mrp'];
						}
						if($count_profile == 5)
						{
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$find_profile_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
							$find_profile_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'].','.$find_profile_name4['Test']['testcode'].' - '.$find_profile_name4['Test']['test_parameter'].' - Rs.'.$find_profile_name4['Test']['mrp'].','.$find_profile_name5['Test']['testcode'].' - '.$find_profile_name5['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'];
						}
						if($count_profile == 6)
						{
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$find_profile_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
							$find_profile_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
							$find_profile_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'].','.$find_profile_name4['Test']['testcode'].' - '.$find_profile_name4['Test']['test_parameter'].' - Rs.'.$find_profile_name4['Test']['mrp'].','.$find_profile_name5['Test']['testcode'].' - '.$find_profile_name5['Test']['test_parameter'].' - Rs.'.$find_profile_name5['Test']['mrp'].','.$find_profile_name6['Test']['testcode'].' - '.$find_profile_name6['Test']['test_parameter'].' - Rs.'.$find_profile_name6['Test']['mrp'];
						}
						if($count_profile == 7)
						{
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$find_profile_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
							$find_profile_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
							$find_profile_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
							$find_profile_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'].','.$find_profile_name4['Test']['testcode'].' - '.$find_profile_name4['Test']['test_parameter'].' - Rs.'.$find_profile_name4['Test']['mrp'].','.$find_profile_name5['Test']['testcode'].' - '.$find_profile_name5['Test']['test_parameter'].' - Rs.'.$find_profile_name5['Test']['mrp'].','.$find_profile_name6['Test']['testcode'].' - '.$find_profile_name6['Test']['test_parameter'].' - Rs.'.$find_profile_name6['Test']['mrp'].','.$find_profile_name7['Test']['testcode'].' - '.$find_profile_name7['Test']['test_parameter'].' - Rs.'.$find_profile_name7['Test']['mrp'];
						}
						if($count_profile == 8)
						{
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$find_profile_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
							$find_profile_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
							$find_profile_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
							$find_profile_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
							$find_profile_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[7])));
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'].','.$find_profile_name4['Test']['testcode'].' - '.$find_profile_name4['Test']['test_parameter'].' - Rs.'.$find_profile_name4['Test']['mrp'].','.$find_profile_name5['Test']['testcode'].' - '.$find_profile_name5['Test']['test_parameter'].' - Rs.'.$find_profile_name5['Test']['mrp'].','.$find_profile_name6['Test']['testcode'].' - '.$find_profile_name6['Test']['test_parameter'].' - Rs.'.$find_profile_name6['Test']['mrp'].','.$find_profile_name7['Test']['testcode'].' - '.$find_profile_name7['Test']['test_parameter'].' - Rs.'.$find_profile_name7['Test']['mrp'].','.$find_profile_name8['Test']['testcode'].' - '.$find_profile_name8['Test']['test_parameter'].' - Rs.'.$find_profile_name8['Test']['mrp'];
						}
						if($count_profile == 9)
						{
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$find_profile_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
							$find_profile_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
							$find_profile_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
							$find_profile_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
							$find_profile_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[7])));
							$find_profile_name9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[8])));
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'].','.$find_profile_name4['Test']['testcode'].' - '.$find_profile_name4['Test']['test_parameter'].' - Rs.'.$find_profile_name4['Test']['mrp'].','.$find_profile_name5['Test']['testcode'].' - '.$find_profile_name5['Test']['test_parameter'].' - Rs.'.$find_profile_name5['Test']['mrp'].','.$find_profile_name6['Test']['testcode'].' - '.$find_profile_name6['Test']['test_parameter'].' - Rs.'.$find_profile_name6['Test']['mrp'].','.$find_profile_name7['Test']['testcode'].' - '.$find_profile_name7['Test']['test_parameter'].' - Rs.'.$find_profile_name7['Test']['mrp'].','.$find_profile_name8['Test']['testcode'].' - '.$find_profile_name8['Test']['test_parameter'].' - Rs.'.$find_profile_name8['Test']['mrp'].','.$find_profile_name9['Test']['testcode'].' - '.$find_profile_name9['Test']['test_parameter'].' - Rs.'.$find_profile_name9['Test']['mrp'];
						}
						if($count_profile == 10)
						{
							$find_profile_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$find_profile_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$find_profile_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$find_profile_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
							$find_profile_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
							$find_profile_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
							$find_profile_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
							$find_profile_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[7])));
							$find_profile_name9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[8])));
							$find_profile_name10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[9])));
							$someOneArray['Health']['profile_id'] = $find_profile_name['Test']['testcode'].' - '.$find_profile_name['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'].','.$find_profile_name2['Test']['testcode'].' - '.$find_profile_name2['Test']['test_parameter'].' - Rs.'.$find_profile_name2['Test']['mrp'].','.$find_profile_name3['Test']['testcode'].' - '.$find_profile_name3['Test']['test_parameter'].' - Rs.'.$find_profile_name3['Test']['mrp'].','.$find_profile_name4['Test']['testcode'].' - '.$find_profile_name4['Test']['test_parameter'].' - Rs.'.$find_profile_name4['Test']['mrp'].','.$find_profile_name5['Test']['testcode'].' - '.$find_profile_name5['Test']['test_parameter'].' - Rs.'.$find_profile_name5['Test']['mrp'].','.$find_profile_name6['Test']['testcode'].' - '.$find_profile_name6['Test']['test_parameter'].' - Rs.'.$find_profile_name6['Test']['mrp'].','.$find_profile_name7['Test']['testcode'].' - '.$find_profile_name7['Test']['test_parameter'].' - Rs.'.$find_profile_name7['Test']['mrp'].','.$find_profile_name8['Test']['testcode'].' - '.$find_profile_name8['Test']['test_parameter'].' - Rs.'.$find_profile_name8['Test']['mrp'].','.$find_profile_name9['Test']['testcode'].' - '.$find_profile_name9['Test']['test_parameter'].' - Rs.'.$find_profile_name9['Test']['mrp'].','.$find_profile_name10['Test']['testcode'].' - '.$find_profile_name10['Test']['test_parameter'].' - Rs.'.$find_profile_name['Test']['mrp'];
						}
					}
					
					if(!empty($implode_offer))
					{
						$explode_offers = explode(',',$implode_offer);
						$count_offer = count($explode_offers);
						if($count_offer == 1)
						{
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'];
						}
						if($count_offer == 2)
						{
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$find_offer_name2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'].','.$find_offer_name2['Banner']['banner_code'].' - '.$find_offer_name2['Banner']['banner_name'].' - Rs.'.$find_offer_name2['Banner']['banner_mrp'];
						}
						if($count_offer == 3)
						{
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$find_offer_name2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
							$find_offer_name3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'].','.$find_offer_name2['Banner']['banner_code'].' - '.$find_offer_name2['Banner']['banner_name'].' - Rs.'.$find_offer_name2['Banner']['banner_mrp'].','.$find_offer_name3['Banner']['banner_code'].' - '.$find_offer_name3['Banner']['banner_name'].' - Rs.'.$find_offer_name3['Banner']['banner_mrp'];
						}
						if($count_offer == 4)
						{
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$find_offer_name2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
							$find_offer_name3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
							$find_offer_name4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'].','.$find_offer_name2['Banner']['banner_code'].' - '.$find_offer_name2['Banner']['banner_name'].' - Rs.'.$find_offer_name2['Banner']['banner_mrp'].','.$find_offer_name3['Banner']['banner_code'].' - '.$find_offer_name3['Banner']['banner_name'].' - Rs.'.$find_offer_name3['Banner']['banner_mrp'].','.$find_offer_name4['Banner']['banner_code'].' - '.$find_test_name4['Banner']['banner_name'].' - Rs.'.$find_offer_name4['Banner']['banner_mrp'];
						}
						if($count_offer == 5)
						{
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$find_offer_name2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
							$find_offer_name3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
							$find_offer_name4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
							$find_offer_name5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'].','.$find_offer_name2['Banner']['banner_code'].' - '.$find_offer_name2['Banner']['banner_name'].' - Rs.'.$find_offer_name2['Banner']['banner_mrp'].','.$find_offer_name3['Banner']['banner_code'].' - '.$find_offer_name3['Banner']['banner_name'].' - Rs.'.$find_offer_name3['Banner']['banner_mrp'].','.$find_offer_name4['Banner']['banner_code'].' - '.$find_offer_name4['Banner']['banner_name'].' - Rs.'.$find_offer_name4['Banner']['banner_mrp'].','.$find_offer_name5['Banner']['banner_code'].' - '.$find_offer_name5['Banner']['banner_name'].' - Rs.'.$find_offer_name5['Banner']['banner_mrp'];
						}
						if($count_offer == 6)
						{
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$find_offer_name2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
							$find_offer_name3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
							$find_offer_name4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
							$find_offer_name5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
							$find_offer_name6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[5])));
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'].','.$find_offer_name2['Banner']['banner_code'].' - '.$find_offer_name2['Banner']['banner_name'].' - Rs.'.$find_offer_name2['Banner']['banner_mrp'].','.$find_offer_name3['Banner']['banner_code'].' - '.$find_offer_name3['Banner']['banner_name'].' - Rs.'.$find_offer_name3['Banner']['banner_mrp'].','.$find_offer_name4['Banner']['banner_code'].' - '.$find_offer_name4['Banner']['banner_name'].' - Rs.'.$find_offer_name4['Banner']['banner_mrp'].','.$find_offer_name5['Banner']['banner_code'].' - '.$find_offer_name5['Banner']['banner_name'].' - Rs.'.$find_offer_name5['Banner']['banner_mrp'].','.$find_offer_name6['Banner']['banner_code'].' - '.$find_offer_name6['Banner']['banner_name'].' - Rs.'.$find_offer_name6['Banner']['banner_mrp'];
						}
						if($count_offer == 7)
						{
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$find_offer_name2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
							$find_offer_name3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
							$find_offer_name4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
							$find_offer_name5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
							$find_offer_name6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[5])));
							$find_offer_name7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[6])));
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'].','.$find_offer_name2['Banner']['banner_code'].' - '.$find_offer_name2['Banner']['banner_name'].' - Rs.'.$find_offer_name2['Banner']['banner_mrp'].','.$find_offer_name3['Banner']['banner_code'].' - '.$find_offer_name3['Banner']['banner_name'].' - Rs.'.$find_offer_name3['Banner']['banner_mrp'].','.$find_offer_name4['Banner']['banner_code'].' - '.$find_offer_name4['Banner']['banner_name'].' - Rs.'.$find_offer_name4['Banner']['banner_mrp'].','.$find_offer_name5['Banner']['banner_code'].' - '.$find_offer_name5['Banner']['banner_name'].' - Rs.'.$find_offer_name5['Banner']['banner_mrp'].','.$find_offer_name6['Banner']['banner_code'].' - '.$find_offer_name6['Banner']['banner_name'].' - Rs.'.$find_offer_name6['Banner']['banner_mrp'].','.$find_offer_name7['Banner']['banner_code'].' - '.$find_offer_name7['Banner']['banner_name'].' - Rs.'.$find_offer_name7['Banner']['banner_mrp'];
						}
						if($count_offer == 8)
						{
							$find_offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$find_offer_name2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
							$find_offer_name3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
							$find_offer_name4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
							$find_offer_name5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
							$find_offer_name6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[5])));
							$find_offer_name7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[6])));
							$find_offer_name8 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[7])));
							$someOneArray['Health']['offer_id'] = $find_offer_name['Banner']['banner_code'].' - '.$find_offer_name['Banner']['banner_name'].' - Rs.'.$find_offer_name['Banner']['banner_mrp'].','.$find_offer_name2['Banner']['banner_code'].' - '.$find_offer_name2['Banner']['banner_name'].' - Rs.'.$find_offer_name2['Banner']['banner_mrp'].','.$find_offer_name3['Banner']['banner_code'].' - '.$find_offer_name3['Banner']['banner_name'].' - Rs.'.$find_offer_name3['Banner']['banner_mrp'].','.$find_offer_name4['Banner']['banner_code'].' - '.$find_offer_name4['Banner']['banner_name'].' - Rs.'.$find_offer_name4['Banner']['banner_mrp'].','.$find_offer_name5['Banner']['banner_code'].' - '.$find_offer_name5['Banner']['banner_name'].' - Rs.'.$find_offer_name5['Banner']['banner_mrp'].','.$find_offer_name6['Banner']['banner_code'].' - '.$find_offer_name6['Banner']['banner_name'].' - Rs.'.$find_offer_name6['Banner']['banner_mrp'].','.$find_offer_name7['Banner']['banner_code'].' - '.$find_offer_name7['Banner']['banner_name'].' - Rs.'.$find_offer_name7['Banner']['banner_mrp'].','.$find_offer_name8['Banner']['banner_code'].' - '.$find_offer_name8['Banner']['banner_name'].' - Rs.'.$find_offer_name8['Banner']['banner_mrp'];
						}
					}
					
					
					if(!empty($implode_package))
					{
						$explode_packages = explode(',',$implode_package);
						$count_package = count($explode_packages);
						if($count_package == 1)
						{
							$find_package_name = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
							$someOneArray['Health']['package_id'] = $find_package_name['Package']['package_name'].' - Rs.'.$find_package_name['Package']['package_mrp'];
						}
						if($count_package == 2)
						{
							$find_package_name = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
							$find_package_name2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
							$someOneArray['Health']['package_id'] = $find_package_name['Package']['package_name'].' - Rs.'.$find_package_name['Package']['package_mrp'].','.$find_package_name2['Package']['package_name'].' - Rs.'.$find_package_name2['Package']['package_mrp'];
						}
						if($count_package == 3)
						{
							$find_package_name = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
							$find_package_name2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
							$find_package_name3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[2])));
							$someOneArray['Health']['package_id'] = $find_package_name['Package']['package_name'].' - Rs.'.$find_package_name['Package']['package_mrp'].','.$find_package_name2['Package']['package_name'].' - Rs.'.$find_package_name2['Package']['package_mrp'].','.$find_package_name3['Package']['package_name'].' - Rs.'.$find_package_name3['Package']['package_mrp'];
						}
						if($count_package == 4)
						{
							$find_package_name = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
							$find_package_name2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
							$find_package_name3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[2])));
							$find_package_name4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[3])));
							$someOneArray['Health']['package_id'] = $find_package_name['Package']['package_name'].' - Rs.'.$find_package_name['Package']['package_mrp'].','.$find_package_name2['Package']['package_name'].' - Rs.'.$find_package_name2['Package']['package_mrp'].','.$find_package_name3['Package']['package_name'].' - Rs.'.$find_package_name3['Package']['package_mrp'].','.$find_package_name4['Package']['package_name'].' - Rs.'.$find_package_name4['Package']['package_mrp'];
						}
						if($count_package == 5)
						{
							$find_package_name = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
							$find_package_name2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
							$find_package_name3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[2])));
							$find_package_name4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[3])));
							$find_package_name5 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[4])));
							$someOneArray['Health']['package_id'] = $find_package_name['Package']['package_name'].' - Rs.'.$find_package_name['Package']['package_mrp'].','.$find_package_name2['Package']['package_name'].' - Rs.'.$find_package_name2['Package']['package_mrp'].','.$find_package_name3['Package']['package_name'].' - Rs.'.$find_package_name3['Package']['package_mrp'].','.$find_package_name4['Package']['package_name'].' - Rs.'.$find_package_name4['Package']['package_mrp'].','.$find_package_name5['Package']['package_name'].' - Rs.'.$find_package_name5['Package']['package_mrp'];
						}
					}
					if(!empty($implode_service))
					{
						$explode_service = explode(',',$implode_service);
						$count_service = count($explode_service);
						if($count_service == 1)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'];
						}
						if($count_service == 2)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'];
						}
						if($count_service == 3)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'];
						}
						if($count_service == 4)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$find_service_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'].','.$find_service_name4['Test']['testcode'].' - '.$find_service_name4['Test']['test_parameter'].' - Rs.'.$find_service_name4['Test']['mrp'];
						}
						if($count_service == 5)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$find_service_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
							$find_service_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'].','.$find_service_name4['Test']['testcode'].' - '.$find_service_name4['Test']['test_parameter'].' - Rs.'.$find_service_name4['Test']['mrp'].','.$find_service_name5['Test']['testcode'].' - '.$find_service_name5['Test']['test_parameter'].' - Rs.'.$find_service_name5['Test']['mrp'];
						}
						if($count_service == 6)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$find_service_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
							$find_service_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
							$find_service_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'].','.$find_service_name4['Test']['testcode'].' - '.$find_service_name4['Test']['test_parameter'].' - Rs.'.$find_service_name4['Test']['mrp'].','.$find_service_name5['Test']['testcode'].' - '.$find_service_name5['Test']['test_parameter'].' - Rs.'.$find_service_name5['Test']['mrp'].','.$find_service_name6['Test']['testcode'].' - '.$find_service_name6['Test']['test_parameter'].' - Rs.'.$find_service_name6['Test']['mrp'];
						}
						if($count_service == 7)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$find_service_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
							$find_service_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
							$find_service_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
							$find_service_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[6])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'].','.$find_service_name4['Test']['testcode'].' - '.$find_service_name4['Test']['test_parameter'].' - Rs.'.$find_service_name4['Test']['mrp'].','.$find_service_name5['Test']['testcode'].' - '.$find_service_name5['Test']['test_parameter'].' - Rs.'.$find_service_name5['Test']['mrp'].','.$find_service_name6['Test']['testcode'].' - '.$find_service_name6['Test']['test_parameter'].' - Rs.'.$find_service_name6['Test']['mrp'].','.$find_service_name7['Test']['testcode'].' - '.$find_service_name7['Test']['test_parameter'].' - Rs.'.$find_service_name7['Test']['mrp'];
						}
						if($count_service == 8)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$find_service_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
							$find_service_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
							$find_service_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
							$find_service_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[6])));
							$find_service_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[7])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'].','.$find_service_name4['Test']['testcode'].' - '.$find_service_name4['Test']['test_parameter'].' - Rs.'.$find_service_name4['Test']['mrp'].','.$find_service_name5['Test']['testcode'].' - '.$find_service_name5['Test']['test_parameter'].' - Rs.'.$find_service_name5['Test']['mrp'].','.$find_service_name6['Test']['testcode'].' - '.$find_service_name6['Test']['test_parameter'].' - Rs.'.$find_service_name6['Test']['mrp'].','.$find_service_name7['Test']['testcode'].' - '.$find_service_name7['Test']['test_parameter'].' - Rs.'.$find_service_name7['Test']['mrp'].','.$find_service_name8['Test']['testcode'].' - '.$find_service_name8['Test']['test_parameter'].' - Rs.'.$find_service_name8['Test']['mrp'];
						}
						if($count_service == 9)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$find_service_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
							$find_service_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
							$find_service_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
							$find_service_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[6])));
							$find_service_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[7])));
							$find_service_name9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[8])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'].','.$find_service_name4['Test']['testcode'].' - '.$find_service_name4['Test']['test_parameter'].' - Rs.'.$find_service_name4['Test']['mrp'].','.$find_service_name5['Test']['testcode'].' - '.$find_service_name5['Test']['test_parameter'].' - Rs.'.$find_service_name5['Test']['mrp'].','.$find_service_name6['Test']['testcode'].' - '.$find_service_name6['Test']['test_parameter'].' - Rs.'.$find_service_name6['Test']['mrp'].','.$find_service_name7['Test']['testcode'].' - '.$find_service_name7['Test']['test_parameter'].' - Rs.'.$find_service_name7['Test']['mrp'].','.$find_service_name8['Test']['testcode'].' - '.$find_service_name8['Test']['test_parameter'].' - Rs.'.$find_service_name8['Test']['mrp'].','.$find_service_name9['Test']['testcode'].' - '.$find_service_name9['Test']['test_parameter'].' - Rs.'.$find_service_name9['Test']['mrp'];
						}
						if($count_service == 10)
						{
							$find_service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
							$find_service_name2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
							$find_service_name3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
							$find_service_name4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
							$find_service_name5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
							$find_service_name6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
							$find_service_name7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[6])));
							$find_service_name8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[7])));
							$find_service_name9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[8])));
							$find_service_name10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[9])));
							$someOneArray['Health']['service_id'] = $find_service_name['Test']['testcode'].' - '.$find_service_name['Test']['test_parameter'].' - Rs.'.$find_service_name['Test']['mrp'].','.$find_service_name2['Test']['testcode'].' - '.$find_service_name2['Test']['test_parameter'].' - Rs.'.$find_service_name2['Test']['mrp'].','.$find_service_name3['Test']['testcode'].' - '.$find_service_name3['Test']['test_parameter'].' - Rs.'.$find_service_name3['Test']['mrp'].','.$find_service_name4['Test']['testcode'].' - '.$find_service_name4['Test']['test_parameter'].' - Rs.'.$find_service_name4['Test']['mrp'].','.$find_service_name5['Test']['testcode'].' - '.$find_service_name5['Test']['test_parameter'].' - Rs.'.$find_service_name5['Test']['mrp'].','.$find_service_name6['Test']['testcode'].' - '.$find_service_name6['Test']['test_parameter'].' - Rs.'.$find_service_name6['Test']['mrp'].','.$find_service_name7['Test']['testcode'].' - '.$find_service_name7['Test']['test_parameter'].' - Rs.'.$find_service_name7['Test']['mrp'].','.$find_service_name8['Test']['testcode'].' - '.$find_service_name8['Test']['test_parameter'].' - Rs.'.$find_service_name8['Test']['mrp'].','.$find_service_name9['Test']['testcode'].' - '.$find_service_name9['Test']['test_parameter'].' - Rs.'.$find_service_name9['Test']['mrp'].','.$find_service_name10['Test']['testcode'].' - '.$find_service_name10['Test']['test_parameter'].' - Rs.'.$find_service_name10['Test']['mrp'];
						}
					}
					
					if($this->data['Health']['sample_time'] == 1) {$someOneArray['Health']['sample_time'] = '7:00AM - 7:30AM';}
					if($this->data['Health']['sample_time'] == 2) {$someOneArray['Health']['sample_time'] = '7:30AM - 8:00AM';}
					if($this->data['Health']['sample_time'] == 3) {$someOneArray['Health']['sample_time'] = '8:00AM - 8:30AM';}
					if($this->data['Health']['sample_time'] == 4) {$someOneArray['Health']['sample_time'] = '8:30AM - 9:00AM';}
					if($this->data['Health']['sample_time'] == 5) {$someOneArray['Health']['sample_time'] = '9:00AM - 9:30AM';}
					if($this->data['Health']['sample_time'] == 6) {$someOneArray['Health']['sample_time'] = '9:30AM - 10:00AM';}
					if($this->data['Health']['sample_time'] == 7) {$someOneArray['Health']['sample_time'] = '10:00AM - 10:30AM';}
					if($this->data['Health']['sample_time'] == 8) {$someOneArray['Health']['sample_time'] = '10:30AM - 11:00AM';}
					if($this->data['Health']['sample_time'] == 9) {$someOneArray['Health']['sample_time'] = '11:00AM - 11:30AM';}
					if($this->data['Health']['sample_time'] == 10) {$someOneArray['Health']['sample_time'] = '11:30AM - 12:00PM';}
					if($this->data['Health']['sample_time'] == 11) {$someOneArray['Health']['sample_time'] = '12:00PM - 12:30PM';}
					if($this->data['Health']['sample_time'] == 12) {$someOneArray['Health']['sample_time'] = '12:30PM - 1:00PM';}
					if($this->data['Health']['sample_time'] == 13) {$someOneArray['Health']['sample_time'] = '1:00PM - 1:30PM';}
					if($this->data['Health']['sample_time'] == 14) {$someOneArray['Health']['sample_time'] = '1:30PM - 2:00PM';}
					if($this->data['Health']['sample_time'] == 15) {$someOneArray['Health']['sample_time'] = '2:00PM - 2:30PM';}
					if($this->data['Health']['sample_time'] == 16) {$someOneArray['Health']['sample_time'] = '2:30PM - 3:00PM';}
					if($this->data['Health']['sample_time'] == 17) {$someOneArray['Health']['sample_time'] = '3:00PM - 3:30PM';}
					if($this->data['Health']['sample_time'] == 18) {$someOneArray['Health']['sample_time'] = '3:30PM - 4:00PM';}
					if($this->data['Health']['sample_time'] == 19) {$someOneArray['Health']['sample_time'] = '4:00PM - 4:30PM';}
					if($this->data['Health']['sample_time'] == 20) {$someOneArray['Health']['sample_time'] = '4:30PM - 5:00PM';}
					if($this->data['Health']['sample_time'] == 21) {$someOneArray['Health']['sample_time'] = '5:00PM - 5:30PM';}
					if($this->data['Health']['sample_time'] == 22) {$someOneArray['Health']['sample_time'] = '5:30PM - 6:00PM';}
					if($this->data['Health']['sample_time'] == 23) {$someOneArray['Health']['sample_time'] = '6:00PM - 6:30PM';}
					if($this->data['Health']['sample_time'] == 24) {$someOneArray['Health']['sample_time'] = '6:30PM - 7:00PM';}
					
					if($this->data['Health']['sample_time1'] == 1) {$someOneArray['Health']['sample_time1'] = '7:00AM - 7:30AM';}
					if($this->data['Health']['sample_time1'] == 2) {$someOneArray['Health']['sample_time1'] = '7:30AM - 8:00AM';}
					if($this->data['Health']['sample_time1'] == 3) {$someOneArray['Health']['sample_time1'] = '8:00AM - 8:30AM';}
					if($this->data['Health']['sample_time1'] == 4) {$someOneArray['Health']['sample_time1'] = '8:30AM - 9:00AM';}
					if($this->data['Health']['sample_time1'] == 5) {$someOneArray['Health']['sample_time1'] = '9:00AM - 9:30AM';}
					if($this->data['Health']['sample_time1'] == 6) {$someOneArray['Health']['sample_time1'] = '9:30AM - 10:00AM';}
					if($this->data['Health']['sample_time1'] == 7) {$someOneArray['Health']['sample_time1'] = '10:00AM - 10:30AM';}
					if($this->data['Health']['sample_time1'] == 8) {$someOneArray['Health']['sample_time1'] = '10:30AM - 11:00AM';}
					if($this->data['Health']['sample_time1'] == 9) {$someOneArray['Health']['sample_time1'] = '11:00AM - 11:30AM';}
					if($this->data['Health']['sample_time1'] == 10) {$someOneArray['Health']['sample_time1'] = '11:30AM - 12:00PM';}
					if($this->data['Health']['sample_time1'] == 11) {$someOneArray['Health']['sample_time1'] = '12:00PM - 12:30PM';}
					if($this->data['Health']['sample_time1'] == 12) {$someOneArray['Health']['sample_time1'] = '12:30PM - 1:00PM';}
					if($this->data['Health']['sample_time1'] == 13) {$someOneArray['Health']['sample_time1'] = '1:00PM - 1:30PM';}
					if($this->data['Health']['sample_time1'] == 14) {$someOneArray['Health']['sample_time1'] = '1:30PM - 2:00PM';}
					if($this->data['Health']['sample_time1'] == 15) {$someOneArray['Health']['sample_time1'] = '2:00PM - 2:30PM';}
					if($this->data['Health']['sample_time1'] == 16) {$someOneArray['Health']['sample_time1'] = '2:30PM - 3:00PM';}
					if($this->data['Health']['sample_time1'] == 17) {$someOneArray['Health']['sample_time1'] = '3:00PM - 3:30PM';}
					if($this->data['Health']['sample_time1'] == 18) {$someOneArray['Health']['sample_time1'] = '3:30PM - 4:00PM';}
					if($this->data['Health']['sample_time1'] == 19) {$someOneArray['Health']['sample_time1'] = '4:00PM - 4:30PM';}
					if($this->data['Health']['sample_time1'] == 20) {$someOneArray['Health']['sample_time1'] = '4:30PM - 5:00PM';}
					if($this->data['Health']['sample_time1'] == 21) {$someOneArray['Health']['sample_time1'] = '5:00PM - 5:30PM';}
					if($this->data['Health']['sample_time1'] == 22) {$someOneArray['Health']['sample_time1'] = '5:30PM - 6:00PM';}
					if($this->data['Health']['sample_time1'] == 23) {$someOneArray['Health']['sample_time1'] = '6:00PM - 6:30PM';}
					if($this->data['Health']['sample_time1'] == 24) {$someOneArray['Health']['sample_time1'] = '6:30PM - 7:00PM';}
					$someOneArray['Health']['sample_date1'] = $this->data['Health']['sample_date1'];
					$someOneArray['Health']['address'] = $this->data['Health']['address1'].'*'.$this->data['Health']['address2'];
					if($this->data['Health']['city'] == '')
					{
						$city_name = $this->City->find('first',array('conditions'=>array('City.id'=>$this->data['Health']['city_id'])));
						$someOneArray['Health']['city'] = $city_name['City']['name'];
					}
					if($this->data['Health']['city_id'] != '')
					{
						$this->data['Health']['selecttype'] == 'homecollection';
					}
					$state_name = $this->State->find('first',array('conditions'=>array('State.id'=>$this->data['Health']['state'])));
					$someOneArray['Health']['state'] = $state_name['State']['name'];
					$someOneArray['Health']['locality'] = $this->data['Health']['locality'];
					$someOneArray['Health']['pincode'] = $this->data['Health']['pincode'];
					$someOneArray['Health']['landmark'] = $this->data['Health']['landmark'];
					$someOneArray['Health']['remarks'] = $this->data['Health']['remarks'];
					$someOneArray['Health']['landline'] = $this->data['Health']['landline'];
					//echo "<pre>"; print_r($this->data); exit;
					$this->set('mailContent' , $someOneArray );
					$this->Email->template = 'home_collection1';
					$this->Email->from = $this->data['Health']['email'];
					$this->Email->fromName = $this->data['Health']['name'];
					$this->Email->subject = 'Booking Request';
					if($this->data['Health']['selecttype'] == 'homecollection')
					{
						$this->Email->to = 'tripathi.ashish2007@gmail.com';
					}
					else
					{
						$this->Email->to = $find_pcc_email['Lab']['pcc_email'];
					}
					$this->Email->sendAs = 'html';
					$this->Email->delivery = 'mail';
					if($this->Email->send())
					{
						$update_user_id = $this->Health->query("UPDATE healths SET user_id='".$UserId."' WHERE id='".$last_insert_id."'");
						if($this->data['Health']['requ_type'] == 'visit_lab')
						{
							$number = $this->data['Health']['landline'];
							$get_info_city = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$this->data['Health']['city'])));
							$message = 'Thank you for booking your tests with nirAmaya Healthcare powered by Pathcorp. You have opted for visiting our '.$get_info_city['Lab']['pcc_name'].' Centre '.$get_info_city['Lab']['pcc_address'].' for the tests. Kindly call +91-9555009009 or visit www.niramayahealthcare.com for your test request status updates in "My Account"';
						}
						if($this->data['Health']['requ_type'] == 'home_collection')
						{
							$number = $this->data['Health']['landline'];
							$message = 'Thank you for booking your tests with nirAmaya Healthcare powered by Pathcorp. You have opted for Home Sample collection. Kindly call +91-9555009009 or visit www.niramayahealthcare.com for your test request status updates in "My Account"';
						}
						//$this->__sms_message($number,$message);
						$this->redirect('/tests/checkout/'.$last_insert_id);
					}
					
				}
			}
		}
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));
		$tests = $this->Test->find('all',array('conditions'=>array('Test.status'=>1)));
		$time = $this->Time->find('list',array('conditions'=>array('Time.status'=>1),'fields'=>array('id','name')));
		$time1 = $this->Time->find('list',array('conditions'=>array('Time.status'=>1),'fields'=>array('id','name')));
		$gender = $this->Gender->find('all',array('conditions'=>array('Gender.status'=>1)));
		$city = $this->City->find('list',array('conditions'=>array('City.status'=>1),'fields'=>array('id','name')));
		$this->set('city',$city); 
		$state = $this->State->find('list',array('conditions'=>array('State.status'=>1),'fields'=>array('id','name')));
		$this->set('state',$state); 
		$pcc = $this->Lab->find('all',array('conditions'=>array('Lab.status'=>1)));
		$this->set('pcc',$pcc);
		$this->set('tests',$tests);
		$this->set('time',$time);
		$this->set('time1',$time1);
		$this->set('gender',$gender);
	}
	
	
	function packages()
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','Niramaya Healthcare - Buy Executive Health Check Up, Whole Body Health Check Up Packages at Niramaya Path Lab');
		$this->set('page_description','Niramaya Path Lab offers Executive health check up buy programs and Pre-Employment Health Check-ups and Preventive/buy executive with wholebody Health check-ups. Niramaya Path Lab basic provides a wide range of health screening solutions along with value added services.');
		$this->set('page_keyword','Executive Health Check Up, Health Checkup packages, Buy Executive Health Check Up, Niramaya Basic Health Check Up, Wholebody Health Check Up');
	}
	
	function offers_old()
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','offers');
		$this->Session->delete('email_mess');
		// to not show test records which has been already added to cart
		if(count($this->Session->read('session_banner_type'))>0)
		{
			foreach($this->Session->read('session_banner_type') as $type)
			{
				$exist_banner_id[]= $type['test_id'];
			}
			$check_banner_id = implode(",",$exist_banner_id);
			$banners = $this->Banner->find('all',array('conditions'=>array('Banner.status'=>1 ,'Banner.id NOT IN ('.$check_banner_id.')'),'order'=>array('Banner.id DESC')));
		}else
		{
		$banners = $this->Banner->find('all',array('conditions'=>array('Banner.status'=>1),'order'=>array('Banner.id DESC')));
		}
		//$banners = $this->Banner->find('all',array('conditions'=>array('Banner.status'=>1),'order'=>array('Banner.id DESC')));
		$this->set('banner_count',count($banners));
		$this->set('banners',$banners);
	}
	
	function offers()
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','offers');
		$this->Session->delete('email_mess');
		// to not show test records which has been already added to cart
		if(count($this->Session->read('session_banner_type'))>0)
		{
			foreach($this->Session->read('session_banner_type') as $type)
			{
				$exist_banner_id[]= $type['test_id'];
			}
			$check_banner_id = implode(",",$exist_banner_id);
			$banners = $this->Banner->find('all',array('conditions'=>array('Banner.status'=>1 ,'Banner.id NOT IN ('.$check_banner_id.')'),'order'=>array('Banner.sequence ASC')));
		}else
		{
		$banners = $this->Banner->find('all',array('conditions'=>array('Banner.status'=>1),'order'=>array('Banner.sequence ASC')));
		}
		//$banners = $this->Banner->find('all',array('conditions'=>array('Banner.status'=>1),'order'=>array('Banner.id DESC')));
		$this->set('banner_count',count($banners));
		$this->set('banners',$banners);
	}
	function admin_index()
	{
		$this->Sample = ClassRegistry::init('Sample');
		$this->set('title_for_layout','Manage Client(s)');
		if(isset($this->params['named']['testcode']) && $this->params['named']['testcode']!='')
		{
			$this->data['FilterTest']['test_code'] = $this->params['named']['testcode'];
			$options['testcode'] = $this->params['named']['testcode'];
		}
		if(isset($this->params['named']['testparam']) && $this->params['named']['testparam']!='')
		{
			$this->data['FilterTest']['test_parameter'] = $this->params['named']['testparam'];
			$options['testparam'] = $this->params['named']['testparam'];
		}
		if(isset($this->data) && !empty($this->data))
		{
			$test_code = $this->data['FilterTest']['test_code'];
			$test_param = $this->data['FilterTest']['test_parameter'];
			if(!empty($test_code) && $test_code != '')
			{
				$conditions['Test.testcode LIKE'] = '%'.$test_code.'%';
				$options['testcode'] = $test_code;
			}
			if(!empty($test_param) && $test_param != '')
			{
				$conditions['test_parameter LIKE'] = '%'.$test_param.'%';
				$options['testparam'] = $test_param;
			}
			$conditions['Test.type'] = 'TEST';
			$this->paginate = array('Test' => array('limit' =>'30','order'=>array('Test.add_date'=>'DESC'),'conditions'=>$conditions));
			$testlist=$this->paginate('Test');
			/*if(isset($this->data['Test']['id']) && count($this->data['Test']['id']) && trim($this->data['Page']['mode']) != '')
			{
				$this->update_mode($this->data['Test']['id'], $this->data['Page']['mode']);
			} 
			else 
			{
				$this->Session->setFlash('Please select atlest one Test(s) to perform any action','flash_failure');
			}*/
		}	
		else
		{
			$this->paginate = array('Test' => array('limit' =>'30','order'=>array('Test.add_date'=>'DESC'),'conditions'=>array('Test.type'=>'TEST')));
			$testlist=$this->paginate('Test');
		}
		$k=0;
		
		foreach($testlist as $key=>$val)
		{
			$samplename = $this->Sample->query("select * from sample_type_master where sample_id=".$val['Test']['sample']." or type like '".$val['Test']['sample']."'");
			if(!empty($samplename)){
			$testlist[$k]['Test']['sample'] = $samplename[0]['sample_type_master']['type'];
			}
			$k++;
		}
		$this->set('test_code',$test_code);
		$this->set('test_param',$test_param);
		$this->set('options',$options);	
		$this->set('testlist',$testlist);
	}
	
	function admin_add_test()
	{
		$this->Sample = ClassRegistry::init('Sample');
		$this->DocumentTypeMaster = ClassRegistry::init('DocumentTypeMaster');

		$doc_list = $this->DocumentTypeMaster->find('list',array('fields'=>array('id','name')));

		$this->set('doc_list',$doc_list);

		$samples = $this->Sample->query("select sample_id,type from sample_type_master");
		
		$sampleList = array();
		foreach($samples as $val)
		{
			$sampleList[$val['sample_type_master']['sample_id']] = $val['sample_type_master']['type'];
		}
		$this->set('samplelist',$sampleList);
		
		$this->set('title_for_layout', 'Test(s) List');
		if(!empty($this->data))
		{
			if(!empty($this->data['Test']['description_pdf']['name']))
			{
				$hfile = $this->File->uploadFile($this->data['Test']['description_pdf'], TEST_PDF_STORE_PATH, true,array('jpg','jpe','jpeg','gif','png','JPG','JPE','JPEG','GIF','PNG','PDF','pdf'));
				$this->data['Test']['file_name'] = $hfile['name'];
			}
			$this->data['Test']['type'] = 'TEST';
			$this->data['Test']['add_date'] = date('Y-m-d H:i:s');
			$this->data['Test']['status'] = 1;
			if($this->Test->create($this->data))
			{
				if($this->Test->save($this->data,false))
				{
					$last_insert_id = $this->Test->getLastInsertId();
					//$this->Session->setFlash('Test saved successfully','flash_success');
					$this->redirect(array('controller'=>'tests','action'=>'add_spec_dis',base64_encode($last_insert_id)));	
				}
			}
		}
		$package_type = $this->PackageType->find('all',array('conditions'=>array('PackageType.status'=>1),'fields'=>array('id','name'),'order'=>array('PackageType.id ASC')));
		$p_type = array();
		foreach($package_type as $val)
		{
			$p_type[$val['PackageType']['id']] = $val['PackageType']['name'];
		}
		$this->set('visit_type',array('none'=>'None','clinic'=>'Clinic','home'=>'Home','both'=>'Both'));
		$this->set('package_type',$p_type);
		$this->set('profit_category',$this->_getProfitCategory());
	}
	
	function admin_add_spec_dis($test_id=NULL)
	{
		$test_id_dec = base64_decode($test_id);
		if(!empty($this->data))
		{
		    $this->data['Test']['gender'] = implode(',',$this->data['Test']['gender']);
		    $this->data['Test']['age_group'] = implode(',',$this->data['Test']['age_group']);
		    $this->data['Test']['symptoms'] = implode(',',$this->data['Test']['symptoms']);
			$this->data['Test']['speciality'] = implode(',',$this->data['Test']['speciality']);
			$this->data['Test']['disease'] = implode(',',$this->data['Test']['disease']);
			if($this->Test->create($this->data))
			{
				$update_spec_disease = $this->Test->query("UPDATE tests SET gender ='".$this->data['Test']['gender']."', age_group ='".$this->data['Test']['age_group']."', symptoms ='".$this->data['Test']['symptoms']."', speciality='".$this->data['Test']['speciality']."',disease='".$this->data['Test']['disease']."' WHERE id='".$this->data['Test']['insert_id']."'");
				$this->Session->setFlash('Test saved successfully','flash_success');
				$this->redirect(array('controller'=>'tests','action'=>'index'));
			}
		}
		$symptoms = $this->Symptoms->find('all',array('conditions'=>array('Symptoms.status'=>1),'fields'=>array('id','name')));
		$agegroup = $this->AgeGroup->find('all',array('conditions'=>array('AgeGroup.status'=>1),'fields'=>array('id','name','category')));
		$gender = $this->Gender->find('all',array('conditions'=>array('Gender.status'=>1),'fields'=>array('id','name')));
		$test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$test_id_dec)));
		$speciality = $this->Speciality->find('all',array('conditions'=>array('Speciality.status'=>1),'fields'=>array('id','name'),'order'=>array('Speciality.name ASC')));
		$disease = $this->Disease->find('all',array('conditions'=>array('Disease.status'=>1),'fields'=>array('id','name'),'order'=>array('Disease.name ASC')));
		$this->set('symptoms',$symptoms);
		$this->set('agegroup',$agegroup);
		$this->set('gender',$gender);
		$this->set('speciality',$speciality);
		$this->set('disease',$disease);
		$this->set('test_id_dec',$test_id_dec);
		$this->set('testCode',$test_detail['Test']['testcode']);
		$this->set('testParam',$test_detail['Test']['test_parameter']);
	}
	
	function admin_edit_test($testId=NULL)
	{
		$samples = $this->Sample->query("select sample_id,type from sample_type_master");
		
		$this->DocumentTypeMaster = ClassRegistry::init('DocumentTypeMaster');

		$sampleList = array();
		foreach($samples as $val)
		{
			$sampleList[$val['sample_type_master']['sample_id']] = $val['sample_type_master']['type'];
		}
		$this->set('samplelist',$sampleList);
		
		$this->set('title_for_layout', 'Edit Test');
		$test_id = base64_decode($testId);
		if(!empty($this->data))
		{
			//echo "<pre>"; print_r($this->data); exit;
			if(!empty($this->data['Test']['description_pdf']['name']))
			{
				$hfile = $this->File->uploadFile($this->data['Test']['description_pdf'], TEST_PDF_STORE_PATH, true,array('jpg','jpe','jpeg','gif','png','JPG','JPE','JPEG','GIF','PNG','PDF','pdf'));
				$this->data['Test']['file_name'] = $hfile['name'];
				$this->File->deleteFile(TEST_PDF_STORE_PATH.$this->data['Test']['old_file_name']);
			}
			if(empty($this->data['Test']['description_pdf']['name']))
			{
				$this->data['Test']['file_name'] = $this->data['Test']['old_file_name'];
			}
			if($this->Test->create($this->data))
			{
				if($this->Test->save($this->data,false))
				{
					if(!empty($this->data['Test']['submit_type']) && $this->data['Test']['submit_type'] == 'using_link')
					{
						$this->redirect(array('controller'=>'tests','action'=>'edit_spec_dise',$testId));
					}
					else
					{
						$this->Session->setFlash('Test updated successfully','flash_success');
						$this->redirect(array('controller'=>'tests','action'=>'index'));
					}
				}
			}
		}
		else
		{
			$test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$test_id)));
			
			$doc_list = $this->DocumentTypeMaster->find('list',array('fields'=>array('id','name')));

			$this->set('doc_list',$doc_list);

			//$docs = $this->DocumentTypeMaster->find('all',array('conditions'=>array('DocumentTypeMaster.id IN'=>explode(',',$test_detail['Test']['document_list']))));
			$docs = $this->DocumentTypeMaster->query("Select * from document_type_master where id in (".$test_detail['Test']['document_list'].")");
			$doc_html = "";
			
			foreach($docs as $val)
			{
				$doc_html.= "<div id='doc_".$val['document_type_master']['id']."'>".$val['document_type_master']['name']."<a href='javascript:void(0);' onclick='delete_doc(".$val['document_type_masterdocument_type_master']['id'].")' style='font-weight:bold; color:#FF0000; text-decoration:none;'>[X]</a></div>";
			}	
			
			$this->set('doc_html',$doc_html);
			$explode_speciality = explode(',',$test_detail['Test']['speciality']);
			$explode_disease = explode(',',$test_detail['Test']['disease']);
			$test_detail['Test']['speciality_name'] = array();
			$test_detail['Test']['disease_name'] = array();
			if(!empty($test_detail['Test']['speciality']) && $test_detail['Test']['speciality'] != '')
			{
				foreach($explode_speciality as $key => $val)
				{
					$speciality_name = $this->Speciality->find('first',array('conditions'=>array('Speciality.id'=>$val)));
					$test_detail['Test']['speciality_name'][] = $speciality_name['Speciality']['name'];
				}
			}
			else
			{
				$test_detail['Test']['speciality_name'] = '';
			}
			if(!empty($test_detail['Test']['disease']) && $test_detail['Test']['disease'] != '')
			{
				foreach($explode_disease as $key => $val)
				{
					$speciality_name = $this->Disease->find('first',array('conditions'=>array('Disease.id'=>$val)));
					$test_detail['Test']['disease_name'][] = $speciality_name['Disease']['name'];
				}
			}
			else
			{
				$test_detail['Test']['disease_name'] = '';
			}
			
			$this->data=$test_detail;
			//echo "<pre>"; print_r($this->data); exit;
		}
		$package_type = $this->PackageType->find('all',array('conditions'=>array('PackageType.status'=>1),'fields'=>array('id','name'),'order'=>array('PackageType.id ASC')));
		$speciality = $this->Speciality->find('all',array('conditions'=>array('Speciality.status'=>1),'fields'=>array('id','name'),'order'=>array('Speciality.name ASC')));
		$disease = $this->Disease->find('all',array('conditions'=>array('Disease.status'=>1),'fields'=>array('id','name'),'order'=>array('Disease.name ASC')));
		//print_R($package_type);die;
		$p_type = array();
		foreach($package_type as $val)
		{
			$p_type[$val['PackageType']['id']] = $val['PackageType']['name'];
		}
		$this->set('package_type',$p_type);
		$this->set('speciality',$speciality);
		$this->set('disease',$disease);
        $this->set('profit_category',$this->_getProfitCategory());
        $this->set('visit_type',array('none'=>'None','clinic'=>'Clinic','home'=>'Home','both'=>'Both'));
	}
	
	function admin_edit_spec_dise($test_id=NULL)
	{
		$dec_test_id = base64_decode($test_id);
		if(!empty($this->data))
		{
		    $this->data['Test']['gender'] = implode(',',$this->data['Test']['gender']);
		    $this->data['Test']['age_group'] = implode(',',$this->data['Test']['age_group']);
		    $this->data['Test']['symptoms'] = implode(',',$this->data['Test']['symptoms']);
			$this->data['Test']['speciality'] = implode(',',$this->data['Test']['speciality']);
			$this->data['Test']['disease'] = implode(',',$this->data['Test']['disease']);
			if($this->Test->create($this->data))
			{
				$update_spec_disease = $this->Test->query("UPDATE tests SET gender ='".$this->data['Test']['gender']."', age_group ='".$this->data['Test']['age_group']."', symptoms ='".$this->data['Test']['symptoms']."', speciality='".$this->data['Test']['speciality']."',disease='".$this->data['Test']['disease']."' WHERE id='".$this->data['Test']['insert_id']."'");
				$this->Session->setFlash('Test updated successfully','flash_success');
				$this->redirect(array('controller'=>'tests','action'=>'index'));
			}
		}
		$test_info = $this->Test->find('first',array('conditions'=>array('Test.id'=>$dec_test_id)));
		$explode_speciality = explode(',',$test_info['Test']['speciality']);
		$explode_disease = explode(',',$test_info['Test']['disease']);
		$explode_gender = explode(',',$test_info['Test']['gender']);
		$explode_agegroup = explode(',',$test_info['Test']['age_group']);
		$explode_symptoms = explode(',',$test_info['Test']['symptoms']);
		$test_info['Test']['gender']=array();
		$test_info['Test']['age_group']=array();
		$test_info['Test']['symptoms']=array();
		$test_info['Test']['speciality'] = array();
		$test_info['Test']['disease'] = array();
		//print_R($test_info);
		foreach($explode_gender as $key => $val)
		{
			$test_info['Test']['gender'][] = $val;
		}
		foreach($explode_agegroup as $key => $val)
		{
			$test_info['Test']['age_group'][] = $val;
		}
		foreach($explode_symptoms as $key => $val)
		{
			$test_info['Test']['symptoms'][] = $val;
		}
		foreach($explode_speciality as $key => $val)
		{
			$test_info['Test']['speciality'][] = $val;
		}
		foreach($explode_disease as $key => $val)
		{
			$test_info['Test']['disease'][] = $val;
		}	
		$this->data=$test_info;
		$symptoms = $this->Symptoms->find('all',array('conditions'=>array('Symptoms.status'=>1),'fields'=>array('id','name')));
		$agegroup = $this->AgeGroup->find('all',array('conditions'=>array('AgeGroup.status'=>1),'fields'=>array('id','name','category')));
		$gender = $this->Gender->find('all',array('conditions'=>array('Gender.status'=>1),'fields'=>array('id','name')));
		$test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$dec_test_id)));
		$speciality = $this->Speciality->find('all',array('conditions'=>array('Speciality.status'=>1),'fields'=>array('id','name'),'order'=>array('Speciality.name ASC')));
		$disease = $this->Disease->find('all',array('conditions'=>array('Disease.status'=>1),'fields'=>array('id','name'),'order'=>array('Disease.name ASC')));
		//print_R($test_info);die;
		$this->set('symptoms',$symptoms);
		$this->set('agegroup',$agegroup);
		$this->set('gender',$gender);
		$this->set('speciality',$speciality);
		$this->set('disease',$disease);
		$this->set('dec_test_id',$dec_test_id);
		$this->set('testCode',$test_detail['Test']['testcode']);
		$this->set('testParam',$test_detail['Test']['test_parameter']);
	}
	
	
	function update_mode($data, $mode){
		switch($mode){
			case 'activate':
				$countRecords = count($data);
				for($ctr=0;$ctr<$countRecords;$ctr++){
					if($data[$ctr]){
						$this->Test->id = $data[$ctr];
						$this->Test->saveField('status', '1');
					}
				}
				// set message
				$this->Session->setFlash('Test(s) have been activated','flash_success');
				$this->redirect(array('controller'=>'tests','action'=>'index'));
				break;
				case 'deactivate':
				$countRecords = count($data);
				for($ctr=0;$ctr<$countRecords;$ctr++){
					if($data[$ctr]){
						$this->Test->id = $data[$ctr];
						$this->Test->saveField('status', '0');
					}
				}
				// set message
				$this->Session->setFlash('Test(s) have been deactivated','flash_success');
				$this->redirect(array('controller'=>'tests','action'=>'index'));
				break;
				case 'delete':
				$countRecords = count($data);
				for($ctr=0;$ctr<$countRecords;$ctr++){
					if($data[$ctr]){
						$this->Test->delete($data[$ctr]);
					}
				}
				// set message
				$this->Session->setFlash('Test(s) have been deleted','flash_success');
				$this->redirect(array('controller'=>'tests','action'=>'index'));
				break;
			break;
		}
	}
	
	function call_back($id=NULL)
	{
		$this->Call=ClassRegistry::init('Call');
		$encoded_mess_url = base64_decode($messg);
		if(!empty($encoded_mess_url) && $encoded_mess_url == 'Thank You For Your time we will be calling you soon')
		{
			$this->set('cll_msg',$encoded_mess_url);
		}
		
		
		if(!empty($id))
		{
			if(!empty($this->data))
			{
				
				$this->Session->delete('email_mess');
				$this->data['Call']['name'] = $this->data['Enquiry']['name'.$id];
				$this->data['Call']['phone'] = $this->data['Enquiry']['phone'.$id];
				$this->data['Call']['message'] = $this->data['Enquiry']['message'.$id];
				//echo "<pre>"; print_r($this->data); exit;
				if($this->Call->create($this->data))
				{
					if($this->Call->save($this->data,false))
					{
						$someOneArray = array();
						$someOneArray['Call']['name'] = $this->data['Call']['name'];
						$someOneArray['Call']['phone'] = $this->data['Call']['phone'];
						$someOneArray['Call']['message'] = $this->data['Call']['message'];
						$this->set('mailContent' , $someOneArray );
						$this->Email->template = 'call';
						$this->Email->from = 'info@niramayahealthcare.com';
						$this->Email->fromName = 'Niramaya Offers';
						$this->Email->subject = 'Offer Enquiry';
						$this->Email->to = 'tripathi.ashish2007@gmail.com';
						$this->Email->sendAs = 'html'; // because we like to send pretty mail
						$this->Email->delivery = 'mail';
						if($this->Email->send())
						{
							$bcm_msg = base64_encode('Thank You For Your time we will be calling you soon');
							$this->redirect('/tests/offers');
						}
					}
				}
			}
		}
		
	}
	
	function search()
	{
		$this->layout = 'tests';
		$this->set('title_for_layout', 'Search Test');
		$testcodes = $this->Test->find('list',array('fields'=>array('id','testcode'),'order'=>array('Test.testcode ASC'),'conditions'=>array('LENGTH(testcode) >= '=>1,'Test.status'=>'1')));
		$this->set('search_type','Test');
		$this->set('testcodes',$testcodes);
		$speciality = $this->Speciality->find('list',array('conditions'=>array('Speciality.status'=>1)));
		$diseases = $this->Disease->find('list',array('conditions'=>array('Disease.status'=>1)));
		$this->set('speciality',$speciality);
		$this->set('diseases',$diseases);
		$this->set('search_type','Test');
		
		$keyword_search_home = $this->Session->read('keyword_home_search');
		//echo "<pre>"; print_r($keyword_search_home); exit;
                
		if(!empty($keyword_search_home))
		{
			$this->set('home_keyword',$keyword_search_home);
		}
		
		$this->Session->delete('keyword_home_search');
		
	}
	
	function search_alphabet()
	{
		$alphabet = $_REQUEST['char'];
		// to not show test records which has been already added to cart
		if(count($this->Session->read('session_test_type'))>0)
		{
			foreach($this->Session->read('session_test_type') as $type)
			{
				$exist_test_id[]= $type['test_id'];
			}
			$check_id = implode(",",$exist_test_id);
			$find_tests = $this->Test->find('all',array('conditions'=>array('Test.status'=>1,'Test.id NOT IN ('.$check_id.')' ,'Test.test_parameter LIKE'=>$alphabet.'%'),'fields'=>array('id','testcode','test_parameter','type','mrp','reporting')));
		    $find_tests_2 = $this->Test->find('all',array('conditions'=>array('Test.status'=>1,'Test.id NOT IN ('.$check_id.')' , 'Test.test_parameter LIKE'=>'('.$alphabet.'%'),'fields'=>array('id','testcode','test_parameter','type')));
		}else
		{
		$find_tests = $this->Test->find('all',array('conditions'=>array('Test.status'=>1,'Test.test_parameter LIKE'=>$alphabet.'%'),'fields'=>array('id','testcode','test_parameter','type','mrp','reporting')));
		$find_tests_2 = $this->Test->find('all',array('conditions'=>array('Test.status'=>1,'Test.test_parameter LIKE'=>'('.$alphabet.'%'),'fields'=>array('id','testcode','test_parameter','type')));
		}
		if(!empty($find_tests) || !empty($find_tests_2))
		{
			$count_test_1 = count($find_tests);
			$count_test_2 = count($find_tests_2);
			$total_count = ( $count_test_1+$count_test_2 );
			$x['test_count'] = $total_count;
			$x['search_alphabet'] = $alphabet;
			$x['success'] = 'success';
			$x['test_list'] = $find_tests;
			$x['test_list2'] = $find_tests_2;
			$m['test_info'] = $x;
			echo json_encode($m);
		}
		else
		{
			$count_test_1 = count($find_tests);
			$count_test_2 = count($find_tests_2);
			$total_count = ( $count_test_1+$count_test_2 );
			$x['test_count'] = $total_count;
			$x['search_alphabet'] = $alphabet;
			$x['success'] = 'notsuccess';
			$m['test_info'] = $x;
			echo json_encode($m);	
		}
		exit;
	}
	
	function search_data()
	{
		//print_R(json_encode($this->data));die;
		$search_criteria_1 = $this->data['Search']['speciality'];
		$search_criteria_2 = $this->data['Search']['disease'];
		$search_criteria_3 = $this->data['Search']['code'];
		$search_type = $this->data['Search']['search_type'];
		
		if(!empty($search_criteria_1) && empty($search_criteria_2) && empty($search_criteria_3))
		{
			$search_test_1 = $this->Test->find('all',array('conditions'=>array('Test.speciality'=>$search_criteria_1)));
			$search_test_2 = $this->Test->find('all',array('conditions'=>array('Test.speciality LIKE'=>'%'.','.$search_criteria_1.','.'%')));
			$search_test_3 = $this->Test->find('all',array('conditions'=>array('Test.speciality LIKE'=>$search_criteria_1.','.'%')));
			$search_test_4 = $this->Test->find('all',array('conditions'=>array('Test.speciality LIKE'=>'%'.','.$search_criteria_1)));
			$x['count_test'] = (count($search_test_1)+count($search_test_2)+count($search_test_3)+count($search_test_4));
			$x['success'] = 'success';
			$x['search_list_1'] = $search_test_1;
			$x['search_list_2'] = $search_test_2;
			$x['search_list_3'] = $search_test_3;
			$x['search_list_4'] = $search_test_4;
			$m['search_info'] = $x;
		}
		if(empty($search_criteria_1) && !empty($search_criteria_2) && empty($search_criteria_3))
		{
			$search_test_1 = $this->Test->find('all',array('conditions'=>array('Test.disease'=>$search_criteria_2)));
			$search_test_2 = $this->Test->find('all',array('conditions'=>array('Test.disease LIKE'=>'%'.','.$search_criteria_2.','.'%')));
			$search_test_3 = $this->Test->find('all',array('conditions'=>array('Test.disease LIKE'=>$search_criteria_2.','.'%')));
			$search_test_4 = $this->Test->find('all',array('conditions'=>array('Test.disease LIKE'=>'%'.','.$search_criteria_2)));
			$x['count_test'] = (count($search_test_1)+count($search_test_2)+count($search_test_3)+count($search_test_4));
			$x['success'] = 'success';
			$x['search_list_1'] = $search_test_1;
			$x['search_list_2'] = $search_test_2;
			$x['search_list_3'] = $search_test_3;
			$x['search_list_4'] = $search_test_4;
			$m['search_info'] = $x;
		}
		if(empty($search_criteria_1) && empty($search_criteria_2) && !empty($search_criteria_3))
		{
			$search_test_1 = $this->Test->find('all',array('conditions'=>array('Test.id'=>$search_criteria_3)));
			$x['count_test'] = count($search_test_1);
			$x['success'] = 'success';
			$x['search_list_1'] = $search_test_1;
			$x['search_list_2'] = '';
			$x['search_list_3'] = '';
			$x['search_list_4'] = '';
			$m['search_info'] = $x;
			
		}
		if(!empty($search_criteria_1) && !empty($search_criteria_2) && empty($search_criteria_3))
		{
			$search_test_1 = $this->Test->find('all',array('conditions'=>array('Test.speciality'=>$search_criteria_1,'Test.disease'=>$search_criteria_2)));
			$search_test_2 = $this->Test->find('all',array('conditions'=>array('Test.speciality LIKE'=>'%'.','.$search_criteria_1.','.'%','Test.disease LIKE'=>'%'.','.$search_criteria_2.','.'%')));
			$search_test_3 = $this->Test->find('all',array('conditions'=>array('Test.speciality LIKE'=>$search_criteria_1.','.'%','Test.disease LIKE'=>$search_criteria_2.','.'%')));
			$search_test_4 = $this->Test->find('all',array('conditions'=>array('Test.speciality LIKE'=>'%'.','.$search_criteria_1,'Test.disease LIKE'=>'%'.','.$search_criteria_2)));
			$x['count_test'] = (count($search_test_1)+count($search_test_2)+count($search_test_3)+count($search_test_4));
			$x['success'] = 'success';
			$x['search_list_1'] = $search_test_1;
			$x['search_list_2'] = $search_test_2;
			$x['search_list_3'] = $search_test_3;
			$x['search_list_4'] = $search_test_4;
			$m['search_info'] = $x;
			
		}
		if(!empty($search_criteria_1) && empty($search_criteria_2) && !empty($search_criteria_3))
		{
			$search_test_1 = $this->Test->find('all',array('conditions'=>array('Test.speciality'=>$search_criteria_1,'Test.id'=>$search_criteria_3)));
			$search_test_2 = $this->Test->find('all',array('conditions'=>array('Test.speciality LIKE'=>'%'.','.$search_criteria_1.','.'%','Test.id'=>$search_criteria_3)));
			$search_test_3 = $this->Test->find('all',array('conditions'=>array('Test.speciality LIKE'=>$search_criteria_1.','.'%','Test.id'=>$search_criteria_3)));
			$search_test_4 = $this->Test->find('all',array('conditions'=>array('Test.speciality LIKE'=>'%'.','.$search_criteria_1,'Test.id'=>$search_criteria_3)));
			$x['count_test'] = (count($search_test_1)+count($search_test_2)+count($search_test_3)+count($search_test_4));
			$x['success'] = 'success';
			$x['search_list_1'] = $search_test_1;
			$x['search_list_2'] = $search_test_2;
			$x['search_list_3'] = $search_test_3;
			$x['search_list_4'] = $search_test_4;
			$m['search_info'] = $x;
			
		}
		if(empty($search_criteria_1) && !empty($search_criteria_2) && !empty($search_criteria_3))
		{
			$search_test_1 = $this->Test->find('all',array('conditions'=>array('Test.disease'=>$search_criteria_2,'Test.id'=>$search_criteria_3)));
			$search_test_2 = $this->Test->find('all',array('conditions'=>array('Test.disease LIKE'=>'%'.','.$search_criteria_2.','.'%','Test.id'=>$search_criteria_3)));
			$search_test_3 = $this->Test->find('all',array('conditions'=>array('Test.disease LIKE'=>$search_criteria_2.','.'%','Test.id'=>$search_criteria_3)));
			$search_test_4 = $this->Test->find('all',array('conditions'=>array('Test.disease LIKE'=>'%'.','.$search_criteria_2,'Test.id'=>$search_criteria_3)));
			$x['count_test'] = (count($search_test_1)+count($search_test_2)+count($search_test_3)+count($search_test_4));
			$x['success'] = 'success';
			$x['search_list_1'] = $search_test_1;
			$x['search_list_2'] = $search_test_2;
			$x['search_list_3'] = $search_test_3;
			$x['search_list_4'] = $search_test_4;
			$m['search_info'] = $x;
		}
		if(!empty($search_criteria_1) && !empty($search_criteria_2) && !empty($search_criteria_3))
		{
			$search_test_1 = $this->Test->find('all',array('conditions'=>array('Test.speciality'=>$search_criteria_1,'Test.disease'=>$search_criteria_2,'Test.id'=>$search_criteria_3,'Test.type'=>'TEST')));
			$search_test_2 = $this->Test->find('all',array('conditions'=>array('Test.speciality LIKE'=>'%'.','.$search_criteria_1.','.'%','Test.disease LIKE'=>'%'.','.$search_criteria_2.','.'%','Test.id'=>$search_criteria_3,'Test.type'=>'TEST')));
			$search_test_3 = $this->Test->find('all',array('conditions'=>array('Test.speciality LIKE'=>$search_criteria_1.','.'%','Test.disease LIKE'=>$search_criteria_2.','.'%','Test.id'=>$search_criteria_3,'Test.type'=>'TEST')));
			$search_test_4 = $this->Test->find('all',array('conditions'=>array('Test.speciality LIKE'=>'%'.','.$search_criteria_1,'Test.disease LIKE'=>'%'.','.$search_criteria_2,'Test.id'=>$search_criteria_3,'Test.type'=>'TEST')));
			$x['count_test'] = (count($search_test_1)+count($search_test_2)+count($search_test_3)+count($search_test_4));
			$x['success'] = 'success';
			$x['search_list_1'] = $search_test_1;
			$x['search_list_2'] = $search_test_2;
			$x['search_list_3'] = $search_test_3;
			$x['search_list_4'] = $search_test_4;
			$m['search_info'] = $x;
		}
		if(empty($search_criteria_1) && empty($search_criteria_2) && empty($search_criteria_3))
		{
			$x['count_test'] = 0;
			$x['success'] = 'notsuccess';
			$m['search_info'] = $x;
		}
		echo json_encode($m);
		exit;
	}

	function test_detail($id = NULL){
        $this->layout = 'tests';
		$this->Observation = ClassRegistry::init('Observation');
		$this->Test = ClassRegistry::init('Test');
		$this->TestDetails = ClassRegistry::init('TestDetails');
		$this->set('title_for_layout', 'Search Test');
		$dataview = $this->Test->read(NULL, $id);
		$this->set('dataView', $dataview);
		$category = $this->_getProfitCategory();
		$components = array();
		$testdetails = $this->TestDetails->find('first',array('conditions'=>array('TestDetails.test_id'=>$dataview['Test']['id'])));
		//print_R("Select * from tests where testcode in (".$dataview['Test']['testscode'].")");
		$observations = $this->Observation->query("Select * from observations where observation_id in (".$dataview['Test']['observation_id'].")");
		
		$this->Sample = ClassRegistry::init('Sample');
		$sample_ids = explode(",",$dataview['Test']['sample']);
		$samples = array();
		foreach($sample_ids as $val){
			$sample = $this->Sample->query("select type from sample_type_master where sample_id = '".$val."' limit 1");
			array_push($samples,$sample[0]['sample_type_master']['type']);
		}
		//print_R(implode(",",$samples));die;
		//$samples = $this->Sample->query("select GROUP_CONCAT(type) as sample_type from sample_type_master where sample_id in (".$dataview['Test']['sample'].") or type in (".$dataview['Test']['sample'].")");
		//print_R($samples);die;
		$tests = $this->Test->query("Select * from tests where id in (".$dataview['Test']['testscode'].")");
		//print_R($tests);die;
		$obs_count = 1;
		$x['obs_data'] = '';
		if($dataview['Test']['type'] == 'PROFILE' && !empty($dataview['Test']['testscode']))
		{
			foreach($tests as $val)
			{
				$components[$obs_count]['name'] = $val['tests']['test_parameter'];
				$count_obs = explode(',',$val['tests']['test_parameter']);
				
				$components[$obs_count]['count'] = count($count_obs);
				$obs_count++;
			}
		}
		else
		{
			foreach($observations as $val)
			{
				if($val['observations']['nabl']=='1')
					$components[$obs_count] = $val['observations']['observation_name']." *";
				else
					$components[$obs_count] = $val['observations']['observation_name'];
				$obs_count++;
			}
		}

		//print_R($components);die;
		$this->set('testDetails',$testdetails['TestDetails']);
		$this->set('sampleType',implode(",",$samples));
		$this->set('component',$components);
		$this->set('category',$category[$dataview['Test']['profit_margin_category']]);
	}
	
	private function createRequestTePr($h_id)
	{
		$tests = $this->Session->read('session_test');
		$this->Health = ClassRegistry::init('Health');
		foreach($tests as $val)
		{
			$total = $total + $val['Cart']['test_mrp'];
		
			$this->Test = ClassRegistry::init('Test');
			$data = $this->Test->find('all',array('fields'=>array('id','type','mrp'),'conditions'=>array('Test.testcode'=>$val['Cart']['test_code'],'Test.status'=>1)));
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
					$this->data['RequestTest']['health_id'] = $h_id;
					$this->data['RequestTest']['test_id'] = $value['Test']['id'];
					$this->data['RequestTest']['mrp'] = $value['Test']['mrp'];
					$this->data['RequestTest']['test_book_date'] = date('Y-m-d H:i:s');
					$this->data['RequestTest']['status'] = 1;  
					$this->_order_total_amt += $value['Test']['mrp'];

					//print_R($this->data);die;
					$this->RequestTest->create();
					//$this->RequestTest->save($this->data);
					if($this->RequestTest->save($this->data))
					{
						$healthdata = $this->Health->find('first',array('conditions'=>array('Health.id'=>$h_id)));
						if($healthdata['Health']['total_amount']!=0)
						{
							$this->redirect('/tests/checkout/'.$h_id);
						}
						else
						{
							$this->cod_order($h_id);
						}
					}
					else
					{
						$this->Session->setFlash('Error Saving Tests','flash_failure'); 
					}
				}
			}
		}
	}
	
	function cod_order($h_id)
	{
		//echo "in cod_order";die;
		$this->Health = ClassRegistry::init('Health');
		$this->Billing = ClassRegistry::init('Billing');
		
		$this->data = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$h_id)));
		
		$timeslot = Configure::Read("TimeSlot");
		
		$request_info_insrt = $this->Health->find('first',array('conditions'=>array('Health.id'=>$h_id)));
		if($request_info_insrt['Health']['assigned_lab'] != 'Home')
		{
			$get_info_lab = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$request_info_insrt['Health']['assigned_lab'])));
		}
		
		if(!empty($request_info_insrt['Health']['sample_date1']) && $request_info_insrt['Health']['sample_date'] == 'Please select a suitable date')
		{
			$get_collection_time_info1 = $timeslot[$request_info_insrt['Health']['sample_time']];
			
			$number = $request_info_insrt['Health']['landline'];
			$message = 'Test Req. No:'.$this->data['Billing']['order_id'].' Thank you for booking your tests with nirAmaya Pathlabs on '.$request_info_insrt['Health']['sample_date1'].' '.$get_collection_time_info1.' Call 9555009009 or visit www.nhcare.in for assistance';
		
		}

		$this->__sms_message($number,$message);

		if(!empty($this->data['Billing']['test_id']))
		{
			$explode_tests = explode(',',$this->data['Billing']['test_id']);
			$count_test = count($explode_tests);
			
			foreach($explode_tests as $val)
			{
				$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
				$test_name_string .= '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp']."<br />";
			}
		}
		
		if(!empty($this->data['Billing']['profile_id']))
		{
			$explode_profiles = explode(',',$this->data['Billing']['profile_id']);
			$count_profile = count($explode_profiles);
			
			foreach($explode_profiles as $val)
			{
				$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
				$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp']."<br />";	
			}
		}
		
		
		if(!empty($this->data['Billing']['offer_id']))
		{
			$explode_offers = explode(',',$this->data['Billing']['offer_id']);
			$count_offers = count($explode_offers);
			
			foreach($explode_offers as $val)
			{
				$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$val)));
				$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp']."<br />";	
			}
		}
		
		if(!empty($this->data['Billing']['package_id']))
		{
			$explode_packages = explode(',',$this->data['Billing']['package_id']);
			$count_packages = count($explode_packages);
			
			foreach($explode_packages as $val)
			{
				$package_name_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$val)));
				$package_name = '<strong>1- </strong>'.$package_name_1['Package']['package_name'].' - Rs.'.$package_name_1['Package']['package_mrp']."<br />";	
			}
		}
		
		$this->set('first_name',$this->data['Billing']['first_name']);
		$this->set('last_name',$this->data['Billing']['last_name']);
		$this->set('order_id',$this->data['Billing']['order_id']);
		$this->set('tests',$test_name);
		$this->set('profiles',$profile_name);
		$this->set('offers',$offer_name);
		$this->set('sub_total',$this->data['Billing']['sub_total']);
		
		$update_cod_status = $this->Health->query("UPDATE healths SET cod_status='1' WHERE id='".$h_id."'");
		$this->Session->setFlash('Thank you for confirming test booking.','flash_success');
		$this->redirect(array('controller'=>'tests','action'=>'payment_history'));
	}
	
	private function createBilling($healthid,$userDetail)
	{
		$this->Health = ClassRegistry::init('Health');
		$health = $this->Health->find('first',array('conditions'=>array('Health.id'=>$healthid)));
		
		$this->Billing = ClassRegistry::init('Billing');
		$data = $this->Billing->find('first',array('fields'=>array('Billing.order_id'),'order'=>array('Billing.id DESC')));
		$order_id = $data['Billing']['order_id']+1;
		
		$this->data['Billing']['order_id'] = $order_id;
		$this->data['Billing']['request_id'] = $healthid;
		$this->data['Billing']['user_id'] = $userDetail['User']['id'];
		$this->data['Billing']['test_id'] = $health['Health']['test_id'];
		$this->data['Billing']['profile_id'] = $health['Health']['profile_id'];
		$this->data['Billing']['offer_id'] = $health['Health']['offer_id'];
		$this->data['Billing']['package_id'] = $health['Health']['package_id'];
		$this->data['Billing']['service_id'] = $health['Health']['service_id'];
		$this->data['Billing']['first_name'] = $userDetail['User']['name'];
		$this->data['Billing']['contact'] = $health['Health']['landline'];
		$this->data['Billing']['address'] = $health['Health']['address'];
		$this->data['Billing']['locality'] = $health['Health']['locality'];
		$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
		$this->data['Billing']['zip'] = $health['Health']['pincode'];
		
		$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$health['Health']['pincode'])));
		$this->data['Billing']['city'] = $pincodeMaster['PincodeMaster']['city'];
		$this->data['Billing']['state'] = $pincodeMaster['PincodeMaster']['state'];	
		
		$this->data['Billing']['landmark'] = $health['Health']['landmark'];
		$this->data['Billing']['book_date'] = date('Y-m-d H:i:s');
		$this->data['Billing']['sub_total'] = $health['Health']['total_amount'];
		$this->Billing->create();
		$this->Billing->save($this->data);
		return $this->data['Billing']['order_id'];
	}
	
	function make_payment(){
		$this->PrescriptionMaster = ClassRegistry::init('PrescriptionMaster');
		$userData = $this->Session->read('UserDetail');
		$this->DocumentTypeMaster = ClassRegistry::init("DocumentTypeMaster");
		$this->UserDocument = ClassRegistry::init("UserDocument");
		$this->Test = ClassRegistry::init("Test");

		//if($userData)
		//{
			$session_check = $this->PrescriptionMaster->find('first',array('conditions'=>array('PrescriptionMaster.session_id'=>$_COOKIE['PHPSESSID'])));

			$tests = $this->Session->read('session_test');

			$total = 0;
			$testname = array();
			$test_id_list = array();
			$doc_array = array();
			foreach($tests as $val)
			{
				$testDetail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val['Cart']['test_id'])));
				$doc_list = explode(',',$testDetail['Test']['document_type']);
				$docs = $this->DocumentTypeMaster->query("Select * from document_type_master where id in (".$testDetail['Test']['document_list'].")");

				foreach($docs as $val1)
				{
					$doc_array[$val1['document_type_master']['id']] = $val1;
				}
				array_push($testname,array($val['Cart']['test_parameter'],$val['Cart']['test_mrp']));
				array_push($test_id_list,$val['Cart']['test_id']);
				$total = $total + $val['Cart']['test_mrp'];
			}
			$this->set('doc_list',$doc_array);
			//print_R($doc_array);die;
			if(!$session_check)
			{
				$this->pres = $this->PrescriptionMaster->create();

				$this->pres['PrescriptionMaster']['prescription_id'] = 'P-'.strtotime(date('Y-m-d h:i:s'));
				$this->pres['PrescriptionMaster']['first_name'] = $_SESSION['UserDetail']['User']['first_name'];
				$this->pres['PrescriptionMaster']['last_name'] = $_SESSION['UserDetail']['User']['last_name'];
				$this->pres['PrescriptionMaster']['gender'] = $_SESSION['UserDetail']['User']['gender'];
				$this->pres['PrescriptionMaster']['age'] = $_SESSION['UserDetail']['User']['age'];
				$this->pres['PrescriptionMaster']['date'] = date('Y-m-d h:i:s');
				$this->pres['PrescriptionMaster']['contact_number'] = $_SESSION['UserDetail']['User']['contact'];
				$this->pres['PrescriptionMaster']['alternate_contact'] = $_SESSION['UserDetail']['User']['alternate_contact'];
				$this->pres['PrescriptionMaster']['mrn'] = $_SESSION['UserDetail']['User']['id'];
				$this->pres['PrescriptionMaster']['email'] = $_SESSION['UserDetail']['User']['email'];
				$this->pres['PrescriptionMaster']['estimate_reference'] = $total;
				$this->pres['PrescriptionMaster']['referred_by'] = "self";
				$this->pres['PrescriptionMaster']['prescription_url'] = "none";
				$this->pres['PrescriptionMaster']['remarks'] = "";
				$this->pres['PrescriptionMaster']['status'] = 7;
				$this->pres['PrescriptionMaster']['order_type'] = 'Online';
				$this->pres['PrescriptionMaster']['created_by'] = $_SESSION['UserDetail']['User']['id'];
				$this->pres['PrescriptionMaster']['tests'] = implode(',',$test_id_list);
				$this->pres['PrescriptionMaster']['total_amount'] = $total;
				$this->pres['PrescriptionMaster']['discount_amount'] = 0;
				$this->pres['PrescriptionMaster']['discount_amount_reason'] = "none";
				$this->pres['PrescriptionMaster']['session_id'] = $_COOKIE['PHPSESSID'];
				$this->PrescriptionMaster->save($this->pres);
			}
			else
			{
				$this->pres = $session_check;
				$this->pres['PrescriptionMaster']['estimate_reference'] = $total;
				$this->pres['PrescriptionMaster']['remarks'] = "";
				$this->pres['PrescriptionMaster']['tests'] = implode(',',$test_id_list);
				$this->pres['PrescriptionMaster']['total_amount'] = $total;
				$this->pres['PrescriptionMaster']['session_id'] = $_COOKIE['PHPSESSID'];				
				$this->PrescriptionMaster->save($this->pres);
			}
			
			$this->layout = 'tests';

			$this->User = ClassRegistry::init("User");
			$this->Timelab = ClassRegistry::init("Timelab");
			$timelab = $this->Timelab->find('list',array('conditions'=>array('Timelab.status'=>'1')));

			if(isset($_SESSION['UserDetail']['User']))
			{
				$this->set('logged_in',1);
			}
			$sessionData = $this->Session->read('prescription');
			$userDetail = '';
			$healthid='';
			if($_POST)
			{
				$pid = $this->Session->read('prescription');
				if(!isset($_SESSION['UserDetail']['User']))
				{
					$user_id = $this->createUser($_POST);
					$healthid = $this->createHealth($_POST,$user_id);
					$userDetail = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
				}
				else
				{
					
					$userDetail = $_SESSION['UserDetail'];
					$healthid = $this->createHealth($_POST,$_SESSION['UserDetail']['User']['id']);
				}

				$this->pres = $session_check;
				$this->pres['PrescriptionMaster']['status'] = 3;				
				
				$this->PrescriptionMaster->save($this->pres);

				$this->Session->write('UserDetail',$userDetail);

				if($healthid!='')
				{
					$this->createBilling($healthid,$userDetail);
					
					$v_balance = $_POST['voucher_total'] - $_POST['voucher'];
					$this->VoucherMaster = ClassRegistry::init('VoucherMaster');
					$voucher_data = $this->VoucherMaster->find('first',array('conditions'=>array('VoucherMaster.voucher_code'=>$_POST['voucherid'])));
					if(!empty($voucher_data))
					{
						$this->Paytrack = ClassRegistry::init('Paytrack');
						
						$this->payData = $this->Paytrack->create();
						$this->payData['Paytrack']['type'] = "Receive";
						$this->payData['Paytrack']['admin_id'] = $_SESSION['UserDetail']['User']['id'];
						$this->payData['Paytrack']['request_id'] = $healthid;
						$this->payData['Paytrack']['pay_mode'] = "voucher";
						$this->payData['Paytrack']['c_number'] = "";
						$this->payData['Paytrack']['pay_install'] = $_POST['voucher'];
						$this->payData['Paytrack']['receive_date'] = date('Y-m-d H:i:s');
						$this->payData['Paytrack']['remarks'] = $voucher_data['VoucherMaster']['voucher_code'];
						
						$this->Paytrack->save($this->payData);
						
						$this->VoucherMaster->query('update voucher_master set balance_amt='.$v_balance.' where voucher_code="'.$_POST['voucherid'].'"');
						
						$this->VoucherTransaction = ClassRegistry::init('VoucherTransaction');
						$this->trans_data = $this->VoucherTransaction->create();
						$this->trans_data['VoucherTransaction']['voucher_id'] = $voucher_data['VoucherMaster']['id'];
						$this->trans_data['VoucherTransaction']['amount'] = $_POST['voucher'];
						$this->trans_data['VoucherTransaction']['request_id'] = $healthid;
						$this->trans_data['VoucherTransaction']['date'] = date('Y-m-d H:i:s');
						
						$vt_id = $this->VoucherTransaction->save($this->trans_data);
					}
					$this->ActivityLog = ClassRegistry::init('ActivityLog');
					$this->data['ActivityLog']['admin_id'] = $_SESSION['UserDetail']['User']['id'];
					
					$page_url = Router::url( $this->here, true );
					
					$this->data['ActivityLog']['patient_id'] = $userDetail['User']['id'];
					$this->data['ActivityLog']['health_id'] = $healthid;
					$this->data['ActivityLog']['page_url']= $page_url;
					$this->data['ActivityLog']['action']= "Online Order Added";
					$this->data['ActivityLog']['creation'] = date('Y-m-d H:i:s');
					
					if($this->ActivityLog->create($this->data))
					{
						$this->ActivityLog->save($this->data);
					}
					
					$this->LabMessageMaster = ClassRegistry::init('LabMessageMaster');
					$this->LabMessageMaster->create();
					
					$this->data['LabMessageMaster']['request_id'] = $healthid;
					$this->data['LabMessageMaster']['date'] = date('Y-m-d H:i:s');
					$this->data['LabMessageMaster']['message'] = "Online Order Added";
					
					$this->LabMessageMaster->save($this->data);				
					
					foreach($this->data['DocumentTypeMaster'] as $key=>$val)
					{
						$this->UserDocument->create();
						$doc_type = $this->DocumentTypeMaster->find('first',array('conditions'=>array('DocumentTypeMaster.name'=>str_replace("_"," ",$key))));	
						
						$this->data['UserDocument']['user_id'] = $userDetail['User']['id'];
						$this->data['UserDocument']['request_id'] = $healthid;
						$this->data['UserDocument']['document_id'] = $doc_type['DocumentTypeMaster']['id'];
						$this->data['UserDocument']['documant_type'] = $doc_type['DocumentTypeMaster']['doc_type'];

						if($doc_type['DocumentTypeMaster']['doc_type']=='doc')
						{
							$hfile = $this->File->uploadFile($this->data['DocumentTypeMaster'][$key], PATIENT_DOC_STORE_PATH, true,array('doc','docx','xls','xlsx','pdf','PDF'));
							$this->data['UserDocument']['value'] = urlencode(SITE_URL."files/patient_doc/".$hfile['name']);
						}
						else
							$this->data['UserDocument']['value'] = $val;

						$this->UserDocument->save($this->data);
					}

					$this->createRequestTePr($healthid);
				}
			}
			$tests = $this->Session->read('session_test');

			$total = 0;
			$testname = array();
			foreach($tests as $val)
			{
				array_push($testname,array($val['Cart']['test_parameter'],$val['Cart']['test_mrp']));
				$total = $total + $val['Cart']['test_mrp'];
			}
			$this->set('testname',$testname);
			//print_R($testname);die;
			$this->Lab = ClassRegistry::init("Lab");
			$lab = $this->Lab->find('list',array('fields'=>array('id','pcc_name'),'conditions'=>array('Lab.status'=>'1')));
			$this->set('lablist',$lab);
			$this->set('timelab',$timelab);
			$this->set('total_amt',$total);
			
			$pid = $this->Session->read('prescription');
			
			$this->set('prescription',$pid);
			$this->set('discount',$pid['PrescriptionMaster']['discount_amount']);
			
			$this->set('test_cart_count',count($this->Session->read('session_test')));
			$this->set('title_for_layout', 'Search Test');
		/*}
		else
		{
			$this->Session->setFlash('Kindly login Before Adding Any Item to Cart');
			$this->redirect('/testds/login');
		}*/
	}

	private function createHealth($data,$user_id)
    {
		$date = '';
		$time = '';
		$s_date_new = '';
		//$date = date('d-m-Y',strtotime($data['date']));
		
		$this->User = ClassRegistry::init("User");
		$userDetail = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
		
		$pid = $this->Session->read('prescription');
		
		$s_date_new = date('d-m-Y',strtotime($data['date']));
		$this->data['Health']['agent_id'] = 0;
		$this->data['Health']['user_id'] = $user_id;
		$this->data['Health']['ref_num'] = '';
		if(!empty($pid))
		{
			$this->data['Health']['medical_reference_number'] = !empty($pid['PrescriptionMaster']['mrn']) ? $pid['PrescriptionMaster']['mrn'] : $user_id;
			$this->data['Health']['discount_id'] = 0;
			$this->data['Health']['discount_amount'] = !empty($pid['PrescriptionMaster']['discount_amount']) ? $pid['PrescriptionMaster']['discount_amount'] : "0";
			$this->data['Health']['discount_amount_reason'] = !empty($pid['PrescriptionMaster']['discount_amount_reason']) ? $pid['PrescriptionMaster']['discount_amount_reason'] : "";
			$this->data['Health']['created_by'] = !empty($pid['PrescriptionMaster']['created_by']) ? $pid['PrescriptionMaster']['created_by'] : "11";
		}
		else
		{
			$this->VoucherMaster = ClassRegistry::init('VoucherMaster');
			$voucher_data = $this->VoucherMaster->find('first',array('conditions'=>array('VoucherMaster.voucher_code'=>$_POST['voucherid'])));
			
			$this->data['Health']['medical_reference_number'] = $user_id;
			$this->data['Health']['discount_id'] = !empty($data['discountid']) ? $data['discountid'] : 0;
			$this->data['Health']['discount_amount'] = $data['discount'];
			$this->data['Health']['discount_amount_reason'] = "";
			$this->data['Health']['voucher_code'] = $data['voucherid'];;
			$this->data['Health']['redeemed_amount'] = $data['voucher'];
			$this->data['Health']['other_charges'] = $data['other_charges'];;
			$this->data['Health']['created_by'] = !empty($voucher_data['VoucherMaster']['pcc_id']) ? $voucher_data['VoucherMaster']['pcc_id'] : "11" ;
		}
		$this->data['Health']['name'] = $userDetail['User']['name'];
		$date = date('d').date('m').date('Y').date('h').date('i').date('s');
		$this->data['Health']['reference'] = $user_id."-".$date;
		
		//$from = new DateTime($data['dob']);
		//$to   = new DateTime('today');
//		echo $from->diff($to)->y;
		
		$this->data['Health']['flags'] = "1000000000";
		$this->data['Health']['gender'] = $data['gender'];
		$this->data['Health']['age'] = $data['age'];
		$this->data['Health']['landline'] = $data['mobile'];
		$this->data['Health']['mobile'] = "";
		$this->data['Health']['email'] = !empty($data['email']) ? $data['email'] : "";
		$this->data['Health']['address'] = $data['address'];
		$this->data['Health']['address1'] = $data['address'];
		$this->data['Health']['locality'] = ".";
		$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
		$this->data['Health']['pincode'] = !empty($data['pincode']) ? $data['pincode'] :'';
		
		$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$data['pincode'])));
		$this->data['Health']['city_id'] = $pincodeMaster['PincodeMaster']['city'];
		$this->data['Health']['state'] = $pincodeMaster['PincodeMaster']['state'];	
		$this->data['Health']['visit_pat_city'] = $pincodeMaster['PincodeMaster']['city'];
				
		$tests = $this->Session->read('session_test');
		//print_R($tests);die;
		$testlist = array();
		foreach($tests as $val)
		{
			array_push($testlist,$val['Cart']['test_id']);
		}
		
		$this->data['Health']['landmark'] = '0';
		$this->data['Health']['city'] = "";
		$this->data['Health']['s_date'] = date('Y-m-d',strtotime($data['date']));
		$this->data['Health']['test_id'] = implode(',',$testlist);
		$this->data['Health']['profile_id'] = "";
		$this->data['Health']['offer_id'] =      "";   
		$this->data['Health']['package_id'] =   "";
		$this->data['Health']['service_id'] = "";
		$this->data['Health']['sample_date'] = "";
		$this->data['Health']['sample_date1'] = date('d-m-Y',strtotime($data['date']));
		$this->data['Health']['sample_time'] = "";
		$this->data['Health']['sample_time1'] = !empty($data['time']) ? $data['time'] :'1';
		$this->data['Health']['pay_status'] = 0;
		$tests = $this->Session->read('session_test');
		
		$total = 0;
		foreach($tests as $val)
		{
			$total = $total + $val['Cart']['test_mrp'];
		}
		
		$this->data['Health']['total_amount'] = $total + $data['other_charges'] - $this->data['Health']['discount_amount'];
		$this->data['Health']['received_amount'] = $data['voucher'];
		$this->data['Health']['refund_status'] = 0;
		$this->data['Health']['adj_reason'] = "";
		$this->data['Health']['btc_reason'] = "";
		$this->data['Health']['sent_pathcorp_admin'] = "";
		$this->data['Health']['agent_confirm'] = 0;
		$this->data['Health']['home_report'] = 0;
		$this->data['Health']['requ_status'] = 0;
		$this->data['Health']['status'] = 1;
		
		$this->data['Health']['patient_report'] = "";
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
		$this->data['Health']['agent_id'] = '83';
		
		$this->data['Health']['refered_by'] = !empty($this->_request->refered_by) ? $this->_request->refered_by :'';
		$this->data['Health']['market_value'] = !empty($this->_request->market_value) ? $this->_request->market_value :0;
		
		$this->lab = ClassRegistry::init("Lab");
		$labs = $this->lab->find('first',array('conditions'=>array('Lab.id'=>$data['lab'])));

		$this->data['Health']['assigned_lab'] = 'Home';
		$this->data['Health']['btc_no_payment_bill_to_company'] = $labs['Lab']['pcc_name'];
		$this->data['Health']['btc_reason'] = '';
		$this->data['Health']['balance_amount'] = $total + $data['other_charges'] - ($data['voucher'] + $this->data['Health']['discount_amount']);
		$this->data['Health']['balance_refund'] = 0;
		$sample_collected_date = $data['date'];    
		
		if($this->data['Health']['balance_amount'] == $this->data['Health']['total_amount'] && $this->data['Health']['balance_amount'] > 0)
			$this->data['Health']['payment_type'] = 3;
		else if($this->data['Health']['balance_amount'] < $this->data['Health']['total_amount'] && $this->data['Health']['balance_amount'] > 0)
			$this->data['Health']['payment_type'] = 2;
		else
			$this->data['Health']['payment_type'] = 1;
		
		$this->data['Health']['amount_collected'] = $data['voucher'];
		$this->data['Health']['amount_to_be_collected'] = $total + $data['other_charges'] - ($data['voucher'] + $this->data['Health']['discount_amount']);
		$this->data['Health']['prescription_url'] = "";
	
		$this->data['Health']['sample_collected_date'] = $sample_collected_date;
		//print_R($this->data);die;
		$this->Health = ClassRegistry::init('Health');
		$this->Health->create();
		if($this->Health->save($this->data))
		{
			$this->_health_table_id = $this->Health->getLastInsertId();
			return $this->_health_table_id;
		}
		else
		{
			$this->Session->setFlash('Error Saving Order','flash_failure'); 
		}
	}
	
	private function createUser($data)
	{
		$this->User = ClassRegistry::init("User");
		$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
		$this->data['User']['email'] = !empty($data['email']) ? $data['email'] : "";
		$this->data['User']['alternate_email'] = ".";
		$this->data['User']['status'] = 1;
		$this->data['User']['first_name'] = !empty($data['firstname']) ? $data['firstname'] : "";
		$this->data['User']['last_name'] = !empty($data['lastname']) ? $data['lastname'] : "";
		$this->data['User']['name'] = $data['firstname']." ".$data['lastname'];
		$this->data['User']['gender'] = $data['gender'];
		
		//$from = new DateTime($data['dob']);
		//$to   = new DateTime('today');
	//	echo $from->diff($to)->y;
		
		$this->data['User']['age'] = $data['age'];
		$this->data['User']['contact'] = $data['mobile'];
		$this->data['User']['alternate_contact'] = ".";
		$this->data['User']['address'] = $data['address'];
		$this->data['User']['locality'] = ".";
		$this->data['User']['username'] = strtolower($data['firstname']).mt_rand(1000,9999);
		$this->data['User']['passwd'] = substr(strtolower($data['firstname']),0,1).substr($data['mobile'],-4,4);
		$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
		$this->data['User']['pincode'] = !empty($data['pincode']) ? $data['pincode'] :'';

		if($data['pincode'])
		{
			$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$data['pincode'])));
			$this->data['User']['city'] = $pincodeMaster['PincodeMaster']['city'];
			$this->data['User']['state'] = $pincodeMaster['PincodeMaster']['state'];	
		}
		else{
			$this->data['User']['city'] = '0';
			$this->data['User']['state'] = '0';	
		}
		$this->data['User']['landmark'] = '';
		$this->data['User']['created_by'] = '1';
		//print_R($this->data);
		$this->User->create();
		
		$user_table_id =='';
		if($this->User->save($this->data))
		{
			$user_table_id = $this->User->getLastInsertId();
			return $user_table_id;
		}
		else
		{
			$this->Session->setFlash('Error Saving User Detail','flash_failure'); 
		}
	}	
	
	function test_description()
	{
		$this->layout = 'tests';
		$this->Observation = ClassRegistry::init('Observation');
		$test_id = $_REQUEST['number'];
		$description = $this->Test->find('first',array('conditions'=>array('Test.id'=>$test_id)));
		if(!empty($description))
		{
			$x['success'] = 'success';
			$x['id'] = $description['Test']['id'];
			$x['type'] = $description['Test']['type'];
			$x['testcode'] = $description['Test']['testcode'];
			$x['test_parameter'] = $description['Test']['test_parameter'];
			$x['sample'] = $description['Test']['sample'];
			$x['methodology'] = $description['Test']['methodology'];
			$x['temp'] = $description['Test']['temp'];
			$x['schedule'] = $description['Test']['schedule'];
			$x['reporting'] = $description['Test']['reporting'];
			$x['net'] = $description['Test']['net'];
			$x['mrp'] = $description['Test']['mrp'];
			$x['type'] = $description['Test']['type'];
			$x['description'] = $description['Test']['description'];
			
			$this->Sample = ClassRegistry::init('Sample');
			$samples = $this->Sample->query("select sample_id,type from sample_type_master where sample_id in (".$description['Test']['sample'].") or type in (".$description['Test']['sample'].")");
			$des_sample='';
			foreach($samples as $val)
			{
				if($des_sample=='')
					$des_sample = $val['sample_type_master']['type'];
				else
					$des_sample = $des_sample.",".$val['sample_type_master']['type'];
			}
			
			$x['sample'] = $des_sample;
			$observations = $this->Observation->query("Select * from observations where observation_id in (".$description['Test']['observation_id'].")");
			$tests = $this->Observation->query("Select * from tests where id in (".$description['Test']['testscode'].")");
			$obs_count = 1;
			$x['obs_data'] = '';
			if($description['Test']['type'] == 'PROFILE')
			{
				foreach($tests as $val)
				{
					$x['obs_data'][$obs_count] = $val;
					$obs_count++;
				}
			}
			else
			{
				foreach($observations as $val)
				{
					$x['obs_data'][$obs_count] = $val;
					$obs_count++;
				}
			}
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
	
	function search_keyword()
	{
		if(!empty($this->data))
		{
			$keyword = $this->data['Search']['test_search'];
			// to not show test records which has been already added to cart
			if(count($this->Session->read('session_test_type'))>0)
			{
				foreach($this->Session->read('session_test_type') as $type)
				{
					$exist_test_id[]= $type['test_id'];
				}
				$check_id = implode(",",$exist_test_id);
				$search_keyword_1 = $this->Test->find('all',array('conditions'=>array('Test.id NOT IN ('.$check_id.')','Test.test_parameter LIKE'=>'%'.$keyword.'%','Test.status'=>1,'Test.p_type'=>1)));
			}
			else
			{
			$search_keyword_1 = $this->Test->find('all',array('conditions'=>array('Test.status'=>1,'Test.test_parameter LIKE'=>'%'.$keyword.'%','Test.p_type'=>1)));
			}
			//$search_keyword_2 = $this->Test->find('all',array('conditions'=>array('Test.test_parameter LIKE'=>$keyword.'%')));
			//$search_keyword_3 = $this->Test->find('all',array('conditions'=>array('Test.test_parameter LIKE'=>'%'.$keyword)));
			//$search_keyword_4 = $this->Test->find('all',array('conditions'=>array('Test.test_parameter LIKE'=>'('.$keyword.'%')));
			$count_1 = count($search_keyword_1);
			//$count_2 = count($search_keyword_2);
			//$count_3 = count($search_keyword_3);
			//$count_4 = count($search_keyword_4);
			
			if(!empty($search_keyword_1))
			{
				$x['success'] = 'success';
				$x['test_count'] = ($count_1+$count_2+$count_3+$count_4);
				$x['search_list_1'] = $search_keyword_1;
				$x['search_list_2'] = $search_keyword_2;
				$x['search_list_3'] = $search_keyword_3;
				$x['search_list_4'] = $search_keyword_4;
				$m['keyword_info'] = $x;
				echo json_encode($m);
			}
			if(empty($search_keyword_1) && empty($search_keyword_2) && empty($search_keyword_3) && empty($search_keyword_4))
			{
				$x['success'] = 'unsuccess';
				$x['test_count'] = ($count_1+$count_2+$count_3+$count_4);
				$m['keyword_info'] = $x;
				echo json_encode($m);
			}
		}
		exit;
	}
	
	function personal_detail()
	{
		$this->layout = 'tests';
		$userData = $this->Session->read('UserDetail');
		$this->set('title_for_layout', ucfirst($userData['User']['name']).' Account');
		$this->set('member_detail',$userData);
		$find_city_name = $this->City->find('first',array('conditions'=>array('City.id'=>$userData['User']['city'])));
		$find_state_name = $this->State->find('first',array('conditions'=>array('State.id'=>$userData['User']['state']))); 
		$this->set('mem_city',$find_city_name['City']['name']);
		$this->set('mem_state',$find_state_name['State']['name']);
	}
	
	function edit_detail()
	{
		$this->layout = 'tests';
		$userData = $this->Session->read('UserDetail');
		$this->set('title_for_layout', ucfirst($userData['User']['name']).' Account');
		$this->set('member_detail',$userData);
		if(!empty($this->data))
		{
			//print_R($this->data);
			$this->data['User']['dob'] = date('Y-m-d',strtotime($this->data['User']['dob']));
			$this->data['User']['name'] = $this->data['User']['first_name'].' '.$this->data['User']['last_name'];
			if($this->User->create($this->data))
			{
				if(!empty($this->data['User']['address1']) && empty($this->data['User']['address2']))
				{
					$this->data['User']['address'] = $this->data['User']['address1'];
				}
				if(!empty($this->data['User']['address1']) && !empty($this->data['User']['address2']))
				{
					$this->data['User']['address'] = $this->data['User']['address1'].'*'.$this->data['User']['address2'];
				}
				//print_R($this->data);die;
				if($this->User->save($this->data,false))
				{
					$old_passwd = $this->data['User']['old_pass_user'];
					$new_passwd = $this->data['User']['new_pass'];
					$conf_passwd = $this->data['User']['conf_pass'];
					if(!empty($new_passwd) && !empty($conf_passwd))
					{
						$get_old_pass = $this->User->find('first',array('conditions'=>array('User.id'=>$this->data['User']['id'])));
						if($get_old_pass['User']['passwd'] == $old_passwd)
						{
							if($new_passwd == $conf_passwd)
							{
								$update_pass = $this->User->query("UPDATE users SET passwd='$conf_passwd' WHERE id='".$this->data['User']['id']."'");
								$this->Session->delete('UserDetail');
								$find_user = $this->User->find('first',array('conditions'=>array('User.id'=>$this->data['User']['id'])));
								$this->Session->write('UserDetail',$find_user);
								$userData = $this->Session->read('UserDetail');
								$this->set('member_detail',$userData);
								$this->set('mess_succ_pass','Details and password updated successfully.');
							}
							else
							{
								$this->set('mess_fail','Your new password and confirm password did not match');
							}
						}
						else
						{
							$this->set('mess_fail','Your old password did not match');
						}
					}
					else
					{
						$this->Session->delete('UserDetail');
						$find_user = $this->User->find('first',array('conditions'=>array('User.id'=>$this->data['User']['id'])));
						$this->Session->write('UserDetail',$find_user);
						$userData = $this->Session->read('UserDetail');
						$this->set('member_detail',$userData);
						$this->set('mess_succ','Details updated successfully.');
					}
				}
			}
		}
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1),'order'=>array('City.name ASC')));
		$this->set('city',$city);
		$state = $this->State->find('all',array('conditions'=>array('State.status'=>1),'order'=>array('State.name ASC')));
		$this->set('state',$state);
	}

	function manage_subuser()
	{
		$this->layout = 'tests';
		$userData = $this->Session->read('UserDetail');
		$this->set('title_for_layout', ucfirst($userData['User']['name']).' Sub User List');
		$this->Relation = ClassRegistry::init('RelationMaster');

		if(!empty($_POST))
		{
			foreach($_POST['data'] as $key=>$val)
			{
				if($val['relation']=="self")
				{
					$this->Health->query('update healths set user_id="'.$_POST['data']['id'].'" where user_id="'.$key.'"');
					$this->User->query('delete from users where id="'.$key.'"');
				}
				else
				{
					$this->User->query('update users set relation="'.$val['relation'].'"where id="'.$key.'"');
				}
			}
		}

		$subusers = $this->User->find('all',array('conditions'=>array('User.parent_id'=>$userData['User']['id'],'User.parent_child'=>'child')));
		$relation = $this->Relation->find('list',array('fields'=>array('prefix','name')));
		$this->set('relation',$relation);
		$this->set('member_detail',$userData);
		$this->set('sub_user',$subusers);
	}
	
	function my_request()
	{
		$this->layout = 'tests';
		$userData = $this->Session->read('UserDetail');
		$this->set('title_for_layout', ucfirst($userData['User']['name']).' Request(s)');
		//$this->paginate = array('Health' => array('limit' =>'5','order'=>array('Health.id'=>'DESC'),'conditions'=>array('Health.user_id'=>$userData['User']['id'],'Health.published'=>0)));
		$this->paginate = array('Health' => array('limit' =>'5','order'=>array('Health.id'=>'DESC'),'conditions'=>array('Health.user_id'=>$userData['User']['id'],'Health.patient_report'=>'','Health.pay_status'=>0)));
		$get_requests=$this->paginate('Health');
		$k = 0;
		foreach($get_requests as $key => $val)
		{
			if($val['Health']['opted_for_id'] != 0)
			{
				$opted_type = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val['Health']['opted_for_id'])));
				if($opted_type['Test']['type'] == 'TEST')
				{
					$get_requests[$k]['Health']['test_type'] = 'Test';
					$get_requests[$k]['Health']['test_name'] = $opted_type['Test']['test_parameter'];
				}
				if($opted_type['Test']['type'] == 'PROFILE')
				{
					$get_requests[$k]['Health']['test_type'] = 'Profile';
					$get_requests[$k]['Health']['test_name'] = $opted_type['Test']['test_parameter'];
				}
			}
			else
			{
				if($val['Health']['test_id'] != '')
				{
					$get_requests[$k]['Health']['test_type'] = 'Test(s)';
					$explode_test = explode(',',$val['Health']['test_id']);
					$count_test = count($explode_test);
					if($count_test == 1)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>';
					}
					if($count_test == 2)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>';
					}
					if($count_test == 3)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>';
					}
					if($count_test == 4)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$test_4['Test']['mrp'].'</p>';
					}
					if($count_test == 5)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$test_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$test_5['Test']['mrp'].'</p>';
					}
					if($count_test == 6)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$test_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$test_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$test_6['Test']['mrp'].'</p>';
					}
					if($count_test == 7)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p>'.'<strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$test_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$test_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$test_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$test_7['Test']['mrp'].'</p>';
					}
					if($count_test == 8)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
						$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$test_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$test_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$test_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$test_7['Test']['mrp'].'</p>'.'<p><strong>8)</strong> '.$test_8['Test']['testcode'].' - '.$test_8['Test']['test_parameter'].' - Rs.'.$test_8['Test']['mrp'].'</p>';
					}
					if($count_test == 9)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
						$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
						$test_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[8])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$test_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$test_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$test_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$test_7['Test']['mrp'].'</p>'.'<p><strong>8)</strong> '.$test_8['Test']['testcode'].' - '.$test_8['Test']['test_parameter'].' - Rs.'.$test_8['Test']['mrp'].'</p>'.'<p><strong>9)</strong> '.$test_9['Test']['testcode'].' - '.$test_9['Test']['test_parameter'].' - Rs.'.$test_9['Test']['mrp'].'</p>';
					}
					if($count_test == 10)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
						$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
						$test_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[8])));
						$test_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[9])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$test_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$test_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$test_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$test_7['Test']['mrp'].'</p>'.'<p><strong>8)</strong> '.$test_8['Test']['testcode'].' - '.$test_8['Test']['test_parameter'].' - Rs.'.$test_8['Test']['mrp'].'</p>'.'<p><strong>9)</strong> '.$test_9['Test']['testcode'].' - '.$test_9['Test']['test_parameter'].' - Rs.'.$test_9['Test']['mrp'].'</p>'.'<p><strong>10)</strong> '.$test_10['Test']['testcode'].' - '.$test_10['Test']['test_parameter'].' - Rs.'.$test_10['Test']['mrp'].'</p>';
					}
					$get_requests[$k]['Health']['test_name'] = $test_name;
				}
				if($val['Health']['profile_id'] != '')
				{
					$get_requests[$k]['Health']['profile_type'] = 'Profile(s)';
					$explode_profile = explode(',',$val['Health']['profile_id']);
					$count_profile = count($explode_profile);
					if($count_profile == 1)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>';
					}
					if($count_profile == 2)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>';
					}
					if($count_profile == 3)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>';
					}
					if($count_profile == 4)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$profile_4['Test']['mrp'].'</p>';
					}
					if($count_profile == 5)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$profile_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$profile_5['Test']['mrp'].'</p>';
					}
					if($count_profile == 6)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$profile_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$profile_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$profile_6['Test']['mrp'].'</p>';
					}
					if($count_profile == 7)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$profile_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$profile_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$profile_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$profile_7['Test']['mrp'].'</p>';
					}
					if($count_profile == 8)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
						$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$profile_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$profile_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$profile_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$profile_7['Test']['mrp'].'</p>'.'<p><strong>8)</strong> '.$profile_8['Test']['testcode'].' - '.$profile_8['Test']['test_parameter'].' - Rs.'.$profile_8['Test']['mrp'].'</p>';
					}
					if($count_profile == 9)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
						$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
						$profile_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[8])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$profile_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$profile_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$profile_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$profile_7['Test']['mrp'].'</p>'.'<p><strong>8)</strong> '.$profile_8['Test']['testcode'].' - '.$profile_8['Test']['test_parameter'].' - Rs.'.$profile_8['Test']['mrp'].'</p>'.'<p><strong>9)</strong> '.$profile_9['Test']['testcode'].' - '.$profile_9['Test']['test_parameter'].' - Rs.'.$profile_9['Test']['mrp'].'</p>';
					}
					if($count_profile == 10)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
						$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
						$profile_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[8])));
						$profile_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[9])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$profile_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$profile_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$profile_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$profile_7['Test']['mrp'].'</p>'.'<p><strong>8)</strong> '.$profile_8['Test']['testcode'].' - '.$profile_8['Test']['test_parameter'].' - Rs.'.$profile_8['Test']['mrp'].'</p>'.'<p><strong>9)</strong> '.$profile_9['Test']['testcode'].' - '.$profile_9['Test']['test_parameter'].' - Rs.'.$profile_9['Test']['mrp'].'</p>'.'<p><strong>10)</strong> '.$profile_10['Test']['testcode'].' - '.$profile_10['Test']['test_parameter'].' - Rs.'.$profile_10['Test']['mrp'].'</p>';
					}
					$get_requests[$k]['Health']['profile_name'] = $profile_name;
				}
				if($val['Health']['offer_id'] != '')
				{
					$get_requests[$k]['Health']['offer_type'] = 'Offer Banner(s)';
					$explode_offer = explode(',',$val['Health']['offer_id']);
					$count_offer = count($explode_offer);
					if($count_offer == 1)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>';
					}
					if($count_offer == 2)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$offer_2['Banner']['banner_mrp'].'</p>';
					}
					if($count_offer == 3)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
						$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$offer_2['Banner']['banner_mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$offer_3['Banner']['banner_mrp'].'</p>';
					}
					if($count_offer == 4)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
						$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
						$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$offer_2['Banner']['banner_mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$offer_3['Banner']['banner_mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$offer_4['Banner']['banner_mrp'].'</p>';
					}
					if($count_offer == 5)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
						$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
						$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
						$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$offer_2['Banner']['banner_mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$offer_3['Banner']['banner_mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$offer_4['Banner']['banner_mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$offer_5['Banner']['banner_mrp'].'</p>';
					}
					if($count_offer == 6)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
						$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
						$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
						$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
						$offer_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[5])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$offer_2['Banner']['banner_mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$offer_3['Banner']['banner_mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$offer_4['Banner']['banner_mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$offer_5['Banner']['banner_mrp'].'</p>'.'<p><strong>6)</strong> '.$offer_6['Banner']['banner_code'].' - '.$offer_6['Banner']['banner_name'].' - Rs.'.$offer_6['Banner']['banner_mrp'].'</p>';
					}
					if($count_offer == 7)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
						$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
						$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
						$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
						$offer_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[5])));
						$offer_7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[6])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$offer_2['Banner']['banner_mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$offer_3['Banner']['banner_mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$offer_4['Banner']['banner_mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$offer_5['Banner']['banner_mrp'].'</p>'.'<p><strong>6)</strong> '.$offer_6['Banner']['banner_code'].' - '.$offer_6['Banner']['banner_name'].' - Rs.'.$offer_6['Banner']['banner_mrp'].'</p>'.'<p><strong>7)</strong> '.$offer_7['Banner']['banner_code'].' - '.$offer_7['Banner']['banner_name'].' - Rs.'.$offer_7['Banner']['banner_mrp'].'</p>';
					}
					if($count_offer == 8)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
						$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
						$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
						$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
						$offer_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[5])));
						$offer_7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[6])));
						$offer_8 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[7])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$offer_2['Banner']['banner_mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$offer_3['Banner']['banner_mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$offer_4['Banner']['banner_mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$offer_5['Banner']['banner_mrp'].'</p>'.'<p><strong>6)</strong> '.$offer_6['Banner']['banner_code'].' - '.$offer_6['Banner']['banner_name'].' - Rs.'.$offer_6['Banner']['banner_mrp'].'</p>'.'<p><strong>7)</strong> '.$offer_7['Banner']['banner_code'].' - '.$offer_7['Banner']['banner_name'].' - Rs.'.$offer_7['Banner']['banner_mrp'].'</p>'.'<p><strong>8)</strong> '.$offer_8['Banner']['banner_code'].' - '.$offer_8['Banner']['banner_code'].' - '.$offer_8['Banner']['banner_name'].' - Rs.'.$offer_8['Banner']['banner_mrp'].'</p>';
					}
					$get_requests[$k]['Health']['offer_name'] = $offer_name;
				}
				if($val['Health']['package_id'] != '')
				{
					$get_requests[$k]['Health']['package_type'] = 'Package(s)';
					$explode_package = explode(',',$val['Health']['package_id']);
					$count_package = count($explode_offer);
					if($count_package == 1)
					{
						$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
						$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$package_1['Package']['package_mrp'].'</p>';
					}
					if($count_package == 2)
					{
						$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
						$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
						$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$package_1['Package']['package_mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$package_2['Package']['package_mrp'].'</p>';
					}
					if($count_package == 3)
					{
						$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
						$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
						$package_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[2])));
						$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$package_1['Package']['package_mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$package_2['Package']['package_mrp'].'</p>'.'<p><strong>3)</strong> '.$package_3['Package']['package_name'].' - Rs.'.$package_3['Package']['package_mrp'].'</p>';
					}
					if($count_package == 4)
					{
						$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
						$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
						$package_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[2])));
						$package_4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[3])));
						$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$package_1['Package']['package_mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$package_2['Package']['package_mrp'].'</p>'.'<p><strong>3)</strong> '.$package_3['Package']['package_name'].' - Rs.'.$package_3['Package']['package_mrp'].'</p>'.'<p><strong>4)</strong> '.$package_4['Package']['package_name'].' - Rs.'.$package_4['Package']['package_mrp'].'</p>';
					}
					if($count_package == 5)
					{
						$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
						$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
						$package_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[2])));
						$package_4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[3])));
						$package_5 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[4])));
						$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$package_1['Package']['package_mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$package_2['Package']['package_mrp'].'</p>'.'<p><strong>3)</strong> '.$package_3['Package']['package_name'].' - Rs.'.$package_3['Package']['package_mrp'].'</p>'.'<p><strong>4)</strong> '.$package_4['Package']['package_name'].' - Rs.'.$package_4['Package']['package_mrp'].'</p>'.'<p><strong>5)</strong> '.$package_5['Package']['package_name'].' - Rs.'.$package_5['Package']['package_mrp'].'</p>';
					}
					$get_requests[$k]['Health']['package_name'] = $package_name;
				}
				
			}
			$k++;
		}
		$this->set('get_requests',$get_requests);
	}
	
	function my_report()
	{
		$this->layout = 'tests';
		$userData = $this->Session->read('UserDetail');
		$this->set('title_for_layout', ucfirst($userData['User']['name']).' Request(s)');
		//$this->paginate = array('Health' => array('limit' =>'5','order'=>array('Health.id'=>'DESC'),'conditions'=>array('Health.user_id'=>$userData['User']['id'],'Health.published'=>1)));
		$this->paginate = array('Health' => array('limit' =>'5','order'=>array('Health.id'=>'DESC'),'conditions'=>array('Health.user_id'=>$userData['User']['id'],'Health.patient_report <>'=>'','Health.pay_status'=>1)));
		$get_requests=$this->paginate('Health');
		$k = 0;
		foreach($get_requests as $key => $val)
		{
			if($val['Health']['opted_for_id'] != 0)
			{
				$opted_type = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val['Health']['opted_for_id'])));
				if($opted_type['Test']['type'] == 'TEST')
				{
					$get_requests[$k]['Health']['test_type'] = 'Test';
					$get_requests[$k]['Health']['test_name'] = $opted_type['Test']['test_parameter'];
				}
				if($opted_type['Test']['type'] == 'PROFILE')
				{
					$get_requests[$k]['Health']['test_type'] = 'Profile';
					$get_requests[$k]['Health']['test_name'] = $opted_type['Test']['test_parameter'];
				}
			}
			else
			{
				if($val['Health']['test_id'] != '')
				{
					$get_requests[$k]['Health']['test_type'] = 'Test(s)';
					$explode_test = explode(',',$val['Health']['test_id']);
					$count_test = count($explode_test);
					if($count_test == 1)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>';
					}
					if($count_test == 2)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>';
					}
					if($count_test == 3)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>';
					}
					if($count_test == 4)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$test_4['Test']['mrp'].'</p>';
					}
					if($count_test == 5)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$test_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$test_5['Test']['mrp'].'</p>';
					}
					if($count_test == 6)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$test_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$test_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$test_6['Test']['mrp'].'</p>';
					}
					if($count_test == 7)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p>'.'<strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$test_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$test_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$test_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$test_7['Test']['mrp'].'</p>';
					}
					if($count_test == 8)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
						$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$test_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$test_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$test_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$test_7['Test']['mrp'].'</p>'.'<p><strong>8)</strong> '.$test_8['Test']['testcode'].' - '.$test_8['Test']['test_parameter'].' - Rs.'.$test_8['Test']['mrp'].'</p>';
					}
					if($count_test == 9)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
						$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
						$test_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[8])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$test_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$test_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$test_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$test_7['Test']['mrp'].'</p>'.'<p><strong>8)</strong> '.$test_8['Test']['testcode'].' - '.$test_8['Test']['test_parameter'].' - Rs.'.$test_8['Test']['mrp'].'</p>'.'<p><strong>9)</strong> '.$test_9['Test']['testcode'].' - '.$test_9['Test']['test_parameter'].' - Rs.'.$test_9['Test']['mrp'].'</p>';
					}
					if($count_test == 10)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
						$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
						$test_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[8])));
						$test_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[9])));
						$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$test_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$test_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$test_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$test_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$test_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$test_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$test_7['Test']['mrp'].'</p>'.'<p><strong>8)</strong> '.$test_8['Test']['testcode'].' - '.$test_8['Test']['test_parameter'].' - Rs.'.$test_8['Test']['mrp'].'</p>'.'<p><strong>9)</strong> '.$test_9['Test']['testcode'].' - '.$test_9['Test']['test_parameter'].' - Rs.'.$test_9['Test']['mrp'].'</p>'.'<p><strong>10)</strong> '.$test_10['Test']['testcode'].' - '.$test_10['Test']['test_parameter'].' - Rs.'.$test_10['Test']['mrp'].'</p>';
					}
					$get_requests[$k]['Health']['test_name'] = $test_name;
				}
				if($val['Health']['profile_id'] != '')
				{
					$get_requests[$k]['Health']['profile_type'] = 'Profile(s)';
					$explode_profile = explode(',',$val['Health']['profile_id']);
					$count_profile = count($explode_profile);
					if($count_profile == 1)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>';
					}
					if($count_profile == 2)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>';
					}
					if($count_profile == 3)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>';
					}
					if($count_profile == 4)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$profile_4['Test']['mrp'].'</p>';
					}
					if($count_profile == 5)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$profile_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$profile_5['Test']['mrp'].'</p>';
					}
					if($count_profile == 6)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$profile_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$profile_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$profile_6['Test']['mrp'].'</p>';
					}
					if($count_profile == 7)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$profile_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$profile_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$profile_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$profile_7['Test']['mrp'].'</p>';
					}
					if($count_profile == 8)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
						$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$profile_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$profile_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$profile_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$profile_7['Test']['mrp'].'</p>'.'<p><strong>8)</strong> '.$profile_8['Test']['testcode'].' - '.$profile_8['Test']['test_parameter'].' - Rs.'.$profile_8['Test']['mrp'].'</p>';
					}
					if($count_profile == 9)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
						$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
						$profile_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[8])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$profile_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$profile_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$profile_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$profile_7['Test']['mrp'].'</p>'.'<p><strong>8)</strong> '.$profile_8['Test']['testcode'].' - '.$profile_8['Test']['test_parameter'].' - Rs.'.$profile_8['Test']['mrp'].'</p>'.'<p><strong>9)</strong> '.$profile_9['Test']['testcode'].' - '.$profile_9['Test']['test_parameter'].' - Rs.'.$profile_9['Test']['mrp'].'</p>';
					}
					if($count_profile == 10)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
						$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
						$profile_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[8])));
						$profile_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[9])));
						$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$profile_1['Test']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$profile_2['Test']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$profile_3['Test']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$profile_4['Test']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$profile_5['Test']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$profile_6['Test']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$profile_7['Test']['mrp'].'</p>'.'<p><strong>8)</strong> '.$profile_8['Test']['testcode'].' - '.$profile_8['Test']['test_parameter'].' - Rs.'.$profile_8['Test']['mrp'].'</p>'.'<p><strong>9)</strong> '.$profile_9['Test']['testcode'].' - '.$profile_9['Test']['test_parameter'].' - Rs.'.$profile_9['Test']['mrp'].'</p>'.'<p><strong>10)</strong> '.$profile_10['Test']['testcode'].' - '.$profile_10['Test']['test_parameter'].' - Rs.'.$profile_10['Test']['mrp'].'</p>';
					}
					$get_requests[$k]['Health']['profile_name'] = $profile_name;
				}
				
				if($val['Health']['offer_id'] != '')
				{
					$get_requests[$k]['Health']['offer_type'] = 'Offer Banner(s)';
					$explode_offer = explode(',',$val['Health']['offer_id']);
					$count_offer = count($explode_offer);
					if($count_offer == 1)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>';
					}
					if($count_offer == 2)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$offer_2['Banner']['banner_mrp'].'</p>';
					}
					if($count_offer == 3)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
						$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$offer_2['Banner']['banner_mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$offer_3['Banner']['banner_mrp'].'</p>';
					}
					if($count_offer == 4)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
						$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
						$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$offer_2['Banner']['banner_mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$offer_3['Banner']['banner_mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$offer_4['Banner']['banner_mrp'].'</p>';
					}
					if($count_offer == 5)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
						$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
						$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
						$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$offer_2['Banner']['banner_mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$offer_3['Banner']['banner_mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$offer_4['Banner']['banner_mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$offer_5['Banner']['banner_mrp'].'</p>';
					}
					if($count_offer == 6)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
						$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
						$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
						$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
						$offer_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[5])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$offer_2['Banner']['banner_mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$offer_3['Banner']['banner_mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$offer_4['Banner']['banner_mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$offer_5['Banner']['banner_mrp'].'</p>'.'<p><strong>6)</strong> '.$offer_6['Banner']['banner_code'].' - '.$offer_6['Banner']['banner_name'].' - Rs.'.$offer_6['Banner']['banner_mrp'].'</p>';
					}
					if($count_offer == 7)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
						$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
						$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
						$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
						$offer_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[5])));
						$offer_7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[6])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$offer_2['Banner']['banner_mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$offer_3['Banner']['banner_mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$offer_4['Banner']['banner_mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$offer_5['Banner']['banner_mrp'].'</p>'.'<p><strong>6)</strong> '.$offer_6['Banner']['banner_code'].' - '.$offer_6['Banner']['banner_name'].' - Rs.'.$offer_6['Banner']['banner_mrp'].'</p>'.'<p><strong>7)</strong> '.$offer_7['Banner']['banner_code'].' - '.$offer_7['Banner']['banner_name'].' - Rs.'.$offer_7['Banner']['banner_mrp'].'</p>';
					}
					if($count_offer == 8)
					{
						$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
						$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
						$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
						$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
						$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
						$offer_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[5])));
						$offer_7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[6])));
						$offer_8 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[7])));
						$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$offer_1['Banner']['banner_mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$offer_2['Banner']['banner_mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$offer_3['Banner']['banner_mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$offer_4['Banner']['banner_mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$offer_5['Banner']['banner_mrp'].'</p>'.'<p><strong>6)</strong> '.$offer_6['Banner']['banner_code'].' - '.$offer_6['Banner']['banner_name'].' - Rs.'.$offer_6['Banner']['banner_mrp'].'</p>'.'<p><strong>7)</strong> '.$offer_7['Banner']['banner_code'].' - '.$offer_7['Banner']['banner_name'].' - Rs.'.$offer_7['Banner']['banner_mrp'].'</p>'.'<p><strong>8)</strong> '.$offer_8['Banner']['banner_code'].' - '.$offer_8['Banner']['banner_code'].' - '.$offer_8['Banner']['banner_name'].' - Rs.'.$offer_8['Banner']['banner_mrp'].'</p>';
					}
					$get_requests[$k]['Health']['offer_name'] = $offer_name;
				}
				
				if($val['Health']['package_id'] != '')
				{
					$get_requests[$k]['Health']['package_type'] = 'Package(s)';
					$explode_package = explode(',',$val['Health']['package_id']);
					$count_package = count($explode_offer);
					if($count_package == 1)
					{
						$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
						$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$package_1['Package']['package_mrp'].'</p>';
					}
					if($count_package == 2)
					{
						$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
						$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
						$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$package_1['Package']['package_mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$package_2['Package']['package_mrp'].'</p>';
					}
					if($count_package == 3)
					{
						$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
						$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
						$package_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[2])));
						$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$package_1['Package']['package_mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$package_2['Package']['package_mrp'].'</p>'.'<p><strong>3)</strong> '.$package_3['Package']['package_name'].' - Rs.'.$package_3['Package']['package_mrp'].'</p>';
					}
					if($count_package == 4)
					{
						$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
						$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
						$package_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[2])));
						$package_4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[3])));
						$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$package_1['Package']['package_mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$package_2['Package']['package_mrp'].'</p>'.'<p><strong>3)</strong> '.$package_3['Package']['package_name'].' - Rs.'.$package_3['Package']['package_mrp'].'</p>'.'<p><strong>4)</strong> '.$package_4['Package']['package_name'].' - Rs.'.$package_4['Package']['package_mrp'].'</p>';
					}
					if($count_package == 5)
					{
						$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
						$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
						$package_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[2])));
						$package_4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[3])));
						$package_5 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[4])));
						$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$package_1['Package']['package_mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$package_2['Package']['package_mrp'].'</p>'.'<p><strong>3)</strong> '.$package_3['Package']['package_name'].' - Rs.'.$package_3['Package']['package_mrp'].'</p>'.'<p><strong>4)</strong> '.$package_4['Package']['package_name'].' - Rs.'.$package_4['Package']['package_mrp'].'</p>'.'<p><strong>5)</strong> '.$package_5['Package']['package_name'].' - Rs.'.$package_5['Package']['package_mrp'].'</p>';
					}
					$get_requests[$k]['Health']['package_name'] = $package_name;
				}
			}
			$k++;
		}
		$this->set('get_requests',$get_requests);
	}
	
	function my_account()
	{
		$this->layout = 'tests';
		$userData = $this->Session->read('UserDetail');
		$this->set('title_for_layout', ucfirst($userData['User']['name']).' Account');
		$this->set('UserName',ucfirst($userData['User']['name']));
		$this->paginate = array('Health' => array('limit' =>'10','order'=>array('Health.id'=>'DESC'),'conditions'=>array('Health.user_id'=>$userData['User']['id'])));
		$get_requests=$this->paginate('Health');
		$k = 0;
		foreach($get_requests as $key => $val)
		{
			if($val['Health']['opted_for_id'] != 0)
			{
				$opted_type = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val['Health']['opted_for_id'])));
				if($opted_type['Test']['type'] == 'TEST')
				{
					$get_requests[$k]['Health']['test_type'] = 'Test';
					$get_requests[$k]['Health']['test_name'] = $opted_type['Test']['test_parameter'];
				}
				if($opted_type['Test']['type'] == 'PROFILE')
				{
					$get_requests[$k]['Health']['test_type'] = 'Profile';
					$get_requests[$k]['Health']['test_name'] = $opted_type['Test']['test_parameter'];
				}
			}
			else
			{
				if($val['Health']['test_id'] != '')
				{
					$get_requests[$k]['Health']['test_type'] = 'Test';
					$explode_test = explode(',',$val['Health']['test_id']);
					$count_test = count($explode_test);
					if($count_test == 1)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_name = '<strong>1-</strong> '.$test_1['Test']['test_parameter'];
					}
					if($count_test == 2)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_name = '<strong>1-</strong> '.$test_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$test_2['Test']['test_parameter'];
					}
					if($count_test == 3)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_name = '<strong>1-</strong> '.$test_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$test_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$test_3['Test']['test_parameter'];
					}
					if($count_test == 4)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_name = '<strong>1-</strong> '.$test_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$test_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$test_3['Test']['test_parameter'].'<br />'.'<strong>4-</strong> '.$test_4['Test']['test_parameter'];
					}
					if($count_test == 5)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_name = '<strong>1-</strong> '.$test_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$test_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$test_3['Test']['test_parameter'].'<br />'.'<strong>4-</strong> '.$test_4['Test']['test_parameter'].'<br />'.'<strong>5-</strong> '.$test_5['Test']['test_parameter'];
					}
					if($count_test == 6)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_name = '<strong>1-</strong> '.$test_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$test_2['Test']['test_parameter'].'<strong>3-</strong> '.$test_3['Test']['test_parameter'].'<br />'.'<strong>4-</strong> '.$test_4['Test']['test_parameter'].'<br />'.'<strong>5-</strong> '.$test_5['Test']['test_parameter'].'<br />'.'<strong>6-</strong> '.$test_6['Test']['test_parameter'];
					}
					if($count_test == 7)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
						$test_name = '<strong>1-</strong> '.$test_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$test_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$test_3['Test']['test_parameter'].'<br />'.'<strong>4-</strong> '.$test_4['Test']['test_parameter'].'<br />'.'<strong>5-</strong> '.$test_5['Test']['test_parameter'].'<br />'.'<strong>6-</strong> '.$test_6['Test']['test_parameter'].'<br />'.'<strong>7-</strong> '.$test_7['Test']['test_parameter'];
					}
					if($count_test == 8)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
						$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
						$test_name = '<strong>1-</strong> '.$test_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$test_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$test_3['Test']['test_parameter'].'<br />'.'<strong>4-</strong> '.$test_4['Test']['test_parameter'].'<br />'.'<strong>5-</strong> '.$test_5['Test']['test_parameter'].'<br />'.'<strong>6-</strong> '.$test_6['Test']['test_parameter'].'<br />'.'<strong>7-</strong> '.$test_7['Test']['test_parameter'].'<br />'.'<strong>8-</strong> '.$test_8['Test']['test_parameter'];
					}
					if($count_test == 9)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
						$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
						$test_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[8])));
						$test_name = '<strong>1-</strong> '.$test_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$test_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$test_3['Test']['test_parameter'].'<br />'.'<strong>4-</strong> '.$test_4['Test']['test_parameter'].'<br />'.'<strong>5-</strong> '.$test_5['Test']['test_parameter'].'<br />'.'<strong>6-</strong> '.$test_6['Test']['test_parameter'].'<br />'.'<strong>7-</strong> '.$test_7['Test']['test_parameter'].'<br />'.'<strong>8-</strong> '.$test_8['Test']['test_parameter'].'<br />'.'<strong>9-</strong> '.$test_9['Test']['test_parameter'];
					}
					if($count_test == 10)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
						$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
						$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
						$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
						$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
						$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
						$test_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[8])));
						$test_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[9])));
						$test_name = '<strong>1-</strong> '.$test_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$test_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$test_3['Test']['test_parameter'].'<br />'.'<strong>4-</strong> '.$test_4['Test']['test_parameter'].'<br />'.'<strong>5-</strong> '.$test_5['Test']['test_parameter'].'<br />'.'<strong>6-</strong> '.$test_6['Test']['test_parameter'].'<br />'.'<strong>7-</strong> '.$test_7['Test']['test_parameter'].'<br />'.'<strong>8-</strong> '.$test_8['Test']['test_parameter'].'<br />'.'<strong>9-</strong> '.$test_9['Test']['test_parameter'].'<br />'.$test_10['Test']['test_parameter'];
					}
					$get_requests[$k]['Health']['test_name'] = $test_name;
				}
				if($val['Health']['profile_id'] != '')
				{
					$get_requests[$k]['Health']['profile_type'] = 'Profile';
					$explode_profile = explode(',',$val['Health']['profile_id']);
					$count_profile = count($explode_profile);
					if($count_profile == 1)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_name = '<strong>1-</strong> '.$profile_1['Test']['test_parameter'];
					}
					if($count_profile == 2)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_name = '<strong>1-</strong> '.$profile_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$profile_2['Test']['test_parameter'];
					}
					if($count_profile == 3)
					{
						$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$test_name = '<strong>1-</strong> '.$profile_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$profile_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$profile_3['Test']['test_parameter'];
					}
					if($count_profile == 4)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_name = '<strong>1-</strong> '.$profile_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$profile_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$profile_3['Test']['test_parameter'].'<br />'.'<strong>4-</strong> '.$profile_4['Test']['test_parameter'];
					}
					if($count_profile == 5)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_name = '<strong>1-</strong> '.$profile_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$profile_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$profile_3['Test']['test_parameter'].'<br />'.'<strong>4-</strong> '.$profile_4['Test']['test_parameter'].'<br />'.'<strong>5-</strong> '.$profile_5['Test']['test_parameter'];
					}
					if($count_profile == 6)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_name = '<strong>1-</strong> '.$profile_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$profile_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$profile_3['Test']['test_parameter'].'<br />'.'<strong>4-</strong> '.$profile_4['Test']['test_parameter'].'<br />'.'<strong>5-</strong> '.$profile_5['Test']['test_parameter'].'<br />'.'<strong>6-</strong> '.$profile_6['Test']['test_parameter'];
					}
					if($count_profile == 7)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
						$profile_name = '<strong>1-</strong> '.$profile_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$profile_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$profile_3['Test']['test_parameter'].'<br />'.'<strong>4-</strong> '.$profile_4['Test']['test_parameter'].'<br />'.'<strong>5-</strong> '.$profile_5['Test']['test_parameter'].'<br />'.'<strong>6-</strong> '.$profile_6['Test']['test_parameter'].'<br />'.'<strong>7-</strong> '.$profile_7['Test']['test_parameter'];
					}
					if($count_profile == 8)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
						$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
						$profile_name = '<strong>1-</strong> '.$profile_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$profile_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$profile_3['Test']['test_parameter'].'<br />'.'<strong>4-</strong> '.$profile_4['Test']['test_parameter'].'<br />'.'<strong>5-</strong> '.$profile_5['Test']['test_parameter'].'<br />'.'<strong>6-</strong> '.$profile_6['Test']['test_parameter'].'<br />'.'<strong>7-</strong> '.$profile_7['Test']['test_parameter'].'<br />'.'<strong>8-</strong> '.$profile_8['Test']['test_parameter'];
					}
					if($count_profile == 9)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
						$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
						$profile_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[8])));
						$profile_name = '<strong>1-</strong> '.$profile_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$profile_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$profile_3['Test']['test_parameter'].'<br />'.'<strong>4-</strong> '.$profile_4['Test']['test_parameter'].'<br />'.'<strong>5-</strong> '.$profile_5['Test']['test_parameter'].'<br />'.'<strong>6-</strong> '.$profile_6['Test']['test_parameter'].'<br />'.'<strong>7-</strong> '.$profile_7['Test']['test_parameter'].'<br />'.'<strong>8-</strong> '.$profile_8['Test']['test_parameter'].'<strong>9-</strong> '.$profile_9['Test']['test_parameter'];
					}
					if($count_profile == 10)
					{
						$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
						$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
						$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
						$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
						$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
						$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
						$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
						$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
						$profile_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[8])));
						$profile_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[9])));
						$profile_name = '<strong>1-</strong> '.$profile_1['Test']['test_parameter'].'<br />'.'<strong>2-</strong> '.$profile_2['Test']['test_parameter'].'<br />'.'<strong>3-</strong> '.$profile_3['Test']['test_parameter'].'<br />'.'<strong>4-</strong> '.$profile_4['Test']['test_parameter'].'<br />'.'<strong>5-</strong> '.$profile_5['Test']['test_parameter'].'<br />'.'<strong>6-</strong> '.$profile_6['Test']['test_parameter'].'<br />'.'<strong>7-</strong> '.$profile_7['Test']['test_parameter'].'<br />'.'<strong>8-</strong> '.$profile_8['Test']['test_parameter'].'<br />'.'<strong>9-</strong> '.$profile_9['Test']['test_parameter'].'<br />'.$profile_10['Test']['test_parameter'];
					}
					$get_requests[$k]['Health']['profile_name'] = $profile_name;
				}
			}
			$k++;
		}
		
		$this->set('get_requests',$get_requests);
	}
	
	
	function become_member()
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','Become Member');
		if(!empty($this->data))
		{
			$find_dup_email = $this->User->find('first',array('conditions'=>array('User.email'=>$this->data['User']['email'])));
			if(empty($find_dup_email))
			{
				$this->data['User']['name'] = $this->data['User']['first_name'].' '.$this->data['User']['last_name'];
				$username = strtolower($this->data['User']['first_name']).mt_rand(1000,9999);
				/*$strpos_space = strpos($this->data['User']['first_name'],' ');
				$strpos_dot = strpos($this->data['User']['first_name'],'.');
				if($strpos_space != '')
				{
					$string_rep = str_replace(' ','',$this->data['User']['first_name']);
					$strlen = strlen($string_rep);
				}
				elseif($strpos_dot != '')
				{
					$strlen = strlen(str_replace('.','',$this->data['User']['first_name']));
				}
				else
				{
					$strlen = strlen($this->data['User']['first_name']);
				}
				if($strlen < 5)
				{
					if($strlen == 1)
					{
						if($strpos_space != '')
						{
							$pass1 = str_replace(' ','',strtolower($this->data['User']['first_name']));
							$pass2 = substr(strtolower($this->data['User']['last_name']),0,3);
						}
						elseif($strpos_dot != '')
						{
							$pass1 = str_replace('.','',strtolower($this->data['User']['first_name']));
							$pass2 = substr(strtolower($this->data['User']['last_name']),0,3);
						}
						else
						{
							$pass1 = strtolower($this->data['User']['first_name']);
							$pass2 = substr(strtolower($this->data['User']['last_name']),0,3);
						}
						$pass3 = substr($this->data['User']['contact'],-4,4);
						$password = $pass1.$pass2.$pass3;
					}
					elseif($strlen == 2)
					{
						if($strpos_space != '')
						{
							$pass1 = str_replace(' ','',strtolower($this->data['User']['first_name']));
							$pass2 = substr(strtolower($this->data['User']['last_name']),0,2);
						}
						elseif($strpos_dot != '')
						{
							$pass1 = str_replace('.','',strtolower($this->data['User']['first_name']));
							$pass2 = substr(strtolower($this->data['User']['last_name']),0,2);
						}
						else
						{
							$pass1 = strtolower($this->data['User']['first_name']);
							$pass2 = substr(strtolower($this->data['User']['last_name']),0,2);
						}
						$pass3 = substr($this->data['User']['contact'],-4,4);
						$password = $pass1.$pass2.$pass3;
					}
					elseif($strlen == 3)
					{
						if($strpos_space != '')
						{
							$pass1 = str_replace(' ','',strtolower($this->data['User']['first_name']));
							$pass2 = substr(strtolower($this->data['User']['last_name']),0,1);
						}
						elseif($strpos_dot != '')
						{
							$pass1 = str_replace('.','',strtolower($this->data['User']['first_name']));
							$pass2 = substr(strtolower($this->data['User']['last_name']),0,1);
						}
						else
						{
							$pass1 = strtolower($this->data['User']['first_name']);
							$pass2 = substr(strtolower($this->data['User']['last_name']),0,1);
						}
						$pass3 = substr($this->data['User']['contact'],-4,4);
						$password = $pass1.$pass2.$pass3;
					}
					elseif($strlen == 4)
					{
						if($strpos_space != '')
						{
							$pass1 = str_replace(' ','',strtolower($this->data['User']['first_name']));
						}
						elseif($strpos_dot != '')
						{
							$pass1 = str_replace('.','',strtolower($this->data['User']['first_name']));
						}
						else
						{
							$pass1 = strtolower($this->data['User']['first_name']);
						}
						$pass3 = substr($this->data['User']['contact'],-4,4);
						$password = $pass1.$pass3;
					}
				}
				else
				{
					$pass1 = substr(str_replace('.','',strtolower($this->data['User']['first_name'])),0,4);
					$pass3 = substr($this->data['User']['contact'],-4,4);
					$password = $pass1.$pass3;
				}*/
				$pass2 = substr(strtolower($this->data['User']['first_name']),0,1);
				$pass3 = substr($this->data['User']['contact'],-4,4);
				$password = $pass2.$pass3;
				
				
				//$password = mt_rand();
				
				$this->data['User']['username'] = $username;
				$this->data['User']['email'] = $this->data['User']['email'];
				$this->data['User']['passwd'] = $password;
				$this->data['User']['status'] = 1;
				$this->data['User']['name'] = $this->data['User']['name'];
				$this->data['User']['gender'] = $this->data['User']['gender'];
				$this->data['User']['age'] = $this->data['User']['age'];
				$this->data['User']['contact'] = trim($this->data['User']['contact']);
				if(!empty($this->data['User']['address1']) && empty($this->data['User']['address2']))
				{
					$this->data['User']['address'] = $this->data['User']['address1'];
				}
				if(!empty($this->data['User']['address1']) && !empty($this->data['User']['address2']))
				{
					$this->data['User']['address'] = $this->data['User']['address1'].'*'.$this->data['User']['address2'];
				}
				if($this->User->create($this->data))
				{
					if($this->User->save($this->data,false))
					{
						$last_id = $this->User->getLastInsertID();
						/*$this->set('user_name' , $username );
						$this->set('user_email' , $this->data['User']['email'] );
						$this->set('user_pass' , $password );
						$this->Email->template = 'login_detail';
						$this->Email->from = $this->data['User']['email'];
						$this->Email->fromName = 'info@niramayahealthcare.com';
						$this->Email->subject = 'Login details for niramaya member panel';
						$this->Email->to = $this->data['User']['email'];
						$this->Email->sendAs = 'html'; // because we like to send pretty mail
						$this->Email->delivery = 'mail';
						if($this->Email->send())
						{
							
						}*/
						$this->redirect('/pages/login/'.$last_id);
					}
				}
			}
			else
			{
				$this->Session->setFlash('This EmailID is already registered please enter another EmailID','flash_failure');
				$this->data = $this->data;
			}
		}
		$gender = $this->Gender->find('all',array('conditions'=>array('Gender.status'=>1)));
		$this->set('gender',$gender);
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1),'order'=>array('City.name ASC')));
		$this->set('city',$city);
		$state = $this->State->find('all',array('conditions'=>array('State.status'=>1),'order'=>array('State.name ASC')));
		$this->set('state',$state);
	}
	
	function search_keyword_home()
	{
		$this->Session->delete('keyword_home_search');
		
		if(!empty($this->data) || isset($_GET['condition']))
		{
			$keyword = $this->data['Search']['test_search'];
			$search_keyword_1='';
			if(isset($_GET['condition']))
			{
				$search_keyword_1 = $this->Test->find('all',array('conditions'=>array('Test.disease LIKE'=>'%'.$_GET['condition'].'%','LENGTH(Test.testcode) >= '=>1,'Test.status'=>1,'Test.p_type'=>1)));
			}
			else
			{
				$search_keyword_1 = $this->Test->find('all',array('conditions'=>array('Test.test_parameter LIKE'=>'%'.$keyword.'%','LENGTH(Test.testcode) >= '=>1,'Test.status'=>1,'Test.p_type'=>1)));
			}
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
					
			$this->Session->write('keyword_home_search',$search_data_keyword);
			$this->redirect('/tests/search');
		}
	}

	function check_phone()
	{
		$user_data = $this->User->find('first',array('conditions'=>array('User.contact'=>$_GET['req_val'],'User.parent_child'=>'parent')));
		if($user_data)
		{
			$otp = rand(100000, 999999);
			$message = "Your One Time Password is " . $otp;

			$messageurl =  urlencode($message);

			$url_sms1='http://103.233.79.246//submitsms.jsp?user=nirAmaya&key=e2ceeba388XX&mobile='.$_GET['req_val'].'&message='.$messageurl.'&senderid=NHCare&accusage=1';

			$ch_sms = curl_init();

			curl_setopt($ch_sms, CURLOPT_URL, $url_sms1);
			curl_setopt($ch_sms, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch_sms, CURLOPT_MAXREDIRS, 3);
			curl_setopt($ch_sms, CURLOPT_RETURNTRANSFER, TRUE);

			$data_sms = curl_exec($ch_sms);
			$x['success'] = 'success';
			$this->User->query('update users set otp="'.$otp.'",otp_generated="'.date('Y-m-d H:i:s').'" where contact="'.$_GET['req_val'].'" and parent_child="parent"');
		}
		else
		{
			$x['success'] = 'notsuccess';
		}
		$user['user_info'] = $x;
		print_R(json_encode($user));die;
	}
	
	function change_pass()
	{
		$this->layout = 'tests';
		$userData = $this->Session->read('UserDetail');
		$this->set('title_for_layout', 'Change Password');
		$this->set('UserName',ucfirst($userData['User']['name']));
		$this->set('UserId',ucfirst($userData['User']['id']));
		if(!empty($this->data))
		{
			$old_pass = $this->data['User']['old_pass'];
			$new_pass = $this->data['User']['new_pass'];
			$conf_pass = $this->data['User']['conf_pass'];
			$user_id = $this->data['User']['user_id'];
			$get_old_pass = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
			$db_user_pass = $get_old_pass['User']['passwd'];
			if($db_user_pass == $old_pass)
			{
				if($new_pass == $conf_pass)
				{
					$update = $this->User->query("UPDATE users SET passwd='$conf_pass' WHERE id='".$user_id."'");
					$this->set('mess_fail','');
					$this->set('mess_success','Your password updated successfully');	
				}
				else
				{
					$this->set('mess_fail','Your new password and confirm password did not match');
					$this->set('mess_success','');	
				}
			}
			else
			{
				$this->set('mess_fail','Your old password did not match');
				$this->set('mess_success','');
			}
		}
	}
	
	function download_report($rep_name=NULL)
	{
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
			//print_R($req_info);
			//echo "-----";
			//print_R($lastyear);
			//echo "---";
			if(strtotime($req_info['Health']['s_date']) <= strtotime($lastyear))
			{
				//echo "if";	
				$this->ftp_access($req_info);				
				$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['id'].".pdf";			
			}			
			else
			{	
				//print_R(filter_var($req_info['Health']['patient_report'], FILTER_VALIDATE_URL));
				if (strpos($req_info['Health']['patient_report'], 'http:') !== false || strpos($req_info['Health']['patient_report'], 'https:') !== false) { 
					file_put_contents("/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf",file_get_contents($req_info['Health']['patient_report']));
					$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf";
				}
				else{
					$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/".$req_info['Health']['patient_report'];			
				}
			}
			
			//phpinfo(); exit;
			//$dec_rep_name = base64_decode($rep_name);
			
			App::import('Vendor', '/fpdf/fpdf');
			App::import('Vendor', '/fpdf/fpdi');
			
			
			$pdf = new FPDI();
			$pdf->addPage();
			$pagecount = $pdf->setSourceFile($dec_rep_name);
			for ($i=1; $i <= $pagecount; $i++) {
				$tplidx = $pdf->ImportPage($i);
				$pdf->useTemplate($tplidx,0,0,0);
				$pdf->Image('/home2/niramovh/public_html/app/webroot/fpdf/nirAmaya_Report_Header.jpg',0,0,210,27);
				//$pdf->Image('/var/www/html/niramayahealthcare.com/public_html/NH/app/webroot/fpdf/footer.jpg',10,273,196,6.5);
				if($i != $pagecount)
				{
					$pdf->addPage();
				}
			}
                        $pdf->addPage();
                        $pdf->Image('/home2/niramovh/public_html/app/webroot/fpdf/nirAmaya_Report_Back.jpg', 0, 0, $pdf->w, $pdf->h);
			$pdf->Output($dec_rep_name, 'D');
			/*$dec_rep_name = base64_decode($rep_name);
			$fullPath = PATIENT_REPORT_STORE_PATH.$dec_rep_name;
			if( file_exists($fullPath) )
			{
   				
    			$fsize = filesize($fullPath);
    			$path_parts = pathinfo($fullPath);
    			$ext = strtolower($path_parts["extension"]);
   
    			
    			switch ($ext) 
				{
      				case "pdf": $ctype="application/pdf"; break;
      				case "doc": $ctype="application/msword"; break;
      				case "xls": $ctype="application/vnd.ms-excel"; break;
      				default: $ctype="application/force-download";
    			}
				header("Pragma: public"); 
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: private",false); 
				header("Content-Type: $ctype");
				header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";" );
				header("Content-Transfer-Encoding: binary");
				header("Content-Length: ".$fsize);
				ob_clean();
				flush();
				readfile( $fullPath );
			}*/
			exit;
		}
	}
	
	function my_cart($test_id=NULL,$type=NULL)
	{
		//echo "<pre>";print_r($this->Session->read('session_test')); //exit;
		$this->layout = 'tests';
		$this->set('title_for_layout','Niramayahealth Care | My Cart');
		$this->Session->delete('book_mess');
		$check_exist_id = array();
		//echo "<pre>";print_r($this->Session->read('session_test'));
		
		if(!empty($test_id))
		{
			$session_test = $this->Session->read('session_test');
			$count_test = count($session_test);
			$find_test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$test_id)));
			if(empty($type))
			{
				$id = $this->__searchForId($find_test_detail['Test']['testcode'], $this->Session->read('session_test'));
         		// to not show test records which has been already added to cart
         		$this->Session->write('session_test_type.'.$count_test.'.test_id',$find_test_detail['Test']['id']);
				if(empty($id))
				{
					$this->Session->write('session_test.'.$count_test.'.Cart.test_id',$find_test_detail['Test']['id']);
					$this->Session->write('session_test.'.$count_test.'.Cart.test_code',$find_test_detail['Test']['testcode']);
					$this->Session->write('session_test.'.$count_test.'.Cart.test_parameter',$find_test_detail['Test']['test_parameter']);
					$this->Session->write('session_test.'.$count_test.'.Cart.test_reporting',$find_test_detail['Test']['reporting']);
					$this->Session->write('session_test.'.$count_test.'.Cart.test_mrp',$find_test_detail['Test']['mrp']);
					$this->Session->write('session_test.'.$count_test.'.Cart.test_type',$find_test_detail['Test']['type']);
				}
				else
				{
					$this->set('duplicate_test','yes');
				}
			}
			else
			{
				if($type == 'banner')
				{
					$offer = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$test_id)));
					$id = $this->__searchForId($offer['Banner']['banner_code'], $this->Session->read('session_test'));
					// to not show test records which has been already added to cart
					$this->Session->write('session_banner_type.'.$count_test.'.test_id',$offer['Banner']['id']);
					if(empty($id))
					{
						$this->Session->write('session_test.'.$count_test.'.Cart.test_id',$offer['Banner']['id']);
						$this->Session->write('session_test.'.$count_test.'.Cart.test_code',$offer['Banner']['banner_code']);
						$this->Session->write('session_test.'.$count_test.'.Cart.test_parameter',$offer['Banner']['banner_name']);
						$this->Session->write('session_test.'.$count_test.'.Cart.test_reporting',$offer['Banner']['banner_reporting']);
						$this->Session->write('session_test.'.$count_test.'.Cart.test_mrp',$offer['Banner']['banner_mrp']);
						$this->Session->write('session_test.'.$count_test.'.Cart.test_type','Banner');
					}
					else
					{
						$this->set('duplicate_test','yes');
					}
				}
				if($type == 'package')
				{
					$package = $this->Package->find('first',array('conditions'=>array('Package.id'=>$test_id)));
					$id = $this->__searchForId($package['Package']['package_code'], $this->Session->read('session_test'));
					//$this->Session->write('session_package_type.'.$count_test.'.test_id',$package['Package']['id']);
					if(empty($id))
					{
						$this->Session->write('session_test.'.$count_test.'.Cart.test_id',$package['Package']['id']);
						$this->Session->write('session_test.'.$count_test.'.Cart.test_code',$package['Package']['package_code']);
						$this->Session->write('session_test.'.$count_test.'.Cart.test_parameter',$package['Package']['package_name']);
						$this->Session->write('session_test.'.$count_test.'.Cart.test_reporting',$package['Package']['package_reporting']);
						$this->Session->write('session_test.'.$count_test.'.Cart.test_mrp',$package['Package']['package_mrp']);
						$this->Session->write('session_test.'.$count_test.'.Cart.test_type','Package');
					}
					else
					{
						$this->set('duplicate_test','yes');
					}
				}
			}
		}
		$pid = $this->Session->read('prescription');
		
		$this->set('discount',$pid['PrescriptionMaster']['discount_amount']);
		$this->set('my_cart',$this->Session->read('session_test'));
		$this->set('test_cart_count',count($this->Session->read('session_test')));
	}
	
 function __delete_cart_test1($test_id=NULL,$test_code=NULL,$test_param=NULL,$test_rep=NULL,$test_mrp=NULL)
	{
		
		//echo "delete";
		//die;
		
		$dec_test_id = $test_id;
		$dec_test_code = $test_code;
		$dec_test_param = $test_param;
		$dec_test_rep = $test_rep;
		$dec_test_mrp = $test_mrp;
	/*	$dec_test_id = base64_decode($test_id);
		$dec_test_code = base64_decode($test_code);
		$dec_test_param = base64_decode($test_param);
		$dec_test_rep = base64_decode($test_rep);
		$dec_test_mrp = base64_decode($test_mrp);*/
		$unset_test = $this->__removeElementWithValue1($this->Session->read('session_test'), $dec_test_id,$dec_test_code,$dec_test_param,$dec_test_rep,$dec_test_mrp);
	}
	
	
	
	
	function delete_cart_test($test_id=NULL,$test_code=NULL,$test_param=NULL,$test_rep=NULL,$test_mrp=NULL)
	{
		$dec_test_id = base64_decode($test_id);
		$dec_test_code = base64_decode($test_code);
		$dec_test_param = base64_decode($test_param);
		$dec_test_rep = base64_decode($test_rep);
		$dec_test_mrp = base64_decode($test_mrp);
		$unset_test = $this->__removeElementWithValue($this->Session->read('session_test'), $dec_test_id,$dec_test_code,$dec_test_param,$dec_test_rep,$dec_test_mrp);
	}
	
	function proceed_booking()
	{
		$cart_test = $this->Session->read('session_test');
		if(empty($cart_test))
		{
			echo "<script>";
			echo "alert('Please Add Test(s)/Profile(s) in your cart');";
			echo "</script>";
		}
		else
		{
			$userSession = $this->Session->read('UserDetail');
			if(!empty($userSession))
			{
				$test_ids_array = array();
				$profile_ids_array = array();
				$offer_ids_array = array();
				$package_ids_array = array();
				$service_ids_array = array();
				
				//echo "<pre>"; print_r($this->Session->read('session_test')); exit;
				foreach($this->Session->read('session_test') as $key => $val)
				{
					if($val['Cart']['test_type'] == 'TEST')
					{
						$test_ids = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val['Cart']['test_id'])));
						$test_ids_array[] = $test_ids['Test']['id'];
					}
					if($val['Cart']['test_type'] == 'PROFILE')
					{
						$test_ids = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val['Cart']['test_id'])));
						$profile_ids_array[] = $test_ids['Test']['id'];
					}
					if($val['Cart']['test_type'] == 'Banner')
					{
						$offer = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$val['Cart']['test_id'])));
						$offer_ids_array[] = $offer['Banner']['id'];
					}
					if($val['Cart']['test_type'] == 'Package')
					{
						$package = $this->Package->find('first',array('conditions'=>array('Package.id'=>$val['Cart']['test_id'])));
						$package_ids_array[] = $package['Package']['id'];
					}
					if($val['Cart']['test_type'] == 'SERVICE')
					{
						$service = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val['Cart']['test_id'])));
						$service_ids_array[] = $service['Test']['id'];
					}
				}
				$this->Session->write('test_ids_array_book',$test_ids_array);
				$this->Session->write('profile_ids_array_book',$profile_ids_array);
				$this->Session->write('offer_ids_array_book',$offer_ids_array);
				$this->Session->write('package_ids_array_book',$package_ids_array);
				$this->Session->write('service_ids_array_book',$service_ids_array);
			//	$this->redirect('/tests/book_for_self');
				$this->redirect('/testds/booking');
			}
			else
			{
				$cart_test = $this->Session->read('session_test');
				if(!empty($cart_test))
				{
					$test_ids_array = array();
					$profile_ids_array = array();
					$offer_ids_array = array();
					$package_ids_array = array();
					$service_ids_array = array();
					foreach($this->Session->read('session_test') as $key => $val)
					{
						if($val['Cart']['test_type'] == 'TEST')
						{
							$test_ids = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val['Cart']['test_id'])));
							$test_ids_array[] = $test_ids['Test']['id'];
						}
						if($val['Cart']['test_type'] == 'PROFILE')
						{
							$test_ids = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val['Cart']['test_id'])));
							$profile_ids_array[] = $test_ids['Test']['id'];
						}
						if($val['Cart']['test_type'] == 'Banner')
						{
							$offer = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$val['Cart']['test_id'])));
							$offer_ids_array[] = $offer['Banner']['id'];
						}
						if($val['Cart']['test_type'] == 'Package')
						{
							$package = $this->Package->find('first',array('conditions'=>array('Package.id'=>$val['Cart']['test_id'])));
							$package_ids_array[] = $package['Package']['id'];
						}
						if($val['Cart']['test_type'] == 'SERVICE')
						{
							$service = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val['Cart']['test_id'])));
							$service_ids_array[] = $service['Test']['id'];
						}
					}
					$this->Session->write('test_ids_array_book',$test_ids_array);
					$this->Session->write('profile_ids_array_book',$profile_ids_array);
					$this->Session->write('offer_ids_array_book',$offer_ids_array);
					$this->Session->write('package_ids_array_book',$package_ids_array);
					$this->Session->write('service_ids_array_book',$service_ids_array);
				}
				
				/*echo "<script>";
				//echo "alert('Please login in your account to book the test');";
				echo "window.location.href='".SITE_URL.'pages/login_page'."'";
				echo "</script>";*/
				
				//$this->redirect(array('controller'=>'pages','action'=>'login_page'));
				$this->redirect(array('controller'=>'testds','action'=>'login'));
				
			}
		}
	}
	function checkout($req_id = NULL)
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','Niramayahealth Care | Checkout');
		
		$get_req_detail = $this->Health->find('first',array('conditions'=>array('Health.id'=>$req_id)));
		$cart_value = $this->Session->read('session_test');
		
		$billing = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$req_id)));
		$this->set('order_id',$billing['Billing']['order_id']);
		
		if(empty($cart_value))
		{
			$tot_cost = 0;
			if(!empty($get_req_detail['Health']['test_id']))
			{
				$expl_test = explode(',',$get_req_detail['Health']['test_id']);
				foreach($expl_test as $key => $val)
				{
					$find_mrp_test = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
					$costing_test = ($tot_cost+$find_mrp_test['Test']['mrp']);
					$tot_cost = $costing_test;
				}
			}
			if(!empty($get_req_detail['Health']['profile_id']))
			{
				$expl_profile = explode(',',$get_req_detail['Health']['profile_id']);
				foreach($expl_profile as $key => $val)
				{
					$find_mrp_profile = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
					$costing_profile = ($tot_cost+$find_mrp_profile['Test']['mrp']);
					$tot_cost = $costing_profile;
				}
			}
			if(!empty($get_req_detail['Health']['offer_id']))
			{
				$expl_offer = explode(',',$get_req_detail['Health']['offer_id']);
				foreach($expl_offer as $key => $val)
				{
					$find_mrp_offer = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$val)));
					$costing_offer = ($tot_cost+$find_mrp_offer['Banner']['banner_mrp']);
					$tot_cost = $costing_offer;
				}
			}
			if(!empty($get_req_detail['Health']['package_id']))
			{
				$expl_package = explode(',',$get_req_detail['Health']['package_id']);
				foreach($expl_package as $key => $val)
				{
					$find_mrp_package = $this->Package->find('first',array('conditions'=>array('Package.id'=>$val)));
					$costing_package = ($tot_cost+$find_mrp_package['Package']['package_mrp']);
					$tot_cost = $costing_package;
				}
			}
			$x = $tot_cost;
			
			
			$n = 0;
			if(!empty($get_req_detail['Health']['test_id']))
			{
				$expl_test = explode(',',$get_req_detail['Health']['test_id']);
				foreach($expl_test as $key => $val)
				{
					$find_mrp_test = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
					$my_cart[$n]['Cart']['test_code'] = $find_mrp_test['Test']['testcode'];
					$my_cart[$n]['Cart']['test_parameter'] = $find_mrp_test['Test']['test_parameter'];
					$my_cart[$n]['Cart']['test_reporting'] = $find_mrp_test['Test']['reporting'];
					$my_cart[$n]['Cart']['test_mrp'] = $find_mrp_test['Test']['mrp'];
					$n++;
				}
			}
			if(!empty($get_req_detail['Health']['profile_id']))
			{
				$expl_profile = explode(',',$get_req_detail['Health']['profile_id']);
				foreach($expl_profile as $key => $val)
				{
					$find_mrp_profile = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
					$my_cart[$n]['Cart']['test_code'] = $find_mrp_profile['Test']['testcode'];
					$my_cart[$n]['Cart']['test_parameter'] = $find_mrp_profile['Test']['test_parameter'];
					$my_cart[$n]['Cart']['test_reporting'] = $find_mrp_profile['Test']['reporting'];
					$my_cart[$n]['Cart']['test_mrp'] = $find_mrp_profile['Test']['mrp'];
					$n++;
				}
			}
			if(!empty($get_req_detail['Health']['offer_id']))
			{
				$expl_offer = explode(',',$get_req_detail['Health']['offer_id']);
				foreach($expl_offer as $key => $val)
				{
					$find_mrp_offer = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$val)));
					$my_cart[$n]['Cart']['test_code'] = $find_mrp_offer['Banner']['banner_code'];
					$my_cart[$n]['Cart']['test_parameter'] = $find_mrp_offer['Banner']['banner_name'];
					$my_cart[$n]['Cart']['test_reporting'] = $find_mrp_offer['Banner']['banner_reporting'];
					$my_cart[$n]['Cart']['test_mrp'] = $find_mrp_offer['Banner']['banner_mrp'];
					$n++;
				}
			}
			if(!empty($get_req_detail['Health']['package_id']))
			{
				$expl_package = explode(',',$get_req_detail['Health']['package_id']);
				foreach($expl_package as $key => $val)
				{
					$find_mrp_package = $this->Package->find('first',array('conditions'=>array('Package.id'=>$val)));
					$my_cart[$n]['Cart']['test_code'] = $find_mrp_package['Package']['package_code'];
					$my_cart[$n]['Cart']['test_parameter'] = $find_mrp_package['Package']['package_name'];
					$my_cart[$n]['Cart']['test_reporting'] = $find_mrp_package['Package']['package_reporting'];
					$my_cart[$n]['Cart']['test_mrp'] = $find_mrp_package['Package']['package_mrp'];
					$n++;
				}
			}

			$this->set('my_cart',$my_cart);
		}
		$test_amt = 0;
		//print_R($cart_value);echo "<br>";
		if(!empty($cart_value))
		{
			$x = 0;
			foreach($this->Session->read('session_test') as $key => $val)
			{
				$cost = ($x+$val['Cart']['test_mrp']);
				$x = $cost;
			}
			$this->set('my_cart',$this->Session->read('session_test'));
		}
		$prescription = $this->Session->read('prescription');
		//echo "hello";
		//print_R($test_amt);die;
		if(!empty($prescription))
		{
			if(isset($prescription['PrescriptionMaster']['discount_amount']))
			{
				$x = $x-$prescription['PrescriptionMaster']['discount_amount'];
			}
		}
		else
		{
			$test_amt = $x;
			$x = $x + $get_req_detail['Health']['other_charges'] - $get_req_detail['Health']['discount_amount'] - $get_req_detail['Health']['redeemed_amount'];
		}
		$this->set('total_cost',$x);
		$this->set('test_amt',$test_amt);
		$this->set('voucher_code',$get_req_detail['Health']['voucher_code']);
		$this->set('voucher_amount',$get_req_detail['Health']['redeemed_amount']);
		$this->set('other_charges',$get_req_detail['Health']['other_charges']);
		$this->set('discount_amt',$get_req_detail['Health']['discount_amount']);
		
		$this->set('pat_name',$get_req_detail['Test']['name']);
		
		$timeslot = Configure::Read("TimeSlot");
		
		if(!empty($get_req_detail['Health']['sample_date']) && !empty($get_req_detail['Health']['sample_time']))
		{
			$city = $get_req_detail['Health']['city'];
			if($city == 'Crossing Republic')
			{
				$visit_date = date('d-m-Y',strtotime($get_req_detail['Health']['sample_date']));
				$visit_time = $timeslot[$get_req_detail['Health']['sample_time']];
				$this->set('collectType','Visit a Lab');
				$this->set('labType','Crossing Republic');
				$this->set('visit_date',$visit_date);
				$this->set('visit_time',$visit_time);	
			}
			if($city == 'Indirapuram')
			{
				$visit_date = date('d-m-Y',strtotime($get_req_detail['Health']['sample_date']));
				$visit_time = $timeslot[$get_req_detail['Health']['sample_time']];
				$this->set('collectType','Visit a Lab');
				$this->set('labType','Indirapuram');
				$this->set('visit_date',$visit_date);
				$this->set('visit_time',$visit_time);
			}
			if($city == 'Noida')
			{
				$visit_date = date('d-m-Y',strtotime($get_req_detail['Health']['sample_date']));
				$visit_time = $timeslot[$get_req_detail['Health']['sample_time']];
				$this->set('collectType','Visit a Lab');
				$this->set('labType','Noida');
				$this->set('visit_date',$visit_date);
				$this->set('visit_time',$visit_time);
			}
			
			$this->set('pat_name',$get_req_detail['Health']['name']);
			$this->set('pat_age',$get_req_detail['Health']['age']);
			$this->set('pat_contact',$get_req_detail['Health']['landline']);
			$this->set('request_id',$get_req_detail['Health']['id']);
		}
		if(!empty($get_req_detail['Health']['sample_date1']) && !empty($get_req_detail['Health']['sample_time1']))
		{
			$collect_date = date('d-m-Y',strtotime($get_req_detail['Health']['sample_date1']));
			$collect_time = $timeslot[$get_req_detail['Health']['sample_time1']];
			
			$city_name = $this->City->find('first',array('conditions'=>array('City.id'=>$get_req_detail['Health']['city_id'])));
			$state_name = $this->State->find('first',array('conditions'=>array('State.id'=>$get_req_detail['Health']['state'])));
			$this->set('collectType','Home Collection');
			$this->set('labType','');
			$this->set('collect_date',$collect_date);
			$this->set('collect_time',$collect_time);
			$this->set('collect_address',$get_req_detail['Health']['address']);
			$this->set('collect_city',$city_name['City']['name']);
			$this->set('test_names',$test_name);
			$this->set('profiles_names',$profile_name);
			$this->set('offers_names',$offer_name);
			$this->set('pat_name',$get_req_detail['Health']['name']);
			$this->set('pat_age',$get_req_detail['Health']['age']);
			$this->set('pat_contact',$get_req_detail['Health']['landline']);
			$this->set('collect_locality',$get_req_detail['Health']['locality']);
			$this->set('collect_pincode',$get_req_detail['Health']['pincode']);
			$this->set('collect_landmark',$get_req_detail['Health']['landmark']);
			$this->set('state_name',$state_name['State']['name']);
			$this->set('request_id',$get_req_detail['Health']['id']);
			
		}
		
		//print_R($prescription);die;
		$this->set('prescription',$prescription);
		$this->set('req_id',$req_id);
	}

	function confirm_booking($total_amt=NULL,$request_id=NULL,$home_report=NULL,$discount=NULL)
	{
            if($_SERVER['REMOTE_ADDR'] == '171.79.71.209')
            {
				
				//$session_tests = $this->Session->read('test_ids_array_book');
				
				//print_r($session_tests);
               /* Configure::write('debug',2);
                echo "<pre>".$total_amt;
                print_r($this->data);
                die;*/
            }
                $this->layout = 'tests';
		$this->set('title_for_layout','Niramayahealthcare | Confirm Booking');
		$userData = $this->Session->read('UserDetail');
		
		//25-09-2013 Ends
		$request_detail = $this->Health->find('first',array('conditions'=>array('Health.id'=>$request_id)));
		
		$billing_data = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$request_id)));
		
		$this->data['Billing'] = $billing_data['Billing'];
		
		$sessionData = $this->Session->read('prescription');
				
		$this->PrescriptionMaster = ClassRegistry::init('PrescriptionMaster');
		//print_R("update prescription_master set order_id='".$last_insert_id."',status='3' where id='".$sessionData['PrescriptionMaster']['id']."'");die;
		$this->PrescriptionMaster->query("update prescription_master set request_id='".$request_id."',order_id='".$this->data['Billing']['order_id']."',status='3' where id='".$sessionData['PrescriptionMaster']['id']."'");
		
		$timeslot = Configure::Read("TimeSlot");
		$request_info_insrt = $this->Health->find('first',array('conditions'=>array('Health.id'=>$request_id)));
		if($request_info_insrt['Health']['assigned_lab'] != 'Home')
		{
			$get_info_lab = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$request_info_insrt['Health']['assigned_lab'])));
		}
		if(!empty($request_info_insrt['Health']['sample_date']) && $request_info_insrt['Health']['sample_date1'] == 'Please select a suitable date')
		{
			
			$get_collection_time_info = $timeslot[$request_info_insrt['Health']['sample_time']];
								
			$number = $request_info_insrt['Health']['landline'];
			$get_info_city = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$this->data['Health']['city'])));
			
			/*$message = 'Test Req. No:'.$this->data['Billing']['order_id'].' Thank you for booking your tests with nirAmaya Healthcare. You have opted for visiting our '.$get_info_lab['Lab']['pcc_name'].' Centre '.$get_info_lab['Lab']['pcc_address'].' on '.$request_info_insrt['Health']['sample_date'].' '.$get_collection_time_info.' for the tests. For more details call +91-9555009009 or visit www.NHcare.in';*/
				$message = 'Test Req. No:'.$this->data['Billing']['order_id'].' Thank you for booking your tests with nirAmaya Healthcare. You have opted for visiting our '.$get_info_lab['Lab']['pcc_name'].' Centre '.$get_info_lab['Lab']['pcc_address'].' on '.$request_info_insrt['Health']['sample_date'].' '.$get_collection_time_info.' for the tests. For more details call +91-9555009009 or visit www.NHcare.in';
		}
		if(!empty($request_info_insrt['Health']['sample_date1']) && $request_info_insrt['Health']['sample_date'] == 'Please select a suitable date')
		{
			$get_collection_time_info1 = $timeslot[$request_info_insrt['Health']['sample_time']];
			
			$number = $request_info_insrt['Health']['landline'];
			//$message = 'Test Req. No:'.$this->data['Billing']['order_id'].' Thank you for booking your tests & Scheduling Home Sample Collection on '.$request_info_insrt['Health']['sample_date1'].' '.$get_collection_time_info1.' with nirAmaya Healthcare. For more details call +91-9555009009 or visit www.NHcare.in';
			$message = 'Test Req. No:'.$this->data['Billing']['order_id'].' Thank you for booking your tests with nirAmaya Pathlabs on '.$request_info_insrt['Health']['sample_date1'].' '.$get_collection_time_info1.' Call 9555009009 or visit www.nhcare.in for assistance';
		
		}
			//echo $message;
			//die;
		$this->__sms_message($number,$message);

		if(!empty($this->data['Billing']['test_id']))
		{
			$explode_tests = explode(',',$this->data['Billing']['test_id']);
			$count_test = count($explode_tests);
			
			foreach($explode_tests as $val)
			{
				$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
				$test_name_string .= '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp']."<br />";
			}
		}
		
		if(!empty($this->data['Billing']['profile_id']))
		{
			$explode_profiles = explode(',',$this->data['Billing']['profile_id']);
			$count_profile = count($explode_profiles);
			
			foreach($explode_profiles as $val)
			{
				$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
				$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp']."<br />";	
			}
		}
		
		
		if(!empty($this->data['Billing']['offer_id']))
		{
			$explode_offers = explode(',',$this->data['Billing']['offer_id']);
			$count_offers = count($explode_offers);
			
			foreach($explode_offers as $val)
			{
				$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$val)));
				$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp']."<br />";	
			}
		}
		
		if(!empty($this->data['Billing']['package_id']))
		{
			$explode_packages = explode(',',$this->data['Billing']['package_id']);
			$count_packages = count($explode_packages);
			
			foreach($explode_packages as $val)
			{
				$package_name_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$val)));
				$package_name = '<strong>1- </strong>'.$package_name_1['Package']['package_name'].' - Rs.'.$package_name_1['Package']['package_mrp']."<br />";	
			}
		}
		$this->set('first_name',$this->data['Billing']['first_name']);
		$this->set('last_name',$this->data['Billing']['last_name']);
		$this->set('order_id',$this->data['Billing']['order_id']);
		$this->set('tests',$test_name);
		$this->set('profiles',$profile_name);
		$this->set('offers',$offer_name);
		$this->set('sub_total',$this->data['Billing']['sub_total']);
		if(isset($this->data['order']['payment_method']) && !empty($this->data['order']['payment_method']) && $this->data['order']['payment_method']=='O')
		{
			//email format for online payment
			$total_cost=$sub_total;
			$req_id=$request_id;
			//sending mail for test details
			$user_email = $userData['User']['email'];
			$this->Email->template = 'payment_email';
			$this->Email->from = 'info@niramayahealthcare.com';
			$this->Email->fromName = $this->data['Billing']['first_name'];
			$this->Email->subject = 'Niramaya Payment Details';
			$this->Email->to = $user_email;
			$this->Email->replyTo = 'info@niramayahealthcare.com';
			$this->Email->sendAs = 'html'; // because we like to send pretty mail
			$this->Email->delivery = 'mail';
			$this->Email->send();
			//$this->redirect(array('controller'=>'payment','action'=>'process_payment',base64_encode($total_cost),base64_encode($req_id),base64_encode($this->data['Billing']['order_id'])));
			if(Configure::read('ActivePG') == 'TOM')
				$this->redirect(array('controller'=>'payment','action'=>'process_payment',base64_encode($total_cost),base64_encode($req_id),base64_encode($this->data['Billing']['order_id'])));
			elseif(Configure::read('ActivePG') == 'PAYTM')
				$this->redirect(array('controller'=>'payment_paytm','action'=>'process_payment',base64_encode($total_cost),base64_encode($req_id),base64_encode($this->data['Billing']['order_id'])));
		}
		else
		{
			if(!empty($userData['User']['email']))
			{
					$user_email = $userData['User']['email'];
					$this->Email->template = 'payment_email';
					$this->Email->from = 'info@niramayahealthcare.com';
					$this->Email->fromName = $this->data['Billing']['first_name'];
					$this->Email->subject = 'Niramaya Payment Details';
					$this->Email->to = $user_email;
					$this->Email->replyTo = 'info@niramayahealthcare.com';
					$this->Email->sendAs = 'html'; // because we like to send pretty mail
					$this->Email->delivery = 'mail';
					if($this->Email->send())
					{
							$update_cod_status = $this->Health->query("UPDATE healths SET cod_status='1',total_amount='".$this->data['Billing']['sub_total']."' WHERE id='".$request_id."'");
							$this->Session->delete('session_test');
							$this->Session->delete('session_test_type');
							$this->Session->delete('session_banner_type');
							$this->Session->setFlash('Thank you for confirming test booking. You have opted for Cash on delivery as payment option. Kindly pay the test amount during sample collection.','flash_success');
							$this->redirect(array('controller'=>'tests','action'=>'payment_history'));
					}
			}
			else
			{
					$update_cod_status = $this->Health->query("UPDATE healths SET cod_status='1',total_amount='".$this->data['Billing']['sub_total']."' WHERE id='".$request_id."'");
					$this->Session->delete('session_test');
					$this->Session->delete('session_test_type');
					$this->Session->delete('session_banner_type');
					$this->Session->setFlash('Thank you for confirming test booking. You have opted for Cash on delivery as payment option. Kindly pay the test amount during sample collection.','flash_success');
					$this->redirect(array('controller'=>'tests','action'=>'payment_history'));
			}
		}
	}

	function book_test_cod($total_amt=NULL,$req_id=NULL)
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','Niramayahealth Care | Billing Information');
		$userData = $this->Session->read('UserDetail');
		$this->set('member_detail',$userData);
		$sub_total = base64_decode($total_amt);
		$update_tot_amt = $this->Health->updateAll(array('Health.total_amount'=>$sub_total),array('Health.id'=>$req_id));
		if(!empty($this->data))
		{
			$get_last_order = $this->Billing->find('first',array('order'=>array('Billing.id DESC')));
			if(!empty($get_last_order))
			{
				$order_num = ($get_last_order['Billing']['order_id']+1);
				$this->data['Billing']['order_id'] = $order_num;
			}
			if(empty($get_last_order))
			{
				$this->data['Billing']['order_id'] = '1000';
			}
			
			$this->data['Billing']['book_date'] = date('Y-m-d H:i:s');
			$this->data['Billing']['request_id'] = $this->data['Billing']['b_req_id'];
			if(!empty($this->data['Billing']['address1']) && !empty($this->data['Billing']['address2']))
			{
				$this->data['Billing']['address'] = $this->data['Billing']['address1'].'*'.$this->data['Billing']['address2'];
			}
			if(!empty($this->data['Billing']['address1']) && empty($this->data['Billing']['address2']))
			{
				$this->data['Billing']['address'] = $this->data['Billing']['address1'];
			}
			if(empty($this->data['Billing']['address1']) && !empty($this->data['Billing']['address2']))
			{
				$this->data['Billing']['address'] = $this->data['Billing']['address2'];
			}
			if($this->Billing->create($this->data))
			{
				if($this->Billing->save($this->data,false))
				{
					if(!empty($this->data['Billing']['test_id']))
					{
						$explode_tests = explode(',',$this->data['Billing']['test_id']);
						$count_test = count($explode_tests);
						if($count_test == 1)
						{
							$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'];	
						}
						if($count_test == 2)
						{
							$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'];
						}
						if($count_test == 3)
						{
							$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'];
						}
						if($count_test == 4)
						{
							$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$test_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
							$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$test_name_4['Test']['testcode'].' - '.$test_name_4['Test']['test_parameter'].' - Rs.'.$test_name_4['Test']['mrp'];
						}
						if($count_test == 5)
						{
							$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$test_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
							$test_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
							$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$test_name_4['Test']['testcode'].' - '.$test_name_4['Test']['test_parameter'].' - Rs.'.$test_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$test_name_5['Test']['testcode'].' - '.$test_name_5['Test']['test_parameter'].' - Rs.'.$test_name_5['Test']['mrp'];
						}
						if($count_test == 6)
						{
							$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$test_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
							$test_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
							$test_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
							$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$test_name_4['Test']['testcode'].' - '.$test_name_4['Test']['test_parameter'].' - Rs.'.$test_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$test_name_5['Test']['testcode'].' - '.$test_name_5['Test']['test_parameter'].' - Rs.'.$test_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$test_name_6['Test']['testcode'].' - '.$test_name_6['Test']['test_parameter'].' - Rs.'.$test_name_6['Test']['mrp'];
						}
						if($count_test == 7)
						{
							$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$test_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
							$test_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
							$test_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
							$test_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
							$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$test_name_4['Test']['testcode'].' - '.$test_name_4['Test']['test_parameter'].' - Rs.'.$test_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$test_name_5['Test']['testcode'].' - '.$test_name_5['Test']['test_parameter'].' - Rs.'.$test_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$test_name_6['Test']['testcode'].' - '.$test_name_6['Test']['test_parameter'].' - Rs.'.$test_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$test_name_7['Test']['testcode'].' - '.$test_name_7['Test']['test_parameter'].' - Rs.'.$test_name_7['Test']['mrp'];
						}
						if($count_test == 8)
						{
							$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$test_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
							$test_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
							$test_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
							$test_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
							$test_name_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[7])));
							$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$test_name_4['Test']['testcode'].' - '.$test_name_4['Test']['test_parameter'].' - Rs.'.$test_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$test_name_5['Test']['testcode'].' - '.$test_name_5['Test']['test_parameter'].' - Rs.'.$test_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$test_name_6['Test']['testcode'].' - '.$test_name_6['Test']['test_parameter'].' - Rs.'.$test_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$test_name_7['Test']['testcode'].' - '.$test_name_7['Test']['test_parameter'].' - Rs.'.$test_name_7['Test']['mrp'].'<br />'.'<strong>8- </strong>'.$test_name_8['Test']['testcode'].' - '.$test_name_8['Test']['test_parameter'].' - Rs.'.$test_name_8['Test']['mrp'];
						}
						if($count_test == 9)
						{
							$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$test_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
							$test_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
							$test_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
							$test_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
							$test_name_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[7])));
							$test_name_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[8])));
							$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$test_name_4['Test']['testcode'].' - '.$test_name_4['Test']['test_parameter'].' - Rs.'.$test_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$test_name_5['Test']['testcode'].' - '.$test_name_5['Test']['test_parameter'].' - Rs.'.$test_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$test_name_6['Test']['testcode'].' - '.$test_name_6['Test']['test_parameter'].' - Rs.'.$test_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$test_name_7['Test']['testcode'].' - '.$test_name_7['Test']['test_parameter'].' - Rs.'.$test_name_7['Test']['mrp'].'<br />'.'<strong>8- </strong>'.$test_name_8['Test']['testcode'].' - '.$test_name_8['Test']['test_parameter'].' - Rs.'.$test_name_8['Test']['mrp'].'<br />'.'<strong>9- </strong>'.$test_name_9['Test']['testcode'].' - '.$test_name_9['Test']['test_parameter'].' - Rs.'.$test_name_9['Test']['mrp'];
						}
						if($count_test == 10)
						{
							$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
							$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
							$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
							$test_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
							$test_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
							$test_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
							$test_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
							$test_name_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[7])));
							$test_name_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[8])));
							$test_name_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[9])));
							$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$test_name_4['Test']['testcode'].' - '.$test_name_4['Test']['test_parameter'].' - Rs.'.$test_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$test_name_5['Test']['testcode'].' - '.$test_name_5['Test']['test_parameter'].' - Rs.'.$test_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$test_name_6['Test']['testcode'].' - '.$test_name_6['Test']['test_parameter'].' - Rs.'.$test_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$test_name_7['Test']['testcode'].' - '.$test_name_7['Test']['test_parameter'].' - Rs.'.$test_name_7['Test']['mrp'].'<br />'.'<strong>8- </strong>'.$test_name_8['Test']['testcode'].' - '.$test_name_8['Test']['test_parameter'].' - Rs.'.$test_name_8['Test']['mrp'].'<br />'.'<strong>9- </strong>'.$test_name_9['Test']['testcode'].' - '.$test_name_9['Test']['test_parameter'].' - Rs.'.$test_name_9['Test']['mrp'].'<br />'.'<strong>10- </strong>'.$test_name_10['Test']['testcode'].' - '.$test_name_10['Test']['test_parameter'].' - Rs.'.$test_name_10['Test']['mrp'];
						}
					}
					
					if(!empty($this->data['Billing']['profile_id']))
					{
						$explode_profiles = explode(',',$this->data['Billing']['profile_id']);
						$count_profile = count($explode_profiles);
						if($count_profile == 1)
						{
							$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'];	
						}
						if($count_profile == 2)
						{
							$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'];
						}
						if($count_profile == 3)
						{
							$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'];
						}
						if($count_profile == 4)
						{
							$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$profile_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
							$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$profile_name_4['Test']['testcode'].' - '.$profile_name_4['Test']['test_parameter'].' - Rs.'.$profile_name_4['Test']['mrp'];
						}
						if($count_profile == 5)
						{
							$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$profile_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
							$profile_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
							$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$profile_name_4['Test']['testcode'].' - '.$profile_name_4['Test']['test_parameter'].' - Rs.'.$profile_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$profile_name_5['Test']['testcode'].' - '.$profile_name_5['Test']['test_parameter'].' - Rs.'.$profile_name_5['Test']['mrp'];
						}
						if($count_profile == 6)
						{
							$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$profile_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
							$profile_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
							$profile_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
							$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$profile_name_4['Test']['testcode'].' - '.$profile_name_4['Test']['test_parameter'].' - Rs.'.$profile_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$profile_name_5['Test']['testcode'].' - '.$profile_name_5['Test']['test_parameter'].' - Rs.'.$profile_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$profile_name_6['Test']['testcode'].' - '.$profile_name_6['Test']['test_parameter'].' - Rs.'.$profile_name_6['Test']['mrp'];
						}
						if($count_profile == 7)
						{
							$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$profile_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
							$profile_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
							$profile_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
							$profile_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
							$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$profile_name_4['Test']['testcode'].' - '.$profile_name_4['Test']['test_parameter'].' - Rs.'.$profile_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$profile_name_5['Test']['testcode'].' - '.$profile_name_5['Test']['test_parameter'].' - Rs.'.$profile_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$profile_name_6['Test']['testcode'].' - '.$profile_name_6['Test']['test_parameter'].' - Rs.'.$profile_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$profile_name_7['Test']['testcode'].' - '.$profile_name_7['Test']['test_parameter'].' - Rs.'.$profile_name_7['Test']['mrp'];
						}
						if($count_profile == 8)
						{
							$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$profile_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
							$profile_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
							$profile_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
							$profile_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
							$profile_name_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[7])));
							$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$profile_name_4['Test']['testcode'].' - '.$profile_name_4['Test']['test_parameter'].' - Rs.'.$profile_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$profile_name_5['Test']['testcode'].' - '.$profile_name_5['Test']['test_parameter'].' - Rs.'.$profile_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$profile_name_6['Test']['testcode'].' - '.$profile_name_6['Test']['test_parameter'].' - Rs.'.$profile_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$profile_name_7['Test']['testcode'].' - '.$profile_name_7['Test']['test_parameter'].' - Rs.'.$profile_name_7['Test']['mrp'].'<br />'.'<strong>8- </strong>'.$profile_name_8['Test']['testcode'].' - '.$profile_name_8['Test']['test_parameter'].' - Rs.'.$profile_name_8['Test']['mrp'];
						}
						if($count_profile == 9)
						{
							$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$profile_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
							$profile_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
							$profile_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
							$profile_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
							$profile_name_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[7])));
							$profile_name_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[8])));
							$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$profile_name_4['Test']['testcode'].' - '.$profile_name_4['Test']['test_parameter'].' - Rs.'.$profile_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$profile_name_5['Test']['testcode'].' - '.$profile_name_5['Test']['test_parameter'].' - Rs.'.$profile_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$profile_name_6['Test']['testcode'].' - '.$profile_name_6['Test']['test_parameter'].' - Rs.'.$profile_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$profile_name_7['Test']['testcode'].' - '.$profile_name_7['Test']['test_parameter'].' - Rs.'.$profile_name_7['Test']['mrp'].'<br />'.'<strong>8- </strong>'.$profile_name_8['Test']['testcode'].' - '.$profile_name_8['Test']['test_parameter'].' - Rs.'.$profile_name_8['Test']['mrp'].'<br />'.'<strong>9- </strong>'.$profile_name_9['Test']['testcode'].' - '.$profile_name_9['Test']['test_parameter'].' - Rs.'.$profile_name_9['Test']['mrp'];
						}
						if($count_profile == 10)
						{
							$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
							$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
							$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
							$profile_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
							$profile_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
							$profile_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
							$profile_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
							$profile_name_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[7])));
							$profile_name_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[8])));
							$profile_name_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[9])));
							$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$profile_name_4['Test']['testcode'].' - '.$profile_name_4['Test']['test_parameter'].' - Rs.'.$profile_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$profile_name_5['Test']['testcode'].' - '.$profile_name_5['Test']['test_parameter'].' - Rs.'.$profile_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$profile_name_6['Test']['testcode'].' - '.$profile_name_6['Test']['test_parameter'].' - Rs.'.$profile_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$profile_name_7['Test']['testcode'].' - '.$profile_name_7['Test']['test_parameter'].' - Rs.'.$profile_name_7['Test']['mrp'].'<br />'.'<strong>8- </strong>'.$profile_name_8['Test']['testcode'].' - '.$profile_name_8['Test']['test_parameter'].' - Rs.'.$profile_name_8['Test']['mrp'].'<br />'.'<strong>9- </strong>'.$profile_name_9['Test']['testcode'].' - '.$profile_name_9['Test']['test_parameter'].' - Rs.'.$profile_name_9['Test']['mrp'].'<br />'.'<strong>10- </strong>'.$profile_name_10['Test']['testcode'].' - '.$profile_name_10['Test']['test_parameter'].' - Rs.'.$profile_name_10['Test']['mrp'];
						}
					}
					
					
					if(!empty($this->data['Billing']['offer_id']))
					{
						$explode_offers = explode(',',$this->data['Billing']['offer_id']);
						$count_offers = count($explode_offers);
						if($count_offers == 1)
						{
							$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'];	
						}
						if($count_offers == 2)
						{
							$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$offer_name_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
							$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'].'<br />'.'<strong>2- </strong>'.$offer_name_2['Banner']['banner_code'].' - '.$offer_name_2['Banner']['banner_name'].' - Rs.'.$offer_name_2['Banner']['banner_mrp'];
						}
						if($count_offers == 3)
						{
							$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$offer_name_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
							$offer_name_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
							$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'].'<br />'.'<strong>2- </strong>'.$offer_name_2['Banner']['banner_code'].' - '.$offer_name_2['Banner']['banner_name'].' - Rs.'.$offer_name_2['Banner']['banner_mrp'].'<br />'.'<strong>3- </strong>'.$offer_name_3['Banner']['banner_code'].' - '.$offer_name_3['Banner']['banner_name'].' - Rs.'.$offer_name_3['Banner']['banner_mrp'];
						}
						if($count_offers == 4)
						{
							$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$offer_name_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
							$offer_name_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
							$offer_name_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
							$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'].'<br />'.'<strong>2- </strong>'.$offer_name_2['Banner']['banner_code'].' - '.$offer_name_2['Banner']['banner_name'].' - Rs.'.$offer_name_2['Banner']['banner_mrp'].'<br />'.'<strong>3- </strong>'.$offer_name_3['Banner']['banner_code'].' - '.$offer_name_3['Banner']['banner_name'].' - Rs.'.$offer_name_3['Banner']['banner_mrp'].'<br />'.'<strong>4- </strong>'.$offer_name_4['Banner']['banner_code'].' - '.$offer_name_4['Banner']['banner_name'].' - Rs.'.$offer_name_4['Banner']['banner_mrp'];
						}
						if($count_offers == 5)
						{
							$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$offer_name_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
							$offer_name_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
							$offer_name_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
							$offer_name_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
							$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'].'<br />'.'<strong>2- </strong>'.$offer_name_2['Banner']['banner_code'].' - '.$offer_name_2['Banner']['banner_name'].' - Rs.'.$offer_name_2['Banner']['banner_mrp'].'<br />'.'<strong>3- </strong>'.$offer_name_3['Banner']['banner_code'].' - '.$offer_name_3['Banner']['banner_name'].' - Rs.'.$offer_name_3['Banner']['banner_mrp'].'<br />'.'<strong>4- </strong>'.$offer_name_4['Banner']['banner_code'].' - '.$offer_name_4['Banner']['banner_name'].' - Rs.'.$offer_name_4['Banner']['banner_mrp'].'<br />'.'<strong>5- </strong>'.$offer_name_5['Banner']['banner_code'].' - '.$offer_name_5['Banner']['banner_name'].' - Rs.'.$offer_name_5['Banner']['banner_mrp'];
						}
						if($count_offers == 6)
						{
							$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$offer_name_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
							$offer_name_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
							$offer_name_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
							$offer_name_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
							$offer_name_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[5])));
							$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'].'<br />'.'<strong>2- </strong>'.$offer_name_2['Banner']['banner_code'].' - '.$offer_name_2['Banner']['banner_name'].' - Rs.'.$offer_name_2['Banner']['banner_mrp'].'<br />'.'<strong>3- </strong>'.$offer_name_3['Banner']['banner_code'].' - '.$offer_name_3['Banner']['banner_name'].' - Rs.'.$offer_name_3['Banner']['banner_mrp'].'<br />'.'<strong>4- </strong>'.$offer_name_4['Banner']['banner_code'].' - '.$offer_name_4['Banner']['banner_name'].' - Rs.'.$offer_name_4['Banner']['banner_mrp'].'<br />'.'<strong>5- </strong>'.$offer_name_5['Banner']['banner_code'].' - '.$offer_name_5['Banner']['banner_name'].' - Rs.'.$offer_name_5['Banner']['banner_mrp'].'<br />'.'<strong>6- </strong>'.$offer_name_6['Banner']['banner_code'].' - '.$offer_name_6['Banner']['banner_name'].' - Rs.'.$offer_name_6['Banner']['banner_mrp'];
						}
						if($count_offers == 7)
						{
							$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$offer_name_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
							$offer_name_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
							$offer_name_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
							$offer_name_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
							$offer_name_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[5])));
							$offer_name_7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[6])));
							$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'].'<br />'.'<strong>2- </strong>'.$offer_name_2['Banner']['banner_code'].' - '.$offer_name_2['Banner']['banner_name'].' - Rs.'.$offer_name_2['Banner']['banner_mrp'].'<br />'.'<strong>3- </strong>'.$offer_name_3['Banner']['banner_code'].' - '.$offer_name_3['Banner']['banner_name'].' - Rs.'.$offer_name_3['Banner']['banner_mrp'].'<br />'.'<strong>4- </strong>'.$offer_name_4['Banner']['banner_code'].' - '.$offer_name_4['Banner']['banner_name'].' - Rs.'.$offer_name_4['Banner']['banner_mrp'].'<br />'.'<strong>5- </strong>'.$offer_name_5['Banner']['banner_code'].' - '.$offer_name_5['Banner']['banner_name'].' - Rs.'.$offer_name_5['Banner']['banner_mrp'].'<br />'.'<strong>6- </strong>'.$offer_name_6['Banner']['banner_code'].' - '.$offer_name_6['Banner']['banner_name'].' - Rs.'.$offer_name_6['Banner']['banner_mrp'].'<br />'.'<strong>7- </strong>'.$offer_name_7['Banner']['banner_code'].' - '.$offer_name_7['Banner']['banner_name'].' - Rs.'.$offer_name_7['Banner']['banner_mrp'];
						}
						if($count_offers == 8)
						{
							$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
							$offer_name_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
							$offer_name_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
							$offer_name_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
							$offer_name_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
							$offer_name_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[5])));
							$offer_name_7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[6])));
							$offer_name_8 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[7])));
							$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'].'<br />'.'<strong>2- </strong>'.$offer_name_2['Banner']['banner_code'].' - '.$offer_name_2['Banner']['banner_name'].' - Rs.'.$offer_name_2['Banner']['banner_mrp'].'<br />'.'<strong>3- </strong>'.$offer_name_3['Banner']['banner_code'].' - '.$offer_name_3['Banner']['banner_name'].' - Rs.'.$offer_name_3['Banner']['banner_mrp'].'<br />'.'<strong>4- </strong>'.$offer_name_4['Banner']['banner_code'].' - '.$offer_name_4['Banner']['banner_name'].' - Rs.'.$offer_name_4['Banner']['banner_mrp'].'<br />'.'<strong>5- </strong>'.$offer_name_5['Banner']['banner_code'].' - '.$offer_name_5['Banner']['banner_name'].' - Rs.'.$offer_name_5['Banner']['banner_mrp'].'<br />'.'<strong>6- </strong>'.$offer_name_6['Banner']['banner_code'].' - '.$offer_name_6['Banner']['banner_name'].' - Rs.'.$offer_name_6['Banner']['banner_mrp'].'<br />'.'<strong>7- </strong>'.$offer_name_7['Banner']['banner_code'].' - '.$offer_name_7['Banner']['banner_name'].' - Rs.'.$offer_name_7['Banner']['banner_mrp'].'<br />'.'<strong>8- </strong>'.$offer_name_8['Banner']['banner_code'].' - '.$offer_name_8['Test']['banner_name'].' - Rs.'.$offer_name_8['Banner']['banner_mrp'];
						}
					}
					
					if(!empty($this->data['Billing']['package_id']))
					{
						$explode_packages = explode(',',$this->data['Billing']['package_id']);
						$count_packages = count($explode_packages);
						if($count_packages == 1)
						{
							$package_name_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
							$package_name = '<strong>1- </strong>'.$package_name_1['Package']['package_name'].' - Rs.'.$package_name_1['Package']['package_mrp'];	
						}
						if($count_packages == 2)
						{
							$package_name_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
							$package_name_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
							$package_name = '<strong>1- </strong>'.$package_name_1['Package']['package_name'].' - Rs.'.$package_name_1['Package']['package_mrp'].'<br />'.'<strong>2- </strong>'.$package_name_2['Package']['package_name'].' - Rs.'.$package_name_2['Package']['package_mrp'];
						}
						if($count_packages == 3)
						{
							$package_name_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
							$package_name_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
							$package_name_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[2])));
							$package_name = '<strong>1- </strong>'.$package_name_1['Package']['package_name'].' - Rs.'.$package_name_1['Package']['package_mrp'].'<br />'.'<strong>2- </strong>'.$package_name_2['Package']['package_name'].' - Rs.'.$package_name_2['Package']['package_mrp'].'<br />'.'<strong>3- </strong>'.$package_name_3['Package']['package_name'].' - Rs.'.$package_name_3['Package']['package_mrp'];
						}
						if($count_packages == 4)
						{
							$package_name_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
							$package_name_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
							$package_name_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[2])));
							$package_name_4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[3])));
							$package_name = '<strong>1- </strong>'.$package_name_1['Package']['package_name'].' - Rs.'.$package_name_1['Package']['package_mrp'].'<br />'.'<strong>2- </strong>'.$package_name_2['Package']['package_name'].' - Rs.'.$package_name_2['Package']['package_mrp'].'<br />'.'<strong>3- </strong>'.$package_name_3['Package']['package_name'].' - Rs.'.$package_name_3['Package']['package_mrp'].'<br />'.'<strong>4- </strong>'.$package_name_4['Package']['package_name'].' - Rs.'.$package_name_4['Package']['package_mrp'];
						}
						if($count_packages == 5)
						{
							$package_name_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
							$package_name_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
							$package_name_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[2])));
							$package_name_4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[3])));
							$package_name_5 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[4])));
							$package_name = '<strong>1- </strong>'.$package_name_1['Package']['package_name'].' - Rs.'.$package_name_1['Package']['package_mrp'].'<br />'.'<strong>2- </strong>'.$package_name_2['Package']['package_name'].' - Rs.'.$package_name_2['Package']['package_mrp'].'<br />'.'<strong>3- </strong>'.$package_name_3['Package']['package_name'].' - Rs.'.$package_name_3['Package']['package_mrp'].'<br />'.'<strong>4- </strong>'.$package_name_4['Package']['package_name'].' - Rs.'.$package_name_4['Package']['package_mrp'].'<br />'.'<strong>5- </strong>'.$package_name_5['Package']['package_name'].' - Rs.'.$package_name_5['Package']['package_mrp'];
						}
					}
					$this->set('first_name',$this->data['Billing']['first_name']);
					$this->set('last_name',$this->data['Billing']['last_name']);
					$this->set('order_id',$this->data['Billing']['order_id']);
					$this->set('tests',$test_name);
					$this->set('profiles',$profile_name);
					$this->set('offers',$offer_name);
					$this->set('sub_total',$this->data['Billing']['sub_total']);
					
					
					$user_email = $userData['User']['email'];
					$this->Email->template = 'payment_email';
					$this->Email->from = '';
					$this->Email->fromName = $this->data['Billing']['first_name'].' '.$this->data['Billing']['last_name'];
					$this->Email->subject = 'Niramaya Payment Details';
					$this->Email->to = $user_email;
					$this->Email->sendAs = 'html'; // because we like to send pretty mail
					$this->Email->delivery = 'mail';
					if($this->Email->send())
					{
						$update_cod_status = $this->Health->query("UPDATE healths SET cod_status='1',total_amount='".$this->data['Billing']['sub_total']."' WHERE id='".$this->data['Billing']['b_req_id']."'");
						$this->Session->write('book_mess','Thank you for confirming test booking. You have opted for Cash on delivery as payment option. Kindly pay the test amount during sample collection.');
						$this->Session->delete('session_test');
						$this->Session->delete('session_test_type');
						$this->Session->delete('session_banner_type');
						$this->redirect('/tests/book_test_cod/'.$this->data['Billing']['b_total_amt'].'/'.$this->data['Billing']['b_req_id']);
					}
				}
			}
		}
		$session_mess = $this->Session->read('book_mess');
		if(!empty($session_mess))
		{
			$this->set('mess_succ',$session_mess);
		}
		$this->set('b_total_amt',$total_amt);
		$this->set('b_req_id',$req_id);
		$get_req_detail = $this->Health->find('first',array('conditions'=>array('Health.id'=>$req_id)));
		//echo "<pre>"; print_r($get_req_detail); exit;
		if(!empty($get_req_detail['Health']['sample_date']) && !empty($get_req_detail['Health']['sample_time']))
		{
			$city = $get_req_detail['Health']['city'];
			if($city == 'Crossing Republic')
			{
				$visit_date = date('d-m-Y',strtotime($get_req_detail['Health']['sample_date']));
				if($get_req_detail['Health']['sample_time'] == 1) { $visit_time = '7:00AM - 7:30AM';}
				if($get_req_detail['Health']['sample_time'] == 2) { $visit_time = '7:30AM - 8:00AM';}
				if($get_req_detail['Health']['sample_time'] == 3) { $visit_time = '8:00AM - 8:30AM';}
				if($get_req_detail['Health']['sample_time'] == 4) { $visit_time = '8:30AM - 9:00AM';}
				if($get_req_detail['Health']['sample_time'] == 5) { $visit_time = '9:00AM - 9:30AM';}
				if($get_req_detail['Health']['sample_time'] == 6) { $visit_time = '9:30AM - 10:00AM';}
				if($get_req_detail['Health']['sample_time'] == 7) { $visit_time = '10:00AM - 10:30AM';}
				if($get_req_detail['Health']['sample_time'] == 8) { $visit_time = '10:30AM - 11:00AM';}
				if($get_req_detail['Health']['sample_time'] == 9) { $visit_time = '11:00AM - 11:30AM';}
				if($get_req_detail['Health']['sample_time'] == 10) { $visit_time = '11:30AM - 12:00PM';}
				if($get_req_detail['Health']['sample_time'] == 11) { $visit_time = '12:00PM - 12:30PM';}
				if($get_req_detail['Health']['sample_time'] == 12) { $visit_time = '12:30PM - 1:00PM';}
				if($get_req_detail['Health']['sample_time'] == 13) { $visit_time = '1:00PM - 1:30PM';}
				if($get_req_detail['Health']['sample_time'] == 14) { $visit_time = '1:30PM - 2:00PM';}
				if($get_req_detail['Health']['sample_time'] == 15) { $visit_time = '2:00PM - 2:30PM';}
				if($get_req_detail['Health']['sample_time'] == 16) { $visit_time = '2:30PM - 3:00PM';}
				if($get_req_detail['Health']['sample_time'] == 17) { $visit_time = '3:00PM - 3:30PM';}
				if($get_req_detail['Health']['sample_time'] == 18) { $visit_time = '3:30PM - 4:00PM';}
				if($get_req_detail['Health']['sample_time'] == 19) { $visit_time = '4:00PM - 4:30PM';}
				if($get_req_detail['Health']['sample_time'] == 20) { $visit_time = '4:30PM - 5:00PM';}
				if($get_req_detail['Health']['sample_time'] == 21) { $visit_time = '5:00PM - 5:30PM';}
				if($get_req_detail['Health']['sample_time'] == 22) { $visit_time = '5:30PM - 6:00PM';}
				if($get_req_detail['Health']['sample_time'] == 23) { $visit_time = '6:00PM - 6:30PM';}
				if($get_req_detail['Health']['sample_time'] == 24) { $visit_time = '6:30PM - 7:00PM';}
				$this->set('collectType','Visit a Lab');
				$this->set('labType','Crossing Republic');
				$this->set('visit_date',$visit_date);
				$this->set('visit_time',$visit_time);	
			}
			if($city == 'Indirapuram')
			{
				$visit_date = date('d-m-Y',strtotime($get_req_detail['Health']['sample_date']));
				if($get_req_detail['Health']['sample_time'] == 1) { $visit_time = '7:00AM - 7:30AM';}
				if($get_req_detail['Health']['sample_time'] == 2) { $visit_time = '7:30AM - 8:00AM';}
				if($get_req_detail['Health']['sample_time'] == 3) { $visit_time = '8:00AM - 8:30AM';}
				if($get_req_detail['Health']['sample_time'] == 4) { $visit_time = '8:30AM - 9:00AM';}
				if($get_req_detail['Health']['sample_time'] == 5) { $visit_time = '9:00AM - 9:30AM';}
				if($get_req_detail['Health']['sample_time'] == 6) { $visit_time = '9:30AM - 10:00AM';}
				if($get_req_detail['Health']['sample_time'] == 7) { $visit_time = '10:00AM - 10:30AM';}
				if($get_req_detail['Health']['sample_time'] == 8) { $visit_time = '10:30AM - 11:00AM';}
				if($get_req_detail['Health']['sample_time'] == 9) { $visit_time = '11:00AM - 11:30AM';}
				if($get_req_detail['Health']['sample_time'] == 10) { $visit_time = '11:30AM - 12:00PM';}
				if($get_req_detail['Health']['sample_time'] == 11) { $visit_time = '12:00PM - 12:30PM';}
				if($get_req_detail['Health']['sample_time'] == 12) { $visit_time = '12:30PM - 1:00PM';}
				if($get_req_detail['Health']['sample_time'] == 13) { $visit_time = '1:00PM - 1:30PM';}
				if($get_req_detail['Health']['sample_time'] == 14) { $visit_time = '1:30PM - 2:00PM';}
				if($get_req_detail['Health']['sample_time'] == 15) { $visit_time = '2:00PM - 2:30PM';}
				if($get_req_detail['Health']['sample_time'] == 16) { $visit_time = '2:30PM - 3:00PM';}
				if($get_req_detail['Health']['sample_time'] == 17) { $visit_time = '3:00PM - 3:30PM';}
				if($get_req_detail['Health']['sample_time'] == 18) { $visit_time = '3:30PM - 4:00PM';}
				if($get_req_detail['Health']['sample_time'] == 19) { $visit_time = '4:00PM - 4:30PM';}
				if($get_req_detail['Health']['sample_time'] == 20) { $visit_time = '4:30PM - 5:00PM';}
				if($get_req_detail['Health']['sample_time'] == 21) { $visit_time = '5:00PM - 5:30PM';}
				if($get_req_detail['Health']['sample_time'] == 22) { $visit_time = '5:30PM - 6:00PM';}
				if($get_req_detail['Health']['sample_time'] == 23) { $visit_time = '6:00PM - 6:30PM';}
				if($get_req_detail['Health']['sample_time'] == 24) { $visit_time = '6:30PM - 7:00PM';}
				$this->set('collectType','Visit a Lab');
				$this->set('labType','Indirapuram');
				$this->set('visit_date',$visit_date);
				$this->set('visit_time',$visit_time);
			}
			if($city == 'Noida')
			{
				$visit_date = date('d-m-Y',strtotime($get_req_detail['Health']['sample_date']));
				if($get_req_detail['Health']['sample_time'] == 1) { $visit_time = '7:00AM - 7:30AM';}
				if($get_req_detail['Health']['sample_time'] == 2) { $visit_time = '7:30AM - 8:00AM';}
				if($get_req_detail['Health']['sample_time'] == 3) { $visit_time = '8:00AM - 8:30AM';}
				if($get_req_detail['Health']['sample_time'] == 4) { $visit_time = '8:30AM - 9:00AM';}
				if($get_req_detail['Health']['sample_time'] == 5) { $visit_time = '9:00AM - 9:30AM';}
				if($get_req_detail['Health']['sample_time'] == 6) { $visit_time = '9:30AM - 10:00AM';}
				if($get_req_detail['Health']['sample_time'] == 7) { $visit_time = '10:00AM - 10:30AM';}
				if($get_req_detail['Health']['sample_time'] == 8) { $visit_time = '10:30AM - 11:00AM';}
				if($get_req_detail['Health']['sample_time'] == 9) { $visit_time = '11:00AM - 11:30AM';}
				if($get_req_detail['Health']['sample_time'] == 10) { $visit_time = '11:30AM - 12:00PM';}
				if($get_req_detail['Health']['sample_time'] == 11) { $visit_time = '12:00PM - 12:30PM';}
				if($get_req_detail['Health']['sample_time'] == 12) { $visit_time = '12:30PM - 1:00PM';}
				if($get_req_detail['Health']['sample_time'] == 13) { $visit_time = '1:00PM - 1:30PM';}
				if($get_req_detail['Health']['sample_time'] == 14) { $visit_time = '1:30PM - 2:00PM';}
				if($get_req_detail['Health']['sample_time'] == 15) { $visit_time = '2:00PM - 2:30PM';}
				if($get_req_detail['Health']['sample_time'] == 16) { $visit_time = '2:30PM - 3:00PM';}
				if($get_req_detail['Health']['sample_time'] == 17) { $visit_time = '3:00PM - 3:30PM';}
				if($get_req_detail['Health']['sample_time'] == 18) { $visit_time = '3:30PM - 4:00PM';}
				if($get_req_detail['Health']['sample_time'] == 19) { $visit_time = '4:00PM - 4:30PM';}
				if($get_req_detail['Health']['sample_time'] == 20) { $visit_time = '4:30PM - 5:00PM';}
				if($get_req_detail['Health']['sample_time'] == 21) { $visit_time = '5:00PM - 5:30PM';}
				if($get_req_detail['Health']['sample_time'] == 22) { $visit_time = '5:30PM - 6:00PM';}
				if($get_req_detail['Health']['sample_time'] == 23) { $visit_time = '6:00PM - 6:30PM';}
				if($get_req_detail['Health']['sample_time'] == 24) { $visit_time = '6:30PM - 7:00PM';}
				$this->set('collectType','Visit a Lab');
				$this->set('labType','Noida');
				$this->set('visit_date',$visit_date);
				$this->set('visit_time',$visit_time);
			}
		}
		if(!empty($get_req_detail['Health']['sample_date1']) && !empty($get_req_detail['Health']['sample_time1']))
		{
			$collect_date = date('d-m-Y',strtotime($get_req_detail['Health']['sample_date1']));
			if($get_req_detail['Health']['sample_time1'] == 1) { $collect_time = '7:00AM - 7:30AM';}
			if($get_req_detail['Health']['sample_time1'] == 2) { $collect_time = '7:30AM - 8:00AM';}
			if($get_req_detail['Health']['sample_time1'] == 3) { $collect_time = '8:00AM - 8:30AM';}
			if($get_req_detail['Health']['sample_time1'] == 4) { $collect_time = '8:30AM - 9:00AM';}
			if($get_req_detail['Health']['sample_time1'] == 5) { $collect_time = '9:00AM - 9:30AM';}
			if($get_req_detail['Health']['sample_time1'] == 6) { $collect_time = '9:30AM - 10:00AM';}
			if($get_req_detail['Health']['sample_time1'] == 7) { $collect_time = '10:00AM - 10:30AM';}
			if($get_req_detail['Health']['sample_time1'] == 8) { $collect_time = '10:30AM - 11:00AM';}
			if($get_req_detail['Health']['sample_time1'] == 9) { $collect_time = '11:00AM - 11:30AM';}
			if($get_req_detail['Health']['sample_time1'] == 10) { $collect_time = '11:30AM - 12:00PM';}
			if($get_req_detail['Health']['sample_time1'] == 11) { $collect_time = '12:00PM - 12:30PM';}
			if($get_req_detail['Health']['sample_time1'] == 12) { $collect_time = '12:30PM - 1:00PM';}
			if($get_req_detail['Health']['sample_time1'] == 13) { $collect_time = '1:00PM - 1:30PM';}
			if($get_req_detail['Health']['sample_time1'] == 14) { $collect_time = '1:30PM - 2:00PM';}
			if($get_req_detail['Health']['sample_time1'] == 15) { $collect_time = '2:00PM - 2:30PM';}
			if($get_req_detail['Health']['sample_time1'] == 16) { $collect_time = '2:30PM - 3:00PM';}
			if($get_req_detail['Health']['sample_time1'] == 17) { $collect_time = '3:00PM - 3:30PM';}
			if($get_req_detail['Health']['sample_time1'] == 18) { $collect_time = '3:30PM - 4:00PM';}
			if($get_req_detail['Health']['sample_time1'] == 19) { $collect_time = '4:00PM - 4:30PM';}
			if($get_req_detail['Health']['sample_time1'] == 20) { $collect_time = '4:30PM - 5:00PM';}
			if($get_req_detail['Health']['sample_time1'] == 21) { $collect_time = '5:00PM - 5:30PM';}
			if($get_req_detail['Health']['sample_time1'] == 22) { $collect_time = '5:30PM - 6:00PM';}
			if($get_req_detail['Health']['sample_time1'] == 23) { $collect_time = '6:00PM - 6:30PM';}
			if($get_req_detail['Health']['sample_time1'] == 24) { $collect_time = '6:30PM - 7:00PM';}
			$city_name = $this->City->find('first',array('conditions'=>array('City.id'=>$get_req_detail['Health']['city_id'])));
			$state_name = $this->State->find('first',array('conditions'=>array('State.id'=>$get_req_detail['Health']['state'])));
			$this->set('collectType','Home Collection');
			$this->set('labType','');
			$this->set('collect_date',$collect_date);
			$this->set('collect_time',$collect_time);
			$this->set('collect_address',$get_req_detail['Health']['address']);
			$this->set('collect_city',$city_name['City']['name']);
			$this->set('collect_state',$state_name['State']['name']);
			$this->set('collect_pincode',$get_req_detail['Health']['pincode']);
			$this->set('collect_landmark',$get_req_detail['Health']['landmark']);
			$this->set('collect_locality',$get_req_detail['Health']['locality']);
		}
		if(!empty($get_req_detail['Health']['test_id']))
		{
			$explode_tests = explode(',',$get_req_detail['Health']['test_id']);
			$count_test = count($explode_tests);
			if($count_test == 1)
			{
				$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
				$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'];	
			}
			if($count_test == 2)
			{
				$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
				$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
				$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'];
			}
			if($count_test == 3)
			{
				$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
				$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
				$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
				$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'];
			}
			if($count_test == 4)
			{
				$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
				$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
				$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
				$test_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
				$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$test_name_4['Test']['testcode'].' - '.$test_name_4['Test']['test_parameter'].' - Rs.'.$test_name_4['Test']['mrp'];
			}
			if($count_test == 5)
			{
				$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
				$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
				$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
				$test_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
				$test_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
				$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$test_name_4['Test']['testcode'].' - '.$test_name_4['Test']['test_parameter'].' - Rs.'.$test_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$test_name_5['Test']['testcode'].' - '.$test_name_5['Test']['test_parameter'].' - Rs.'.$test_name_5['Test']['mrp'];
			}
			if($count_test == 6)
			{
				$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
				$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
				$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
				$test_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
				$test_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
				$test_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
				$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$test_name_4['Test']['testcode'].' - '.$test_name_4['Test']['test_parameter'].' - Rs.'.$test_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$test_name_5['Test']['testcode'].' - '.$test_name_5['Test']['test_parameter'].' - Rs.'.$test_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$test_name_6['Test']['testcode'].' - '.$test_name_6['Test']['test_parameter'].' - Rs.'.$test_name_6['Test']['mrp'];
			}
			if($count_test == 7)
			{
				$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
				$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
				$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
				$test_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
				$test_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
				$test_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
				$test_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
				$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$test_name_4['Test']['testcode'].' - '.$test_name_4['Test']['test_parameter'].' - Rs.'.$test_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$test_name_5['Test']['testcode'].' - '.$test_name_5['Test']['test_parameter'].' - Rs.'.$test_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$test_name_6['Test']['testcode'].' - '.$test_name_6['Test']['test_parameter'].' - Rs.'.$test_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$test_name_7['Test']['testcode'].' - '.$test_name_7['Test']['test_parameter'].' - Rs.'.$test_name_7['Test']['mrp'];
			}
			if($count_test == 8)
			{
				$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
				$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
				$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
				$test_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
				$test_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
				$test_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
				$test_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
				$test_name_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[7])));
				$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$test_name_4['Test']['testcode'].' - '.$test_name_4['Test']['test_parameter'].' - Rs.'.$test_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$test_name_5['Test']['testcode'].' - '.$test_name_5['Test']['test_parameter'].' - Rs.'.$test_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$test_name_6['Test']['testcode'].' - '.$test_name_6['Test']['test_parameter'].' - Rs.'.$test_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$test_name_7['Test']['testcode'].' - '.$test_name_7['Test']['test_parameter'].' - Rs.'.$test_name_7['Test']['mrp'].'<br />'.'<strong>8- </strong>'.$test_name_8['Test']['testcode'].' - '.$test_name_8['Test']['test_parameter'].' - Rs.'.$test_name_8['Test']['mrp'];
			}
			if($count_test == 9)
			{
				$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
				$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
				$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
				$test_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
				$test_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
				$test_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
				$test_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
				$test_name_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[7])));
				$test_name_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[8])));
				$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$test_name_4['Test']['testcode'].' - '.$test_name_4['Test']['test_parameter'].' - Rs.'.$test_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$test_name_5['Test']['testcode'].' - '.$test_name_5['Test']['test_parameter'].' - Rs.'.$test_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$test_name_6['Test']['testcode'].' - '.$test_name_6['Test']['test_parameter'].' - Rs.'.$test_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$test_name_7['Test']['testcode'].' - '.$test_name_7['Test']['test_parameter'].' - Rs.'.$test_name_7['Test']['mrp'].'<br />'.'<strong>8- </strong>'.$test_name_8['Test']['testcode'].' - '.$test_name_8['Test']['test_parameter'].' - Rs.'.$test_name_8['Test']['mrp'].'<br />'.'<strong>9- </strong>'.$test_name_9['Test']['testcode'].' - '.$test_name_9['Test']['test_parameter'].' - Rs.'.$test_name_9['Test']['mrp'];
			}
			if($count_test == 10)
			{
				$test_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[0])));
				$test_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[1])));
				$test_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[2])));
				$test_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[3])));
				$test_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[4])));
				$test_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[5])));
				$test_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[6])));
				$test_name_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[7])));
				$test_name_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[8])));
				$test_name_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_tests[9])));
				$test_name = '<strong>1- </strong>'.$test_name_1['Test']['testcode'].' - '.$test_name_1['Test']['test_parameter'].' - Rs.'.$test_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$test_name_2['Test']['testcode'].' - '.$test_name_2['Test']['test_parameter'].' - Rs.'.$test_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$test_name_3['Test']['testcode'].' - '.$test_name_3['Test']['test_parameter'].' - Rs.'.$test_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$test_name_4['Test']['testcode'].' - '.$test_name_4['Test']['test_parameter'].' - Rs.'.$test_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$test_name_5['Test']['testcode'].' - '.$test_name_5['Test']['test_parameter'].' - Rs.'.$test_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$test_name_6['Test']['testcode'].' - '.$test_name_6['Test']['test_parameter'].' - Rs.'.$test_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$test_name_7['Test']['testcode'].' - '.$test_name_7['Test']['test_parameter'].' - Rs.'.$test_name_7['Test']['mrp'].'<br />'.'<strong>8- </strong>'.$test_name_8['Test']['testcode'].' - '.$test_name_8['Test']['test_parameter'].' - Rs.'.$test_name_8['Test']['mrp'].'<br />'.'<strong>9- </strong>'.$test_name_9['Test']['testcode'].' - '.$test_name_9['Test']['test_parameter'].' - Rs.'.$test_name_9['Test']['mrp'].'<br />'.'<strong>10- </strong>'.$test_name_10['Test']['testcode'].' - '.$test_name_10['Test']['test_parameter'].' - Rs.'.$test_name_10['Test']['mrp'];
			}
		}
		if(!empty($get_req_detail['Health']['profile_id']))
		{
			$explode_profiles = explode(',',$get_req_detail['Health']['profile_id']);
			$count_profile = count($explode_profiles);
			if($count_profile == 1)
			{
				$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
				$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'];	
			}
			if($count_profile == 2)
			{
				$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
				$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
				$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'];
			}
			if($count_profile == 3)
			{
				$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
				$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
				$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
				$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'];
			}
			if($count_profile == 4)
			{
				$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
				$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
				$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
				$profile_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
				$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$profile_name_4['Test']['testcode'].' - '.$profile_name_4['Test']['test_parameter'].' - Rs.'.$profile_name_4['Test']['mrp'];
			}
			if($count_profile == 5)
			{
				$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
				$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
				$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
				$profile_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
				$profile_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
				$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$profile_name_4['Test']['testcode'].' - '.$profile_name_4['Test']['test_parameter'].' - Rs.'.$profile_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$profile_name_5['Test']['testcode'].' - '.$profile_name_5['Test']['test_parameter'].' - Rs.'.$profile_name_5['Test']['mrp'];
			}
			if($count_profile == 6)
			{
				$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
				$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
				$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
				$profile_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
				$profile_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
				$profile_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
				$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$profile_name_4['Test']['testcode'].' - '.$profile_name_4['Test']['test_parameter'].' - Rs.'.$profile_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$profile_name_5['Test']['testcode'].' - '.$profile_name_5['Test']['test_parameter'].' - Rs.'.$profile_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$profile_name_6['Test']['testcode'].' - '.$profile_name_6['Test']['test_parameter'].' - Rs.'.$profile_name_6['Test']['mrp'];
			}
			if($count_profile == 7)
			{
				$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
				$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
				$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
				$profile_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
				$profile_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
				$profile_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
				$profile_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
				$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$profile_name_4['Test']['testcode'].' - '.$profile_name_4['Test']['test_parameter'].' - Rs.'.$profile_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$profile_name_5['Test']['testcode'].' - '.$profile_name_5['Test']['test_parameter'].' - Rs.'.$profile_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$profile_name_6['Test']['testcode'].' - '.$profile_name_6['Test']['test_parameter'].' - Rs.'.$profile_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$profile_name_7['Test']['testcode'].' - '.$profile_name_7['Test']['test_parameter'].' - Rs.'.$profile_name_7['Test']['mrp'];
			}
			if($count_profile == 8)
			{
				$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
				$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
				$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
				$profile_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
				$profile_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
				$profile_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
				$profile_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
				$profile_name_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[7])));
				$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$profile_name_4['Test']['testcode'].' - '.$profile_name_4['Test']['test_parameter'].' - Rs.'.$profile_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$profile_name_5['Test']['testcode'].' - '.$profile_name_5['Test']['test_parameter'].' - Rs.'.$profile_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$profile_name_6['Test']['testcode'].' - '.$profile_name_6['Test']['test_parameter'].' - Rs.'.$profile_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$profile_name_7['Test']['testcode'].' - '.$profile_name_7['Test']['test_parameter'].' - Rs.'.$profile_name_7['Test']['mrp'].'<br />'.'<strong>8- </strong>'.$profile_name_8['Test']['testcode'].' - '.$profile_name_8['Test']['test_parameter'].' - Rs.'.$profile_name_8['Test']['mrp'];
			}
			if($count_profile == 9)
			{
				$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
				$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
				$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
				$profile_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
				$profile_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
				$profile_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
				$profile_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
				$profile_name_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[7])));
				$profile_name_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[8])));
				$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$profile_name_4['Test']['testcode'].' - '.$profile_name_4['Test']['test_parameter'].' - Rs.'.$profile_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$profile_name_5['Test']['testcode'].' - '.$profile_name_5['Test']['test_parameter'].' - Rs.'.$profile_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$profile_name_6['Test']['testcode'].' - '.$profile_name_6['Test']['test_parameter'].' - Rs.'.$profile_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$profile_name_7['Test']['testcode'].' - '.$profile_name_7['Test']['test_parameter'].' - Rs.'.$profile_name_7['Test']['mrp'].'<br />'.'<strong>8- </strong>'.$profile_name_8['Test']['testcode'].' - '.$profile_name_8['Test']['test_parameter'].' - Rs.'.$profile_name_8['Test']['mrp'].'<br />'.'<strong>9- </strong>'.$profile_name_9['Test']['testcode'].' - '.$profile_name_9['Test']['test_parameter'].' - Rs.'.$profile_name_9['Test']['mrp'];
			}
			if($count_profile == 10)
			{
				$profile_name_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[0])));
				$profile_name_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[1])));
				$profile_name_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[2])));
				$profile_name_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[3])));
				$profile_name_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[4])));
				$profile_name_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[5])));
				$profile_name_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[6])));
				$profile_name_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[7])));
				$profile_name_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[8])));
				$profile_name_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profiles[9])));
				$profile_name = '<strong>1- </strong>'.$profile_name_1['Test']['testcode'].' - '.$profile_name_1['Test']['test_parameter'].' - Rs.'.$profile_name_1['Test']['mrp'].'<br />'.'<strong>2- </strong>'.$profile_name_2['Test']['testcode'].' - '.$profile_name_2['Test']['test_parameter'].' - Rs.'.$profile_name_2['Test']['mrp'].'<br />'.'<strong>3- </strong>'.$profile_name_3['Test']['testcode'].' - '.$profile_name_3['Test']['test_parameter'].' - Rs.'.$profile_name_3['Test']['mrp'].'<br />'.'<strong>4- </strong>'.$profile_name_4['Test']['testcode'].' - '.$profile_name_4['Test']['test_parameter'].' - Rs.'.$profile_name_4['Test']['mrp'].'<br />'.'<strong>5- </strong>'.$profile_name_5['Test']['testcode'].' - '.$profile_name_5['Test']['test_parameter'].' - Rs.'.$profile_name_5['Test']['mrp'].'<br />'.'<strong>6- </strong>'.$profile_name_6['Test']['testcode'].' - '.$profile_name_6['Test']['test_parameter'].' - Rs.'.$profile_name_6['Test']['mrp'].'<br />'.'<strong>7- </strong>'.$profile_name_7['Test']['testcode'].' - '.$profile_name_7['Test']['test_parameter'].' - Rs.'.$profile_name_7['Test']['mrp'].'<br />'.'<strong>8- </strong>'.$profile_name_8['Test']['testcode'].' - '.$profile_name_8['Test']['test_parameter'].' - Rs.'.$profile_name_8['Test']['mrp'].'<br />'.'<strong>9- </strong>'.$profile_name_9['Test']['testcode'].' - '.$profile_name_9['Test']['test_parameter'].' - Rs.'.$profile_name_9['Test']['mrp'].'<br />'.'<strong>10- </strong>'.$profile_name_10['Test']['testcode'].' - '.$profile_name_10['Test']['test_parameter'].' - Rs.'.$profile_name_10['Test']['mrp'];
			}
		}
		if(!empty($get_req_detail['Health']['offer_id']))
		{
			$explode_offers = explode(',',$get_req_detail['Health']['offer_id']);
			$count_offers = count($explode_offers);
			if($count_offers == 1)
			{
				$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
				$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'];	
			}
			if($count_offers == 2)
			{
				$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
				$offer_name_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
				$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'].'<br />'.'<strong>2- </strong>'.$offer_name_2['Banner']['banner_code'].' - '.$offer_name_2['Banner']['banner_name'].' - Rs.'.$offer_name_2['Banner']['banner_mrp'];
			}
			if($count_offers == 3)
			{
				$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
				$offer_name_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
				$offer_name_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
				$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'].'<br />'.'<strong>2- </strong>'.$offer_name_2['Banner']['banner_code'].' - '.$offer_name_2['Banner']['banner_name'].' - Rs.'.$offer_name_2['Banner']['banner_mrp'].'<br />'.'<strong>3- </strong>'.$offer_name_3['Banner']['banner_code'].' - '.$offer_name_3['Banner']['banner_name'].' - Rs.'.$offer_name_3['Banner']['banner_mrp'];
			}
			if($count_offers == 4)
			{
				$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
				$offer_name_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
				$offer_name_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
				$offer_name_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
				$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'].'<br />'.'<strong>2- </strong>'.$offer_name_2['Banner']['banner_code'].' - '.$offer_name_2['Banner']['banner_name'].' - Rs.'.$offer_name_2['Banner']['banner_mrp'].'<br />'.'<strong>3- </strong>'.$offer_name_3['Banner']['banner_code'].' - '.$offer_name_3['Banner']['banner_name'].' - Rs.'.$offer_name_3['Banner']['banner_mrp'].'<br />'.'<strong>4- </strong>'.$offer_name_4['Banner']['banner_code'].' - '.$offer_name_4['Banner']['banner_name'].' - Rs.'.$offer_name_4['Banner']['banner_mrp'];
			}
			if($count_offers == 5)
			{
				$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
				$offer_name_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
				$offer_name_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
				$offer_name_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
				$offer_name_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
				$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'].'<br />'.'<strong>2- </strong>'.$offer_name_2['Banner']['banner_code'].' - '.$offer_name_2['Banner']['banner_name'].' - Rs.'.$offer_name_2['Banner']['banner_mrp'].'<br />'.'<strong>3- </strong>'.$offer_name_3['Banner']['banner_code'].' - '.$offer_name_3['Banner']['banner_name'].' - Rs.'.$offer_name_3['Banner']['banner_mrp'].'<br />'.'<strong>4- </strong>'.$offer_name_4['Banner']['banner_code'].' - '.$offer_name_4['Banner']['banner_name'].' - Rs.'.$offer_name_4['Banner']['banner_mrp'].'<br />'.'<strong>5- </strong>'.$offer_name_5['Banner']['banner_code'].' - '.$offer_name_5['Banner']['banner_name'].' - Rs.'.$offer_name_5['Banner']['banner_mrp'];
			}
			if($count_offers == 6)
			{
				$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
				$offer_name_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
				$offer_name_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
				$offer_name_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
				$offer_name_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
				$offer_name_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[5])));
				$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'].'<br />'.'<strong>2- </strong>'.$offer_name_2['Banner']['banner_code'].' - '.$offer_name_2['Banner']['banner_name'].' - Rs.'.$offer_name_2['Banner']['banner_mrp'].'<br />'.'<strong>3- </strong>'.$offer_name_3['Banner']['banner_code'].' - '.$offer_name_3['Banner']['banner_name'].' - Rs.'.$offer_name_3['Banner']['banner_mrp'].'<br />'.'<strong>4- </strong>'.$offer_name_4['Banner']['banner_code'].' - '.$offer_name_4['Banner']['banner_name'].' - Rs.'.$offer_name_4['Banner']['banner_mrp'].'<br />'.'<strong>5- </strong>'.$offer_name_5['Banner']['banner_code'].' - '.$offer_name_5['Banner']['banner_name'].' - Rs.'.$offer_name_5['Banner']['banner_mrp'].'<br />'.'<strong>6- </strong>'.$offer_name_6['Banner']['banner_code'].' - '.$offer_name_6['Banner']['banner_name'].' - Rs.'.$offer_name_6['Banner']['banner_mrp'];
			}
			if($count_offers == 7)
			{
				$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
				$offer_name_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
				$offer_name_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
				$offer_name_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
				$offer_name_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
				$offer_name_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[5])));
				$offer_name_7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[6])));
				$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'].'<br />'.'<strong>2- </strong>'.$offer_name_2['Banner']['banner_code'].' - '.$offer_name_2['Banner']['banner_name'].' - Rs.'.$offer_name_2['Banner']['banner_mrp'].'<br />'.'<strong>3- </strong>'.$offer_name_3['Banner']['banner_code'].' - '.$offer_name_3['Banner']['banner_name'].' - Rs.'.$offer_name_3['Banner']['banner_mrp'].'<br />'.'<strong>4- </strong>'.$offer_name_4['Banner']['banner_code'].' - '.$offer_name_4['Banner']['banner_name'].' - Rs.'.$offer_name_4['Banner']['banner_mrp'].'<br />'.'<strong>5- </strong>'.$offer_name_5['Banner']['banner_code'].' - '.$offer_name_5['Banner']['banner_name'].' - Rs.'.$offer_name_5['Banner']['banner_mrp'].'<br />'.'<strong>6- </strong>'.$offer_name_6['Banner']['banner_code'].' - '.$offer_name_6['Banner']['banner_name'].' - Rs.'.$offer_name_6['Banner']['banner_mrp'].'<br />'.'<strong>7- </strong>'.$offer_name_7['Banner']['banner_code'].' - '.$offer_name_7['Banner']['banner_name'].' - Rs.'.$offer_name_7['Banner']['banner_mrp'];
			}
			if($count_offers == 8)
			{
				$offer_name_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[0])));
				$offer_name_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[1])));
				$offer_name_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[2])));
				$offer_name_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[3])));
				$offer_name_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[4])));
				$offer_name_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[5])));
				$offer_name_7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[6])));
				$offer_name_8 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offers[7])));
				$offer_name = '<strong>1- </strong>'.$offer_name_1['Banner']['banner_code'].' - '.$offer_name_1['Banner']['banner_name'].' - Rs.'.$offer_name_1['Banner']['banner_mrp'].'<br />'.'<strong>2- </strong>'.$offer_name_2['Banner']['banner_code'].' - '.$offer_name_2['Banner']['banner_name'].' - Rs.'.$offer_name_2['Banner']['banner_mrp'].'<br />'.'<strong>3- </strong>'.$offer_name_3['Banner']['banner_code'].' - '.$offer_name_3['Banner']['banner_name'].' - Rs.'.$offer_name_3['Banner']['banner_mrp'].'<br />'.'<strong>4- </strong>'.$offer_name_4['Banner']['banner_code'].' - '.$offer_name_4['Banner']['banner_name'].' - Rs.'.$offer_name_4['Banner']['banner_mrp'].'<br />'.'<strong>5- </strong>'.$offer_name_5['Banner']['banner_code'].' - '.$offer_name_5['Banner']['banner_name'].' - Rs.'.$offer_name_5['Banner']['banner_mrp'].'<br />'.'<strong>6- </strong>'.$offer_name_6['Banner']['banner_code'].' - '.$offer_name_6['Banner']['banner_name'].' - Rs.'.$offer_name_6['Banner']['banner_mrp'].'<br />'.'<strong>7- </strong>'.$offer_name_7['Banner']['banner_code'].' - '.$offer_name_7['Banner']['banner_name'].' - Rs.'.$offer_name_7['Banner']['banner_mrp'].'<br />'.'<strong>8- </strong>'.$offer_name_8['Banner']['banner_code'].' - '.$offer_name_8['Test']['banner_name'].' - Rs.'.$offer_name_8['Banner']['banner_mrp'];
			}
		}
		if(!empty($get_req_detail['Health']['package_id']))
		{
			$explode_packages = explode(',',$get_req_detail['Health']['package_id']);
			$count_packages = count($explode_packages);
			if($count_packages == 1)
			{
				$package_name_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
				$package_name = '<strong>1- </strong>'.$package_name_1['Package']['package_name'].' - Rs.'.$package_name_1['Package']['package_mrp'];	
			}
			if($count_packages == 2)
			{
				$package_name_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
				$package_name_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
				$package_name = '<strong>1- </strong>'.$package_name_1['Package']['package_name'].' - Rs.'.$package_name_1['Package']['package_mrp'].'<br />'.'<strong>2- </strong>'.$package_name_2['Package']['package_name'].' - Rs.'.$package_name_2['Package']['package_mrp'];
			}
			if($count_packages == 3)
			{
				$package_name_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
				$package_name_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
				$package_name_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[2])));
				$package_name = '<strong>1- </strong>'.$package_name_1['Package']['package_name'].' - Rs.'.$package_name_1['Package']['package_mrp'].'<br />'.'<strong>2- </strong>'.$package_name_2['Package']['package_name'].' - Rs.'.$package_name_2['Package']['package_mrp'].'<br />'.'<strong>3- </strong>'.$package_name_3['Package']['package_name'].' - Rs.'.$package_name_3['Package']['package_mrp'];
			}
			if($count_packages == 4)
			{
				$package_name_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
				$package_name_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
				$package_name_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[2])));
				$package_name_4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[3])));
				$package_name = '<strong>1- </strong>'.$package_name_1['Package']['package_name'].' - Rs.'.$package_name_1['Package']['package_mrp'].'<br />'.'<strong>2- </strong>'.$package_name_2['Package']['package_name'].' - Rs.'.$package_name_2['Package']['package_mrp'].'<br />'.'<strong>3- </strong>'.$package_name_3['Package']['package_name'].' - Rs.'.$package_name_3['Package']['package_mrp'].'<br />'.'<strong>4- </strong>'.$package_name_4['Package']['package_name'].' - Rs.'.$package_name_4['Package']['package_mrp'];
			}
			if($count_packages == 5)
			{
				$package_name_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[0])));
				$package_name_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[1])));
				$package_name_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[2])));
				$package_name_4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[3])));
				$package_name_5 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_packages[4])));
				$package_name = '<strong>1- </strong>'.$package_name_1['Package']['package_name'].' - Rs.'.$package_name_1['Package']['package_mrp'].'<br />'.'<strong>2- </strong>'.$package_name_2['Package']['package_name'].' - Rs.'.$package_name_2['Package']['package_mrp'].'<br />'.'<strong>3- </strong>'.$package_name_3['Package']['package_name'].' - Rs.'.$package_name_3['Package']['package_mrp'].'<br />'.'<strong>4- </strong>'.$package_name_4['Package']['package_name'].' - Rs.'.$package_name_4['Package']['package_mrp'].'<br />'.'<strong>5- </strong>'.$package_name_5['Package']['package_name'].' - Rs.'.$package_name_5['Package']['package_mrp'];
			}
		}
		$test_ids = implode(',',$this->Session->read('test_ids_array_book')); 
		$profile_ids = implode(',',$this->Session->read('profile_ids_array_book')); 
		$offer_ids = implode(',',$this->Session->read('offer_ids_array_book')); 
		$package_ids = implode(',',$this->Session->read('package_ids_array_book')); 
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));
		$this->set('city',$city); 
		$state = $this->State->find('all',array('conditions'=>array('State.status'=>1)));
		$this->set('state',$state); 
		$this->set('test_id',$test_ids);
		$this->set('profile_id',$profile_ids);
		$this->set('offer_id',$offer_ids);
		$this->set('package_id',$package_ids);
		$this->set('total_cost',$sub_total);
		$this->set('test_names',$test_name);
		$this->set('profiles_names',$profile_name);
		$this->set('offers_names',$offer_name);
		$this->set('package_name',$package_name);
		$this->set('pat_name',$get_req_detail['Health']['name']);
		$this->set('pat_age',$get_req_detail['Health']['age']);
		$this->set('pat_gen',$get_req_detail['Health']['gender']);
	}
	
	public function payment_history()
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','Niramayahealth Care | Payment History');
		//echo "<pre>"; print_r($this->Session->read('UserDetail')); exit;
		
		$this->Health->bindModel(
			array('hasOne'=>array(
					'Billing'=>array(
                    'className'=>'Billing',
                    'foreignKey'=>'request_id'
                )
			)),false
		);
		$this->paginate = array('Health' => array('limit' =>'10','order'=>array('Health.id'=>'DESC'),'conditions'=>array('Health.user_id'=>$this->Session->read('UserDetail.User.id'),'Health.status'=>1)));
		$paymenthistory=$this->paginate('Health');
		//print_R($paymenthistory);die;
		$k = 0;
		foreach($paymenthistory as $key => $val)
		{
			if($val['Health']['test_id'] != '')
			{
				$paymenthistory[$k]['Health']['test_type'] = 'Test(s)';
				$explode_test = explode(',',$val['Health']['test_id']);
				$count_test = count($explode_test);
				if($count_test == 1)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 2)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 3)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 4)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[3],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_4['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 5)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
					$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[3],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[4],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_5['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 6)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
					$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
					$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[3],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[4],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[5],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_6['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 7)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
					$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
					$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
					$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[3],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[4],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[5],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[6],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_7['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 8)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
					$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
					$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
					$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
					$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[3],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[4],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[5],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[6],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[7],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$test_8['Test']['testcode'].' - '.$test_8['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_8['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 9)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
					$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
					$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
					$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
					$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
					$test_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[8])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[3],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[4],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[5],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[6],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[7],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_9 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[8],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$test_8['Test']['testcode'].' - '.$test_8['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_8['RequestTest']['mrp'].'</p>'.'<p><strong>9)</strong> '.$test_9['Test']['testcode'].' - '.$test_9['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_9['RequestTest']['mrp'];
				}
				if($count_test == 10)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
					$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
					$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
					$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
					$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
					$test_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[8])));
					$test_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[9])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[3],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[4],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[5],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[6],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[7],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_9 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[8],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_10 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[9],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$test_8['Test']['testcode'].' - '.$test_8['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_8['RequestTest']['mrp'].'</p>'.'<p><strong>9)</strong> '.$test_9['Test']['testcode'].' - '.$test_9['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_9['RequestTest']['mrp'].'</p>'.'<p><strong>10)</strong> '.$test_10['Test']['testcode'].' - '.$test_10['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_10['RequestTest']['mrp'].'</p>';
				}
				$paymenthistory[$k]['Health']['test_name'] = $test_name;
			}
			if($val['Health']['profile_id'] != '')
			{
				$paymenthistory[$k]['Health']['profile_type'] = 'Profile(s)';
				$explode_profile = explode(',',$val['Health']['profile_id']);
				$count_profile = count($explode_profile);
				if($count_profile == 1)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 2)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 3)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 4)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[3],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_4['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 5)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
					$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[3],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[4],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_5['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 6)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
					$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
					$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[3],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[4],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[5],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_6['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 7)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
					$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
					$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
					$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[3],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[4],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[5],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[6],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_7['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 8)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
					$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
					$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
					$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
					$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[3],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[4],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[5],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[6],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[7],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$profile_8['Test']['testcode'].' - '.$profile_8['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_8['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 9)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
					$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
					$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
					$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
					$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
					$profile_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[8])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[3],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[4],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[5],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[6],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[7],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_9 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[8],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$profile_8['Test']['testcode'].' - '.$profile_8['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_8['RequestTest']['mrp'].'</p>'.'<p><strong>9)</strong> '.$profile_9['Test']['testcode'].' - '.$profile_9['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_9['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 10)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
					$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
					$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
					$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
					$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
					$profile_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[8])));
					$profile_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[9])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[3],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[4],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[5],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[6],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[7],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_9 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[8],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_10 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[9],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$profile_8['Test']['testcode'].' - '.$profile_8['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_8['RequestTest']['mrp'].'</p>'.'<p><strong>9)</strong> '.$profile_9['Test']['testcode'].' - '.$profile_9['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_9['RequestTest']['mrp'].'</p>'.'<p><strong>10)</strong> '.$profile_10['Test']['testcode'].' - '.$profile_10['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_10['RequestTest']['mrp'].'</p>';
				}
				$paymenthistory[$k]['Health']['profile_name'] = $profile_name;
			}
			if($val['Health']['offer_id'] != '')
			{
				$paymenthistory[$k]['Health']['offer_type'] = 'Offer Banner(s)';
				$explode_offer = explode(',',$val['Health']['offer_id']);
				$count_offer = count($explode_offer);
				if($count_offer == 1)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>';
				}
				if($count_offer == 2)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[1],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_2['RequestTest']['mrp'].'</p>';
				}
				if($count_offer == 3)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
					$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[1],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[2],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_3['RequestTest']['mrp'].'</p>';
				}
				if($count_offer == 4)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
					$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
					$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[1],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[2],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[3],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_4['RequestTest']['mrp'].'</p>';
				}
				if($count_offer == 5)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
					$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
					$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
					$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[1],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[2],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[3],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[4],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_5['RequestTest']['mrp'].'</p>';
				}
				if($count_offer == 6)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
					$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
					$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
					$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
					$offer_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[5])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[1],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[2],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[3],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[4],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[5],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$offer_6['Banner']['banner_code'].' - '.$offer_6['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_6['RequestTest']['mrp'].'</p>';
				}
				if($count_offer == 7)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
					$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
					$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
					$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
					$offer_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[5])));
					$offer_7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[6])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[1],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[2],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[3],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[4],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[5],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[6],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$offer_6['Banner']['banner_code'].' - '.$offer_6['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$offer_7['Banner']['banner_code'].' - '.$offer_7['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_7['RequestTest']['mrp'].'</p>';
				}
				if($count_offer == 8)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
					$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
					$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
					$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
					$offer_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[5])));
					$offer_7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[6])));
					$offer_8 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[7])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[1],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[2],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[3],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[4],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[5],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[6],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[7],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$offer_6['Banner']['banner_code'].' - '.$offer_6['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$offer_7['Banner']['banner_code'].' - '.$offer_7['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$offer_8['Banner']['banner_code'].' - '.$offer_8['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_8['RequestTest']['mrp'].'</p>';
				}
				$paymenthistory[$k]['Health']['offer_name'] = $offer_name;
			}
			
			if($val['Health']['package_id'] != '')
			{
				$paymenthistory[$k]['Health']['package_type'] = 'Package(s)';
				$explode_package = explode(',',$val['Health']['package_id']);
				$count_package = count($explode_package);
				if($count_package == 1)
				{
					$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
					$save_db_package_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[0],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$save_db_package_mrp_1['RequestTest']['mrp'].'</p>';
				}
				if($count_package == 2)
				{
					$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
					$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
					$save_db_package_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[0],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[1],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$save_db_package_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$save_db_package_mrp_2['RequestTest']['mrp'].'</p>';
				}
				if($count_package == 3)
				{
					$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
					$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
					$package_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[2])));
					$save_db_package_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[0],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[1],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[2],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$save_db_package_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$save_db_package_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$package_3['Package']['package_name'].' - Rs.'.$save_db_package_mrp_3['RequestTest']['mrp'].'</p>';
				}
				if($count_package == 4)
				{
					$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
					$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
					$package_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[2])));
					$package_4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[3])));
					$save_db_package_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[0],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[1],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[2],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[3],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$save_db_package_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$save_db_package_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$package_3['Package']['package_name'].' - Rs.'.$save_db_package_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$package_4['Package']['package_name'].' - Rs.'.$save_db_package_mrp_4['RequestTest']['mrp'].'</p>';
				}
				if($count_package == 5)
				{
					$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
					$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
					$package_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[2])));
					$package_4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[3])));
					$package_5 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[4])));
					$save_db_package_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[0],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[1],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[2],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[3],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[4],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$save_db_package_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$save_db_package_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$package_3['Package']['package_name'].' - Rs.'.$save_db_package_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$package_4['Package']['package_name'].' - Rs.'.$save_db_package_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$package_5['Package']['package_name'].' - Rs.'.$save_db_package_mrp_5['RequestTest']['mrp'].'</p>';
				}
				$paymenthistory[$k]['Health']['package_name'] = $package_name;
			}
			if($val['Health']['service_id'] != '')
			{
				$paymenthistory[$k]['Health']['service_type'] = 'Patient Care Services';
				$explode_service = explode(',',$val['Health']['service_id']);
				$count_service = count($explode_service);
				if($count_service == 1)
				{
					$service_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
					$save_db_service_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[0],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$service_name = '<p><strong>1)</strong> '.$service_1['Test']['testcode'].' - '.$service_1['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_1['RequestTest']['mrp'].'</p>';
				}
				if($count_service == 2)
				{
					$service_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
					$service_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
					$save_db_service_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[0],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[1],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$service_name = '<p><strong>1)</strong> '.$service_1['Test']['testcode'].' - '.$service_1['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$service_2['Test']['testcode'].' - '.$service_2['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_2['RequestTest']['mrp'].'</p>';
				}
				if($count_service == 3)
				{
					$service_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
					$service_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
					$service_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
					$save_db_service_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[0],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[1],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[2],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$service_name = '<p><strong>1)</strong> '.$service_1['Test']['testcode'].' - '.$service_1['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$service_2['Test']['testcode'].' - '.$service_2['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$service_3['Test']['testcode'].' - '.$service_3['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_3['RequestTest']['mrp'].'</p>';
				}
				if($count_service == 4)
				{
					$service_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
					$service_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
					$service_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
					$service_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
					$save_db_service_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[0],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[1],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[2],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[3],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$service_name = '<p><strong>1)</strong> '.$service_1['Test']['testcode'].' - '.$service_1['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$service_2['Test']['testcode'].' - '.$service_2['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$service_3['Test']['testcode'].' - '.$service_3['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$service_4['Test']['testcode'].' - '.$service_4['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_4['RequestTest']['mrp'].'</p>';
				}
				if($count_service == 5)
				{
					$service_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
					$service_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
					$service_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
					$service_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
					$service_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
					$save_db_service_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[0],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[1],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[2],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[3],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[4],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$service_name = '<p><strong>1)</strong> '.$service_1['Test']['testcode'].' - '.$service_1['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$service_2['Test']['testcode'].' - '.$service_2['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$service_3['Test']['testcode'].' - '.$service_3['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$service_4['Test']['testcode'].' - '.$service_4['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$service_5['Test']['testcode'].' - '.$service_5['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_5['RequestTest']['mrp'].'</p>';
				}
				if($count_service == 6)
				{
					$service_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
					$service_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
					$service_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
					$service_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
					$service_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
					$service_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
					$save_db_service_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[0],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[1],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[2],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[3],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[4],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[5],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$service_name = '<p><strong>1)</strong> '.$service_1['Test']['testcode'].' - '.$service_1['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$service_2['Test']['testcode'].' - '.$service_2['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$service_3['Test']['testcode'].' - '.$service_3['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$service_4['Test']['testcode'].' - '.$service_4['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$service_5['Test']['testcode'].' - '.$service_5['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$service_6['Test']['testcode'].' - '.$service_6['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_6['RequestTest']['mrp'].'</p>';
				}
				if($count_service == 7)
				{
					$service_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
					$service_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
					$service_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
					$service_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
					$service_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
					$service_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
					$service_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[6])));
					$save_db_service_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[0],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[1],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[2],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[3],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[4],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[5],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[6],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$service_name = '<p><strong>1)</strong> '.$service_1['Test']['testcode'].' - '.$service_1['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$service_2['Test']['testcode'].' - '.$service_2['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$service_3['Test']['testcode'].' - '.$service_3['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$service_4['Test']['testcode'].' - '.$service_4['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$service_5['Test']['testcode'].' - '.$service_5['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$service_6['Test']['testcode'].' - '.$service_6['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$service_7['Test']['testcode'].' - '.$service_7['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_7['RequestTest']['mrp'].'</p>';
				}
				if($count_service == 8)
				{
					$service_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
					$service_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
					$service_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
					$service_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
					$service_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
					$service_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
					$service_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[6])));
					$service_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[7])));
					$save_db_service_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[0],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[1],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[2],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[3],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[4],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[5],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[6],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[7],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$service_name = '<p><strong>1)</strong> '.$service_1['Test']['testcode'].' - '.$service_1['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$service_2['Test']['testcode'].' - '.$service_2['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$service_3['Test']['testcode'].' - '.$service_3['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$service_4['Test']['testcode'].' - '.$service_4['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$service_5['Test']['testcode'].' - '.$service_5['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$service_6['Test']['testcode'].' - '.$service_6['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$service_7['Test']['testcode'].' - '.$service_7['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$service_8['Test']['testcode'].' - '.$service_8['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_8['RequestTest']['mrp'].'</p>';
				}
				if($count_service == 9)
				{
					$service_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
					$service_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
					$service_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
					$service_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
					$service_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
					$service_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
					$service_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[6])));
					$service_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[7])));
					$service_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[8])));
					$save_db_service_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[0],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[1],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[2],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[3],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[4],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[5],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[6],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[7],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_9 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[8],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$service_name = '<p><strong>1)</strong> '.$service_1['Test']['testcode'].' - '.$service_1['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$service_2['Test']['testcode'].' - '.$service_2['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$service_3['Test']['testcode'].' - '.$service_3['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$service_4['Test']['testcode'].' - '.$service_4['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$service_5['Test']['testcode'].' - '.$service_5['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$service_6['Test']['testcode'].' - '.$service_6['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$service_7['Test']['testcode'].' - '.$service_7['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$service_8['Test']['testcode'].' - '.$service_8['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_8['RequestTest']['mrp'].'</p>'.'<p><strong>9)</strong> '.$service_9['Test']['testcode'].' - '.$service_9['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_9['RequestTest']['mrp'].'</p>';
				}
				if($count_service == 10)
				{
					$service_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[0])));
					$service_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[1])));
					$service_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[2])));
					$service_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[3])));
					$service_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[4])));
					$service_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[5])));
					$service_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[6])));
					$service_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[7])));
					$service_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[8])));
					$service_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_service[9])));
					$save_db_service_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[0],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[1],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[2],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[3],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[4],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[5],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[6],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[7],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_9 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[8],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$save_db_service_mrp_10 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_service[9],'RequestTest.type'=>'SR','RequestTest.status'=>1)));
					$service_name = '<p><strong>1)</strong> '.$service_1['Test']['testcode'].' - '.$service_1['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$service_2['Test']['testcode'].' - '.$service_2['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$service_3['Test']['testcode'].' - '.$service_3['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$service_4['Test']['testcode'].' - '.$service_4['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$service_5['Test']['testcode'].' - '.$service_5['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$service_6['Test']['testcode'].' - '.$service_6['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$service_7['Test']['testcode'].' - '.$service_7['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$service_8['Test']['testcode'].' - '.$service_8['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_8['RequestTest']['mrp'].'</p>'.'<p><strong>9)</strong> '.$service_9['Test']['testcode'].' - '.$service_9['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_9['RequestTest']['mrp'].'</p>'.'<p><strong>10)</strong> '.$service_10['Test']['testcode'].' - '.$service_10['Test']['test_parameter'].' - Rs.'.$save_db_service_mrp_10['RequestTest']['mrp'].'</p>';
				}
				$paymenthistory[$k]['Health']['service_name'] = $service_name;
			}
			
			//check if btc is applied
			$is_btc = $this->Paytrack->find('count',array('conditions'=>array('request_id'=>$val['Health']['id'],'pay_mode'=>'btc')));
			$paymenthistory[$k]['Health']['is_btc'] = $is_btc;
			if($val['Health']['received_amount'] == 0)
			{
				$paymenthistory[$k]['Health']['advance_rec'] = ($val['Health']['received_amount']+$val['Health']['balance_refund']);
				$paymenthistory[$k]['Health']['advance_due'] = $val['Health']['total_amount'];
			}
			if($val['Health']['received_amount'] != 0)
			{
				if($val['Health']['balance_refund'] == 0)
				{
					$paymenthistory[$k]['Health']['advance_rec'] = ($val['Health']['received_amount']+$val['Health']['balance_refund']);
					$paymenthistory[$k]['Health']['advance_due'] = $val['Health']['balance_amount'];
				}
				if($val['Health']['balance_refund'] != 0 && $val['Health']['refund_status'] == 0)
				{
					$paymenthistory[$k]['Health']['advance_rec'] = ($val['Health']['received_amount']+$val['Health']['balance_refund']);
					$paymenthistory[$k]['Health']['advance_due'] = '-'.$val['Health']['balance_refund'];
				}
				if($val['Health']['balance_refund'] != 0 && $val['Health']['refund_status'] == 1)
				{
					$paymenthistory[$k]['Health']['advance_rec'] = ($val['Health']['received_amount']+$val['Health']['balance_refund']);
					$paymenthistory[$k]['Health']['advance_due'] = 0;
				}
			}
			$paymenthistory[$k]['Health']['pat_name'] = $val['Health']['name'];
			$paymenthistory[$k]['Health']['adj_reason'] = $val['Health']['adj_reason'];
			
			$find_payment_detail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$val['Health']['id'])));
			if(!empty($find_payment_detail))
			{
				$paymenthistory[$k]['Health']['order_status'] = 'confirm';
			}
			if(empty($find_payment_detail))
			{
				$paymenthistory[$k]['Health']['order_status'] = 'not_confirm';
			}
			
			
			
			if($val['Health']['received_amount'] < $val['Health']['total_amount'])
			{
				$paymenthistory[$k]['Health']['report_status'] = 'not_upload';
			}
			if($val['Health']['received_amount'] >= $val['Health']['total_amount'])
			{
				$paymenthistory[$k]['Health']['report_status'] = 'upload';
				$paymenthistory[$k]['Health']['health_id'] = $val['Health']['id']; 
				$paymenthistory[$k]['Health']['request_num'] = $find_payment_detail['Billing']['order_id'];
			}
			if($paymenthistory[$k]['Health']['is_btc'] == 1 && $val['Health']['requ_status'] == 6)
			{
				//$paymenthistory[$k]['Health']['report_status'] = 'upload';
			}
			
			
			$paymenthistory[$k]['Health']['request_num'] = $find_payment_detail['Billing']['order_id'];
			
			if(!empty($val['Health']['cancelled_reason']))
			{
				$paymenthistory[$k]['Health']['cancel_reason'] = $val['Health']['cancelled_reason'];
			}
			if(!empty($val['Health']['lab_message']))
			{
				$paymenthistory[$k]['Health']['lab_message'] = $val['Health']['lab_message'];
			}
			$k++;
		}
			
		$this->Timelab = ClassRegistry::init("Timelab");
		$timelab = $this->Timelab->find('list',array('conditions'=>array('Timelab.status'=>'1')));
		
		$orderStatus = array(
				"0"=>"New booking",
				"1"=>"Slot Not Available",
				"2"=>"Slot Blocked",
				"3"=>"Follow Up",
				"4"=>"Phlebo Assigned",
				"5"=>"Sent to Lab",
				"6"=>"Report",
				"7"=>"Partial Report",
				"8"=>"Cancelled",
				"9"=>"closed",
				"10"=>"Sample Collected",
				"11"=>"Sample Rejected",
				"12"=>"Partial Sent To Lab",
				"13"=>"Rescheduled",
				"14"=>"Reg. in LIS",
				"15"=>"API New Booking",
				"16"=>"Specimen Drawn",
			);
		$this->set('timelab',$timelab);
		$this->set('orderStatus',$orderStatus);	
		$this->set('paymenthistory',$paymenthistory);
	}
	
	function print_user_receipt($req_id=NULL,$order_id=NULL)
	{
		$this->layout = false;
		$dec_req_id = base64_decode($req_id);
		$dec_order_id = base64_decode($order_id);
		$req_detail = $this->Health->find('first',array('conditions'=>array('Health.id'=>$dec_req_id)));
		$b = 0;
		if($req_detail['Health']['test_id'] != '')
		{
			$explode_test = explode(',',$req_detail['Health']['test_id']);
			
			foreach($explode_test as $key => $val)
			{
				$test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
				$req_detail['Health']['tests'][$b]['test_code'] = $test_name['Test']['testcode'];
				$req_detail['Health']['tests'][$b]['test_parameter'] = $test_name['Test']['test_parameter'];
				$req_detail['Health']['tests'][$b]['test_mrp'] = $test_name['Test']['mrp'];
				$b++;
			}
		}
		if($req_detail['Health']['profile_id'] != '')
		{
			$explode_profile = explode(',',$req_detail['Health']['profile_id']);
			foreach($explode_profile as $key => $val)
			{
				$test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
				$req_detail['Health']['tests'][$b]['test_code'] = $test_name['Test']['testcode'];
				$req_detail['Health']['tests'][$b]['test_parameter'] = $test_name['Test']['test_parameter'];
				$req_detail['Health']['tests'][$b]['test_mrp'] = $test_name['Test']['mrp'];
				$b++;
			}
		}
		if($req_detail['Health']['offer_id'] != '')
		{
			$explode_offer = explode(',',$req_detail['Health']['offer_id']);
			foreach($explode_offer as $key => $val)
			{
				$offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$val)));
				$req_detail['Health']['tests'][$b]['test_code'] = $offer_name['Banner']['banner_code'];
				$req_detail['Health']['tests'][$b]['test_parameter'] = $offer_name['Banner']['banner_name'];
				$req_detail['Health']['tests'][$b]['test_mrp'] = $offer_name['Banner']['banner_mrp'];
				$b++;
			}
		}
		if($req_detail['Health']['package_id'] != '')
		{
			$explode_package = explode(',',$req_detail['Health']['package_id']);
			foreach($explode_package as $key => $val)
			{
				$package_name = $this->Package->find('first',array('conditions'=>array('Package.id'=>$val)));
				$req_detail['Health']['tests'][$b]['test_code'] = $package_name['Package']['package_code'];
				$req_detail['Health']['tests'][$b]['test_parameter'] = $package_name['Package']['package_name'];
				$req_detail['Health']['tests'][$b]['test_mrp'] = $package_name['Package']['package_mrp'];
				$b++;
			}
		}
		if($req_detail['Health']['service_id'] != '')
		{
			$explode_service = explode(',',$req_detail['Health']['service_id']);
			foreach($explode_service as $key => $val)
			{
				$service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
				$req_detail['Health']['tests'][$b]['test_code'] = $service_name['Test']['testcode'];
				$req_detail['Health']['tests'][$b]['test_parameter'] = $service_name['Test']['test_parameter'];
				$req_detail['Health']['tests'][$b]['test_mrp'] = $service_name['Test']['mrp'];
				$b++;
			}
		}
		
		$vv = 0;
		foreach($req_detail['Health']['tests'] as $k => $x) 
		{
			$vv = ($x['test_mrp']+$vv);
			$vv = $vv;
		}
		$req_detail['Health']['grand_total'] = $vv;
		
		if($req_detail['Health']['home_report'] != 0)
		{
			$req_detail['Health']['home_report_charge'] = '50';
		}
		if($req_detail['Health']['discount_id'] != 0)
		{
			$dicount_info = $this->Discount->find('first',array('conditions'=>array('Discount.id'=>$req_detail['Health']['discount_id'])));
			$req_detail['Health']['discount_code'] = $dicount_info['Discount']['discount_code'];
			$req_detail['Health']['discount_name'] = $dicount_info['Discount']['discount_name'];
			if($dicount_info['Discount']['type'] == 'Percent')
			{
				$v_1 = ($dicount_info['Discount']['amount']/100);
				$v_2 = ($vv*$v_1);
				$req_detail['Health']['discount_amt'] = $dicount_info['Discount']['amount'].'% ('.$v_2.')';
			}
			if($dicount_info['Discount']['type'] == 'Rupees')
			{
				$req_detail['Health']['discount_amt'] = $dicount_info['Discount']['amount'];
			}
		}
		
		
		if($req_detail['Health']['discount_amount'] != 0)
		{
			$req_detail['Health']['add_discount'] = 'Yes';
			$req_detail['Health']['discount_amount'] = $req_detail['Health']['discount_amount'];
		}
		
		//01-04014 Starts
		$get_all_pay_track = $this->Paytrack->find('all',array('conditions'=>array('Paytrack.request_id'=>$req_detail['Health']['id'])));
		$init_amt = 0;
		$adj_amount = 0;
		foreach($get_all_pay_track as $pay_key => $pay_val)
		{
			if($pay_val['Paytrack']['pay_mode'] == 'adjust')
			{
				$adj_amount = ($pay_val['Paytrack']['pay_install']+$adj_amount);
			}
			else
			{
				$init_amt = ($pay_val['Paytrack']['pay_install']+$init_amt);
			}
		}
		$req_detail['Health']['total_rec_amt'] = $init_amt;
		$req_detail['Health']['adj_amt'] = $adj_amount;
		//01-04014 Ends
		if(empty($req_detail['Health']['city']))
		{
			if($req_detail['Health']['sample_time1'] == 1){ $home_collection_time = '7:00AM - 7:30AM'; }
			if($req_detail['Health']['sample_time1'] == 2){ $home_collection_time = '7:30AM - 8:00AM'; }
			if($req_detail['Health']['sample_time1'] == 3){ $home_collection_time = '8:00AM - 8:30AM'; }
			if($req_detail['Health']['sample_time1'] == 4){ $home_collection_time = '8:30AM - 9:00AM'; }
			if($req_detail['Health']['sample_time1'] == 5){ $home_collection_time = '9:00AM - 9:30AM'; }
			if($req_detail['Health']['sample_time1'] == 6){ $home_collection_time = '9:30AM - 10:00AM'; }
			if($req_detail['Health']['sample_time1'] == 7){ $home_collection_time = '10:00AM - 10:30AM'; }
			if($req_detail['Health']['sample_time1'] == 8){ $home_collection_time = '10:30AM - 11:00AM'; }
			if($req_detail['Health']['sample_time1'] == 9){ $home_collection_time = '11:00AM - 11:30AM'; }
			if($req_detail['Health']['sample_time1'] == 10){ $home_collection_time = '11:30AM - 12:00PM'; }
			if($req_detail['Health']['sample_time1'] == 11){ $home_collection_time = '12:00PM - 12:30PM'; }
			if($req_detail['Health']['sample_time1'] == 12){ $home_collection_time = '12:30PM - 1:00PM'; }
			if($req_detail['Health']['sample_time1'] == 13){ $home_collection_time = '1:00PM - 1:30PM'; }
			if($req_detail['Health']['sample_time1'] == 14){ $home_collection_time = '1:30PM - 2:00PM'; }
			if($req_detail['Health']['sample_time1'] == 15){ $home_collection_time = '2:00PM - 2:30PM'; }
			if($req_detail['Health']['sample_time1'] == 16){ $home_collection_time = '2:30PM - 3:00PM'; }
			if($req_detail['Health']['sample_time1'] == 17){ $home_collection_time = '3:00PM - 3:30PM'; }
			if($req_detail['Health']['sample_time1'] == 18){ $home_collection_time = '3:30PM - 4:00PM'; }
			if($req_detail['Health']['sample_time1'] == 19){ $home_collection_time = '4:00PM - 4:30PM'; }
			if($req_detail['Health']['sample_time1'] == 20){ $home_collection_time = '4:30PM - 5:00PM'; }
			if($req_detail['Health']['sample_time1'] == 21){ $home_collection_time = '5:00PM - 5:30PM'; }
			if($req_detail['Health']['sample_time1'] == 22){ $home_collection_time = '5:30PM - 6:00PM'; }
			if($req_detail['Health']['sample_time1'] == 23){ $home_collection_time = '6:00PM - 6:30PM'; }
			if($req_detail['Health']['sample_time1'] == 24){ $home_collection_time = '6:30PM - 7:00PM'; }
			$this->set('home_collection_time',$home_collection_time);
		}
		
		$pcc_list = $this->Lab->find('all',array('conditions'=>array('Lab.status'=>1)));
		$this->set('pcc_list',$pcc_list);	
				
		$this->set('req_detail',$req_detail);
		$this->set('dec_order_id',$dec_order_id);
	}
	
	function __removeElementWithValue($array,  $value1,$value2,$value3,$value4,$value5)
	{
		//echo "<pre>"; print_r($array); exit;
		foreach($array as $subKey => $subArray)
		{
			if($subArray['Cart']['test_id'] == $value1)
			{
				if($subArray['Cart']['test_code'] == $value2)
				{
					if($subArray['Cart']['test_parameter'] == $value3)
					{
						if($subArray['Cart']['test_reporting'] == $value4)
						{
							if($subArray['Cart']['test_mrp'] == $value5)
							{
								$this->Session->delete('session_test.'.$subKey.'.Cart.test_id');
								$this->Session->delete('session_test.'.$subKey.'.Cart.test_code');
								$this->Session->delete('session_test.'.$subKey.'.Cart.test_parameter');
								$this->Session->delete('session_test.'.$subKey.'.Cart.test_reporting');
								$this->Session->delete('session_test.'.$subKey.'.Cart.test_mrp');	
								$this->Session->delete('session_test.'.$subKey);
								$this->Session->delete('session_test_type.'.$subKey.'.test_id');
								$this->Session->delete('session_test_type.'.$subKey);
								$this->Session->delete('session_banner_type.'.$subKey.'.test_id');
								$this->Session->delete('session_banner_type.'.$subKey);
							}
						}
					}
				}
			}
			
		}
		$this->redirect('/tests/my_cart');
	}
	
	
//	for delete services test according time  
	
	function __removeElementWithValue1($array,  $value1,$value2,$value3,$value4,$value5)
	{
		//echo "<pre>"; print_r($array); exit;
		foreach($array as $subKey => $subArray)
		{
			if($subArray['Cart']['test_id'] == $value1)
			{
				if($subArray['Cart']['test_code'] == $value2)
				{
					if($subArray['Cart']['test_parameter'] == $value3)
					{
						if($subArray['Cart']['test_reporting'] == $value4)
						{
							if($subArray['Cart']['test_mrp'] == $value5)
							{
								$this->Session->delete('session_test.'.$subKey.'.Cart.test_id');
								$this->Session->delete('session_test.'.$subKey.'.Cart.test_code');
								$this->Session->delete('session_test.'.$subKey.'.Cart.test_parameter');
								$this->Session->delete('session_test.'.$subKey.'.Cart.test_reporting');
								$this->Session->delete('session_test.'.$subKey.'.Cart.test_mrp');	
								$this->Session->delete('session_test.'.$subKey);
								$this->Session->delete('session_test_type.'.$subKey.'.test_id');
								$this->Session->delete('session_test_type.'.$subKey);
								$this->Session->delete('session_banner_type.'.$subKey.'.test_id');
								$this->Session->delete('session_banner_type.'.$subKey);
							}
						}
					}
				}
			}
			
		}
		//$this->redirect('/tests/my_cart');
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
	function logout()
	{
		$this->Session->destroy('UserDetail'); 
		$this->redirect(array('controller'=>'pages','action'=>'index'));
	}
	
	function discount_info()
	{
		$get_code = $_REQUEST['discount_code'];
		$get_tot_amt = $_REQUEST['tot_cost'];
		$get_all = $this->Discount->find('first',array('conditions'=>array('Discount.discount_code'=>$get_code,'Discount.used_status'=>0)));
		//echo "<pre>"; print_r($get_all); exit;
		if(!empty($get_all))
		{
			if($get_all['Discount']['type'] == 'Percent')
			{
				$value_1 = ($get_all['Discount']['amount']/100);
				$value_2 = ($get_tot_amt*$value_1);
				$value_3 = ($get_tot_amt-$value_2);
				$value_4 = ($value_3+50);
				$x['final_amt'] = round($value_4);
				$x['disc_desc'] = $get_all['Discount']['discount_description'];
				$x['less_amt'] = $get_all['Discount']['amount'].'%';
				$x['disc_type'] = 'P';
			}
			if($get_all['Discount']['type'] == 'Rupees')
			{
				$value_3 = ($get_tot_amt-$get_all['Discount']['amount']);
				$value_4 = ($value_3+50);
				$x['final_amt'] = round($value_4);
				$x['disc_desc'] = $get_all['Discount']['discount_description'];
				$x['less_amt'] = $get_all['Discount']['amount'];
				$x['disc_type'] = 'R';
			}
			$x['success'] = 'success';
			$m['disc_info'] = $x;
		}
		else
		{
			$x['success'] = 'notsuccess';
			$m['disc_info'] = $x;
		}
		echo json_encode($m);
		exit;
	}
	
	function discount_info_uncheck()
	{
		$get_code = $_REQUEST['discount_code'];
		$get_tot_amt = $_REQUEST['tot_cost'];
		$get_all = $this->Discount->find('first',array('conditions'=>array('Discount.discount_code'=>$get_code,'Discount.used_status'=>0)));
		//echo "<pre>"; print_r($get_all); exit;
		if(!empty($get_all))
		{
			if($get_all['Discount']['type'] == 'Percent')
			{
				$value_1 = ($get_all['Discount']['amount']/100);
				$value_2 = ($get_tot_amt*$value_1);
				$value_3 = ($get_tot_amt+$value_2);
				$value_4 = ($value_3);
				$x['final_amt'] = round($value_4);
				$x['disc_desc'] = $get_all['Discount']['discount_description'];
				$x['less_amt'] = $get_all['Discount']['amount'].'%';
				$x['discount_id'] = $get_all['Discount']['id'];
				$x['disc_type'] = 'P';
			}
			if($get_all['Discount']['type'] == 'Rupees')
			{
				$value_3 = ($get_tot_amt+$get_all['Discount']['amount']);
				$value_4 = ($value_3);
				$x['final_amt'] = round($value_4);
				$x['disc_desc'] = $get_all['Discount']['discount_description'];
				$x['less_amt'] = $get_all['Discount']['amount'];
				$x['discount_id'] = $get_all['Discount']['id'];
				$x['disc_type'] = 'R';
			}
			$x['success'] = 'success';
			$m['disc_info'] = $x;
		}
		else
		{
			$x['success'] = 'notsuccess';
			$m['disc_info'] = $x;
		}
		echo json_encode($m);
		exit;
	}
	
	function discount_info_only()
	{
		$get_code = $_REQUEST['discount_code'];
		$get_tot_amt = $_REQUEST['tot_cost'];
		$get_all = $this->Discount->find('first',array('conditions'=>array('Discount.discount_code'=>$get_code,'Discount.used_status'=>0,'Discount.status'=>1)));
		if(!empty($get_all))
		{
			if($get_all['Discount']['type'] == 'Percent')
			{
				$value_1 = ($get_all['Discount']['amount']/100);
				$value_2 = ($get_tot_amt*$value_1);
				$value_3 = ($get_tot_amt-$value_2);
				$value_4 = $value_3;
				$x['final_amt'] = round($value_4);
				$x['disc_desc'] = $get_all['Discount']['discount_description'];
				$x['less_amt'] = $get_all['Discount']['amount'].'%';
				$x['discount_id'] = $get_all['Discount']['id'];
				$x['disc_type'] = 'P';
			}
			if($get_all['Discount']['type'] == 'Rupees')
			{
				$value_3 = ($get_tot_amt-$get_all['Discount']['amount']);
				$value_4 = $value_3;
				$x['final_amt'] = round($value_4);
				$x['disc_desc'] = $get_all['Discount']['discount_description'];
				$x['less_amt'] = $get_all['Discount']['amount'];
				$x['discount_id'] = $get_all['Discount']['id'];
				$x['disc_type'] = 'R';
			}
			$x['success'] = 'success';
			$m['disc_info'] = $x;
		}
		else
		{
			$x['success'] = 'notsuccess';
			$m['disc_info'] = $x;
		}
		echo json_encode($m);
		exit;
	}
	
	function discount_info_unck()
	{
		$get_code = $_REQUEST['discount_code'];
		$get_tot_amt = $_REQUEST['tot_cost'];
		$get_all = $this->Discount->find('first',array('conditions'=>array('Discount.discount_code'=>$get_code,'Discount.used_status'=>0)));
		if(!empty($get_all))
		{
			if($get_all['Discount']['type'] == 'Percent')
			{
				$value_1 = ($get_all['Discount']['amount']/100);
				$value_2 = ($get_tot_amt*$value_1);
				$value_3 = ($get_tot_amt+$value_2);
				$value_4 = $value_3;
				$x['final_amt'] = round($value_4);
				$x['discount_id'] = $get_all['Discount']['id'];
				$x['disc_type'] = 'P';
			}
			if($get_all['Discount']['type'] == 'Rupees')
			{
				$value_3 = ($get_tot_amt+$get_all['Discount']['amount']);
				$value_4 = $value_3;
				$x['final_amt'] = round($value_4);
				$x['discount_id'] = $get_all['Discount']['id'];
				$x['disc_type'] = 'R';
			}
			$x['success'] = 'success';
			$m['disc_info'] = $x;
		}
		else
		{
			$x['success'] = 'notsuccess';
			$m['disc_info'] = $x;
		}
		echo json_encode($m);
		exit;
	}
	
	function view_request($id=NULL)
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','Niramayahealth Care | View Request(s)');
		$dec_id = base64_decode($id);
		
		$this->paginate = array('Health' => array('limit' =>'10','order'=>array('Health.id'=>'DESC'),'conditions'=>array('Health.user_id'=>$dec_id,'Health.status'=>1)));
		$paymenthistory=$this->paginate('Health');
		$k = 0;
		foreach($paymenthistory as $key => $val)
		{
			if($val['Health']['test_id'] != '')
			{
				$paymenthistory[$k]['Health']['test_type'] = 'Test(s)';
				$explode_test = explode(',',$val['Health']['test_id']);
				$count_test = count($explode_test);
				if($count_test == 1)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 2)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 3)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 4)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[3],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_4['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 5)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
					$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[3],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[4],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_5['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 6)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
					$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
					$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[3],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[4],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[5],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_6['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 7)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
					$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
					$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
					$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[3],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[4],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[5],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[6],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_7['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 8)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
					$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
					$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
					$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
					$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[3],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[4],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[5],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[6],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[7],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$test_8['Test']['testcode'].' - '.$test_8['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_8['RequestTest']['mrp'].'</p>';
				}
				if($count_test == 9)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
					$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
					$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
					$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
					$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
					$test_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[8])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[3],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[4],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[5],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[6],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[7],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_9 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[8],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$test_8['Test']['testcode'].' - '.$test_8['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_8['RequestTest']['mrp'].'</p>'.'<p><strong>9)</strong> '.$test_9['Test']['testcode'].' - '.$test_9['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_9['RequestTest']['mrp'];
				}
				if($count_test == 10)
				{
					$test_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[0])));
					$test_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[1])));
					$test_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[2])));
					$test_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[3])));
					$test_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[4])));
					$test_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[5])));
					$test_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[6])));
					$test_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[7])));
					$test_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[8])));
					$test_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_test[9])));
					$save_db_test_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[0],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[1],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[2],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[3],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[4],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[5],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[6],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[7],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_9 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[8],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$save_db_test_mrp_10 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_test[9],'RequestTest.type'=>'TE','RequestTest.status'=>1)));
					$test_name = '<p><strong>1)</strong> '.$test_1['Test']['testcode'].' - '.$test_1['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$test_2['Test']['testcode'].' - '.$test_2['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$test_3['Test']['testcode'].' - '.$test_3['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$test_4['Test']['testcode'].' - '.$test_4['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$test_5['Test']['testcode'].' - '.$test_5['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$test_6['Test']['testcode'].' - '.$test_6['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$test_7['Test']['testcode'].' - '.$test_7['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$test_8['Test']['testcode'].' - '.$test_8['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_8['RequestTest']['mrp'].'</p>'.'<p><strong>9)</strong> '.$test_9['Test']['testcode'].' - '.$test_9['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_9['RequestTest']['mrp'].'</p>'.'<p><strong>10)</strong> '.$test_10['Test']['testcode'].' - '.$test_10['Test']['test_parameter'].' - Rs.'.$save_db_test_mrp_10['RequestTest']['mrp'].'</p>';
				}
				$paymenthistory[$k]['Health']['test_name'] = $test_name;
			}
			if($val['Health']['profile_id'] != '')
			{
				$paymenthistory[$k]['Health']['profile_type'] = 'Profile(s)';
				$explode_profile = explode(',',$val['Health']['profile_id']);
				$count_profile = count($explode_profile);
				if($count_profile == 1)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 2)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 3)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 4)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[3],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_4['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 5)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
					$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[3],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[4],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_5['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 6)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
					$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
					$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[3],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[4],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[5],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_6['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 7)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
					$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
					$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
					$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[3],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[4],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[5],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[6],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_7['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 8)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
					$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
					$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
					$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
					$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[3],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[4],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[5],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[6],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[7],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$profile_8['Test']['testcode'].' - '.$profile_8['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_8['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 9)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
					$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
					$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
					$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
					$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
					$profile_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[8])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[3],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[4],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[5],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[6],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[7],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_9 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[8],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$profile_8['Test']['testcode'].' - '.$profile_8['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_8['RequestTest']['mrp'].'</p>'.'<p><strong>9)</strong> '.$profile_9['Test']['testcode'].' - '.$profile_9['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_9['RequestTest']['mrp'].'</p>';
				}
				if($count_profile == 10)
				{
					$profile_1 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[0])));
					$profile_2 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[1])));
					$profile_3 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[2])));
					$profile_4 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[3])));
					$profile_5 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[4])));
					$profile_6 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[5])));
					$profile_7 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[6])));
					$profile_8 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[7])));
					$profile_9 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[8])));
					$profile_10 = $this->Test->find('first',array('conditions'=>array('Test.id'=>$explode_profile[9])));
					$save_db_profile_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[0],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[1],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[2],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[3],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[4],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[5],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[6],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[7],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_9 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[8],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$save_db_profile_mrp_10 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_profile[9],'RequestTest.type'=>'PR','RequestTest.status'=>1)));
					$profile_name = '<p><strong>1)</strong> '.$profile_1['Test']['testcode'].' - '.$profile_1['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$profile_2['Test']['testcode'].' - '.$profile_2['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$profile_3['Test']['testcode'].' - '.$profile_3['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$profile_4['Test']['testcode'].' - '.$profile_4['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$profile_5['Test']['testcode'].' - '.$profile_5['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$profile_6['Test']['testcode'].' - '.$profile_6['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$profile_7['Test']['testcode'].' - '.$profile_7['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$profile_8['Test']['testcode'].' - '.$profile_8['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_8['RequestTest']['mrp'].'</p>'.'<p><strong>9)</strong> '.$profile_9['Test']['testcode'].' - '.$profile_9['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_9['RequestTest']['mrp'].'</p>'.'<p><strong>10)</strong> '.$profile_10['Test']['testcode'].' - '.$profile_10['Test']['test_parameter'].' - Rs.'.$save_db_profile_mrp_10['RequestTest']['mrp'].'</p>';
				}
				$paymenthistory[$k]['Health']['profile_name'] = $profile_name;
			}
			if($val['Health']['offer_id'] != '')
			{
				$paymenthistory[$k]['Health']['offer_type'] = 'Offer Banner(s)';
				$explode_offer = explode(',',$val['Health']['offer_id']);
				$count_offer = count($explode_offer);
				if($count_offer == 1)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>';
				}
				if($count_offer == 2)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[1],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_2['RequestTest']['mrp'].'</p>';
				}
				if($count_offer == 3)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
					$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[1],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[2],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_3['RequestTest']['mrp'].'</p>';
				}
				if($count_offer == 4)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
					$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
					$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[1],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[2],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[3],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_4['RequestTest']['mrp'].'</p>';
				}
				if($count_offer == 5)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
					$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
					$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
					$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[1],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[2],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[3],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[4],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_5['RequestTest']['mrp'].'</p>';
				}
				if($count_offer == 6)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
					$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
					$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
					$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
					$offer_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[5])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[1],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[2],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[3],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[4],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[5],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$offer_6['Banner']['banner_code'].' - '.$offer_6['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_6['RequestTest']['mrp'].'</p>';
				}
				if($count_offer == 7)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
					$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
					$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
					$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
					$offer_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[5])));
					$offer_7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[6])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[1],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[2],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[3],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[4],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[5],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[6],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$offer_6['Banner']['banner_code'].' - '.$offer_6['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$offer_7['Banner']['banner_code'].' - '.$offer_7['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_7['RequestTest']['mrp'].'</p>';
				}
				if($count_offer == 8)
				{
					$offer_1 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[0])));
					$offer_2 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[1])));
					$offer_3 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[2])));
					$offer_4 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[3])));
					$offer_5 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[4])));
					$offer_6 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[5])));
					$offer_7 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[6])));
					$offer_8 = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$explode_offer[7])));
					$save_db_offer_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[0],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[1],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[2],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[3],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[4],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_6 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[5],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_7 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[6],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$save_db_offer_mrp_8 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_offer[7],'RequestTest.type'=>'OF','RequestTest.status'=>1)));
					$offer_name = '<p><strong>1)</strong> '.$offer_1['Banner']['banner_code'].' - '.$offer_1['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$offer_2['Banner']['banner_code'].' - '.$offer_2['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$offer_3['Banner']['banner_code'].' - '.$offer_3['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$offer_4['Banner']['banner_code'].' - '.$offer_4['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$offer_5['Banner']['banner_code'].' - '.$offer_5['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_5['RequestTest']['mrp'].'</p>'.'<p><strong>6)</strong> '.$offer_6['Banner']['banner_code'].' - '.$offer_6['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_6['RequestTest']['mrp'].'</p>'.'<p><strong>7)</strong> '.$offer_7['Banner']['banner_code'].' - '.$offer_7['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_7['RequestTest']['mrp'].'</p>'.'<p><strong>8)</strong> '.$offer_8['Banner']['banner_code'].' - '.$offer_8['Banner']['banner_name'].' - Rs.'.$save_db_offer_mrp_8['RequestTest']['mrp'].'</p>';
				}
				$paymenthistory[$k]['Health']['offer_name'] = $offer_name;
			}
			
			if($val['Health']['package_id'] != '')
			{
				$paymenthistory[$k]['Health']['package_type'] = 'Package(s)';
				$explode_package = explode(',',$val['Health']['package_id']);
				$count_package = count($explode_package);
				if($count_package == 1)
				{
					$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
					$save_db_package_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[0],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$save_db_package_mrp_1['RequestTest']['mrp'].'</p>';
				}
				if($count_package == 2)
				{
					$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
					$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
					$save_db_package_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[0],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[1],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$save_db_package_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$save_db_package_mrp_2['RequestTest']['mrp'].'</p>';
				}
				if($count_package == 3)
				{
					$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
					$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
					$package_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[2])));
					$save_db_package_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[0],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[1],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[2],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$save_db_package_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$save_db_package_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$package_3['Package']['package_name'].' - Rs.'.$save_db_package_mrp_3['RequestTest']['mrp'].'</p>';
				}
				if($count_package == 4)
				{
					$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
					$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
					$package_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[2])));
					$package_4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[3])));
					$save_db_package_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[0],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[1],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[2],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[3],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$save_db_package_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$save_db_package_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$package_3['Package']['package_name'].' - Rs.'.$save_db_package_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$package_4['Package']['package_name'].' - Rs.'.$save_db_package_mrp_4['RequestTest']['mrp'].'</p>';
				}
				if($count_package == 5)
				{
					$package_1 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[0])));
					$package_2 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[1])));
					$package_3 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[2])));
					$package_4 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[3])));
					$package_5 = $this->Package->find('first',array('conditions'=>array('Package.id'=>$explode_package[4])));
					$save_db_package_mrp_1 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[0],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_2 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[1],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_3 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[2],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_4 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[3],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$save_db_package_mrp_5 = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$val['Health']['id'],'RequestTest.test_id'=>$explode_package[4],'RequestTest.type'=>'PA','RequestTest.status'=>1)));
					$package_name = '<p><strong>1)</strong> '.$package_1['Package']['package_name'].' - Rs.'.$save_db_package_mrp_1['RequestTest']['mrp'].'</p>'.'<p><strong>2)</strong> '.$package_2['Package']['package_name'].' - Rs.'.$save_db_package_mrp_2['RequestTest']['mrp'].'</p>'.'<p><strong>3)</strong> '.$package_3['Package']['package_name'].' - Rs.'.$save_db_package_mrp_3['RequestTest']['mrp'].'</p>'.'<p><strong>4)</strong> '.$package_4['Package']['package_name'].' - Rs.'.$save_db_package_mrp_4['RequestTest']['mrp'].'</p>'.'<p><strong>5)</strong> '.$package_5['Package']['package_name'].' - Rs.'.$save_db_package_mrp_5['RequestTest']['mrp'].'</p>';
				}
				$paymenthistory[$k]['Health']['package_name'] = $package_name;
			}
			
			
			if($val['Health']['received_amount'] == 0)
			{
				$paymenthistory[$k]['Health']['advance_rec'] = ($val['Health']['received_amount']+$val['Health']['balance_refund']);
				$paymenthistory[$k]['Health']['advance_due'] = $val['Health']['total_amount'];
			}
			if($val['Health']['received_amount'] != 0)
			{
				if($val['Health']['balance_refund'] == 0)
				{
					$paymenthistory[$k]['Health']['advance_rec'] = ($val['Health']['received_amount']+$val['Health']['balance_refund']);
					$paymenthistory[$k]['Health']['advance_due'] = $val['Health']['balance_amount'];
				}
				if($val['Health']['balance_refund'] != 0 && $val['Health']['refund_status'] == 0)
				{
					$paymenthistory[$k]['Health']['advance_rec'] = ($val['Health']['received_amount']+$val['Health']['balance_refund']);
					$paymenthistory[$k]['Health']['advance_due'] = '-'.$val['Health']['balance_refund'];
				}
				if($val['Health']['balance_refund'] != 0 && $val['Health']['refund_status'] == 1)
				{
					$paymenthistory[$k]['Health']['advance_rec'] = ($val['Health']['received_amount']+$val['Health']['balance_refund']);
					$paymenthistory[$k]['Health']['advance_due'] = 0;
				}
			}
			$paymenthistory[$k]['Health']['pat_name'] = $val['Health']['name'];
			
			$find_payment_detail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$val['Health']['id'])));
			if(!empty($find_payment_detail))
			{
				$paymenthistory[$k]['Health']['order_status'] = 'confirm';
			}
			if(empty($find_payment_detail))
			{
				$paymenthistory[$k]['Health']['order_status'] = 'not_confirm';
			}
			$fin_amt = ($val['Health']['total_amount'] - $val['Health']['discount_amount']);
			if($val['Health']['received_amount'] < $val['Health']['total_amount'])
			{
				$paymenthistory[$k]['Health']['report_status'] = 'not_upload';
			}
			if($val['Health']['received_amount'] == $val['Health']['total_amount'])
			{
				$paymenthistory[$k]['Health']['report_status'] = 'upload';
				$paymenthistory[$k]['Health']['request_num'] = $find_payment_detail['Billing']['order_id'];
			}
			$paymenthistory[$k]['Health']['request_num'] = $find_payment_detail['Billing']['order_id'];
			
			if($val['Health']['requ_status'] == 1)
			{
				$lab_name = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$val['Health']['assigned_lab'])));
				$paymenthistory[$k]['Health']['lab_status'] = REQUEST_BOOKED.' please visit '.$lab_name['Lab']['pcc_name'].' Center';
			}
			if($val['Health']['requ_status'] == 2)
			{
				$paymenthistory[$k]['Health']['lab_status'] = REQUEST_BOOKED;
			}
			if($val['Health']['requ_status'] == 3)
			{
				$paymenthistory[$k]['Health']['lab_status'] = AGENT_ASSIGNED;
			}
			if($val['Health']['requ_status'] == 4)
			{
				$paymenthistory[$k]['Health']['lab_status'] = SAMPLE_COLLECTED;
			}
			if($val['Health']['requ_status'] == 5)
			{
				$paymenthistory[$k]['Health']['lab_status'] = SENT_LAB;
			}
			if($val['Health']['requ_status'] == 6)
			{
				$paymenthistory[$k]['Health']['report_status_final'] = REPORT_UPLOAD;
			}
			if($val['Health']['requ_status'] == 7)
			{
				$paymenthistory[$k]['Health']['report_status_final'] = nl2br($val['Health']['partial_reason']);
			}
			if(!empty($val['Health']['cancelled_reason']))
			{
				$paymenthistory[$k]['Health']['cancel_reason'] = $val['Health']['cancelled_reason'];
			}
			if(!empty($val['Health']['lab_message']))
			{
				$paymenthistory[$k]['Health']['lab_message'] = $val['Health']['lab_message'];
			}
			
			$k++;
		}
	//	print_R($paymenthistory);die;
		$this->set('paymenthistory',$paymenthistory);
	}
	
	function discount_info_id()
	{
		$get_code = $_REQUEST['discount_code'];
		$get_all = $this->Discount->find('first',array('conditions'=>array('Discount.discount_code'=>$get_code)));
		if(!empty($get_all))
		{
			if($get_all['Discount']['type'] == 'Percent')
			{
				$x['discount_id'] = $get_all['Discount']['id'];
			}
			if($get_all['Discount']['type'] == 'Rupees')
			{
				$x['discount_id'] = $get_all['Discount']['id'];
			}
			$x['success'] = 'success';
			$m['disc_info'] = $x;
		}
		else
		{
			$x['success'] = 'notsuccess';
			$m['disc_info'] = $x;
		}
		echo json_encode($m);
		exit;
	}
	
	function bmi_calculator($form_arg = NULL)
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','Niramayahealth Care | BMI Calculator');
		if(!empty($this->data))
		{
			if($form_arg == 'bmi_calc')
			{
				if($this->data['BMICalculator']['select_option'] == 1)
				{
					$pat_weight = $this->data['BMICalculator']['weight'];
					$pat_height_feet = $this->data['BMICalculator']['height_feet'];
					$pat_height_inch = $this->data['BMICalculator']['height_inch'];
				
					$pat_height_feet_in_meter = ($pat_height_feet*0.3048);
					$pat_height_inch_in_meter = ($pat_height_inch*0.0254);
				
					$pat_height_in_meter = ($pat_height_feet_in_meter+$pat_height_inch_in_meter);
				
					$square_of_height_in_meter = ($pat_height_in_meter*$pat_height_in_meter);
					$bmi_of_pat = ($pat_weight/$square_of_height_in_meter);
					
					$bmi_of_pat = number_format($bmi_of_pat,2);	
					
					if(($pat_height_feet == 5) && ($pat_height_inch == 0)){$ideal_weight = '52.3 KG';}
					if(($pat_height_feet == 5) && ($pat_height_inch == 1)){$ideal_weight = '54.5 KG';}
					if(($pat_height_feet == 5) && ($pat_height_inch == 2)){$ideal_weight = '56.8 KG';}
					if(($pat_height_feet == 5) && ($pat_height_inch == 3)){$ideal_weight = '56.8 KG';}
					if(($pat_height_feet == 5) && ($pat_height_inch == 4)){$ideal_weight = '59.1 KG';}
					if(($pat_height_feet == 5) && ($pat_height_inch == 5)){$ideal_weight = '61.4 KG';}
					if(($pat_height_feet == 5) && ($pat_height_inch == 6)){$ideal_weight = '63.6 KG';}
					if(($pat_height_feet == 5) && ($pat_height_inch == 7)){$ideal_weight = '65.9 KG';}
					if(($pat_height_feet == 5) && ($pat_height_inch == 8)){$ideal_weight = '68.2 KG';}
					if(($pat_height_feet == 5) && ($pat_height_inch == 9)){$ideal_weight = '70.5 KG';}
					if(($pat_height_feet == 5) && ($pat_height_inch == 10)){$ideal_weight = '72.7 KG';}
					if(($pat_height_feet == 5) && ($pat_height_inch == 11)){$ideal_weight = '72.7 KG';}
					if(($pat_height_feet == 6) && ($pat_height_inch == 0)){$ideal_weight = '75.0 KG';}
					if(($pat_height_feet == 6) && ($pat_height_inch == 1)){$ideal_weight = '77.3 KG';}
					if(($pat_height_feet == 6) && ($pat_height_inch == 2)){$ideal_weight = '79.5 KG';}
					if(($pat_height_feet == 6) && ($pat_height_inch == 3)){$ideal_weight = '81.8 KG';}
					if(($pat_height_feet == 6) && ($pat_height_inch == 4)){$ideal_weight = '84.1 KG';}
					
					$this->set('enter_height_feet',$this->data['BMICalculator']['height_feet']);
					$this->set('enter_height_inch',$this->data['BMICalculator']['height_inch']);
					$this->set('enter_height_cm','');
					$this->set('ideal_weight',$ideal_weight);
				}
				if($this->data['BMICalculator']['select_option'] == 2)
				{
					$pat_weight = $this->data['BMICalculator']['weight'];
					$pat_height_feet_in_cm = $this->data['BMICalculator']['height_cms'];
					
					$pat_height_feet_in_meter = ($pat_height_feet_in_cm*0.01);
					$square_of_height_in_meter = ($pat_height_feet_in_meter*$pat_height_feet_in_meter);
					$bmi_of_pat = ($pat_weight/$square_of_height_in_meter);
					
					$bmi_of_pat = number_format($bmi_of_pat,2);	
					
					if(($pat_height_feet_in_cm >= 152.4) && ($pat_height_feet_in_cm < 154.9)){$ideal_weight = '52.3 KG';}
					if(($pat_height_feet_in_cm >= 154.9) && ($pat_height_feet_in_cm < 157.4)){$ideal_weight = '54.5 KG';}
					if(($pat_height_feet_in_cm >= 157.4) && ($pat_height_feet_in_cm < 160.0)){$ideal_weight = '56.8 KG';}
					if(($pat_height_feet_in_cm >= 160.0) && ($pat_height_feet_in_cm < 162.5)){$ideal_weight = '56.8 KG';}
					if(($pat_height_feet_in_cm >= 162.5) && ($pat_height_feet_in_cm < 165.1)){$ideal_weight = '59.1 KG';}
					if(($pat_height_feet_in_cm >= 165.1) && ($pat_height_feet_in_cm < 167.6)){$ideal_weight = '61.4 KG';}
					if(($pat_height_feet_in_cm >= 167.6) && ($pat_height_feet_in_cm < 170.1)){$ideal_weight = '63.6 KG';}
					if(($pat_height_feet_in_cm >= 170.1) && ($pat_height_feet_in_cm < 172.7)){$ideal_weight = '65.9 KG';}
					if(($pat_height_feet_in_cm >= 172.7) && ($pat_height_feet_in_cm < 175.2)){$ideal_weight = '68.2 KG';}
					if(($pat_height_feet_in_cm >= 175.2) && ($pat_height_feet_in_cm < 177.8)){$ideal_weight = '70.5 KG';}
					if(($pat_height_feet_in_cm >= 177.8) && ($pat_height_feet_in_cm < 180.3)){$ideal_weight = '72.7 KG';}
					if(($pat_height_feet_in_cm >= 180.3) && ($pat_height_feet_in_cm < 182.8)){$ideal_weight = '72.7 KG';}
					if(($pat_height_feet_in_cm >= 182.8) && ($pat_height_feet_in_cm < 185.4)){$ideal_weight = '75.0 KG';}
					if(($pat_height_feet_in_cm >= 185.4) && ($pat_height_feet_in_cm < 187.9)){$ideal_weight = '77.3 KG';}
					if(($pat_height_feet_in_cm >= 187.9) && ($pat_height_feet_in_cm < 190.5)){$ideal_weight = '79.5 KG';}
					if(($pat_height_feet_in_cm >= 190.5) && ($pat_height_feet_in_cm < 193.0)){$ideal_weight = '81.8 KG';}
					if(($pat_height_feet_in_cm == 193.0)){$ideal_weight = '84.1 KG';}
					
					$this->set('enter_height_feet','');
					$this->set('enter_height_inch','');
					$this->set('enter_height_cm',$this->data['BMICalculator']['height_cms']);
					$this->set('ideal_weight',$ideal_weight);
				}
				
			
				
				if($bmi_of_pat < 18.5){$bmi_indicator = 'Underweight'; $background = 'style="background: none repeat scroll 0 0 #30b1f0;"';}
				if($bmi_of_pat > 18.5 && $bmi_of_pat < 24.0){$bmi_indicator = 'Healthy'; $background = 'style="background: none repeat scroll 0 0 #79c20d;"';}
				if($bmi_of_pat > 24.0 && $bmi_of_pat < 29.0){$bmi_indicator = 'Overweight'; $background = 'style="background: none repeat scroll 0 0 #79c20d;"';}
				if($bmi_of_pat > 29.0 && $bmi_of_pat < 39.0){$bmi_indicator = 'Obese'; $background = 'style="background: none repeat scroll 0 0 #e33b01;"';}
				if($bmi_of_pat > 39.0){$bmi_indicator = 'Externely Obese'; $background = 'style="background: none repeat scroll 0 0 #eb1a11;"';}
			
				$this->set('bmi_value',$bmi_of_pat);
				$this->set('bmi_indicator',$bmi_indicator);
				$this->set('background_color',$background);
				$this->set('enter_height_weight',$this->data['BMICalculator']['weight']);
			}
			if($form_arg == 'bp_calc')
			{
				$user_detail = $this->Session->read('UserDetail');
				if(!empty($user_detail))
				{
					if(!empty($this->data))
					{
						$this->data['UserBmiBp']['user_id'] = $user_detail['User']['id'];
						$this->data['UserBmiBp']['bmi_value'] = $this->data['BP']['bmi_value'];
						$this->data['UserBmiBp']['bmi_indicator'] = $this->data['BP']['bmi_indicator'];
						$this->data['UserBmiBp']['bp_systolic'] = $this->data['BP']['bp_systolic'];
						$this->data['UserBmiBp']['bp_diastolic'] = $this->data['BP']['bp_diastolic'];
						$this->data['UserBmiBp']['bp_pulse'] = $this->data['BP']['bp_pulse'];
						$this->data['UserBmiBp']['time'] = '00:00';
						$this->data['UserBmiBp']['status'] = 1;
						$this->data['UserBmiBp']['save_date'] = date('Y-m-d H:i:s');
				
				
						if($this->UserBmiBp->create($this->data))
						{
							if($this->UserBmiBp->save($this->data))
							{
								$this->Session->setFlash('Your values saved successfully.','flash_success');
								$this->redirect(array('controller'=>'tests','action'=>'bmi_value'));
							}
						}
					}
				}
				else
				{
					$this->Session->setFlash('Please signup yourself as a patient to save your BMI and BP.','flash_success');
					$this->redirect('/pages/login_page');
				}
			}
		}
		
	}
	
	function bmi_value()
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','BMI & BP Values');
		$user_detail = $this->Session->read('UserDetail');
		if(!empty($user_detail))
		{
			$this->paginate = array('UserBmiBp' => array('limit' =>'10','order'=>array('UserBmiBp.save_date'=>'DESC'),'conditions'=>array('UserBmiBp.status'=>1,'UserBmiBp.user_id'=>$user_detail['User']['id'])));
			$bmibpvalues=$this->paginate('UserBmiBp');
			$this->set('bmibpvalues',$bmibpvalues);
		}
		else
		{
			$this->redirect('/pages/report_login_page');
		}
	}
	
	function health_check_up_corporate()
	{
		$this->layout = 'tests';
		$this->set('title_for_layout','Corporate Health Check Up Services at NiramayaHealthcare NABL Labs Delhi');
		$this->set('page_description','Niramaya Path Lab offers Corporate Health Check Up programs Pre-Employment Health Check-ups and Preventive/Corporate with General Health check-ups. Niramaya Path Lab provides a wide range of health screening solutions along with value added services.');
		$this->set('page_keyword','Corporate Health Checkup, Health Checkup packages');
	}
	
	function admin_add_service()
	{
		$this->set('title_for_layout','Add Services');
		if(!empty($this->data))
		{
			if(!empty($this->data['Test']['description_pdf']['name']))
			{
				$hfile = $this->File->uploadFile($this->data['Test']['description_pdf'], TEST_PDF_STORE_PATH, true,array('jpg','jpe','jpeg','gif','png','JPG','JPE','JPEG','GIF','PNG','PDF','pdf'));
				$this->data['Test']['file_name'] = $hfile['name'];
			}
			$this->data['Test']['type'] = 'SERVICE';
			$this->data['Test']['speciality'] = '';
			$this->data['Test']['disease'] = '';
			$this->data['Test']['sample'] = '';
			$this->data['Test']['methodology'] = '';
			$this->data['Test']['temp'] = '';
			$this->data['Test']['schedule'] = '';
			$this->data['Test']['net'] = '';
			$this->data['Test']['add_date'] = date('Y-m-d H:i:s');
			$this->data['Test']['status'] = 1;
			if($this->Test->create($this->data))
			{
				if($this->Test->save($this->data))
				{
					$this->Session->setFlash('Service saved successfully.','flash_success');
					$this->redirect(array('controller'=>'tests','action'=>'view_service'));
				}
			}
		}
                $this->set('profit_category',$this->_getProfitCategory()); 
	}
	
	function admin_view_service()
	{
		$this->set('title_for_layout','View Services');
		$this->paginate = array('Test' => array('limit' =>'30','order'=>array('Test.add_date'=>'DESC'),'conditions'=>array('Test.type'=>'SERVICE')));
		$testlist=$this->paginate('Test');
		$this->set('testlist',$testlist);
	}
	function admin_edit_service($service_id=NULL)	
	{		
		$dec_id = base64_decode($service_id);		
		if(!empty($this->data))
		{			
			if(!empty($this->data['Test']['description_pdf']['name']))
			{
				$hfile = $this->File->uploadFile($this->data['Test']['description_pdf'], TEST_PDF_STORE_PATH, true,array('jpg','jpe','jpeg','gif','png','JPG','JPE','JPEG','GIF','PNG','PDF','pdf'));				
				$this->data['Test']['file_name'] = $hfile['name'];				
				$this->File->deleteFile(TEST_PDF_STORE_PATH.$this->data['Test']['old_file_name']);			
			}
			if(empty($this->data['Test']['description_pdf']['name']))
			{
				$this->data['Test']['file_name'] = $this->data['Test']['old_file_name'];			
			}
			if($this->Test->create($this->data))			
			{				
				if($this->Test->save($this->data))				
				{					
					$this->Session->setFlash('Service updated successfully.','flash_success');					
					$this->redirect(array('controller'=>'tests','action'=>'view_service'));				
				}			
			}		
		}		
		else
		{			
			$get_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$dec_id)));			
			$this->data = $get_detail;		
		}                
		$this->set('profit_category',$this->_getProfitCategory()); 	
	}
    function view_report($rep_name=NULL)	
	{		
		if(empty($rep_name))		
		{			
			$this->redirect('/tests/my_account');		
		}		
		else		
		{ 			
			$dec_rep_name = "";		
			$report_name = str_replace("@@@@","?",base64_decode($rep_name));
			
			//print_R($report_name);
			$req_info = $this->Health->find('first',array('conditions'=>array('OR'=>array(array('Health.patient_report LIKE '=>$report_name),array('Health.patient_report LIKE '=>$rep_name)))));
			
			//$req_info = $this->Health->find('first',array('conditions'=>array('Health.patient_report'=>base64_decode($rep_name))));

			$date = explode("-",$req_info['Health']['s_date']);	
			$lastyear = date('Y-1-1');
			$lastyear = date('Y-m-d',(strtotime ( '-1 year' , strtotime ( $lastyear) ) ));			
			//print_R($req_info);
			//echo "-----";
			//print_R($lastyear);
			//echo "---";die;
			if(strtotime($req_info['Health']['s_date']) <= strtotime($lastyear))
			{
				//echo "if";	
				$this->ftp_access($req_info);				
				$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['id'].".pdf";			
			}			
			else
			{	
				//print_R(filter_var($req_info['Health']['patient_report'], FILTER_VALIDATE_URL));
				if (strpos($req_info['Health']['patient_report'], 'https:') !== false || strpos($req_info['Health']['patient_report'], 'http:') !== false) { 
					if(file_put_contents("/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf",file_get_contents($req_info['Health']['patient_report'])))
					{
						$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf";
					}	
					else
					{
						file_put_contents("/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf",file_get_contents("https://test.niramayahealthcare.com/tests/view_report/".base64_encode(str_replace("?","@@@@",$req_info['Health']['patient_report']))));
						$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf";
					}
				}
				else{
					$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/".$req_info['Health']['patient_report'];			
				}
			}
			//print_R($dec_rep_name);die;
			App::import('Vendor', '/fpdf/fpdf');			
			App::import('Vendor', '/fpdf/fpdi');
			$pdf = new FPDI();
			$pdf->addPage();
			$pagecount = $pdf->setSourceFile($dec_rep_name);			
			$lab_info = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$req_info['Health']['created_by'])));			
			$header_image='';
			if($lab_info['Lab']['custom_header_status']=='1')	
			{				
				$header_image = "/files/header/".$lab_info['Lab']['custom_header'];
			}
			else
			{
				$header_image = "/fpdf/nirAmaya_Report_Header.jpg";
			}			
			for ($i=1; $i <= $pagecount; $i++) {
				$tplidx = $pdf->ImportPage($i);
				$pdf->useTemplate($tplidx,0,0,0);
				$pdf->Image('/home2/niramovh/public_html/app/webroot'.$header_image,0,0,$pdf->w,40);
				if($i != $pagecount)
				{
					$pdf->addPage();
				}
			}
			$pdf->Output("report.pdf", "I");
			exit;
		}	
	}

	function ftp_access($req_info)		
	{
		$ftp_server = "npl.infosysmicro.com";
		$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
		$login = ftp_login($ftp_conn, 'niramya', 'abc123!@');
		$local_file = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['id'].".pdf";
		$server_file = "/files/reports/".$req_info['Health']['patient_report'];
		if(!ftp_get($ftp_conn, $local_file, $server_file, FTP_BINARY))
		{
			echo "not copied---";
			die;
		}
		ftp_close($ftp_conn);
	}
		
        //print report
		function apicall()
        {
            $this->integrateApiCall('report',48179);
        }
		
		function get_free_consultation($req_id=NULL,$order_id=NULL)
		{
			$this->layout = false;
			$this->set('request_id',$req_id);
			$this->set('order_id',$order_id);
		}
		
		function get_free_consultation_agree($request_id=null,$order_id=null)
		{
			if(isset($request_id) && !empty($request_id))
			{
				$data = $this->Health->findById(base64_decode($request_id));
				if(isset($data['Health']['patient_report']) && !empty($data['Health']['patient_report']))
				{
					$report_link = SITE_URL."files/reports/".$data['Health']['patient_report'];
					$gender = ($data['Health']['gender'] == 1) ? 'male' : 'female';
					
					/*add to activity log*/
					$this->ActivityLog = ClassRegistry::init('ActivityLog');
					$page_url = Router::url( $this->here, true );
					$this->data['ActivityLog']['admin_id'] = 0;
					$this->data['ActivityLog']['patient_id'] = $data['Health']['user_id'];
					$this->data['ActivityLog']['health_id'] = $data['Health']['id'];
					$this->data['ActivityLog']['page_url']= $page_url;
					$this->data['ActivityLog']['action']= 'free consultation agreed';
					$this->data['ActivityLog']['creation'] = date('Y-m-d H:i:s');
					if($this->ActivityLog->create($this->data))
					{
						$this->ActivityLog->save($this->data);
					}
					
					
					$link = "https://web.getvisitapp.com/?referrer=nirmaya_web_report_consult&reportlink=".$report_link."&mobile=".$data['Health']['landline']."&name=".$data['Health']['name']."&email=".$data['Health']['email']."&gender=".$gender."&age=".$data['Health']['age']."&niramayauserid=".base64_decode($order_id)."&nirmayareportid=".base64_decode($request_id)."&utm_source=niramaya_dashboard_consult_now&utm_medium=consult_now_btn&utm_campaign=nirmaya";
					        
					$this->redirect($link);
				}
				else
				{
					$this->redirect("/");
				}
				
			}
			else
			{
				$this->redirect("/");
			}
		}
		
	function print_user_receipt_new($req_id=NULL,$order_id=NULL)
	{

		$this->layout = false;

		$dec_req_id = base64_decode($req_id);

		$dec_order_id = base64_decode($order_id);

		$req_detail = $this->Health->find('first',array('conditions'=>array('Health.id'=>$dec_req_id)));
		
		$b = 0;

		if($req_detail['Health']['test_id'] != '')

		{

			$explode_test = explode(',',$req_detail['Health']['test_id']);

			

			foreach($explode_test as $key => $val)

			{

				$test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));

				$req_detail['Health']['tests'][$b]['test_code'] = $test_name['Test']['testcode'];

				$req_detail['Health']['tests'][$b]['test_parameter'] = $test_name['Test']['test_parameter'];

				$req_detail['Health']['tests'][$b]['test_mrp'] = $test_name['Test']['mrp'];

				$b++;

			}

		}

		if($req_detail['Health']['profile_id'] != '')

		{

			$explode_profile = explode(',',$req_detail['Health']['profile_id']);

			foreach($explode_profile as $key => $val)

			{

				$test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));

				$req_detail['Health']['tests'][$b]['test_code'] = $test_name['Test']['testcode'];

				$req_detail['Health']['tests'][$b]['test_parameter'] = $test_name['Test']['test_parameter'];

				$req_detail['Health']['tests'][$b]['test_mrp'] = $test_name['Test']['mrp'];

				$b++;

			}

		}

		if($req_detail['Health']['offer_id'] != '')

		{

			$explode_offer = explode(',',$req_detail['Health']['offer_id']);

			foreach($explode_offer as $key => $val)

			{

				$offer_name = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$val)));

				$req_detail['Health']['tests'][$b]['test_code'] = $offer_name['Banner']['banner_code'];

				$req_detail['Health']['tests'][$b]['test_parameter'] = $offer_name['Banner']['banner_name'];

				$req_detail['Health']['tests'][$b]['test_mrp'] = $offer_name['Banner']['banner_mrp'];

				$b++;

			}

		}
		if($req_detail['Health']['package_id'] != '')

		{

			$explode_package = explode(',',$req_detail['Health']['package_id']);

			foreach($explode_package as $key => $val)

			{

				$package_name = $this->Package->find('first',array('conditions'=>array('Package.id'=>$val)));

				$req_detail['Health']['tests'][$b]['test_code'] = $package_name['Package']['package_code'];

				$req_detail['Health']['tests'][$b]['test_parameter'] = $package_name['Package']['package_name'];

				$req_detail['Health']['tests'][$b]['test_mrp'] = $package_name['Package']['package_mrp'];

				$b++;

			}

		}
		if($req_detail['Health']['service_id'] != '')
		{
			$explode_service = explode(',',$req_detail['Health']['service_id']);
			foreach($explode_service as $key => $val)
			{
				$service_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
				$req_detail['Health']['tests'][$b]['test_code'] = $service_name['Test']['testcode'];
				$req_detail['Health']['tests'][$b]['test_parameter'] = $service_name['Test']['test_parameter'];
				$req_detail['Health']['tests'][$b]['test_mrp'] = $service_name['Test']['mrp'];
				$b++;
			}
		}
		
		$vv = 0;
		foreach($req_detail['Health']['tests'] as $k => $x) 
		{
			$vv = ($x['test_mrp']+$vv);
			$vv = $vv;
		}
		$req_detail['Health']['grand_total'] = $vv;
		
		if($req_detail['Health']['home_report'] != 0)
		{
			$req_detail['Health']['home_report_charge'] = '50';
		}
		if($req_detail['Health']['discount_id'] != 0)
		{
			$dicount_info = $this->Discount->find('first',array('conditions'=>array('Discount.id'=>$req_detail['Health']['discount_id'])));
			$req_detail['Health']['discount_code'] = $dicount_info['Discount']['discount_code'];
			$req_detail['Health']['discount_name'] = $dicount_info['Discount']['discount_name'];
			if($dicount_info['Discount']['type'] == 'Percent')
			{
				$v_1 = ($dicount_info['Discount']['amount']/100);
				$v_2 = ($vv*$v_1);
				$req_detail['Health']['discount_amt'] = $dicount_info['Discount']['amount'].'% ('.$v_2.')';
			}
			if($dicount_info['Discount']['type'] == 'Rupees')
			{
				$req_detail['Health']['discount_amt'] = $dicount_info['Discount']['amount'];
			}
		}
		
		
		if($req_detail['Health']['discount_amount'] != 0)
		{
			$req_detail['Health']['add_discount'] = 'Yes';
			$req_detail['Health']['discount_amount'] = $req_detail['Health']['discount_amount'];
		}
		
		//01-04014 Starts
		$get_all_pay_track = $this->Paytrack->find('all',array('conditions'=>array('Paytrack.request_id'=>$req_detail['Health']['id'])));
		$init_amt = 0;
		$adj_amount = 0;
		foreach($get_all_pay_track as $pay_key => $pay_val)
		{
			if($pay_val['Paytrack']['pay_mode'] == 'adjust')
			{
				$adj_amount = ($pay_val['Paytrack']['pay_install']+$adj_amount);
			}
			else
			{
				$init_amt = ($pay_val['Paytrack']['pay_install']+$init_amt);
			}
		}
		$req_detail['Health']['total_rec_amt'] = $init_amt;
		$req_detail['Health']['adj_amt'] = $adj_amount;
		//01-04014 Ends

		if(empty($req_detail['Health']['city']))

		{

			if($req_detail['Health']['sample_time1'] == 1){ $home_collection_time = '7:00AM - 7:30AM'; }

			if($req_detail['Health']['sample_time1'] == 2){ $home_collection_time = '7:30AM - 8:00AM'; }

			if($req_detail['Health']['sample_time1'] == 3){ $home_collection_time = '8:00AM - 8:30AM'; }

			if($req_detail['Health']['sample_time1'] == 4){ $home_collection_time = '8:30AM - 9:00AM'; }

			if($req_detail['Health']['sample_time1'] == 5){ $home_collection_time = '9:00AM - 9:30AM'; }

			if($req_detail['Health']['sample_time1'] == 6){ $home_collection_time = '9:30AM - 10:00AM'; }

			if($req_detail['Health']['sample_time1'] == 7){ $home_collection_time = '10:00AM - 10:30AM'; }

			if($req_detail['Health']['sample_time1'] == 8){ $home_collection_time = '10:30AM - 11:00AM'; }

			if($req_detail['Health']['sample_time1'] == 9){ $home_collection_time = '11:00AM - 11:30AM'; }

			if($req_detail['Health']['sample_time1'] == 10){ $home_collection_time = '11:30AM - 12:00PM'; }

			if($req_detail['Health']['sample_time1'] == 11){ $home_collection_time = '12:00PM - 12:30PM'; }

			if($req_detail['Health']['sample_time1'] == 12){ $home_collection_time = '12:30PM - 1:00PM'; }

			if($req_detail['Health']['sample_time1'] == 13){ $home_collection_time = '1:00PM - 1:30PM'; }

			if($req_detail['Health']['sample_time1'] == 14){ $home_collection_time = '1:30PM - 2:00PM'; }

			if($req_detail['Health']['sample_time1'] == 15){ $home_collection_time = '2:00PM - 2:30PM'; }

			if($req_detail['Health']['sample_time1'] == 16){ $home_collection_time = '2:30PM - 3:00PM'; }

			if($req_detail['Health']['sample_time1'] == 17){ $home_collection_time = '3:00PM - 3:30PM'; }

			if($req_detail['Health']['sample_time1'] == 18){ $home_collection_time = '3:30PM - 4:00PM'; }

			if($req_detail['Health']['sample_time1'] == 19){ $home_collection_time = '4:00PM - 4:30PM'; }

			if($req_detail['Health']['sample_time1'] == 20){ $home_collection_time = '4:30PM - 5:00PM'; }

			if($req_detail['Health']['sample_time1'] == 21){ $home_collection_time = '5:00PM - 5:30PM'; }

			if($req_detail['Health']['sample_time1'] == 22){ $home_collection_time = '5:30PM - 6:00PM'; }

			if($req_detail['Health']['sample_time1'] == 23){ $home_collection_time = '6:00PM - 6:30PM'; }

			if($req_detail['Health']['sample_time1'] == 24){ $home_collection_time = '6:30PM - 7:00PM'; }

			$this->set('home_collection_time',$home_collection_time);

		}

		
		$pcc_list = $this->Lab->find('first',array('conditions'=>array('Lab.status'=>1,'Lab.id'=>$req_detail['Health']['created_by'])));
		$this->set('pcc_list',$pcc_list);	
				

		$this->set('req_detail',$req_detail);

		$this->set('dec_order_id',$dec_order_id);

	}
	
	function apitest()
	{
	Configure::write('debug',2);
		$this->__sms_message('9313789068','NHCare
BP-Phlebo the 97816 Booked by Aarav Healthcare ( Lomesh ) to be collected on 18-05-2017 10:00AM - 10:30AM from SAPNA VERMA Female 35 Yrs 8397007204 for C1180 - Vitamin - B12 ,C1168 - Thyroid Stimulating Hormone (TSH) Total Test Amount Rs.860 Net Payable Rs.860 Bal Due Rs.559 Address .,.,.,Delhi,Delhi,..,.. ..');
	}
	
	function view_reports($health_id=NULL)	
	{		
		if(empty($health_id))		
		{			
			$this->redirect('/tests/my_account');		
		}		
		else		
		{ 			
			$dec_rep_name = "";			
			$req_info = $this->Health->find('first',array('conditions'=>array('Health.id'=>base64_decode($health_id))));			
			$date = explode("-",$req_info['Health']['s_date']);	
			$lastyear = date('Y-1-1');
			$lastyear = date('Y-m-d',(strtotime ( '-1 year' , strtotime ( $lastyear) ) ));			
			//print_R($req_info);
			//echo "-----";
			//print_R($lastyear);
			//echo "---";
			if(strtotime($req_info['Health']['s_date']) <= strtotime($lastyear))
			{
				//echo "if";	
				$this->ftp_access($req_info);				
				$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['id'].".pdf";			
			}			
			else
			{	
				//print_R(filter_var($req_info['Health']['patient_report'], FILTER_VALIDATE_URL));
				if (strpos($req_info['Health']['patient_report'], 'https:') !== false || strpos($req_info['Health']['patient_report'], 'http:') !== false) { 
					file_put_contents("/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf",file_get_contents($req_info['Health']['patient_report']));
					$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/temp/".$req_info['Health']['ref_num'].".pdf";
				}
				else{
					$dec_rep_name = "/home2/niramovh/public_html/app/webroot/files/reports/".$req_info['Health']['patient_report'];			
				}
			}
			print_R($dec_rep_name);die;
			App::import('Vendor', '/fpdf/fpdf');			
			App::import('Vendor', '/fpdf/fpdi');
			$pdf = new FPDI();
			$pdf->addPage();
			$pagecount = $pdf->setSourceFile($dec_rep_name);			
			$lab_info = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$req_info['Health']['created_by'])));			
			$header_image='';
			if($lab_info['Lab']['custom_header_status']=='1')	
			{				
				$header_image = "/files/header/".$lab_info['Lab']['custom_header'];
			}
			else
			{
				$header_image = "/fpdf/nirAmaya_Report_Header.jpg";
			}			
			for ($i=1; $i <= $pagecount; $i++) {
				$tplidx = $pdf->ImportPage($i);
				$pdf->useTemplate($tplidx,0,0,0);
				$pdf->Image('/home2/niramovh/public_html/app/webroot'.$header_image,0,0,$pdf->w,40);
				if($i != $pagecount)
				{
					$pdf->addPage();
				}
			}
			$pdf->Output("report.pdf", "I");
			exit;
		}	
	}

	function apply_voucher()
	{
		$this->VoucherMaster = ClassRegistry::init('VoucherMaster');
		
		$voucher_data = $this->VoucherMaster->find('first',array('conditions'=>array('VoucherMaster.voucher_code'=>$_REQUEST['voucher_code'])));
		if(!empty($voucher_data) && strtotime($voucher_data['VoucherMaster']['to_date']) >= strtotime(date('Y-m-d 00:00:00')))
		{
			print_R(json_encode($voucher_data));die;
		}
		else
		{
			print_R(json_encode("error"));die;
		}
	}

	function getcitystate()
	{
		$this->Pincodemaster = ClassRegistry::init("PincodeMaster");
		$pincodeMaster = $this->Pincodemaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$_REQUEST['pin'])));
		$localityArray = array();
		//$localityArray['locality'] = array();
		if($pincodeMaster)
		{
			if($pincodeMaster['PincodeMaster']['servicable']==1)
			{
				$localityArray['city'] = $pincodeMaster['PincodeMaster']['city'];
				$localityArray['state'] = $pincodeMaster['PincodeMaster']['state'];
				$localityArray['error'] = "";
			}
			else
			{
				$localityArray['error'] = "Non Servicable Pincode";
			}
		}
		else
		{
			$localityArray['error'] = "Invalid Pincode";
		}
		print_R(json_encode($localityArray));die;
	}

	function admin_add_document_type()
	{
		$this->DocumentTypeMaster = ClassRegistry::init('DocumentTypeMaster');
		$type = array('doc'=>'Document','number'=>'Numeric','text'=>'Normal Text');
		$this->set('type',$type);
		
		if(!empty($this->data))
		{
			if ($_FILES["file"]["error"] > 0) {
				echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			}
			else
			{
				if(!empty($_FILES))
				{
					$hfile = $this->File->uploadFile($this->data['DocumentTypeMaster']['dummy_link'], DUMMY_DOC_STORE_PATH, true,array('doc','docx','xls','xlsx','pdf','PDF'));
					$this->data['DocumentTypeMaster']['dummy_link'] = urlencode(SITE_URL."files/dummy_doc/".$hfile['name']);	
				}
				else
				{
					$this->data['DocumentTypeMaster']['dummy_link'] = '';
				}
			}

			if($this->DocumentTypeMaster->save($this->data))
			{
				$this->Session->setFlash('Document Type Added successfully','flash_success');
				$this->redirect(array('controller'=>'tests','action'=>'view_document_list'));	
			}
			else
			{
				$this->Session->setFlash('Document Type Not Added','flash_failure');
			}
		}		
	}

	function admin_view_document_list()
	{
		$this->DocumentTypeMaster = ClassRegistry::init('DocumentTypeMaster');
		$this->paginate = array('DocumentTypeMaster' => array('limit' =>'12','order'=>array('DocumentTypeMaster.id'=>'DESC')));		
		$type = array('doc'=>'Document','number'=>'Numeric','text'=>'Normal Text');
		$this->set('type',$type);
		$docs = $this->paginate('DocumentTypeMaster');
		$this->set("docs",$docs);
	}

	function admin_edit_doc($id=NULL)
	{
		//print_R(base64_decode($id));die;
		$this->DocumentTypeMaster = ClassRegistry::init('DocumentTypeMaster');
		
		if(!empty($this->data))
		{
			if ($_FILES["file"]["error"] > 0) {
				echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			}
			else
			{
				if(!empty($_FILES))
				{
					$hfile = $this->File->uploadFile($this->data['DocumentTypeMaster']['dummy_link'], DUMMY_DOC_STORE_PATH, true,array('doc','docx','xls','xlsx','pdf','PDF'));
				$this->data['DocumentTypeMaster']['dummy_link'] = urlencode(SITE_URL."files/dummy_doc/".$hfile['name']);	
				}
				else
				{
					$this->data['DocumentTypeMaster']['dummy_link'] = '';
				}
			}
			
			if($this->DocumentTypeMaster->save($this->data))
			{
				$this->Session->setFlash('Document Type Added successfully','flash_success');
				$this->redirect(array('controller'=>'tests','action'=>'view_document_list'));	
			}
			else
			{
				$this->Session->setFlash('Document Type Not Added','flash_failure');
			}
		}

		$this->data = $this->DocumentTypeMaster->find('first',array('conditions'=>array('DocumentTypeMaster.id'=>base64_decode($id))));
		$type = array('doc'=>'Document','number'=>'Numeric','text'=>'Normal Text');
		$this->set('type',$type);
	}
}
?>