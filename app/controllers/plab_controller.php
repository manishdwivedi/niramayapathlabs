<?php
App::import('Vendor', '/fpdf/fpdf');
App::import('Vendor', '/fpdf/fpdi');

class PlabController extends AppController {
	
	var $name = "Plab";

	var $breadcrumb = array();

	var $uses=array('Admin','Test','PincodeMaster','ProcessingLabs','PlabPincodeMaster','PlabTests','City','State','Lab');

	var $helpers = array('Form','Html','Javascript', 'Ajax','Utility');

	public $components = array('RequestHandler','Cookie','Utility');

	public $paginate = array('maxLimit' => 10);

	function admin_add_labs()
	{
		$this->ProcessingLabs = ClassRegistry::init("ProcessingLabs");
		$this->set('title_for_layout', 'Add Processing Labs');
		//print_R("hello");die;
		if(!empty($this->data))
		{
			//$newid = $this->ProcessingLabs->find('first',array('order'=>'id DESC'));
			//$lab_id = "lab".$newid['ProcessingLabs']['id']+1;
			//$this->data['ProcessingLabs']['lab_code'] = 'lab'.$newid['ProcessingLabs']['id']+1;
			//echo $newid['ProcessingLabs']['id']+1;die;
			if($this->ProcessingLabs->save($this->data))
			{
				$this->Session->setFlash('Lab Info Saved.','flash_success');  
				$labid = $this->ProcessingLabs->getLastInsertID();
				$this->Session->write('plab_id', $labid);
				$this->redirect('/admin/plab/city_tests/');
			}
			else
			{
				$this->Session->setFlash('Unable to Save.','flash_failure');  
			}
		}
	}
	
	function admin_view_labs()
	{
		$this->ProcessingLabs = ClassRegistry::init("ProcessingLabs");
		$conditions = "";
		$this->set('title_for_layout', 'View Processing Labs');
		$this->paginate = array('ProcessingLabs' => array('limit' =>'20','order'=>array('ProcessingLabs.id'=>'DESC'),'conditions'=>$conditions));
		$lablist=$this->paginate('ProcessingLabs');
		//print_R($lablist);die;
		$plabData = array();
		$count = 0;
		
		foreach($lablist as $val)
		{
			$plabData[$count]['ProcessingLabs']['id'] = $val['ProcessingLabs']['id'];
			$plabData[$count]['ProcessingLabs']['name'] = $val['ProcessingLabs']['name'];
			$plabData[$count]['ProcessingLabs']['lab_code'] = $val['ProcessingLabs']['lab_code'];
			$plabData[$count]['ProcessingLabs']['address'] = $val['ProcessingLabs']['address'];
			$plabData[$count]['ProcessingLabs']['phone_number'] = $val['ProcessingLabs']['phone_number'];
			$plabData[$count]['ProcessingLabs']['email'] = $val['ProcessingLabs']['email'];
			
			$count++;
		}
		$this->set('plablist',$plabData);
	}
	
	function admin_edit_labs($plab_id=null)
	{
		$dec_plab_id = base64_decode($plab_id);
		$this->ProcessingLabs = ClassRegistry::init("ProcessingLabs");
		$processinglabs = $this->ProcessingLabs->find('first',array('conditions'=>array('ProcessingLabs.id'=>$dec_plab_id)));
		
		if(!empty($this->data))
		{
			//$this->data['ProcessingLabs']['id'] = $dec_plab_id;
			//print_R($this->data);die;
			
			if($this->ProcessingLabs->save($this->data))
			{
				$this->Session->setFlash('Lab Info Saved.','flash_success');  
				$this->redirect('/admin/plab/view_labs/');
			}
			else
			{
				$this->Session->setFlash('Unable to Save.','flash_failure');  
			}
		}
		
		$this->data = $processinglabs;
		$this->set('lab_id',$dec_plab_id);
		//print_R($processinglabs);die;
	}
	
