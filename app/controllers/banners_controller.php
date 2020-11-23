<?php
class BannersController extends AppController
{
	var $name = "Banners";
	var $breadcrumb = array();
	var $uses=array('Page','Pagelocale','Locale','Test','City','Sample','Call','Become','Banner');
	var $helpers = array('Form','Html','Javascript', 'Ajax');
	public $components = array('Email');
	public $paginate = array('maxLimit' => 10);
	
	function admin_index()
	{
		$this->set('title_for_layout','Manage Banner(s)');
		$this->paginate = array('Banner' => array('limit' =>'10','order'=>array('Banner.id DESC')));
		$bannerlist=$this->paginate('Banner');
		//echo "<pre>"; print_r($bannerlist); exit;
		if(isset($this->data) && !empty($this->data))
		{
			if(isset($this->data['Banner']['id']) && count($this->data['Banner']['id']) && trim($this->data['Page']['mode']) != ''){
				$this->update_mode($this->data['Banner']['id'], $this->data['Page']['mode']);
			} 
			else 
			{
				// set message
				$this->Session->setFlash('Please select atlest one Banner(s) to perform any action','flash_failure');
			}

		}
                
		$this->set('bannerlist',$bannerlist);
	}
	
	function update_mode($data, $mode){
		switch($mode){
			case 'activate':
				$countRecords = count($data);
				for($ctr=0;$ctr<$countRecords;$ctr++){
					if($data[$ctr]){
						$this->Banner->id = $data[$ctr];
						$this->Banner->saveField('status', '1');
					}
				}
				// set message
				$this->Session->setFlash('Banner(s) have been activated','flash_success');
				$this->redirect(array('controller'=>'banners','action'=>'index'));
				break;
			case 'deactivate':
				$countRecords = count($data);
				for($ctr=0;$ctr<$countRecords;$ctr++){
					if($data[$ctr]){
						$this->Banner->id = $data[$ctr];
						$this->Banner->saveField('status', '0');
					}
				}
				// set message
				$this->Session->setFlash('Banner(s) have been deactivated','flash_success');
				$this->redirect(array('controller'=>'banners','action'=>'index'));
				break;
			case 'delete':
				$countRecords = count($data);
				for($ctr=0;$ctr<$countRecords;$ctr++){
					if($data[$ctr]){
						$this->Banner->delete($data[$ctr]);
					}
				}
				// set message
				$this->Session->setFlash('Banner(s) have been deleted','flash_success');
				$this->redirect(array('controller'=>'banners','action'=>'index'));
				break;
			break;
		}
	}
	
	function admin_add()
	{
		$this->set('title_for_layout', 'Add Banner');
		if(!empty($this->data))
		{
			$this->data['Banner']['add_date'] = date('Y-m-d H:i:s');
			$this->data['Banner']['edit_date'] = '0000-00-00 00:00:00';
			$this->data['Banner']['status'] = 1;
			
			$hfile = $this->File->uploadFile($this->data['Banner']['banner_image'], OFFER_IMAGE_STORE_PATH, true,array('jpg','jpe','jpeg','gif','png','JPG','JPE','JPEG','GIF','PNG'));
			$this->data['Banner']['banner_image'] = $hfile['name'];
			// resize images
			$this->Image->load(OFFER_IMAGE_STORE_PATH.$hfile['name']);
			//$this->Image->resizeToWidth(OFFER_IMAGE_THUMB_WIDTH);
			$this->Image->save(OFFER_IMAGE_THUMB_PATH.$hfile['name']);
			
			if($this->Banner->create($this->data))
			{
				if($this->Banner->save($this->data,false))
				{
					$this->Session->setFlash('Banner image uploaded successfully.','flash_success');
					$this->redirect(array('controller'=>'banners','action'=>'index'));
				}
			}
		}
                $this->set('profit_category',$this->_getProfitCategory());
	}
	
	function admin_edit($id=NULL)
	{
		$this->set('title_for_layout','Edit Banner');
		$id = base64_decode($id);
		if(!empty($this->data))
		{
			$this->data['Banner']['edit_date'] = date('Y-m-d H:i:s');
			if(!empty($this->data['Banner']['new_banner_image']['name']))
			{
				$hfile = $this->File->uploadFile($this->data['Banner']['new_banner_image'], OFFER_IMAGE_STORE_PATH, true,array('jpg','jpe','jpeg','gif','png','JPG','JPE','JPEG','GIF','PNG'));
				$this->data['Banner']['banner_image'] = $hfile['name'];
				// resize images
				$this->Image->load(OFFER_IMAGE_STORE_PATH.$hfile['name']);
				//$this->Image->resizeToWidth(OFFER_IMAGE_THUMB_WIDTH);
				$this->Image->save(OFFER_IMAGE_THUMB_PATH.$hfile['name']);
				
				$this->File->deleteFile(OFFER_IMAGE_STORE_PATH.$this->data['Banner']['old_banner_image']);
				$this->File->deleteFile(OFFER_IMAGE_STORE_PATH.$this->data['Banner']['old_banner_image']);
			}
			if($this->Banner->create($this->data))
			{
				if($this->Banner->save($this->data))
				{

					$this->Session->setFlash('Banner(s) information updated successfully.','flash_success');
					$this->redirect('/admin/banners/index/');
				}
			} 
			else 
			{
				$this->Banner->invalidFields();
			}
		}else{
		    $bannerdetail = $this->Banner->find('first',array('conditions'=>array('Banner.id'=>$id)));
			$this->data=$bannerdetail;
		}
                $this->set('profit_category',$this->_getProfitCategory()); 
	}

}
?>