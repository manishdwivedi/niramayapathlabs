<?php
if(isset($summary) && !empty($summary)):
    $line = array('Total No. of Requests','Total No. of Tests','Total Test Amount','Total Patient Discount','Total Net Payable');
    $csv->addRow($line);
    $line = array($summary['total_request'],$summary['total_test'],'Rs. '.$summary['total_amount'],'Rs. '.$summary['total_discount_amount'],'Rs. '.$summary['total_net_payable']);
    $csv->addRow($line);

    $line = array('Total Received Amount','Total Balance Due','Gross BP Discount','BP Discount %','Net BP Discount');
    $csv->addRow($line);
    $line = array('Rs. '.$summary['total_received_amount'],'Rs. '.$summary['total_balance_due'],'Rs. '.$summary['gross_booked_income'],$summary['booking_income_percent'].' %','Rs. '.$summary['net_booked_income']);
    $csv->addRow($line);
endif;
$csv->addRow(array());

if(count($all_record)):
$line = array('S.No.','Date','ReqNo','Ref No (if Any)','Medical Reference Number','Booked By','Serviced By','No of tests','Test codes','Test Amount','Patient Discount','Net Payable','Payment Received','Balance Due','Payment Type','BP Discount','Net Testing Charges Billed','Lab Patient ID','Request Status','City');
$csv->addRow($line);

$g = 1;
foreach($all_record as $rep_key => $rep_val):
$per_net_income = round(($rep_val['Health']['row_gross_booked_by_income']*100)/$rep_val['Health']['row_test_amt'],2).'%';
$line = array($g,date('d-M-Y',strtotime($rep_val['Health']['s_date'])),$rep_val['Billing']['order_id'],$rep_val['Health']['reference'],$rep_val['Health']['medical_reference_number'],isset($rep_val['Health']['created_by'])?$pcc_list[$rep_val['Health']['created_by']]:'NPL',$pcc_list[$rep_val['Health']['assigned_lab']],$rep_val['Health']['no_of_test'],$rep_val['Health']['row_test_code'],$rep_val['Health']['row_test_amt'],$rep_val['Health']['discount_amount'],$rep_val['Health']['total_amount'],$rep_val['Health']['received_amount'],$rep_val['Health']['total_amount'] - $rep_val['Health']['received_amount'],$p_type[$rep_val['Health']['payment_type']],$rep_val['Health']['row_gross_booked_by_income'],$rep_val['Health']['total_amount']-$rep_val['Health']['row_net_booked_by_income'],$rep_val['Health']['ref_num'],Configure::read('RequestStatus.'.$rep_val['Health']['requ_status']),$rep_val['Health']['city_name']);
$csv->addRow($line);
$g++;
endforeach;
endif;
echo $csv->render('profit_sharing_booked_by.csv');
?>