<?php
/* SVN FILE: $Id: form.php 8166 2009-05-04 21:17:19Z gwoo $ */
/**
 * Automatic generation of HTML FORMs from given data.
 *
 * Used for scaffolding.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.helpers
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 8166 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2009-05-04 14:17:19 -0700 (Mon, 04 May 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Form helper library.
 *
 * Automatic generation of utility.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.view.helpers
 */
class UtilityHelper extends AppHelper {
     var $helpers = array('Html','Form','Session');
	/**
	* function to check file existance
	* @param string $filePath
	* @return boolean
	**/
	function fileExists($filePath){
		if(is_file($filePath) && file_exists($filePath)){
			return true;
		} else {
			return false;
		}
	}

        function show_empty_pcc_yes_no()
        {
            $user_type=$this->Session->read('Admin.userType');
            $user_type_array=array('A','BM','Agent','DA');
            if(in_array($user_type,$user_type_array))
                return "<option value=''>Select PCC</option>";
            else
                return "";
        }
        function show_empty_pcc_yes_no_booked()
        {
            $user_type=$this->Session->read('Admin.userType');
            $user_type_array=array('A','BM','Agent','DA');
            if(in_array($user_type,$user_type_array))
                return "<option value=''>Select Booked By PCC</option>";
            else
                return "";
        }
		
		function show_mobile_hide($landline=null , $s_date=null)
        { 
            $user_type=$this->Session->read('Admin.userType');
            //$yesterday = date("Y-m-d");
            $yesterday1 = date('d-M-Y', strtotime('-5 days')); 	
			
			
			//return $user_type;		
			//$this->Health = ClassRegistry::init('Health');
			
			//$landline = $this->Health->find('first',array('fields'=>array('landline','s_date'),'conditions'=>array('Health.id'=>$this->data['Health']['id'])));
					if($user_type == 'A')
					{

					return $landline;
					} else {
					if(strtotime($s_date) >  strtotime($yesterday1))
					
						{ 
							return $landline;
						}
						else{
							//$reports[$k]['SalesReport']['patient_contact'] = $sl_vl['Health']['landline'];
							$newstring = substr_replace($landline, "****", 3 , -3); 
							return $newstring;
						}
					
					}
        }
		function show_email_hide($email=null , $s_date=null)
        { 
            $user_type=$this->Session->read('Admin.userType');
            $yesterday1 = date('d-M-Y', strtotime('-7 days')); 	
			if($user_type == 'A')
					{

					return $email;
					} else {
					if(strtotime($s_date) >  strtotime($yesterday1))
					
						{ 
							return $email;
						}
						else{
							$newstring1 = substr_replace($email, "****", 3 , -3); 
							return $newstring1;
						}
					
					}
        }
		
		
        function show_empty_pcc_yes_no_service()
        {
            $user_type=$this->Session->read('Admin.userType');
            $user_type_array=array('A','BM','Agent','DA');
            if(in_array($user_type,$user_type_array))
                return "<option value=''>Select Service By PCC</option>";
            else
                return "";
        }
}
?>