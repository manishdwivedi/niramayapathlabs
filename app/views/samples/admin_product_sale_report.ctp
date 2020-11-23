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
		rep_text +='<input type="hidden" name="data[ProductReport][set_option]" value="filter">';
		jQuery('#setOption').html(rep_text);
		document.forms['formreport'].submit();
	}
	if(val == 'export_excel')
	{
		var rep_text = '';
		rep_text +='<input type="hidden" name="data[ProductReport][set_option]" value="export_excel">';
		jQuery('#setOption').html(rep_text);
		document.forms['formreport'].submit();
	}
}
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Product Sales Report</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Product Sales Report
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/samples/product_sale_report','id'=>'formreport','name'=>'formreport')); ?>
	<div id="setOption" style="display:none;"></div>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<td colspan="9">
				<table border="0" width="100%">
					<tr>
						<td width="30"><?php echo $form->text('ProductReport.from_date',array('class'=>'input-Search datepicker','placeholder'=>'From Date'));?></td>
						<td width="30"><?php echo $form->text('ProductReport.to_date',array('class'=>'input-Search datepicker','placeholder'=>'To Date'));?></td>
						<?php if($login_agent_type != 'Agent') {?>
						<td width="30">
							<?php if(empty($lab_id1)) {?>
							<select name="data[ProductReport][pcc_list_id1]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_booked(); ?>
								<?php foreach($pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>"><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[ProductReport][pcc_list_id1]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_booked(); ?>
								<?php foreach($pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>" <?php if($lab_id == $vl['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
                                                <td width="30">
							<?php if(empty($lab_id)) {?>
							<select name="data[ProductReport][pcc_list_id]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_service(); ?>
								<?php foreach($s_pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>"><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[ProductReport][pcc_list_id]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_service(); ?>
								<?php foreach($s_pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>" <?php if($lab_id == $vl['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
						<?php }?>
						<td width="30">
							<?php if(empty($agent_id)) {?>
							<select name="data[ProductReport][agent_list_id]" class="input-Search">
								<option value="">Select Agent</option>
								<?php foreach($agents as $agky => $agvl) {?>
								<option value="<?php echo $agvl['Agent']['id'];?>"><?php echo $agvl['Agent']['name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[ProductReport][agent_list_id]" class="input-Search">
								<option value="">Select Agent</option>
								<?php foreach($agents as $agky => $agvl) {?>
								<option value="<?php echo $agvl['Agent']['id'];?>" <?php if($agent_id == $agvl['Agent']['id']) {?> selected="selected" <?php }?>><?php echo $agvl['Agent']['name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>

						<td>
						<select name="data[ProductReport][test_list]" class="input-Search">
						<option value="">Select Test</option>
						<?php
						foreach($allTestLists as $test)
						{
					    echo "<option value=".$test['Test']['id']; if($test_list == $test['Test']['id']) { echo " selected"; }echo ">".$test['Test']['test_parameter']."</option>";	}
						?>
						</select>
						</td>
					</tr>
					<tr>
						<td width="30"><?php echo $form->text('ProductReport.test_code',array('class'=>'input-Search','placeholder'=>'Test Code'));?></td>
						<td width="30"><?php echo $form->text('ProductReport.profile_code',array('class'=>'input-Search','placeholder'=>'Profile Code'));?></td>
						<td width="30"><?php echo $form->text('ProductReport.offer_code',array('class'=>'input-Search','placeholder'=>'Offer Code'));?></td>
						<td width="30"><?php echo $form->text('ProductReport.package_code',array('class'=>'input-Search','placeholder'=>'Package Code'));?></td>
						<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;','onclick'=>'set_option("filter");')); ?>&nbsp;&nbsp;<?php echo $form->submit('Export Excel', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;','onclick'=>'set_option("export_excel");')); ?></td>
					</tr>
					<!--<tr>
						<td width="30"><?php //echo $form->text('ProductReport.test_name',array('class'=>'input-Search','placeholder'=>'Test Name'));?></td>
						<td width="30"><?php //echo $form->text('ProductReport.profile_name',array('class'=>'input-Search','placeholder'=>'Profile Name'));?></td>
						<td width="30"><?php //echo $form->text('ProductReport.offer_name',array('class'=>'input-Search','placeholder'=>'Offer Name'));?></td>
						<td width="30"><?php //echo $form->text('ProductReport.package_name',array('class'=>'input-Search','placeholder'=>'Package Name'));?></td>
						
					</tr>-->
				</table>
			</td>
		</tr>
		<?php if(!empty($reports)) {?>
		<tr>
			<td colspan="9">
				<table border="0" width="100%">
					<tr>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Total Requests</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Total Tests</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Total Amount</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Discount Amount</td>
						<td style="font-weight:bold; width:141px; border-top:3px solid #D8D8D8; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8; text-align:center;">Net Payable</td>
					</tr>
					<tr>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo $total_request;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo count($reports);?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$total_amount;?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.($total_amount-$net_amount);?></td>
						<td style="text-align:center; border-bottom:3px solid #D8D8D8; border-right:3px solid #D8D8D8; border-left:3px solid #D8D8D8;"><?php echo 'Rs. '.$net_amount;?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="30" style="font-weight:bold;">Total Records : <?php echo count($reports);?></td>
		</tr>
		<tr>
			<th width="5%"><div style="text-align:center;">S.No.</div></th>
			<th><div style="text-align:center;">Date</div></th>
			<th><div style="text-align:center;">ReqNo</div></th>
			<th><div style="text-align:center;">Test Code</div></th>
			<th><div style="text-align:center;">Test Name</div></th>
			<th><div style="text-align:center;">Booked By PCC</div></th>
                        <th><div style="text-align:center;">Service By PCC</div></th>
			<th><div style="text-align:center;">Agent Name</div></th>
			<th><div style="text-align:center;">Test Amount</div></th>
			<th><div style="text-align:center;">Discount %</div></th>
			<th><div style="text-align:center;">Discount Amount</div></th>
			<th><div style="text-align:center;">Net Payable</div></th>
		</tr>
		<?php if(count($reports) > 0) {?>	
		<?php $g = 1;foreach($reports as $rep_key => $rep_val) {?>
		<tr>
			<td style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $g;?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['ProductSales']['book_date'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['ProductSales']['req_num'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['ProductSales']['test_code'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['ProductSales']['test_name'];?></td>
                        <td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo isset($rep_val['ProductSales']['pcc_name1'])?$rep_val['ProductSales']['pcc_name1']:'NPL';?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['ProductSales']['pcc_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['ProductSales']['agent_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['ProductSales']['test_amount'];?></td>
			<?php if($rep_val['ProductSales']['discount_perc'] == '100%') {?>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['ProductSales']['discount_perc'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['ProductSales']['test_amount'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['ProductSales']['net_payable'];?></td>
			<?php } else {?>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['ProductSales']['discount_perc'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['ProductSales']['discount_amount'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['ProductSales']['net_payable'];?></td>
			<?php }?>
		</tr>
		<?php $g++;}?>
		<!--<tr>
			<td colspan="30" style="font-weight:bold;"><?php //echo $this->element('pagination');?></td>
		</tr>-->
		<?php } else {?>
		<tr>
			<td colspan="29" style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; border-left:1px solid #D8D8D8; font-weight:bold; color:#FF0000;">No Records Found</td>
		</tr>
		<?php }}?>	
	</thead>
	
	
	
	
</table>
<?php echo $form->end(); ?>
</div>