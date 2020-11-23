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
	var request_status_pie = $('#request_status_pie_data').val();
	var monthly_booked_by_pie = $('#monthly_booked_by_pie_data').val();
	var monthly_request_status_pie = $('#monthly_request_status_pie_data').val();
	var yearly_booked_by_pie = $('#yearly_booked_by_pie_data').val();
	var yearly_request_status_pie = $('#yearly_request_status_pie_data').val();
	
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
	
	if(request_status_pie_data!='')
	{
		var request_status_pie_data = JSON.parse(request_status_pie);
		
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		// Draw the chart and set the chart values
		function drawChart() {
		  var data = google.visualization.arrayToDataTable(request_status_pie_data);

		  // Optional; add a title and set the width and height of the chart
		  var options = {'title':'Total Payable Data', 'width':550, 'height':400};

		  // Display the chart inside the <div> element with id="piechart"
		  var chart = new google.visualization.PieChart(document.getElementById('request_status_piechart'));
		  chart.draw(data, options);
		}
	}
	
	if(monthly_booked_by_pie!='')
	{
		var monthly_booked_by_pie_data = JSON.parse(monthly_booked_by_pie);
		
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		// Draw the chart and set the chart values
		function drawChart() {
		  var data = google.visualization.arrayToDataTable(monthly_booked_by_pie_data);

		  // Optional; add a title and set the width and height of the chart
		  var options = {'title':'Booked By Data (Monthly)', 'width':550, 'height':400};

		  // Display the chart inside the <div> element with id="piechart"
		  var chart = new google.visualization.PieChart(document.getElementById('monthly_booked_by_piechart'));
		  chart.draw(data, options);
		}
	}
	
	if(monthly_request_status_pie_data!='')
	{
		var monthly_request_status_pie_data = JSON.parse(monthly_request_status_pie);
		
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		// Draw the chart and set the chart values
		function drawChart() {
		  var data = google.visualization.arrayToDataTable(monthly_request_status_pie_data);

		  // Optional; add a title and set the width and height of the chart
		  var options = {'title':'Total Payable Data (Monthly)', 'width':550, 'height':400};

		  // Display the chart inside the <div> element with id="piechart"
		  var chart = new google.visualization.PieChart(document.getElementById('monthly_request_status_piechart'));
		  chart.draw(data, options);
		}
	}
	
	if(yearly_booked_by_pie!='')
	{
		var yearly_booked_by_pie_data = JSON.parse(yearly_booked_by_pie);
		
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		// Draw the chart and set the chart values
		function drawChart() {
		  var data = google.visualization.arrayToDataTable(yearly_booked_by_pie_data);

		  // Optional; add a title and set the width and height of the chart
		  var options = {'title':'Booked By Data (Yearly)', 'width':550, 'height':400};

		  // Display the chart inside the <div> element with id="piechart"
		  var chart = new google.visualization.PieChart(document.getElementById('yearly_booked_by_piechart'));
		  chart.draw(data, options);
		}
	}
	
	if(yearly_request_status_pie_data!='')
	{
		var yearly_request_status_pie_data = JSON.parse(yearly_request_status_pie);
		
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		// Draw the chart and set the chart values
		function drawChart() {
		  var data = google.visualization.arrayToDataTable(yearly_request_status_pie_data);

		  // Optional; add a title and set the width and height of the chart
		  var options = {'title':'Total Payable Data (Yearly)', 'width':550, 'height':400};

		  // Display the chart inside the <div> element with id="piechart"
		  var chart = new google.visualization.PieChart(document.getElementById('yearly_request_status_piechart'));
		  chart.draw(data, options);
		}
	}
});

function mail_report()
{
	var data = $('#formreport').serialize();
	var email = $('#DailyRequestReportEmail').val();
	console.log(data);
	console.log(email);
	$('#emailDiv').hide();
	$('#processingDiv').show();
	var dataString = 'data='+ data+'&email='+email;
	
	if(email!="" && email!=" ")
	{
		$.ajax({
			type: "POST",
			url: siteUrl+"samples/send_report",
			data: dataString,
			cache: false,
			success: function(html)
			{
				console.log(html);
				$('#emailDiv').show();
				$('#processingDiv').hide();
			}
		});
	}
}

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
	 var reqAmount = document.getElementById('request_status_piechart').innerHTML;
	 var monthlystatusContents = document.getElementById('monthly_booked_by_piechart').innerHTML;
	 var monthlyreqAmount = document.getElementById('monthly_request_status_piechart').innerHTML;
	 var pieTitle = document.getElementById('filter_class').innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = pieTitle+statusContents+reqAmount+monthlystatusContents+monthlyreqAmount;
     window.print();

     document.body.innerHTML = originalContents;
}

