<?php
class LocalesController extends AppController {
	var $name = 'Locales';
	var $uses = array('Admin', 'Locale');

	function admin_index()
	{
		$this->set('title_for_layout','Manage Language(s)');
		$this->paginate = array('Locale' => array('limit' =>'10'));
		$localelist=$this->paginate('Locale');
		//echo "<pre>"; print_r($memberlist); exit;
		if(isset($this->data) && !empty($this->data))
		{
			if(isset($this->data['Locale']['id']) && count($this->data['Locale']['id']) && trim($this->data['Page']['mode']) != ''){
				$this->update_mode($this->data['Locale']['id'], $this->data['Page']['mode']);
			} 
			else 
			{
				// set message
				$this->Session->setFlash('Please select atlest one Language(s) to perform any action','flash_failure');
			}

		}		
		$this->set('localelist',$localelist);
	}

	function update_mode($data, $mode){
		switch($mode){
			case 'activate':
				$countRecords = count($data);
				for($ctr=0;$ctr<$countRecords;$ctr++){
					if($data[$ctr]){
						$this->Locale->id = $data[$ctr];
						$this->Locale->saveField('status', '1');
					}
				}
				// set message
				$this->Session->setFlash('Language(s) have been activated','flash_success');
				$this->redirect(array('controller'=>'locales','action'=>'index'));
				break;
			case 'deactivate':
				$countRecords = count($data);
				for($ctr=0;$ctr<$countRecords;$ctr++){
					if($data[$ctr]){
						$this->Locale->id = $data[$ctr];
						$this->Locale->saveField('status', '0');
					}
				}
				// set message
				$this->Session->setFlash('Language(s) have been deactivated','flash_success');
				$this->redirect(array('controller'=>'locales','action'=>'index'));
				break;
			case 'delete':
				$countRecords = count($data);
				for($ctr=0;$ctr<$countRecords;$ctr++){
					if($data[$ctr]){
						$this->Locale->delete($data[$ctr]);
					}
				}
				// set message
				$this->Session->setFlash('Language(s) have been deleted','flash_success');
				$this->redirect(array('controller'=>'locales','action'=>'index'));
				break;
			break;
		}
	}

	function admin_add()
	{
		$this->set('title_for_layout','Add Language');
		//rmdir(LOCALE_PATH.'spa');
		//$this->File->deleteFile(LOCALE_PATH.'fra/LC_MESSAGES/default.po');
		//exit;
		if(!empty($this->data))
		{
			if($this->Locale->create($this->data) && $this->Locale->validates())
			{
				if(empty($this->data['Locale']['flag']['name']) || empty($this->data['Locale']['lang_file']['name']))
				{
					$this->Session->setFlash('Flag Image field and Language File field cannot be empty','flash_failure');
					//$this->redirect(array('controller'=>'locales','action'=>'add'));
				}
				$flagfile = $this->File->uploadFile($this->data['Locale']['flag'], FLAG_IMAGE_STORE_PATH, true,array('po','jpg','gif','jpeg','png'));
				$this->data['Locale']['flag'] = $flagfile['name'];
				
				// resize images
				$this->Image->load(FLAG_IMAGE_STORE_PATH.$flagfile['name']);
				$this->Image->resizeToWidth(FLAG_IMAGE_WIDTH);
				$this->Image->save(FLAG_IMAGE_STORE_PATH.$flagfile['name']);

				mkdir(LOCALE_PATH.$this->data['Locale']['locale_folder'],0777);
				chmod(LOCALE_PATH.$this->data['Locale']['locale_folder'],0777);
				if(is_dir(LOCALE_PATH.$this->data['Locale']['locale_folder']))
				{
					mkdir(LOCALE_PATH.$this->data['Locale']['locale_folder'].'/LC_MESSAGES',0777);
					chmod(LOCALE_PATH.$this->data['Locale']['locale_folder'].'/LC_MESSAGES',0777);
					if(is_dir(LOCALE_PATH.$this->data['Locale']['locale_folder'].'/LC_MESSAGES'))
					{
						if($this->File->uploadFile($this->data['Locale']['lang_file'], LOCALE_PATH.$this->data['Locale']['locale_folder'].'/LC_MESSAGES/', false,array('po')))
						{
							if($this->Locale->save($this->data,false))
							{
								$this->Session->setFlash('Language have been added successfully.','flash_success');
								$this->redirect(array('controller'=>'locales','action'=>'index'));
							}
						}
						else
						{
							$this->Session->setFlash('Some error occurred while uploading language file.','flash_success');
							$this->redirect(array('controller'=>'locales','action'=>'add'));
						}
					}
				}
			}
			else
			{
				$this->Locale->invalidFields();
			}
		}
	}

