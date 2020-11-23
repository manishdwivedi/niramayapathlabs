<?php

class UsersController extends AppController {

	var $name = 'Users';
	var $breadcrumb = array();
	var $uses=array('Page','Pagelocale','Locale','Test','City','Sample','Time','Timelab','Gender','Banner','User','Disease','Speciality','Health','Billing','State','City','Package','Lab','Discount','UserBmiBp','RequestTest','Paytrack');
	var $helpers = array('Form','Html','Javascript', 'Ajax');
	var $components  = 	array('Email','RequestHandler') ;
	public $paginate = array('maxLimit' => 10);
	

	// Function used to send mail to users in case of forgot password. view file is forgot_password.ctp
	function forgot_password()
	{
		$this->layout = 'tests';

		$this->set('title_for_layout','Forgot Password');

		if(!empty($this->data))

		{

			$find_user = $this->User->find('first',array('conditions'=>array('User.email'=>$this->data['User']['email'])));

			if(!empty($find_user['User'] ['id']))

			{

				$email_encode=rtrim(strtr(base64_encode($find_user['User']['email']), '+/', '-_'), '=');
				$this->Email->to = $find_user['User']['email'];
				$this->Email->subject = WEBSITE_TITLE. ' Password Recovery Link';
				$this->Email->from = 'info@niramayahealthcare.com';
				$this->Email->fromName = 'Email from Niramaya Healthcare';
				
				$this->set('user', $find_user);
				// Set email
				$this->set('email', $email_encode);
				$this->Email->template = 'resetpassword';
				$this->Email->sendAs = 'html';
				if($this->Email->send())
				{
					$this->Session->setFlash('An email has been sent to '.$find_user['User']['email'].'. Please click on the link provided in the mail to reset your password.<br/>
					In case you do not receive your password reset email shortly, please check your spam folder also.','flash_success');
					$this->set('issend',1);
				}

			}
			else {
				$this->Session->setFlash('Entered email id does not exist.','flash_failure');

			}
		}
	}

	// Function used to reset password. view file is reset_password.ctp
	function reset_password()
	{

		$this->layout = 'tests';

		$this->set('title_for_layout','Forgot Password');

		$email = $this->params['pass'];

		$email_decoded = base64_decode(strtr($email[0], '-_', '+/'));

		//$this->set('emailid', $email_decoded);

		if(!empty($this->data['User']['emailId']))
		{
			$this->set('emailid', $this->data['User']['emailId']);
		}else
		{
			$this->set('emailid', $email_decoded);
		}

		if(!empty($this->data))
		{

			if($this->data['User']['new_password'] === $this->data['User']['confirm_password'])

			{

				$newpass = $this->data['User']['new_password'];

				$encpass = $newpass;
				
				$email_id= $this->data['User']['emailId'];
				
				$updatepass = $this->User->query("UPDATE users SET passwd = '$encpass' WHERE email like '%$email_id%'");

				$this->Session->setFlash('Your Password changed successfully.','flash_success');
				$this->redirect(array('controller'=>'pages','action'=>'login_page'));

				//$find_user = $this->User->find('first',array('conditions'=>array('User.id'=>$userid)));

			}

			else

			{

				$this->Session->setFlash('Your Password and Confirm Password did not match.','flash_failure');

			}

		}
	}
	
	function validate_email_is_exist($email=null)
	{
		if($this->RequestHandler->isAjax())
        {
			if(isset($email) && !empty($email))
			{
				$is_exist=$this->User->find('count',array('conditions'=>array('User.email'=>trim($email))));
				if($is_exist > 0)
					echo json_encode(array('status'=>'success'));
				else
					echo json_encode(array('status'=>'failed'));
			}
			else
			{
				echo json_encode(array('status'=>'failed'));
			}
           $this->layout="";
           $this->render(false);
		   exit;
           
        }
		else
		{
			$this->redirect("/");
		}
	}

}

?>