	function admin_city_tests()
	{
		$this->set('title_for_layout', 'Add Cities and Tests');
		$this->ProcessingLabs = ClassRegistry::init("ProcessingLabs");
		$this->PlabPincodeMaster = ClassRegistry::init("PlabPincodeMaster");
		$this->PlabTests = ClassRegistry::init("PlabTests");
		$this->State = ClassRegistry::init("State");
		$state = $this->State->find('all',array('conditions'=>array('State.status'=>1)));
		$plabid = $this->Session->read('plab_id');

		$this->set('lab_id',$plabid);
		$this->set('state',$state);
		if(!empty($_POST))
		{
			$this->PlabTests->query("delete from plab_tests where lab_id='".$_POST['lab_id']."'");
			$this->PlabPincodeMaster->query("delete from plab_pincode_master where lab_id='".$_POST['lab_id']."'");
			
			$pincodes = explode(",",$_POST['pincodes']);
			foreach($pincodes as $val)
			{
				$planpincode = $this->PlabPincodeMaster->create();
				$planpincode['PlabPincodeMaster']['pincode_id'] = $val;
				$planpincode['PlabPincodeMaster']['lab_id'] = $_POST['lab_id'];
				$this->PlabPincodeMaster->save($planpincode);
				//print_R(json_encode($_POST));die;
			}
			
			foreach($_POST['test'] as $key=>$val)
			{
				$plabtest = $this->PlabTests->create();
				$plabtest['PlabTests']['lab_id'] = $_POST['lab_id'];
				$plabtest['PlabTests']['test_id'] = $key;
				$plabtest['PlabTests']['mrp'] = $val['mrp'];
				$plabtest['PlabTests']['net_rate'] = $val['net_price'];
				$plabtest['PlabTests']['tescode'] = $val['code'];
				$plabtest['PlabTests']['tat'] = $val['tat'];
				
				$this->PlabTests->save($plabtest);
			}
			//print_R(json_encode($_POST));die;
			$this->redirect('/admin/plab/view_labs/');
		}
	}
	
	function admin_searchcity()
	{
		
		$this->PincodeMaster = ClassRegistry::init("PincodeMaster");
		$cities = $this->PincodeMaster->query("Select distinct(pincode) from pincode_master where city='".$_POST['city']."'");
		$pincodelist = '</br><h2>Select Pincodes</h2></br>';
		$pincode = explode(",",$_POST['pincodes']);
		foreach($cities as $key)
		{
			//print_R($key);
			if(in_array($key['pincode_master']['pincode'],$pincode))
				$pincodelist .= '<div style="width:20%;float:left;padding-bottom: 10px;font-size: medium;"><input class="checkbox" type="checkbox" id="'.$key['pincode_master']['pincode'].'" name="pincode['.$key['pincode_master']['pincode'].']" value="'.$key['pincode_master']['pincode'].'" onclick="checkpincode('.$key['pincode_master']['pincode'].')" checked="checked">'.$key['pincode_master']['pincode']."</div>";
			else
				$pincodelist .= '<div style="width:20%;float:left;padding-bottom: 10px;font-size: medium;"><input class="checkbox" type="checkbox" id="'.$key['pincode_master']['pincode'].'" name="pincode['.$key['pincode_master']['pincode'].']" value="'.$key['pincode_master']['pincode'].'" onclick="checkpincode('.$key['pincode_master']['pincode'].')">'.$key['pincode_master']['pincode']."</div>";
		}
		
		print_R($pincodelist);die;
	}
	
	function admin_getcity()
	{
		$this->PincodeMaster = ClassRegistry::init("PincodeMaster");
		$this->City = ClassRegistry::init("City");
		$cities = $this->PincodeMaster->query("Select distinct(city) from pincode_master where state='".$_POST['name']."'");
		//print_R($cities);die;
		$citylist="<option value=''>Select City</option>";
		foreach($cities as $val)
		{
			$city = $this->City->find('first',array('conditions'=>array('City.id'=>$val['pincode_master']['city'])));
			$citylist .= "<option value=".$city['City']['id'].">".$city['City']['name']."</option>";
		}
		//$this->City->find('all',array('conditions'=>array('City.')))
		print_R($citylist);
		die;
	}
	
