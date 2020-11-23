<?php
class TestdsController extends AppController
{
	var $name = "Testds";

	var $breadcrumb = array();
	var $uses=array('Page','Pagelocale','Locale','Banner','User','Siteadminlang','Test','Package','Health','Billing','City','State','Gender','Doctor','Specialization','DoctorClinic','ClinicTime','SearchedDoctor','BookAppointment','AppointmentBookStat','StateCity','Gender','City','State','Time','Timelab','Gender','Banner','User','Disease','Speciality','Health','Lab','RequestTest','Paytrack','RelationMaster');
	var $helpers = array('Form','Html','Javascript', 'Ajax');

	public $paginate = array('maxLimit' => 10);
	public $components = array('Email');	

	function index()
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
				
				$pass2 = substr(strtolower($this->data['User']['first_name']),0,1);
				$pass3 = substr($this->data['User']['contact'],-4,4);
				$password = $pass2.$pass3;
				
				if(!isset($this->data['User']['relation']))
					$this->data['User']['username'] = 'self';	

				$this->data['User']['username'] = $username;
				$this->data['User']['email'] = $this->data['User']['email'];
				$this->data['User']['passwd'] = $password;
				$this->data['User']['status'] = 1;
				$this->data['User']['name'] = $this->data['User']['name'];
				$this->data['User']['gender'] = $this->data['User']['gender'];
				$this->data['User']['age'] = $this->data['User']['age'];
				$this->data['User']['contact'] = trim($this->data['User']['contact']);
				$this->data['User']['landmark'] = $this->data['User']['landmark'];
				$this->data['User']['pincode'] = $this->data['User']['pincode'];

