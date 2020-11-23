<?php
class ReportController extends AppController
{

	var $name = "Report";
	var $breadcrumb = array();
	var $uses=array('Test','Health','User','Agent','Billing','Banner','Package','Lab','Discount','RequestTest','Admin','PincodeReport','PincodeMaster','City','State','PaymentType');
	var $helpers = array('Form','Html','Javascript', 'Ajax','Utility','csv');
	public $components = array('RequestHandler','Cookie','Utility');
	public $paginate = array('maxLimit' => 10);

	function admin_revenue_report()
	{
		$this->set('title_for_layout','Revenue Report');

		$admin_u_type = $this->Session->read('Admin.userType');

		$admin_lab_type = $this->Session->read('Admin.labType');

		$this->PaymentType = ClassRegistry::init('PaymentType');

		$p_type = $this->PaymentType->find('list',array('fields'=>array('PaymentType.id','PaymentType.type')));

		$this->set('p_type',$p_type);

		if(($admin_u_type != 'A') && ($admin_u_type != 'BM') && ($admin_u_type != 'Agent'))
		{
			$pcc = $this->Lab->find('all',array('conditions'=>array('Lab.pcc_lab_value'=>$admin_lab_type)));
			$s_pcc = $this->Lab->find('all',array('conditions'=>array('Lab.status'=>1)));
			
			$this->set('pcc',$pcc);
			$this->set('s_pcc',$s_pcc);
		}
		else
		{
			$pcc = $this->Lab->find('all',array('conditions'=>array('Lab.status'=>1)));
			$s_pcc = $this->Lab->find('all',array('conditions'=>array('Lab.status'=>1)));
			
			$this->set('pcc',$pcc);
			$this->set('s_pcc',$s_pcc);
		}

		$login_agent_type = $this->Session->read('Admin.login_agent_type');

		$login_agent_id = $this->Session->read('Admin.id');

		if($login_agent_type == 'Agent')
		{
			$agents = $this->Agent->find('all',array('conditions'=>array('Agent.id'=>$login_agent_id)));
			$this->set('agents',$agents);
                        $this->set('agents_booked',array());
		}
		else
		{
			$agents = $this->Agent->find('all',array('conditions'=>array('Agent.status'=>1)));
			$this->set('agents',$agents);

                        $agents_booked = $this->Admin->find('list',array('conditions'=>array('Admin.status'=>1)));
			$this->set('agents_booked',$agents_booked);
		}
		$this->set('login_agent_type',$login_agent_type);
		$filter_class="Result For ";
		
		if(!empty($this->params['named']['from_date']) && $this->params['named']['from_date'] != '')
		{
			$this->data['RevenueReport']['from_date'] = $this->params['named']['from_date'];
			$options['from_date'] = $this->params['named']['from_date'];
		}
		if(!empty($this->params['named']['to_date']) && $this->params['named']['to_date'] != '')
		{
			$this->data['RevenueReport']['to_date'] = $this->params['named']['to_date'];
			$options['to_date'] = $this->params['named']['to_date'];
		}
		if(!empty($this->params['named']['lab']) && $this->params['named']['lab'] != '')
		{
			$this->data['RevenueReport']['pcc_list_id'] = $this->params['named']['lab'];
			$options['lab'] = $this->params['named']['lab'];
		}
		if(!empty($this->params['named']['agent']) && $this->params['named']['agent'] != '')
		{
			$this->data['RevenueReport']['agent'] = $this->params['named']['agent'];
			$options['agent'] = $this->params['named']['agent'];
		}
		if(!empty($this->params['named']['set_option']) && $this->params['named']['set_option'] != '')
		{
			$this->data['RevenueReport']['set_option'] = $this->params['named']['set_option'];
			$options['set_option'] = $this->params['named']['set_option'];
		}

		if(isset($this->data['RevenueReport']['balance_due']) && !empty($this->data['RevenueReport']['balance_due']))
		{
			if($this->data['RevenueReport']['balance_due'] == 'not_paid')
			{
				$conditions['Health.received_amount'] = 0;
				$conditions['Health.total_amount >'] = 0;
				$filter_class.= "<font color='pink'> Payment Status : <strong> Not Paid </strong></font>";
			}
			else if($this->data['RevenueReport']['balance_due'] == 'partial_paid')
			{
				$conditions['Health.received_amount >'] = 0;
				$conditions['Health.balance_amount >'] = 0;
				$filter_class.= "<font color='pink'> Payment Status : <strong> Partial Paid </strong></font>";
			}
		}
		else
		{
			$filter_class.= "<font color='pink'> Payment Status : <strong> Not Selected </strong></font>";
		}
		
		if(isset($this->data['RevenueReport']['discount_status']) && !empty($this->data['RevenueReport']['discount_status']))
		{
			if($this->data['RevenueReport']['discount_status'] == 'yes')
			{
				$conditions['Health.discount_amount >'] = 0;
				$filter_class.= "<font color='lightgreen'> Discount Status : <strong> Yes </strong></font>";
			}
			else if($this->data['RevenueReport']['discount_status'] == 'no')
			{
				$conditions['Health.discount_amount'] = 0;
				$filter_class.= "<font color='lightgreen'> Discount Status : <strong> No </strong></font>";
			}
		}
		else
		{
			$filter_class.= "<font color='lightgreen'> Discount Status : <strong> Not Selected </strong></font>";
		}
				
		if(!empty($this->data))
		{
			if(1)//$this->data['RevenueReport']['set_option'] == 'filter'
			{
				$from_date = $this->data['RevenueReport']['from_date'];
				$to_date = $this->data['RevenueReport']['to_date'];
				
				$lab_id = $this->data['RevenueReport']['pcc_list_id'];
                $lab_id1 = $this->data['RevenueReport']['pcc_list_id1'];
				
				$agent_id = $this->data['RevenueReport']['agent_list_id'];
                $agent_id_booked = $this->data['RevenueReport']['agent_list_id1'];
				
				$select_option = $this->data['RevenueReport']['set_option'];
				if(!empty($from_date) && $from_date != '')
				{
					$conditions['Health.s_date >='] = date('Y-m-d',strtotime($from_date));
					$options['from_date'] = $from_date;
					$filter_class.= "<font color='green'>From <strong>".$from_date."</strong></font>";
				}
				if(!empty($to_date) && $to_date != '')
				{
					$conditions['Health.s_date <='] = date('Y-m-d',strtotime($to_date));
					$options['to_date'] = $to_date;
					$filter_class.= "<font color='green'> till <strong>".$to_date."</strong></font>";
				}
				
				$lab_list_filter = $this->Lab->find('list',array('fields'=>array('id','pcc_name')));
				
				if(!empty($lab_id) && $lab_id != '')
				{
					$conditions['Health.assigned_lab'] = $lab_id;
					$options['lab'] = $lab_id;
					$filter_class.= "<font color='orange'> Serviced By : <strong>".$lab_list_filter[$lab_id]."</strong></font>";
				}
				else
				{
					$filter_class.= "<font color='orange'> Serviced By : <strong>All</strong></font>";
				}

                if(!empty($lab_id1) && $lab_id1 != '')
				{
					$conditions['Health.created_by'] = $lab_id1;
					$options['lab1'] = $lab_id1;
					$filter_class.= "<font color='red'> Booked By : <strong>".$lab_list_filter[$lab_id1]."</strong></font>";
				}
				else
				{
					$filter_class.= "<font color='red'> Booked By : <strong>All</strong></font>";
				}

				//for pcc who offer either of service booked by or service by
				if(!empty($lab_id1) && $lab_id1 != '' && !empty($lab_id) && $lab_id != '')
				{
					$conditions['OR'] = array('Health.assigned_lab'=> $lab_id, 'Health.created_by' =>$lab_id1) ;
					unset($conditions['Health.created_by']);
					unset($conditions['Health.assigned_lab']);
				}
				
				$agent_list_filter = $this->Agent->find('list',array('fields'=>array('id','name')));
				
				if(!empty($agent_id) && $agent_id != '')
				{
					$conditions['Health.agent_id'] = $agent_id;
					$options['agent'] = $agent_id;
					$filter_class.= " <font color='brown'> Assigned By Phlebo : <strong>".$agent_list_filter[$agent_id]."</strong></font>";
				}
				else
				{
					$filter_class.= " <font color='brown'> Assigned By Phlebo : <strong>All</strong></font>";
				}

                if(!empty($agent_id_booked) && $agent_id_booked != '')
				{
					$conditions['Health.created_by_agent'] = $agent_id_booked;
					$options['agent_booked'] = $agent_id_booked;
					$filter_class.= " <font color='violet'> Booked By Phlebo Name : <strong>".$agent_list_filter[$agent_id_booked]."</strong></font>";
				}
				else
				{
					$filter_class.= " <font color='violet'> Booked By Phlebo : <strong>All</strong></font>";
				}

				$conditions['Health.status'] = 1;
				$conditions['Health.sent_pathcorp'] = 1;

				$options['set_option'] = $select_option;
				
				$this->set('filter_class',$filter_class);

				if($this->data['RevenueReport']['set_option'] == 'export_excel')
					$this->paginate = array('Health' => array('limit' =>100000,'conditions'=>$conditions));
				else
					$this->paginate = array('Health' => array('limit' =>'50','conditions'=>$conditions));

				$find_request=$this->paginate('Health');

				$reports = array();

				$k = 0;
				
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

							$test_code = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$sl_vl['Health']['id'],'RequestTest.test_id'=>$test_val)));