	function admin_searchtest()
	{
		$this->Test = ClassRegistry::init("Test");
		$this->PlabTests = ClassRegistry::init("PlabTests");
		
		$tests = $this->Test->query("select * from tests where test_parameter like '%".$_POST['test']."%' or testcode like '%".$_POST['test']."%'");
		//print_R($tests);die;

		$tetcodedata = "<table width='100%'>";
		$tetcodedata .= "<tr><th width='5%' style='font-size: large;'>S No.</th><th width='15%' style='font-size: large;'>Name</th><th width='10%' style='font-size: large;'>NPL Testcode</th></th><th width='10%' style='font-size: large;'>Lab Testcode</th><th width='5%' style='font-size: large;'>MRP</th><th width='5%' style='font-size: large;'>Net Price</th><th width='15%' style='font-size: large;'>TAT (in hrs)</th><th width='5%' style='font-size: large;'>Status</th><th width='20%' style='font-size: large;'>Action</th></tr>";
		$count = 1;
		
		foreach($tests as $key)
		{
			$testdata = $this->PlabTests->query("SELECT * FROM plab_tests where lab_id='".$_POST["plab_id"]."' and test_id ='".$key['tests']['id']."'");
//			echo $_POST["plab_id"];
			//print_R($testdata);
			if($testdata)
			{
				$tetcodedata .= '<tr><td width="5%" style="font-size: small;">'.$count.'</td><td style="background-color: lightgray;" readonly width="15%" style="font-size: small;">'.$key['tests']['test_parameter'].'</td>';
				$tetcodedata .= '<td style="background-color: lightgray;font-size: large;font-weight:600;" readonly width="15%">'.$key['tests']['testcode'].'</td><td width="10%" style="font-size: small;"><input id="code_'.$testdata[0]['plab_tests']['test_id'].'" style="background-color: lightgray;" readonly type="text" name="test['.$testdata[0]['plab_tests']['test_id'].'][code]"  value="'.$testdata[0]["plab_tests"]["tescode"].'"></td>';
				$tetcodedata .= '<td width="5%" style="font-size: small;"><input id="mrp_'.$testdata[0]['plab_tests']['test_id'].'" style="background-color: lightgray;" readonly type="number" name="test['.$testdata[0]['plab_tests']['test_id'].'][mrp]"  value="'.$testdata[0]["plab_tests"]["mrp"].'"></td>';
				$tetcodedata .= '<td width="5%" style="font-size: small;"><input id="net_'.$testdata[0]['plab_tests']['test_id'].'" style="background-color: lightgray;" readonly type="number" name="test['.$testdata[0]['plab_tests']['test_id'].'][net_price]"  value="'.$testdata[0]["plab_tests"]["net_rate"].'"></td>';
				$tetcodedata .= '<td width="15%" style="font-size: small;"><input id="tat_'.$testdata[0]['plab_tests']['test_id'].'" style="background-color: lightgray;" readonly type="number" name="test['.$testdata[0]['plab_tests']['test_id'].'][tat]"  value="'.$testdata[0]["plab_tests"]["tat"].'"></td>';
				$tetcodedata .= '<td width="5%" style="font-size: small;"><input id="deactivate" style="margin-right:10px;width:71px;" class="btn" type="button" value="Active" disabled/></td><td width="20%" style="font-size: small;"> 
								<input type="button" class="btn" id="edit_'.$testdata[0]['plab_tests']['test_id'].'" onclick="edit('.$testdata[0]['plab_tests']['test_id'].')" value="Edit"> 
								<input id="save_'.$testdata[0]['plab_tests']['test_id'].'" type="button" style="margin-right:10px;display:none" class="btn" onclick="save('.$testdata[0]['plab_tests']['test_id'].',1)" value="Save">
								<input id="remove_'.$testdata[0]['plab_tests']['test_id'].'" type="button" style="margin-right:10px;display:none" class="btn" onclick="save('.$testdata[0]['plab_tests']['test_id'].',0)" value="Remove">
								<input type="button" id="cancel_'.$testdata[0]['plab_tests']['test_id'].'" style="margin-right:10px;display:none" class="btn" onclick="cancel('.$testdata[0]['plab_tests']['test_id'].')" value="Cancel"></td></tr>';
			}
			else
			{
				$tetcodedata .= '<tr><td width="5%" style="font-size: small;">'.$count.'</td><td style="background-color: lightgray;" readonly width="15%" style="font-size: small;">'.$key['tests']['test_parameter']."</td>";
				$tetcodedata .= '<td style="background-color: lightgray;font-size: large;font-weight:600;" readonly width="15%" >'.$key['tests']['testcode'].'</td><td width="10%" style="font-size: small;"><input id="code_'.$key['tests']['id'].'" style="background-color: lightgray;" readonly type="text" id="test['.$key['tests']['id'].'][code]" name="test['.$key['tests']['id'].'][code]" value=""></td>';
				$tetcodedata .= '<td width="5%" style="font-size: small;"><input id="mrp_'.$key['tests']['id'].'" style="background-color: lightgray;" readonly type="number" id="test['.$key['tests']['id'].'][mrp]" name="test['.$key['tests']['id'].'][mrp]" value=""></td>';
				$tetcodedata .= '<td width="5%" style="font-size: small;"><input id="net_'.$key['tests']['id'].'" style="background-color: lightgray;" readonly type="number" id="test['.$key['tests']['id'].'][net_price]" name="test['.$key['tests']['id'].'][net_price]" value=""></td>';
				$tetcodedata .= '<td width="15%" style="font-size: small;"><input id="tat_'.$key['tests']['id'].'" style="background-color: lightgray;" readonly type="number" id="test['.$key['tests']['id'].'][tat]" name="test['.$key['tests']['id'].'][tat]" value=""></td>';
				$tetcodedata .= '<td width="5%" style="font-size: small;"><input id="activate" style="margin-right:10px; background: crimson;" class="btn" type="button" value="Deactive" disabled/></td><td width="20%" style="font-size: small;">
								<input type="button" id="edit_'.$key['tests']['id'].'" class="btn" onclick="edit('.$key['tests']['id'].')" value="Edit"> 
								<input type="button"  id="save_'.$key['tests']['id'].'" style="margin-right:10px;display:none" class="btn" onclick="save('.$key['tests']['id'].',1)" value="Add">
								<input type="button" id="cancel_'.$key['tests']['id'].'" style="margin-right:10px;display:none" class="btn" onclick="cancel('.$key['tests']['id'].')" value="Cancel"></td></tr>';
			}
			$count++;
		}
		$tetcodedata .="</table>";
		print_R($tetcodedata);
		die;
	}
	
