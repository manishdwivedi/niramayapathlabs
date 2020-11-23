<?php
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
require "/home2/niramovh/lib/PHPMailer/class.phpmailer.php";
require "/home2/niramovh/lib/PHPMailer/class.smtp.php";
App::import('Vendor', '/fpdf/fpdf');
App::import('Vendor', '/fpdf/fpdi');

class PrescriptionController extends AppController
{
	var $name = "Prescription";

	var $breadcrumb = array();

	var $uses=array('FollowUpLog','PrescriptionMaster','LabMessageMaster','PaymentType','Ticket','ProcessingLabs','TicketTracking','PincodeMaster','Samplemaster','Healthsample','Page','Pagelocale','Locale','Test','Sample','City','Timelab','Health','User','Agent','Billing','Banner','State','Paytrack','Admin','Package','Lab','Vial','Discount','UserBmiBp','RequestTest','UserCollectionReport','ActivityLog','Api');

	var $helpers = array('Form','Html','Javascript', 'Ajax','Utility');

	public $components = array('RequestHandler','Cookie','Utility');

	public $paginate = array('maxLimit' => 10);

	public function admin_add_prescription()
	{
		$this->PrescriptionMaster = ClassRegistry::init('PrescriptionMaster');	
		if($this->data)
		{
			$uploadfile = array();
			if(!empty($_FILES))
			{
				$total = count($_FILES['prescription_url']['name']);
				for( $i=0 ; $i < $total ; $i++ ) {
				  $tmpFilePath = $_FILES['prescription_url']['tmp_name'][$i];
				  if ($tmpFilePath != ""){
					$newFilePath = "/home2/niramovh/test.niramayahealthcare.com/app/webroot/files/ticket/" . $_FILES['prescription_url']['name'][$i];
					if(move_uploaded_file($tmpFilePath, $newFilePath)) {
						array_push($uploadfile,$_FILES['prescription_url']['name'][$i]);
					}
				  }
				}
			}

			$this->PrescriptionMaster->create();
			$this->data['PrescriptionMaster']['prescription_id'] = 'P-'.strtotime(date('Y-m-d h:i:s'));
			$this->data['PrescriptionMaster']['first_name'] = $this->data['PrescriptionMaster']['first_name'];
			$this->data['PrescriptionMaster']['last_name'] = $this->data['PrescriptionMaster']['last_name'];
			$this->data['PrescriptionMaster']['gender'] = $this->data['PrescriptionMaster']['gender'];
			$this->data['PrescriptionMaster']['age'] = $this->data['PrescriptionMaster']['age'];
			$this->data['PrescriptionMaster']['date'] = date('Y-m-d h:i:s');
			$this->data['PrescriptionMaster']['contact_number'] = $this->data['PrescriptionMaster']['contact_number'];
			$this->data['PrescriptionMaster']['alternate_contact'] = $this->data['PrescriptionMaster']['alternate_contact'];
			$this->data['PrescriptionMaster']['mrn'] = $this->data['PrescriptionMaster']['mrn'];
			$this->data['PrescriptionMaster']['email'] = $this->data['PrescriptionMaster']['email'];
			$this->data['PrescriptionMaster']['estimate_reference'] = $this->data['PrescriptionMaster']['estimate_reference'];
			$this->data['PrescriptionMaster']['referred_by'] = $this->data['PrescriptionMaster']['referred_by'];
			$this->data['PrescriptionMaster']['prescription_url'] = implode("@@@@@",$uploadfile);
			$this->data['PrescriptionMaster']['remarks'] = $this->data['PrescriptionMaster']['remarks'];
			$this->data['PrescriptionMaster']['status'] = 2;
			$this->data['PrescriptionMaster']['order_type'] = 'Online';
			$this->data['PrescriptionMaster']['created_by'] = $this->data['PrescriptionMaster']['created_by'];
			$this->data['PrescriptionMaster']['tests'] = $this->data['PrescriptionMaster']['tests'];
			$this->data['PrescriptionMaster']['total_amount'] = $this->data['PrescriptionMaster']['total_amount'];
			$this->data['PrescriptionMaster']['discount_amount'] = $this->data['PrescriptionMaster']['discount_amount'];
			$this->data['PrescriptionMaster']['discount_amount_reason'] = $this->data['PrescriptionMaster']['discount_amount_reason'];
			
			
			if($this->PrescriptionMaster->save($this->data)){
				$last_prescription_id = $this->PrescriptionMaster->getLastInsertId();
				
				$new_url = $this->get_tiny_url(SITE_URL."home/book_estimate/".base64_encode($last_prescription_id));
				if($this->data['PrescriptionMaster']['order_type']=='Online')
				{
					$message = "Estimate for your submitted Prescription is - Rs ".$this->data['PrescriptionMaster']['total_amount'].". If you want to place the order kindly click - ".$new_url;
					if($this->data['PrescriptionMaster']['created_by']=='Home')
					{
						$this->__sms_message($this->data['PrescriptionMaster']['contact_number'],$message);
						$this->__sms_message($this->data['PrescriptionMaster']['alternate_contact'],$message);
						$this->send_message_whatsapp($this->data['PrescriptionMaster']['contact_number'],$message);
					}
					else
					{
						$this->__sms_message($this->data['PrescriptionMaster']['contact_number'],$message);
						$this->__sms_message($this->data['PrescriptionMaster']['alternate_contact'],$message);
						$this->send_message_whatsapp($this->data['PrescriptionMaster']['contact_number'],$message);
					}
					
					if(!empty($this->data['PrescriptionMaster']['email']))
					{
						$this->email_estimate(base64_encode($last_prescription_id),$this->data['PrescriptionMaster']['email'],$this->data['PrescriptionMaster']['first_name']." ".$this->data['PrescriptionMaster']['last_name']);
					}
				}
				
				$this->redirect(array('controller'=>'prescription','action'=>'index'));
			}
			else
			{
				
				$this->redirect(array('controller'=>'prescription','action'=>'index'));
			}
			
			
		}
		$list = $this->Lab->find('all',array('joins'=>array(array('table'=>'api_key','alias' => 'Labkey','conditions' => array('Labkey.pcc_id=Lab.id'))),'conditions'=>array('Lab.status'=>1)));
		$this->set('labList',$list);
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
	
	public function admin_index()
	{
		//print_R("Hello");die;
		$this->PrescriptionMaster = ClassRegistry::init('PrescriptionMaster');	
		$this->FollowUpLog = ClassRegistry::init('FollowUpLog');	
		
		if($this->data)
		{
			$conditions = array();
			//print_R($this->data);die;
			if(!empty($this->data['Filter']['req_from_date']))
			{
				$conditions['PrescriptionMaster.date >='] =  date('Y-m-d h:i:s',strtotime($this->data['Filter']['req_from_date']));
				$this->set('data_req_from_date',$this->data['Filter']['req_from_date']);
			}
			
			if(!empty($this->data['Filter']['req_to_date']))
			{
				$conditions['PrescriptionMaster.date <='] =  date('Y-m-d h:i:s',strtotime($this->data['Filter']['req_to_date']));
				$this->set('data_req_to_date',$this->data['Filter']['req_to_date']);
			}
			
			if(!empty($this->data['Filter']['follow_up_date']))
			{
				$conditions['FollowUpLog.date LIKE'] =  date('Y-m-d',strtotime($this->data['Filter']['follow_up_date']));
				$this->set('data_follow_up_date',$this->data['Filter']['follow_up_date']);
			}
			
			if(!empty($this->data['Filter']['req_status']))
			{
				$conditions['PrescriptionMaster.status '] =  $this->data['Filter']['req_status'];
				$this->set('req_status',$this->data['Filter']['req_status']);
			}
			
			if(!empty($this->data['Filter']['name']))
			{
				$conditions['PrescriptionMaster.first_name LIKE'] =  "%".$this->data['Filter']['name']."%";
				$this->set('name',$this->data['Filter']['name']);
			}
			
			if(!empty($this->data['Filter']['contact']))
			{
				$conditions['PrescriptionMaster.contact_number '] =  $this->data['Filter']['contact'];
				$this->set('contact',$this->data['Filter']['contact']);
			}
			
			if(!empty($this->data['Filter']['email']))
			{
				$conditions['PrescriptionMaster.email '] =  $this->data['Filter']['email'];
				$this->set('email',$this->data['Filter']['email']);
			}
			
			$this->paginate = array('PrescriptionMaster' => array(
									'conditions'=>$conditions,
									'joins'=>array(array(
										'alias' => 'FollowUpLog',
										'table' => 'follow_up_log',
										'type' => 'INNER',
										'conditions' => '`FollowUpLog`.`prescription_id` = `PrescriptionMaster`.`prescription_id`'
									)),
									'order'=>array('PrescriptionMaster.date'=>'DESC'),
									'limit' =>'20'
									));
		}
		else
		{
			$this->paginate = array('PrescriptionMaster' => array('limit' =>'20','order'=>array('PrescriptionMaster.date'=>'DESC')));
		}
		$prescription = $this->paginate('PrescriptionMaster');
		
		$this->FollowUpLog = ClassRegistry::init('FollowUpLog');	
		$timeslot = Configure::Read("TimeSlot");
		$count = 0;
		foreach($prescription as $key=>$val)
		{
			$followuplog = $this->FollowUpLog->find('first',array('conditions'=>array('FollowUpLog.prescription_id'=>$val['PrescriptionMaster']['prescription_id']),'order'=>array('FollowUpLog.id'=>'DESC')));
			$prescription[$count]['PrescriptionMaster']['follow_date'] = $followuplog['FollowUpLog']['date'];
			$prescription[$count]['PrescriptionMaster']['follow_time'] = $timeslot[$followuplog['FollowUpLog']['time']];
			$prescription[$count]['PrescriptionMaster']['follow_remarks'] = $followuplog['FollowUpLog']['remarks'];
			$count++;
		}
		//print_R($prescription);die;
		//die;
		$this->set('gender',array('1'=>'Male','2'=>'Female'));
		$this->set('status',array('1'=>'Estimate Requested','2'=>'Estimate Submitted','3'=>'Order Placed','4'=>'FollowUp - Cold','5'=>'FollowUp - Warm','6'=>'FollowUp - Hot','7'=>'In Cart'));
		
		$this->set('prescription',$prescription);
	}
	
	public function admin_edit_prescription($id="")
	{
		$this->PrescriptionMaster = ClassRegistry::init('PrescriptionMaster');	
		$prescription = $this->PrescriptionMaster->find('first',array('conditions'=>array('PrescriptionMaster.id'=>base64_decode($id))));
		if($this->data)
		{
			if($_POST['submit_type']=="edit" || $_POST['submit_type']=="save")
			{
				$this->PrescriptionMaster->create();
				$this->data1['PrescriptionMaster']['id'] = base64_decode($id);
				$this->data1['PrescriptionMaster']['first_name'] = $this->data['PrescriptionMaster']['first_name'];
				$this->data1['PrescriptionMaster']['last_name'] = $this->data['PrescriptionMaster']['last_name'];
				$this->data1['PrescriptionMaster']['gender'] = $this->data['PrescriptionMaster']['gender'];
				$this->data1['PrescriptionMaster']['age'] = $this->data['PrescriptionMaster']['age'];
				$this->data1['PrescriptionMaster']['date'] = $prescription['PrescriptionMaster']['date'];
				$this->data1['PrescriptionMaster']['contact_number'] = $this->data['PrescriptionMaster']['contact_number'];
				$this->data1['PrescriptionMaster']['alternate_contact'] = $this->data['PrescriptionMaster']['alternate_contact'];
				$this->data1['PrescriptionMaster']['mrn'] = $this->data['PrescriptionMaster']['mrn'];
				$this->data1['PrescriptionMaster']['email'] = $this->data['PrescriptionMaster']['email'];
				$this->data1['PrescriptionMaster']['estimate_reference'] = $this->data['PrescriptionMaster']['estimate_reference'];;
				$this->data1['PrescriptionMaster']['referred_by'] = $this->data['PrescriptionMaster']['referred_by'];
				$this->data1['PrescriptionMaster']['prescription_url'] = $prescription['PrescriptionMaster']['prescription_url'];
				$this->data1['PrescriptionMaster']['remarks'] = $this->data['PrescriptionMaster']['remarks'];
				$this->data1['PrescriptionMaster']['created_by'] = $this->data['PrescriptionMaster']['created_by'];// id of pcc will be here
				$this->data1['PrescriptionMaster']['status'] = 2;
				$this->data1['PrescriptionMaster']['tests'] = $this->data['PrescriptionMaster']['tests'];
				$this->data1['PrescriptionMaster']['total_amount'] = $this->data['PrescriptionMaster']['total_amount'];
				$this->data1['PrescriptionMaster']['discount_amount'] = $this->data['PrescriptionMaster']['discount_amount'];
				$this->data1['PrescriptionMaster']['discount_amount_reason'] = $this->data['PrescriptionMaster']['discount_amount_reason'];
				
				$this->PrescriptionMaster->save($this->data1);
				//print_R($this->data1);die;
				$subtotal = $this->data['PrescriptionMaster']['total_amount'] - $this->data['PrescriptionMaster']['discount_amount'];
				$new_url = $this->get_tiny_url(SITE_URL."home/book_estimate/".$id);
				//print_R($new_url);
				if($prescription['PrescriptionMaster']['order_type']=='Online')
				{
					$message = "Estimate for your submitted Prescription is - Rs ".$subtotal.". If you want to place the order kindly click - ".$new_url;
					if($this->data['PrescriptionMaster']['created_by']=='Home')
					{
						$this->__sms_message($this->data['PrescriptionMaster']['contact_number'],$message);
					}
					else
					{
						if($this->Utility->check_sms_enable_for_pcc($this->data['PrescriptionMaster']['created_by'],'estimate')==1)
						{
							$this->__sms_message($this->data['PrescriptionMaster']['contact_number'],$message);
						}
					}
					
					if(!empty($this->data['PrescriptionMaster']['email']))
					{
						$this->email_estimate($id,$this->data1['PrescriptionMaster']['email'],$this->data1['PrescriptionMaster']['first_name']." ".$this->data1['PrescriptionMaster']['last_name']);
					}
				}
			}
			else
			{
				$this->Session->write('estimate_data',$prescription);
				$this->redirect('/admin/prescription/add_request');
			}
			//print_R($this->data);
			
			//die;
		}
		else
		{
			$this->data = $prescription;
		}
		
		$timeslot = Configure::Read("TimeSlot");
		$this->set('timeslot',$timeslot);
		
		$this->FollowUpLog = ClassRegistry::init('FollowUpLog');	
		$followuplog = $this->FollowUpLog->find('all',array('conditions'=>array('FollowUpLog.prescription_id'=>$prescription['PrescriptionMaster']['prescription_id'])));
		$this->set('followuplog',$followuplog);
		
		$followup_status = array('4'=>'FollowUp - Cold','5'=>'FollowUp - Warm','6'=>'FollowUp - Hot');
		$this->LabMessageMaster = ClassRegistry::init('LabMessageMaster');
		$lab_mm = $this->LabMessageMaster->find('all',array('conditions'=>array('LabMessageMaster.request_id'=>$prescription['PrescriptionMaster']['prescription_id'])));
		$this->set('lab_mm',$lab_mm);
		$this->set('followup_status',$followup_status);
		//print_R($lab_mm);
		$list = $this->Lab->find('all',array('joins'=>array(array('table'=>'api_key','alias' => 'Labkey','conditions' => array('Labkey.pcc_id=Lab.id'))),'conditions'=>array('Lab.status'=>1)));
		$this->set('labList',$list);
	}
	
	function admin_estimate($id="")
	{
		//print_R($_POST);die;
		if(isset($_POST['message_estimate']))
		{
			if(preg_match('/^[0-9]{10}+$/', $_POST['estimate_number']))
			{
				$this->message_estimate($id,$_POST['estimate_number']);
			}
			else
			{
				$this->Session->setFlash('Unable to Send Estimate Message due to Invalid Number','flash_failure');
				$this->redirect('/admin/prescription/edit_prescription/'.$id);
			}
		}
		
		if(isset($_POST['email_estimate']))
		{
			//if (filter_var($_POST['sender'], FILTER_VALIDATE_EMAIL)) {
				$this->email_estimate($id,$_POST['estimate_email'],$_POST['estimate_name']);
			/*}
			else
			{
				$this->Session->setFlash('Unable to Send Estimate Email due to Invalid Email Id','flash_failure');
				$this->redirect('/admin/prescription/edit_prescription/'.$id);
			}*/
		}
	}
	
	function message_estimate($id,$number)
	{
		$this->PrescriptionMaster = ClassRegistry::init('PrescriptionMaster');	
		$prescription = $this->PrescriptionMaster->find('first',array('conditions'=>array('PrescriptionMaster.id'=>base64_decode($id))));
		
		$new_url = $this->get_tiny_url(SITE_URL."home/book_estimate/".$id);
		
		$message = "Estimate for your submitted Prescription is - Rs ".$prescription['PrescriptionMaster']['total_amount'].". If you want to place the order kindly click - ".$new_url;
		
		if($prescription['PrescriptionMaster']['created_by']=='Home')
		{
			$this->__sms_message($number,$message);
			$this->Session->setFlash('Estimate Message Sent','flash_success');
		}
		else
		{
			if($this->Utility->check_sms_enable_for_pcc($prescription['PrescriptionMaster']['created_by'],'estimate')==1)
			{
				$this->__sms_message($number,$message);
				$this->Session->setFlash('Estimate Message Sent','flash_success');
			}
		}
		$this->redirect('/admin/prescription/edit_prescription/'.$id);
	}
	
	function email_estimate($id,$email,$name)
	{
		$this->Lab = ClassRegistry::init('Lab');
		$this->Test = ClassRegistry::init('Test');
		$this->PrescriptionMaster = ClassRegistry::init('PrescriptionMaster');	
		$prescription = $this->PrescriptionMaster->find('first',array('conditions'=>array('PrescriptionMaster.id'=>base64_decode($id))));
		
		$lab_name = "";
		if($prescription['PrescriptionMaster']['created_by']=='Home')
		{
			$lab_name = 'nirAmaya Pathlabs';
		}
		else
		{
			$lab_info_created = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$prescription['PrescriptionMaster']['created_by'])));
			$lab_name = $lab_info_created['Lab']['pcc_name'];
		}
		
		$new_url = $this->get_tiny_url(SITE_URL."home/book_estimate/".$id);
		
		$testsid = explode(",",$prescription['PrescriptionMaster']['tests']);
		$test_data="";
		$count = 0;
		$total_amount = 0;
		foreach($testsid as $val)
		{
			$count++;
			$find_all_test = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
			$total_amount = $total_amount + $find_all_test['Test']['mrp'];
			$test_data .= "<tr><td>".$count.". ".$find_all_test['Test']['testcode']." - ".$find_all_test['Test']['test_parameter']." - ".$find_all_test['Test']['mrp']."</td></tr>";
		}
		
		$subtotal = $total_amount;
		$total_amount = $subtotal - $prescription['PrescriptionMaster']['discount_amount'];
		$mail = new PHPMailer();
		
		$mail->setFrom('info@niramayapathlabs.com', 'NirAmaya PathLabs');
		$mail->addAddress($email,$name);
		$mail->Subject = "Estimate Message From NirAmaya Pathlabs for Prescription Id - ".$prescription['PrescriptionMaster']['prescription_id'];
		$mail->Body = "<table width='600' border='0' cellspacing='0' cellpadding='0' align='left'>
							<tr>
								<td>
									Dear ".$prescription['PrescriptionMaster']['first_name']." ".$prescription['PrescriptionMaster']['last_name']."
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									Prescription Id - ".$prescription['PrescriptionMaster']['prescription_id']."
								</td>
							</tr>
							<tr>
								<td>
									Name - ".$prescription['PrescriptionMaster']['first_name']." ".$prescription['PrescriptionMaster']['last_name']."
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							".$test_data."
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									Subtotal - ".$subtotal."
								</td>
							</tr>
							<tr>
								<td>
									Discount Amount - ".$prescription['PrescriptionMaster']['discount_amount']."
								</td>
							</tr>
							<tr>
								<td>
									Total Amount - ".$total_amount."
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									In case, you want to book click the link given below:-
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									".$new_url."
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
									"; 
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
			//$this->_activity_log($req_info['Health']['user_id'], $req_info['Health']['id'], 'report mail not sent');
			//echo " Estimate Email not sent. " , $mail->ErrorInfo , PHP_EOL;
			$this->Session->setFlash('Unable to send Email','flash_failure');
		} else {
			//$this->_activity_log($req_info['Health']['user_id'], $req_info['Health']['id'],'lab message mail sent');	
			//echo "Estimate Email sent!" , PHP_EOL;
			$this->Session->setFlash('Estimate Email Sent','flash_success');
		}
		$this->redirect('/admin/prescription/edit_prescription/'.$id);
		
	}
	
	function get_tiny_url($url)  {  
		$ch = curl_init();  
		$timeout = 5;  
		curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
		$data = curl_exec($ch);  
		curl_close($ch);  
		return $data;  
	}
	
	function admin_get_all_test_detail()
	{
		$testsid = explode(",",$_POST['test_id']);
		$count=0;
		$total_amount = 0;
		$g=0;
		$rep_div = '';
		$rep_div .='<td width="15%" class="boldText">Selected Test(s)</td>';
		$rep_div .='<td id="selected_test_desc">';
		$rep_div .='<table border="0" width="100%" style="margin:-8px 0 0 0;">';
		foreach($testsid as $val)
		{
			$this->Test = ClassRegistry::init('Test');
			$find_all_test = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
			$g++;
			$rep_div .='<tr id="selected'.$find_all_test['Test']['id'].'">';
			$rep_div .='<td>';
			$rep_div .=$g.'- '.$find_all_test['Test']['testcode'].' - '.$find_all_test['Test']['test_parameter'].' - Rs.'.$find_all_test['Test']['mrp'].'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_test('.$find_all_test['Test']['id'].','.$find_all_test['Test']['mrp'].');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
			$rep_div .='</td>';
			$rep_div .='</tr>';
			
			$total_amount += $find_all_test['Test']['mrp'];
			$count++;
		}
		$rep_div .='</table>';
		$rep_div .='</td>';
		
		$m['test_count'] = $count;
		$m['test_info'] = $rep_div;
		$m['total_mrp'] = $total_amount;
		echo json_encode($m);
		exit;
	}
	
	function admin_add_request()
	{
		$sessionData = $this->Session->read('estimate_data');
		
        $this->Admin = ClassRegistry::init('Admin');
        $agents_booked = $this->Admin->find('list',array('conditions'=>array('Admin.status'=>1)));
        $this->set('agents_booked',$agents_booked);

		$usertype = $this->Session->read('Admin.userType');
		$userlab = $this->Session->read('userlab');
		$this->set('usertype',$usertype);
		$this->set('title_for_layout','Add Sample');
		$login_type = $this->Session->read('Admin.userType');
        	if($login_type == 'A')
		{
			$this->set('LoginType','Super');
		}
		elseif($login_type == 'Agent')
		{
			$this->set('LoginType','Agent');
		}
		elseif($login_type == 'BM')
		{
			$this->set('LoginType','BM');
		}
		else
		{
			$this->set('LoginType','PCC');
		}
                
		if(!empty($this->data))
			{
				
//				print_R($sessionData);die;
			$this->data['Health']['status'] = 1;
			if(!empty($this->data['Health']['test_id']))
			{
				$implode = $this->data['Health']['test_id'];
			}
			else
			{
				$implode = '';
			}
			
			if(!empty($this->data['Health']['profile_id']) && isset($this->data['Health']['profile_id']))
			{
				$implode_profile = $this->data['Health']['profile_id'];
			}
			else
			{
				$implode_profile = '';
			}

			if(!empty($this->data['Health']['offer_id']) && isset($this->data['Health']['offer_id']))
			{
				$implode_offer = $this->data['Health']['offer_id'];
			}
			else
			{
				$implode_offer = '';
			}

			if(!empty($this->data['Health']['package_id']) && isset($this->data['Health']['package_id']))
			{
				$implode_package = $this->data['Health']['package_id'];
			}
			else
			{
				$implode_package = '';
			}

			if(!empty($this->data['Health']['service_id']) && isset($this->data['Health']['service_id']))
			{
				$implode_service = $this->data['Health']['service_id'];
			}
			else
			{
				$implode_service = '';
			}

			$this->data['Health']['test_id'] = $implode;
			$this->data['Health']['profile_id'] = $implode_profile;
			$this->data['Health']['offer_id'] = $implode_offer;
			$this->data['Health']['package_id'] = $implode_package;
			$this->data['Health']['service_id'] = $implode_service;

			$amt_t = 0;

			if(!empty($this->data['Health']['test_id']))
			{
                            $amt_tst = $this->Test->find('all',array('fields'=>array('Test.id','Test.mrp'),'conditions'=>array('Test.id'=>explode(',',$this->data['Health']['test_id']))));
                            foreach($amt_tst as $k => $v)
                            {
                                $amt_t = $amt_t + $v['Test']['mrp'];
                                
                            }

			}
                        //for profile
                        if(!empty($this->data['Health']['profile_id']))
			{
                            $amt_tst = $this->Test->find('all',array('fields'=>array('Test.id','Test.mrp'),'conditions'=>array('Test.id'=>explode(',',$this->data['Health']['profile_id']))));
                            foreach($amt_tst as $k => $v)
                            {
                                $amt_t = $amt_t + $v['Test']['mrp'];

                            }

			}
                        //for offer
                        if(!empty($this->data['Health']['offer_id']))
			{
                            $amt_tst = $this->Banner->find('all',array('fields'=>array('Banner.id','Banner.banner_mrp'),'conditions'=>array('Banner.id'=>explode(',',$this->data['Health']['offer_id']))));
                            
                            foreach($amt_tst as $k => $v)
                            {
                                $amt_t = $amt_t + $v['Banner']['banner_mrp'];

                            }

			}
                        //for package
                        if(!empty($this->data['Health']['package_id']))
			{
                            $amt_tst = $this->Package->find('all',array('fields'=>array('Package.id','Package.package_mrp'),'conditions'=>array('Package.id'=>explode(',',$this->data['Health']['package_id']))));
                            
                            foreach($amt_tst as $k => $v)
                            {
                                $amt_t = $amt_t + $v['Package']['package_mrp'];

                            }

			}
                        //for service
                        if(!empty($this->data['Health']['service_id']))
			{
                            $amt_tst = $this->Test->find('all',array('fields'=>array('Test.id','Test.mrp'),'conditions'=>array('Test.id'=>explode(',',$this->data['Health']['service_id']))));
                            foreach($amt_tst as $k => $v)
                            {
                                $amt_t = $amt_t + $v['Test']['mrp'];

                            }

			}

			$this->data['Health']['total_amount'] = $amt_t;

            
			if(!empty($this->data['Health']['discount']))

			{

				$find_discount = $this->Discount->find('first',array('conditions'=>array('Discount.discount_code'=>$this->data['Health']['discount'],'Discount.status'=>1)));

				if(!empty($find_discount))

				{

					$get_type = $find_discount['Discount']['type'];

					if($get_type == 'Percent')

					{

						$value_1 = ($find_discount['Discount']['amount']/100);

						$value_2 = ($value_1*$this->data['Health']['total_amount']);

						$value_3 = ($this->data['Health']['total_amount']-$value_2);

						if($this->data['Health']['discount'] == 'Comp100')

						{

							$this->data['Health']['total_amount'] = round($value_3);

							$this->data['Health']['received_amount'] = $this->data['Health']['total_amount'];

						}

						else

						{

							$this->data['Health']['total_amount'] = round($value_3);

						}

						$this->data['Health']['discount_id'] = $find_discount['Discount']['id'];

					}

					if($get_type == 'Rupees')

					{

						$value_3 = ($this->data['Health']['total_amount']-$find_discount['Discount']['amount']);

						$this->data['Health']['total_amount'] = round($value_3);

						$this->data['Health']['discount_id'] = $find_discount['Discount']['id'];

					}

				}

			}

			//24 Sep 2013 Ends



			if(!empty($this->data['Health']['discount_amount']))

			{

				//echo $this->data['Health']['total_amount']; exit;

				$value_3 = ($this->data['Health']['total_amount']-$this->data['Health']['discount_amount']);

				$this->data['Health']['total_amount'] = $value_3;

				$this->data['Health']['discount_amount'] = $this->data['Health']['discount_amount'];

			}

			$this->data['Health']['balance_amount'] = $this->data['Health']['total_amount'];

			if(empty($this->data['Health']['discount_amount']))

			{

				$this->data['Health']['discount_amount'] = 0;

			}



			if(empty($this->data['Health']['created_by']))
                            $this->data['Health']['created_by']=$this->Session->read('Admin.labId');
                        if(isset($this->data['Health']['created_by_agent']) && !empty($this->data['Health']['created_by_agent']))
                        {

                        }
                        elseif($this->Session->check('Admin.id'))
                        {
                            $this->data['Health']['created_by_agent'] = $this->Session->read('Admin.id');
                        }
			/*if book by BM set lab id 31*/
			if(empty($this->data['Health']['created_by']))
				$this->data['Health']['created_by']=31;			
                            
            $this->data['Health']['processing_lab']=1;	                        

			if($this->Health->create($this->data))

			{

				$this->data['Health']['agent_id'] = 0;

				//$this->data['Health']['user_id'] = 0;

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

				$this->data['Health']['prescription_url'] = $sessionData['PrescriptionMaster']['prescription_url'];
				
				if($this->data['Health']['city'] != '')

				{

					$this->data['Health']['city_id'] = 0;

					$this->data['Health']['assigned_lab'] = $this->data['Health']['city'];

					if(empty($this->data['Health']['user_id']))

					{

						$city_v = $this->data['Health']['city'];

						$state_v = $this->data['Health']['state'];

						$locality_v = $this->data['Health']['locality'];

						$pincode_v = $this->data['Health']['pincode'];

						$landmark_v = $this->data['Health']['landmark'];

						$this->data['Health']['address'] = '';

						$this->data['Health']['locality'] = '';

						$this->data['Health']['city_id'] = 0;

						$this->data['Health']['state'] = 0;

						$this->data['Health']['pincode'] = '';

						$this->data['Health']['landmark'] = '';

					}

					$this->data['Health']['visit_pat_city'] = $this->data['Health']['city'];

					$this->data['Health']['s_date'] = date('Y-m-d',strtotime($this->data['Health']['sample_date']));

					$this->data['Health']['requ_status'] = 0;

					$this->data['Health']['requ_type'] = 'visit_lab';

				}

				if(!empty($this->data['Health']['sample_time1']) && !empty($this->data['Health']['sample_date1']))

				{

					$city_v = $this->data['Health']['same_city'];

					$state_v = $this->data['Health']['same_state'];

					$locality_v = $this->data['Health']['same_locality'];

					$pincode_v = $this->data['Health']['same_pincode'];

					$landmark_v = $this->data['Health']['same_landmark'];

					$this->data['Health']['assigned_lab'] = 'Home';

					if(!empty($this->data['Health']['same_address1']) && empty($this->data['Health']['same_address2']))

					{

						$this->data['Health']['address'] = $this->data['Health']['same_address1'];

					}

					if(!empty($this->data['Health']['same_address1']) && !empty($this->data['Health']['same_address2']))

					{

						$this->data['Health']['address'] = $this->data['Health']['same_address1'].'*'.$this->data['Health']['same_address2'];

					}

					$this->data['Health']['locality'] = $this->data['Health']['same_locality'];

					$this->data['Health']['city_id'] = $this->data['Health']['same_city'];

					$this->data['Health']['state'] = $this->data['Health']['same_state'];

					$this->data['Health']['pincode'] = $this->data['Health']['same_pincode'];

					$this->data['Health']['landmark'] = $this->data['Health']['same_landmark'];

					$this->data['Health']['s_date'] = date('Y-m-d',strtotime($this->data['Health']['sample_date1']));

					$this->data['Health']['visit_pat_city'] = $this->data['Health']['same_city'];

					$this->data['Health']['requ_status'] = 0;

					$this->data['Health']['requ_type'] = 'home_collection';

				}

				if(isset($this->data['Health']['old_home_report']) && $this->data['Health']['old_home_report'] == 0)

				{

					if($this->data['Health']['home_report'] == 1)

					{

						$find_tot_amt = $this->Health->find('first',array('conditions'=>array('Health.id'=>$this->data['Health']['id'])));

						$new_tot_amt = ($find_tot_amt['Health']['total_amount']+50);

						$update_tot_amt = $this->Health->query("UPDATE healths SET total_amount='".$new_tot_amt."' WHERE id='".$this->data['Health']['id']."'");

					}

				}

				if(isset($this->data['Health']['old_home_report']) && $this->data['Health']['old_home_report'] == 1)

				{

					if($this->data['Health']['home_report'] == 0)

					{

						$find_tot_amt = $this->Health->find('first',array('conditions'=>array('Health.id'=>$this->data['Health']['id'])));

						$new_tot_amt = ($find_tot_amt['Health']['total_amount']-50);

						$update_tot_amt = $this->Health->query("UPDATE healths SET total_amount='".$new_tot_amt."' WHERE id='".$this->data['Health']['id']."'");

					}

				} 

				if(empty($this->data['Health']['old_home_report']))

				{

					if($this->data['Health']['home_report'] == 1)

					{

						$this->data['Health']['total_amount'] = ($this->data['Health']['total_amount']+50);

					}

				}
				
				$this->data['Health']['amount_to_be_collected'] = $this->data['Health']['total_amount'];
				$this->data['Health']['amount_collected'] = '0';
				$this->data['Health']['payment_type'] = '3';
				
				if(empty($this->data['Health']['s_date']) || $this->data['Health']['s_date']=='1970-01-01')
                                {
                                    $this->data['Health']['s_date'] = date('Y-m-d');
                                }
								
				if($this->Health->save($this->data,false))

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

					if(!empty($explode_profile_ids_db[0]))

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

					if(!empty($explode_offer_ids_db[0]))

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

					if(!empty($explode_package_ids_db[0]))

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

					if(!empty($explode_service_ids_db[0]))

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


                                        if(isset($this->data['Health']['discount_id']) && !empty($this->data['Health']['discount_id']))
                                        {
                                            $get_use_time_type = $this->Discount->find('first',array('conditions'=>array('Discount.id'=>$this->data['Health']['discount_id'])));

                                            if($get_use_time_type['Discount']['use_time'] == 1)

                                            {

                                                    $update_disc_status = $this->Discount->query("UPDATE discounts SET used_status='1' WHERE id='".$this->data['Health']['discount_id']."'");

                                            }
                                        }
					



					$someOneArray = array();

					$someOneArray['Health']['name'] = strtoupper($this->data['Health']['name']);

					if($this->data['Health']['gender'] == 1)

					{

						$someOneArray['Health']['gender'] = 'Male';

					}

					if($this->data['Health']['gender'] == 2)

					{

						$someOneArray['Health']['gender'] = 'Female';

					}



					if(!empty($implode))

					{
                                                $find_test_name = $this->Test->find('all',array('conditions'=>array('Test.id'=>explode(',',$implode))));
                                                $someOneArray['Health']['test_id']="";
                                                foreach($find_test_name as $key=>$value)
                                                {
                                                    $someOneArray['Health']['test_id'] .= $value['Test']['testcode'].' - '.$value['Test']['test_parameter'].' - Rs.'.$value['Test']['mrp'].',';
                                                }
                                                $someOneArray['Health']['test_id']=substr($someOneArray['Health']['test_id'],0,strlen($someOneArray['Health']['test_id'])-1);
					}


					if(!empty($implode_profile))

					{
                                            $find_profile_name = $this->Test->find('all',array('conditions'=>array('Test.id'=>explode(',',$implode_profile))));
                                            $someOneArray['Health']['profile_id']="";
                                            foreach($find_profile_name as $key=>$value)
                                            {
                                                $someOneArray['Health']['profile_id'] .= $value['Test']['testcode'].' - '.$value['Test']['test_parameter'].' - Rs.'.$value['Test']['mrp'].',';
                                            }
                                            $someOneArray['Health']['profile_id']=substr($someOneArray['Health']['profile_id'],0,strlen($someOneArray['Health']['profile_id'])-1);
                                        }
                                        
					if(!empty($implode_offer))
					{
                                            $find_offer_name = $this->Banner->find('all',array('conditions'=>array('Banner.id'=>explode(',',$implode_offer))));
                                            $someOneArray['Health']['offer_id']="";
                                            foreach($find_offer_name as $key=>$value)
                                            {
                                                $someOneArray['Health']['offer_id'] .= $value['Banner']['banner_code'].' - '.$value['Banner']['banner_name'].' - Rs.'.$value['Banner']['banner_mrp'].',';
                                            }
                                            $someOneArray['Health']['offer_id']=substr($someOneArray['Health']['offer_id'],0,strlen($someOneArray['Health']['offer_id'])-1);
					}

					if(!empty($implode_package))
					{
                                            $find_package_name = $this->Package->find('all',array('conditions'=>array('Package.id'=>explode(',',$implode_package))));
                                            $someOneArray['Health']['package_id']="";
                                            foreach($find_package_name as $key=>$value)
                                            {
                                                $someOneArray['Health']['package_id'] .= $value['Package']['package_name'].' - Rs.'.$value['Package']['package_mrp'].',';
                                            }
                                            $someOneArray['Health']['package_id']=substr($someOneArray['Health']['package_id'],0,strlen($someOneArray['Health']['package_id'])-1);

					}

					if(!empty($implode_service))
					{
                                            $find_service_name = $this->Test->find('all',array('conditions'=>array('Test.id'=>explode(',',$implode_service))));
                                            $someOneArray['Health']['service_id']="";
                                            foreach($find_service_name as $key=>$value)
                                            {
                                                $someOneArray['Health']['service_id'] .= $value['Test']['testcode'].' - '.$value['Test']['test_parameter'].' - Rs.'.$value['Test']['mrp'].',';
                                            }
                                            $someOneArray['Health']['service_id']=substr($someOneArray['Health']['service_id'],0,strlen($someOneArray['Health']['service_id'])-1);
                        
						                }
										
					$timeslot = configure::read("TimeSlot");
					
					$someOneArray['Health']['sample_time'] = $timeslot[$this->data['Health']['sample_time']];
					
					$someOneArray['Health']['sample_time1'] = $timeslot[$this->data['Health']['sample_time1']];
				
					if(!empty($this->data['Health']['same_address1']) && empty($this->data['Health']['same_address2']))

					{

						$someOneArray['Health']['address'] = $this->data['Health']['same_address1'];

					}

					if(!empty($this->data['Health']['same_address1']) && !empty($this->data['Health']['same_address2']))

					{

						$someOneArray['Health']['address'] = $this->data['Health']['same_address1'].'*'.$this->data['Health']['same_address2'];

					}

					if(!empty($this->data['Health']['same_locality']))

					{

						$someOneArray['Health']['locality'] = $this->data['Health']['same_locality'];

					}

					if(!empty($this->data['Health']['same_city']))

					{

						$city_name = $this->City->find('first',array('conditions'=>array('City.id'=>$this->data['Health']['same_city'])));

						$someOneArray['Health']['city_id'] = $city_name['City']['name'];

					}

					if(!empty($this->data['Health']['same_state']))

					{

						$state_name = $this->State->find('first',array('conditions'=>array('State.id'=>$this->data['Health']['same_state'])));

						$someOneArray['Health']['state'] = $state_name['State']['name'];

					}

					if(!empty($this->data['Health']['same_pincode']))

					{

						$someOneArray['Health']['pincode'] = $this->data['Health']['same_pincode'];

					}

					if(!empty($this->data['Health']['same_landmark']))

					{

						$someOneArray['Health']['landmark'] = $this->data['Health']['same_landmark'];

					}



					if(empty($this->data['Health']['same_address1']) && empty($this->data['Health']['same_address2']))

					{

						if(!empty($this->data['Health']['address1']) && empty($this->data['Health']['address2']))

						{

							$someOneArray['Health']['address'] = $this->data['Health']['address1'];

						}

						if(!empty($this->data['Health']['address1']) && !empty($this->data['Health']['address2']))

						{

							$someOneArray['Health']['address'] = $this->data['Health']['address1'].'*'.$this->data['Health']['address2'];

						}

					}

					if(empty($this->data['Health']['same_locality']))

					{

						$someOneArray['Health']['locality'] = $this->data['Health']['locality'];

					}

					if(empty($this->data['Health']['same_city']))

					{

						$city_name2 = $this->City->find('first',array('conditions'=>array('City.id'=>$this->data['Health']['city_id'])));

						$someOneArray['Health']['city_id'] = $city_name2['City']['name'];

					}

					if(empty($this->data['Health']['same_state']))

					{

						$state_name2 = $this->State->find('first',array('conditions'=>array('State.id'=>$this->data['Health']['state'])));

						$someOneArray['Health']['state'] = $state_name2['State']['name'];

					}

					if(empty($this->data['Health']['same_pincode']))

					{

						$someOneArray['Health']['pincode'] = $this->data['Health']['pincode'];

					}

					if(empty($this->data['Health']['same_landmark']))

					{

						$someOneArray['Health']['landmark'] = $this->data['Health']['landmark'];

					}


					$someOneArray['Health']['age'] = $this->data['Health']['age'];

					$someOneArray['Health']['email'] = $this->data['Health']['email'];

					$someOneArray['Health']['landline'] = $this->data['Health']['landline'];

					$someOneArray['Health']['remark'] = $this->data['Health']['remark'];

					$someOneArray['Health']['city'] = $this->data['Health']['city'];

					$someOneArray['Health']['sample_date'] = $this->data['Health']['sample_date'];

					$someOneArray['Health']['sample_date1'] = $this->data['Health']['sample_date1'];



					//echo "<pre>"; print_r($this->data); exit;

					$this->set('mailContent' , $someOneArray );

					$this->Email->template = 'home_collection2';

					$this->Email->from = $this->data['Health']['email'];

					$this->Email->fromName = strtoupper($this->data['Health']['name']);

					$this->Email->subject = 'Booking Request Test ';

					if($this->data['Health']['city'] != '')

					{

						$get_email_info = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$this->data['Health']['city'])));

						$this->Email->to = $get_email_info['Lab']['pcc_email'];

					}

					//if($this->data['Health']['city'] == 'Indirapuram')

					//{

					//$this->Email->to = 'indirapuramlab@niramayahealthcare.com,bookatest@niramayahealthcare.com,itcombinetesting@gmail.com';

					//$this->Email->to = 'nisha.kathait@gmail.com';

					//}

					if($this->data['Health']['city'] == '')

					{



						$this->Email->to = 'homecollection@niramayahealthcare.com,bookatest@niramayahealthcare.com';

						//$this->Email->to = 'tripathi.ashish2007@gmail.com';

					}

					//if($this->data['Health']['city'] == 'Noida')

					//{

					//$this->Email->to = 'sector31noida@niramayahealthcare.com,bookatest@niramayahealthcare.com,itcombinetesting@gmail.com';

					//$this->Email->to = 'surbhi.tandon07@gmail.com';

					//}

					//Send as 'html', 'text' or 'both' (default is 'text')

					$this->Email->sendAs = 'html'; // because we like to send pretty mail

					$this->Email->delivery = 'mail';

