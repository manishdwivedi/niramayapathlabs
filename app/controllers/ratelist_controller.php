<?php
require "/home2/niramovh/lib/PHPMailer/class.phpmailer.php";
require "/home2/niramovh/lib/PHPMailer/class.smtp.php";
App::import('Vendor', '/fpdf/fpdf');
App::import('Vendor', '/fpdf/fpdi');

class RatelistController extends AppController {
	
	var $name = "Ratelist";

	var $breadcrumb = array();

	var $uses=array('Tests','BbEstimate','LabRateList','Lab','Ratelist','Admin');

	var $helpers = array('Form','Html','Javascript', 'Ajax','Utility');

	public $components = array('RequestHandler','Cookie','Utility');

	public $paginate = array('maxLimit' => 10);
	
	function admin_add_ratelist()
	{
		$admin_id = $this->Session->read('Admin.id');
		$login_type = $this->Session->read('Admin.userType');
		$lab_id = "";
		if($login_type != 'A')
		{
			$this->Admin = ClassRegistry::init('Admin');
			$userdetail = $this->Admin->find('first',array('conditions'=>array('Admin.id'=>$admin_id)));
					
			$pcc_list = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$userdetail['Admin']['labId']),'fields'=>array('Lab.id','Lab.ratelist')));
			//print_R($pcc_list);die;
			$this->set('lab_ratelist',$pcc_list['Lab']['ratelist']);
			$this->set('selected_lab',$userdetail['Admin']['labId']);
			$lab_id = $userdetail['Admin']['labId'];
		}
		
		$this->set('title_for_layout', 'Add Ratelist Estimate');
		
		$this->bbestimate = ClassRegistry::init("BbEstimate");
		$this->lab = ClassRegistry::init("Lab");
		
		$pcc_list = $this->Lab->find('list',array('conditions'=>array('Lab.status'=>1),'fields'=>array('Lab.id','Lab.pcc_name')));
		$this->set('lab_list',$pcc_list);
		if($this->data)
		{
			if(!empty($this->data['Test']['lab_id']))
				$this->data['BbEstimate']['booked_by'] = $this->data['Test']['lab_id'];
			else
				$this->data['BbEstimate']['booked_by'] = $lab_id;
			
			//print_R($this->data);die;
			$this->data['BbEstimate']['date'] = date('Y-m-d H:i:s');
			$this->data['BbEstimate']['last_edited'] = date('Y-m-d H:i:s');
			$this->data['BbEstimate']['status'] = 1;
			
			$this->bbestimate->create($this->data);
			if($this->bbestimate->save($this->data))
			{
				$estmate_id = $this->bbestimate->getLastInsertId();
				$mail_data = "A new Estimate with id - ".$estmate_id." has been submitted";
				$subject = "New Estimate Submitted";
				$this->sendmail($mail_data, 'accounts@niramayapathlabs.com',$subject);
				$this->__sms_message('8826822855',$mail_data);
				
				$this->Session->setFlash('Package Estimate Created successfully','flash_success');
				$this->redirect('index');
			}
			else
			{
				$this->Session->setFlash('Unable to Create Package Estimate','flash_failure');
				$this->redirect('index');
			}
		}
		$ratelist = $this->Ratelist->find('list',array('fields'=>array('Ratelist.id','Ratelist.name')));
		$this->set('ratelist',$ratelist);
	}
	
	public function searchtest()
	{
		$this->layout="";
		$this->Test = ClassRegistry::init('Test');
		$observations = $this->Test->query("Select * from tests where test_parameter Like '%".$_POST['search']."%' and type = 'TEST'");
		$content="";
		foreach($observations as $val)
		{
			$this->LabRateList = ClassRegistry::init('LabRateList');
			$ratetest = $this->LabRateList->query("Select * from lab_rate_list where rate_list_id = '".$_POST['ratelist']."' and test_id = ".$val['tests']['id']."");
			//print_R($ratetest);
			if($ratetest[0]['lab_rate_list']['custom_mrp']!=0)			
				$content .= "<option value='".$val['tests']['id']."'>".$val['tests']['test_parameter']."</option>";
		}
		//die;
		print_R($content);
		$this->render(false);
	}
	
	public function gettest()
	{
		$this->layout="";
		$this->Test = ClassRegistry::init('Test');
		$this->LabRateList = ClassRegistry::init('LabRateList');
		$tests = explode(',',$_POST['testlist']);

		if($_POST['testlist'][0]=='')
		{
			$tests = array();
		}

		if(!empty($_POST['id']))
		{
			if(!in_array($_POST['id'],$tests))
			{
				array_push($tests,$_POST['id']);
			}
			else
			{
				echo "failure";die;
			}
		}

		$totaltest = $this->LabRateList->query("Select * from lab_rate_list where rate_list_id = '".$_POST['ratelist']."' and test_id in (".implode(',',$tests).")");
		
		//$this->Test->query("Select * from tests where id in (".implode(',',$tests).")");
//		print_R($totaltest);die;
		$content="";
		$count = 0;
		$amount = 0;
		$projected_mrp = 0;
		$test_id = array();
		foreach($totaltest as $val)
		{
			$testname = $this->Test->query("Select * from tests where id = '".$val['lab_rate_list']['test_id']."'");
			$count++;
			$content .= "<div id='test".$val['lab_rate_list']['test_id']."'>".$testname[0]['tests']['test_parameter']."<a href='javascript:void(0);' onclick='delete_obs(".$val['lab_rate_list']['test_id'].")' style='font-weight:bold; color:#FF0000; text-decoration:none;'>[X]</a></div>";
			$amount = $amount+$val['lab_rate_list']['custom_mrp'];
			array_push($test_id,$val['lab_rate_list']['test_id']);
			$projected_mrp = $projected_mrp+$testname[0]['tests']['mrp'];
		}
		print_R($content."@@@@@".$amount."@@@@@".implode(',',$test_id)."@@@@@".$projected_mrp);
		die;
	}
	
	public function gettestrate()
	{
		$this->LabRateList = ClassRegistry::init('LabRateList');
		$totalamount = $this->LabRateList->query("Select sum(custom_mrp) as total from lab_rate_list where rate_list_id = '".$_POST['id']."' and test_id in (".$_POST['testlist'].")");
		print_R($totalamount[0][0]['total']);die;
	}
	
	function admin_index()
	{
		$admin_id = $this->Session->read('Admin.id');
		$login_type = $this->Session->read('Admin.userType');
		$conditions = array();
		
		if($login_type != 'A')
		{
			$this->Admin = ClassRegistry::init('Admin');
			$userdetail = $this->Admin->find('first',array('conditions'=>array('Admin.id'=>$admin_id)));
			$conditions['BbEstimate.booked_by like'] = $userdetail['Admin']['labId'];
		}
		$this->bbestimate = ClassRegistry::init("BbEstimate");
		$this->paginate = array('BbEstimate' => array('limit' =>'30','order'=>array('BbEstimate.id'=>'DESC'),'conditions'=>$conditions));
		
		$packageEstimate=$this->paginate('BbEstimate');
		$this->set('packageEstimate',$packageEstimate);
		$this->lab = ClassRegistry::init("Lab");
		
		$ratelist = $this->Ratelist->find('list',array('fields'=>array('Ratelist.id','Ratelist.name')));
		$this->set('ratelist',$ratelist);
		
		$estimate_status = array('1'=>'New PKG Request','2'=>'Approved PKG','3'=>'PKG For Reapproval','4'=>'Create PKG Request','5'=>'PKG Created');
		
		$pcc_list = $this->Lab->find('list',array('conditions'=>array('Lab.status'=>1),'fields'=>array('Lab.id','Lab.pcc_name')));
		//print_R($estimate_status);die;
		$this->set('status',$estimate_status);
		$this->set('lab_list',$pcc_list);
		//print_R($packageEstimate);die;
	}
	
	function admin_edit_estimate($eid=null)
	{
		$id = base64_decode($eid);
		$this->bbestimate = ClassRegistry::init("BbEstimate");
		
		if($this->data)
		{
			$this->data['BbEstimate']['id'] = $id;
			$this->data['BbEstimate']['last_edited'] = date('Y-m-d H:i:s');
			
			$this->bbestimate->create($this->data);
			if($this->bbestimate->save($this->data))
			{
				$this->Session->setFlash('Package Estimate Updated successfully','flash_success');
				$this->redirect('index');
			}
			else
			{
				$this->Session->setFlash('Unable to Update Package Estimate','flash_failure');
				$this->redirect('index');
			}
		}
		
		$estimate = $this->bbestimate->find('first',array('conditions'=>array('BbEstimate.id'=>$id)));
		//print_R($estimate);die;
		
		$pcc_list = $this->Lab->find('list',array('conditions'=>array('Lab.status'=>1),'fields'=>array('Lab.id','Lab.pcc_name')));
		$this->set('lab_list',$pcc_list);
		
		$ratelist = $this->Ratelist->find('list',array('fields'=>array('Ratelist.id','Ratelist.name')));
		$this->set('ratelist',$ratelist);
		
		$this->data = $estimate;
	}
	
	public function createpackage()
	{
		$this->bbestimate = ClassRegistry::init("BbEstimate");
		$bbestimate = $this->bbestimate->find('first',array('conditions'=>array('BbEstimate.id'=>$_POST['data']['BbEstimate']['id'])));
				
		$this->LabRateList = ClassRegistry::init('LabRateList');
		$this->Test = ClassRegistry::init('Tests');
		
		$this->data['Tests']['type'] = 'PROFILE';
		$this->data['Tests']['speciality'] = '';
		$this->data['Tests']['disease'] = '';
		$this->data['Tests']['testcode'] = $bbestimate['BbEstimate']['pkg_code'];
		$this->data['Tests']['test_parameter'] = $bbestimate['BbEstimate']['pkg_name'];
				
		$sample_type = array();
		$observations = array();
		$market_value = 0;
		
		$test_detail = $this->Test->query('select * from tests where id in ('.$bbestimate['BbEstimate']['test_id'].')');
		
		foreach($test_detail as $test)
		{
			$sample = explode(',',$test['tests']['sample']);
			foreach($sample as $val)
			{
				if(!in_array($val,$sample_type))
				{
					array_push($sample_type,$val);
				}
			}
			
			$observation = explode(',',$test['tests']['observation_id']);
			foreach($observation as $val)
			{
				if(!in_array($val,$observations))
				{
					array_push($observations,$val);
				}
			}
			$market_value = $market_value + $test['tests']['mrp'];
		}
		
		$this->data['Tests']['sample'] = implode(',',$sample_type);
		$this->data['Tests']['observation_id'] = implode(',',$observations);		
		$this->data['Tests']['testscode'] = $bbestimate['BbEstimate']['test_id'];
		$this->data['Tests']['temp'] = ' ';
		$this->data['Tests']['schedule'] = ' ';
		$this->data['Tests']['reporting'] = ' ';
		$this->data['Tests']['net'] = $market_value;
		$this->data['Tests']['mrp'] = $bbestimate['BbEstimate']['projected_mrp'];
		$this->data['Tests']['add_date'] = date('Y-m-d h:i:s');
		$this->data['Tests']['status'] = '1';
		$this->data['Tests']['description'] = ' ';
		$this->data['Tests']['file_name'] = ' ';
		$this->data['Tests']['special_offer'] = '0';
		$this->data['Tests']['p_type'] = '3';
		$this->data['Tests']['assigned_lab'] = $bbestimate['BbEstimate']['booked_by'];
		
		$this->Tests->create($this->data);
		$this->Tests->save($this->data);
		
		$last_id = $this->Tests->getLastInsertId();
		
		$this->ratedata['LabRateList']['rate_list_id'] = $bbestimate['BbEstimate']['pkg_rate_list'];
		$this->ratedata['LabRateList']['test_id'] = $last_id;
		$this->ratedata['LabRateList']['custom_mrp'] = $bbestimate['BbEstimate']['final_cost'];
		
		$this->LabRateList->create($this->ratedata);
		$this->LabRateList->save($this->ratedata);
		
		$this->bbestimate->query('update bb_estimate set status="5" where id="'.$_POST['data']['BbEstimate']['id'].'"');
		
		$mail_data_client = "Package has been created from Estimate id - ".$_POST['data']['BbEstimate']['id'].". Kindly Look at it.";
		
		$subject = "Package Has been Created";
		$this->sendmail($mail_data_client,$bbestimate['BbEstimate']['email'],$subject);
		$this->__sms_message($bbestimate['BbEstimate']['contact'],$mail_data_client);
		
		print_R($last_id);die;
	}
	
	public function createpackagerequest()
	{
		$this->bbestimate = ClassRegistry::init("BbEstimate");
		
		$bbestimate = $this->bbestimate->find('first',array('conditions'=>array('BbEstimate.id'=>$_POST['data']['BbEstimate']['id'])));
		
		if(!isset($_POST['data']['BbEstimate']['final_cost']))
			$this->data = $bbestimate;
		else
			$this->data = $_POST['data'];
				
		$this->data['BbEstimate']['id'] = $_POST['data']['BbEstimate']['id'];
		$this->data['BbEstimate']['last_edited'] = date('Y-m-d H:i:s');
		$this->data['BbEstimate']['status'] = 4;
		
		$this->bbestimate->create($this->data);
		$this->bbestimate->save($this->data);
		
		$mail_data_nir = "Estimate with id - ".$this->data['BbEstimate']['id']." has been Requested for Creation of Package";
		
		$subject = "Request For Creation Of Package";
		$this->sendmail($mail_data,"accounts@niramayapathlabs.com",$subject);
		$this->__sms_message("9555009009",$mail_data);
		
		print_R($this->data);die;
	}
	
	public function approveestimate()
	{
		$this->bbestimate = ClassRegistry::init("BbEstimate");
		
		$bbestimate = $this->bbestimate->find('first',array('conditions'=>array('BbEstimate.id'=>$_POST['data']['BbEstimate']['id'])));
		
		if(!isset($_POST['data']['BbEstimate']['final_cost']))
			$this->data = $bbestimate;
		else
			$this->data = $_POST['data'];
		
		$this->data['BbEstimate']['id'] = $_POST['data']['BbEstimate']['id'];
		$this->data['BbEstimate']['last_edited'] = date('Y-m-d H:i:s');
		$this->data['BbEstimate']['status'] = 2;
		
		$this->bbestimate->create($this->data);
		$this->bbestimate->save($this->data);

		//$mail_data_nir = "Estimate with id - ".$this->data['BbEstimate']['id']." has been Approved";
		$mail_data_client = "Estimate with id - ".$this->data['BbEstimate']['id']." has been Approved. Kindly Look at it.";
		
		$subject = "Estimate Has Been Approved";
		$this->sendmail($mail_data_client,$bbestimate['BbEstimate']['email'],$subject);
		$this->__sms_message($bbestimate['BbEstimate']['contact'],$mail_data_client);
		
		print_R($this->data);die;
	}
	
	public function reapproveestimate()
	{
		$this->bbestimate = ClassRegistry::init("BbEstimate");
		
		$bbestimate = $this->bbestimate->find('first',array('conditions'=>array('BbEstimate.id'=>$_POST['data']['BbEstimate']['id'])));
		
		if(!isset($_POST['data']['BbEstimate']['final_cost']))
			$this->data = $bbestimate;
		else
			$this->data = $_POST['data'];
		
		$this->data['BbEstimate']['id'] = $_POST['data']['BbEstimate']['id'];
		$this->data['BbEstimate']['last_edited'] = date('Y-m-d H:i:s');
		$this->data['BbEstimate']['status'] = 3;
		
		$this->bbestimate->create($this->data);
		$this->bbestimate->save($this->data);
		
		$mail_data = "Estimate with id - ".$this->data['BbEstimate']['id']." has been Requested for Re-approval";
		//$mail_data_client = "Estimate with id - ".$this->data['BbEstimate']['id']." has been Approved. Kindly Look at it.";
		
		$subject = "Estimate Has Been Submitted for Reapproval";
		$this->sendmail($mail_data, 'accounts@niramayapathlabs.com',$subject);
				$this->__sms_message('8826822855',$mail_data);
		
		print_R($this->data);die;
	}
	
	public function getratelist()
	{
		$pcc_list = $this->Lab->find('first',array('conditions'=>array('Lab.id'=>$_POST['id']),'fields'=>array('Lab.id','Lab.ratelist')));
		print_R($pcc_list['Lab']['ratelist']);die;
	}
	
	function admin_get_package_rate()
	{
		$ratelist = $this->Ratelist->find('list',array('fields'=>array('Ratelist.id','Ratelist.name')));
		$this->set('ratelist',$ratelist);
	}
	
	public function getpackageestimate()
	{
		//print_R($_POST);die;
		$tests = explode(',',$_POST['testcodes']);
		$totalamount = 0;
		$tesname = "";
		$not_available = "";
		$not_found = "";
		foreach($tests as $val)
		{
			$testname = $this->Test->find('first',array('conditions'=>array('Test.testcode'=>$val)));
			//print_R($val);
			$ratelist = $this->LabRateList->find('first',array('conditions'=>array('LabRateList.rate_list_id'=>$_POST['rate'],'LabRateList.test_id'=>$testname['Test']['id'])));
			
			if(!empty($ratelist))
			{
				if($ratelist['LabRateList']['custom_mrp'] == 0)
				{
					$not_available .= "Test Code ".$val."- not Available<br>";
				}
				$tesname .= $testname['Test']['test_parameter']." (".$val.") - Rs.".$ratelist['LabRateList']['custom_mrp']."<br>";
			}
			else
			{
				$not_found .= "Test Code ".$val."- not Found <br>";
			}
			
			$totalamount = $totalamount + $ratelist['LabRateList']['custom_mrp'];
		}
		print_R($totalamount."@@@".$tesname."@@@".$not_available."@@@".$not_found);
		die;
	}
	
	function writelog($content){
		$file = '/home2/niramovh/public_html/app/webroot/files/log/ratelistlog.txt';
		file_put_contents($file,$content, FILE_APPEND);
	}
	
	function sendmail($maildata,$address,$subject)
	{
		$this->writelog("\n");
		$this->writelog($address);
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
		$mail->addAddress($address,'Estimate');
		
		$mail->Username = 'lab.reports@niramayapathlabs.com';
		$mail->Password = 'Lab@Reports';
						//print_R(json_encode($mail));die;
		$mail->Subject = $subject;
		$mail->Body = "<table width='600' border='0' cellspacing='0' cellpadding='0' align='left'>
						<tr>
							<td>
								".$maildata."
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
								<br/>
								Niramaya Pathlabs
							</td>
						</tr>
					</table>
						";

		$mail->isHTML(true);

		if(!$mail->send()) {
			$this->writelog("Email Not Sent");
			$this->writelog("\n");
			$this->writelog("----------------------------------------------------------------------------------------------------");
			print_R("ratelist Email Not Sent");
		} else {
			$this->writelog("Email Sent!");
			$this->writelog("\n");
			$this->writelog("----------------------------------------------------------------------------------------------------");
			print_R("ratelist Email Sent!");
		}
	}
}