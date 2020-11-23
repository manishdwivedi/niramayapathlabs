<?php
/* SVN FILE: $Id: bootstrap.php 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 * Short description for file.
 *
 * Long description for file
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
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 *
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php is loaded
 * This is an application wide file to load any function that is not used within a class define.
 * You can also use this to include or require any files in your application.
 *
 */
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * $modelPaths = array('full path to models', 'second full path to models', 'etc...');
 * $viewPaths = array('this path to views', 'second full path to views', 'etc...');
 * $controllerPaths = array('this path to controllers', 'second full path to controllers', 'etc...');
 *
 */
//EOF
$mode = '';
if($mode == 'live'){
	define('SITE_URL', FULL_BASE_URL);
} elseif($mode == 'local'){
	define('SITE_URL', FULL_BASE_URL.'/');
} else {
	define('SITE_URL', FULL_BASE_URL.'/');
}

define('WEBSITE_TITLE', 'Niramaya Healthcare');
define('WEBSITE_ADMINISTRATOR_EMAIL', 'ashisht@itcombine.com');
define('MAIN_SITE_URL','https://www.niramayahealthcare.com/');
define('FILES_PATH', WWW_ROOT.'files'.DS);
define('VIDEO_PATH', WWW_ROOT.'propertyvideos'.DS);
//echo VIDEO_PATH;

//define('FILES_URL', SITE_URL.'app/webroot/files/');
if(Configure::read('App.baseUrl'))
{
	define('FILES_URL', SITE_URL.'app/webroot/files/');
}
else 
{
    define('FILES_URL', SITE_URL.'files/');
}

define('EXCEL_FILE',WWW_ROOT.'excel/');
define('IMG_FILES_URL', SITE_URL.'files/');
define('TMP_PATH', FILES_PATH.'tmp'.DS);
define('TMP_URL', FILES_URL.'tmp/');

define('TEMP_IMAGE_STORE_PATH', FILES_PATH.'temp'.DS);
define('TEMP_IMAGE_URL', FILES_URL.'temp/');


//Locale Folder Path

define('LOCALE_PATH', '/var/www/html/public/monitorit/app/locale/');
define('LANGUAGE_FILE_PATH', FILES_PATH.'languagefile'.DS);

//Locale Folder Path

define('OFFER_URL',WWW_ROOT.'img/');
//Offer Images Starts
define('OFFER_IMAGE_STORE_PATH', OFFER_URL.'offers'.DS);
define('OFFER_IMAGE_THUMB_PATH', FILES_PATH.'offers'.DS.'thumb'.DS);
define('OFFER_IMAGE_THUMB_URL',FILES_URL.DS.'offers/thumb'.DS);
define('OFFER_PICTURE_ALLOWED_FORMATS', serialize(array('jpg', 'jpeg', 'jpe', 'gif', 'png')));
define('OFFER_IMAGE_URL', FILES_URL.'offers/');
define('OFFER_IMAGE_THUMB_WIDTH', '650');
//Offer Images Ends

//DOCTOR IMAGE STARTS
define('DOCTOR_IMAGE_STORE_PATH', FILES_PATH.'doctors'.DS);
define('DOCTOR_IMAGE_THUMB_PATH', FILES_PATH.'doctors'.DS.'thumb'.DS);
define('DOCTOR_IMAGE_MEDIUM_PATH', FILES_PATH.'doctors'.DS.'medium'.DS);
define('DOCTOR_IMAGE_SMALL_PATH', FILES_PATH.'doctors'.DS.'small'.DS);
define('DOCTOR_IMAGE_VERYSMALL_PATH', FILES_PATH.'doctors'.DS.'verysmall'.DS);
define('DOCTOR_IMAGE_BIGSMALL_PATH', FILES_PATH.'doctors'.DS.'bigsmall'.DS);
define('DOCTOR_IMAGE_THUMB_URL',FILES_URL.DS.'doctors/thumb'.DS);
define('DOCTOR_IMAGE_MEDIUM_URL',FILES_URL.DS.'doctors/medium'.DS);
define('DOCTOR_IMAGE_SMALL_URL',FILES_URL.DS.'doctors/small'.DS);
define('DOCTOR_IMAGE_VERYSMALL_URL',FILES_URL.DS.'doctors/verysmall'.DS);
define('DOCTOR_IMAGE_BIGSMALL_URL',FILES_URL.DS.'doctors/bigsmall'.DS);
define('DOCTOR_PICTURE_ALLOWED_FORMATS', serialize(array('jpg', 'jpeg', 'jpe', 'gif', 'png')));
define('DOCTOR_IMAGE_URL', FILES_URL.'doctors/');
define('DOCTOR_IMAGE_THUMB_WIDTH', '650');
define('DOCTOR_IMAGE_THUMB_MEDIUM_WIDTH', '250');
define('DOCTOR_IMAGE_THUMB_SMALL_WIDTH', '120');
define('DOCTOR_IMAGE_THUMB_VERYSMALL_WIDTH', '67');
define('DOCTOR_IMAGE_THUMB_BIGSMALL_WIDTH', '131');
//DOCTOR IMAGE ENDS