/*					if($this->Email->send())
					{*/
						if($this->data['Health']['user_id'] == 0)
						{
							$explode_name = explode(' ',$this->data['Health']['name']);

							$username = strtolower($explode_name[0]).mt_rand(1000,9999);;

							$pass2 = substr(strtolower($explode_name[0]),0,1);

							$pass3 = substr($this->data['Health']['landline'],-4,4);

							$password = $pass2.$pass3;



							$this->data['User']['username'] = $username;

							if(!empty($this->data['Health']['email']))
							{
								$this->data['User']['email'] = $this->data['Health']['email'];
							}
							else
							{
								$this->data['User']['email'] = '';
							}
							
							$this->data['User']['passwd'] = $password;

							$this->data['User']['status'] = 1;

							$explode_name = explode(' ',$this->data['Health']['name']);

							$this->data['User']['name'] = strtoupper($this->data['Health']['name']);

							$this->data['User']['first_name'] = $explode_name[0];

							if(!empty($explode_name[1]))
							{
								$this->data['User']['last_name'] = $explode_name[1];
							}

							else

							{

								$this->data['User']['last_name'] = '';

							}

							$this->data['User']['gender'] = $this->data['Health']['gender'];

							$this->data['User']['age'] = $this->data['Health']['age'];

							$this->data['User']['contact'] = trim($this->data['Health']['landline']);
							
							if(!empty($this->data['Health']['alternate_email']))
							{
								$this->data['User']['alternate_email'] = $this->data['Health']['alternate_email'];
							}
							else
							{
								$this->data['User']['alternate_email'] = '';
							}
							
							if(!empty($this->data['Health']['alternate_contact']))
							{
								$this->data['User']['alternate_contact'] = $this->data['Health']['alternate_contact'];
							}
							else
							{
								$this->data['User']['alternate_contact'] = '';
							}
							
							if(!empty($this->data['Health']['address1']) && empty($this->data['Health']['address2']))

							{

								$this->data['User']['address'] = $this->data['Health']['address1'];

							}

							if(!empty($this->data['Health']['address1']) && !empty($this->data['Health']['address2']))

							{

								$this->data['User']['address'] = $this->data['Health']['address1'].'*'.$this->data['Health']['address2'];

							}

							$this->data['User']['locality'] = $locality_v;

							$this->data['User']['city'] = $city_v;

							$this->data['User']['state'] = $state_v;

							$this->data['User']['pincode'] = $pincode_v;

							$this->data['User']['landmark'] = $landmark_v;
                                                        $this->data['User']['created_by']=$this->Session->read('Admin.labId');


							if($this->User->create($this->data))

							{

								if($this->User->save($this->data,false))

								{

									$last_user_id = $this->User->getLastInsertId();



									//Code For Inserting BMI value Starts

									if($this->data['Health']['select_bmi_opt'] == 1)

									{

										$pat_weight = $this->data['Health']['pat_weight'];

										$pat_height_feet = $this->data['Health']['pat_height_feet'];

										$pat_height_inch = $this->data['Health']['pat_height_inch'];



										$pat_height_feet_in_meter = ($pat_height_feet*0.3048);

										$pat_height_inch_in_meter = ($pat_height_inch*0.0254);



										$pat_height_in_meter = ($pat_height_feet_in_meter+$pat_height_inch_in_meter);



										$square_of_height_in_meter = ($pat_height_in_meter*$pat_height_in_meter);

										$bmi_of_pat = ($pat_weight/$square_of_height_in_meter);



										$this->data['Health']['pat_height_cms'] = 0;

									}

									if($this->data['Health']['select_bmi_opt'] == 2)

									{

										$pat_weight = $this->data['Health']['pat_weight'];

										$pat_height_feet_in_cm = $this->data['Health']['pat_height_cms'];



										$pat_height_in_meter = ($pat_height_feet_in_cm*0.01);

										$square_of_height_in_meter = ($pat_height_in_meter*$pat_height_in_meter);

										$bmi_of_pat = ($pat_weight/$square_of_height_in_meter);



										$this->data['Health']['pat_height_feet'] = 0;

										$this->data['Health']['pat_height_inch'] = 0;

									}



									if($bmi_of_pat < 18.5){$bmi_indicator = 'Underweight';}

									if($bmi_of_pat > 18.5 && $bmi_of_pat < 24.0){$bmi_indicator = 'Healthy';}

									if($bmi_of_pat > 24.0 && $bmi_of_pat < 29.0){$bmi_indicator = 'Overweight';}

									if($bmi_of_pat > 29.0 && $bmi_of_pat < 39.0){$bmi_indicator = 'Obese';}

									if($bmi_of_pat > 39.0){$bmi_indicator = 'Externely Obese';}



									if(!empty($this->data['Health']['pat_bp_time_hr']) && !empty($this->data['Health']['pat_bp_time_sec']))

									{

										$time_value = $this->data['Health']['pat_bp_time_hr'].':'.$this->data['Health']['pat_bp_time_sec'];

									}

									else

									{

										$time_value = '00:00';

									}



									$this->data['UserBmiBp']['user_id'] = $last_user_id;

									$this->data['UserBmiBp']['request_id'] = $last_insert_id;

									$this->data['UserBmiBp']['weight'] = $this->data['Health']['pat_weight'];

									$this->data['UserBmiBp']['height_opt'] = $this->data['Health']['select_bmi_opt'];

									$this->data['UserBmiBp']['height_feet'] = $this->data['Health']['pat_height_feet'];

									$this->data['UserBmiBp']['height_inch'] = $this->data['Health']['pat_height_inch'];

									$this->data['UserBmiBp']['height_cm'] = $this->data['Health']['pat_height_cms'];

									$this->data['UserBmiBp']['bmi_value'] = $bmi_of_pat;

									$this->data['UserBmiBp']['bmi_indicator'] = $bmi_indicator;

									$this->data['UserBmiBp']['bp_systolic'] = $this->data['Health']['pat_systolic'];

									$this->data['UserBmiBp']['bp_diastolic'] = $this->data['Health']['pat_diaostolic'];

									$this->data['UserBmiBp']['bp_pulse'] = $this->data['Health']['pat_pulse_rate'];

									$this->data['UserBmiBp']['time'] = $time_value;

									$this->data['UserBmiBp']['status'] = 1;

									$this->data['UserBmiBp']['save_date'] = date('Y-m-d H:i:s',strtotime($this->data['Health']['vital_time']));



									if($this->UserBmiBp->create($this->data))

									{

										$this->UserBmiBp->save($this->data);

									}



									//Code For Inserting BMI value Ends

									$update_user_id = $this->Health->query("UPDATE healths SET user_id='$last_user_id' WHERE id='".$last_insert_id."'");

									if(!empty($this->data['Health']['email']))

									{

										$this->set('user_name' , strtoupper($this->data['Health']['name'] ));

										$this->set('user_email' , $this->data['Health']['email'] );

										$this->set('user_pass' , $password );

										$this->Email->template = 'login_detail';

										$this->Email->from = $this->data['Health']['email'];

										$this->Email->fromName = 'info@niramayahealthcare.com';

										$this->Email->subject = 'Login details for niramaya member panel';

										$this->Email->to = $this->data['Health']['email'];

										$this->Email->sendAs = 'html'; // because we like to send pretty mail

										$this->Email->delivery = 'mail';

										$this->Email->send();

									}



									if(!empty($this->data['Health']['address1']) && empty($this->data['Health']['address2']))

									{

										$billing_add = $this->data['Health']['address1'];

									}

									if(!empty($this->data['Health']['address1']) && !empty($this->data['Health']['address2']))

									{

										$billing_add = $this->data['Health']['address1'].'*'.$this->data['Health']['address2'];

									}

									$find_desc = $this->Billing->find('first',array('order'=>array('Billing.id DESC')));

									if(empty($find_desc))

									{

										$this->data['Billing']['order_id'] = 1000;

									}

									if(!empty($find_desc))

									{

										$this->data['Billing']['order_id'] = ($find_desc['Billing']['order_id']+1);

									}

									$this->data['Billing']['request_id'] = $last_insert_id;

									$this->data['Billing']['user_id'] = $last_user_id;

									$this->data['Billing']['test_id'] = $this->data['Health']['test_id'];

									$this->data['Billing']['profile_id'] = $this->data['Health']['profile_id'];

									$this->data['Billing']['offer_id'] = $this->data['Health']['offer_id'];

									$this->data['Billing']['package_id'] = $this->data['Health']['package_id'];

									$this->data['Billing']['service_id'] = $this->data['Health']['service_id'];

									$this->data['Billing']['first_name'] = strtoupper($this->data['Health']['name']);

									$this->data['Billing']['contact'] = $this->data['Health']['landline'];

									$this->data['Billing']['address'] = $billing_add;

									$this->data['Billing']['locality'] = $locality_v;

									$this->data['Billing']['city'] = $city_v;

									$this->data['Billing']['state'] = $state_v;

									$this->data['Billing']['zip'] = $pincode_v;

									$this->data['Billing']['landmark'] = $landmark_v;

									$this->data['Billing']['book_date'] = date('Y-m-d H:i:s');

									$this->data['Billing']['sub_total'] = $this->data['Health']['total_amount'];

									if($this->Billing->create($this->data))

									{

										if($this->Billing->save($this->data,false))

										{
											$get_request_detail_book = $this->Health->find('first',array('conditions'=>array('Health.id'=>$last_insert_id)));

											if(!empty($get_request_detail_book['Health']['email']))

											{

												//Email to user for Request Number Starts

												$this->set('user_Name',strtoupper($get_request_detail_book['Health']['name']));

												$this->set('request_Number',$this->data['Billing']['order_id']);

												$this->Email->to = $get_request_detail_book['Health']['email'];

												$this->Email->subject = 'Request Number for Booked Request';

												$this->Email->from = 'info@niramayahealthcare.com';

												$this->Email->template = 'request_number';

												$this->Email->sendAs = 'both';

												$this->Email->send();

												//Email to user for Request Number Ends

											}
											$timslot = configure::read("TimeSlot");
											if($this->data['Health']['requ_type'] == 'visit_lab')

											{
												$get_collection_time_info = $timeslot[$get_request_detail_book['Health']['sample_time']];
												
												$number = $this->data['Health']['landline'];

												$get_info_city = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$this->data['Health']['city'])));

												$message = 'Test Req. No:'.$this->data['Billing']['order_id'].' Thank you for booking your tests & opting for visiting our'.$get_info_city['Lab']['pcc_name'].' Centre '.$get_info_city['Lab']['pcc_address'].' on '.$get_request_detail_book['Health']['sample_date'].' '.$get_collection_time_info.' after applicable discounts. For assistance: call NirAmaya Pathlabs +91-9555009009 or visit www.NHcare.in';

											}

											if($this->data['Health']['requ_type'] == 'home_collection')

											{
												$get_collection_time_info1 = $timeslot[$get_request_detail_book['Health']['sample_time']];

												$number = $this->data['Health']['landline'];

												//$message = 'Test Req. No:'.$this->data['Billing']['order_id'].' Thank you for booking your tests with nirAmaya Pathlabs on '.$get_request_detail_book['Health']['sample_date1'].' '.$get_collection_time_info1.' after applicable discounts. For assistance: call +91-9555009009 or visit www.NHcare.in';


													$message = 'Test Req. No:'.$this->data['Billing']['order_id'].' Thank you for booking your tests with nirAmaya Pathlabs on '.$get_request_detail_book['Health']['sample_date1'].' '.$get_collection_time_info1.'. Call 9555009009 or visit www.NHcare.in for assistance.';



													



											}
											if($this->Utility->check_sms_enable_for_pcc($this->data['Health']['created_by'],$this->data['Health']['assigned_lab']) == 1)
											{
												$this->__sms_message($number,$message);
											}
											

											//$update_healths = $this->Health->query("UPDATE healths SET visit_pat_city='".$this->data['Health']['city_id']."' WHERE id='".$last_insert_id."'");
											$getOrderId = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$last_insert_id)));
								            $referenceId = $this->data['Health']['reference'];
											$mrn = $this->data['Health']['medical_reference_number'];
											if(empty($mrn))
												$mrn = $getOrderId['Billing']['user_id'];
											
											$this->PrescriptionMaster = ClassRegistry::init('PrescriptionMaster');
											//print_R("update prescription_master set order_id='".$last_insert_id."',status='3' where id='".$sessionData['PrescriptionMaster']['id']."'");die;
											$this->PrescriptionMaster->query("update prescription_master set request_id='".$last_insert_id."',order_id='".$getOrderId['Billing']['order_id']."',status='3' where id='".$sessionData['PrescriptionMaster']['id']."'");


											$this->Lab = ClassRegistry::init("Lab");
											$lab_data = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$this->data['Health']['created_by'])));

											$date = date('d').date('m').date('Y').date('h').date('i').date('s');	
											if(empty($referenceId))
												$referenceId = $getOrderId['Billing']['user_id']."-".$date;

											$update_user_id = $this->Health->query("UPDATE healths SET reference='".$referenceId."', medical_reference_number='".$mrn."' WHERE id='".$last_insert_id."'");