	function admin_edit_citytests($plab_id=null)
	{
		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		
		$dec_plab_id = base64_decode($plab_id);
		$this->set('title_for_layout', 'Add Cities and Tests');
		$this->ProcessingLabs = ClassRegistry::init("ProcessingLabs");
		
		$this->PlabPincodeMaster = ClassRegistry::init("PlabPincodeMaster");
		$plab_list = $this->ProcessingLabs->find('list',array('fields'=>array('ProcessingLabs.id','ProcessingLabs.name')));
		$this->set('plabList',$plab_list);
		/*if(!empty($_POST))
		{
			if(isset($_FILES['file']['name']) && $_FILES['file']['name']!="")
			{
				$this->PlabPincodeMaster->query("delete from plab_pincode_master where lab_id='".$_POST['lab_id']."'");

				if ($_FILES["file"]["error"] > 0) {
					echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
				}
				else
				{
					$hfile = $this->File->uploadFile($_FILES['file'], EXCEL_FILE, true,array('xls','xlsx'));
					
					$excelReader = PHPExcel_IOFactory::createReaderForFile(EXCEL_FILE.$hfile['name']);
					$excelReader->setReadDataOnly(true);
					$excelObj = $excelReader->load(EXCEL_FILE.$hfile['name']);
					$worksheet = $excelObj->getSheet(0);
					$lastRow = $excelObj->setActiveSheetIndex(0)->getHighestRow();
					for ($row = 2; $row <= $lastRow; $row++) {
						echo "<br>";
						$planpincode = $this->PlabPincodeMaster->create();
						$planpincode['PlabPincodeMaster']['pincode_id'] = $worksheet->getCell('A'.$row)->getFormattedValue();
						$planpincode['PlabPincodeMaster']['lab_id'] = $_POST['lab_id'];
						$this->PlabPincodeMaster->save($planpincode);
					}
				}
			}
			else
			{
				//print_R($_POST);die;
				$this->PlabPincodeMaster->query("delete from plab_pincode_master where lab_id='".$_POST['lab_id']."'");
				$pincodes = explode(",",$_POST['pincodeliststring']);
				foreach($pincodes as $val)
				{
					if($val!="")
					{
						$planpincode = $this->PlabPincodeMaster->create();
						$planpincode['PlabPincodeMaster']['pincode_id'] = $val;
						$planpincode['PlabPincodeMaster']['lab_id'] = $_POST['lab_id'];
						$this->PlabPincodeMaster->save($planpincode);
					}
				}
			}
		}*/
		
		$pincodes = $this->PlabPincodeMaster->query('SELECT pincode_id FROM plab_pincode_master where lab_id='.$dec_plab_id.' order by id asc');
		
		$pincodelist=array();
		foreach($pincodes as $val)
		{
			array_push($pincodelist,$val['plab_pincode_master']['pincode_id']);
		}
		
		$this->set('pincodes',$pincodelist);
		$this->set('pincodestring',implode(",",$pincodelist));
		$this->set('lab_id',$dec_plab_id);
	}
	
