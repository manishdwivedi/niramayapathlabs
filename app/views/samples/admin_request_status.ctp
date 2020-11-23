<style type="text/css">
.class-textarea
{
	border: 1px solid #999999;
    border-radius: 3px 3px 3px 3px;
    color: #666666;
    margin-bottom: 5px;
    padding: 10px;
    width: 375px;
	font-size:13px;
	height:121px;
}
.hint-class
{
	color:#999999; 
	font-size:11px; 
	padding:0 0 0 10px;
}
.boldText
{
	width:200px;
}
</style>
<script type="text/javascript">
function reschduled(val)
{
	if(val == 1)
	{
		$('#ReschduledDivDate').show();
		$('#ReschduledDivTime').show(); 
		var res_time = '';
		var res_date= '';	
		res_time +='<td>';
		res_time +='<input type="text" name="data[Health][old_time]" value="<?php echo $pat_collecttime;?>">';
		res_time +='</td>';
		res_date +='<td>';
		res_date +='<input type="text" name="data[Health][old_date]" value="<?php echo $pat_collectdate;?>">';
		res_date +='</td>';
		$('#timeDiv').html(res_time);
		$('#dateDiv').html(res_date);
	}
	if(val == 0)
	{
		$('#ReschduledDivDate').hide();
		$('#ReschduledDivTime').hide();
		var res_time = '';
		var res_date= '';	
		res_time +='<td>';
		res_time +='';
		res_time +='</td>';
		res_date +='<td>';
		res_date +='';
		res_date +='</td>';
		$('#timeDiv').html(res_time);
		$('#dateDiv').html(res_date);
	}
}
function cancelled(val)
{
	if(val == 1)
	{
		$('#CancelledDiv').show();
	}
	if(val == 0)
	{
		$('#CancelledDiv').hide();	
	}
}
function published(val)
{
	if(val == 1)
	{
		$('#PublishedDiv').hide();
	}
	if(val == 0)
	{
		$('#PublishedDiv').show();
	}
}
</script>
<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		//minDate: 0,
		maxDate: '+6M',
		dateFormat: 'dd-mm-yy'
	});
});