function set_option(val)
{
	if(val == 'filter')
	{
		var rep_text = '';
		rep_text +='<input type="hidden" name="data[DailyRequestReport][set_option]" value="filter">';
		jQuery('#setOption').html(rep_text);
		document.forms['formreport'].submit();
	}
	if(val == 'export_excel')
	{
		var rep_text = '';
		rep_text +='<input type="hidden" name="data[DailyRequestReport][set_option]" value="export_excel">';
		jQuery('#setOption').html(rep_text);
		document.forms['formreport'].submit();
	}
}
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Daily Request Report</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Daily Request Report
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/samples/daily_request_report','id'=>'formreport','name'=>'formreport')); ?>
	<div id="setOption" style="display:none;"></div>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<td colspan="9">
				<table border="0" width="100%" style="width:1150px;">
					<tr>
						<td width="30"><?php echo $form->text('DailyRequestReport.s_date',array('class'=>'input-Search datepicker','placeholder'=>'Request Date'));?></td>
						<!--<td width="30"><?php echo $form->text('DailyRequestReport.from_date',array('class'=>'input-Search datepicker','placeholder'=>'Sample Collection From Date'));?></td>
						<td width="30"><?php echo $form->text('DailyRequestReport.to_date',array('class'=>'input-Search datepicker','placeholder'=>'Sample Collection To Date'));?></td>-->
						<?php if($login_agent_type != 'Agent') {?>
						<td width="30">
							<?php if(empty($lab_id1)) {?>
							<select name="data[DailyRequestReport][pcc_list_id1]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_booked(); ?>
								<?php foreach($pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>"><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[DailyRequestReport][pcc_list_id1]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no_booked(); ?>
								<?php foreach($pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>" <?php if($lab_id1 == $vl['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
                        <td width="30">
							<?php if(empty($lab_id)) {?>
							<select name="data[DailyRequestReport][pcc_list_id]" class="input-Search">
								
								<?php echo $this->Utility->show_empty_pcc_yes_no_service(); ?>
								<?php foreach($pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>"><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[DailyRequestReport][pcc_list_id]" class="input-Search">
								<?php echo $this->Utility->show_empty_pcc_yes_no(); ?>
								
								<?php foreach($pcc as $ky => $vl) {?>
								<option value="<?php echo $vl['Lab']['id'];?>" <?php if($lab_id == $vl['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $vl['Lab']['pcc_name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
						<?php }?>
						<td width="30">
							<?php if(empty($requ_status)) {?>
							<select name="data[DailyRequestReport][requ_status]" class="input-Search">
								<option value="">Select Requet Status</option>
								<?php foreach($requ_list as $agky => $agvl) {?>
								<option value="<?php echo $agky;?>"><?php echo $agvl;?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[DailyRequestReport][requ_status]" class="input-Search">
								<option value="">Select Request Status</option>
								<?php foreach($requ_list as $agky => $agvl) {?>
								<option value="<?php echo $agky;?>" <?php if($requ_status == $agky) {?> selected="selected" <?php }?>><?php echo $agvl;?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
						<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;','onclick'=>'set_option("filter");')); ?>
							&nbsp;&nbsp;<?php echo $form->submit('Export Excel', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;','onclick'=>'set_option("export_excel");')); ?>
							<?php if(!empty($reports)) {?>
								&nbsp;&nbsp;<input class="btn no_pie" style="padding:0 2px; height:20px;" onclick="get_data();" type="button" value="Show Data">
								&nbsp;&nbsp;<input class="btn pie" style="padding:0 2px; height:20px;display:none;" onclick="hide_data();" type="button" value="Hide Data">
								&nbsp;&nbsp;<input class="btn pie" style="padding:0 2px; height:20px;display:none;" onclick="print_pie();" type="button" value="Print Pie Chart">
							<?php } ?>
						</td>
					</tr>
					<?php if(!empty($reports)) {?>
					<tr id="emailDiv">
						<td colspan="3">
							Email : <?php echo $form->text('DailyRequestReport.email',array('class'=>'input-Search','placeholder'=>'Email'));?>
							<input class="btn" style="padding:0 2px; height:20px;" onclick="mail_report();" type="button" value="Mail Report">
						</td>
					</tr>
					<tr id="processingDiv" style="display:none;">
						<td style="color:Green;font-size:13px;" colspan="3">
							Processing Request Data. Kindly Wait
						</td>
					</tr>
					<?php } ?>
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
			<th><div style="text-align:center;">Created On</div></th>
			<th><div style="text-align:center;">Req No.</div></th>
			<th><div style="text-align:center;">Booked From</div></th>
			<th><div style="text-align:center;">Reference No.</div></th>
			<th><div style="text-align:center;">MRN No.</div></th>
			<th><div style="text-align:center;">Pincode</div></th>
			<th><div style="text-align:center;">Collection Date</div></th>
			<th><div style="text-align:center;">Collection Time</div></th>
			<th><div style="text-align:center;">Booked By PCC</div></th>
            <th><div style="text-align:center;">Service By PCC</div></th>
            <th><div style="text-align:center;">Patient Name</div></th>
			<th><div style="text-align:center;">Gender/Age</div></th>
			<th><div style="text-align:center; width:150px;">Test Names</div></th>
			<th><div style="text-align:center; width:150px;">Test Codes</div></th>
			<th><div style="text-align:center; width:55px;">Net Payble</div></th>
			<th><div style="text-align:center; width:55px;">Balance Due</div></th>
			<th><div style="text-align:center; width:55px;">Payment Type</div></th>
			<th><div style="text-align:center; width:55px;">Amount Collected By PCC</div></th>
			<th><div style="text-align:center; width:55px;">Amount To Be Collected By NPL</div></th>
			<th><div style="text-align:center; width:55px;">Request Status</div></th>
			<th><div style="text-align:center;">Lab Reference No.</div></th>						
		</tr>
		<?php if(count($reports) > 0) {?>	
		<?php $g = 1;foreach($reports as $rep_key => $rep_val) {?>
		<tr class="no_pie">
			<td style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $g;?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['s_date'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['req_num'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['booking_mode'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['reference'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['medical_reference_number'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['pincode'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['sample_collected_date'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['sample_collected_time'];?></td>
            <td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo !empty($rep_val['DailyRequestReport']['pcc_name1'])?$rep_val['DailyRequestReport']['pcc_name1']:'NPL';?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['pcc_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['patient_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['patient_gender'].'/'.$rep_val['DailyRequestReport']['patient_age'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['parameter_name'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['parameter_code'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['net_payble'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['balance_payment'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['payment_type'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['amount_collected'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['amount_to_be_collected'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['requ_status'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['DailyRequestReport']['test_ref_num'];?></td>
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
				<div style="text-align: center;"><h2>Total Request (<?php echo date('d-m-Y',strtotime($s_date));?>) - <?php echo $total_records;?></h2></div>
				<div id="booked_by_piechart"></div>
			</td>
			<td>
				<div style="text-align: center;"><h2>Request Status Count (<?php echo date('d-m-Y',strtotime($s_date));?>) - <?php echo $total_records;?></h2></div>
				<div id="request_status_piechart"></div>
			</td>
		</tr>	
		<tr class="pie" style="display:none;">
			<td>
				<div style="text-align: center;"><h2>Total Request (Monthly) - <?php echo $monthly_total_records;?></h2></div>
				<div id="monthly_booked_by_piechart"></div>
			</td>
			<td>
				<div style="text-align: center;"><h2>Request Status Count (Monthly) - <?php echo $monthly_total_records;?></h2></div>
				<div id="monthly_request_status_piechart"></div>
			</td>
		</tr>
		<tr class="pie" style="display:none;">
			<td>
				<div style="text-align: center;"><h2>Total Request (Yearly) - <?php echo $yearly_total_records;?></h2></div>
				<div id="yearly_booked_by_piechart"></div>
			</td>
			<td>
				<div style="text-align: center;"><h2>Request Status Count (Yearly) - <?php echo $yearly_total_records;?></h2></div>
				<div id="yearly_request_status_piechart"></div>
			</td>
		</tr>
	</thead>
	
	
	
	
</table>
<input id='booked_by_pie_data' value='<?php echo $booked_by_total;?>' type='hidden'>
<input id='request_status_pie_data' value='<?php echo $request_status_total;?>' type='hidden'>
<input id='monthly_booked_by_pie_data' value='<?php echo $monthly_booked_by_total;?>' type='hidden'>
<input id='monthly_request_status_pie_data' value='<?php echo $monthly_request_status_total;?>' type='hidden'>
<input id='yearly_booked_by_pie_data' value='<?php echo $yearly_booked_by_total;?>' type='hidden'>
<input id='yearly_request_status_pie_data' value='<?php echo $yearly_request_status_total;?>' type='hidden'>

<?php echo $form->end(); ?>
</div>