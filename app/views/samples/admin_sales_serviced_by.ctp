<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>
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
		rep_text +='<input type="hidden" name="data[SalesReport][set_option]" value="filter">';
		jQuery('#setOption').html(rep_text);
		document.forms['formreport'].submit();
	}
	if(val == 'export_excel')
	{
		var rep_text = '';
		rep_text +='<input type="hidden" name="data[SalesReport][set_option]" value="export_excel">';
		jQuery('#setOption').html(rep_text);
		document.forms['formreport'].submit();
	}
}
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Sales Serviced By Report</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Sales Serviced By Report
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/samples/sales_serviced_by','id'=>'formreport','name'=>'formreport')); ?>
	<div id="setOption" style="display:none;"></div>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<td colspan="9">
				<table border="0" width="100%">
					<tr>
						<td width="30"><?php echo $form->text('SalesReport.from_date',array('class'=>'input-Search datepicker','placeholder'=>'From Date'));?></td>
						<td width="30"><?php echo $form->text('SalesReport.to_date',array('class'=>'input-Search datepicker','placeholder'=>'To Date'));?></td>
						<?php if($login_agent_type != 'Agent') {?>
						<td width="30">
							<?php if(empty($lab_id1)) {?>
							<select name="data[SalesReport][pcc_list_id1]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_booked(); ?>
								<option value="">Select Serviced By</option>
								<?php foreach($s_pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>"><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[SalesReport][pcc_list_id1]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_booked(); ?>
								<option value="">Select Serviced By</option>
								<?php foreach($s_pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>" <?php if($lab_id == $vl['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
                                                <td width="30">
							<?php if(empty($lab_id)) {?>
							<select name="data[SalesReport][pcc_list_id]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_service(); ?>
								<?php foreach($pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>"><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[SalesReport][pcc_list_id]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no(); ?>
								<?php foreach($pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>" <?php if($lab_id == $vl['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
						<?php }?>
						<td width="30">
							<?php if(empty($agent_id)) {?>
							<select name="data[SalesReport][agent_list_id]" class="input-Search">
								<option value="">Select Agent</option>
								<?php foreach($agents as $agky => $agvl) {?>
								<option value="<?php echo $agvl['Agent']['id'];?>"><?php echo $agvl['Agent']['name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[SalesReport][agent_list_id]" class="input-Search">
								<option value="">Select Agent</option>
								<?php foreach($agents as $agky => $agvl) {?>
								<option value="<?php echo $agvl['Agent']['id'];?>" <?php if($agent_id == $agvl['Agent']['id']) {?> selected="selected" <?php }?>><?php echo $agvl['Agent']['name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
						<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;','onclick'=>'set_option("filter");')); ?>&nbsp;&nbsp;<?php echo $form->submit('Export Excel', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;','onclick'=>'set_option("export_excel");')); ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<?php if(!empty($reports)) {?>
		<tr>
			<td colspan="9">
				<table border="0" width="100%">
					<tr>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Total No. of Requests</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Total No. of Tests</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Total Net Payable</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Total Received Amount</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Total Balance Due</td>
					</tr>
					<tr>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo $total_records;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo $total_test;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$net_pay;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$net_rec;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$net_bal;?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="30" style="font-weight:bold;"><?php echo $this->element('pagination');?></td>
		</tr>
		<tr>
			<th width="5%"><div style="text-align:center;">S.No.</div></th>
			<th><div style="text-align:center;">Date</div></th>
			<th><div style="text-align:center;">ReqNo</div></th>
			<th><div style="text-align:center;">Booked By PCC</div></th>
                        <th><div style="text-align:center;">Service By PCC</div></th>
                        <th><div style="text-align:center;">Booked By User</div></th>
			<th><div style="text-align:center;">Patient Name</div></th>
			<th><div style="text-align:center;">Gender/Age</div></th>
			<th><div style="text-align:center;">Phone No.</div></th>
			<th><div style="text-align:center;">Email</div></th>
			<th><div style="text-align:center;">Reffered By</div></th>
			<th><div style="text-align:center;">Agent Name</div></th>
			<th><div style="text-align:center;">No. of Test</div></th>
			<th><div style="text-align:center; width:150px;">Test Names</div></th>
			<th><div style="text-align:center; width:150px;">Test Codes</div></th>
			<th><div style="text-align:center; width:55px;">Test Amount</div></th>
			<th><div style="text-align:center;">Discount%</div></th>
			<th><div style="text-align:center; width:55px;">Discount Amount</div></th>
			<th><div style="text-align:center; width:55px;">Net Payble</div></th>
			<th><div style="text-align:center; width:55px;">Payment Received</div></th>
			<th><div style="text-align:center; width:55px;">Balance Due</div></th>
			<th><div style="text-align:center;">Lab Refrence No.</div></th>
			<th><div style="text-align:center;">Refrence No.</div></th>
			
						
		</tr>
		<?php if(count($reports) > 0) {?>	
		<?php $g = 1;foreach($reports as $rep_key => $rep_val) {?>
		<tr>
			<td style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $g;?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['book_date'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['req_num'];?></td>
                        <td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo !empty($rep_val['SalesReport']['pcc_name1'])?$rep_val['SalesReport']['pcc_name1']:'NPL';?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['pcc_name'];?></td>
                        <td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo isset($user_list[$rep_val['SalesReport']['booked_by_user']])?$user_list[$rep_val['SalesReport']['booked_by_user']]:'-';?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['patient_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['patient_gender'].'/'.$rep_val['SalesReport']['patient_age'];?></td>
			<!--<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['patient_contact'];?></td>-->
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $this->Utility->show_mobile_hide($rep_val['SalesReport']['patient_contact'],$rep_val['SalesReport']['book_date']); ?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $this->Utility->show_mobile_hide($rep_val['SalesReport']['patient_email'],$rep_val['SalesReport']['book_date']); ?></td>
			<?php //echo $this->Utility->show_mobile_hide($rep_val['SalesReport']['patient_email'],$rep_val['SalesReport']['book_date']); ?>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['refer_by'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['agent_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['parameter_count'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['parameter_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['parameter_code'];?></td>
			
			
			
			
			<?php if(($rep_val['SalesReport']['fix_discount'] != 'N/A') && ($rep_val['SalesReport']['fix_discount'] == '100%')) {?>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['test_amount'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['fix_discount'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['test_amount'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['net_payble'];?></td>
			<?php } else {?>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['test_amount'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['fix_discount'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['disc_amt'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['net_payble'];?></td>
			<?php }?>
			
			
			
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['receive_payment'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['balance_payment'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['test_ref_num'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['reference'];?></td>
		</tr>
		<?php $g++;}?>
		<tr>
			<td colspan="30" style="font-weight:bold;"><?php echo $this->element('pagination');?></td>
		</tr>
		<?php } else {?>
		<tr>
			<td colspan="29" style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; border-left:1px solid #D8D8D8; font-weight:bold; color:#FF0000;">No Records Found</td>
		</tr>
		<?php }}?>	
	</thead>
	
	
	
	
</table>
<?php echo $form->end(); ?>
</div>