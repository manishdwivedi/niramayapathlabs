<?php 
class UtilityComponent extends Object{
	
	var $components    =   array('Session','Email');
	function getBPNet($health_id=null)
	{
		$conditions = array();
		$conditions['Health.id'] = $health_id;
		$conditions['Health.status'] = 1;
		//$conditions['Health.sent_pathcorp'] = 1;
		//$conditions['requ_status'] = array(5,6,9);

		$this->Health = ClassRegistry::init('Health');
		$this->Health->bindModel(array(
			'hasOne'=>array(
				'Billing'=>array(
					'className'=>'Billing',
					'foreignKey'=>'request_id',
				)
			)
		));
		$all_record = $this->Health->find('all',array('conditions'=>$conditions));
		
		//$summary = array('total_request'=>0,'total_test'=>0,'total_amount'=>0,'total_discount_amount'=>0,'total_net_payable'=>0,'total_received_amount'=>0,'total_balance_due'=>0,'gross_booked_income'=>0,'net_booked_income'=>0,'booking_income_percent'=>0);

		$this->RequestTest=ClassRegistry::init('RequestTest');
		$this->Test = ClassRegistry::init('Test');
		$this->Banner = ClassRegistry::init('Banner');
		$this->Package = ClassRegistry::init('Package');

		//finding profit % of all pcc
		$this->ProfitShareConf = ClassRegistry::init('ProfitShareConf');
		$pcc_profit_details = $this->ProfitShareConf->find('all');
		
		$pcc_profit_list = array();
		for($i=0;$i<count($pcc_profit_details);$i++)
		{
			
			$pcc_profit_list[$pcc_profit_details[$i]['ProfitShareConf']['lab_id']] = $pcc_profit_details[$i];
		}
        
                
		for($i=0;$i<count($all_record);$i++)
		{ 
			$summary['total_request']++;
			$total_amt_cond = $all_record[$i]['Health']['received_amount'] + $all_record[$i]['Health']['balance_amount'];
			if($total_amt_cond == 0)
				$total_amt_cond= $all_record[$i]['Health']['total_amount'];
			$summary['total_net_payable'] += $total_amt_cond;

			$summary['total_discount_amount'] += !empty($all_record[$i]['Health']['discount_amount'])?$all_record[$i]['Health']['discount_amount']:0;
			$summary['total_received_amount'] += $all_record[$i]['Health']['received_amount'];

			$all_record[$i]['Health']['no_of_test'] = 0;
			$all_record[$i]['Health']['row_test_amt'] = 0;
			$all_record[$i]['Health']['row_test_code'] = "";
			$all_record[$i]['Health']['row_gross_booked_by_income'] = 0;
			$all_record[$i]['Health']['row_net_booked_by_income'] = 0;

			if(!empty($all_record[$i]['Health']['test_id']))
			{
				$expl_test = explode(',',$all_record[$i]['Health']['test_id']);
				foreach($expl_test as $key1 => $value1)
				{
						if(!empty($value1))
						{
								$summary['total_test']++;
								$all_record[$i]['Health']['no_of_test']++;
						}
				}
				$test_detail = $this->Test->find('all',array('conditions'=>array('Test.id'=>$expl_test,'Test.type'=>'TEST')));
				
				foreach($test_detail as $key5=>$value5)
				{
					$all_record[$i]['Health']['row_test_code'] .= $value5['Test']['testcode'].', ';
				}
				//$all_record[$i]['Health']['row_test_code'] = substr($all_record[$i]['Health']['row_test_code'],0,strlen($all_record[$i]['Health']['row_test_code'])-1);
				
				$test_code = $this->RequestTest->find('all',array('conditions'=>array('RequestTest.health_id'=>$all_record[$i]['Health']['id'],'RequestTest.test_id'=>$expl_test,'RequestTest.type'=>'TE')));
				
				foreach($test_code as $key5=>$value5)
				{
					$all_record[$i]['Health']['row_test_amt'] += $value5['RequestTest']['mrp'];
					foreach($test_detail as $key6=>$value6)
					{   
						if(isset($pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Test']['profit_margin_category']]) && $pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Test']['profit_margin_category']] >0 && $value5['RequestTest']['test_id'] == $value6['Test']['id'])
						{
							$all_record[$i]['Health']['row_gross_booked_by_income'] += (($value5['RequestTest']['mrp']*$pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Test']['profit_margin_category']])/100);
						}
					}
				}
			}
			if(!empty($all_record[$i]['Health']['profile_id']))
			{
				$expl_test = explode(',',$all_record[$i]['Health']['profile_id']);
				foreach($expl_test as $key1 => $value1)
				{
						if(!empty($value1))
						{
								$summary['total_test']++;
								$all_record[$i]['Health']['no_of_test']++;
						}
				}
				$test_detail = $this->Test->find('all',array('conditions'=>array('Test.id'=>$expl_test,'Test.type'=>'PROFILE')));
				foreach($test_detail as $key5=>$value5)
				{
					$all_record[$i]['Health']['row_test_code'] .= $value5['Test']['testcode'].', ';
				}
				//$all_record[$i]['Health']['row_test_code'] = substr($all_record[$i]['Health']['row_test_code'],0,strlen($all_record[$i]['Health']['row_test_code'])-1);

				$test_code = $this->RequestTest->find('all',array('conditions'=>array('RequestTest.health_id'=>$all_record[$i]['Health']['id'],'RequestTest.test_id'=>$expl_test,'RequestTest.type'=>'PR')));
				foreach($test_code as $key5=>$value5)
				{
					$all_record[$i]['Health']['row_test_amt'] += $value5['RequestTest']['mrp'];
					foreach($test_detail as $key6=>$value6)
					{
						if(isset($pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Test']['profit_margin_category']]) && $pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Test']['profit_margin_category']] >0 && $value5['RequestTest']['test_id'] == $value6['Test']['id'])
						$all_record[$i]['Health']['row_gross_booked_by_income'] += (($value5['RequestTest']['mrp']*$pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Test']['profit_margin_category']])/100);
					}
				}
			}
			if(!empty($all_record[$i]['Health']['offer_id']))
			{
				$expl_test = explode(',',$all_record[$i]['Health']['offer_id']);
				foreach($expl_test as $key1 => $value1)
				{
						if(!empty($value1))
						{
								$summary['total_test']++;
								$all_record[$i]['Health']['no_of_test']++;
						}
				}
				$test_detail = $this->Banner->find('all',array('conditions'=>array('Banner.id'=>$expl_test)));
				
				foreach($test_detail as $key5=>$value5)
				{
					$all_record[$i]['Health']['row_test_code'] .= $value5['Banner']['banner_code'].' , ';
				}
				//$all_record[$i]['Health']['row_test_code'] = substr($all_record[$i]['Health']['row_test_code'],0,strlen($all_record[$i]['Health']['row_test_code'])-1);

				$test_code = $this->RequestTest->find('all',array('conditions'=>array('RequestTest.health_id'=>$all_record[$i]['Health']['id'],'RequestTest.test_id'=>$expl_test,'RequestTest.type'=>'OF')));
			   
				foreach($test_code as $key5=>$value5)
				{
					$all_record[$i]['Health']['row_test_amt'] += $value5['RequestTest']['mrp'];
					foreach($test_detail as $key6=>$value6)
					{
						if(isset($pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Banner']['profit_margin_category']]) && $pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Banner']['profit_margin_category']] >0 && $value5['RequestTest']['test_id'] == $value6['Banner']['id'])
						{
							
							$all_record[$i]['Health']['row_gross_booked_by_income'] += (($value5['RequestTest']['mrp']*$pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Banner']['profit_margin_category']])/100);
							
						}
						
					}
				} 
			}

			/*new addition*/
			if(!empty($all_record[$i]['Health']['service_id']))
			{
				$expl_test = explode(',',$all_record[$i]['Health']['service_id']);
				foreach($expl_test as $key1 => $value1)
				{
						if(!empty($value1))
						{
								$summary['total_test']++;
								$all_record[$i]['Health']['no_of_test']++;
						}
				}
				$test_detail = $this->Test->find('all',array('conditions'=>array('Test.id'=>$expl_test,'Test.type'=>'SERVICE')));

				foreach($test_detail as $key5=>$value5)
				{
					$all_record[$i]['Health']['row_test_code'] .= $value5['Test']['testcode'].' , ';
				}
				//$all_record[$i]['Health']['row_test_code'] = substr($all_record[$i]['Health']['row_test_code'],0,strlen($all_record[$i]['Health']['row_test_code'])-1);

				$test_code = $this->RequestTest->find('all',array('conditions'=>array('RequestTest.health_id'=>$all_record[$i]['Health']['id'],'RequestTest.test_id'=>$expl_test,'RequestTest.type'=>'SR')));

				foreach($test_code as $key5=>$value5)
				{
					$all_record[$i]['Health']['row_test_amt'] += $value5['RequestTest']['mrp'];
					foreach($test_detail as $key6=>$value6)
					{
						if(isset($pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Test']['profit_margin_category']]) && $pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Test']['profit_margin_category']] >0 && $value5['RequestTest']['test_id'] == $value6['Test']['id'])
						{
							$all_record[$i]['Health']['row_gross_booked_by_income'] += (($value5['RequestTest']['mrp']*$pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Test']['profit_margin_category']])/100);
						}
					}
				}
			}
			/*new addition end*/


			if(!empty($all_record[$i]['Health']['package_id']))
			{
				$expl_test = explode(',',$all_record[$i]['Health']['package_id']);
				foreach($expl_test as $key1 => $value1)
				{
						if(!empty($value1))
						{
								$summary['total_test']++;
								$all_record[$i]['Health']['no_of_test']++;
						}
				}
				$test_detail = $this->Package->find('all',array('conditions'=>array('Package.id'=>$expl_test)));
				foreach($test_detail as $key5=>$value5)
				{
					$all_record[$i]['Health']['row_test_code'] .= $value5['Package']['package_code'].' , ';
				}
				//$all_record[$i]['Health']['row_test_code'] = substr($all_record[$i]['Health']['row_test_code'],0,strlen($all_record[$i]['Health']['row_test_code'])-1);

				$test_code = $this->RequestTest->find('all',array('conditions'=>array('RequestTest.health_id'=>$all_record[$i]['Health']['id'],'RequestTest.test_id'=>$expl_test,'RequestTest.type'=>'PA')));
				foreach($test_code as $key5=>$value5)
				{
					$all_record[$i]['Health']['row_test_amt'] += $value5['RequestTest']['mrp'];
					foreach($test_detail as $key6=>$value6)
					{
						if(isset($pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Package']['profit_margin_category']]) && $pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Package']['profit_margin_category']] >0 && $value5['RequestTest']['test_id'] == $value6['Package']['id'])
						$all_record[$i]['Health']['row_gross_booked_by_income'] += (($value5['RequestTest']['mrp']*$pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['bb_'.$value6['Package']['profit_margin_category']])/100);
					}
				}
			}
			$summary['total_amount'] = $summary['total_net_payable']+$summary['total_discount_amount'];
			$summary['total_balance_due'] = $summary['total_net_payable'] - $summary['total_received_amount'];
			if($all_record[$i]['Health']['row_gross_booked_by_income'] > 0)
				$all_record[$i]['Health']['row_net_booked_by_income'] = $all_record[$i]['Health']['row_gross_booked_by_income'] - $all_record[$i]['Health']['discount_amount'];
			$summary['gross_booked_income'] += $all_record[$i]['Health']['row_gross_booked_by_income'];
		}


		if($summary['gross_booked_income'] > 0)
			$summary['net_booked_income'] = $summary['gross_booked_income'] - $summary['total_discount_amount'];
		$summary['booking_income_percent'] = round(($summary['gross_booked_income']*100)/$summary['total_amount'],2);
		return $all_record[0]['Health']['row_net_booked_by_income']; 
		//$this->set('summary',$summary);
		//$this->set('all_record',$all_record); 
	}
	
	function getDiscountAmountById($discount_id=null,$total_amt=null)
	{
		$discount_amt = 0;
		if(isset($discount_id) && !empty($discount_id) && $discount_id > 0)
		{
			//if($this->Session->check('Discount.'.$discount_id))
			//{
			//	$discount_amt = $this->Session->read('Discout.'.$discount_id);
			//}
			//else
			//{
				$this->Discount = ClassRegistry::init('Discount');
				$data = $this->Discount->find('first',array('fields'=>array('amount','type'),'conditions'=>array('Discount.id'=>$discount_id)));
				if($data['Discount']['type'] == 'Percent')
				{
					$discount_amt = (($total_amt*$data['Discount']['amount'])/100);
				}
				else
				{
					$discount_amt = $data['Discount']['amount'];
				}
				$this->Session->write('Discount.'.$discount_id,$discount_amt);
				
			//}
			
		}
		
		return $discount_amt;
	}
	
	function show_mobile_hide($landline=null , $s_date=null)
        { 
            $user_type=$this->Session->read('Admin.userType');
            //$yesterday = date("Y-m-d");
            $yesterday1 = date('d-M-Y', strtotime('-5 days')); 	
			
			
			//return $user_type;		
			//$this->Health = ClassRegistry::init('Health');
			
			//$landline = $this->Health->find('first',array('fields'=>array('landline','s_date'),'conditions'=>array('Health.id'=>$this->data['Health']['id'])));
					if($user_type == 'A')
					{

					return $landline;
					} else {
					if(strtotime($s_date) >  strtotime($yesterday1))
					
						{ 
							return $landline;
						}
						else{
							//$reports[$k]['SalesReport']['patient_contact'] = $sl_vl['Health']['landline'];
							$newstring = substr_replace($landline, "****", 3 , -3); 
							return $newstring;
						}
					
					}
        }
	/*function to check sms enable for pcc*/
	function check_sms_enable_for_pcc($pcc_id,$assigned_lab=null)
	{
		if(isset($pcc_id) && !empty($pcc_id) && is_numeric($pcc_id))
		{
			$this->Lab = ClassRegistry::init('Lab');
			$data = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$pcc_id),'fields'=>array('send_sms_to_patient')));
			return $data['Lab']['send_sms_to_patient'];
		}
		else
		{
			return 1;
		}
		
	}
	
