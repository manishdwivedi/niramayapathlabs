<?php
App::import('Vendor', '/fpdf/fpdf');
App::import('Vendor', '/fpdf/fpdi');

class PincodeController extends AppController {
	
	var $name = "Pincode";

	var $breadcrumb = array();

	var $uses=array('PincodeMaster','PincodeCategory','State','City');

	var $helpers = array('Form','Html','Javascript', 'Ajax','Utility');

	public $components = array('RequestHandler','Cookie','Utility');

	public $paginate = array('maxLimit' => 10);

	public function admin_add_pincode_category()
	{
		//print_R("pincode category");die;
		$this->PincodeCategory = ClassRegistry::init("PincodeCategory");
		$this->set('title_for_layout', 'Add New Pincode Category');
		//print_R("hello");die;
		if(!empty($this->data))
		{
			if($this->PincodeCategory->save($this->data))
			{
				$this->Session->setFlash('Pincode Category Created.','flash_success');  
				$this->redirect('/admin/pincode/category_list/');
			}
			else
			{
				$this->Session->setFlash('Unable to Save.','flash_failure');  
			}
		}
	}

	public function admin_category_list()
	{
		$this->PincodeCategory = ClassRegistry::init("PincodeCategory");
		$this->set('title_for_layout', 'Add New Pincode Category');
		//print_R("hello");die;
		$pincode_category = $this->PincodeCategory->find('all',array('order'=>array('PincodeCategory.id desc')));
		$count=0;
		foreach($pincode_category as $val)
		{
			$no_of_pincode = $this->PincodeMaster->find('count',array('conditions'=>array('PincodeMaster.category'=>$val['PincodeCategory']['id'])));
			$pincode_category[$count]['PincodeCategory']['no_of_pincode'] = $no_of_pincode;
			$count++;
		}
		//die;
		$this->set('pin_cat',$pincode_category);
	}