							$test_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$test_val)));




							$test_code_arr[] = $test_detail['Test']['testcode'];


							$test_name_arr[] = $test_detail['Test']['test_parameter'];


							$test_amt = ($test_code['RequestTest']['mrp']+$test_amt);

						}

						$count_expl_test = $cnt_test;

					}



					if(!empty($sl_vl['Health']['profile_id']))

					{

						$expl_profile = explode(',',$sl_vl['Health']['profile_id']);

						$cnt_prf = 0;

						foreach($expl_profile as $profile_key => $profile_val)

						{

							if(!empty($profile_val))

							{

								$cnt_prf++;

							}

							$profile_code = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$sl_vl['Health']['id'],'RequestTest.test_id'=>$profile_val,'RequestTest.type'=>'PR')));

							$profile_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$profile_val,'Test.type'=>'PROFILE')));

							//$profile_code = $this->Test->find('first',array('conditions'=>array('Test.id'=>$profile_val,'Test.type'=>'PROFILE')));

							$test_code_arr[] = $profile_detail['Test']['testcode'];


							$test_name_arr[] = $profile_detail['Test']['test_parameter'];


							$test_amt = ($profile_code['RequestTest']['mrp']+$test_amt);

						}

						$count_expl_profile = $cnt_prf;

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

							$offer_code = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$sl_vl['Health']['id'],'RequestTest.test_id'=>$offer_val,'RequestTest.type'=>'OF')));

							$offer_detail = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$offer_val)));

							//$offer_code = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$offer_val)));

							$test_code_arr[] = $offer_detail['Banner']['banner_code'];

							$test_name_arr[] = $offer_detail['Banner']['banner_name'];

							$test_amt = ($offer_code['RequestTest']['mrp']+$test_amt);

						}

						$count_expl_offer = $cnt_offr;

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

							$package_code = $this->RequestTest->find('first',array('conditions'=>array('RequestTest.health_id'=>$sl_vl['Health']['id'],'RequestTest.test_id'=>$package_val,'RequestTest.type'=>'PA')));

							$package_detail = $this->Package->find('first',array('conditions'=>array('Package.id'=>$package_val)));

							//$package_code = $this->Package->find('first',array('conditions'=>array('Package.id'=>$package_val)));

							$test_code_arr[] = $package_detail['Package']['package_code'];

							$test_name_arr[] = $package_detail['Package']['package_name'];

							$test_amt = ($package_code['RequestTest']['mrp']+$test_amt);

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

						$disc_amt = 'Rs. '.$sl_vl['Health']['discount_amount'];

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

					$booking_from = substr($sl_vl['Health']['flags'], 0, 1);
					$booking_mode = '';
					
					if($booking_from == "1")
						$booking_mode = 'Online';
					if($booking_from == "2")
						$booking_mode = 'Manual';
					if($booking_from == "3")
						$booking_mode = 'Excel';
					if($booking_from == "4")
						$booking_mode = 'API';					

					$reports[$k]['RevenueReport']['booking_mode'] = $booking_mode;

                    $reports[$k]['RevenueReport']['request_status'] = $sl_vl['Health']['requ_status'];

					$reports[$k]['RevenueReport']['book_date'] = date('d-M-Y',strtotime($sl_vl['Health']['s_date']));

					$reports[$k]['RevenueReport']['pcc_name'] = $pcc_name['Lab']['pcc_name'];

                    $reports[$k]['RevenueReport']['pcc_name1'] = $pcc_name1['Lab']['pcc_name'];

                    $reports[$k]['RevenueReport']['report_url'] = $sl_vl['Health']['patient_report_with_header'];

					$reports[$k]['RevenueReport']['agent_name'] = $agent_name['Agent']['name'];

					$reports[$k]['RevenueReport']['req_num'] = $requestNum['Billing']['order_id'];
					$reports[$k]['RevenueReport']['medical_reference_number'] = $sl_vl['Health']['medical_reference_number'];
					$reports[$k]['RevenueReport']['test_ref_num'] = $sl_vl['Health']['ref_num'];
					$reports[$k]['RevenueReport']['reference'] = $sl_vl['Health']['reference'];
					$reports[$k]['RevenueReport']['mrn_no'] = $sl_vl['Health']['medical_reference_number'];
					$reports[$k]['RevenueReport']['refer_by'] = $refer_by;

					$reports[$k]['RevenueReport']['parameter_count'] = $parameter_count;

					$reports[$k]['RevenueReport']['parameter_code'] = $implode_parameter_code;

					$reports[$k]['RevenueReport']['parameter_name'] = $implode_parameter_name;

					$reports[$k]['RevenueReport']['patient_name'] = $sl_vl['Health']['name'];

					$reports[$k]['RevenueReport']['patient_gender'] = $gender;

					$reports[$k]['RevenueReport']['patient_age'] = $sl_vl['Health']['age'];

					$reports[$k]['RevenueReport']['patient_contact'] = $sl_vl['Health']['landline'];

					$reports[$k]['RevenueReport']['payment_type'] = $sl_vl['Health']['payment_type'];

					$reports[$k]['RevenueReport']['patient_email'] = $sl_vl['Health']['email'];

					$reports[$k]['RevenueReport']['test_amount'] = 'Rs. '.$test_amt;

					$reports[$k]['RevenueReport']['fix_discount'] = $fix_discount;

					$reports[$k]['RevenueReport']['disc_amt'] = $disc_amt;
                                        $reports[$k]['RevenueReport']['booked_by_user'] = $sl_vl['Health']['created_by_agent'];

					if($sl_vl['Health']['cancelled_status'] == 1)

					{

						$reports[$k]['RevenueReport']['net_payble'] = 'Rs. '.($sl_vl['Health']['received_amount']+$sl_vl['Health']['balance_amount']);

						$reports[$k]['RevenueReport']['receive_payment'] = 'Rs. '.$sl_vl['Health']['received_amount'];

						$reports[$k]['RevenueReport']['balance_payment'] = 'Rs. '.$sl_vl['Health']['balance_amount'];

					}

					else

					{

						$reports[$k]['RevenueReport']['net_payble'] = ($sl_vl['Health']['received_amount']+$sl_vl['Health']['balance_amount']);

						if($sl_vl['Health']['received_amount']+$sl_vl['Health']['balance_amount'] == 0)

						$reports[$k]['RevenueReport']['net_payble']=$sl_vl['Health']['total_amount'];

						$reports[$k]['RevenueReport']['receive_payment'] = 'Rs. '.$sl_vl['Health']['received_amount'];

						$reports[$k]['RevenueReport']['balance_payment'] = 'Rs. '.($reports[$k]['RevenueReport']['net_payble']-$sl_vl['Health']['received_amount']);

						$reports[$k]['RevenueReport']['net_payble'] = 'Rs. '.$reports[$k]['RevenueReport']['net_payble'];

					}

					$k++;

				}



				//echo "<pre>"; print_r($reports); exit;



				$total_records = $this->Health->find('all',array('conditions'=>$conditions));



				$net_pay = 0;

				$net_rec = 0;

				$net_bal = 0;

				$total_test = 0;

				$booked_by_total_req = array();
				
				$total_payable_req = array();
				
				foreach($total_records as $tr_ky => $tr_vl)
				{
                    $cnt_1 = $cnt_2 = $cnt_3 = $cnt_4 = 0;

					$tot_payable_amt=0;
					if(!is_array($booked_by_total_req[$tr_vl['Health']['created_by']]))
						$booked_by_total_req[$tr_vl['Health']['created_by']] = array();
					
					array_push($booked_by_total_req[$tr_vl['Health']['created_by']],$tr_vl['Health']['id']);
					
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

						$expl_prf = explode(',',$tr_vl['Health']['profile_id']);

						$cnt_2 = 0;

						foreach($expl_prf as $k_2 => $v_2)

						{

							if(!empty($v_2))

							{

								$cnt_2++;

							}

						}

					}

					if(!empty($tr_vl['Health']['offer_id']))

					{

						$expl_offer = explode(',',$tr_vl['Health']['offer_id']);

						$cnt_3 = 0;

						foreach($expl_offer as $k_3 => $v_3)

						{

							if(!empty($v_3))

							{

								$cnt_3++;

							}

						}

					}

					if(!empty($tr_vl['Health']['package_id']))

					{

						$expl_pck = explode(',',$tr_vl['Health']['package_id']);

						$cnt_4 = 0;

						foreach($expl_pck as $k_4 => $v_4)

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

					$net_bal_amt=0;

					if($tr_vl['Health']['cancelled_status'] == 1)
					{
						$net_bal = ($tr_vl['Health']['balance_amount']+$net_bal);
						$net_bal_amt=$tr_vl['Health']['balance_amount'];
					}
					else
					{
						$net_pay_amt= ($tr_vl['Health']['received_amount']+$tr_vl['Health']['balance_amount']);

						if($net_pay_amt == 0)

						$net_pay_amt=$tr_vl['Health']['total_amount'];

						$net_bal_amt=$net_pay_amt-$tr_vl['Health']['received_amount'];

						$net_bal = ($net_bal_amt+$net_bal);

					}
					if(!is_array($total_payable_req[$tr_vl['Health']['created_by']]))
						$total_payable_req[$tr_vl['Health']['created_by']] = array();
					
					array_push($total_payable_req[$tr_vl['Health']['created_by']],$tr_vl['Health']['received_amount']+$net_bal_amt);
					
					$net_pay = ($net_rec+$net_bal);

				}

				$booked_by_total = array();
				$total_payable_amount = array();

				$lab_list = $this->Lab->find('list',array('fields'=>array('id','pcc_name')));
				$agent_list = $this->Agent->find('list',array('fields'=>array('id','name')));
				
				array_push($booked_by_total,array('Booked by','count'));
				array_push($total_payable_amount,array('Assigned Lab','count'));
				array_push($agent_total,array('Agent','count'));
				
				foreach($booked_by_total_req as $key=>$val)
				{
					array_push($booked_by_total,array($lab_list[$key]." - ".count($booked_by_total_req[$key]),count($booked_by_total_req[$key])));
				}
				
				foreach($total_payable_req as $key=>$val)
				{
					array_push($total_payable_amount,array($lab_list[$key]." - Rs. ".array_sum($total_payable_req[$key]),array_sum($total_payable_req[$key])));
				}
				//print_R($total_payable_req);
				//print_R($total_payable_amount);
				//die;
				$this->set('booked_by_total',json_encode($booked_by_total));
				
				$this->set('total_payable_amount',json_encode($total_payable_amount));

				$this->set('total_records',count($total_records));

				$this->set('total_test',$total_test);

				$this->set('net_pay',$net_pay);

				$this->set('net_rec',$net_rec);

				$this->set('net_bal',$net_bal);

				$this->set('reports',$reports);

				$this->set('lab_id',$lab_id);
                                $this->set('lab_id1',$lab_id1);

				$this->set('agent_id',$agent_id);

                                $this->set('agent_id_booked',$agent_id_booked);

				$this->set('options',$options);

                                //fetching user list
                                $user_list = $this->Admin->find('list',array('fields'=>array('id','name')));
                                $this->set('user_list',$user_list);

			}



			if($this->data['RevenueReport']['set_option'] == 'export_excel')

			{

				//echo "<pre>"; print_r($this->data); exit;

				/*$export_from_date = $this->data['RevenueReport']['from_date'];

				$export_to_date = $this->data['RevenueReport']['to_date'];

				$export_lab_id = $this->data['RevenueReport']['pcc_list_id'];
                                $export_lab_id1 = $this->data['RevenueReport']['pcc_list_id1'];

				$export_agent_id = $this->data['RevenueReport']['agent_list_id'];
                                $export_agent_id_booked = $this->data['RevenueReport']['agent_list_id1'];





				if(!empty($export_from_date) && $export_from_date != '')

				{

					$conditions['Health.s_date >='] = date('Y-m-d',strtotime($export_from_date));

				}

				if(!empty($export_to_date) && $export_to_date != '')

				{

					$conditions['Health.s_date <='] = date('Y-m-d',strtotime($export_to_date));

				}

				if(!empty($export_lab_id) && $export_lab_id != '')

				{

					$conditions['Health.assigned_lab'] = $export_lab_id;

				}
                                if(!empty($export_lab_id1) && $export_lab_id1 != '')

				{
					$conditions['Health.created_by'] = $export_lab_id1;
				}

				if(!empty($export_agent_id) && $export_agent_id != '')

				{

					$conditions['Health.agent_id'] = $export_agent_id;

				}

                                if(!empty($export_agent_id_booked) && $export_agent_id_booked != '')

				{

					$conditions['Health.created_by_agent'] = $export_agent_id_booked;

				}

				$conditions['Health.status'] = 1;
				$conditions['Health.sent_pathcorp'] = 1;



				$find_request = $this->Health->find('all',array('conditions'=>$conditions));



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

							$test_code = $this->Test->find('first',array('conditions'=>array('Test.id'=>$test_val,'Test.type'=>'TEST')));

							$test_code_arr[] = $test_code['Test']['testcode'];

							$test_name_arr[] = $test_code['Test']['test_parameter'];

							$test_amt = ($test_code['Test']['mrp']+$test_amt);

						}

						$count_expl_test = $cnt_test;

					}



					if(!empty($sl_vl['Health']['profile_id']))

					{

						$expl_profile = explode(',',$sl_vl['Health']['profile_id']);

						$cnt_prf = 0;

						foreach($expl_profile as $profile_key => $profile_val)

						{

							if(!empty($profile_val))

							{

								$cnt_prf++;

							}

							$profile_code = $this->Test->find('first',array('conditions'=>array('Test.id'=>$profile_val,'Test.type'=>'PROFILE')));

							$test_code_arr[] = $profile_code['Test']['testcode'];

							$test_name_arr[] = $profile_code['Test']['test_parameter'];

							$test_amt = ($profile_code['Test']['mrp']+$test_amt);

						}

						$count_expl_profile = $cnt_prf;

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

					//$reports[$k]['pcc_name'] = $pcc_name['Lab']['pcc_name'];

                                        $reports[$k]['pcc_name1'] = !empty($pcc_name1['Lab']['pcc_name']) ? $pcc_name1['Lab']['pcc_name'] : 'NPL';
                                        $reports[$k]['pcc_name'] = !empty($pcc_name['Lab']['pcc_name']) ? $pcc_name['Lab']['pcc_name'] : 'NPL';

					$reports[$k]['patient_name'] = $sl_vl['Health']['name'];

					$reports[$k]['patient_gender'] = $gender.'/'.$sl_vl['Health']['age'];

					$reports[$k]['patient_contact'] = $sl_vl['Health']['landline'];

					$reports[$k]['patient_email'] = $sl_vl['Health']['email'];

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

					$reports[$k]['request_status']="";

					if($sl_vl['Health']['requ_status'] == 4)

					$reports[$k]['request_status']="Sample Collected";

					else if($sl_vl['Health']['requ_status'] == 5)

					$reports[$k]['request_status']="Sent to Lab";

					else if($sl_vl['Health']['requ_status'] == 6)

					$reports[$k]['request_status']="Closed";

					else if($sl_vl['Health']['requ_status'] == 7)

					$reports[$k]['request_status']="Partial Report";

					else if($sl_vl['Health']['requ_status'] == 8)

					$reports[$k]['request_status']="Test Cancelled";

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
                                        $cnt_1 = $cnt_2 = $cnt_3 = $cnt_4 = 0;
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

						$expl_prf = explode(',',$tr_vl['Health']['profile_id']);

						$cnt_2 = 0;

						foreach($expl_prf as $k_2 => $v_2)

						{

							if(!empty($v_2))

							{

								$cnt_2++;

							}

						}

					}

					if(!empty($tr_vl['Health']['offer_id']))

					{

						$expl_offer = explode(',',$tr_vl['Health']['offer_id']);

						$cnt_3 = 0;

						foreach($expl_offer as $k_3 => $v_3)

						{

							if(!empty($v_3))

							{

								$cnt_3++;

							}

						}

					}

					if(!empty($tr_vl['Health']['package_id']))

					{

						$expl_pck = explode(',',$tr_vl['Health']['package_id']);

						$cnt_4 = 0;

						foreach($expl_pck as $k_4 => $v_4)

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
                                */


				header('Content-Type: text/csv; charset=utf-8');

				header('Content-Disposition: attachment; filename=revenue_report.csv');

				$output = fopen('php://output', 'w');

				fputcsv($output, array('Total No. of Requests', 'Total No. of Tests', 'Total Net Payable','Total Received Amount', 'Total Balance Due'));

				fputcsv($output, array(count($total_records),$total_test,$net_pay,$net_rec,$net_bal));

				fputcsv($output, array());



				fputcsv($output, array('S.No.', 'Date', 'ReqNo','Booking From','Booked By PCC','Service By PCC','Booked By User' ,'Patient Name' ,'Gender/Age', 'Phone No.', 'Email','Reffered By','Agent Name','No. of Test', 'Test Names','Test Codes','Test Amount(Rs)', 'Discount%','Discount Amount(Rs)','Net Payble(Rs)','Payment Received(Rs)','Balance Due(Rs)','Lab Refrence No.','Reference','Medical Reference Number','Request Status','Payment Type','Report Url'));
				
				

                                $count_er = 1;
				foreach ($reports as $keys => $values)


				{

					/*if(($values['fix_discount'] != 'N/A') && ($values['fix_discount'] == '100%'))

					{
						$values['test_amount'] = $values['RevenueReport']['test_amount'];
						$values['fix_discount'] = $values['RevenueReport']['fix_discount'];
						$values['disc_amt'] = $values['RevenueReport']['test_amount'];
						$values['net_payble'] = $values['RevenueReport']['net_payble'];
					}
					else
					{
						$values['test_amount'] = $values['RevenueReport']['test_amount'];
						$values['fix_discount'] = $values['RevenueReport']['fix_discount'];
						$values['disc_amt'] = $values['RevenueReport']['disc_amt'];
						$values['net_payble'] = $values['RevenueReport']['net_payble'];
					}*/
                    if($values['RevenueReport']['request_status'] == 17)
						$req_filter_status="Partial Closed";
					else if($values['RevenueReport']['request_status'] == 5)
						$req_filter_status="Sent to Lab";
					else if($values['RevenueReport']['request_status'] == 6)
						$req_filter_status="Closed";
					else if($values['RevenueReport']['request_status'] == 7)
						$req_filter_status="Partial Report";
					else if($values['RevenueReport']['request_status'] == 10)
						$req_filter_status="Sample Collected";
					else if($values['RevenueReport']['request_status'] == 12)
						$req_filter_status="Partial Sent to Lab";
					else if($values['RevenueReport']['request_status'] == 14)
						$req_filter_status="Reg. in LIS";
					else if($values['RevenueReport']['request_status'] == 16)
						$req_filter_status="Specimen Drawn";
					else if($values['RevenueReport']['request_status'] == 9)
						$req_filter_status="Closed";
					else 
						$req_filter_status="Pending";

					$booking_from = substr($sl_vl['Health']['flags'], 0, 1);
					$booking_mode = '';
					
					if($booking_from == "1")
						$booking_mode = 'Online';
					if($booking_from == "2")
						$booking_mode = 'Manual';
					if($booking_from == "3")
						$booking_mode = 'Excel';
					if($booking_from == "4")
						$booking_mode = 'API';					

				$contact = $this->Utility->show_mobile_hide($values['RevenueReport']['patient_contact'],$values['RevenueReport']['book_date']);
				$email = $this->Utility->show_mobile_hide($values['RevenueReport']['patient_email'],$values['RevenueReport']['book_date']);
				

                                        $values_excel = array($count_er++,$values['RevenueReport']['book_date'],$values['RevenueReport']['req_num'],$booking_from,
                                            isset($values['RevenueReport']['pcc_name1'])?$values['RevenueReport']['pcc_name1']:'NPL',
                                            $values['RevenueReport']['pcc_name'],
                                            $user_list[$values['RevenueReport']['booked_by_user']],
                                            $values['RevenueReport']['patient_name'],
                                            $values['RevenueReport']['patient_gender'].'/'.$values['RevenueReport']['patient_age'],
                                            $contact,
                                            $email,
                                            $values['RevenueReport']['refer_by'],
                                            $values['RevenueReport']['agent_name'],
                                            $values['RevenueReport']['parameter_count'],
                                            $values['RevenueReport']['parameter_name'],
                                            $values['RevenueReport']['parameter_code'],
                                            $values['RevenueReport']['test_amount'],
                                            $values['RevenueReport']['fix_discount'],
                                            $values['RevenueReport']['disc_amt'],
                                            $values['RevenueReport']['net_payble'],
                                            $values['RevenueReport']['receive_payment'],
                                            $values['RevenueReport']['balance_payment'],
                                            $values['RevenueReport']['test_ref_num'],
											$values['RevenueReport']['reference'],
											$values['RevenueReport']['mrn_no'],
                                            $req_filter_status,
                                            $p_type[$values['RevenueReport']['payment_type']],
											$values['RevenueReport']['report_url']
                                            );
                                       
                                        /*echo "<pre>";
                                        print_r($values);
                                        die;*/
					fputcsv($output, $values_excel);

				}

				die;

			}

		}

	}

	function prd($data)
	{
		echo "<pre>";
		print_r($data);
		die;
	}
	//function to show home collection based on filter supplied
	function admin_home_collection_report($request_type=null)
	{

		$this->PaymentType = ClassRegistry::init('PaymentType');

		$p_type = $this->PaymentType->find('list',array('fields'=>array('PaymentType.id','PaymentType.type')));

		$this->set('p_type',$p_type);

		//Configure::write('debug',2);
		$data=array();
		if(!empty($this->data))
		{ 
			if(isset($this->data['Report']['from_date']) || isset($this->data['Report']['to_date']) || isset($this->data['Report']['pcc_list_id1']) || isset($this->data['Report']['pcc_list_id']) || isset($this->data['Report']['agent_list_id']) || isset($this->data['Report']['request_status'])) {
					$this->data['Report']['form']['filter'] = $this->params['form']['filter'];
					$this->Session->write('Search.conditions',$this->data) ;
					$this->redirect(array('controller'=>'report', 'action'=>'home_collection_report', 'search'));
			} else {
					$this->Session->setFlash('Please enter search criteria') ;
					$this->Session->delete('Search.conditions') ;
					}
		}
		else
		{
			if($request_type == 'search')
			{
				$this->data = $this->Session->read("Search.conditions");
				$conditions=array();

				$conditions['Health.status'] = 1;
				$conditions['NOT'] = array('Health.sample_date1'=>null,'Health.sample_time1'=>null);
				
				$filter_class="Result For ";

				if (isset($this->data['Report']['from_date']) && !empty($this->data['Report']['from_date'])){
					$conditions['Health.s_date >='] = date('Y-m-d',strtotime($this->data['Report']['from_date']));
					//$conditions['Health.sample_date1 >='] = $this->data['Report']['from_date'];
					$filter_class.= "<font color='green'>From <strong>".$this->data['Report']['from_date']."</strong></font>";
				}
				if (isset($this->data['Report']['to_date']) && !empty($this->data['Report']['to_date'])){
					$conditions['Health.s_date <='] = date('Y-m-d',strtotime($this->data['Report']['to_date']));
					//$conditions['Health.sample_date1 <='] = $this->data['Report']['to_date'];
					$filter_class.= "<font color='green'> till <strong>".$this->data['Report']['to_date']."</strong></font>";
				}
				
				$lab_list_filter = $this->Lab->find('list',array('fields'=>array('id','pcc_name')));
				
				if(isset($this->data['Report']['pcc_list_id1']) && !empty($this->data['Report']['pcc_list_id1']))
				{
					$conditions['Health.created_by'] = $this->data['Report']['pcc_list_id1'];
					$filter_class.= "<font color='red'> Booked By : <strong>".$lab_list_filter[$this->data['Report']['pcc_list_id1']]."</strong></font>";
				}
				else
				{
					$filter_class.= "<font color='red'> Booked By : <strong>All</strong></font>";
				}
				
				if(isset($this->data['Report']['pcc_list_id']) && !empty($this->data['Report']['pcc_list_id']))
				{
					$conditions['Health.assigned_lab'] = $this->data['Report']['pcc_list_id'];
					$filter_class.= "<font color='orange'> Serviced By : <strong>".$lab_list_filter[$this->data['Report']['pcc_list_id']]."</strong></font>";
				}
				else
				{
					$filter_class.= "<font color='orange'> Serviced By : <strong>All</strong></font>";
				}
				
				$agent_list_filter = $this->Agent->find('list',array('fields'=>array('id','name')));
				
				if(isset($this->data['Report']['agent_list_id']) && !empty($this->data['Report']['agent_list_id']))
				{
					$conditions['Health.agent_id'] = $this->data['Report']['agent_list_id'];
					$filter_class.= " <font color='brown'> Phlebo Name : <strong>".$agent_list_filter[$this->data['Report']['agent_list_id']]."</strong></font>";
				}
				else
				{
					$filter_class.= " <font color='brown'> Phlebo : <strong>All</strong></font>";
				}

				$req_list = Configure::read('RequestStatus');
				
				if(isset($this->data['Report']['request_status']) && !empty($this->data['Report']['request_status']))
				{
					$conditions['Health.requ_status'] = $this->data['Report']['request_status'];
					$filter_class.= " <font color='pink'> Request Status : <strong>".$req_list[$this->data['Report']['request_status']]."</strong></font>";
				}
				else
				{
					$filter_class.= " <font color='pink'> Request Status : <strong>All</strong></font>";
				}
				
				$this->set('filter_class',$filter_class);
				
				//finding summary of test
				
				$req_status_total = array();
				$req_amount_total = array();
				
				$summary=$this->Health->find('all',array('fields'=>array('id','test_id','profile_id','offer_id','package_id','service_id','total_amount','received_amount','balance_amount','requ_status'),'conditions'=>$conditions));
				$summary_data=array('total_request'=>0,'total_test'=>0,'total_net_payable'=>0,'total_received_amt'=>0,'total_balance_due'=>0);
				//print_R($summary);die;
				foreach($summary as $key=>$value)
				{
					if(!is_array($req_status_total[$value['Health']['requ_status']]))
						$req_status_total[$value['Health']['requ_status']] = array();
					
					if(!is_array($req_amount_total[$value['Health']['requ_status']]))
						$req_amount_total[$value['Health']['requ_status']] = array();
					
					array_push($req_status_total[$value['Health']['requ_status']],$value['Health']['id']);
					array_push($req_amount_total[$value['Health']['requ_status']],$value['Health']['total_amount']);
											
					$summary_data['total_request']+=1;
					$summary_data['total_test']+=$this->count_test($value['Health']['test_id']);
					$summary_data['total_test']+=$this->count_test($value['Health']['profile_id']);
					$summary_data['total_test']+=$this->count_test($value['Health']['offer_id']);
					$summary_data['total_test']+=$this->count_test($value['Health']['package_id']);
					$summary_data['total_test']+=$this->count_test($value['Health']['service_id']);
					$summary_data['total_net_payable']+=$value['Health']['total_amount'];
					$summary_data['total_received_amt']+=$value['Health']['received_amount'];
					
				}
				
				
				$tot_req_status = array();
				$tot_req_amount = array();
				array_push($tot_req_status,array('Status','Count'));
				array_push($tot_req_amount,array('Status','Amount'));
				
				foreach($req_list as $key=>$val)
				{
					array_push($tot_req_status,array($req_list[$key]." - ".count($req_status_total[$key]),count($req_status_total[$key])));
					array_push($tot_req_amount,array($req_list[$key]." - ".array_sum($req_amount_total[$key]),array_sum($req_amount_total[$key])));
				}
				
				/*print_R($tot_req_status);die;
				foreach($req_status_total as $key=>$val)
				{
					array_push($tot_req_status,array($req_list[$key]." - ".count($req_status_total[$key]),count($req_status_total[$key])));
				}
				
				foreach($req_amount_total as $key=>$val)
				{
					
				}*/
				
				$this->set('total_req_amount',json_encode($tot_req_amount));
				$this->set('total_req_status',json_encode($tot_req_status));
				//print_R($tot_req_status);die;
				$summary_data['total_balance_due']=$summary_data['total_net_payable'] - $summary_data['total_received_amt'];
				$this->set('summary_data',$summary_data);

				$pcc_list = $this->Lab->find('list',array('fields'=>array('id','pcc_name'),'conditions'=>array('Lab.status'=>1)));
				$agents = $this->Agent->find('list',array('fields'=>array('id','name'),'conditions'=>array('Agent.status'=>1)));
				$this->set('agents_list',$agents);
				$this->set('pcc_list',$pcc_list);


				$this->Health->bindModel(array(
					'hasOne'=>array(
						'Billing'=>array(
						'className'=>'Billing',
						'foreignKey'=>'request_id',
						'fields'=>array('Billing.order_id')
						)),
					'belongsTo'=>array(
						'City'=>array(
						'className'=>'City',
						'foreignKey'=>'city_id',
						'fields'=>array('City.name')
					),
					'Admin'=>array(
						'className'=>'Admin',
						'foreignKey'=>'cancelled_by',
						'fields'=>array('Admin.name')
					)
				)),false);

				if(isset($this->data['Report']['form']['filter'])){
					if($this->data['Report']['form']['filter'] == 'Export Excel')
					{
						$this->paginate = array('Health' => array('limit' =>5000,'conditions'=>$conditions));
						$data=$this->paginate('Health');
						$this->set('reports', $data);
						$this->render('home_collection_report_csv','exportexcel');
						$this->layout = '';

					}
					else
					{
						
						$this->paginate = array('Health' => array('limit' =>'50','conditions'=>$conditions));
						$data=$this->paginate('Health');
						$this->set('reports', $data);
					}
				}

			}
			else
			{
				//query without any search parameter
			}
			
		}
		

		

		
		//setting other variable
		$this->set('title_for_layout','Home Collection Report');

		$admin_u_type = $this->Session->read('Admin.userType');

		$admin_lab_type = $this->Session->read('Admin.labType');

		if(($admin_u_type != 'A') && ($admin_u_type != 'BM') && ($admin_u_type != 'Agent'))
		{
			//echo "<pre>"; print_r($this->Session->read('Admin')); exit;
			$pcc = $this->Lab->find('all',array('conditions'=>array('Lab.pcc_lab_value'=>$admin_lab_type)));
			$s_pcc = $this->Lab->find('all',array('conditions'=>array('Lab.status'=>1)));
			
			$this->set('pcc',$pcc);
			$this->set('s_pcc',$s_pcc);
		}
		else
		{
			$pcc = $this->Lab->find('all',array('conditions'=>array('Lab.status'=>1)));
			$s_pcc = $this->Lab->find('all',array('conditions'=>array('Lab.status'=>1)));
			
			$this->set('pcc',$pcc);
			$this->set('s_pcc',$s_pcc);
		}

		$login_agent_type = $this->Session->read('Admin.login_agent_type');

		$login_agent_id = $this->Session->read('Admin.id');

		if($login_agent_type == 'Agent')
		{
				$agents = $this->Agent->find('all',array('conditions'=>array('Agent.id'=>$login_agent_id)));
				$this->set('agents',$agents);
		}
		else
		{
				$agents = $this->Agent->find('all',array('conditions'=>array('Agent.status'=>1)));
				$this->set('agents',$agents);
		}
		$this->set('login_agent_type',$login_agent_type);

		
	}

	function count_test($data)
	{
		$array_test=explode(",",$data); 
		$count=0;
		foreach($array_test as $key=>$value)
		{
			if(isset($value) && !empty($value) && $value > 0)
			{
				$count++;
			}
				
		}
		return $count;
	}
	
	function admin_sms_test()
	{
		$this->__sms_message('9313789068','testing');
		$this->render(false);
		die('d');
	}

	public function admin_pincode_report()
	{
		$this->PincodeReport = ClassRegistry::init('PincodeReport');
		$this->PincodeMaster = ClassRegistry::init('PincodeMaster');
		$this->City = ClassRegistry::init('City');
		$this->State = ClassRegistry::init('State');
		
		$pcc = $this->Lab->find('list',array('fields'=>array('id','pcc_name')));
		$this->set('pcc',$pcc);
		
		$status_code = array('200'=>'Active','306'=>'Not Servicable','406'=>'Incorrect Pincode');
		$this->set('status_code',$status_code);
		
		$conditions = "";
		$filter_class="Result For ";
		if(!empty($this->params['named']['from_date']) && $this->params['named']['from_date'] != '')
		{
			$this->data['PincodeReport']['from_date'] = $this->params['named']['from_date'];
			$options['from_date'] = $this->params['named']['from_date'];
		}
		if(!empty($this->params['named']['to_date']) && $this->params['named']['to_date'] != '')
		{
			$this->data['PincodeReport']['to_date'] = $this->params['named']['to_date'];
			$options['to_date'] = $this->params['named']['to_date'];
		}
		if(!empty($this->params['named']['lab']) && $this->params['named']['lab'] != '')
		{
			$this->data['PincodeReport']['lab_id'] = $this->params['named']['lab'];
			$options['lab'] = $this->params['named']['lab'];
		}
		if(!empty($this->params['named']['status_code']) && $this->params['named']['status_code'] != '')
		{
			$this->data['PincodeReport']['status_code'] = $this->params['named']['status_code'];
			$options['status_code'] = $this->params['named']['status_code'];
		}
		if(!empty($this->params['named']['set_option']) && $this->params['named']['set_option'] != '')
		{
			$this->data['PincodeReport']['set_option'] = $this->params['named']['set_option'];
			$options['set_option'] = $this->params['named']['set_option'];
		}
				
		if($this->data)
		{
			//print_R($this->data);die;
			if($this->data['PincodeReport']['set_option'] == 'filter')
			{
				$from_date = $this->data['PincodeReport']['from_date'];
				$to_date = $this->data['PincodeReport']['to_date'];
				
				$lab_id = $this->data['PincodeReport']['lab_id'];
				
				$statuscode = $this->data['PincodeReport']['status_code'];
				
				$select_option = $this->data['PincodeReport']['set_option'];
			//print_R($this->data);die;	
				if(!empty($from_date) && $from_date != '')
				{
					$conditions['PincodeReport.created_on >='] = date('Y-m-d',strtotime($from_date));
					$options['from_date'] = $from_date;
					$filter_class.= "<font color='green'>From <strong>".$from_date."</strong></font>";
				}
				if(!empty($to_date) && $to_date != '')
				{
					$conditions['PincodeReport.created_on <='] = date('Y-m-d',strtotime($to_date));
					$options['to_date'] = $to_date;
					$filter_class.= "<font color='green'> till <strong>".$to_date."</strong></font>";
				}
				
				$lab_list_filter = $this->Lab->find('list',array('fields'=>array('id','pcc_name')));
				
				if(!empty($lab_id) && $lab_id != '')
				{
					$conditions['PincodeReport.lab_id'] = $lab_id;
					$options['lab'] = $lab_id;
					$filter_class.= "<font color='orange'> Lab : <strong>".$lab_list_filter[$lab_id]."</strong></font>";
				}
				else
				{
					$filter_class.= "<font color='orange'> Lab : <strong>All</strong></font>";
				}
				
				if(!empty($statuscode) && $statuscode!='')
				{
					$conditions['PincodeReport.status_code'] = $statuscode;
					$options['status_code'] = $statuscode;
					$filter_class.= "<font color='orange'> Lab : <strong>".$status_code[$statuscode]."</strong></font>";
				}
				$options['set_option'] = $select_option;
				$this->set('lab_id1',$lab_id);
				$this->set('status',$statuscode);
			
				$this->set('options',$options);
				
				$this->set('filter_class',$filter_class);
			}
			
			if($this->data['PincodeReport']['set_option'] == 'export_excel')
			{
				$from_date = $this->data['PincodeReport']['from_date'];
				$to_date = $this->data['PincodeReport']['to_date'];
				
				$lab_id = $this->data['PincodeReport']['lab_id'];
				
				$statuscode = $this->data['PincodeReport']['status_code'];
				
				$select_option = $this->data['PincodeReport']['set_option'];
			
				if(!empty($from_date) && $from_date != '')
				{
					$conditions['PincodeReport.created_on >='] = date('Y-m-d',strtotime($from_date));
					$options['from_date'] = $from_date;
					$filter_class.= "<font color='green'>From <strong>".$from_date."</strong></font>";
				}
				if(!empty($to_date) && $to_date != '')
				{
					$conditions['PincodeReport.created_on <='] = date('Y-m-d',strtotime($to_date));
					$options['to_date'] = $to_date;
					$filter_class.= "<font color='green'> till <strong>".$to_date."</strong></font>";
				}
				
				$lab_list_filter = $this->Lab->find('list',array('fields'=>array('id','pcc_name')));
				
				if(!empty($lab_id) && $lab_id != '')
				{
					$conditions['PincodeReport.lab_id'] = $lab_id;
					$options['lab'] = $lab_id;
					$filter_class.= "<font color='orange'> Lab : <strong>".$lab_list_filter[$lab_id]."</strong></font>";
				}
				else
				{
					$filter_class.= "<font color='orange'> Lab : <strong>All</strong></font>";
				}
				
				if(!empty($statuscode) && $statuscode!='')
				{
					$conditions['PincodeReport.status_code'] = $statuscode;
					$options['status_code'] = $statuscode;
					$filter_class.= "<font color='orange'> Lab : <strong>".$status_code[$statuscode]."</strong></font>";
				}
				$options['set_option'] = $select_option;
				$this->set('lab_id1',$lab_id);
				$this->set('status',$statuscode);
			
				$this->set('options',$options);
				
				$this->set('filter_class',$filter_class);
				
				$pincodes = $this->PincodeReport->find('all',array('conditions'=>$conditions));
				
				//print_R($pincodes);die;
				$count=0;
				foreach($pincodes as $val)
				{
					$pincode_data = $this->PincodeMaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$val['PincodeReport']['pincode'])));
					
					$city = $this->City->find('first',array('conditions'=>array('City.id'=>$pincode_data['PincodeMaster']['city'])));
					
					$state = $this->State->find('first',array('conditions'=>array('State.id'=>$pincode_data['PincodeMaster']['state'])));
					
					$pincodes[$count]['PincodeReport']['city'] = $city['City']['name'];
					$pincodes[$count]['PincodeReport']['state'] = $state['State']['name'];
					
					$count++;
				}
				
				header('Content-Type: text/csv; charset=utf-8');

				header('Content-Disposition: attachment; filename=pincode_report.csv');

				$output = fopen('php://output', 'w');

				fputcsv($output, array('S.No.', 'Date', 'Pincode','City','State','Lab Name','Pincode Status','Status Code'));
	
				$count_er = 1;
				foreach ($pincodes as $keys => $values)
				{
					$values_excel = array($count_er++,
						$values['PincodeReport']['created_on'],
						$values['PincodeReport']['pincode'],
						$values['PincodeReport']['city'],
						$values['PincodeReport']['state'],
						$pcc[$values['PincodeReport']['lab_id']],
						$values['PincodeReport']['pin_status'],
						$values['PincodeReport']['status_code']
						);
				   
					/*echo "<pre>";
					print_r($values);
					die;*/
					fputcsv($output, $values_excel);

				}

				die;
			}
			
		}
		
		$this->paginate = array('PincodeReport' => array('limit' =>'20','conditions'=>$conditions,'order'=>'created_on DESC'));
		
		$pincode=$this->paginate('PincodeReport');
		$count=0;
		foreach($pincode as $val)
		{
			$pincode_data = $this->PincodeMaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$val['PincodeReport']['pincode'])));
			
			$city = $this->City->find('first',array('conditions'=>array('City.id'=>$pincode_data['PincodeMaster']['city'])));
			
			$state = $this->State->find('first',array('conditions'=>array('State.id'=>$pincode_data['PincodeMaster']['state'])));
			
			$pincode[$count]['PincodeReport']['city'] = $city['City']['name'];
			$pincode[$count]['PincodeReport']['state'] = $state['State']['name'];
			
			$count++;
		}
		$this->set('pincode',$pincode);
		//print_R($pincode);die;
		
	}
}


?>