	function admin_edit_test($plab_id=null)
	{
		$dec_plab_id = base64_decode($plab_id);
		$this->set('title_for_layout', 'Add Cities and Tests');
		$this->ProcessingLabs = ClassRegistry::init("ProcessingLabs");
		
		$this->PlabTests = ClassRegistry::init("PlabTests");
		
		$tests = $this->PlabTests->query('SELECT GROUP_CONCAT(test_id) FROM plab_tests where lab_id='.$dec_plab_id);
		$this->set('tests',$tests[0][0]['GROUP_CONCAT(test_id)']);
		$this->set('lab_id',$dec_plab_id);
	}
	
	function test_action()
	{
		$this->Test = ClassRegistry::init("Test");
		$this->PlabTests = ClassRegistry::init("PlabTests");
		if($_POST['status']==0)
		{
			$this->PlabTests->query('delete from plab_tests where test_id="'.$_POST['id'].'" and lab_id="'.$_POST['lab_id'].'"');
		}
		else{
			$plabtest = $this->PlabTests->query('select * from plab_tests where test_id="'.$_POST['id'].'" and lab_id="'.$_POST['lab_id'].'"');

			if($plabtest)
			{
				$this->PlabTests->query('update plab_tests set tescode="'.$_POST['testcode'].'",mrp="'.$_POST['mrp'].'",net_rate="'.$_POST['net'].'",tat="'.$_POST['tat'].'" where test_id="'.$_POST['id'].'" and lab_id="'.$_POST['lab_id'].'"');
			}
			else{
				$this->data = $this->PlabTests->create();
				$this->data['PlabTests']['lab_id'] = $_POST['lab_id'];
				$this->data['PlabTests']['test_id'] = $_POST['id'];
				$this->data['PlabTests']['mrp'] = $_POST['mrp'];
				$this->data['PlabTests']['net_rate'] = $_POST['net'];
				$this->data['PlabTests']['tescode'] = $_POST['testcode'];
				$this->data['PlabTests']['tat'] = $_POST['tat'];
				$this->PlabTests->save($this->data);
			}
		}
		
		$tests = $this->Test->query("select * from tests where test_parameter like '%".$_POST['search_param']."%' or testcode like '%".$_POST['search_param']."%'");
		//print_R($tests);die;

		$tetcodedata = "<table width='100%'>";
		$tetcodedata .= "<tr><th width='5%' style='font-size: large;'>S No.</th><th width='15%' style='font-size: large;'>Name</th><th width='10%' style='font-size: large;'>Testcode</th><th width='15%' style='font-size: large;'>MRP</th><th width='15%' style='font-size: large;'>Net Price</th><th width='15%' style='font-size: large;'>TAT (in hrs)</th><th width='5%' style='font-size: large;'>Status</th><th width='20%' style='font-size: large;'>Action</th></tr>";
		$count = 1;
		
		foreach($tests as $key)
		{
			$testdata = $this->PlabTests->query("SELECT * FROM plab_tests where lab_id='".$_POST["lab_id"]."' and test_id ='".$key['tests']['id']."'");
//			echo $_POST["plab_id"];
			//print_R($testdata);
			if($testdata)
			{
				$tetcodedata .= '<tr><td width="5%" style="font-size: small;">'.$count.'</td><td style="background-color: lightgray;" readonly width="15%" style="font-size: small;">'.$key['tests']['test_parameter']."</td>";
				$tetcodedata .= '<td width="10%" style="font-size: small;"><input id="code_'.$testdata[0]['plab_tests']['test_id'].'" style="background-color: lightgray;" readonly type="text" name="test['.$testdata[0]['plab_tests']['test_id'].'][code]"  value="'.$testdata[0]["plab_tests"]["tescode"].'"></td>';
				$tetcodedata .= '<td width="15%" style="font-size: small;"><input id="mrp_'.$testdata[0]['plab_tests']['test_id'].'" style="background-color: lightgray;" readonly type="number" name="test['.$testdata[0]['plab_tests']['test_id'].'][mrp]"  value="'.$testdata[0]["plab_tests"]["mrp"].'"></td>';
				$tetcodedata .= '<td width="15%" style="font-size: small;"><input id="net_'.$testdata[0]['plab_tests']['test_id'].'" style="background-color: lightgray;" readonly type="number" name="test['.$testdata[0]['plab_tests']['test_id'].'][net_price]"  value="'.$testdata[0]["plab_tests"]["net_rate"].'"></td>';
				$tetcodedata .= '<td width="15%" style="font-size: small;"><input id="tat_'.$testdata[0]['plab_tests']['test_id'].'" style="background-color: lightgray;" readonly type="number" name="test['.$testdata[0]['plab_tests']['test_id'].'][tat]"  value="'.$testdata[0]["plab_tests"]["tat"].'"></td>';
				$tetcodedata .= '<td width="5%" style="font-size: small;"><input id="deactivate" style="margin-right:10px;width:71px;" class="btn" type="button" value="Active" disabled/></td><td width="20%" style="font-size: small;"> 
								<input type="button" class="btn" id="edit_'.$testdata[0]['plab_tests']['test_id'].'" onclick="edit('.$testdata[0]['plab_tests']['test_id'].')" value="Edit"> 
								<input id="save_'.$testdata[0]['plab_tests']['test_id'].'" type="button" style="margin-right:10px;display:none" class="btn" onclick="save('.$testdata[0]['plab_tests']['test_id'].',1)" value="Save">
								<input id="remove_'.$testdata[0]['plab_tests']['test_id'].'" type="button" style="margin-right:10px;display:none" class="btn" onclick="save('.$testdata[0]['plab_tests']['test_id'].',0)" value="Remove">
								<input type="button" id="cancel_'.$testdata[0]['plab_tests']['test_id'].'" style="margin-right:10px;display:none" class="btn" onclick="cancel('.$testdata[0]['plab_tests']['test_id'].')" value="Cancel"></td></tr>';
			}
			else
			{
				$tetcodedata .= '<tr><td width="5%" style="font-size: small;">'.$count.'</td><td style="background-color: lightgray;" readonly width="15%" style="font-size: small;">'.$key['tests']['test_parameter']."</td>";
				$tetcodedata .= '<td width="10%" style="font-size: small;"><input id="code_'.$key['tests']['id'].'" style="background-color: lightgray;" readonly type="text" id="test['.$key['tests']['id'].'][code]" name="test['.$key['tests']['id'].'][code]" value=""></td>';
				$tetcodedata .= '<td width="15%" style="font-size: small;"><input id="mrp_'.$key['tests']['id'].'" style="background-color: lightgray;" readonly type="number" id="test['.$key['tests']['id'].'][mrp]" name="test['.$key['tests']['id'].'][mrp]" value=""></td>';
				$tetcodedata .= '<td width="15%" style="font-size: small;"><input id="net_'.$key['tests']['id'].'" style="background-color: lightgray;" readonly type="number" id="test['.$key['tests']['id'].'][net_price]" name="test['.$key['tests']['id'].'][net_price]" value=""></td>';
				$tetcodedata .= '<td width="15%" style="font-size: small;"><input id="tat_'.$key['tests']['id'].'" style="background-color: lightgray;" readonly type="number" id="test['.$key['tests']['id'].'][tat]" name="test['.$key['tests']['id'].'][tat]" value=""></td>';
				$tetcodedata .= '<td width="5%" style="font-size: small;"><input id="activate" style="margin-right:10px; background: crimson;" class="btn" type="button" value="Deactive" disabled/></td><td width="20%" style="font-size: small;">
								<input type="button" id="edit_'.$key['tests']['id'].'" class="btn" onclick="edit('.$key['tests']['id'].')" value="Edit"> 
								<input type="button"  id="save_'.$key['tests']['id'].'" style="margin-right:10px;display:none" class="btn" onclick="save('.$key['tests']['id'].',1)" value="Add">
								<input type="button" id="cancel_'.$key['tests']['id'].'" style="margin-right:10px;display:none" class="btn" onclick="cancel('.$key['tests']['id'].')" value="Cancel"></td></tr>';
			}
			$count++;
		}
		$tetcodedata .="</table>";
		print_R($tetcodedata);
		die;
	}
	