				$this->data['User']['address'] = $this->data['User']['address'];
				//Configure::write('debug',2);
				//print_R($this->User->save($this->data,false));die;
				if($this->User->create($this->data))
				{
					if($this->User->save($this->data,false))
					{
						$last_id = $this->User->getLastInsertID();
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
		//print_R("hello there");die;
		$gender = $this->Gender->find('all',array('conditions'=>array('Gender.status'=>1)));

		$this->set('gender',$gender);
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1),'order'=>array('City.name ASC')));
		$this->set('city',$city);
		$state = $this->State->find('all',array('conditions'=>array('State.status'=>1),'order'=>array('State.name ASC')));
		$this->set('state',$state);

		$this->RelationMaster = ClassRegistry::init('RelationMaster');
		$relation_list = $this->RelationMaster->find('list',array('fields'=>array('prefix','name')));
		$this->set('relation',$relation_list);
	}

	function admin_check_phone()
	{
		$this->User = ClassRegistry::init('User');

		$user_data = $this->User->find('first',array('conditions'=>array('User.contact'=>$_REQUEST['contact'])));

		if($user_data)
		{
			$this->RelationMaster = ClassRegistry::init('RelationMaster');
			$relation_list = $this->RelationMaster->find('all',array('fields'=>array('prefix','name')));
			$x['relation'] = $relation_list;
			$x['success'] = 'Success';
			$x['type'] = $user_data['User']['type'];
		}
		else
		{
			$x['success'] = 'Failure';
		}

		echo json_encode($x);
		die;
	}

	function login($doc_id=NULL,$name=NULL,$speciality=NULL,$state=NULL){

		$this->layout = 'tests';
		$this->set('title_for_layout','Login');

		$referer = $this->Session->read('referer');

		if(empty($get_param))
		{
			if(!empty($this->data))
			{
				//echo "<pre>"; print_r($this->data); exit;
				$find_user = $this->User->find('first',array('conditions'=>array('User.contact'=>$this->data['Login']['username'],'User.otp'=>$this->data['Login']['pass'])));
				
				$this->Session->write('UserDetail',$find_user);
				//print_R($find_user);die;
				if(!empty($find_user) && $find_user['User']['first_name']!='enquiry')
				{
					$cart_test = $this->Session->read('session_test');

					if($referer=='raise_ticket')
					{
						$this->redirect('/pages/raise_ticket');	
					}
					
					if(!empty($cart_test))
					{
						$this->redirect('/tests/my_cart');
					}
					if(empty($cart_test))
					{
						$this->redirect('/tests/payment_history');
					}
				}
				else
				{
					//print_R($_SESSION);die;
					if($referer=='raise_ticket')
					{
						$this->redirect('/pages/user_detail/'.$this->data['Login']['username']);	
					}
				}
			}
		}
		else
		{
			if(!empty($get_param))
			{
				$find_user = $this->User->find('first',array('conditions'=>array('User.id'=>$get_param)));
				if(!empty($find_user))
				{
					$this->Session->write('UserDetail',$find_user);
					$cart_test = $this->Session->read('session_test');
					if(!empty($cart_test))
					{
						$this->redirect('/tests/book_for_self');
					}
					if(empty($cart_test))
					{
						$this->redirect('/tests/payment_history');
					}
				}
			}
		}
	}

	function viewreport(){
		Configure::write('debug', 2);
		$this->layout = 'tests';
		$this->set('title_for_layout','viewreport');


		if(!empty($this->data))
		{
			$find_order_id = $this->Billing->find('first',array('conditions'=>array('Billing.order_id'=>$this->data['ViewReport']['password'])));
			/*print_R($find_order_id);
			echo "<br>";*/
			if(!empty($find_order_id))
			{
				$find_user = $this->User->find('first',array('conditions'=>array('User.id'=>$find_order_id['Billing']['user_id'],'User.contact'=>trim($this->data['ViewReport']['username']))));
				/*print_R($find_user);
				echo "<br>";*/
				if(!empty($find_user))
				{
					//echo "if condition <br>";//die;
					$this->Session->write('UserDetail',$find_user);
					$this->redirect('/tests/payment_history');
				}
				else
				{
					$this->Session->setFlash('The Mobile No. does not exist.','flash_failure');
					$this->redirect('/testds/viewreport');
				}
			}
			else
			{
				$this->Session->setFlash('The Request No. does not exist.','flash_failure');
				$this->redirect('/testds/viewreport');
			}
			$this->redirect('/tests/payment_history');
		}

	}

	function booking(){


		$this->layout = 'tests';
	
		//	echo $_SERVER['REMOTE_ADDR'];
		$this->set('title_for_layout','Niramayahealth Care | Book Test(s)/Profile(s)');

				//	$session_tests = $this->Session->read('test_ids_array_book');
			//	echo "<pre>"; print_r($session_tests); exit;
		
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
					if(!empty($this->data['Health']['sample_time1']) && !empty($this->data['Health']['sample_date1']))

					{
						//if($_SERVER['REMOTE_ADDR']=='172.31.39.64' || $_SERVER['REMOTE_ADDR']=="171.79.71.209" || $_SERVER['REMOTE_ADDR']=="172.31.30.173")
                   // {
							
							//echo $_SERVER['REMOTE_ADDR']=='172.31.39.64';
						
						//print_r($session_tests);
						
					//	echo "<br>";
						
					//	print_r($session_profiles);
					//	echo "<br>";
						
						//print_r($session_packages);
						
						
						//array_push($session_tests,905);
						
					//	print_r($session_tests);
						
						//echo "<br>";
						
						
						if($this->data['Health']['sample_time1'] >=4){
					
								array_push($session_tests,905);
					//$services_test = $this->Test->find('first',array('conditions'=>array('Test.id'=>905)));
								}else{
									
									array_push($session_tests,904);
					//$services_test = $this->Test->find('first',array('conditions'=>array('Test.id'=>904)));
								}
								
								//echo "hi";
								//print_r($services_test);
								
								//die;
                   // }
						
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
				if($UserId==0 || $UserId=='')
				{
					exit();
				}
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


					//($find_req_details);
					//die;
					$explode_test_ids_db = explode(',',$find_req_details['Health']['test_id']);


					if(!empty($explode_test_ids_db) && isset($explode_test_ids_db))
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
				//	echo "<pre>"; print_r($this->data); exit;

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
							$message = 'Thank you for booking your tests with nirAmaya Healthcare powered by Pathcorp. You have opted for visiting our '.$get_info_city['Lab']['pcc_name'].' Centre '.$get_info_city['Lab']['pcc_address'].' for the tests. Kindly call +91-9555009009 or visit test.niramayahealthcare.com for your test request status updates in "My Account"';
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

		//	$this->Health=ClassRegistry::init('Health');
	}
}