	public function admin_upload($id=null)
	{
//		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$cat_id = base64_decode($id);
		$this->set('id',$cat_id);
		
		$this->PincodeMaster = ClassRegistry::init("PincodeMaster");
		$this->PincodeCategory = ClassRegistry::init("PincodeCategory");

		if(!empty($_POST) && isset($_FILES['file']))
		{
			print_R($_POST);
			print_R($_FILES);
			if ($_FILES["file"]["error"] > 0) {
				echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
				$this->Session->setFlash('Error Uploading Pincodes to Category.','flash_failure');  
				$this->redirect('/admin/pincode/category_list/');	
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
					
					if($worksheet->getCell("B".$row)->getFormattedValue()==1)
					{
						//print_R("update pincode_master set category='".$cat_id."' where pincode='".$worksheet->getCell("A".$row)->getFormattedValue()."'");
						$this->PincodeMaster->query("update pincode_master set category='".$cat_id."' where pincode='".$worksheet->getCell("A".$row)->getFormattedValue()."'");
					}
				}
				//die;
				$pincode_category = $this->PincodeCategory->find('list',array('fields'=>array('PincodeCategory.id','PincodeCategory.name')));

				$this->Session->setFlash('Pincodes Uploaded to Category "'.$pincode_category[$cat_id].'".','flash_success');  
				$this->redirect('/admin/pincode/category_list/');	
			}
		}

	}

	public function admin_download($id=null)
	{
		$this->PincodeMaster = ClassRegistry::init('PincodeMaster');

		$pincodes = $this->PincodeMaster->find('all',array('fields'=>array('PincodeMaster.pincode','PincodeMaster.category')));

		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$doc = new PHPExcel();
		$doc->setActiveSheetIndex(0);

		$rowCount=1; 
		$doc->getActiveSheet()->SetCellValue('A'.$rowCount, 'Pincode'); 
		$doc->getActiveSheet()->SetCellValue('B'.$rowCount, 'Category'); 

		foreach($pincodes as $val)
		{
			$rowCount++;
			$doc->getActiveSheet()->SetCellValue('A'.$rowCount, $val['PincodeMaster']['pincode']); 
			$doc->getActiveSheet()->SetCellValue('B'.$rowCount, $val['PincodeMaster']['category']); 			
		}

		$filename = "pincode_category.xls";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".$filename);
		header("Pragma: no-cache");
		header("Expires: 0");
		
		$objWriter = PHPExcel_IOFactory::createWriter($doc, 'Excel5');
		 
		$objWriter->save('php://output');
		die;
	}

	public function admin_pincode_master()
	{
//		Configure::write('debug',2);
		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));

		$this->City = ClassRegistry::init("City");
		$this->State = ClassRegistry::init("State");		
		$this->PincodeMaster = ClassRegistry::init("PincodeMaster");
		$this->PincodeCategory = ClassRegistry::init("PincodeCategory");

		if(!empty($_POST) && isset($_FILES['file']))
		{
//			print_R($_POST);
//			print_R($_FILES);die;
			if ($_FILES["file"]["error"] > 0) {
				echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
				$this->Session->setFlash('Error Uploading Pincode Master.','flash_failure');  
				$this->redirect('/admin/pincode/pincode_master/');	
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
				
				for ($row = 2; $row <= $lastRow; $row++) {
					
					$pin_test = $this->PincodeMaster->find('first',array('conditions'=>array('PincodeMaster.pincode'=>$worksheet->getCell("A".$row)->getFormattedValue())));
					print_R($pin_test);
					if($pin_test)
					{
						$this->PincodeMaster->query("update pincode_master set category='".$worksheet->getCell("F".$row)->getFormattedValue()."',servicable='".$worksheet->getCell("E".$row)->getFormattedValue()."' where pincode='".$worksheet->getCell("A".$row)->getFormattedValue()."'");
					}
					else
					{
						$city = $this->City->find('first',array('conditions'=>array('City.name LIKE'=>$worksheet->getCell("B".$row)->getFormattedValue())));
						$state = $this->State->find('first',array('conditions'=>array('State.name LIKE'=>$worksheet->getCell("C".$row)->getFormattedValue())));

						$this->pin = $this->PincodeMaster->create();
						$this->pin['PincodeMaster']['pincode'] = $worksheet->getCell("A".$row)->getFormattedValue();
						$this->pin['PincodeMaster']['state'] = $state['State']['id'];
						$this->pin['PincodeMaster']['city'] = $city['City']['id'];
						$this->pin['PincodeMaster']['locality'] = $worksheet->getCell("D".$row)->getFormattedValue();
						$this->pin['PincodeMaster']['itwoh_servicability'] = 0;
						$this->pin['PincodeMaster']['servicable'] = $worksheet->getCell("E".$row)->getFormattedValue();
						$this->pin['PincodeMaster']['category'] = $worksheet->getCell("F".$row)->getFormattedValue();

						$this->PincodeMaster->save($this->pin);
					}
				}
				$this->Session->setFlash('Pincodes Master Uploaded Successfully.','flash_success');  
				$this->redirect('/admin/pincode/pincode_master/');	
			}
		}
	}

	public function admin_pincode_master_download()
	{
		$this->PincodeMaster = ClassRegistry::init('PincodeMaster');
		$this->City = ClassRegistry::init("City");
		$this->State = ClassRegistry::init("State");		

		$pincodes = $this->PincodeMaster->find('all',array('fields'=>array('PincodeMaster.pincode','PincodeMaster.city','PincodeMaster.state','PincodeMaster.locality','PincodeMaster.servicable','PincodeMaster.category')));

		App::import('Vendor', 'phpexcel', array('file' => 'PHPExcel.php'));
		$doc = new PHPExcel();
		$doc->setActiveSheetIndex(0);

		$rowCount=1; 
		$doc->getActiveSheet()->SetCellValue('A'.$rowCount, 'Pincode'); 
		$doc->getActiveSheet()->SetCellValue('B'.$rowCount, 'City'); 
		$doc->getActiveSheet()->SetCellValue('C'.$rowCount, 'State'); 
		$doc->getActiveSheet()->SetCellValue('D'.$rowCount, 'Locality'); 
		$doc->getActiveSheet()->SetCellValue('E'.$rowCount, 'Servicable'); 
		$doc->getActiveSheet()->SetCellValue('F'.$rowCount, 'Category'); 

		foreach($pincodes as $val)
		{
			$rowCount++;
			$city = $this->City->find('first',array('conditions'=>array('City.id'=>$val['PincodeMaster']['city'])));
			$state = $this->State->find('first',array('conditions'=>array('State.id'=>$val['PincodeMaster']['state'])));

			$doc->getActiveSheet()->SetCellValue('A'.$rowCount, $val['PincodeMaster']['pincode']); 
			$doc->getActiveSheet()->SetCellValue('B'.$rowCount, $city['City']['name']); 			
			$doc->getActiveSheet()->SetCellValue('C'.$rowCount, $state['State']['name']); 			
			$doc->getActiveSheet()->SetCellValue('D'.$rowCount, $val['PincodeMaster']['locality']); 			
			$doc->getActiveSheet()->SetCellValue('E'.$rowCount, $val['PincodeMaster']['servicable']); 			
			$doc->getActiveSheet()->SetCellValue('F'.$rowCount, $val['PincodeMaster']['category']); 			
		}

		$filename = "pincode_master_upload.xls";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".$filename);
		header("Pragma: no-cache");
		header("Expires: 0");
		
		$objWriter = PHPExcel_IOFactory::createWriter($doc, 'Excel5');
		 
		$objWriter->save('php://output');
		die;
	}

}