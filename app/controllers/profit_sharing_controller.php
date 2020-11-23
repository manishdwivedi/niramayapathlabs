<?php
class ProfitSharingController extends AppController {

	var $name = 'ProfitSharing';
        var $uses=array('PaymentType');
        var $helpers = array('Form','Html','Javascript', 'Ajax','csv');
		var $components = array('Utility');
		
		
        function admin_index()
        {
            if($this->Session->read('Admin.userType') == 'A')
            {
                $this->Lab = ClassRegistry::init('Lab');
                $data = $this->Lab->find('all',array());
                $this->set('data',$data);
            }
            else
            {
                $this->redirect("/admin");
            }
        }

        function admin_save_profit_conf($pcc_id=null)
        {
            if($this->Session->read('Admin.userType') == 'A')
            {
                $this->ProfitShareConf = ClassRegistry::init('ProfitShareConf');
                if(!empty($this->data))
                {
                    if(empty($this->data['ProfitShareConf']['id']))
                    {
                        $this->ProfitShareConf->create();
                    }
                    if($this->ProfitShareConf->save($this->data))
                    {
                        $this->Session->setFlash("Record updated successfully");
                        $this->redirect(array('controller'=>'profit_sharing','action'=>'index','admin'=>true));
                    }
                }
                else
                {
                    if(isset($pcc_id) && !empty($pcc_id))
                    {
                        $this->Lab = ClassRegistry::init('Lab');
                        $this->set('pcc_id',base64_decode($pcc_id));
                        $lab_data = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>base64_decode($pcc_id))));
                        $this->set('lab_data',$lab_data);
                        $this->data = $this->ProfitShareConf->find('first',array('conditions'=>array('ProfitShareConf.lab_id'=>base64_decode($pcc_id))));
                    }
                    else
                    {
                        $this->redirect(array('controller'=>'profit_sharing','action'=>'index','admin'=>true));
                    }
                }
            }
            else
            {
                $this->redirect("/admin");
            }
        }

        //booked by profit sharing report
        function admin_booked_by()
        {
            $this->PaymentType = ClassRegistry::init('PaymentType');

            $p_type = $this->PaymentType->find('list',array('fields'=>array('PaymentType.id','PaymentType.type')));

            $this->set('p_type',$p_type);

            if(!empty($this->data))
            {
                
                $conditions = array();
                if(isset($this->data['BookedBy']['from_date']) && !empty($this->data['BookedBy']['from_date']))
                {
                        $conditions['Health.s_date >='] = date('Y-m-d',strtotime($this->data['BookedBy']['from_date']));
                }
                if(isset($this->data['BookedBy']['to_date']) && !empty($this->data['BookedBy']['to_date']))
                {
                        $conditions['Health.s_date <='] = date('Y-m-d',strtotime($this->data['BookedBy']['to_date']));
                }
                if(isset($this->data['BookedBy']['pcc_list_id']) && !empty($this->data['BookedBy']['pcc_list_id']))
                {
                        $conditions['Health.assigned_lab'] = $this->data['BookedBy']['pcc_list_id'];
                }
                if(isset($this->data['BookedBy']['pcc_list_id1']) && !empty($this->data['BookedBy']['pcc_list_id1']))
                {
                        $conditions['Health.created_by'] = $this->data['BookedBy']['pcc_list_id1'];
                }
                if(isset($this->data['BookedBy']['agent_list_id']) && !empty($this->data['BookedBy']['agent_list_id']))
                {
                        $conditions['Health.agent_id'] = $this->data['BookedBy']['agent_list_id'];
                }
                $conditions['Health.status'] = 1;
                $conditions['Health.sent_pathcorp'] = 1;
                $conditions['requ_status'] = array(5,6,7,9);
                //$conditions['assigned_lab !='] = 145;

                $this->Health = ClassRegistry::init('Health');
				$this->City = ClassRegistry::init('City');
				
                $this->Health->bindModel(array(
                    'hasOne'=>array(
                        'Billing'=>array(
                            'className'=>'Billing',
                            'foreignKey'=>'request_id',
                        )
                    )
                ));
                $all_record = $this->Health->find('all',array('conditions'=>$conditions));
                $summary = array('total_request'=>0,'total_test'=>0,'total_amount'=>0,'total_discount_amount'=>0,'total_net_payable'=>0,'total_received_amount'=>0,'total_balance_due'=>0,'gross_booked_income'=>0,'net_booked_income'=>0,'booking_income_percent'=>0);

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
                
                $this->Session->delete('Discount');
                for($i=0;$i<count($all_record);$i++)
                { 
                    $summary['total_request']++;
                    $total_amt_cond = $all_record[$i]['Health']['received_amount'] + $all_record[$i]['Health']['balance_amount'];
                    if($total_amt_cond == 0)
                        $total_amt_cond= $all_record[$i]['Health']['total_amount'];
                    $summary['total_net_payable'] += $total_amt_cond;

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
                        $test_detail = $this->Test->find('all',array('conditions'=>array('Test.id'=>$expl_test)));
                        
                        foreach($test_detail as $key5=>$value5)
                        {
                            $all_record[$i]['Health']['row_test_code'] .= $value5['Test']['testcode'].', ';
                        }
                        //$all_record[$i]['Health']['row_test_code'] = substr($all_record[$i]['Health']['row_test_code'],0,strlen($all_record[$i]['Health']['row_test_code'])-1);
                        
                        $test_code = $this->RequestTest->find('all',array('conditions'=>array('RequestTest.health_id'=>$all_record[$i]['Health']['id'],'RequestTest.test_id'=>$expl_test)));
                        
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
					/*discount#############*/
					if(isset($all_record[$i]['Health']['discount_id']) && !empty($all_record[$i]['Health']['discount_id']) && $all_record[$i]['Health']['discount_id'] > 0)
					{
						
						$all_record[$i]['Health']['discount_amount'] = $this->Utility->getDiscountAmountById($all_record[$i]['Health']['discount_id'],$all_record[$i]['Health']['row_test_amt']);
						
						$summary['total_discount_amount'] = $all_record[$i]['Health']['discount_amount'];
					}
					else
					{
						$summary['total_discount_amount'] += !empty($all_record[$i]['Health']['discount_amount'])?$all_record[$i]['Health']['discount_amount']:0;
					}
					/*end discount*/
					$city_name = $this->City->find('first',array('conditions'=>array('City.id'=>$all_record[$i]['Health']['city_id'])));
                    $all_record[$i]['Health']['city_name'] = $city_name['City']['name'];
					
                    $summary['total_amount'] = $summary['total_net_payable']+$summary['total_discount_amount'];
                    $summary['total_balance_due'] = $summary['total_net_payable'] - $summary['total_received_amount'];
                    if($all_record[$i]['Health']['row_gross_booked_by_income'] > 0)
                        $all_record[$i]['Health']['row_net_booked_by_income'] = $all_record[$i]['Health']['row_gross_booked_by_income'] - $all_record[$i]['Health']['discount_amount'];
                    $summary['gross_booked_income'] += $all_record[$i]['Health']['row_gross_booked_by_income'];
                }


                if($summary['gross_booked_income'] > 0)
                    $summary['net_booked_income'] = $summary['gross_booked_income'] - $summary['total_discount_amount'];
                $summary['booking_income_percent'] = round(($summary['gross_booked_income']*100)/$summary['total_amount'],2);

				
				
                $this->set('summary',$summary);
                $this->set('all_record',$all_record); 
                //excel generation
                if($this->data['BookedBy']['set_option'] == 'export_excel')
                {
                    $this->Lab = ClassRegistry::init('Lab');
                    $pcc_list = $this->Lab->find('list',array('conditions'=>array('Lab.status'=>1),'fields'=>array('Lab.id','Lab.pcc_name')));
                    $this->set('pcc_list',$pcc_list);

                    $this->Agent = ClassRegistry::init('Agent');
                    $agent_list = $this->Agent->find('list',array('conditions'=>array('Agent.status'=>1),'fields'=>array('id','name')));
                    $this->set('agent_list',$agent_list);

                    $this->render('booked_by_csv','exportexcel');
                    //$this->layout = '';
                    //exit;
                }
            }
            $this->Lab = ClassRegistry::init('Lab');
            $admin_lab_type = $this->Session->read('Admin.labType');
            $admin_u_type = $this->Session->read('Admin.userType');
            if(($admin_u_type != 'A') && ($admin_u_type != 'BM') && ($admin_u_type != 'Agent'))
            {
                    $pcc_list = $this->Lab->find('list',array('conditions'=>array('Lab.pcc_lab_value'=>$admin_lab_type),'fields'=>array('Lab.id','Lab.pcc_name')));
            }
            else
            {
                    $pcc_list = $this->Lab->find('list',array('conditions'=>array('Lab.status'=>1),'fields'=>array('Lab.id','Lab.pcc_name')));
            }
            
            $this->set('pcc_list',$pcc_list);
            $this->Agent = ClassRegistry::init('Agent');
            $agent_list = $this->Agent->find('list',array('conditions'=>array('Agent.status'=>1),'fields'=>array('id','name')));
            $this->set('agent_list',$agent_list);
            
        }

        //service by profit sharing report
        function admin_serviced_by()
        {
            if(!empty($this->data))
            {

                $conditions = array();
                if(isset($this->data['ServicedBy']['from_date']) && !empty($this->data['ServicedBy']['from_date']))
                {
                        $conditions['Health.s_date >='] = date('Y-m-d',strtotime($this->data['ServicedBy']['from_date']));
                }
                if(isset($this->data['ServicedBy']['to_date']) && !empty($this->data['ServicedBy']['to_date']))
                {
                        $conditions['Health.s_date <='] = date('Y-m-d',strtotime($this->data['ServicedBy']['to_date']));
                }
                if(isset($this->data['ServicedBy']['pcc_list_id']) && !empty($this->data['ServicedBy']['pcc_list_id']))
                {
                        $conditions['Health.assigned_lab'] = $this->data['ServicedBy']['pcc_list_id'];
                }
                if(isset($this->data['ServicedBy']['pcc_list_id1']) && !empty($this->data['ServicedBy']['pcc_list_id1']))
                {
                        $conditions['Health.created_by'] = $this->data['ServicedBy']['pcc_list_id1'];
                }
                if(isset($this->data['ServicedBy']['agent_list_id']) && !empty($this->data['ServicedBy']['agent_list_id']))
                {
                        $conditions['Health.agent_id'] = $this->data['ServicedBy']['agent_list_id'];
                }




                
                
                if(isset($this->data['ServicedBy']['agent_list_id']) && !empty($this->data['ServicedBy']['agent_list_id']))
                {
                        $conditions['Health.agent_id'] = $this->data['ServicedBy']['agent_list_id'];
                }
                $conditions['Health.status'] = 1;
                $conditions['Health.sent_pathcorp'] = 1;
                $conditions['requ_status'] = array(5,6,7,9);

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
                $summary = array('total_request'=>0,'total_test'=>0,'total_amount'=>0,'total_discount_amount'=>0,'total_net_payable'=>0,'total_received_amount'=>0,'total_balance_due'=>0,'gross_booked_income'=>0,'net_booked_income'=>0,'booking_income_percent'=>0);

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
                        $test_detail = $this->Test->find('all',array('conditions'=>array('Test.id'=>$expl_test)));

                        foreach($test_detail as $key5=>$value5)
                        {
                            $all_record[$i]['Health']['row_test_code'] .= $value5['Test']['testcode'].', ';
                        }
                        //$all_record[$i]['Health']['row_test_code'] = substr($all_record[$i]['Health']['row_test_code'],0,strlen($all_record[$i]['Health']['row_test_code'])-1);

                        $test_code = $this->RequestTest->find('all',array('conditions'=>array('RequestTest.health_id'=>$all_record[$i]['Health']['id'],'RequestTest.test_id'=>$expl_test)));

                        foreach($test_code as $key5=>$value5)
                        {
                            $all_record[$i]['Health']['row_test_amt'] += $value5['RequestTest']['mrp'];
                            foreach($test_detail as $key6=>$value6)
                            {
                                if(isset($pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Test']['profit_margin_category']]) && $pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Test']['profit_margin_category']] >0 && $value5['RequestTest']['test_id'] == $value6['Test']['id'])
                                $all_record[$i]['Health']['row_gross_booked_by_income'] += (($value5['RequestTest']['mrp']*$pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Test']['profit_margin_category']])/100);
                            }
                        }
                    }

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
                            $all_record[$i]['Health']['row_test_code'] .= $value5['Test']['testcode'].', ';
                        }
                        //$all_record[$i]['Health']['row_test_code'] = substr($all_record[$i]['Health']['row_test_code'],0,strlen($all_record[$i]['Health']['row_test_code'])-1);

                        $test_code = $this->RequestTest->find('all',array('conditions'=>array('RequestTest.health_id'=>$all_record[$i]['Health']['id'],'RequestTest.test_id'=>$expl_test,'RequestTest.type'=>'SR')));

                        foreach($test_code as $key5=>$value5)
                        {
                            $all_record[$i]['Health']['row_test_amt'] += $value5['RequestTest']['mrp'];
                            foreach($test_detail as $key6=>$value6)
                            {
                                if(isset($pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Test']['profit_margin_category']]) && $pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Test']['profit_margin_category']] >0 && $value5['RequestTest']['test_id'] == $value6['Test']['id'])
                                $all_record[$i]['Health']['row_gross_booked_by_income'] += (($value5['RequestTest']['mrp']*$pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Test']['profit_margin_category']])/100);
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
                                if(isset($pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Test']['profit_margin_category']]) && $pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Test']['profit_margin_category']] >0 && $value5['RequestTest']['test_id'] == $value6['Test']['id'])
                                $all_record[$i]['Health']['row_gross_booked_by_income'] += (($value5['RequestTest']['mrp']*$pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Test']['profit_margin_category']])/100);
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
                                if(isset($pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Banner']['profit_margin_category']]) && $pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Banner']['profit_margin_category']] >0 && $value5['RequestTest']['test_id'] == $value6['Banner']['id'])
                                $all_record[$i]['Health']['row_gross_booked_by_income'] += (($value5['RequestTest']['mrp']*$pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Banner']['profit_margin_category']])/100);
                            }
                        }
                    }
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
                                if(isset($pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Package']['profit_margin_category']]) && $pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Package']['profit_margin_category']] >0 && $value5['RequestTest']['test_id'] == $value6['Package']['id'])
                                $all_record[$i]['Health']['row_gross_booked_by_income'] += (($value5['RequestTest']['mrp']*$pcc_profit_list[$all_record[$i]['Health']['created_by']]['ProfitShareConf']['sb_'.$value6['Package']['profit_margin_category']])/100);
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
                    $summary['net_booked_income'] = $summary['gross_booked_income'] - $summary['total_balance_due'];
                    //$summary['net_booked_income'] = $summary['gross_booked_income'] - $summary['total_discount_amount'];
                $summary['booking_income_percent'] = round(($summary['gross_booked_income']*100)/$summary['total_amount'],2);

                $this->set('summary',$summary);
                $this->set('all_record',$all_record);
                //excel generation
                if($this->data['BookedBy']['set_option'] == 'export_excel')
                {
                    $this->Lab = ClassRegistry::init('Lab');
                    $pcc_list = $this->Lab->find('list',array('conditions'=>array('Lab.status'=>1),'fields'=>array('Lab.id','Lab.pcc_name')));
                    $this->set('pcc_list',$pcc_list);

                    $this->Agent = ClassRegistry::init('Agent');
                    $agent_list = $this->Agent->find('list',array('conditions'=>array('Agent.status'=>1),'fields'=>array('id','name')));
                    $this->set('agent_list',$agent_list);

                    $this->render('serviced_by_csv','exportexcel');
                    //$this->layout = '';
                    //exit;
                }
            }
            $this->Lab = ClassRegistry::init('Lab');
            $admin_lab_type = $this->Session->read('Admin.labType');
            $admin_u_type = $this->Session->read('Admin.userType');
            if(($admin_u_type != 'A') && ($admin_u_type != 'BM') && ($admin_u_type != 'Agent'))
            {
                    $pcc_list = $this->Lab->find('list',array('conditions'=>array('Lab.pcc_lab_value'=>$admin_lab_type),'fields'=>array('Lab.id','Lab.pcc_name')));
            }
            else
            {
                    $pcc_list = $this->Lab->find('list',array('conditions'=>array('Lab.status'=>1),'fields'=>array('Lab.id','Lab.pcc_name')));
            }

            $this->set('pcc_list',$pcc_list);
            $this->Agent = ClassRegistry::init('Agent');
            $agent_list = $this->Agent->find('list',array('conditions'=>array('Agent.status'=>1),'fields'=>array('id','name')));
            $this->set('agent_list',$agent_list);

        }
}
?>