	function pincode_action()
	{
		$this->PlabPincodeMaster = ClassRegistry::init("PlabPincodeMaster");
		$pincodedata = "";
		if($_POST['val']==0)
		{
			$this->PlabPincodeMaster->query('delete from plab_pincode_master where pincode_id="'.$_POST['pincode'].'" and lab_id="'.$_POST['labid'].'"');
			$pincodedata = "<input id='activate' class='btn' style='background: crimson;' type='button' value='Deactive' disabled/>  <a href='#' onclick='pincode_action(1)'>Activate</a>";
		}
		else
		{
			$this->data = $this->PlabPincodeMaster->create();
			$this->data['PlabPincodeMaster']['lab_id'] = $_POST['labid'];
			$this->data['PlabPincodeMaster']['pincode_id'] = $_POST['pincode'];
			$this->PlabPincodeMaster->save($this->data);
			$pincodedata .= "<input id='deactivate' class='btn' type='button' value='Active' disabled/>  <a href='#' onclick='pincode_action(0)'>Deactivate</a>";
		}
		print_R($pincodedata);
		exit;
	}
	
	function pincode_search()
	{
		$this->layout="blank";
		$this->PlabPincodeMaster = ClassRegistry::init("PlabPincodeMaster");
		$this->PincodeMaster = ClassRegistry::init("PincodeMaster");
		$this->State = ClassRegistry::init("State");
		$this->City = ClassRegistry::init("City");
		$search_val = $_REQUEST['pincode'];
		$search_lab = $_REQUEST['labid'];
		
		$pincode = $this->PincodeMaster->find("first",array('conditions'=>array('PincodeMaster.pincode'=>$search_val)));
		
		if($pincode)
		{
			$city = $this->City->find('first',array('conditions'=>array('City.id'=>$pincode['PincodeMaster']['city'])));
			$state = $this->State->find('first',array('conditions'=>array('State.id'=>$pincode['PincodeMaster']['state'])));
				
			$selectedpincode = $this->PlabPincodeMaster->find("first",array('conditions'=>array('PlabPincodeMaster.pincode_id'=>$search_val,'PlabPincodeMaster.lab_id'=>$search_lab)));
			
			$pincodedata = "<table width='100%'><tr><th>S No.</th><th>Pincode</th><th>State</th><th>City</th><th>Action</th></tr>";
			$pincodedata .= "<tr><td>1</td><td>".$search_val."</td><td>".$state['State']['name']."</td><td>".$city['City']['name']."</td><td id='pincode_action'>";
			
			if(!$selectedpincode)
				$pincodedata .= "<input id='activate' class='btn' style='background: crimson;' type='button' value='Deactive' disabled/>  <a href='#' onclick='pincode_action(1)'>Activate</a>";
			else
				$pincodedata .= "<input id='deactivate' class='btn' type='button' value='Active' disabled/>   <a href='#' onclick='pincode_action(0)'>Deactivate</a>";
			
			$pincodedata .= "</td></tr></table>";
		}
		else
			$pincodedata .= "<span style='color:red;font-size: large;'>Invalid Pincode Entered</span>";
		
		print_R($pincodedata);
		exit;
	}
	
