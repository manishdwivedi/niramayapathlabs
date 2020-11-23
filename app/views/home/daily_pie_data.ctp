<?php 
	if(isset($options) && $options!='')
	{
		$paginator->options=array('url'=>$options);
	}
	ob_start();
?>
<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
<script type='text/javascript'>
// Load google charts
</script>

<script type='text/javascript'>
$(function() {	
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
		  var options = {'title':'Request Count (Daily)', 'width':550, 'height':400};

		  // Display the chart inside the <div> element with id='piechart'
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
		  var options = {'title':'Request Status Count (Daily)', 'width':550, 'height':400};

		  // Display the chart inside the <div> element with id='piechart'
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
		  var options = {'title':'Request Count (Monthly)', 'width':550, 'height':400};

		  // Display the chart inside the <div> element with id='piechart'
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
		  var options = {'title':'Request Status Count (Monthly)', 'width':550, 'height':400};

		  // Display the chart inside the <div> element with id='piechart'
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


</script>
<table border='0' cellspacing='2' cellpadding='0' align='center' width='100%'>
	<thead>
		<tr>
			<td colspan="2" >
				<h2 style="text-align:center;"><?php echo $pcc_name;?> Request Data from <?php echo date('1-m-Y');?> to <?php echo date('d-m-Y',strtotime($export_date));?></h2>
			</td>
		</tr>
		<tr class='pie' >
			<td>
				<div style='text-align: center;'><h3>Total Request (<?php echo date('d-m-Y',strtotime($export_date));?>) - <?php echo $total_records;?></h3></div>
				<div id='booked_by_piechart'></div>
			</td>
			<td>
				<div style='text-align: center;'><h3>Request Status Count (<?php echo date('d-m-Y',strtotime($export_date));?>) - <?php echo $total_records;?></h3></div>
				<div id='request_status_piechart'></div>
			</td>
		</tr>	
		<tr class='pie' >
			<td>
				<div style='text-align: center;'><h3>Total Request (<?php echo date('M Y'); ?>) - <?php echo $monthly_total_records;?></h3></div>
				<div id='monthly_booked_by_piechart'></div>
			</td>
			<td>
				<div style='text-align: center;'><h3>Request Status Count (<?php echo date('M Y'); ?>) - <?php echo $monthly_total_records;?></h3></div>
				<div id='monthly_request_status_piechart'></div>
			</td>
		</tr>
		<tr class="pie">
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
<?php ob_end_flush();  ?>