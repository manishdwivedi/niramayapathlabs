<?php
class PackagesController extends AppController
{
	var $name = "Packages";
	var $breadcrumb = array();
	var $uses=array('Page','Pagelocale','Locale','Test','City','Sample','Time','Timelab','Profile','Gender','Package','Siteadminlang');
	var $helpers = array('Form','Html','Javascript', 'Ajax');
	public $paginate = array('maxLimit' => 10);
	public $components = array('Email');
	
	function admin_add_package()
	{
		$this->set('title_for_layout', 'Add Package');
		if(!empty($this->data))
		{
			//echo "<pre>"; print_r($this->data); exit;
			$this->data['Package']['add_date'] = date('Y-m-d H:i:s');
			$this->data['Package']['status'] = 1;
			if($this->Package->create($this->data))
			{
				if($this->Package->save($this->data,false))
				{
					$this->Session->setFlash('Package saved successfully','flash_success');
					$this->redirect(array('controller'=>'packages','action'=>'add_package'));	
				}
			}
		}
	}
}
?>