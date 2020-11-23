<?php

$line = array('Total No. of Requests','Total No. of Tests','Total Net Payable','Total Received Amount','Total Balance Due');
$csv->addRow($line);
$line = array($summary_data['total_request'],$summary_data['total_test'],'Rs. '.$summary_data['total_net_payable'],'Rs. '.$summary_data['total_received_amt'],'Rs. '.$summary_data['total_balance_due']);
$csv->addRow($line);

if(count($reports)):
$line = array('S.No.','Date','Time','ReqNo','Booked By PCC','Service By PCC','Patient Name','Phone No.','Address','Agent Assigned','Net Payable','Payment Received','Balance Due','Request Status','Payment Type','Lab Refrence No.','Cancellation Reason','Cancelled By');
$csv->addRow($line);

$g = 1;
foreach($reports as $key => $val):
$counter = $key+1;
$line = array($g,$val['Health']['sample_date1'],Configure::read('TimeSlot.'.$val['Health']['sample_time1']),$val['Billing']['order_id'],isset($pcc_list[$val['Health']['created_by']])?$pcc_list[$val['Health']['created_by']]:'NPL',isset($pcc_list[$val['Health']['assigned_lab']])?$pcc_list[$val['Health']['assigned_lab']]:'NPL',$val['Health']['name'],$this->Utility->show_mobile_hide($val['Health']['landline'],$val['Health']['sample_date1']),$val['Health']['address1'].','.$val['Health']['locality'].','.$val['City']['name'],!empty($val['Health']['agent_id']) ? $agents_list[$val['Health']['agent_id']] : '',$val['Health']['total_amount'],$val['Health']['received_amount'],$val['Health']['total_amount']-$val['Health']['received_amount'],Configure::read('RequestStatus.'.$val['Health']['requ_status']),$p_type[$val['Health']['payment_type']],$val['Health']['ref_num'],$val['Health']['cancelled_reason'],$val['Admin']['name']);
$csv->addRow($line);
$g++;
endforeach;
endif;
echo $csv->render('home_collection_report.csv');
?>