	function admin_download_file()
	{
		$fsize = filesize(LANGUAGE_FILE_PATH.'default.po');
		$path_parts = pathinfo(LANGUAGE_FILE_PATH.'default.po');
		$ext = strtolower($path_parts["extension"]);

		switch ($ext) 
		{ 
		  
		  case "po": $ctype="application/octet-stream"; break; 
		  default: $ctype="application/force-download";
		}	

		header("Pragma: public"); // required
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false); // required for certain browsers
		header("Content-Type: $ctype");
		header("Content-Disposition: attachment; filename=\"".basename(LANGUAGE_FILE_PATH.'default.po')."\";" );
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".$fsize);
		ob_clean();
		flush();
		readfile( LANGUAGE_FILE_PATH.'default.po' );
		//$this->redirect(array('controller'=>'locales','action'=>'add'));
		exit;
	}

	function admin_edit($id)
	{
		if(!empty($this->data))
		{
			if($this->Locale->create($this->data) && $this->Locale->validates())
			{
				//echo "<pre>"; print_r($this->data); exit;
				if(!empty($this->data['Locale']['flag']['name']))
				{
					$flagoldimage = $this->data['Locale']['oldflag'];
					$flagfile = $this->File->uploadFile($this->data['Locale']['flag'], FLAG_IMAGE_STORE_PATH, true,array('po','jpg','gif','jpeg','png'));
					//echo "<pre>"; print_r($flagfile); exit;


					$this->data['Locale']['flag'] = $flagfile['name'];
					
					// resize images
					$this->Image->load(FLAG_IMAGE_STORE_PATH.$flagfile['name']);
					$this->Image->resizeToWidth(FLAG_IMAGE_WIDTH);
					$this->Image->save(FLAG_IMAGE_STORE_PATH.$flagfile['name']);

					//Remove Old Image
					$this->File->deleteFile(FLAG_IMAGE_STORE_PATH.$flagoldimage);
				}
				else
				{
					$this->data['Locale']['flag'] = $this->data['Locale']['oldflag'];
				}

				$getinfo = $this->Locale->find('first',array('conditions'=>array('Locale.id'=>$id)));
				if(!empty($this->data['Locale']['lang_file']['name']))
				{
					if(file_exists(LOCALE_PATH.$getinfo['Locale']['locale_folder'].'/LC_MESSAGES/default.po'))
					{
						$this->File->deleteFile(LOCALE_PATH.$getinfo['Locale']['locale_folder'].'/LC_MESSAGES/default.po');
						$this->File->uploadFile($this->data['Locale']['lang_file'], LOCALE_PATH.$getinfo['Locale']['locale_folder'].'/LC_MESSAGES/', false,array('po'));
					}
					else
					{
						$this->File->uploadFile($this->data['Locale']['lang_file'], LOCALE_PATH.$getinfo['Locale']['locale_folder'].'/LC_MESSAGES/', false,array('po'));
					}
					if($this->Locale->save($this->data,false))
					{
						$this->Session->setFlash('Language have been updated successfully.','flash_success');
						$this->redirect(array('controller'=>'locales','action'=>'index'));
					}
				}
				else
				{
					if($this->Locale->save($this->data,false))
					{
						$this->Session->setFlash('Language have been updated successfully.','flash_success');
						$this->redirect(array('controller'=>'locales','action'=>'index'));
					}
				}
			}
			else
			{
				$this->Locale->invalidFields();
			}
		}
		else
		{
			$getinfo = $this->Locale->find('first',array('conditions'=>array('Locale.id'=>$id)));
			if(file_exists(LOCALE_PATH.$getinfo['Locale']['locale_folder'].'/LC_MESSAGES/default.po'))
			{
				$this->set('oldfileexists','oldfileexists');
			}
			$this->data = $getinfo;
		}
	}

	function admin_edit_file($langid)
	{
		$langinfo = $this->Locale->find('first',array('conditions'=>array('Locale.id'=>$langid)));
		//echo "<pre>"; print_r($langinfo); exit;
		$foldername = $langinfo['Locale']['locale_folder'];


		$fsize = filesize(LOCALE_PATH.$foldername.'/LC_MESSAGES/default.po');
		$path_parts = pathinfo(LOCALE_PATH.$foldername.'/LC_MESSAGES/default.po');
		$ext = strtolower($path_parts["extension"]);

		switch ($ext) 
		{ 
		  
		  case "po": $ctype="application/octet-stream"; break; 
		  default: $ctype="application/force-download";
		}	

		header("Pragma: public"); // required
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false); // required for certain browsers
		header("Content-Type: $ctype");
		header("Content-Disposition: attachment; filename=\"".basename(LOCALE_PATH.$foldername.'/LC_MESSAGES/default.po')."\";" );
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".$fsize);
		ob_clean();
		flush();
		readfile( LOCALE_PATH.$foldername.'/LC_MESSAGES/default.po' );
		//$this->redirect(array('controller'=>'locales','action'=>'add'));
		exit;
	}
	
}
?>