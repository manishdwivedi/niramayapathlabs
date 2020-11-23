<?php
class AdminsController extends AppController {
	var $name = 'Admins';

	var $uses = array('Admin','Agent');

	function admin_login(){	
	    //print_R('hello');die;
		if($this->Session->check('Admin.id')){
			$this->redirect('/admin/admins/index/');
		}
		
		$this->set('title_for_layout', 'Admin Login');

		if(!empty($this->data)) {
			if($this->Admin->create($this->data) && $this->Admin->validates()){
				// get Admin information
				
				$Admins = $this->Admin->find(array('Admin.userName' => $this->data['Admin']['userName']), array('Admin.id', 'Admin.email', 'Admin.userName', 'Admin.userType', 'Admin.userValue', 'Admin.labId', 'Admin.labType', 'Admin.name'));
				// set session
				$this->Session->write('Admin', $Admins['Admin']);
				
				//echo "<pre>"; print_r($this->Session->read()); exit;
				$this->Session->setFlash('You have logged in successfully!!!','flash_success');
				
				// redirect to offers page
				$this->redirect('/admin/admins/index/');
			} else {
				$password = md5($this->data['Admin']['password']);
				$agent_login = $this->Agent->find('first',array('conditions'=>array('Agent.username'=>$this->data['Admin']['userName'],'Agent.password'=>$password)));
				
				
				if(!empty($agent_login))
				{
					$agent_login['Agent']['login_agent_type'] = 'Agent';
					// set session
					$this->Session->write('Admin', $agent_login['Agent']);
				
					//echo "<pre>"; print_r($this->Session->read()); exit;
					$this->Session->setFlash('You have logged in successfully!!!','flash_success');
				
					// redirect to offers page
					$this->redirect('/admin/admins/index/');
				}
				else
				{
					$this->Admin->invalidFields();
				}
			}
		}
	}

	function admin_index() {
		$this->set('title_for_layout', 'Dashboard');
		
		
	}

	function admin_logout(){
		// removing the session
		$this->Session->delete('Admin');
		// set message
		$this->Session->setFlash('You have logged out successfully','flash_success');

		// redirect to login page
		$this->redirect('/admin/admins/login/');
	}
	
	
	function admin_forgotpassword(){
		// check for session set
		if($this->Session->check('Admin.id')){
			$this->redirect('/admin/admins/index/');
		}
		$this->set('title_for_layout', 'Forgot Password');
		if(!empty($this->data)) {
		
		
			if($this->Admin->create($this->data) && $this->Admin->validates()){
				// generate password
				
				$password = $this->generateCode();

				// get User information
				$admin = $this->Admin->find(array('Admin.email LIKE' => $this->data['Admin']['email']), array('Admin.id', 'Admin.email', 'Admin.userName'));

				// save new password in database
				$this->Admin->id = $admin['Admin']['id'];
				$this->Admin->saveField('password', md5($password));

				$admin['Admin']['password'] = $password;

				// sending email to user
				$this->_admin_forgot_password_email($admin);

				// set message
				$this->Session->setFlash('An email with your login details have been sent to provided email address. Please follow the instruction in email.','flash_success');
				// redirect to same page
				$this->redirect('/admin/admins/forgotpassword/');
			} else {
			
			
				$this->Admin->invalidFields();
			}
		}
	}

	function _admin_forgot_password_email($user){
		
		$this->Email->to = $user['Admin']['email'];
		$this->Email->subject = 'Your login details';
		$this->Email->replyTo = WEBSITE_ADMINISTRATOR_EMAIL;
		$this->Email->from = 'Website Administrator <'.WEBSITE_ADMINISTRATOR_EMAIL.'>';
		$this->set('user', $user);
		$this->Email->template = 'admin/forgotpassword'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'both'; // because we like to send pretty mail
		//Set view variables as normal
		//Do not pass any args to send()
		if($this->Email->send()){
			return true;
		} else {
			return false;
		}
	}
	
	function admin_myaccount(){
		$this->set('title_for_layout', 'Change Admin Email Details ');
		$advertiser_id = $this->Session->read('Admin.id');
		$this->set('adminemail',$this->Session->read('Admin.email'));

		if(!empty($this->data)) {
			if($this->Admin->create($this->data) && $this->Admin->validates()){
				$this->data['Admin']['id'] = $advertiser_id;

				// save in database				
				if($this->Admin->save($this->data)){
					$this->Session->write('Admin.email', $this->data['Admin']['email']);
					// set message
					
					$this->Session->setFlash('Your account information has been saved successfully.','flash_success');
					// redirect to same page
					$this->redirect('/admin/admins/myaccount/');
				} else {
					// set message
					$this->Session->setFlash('Some error has been occured. Please try again later.','flash_failure');
				}				
			} else {
				$this->Admin->invalidFields();
			}
		}
	}
	
	function admin_agent_change()
	{
		if($this->Session->check('Admin.id'))
		{
			if(!empty($this->data))
			{
				if($this->data['User']['new_password'] === $this->data['User']['confirm_password'])
				{
					$admindetail = $this->Agent->find('first',array('conditions'=>array('Agent.id'=>$this->Session->read('Admin.id'))));
					//echo "<pre>"; print_r($admindetail); exit;
					$adminid = $admindetail['Agent']['id'];
					$oldpass = $admindetail['Agent']['password'];
					$postedpass = md5($this->data['User']['password']);

					if($postedpass === $oldpass)
					{
						
						$newpass = $this->data['User']['new_password'];
						$encpass = md5($newpass);
						$this->data['Agent']['password'] = $encpass;
						$updatepass = $this->Admin->query("UPDATE agents SET password = '$encpass' WHERE id = $adminid");
						$this->Session->setFlash('Your Password changed successfully.','flash_success');
					}
					else
					{
						$this->Session->setFlash('Your Old Password did not match.','flash_failure');
					}
				}
				else
				{
					$this->Session->setFlash('Your Password and Confirm Password did not match.','flash_failure');
				}
			}
		}
	}

	function admin_changepassword() {
	
		
		if($this->Session->check('Admin.id'))
		{
			if(!empty($this->data))
			{
				if($this->data['User']['new_password'] === $this->data['User']['confirm_password'])
				{
					$admindetail = $this->Admin->find('first',array('conditions'=>array('Admin.id'=>$this->Session->read('Admin.id'))));
					//echo "<pre>"; print_r($admindetail); exit;
					$adminid = $admindetail['Admin']['id'];
					$oldpass = $admindetail['Admin']['password'];
					$postedpass = md5($this->data['User']['password']);

					if($postedpass === $oldpass)
					{
						
						$newpass = $this->data['User']['new_password'];
						$encpass = md5($newpass);
						$this->data['Admin']['password'] = $encpass;
						$updatepass = $this->Admin->query("UPDATE admins SET password = '$encpass' WHERE id = $adminid");
						$this->Session->setFlash('Your Password changed successfully.','flash_success');
					}
					else
					{
						$this->Session->setFlash('Your Old Password did not match.','flash_failure');
					}
				}
				else
				{
					$this->Session->setFlash('Your Password and Confirm Password did not match.','flash_failure');
				}
			}
		}
	}
		
	
}
?>