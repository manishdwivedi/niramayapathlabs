<?php 
 /*production*/
	Configure::write('debug',0); 
	
	if($_SERVER['REMOTE_ADDR'] == '172.31.17.77')
	{
		Configure::write('debug',2);
	}



/**

 * Application wide charset encoding

 */

	Configure::write('App.encoding', 'UTF-8');

/**

 * To configure CakePHP *not* to use mod_rewrite and to

 * use CakePHP pretty URLs, remove these .htaccess

 * files:

 *

 * /.htaccess

 * /app/.htaccess

 * /app/webroot/.htaccess

 *

 * And uncomment the App.baseUrl below:

 */

	//Configure::write('App.baseUrl', env('SCRIPT_NAME'));

/**

 * Uncomment the define below to use CakePHP admin routes.

 *

 * The value of the define determines the name of the route

 * and its associated controller actions:

 *

 * 'admin' 		-> admin_index() and /admin/controller/index

 * 'superuser' -> superuser_index() and /superuser/controller/index

 */

	Configure::write('Routing.prefixes', array('admin'));



/**

 * Turn off all caching application-wide.

 *

 */

	Configure::write('Cache.disable', true);

/**

 * Enable cache checking.

 *

 * If set to true, for view caching you must still use the controller

 * var $cacheAction inside your controllers to define caching settings.

 * You can either set it controller-wide by setting var $cacheAction = true,

 * or in each action using $this->cacheAction = true.

 *

 */

	//Configure::write('Cache.check', true);

/**

 * Defines the default error type when using the log() function. Used for

 * differentiating error logging and debugging. Currently PHP supports LOG_DEBUG.

 */

	define('LOG_ERROR', 2);

/**

 * The preferred session handling method. Valid values:

 *

 * 'php'	 		Uses settings defined in your php.ini.

 * 'cake'		Saves session files in CakePHP's /tmp directory.

 * 'database'	Uses CakePHP's database sessions.

 *

 * To define a custom session handler, save it at /app/config/<name>.php.

 * Set the value of 'Session.save' to <name> to utilize it in CakePHP.

 *

 * To use database sessions, execute the SQL file found at /app/config/sql/sessions.sql.

 *

 */

	Configure::write('Session.save', 'php');

    Configure::write('Error', array(
        'handler' => 'ErrorHandler::handleError',
        'level' => E_ALL & ~E_STRICT & ~E_DEPRECATED,
        'trace' => true
    ));
    
/**

 * The name of the table used to store CakePHP database sessions.

 *

 * 'Session.save' must be set to 'database' in order to utilize this constant.

 *

 * The table name set here should *not* include any table prefix defined elsewhere.

 */

	//Configure::write('Session.table', 'cake_sessions');

/**

 * The DATABASE_CONFIG::$var to use for database session handling.

 *

 * 'Session.save' must be set to 'database' in order to utilize this constant.

 */

	//Configure::write('Session.database', 'default');

/**

 * The name of CakePHP's session cookie.

 */

	Configure::write('Session.cookie', 'CAKEPHP');

/**

 * Session time out time (in seconds).

 * Actual value depends on 'Security.level' setting.

 */

	Configure::write('Session.timeout', '120');

/**

 * If set to false, sessions are not automatically started.

 */

	Configure::write('Session.start', true);

/**

 * When set to false, HTTP_USER_AGENT will not be checked

 * in the session

 */

	Configure::write('Session.checkAgent', true);

/**

 * The level of CakePHP security. The session timeout time defined

 * in 'Session.timeout' is multiplied according to the settings here.

 * Valid values:

 *

 * 'high'	Session timeout in 'Session.timeout' x 10

 * 'medium'	Session timeout in 'Session.timeout' x 100

 * 'low'		Session timeout in 'Session.timeout' x 300

 *

 * CakePHP session IDs are also regenerated between requests if

 * 'Security.level' is set to 'high'.

 */

	Configure::write('Security.level', 'medium');

/**

 * A random string used in security hashing methods.

 */

	Configure::write('Security.salt', 'DYhG93b0qyJfIxfs2guVoUubWwvniR2G0FgaC9mi1');

	

	/**

 * A random numeric string (digits only) used to encrypt/decrypt strings.

 */

	Configure::write('Security.cipherSeed', '76859309657453542496749683645');



	