define('REPLY_TO_EMAIL','info@niramayahealthcare.com');
define('BOOK_APPOINT_REQUEST_EMAIL','info@niramayahealthcare.com');

//Patient Report Starts
define('PATIENT_TICKET_STORE_PATH', FILES_PATH.'ticket'.DS);
define('PATIENT_REPORT_STORE_PATH', FILES_PATH.'reports'.DS);
define('PATIENT_REPORT_PATH',FILES_URL.DS.'reports/'.DS);
define('PATIENT_REPORT_URL', FILES_URL.'reports/');
//Patient Report Ends

//Agent Docs Starts
define('PATIENT_AGENT_STORE_PATH', FILES_PATH.'agent_doc'.DS);
define('DUMMY_DOC_STORE_PATH', FILES_PATH.'dummy_doc'.DS);
define('PATIENT_DOC_STORE_PATH', FILES_PATH.'patient_doc'.DS);
//Agent Docs Ends

// custom report header starts
define('CUSTOM_REPORT_HEADER_PATH', FILES_PATH.'header'.DS);
define('CUSTOM_REPORT_PATH',FILES_URL.DS.'header/'.DS);
define('CUSTOM_REPORT_HEADER_URL', FILES_URL.'header/');
// custom report header ends

//Test Description PDF Starts
define('TEST_PDF_STORE_PATH', FILES_PATH.'tests'.DS);
define('TEST_PDF_PATH',FILES_URL.DS.'tests/'.DS);
define('TEST_PDF_URL', FILES_URL.'tests/');
//Test Description PDF Ends

//Profile Description PDF Starts
define('PROFILE_PDF_STORE_PATH', FILES_PATH.'profiles'.DS);
define('PROFILE_PDF_PATH',FILES_URL.DS.'profiles/'.DS);
define('PROFILE_PDF_URL', FILES_URL.'profiles/');
//Profile Description PDF Ends

//Statuses starts
define('REQUEST_BOOKED','Test Booked');
define('AGENT_ASSIGNED','Agent Assigned');
define('SAMPLE_COLLECTED','Sample Collected');
define('SENT_LAB','Test in Progress');
define('REPORT_UPLOAD','You can only View / Download the report if the payment is fully paid');
//Statuses ends



define('ARR_ACTIVATE_ACTION', serialize(array('activate'=>'Activate')));
define('ARR_DEACTIVATE_ACTION', serialize(array('deactivate'=>'Deactivate')));
define('ARR_DELETE_ACTION', serialize(array('delete'=>'Delete')));
$actions = array_merge(unserialize(ARR_ACTIVATE_ACTION), unserialize(ARR_DEACTIVATE_ACTION), unserialize(ARR_DELETE_ACTION));
define('ARR_ACTIONS', serialize($actions));
define('DEFAULT_PAGE_SIZE', 9);
define('DEFAULT_PAGE_SIZE_GALLERY', 12);
define('DEFAULT_DATE_FORMAT', 'm-d-Y');

define('ARR_PENDING_ACTION', serialize(array('pending'=>'Pending')));
define('ARR_INPROGRESS_ACTION', serialize(array('inprocess'=>'Inprocess')));
define('ARR_CANCEL_ACTION', serialize(array('cancel'=>'Cancel')));
define('ARR_COMPLETE_ACTION', serialize(array('complete'=>'Complete')));
$orderActions = array_merge(unserialize(ARR_PENDING_ACTION), unserialize(ARR_INPROGRESS_ACTION), unserialize(ARR_CANCEL_ACTION), unserialize(ARR_COMPLETE_ACTION));
define('ORDER_ACTIONS', serialize($orderActions));

define('LIST_OFFSET', 60);
define('CURRENCY_FORMAT', serialize(array('places' => 2,'before' => '$ ','escape' => false,'decimals' => '.','thousands' => ','
))); 

