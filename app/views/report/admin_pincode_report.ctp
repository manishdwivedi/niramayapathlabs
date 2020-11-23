
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
		rep_text +='<input type="hidden" name="data[PincodeReport][set_option]" value="filter">';
		jQuery('#setOption').html(rep_text);
		document.forms['formreport'].submit();
	}
	if(val == 'export_excel')
	{
		var rep_text = '';
		rep_text +='<input type="hidden" name="data[PincodeReport][set_option]" value="export_excel">';
		jQuery('#setOption').html(rep_text);
		document.forms['formreport'].submit();
	}
}
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Pincode Report</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Pincode Report
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/report/pincode_report','id'=>'formreport','name'=>'formreport')); ?>
	<div id="setOption" style="display:none;"></div>
        
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<td colspan="9">
				<table border="0" width="100%">
					<tr>
						<td width="30"><?php echo $form->text('PincodeReport.from_date',array('class'=>'input-Search datepicker','placeholder'=>'From Date'));?></td>
						<td width="30"><?php echo $form->text('PincodeReport.to_date',array('class'=>'input-Search datepicker','placeholder'=>'To Date'));?></td>
						<?php if($login_agent_type != 'Agent') {?>
						<td width="30">
							<?php if(empty($lab_id1)) {?>
							<select name="data[PincodeReport][lab_id]" class="input-Search">
								<option value="">Select Lab Name</option>
								<?php foreach($pcc as $ky => $vl) {?>
								<option value="<?php echo $ky;?>"><?php echo $vl;?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[PincodeReport][lab_id]" class="input-Search">
								<option value="">Select Lab Name</option>
								<?php foreach($pcc as $ky => $vl) {?>
								<option value="<?php echo $ky;?>" <?php if($lab_id1 == $ky) {?> selected="selected" <?php }?>><?php echo $vl;?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
                        <?php }?>
						<td width="30">
							<?php if(empty($status)) {?>
							<select name="data[PincodeReport][status_code]" class="input-Search">
								<option value="">Select Status</option>
								<?php foreach($status_code as $ky => $vl) {?>
								<option value="<?php echo $ky;?>"><?php echo $vl;?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[PincodeReport][status_code]" class="input-Search">
								<option value="">Select Status</option>
								<?php foreach($status_code as $ky => $vl) {?>
								<option value="<?php echo $ky;?>" <?php if($status == $ky) {?> selected="selected" <?php }?>><?php echo $vl;?></option>
								<?php }?>
							</select>
							<?php }?>
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
		<?php if(!empty($pincode)) {?>
		<tr>
			<td colspan="30" style="font-weight:bold;"><?php echo $this->element('pagination');?></td>
		</tr>
		<tr class="no_pie" style="font-size:14px;">
			<th width="5%"><div style="text-align:center;">S.No.</div></th>
			<th><div style="text-align:center;">Date</div></th>
			<th><div style="text-align:center;">Pincode</div></th>
			<th><div style="text-align:center;">City</div></th>
			<th><div style="text-align:center;">State</div></th>
            <th><div style="text-align:center;">PCC Name</div></th>
			<th><div style="text-align:center;">Pincode Status</div></th>
            <th><div style="text-align:center;">HTTP Code</div></th>					
		</tr>
		<?php if(count($pincode) > 0) {?>	
		<?php $g = 1;foreach($pincode as $rep_key => $rep_val) {?>
		<?php if($rep_val['PincodeReport']['status_code']==200){ ?>
			<tr class="no_pie" style="background-color:lightgreen;height:35px;font-size:14px;">
		<?php } else if($rep_val['PincodeReport']['status_code']==306){?>
			<tr class="no_pie" style="background-color:lightblue;height:35px;font-size:14px;">
		<?php } else {?>
			<tr class="no_pie" style="background-color:lightyellow;height:35px;font-size:14px;">
		<?php } ?>
			<td style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $g;?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo date('d-m-Y H:i:s',strtotime($rep_val['PincodeReport']['created_on']));?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['PincodeReport']['pincode'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['PincodeReport']['city'];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['PincodeReport']['state'];?></td>
            <td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $pcc[$rep_val['PincodeReport']['lab_id']];?></td>
			<td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['PincodeReport']['pin_status'];?></td>
            <td style="text-align:center; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo $rep_val['PincodeReport']['status_code'];?></td>  
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