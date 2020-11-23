
<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
// Load google charts
</script>
<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		dateFormat: 'dd-mm-yy'
	});
	
		var booked_by_pie = $('#booked_by_pie_data').val();
	var total_payable_amount = $('#total_payable_pie_data').val();
	
	if(booked_by_pie!='')
	{
		var booked_by_pie_data = JSON.parse(booked_by_pie);
		
		console.log(booked_by_pie_data);
		
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		// Draw the chart and set the chart values
		function drawChart() {
		  var data = google.visualization.arrayToDataTable(booked_by_pie_data);

		  // Optional; add a title and set the width and height of the chart
		  var options = {'title':'Booked By Data', 'width':550, 'height':400};

		  // Display the chart inside the <div> element with id="piechart"
		  var chart = new google.visualization.PieChart(document.getElementById('booked_by_piechart'));
		  chart.draw(data, options);
		}
	}
	
	if(total_payable_amount!='')
	{
		var total_payable_pie_data = JSON.parse(total_payable_amount);
		
		console.log(booked_by_pie_data);
		
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		// Draw the chart and set the chart values
		function drawChart() {
		  var data = google.visualization.arrayToDataTable(total_payable_pie_data);

		  // Optional; add a title and set the width and height of the chart
		  var options = {'title':'Total Payable Data', 'width':550, 'height':400};

		  // Display the chart inside the <div> element with id="piechart"
		  var chart = new google.visualization.PieChart(document.getElementById('total_payable_piechart'));
		  chart.draw(data, options);
		}
	}
});

function get_data()
{
	$('.no_pie').hide();
	$('.pie').show();
}

function hide_data()
{
	$('.no_pie').show();
	$('.pie').hide();
}

function print_pie() {
     var statusContents = document.getElementById('booked_by_piechart').innerHTML;
	 var reqAmount = document.getElementById('total_payable_piechart').innerHTML;
	 var pieTitle = document.getElementById('filter_class').innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = pieTitle+statusContents+reqAmount;
     window.print();

     document.body.innerHTML = originalContents;
}

