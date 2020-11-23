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
        <h2>Daily Collection Report</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Daily Collection Report
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/samples/daily_collection_report','id'=>'formreport','name'=>'formreport')); ?>
	<div id="setOption" style="display:none;"></div>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<td colspan="10">
				<table border="0" width="100%">
					<tr>
						<td width="30"><?php echo $form->text('SalesReport.from_date',array('class'=>'input-Search datepicker','placeholder'=>'From Date'));?></td>
						<td width="30"><?php echo $form->text('SalesReport.to_date',array('class'=>'input-Search datepicker','placeholder'=>'To Date'));?></td>
						<?php if($login_agent_type != 'Agent') { ?>
						<td width="30">
							<?php if(empty($pcc_list_id1)) {?>
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
								<option value="<?php echo $vl['Lab']['id'];?>" <?php if($pcc_list_id1 == $vl['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
                                                <td width="30">
							<?php if(empty($pcc_list_id)) {?>
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
								<option value="<?php echo $vl['Lab']['id'];?>" <?php if($pcc_list_id == $vl['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Lab']['pcc_name'];?></option>
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
						<td width="30">
							<?php if(empty($select_mode)) {?>
							<select name="data[SalesReport][paymode]" class="input-Search">
								<option value="">Select Mode</option>
								<option value="paymenttopcc">Payment To PCC</option>
								<option value="cash">Cash</option>
								<option value="credit_card">Credit Card</option>
								<option value="cheque">Cheque</option>
								<option value="adjust">Adjustment</option>
                                                                <option value="online">Online</option>
							</select>
							<?php } else {?>
							<select name="data[SalesReport][paymode]" class="input-Search">
								<option value="">Select Mode</option>
								<option value="paymenttopcc" <?php if($select_mode == 'paymenttopcc') {?> selected="selected" <?php }?>>Payment to PCC</option>
								<option value="cash" <?php if($select_mode == 'cash') {?> selected="selected" <?php }?>>Cash</option>
								<option value="credit_card" <?php if($select_mode == 'credit_card') {?> selected="selected" <?php }?>>Credit Card</option>
								<option value="cheque" <?php if($select_mode == 'cheque') {?> selected="selected" <?php }?>>Cheque</option>
								<option value="adjust" <?php if($select_mode == 'adjust') {?> selected="selected" <?php }?>>Adjustment</option>
                                                                <option value="online" <?php if($select_mode == 'online') {?> selected="selected" <?php }?>>Online</option>
							</select>
							<?php }?>
						</td>
						<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;','onclick'=>'set_option("filter");')); ?>&nbsp;&nbsp;<?php echo $form->submit('Export Excel', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;','onclick'=>'set_option("export_excel");')); ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<?php if(count($reports) > 0) {?>
		<tr>
			<td colspan="9">
				<table border="0" width="100%">
					<tr>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Total Collection</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Payment To PCC Collection</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Cash Collection</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Cheque Collection</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Credit Card Collection</td>
                                                <td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Online Collection</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Adjustment</td>
					</tr>
					<tr>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$total_amt;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$paymenttopcc_amt;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$cash_amt;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$cheque_amt;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$credit_card_amt;?></td>
                                                <td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$online_amt;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$adjust_amt;?></td>
					</tr>
				</table>
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
			<th><div style="text-align:center;">Booked By PCC</div></th>
                        <th><div style="text-align:center;">Service By PCC</div></th>
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
                        <td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo isset($rep_val['SalesReport']['pcc_name1']) ? $rep_val['SalesReport']['pcc_name1'] : 'NPL';?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['pcc_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['agent_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['receive_by'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['patient_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $this->Utility->show_mobile_hide($rep_val['SalesReport']['patient_contact'],$rep_val['SalesReport']['receive_date']); ?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['SalesReport']['install_amt'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;">	
				<?php 
				if($rep_val['SalesReport']['pay_mode'] == 'paymenttopcc') { 
					echo 'Payment To PCC';
				} elseif($rep_val['SalesReport']['pay_mode'] == 'cash') { 
					echo 'Cash';
				} elseif($rep_val['SalesReport']['pay_mode'] == 'cheque') {
					echo 'Cheque';
				} elseif($rep_val['SalesReport']['pay_mode'] == 'credit_card') {
					echo 'Credit Card';
				} elseif($rep_val['SalesReport']['pay_mode'] == 'adjust') {
					echo 'Adjustment';
				} elseif($rep_val['SalesReport']['pay_mode'] == 'online') {
					echo 'Online';
				} elseif($rep_val['SalesReport']['pay_mode'] == 'btc') {
					echo 'BTC';
				} else {
					echo 'BTC No Payment';
				}?>
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
<?php echo $form->end(); ?>
</div>