define('PRODUCT_IMAGE_STORE_PATH', FILES_PATH.'products'.DS);
define('PRODUCT_IMAGE_THUMB_PATH', FILES_PATH.'products'.DS.'products_thumb'.DS);
define('PRODUCT_IMAGE_MEDIUM_PATH', FILES_PATH.'products'.DS.'medium'.DS);
define('PRODUCT_IMAGE_SMALL_PATH', FILES_PATH.'products'.DS.'small'.DS);
define('PRODUCT_IMAGE_SMALL_URL',FILES_URL.DS.'products/small'.DS);
define('PRODUCT_IMAGE_THUMB_URL',FILES_URL.DS.'products/products_thumb'.DS);
define('PRODUCT_PICTURE_ALLOWED_FORMATS', serialize(array('jpg', 'jpeg', 'jpe', 'gif', 'png')));
define('PRODUCT_IMAGE_URL', FILES_URL.'products/');
define('PRODUCT_IMAGE_MEDIUM_WIDTH', '267');
define('PRODUCT_IMAGE_SMALL_WIDTH', '409');
define('PRODUCT_IMAGE_THUMB_WIDTH', '88');

define('GALLERY_IMAGE_PATH', FILES_PATH.'galleries'.DS);
define('GALLERY_IMAGE_THUMB_PATH', GALLERY_IMAGE_PATH.'thumb'.DS);
define('GALLERY_IMAGE_URL', FILES_URL.DS.'galleries/');
define('GALLERY_IMAGE_THUMB_URL', GALLERY_IMAGE_URL.DS.'thumb/');
define('GALLERY_IMAGE_ALLOWED_FORMATS', serialize(array('jpg', 'jpeg', 'jpe', 'gif', 'png')));
define('GALLERY_IMAGE_THUMB_WIDTH', '227');


define('FABRIC_SUIT_IMAGE_THUMB_PATH', FILES_PATH.'uploads'.DS.'fabrics'.DS.'thumbnails'.DS);
define('FABRIC_SUIT_IMAGE_THUMB_URL',FILES_URL.DS.'/uploads/fabrics/thumbnails'.DS);
define('FABRIC_SUIT_IMAGE_THUMB_WIDTH', '80');
define('FABRIC_SUIT_IMAGE_SMALL_PATH', FILES_PATH.'uploads'.DS.'fabrics'.DS.'small'.DS);
define('FABRIC_SUIT_IMAGE_SMALL_URL',FILES_URL.DS.'/uploads/fabrics/small'.DS);
define('FABRIC_SUIT_IMAGE_SMALL_WIDTH', '414');
define('FABRIC_SMALL_IMAGE_PATH', FILES_PATH.'uploads'.DS.'fabrics'.DS);
define('FABRIC_BIG_IMAGE_PATH', FILES_PATH.'uploads'.DS.'fabrics'.DS.'big'.DS);
define('FABRIC_SMALL_IMAGE_WIDTH', '50');
define('FABRIC_BIG_IMAGE_WIDTH', '234');

define('TYPE_IMAGE_PATH', FILES_PATH.'uploads'.DS.'types'.DS);
define('TYPE_IMAGE_URL',FILES_URL.DS.'/uploads/types'.DS);
define('TYPE_IMAGE_SUIT_WIDTH', '138');
define('TYPE_IMAGE_WIDTH', '65');

define('VENT_IMAGE_PATH', FILES_PATH.'uploads'.DS.'vents'.DS);
define('VENT_IMAGE_URL',FILES_URL.DS.'/uploads/vents'.DS);
define('VENT_IMAGE_WIDTH', '182');

define("AUTHORIZENET_API_LOGIN_ID", "9Ev82aSpU8p");  
define("AUTHORIZENET_TRANSACTION_KEY", "3X4dawt274886STm");  
define("AUTHORIZENET_SANDBOX", true); 
/**
 * Enter your live account credentials to run tests against production gateway.
 */
define("MERCHANT_LIVE_API_LOGIN_ID", "");
define("MERCHANT_LIVE_TRANSACTION_KEY", "");

/**
 * Card Present Sandbox Credentials
 */
define("CP_API_LOGIN_ID", "");
define("CP_TRANSACTION_KEY", "");
$jacketSizeArray = array(0=>36,1=>38,2=>40,3=>42, 4=>44, 5=>46);
define("JACKETSIZEARRAY", serialize($jacketSizeArray));

$neckSizeArray = array(0=>37.5,1=>38.5,2=>40.5,3=>42,4=>43.5,5=>44);
define("NECKSIZEARRAY", serialize($neckSizeArray));

function prd($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die;
}

?>
