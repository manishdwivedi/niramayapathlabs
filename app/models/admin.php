<?php

class Admin extends AppModel

{

  var $name = 'Admin';



	function beforeValidate(){

		$action = Configure::read('App.controller')->action;

		$user_id = Configure::read('App.controller')->Session->read('Admin.id');

		switch($action){			

			case 'admin_login':

				$this->validate = array(

					'userName' => array(

						'required' => array('rule'=>array('notEmpty'), 'last'=>true),

						'isUsernameExists' =>array('rule'=>array('isUsernameExists'))

					),

					'password' => array(

						'between' =>array('rule'=>array('between', '6', '16'), 'last'=>true),

						'isPassword' =>array('rule'=>array('isPassword', $this->data['Admin']['userName']))

					)

				);

				break;

			case 'admin_forgotpassword':

				$this->validate = array(

					'email' => array(

						'email' =>array('rule'=>'email', 'last'=>true),

						'isEmailExists' =>array('rule'=>array('isEmailExists'))

					),

					'code' => array(						

						'isValidCode' =>array('rule'=>array('isValidCode'))

					)

				);

				break;

			case 'admin_changepassword':

				$this->validate = array(

					'password' => array(

						'between' =>array('rule'=>array('between', '6', '16'), 'last'=>true),

						'isPassword' =>array('rule'=>array('isPassword', Configure::read('App.controller')->Session->read('Admin.username')))

					),

					'new_password' => array(

						'between' =>array('rule'=>array('between', '6', '16'), 'last'=>true),

						//'alphaNumeric' =>array('rule'=>array('alphaNumeric'), 'last'=>true),

						'equalTo' =>array('rule'=>array('equalTo', $this->data['Admin']['confirm_password']))

					),

					'confirm_password' => array(

						'between' =>array('rule'=>array('between', '6', '16'))

					)

				);

				break;

			case 'admin_myaccount':

				$this->validate = array(

					'email' => array(

						'email' => array('rule'=>array('email'))

					),

				);

				break;

		}

	}



	function isEmailExists($data){	

		foreach($data AS $key=>$value){

			if($key == 'email'){

				$arr = $this->find(array('Admin.email LIKE'=>$value, 'Admin.status'=>'1'));

				if(is_array($arr) && count($arr)){

					return true;

				} else {

					return false;

				}

			}

		}

		return false;

	}



	function isUsernameExists($data){	

		foreach($data AS $key=>$value){

			if($key == 'userName'){

				$arr = $this->find(array('Admin.userName LIKE'=>$value, 'Admin.status'=>'1'));

				if(is_array($arr) && count($arr)){

					return true;

				} else {

					return false;

				}

			}

		}

		return false;

	}



	function isPassword($data, $username){		

		foreach($data AS $key=>$value){

			if($key == 'password'){

				$arr = $this->find(array('Admin.userName LIKE'=>$username, 'Admin.password'=>md5($value), 'Admin.status'=>'1'));

				if(is_array($arr) && count($arr)){

					return true;

				} else {

					return false;

				}

			}

		}

		return false;

	}



	function isValidCode($data){		

		foreach($data AS $key=>$value){

			if($key == 'code'){

				$code = Configure::read('App.controller')->Session->read('Captcha.code');

				if($code === $value){

					return true;

				} else {

					return false;

				}

			}

		}

		return false;

	}

}

?>