<?php

class Page extends AppModel

{

    var $name = 'Page';
//var $actsAs = array('Tree');
	function beforeValidate(){
		$action = Configure::read('App.controller')->action;
		switch($action){			

			case 'admin_add':
			case 'admin_edit':				
					$this->validate = array(
						'title1' => array(
							'validate_title' => array('rule'=>array('validate_title'))
						),
						'content1' => array(
							 'notEmpty' => array('rule'=>array('notEmpty')),
				              'ValidContent' => array('rule'=>array('validate_content',null))
						),
					);	
			
				break;

			
		}
	}

	
	function isValidEmail($email){
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}

function validate_title($data){
	  if(isset($this->data['Page']['title']) && count($this->data['Page']['title'])>0){
		  foreach($this->data['Page']['title'] as $key=>$val){
			  if($val=="" ||  $this->data['Page']['title1']==""){
				  return false;
			  }
		  }
	  }
	  return true;
	}
	function validate_content($data){
	  if(isset($this->data['Page']['content']) && count($this->data['Page']['content'])>0){
		  foreach($this->data['Page']['content'] as $key=>$val){
			  if($val=="" || $this->data['Page']['content1']==""){
				  return false;
			  }
		  }
	  }
	  return true;
	}

}

?>