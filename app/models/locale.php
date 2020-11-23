<?php
class Locale extends AppModel
{
	var $name = 'Locale';

	function beforeValidate()
	{
		$action = Configure::read('App.controller')->action;
		switch($action)
		{
			case 'admin_add':
			$this->validate = array(
				'title' => array(
					'notEmpty' => array('rule'=>array('notEmpty')),
				),
				'curr_abbrevation' => array(
					'notEmpty' => array('rule'=>array('notEmpty')),
				),
				'code' => array(
					'notEmpty' => array('rule'=>array('notEmpty')),
					'custom' => array('rule' => array('custom', 'regex'=>'/^[a-z]{2}$/'), 'last' => true)
				),
				'locale_folder' => array(
					'notEmpty' => array('rule'=>array('notEmpty')),
					'custom' => array('rule' => array('custom', 'regex'=>'/^[a-z]{3}$/'), 'last' => true)
				),
				
				'curr_exchange' => array(
					'notEmpty' => array('rule'=>array('notEmpty'))
				)
				
			);
			
			break;


			case 'admin_edit':
			$this->validate = array(
				'title' => array(
					'notEmpty' => array('rule'=>array('notEmpty')),
				),
				'curr_abbrevation' => array(
					'notEmpty' => array('rule'=>array('notEmpty')),
				),
				'code' => array(
					'notEmpty' => array('rule'=>array('notEmpty')),
					'custom' => array('rule' => array('custom', 'regex'=>'/^[a-z]{2}$/'), 'last' => true)
				)
			);
			break;
		}
	}
}
?>