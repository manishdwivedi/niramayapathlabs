<?php
/*

- Use PAYTM_ENVIRONMENT as 'PROD' if you wanted to do transaction in production environment else 'TEST' for doing transaction in testing environment.
- Change the value of PAYTM_MERCHANT_KEY constant with details received from Paytm.
- Change the value of PAYTM_MERCHANT_MID constant with details received from Paytm.
- Change the value of PAYTM_MERCHANT_WEBSITE constant with details received from Paytm.
- Above details will be different for testing and production environment.

*/
/*test
define('PAYTM_ENVIRONMENT', 'TEST'); // PROD //TEST
define('PAYTM_MERCHANT_KEY', 'wDCvL4HrT9cpiJ%C'); //Change this constant's value with Merchant key downloaded from portal
define('PAYTM_MERCHANT_MID', 'Nirama67124075557527'); //Change this constant's value with MID (Merchant ID) received from Paytm
define('PAYTM_MERCHANT_WEBSITE', 'niramayahealthcareWEB'); //Change this constant's value with Website name received from Paytm
*/

define('PAYTM_ENVIRONMENT', 'PROD'); // PROD //TEST
define('PAYTM_MERCHANT_KEY', 'LTxp00u3fbeanb&J'); //Change this constant's value with Merchant key downloaded from portal
define('PAYTM_MERCHANT_MID', 'Nirama09285107747542'); //Change this constant's value with MID (Merchant ID) received from Paytm
define('PAYTM_MERCHANT_WEBSITE', 'NiramaWEB'); //Change this constant's value with Website name received from Paytm


$PAYTM_DOMAIN = "pguat.paytm.com";
if (PAYTM_ENVIRONMENT == 'PROD') {
	$PAYTM_DOMAIN = 'secure.paytm.in';
}

define('PAYTM_REFUND_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/REFUND');
define('PAYTM_STATUS_QUERY_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/TXNSTATUS');
define('PAYTM_TXN_URL', 'https://'.$PAYTM_DOMAIN.'/oltp-web/processTransaction');

define('PAYTM_SUCCESS_RESPONSE', 'http://www.niramayahealthcare.com/payment_paytm/success');
define('PAYTM_FAILURE_RESPONSE', 'http://www.niramayahealthcare.com/payment_paytm/failure');

?>