function set_option(val)
{
	if(val == 'filter')
	{
		var rep_text = '';
		rep_text +='<input type="hidden" name="data[RevenueReport][set_option]" value="filter">';
		jQuery('#setOption').html(rep_text);
		document.forms['formreport'].submit();
	}
	if(val == 'export_excel')
	{
		var rep_text = '';
		rep_text +='<input type="hidden" name="data[RevenueReport][set_option]" value="export_excel">';
		jQuery('#setOption').html(rep_text);
		document.forms['formreport'].submit();
	}
}
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Revenue Report</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Revenue Report
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/report/revenue_report','id'=>'formreport','name'=>'formreport')); ?>
	<div id="setOption" style="display:none;"></div>
        
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<td colspan="9">
				<table border="0" width="100%">
					<tr>
						<td width="30"><?php echo $form->text('RevenueReport.from_date',array('class'=>'input-Search datepicker','placeholder'=>'From Date'));?></td>
						<td width="30"><?php echo $form->text('RevenueReport.to_date',array('class'=>'input-Search datepicker','placeholder'=>'To Date'));?></td>
						<?php if($login_agent_type != 'Agent') {?>
						<td width="30">
							<?php if(empty($lab_id1)) {?>
							<select name="data[RevenueReport][pcc_list_id1]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_booked(); ?>
								<?php foreach($pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>"><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[RevenueReport][pcc_list_id1]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_booked(); ?>
								<?php foreach($pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>" <?php if($lab_id1 == $vl['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
                                                <td width="30">
							<?php if(empty($lab_id)) {?>
							<select name="data[RevenueReport][pcc_list_id]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_service(); ?>
								<option>Select A Lab</option>
								<?php foreach($s_pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>"><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[RevenueReport][pcc_list_id]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no(); ?>
								<option>Select A Lab</option>
								<?php foreach($s_pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>" <?php if($lab_id == $vl['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
						<?php }?>
						<td width="30">
							<?php if(empty($agent_id_booked)) {?>
							<select name="data[RevenueReport][agent_list_id1]" class="input-Search">
								<option value="">Select Booked By User</option>
								<?php foreach($agents_booked as $agky => $agvl) {?>
								<option value="<?php echo $agky;?>"><?php echo $agvl;?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[RevenueReport][agent_list_id1]" class="input-Search">
								<option value="">Select Booked By User</option>
								<?php foreach($agents_booked as $agky => $agvl) {?>
								<option value="<?php echo $agky;?>" <?php if($agent_id_booked == $agky) {?> selected="selected" <?php }?>><?php echo $agvl;?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
                                                <td width="30">
							<?php if(empty($agent_id)) {?>
							<select name="data[RevenueReport][agent_list_id]" class="input-Search">
								<option value="">Select Service By Agent</option>
								<?php foreach($agents as $agky => $agvl) {?>
								<option value="<?php echo $agvl['Agent']['id'];?>"><?php echo $agvl['Agent']['name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[RevenueReport][agent_list_id]" class="input-Search">
								<option value="">Select Service By Agent</option>
								<?php foreach($agents as $agky => $agvl) {?>
								<option value="<?php echo $agvl['Agent']['id'];?>" <?php if($agent_id == $agvl['Agent']['id']) {?> selected="selected" <?php }?>><?php echo $agvl['Agent']['name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>

					</tr>
                                        <tr>
                                            <td width="30">
                                                <?php e($form->select('RevenueReport.balance_due', array('partial_paid'=>'Partial Paid','not_paid'=>'Not Paid'), null, array('class'=>'input-Search','empty'=>'Select Payment Status'),null,false))?>
                                            </td>
                                            <td width="30">
                                                <?php e($form->select('RevenueReport.discount_status', array('yes'=>'Discount Given','no'=>'Discount Not Given'), null, array('class'=>'input-Search','empty'=>'Select Discount Status'),null,false))?>
                                            </td>
                                            <td width="30" colspan="2">
                                                <?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;','onclick'=>'set_option("filter");')); ?>
                                                &nbsp; &nbsp;
                                                <?php echo $form->submit('Export Excel', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;','onclick'=>'set_option("export_excel");')); ?>
												<?php if(!empty($reports)) {?>
													&nbsp;&nbsp;<input class="btn no_pie" style="padding:0 2px; height:20px;" onclick="get_data();" type="button" value="Show Data">
													&nbsp;&nbsp;<input class="btn pie" style="padding:0 2px; height:20px;display:none;" onclick="hide_data();" type="button" value="Hide Data">
													&nbsp;&nbsp;<input class="btn pie" style="padding:0 2px; height:20px;display:none;" onclick="print_pie();" type="button" value="Print Pie Chart">
												<?php } ?>
                                            </td>
                                        </tr>
				</table>
			</td>
		</tr>
		<?php if(!empty($reports)) {?>
		<tr class="no_pie">
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
		<tr class="no_pie">
			<th width="5%"><div style="text-align:center;">S.No.</div></th>
			<th><div style="text-align:center;">Date</div></th>
			<th><div style="text-align:center;">ReqNo</div></th>
			<th><div style="text-align:center;">Booked From</div></th>
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
			<th><div style="text-align:center;">Reference No.</div></th>
			<th><div style="text-align:center;">Request Status</div></th>
			<th><div style="text-align:center;">Payment Type</div></th>
			<th><div style="text-align:center;">Report</div></th>
						
		</tr>
		<?php if(count($reports) > 0) {?>	
		<?php $g = 1;foreach($reports as $rep_key => $rep_val) {?>
		<tr class="no_pie">
			<td style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $g;?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['book_date'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['req_num'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['booking_mode'];?></td>
                        <td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo isset($rep_val['RevenueReport']['pcc_name1'])?$rep_val['RevenueReport']['pcc_name1']:'NPL';?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['pcc_name'];?></td>
                        <td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo isset($user_list[$rep_val['RevenueReport']['booked_by_user']])?$user_list[$rep_val['RevenueReport']['booked_by_user']]:'-';?></td>  
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['patient_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['patient_gender'].'/'.$rep_val['RevenueReport']['patient_age'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $this->Utility->show_mobile_hide($rep_val['RevenueReport']['patient_contact'],$rep_val['RevenueReport']['book_date']); ?></td>
			
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $this->Utility->show_mobile_hide($rep_val['RevenueReport']['patient_email'],$rep_val['RevenueReport']['book_date']); ?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['refer_by'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['agent_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['parameter_count'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['parameter_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['parameter_code'];?></td>
			
			
			
			
			<?php if(($rep_val['RevenueReport']['fix_discount'] != 'N/A') && ($rep_val['RevenueReport']['fix_discount'] == '100%')) {?>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['test_amount'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['fix_discount'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['test_amount'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['net_payble'];?></td>
			<?php } else {?>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['test_amount'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['fix_discount'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['disc_amt'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['net_payble'];?></td>
			<?php }?>
			
			
			
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['receive_payment'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['balance_payment'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['test_ref_num'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['reference'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['RevenueReport']['request_status'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $p_type[$rep_val['RevenueReport']['payment_type']];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><a href="<?php echo $rep_val['RevenueReport']['report_url'];?>" target="_blank">View</a></td>
		</tr>
		<?php $g++;}?>
		<tr class="no_pie">
			<td colspan="30" style="font-weight:bold;"><?php echo $this->element('pagination');?></td>
		</tr>
		<?php } else {?>
		<tr class="no_pie">
			<td colspan="29" style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; border-left:1px solid #D8D8D8; font-weight:bold; color:#FF0000;">No Records Found</td>
		</tr>
		<?php }}?>	
		<tr class="pie" style="display:none;">
			<td colspan="29" id="filter_class"><div style="text-align: center;font-size: larger;"><?php echo $filter_class;?></div></td>
		</tr>
		<tr class="pie" style="display:none;">
			<td>
				<div style="text-align: center;"><h2>Total Request - <?php echo $total_records;?></h2></div>
				<div id="booked_by_piechart"></div>
			</td>
			<td>
				<div style="text-align: center;"><h2>Total Net Payable - <?php echo "Rs. ".$net_pay;?></h2></div>
				<div id="total_payable_piechart"></div>
			</td>
		</tr>
	</thead>
	
	
	
	
</table>
<input id='booked_by_pie_data' value='<?php echo $booked_by_total;?>' type='hidden'>
<input id='total_payable_pie_data' value='<?php echo $total_payable_amount;?>' type='hidden'>
<?php echo $form->end(); ?>
</div>