$(document).ready(function() {
<?php if(($pat_old_date != '0000-00-00') && ($pat_old_time != 0)) {?>
	$('#ReschduledDivDateNew').show();
	$('#ReschduledDivTimeNew').show();
	
<?php }?>
<?php if(!empty($pat_cancelled_reason)) {?>
	$('#CancelledDivNew').show();
<?php }?>
<?php if(!empty($pat_published_reason)) {?>
	$('#PublishedDivNew').show();
<?php }?>
});
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Edit Request Status</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/samples/home/SG9tZQ==/Assign', array('title'=>'Home')); ?>&nbsp;&nbsp;&#187;&nbsp;&nbsp;Edit Collection Request Status for <?php echo ucfirst($pat_name);?>
	<?php echo $form->create(null, array('url'=>'/admin/samples/request_status/'.$req_id,'enctype'=>'multipart/form-data')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Test Booked / TRF Filled</td>
		<td>
			<input type="radio" name="data[Health][trf_status]" value="1" <?php if($pat_trf_status == 1) {?> checked="checked" <?php }?> />&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="data[Health][trf_status]" value="0" <?php if($pat_trf_status == 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;No
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Report sent to Pathcorp</td>
		<td>
			<input type="radio" name="data[Health][sent_pathcorp]" value="1" <?php if($pat_sent_pathcorp == 1) {?> checked="checked" <?php }?> />&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="data[Health][sent_pathcorp]" value="0" <?php if($pat_sent_pathcorp == 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;No
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Report received from Pathcorp</td>
		<td>
			<input type="radio" name="data[Health][receive_pathcorp]" value="1" <?php if($pat_receive_pathcorp == 1) {?> checked="checked" <?php }?> />&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="data[Health][receive_pathcorp]" value="0" <?php if($pat_receive_pathcorp == 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;No
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Request Reschduled</td>
		<td>
			<input type="radio" name="data[Health][reschduled]" value="1" onclick="reschduled(1);" <?php if($pat_reschduled == 1) {?> checked="checked" <?php }?> />&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="data[Health][reschduled]" value="0" onclick="reschduled(0);" <?php if($pat_reschduled == 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;No
		</td>
	</tr>
	<tr id="timeDiv" style="display:none;">
	</tr>
	<tr id="dateDiv" style="display:none;">
	</tr>
	<tr id="ReschduledDivDateNew" style="display:none;">
		<td width="15%" class="boldText">Reschduled Date</td>
		<td>
			<?php echo $form->text('Health.sample_date1', array('class'=>'input-text datepicker','style'=>'width:100px;','value'=>date('d-m-Y',strtotime($pat_sample_date1)))); ?>
		</td>
	</tr>
	<tr id="ReschduledDivDate" style="display:none;">
		<td width="15%" class="boldText">Reschduled Date</td>
		<td>
			<?php echo $form->text('Health.sample_date1', array('class'=>'input-text datepicker','style'=>'width:100px;')); ?>
		</td>
	</tr>
	</tr>
	<tr id="ReschduledDivTimeNew" style="display:none;">
		<td width="15%" class="boldText">Reschduled Time</td>
		<td>
			<select name="data[Health][sample_time1]" id="HealthSampleTime1" class="input-text">
				<option value="">Select Time</option>
				<?php foreach($timelabs as $key => $val) {?>
				<option value="<?php echo $val['Timelab']['id'];?>" <?php if($pat_sample_time1 == $val['Timelab']['id']) {?> selected="selected" <?php }?>><?php echo $val['Timelab']['name'];?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr id="ReschduledDivTime" style="display:none;">
		<td width="15%" class="boldText">Reschduled Time</td>
		<td>
			<select name="data[Health][sample_time1]" id="HealthSampleTime1" class="input-text">
				<option value="">Select Time</option>
				<?php foreach($timelabs as $key => $val) {?>
				<option value="<?php echo $val['Timelab']['id'];?>"><?php echo $val['Timelab']['name'];?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Request Cancelled</td>
		<td>
			<input type="radio" name="data[Health][cancelled_status]" value="1" onclick="cancelled(1);" <?php if($pat_cancelled_status == 1) {?> checked="checked" <?php }?> />&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="data[Health][cancelled_status]" value="0" onclick="cancelled(0);" <?php if($pat_cancelled_status == 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;No
		</td>
	</tr>
	<tr id="CancelledDivNew" style="display:none;">
		<td width="15%" class="boldText">Cancelled Reason</td>
		<td>
			<?php echo $form->textarea('Health.cancelled_reason_new', array('class'=>'class-textarea','value'=>$pat_cancelled_reason)); ?>
		</td>
	</tr>
	<tr id="CancelledDiv" style="display:none;">
		<td width="15%" class="boldText">Cancelled Reason</td>
		<td>
			<?php echo $form->textarea('Health.cancelled_reason', array('class'=>'class-textarea')); ?>
		</td>
	</tr>
	<?php if($report_status == 'uploaded') {?>
	<?php echo $form->hidden('Health.old_report',array('value'=>$report_name));?>
	<tr>
		<td width="15%" class="boldText">Patient Report</td>
		<td><a href="<?php echo PATIENT_REPORT_URL.$report_name;?>" target="_blank"><?php echo $html->image('admin/pdf_icon.gif');?>&nbsp;View Report</a></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Upload New Report</td>
		<td><?php echo $form->file('Health.patient_report_new',array());?></td>
	</tr>
	<?php } if($report_status == 'not_uploaded') {?>
	<tr>
		<td width="15%" class="boldText">Upload Report</td>
		<td><?php echo $form->file('Health.patient_report',array());?></td>
	</tr>
	<?php }?>
	<tr>
		<td width="15%" class="boldText">Report Published</td>
		<td>
			<input type="radio" name="data[Health][published]" value="1" onclick="published(1);" <?php if($pat_published == 1) {?> checked="checked" <?php }?> />&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="data[Health][published]" value="0" onclick="published(0);" <?php if($pat_published == 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;No
		</td>
	</tr>
	<tr id="PublishedDivNew" style="display:none;">
		<td width="15%" class="boldText">Not Published Reason</td>
		<td>
			<?php echo $form->textarea('Health.published_reason_new', array('class'=>'class-textarea','value'=>$pat_published_reason)); ?>
		</td>
	</tr>
	<tr id="PublishedDiv" style="display:none;">
		<td width="15%" class="boldText">Not Published Reason</td>
		<td>
			<?php echo $form->textarea('Health.published_reason', array('class'=>'class-textarea')); ?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">&nbsp;</td>
		<td>
			<?php echo $form->submit('Update Status', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>
</div>