	function excel_download()
	{
		$this->PlabPincodeMaster = ClassRegistry::init("PlabPincodeMaster");
		$selectedpincode = $this->PlabPincodeMaster->find("all",array('conditions'=>array('PlabPincodeMaster.lab_id'=>$_REQUEST['labid'])));

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=processing_lab_pincode.csv');
		$output = fopen('php://output', 'w');
		
		fputcsv($output, array('S.No.', 'Pincode', 'State','City'));
		$count = 1;
		foreach ($selectedpincode as $keys => $values) 
		{
			$this->State = ClassRegistry::init("State");
			$this->City = ClassRegistry::init("City");
			$this->PincodeMaster = ClassRegistry::init("PincodeMaster");
			
			$pincode = $this->PincodeMaster->find("first",array('conditions'=>array('PincodeMaster.pincode'=>$values['PlabPincodeMaster']['pincode_id'])));
			$city = $this->City->find('first',array('conditions'=>array('City.id'=>$pincode['PincodeMaster']['city'])));
			$state = $this->State->find('first',array('conditions'=>array('State.id'=>$pincode['PincodeMaster']['state'])));
			fputcsv($output, array($count, $values['PlabPincodeMaster']['pincode_id'], $state['State']['name'],$city['City']['name']));
			$count++;
		}
		die;
	}
	