//print_R('hello');die;											// To get page url to track activity
						                    $this->_activity_log($last_user_id, $last_insert_id, $action = "New Request");
											
											$this->Session->setFlash('Thank You for Your time, Your request has been saved successfully','flash_success');

											if($this->data['Health']['login_type'] == 'Super')

											{

												$this->redirect(array('controller'=>'samples','action'=>'view_detail',base64_encode($last_insert_id)));

											}

											if($this->data['Health']['login_type'] == 'Agent')

											{

												$this->redirect(array('controller'=>'samples','action'=>'view_detail_agent',base64_encode($last_insert_id)));

											}

											if($this->data['Health']['login_type'] == 'BM')

											{

												$this->redirect(array('controller'=>'samples','action'=>'view_detail',base64_encode($last_insert_id)));

											}

											if($this->data['Health']['login_type'] == 'PCC')

											{

												$this->redirect(array('controller'=>'samples','action'=>'view_patient_details',base64_encode($last_insert_id)));

											}

										}

									}



								}

							}
						}

						else

						{
							$update_user = $this->User->query("UPDATE users SET alternate_email='".$this->data['Health']['alternate_email']."',alternate_contact='".$this->data['Health']['alternate_contact']."' WHERE id='".$this->data['Health']['user_id']."'");
							$update_user_id = $this->Health->query("UPDATE healths SET user_id='".$this->data['Health']['user_id']."' WHERE id='".$last_insert_id."'");

							if(!empty($this->data['Health']['address1']) && empty($this->data['Health']['address2']))

							{

								$billing_add = $this->data['Health']['address1'];

							}

							if(!empty($this->data['Health']['address1']) && !empty($this->data['Health']['address2']))

							{

								$billing_add = $this->data['Health']['address1'].'*'.$this->data['Health']['address2'];

							}

							$find_desc = $this->Billing->find('first',array('order'=>array('Billing.id DESC')));

							if(empty($find_desc))

							{

								$this->data['Billing']['order_id'] = 1000;

							}

							if(!empty($find_desc))

							{

								$this->data['Billing']['order_id'] = ($find_desc['Billing']['order_id']+1);

							}

							$get_user_detail = $this->User->find('first',array('conditions'=>array('User.id'=>$this->data['Health']['user_id'])));

							$this->data['Billing']['request_id'] = $last_insert_id;

							$this->data['Billing']['user_id'] = $this->data['Health']['user_id'];

							$this->data['Billing']['test_id'] = $this->data['Health']['test_id'];

							$this->data['Billing']['profile_id'] = $this->data['Health']['profile_id'];

							$this->data['Billing']['offer_id'] = $this->data['Health']['offer_id'];

							$this->data['Billing']['package_id'] = $this->data['Health']['package_id'];

							$this->data['Billing']['service_id'] = $this->data['Health']['service_id'];

							$this->data['Billing']['first_name'] = $get_user_detail['User']['name'];

							$this->data['Billing']['contact'] = $get_user_detail['User']['contact'];

							$this->data['Billing']['address'] = $get_user_detail['User']['address'];

							$this->data['Billing']['locality'] = $get_user_detail['User']['locality'];

							$this->data['Billing']['city'] = $get_user_detail['User']['city'];

							$this->data['Billing']['state'] = $get_user_detail['User']['state'];

							$this->data['Billing']['zip'] = $get_user_detail['User']['pincode'];

							$this->data['Billing']['landmark'] = $get_user_detail['User']['landmark'];

							$this->data['Billing']['book_date'] = date('Y-m-d H:i:s');

							$this->data['Billing']['sub_total'] = $this->data['Health']['total_amount'];

							//echo "<pre>"; print_r($this->data); exit;

							if($this->Billing->create($this->data))

							{

								if($this->Billing->save($this->data,false))

								{



									$get_request_detail_book = $this->Health->find('first',array('conditions'=>array('Health.id'=>$last_insert_id)));

									if(!empty($get_request_detail_book['Health']['email']))

									{

										//Email to user for Request Number Starts

										$this->set('user_Name',strtoupper($get_request_detail_book['Health']['name']));

										$this->set('request_Number',$this->data['Billing']['order_id']);

										$this->Email->to = $get_request_detail_book['Health']['email'];

										$this->Email->subject = 'Request Number for Booked Request';

										$this->Email->from = 'info@niramayahealthcare.com';

										$this->Email->template = 'request_number';

										$this->Email->sendAs = 'both';

										$this->Email->send();

										//Email to user for Request Number Ends

									}

									$timeslot = configure::read("TimeSlot");
									if($this->data['Health']['requ_type'] == 'visit_lab')

									{

										//echo "asas<pre>"; print_r($get_request_detail_book);
										$get_collection_time_info = $timeslot[$get_request_detail_book['Health']['sample_time']];
										
										$number = $this->data['Health']['landline'];

										$get_info_city = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$this->data['Health']['city'])));

										$message = 'Test Req. No:'.$this->data['Billing']['order_id'].' Thank you for booking your tests & opting for visiting our'.$get_info_city['Lab']['pcc_name'].' Centre '.$get_info_city['Lab']['pcc_address'].' on '.$get_request_detail_book['Health']['sample_date'].' '.$get_collection_time_info.' after applicable discounts. For assistance: call NirAmaya Pathlabs +91-9555009009 or visit www.NHcare.in';



										//echo $message; exit;

									}

									if($this->data['Health']['requ_type'] == 'home_collection')

									{
										$get_collection_time_info1 = $timeslot[$get_request_detail_book['Health']['sample_time']];
									
										$number = $this->data['Health']['landline'];

										/*$message = 'Test Req. No:'.$this->data['Billing']['order_id'].' Thank you for booking your tests with nirAmaya Pathlabs on '.$get_request_detail_book['Health']['sample_date1'].' '.$get_collection_time_info1.' after applicable discounts. For assistance: call +91-9555009009 or visit www.NHcare.in';*/


										$message = 'Test Req. No:'.$this->data['Billing']['order_id'].' Thank you for booking your tests with nirAmaya Pathlabs on '.$get_request_detail_book['Health']['sample_date1'].' '.$get_collection_time_info1.'. Call 9555009009 or visit www.nhcare.in for assistance.';

									}
									if($this->Utility->check_sms_enable_for_pcc($this->data['Health']['created_by'],$this->data['Health']['assigned_lab']) == 1)
									{
										$this->__sms_message($number,$message);
									}
									

									//$update_healths = $this->Health->query("UPDATE healths SET visit_pat_city='".$get_user_detail['User']['city']."' WHERE id='".$last_insert_id."'");
									
									// To get page url to track activity
						            $this->_activity_log($this->data['Health']['user_id'], $last_insert_id, $action = "New Request");

						            $getOrderId = $this->Billing->find('first',array('conditions'=>array('Billing.request_id'=>$last_insert_id)));

						            $referenceId = $this->data['Health']['reference'];
									$mrn = $this->data['Health']['medical_reference_number'];
									if(empty($mrn))
										$mrn = $getOrderId['Billing']['user_id'];
									if(empty($referenceId))
										$referenceId = $getOrderId['Billing']['order_id'];

									$update_user_id = $this->Health->query("UPDATE healths SET reference='".$referenceId."',medical_reference_number='".$mrn."' WHERE id='".$last_insert_id."'");
									
									$this->Session->setFlash('Thank You for Your time, Your request has been saved successfully','flash_success');

									if($this->data['Health']['login_type'] == 'Super')

									{

										$this->redirect(array('controller'=>'samples','action'=>'view_detail',base64_encode($last_insert_id)));

									}

									if($this->data['Health']['login_type'] == 'Agent')

									{

										$this->redirect(array('controller'=>'samples','action'=>'view_detail_agent',base64_encode($last_insert_id)));

									}

									if($this->data['Health']['login_type'] == 'BM')

									{

										$this->redirect(array('controller'=>'samples','action'=>'view_detail',base64_encode($last_insert_id)));

									}

									if($this->data['Health']['login_type'] == 'PCC')

									{

										$this->redirect(array('controller'=>'samples','action'=>'view_patient_details',base64_encode($last_insert_id)));

									}

								}

							}

						}

					//}

				}

			}
		}

		$health = $this->Health->create();
		$health['Health']['medical_reference_number'] = $sessionData['PrescriptionMaster']['mrn'];
		$health['Health']['name'] = $sessionData['PrescriptionMaster']['first_name']." ".$sessionData['PrescriptionMaster']['last_name'];
		$health['Health']['gender'] = $sessionData['PrescriptionMaster']['gender'];
		$health['Health']['age'] = $sessionData['PrescriptionMaster']['age'];
		$health['Health']['landline'] = $sessionData['PrescriptionMaster']['contact_number'];
		$health['Health']['alternate_contact'] = $sessionData['PrescriptionMaster']['alternate_contact'];
		$health['Health']['email'] = $sessionData['PrescriptionMaster']['email'];
		$health['Health']['test_id'] = $sessionData['PrescriptionMaster']['tests'];
		$health['Health']['test_sel_ids'] = $sessionData['PrescriptionMaster']['tests'];
		$health['Health']['discount_amount'] = $sessionData['PrescriptionMaster']['discount_amount'];
		$health['Health']['discount_amount_reason'] = $sessionData['PrescriptionMaster']['discount_amount_reason'];
		$health['Health']['reference'] = $sessionData['PrescriptionMaster']['prescription_id'];
		$health['Health']['created_by'] = $sessionData['PrescriptionMaster']['created_by'];
		
		if(!empty($sessionData['PrescriptionMaster']['tests']))
		{
			$expl_test = explode(',',$sessionData['PrescriptionMaster']['tests']);
			$amt_test = 0;
			$counter_seq=1;
			$test_name="";
			foreach($expl_test as $key => $val)
			{
				$find_mrp_test = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));
				
				$test_name = '<td width="15%" class="boldText">Selected Test(s)</td>
							<td id="selected_test_desc">
							<table border="0" width="100%" style="margin:-8px 0 0 0;">
							<tr id="selected'.$find_mrp_test['Test']['id'].'"><td>'.$test_name.'<strong>'.$counter_seq.'-</strong> '.$find_mrp_test['Test']['testcode'].' - '.$find_mrp_test['Test']['test_parameter'].' - Rs.'.$find_mrp_test['Test']['mrp'].'
							<a href="javascript:void(0);" onclick="remove_sel_test('.$find_mrp_test['Test']['id'].','.$find_mrp_test['Test']['mrp'].')" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a></td></tr>
							</table></td>';
				$amt_test = ($find_mrp_test['Test']['mrp']+$amt_test);
				$amt_test = $amt_test;
				$counter_seq++;
			}
			$health['Health']['total_test_amt'] = $amt_test;
			$health['Health']['test_name'] = $test_name;
		}
		
		//print_R($health);die;
		$city = $this->City->find('all',array('conditions'=>array('City.status'=>1)));

		$state = $this->State->find('all',array('conditions'=>array('State.status'=>1)));

		$offers = $this->Banner->find('all',array('conditions'=>array('Banner.status'=>1),'order'=>array('Banner.banner_name ASC')));

		$tests = $this->Test->find('all',array('conditions'=>array('Test.status'=>1,'Test.type'=>'TEST'),'order'=>array('Test.test_parameter ASC')));

		$profiles = $this->Test->find('all',array('conditions'=>array('Test.status'=>1,'Test.type'=>'PROFILE'),'order'=>array('Test.test_parameter ASC')));

		$timelabs = $this->Timelab->find('all',array('conditions'=>array('Timelab.status'=>1),'order'=>array('Timelab.sequence ASC')));

		//$users = $this->User->find('all',array('conditions'=>array('User.status'=>1)));

		$pcc_list = $this->Lab->find('all',array('conditions'=>array('Lab.status'=>1)));

		//$pcc_list = $this->Lab->find('all',array('conditions'=>array('Lab.status'=>1,'Lab.show_to_world'=>1),'order'=>array('Lab.sequence'=>'asc')));

		$this->set('pcc_list',$pcc_list);

		$this->set('offers',$offers);

		//$this->set('users',$users);

		$this->set('timelabs',$timelabs);

		$this->set('city',$city);

		$this->set('state',$state);

		$this->set('tests',$tests);

		$this->set('profiles',$profiles);
		
		$this->data = $health;
		//$this->set('orderdata',$sessionData);
	}
	
	function print_estimate($req_id=NULL)
	{
//		print_R('hello');die;
		$this->layout = false;

		$dec_req_id = base64_decode($req_id);

		$req_detail = $this->PrescriptionMaster->find('first',array('conditions'=>array('id'=>$dec_req_id)));
		
		$b = 0;

		if($req_detail['PrescriptionMaster']['tests'] != '')

		{

			$explode_test = explode(',',$req_detail['PrescriptionMaster']['tests']);

			

			foreach($explode_test as $key => $val)

			{

				$test_name = $this->Test->find('first',array('conditions'=>array('Test.id'=>$val)));

				$req_detail['PrescriptionMaster']['testlist'][$b]['test_code'] = $test_name['Test']['testcode'];

				$req_detail['PrescriptionMaster']['testlist'][$b]['test_parameter'] = $test_name['Test']['test_parameter'];

				$req_detail['PrescriptionMaster']['testlist'][$b]['test_mrp'] = $test_name['Test']['mrp'];

				$b++;

			}

		}

		$vv = 0;
		foreach($req_detail['PrescriptionMaster']['testlist'] as $k => $x) 
		{
			$vv = ($x['test_mrp']+$vv);
			$vv = $vv;
		}
		$req_detail['PrescriptionMaster']['grand_total'] = $vv;
//print_R($req_detail);die;
		$this->set('req_detail',$req_detail);
	}

	function _activity_log($patient , $health, $action)
	{
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
	
	function admin_lab_message($req_id=NULL)
	{
		$dd = $this->Session->read('Admin.id');
		$dec_id = base64_decode($req_id);
		//print_R($dec_id);
		$this->PrescriptionMaster = ClassRegistry::init('PrescriptionMaster');
		$prescription = $this->PrescriptionMaster->find('first',array('conditions'=>array('PrescriptionMaster.id'=>$dec_id)));
		
		if(!empty($this->data['Health']['lab_message']))
		{
			$this->LabMessageMaster = ClassRegistry::init('LabMessageMaster');
			$this->LabMessageMaster->create();
			
			if(!empty($prescription['PrescriptionMaster']['request_id']))
			{
				$this->data['LabMessageMaster']['request_id'] = $prescription['PrescriptionMaster']['request_id'];
				$this->data['LabMessageMaster']['date'] = date('Y-m-d H:i:s');
				$this->data['LabMessageMaster']['message'] = $this->data['Health']['lab_message'];
			//	print_R($this->data);
				$this->LabMessageMaster->save($this->data);
				$update = $this->Health->query("UPDATE healths SET lab_message='".$this->data['Health']['lab_message']."',message_status='".$this->data['Health']['message_status']."'  ,last_edited='".$dd."',last_edited_date='".date('Y-m-d H:i:s')."' WHERE id='".$prescription['PrescriptionMaster']['request_id']."'");
			}
			else{
				$this->data['LabMessageMaster']['request_id'] = $prescription['PrescriptionMaster']['prescription_id'];
				$this->data['LabMessageMaster']['date'] = date('Y-m-d H:i:s');
				$this->data['LabMessageMaster']['message'] = $this->data['Health']['lab_message'];
			//	print_R($this->data);
				$this->LabMessageMaster->save($this->data);
			}
			$this->Session->setFlash('Lab Message Saved','flash_success');
		}
		else
		{
			$this->Session->setFlash('Lab Message is Empty','flash_failure');
		}
		//die;
		$this->redirect('/admin/prescription/edit_prescription/'.$req_id);

	}
	
	function admin_follow_up($req_id=NULL)
	{
		$dec_id = base64_decode($req_id);
		
		$this->PrescriptionMaster = ClassRegistry::init('PrescriptionMaster');
		$prescription = $this->PrescriptionMaster->find('first',array('conditions'=>array('PrescriptionMaster.id'=>$dec_id)));
		
		$this->FollowUpLog = ClassRegistry::init('FollowUpLog');	
		
		$this->FollowUpLog->create();
		
		$this->data1['FollowUpLog']['date'] = date('Y-m-d',strtotime($_POST['data']['Health']['sample_date1']));
		$this->data1['FollowUpLog']['time'] = $_POST['data']['Filter']['time'];
		$this->data1['FollowUpLog']['remarks'] = $_POST['followup_remarks'];
		$this->data1['FollowUpLog']['status'] = $_POST['data']['Filter']['req_status'];
		$this->data1['FollowUpLog']['prescription_id'] = $prescription['PrescriptionMaster']['prescription_id'];
		$this->FollowUpLog->save($this->data1);
		
		$this->PrescriptionMaster->query('update prescription_master set status="'.$_POST['data']['Filter']['req_status'].'" where id="'.$dec_id.'"');
		
		$this->Session->setFlash('Follow Up Scheduled','flash_success');
		
		$this->redirect('/admin/prescription/edit_prescription/'.$req_id);
	}

}
