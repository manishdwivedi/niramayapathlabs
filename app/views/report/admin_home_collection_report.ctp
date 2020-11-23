<style>
form table th{border-right:solid 1px #fff;}
form table td{
    border: 1px solid #d8d8d8;
    
    text-align: center;
}
</style>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		dateFormat: 'dd-mm-yy'
	});
	
	var booked_by_pie = $('#request_pie_data').val();
	var request_amount_pie = $('#request_amount_pie_data').val();
	
	if(booked_by_pie!='')
	{
		var request_pie_data = JSON.parse(booked_by_pie);
		
		console.log(request_pie_data);
		
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		// Draw the chart and set the chart values
		function drawChart() {
		  var data = google.visualization.arrayToDataTable(request_pie_data);

		  // Optional; add a title and set the width and height of the chart
		  var options = {'title':'Request Status Data', 'width':1000, 'height':800};

		  // Display the chart inside the <div> element with id="piechart"
		  var chart = new google.visualization.PieChart(document.getElementById('total_req_status'));
		  chart.draw(data, options);
		}
	}
	
	if(request_amount_pie!='')
	{
		var request_amount_pie_data = JSON.parse(request_amount_pie);
		
		console.log(request_amount_pie_data);
		
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		// Draw the chart and set the chart values
		function drawChart() {
		  var data = google.visualization.arrayToDataTable(request_amount_pie_data);

		  // Optional; add a title and set the width and height of the chart
		  var options = {'title':'Total Amount Request Status Vise Data', 'width':1000, 'height':800};

		  // Display the chart inside the <div> element with id="piechart"
		  var chart = new google.visualization.PieChart(document.getElementById('total_req_amount'));
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
     var statusContents = document.getElementById('request_pie_data').innerHTML;
	 //var reqAmount = document.getElementById('total_payable_piechart').innerHTML;
	 var pieTitle = document.getElementById('filter_class').innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = pieTitle+statusContents;
     window.print();

     document.body.innerHTML = originalContents;
}

</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Home Collection Report</h2>
    </div>
    <div class="contentbox">
        <?php echo $this->Session->flash(); ?>
        <?php echo $html->link('Home', '/admin/admins/index', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Home Collection Report
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/report/home_collection_report','id'=>'formreport','name'=>'formreport')); ?>
            <table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
                <thead>
                    <tr>
                        <td colspan="9">
                            <table border="0" width="100%" style="width:1180px;">
                                <tr>
                                    <td width="30"><?php echo $form->text('Report.from_date',array('class'=>'input-Search datepicker','placeholder'=>'From Date'));?></td>
                                    <td width="30"><?php echo $form->text('Report.to_date',array('class'=>'input-Search datepicker','placeholder'=>'To Date'));?></td>
                                    <?php if($login_agent_type != 'Agent') {?>
                                    <td width="30">
                                            <?php if(empty($lab_id1)) {?>
                                            <select name="data[Report][pcc_list_id1]" class="input-Search">
                                                    <?php echo $this->Utility->show_empty_pcc_yes_no_booked(); ?>
                                                    <?php foreach($pcc as $ky => $vl) {?>
                                                    <option value="<?php echo $vl['Lab']['id'];?>"><?php echo $vl['Lab']['pcc_name'];?></option>
                                                    <?php }?>
                                            </select>
                                            <?php } else {?>
                                            <select name="data[Report][pcc_list_id1]" class="input-Search">
                                                    <?php echo $this->Utility->show_empty_pcc_yes_no_booked(); ?>
                                                    <?php foreach($pcc as $ky => $vl) {?>
                                                    <option value="<?php echo $vl['Lab']['id'];?>" <?php if($lab_id1 == $vl['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Lab']['pcc_name'];?></option>
                                                    <?php }?>
                                            </select>
                                            <?php }?>
                                    </td>
                                    <td width="30">
                                            <?php if(empty($lab_id)) {?>
                                            <select name="data[Report][pcc_list_id]" class="input-Search">
                                                    <?php echo $this->Utility->show_empty_pcc_yes_no_service(); ?>
                                                    <option>Select A Lab</option>
                                                    <?php foreach($s_pcc as $ky => $vl) {?>
                                                    <option value="<?php echo $vl['Lab']['id'];?>"><?php echo $vl['Lab']['pcc_name'];?></option>
                                                    <?php }?>
                                            </select>
                                            <?php } else {?>
                                            <select name="data[Report][pcc_list_id]" class="input-Search">
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
                                            <?php if(empty($agent_id)) {?>
                                            <select name="data[Report][agent_list_id]" class="input-Search">
                                                    <option value="">Select Agent</option>
                                                    <?php foreach($agents as $agky => $agvl) {?>
                                                    <option value="<?php echo $agvl['Agent']['id'];?>"><?php echo $agvl['Agent']['name'];?></option>
                                                    <?php }?>
                                            </select>
                                            <?php } else {?>
                                            <select name="data[Report][agent_list_id]" class="input-Search">
                                                    <option value="">Select Agent</option>
                                                    <?php foreach($agents as $agky => $agvl) {?>
                                                    <option value="<?php echo $agvl['Agent']['id'];?>" <?php if($agent_id == $agvl['Agent']['id']) {?> selected="selected" <?php }?>><?php echo $agvl['Agent']['name'];?></option>
                                                    <?php }?>
                                            </select>
                                            <?php }?>
                                    </td>
                                    <td>
                                        <?php e($form->select('Report.request_status', Configure::read('RequestStatus'), null, array('class'=>'input-Search','empty'=>'Select Status'),null,false))?>
                                       
                                    </td>
                                    <td><?php echo $form->submit('Filter', array('name'=>'filter','value'=>'Filter','div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?>&nbsp;&nbsp;
                                        <?php echo $form->submit('Export Excel', array('name'=>'filter','value'=>'Export Excel','div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?>
										<?php if(isset($summary_data) && !empty($summary_data)) {?>
											&nbsp;&nbsp;<input class="btn no_pie" style="padding:0 2px; height:20px;" onclick="get_data();" type="button" value="Show Data">
											&nbsp;&nbsp;<input class="btn pie" style="padding:0 2px; height:20px;display:none;" onclick="hide_data();" type="button" value="Hide Data">
											&nbsp;&nbsp;<input class="btn pie" style="padding:0 2px; height:20px;display:none;" onclick="print_pie();" type="button" value="Print Pie Chart">
										<?php } ?>
									</td>
                                </tr>
                            </table>
			</td>
		</tr>
		<?php if(isset($summary_data) && !empty($summary_data)) {?>
		<tr class="no_pie">
			<td colspan="9">
				<table border="0" width="100%">
					<tr>
						<td>Total No. of Requests</td>
						<td>Total No. of Tests</td>
						<td>Total Net Payable</td>
						<td>Total Received Amount</td>
						<td>Total Balance Due</td>
					</tr>
					<tr>
						<td><?php echo $summary_data['total_request'];?></td>
						<td><?php echo $summary_data['total_test'];?></td>
						<td><?php echo 'Rs. '.$summary_data['total_net_payable'];?></td>
						<td><?php echo 'Rs. '.$summary_data['total_received_amt'];?></td>
						<td><?php echo 'Rs. '.$summary_data['total_balance_due'];?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="no_pie">
			<td colspan="30" style="font-weight:bold;text-align:left;"><?php echo $this->element('pagination');?></td>
		</tr>
		<tr class="no_pie">
			<th width="5%"><div style="text-align:center;">S.No.</div></th>
			<th>Date</th>
                        <th>Time</th>
			<th>ReqNo</th>
                        <th>Booked By PCC</th>
			<th>Service By PCC</th>
			<th>Patient Name</th>
                        <th>Phone No.</th>
			<th>Address</th>
                        <th>Agent Assigned</th>
                        <th>Net Payable</th>
                        <th>Payment Received</th>
                        <th>Balance Due</th>
                        <th>Request Status</th>
                        <th>Payment Type</th>
						<th>Lab Refrence No.</th>
                        <th>Cancellation Reason</th>
                        <th>Cancelled By</th>
                        
			
						
		</tr>
		<?php if(count($reports) > 0) {?>	
		<?php $g = 1;foreach($reports as $key => $val) {?>
		<tr class="no_pie">
			<td><?php echo $g;?></td>
			<td><?php echo $val['Health']['sample_date1'];?></td>
                        <td><?php echo Configure::read('TimeSlot.'.$val['Health']['sample_time1']);?></td>
			<td><?php echo $val['Billing']['order_id']; ?></td>
                        <td><?php echo isset($pcc_list[$val['Health']['created_by']])?$pcc_list[$val['Health']['created_by']]:'NPL';?></td>
			<td><?php echo isset($pcc_list[$val['Health']['assigned_lab']])?$pcc_list[$val['Health']['assigned_lab']]:'NPL';?></td>
			<td><?php echo $val['Health']['name'];?></td>
			<td><?php echo $this->Utility->show_mobile_hide($val['Health']['landline'],$val['Health']['sample_date1']); ?></td>
			
			<td><?php echo $val['Health']['address1'].','.$val['Health']['locality'].','.$val['City']['name'];?></td>
                        <td><?php echo !empty($val['Health']['agent_id']) ? $agents_list[$val['Health']['agent_id']] : '';?></td>
			<td><?php echo $val['Health']['total_amount'];?></td>
			<td><?php echo $val['Health']['received_amount'];?></td>
			<td><?php echo $val['Health']['total_amount']-$val['Health']['received_amount'];?></td>
            <td><?php echo Configure::read('RequestStatus.'.$val['Health']['requ_status']);?></td>
            <td><?php echo $p_type[$val['Health']['payment_type']];?></td>
			<td><?php echo $val['Health']['ref_num'];?></td>
			<td><?php echo $val['Health']['cancelled_reason']; ?></td>
			<td><?php echo $val['Admin']['name']; ?></td>
                        
		</tr>
		<?php $g++;}?>
		<tr class="no_pie">
			<td colspan="30" style="font-weight:bold;text-align:left;"><?php echo $this->element('pagination');?></td>
		</tr>
		<?php } else {?>
		<tr class="no_pie">
			<td colspan="29" style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; border-left:1px solid #D8D8D8; font-weight:bold; color:#FF0000;">No Records Found</td>
		</tr>
		<?php }}?>	
		<tr class="pie print_pie" style="display:none;">
			<td colspan="29"> <h2>Total Request - <?php echo $summary_data['total_request'];?></h2> </td>
		<tr class="pie print_pie" style="display:none;">
			<td id="filter_class">
				<div style="text-align: center;font-size: large;"><?php echo $filter_class;?></div>
				<div id="total_req_status" style="text-align: -webkit-center;"></div>
			</td>
		</tr>
		<tr></br></tr>
		<!--<tr class="pie print_pie" style="display:none;">
			<td colspan="29"> <h2>Total Request Amount - <?php echo 'Rs. '.$summary_data['total_net_payable'];?></h2></td>
		<tr class="pie print_pie" style="display:none;">
			<td><div id="total_req_amount" style="text-align: -webkit-center;"></div></td>
		</tr>-->
	</thead>
</table>

<input id='request_pie_data' value='<?php echo $total_req_status;?>' type='hidden'>
<input id='request_amount_pie_data' value='<?php echo $total_req_amount;?>' type='hidden'>
<?php echo $form->end(); ?>
</div>
</div>