/**

 * Compress CSS output by removing comments, whitespace, repeating tags, etc.

 * This requires a/var/cache directory to be writable by the web server for caching.

 * and /vendors/csspp/csspp.php

 *

 * To use, prefix the CSS link URL with '/ccss/' instead of '/css/' or use HtmlHelper::css().

 */

	//Configure::write('Asset.filter.css', 'css.php');

/**

 * Plug in your own custom JavaScript compressor by dropping a script in your webroot to handle the

 * output, and setting the config below to the name of the script.

 *

 * To use, prefix your JavaScript link URLs with '/cjs/' instead of '/js/' or use JavaScriptHelper::link().

 */

	//Configure::write('Asset.filter.js', 'custom_javascript_output_filter.php');

/**

 * The classname and database used in CakePHP's

 * access control lists.

 */
        date_default_timezone_set('Asia/Calcutta');
        
	Configure::write('Acl.classname', 'DbAcl');

	Configure::write('Acl.database', 'default');

/**

 *

 * Cache Engine Configuration

 * Default settings provided below

 *

 * File storage engine.

 *

 * 	 Cache::config('default', array(

 *		'engine' => 'File', //[required]

 *		'duration'=> 3600, //[optional]

 *		'probability'=> 100, //[optional]

 * 		'path' => CACHE, //[optional] use system tmp directory - remember to use absolute path

 * 		'prefix' => 'cake_', //[optional]  prefix every cache file with this string

 * 		'lock' => false, //[optional]  use file locking

 * 		'serialize' => true, [optional]

 *	));

 *

 *

 * APC (http://pecl.php.net/package/APC)

 *

 * 	 Cache::config('default', array(

 *		'engine' => 'Apc', //[required]

 *		'duration'=> 3600, //[optional]

 *		'probability'=> 100, //[optional]

 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string

 *	));

 *

 * Xcache (http://xcache.lighttpd.net/)

 *

 * 	 Cache::config('default', array(

 *		'engine' => 'Xcache', //[required]

 *		'duration'=> 3600, //[optional]

 *		'probability'=> 100, //[optional]

 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional] prefix every cache file with this string

 *		'user' => 'user', //user from xcache.admin.user settings

 *      'password' => 'password', //plaintext password (xcache.admin.pass)

 *	));

 *

 *

 * Memcache (http://www.danga.com/memcached/)

 *

 * 	 Cache::config('default', array(

 *		'engine' => 'Memcache', //[required]

 *		'duration'=> 3600, //[optional]

 *		'probability'=> 100, //[optional]

 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string

 * 		'servers' => array(

 * 			'127.0.0.1:11211' // localhost, default port 11211

 * 		), //[optional]

 * 		'compress' => false, // [optional] compress data in Memcache (slower, but uses less memory)

 *	));

 *

 */

		Configure::write('SiteSettings.siteUrl','http://34.217.109.229/');
        /*
         * DirectPay Settings for Online Payment
         * Don't modify below code
         */
        //Configure::write('DirectPay.mid', '200904281000001');//test
        Configure::write('DirectPay.mid', '201407281000003');//live
        Configure::write('DirectPay.operating_mode', 'DOM');
        Configure::write('DirectPay.country', 'IND');
        Configure::write('DirectPay.currency', 'INR');
        Configure::write('DirectPay.amount', '');
        Configure::write('DirectPay.order_number', '');
        Configure::write('DirectPay.other_detail', 'other details');
        Configure::write('DirectPay.success_url', 'http://www.niramayahealthcare.com/payment/success');
        Configure::write('DirectPay.failure_url', 'http://www.niramayahealthcare.com/payment/failure');
        //Configure::write('DirectPay.collaborator', 'TOML');//test
        Configure::write('DirectPay.collaborator', 'DirecPay');//live
        //Configure::write('DirectPayKey','qcAHa6tt8s0l5NN7UWPVAQ==');//test
        Configure::write('DirectPayKey','ESh+kaGUzl5DX2rQMhdexQ==');//live
        Configure::write('DirectPayBillCountry','IN');
        //Configure::write('DirectPaySubmitUrl','http://test.timesofmoney.com/direcpay/secure/dpMerchantPayment.jsp');//test
        Configure::write('DirectPaySubmitUrl','https://www.timesofmoney.com/direcpay/secure/dpMerchantPayment.jsp');//live
		
		/*active payment gateway***********************************************/
		Configure::write('ActivePG','PAYTM');
        
        /*paytm payment for online payment*/
        //Configure::write('PayTM.mid', 'Nirama67124075557527');//test
		Configure::write('PayTM.mid', 'Nirama09285107747542');//live
        
        //Configure::write('PayTM.merchant_key','wDCvL4HrT9cpiJ%C');//test
		Configure::write('PayTM.merchant_key','LTxp00u3fbeanb&J');//live
        
        Configure::write('PayTM.channel_id', 'WEB');
        
		//Configure::write('PayTM.industry_type_id','Retail');//test
		Configure::write('PayTM.industry_type_id','Retail109');//live
        
        //Configure::write('PayTM.website','niramayahealthcareWEB');//test
		Configure::write('PayTM.website','NiramaWEB');//live
       
        Configure::write('PayTM.amount', '');
        Configure::write('PayTM.order_number', '');
        Configure::write('PayTM.SubmitUrl',Configure::read('SiteSettings.siteUrl').'PaytmKit/pgRedirect.php');

        Configure::write('TimeSlot',array(
										1=>'6:00AM - 7:00AM',
										2=>'6:30AM - 7:30AM',
										3=>'7:00AM - 8:00AM',
                                        4=>'7:30AM - 8:30AM',
                                        5=>'8:00AM - 9:00AM',
                                        6=>'8:30AM - 9:30AM',
                                        7=>'9:00AM - 10:00AM',
                                        8=>'9:30AM - 10:30AM',
                                        9=>'10:00AM - 11:00AM',
                                        10=>'10:30AM - 11:30AM',
                                        11=>'11:00AM - 12:00AM',
                                        12=>'11:30AM - 12:30PM',
                                        13=>'12:00PM - 1:00PM',
                                        14=>'12:30PM - 1:30PM',
                                        15=>'1:00PM - 2:00PM',
                                        16=>'1:30PM - 2:30PM',
                                        17=>'2:00PM - 3:00PM',
                                        18=>'2:30PM - 3:30PM',
                                        19=>'3:00PM - 4:00PM',
                                        20=>'3:30PM - 4:30PM',
                                        21=>'4:00PM - 5:00PM',
                                        22=>'4:30PM - 5:30PM',
                                        23=>'5:00PM - 6:00PM',
                                        24=>'5:30PM - 6:30PM',
                                        25=>'6:00PM - 7:00PM',
                                        26=>'6:30PM - 7:30PM'
										
										));
        Configure::write('RequestStatus',array(0=>'New Booking',
												15=>'API New Booking',
												18=>'Booking Confirmed',
												1=>'Slot Not Available',
												2=>'Slot Blocked',
												4=>'Phlebo Assigned',
												19=>'Phlebo Confirmed',
												20=>'Phlebo Tracking',
												16=>'Specimen Drawn',
												21=>'Specimen onHold',
												3=>'Follow Up',
												13=>'Rescheduled',
												10=>'Sample Collected',
												14=>'Reg. in LIS',
												11=>'Sample Rejected',
												12=>'Partial Sent To Lab',
												5=>'Sent to Lab',
												8=>'Cancelled',
												7=>'Partial Report',
												6=>'Report',
												17=>'Partial Closed',
												9=>'Closed',
												22=>'Cxl Req by Phlebo',
												23=>'Rejection Request'
										));

        /*constant for profit sharing*/
        Configure::write('Profit.Category',array(
            1=>array('title'=>'SR','desc'=>'Special Routine'),
            2=>array('title'=>'R','desc'=>'Routine'),
            3=>array('title'=>'SA','desc'=>'Special Advance'),
            4=>array('title'=>'A','desc'=>'Advance'),
            5=>array('title'=>'PKG','desc'=>'nirAmaya Packages'),
            6=>array('title'=>'SPL','desc'=>'Special Offers'),
            7=>array('title'=>'PCS','desc'=>'Patient Care Services')
        ));
		
		Configure::write('RunnerStatus',array('1'=>'New Adhoc Request','10'=>'New Recurring Request','11'=>'Drop Location Allocated','2'=>'Runner Assigned','3'=>'Runner Confirmed','4'=>'Pick Up','5'=>'Dropped','6'=>'Confirmed By Lab','7'=>'Cancelled','8'=>'Request Rescheduled','9'=>'Closed'));
		
        Configure::write('CancelStatus',array(
            /*'Wrong Ph. No'=>'Wrong Ph. No',
            'Wrong Address'=>'Wrong Address',
            'Duplicate Booking'=>'Duplicate Booking',
            'Out of Service area'=>'Out of Service area',
            'Patient not reachable'=>'Patient not reachable',
            'Request for An Other Lab'=>'Request for An Other Lab',
            'Cancelled upon HC Phlebo visit'=>'Cancelled upon HC Phlebo visit',
            'Cancelled before HC Phlebo visit'=>'Cancelled before HC Phlebo visit',
            'Phlebo not able to draw the sample'=>'Phlebo not able to draw the sample',
            'Phlebo reached late for the sample collection'=>'Phlebo reached late for the sample collection',
            'Patient not paying the test amount as per request'=>'Patient not paying the test amount as per request',
            'Patient postponed multiple times seems not interested'=>'Patient postponed multiple times seems not interested',
            'custom'=>'Write own message',*/

            'Before Visit - Not Interested'=>'Before Visit - Not Interested',
            'Before Visit - Not  Reachable/Responding/Switched OFF'=>'Before Visit - Not  Reachable/Responding/Switched OFF',
            'Before Visit - Request for Another Lab'=>'Before Visit - Request for Another Lab',
            //'Before Visit - Out of Town'=>'Before Visit - Out of Town',
            'Before Visit - Test Already Done'=>'Before Visit - Test Already Done',
            'Before Visit - Not Required'=>'Before Visit - Not Required',
            'Before Visit - Discount or Payment Issue'=>'Before Visit - Discount or Payment Issue',
            //'Before Visit - Out of zone'=>'Before Visit - Out of zone',
            //'Before Visit -  Phlebo Reached Late'=>'Before Visit -  Phlebo Reached Late',
            'After Visit -  Request for Another Lab'=>'After Visit -  Request for Another Lab',
            'After Visit -  Not Reachable/Responding/Switched OFF'=>'After Visit -  Not Reachable/Responding/Switched OFF',
            'After Visit -  Request for Another Lab'=>'After Visit -  Request for Another Lab',
            'After Visit -  Out of Town'=>'After Visit -  Out of Town',
            'After Visit -  Not been able to Draw Sample'=>'After Visit -  Not been able to Draw Sample',
            'After Visit -  Not on Fasting'=>'After Visit -  Not on Fasting',
            'After Visit -  Discount or Payment Issue'=>'After Visit -  Discount or Payment Issue',
            'After Visit - Miscellaneous'=>'After Visit - Miscellaneous',
            'After Visit - Rescheduled'=>'After Visit - Rescheduled',
			'After Visit - Not Interested'=>'After Visit - Not Interested',
			'After Visit - Phlebo Reached Late'=>'After Visit - Phlebo Reached Late',
			'After Visit - Sample already taken'=>'After Visit - Sample already taken',
            'Duplicate Booking'=>'Duplicate Booking / Wrong Entry'
			

            ));
			
	/*smtp options*/ 
	Configure::write('SMTP',array(
		 'port'=>'25',
		 'timeout'=>'30',
		 'host' => 'email-smtp.us-west-2.amazonaws.com',
		 'username'=>'AKIAJQO367UVOHAOKLTA',
		 'password'=>'AiikEB5AYOsA2lPSqP8z8UISPkq4f4EJuEpJiy9foODK',
		 'tls'=>true
		 //'client' => 'smtp_helo_hostname'
	));	
?>
