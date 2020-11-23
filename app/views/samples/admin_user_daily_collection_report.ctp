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


function calculate_pay()
{
	var total_collection = '<?php echo $total_amt;?>';
	var nn = parseInt(total_collection);
	var cash = document.getElementById('DailyCollectionTotalCash').value;
	var credit = document.getElementById('DailyCollectionTotalCreditCard').value;
	var cheque = document.getElementById('DailyCollectionTotalCheque').value;
	if(cash == ''){var cash_amt = 0;}else{var cash_amt = parseInt(document.getElementById('DailyCollectionTotalCash').value);}
	if(credit == ''){var credit_amt = 0;}else{var credit_amt = parseInt(document.getElementById('DailyCollectionTotalCreditCard').value);}
	if(cheque == ''){var cheque_amt = 0;}else{var cheque_amt = parseInt(document.getElementById('DailyCollectionTotalCheque').value);}
	var total_amount = parseInt(cash_amt+credit_amt+cheque_amt);
	var variation = parseInt(total_collection-total_amount);
	$('#DailyCollectionTotalDeposit').val(total_amount);
	$('#DailyCollectionTotalVariation').val(variation);
}
		
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Daily Collection Report</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Daily Collection Report
	<div>&nbsp;</div>
	
	<div id="setOption" style="display:none;"></div>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<td colspan="10">
				<?php echo $form->create(null, array('url'=>'/admin/samples/user_daily_collection_report','id'=>'formreport','name'=>'formreport')); ?>
				<table border="0" width="100%">
					<tr>
						<td width="30"><?php echo $form->text('SalesReport.from_date',array('class'=>'input-Search datepicker','placeholder'=>'Select Date'));?></td>
						<?php if($login_agent_type != 'Agent') { ?>
						<td width="30">
							<?php if(empty($lab_id1)) {?>
							<select name="data[SalesReport][pcc_list_id1]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_booked(); ?>
								<?php foreach($pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>"><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[SalesReport][pcc_list_id1]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_booked(); ?>
								<?php foreach($pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>" <?php if($lab_id == $vl['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
                                                <td width="30">
							<?php if(empty($lab_id)) {?>
							<select name="data[SalesReport][pcc_list_id]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_service(); ?>
								<?php foreach($s_pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>"><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[SalesReport][pcc_list_id]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no(); ?>
								<?php foreach($s_pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>" <?php if($lab_id == $vl['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
						<?php }?>
						<td width="30">
							<?php if(empty($select_user)) {?>
							<select name="data[SalesReport][admin_list_id]" class="input-Search">
								<option value="">Select User</option>
								<?php $i = 1;foreach($select_user as $ky => $vl) {?>
								<?php if($vl['Admin']['userType'] == 'A') {?>
								<option value="<?php echo $vl['Admin']['id'];?>"><?php echo $vl['Admin']['name'].' (Super Admin)';?></option>
								<?php } elseif($vl['Admin']['userType'] == 'BM') {?>
								<option value="<?php echo $vl['Admin']['id'];?>"><?php echo $vl['Admin']['name'].' (Buisiness Manager)';?></option>
								<?php } else {?>
								<option value="<?php echo $vl['Admin']['id'];?>"><?php echo $vl['Admin']['name'].' ('.$vl['Admin']['userValue'].' Lab)';?></option>
								<?php }$i++;}?>
							</select>
							<?php } else {?>
							<select name="data[SalesReport][admin_list_id]" class="input-Search">
								<option value="">Select User</option>
								<?php $i = 1;foreach($select_user as $ky => $vl) {?>
								<?php if($vl['Admin']['userType'] == 'A') {?>
								<option value="<?php echo $vl['Admin']['id'];?>" <?php if($select_user == $vl['Admin']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Admin']['name'].' (Super Admin)';?></option>
								<?php } elseif($vl['Admin']['userType'] == 'BM') {?>
								<option value="<?php echo $vl['Admin']['id'];?>" <?php if($select_user == $vl['Admin']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Admin']['name'].' (Buisiness Manager)';?></option>
								<?php } else {?>
								<option value="<?php echo $vl['Admin']['id'];?>" <?php if($select_user == $vl['Admin']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Admin']['name'].' ('.$vl['Admin']['userValue'].' Lab)';?></option>
								<?php }$i++;}?>
							</select>
							<?php }?>
						</td>
						<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
					</tr>
				</table>
				<?php echo $form->end();?>
			</td>
		</tr>
		<?php if(count($reports) > 0) {?>
		<tr>
			<td colspan="9">
				<table border="0" width="100%">
					<tr>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Total Collection</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Cash Collection</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Cheque Collection</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Credit Card Collection</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Adjustment</td>
					</tr>
					<tr>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$total_amt;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$cash_amt;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$cheque_amt;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$credit_card_amt;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$adjust_amt;?></td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td colspan="9">
				<?php echo $form->create(null,array('url'=>'/admin/samples/user_daily_collection_report/save_detail'));?>
				<?php echo $form->hidden('DailyCollection.report_date',array('value'=>$date_report));?>
				<?php echo $form->hidden('DailyCollection.upper_total_amount',array('value'=>$total_amt));?>
				<?php echo $form->hidden('DailyCollection.upper_cash_amount',array('value'=>$cash_amt));?>
				<?php echo $form->hidden('DailyCollection.upper_credit_card_amount',array('value'=>$credit_card_amt));?>
				<?php echo $form->hidden('DailyCollection.upper_cheque_amount',array('value'=>$cheque_amt));?>
				<?php echo $form->hidden('DailyCollection.adjustment_amount',array('value'=>$adjust_amt));?>
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="6" style="text-align:center; font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; border-top:1px solid #D8D8D8;">Amount Deposited</td>
					</tr>
					<tr>
						<td style="border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $form->text('DailyCollection.total_cash',array('class'=>'input-Search','placeholder'=>'Total Cash','onkeyup'=>'calculate_pay();'));?></td>
						<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $form->text('DailyCollection.total_cheque',array('class'=>'input-Search','placeholder'=>'Total Cheque/DD','onkeyup'=>'calculate_pay();'));?></td>
						<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $form->text('DailyCollection.total_credit_card',array('class'=>'input-Search','placeholder'=>'Total Credit Card','onkeyup'=>'calculate_pay();'));?></td>
						<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $form->text('DailyCollection.total_deposit',array('class'=>'input-Search','placeholder'=>'Total Deposited','readonly'=>'readonly'));?></td>
						<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $form->text('DailyCollection.total_variation',array('class'=>'input-Search','placeholder'=>'Variation(Short/Over)','readonly'=>'readonly'));?></td>
						<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $form->submit('Submit', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
					</tr>
				</table>
				<?php echo $form->end();?>
			</td>
		</tr>
		
		<!--<tr>
			<td colspan="30" style="font-weight:bold;"><?php //echo $this->element('pagination');?></td>
		</tr>-->
		<?php }?>
		<tr>
			<th width="5%"><div style="text-align:center;">S.No.</div></th>
			<th><div style="text-align:center;">Collection Date & Time</div></th>
			<th><div style="text-align:center;">ReqNo</div></th>
			<th><div style="text-align:center;">PCC Name</div></th>
			<th><div style="text-align:center;">Agent Name</div></th>
			<th><div style="text-align:center;">Received By</div></th>
			<th><div style="text-align:center;">Patient Name</div></th>
			<th><div style="text-align:center;">Contact No.</div></th>
			<th><div style="text-align:center;">Installment Amount</div></th>
			<th><div style="text-align:center;">Payment Mode</div></th>
		</tr>
		<?php if(count($reports) > 0) {?>	
		<?php $g = 1;foreach($reports as $rep_key => $rep_val) {?>
		<tr>
			<td style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $g;?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['receive_date'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['req_num'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['pcc_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['agent_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['receive_by'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['patient_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $this->Utility->show_mobile_hide($rep_val['SalesReport']['patient_contact'],$rep_val['SalesReport']['receive_date']); ?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['install_amt'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;">	
				<?php if($rep_val['SalesReport']['pay_mode'] == 'cash') {?>
					<?php echo 'Cash';?>
				<?php }?>
				<?php if($rep_val['SalesReport']['pay_mode'] == 'cheque') {?>
					<?php echo 'Cheque';?>
				<?php }?>
				<?php if($rep_val['SalesReport']['pay_mode'] == 'credit_card') {?>
					<?php echo 'Credit Card';?>
				<?php }?>
				<?php if($rep_val['SalesReport']['pay_mode'] == 'adjust') {?>
					<?php echo 'Adjustment';?>
				<?php }?>
			</td>
		</tr>
		<?php $g++;}?>
		<!--<tr>
			<td colspan="30" style="font-weight:bold;"><?php //echo $this->element('pagination');?></td>
		</tr>-->
		<?php } else {?>
		<tr>
			<td colspan="29" style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; border-left:1px solid #D8D8D8; font-weight:bold; color:#FF0000; text-align:center;">No Records Found</td>
		</tr>
		<?php }?>	
	</thead>
</table>
</div>