	/*function to check whatsapp enable for pcc*/
	function check_whatsapp_enable_for_pcc($pcc_id,$assigned_lab=null)
	{
		if(isset($pcc_id) && !empty($pcc_id) && is_numeric($pcc_id))
		{
			$this->Lab = ClassRegistry::init('Lab');
			$data = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$pcc_id),'fields'=>array('send_whatsapp_to_patient')));
			return $data['Lab']['send_whatsapp_to_patient'];
		}
		else
		{
			return 1;
		}
		
	}
	
	function check_push_notification_for_pcc($pcc_id,$assigned_lab=null)
	{
		if(isset($pcc_id) && !empty($pcc_id) && is_numeric($pcc_id))
		{
			$this->Lab = ClassRegistry::init('Lab');
			$data = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$pcc_id),'fields'=>array('send_push_notification')));
			//print_R(json_encode($data));die;
			return $data['Lab']['send_push_notification'];
		}
		else
		{
			return 1;
		}
		
	}
	
	function check_report_sms_enable_for_pcc($pcc_id,$assigned_lab=null)
	{
		if(isset($pcc_id) && !empty($pcc_id) && is_numeric($pcc_id))
		{
			$this->Lab = ClassRegistry::init('Lab');
			$data = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$pcc_id),'fields'=>array('report_upload_sms')));
			return $data['Lab']['report_upload_sms'];
		}
		else
		{
			return 1;
		}
		
	}
	
	function check_agent_sms_enable_for_pcc($pcc_id,$assigned_lab=null)
	{
		if(isset($pcc_id) && !empty($pcc_id) && is_numeric($pcc_id))
		{
			$this->Lab = ClassRegistry::init('Lab');
			$data = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$pcc_id),'fields'=>array('confirm_agent_sms')));
			return $data['Lab']['confirm_agent_sms'];
		}
		else
		{
			return 1;
		}
		
	}
	
	/*function to get test completed status*/
	function get_test_completed_status($health_id=null)
	{ 
		$format_array = array();
		if(isset($health_id) && !empty($health_id))
		{
			$this->RequestTest = ClassRegistry::init('RequestTest');
			$this->RequestTest->bindModel(array(
				'belongsTo'=>array(
					'Test'=>array(
						'className'=>'Test',
						'foreignKey'=>'test_id',
						'conditions'=>array('RequestTest.type'=>'TE','Test.type'=>'TEST'),
						'fields'=>array('id','testcode','test_parameter')
					),
					'Profile'=>array(
						'className'=>'Test',
						'foreignKey'=>'test_id',
						'conditions'=>array('RequestTest.type'=>'PR','Profile.type'=>'PROFILE'),
						'fields'=>array('id','testcode','test_parameter')
					),
					'Service'=>array(
						'className'=>'Test',
						'foreignKey'=>'test_id',
						'conditions'=>array('RequestTest.type'=>'SR','Service.type'=>'SERVICE'),
						'fields'=>array('id','testcode','test_parameter')
					),
					'Package'=>array(
						'className'=>'Package',
						'foreignKey'=>'test_id',
						'conditions'=>array('RequestTest.type'=>'PA'),
						'fields'=>array('id','package_code','package_name')
					),
					'Banner'=>array(
						'className'=>'Banner',
						'foreignKey'=>'test_id',
						'conditions'=>array('RequestTest.type'=>'OF'),
						'fields'=>array('id','banner_name','banner_code')
					)
				)
			));
			
			$data = $this->RequestTest->find('all',array('conditions'=>array('RequestTest.health_id'=>$health_id)));
			foreach($data as $key=>$value)
			{
				if(isset($value['Test']['id']) && !empty($value['Test']['id']))
				{
					$format_array[$value['RequestTest']['id']] = array('id'=>$value['RequestTest']['id'],'test_code'=>$value['Test']['testcode'],'test_name'=>$value['Test']['test_parameter'],'reporting_status'=>$value['RequestTest']['reporting_status'],'type'=>$value['RequestTest']['type']);
				}
				elseif(isset($value['Profile']['id']) && !empty($value['Profile']['id']))
				{
					$format_array[$value['RequestTest']['id']] = array('id'=>$value['RequestTest']['id'],'test_code'=>$value['Profile']['testcode'],'test_name'=>$value['Profile']['test_parameter'],'reporting_status'=>$value['RequestTest']['reporting_status'],'type'=>$value['RequestTest']['type']);
				}
				elseif(isset($value['Service']['id']) && !empty($value['Service']['id']))
				{
					$format_array[$value['RequestTest']['id']] = array('id'=>$value['RequestTest']['id'],'test_code'=>$value['Service']['testcode'],'test_name'=>$value['Service']['test_parameter'],'reporting_status'=>$value['RequestTest']['reporting_status'],'type'=>$value['RequestTest']['type']);
				}
				elseif(isset($value['Banner']['id']) && !empty($value['Banner']['id']))
				{
					$format_array[$value['RequestTest']['id']] = array('id'=>$value['RequestTest']['id'],'test_code'=>$value['Banner']['banner_code'],'test_name'=>$value['Banner']['banner_name'],'reporting_status'=>$value['RequestTest']['reporting_status'],'type'=>$value['RequestTest']['type']);
				}
				elseif(isset($value['Package']['id']) && !empty($value['Package']['id']))
				{
					$format_array[$value['RequestTest']['id']] = array('id'=>$value['RequestTest']['id'],'test_code'=>$value['Package']['package_code'],'test_name'=>$value['Package']['package_name'],'reporting_status'=>$value['RequestTest']['reporting_status'],'type'=>$value['RequestTest']['type']);
				}
			}
			
		}
		return $format_array;
	}

	function trigger_callhealth_results($id)
	{ 
	    $this->Health = ClassRegistry::init('Health');
		$health_detail = $this->Health->find('first',array('conditions'=>array('Health.id'=>$id)));

		$this->Lab = ClassRegistry::init('Lab');
		$labs = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$health_detail['Health']['created_by'])));

		$this->Billing = ClassRegistry::init('Billing');
		$billing_detail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$id)));

	        $reference = "NPL".$billing_detail['Billing']['order_id'];
		if(!empty($health_detail['Health']['reference']))
			$reference = $health_detail['Health']['reference'];

		$customerId = $health_detail['Health']['user_id'];
		if(!empty($health_detail['Health']['medical_reference_number']))
	    		$customerId = $health_detail['Health']['medical_reference_number'];
		
		//if($health_detail['Health']['created_by'] == '146' || $health_detail['Health']['created_by'] == '153')
		//	return $this->call_health_result($id,$health_detail['Health']['created_by']);
		if($health_detail['Health']['created_by'] == '157')
			return $this->panasonic_result($id,$health_detail['Health']['created_by']);
	}
	
	function visitapp_result($id,$createdBy,$type)
	{
		$this->Health = ClassRegistry::init('Health');
		$health = $this->Health->find('first',array('conditions'=>array('Health.id'=>$id),'order'=>array('id'=>'DESC')));
		
		$file = '/home2/niramovh/public_html/app/webroot/files/log/visitapplog.txt';
		
		$this->Billing = ClassRegistry::init('Billing');
		$billing_detail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$id)));
		file_put_contents($file,$billing_detail['Billing']['order_id'], FILE_APPEND);
		
		$test_list = explode(',',$health['Health']['test_id']);
		$profile_list = explode(',',$health['Health']['profile_id']);
		$service_list = explode(',',$health['Health']['service_id']);
		$package_list = explode(',',$health['Health']['package_id']);
		$offer_list = explode(',',$health['Health']['offer_id']);
		file_put_contents($file,PHP_EOL, FILE_APPEND);
		
		$testList = array();
		$testnamelist = array();
		$count = 0;
		
		$this->Test = ClassRegistry::init('Test');
		$this->Package = ClassRegistry::init('Package');
		$this->Banner = ClassRegistry::init('Banner');
		
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
		
		if($health['Health']['gender']==2)
			$gender = 'Female';
		else
			$gender = 'Male';
		
		$formattedData = array(
//			"reportUrl" => $reportUrl,
			"testCodes" => implode(',',$testList),
			"phone" => $health['Health']['landline'],
			"email" => $health['Health']['email'],
			"age" => $health['Health']['age'],
			"collectionDate" => $health['Health']['sample_collected_date'],
			"address" => $health['Health']['address'],
			"pincode" => $health['Health']['pincode'],
			"gender" => $gender,
			"name" => $health['Health']['name'],
//			"reportStatus" => $report,
			"referenceId" => $health['Health']['reference'],
			"reqNumber" => $billing_detail['Billing']['order_id'],
			"camp_name" => $health['Health']['landmark']
		);
		file_put_contents($file,json_encode($formattedData), FILE_APPEND);
		file_put_contents($file,"--------------------------", FILE_APPEND);
		$ch = curl_init();
		$curlConfig = array();
		$curlConfig = array(
			CURLOPT_URL            => "https://api.getvisitapp.com/v3/new-auth/niramaya-onboard",
			CURLOPT_POST           => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYHOST=>false,
			CURLOPT_SSL_VERIFYPEER=>false,
			CURLOPT_POSTFIELDS     => json_encode($formattedData),
			CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/json",
			),
		);     
		
		curl_setopt_array($ch, $curlConfig);
		$callvisitapp = curl_exec($ch);
		curl_close($ch);
		file_put_contents($file,$callvisitapp, FILE_APPEND);
		file_put_contents($file,PHP_EOL, FILE_APPEND);
		file_put_contents($file,PHP_EOL, FILE_APPEND);
		return $callvisitapp;
	}
	
	function writelog($content){
		$file = '/home2/niramovh/public_html/app/webroot/files/log/panasoniclog.txt';
		file_put_contents($file,$content, FILE_APPEND);
	}

	function panasonic_result($id,$createdBy)
	{
		$this->writelog(PHP_EOL );
		$this->writelog(date('d-m-Y h:i:s'));
		$this->writelog(PHP_EOL );
		$this->writelog($id);
		$this->writelog(PHP_EOL );
		$this->writelog('entry to panasonic result');
		$this->writelog(PHP_EOL );
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
		
		$this->writelog(json_encode($data));
		$this->writelog(PHP_EOL );

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
		
		$this->writelog($callHealthResult);
		$this->writelog(PHP_EOL );
		$this->writelog('----------------------------------------------------------------------------------------------------------------------------------------');
		$this->writelog('----------------------------------------------------------------------------------------------------------------------------------------');

		return $callHealthResult;
	}
	
	function call_health_result($id,$createdBy)
	{
		$this->Healthlabmateresponse = ClassRegistry::init('Healthlabmateresponse');
		$healthlabmate = $this->Healthlabmateresponse->find('first',array('conditions'=>array('Healthlabmateresponse.health_id'=>$id),'order'=>array('id'=>'ASC')));
		print_R($healthlabmate);
		$this->Health = ClassRegistry::init('Health');
		$resultSetLabmate = json_decode($healthlabmate['Healthlabmateresponse']['json_data']);
		
		unset($resultSetLabmate->APIKey);
		unset($resultSetLabmate->APIUser);
		unset($resultSetLabmate->Message);
		$resultSetLabmate->associate_name = 'Niramaya PathLabs';
		print_R($id);
		print_R($resultSetLabmate);
		$testList=array();
		$ch = curl_init();
		$curlConfig = array();
		if($createdBy=='146')
		{
			$curlConfig = array(
			    CURLOPT_URL            => "https://hies-uat.callhealth.com/orders/v1/results",
			    CURLOPT_POST           => true,
			    CURLOPT_RETURNTRANSFER => true,
			    CURLOPT_SSL_VERIFYHOST=>false,
			    CURLOPT_SSL_VERIFYPEER=>false,
			    CURLOPT_POSTFIELDS     => json_encode($resultSetLabmate),
			    CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"token:Ni39Ek4L4sm2F58aiv58349A",
			    ),
			);                                                                                   
		}
		else
		{
			$curlConfig = array(
			    CURLOPT_URL            => "https://hies.callhealth.com/orders/v1/results",
			    CURLOPT_POST           => true,
			    CURLOPT_RETURNTRANSFER => true,
			    CURLOPT_SSL_VERIFYHOST=>false,
			    CURLOPT_SSL_VERIFYPEER=>false,
			    CURLOPT_POSTFIELDS     => json_encode($resultSetLabmate),
			    CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"token:NI45Rj8S1rp3V69ifo5823EA",
			    ),
			);
		}
		
		 curl_setopt_array($ch, $curlConfig);
			$callHealthResult = curl_exec($ch);
		curl_close($ch);
		print_R($callHealthResult);
	}

	function dropletapi($id=null,$lab_name=null,$caller=null)
	{
		//print_R('Droplet API');
		$this->Health = ClassRegistry::init('Health');
		$health_data = $this->Health->find('first',array('conditions'=>array('Health.id'=>$id)));
		
		$this->PincodeMaster = ClassRegistry::init('PincodeMaster');
		$lab_city = $this->PincodeMaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$health_data['Health']['pincode'])));

		if(!empty($lab_city['PincodeMaster']['droplet_city_id']) && $lab_city['PincodeMaster']['droplet_city_id']!=0)
		{
			$start_date = '';
			if(!empty($health_data['Health']['sample_date']))
			{
				$start_date = date('Y-m-d',strtotime($health_data['Health']['sample_date']));
			}
			else
			{
				$start_date = date('Y-m-d',strtotime($health_data['Health']['sample_date1']));
			}
			//print_R("https://sandbox.droplet.net.in/api/v5/slots?start_date=".$start_date."&end_date=".$start_date."&pincode=".$health_data['Health']['pincode']."&city_id=".$lab_city['LabCityMapping']['lab_city_id']);
			$curl = curl_init();

			  curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://dash.droplet.net.in/api/v5/slots?start_date=".$start_date."&end_date=".$start_date."&pincode=".$health_data['Health']['pincode']."&city_id=".$lab_city['PincodeMaster']['droplet_city_id'],
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_POSTFIELDS => "",
			  CURLOPT_HTTPHEADER => array(
				"Authorization: 385e430952a503dd29bdc1aaf84e273e",
				"Cache-Control: no-cache",
				"Postman-Token: 2adcbcc1-41f8-4ac3-b1cd-6fc6be9b085d",
				"cache-control: no-cache"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  $res_slot = json_decode($response);
			  //print_R($res_slot);
			  if($res_slot->status=='success')
			  {
				  $this->Health->query('update healths set requ_status=1 where id="'.$health_data['Health']['id'].'"');
				  
				  if($this->check_push_notification_for_pcc($health_data['Health']['created_by'],$health_data['Health']['assigned_lab']) == 1)
					{
						$response = $this->send_notification($health_data['Health']['id']);
					}
					
				  $this->_activity_log($health_data,"slot ids fetched");
				  $this->book_slot($res_slot->slots,$start_date,$health_data,$lab_name,$caller);
			  }
			  else{
				  $this->_activity_log($health_data,"No Slot Available for ".$health_data['Health']['sample_date']);
				   echo "error_not_updated";
			  }
			}
		}
		else
		{
			$this->_activity_log($health_data,"Pincode Not Servicable by Droplet");
			 echo "error_not_updated";
		}
	}

	function _activity_log($health, $action)
	{
		// To get page url to track activity
		$page_url = Router::url( $this->here, true );
		//echo json_encode($page_url);
		$this->ActivityLog = ClassRegistry::init('ActivityLog');
		$this->data['ActivityLog']['admin_id'] = "1";
		
		$this->data['ActivityLog']['patient_id'] = $health['Health']['user_id'];
		$this->data['ActivityLog']['health_id'] = $health['Health']['id'];
		$this->data['ActivityLog']['page_url']= $page_url;
		$this->data['ActivityLog']['action']= $action;
		$this->data['ActivityLog']['creation'] = date('Y-m-d H:i:s');
		
		//echo json_encode($this->data);
		if($this->ActivityLog->create($this->data))
		{
			$this->ActivityLog->save($this->data);
		}
	}
	
	function book_slot($dateslots,$start_date,$health_data,$lab_name,$caller)
	{
		$time = '';
		if(!empty($health_data['Health']['sample_time1']))
			$time = $health_data['Health']['sample_time1'];
		else
			$time = $health_data['Health']['sample_time'];
		//print_R($health_data);die;
		$time_array = array($time,$time-1,$time+1,$time-2,$time+2,$time-3,$time+3);
		//print_R($time_array);
		
		$this->Billing = ClassRegistry::init('Billing');
		$billing_detail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$health_data['Health']['id'])));
		
		foreach($time_array as $key)
		{
			foreach($dateslots as $date=>$slot)
			{
				$this->Timelabs = ClassRegistry::init('Timelabs');
				$timeslot = $this->Timelabs->find('first',array('conditions'=>array('Timelabs.sequence'=>$key)));
				$slot_time = explode('-',$timeslot['Timelabs']['name']);
				
				foreach($slot as $val)
				{
					if(!empty($val->id))
					{
						if(strtotime($slot_time[0])==strtotime($val->starttime)&&strtotime($slot_time[1])==strtotime($val->endtime))
						{
							$this->_activity_log($health_data,"Using slot id ".$val->id);
							
							$slotbooking = array('uid'=>$health_data['Health']['reference'],'slot_id'=>$val->id);
							$curl = curl_init();

							  curl_setopt_array($curl, array(
							  CURLOPT_URL => "http://dash.droplet.net.in/api/v5/slots/book",
							  CURLOPT_POST           => true,
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_SSL_VERIFYHOST=>false,
								CURLOPT_SSL_VERIFYPEER=>false,
								CURLOPT_POSTFIELDS     => json_encode($slotbooking),
							  CURLOPT_HTTPHEADER => array(
								"Authorization: 385e430952a503dd29bdc1aaf84e273e",
								"Cache-Control: no-cache",
								"content-type: application/json",
							  ),
							));

							$response = curl_exec($curl);
							$err = curl_error($curl);
							//print_R($response);
							$res_slot = json_decode($response);
							if($res_slot->status=='success')
							  {
								  $this->_activity_log($health_data,"slot_booking_id fetched ".$res_slot->slot_booking_id);
								  $this->Health = ClassRegistry::init('Health');
								  $this->Health->query('update healths set requ_status=2,sample_time1='.$key.' where id="'.$health_data['Health']['id'].'"');
								  
								  if($this->check_push_notification_for_pcc($health_data['Health']['created_by'],$health_data['Health']['assigned_lab']) == 1)
									{
										$response = $this->send_notification($health_data['Health']['id']);
									}
									
								  $this->push_order($res_slot->slot_booking_id,$health_data,$lab_name,$caller);
								  break 3;
							  }
							  else{
								   $this->_activity_log($health_data,"No Slot Available For the Order No ".$health_data['Health']['id']);
							  }
						}
					}
				}
			}
		}
		
		$this->_activity_log($health_data,"No Slot Available For the NPL Req. No ".$billing_detail['Billing']['order_id']);
		echo "error_not_updated";
	}
	
	function push_order($slot_booking_id,$health_data,$lab_name,$caller)
	{
		if($health_data['Health']['gender']=='2')
            $sex = 'Female';
        else
			$sex = 'Male';
		
		$testdata = array();
		$this->Test = ClassRegistry::init('Test');
		$testarray = array();
		if(!empty($health_data['Health']['test_id']))
		{
			$tests = explode(',',$health_data['Health']['test_id']);
			foreach($tests as $key)
			{
				if(!empty($key))
					array_push($testarray,$key);
			}
		}
		
		if(!empty($health_data['Health']['profile_id']))
		{
			$tests = explode(',',$health_data['Health']['profile_id']);
			foreach($tests as $key)
			{
				if(!empty($key))
					array_push($testarray,$key);
			}
		}
		
		if(!empty($health_data['Health']['service_id']))
		{
			$tests = explode(',',$health_data['Health']['service_id']);
			foreach($tests as $key)
			{
				if(!empty($key))
					array_push($testarray,$key);
			}
		}
		$count = 1;
		
		$testdetail = array();
		
//		print_R($testarray);
		foreach($testarray as $key)
		{
			$singletest = array();
			
			$testlist = $this->Test->find('first',array('conditions'=>array('Test.id'=>$key)));
			$singletest["dos_code"] = $testlist["Test"]['testcode'];
			$singletest["mrp"] = $testlist["Test"]['mrp'];
			$singletest["offered_price"] = $testlist["Test"]['mrp'] ;
			
			$this->Billing = ClassRegistry::init('Billing');
			$billing_detail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$health_data['Health']['id'])));
			
			$singletest["booking_reference_id"] = $health_data['Health']['reference']."-".$testlist["Test"]['testcode'] ;
			$singletest["phlebo_communication"] = $testlist["Test"]['test_parameter']."- Rs".$testlist["Test"]['mrp'];
			
			array_push($testdetail,$singletest["phlebo_communication"]);
			//print_R($singletest);
			array_push($testdata,$singletest);
		}
		//print_R($testdata);
		//die;
		$send_lab="";
		if($health_data['Health']['assigned_lab']=='122')
		{
			$send_lab = "284";
		}
		else
		{
			$send_lab = "159";
		}
		$this->PincodeMaster = ClassRegistry::init('PincodeMaster');
		$lab_city = $this->PincodeMaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$health_data['Health']['pincode'])));
		
		//$this->LabCityMapping = ClassRegistry::init('LabCityMapping');
		//$lab_city = $this->LabCityMapping->find('first',array('conditions'=>array('LabCityMapping.lab_id'=>$lab_value,'LabCityMapping.city_id'=>$health_data['Health']['city_id'])));
		
		$data = array(
			"patient_detail"=>array(
				"name" => $health_data['Health']['name'],
				"age" => $health_data['Health']['age'],
				"gender" => $sex,
				"email" => "helpline@niramayapathlabs.com",
				"phone_number" => $health_data['Health']['landline'],
					"address" => array(
						"street" => $health_data['Health']['address'],
						"area" => $health_data['Health']['locality'],
						//"landmark" => "",
						"pincode" => $health_data['Health']['pincode'],
					),
				),
				"city_id" =>$lab_city['PincodeMaster']['droplet_city_id'],
				"collection_charge" => 0,
				"reporting_charge" => 0,
				"amount_to_be_collected" => $health_data['Health']['amount_to_be_collected'],
				"hard_copy_required" => "false",
				"slot_booking_id" => $slot_booking_id,
				"order_reference_id" => $health_data['Health']['reference'],
				"lab_id" => $send_lab,
				"tests" => $testdata,						
			);
		//print_R(json_encode($data));
		$curl = curl_init();

		  curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://dash.droplet.net.in/api/v5/orders",
		  CURLOPT_POST           => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYHOST=>false,
			CURLOPT_SSL_VERIFYPEER=>false,
			CURLOPT_POSTFIELDS     => json_encode($data),
		  CURLOPT_HTTPHEADER => array(
			"Authorization: 385e430952a503dd29bdc1aaf84e273e",
			"Cache-Control: no-cache",
			"content-type: application/json",
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		print_R($response);
		$order = json_decode($response);
		if($order->status=='success')
		  {
			  $this->_activity_log($health_data,"Droplet OrderID ".$order->order_id);
			  $this->Health = ClassRegistry::init('Health');
			  $this->Health->query('update healths set agent_id="79",requ_status=4,assigned_lab=121 where id="'.$health_data['Health']['id'].'"');
			  
			  if($this->check_push_notification_for_pcc($health_data['Health']['created_by'],$health_data['Health']['assigned_lab']) == 1)
			  {
				 $response = $this->send_notification($health_data['Health']['id']);
			  }
					
			 echo $lab_name.','.$health_data['Health']['id'];
		  }
		  else{
			  if($order->message=="Lab-Test Not Found for #0 test.")
			  {
				foreach($testdata as $key)
				{
					array_pop($testdata);
				}	
				
				//$testlist = $this->Test->find('first',array('conditions'=>array('Test.testcode'=>'PKG001')));
				$singletest["dos_code"] = 'PKG001';
				$singletest["mrp"] = '1500';
				$singletest["offered_price"] = '1500';
				$singletest["phlebo_communication"] = implode(" , ",$testdetail);
				
				$this->Billing = ClassRegistry::init('Billing');
				$billing_detail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$health_data['Health']['id'])));
				
				$singletest["booking_reference_id"] = $billing_detail['Billing']['order_id']."-PKG001";
				//print_R($singletest);
				array_push($testdata,$singletest);
				//print_R($testdata);
				
				$data['tests'] = $testdata;
				//print_R(json_encode($data));
				$curl = curl_init();

				  curl_setopt_array($curl, array(
				  CURLOPT_URL => "http://dash.droplet.net.in/api/v5/orders",
				  CURLOPT_POST           => true,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_SSL_VERIFYHOST=>false,
					CURLOPT_SSL_VERIFYPEER=>false,
					CURLOPT_POSTFIELDS     => json_encode($data),
				  CURLOPT_HTTPHEADER => array(
					"Authorization: 385e430952a503dd29bdc1aaf84e273e",
					"Cache-Control: no-cache",
					"content-type: application/json",
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);
				//print_R($response);
				$order = json_decode($response);
				if($order->status=='success')
				  {
					  $this->_activity_log($health_data,"Droplet OrderID ".$order->order_id);
					  $this->Health = ClassRegistry::init('Health');
					  $this->Health->query('update healths set agent_id="79",requ_status=4,assigned_lab=121 where id="'.$health_data['Health']['id'].'"');
					  
					if($this->check_push_notification_for_pcc($health_data['Health']['created_by'],$health_data['Health']['assigned_lab']) == 1)
					{
						$response = $this->send_notification($health_data['Health']['id']);
					}
						
					 echo $lab_name.','.$health_data['Health']['id'];
				  }
				  else{
					  $this->_activity_log($health_data,$order->message);
					  echo "error_not_updated";
				  }
			  }
			  else
			  {
			   $this->_activity_log($health_data,$order->message);
			   echo "error_not_updated";
			  }
		  }
	}
