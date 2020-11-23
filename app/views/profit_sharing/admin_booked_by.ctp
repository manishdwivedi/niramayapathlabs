<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		dateFormat: 'dd-mm-yy'
	});
});
function set_option(val)
{
	if(val == 'filter')
	{
		var rep_text = '';
		rep_text +='<input type="hidden" name="data[BookedBy][set_option]" value="filter">';
		jQuery('#setOption').html(rep_text);
		document.forms['formreport'].submit();
	}
	if(val == 'export_excel')
	{
		var rep_text = '';
		rep_text +='<input type="hidden" name="data[BookedBy][set_option]" value="export_excel">';
		jQuery('#setOption').html(rep_text);
		document.forms['formreport'].submit();
	}
}
</script>
<style type="text/css">
.thickBorder td{
    text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;
}
.thickBorder td.heading{
    text-align:center; border:3px solid #D8D8D8;font-weight:bold;
}
td.recordRow{
    border-bottom: 1px solid #d8d8d8;
    
    border-right: 1px solid #d8d8d8;
    text-align: center;
}
td.recordRowFirst{
    border-bottom: 1px solid #d8d8d8;
    border-left: 1px solid #d8d8d8;
    border-right: 1px solid #d8d8d8;
    text-align: center;
}
</style>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Booked by BP Discounting Report</h2>
    </div>
    <div class="contentbox">
        <?php echo $this->Session->flash(); ?>
        <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Booked by BP Discounting Report
	<div>&nbsp;</div>
        <?php e($form->create('booked_by', array('url'=>array('controller'=>'profit_sharing', 'action'=>'booked_by'),'class'=>' zpFormLightgreen','id'=>'formreport'))); ?>
	
	<div id="setOption" style="display:none;"></div>

        <table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
            <thead>
		<tr>
                    <td colspan="9">
                        <table border="0" width="100%">
                            <tr>
						<td width="30"><?php echo $form->text('BookedBy.from_date',array('class'=>'input-Search datepicker','placeholder'=>'From Date'));?></td>
						<td width="30"><?php echo $form->text('BookedBy.to_date',array('class'=>'input-Search datepicker','placeholder'=>'To Date'));?></td>
					
                                                <td width="30">
                                                        <?php $empty=false; if(count($pcc_list) > 1) $empty="Select Booked By PCC" ; ?>
							<?php e($form->select('BookedBy.pcc_list_id1', $pcc_list, null, array('class'=>'input-Search','empty'=>$empty),null,false))?>
                                                </td>
                                                
                                                <td width="30">
                                                        <?php $empty=false; if(count($pcc_list) > 1) $empty="Select Service By PCC"; else $empty="Select Service By PCC"; ?>
							<?php e($form->select('BookedBy.pcc_list_id', $pcc_list, null, array('class'=>'input-Search','empty'=>$empty),null,false))?>
                                                </td>

                                                <td width="30">
							<?php e($form->select('BookedBy.agent_list_id', $agent_list, null, array('class'=>'input-Search','empty'=>'Select Agent'),null,false))?>
                                                </td>
						
						
						<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;','onclick'=>'set_option("filter");')); ?>&nbsp;&nbsp;<?php echo $form->submit('Export Excel', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;','onclick'=>'set_option("export_excel");')); ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<?php if(isset($summary) && !empty($summary)) {?>
		<tr>
			<td colspan="9">
				<table border="0" width="100%" class="thickBorder">
					<tr>
						<td class="heading">Total No. of Requests</td>
						<td class="heading">Total No. of Tests</td>
						<td class="heading">Total Test Amount</td>
						<td class="heading">Total Patient Discount</td>
						<td class="heading">Total Net Payable</td>
                                                

					</tr>
					<tr>
						<td><?php echo $summary['total_request'];?></td>
						<td><?php echo $summary['total_test'];?></td>
						<td><?php echo 'Rs. '.$summary['total_amount'];?></td>
						<td><?php echo 'Rs. '.$summary['total_discount_amount'];?></td>
						<td><?php echo 'Rs. '.$summary['total_net_payable'];?></td>
                                                
					</tr>

                                        <tr>
						<td class="heading">Total Received Amount</td>
						<td class="heading">Total Balance Due</td>
						<td class="heading">Gross BP Discount</td>
						<td class="heading">BP Discount %</td>
						<td class="heading">Net BP Discount</td>

					</tr>
					<tr>
						<td><?php echo 'Rs. '.$summary['total_received_amount'];?></td>
						<td><?php echo 'Rs. '.$summary['total_balance_due'];?></td>
						<td><?php echo 'Rs. '.$summary['gross_booked_income'];?></td>
						<td><?php echo $summary['booking_income_percent'].' %';?></td>
						<td><?php echo 'Rs. '.$summary['net_booked_income'];?></td>
					</tr>

				</table>
			</td>
		</tr>
                <?php } ?>

                <?php if(isset($all_record) && !empty($all_record)) {?>
		<tr>
			<th width="5%">S.No.</th>
			<th>Date</th>
			<th>ReqNo</th>
			<th>Ref No (if Any)</th>
            <th>Booked By</th>
			<th>Serviced By</th>
			<!--<th>Agent Name</th>-->
			<th>No of tests</th>
			<th>Test codes</th>
			<th>Test Amount</th>
			<th>Patient Discount</th>
			<th>Net Payable</th>
			<th>Payment Received</th>
			<th>Balance Due</th>
			<th>Payment Type</th>
			<th>BP Discount</th>
			<th>Net Testing Charges Billed</th>
			<th>Lab Patient ID</th>
			<th>Request Status</th>
		</tr>
		<?php if(count($all_record) > 0) { ?>
		<?php $g = 1;foreach($all_record as $rep_key => $rep_val) {?>
		<tr>
			<td class="recordRowFirst"><?php echo $g++;?></td>
			<td class="recordRow"><?php echo date('d-M-Y',strtotime($rep_val['Health']['s_date']));?></td>
			<td class="recordRow"><?php echo $rep_val['Billing']['order_id'];?></td>
			<td class="recordRow"><?php echo $rep_val['Health']['reference'];?></td>
			<td class="recordRow"><?php echo isset($rep_val['Health']['created_by'])?$pcc_list[$rep_val['Health']['created_by']]:'NPL';?></td>
			<td class="recordRow"><?php echo $pcc_list[$rep_val['Health']['assigned_lab']];?></td>
			<!--<td class="recordRow"><?php echo !empty($rep_val['Health']['agent_id'])?$agent_list[$rep_val['Health']['agent_id']]:'';?></td>-->
			<td class="recordRow"><?php echo $rep_val['Health']['no_of_test'];?></td>
			<td class="recordRow"><?php echo $rep_val['Health']['row_test_code'];?></td>
			<td class="recordRow"><?php echo $rep_val['Health']['row_test_amt'];?></td>
            <td class="recordRow"><?php echo $rep_val['Health']['discount_amount'];?></td>
            <td class="recordRow"><?php echo $rep_val['Health']['total_amount'];?></td>
			<td class="recordRow"><?php echo $rep_val['Health']['received_amount'];?></td>
			<td class="recordRow"><?php echo $rep_val['Health']['total_amount'] - $rep_val['Health']['received_amount'];?></td>
			<td class="recordRow"><?php echo $p_type[$rep_val['Health']['payment_type']];?></td>
			<td class="recordRow"><?php echo $rep_val['Health']['row_gross_booked_by_income'];?></td>
			<td class="recordRow"><?php echo $rep_val['Health']['total_amount']-$rep_val['Health']['row_net_booked_by_income']; ?><?php //echo round(($rep_val['Health']['row_gross_booked_by_income']*100)/$rep_val['Health']['row_test_amt'],2).'%';?></td>
			<td class="recordRow"><?php echo $rep_val['Health']['ref_num'];?></td>
			<td class="recordRow"><?php echo Configure::read('RequestStatus.'.$rep_val['Health']['requ_status']);?></td>

		</tr>
		<?php }?>
		
		<?php } else {?>
		<tr>
			<td colspan="17">No Records Found</td>
		</tr>
		<?php }}?>
	</thead>
</table>
<?php echo $form->end(); ?>
</div>
