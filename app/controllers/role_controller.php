<?php

class RoleController extends AppController {
	
	var $name = "Role";

	var $breadcrumb = array();

	var $uses=array('Lab','Admin');

	var $helpers = array('Form','Html','Javascript', 'Ajax','Utility');

	public $components = array('RequestHandler','Cookie','Utility');

	public $paginate = array('maxLimit' => 10);
	
	public function admin_specify_role($id=null)
	{
		$this->set('title_for_layout','Edit User(s)');
		$dec_user_id = base64_decode($id);
		if(!empty($this->data))
		{
			if($this->Admin->create($this->data))
			{
				//$this->data['Admin']['password'] = md5($this->data['Admin']['password']);
                if(isset($this->data['Admin']['password1']) && !empty($this->data['Admin']['password1']))
                {
                    $this->data['Admin']['password'] = md5($this->data['Admin']['password1']);
                }
				$this->data['Admin']['modified'] = date('Y-m-d H:i:s');

				if($this->Admin->save($this->data,false))
				{
					$this->Session->setFlash('User updated successfully','flash_success');
					$this->redirect('/admin/samples/view_user');
				}
			}
		}
		else
		{
			$find_user_detail = $this->Admin->find('first',array('conditions'=>array('Admin.id'=>$dec_user_id)));
			$this->data = $find_user_detail;
		}
		$get_pcc_list = $this->Lab->find('all',array('conditions'=>array('Lab.status'=>1)));
		$this->set('get_pcc_list',$get_pcc_list);
	}
	
	public function admin_index()
	{
		$this->Admin = ClassRegistry::init('Admin');
		$this->paginate = array('Admin' => array('limit' =>'20','order'=>array('Admin.id'=>'DESC'),'conditions'=>array('Admin.status'=>1)));
		$userlist=$this->paginate('Admin');
		$this->set('userlist',$userlist);
	}
}