/*	function call_health_result_test($id,$createdBy)
	{
		$this->Healthlabmateresponse = ClassRegistry::init('Healthlabmateresponse');
		echo $id;
		$healthlabmate = $this->Healthlabmateresponse->find('first',array('conditions'=>array('Healthlabmateresponse.health_id'=>$id),'order'=>array('id'=>'DESC')));

		$this->Health = ClassRegistry::init('Health');
		$resultSetLabmate = json_decode($healthlabmate['Healthlabmateresponse']['json_data']);
		unset($resultSetLabmate->APIKey);
		unset($resultSetLabmate->APIUser);
		unset($resultSetLabmate->Message);
		$resultSetLabmate->associate_name = 'Niramaya PathLabs';
				print_R($resultSetLabmate);
		echo "<br><br>";*/
		/*$testList=array();
		$ch = curl_init();
		$curlConfig = array();
		if($createdBy=='146')
		{
			$curlConfig = array(
			    CURLOPT_URL            => "https://hies-uat.callhealth.com/orders/v1/results",
			    CURLOPT_POST           => true,
			    CURLOPT_RETURNTRANSFER => true,
			    CURLOPT_SSL_VERIFYHOST=>false,
			    CURLOPT_SSL_VERIFYPEER=>false,
			    CURLOPT_POSTFIELDS     => json_encode($resultSetLabmate),
			    CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"token:Ni39Ek4L4sm2F58aiv58349A",
			    ),
			);                                                                                   
		}
		else
		{
			$curlConfig = array(
			    CURLOPT_URL            => "https://hies.callhealth.com/orders/v1/results",
			    CURLOPT_POST           => true,
			    CURLOPT_RETURNTRANSFER => true,
			    CURLOPT_SSL_VERIFYHOST=>false,
			    CURLOPT_SSL_VERIFYPEER=>false,
			    CURLOPT_POSTFIELDS     => json_encode($resultSetLabmate),
			    CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"token:NI45Rj8S1rp3V69ifo5823EA",
			    ),
			);
		}
		
		 curl_setopt_array($ch, $curlConfig);
			$callHealthResult = curl_exec($ch);
		curl_close($ch);
		print_R($callHealthResult);*/
	/*}

	function trigger_callhealth_results_test($id)
	{ 
		$this->Health = ClassRegistry::init('Health');
		$health_detail = $this->Health->find('first',array('conditions'=>array('Health.id'=>$id)));

		$this->Lab = ClassRegistry::init('Lab');
		$labs = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$health_detail['Health']['created_by'])));

		$this->Billing = ClassRegistry::init('Billing');
		$billing_detail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$id)));

	        $reference = "NPL".$billing_detail['Billing']['order_id'];
		if(!empty($health_detail['Health']['reference']))
			$reference = $health_detail['Health']['reference'];

		$customerId = $health_detail['Health']['user_id'];
		if(!empty($health_detail['Health']['medical_reference_number']))
	    		$customerId = $health_detail['Health']['medical_reference_number'];

		$sampleData = array(
			   "APIKey"=>"PSBIONWTYKQ1298RTYQSW",
			   "APIUser"=>"APWTYCOMTY19ANPWTRNR",
			   "ch_order_num"=>$reference,
			   "patient_id"=>$customerId,
		); 

		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => "http://182.73.179.75:99/Nhcare/labmateservice.svc/GetResultValue",
		    CURLOPT_POST           => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS     => json_encode($sampleData),
		    CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/json",
		    ),
		);

		 curl_setopt_array($ch, $curlConfig);
		$getLabmateResult =curl_exec($ch);

		curl_close($ch);
		$this->Healthlabmateresponse = ClassRegistry::init('Healthlabmateresponse');
		$this->Healthlabmateresponse->create();
		$this->data['Healthlabmateresponse']['health_id'] = $id;
		$this->data['Healthlabmateresponse']['json_data'] = $getLabmateResult;
		$result = $this->Healthlabmateresponse->save($this->data);
		print_R($result);
	/*	if($health_detail['Health']['created_by'] == '146' || $health_detail['Health']['created_by'] == '153')
			$this->call_health_result($id,$health_detail['Health']['created_by']);*/
	//}
	public function getRequestStatus($status_code=null)
	{
		$status = Configure::read('RequestStatus');
		return ($status[$status_code])?$status[$status_code]:'Unkwown';
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
							
				if($data['Health']['report_type']=='partial' && $data['Health']['requ_status']=="7")
				{
					$statusdata['report_type'] = ($data['Health']['report_type'])? $data['Health']['report_type'] : "";

					if (strpos($data['Health']['patient_report_with_header'], 'https:') !== false || strpos($data['Health']['patient_report_with_header'], 'http:') !== false) { 
						$statusdata['report_url'] = ($data['Health']['patient_report_with_header'])?$data['Health']['patient_report_with_header'] : "";
					}
					else{
						$statusdata['report_url'] = SITE_URL."tests/view_report/".base64_encode(str_replace("?","@@@@",$data['Health']['patient_report_with_header']));			
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
				else if($data['Health']['report_type']=='full' && $data['Health']['requ_status']=="6")
				{
					if(empty($data['Health']['smart_report']))
					{
						$statusdata['report_type'] = ($data['Health']['report_type'])? $data['Health']['report_type'] : "";
						
						if (strpos($data['Health']['patient_report_with_header'], 'https:') !== false || strpos($data['Health']['patient_report_with_header'], 'http:') !== false) { 
							$statusdata['report_url'] = ($data['Health']['patient_report_with_header'])?$data['Health']['patient_report_with_header'] : "";
						}
						else{
							$statusdata['report_url'] = SITE_URL."tests/view_report/".base64_encode(str_replace("?","@@@@",$data['Health']['patient_report_with_header']));			
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

				if($data['Health']['requ_status']==12)
				{
					$this->Healthsample = ClassRegistry::init('Healthsample');
					$this->Samplemaster = ClassRegistry::init("Samplemaster");
					
					$samples = $this->Healthsample->find('all',array('conditions'=>array('Healthsample.health_id'=>$data['Health']['id'])));
					
					$statusdata['completed'] = array();
					$statusdata['rejected'] = array();
					$statusdata['pending'] = array();

					foreach($samples as $val)
					{
						$sample_type = $this->Samplemaster->find('first',array('conditions'=>array('Samplemaster.sample_id'=>$val['Healthsample']['sample_id'])));

						$s_array = array();

						$s_array['sample_id'] = $val['Healthsample']['sample_id'];
						$s_array['sample_type'] = $sample_type['Samplemaster']['type'];;
						
						if($val['Healthsample']['sample_status']==3)
							array_push($statusdata['pending'], $s_array);
						

						if($val['Healthsample']['sample_status']==2)
						{
							$s_array['reason'] = $val['Healthsample']['sample_remark'];
							array_push($statusdata['rejected'], $s_array);
						}
						
						if($val['Healthsample']['sample_status']==1)
							array_push($statusdata['completed'], $s_array);
					}
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
			
			//print_R(curl_error($ch));
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

				if($data['Health']['requ_status']=="6")
				{
					$this->send_receipt($data['Health']['id']);
				}
			}
			curl_close($ch);
			//print_R($result);die;
		}
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

	function send_reject_notification($req_id=null,$sample_id=NULL)
	{
		$file = '/home2/niramovh/test.niramayahealthcare.com/app/webroot/files/log/sendnotification.txt';
		file_put_contents($file,date('Y-m-d H:i:s'), FILE_APPEND);

		$this->Health = ClassRegistry::init("Health");
		$this->Billing = ClassRegistry::init("Billing");
		$this->Samplemaster = ClassRegistry::init("Samplemaster");

		$data = $this->Health->find("first",array('conditions'=>array('Health.id'=>$req_id)));	
		$b_data = $this->Billing->find("first",array("conditions"=>array("Billing.request_id"=>$req_id)));
		$sample_data = $this->Samplemaster->find('first',array('conditions'=>array('Samplemaster.sample_id'=>$sample_id)));
		
		$check_status = substr($data['Health']['flag'],-2);

		if($data['Health']['requ_status']!=$check_status)
		{
			$lab_data = $this->Lab->find("first",array('conditions'=>array('Lab.id'=>$data['Health']['created_by'])));
			$statusdata = array();
			if(isset($data['Health']['id']))
			{
				$statusdata['order_id'] = $b_data['Billing']['order_id'];
				$statusdata['reference_id'] = $data['Health']['reference'];
				$statusdata['request_status'] = 'Sample Rejected';
				$statusdata['sample_type'] = $sample_data['Samplemaster']['type'];
				$statusdata['sample_id'] = $sample_data['Samplemaster']['sample_id'];
				$statusdata['reason'] = $sample_data['Samplemaster']['sample_remark'];
			}
			$statusdata['authorization'] = $lab_data['Lab']['auth_code_notification'];
//print_R( $lab_data['Lab']['call_url_notification']);
			print_R($statusdata);
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
				/*$len = strlen($data['Health']['requ_status']);
				
				if($len==1)
					$new_flag = substr_replace($data['Health']['flag'],$data['Health']['requ_status'],-1);
				if($len==2)
					$new_flag = substr_replace($data['Health']['flag'],$data['Health']['requ_status'],-2);

				$this->Health->query("update healths set flag=".$new_flag." where id=".$data['Health']['id']);*/
			}
			curl_close($ch);
		}
		
	}
	
	function itwohapi($id=null,$lab_name=null,$caller=null)
	{
		print_R("Itwoh API");
		/*$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://prod.i2hapi.com/rest/v1/token",
		 // CURLOPT_PROXYPORT => "9000",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_SSL_VERIFYHOST => 0,
		  //CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"api-key: NIRAMAYA",
			"api-secret: 10885454",
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$token = json_decode($response);
			
			$this->Health = ClassRegistry::init('Health');
			$health_data = $this->Health->find('first',array('conditions'=>array('Health.id'=>$id)));
			
			$this->itwohpushorder($health_data,$token->data->token);
			//$this->itwoh_check_zipcode($id,$token->data->token);
			//print_R(json_decode($response)->data->token);
		}*/
	}
	
	function itwoh_check_zipcode($id,$token)
	{
		$this->Health = ClassRegistry::init('Health');
		$health_data = $this->Health->find('first',array('conditions'=>array('Health.id'=>$id)));
		
		$curl = curl_init();
		print_R($health_data['Health']['pincode']);
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://prod.i2hapi.com/rest/v1/zipcode/".$health_data['Health']['pincode'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_SSL_VERIFYHOST => 0,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"token: ".$token,
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$responsedata = json_decode($response);
			if(!empty((array)$responsedata->data))
			{
				//$this->_activity_log($health_data,"I2H Zipcode Servicable ".$health_data['Health']['pincode']);
				echo "not empty";
				echo "<br><br>";
				
				$this->itwohpushorder($health_data,$token);
			}
			else
			{
				$this->_activity_log($health_data,"I2H Zipcode Not Servicable ".$health_data['Health']['pincode']);
				echo "empty";
			}
		}
	}
	
	function itwohpushorder($health_data,$token)
	{
		date_default_timezone_set("Asia/Calcutta");
		$file = '/home2/niramovh/public_html/app/webroot/files/log/itwoh_push_order.txt';
		
		$sex="";
		if($health_data['Health']['gender']=='2')
            $sex = 'F';
        else
			$sex = 'M';
		
		$this->Test = ClassRegistry::init('Test');
		$testarray = array();
		if(!empty($health_data['Health']['test_id']))
		{
			$tests = explode(',',$health_data['Health']['test_id']);
			foreach($tests as $key)
			{
				if(!empty($key))
					array_push($testarray,$key);
			}
		}
		
		if(!empty($health_data['Health']['profile_id']))
		{
			$tests = explode(',',$health_data['Health']['profile_id']);
			foreach($tests as $key)
			{
				if(!empty($key))
					array_push($testarray,$key);
			}
		}
		
		if(!empty($health_data['Health']['service_id']))
		{
			$tests = explode(',',$health_data['Health']['service_id']);
			foreach($tests as $key)
			{
				if(!empty($key))
					array_push($testarray,$key);
			}
		}
		$count = 1;
		
		$testdata = array();
		
		$testcounter = 1;
		$this->Samplemaster = ClassRegistry::init('Samplemaster');
		$sampleMaster = $this->Samplemaster->find('list',array('fields'=>array('Samplemaster.sample_id','Samplemaster.type')));
		$comment = array();
		$samplename = array();
		
		foreach($testarray as $key)
		{
			$testlist = $this->Test->find('first',array('conditions'=>array('Test.id'=>$key)));
			$sampleid = explode(',',$testlist['Test']['sample']);
			foreach($sampleid as $val)
			{
				array_push($samplename,$val);
			}
			
			array_push($comment,$testlist['Test']['test_parameter']);
		}
		
		$samplename = array_unique($samplename);
		
		
		foreach($samplename as $val1)
		{
			$singletest = array();
			
			$singletest["test_sequence"] = $testcounter;
			$singletest["test_name"] = $sampleMaster[$val1];
			$singletest["test_description"] = $sampleMaster[$val1];//$testlist['Test']['description'] ;
			$singletest["quantity"] = 1;
			
			array_push($testdata,$singletest);		
			
			$testcounter++;
		}
		
		$this->Billing = ClassRegistry::init('Billing');
		$billing_detail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$health_data['Health']['id'])));
		
		$this->City = ClassRegistry::init('City');
		$city = $this->City->find('first',array('conditions'=>array('City.id'=>$health_data['Health']['city_id'])));
		
		$this->State = ClassRegistry::init('State');
		$state = $this->State->find('first',array('conditions'=>array('State.id'=>$health_data['Health']['state'])));
		
		$this->Timelabs = ClassRegistry::init('Timelabs');
		$timeslot = $this->Timelabs->find('first',array('conditions'=>array('Timelabs.id'=>$health_data['Health']['sample_time1'])));
		$slot_time = explode('-',$timeslot['Timelabs']['name']);
		
		echo "<br>";
		print_R(date('d-m-Y',strtotime($health_data['Health']['sample_date1']))." ".$slot_time[0]);
		echo "<br>";
		print_R(date_default_timezone_get());
		echo "<br>";
		$earl_date = strtotime(date('d-m-Y',strtotime($health_data['Health']['sample_date1']))." ".$slot_time[0]);

		$lat_date = strtotime(date('d-m-Y',strtotime($health_data['Health']['sample_date1']))." ".$slot_time[1]);
		
		file_put_contents($file,"Original Timezone - ".date_default_timezone_get()."\n", FILE_APPEND);
		file_put_contents($file,"earliest Original Time - ".date('d-m-Y',strtotime($health_data['Health']['sample_date1']))." ".$slot_time[0]."\n", FILE_APPEND);
		file_put_contents($file,"earliest Original Time - ".date('d-m-Y',strtotime($health_data['Health']['sample_date1']))." ".$slot_time[1]."\n", FILE_APPEND);
		
		date_default_timezone_set("UTC");
		$earliest_pickup_date = date("Y-m-d\TH:i:s", $earl_date);

		$latest_pickup_date = date("Y-m-d\TH:i:s", $lat_date);
		file_put_contents($file,"Modified Timezone - ".date_default_timezone_get()."\n", FILE_APPEND);
		file_put_contents($file,"earliest UTC Time - ".$earliest_pickup_date."\n", FILE_APPEND);
		file_put_contents($file,"latest UTC Time - ".$latest_pickup_date."\n", FILE_APPEND);
						
		if($health_data['Health']['payment_type']==1)
		{
			$payment_type = "Prepaid";
		}
		
		if($health_data['Health']['payment_type']==2)
		{
			$payment_type = "Partial Paid";
		}
		
		if($health_data['Health']['payment_type']==3)
		{
			$payment_type = "Postpaid";
		}
		
		$data = array(
			"order_type"=> 1,
			"vendor_order_number" => $billing_detail['Billing']['order_id'],
			"preferred_lab_name"=> "Niramaya Path Labs",
			"bill_to_name" => "Niramaya Path Labs",
			"is_customer_signature_required" => true,
			"ship_to_name" => $health_data['Health']['name'],
			"ship_to_address1" => $health_data['Health']['address'],
			"ship_to_address2" => ".",
			"ship_to_city" => $city['City']['name'],
			"ship_to_state" => $state['State']['name'],
			"ship_to_zip_code" => $health_data['Health']['pincode'],
			"ship_to_country" => "India",
			"earliest_pickup_date" => $earliest_pickup_date,//date('d-m-Y',strtotime($health_data['Health']['sample_date1']))." ".$slot_time[0]
			"latest_pickup_date" => $latest_pickup_date,//date('d-m-Y',strtotime($health_data['Health']['sample_date1']))." ".$slot_time[1]
			"customer_name" => $health_data['Health']['name'],
			"customer_email" => $health_data['Health']['email'],
			"customer_contact" => $health_data['Health']['landline'],
			"customer_gender" => $sex,
			"customer_age" => (string)$health_data['Health']['age'],
			"lab_report_email" => "labreports@niramaya.com",
			"order_reference_number" => $health_data['Health']['reference'],
			"comments" => $comment,
			"test_details" => $testdata,
			"amount_to_collect" => $health_data['Health']['amount_to_be_collected'],
			"payment_mode" => $payment_type,
			"prepaid_amount" => $health_data['Health']['amount_collected']
		);
		file_put_contents($file,$billing_detail['Billing']['order_id']."\n", FILE_APPEND);
		file_put_contents($file,date('d-m-Y H:i:s')."\n", FILE_APPEND);
		file_put_contents($file,json_encode($data)."\n", FILE_APPEND);
		
		//print_R(json_encode($data));die;
			
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://prod.i2hapi.com/rest/v1/order",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($data),
		  CURLOPT_HTTPHEADER => array(
			"token: ".$token,
			"Content-Type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		
		file_put_contents($file,$response."\n", FILE_APPEND);
		file_put_contents($file,"\n\n", FILE_APPEND);
		curl_close($curl);
		
		if ($err) {
			echo "cURL Error #:" . $err;
			//$this->_activity_log($health_data,"I2H Order Not Placed  for order id-".$billing_detail['Billing']['order_id']);
		} else {
			$responsedata = json_decode($response);
			print_R($responsedata);
			if($responsedata->status==200)
			{
				echo $responsedata->data->i2h_order_id;
				$this->Health->query('update healths set agent_id="107",requ_status=4,assigned_lab=82,lab_message="I2H Order Id - '.$responsedata->data->i2h_order_id.'" where id="'.$health_data['Health']['id'].'"');
				$this->_activity_log($health_data,"I2H Order Id - ".$responsedata->data->i2h_order_id." for niramaya order id - ".$billing_detail['Billing']['order_id']);
			}
		}
		echo "<br><br><br>";
	}
	
	function medimojo_api($id=null,$lab_name=null,$caller=null)
	{
		print_R("MEDIMOJO API TRIGGERED");echo "<br>";
		$this->Health = ClassRegistry::init("Health");
		$this->Lab = ClassRegistry::init("Lab");
		$this->Samplemaster = ClassRegistry::init("Samplemaster");
		$this->Billing = ClassRegistry::init('Billing');
		$this->City = ClassRegistry::init("City");
		$this->State = ClassRegistry::init("State");
		$this->Timelabs = ClassRegistry::init("Timelabs");
		$this->ProcessingLabs = ClassRegistry::init("ProcessingLabs");
        
        $health_orders = $this->Health->query("SELECT *
			FROM healths
			WHERE id='".$id."'");
		
		$get_collection_time_info1 = Configure::read('TimeSlot');
		
		$labs = $this->Lab->find('list',array('fields'=>array('Lab.id','Lab.pcc_name')));

		$city = $this->City->find('list',array('fields'=>array('City.id','City.name')));
		$state = $this->State->find('list',array('fields'=>array('State.id','State.name')));
		$plab = $this->ProcessingLabs->find('list',array('fields'=>array('ProcessingLabs.id','ProcessingLabs.name')));
		
		$get_collection_time_info1 = $this->Timelabs->find('list',array('fields'=>array('Timelabs.id','Timelabs.name')));
		//print_R($plab);
		
		foreach($health_orders as $val)
		{
			$serviced_labs = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$val['healths']['assigned_lab'])));
			
			$billingdetail = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$val['healths']['id'])));
			
			$testIds = array();
			$sampleType = array();
			//print_R($val['healths']['test_id']);
			$t_ids = explode(',',$val['healths']['test_id']);
			$this->Test = ClassRegistry::init('Test');
            $tests = $this->Test->find('all',array('conditions'=>array('Test.id '=>$t_ids)));
			
			$fasting_required = "";
			
			foreach($tests as $test_val)
			{
				array_push($testIds,array('testId'=>$test_val['Test']['testcode'],'testName'=>$test_val['Test']['test_parameter'],'price'=>$test_val['Test']['mrp']));
				
				if($test_val['Test']['fasting_required']!="NO" || $test_val['Test']['fasting_required']!=NULL || $test_val['Test']['fasting_required']!=" ")
					$fasting_required = 'Fasting';
				$samples = $this->Samplemaster->find('all',array('conditions'=>array('Samplemaster.sample_id'=>$test_val['Test']['sample'])));
				//print_R($samples);die;
				foreach($samples as $sample_val)
				{
					array_push($sampleType,array('sampleId'=>$sample_val['Samplemaster']['sample_id'],'sampleType'=>$sample_val['Samplemaster']['type']));
				}
			}

			$p_ids = explode(',',$val['healths']['profile_id']);
			
            $profiles = $this->Test->find('all',array('conditions'=>array('Test.id '=>$p_ids)));
			
			$fasting_required = "";
			
			foreach($profiles as $test_val)
			{
				array_push($testRemarks,$test_val['Test']['test_parameter']);
				array_push($testIds,array('testId'=>$test_val['Test']['testcode'],'testName'=>$test_val['Test']['test_parameter'],'price'=>$test_val['Test']['mrp']));
				
				if($test_val['Test']['fasting_required']!="NO" || $test_val['Test']['fasting_required']!=NULL || $test_val['Test']['fasting_required']!=" ")
					$fasting_required = 'Fasting';
				$samples = $this->Samplemaster->find('all',array('conditions'=>array('Samplemaster.sample_id'=>$test_val['Test']['sample'])));
				//print_R($samples);die;
				foreach($samples as $sample_val)
				{
					array_push($sampleType,array('sampleId'=>$sample_val['Samplemaster']['sample_id'],'sampleType'=>$sample_val['Samplemaster']['type']));
				}
			}

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
				"testRemarks"=> $val['healths']['remarks'],
				"conditionStatus"=> $fasting_required,
				"closetCenter"=> $serviced_labs['Lab']['pcc_lab_value'],
				"distance"=> "0",
				"visitNo"=> $billingdetail['Billing']['order_id'],
				"collectionCharges"=> "0",
				"paymentType"=> $payment_type,
				"netAmount" => $val['healths']['total_amount'],
				"amountCollected" =>  $val['healths']['received_amount'],
				"amountToBeCollected"=> $val['healths']['total_amount'] - $val['healths']['recieved_amount'],
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
				$decoded_response = json_decode($response);
			  print_R($decoded_response);
			  echo "<br>";
			  print_R('update healths set requ_status=2,lab_message="Medimojo Id - '.$decoded_response->medimojoId.'" where id="'.$val['healths']['id'].'"');
			  $this->Health->query('update healths set requ_status=2,lab_message="Medimojo Id - '.$decoded_response->medimojoId.'" where id="'.$val['healths']['id'].'"');
			}
			echo "<br>";
			//die;
		}
	}

	function lis_payment_update($req_id=NULL,$check=NULL)
	{
		$mode = array('1'=>'cash','2'=>'cheque','3'=>'credit_card','4'=>'wallet');
		$this->Lab = ClassRegistry::init('Lab');
		$this->Admin = ClassRegistry::init('Admin');

		$admin_list = $this->Admin->find('list',array('fields'=>array('id','name')));

		$this->Health = ClassRegistry::init('Health');
		$healthData = $this->Health->find('first',array('conditions'=>array('Health.id'=>$req_id)));
		$lab_data = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$healthData['Health']['created_by'])));

		$this->Paytrack = ClassRegistry::init('Paytrack');
		$paytrackData="";

		if($check=="all"){
			$paytrackData = $this->Paytrack->find('all',array('conditions'=>array('Paytrack.request_id'=>$req_id,'Paytrack.type'=>'Receive')));
		}

		if($check=="one"){
			$paytrackData = $this->Paytrack->find('all',array('conditions'=>array('Paytrack.request_id'=>$req_id,'Paytrack.type'=>'Receive'),'limit'=>1,'order'=>array('Paytrack.id DESC')));
		}

		echo "<br>";
		$narration = "";
		foreach($paytrackData as $val)
		{
			if($val['Paytrack']['pay_mode'] == 'wallet'){
				$narration = 'Rs. '.$val['Paytrack']['pay_install'].' received through '.$val['Paytrack']['org_name'].' by '.$val['Paytrack']['pay_mode'].' on '.date('d-m-Y',strtotime($val['Paytrack']['receive_date']));
			}

			if($val['Paytrack']['pay_mode'] == 'cash'){
				$narration = 'Rs. '.$val['Paytrack']['pay_install'].' received by '.$admin_list[$val['Paytrack']['admin_id']].' through '.$val['Paytrack']['pay_mode'].' on '.date('d-m-Y',strtotime($val['Paytrack']['receive_date']));
			}

			if($val['Paytrack']['pay_mode'] == 'credit_card'){
				$narration = 'Rs. '.$val['Paytrack']['pay_install'].' received by '.$admin_list[$val['Paytrack']['admin_id']].' through '.$val['Paytrack']['pay_mode'].' ('.$val['Paytrack']['c_number'].')'.' on '.date('d-m-Y',strtotime($val['Paytrack']['receive_date']));
			}

			if($val['Paytrack']['pay_mode'] == 'cheque'){
				$narration = 'Rs. '.$val['Paytrack']['pay_install'].' received by '.$admin_list[$val['Paytrack']['admin_id']].' through '.$val['Paytrack']['pay_mode'].' ('.$val['Paytrack']['c_number'].')'.' on '.date('d-m-Y',strtotime($val['Paytrack']['receive_date']));
			}

			if(in_array($val['Paytrack']['pay_mode'],$mode))
			{
				$key = array_search($val['Paytrack']['pay_mode'],$mode);
				
				$credit = "";
				if($val['Paytrack']['pay_mode'] == "credit_card")
				{
					$credit = $val['Paytrack']['c_number'];
				}

				$cheque = "";
				if($val['Paytrack']['pay_mode'] == "cheque")
				{
					$cheque = $val['Paytrack']['c_number'];
				}
				
				$transaction = "";
				if($val['Paytrack']['pay_mode'] == "wallet")
				{
					$transaction = $val['Paytrack']['c_number'];
				}

				$data = array(
					"APIUser" => $lab_data['Lab']['api_user'],
					"APIKey" => $lab_data['Lab']['api_key'],
					"LabNo" => $healthData['Health']['ref_num'],
					"PaidAmount" => $val['Paytrack']['pay_install'],
					"PaymentType" => $key,
					"CreditCardNo" => $credit,
					"ChequeNo" => $cheque,
					"BankName" => $val['Paytrack']['remark'],
					"Narration" => $narration,
					"Transactionno" => $transaction
				);
			print_R(json_encode($data));
				echo "<br><br>";

				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "http://lis.niramayapathlabs.com/live/design/JSONReceive/PaymentSattlement.aspx",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => json_encode($data),
				  CURLOPT_HTTPHEADER => array(
				    "cache-control: no-cache",
				    "content-type: application/json"
				  ),
				));

				$response = curl_exec($curl);
				print_R($response);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
					$this->_activity_log($healthData,"Payment Updated in LIS");
				    $this->_json_data($healthData['Health']['id'],date('Y-m-d h:i:s'),"Payment Update for - ".$req_id,json_encode($data),$response);
				  	$this->Health->query('update healths set lab_message="Payment Updated in LIS for Order No. - '.$req_id.'" where id="'.$req_id.'"');
				  	print_R($response);
				}
			}
		}
		die;
	}	
}

?>
