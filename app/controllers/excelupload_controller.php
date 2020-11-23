<?php
class ExceluploadController extends AppController
{
	var $name = "Excelupload";
	var $uses=array('Lab','Api','Admin','PincodeMaster','City','State','TestDetails','Tests','LabCityMapping','PlabPincodeMaster','LabRateList','Ratelist');
	
	function admin_index(){
	
		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$usertype = $this->Session->read('Admin.userType');
		if(!empty($_POST) && isset($_FILES['file']))
		{
			$sampleSpecific = array("S"=>"5",  "T"=>"34" ,  "U"=>"21",  "V"=>"51",  "W"=>"59" ,  "X"=>"13","Y"=>"15","Z"=>"49",  "AA"=>"56",  "AB"=>"43");
			
			$authKey = $this->Api->find('first',array('conditions'=>array('Api.pcc_id'=>$_POST['Pcc'])));

			$samplespecificarray = array('S','T','U','V','W','X','Y','Z','AA','AB');
	
			if(isset($_POST['withsample']))
				$exceluploadindex = $this->arrayLoader($_POST['withsample']);
			else
				$exceluploadindex = $this->arrayLoader($_POST['withoutsample']);
		
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
				$lastColumn = $excelObj->setActiveSheetIndex(0)->getHighestColumn();
				$lastColumn++;
				$sampleCounter = 0;

				for ($row = 2; $row <= $lastRow; $row++) {

					$arrayInsert = array();
					if(isset($_POST['withsample']))
						$arrayInsert['Samples'] = array();
					$arrayInsert['authorization'] = $authKey['Api']['authorization'];
					$arrayInsert['serviced_pcc'] = $_POST['serviced_pcc'];
					$arrayInsert['booking_mode'] = "3";
					
					for ($column = 'A'; $column != $lastColumn; $column++) {
						if($worksheet->cellExists($column.$row)){
							if(isset($_POST['withsample']) && in_array($column, $samplespecificarray))
							{
								$arrayInsert['Samples'][$sampleCounter] = array('SrlNo'=>$sampleCounter,'SampleId'=>$sampleSpecific[$column],'BarcodeId'=>$worksheet->getCell($column.$row)->getFormattedValue());	
								$sampleCounter++;
							}
							else
							{
								if($exceluploadindex[$column]=='test_code')
								{
									$test_code = str_replace(' ','',$worksheet->getCell($column.$row)->getFormattedValue());
									$test_code = str_replace("\n", "", $test_code);
									$arrayInsert[$exceluploadindex[$column]] = explode(',', $test_code);	
								}
								else
								{
									if($exceluploadindex[$column]=='sample_collected_date'){
										/*if (PHPExcel_Shared_Date::isDateTime($worksheet->getCell($column.$row)->getFormattedValue())) {
											echo $worksheet->getCell($column.$row)->getFormattedValue();
											echo "<br>";
											$stamp_dateTime = PHPExcel_Shared_Date::ExcelToPHP($worksheet->getCell($column.$row)->getFormattedValue());
											$arrayInsert[$exceluploadindex[$column]] = date("d-m-Y H:i:s",$stamp_dateTime - 19800);	
										}
										else*/
											$arrayInsert[$exceluploadindex[$column]] = $worksheet->getCell($column.$row)->getFormattedValue();
									}
									else
									{
										$arrayInsert[$exceluploadindex[$column]] = $worksheet->getCell($column.$row)->getFormattedValue();
									}
								}
							}	

						}

					}

//					print_R(json_encode($arrayInsert));
//					echo "<br>";die;
					$ch = curl_init();
					$curlConfig = array(
					    CURLOPT_URL            => SITE_URL."api/addorder",
					    CURLOPT_POST           => true,
					    CURLOPT_RETURNTRANSFER => true,
					    CURLOPT_POSTFIELDS     => json_encode($arrayInsert),
					    CURLOPT_HTTPHEADER => array(
						"cache-control: no-cache",
						"content-type: application/json"
					    ),
					);
					curl_setopt_array($ch, $curlConfig);
					$result = curl_exec($ch);
					curl_close($ch);
					//print_R($result);
					$decoded_result = json_decode($result) ;
					print_R(json_encode($decoded_result));			
				}
				die;	
			}
		}
		else
		{

		}
		$list = $this->Lab->find('all',array('joins'=>array(array('table'=>'api_key','alias' => 'Labkey','conditions' => array('Labkey.pcc_id=Lab.id'))),'conditions'=>array('Lab.status'=>1))); // ,
		$this->set('labList',$list);
	}

	function admin_sample_excel()
	{
		$filename = "demowithout.xls";
		if($_GET['excel']=='withsample')
		{
			$exceldownloadindex =  $this->arrayLoader($_GET['excel']);
			$filename = "demowith.xls";
		}
		else
			$exceldownloadindex =  $this->arrayLoader($_GET['excel']);

		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$doc = new PHPExcel();
		$doc->setActiveSheetIndex(0);
 
		// read data to active sheet
		$doc->getActiveSheet()->fromArray($exceldownloadindex);
		 
		//save our workbook as this file name
		$filename = 'sample.xls';
		//mime type
		header("Content-type: application/octet-stream");
		//tell browser what's the file name
		header("Content-Disposition: attachment; filename=".$filename);
		header("Pragma: no-cache");
		header("Expires: 0");
		 
		$objWriter = PHPExcel_IOFactory::createWriter($doc, 'Excel5');
		 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		die;
	}
	
	public function arrayLoader($type)
	{
		if($type =='withsample')
		{
			return $excelwithsample = array(
				'A' =>'first_name',
				'B' =>'last_name',
				'C'=>'gender',
				'D'=>'age',
				'E'=>'contact_number',
				'F'=>'address',
				'G'=>'locality',
				'H'=>'city',
				'I'=>'state',
				'J'=>'zip_code',
				'K'=>'landmark',
				'L'=>'sample_collected_date',
				'M'=>'order_reference',
				'N'=>'email',
				'O'=>'discount_amt',
				'P'=>'remarks',
				'Q'=>'test_code',
				'R'=>'mrn',
				'S'=>'Sodium Citrate',
				'T'=>'SST (Serum) Yellow',
				'U'=>'Sodium Heparin',
				'V'=>'EDTA (Purple)',
				'W'=>'Sodium Fluoride (F/R)',
				'X'=>'Sodium Fluoride (PP)',
				'Y'=>'Swab',
				'Z'=>'Urine',
				'AA'=>'Stool',
				'AB'=>'Sputum',
			);
		}
		else
		{
			return $excelwithoutsample = array(
				'A' =>'first_name',
				'B' =>'last_name',
				'C'=>'gender',
				'D'=>'age',
				'E'=>'contact_number',
				'F'=>'address',
				'G'=>'locality',
				'H'=>'city',
				'I'=>'state',
				'J'=>'zip_code',
				'K'=>'landmark',
				'L'=>'sample_date',
				'M'=>'sample_time',
				'N'=>'order_reference',
				'O'=>'email',
				'P'=>'discount_amt',
				'Q'=>'remarks',
				'R'=>'test_code',
				'S'=>'mrn'
			);			
		}
			
	}

	public function admin_pincode_mapping()
	{
		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$usertype = $this->Session->read('Admin.userType');
		if(!empty($_POST) && isset($_FILES['file']))
		{
			//print_R($_FILES);die;
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
				$lastColumn = $excelObj->setActiveSheetIndex(0)->getHighestColumn();
				$lastColumn++;
				$sampleCounter = 0;

				for ($row = 2; $row <= $lastRow; $row++) {
					$pincodeArray = array();
					for ($column = 'A'; $column != $lastColumn; $column++) {
						echo $column."<br>";
						if($column == 'C')
						{
							$this->City = ClassRegistry::init('City');
							$this->City->create();
							$city = $this->City->find('first',array('conditions'=>array('City.name'=>$worksheet->getCell($column.$row)->getFormattedValue())));
							print_R($city);
							if(!$city || $city==''){
								echo "inside city";
								$cityArray = array();
								$cityArray['name'] = $worksheet->getCell($column.$row)->getFormattedValue();
								$cityArray['status'] = '1';
								$this->City->save($cityArray);
								echo $pincodeArray['city'] = $this->City->getLastInsertId();
							}
							else
								echo $pincodeArray['city'] = $city['City']['id'];
						}

						if($column == 'D')
						{
							$this->State = ClassRegistry::init('State');
							$this->State->create();
							$state = $this->State->find('first',array('conditions'=>array('State.name'=>$worksheet->getCell($column.$row)->getFormattedValue())));
							print_R($state);
							if(!$state){
								echo "inside state";
								$stateArray = array();
								$stateArray['name'] = $worksheet->getCell($column.$row)->getFormattedValue();
								$stateArray['status'] = '1';
								$this->State->save($stateArray);
								echo $pincodeArray['state'] = $this->State->getLastInsertId();
							}
							else
								echo $pincodeArray['state'] = $state['State']['id'];							
						}
						if($column == 'A')
						{
							echo $pincodeArray['locality'] = $worksheet->getCell($column.$row)->getFormattedValue();echo "33<br>";
						}
						if($column == 'B')
						{
							echo $pincodeArray['pincode'] = $worksheet->getCell($column.$row)->getFormattedValue();echo "44<br>";
						}
					}
					print_R($pincodeArray);
					$this->PincodeMaster = ClassRegistry::init('PincodeMaster');
					$this->PincodeMaster->create();
					$this->PincodeMaster->save($pincodeArray);
					echo "<br><br>";
				}
				die;	
			}
		}
	}

	public function admin_report()
	{
		$from_date = date('2018-1-1');
		$to_date = date('2018-12-31');
		$conditions = array();
		$conditions['s_date >='] = $from_date;
		$conditions['s_date <='] = $to_date;
		//$conditions['requ_status'] = 5;
		$conditions['ref_num >'] = 0;
		$conditions['OR'] = array(
					array(
						'requ_status'=>6,
						),
					array(
						'requ_status'=>7,'report_type'=>'partial',
					),
					array(
						'requ_status'=>9,
						)
				);
		$this->Health = ClassRegistry::init('Health');
		$data = $this->Health->find('all',array('fields'=>array('id','ref_num','patient_report','s_date'),'conditions'=>$conditions));	
		$count = 1;
		foreach($data as $val)
		{
			echo $count."------".$val['Health']['s_date']."----";
			echo $val['Health']['id'];
			echo PATIENT_REPORT_STORE_PATH.$val['Health']['patient_report'];
			echo "<br>";
			if(file_exists(PATIENT_REPORT_STORE_PATH.$val['Health']['patient_report']))
				echo "file exist<br>";
			else
				echo "file not exist<br>";
			$fileMoved='';
			$file = explode('/',$val['Health']['patient_report']);
			if($file[0]=='2015')
			{
				echo "2015<br>";
				$fileMoved = rename(PATIENT_REPORT_STORE_PATH.$val['Health']['patient_report'],PATIENT_REPORT_STORE_PATH."2018/".$file[1]);
				$this->Health->updateAll(array('Health.patient_report'=>"'".'2018/'.$file[1]."'"),array('Health.id'=>$val['Health']['id']));
				echo PATIENT_REPORT_STORE_PATH."2018/".$file[1];
			}
			else
			{
				echo PATIENT_REPORT_STORE_PATH."2018/".$val['Health']['patient_report'];
			}
			if(!isset($file[1]))
			{
				echo "other<br>";
				$fileMoved = rename(PATIENT_REPORT_STORE_PATH.$val['Health']['patient_report'],PATIENT_REPORT_STORE_PATH."2018/".$val['Health']['patient_report']);
				$this->Health->updateAll(array('Health.patient_report'=>"'".'2018/'.$val['Health']['patient_report']."'"),array('Health.id'=>$val['Health']['id']));
			}
			if($fileMoved){
				echo 'Success!';
			}
			else
			{
				echo '-------failed';
			}
			echo "<br><br>";
			//die;
			$count++;
		}
		print_R($data);die;
	}
	
	public function admin_reportsecond()
	{
		$from_date = date('2018-7-1');
		$to_date = date('2018-12-31');
		$conditions = array();
		$conditions['s_date >='] = $from_date;
		$conditions['s_date <='] = $to_date;
		//$conditions['requ_status'] = 5;
		$conditions['ref_num >'] = 0;
		$conditions['OR'] = array(
					array(
						'requ_status'=>6,
						),
					array(
						'requ_status'=>7,'report_type'=>'partial',
					),
					array(
						'requ_status'=>9,
						)
				);
		$this->Health = ClassRegistry::init('Health');
		$data = $this->Health->find('all',array('fields'=>array('id','ref_num','patient_report','s_date'),'conditions'=>$conditions));	
		$count = 1;
		foreach($data as $val)
		{
			echo $count."------".$val['Health']['s_date']."----";
			echo $val['Health']['id'];
			echo PATIENT_REPORT_STORE_PATH.$val['Health']['patient_report'];
			echo "<br>";
			if(file_exists(PATIENT_REPORT_STORE_PATH.$val['Health']['patient_report']))
				echo "file exist<br>";
			else
				echo "file not exist<br>";
			$fileMoved='';
			$file = explode('/',$val['Health']['patient_report']);
			if($file[0]=='2018')
			{
				echo "2018_2<br>";
				$fileMoved = rename(PATIENT_REPORT_STORE_PATH.$val['Health']['patient_report'],PATIENT_REPORT_STORE_PATH."2018_2/".$file[1]);
				$this->Health->updateAll(array('Health.patient_report'=>"'".'2018_2/'.$file[1]."'"),array('Health.id'=>$val['Health']['id']));
				echo PATIENT_REPORT_STORE_PATH."2018/".$file[1];
			}
			else
			{
				echo PATIENT_REPORT_STORE_PATH."2018_2/".$val['Health']['patient_report'];
			}
			if(!isset($file[1]))
			{
				echo "other<br>";
				$fileMoved = rename(PATIENT_REPORT_STORE_PATH.$val['Health']['patient_report'],PATIENT_REPORT_STORE_PATH."2018_2/".$val['Health']['patient_report']);
				$this->Health->updateAll(array('Health.patient_report'=>"'".'2018_2/'.$val['Health']['patient_report']."'"),array('Health.id'=>$val['Health']['id']));
			}
			if($fileMoved){
				echo 'Success!';
			}
			else
			{
				echo '-------failed';
			}
			echo "<br><br>";
			//die;
			$count++;
		}
		print_R($data);die;
	}
	
	/*public function admin_test_detail()
	{
		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$usertype = $this->Session->read('Admin.userType');
		if(!empty($_POST) && isset($_FILES['file']))
		{
			//print_R($_FILES);die;
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
				$lastColumn = $excelObj->setActiveSheetIndex(0)->getHighestColumn();
				$lastColumn++;
				$sampleCounter = 0;
				$this->Tests = ClassRegistry::init('Tests');
				for ($row = 2; $row <= $lastRow; $row++) {
					$data = $this->Tests->find('first',array('fields'=>array('id'),'conditions'=>array('testcode'=>$worksheet->getCell("A".$row)->getFormattedValue())));	
					
					$this->TestDetails = ClassRegistry::init('TestDetails');
					$this->TestDetails->create();	
					$testdetails = array();
					$testid="";
					$check=0;
					if(!empty($data))
					{
						$testid = $data['Tests']['id'];
						$check = 1;
					}
					
					$testdetails['test_id'] = $testid;
					$testdetails['also_known_as'] = $worksheet->getCell("C".$row)->getFormattedValue();
					$testdetails['formal_name'] = $worksheet->getCell("D".$row)->getFormattedValue();
					$testdetails['why_to'] = $worksheet->getCell("E".$row)->getFormattedValue();
					$testdetails['when_to'] = $worksheet->getCell("F".$row)->getFormattedValue();
					$testdetails['sample_instruction'] = $worksheet->getCell("G".$row)->getFormattedValue();
					$testdetails['test_preparation'] = $worksheet->getCell("H".$row)->getFormattedValue();
					$testdetails['what'] = $worksheet->getCell("I".$row)->getFormattedValue();
					$testdetails['how'] = $worksheet->getCell("J".$row)->getFormattedValue();
					$testdetails['when_ordered'] = $worksheet->getCell("K".$row)->getFormattedValue();
					$testdetails['what_result_mean'] = $worksheet->getCell("L".$row)->getFormattedValue();
					$testdetails['anything_else_to_know'] = $worksheet->getCell("M".$row)->getFormattedValue();
					$testdetails['remark'] = $worksheet->getCell("N".$row)->getFormattedValue();
					$testdetails['final_check'] = $check;
					//print_R($testdetails);
					$this->TestDetails->save($testdetails);	
					//echo "<br><br>";
				}
				die;	
			}
		}
	}*/
	
	public function admin_test_detail()
	{
		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$usertype = $this->Session->read('Admin.userType');
		if(!empty($_POST) && isset($_FILES['file']))
		{
			//print_R($_FILES);die;
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
				$lastColumn = $excelObj->setActiveSheetIndex(0)->getHighestColumn();
				$lastColumn++;
				$sampleCounter = 0;
				$count=0;
				
				for ($row = 2; $row <= $lastRow; $row++) {
					$this->Tests = ClassRegistry::init('Tests');
					$this->Tests->query('update tests set sample="",methodology="",testscode="",observation_id="" where testcode="'.$worksheet->getCell("C".$row)->getFormattedValue().'"');
				}
				
				for ($row = 2; $row <= $lastRow; $row++) {
					//echo $worksheet->getCell("C".$row)->getFormattedValue()."<br>";
					$this->Tests = ClassRegistry::init('Tests');
					$data = $this->Tests->find('first',array('conditions'=>array('Tests.testcode'=>$worksheet->getCell("C".$row)->getFormattedValue())));	
					print_R($worksheet->getCell("C".$row)->getFormattedValue());
					if(!empty($data))
					{
						if(!empty($data['Tests']['observation_id']))
							$observation = explode(',',$data['Tests']['observation_id']);
						else
							$observation = array();
						
						if(!empty($data['Tests']['methodology']))
							$methods = explode(',',$data['Tests']['methodology']);
						else
							$methods = array();
							
						if(!empty($data['Tests']['sample']))
							$sample_id = explode(',',$data['Tests']['sample']);
						else
							$sample_id = array();
						
						//print_R($data['Tests']['id']);
						//echo "-----";
						
						if(!in_array($worksheet->getCell("E".$row)->getFormattedValue(),$observation))
							array_push($observation,$worksheet->getCell("E".$row)->getFormattedValue());
						
						if(!in_array($worksheet->getCell("H".$row)->getFormattedValue(),$methods))
							array_push($methods,$worksheet->getCell("H".$row)->getFormattedValue());
						
						$this->samplemaster = ClassRegistry::init("Samplemaster");
						
						$samplename = $this->samplemaster->find('first',array('conditions'=>array('Samplemaster.type'=>$worksheet->getCell("G".$row)->getFormattedValue())));
						
						
						if(!in_array($samplename['Samplemaster']['sample_id'],$sample_id))
							array_push($sample_id,$samplename['Samplemaster']['sample_id']);
						//print_R($sample_id);die;
						$mrp = $worksheet->getCell("N".$row)->getFormattedValue();
					//	print_R($observation);
					//	echo "------";
						//print_R($methods);
						//echo "------";
						
					//	print_R($sample_id);
						echo "<br>";

						//print_R("update tests set observation_id='".implode(',',$observation)."',methodology='".implode(',',$methods)."',sample='".implode(',',$sample_id)."' where id='".$data['Health']['id']."'");
						//echo "<br>";
						$this->Tests->query("update tests set type='TEST',mrp='".$mrp."',observation_id='".implode(',',array_filter($observation))."',methodology='".implode(', ',array_filter($methods))."',sample='".implode(',',array_filter($sample_id))."' where id='".$data['Tests']['id']."'");	
						$count++;
					}
					else
					{
						$tests = $this->Tests->create();
						$tests['Tests']['type'] = 'TEST';
						$tests['Tests']['testcode'] = $worksheet->getCell("C".$row)->getFormattedValue();
						$tests['Tests']['test_parameter'] = $worksheet->getCell("D".$row)->getFormattedValue();
						$tests['Tests']['observation_id'] = $worksheet->getCell("E".$row)->getFormattedValue();
						
						$this->samplemaster = ClassRegistry::init("Samplemaster");
						$samplename = $this->samplemaster->find('first',array('conditions'=>array('Samplemaster.type'=>$worksheet->getCell("G".$row)->getFormattedValue())));
						
						$tests['Tests']['sample'] = $samplename['Samplemaster']['sample_id'];
						$tests['Tests']['methodology'] = $worksheet->getCell("H".$row)->getFormattedValue();
						$tests['Tests']['add_date'] = date('Y-m-d h:i:s');
						$tests['Tests']['profit_margin_category'] = $worksheet->getCell("I".$row)->getFormattedValue();
						print_R($tests);
						if($this->Tests->save($tests))
						{
							echo "success-----------";
						}
						else
						{
							echo "failure---------";
						}
						
						for ($column = 'A'; $column != $lastColumn; $column++) {
							print_R($worksheet->getCell($column.$row)->getFormattedValue());
							echo ",";
						}
						//die;
						$count++;
						echo "<br>";
					}
				}
				print_R($count);
				die;	
			}
		}
	}
	
	public function admin_package_detail()
	{
		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$usertype = $this->Session->read('Admin.userType');
		if(!empty($_POST) && isset($_FILES['file']))
		{
			//print_R($_FILES);die;
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
				$lastColumn = $excelObj->setActiveSheetIndex(0)->getHighestColumn();
				$lastColumn++;
				$total = array();
				$notfound = array();
				
				/*for ($row = 2; $row <= $lastRow; $row++) {
					$this->Tests = ClassRegistry::init('Tests');
					$this->Tests->query('update tests set testscode="",observation_id="" where testcode="'.$worksheet->getCell("B".$row)->getFormattedValue().'"');
				}*/
				$notfoundcount = 0;
				for ($row = 2; $row <= $lastRow; $row++) {
					if(!in_array($worksheet->getCell("C".$row)->getFormattedValue(),$total))
						array_push($total,$worksheet->getCell("C".$row)->getFormattedValue());
						
					$this->Tests = ClassRegistry::init('Tests');
					$data = $this->Tests->find('first',array('conditions'=>array('Tests.testcode'=>$worksheet->getCell("B".$row)->getFormattedValue())));	
					//print_R($worksheet->getCell("C".$row)->getFormattedValue());
					if(empty($data))
					{
						$testdata = $this->Tests->find('first',array('conditions'=>array('Tests.testcode'=>$worksheet->getCell("F".$row)->getFormattedValue())));
						
						$tests = $this->Tests->create();
						$tests['Tests']['type'] = 'PROFILE';
						$tests['Tests']['testcode'] = $worksheet->getCell("C".$row)->getFormattedValue();
						$tests['Tests']['test_parameter'] = $worksheet->getCell("D".$row)->getFormattedValue();
						
						$observation_id=array();
						$testscode = array();
						$methods = array();
						$sample_id = array();
						
						array_push($observation_id,$testdata['Tests']['observation_id']);
						array_push($testscode,$testdata['Tests']['id']);
						array_push($methods ,$testdata['Tests']['methodology']);
						array_push($sample_id,$testdata['Tests']['sample']);
						
						$tests['Tests']['observation_id'] = implode(',',$observation_id);
						$tests['Tests']['testscode'] = implode(',',$testscode);
						$tests['Tests']['sample'] = implode(',',$sample_id);
						$tests['Tests']['methodology'] = implode(',',$methods);
						$tests['Tests']['add_date'] = date('Y-m-d h:i:s');
						$tests['Tests']['profit_margin_category'] = "";
						
						print_R($tests);
						echo "<br>";
						/*if($this->Tests->save($tests))
						{
							echo "success-----------";
						}
						else
						{
							echo "failure---------";
						}*/
					}
					else
					{
						$testdata = $this->Tests->find('first',array('conditions'=>array('Tests.testcode'=>$worksheet->getCell("F".$row)->getFormattedValue())));
						//print_R($worksheet->getCell("D".$row)->getFormattedValue()."---------------");
						//print_R($testdata);
						$observation_id="";
						$testscode = "";
						$methods = "";
						$sample_id = "";
						
						if(empty($data['Tests']['observation_id']))
							$observation_id = $testdata['Tests']['observation_id'];
						else
							$observation_id = $data['Tests']['observation_id'].",".$testdata['Tests']['observation_id'];
						
						if(empty($data['Tests']['testscode']))
							$testscode = $testdata['Tests']['id'];
						else
							$testscode = $data['Tests']['testscode'].",".$testdata['Tests']['id'];
						
						if(empty($data['Tests']['methodology']))
							$methods = $testdata['Tests']['methodology'];
						else
							$methods = $data['Tests']['methodology'].",".$testdata['Tests']['methodology'];
						
						if(empty($data['Tests']['sample']))
							$sample_id = $testdata['Tests']['sample'];
						else
							$sample_id = $data['Tests']['sample'].",".$testdata['Tests']['sample'];
						
						$observation_id = array_unique(explode(",",$observation_id));
						$testscode = array_unique(explode(",",$testscode));
						$methods = array_unique(explode(",",$methods));
						$sample_id = array_unique(explode(",",$sample_id));
						//$mrp = $worksheet->getCell("G".$row)->getFormattedValue();
						
						//print_R("update tests set testscode='".implode(',',array_filter($testscode))."',type='PROFILE',observation_id='".implode(',',array_filter($observation_id))."',methodology='".implode(', ',array_filter($methods))."',sample='".implode(',',array_filter($sample_id))."' where id='".$data['Tests']['id']."'");
						//print_R("update tests set testscode='".implode(',',array_filter($testscode))."',type='PROFILE',mrp='".$mrp."',observation_id='".implode(',',array_filter($observation_id))."',methodology='".implode(', ',array_filter($methods))."',sample='".implode(',',array_filter($sample_id))."' where id='".$data['Tests']['id']."'");
						//print_R($worksheet->getCell("B".$row)->getFormattedValue());
						//print_R($testscode);
						echo "<br>";
						$this->Tests->query("update tests set testscode='".implode(',',array_filter($testscode))."',type='PROFILE',observation_id='".implode(',',array_filter($observation_id))."',methodology='".implode(', ',array_filter($methods))."',sample='".implode(',',array_filter($sample_id))."' where id='".$data['Tests']['id']."'");	
					}					
				}
				//print_R($notfoundcount."---------------");
				//print_R($notfound);
				//echo "<br>";
				//echo count($notfound);
				//echo "<br>";
				//echo count($total);
				die;	
			}
		}
	}


	public function admin_observation_detail()
	{
		//print_R("hello");die;
		//Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$usertype = $this->Session->read('Admin.userType');
		if(!empty($_POST) && isset($_FILES['file']))
		{
			//print_R($_POST);
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
				$lastColumn = $excelObj->setActiveSheetIndex(0)->getHighestColumn();
				$lastColumn++;
				$sampleCounter = 0;
				
				for ($row = 2; $row <= $lastRow; $row++) {
					
					$this->Observation = ClassRegistry::init('Observation');
					$observation = $this->Observation->find('first',array('conditions'=>array('Observation.observation_id'=>$worksheet->getCell("A".$row)->getFormattedValue())));
					//print_R($observation);
					if(!empty($observation))
					{
						$this->Observation->query("update observations set active='1' where observation_id='".$worksheet->getCell("A".$row)->getFormattedValue()."'");
						print_R($worksheet->getCell("A".$row)->getFormattedValue());
						echo "<br>";
					}
					else
					{
						$obs = $this->Observation->create();
						echo "----".$obs['observation_id'] = $worksheet->getCell("A".$row)->getFormattedValue();
						echo "----".$obs['observation_name'] = $worksheet->getCell("B".$row)->getFormattedValue();
						echo "----".$obs['method'] = $worksheet->getCell("C".$row)->getFormattedValue();
						echo "----".$obs['os_inhouse'] = "";
						echo "----".$obs['gender'] = $worksheet->getCell("E".$row)->getFormattedValue();
						
						//$this->Sample = ClassRegistry::init('Samplemaster');
						//$testid = $this->Sample->find('first',array('conditions'=>array('Samplemaster.sample_id'=>$sample_id)));
						echo "-----".$obs['sample_type']="0";
						//print_R($testid);
						echo "<br>";
						echo $count."<br>";
						
						$obs_id = $this->Observation->save($obs);
					}
					//die;
				}
				die;	
			}
		}
	}
	
	public function admin_citylab()
	{
		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$usertype = $this->Session->read('Admin.userType');
		$labid = array('121','122');
		if(!empty($_POST) && isset($_FILES['file']))
		{
			//print_R($_FILES);die;
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
				$lastColumn = $excelObj->setActiveSheetIndex(0)->getHighestColumn();
				$lastColumn++;
				$sampleCounter = 0;
				$this->City = ClassRegistry::init('City');
				foreach($labid as $key)
				{
					echo $key;
					for ($row = 2; $row <= $lastRow; $row++) {
						
						//$city_id = $this->City->query('select * from cities where name like "%'.$worksheet->getCell("B".$row)->getFormattedValue().'%"');
						$city_id = $this->City->find('first',array('conditions'=>array('City.name'=>$worksheet->getCell("B".$row)->getFormattedValue())));
						$this->LabCityMapping = ClassRegistry::init('LabCityMapping');
						$this->LabCityMapping->create();	
						$labcity = array();
						print_R($city_id);
						//echo $city_id['City']['name'];
						$labcity['city_id'] = $city_id['City']['id'];
						$labcity['lab_id'] = $key;
						$labcity['lab_city_id'] = $worksheet->getCell("A".$row)->getFormattedValue();
						print_R($labcity);
						$this->LabCityMapping->save($labcity);	
						echo "<br>";
					}
					echo "<br><br>";
				}
				die;	
			}
		}
	}
	
	public function admin_pincodemasterupdate()
	{
		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$usertype = $this->Session->read('Admin.userType');
		//$labid = array('121','122');
		if(!empty($_POST) && isset($_FILES['file']))
		{
			//print_R($_FILES);die;
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
				$lastColumn = $excelObj->setActiveSheetIndex(0)->getHighestColumn();
				$lastColumn++;
				$sampleCounter = 0;
				$this->PincodeMaster = ClassRegistry::init('PincodeMaster');
				for ($row = 2; $row <= $lastRow; $row++) {
					print_R($worksheet->getCell("B".$row)->getFormattedValue());
					echo "<br>";
					$this->PincodeMaster->query('update pincode_master set itwoh_servicability = 1 where pincode="'.$worksheet->getCell("B".$row)->getFormattedValue().'"');//$worksheet->getCell("B".$row)->getFormattedValue()
				}
				echo "<br><br>";die;
			}
		}
		//die;	
	}
	
	public function admin_plabpincode()
	{
		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$usertype = $this->Session->read('Admin.userType');
		$labid = array('121','122');
		if(!empty($_POST) && isset($_FILES['file']))
		{
			//print_R($_FILES);die;
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
				$lastColumn = $excelObj->setActiveSheetIndex(0)->getHighestColumn();
				$lastColumn++;
				$sampleCounter = 0;
				$this->PlabPincodeMaster = ClassRegistry::init('PlabPincodeMaster');
				for ($row = 2; $row <= $lastRow; $row++) {
					$this->data = $this->PlabPincodeMaster->create();
					$this->data['PlabPincodeMaster']['lab_id'] = '1';
					$this->data['PlabPincodeMaster']['pincode_id'] = $worksheet->getCell('A'.$row)->getFormattedValue();
					
					$this->PlabPincodeMaster->save($this->data);
					
					for ($column = 'A'; $column != $lastColumn; $column++) {
							print_R($worksheet->getCell($column.$row)->getFormattedValue());
							echo ",";
						}
						echo "<br>";
				}
				echo "<br><br>";die;
			}
		}
		//die;	
	}
	
	public function admin_user_clean()
	{
		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		if(!empty($_POST) && isset($_FILES['file']))
		{
			//print_R($_FILES);die;
			if ($_FILES["file"]["error"] > 0) {
				echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			}
			else
			{
				$hfile = $this->File->uploadFile($_FILES['file'], EXCEL_FILE, true,array('xls','xlsx'));
				//print_R($hfile);die;
				$excelReader = PHPExcel_IOFactory::createReaderForFile(EXCEL_FILE.$hfile['name']);
				$excelReader->setReadDataOnly(true);
				$excelObj = $excelReader->load(EXCEL_FILE.$hfile['name']);
				$worksheet = $excelObj->getSheet(0);
				$lastRow = $excelObj->setActiveSheetIndex(0)->getHighestRow();
				$lastColumn = $excelObj->setActiveSheetIndex(0)->getHighestColumn();
				$lastColumn++;
				$sampleCounter = 0;
				
				$this->Health = ClassRegistry::init('Health');
				$this->User = ClassRegistry::init('User');
				$this->Billing = ClassRegistry::init('Billing');
				//$this->PincodeMaster = ClassRegistry::init('PincodeMaster');
				for ($row = 2; $row <= $lastRow; $row++) {
					if($worksheet->getCell("A".$row)->getFormattedValue() == $worksheet->getCell("V".$row)->getFormattedValue())
					{
						$this->User->Query('update users set username="'.$worksheet->getCell("B".$row)->getFormattedValue().'",email="'.$worksheet->getCell("C".$row)->getFormattedValue().'"
								,alternate_email="'.$worksheet->getCell("D".$row)->getFormattedValue().'",passwd="'.$worksheet->getCell("E".$row)->getFormattedValue().'"
								,status="'.$worksheet->getCell("F".$row)->getFormattedValue().'",name="'.$worksheet->getCell("G".$row)->getFormattedValue().'",first_name="'.$worksheet->getCell("H".$row)->getFormattedValue().'"
								,last_name="'.$worksheet->getCell("I".$row)->getFormattedValue().'",gender="'.$worksheet->getCell("J".$row)->getFormattedValue().'",age="'.$worksheet->getCell("K".$row)->getFormattedValue().'"
								,contact="'.$worksheet->getCell("L".$row)->getFormattedValue().'",alternate_contact="'.$worksheet->getCell("M".$row)->getFormattedValue().'"
								,address="'.$worksheet->getCell("N".$row)->getFormattedValue().'",locality="'.$worksheet->getCell("O".$row)->getFormattedValue().'",city="'.$worksheet->getCell("P".$row)->getFormattedValue().'"
								,state="'.$worksheet->getCell("Q".$row)->getFormattedValue().'",pincode="'.$worksheet->getCell("R".$row)->getFormattedValue().'"
								,landmark="'.$worksheet->getCell("S".$row)->getFormattedValue().'",created_by="'.$worksheet->getCell("T".$row)->getFormattedValue().'" where id="'.$worksheet->getCell("A".$row)->getFormattedValue().'"');
						print_R($worksheet->getCell("A".$row)->getFormattedValue());
						echo "<br>";
					}
					else
					{
						$this->Health->Query('update healths set user_id="'.$worksheet->getCell("V".$row)->getFormattedValue().'" where user_id="'.$worksheet->getCell("A".$row)->getFormattedValue().'"');
						$this->Billing->Query('update billings set user_id="'.$worksheet->getCell("V".$row)->getFormattedValue().'" where user_id="'.$worksheet->getCell("A".$row)->getFormattedValue().'"');
						$this->User->Query('delete from users where id="'.$worksheet->getCell("A".$row)->getFormattedValue().'"');
					}
					//$this->PincodeMaster->query('update pincode_master set droplet_city_id="'.$worksheet->getCell("A".$row)->getFormattedValue().'" where pincode="'.$worksheet->getCell("B".$row)->getFormattedValue().'"');//$worksheet->getCell("B".$row)->getFormattedValue()
				}
				echo "<br><br>";die;
			}
		}
	}
	
	public function admin_ratelist()
	{
		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$usertype = $this->Session->read('Admin.userType');
		if(!empty($_POST) && isset($_FILES['file']))
		{
			$this->Ratelist = ClassRegistry::init('Ratelist');
			$this->rate = $this->Ratelist->create();
			$this->rate['Ratelist']['name'] = $_POST['ratelist_name'];
			$this->Ratelist->save($this->rate);
			$rate_id = $this->Ratelist->getLastInsertId();
			
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
				$lastColumn = $excelObj->setActiveSheetIndex(0)->getHighestColumn();
				$lastColumn++;
				$sampleCounter = 0;
				$this->LabRateList = ClassRegistry::init('LabRateList');
				$this->Test = ClassRegistry::init('Test');
				for ($row = 2; $row <= $lastRow; $row++) {
					$test = $this->Test->find('first',array('conditions'=>array('Test.testcode'=>$worksheet->getCell('A'.$row)->getFormattedValue())));
					$this->data = $this->LabRateList->create();
					$this->data['LabRateList']['rate_list_id'] = $rate_id;
					$this->data['LabRateList']['test_id'] = $test['Test']['id'];
					$this->data['LabRateList']['custom_mrp'] = $worksheet->getCell('E'.$row)->getFormattedValue();
					
					$this->LabRateList->save($this->data);
					
					for ($column = 'A'; $column != $lastColumn; $column++) {
							print_R($worksheet->getCell($column.$row)->getFormattedValue());
							echo ",";
						}
						echo "<br>";
				}
				echo "<br><br>";die;
			}
		}
		//die;	
	}
	
	public function admin_package_estimation()
	{
		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$usertype = $this->Session->read('Admin.userType');
		
		$ratelist = $this->Ratelist->find('list',array('fields'=>array('Ratelist.id','Ratelist.name')));
		$this->set('ratelist',$ratelist);
		
		if(!empty($_POST) && isset($_FILES['file']))
		{
//			print_R($_FILES);
//			print_R($_POST);
//			die;
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
				$lastColumn = $excelObj->setActiveSheetIndex(0)->getHighestColumn();
				$lastColumn++;
				$sampleCounter = 0;
				
				$this->Test = ClassRegistry::init('Test');
				$this->LabRateList = ClassRegistry::init('LabRateList');
				
				header("Content-type: application/octet-stream");
		//tell browser what's the file name
				header("Content-Disposition: attachment; filename=result.xls");
				header("Pragma: no-cache");
				header("Expires: 0");

				$objPHPExcel->setActiveSheetIndex(0);
			    $worksheet1 = $objPHPExcel->getActiveSheet();
				
				for ($row = 1; $row <= $lastRow; $row++) {
					for ($column = 'A'; $column != $lastColumn; $column++) {
						 $worksheet1->setCellValue($column.$row, $worksheet->getCell($column.$row)->getFormattedValue());
					}
					if($row==1)
					{
						$worksheet1->setCellValue('D'.$row, 'Status');
						$worksheet1->setCellValue('E'.$row, 'Package cost');
						$worksheet1->setCellValue('F'.$row, 'Tests Not Available');
						$worksheet1->setCellValue('G'.$row, 'Tests Not Found');
						$worksheet1->setCellValue('H'.$row, 'Test Name');
					}
					else
					{
						if($worksheet->getCell('C'.$row)->getFormattedValue()!='None' || !empty($worksheet->getCell('C'.$row)->getFormattedValue()))
						{
							$tests = explode(',',$worksheet->getCell('C'.$row)->getFormattedValue());
							$totalamount = 0;
							$tesname = "";
							$not_available = "";
							$not_found = "";
							foreach($tests as $val)
							{
								$testname = $this->Test->find('first',array('conditions'=>array('Test.testcode'=>$val)));

								$ratelist = $this->LabRateList->find('first',array('conditions'=>array('LabRateList.rate_list_id'=>$_POST['packageratelist'],'LabRateList.test_id'=>$testname['Test']['id'])));
								
								if(!empty($ratelist))
								{
									if($ratelist['LabRateList']['custom_mrp'] == 0)
									{
										$not_available .= "Test Code ".$val."- not Available,";
									}
									$tesname .= $testname['Test']['test_parameter']." (".$val.") ,";
								}
								else
								{
									$not_found .= "Test Code ".$val."- not Found,";
								}
								
								$totalamount = $totalamount + $ratelist['LabRateList']['custom_mrp'];
							}
							if(!empty($not_found)||!empty($not_available))
							{
								$worksheet1->setCellValue('E'.$row, 'N/A');
								$worksheet1->setCellValue('D'.$row, "N/A");
								$worksheet1->setCellValue('H'.$row, $tesname);
							}
							else
							{
								$worksheet1->setCellValue('E'.$row, $totalamount);
								$worksheet1->setCellValue('D'.$row, "OK");
								$worksheet1->setCellValue('H'.$row, $tesname);
							}
							
							if(!empty($not_available))
								$worksheet1->setCellValue('F'.$row, $not_available);
							else
								$worksheet1->setCellValue('F'.$row, 'N/A');
							
							if(!empty($not_found))
								$worksheet1->setCellValue('G'.$row, $not_found);
							else
								$worksheet1->setCellValue('G'.$row, 'N/A');
						}
						else
						{
							$worksheet1->setCellValue('E'.$row, 'N/A');
							$worksheet1->setCellValue('F'.$row, 'N/A');
							$worksheet1->setCellValue('G'.$row, 'N/A');
							$worksheet1->setCellValue('H'.$row, 'N/A');
						}
					}
						//echo "<br>";
				}
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
				//echo "<br><br>";
				die;
				
			}
		}
		//die;	
	}

	public function admin_user_update()
	{
		ini_set('max_execution_time', '300');
		ini_set('memory_limit', '2048M');
		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$usertype = $this->Session->read('Admin.userType');
		if(!empty($_POST) && isset($_FILES['file']))
		{
			$this->User = ClassRegistry::init('User');
						
			$rate_id = $this->Ratelist->getLastInsertId();
			
			if ($_FILES["file"]["error"] > 0) {
				echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			}
			else
			{
				$hfile = $this->File->uploadFile($_FILES['file'], EXCEL_FILE, true,array('xls','xlsx'));
				//print_R($hfile);die;
				$excelReader = PHPExcel_IOFactory::createReaderForFile(EXCEL_FILE.$hfile['name']);
				$excelReader->setReadDataOnly(true);
				$excelObj = $excelReader->load(EXCEL_FILE.$hfile['name']);
				$worksheet = $excelObj->getSheet(0);
				$lastRow = $excelObj->setActiveSheetIndex(0)->getHighestRow();
				$lastColumn = $excelObj->setActiveSheetIndex(0)->getHighestColumn();
				$lastColumn++;
				$counter = 0;

				for ($row = 2; $row <= $lastRow; $row++) {
					if(!empty($worksheet->getCell('C'.$row)->getFormattedValue()))
					{
						$parent_child = "parent_child='child'";
						if($worksheet->getCell('C'.$row)->getFormattedValue()==$worksheet->getCell('A'.$row)->getFormattedValue())
						{
							$parent_child = "parent_child='parent'";
						}

						$user_data = $this->User->find('first',array('conditions'=>array('User.id'=>$worksheet->getCell('A'.$row)->getFormattedValue())));
						print_R($user_data['User']['id']);
						echo "<br>";	
						//echo "UPDATE users set parent_id='".$worksheet->getCell('C'.$row)->getFormattedValue()."',type='".$worksheet->getCell('G'.$row)->getFormattedValue()."' where id='".$worksheet->getCell('A'.$row)->getFormattedValue()."'";
						$this->User->query("UPDATE users set parent_id='".$worksheet->getCell('C'.$row)->getFormattedValue()."',".$parent_child.",type='".$worksheet->getCell('G'.$row)->getFormattedValue()."' where id='".$worksheet->getCell('A'.$row)->getFormattedValue()."'");
						$counter++;
					}
				}
				echo "<br><br>";
				echo "total count of updating records - ".$counter;
				die;
			}
		}
		//die;	
	}

	public function admin_add_lab()
	{
		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$this->Lab = ClassRegistry::init('Lab');
		$this->Api = ClassRegistry::init('Api');

		if(!empty($_POST) && isset($_FILES['file']))
		{
			//print_R($_FILES);die;
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
				$lastColumn = $excelObj->setActiveSheetIndex(0)->getHighestColumn();
				$lastColumn++;
				$sampleCounter = 0;
				$count=0;
				
				for ($row = 2; $row <= $lastRow; $row++) {
					$count++;
					$lab = $this->Lab->create();
					
					$lab['Lab']['pcc_name'] = $worksheet->getCell('A'.$row)->getFormattedValue();
					if(!empty($worksheet->getCell('G'.$row)->getFormattedValue()))
					{
						$lab['Lab']['pcc_contact'] = $worksheet->getCell('G'.$row)->getFormattedValue();	
					}
					else
					{
						$lab['Lab']['pcc_contact'] = $worksheet->getCell('H'.$row)->getFormattedValue();
					}
					
					$lab['Lab']['pcc_address'] = $worksheet->getCell('B'.$row)->getFormattedValue().",".$worksheet->getCell('C'.$row)->getFormattedValue();
					$lab['Lab']['pcc_email'] = $worksheet->getCell('F'.$row)->getFormattedValue();
					$lab['Lab']['status'] = '1';
					$lab['Lab']['created'] = date('Y-m-d H:i:s');
					$lab['Lab']['parent_pcc_id'] = '0';
					$lab['Lab']['pcc_lab_value'] = $worksheet->getCell('E'.$row)->getFormattedValue();
					$lab['Lab']['client_type'] = 'C';
					$lab['Lab']['center_id'] = $worksheet->getCell('R'.$row)->getFormattedValue();
					$lab['Lab']['registration_number'] = $worksheet->getCell('E'.$row)->getFormattedValue();
					$lab['Lab']['show_to_world'] = '1';
					$lab['Lab']['sequence'] = '';
					$lab['Lab']['send_report_mail'] = 0;
					$lab['Lab']['send_daily_request_report'] = 0;
					$lab['Lab']['send_report_mail_patient'] = 0;
					$lab['Lab']['send_sms_to_patient'] = 0;
					$lab['Lab']['send_push_notification'] = 0;
					$lab['Lab']['call_url_notification'] = '';
					$lab['Lab']['auth_code_notification'] = '';
					$lab['Lab']['send_whatsapp_to_patient'] = 0;
					$lab['Lab']['custom_header_status'] = 0;
					$lab['Lab']['custom_header'] = '';
					$lab['Lab']['auto_assign_phlebo'] = 0;
					$lab['Lab']['pcc_customer_service_email'] = '';
					$lab['Lab']['pcc_management_sevice_email'] = '';
					$lab['Lab']['mis_report_email'] = '';
					$lab['Lab']['pcc_customer_service_number'] = '';
					$lab['Lab']['pcc_management_service_number'] = $worksheet->getCell('H'.$row)->getFormattedValue();
					$lab['Lab']['api_key'] = $worksheet->getCell('T'.$row)->getFormattedValue();
					$lab['Lab']['api_user'] = $worksheet->getCell('S'.$row)->getFormattedValue();
					$lab['Lab']['report_upload_sms'] = 1;
					$lab['Lab']['confirm_agent_sms'] = 1;
					$lab['Lab']['ratelist'] = 0;
					$lab['Lab']['auto_btc'] = 0;
					$lab['Lab']['serviced_by_api'] = 0;
					$lab['Lab']['auto_smart_report'] = 0;
					$lab['Lab']['pcc_type'] = 'individual';
					
					if($this->Lab->save($lab))
					{
						$pcc_id = $this->Lab->getLastInsertId();
						print_R($pcc_id."-----".$lab['Lab']['pcc_name']);

						$this->Lab->query("update labs set parent_pcc_id='".$pcc_id."' where id='".$pcc_id."'");
						
						$api_id = $this->Api->create();
						$api_id['Api']['pcc_id'] = $pcc_id;
						$api_id['Api']['authorization'] = $worksheet->getCell('U'.$row)->getFormattedValue();
						$api_id['Api']['created_on'] = date('Y-m-d H:i:s');
						$api_id['Api']['created_by'] = 1;
						$api_id['Api']['status_id'] = 1;

						$this->Api->save($api_id);
					}
					echo "<br>";

				}
				print_R($count);
				die;	
			}
		}
	}
}