	function test_excel_download()
	{
		$this->PlabTests = ClassRegistry::init("PlabTests");
		$this->Test = ClassRegistry::init("Test");
		$this->ProcessingLabs = ClassRegistry::init("ProcessingLabs");
		
		$selectedtest = $this->PlabTests->find("all",array('conditions'=>array('PlabTests.lab_id'=>$_REQUEST['labid'])));

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=processing_lab_test.csv');
		$output = fopen('php://output', 'w');
		
		fputcsv($output, array('S.No.', 'Lab Name', 'NPL Test Code','Lab Test Code','Test Name','MRP','Net Price','TAT'));
		$count = 1;
		foreach ($selectedtest as $keys => $values) 
		{
			$this->State = ClassRegistry::init("State");
			$this->City = ClassRegistry::init("City");
			$this->PincodeMaster = ClassRegistry::init("PincodeMaster");
			
			$labdata = $this->ProcessingLabs->find("first",array('conditions'=>array('ProcessingLabs.id'=>$values['PlabTests']['lab_id'])));
			$testdata = $this->Test->find("first",array('conditions'=>array('Test.id'=>$values['PlabTests']['test_id'])));
			
			fputcsv($output, array($count, $labdata['ProcessingLabs']['name'], $testdata['Test']['testcode'],$values['PlabTests']['tescode'],$testdata['Test']['test_parameter'],$values['PlabTests']['mrp'],$values['PlabTests']['net_rate'],$values['PlabTests']['tat']));
			$count++;
		}
		die;
	}
}