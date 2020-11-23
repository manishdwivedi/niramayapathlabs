<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<?php echo $javascript->link('price_slider/slides.min.jquery1') ?>
<!-- 30-10-13 Starts -->
<script type="text/javascript">
$(function() {
	$( ".datepicker1" ).datepicker({
		//maxDate: 0,
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker2" ).datepicker({
		//maxDate: 0,
		dateFormat: 'dd-mm-yy'
	});
	
});

function cancel_request(id,ty)
{
	var cnf = confirm('Please confirm for cancel appointment');
	if(cnf == true)
	{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'pages/cancel_appoint?id='+id+'&ty='+ty,
		success:function(data){
			var split_data = data.split(",");
			if(split_data[1] == 'HV')
			{
				var rep_status = '';
				rep_status +='Cancelled';
				var rep_td = '';
				$('#action_'+split_data[0]).html(rep_td);
				$('#status_'+split_data[0]).html(rep_status);
			}
			if(split_data[1] == 'CL')
			{
				var rep_status = '';
				rep_status +='Cancelled';
				var rep_td = '';
				$('#action_'+split_data[0]).html(rep_td);
				$('#status_'+split_data[0]).html(rep_status);
			}
		},
		beforeSend:function(){
			jQuery('#process_'+id).show();
		},
	});
}
}

function done_request(id,ty)
{
	var cnf = confirm('Please confirm for Appointment Done');
	if(cnf == true)
	{
		jQuery.ajax({
			type:'GET',
			url:siteUrl+'pages/done_appoint?id='+id+'&ty='+ty,
			success:function(data){
				var split_data = data.split(",");
				if(split_data[1] == 'HV')
				{
					var rep_status = '';
					rep_status +='Appointment Done';
					var rep_td = '';
					$('#action_'+split_data[0]).html(rep_td);
					$('#status_'+split_data[0]).html(rep_status);
				}
				if(split_data[1] == 'CL')
				{
					var rep_status = '';
					rep_status +='Appointment Done';
					var rep_td = '';
					$('#action_'+split_data[0]).html(rep_td);
					$('#status_'+split_data[0]).html(rep_status);
				}
			},
			beforeSend:function(){
				jQuery('#process_'+id).show();
			},
		});
	}
}

function show_time_slot(id)
{
	var curr_slot = document.getElementById('CurrDoc').innerHTML;
	if(curr_slot == '')
	{
		document.getElementById('CurrDoc').innerHTML = id;
		$('#TimeSlot_'+id).show();
	}
	if(curr_slot != '')
	{
		$('#TimeSlot_'+curr_slot).hide();
		document.getElementById('CurrDoc').innerHTML = id;
		$('#TimeSlot_'+id).show();
	}
}
</script>
<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>
<div id="CurrDoc" style="display:none;"></div>
<div id="VerifyDoc" style="display:none;"></div>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Doctor Clinic Appointment(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;<?php echo $html->link('Doctor(s) List', '/admin/pages/view_appointment', array('title'=>'Doctor(s) List')); ?>&nbsp;&#187;&nbsp;Doctor Clinic Appointment(s)
	<div>&nbsp;</div>
	<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
		<thead>
		<tr>
			<td colspan="11">
				<?php echo $form->create(null,array('url'=>'/admin/pages/view_doctor_appoint_clinic'));?>
				<?php echo $form->text('FilterAppoint.appointment_id',array('class'=>'input-Search','placeholder'=>'AppointmentID','style'=>'width:100px;'));?>&nbsp;
				<?php echo $form->text('FilterAppoint.doctor_name',array('class'=>'input-Search','placeholder'=>'Doctor Name','style'=>'width:100px;'));?>&nbsp;
				<?php echo $form->text('FilterAppoint.user_name',array('class'=>'input-Search','placeholder'=>'User Name','style'=>'width:100px;'));?>&nbsp;
				<?php echo $form->text('FilterAppoint.contact',array('class'=>'input-Search','placeholder'=>'User Mobile No.','style'=>'width:100px;'));?>&nbsp;
				<?php echo $form->text('FilterAppoint.appoint_date_from',array('class'=>'input-Search datepicker1','placeholder'=>'From Date','style'=>'width:100px;'));?>&nbsp;
				<?php echo $form->text('FilterAppoint.appoint_date_to',array('class'=>'input-Search datepicker1','placeholder'=>'To Date','style'=>'width:100px;'));?>&nbsp;
				<select name="data[FilterAppoint][status]" class="input-Search">
					<option value="">Select Status</option>
					<option value="1">Pending</option>
					<option value="2">Done</option>
					<option value="3">Cancelled</option>
				</select>&nbsp;
				<select name="data[FilterAppoint][appointment_for]" class="input-Search">
					<option value="">Appointment For</option>
					<option value="CL">Clinic</option>
					<option value="HV">Home Visit</option>
				</select>&nbsp;
				<?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?>
				<?php echo $form->end();?>
			</td>
		</tr>
		<tr>
			<td colspan="11" style="font-weight:bold; text-align:right;"><?php echo $this->element('pagination');?></td>
		</tr>
		<tr>
			<th style="text-align:center;"><h4>AppointmentID</h4></th>
			<th style="text-align:center;"><h4>Username</h4></th>
			<th style="text-align:center;"><h4>Mobile No.</h4></th>
			<th style="text-align:center;"><h4>Doctor Name</h4></th>
			<th style="text-align:center;"><h4>Clinic Name</h4></th>
			<th style="text-align:center;"><h4>Day</h4></th>
			<th style="text-align:center;"><h4>Time</h4></th>
			<th style="text-align:center;"><h4>Date</h4></th>
			<th style="text-align:center;"><h4>Type</h4></th>
			<th style="text-align:center;"><h4>Status</h4></th>
			<th style="text-align:center;"><h4>Actions</h4></th>
		</tr>	
	</thead>
	<?php
		if(isset($appointlist) && count($appointlist) > 0){
			$countAppoint = count($appointlist);
			for($ctr=0;$ctr<$countAppoint;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
	?>
	
	<tr>
		<td style="text-align:center; border-left:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; border-right:1px solid #D8D8D8;"><?php echo $appointlist[$ctr]['BookAppointment']['appointment_id'];?></td>
		<td style="text-align:center; border-bottom:1px solid #D8D8D8; border-right:1px solid #D8D8D8;"><?php echo $appointlist[$ctr]['BookAppointment']['user_name'];?></td>
		<td style="text-align:center; border-bottom:1px solid #D8D8D8; border-right:1px solid #D8D8D8;"><?php echo $appointlist[$ctr]['BookAppointment']['user_contact'];?></td>
		<td style="text-align:center; border-bottom:1px solid #D8D8D8; border-right:1px solid #D8D8D8;"><?php echo $appointlist[$ctr]['BookAppointment']['doctor_name'];?></td>
		<td style="text-align:center; border-bottom:1px solid #D8D8D8; border-right:1px solid #D8D8D8;">
			<?php if($appointlist[$ctr]['BookAppointment']['appointment_for'] == 'CL') {?>
			<?php echo $appointlist[$ctr]['BookAppointment']['clinic_name'];?>
			<?php } else {?>
			<?php echo '-----';?>
			<?php }?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #D8D8D8; border-right:1px solid #D8D8D8;">
			<?php if($appointlist[$ctr]['BookAppointment']['appointment_for'] == 'CL') {?>
			<?php echo $appointlist[$ctr]['BookAppointment']['day'];?>
			<?php } else {?>
			<?php echo '-----';?>
			<?php }?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #D8D8D8; border-right:1px solid #D8D8D8;">
			<?php echo $appointlist[$ctr]['BookAppointment']['time_slot'];?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #D8D8D8; border-right:1px solid #D8D8D8;"><?php echo date('d-M-Y',strtotime($appointlist[$ctr]['BookAppointment']['appoint_date']));?></td>
		<td style="text-align:center; border-bottom:1px solid #D8D8D8; border-right:1px solid #D8D8D8;"><?php echo $appointlist[$ctr]['BookAppointment']['type'];?></td>
		<td style="text-align:center; border-bottom:1px solid #D8D8D8; border-right:1px solid #D8D8D8;" id="status_<?php echo $appointlist[$ctr]['BookAppointment']['id'];?>"><?php echo $appointlist[$ctr]['BookAppointment']['curr_status'];?></td>
		<td style="text-align:center; border-bottom:1px solid #D8D8D8; border-right:1px solid #D8D8D8;" id="action_<?php echo $appointlist[$ctr]['BookAppointment']['id'];?>">
			<?php if($appointlist[$ctr]['BookAppointment']['curr_status'] != 'Cancelled') {?>
				<?php if($appointlist[$ctr]['BookAppointment']['appointment_for'] == 'CL' && $appointlist[$ctr]['BookAppointment']['status'] == 1) {?>
				<a href="javascript:void(0);" onclick="show_time_slot(<?php echo $appointlist[$ctr]['BookAppointment']['id'];?>);">Change Time</a><br /><br />
				<a href="javascript:void(0);" onclick="done_request('<?php echo $appointlist[$ctr]['BookAppointment']['id'];?>','CL');">Appointment Done</a><br /><br />
				<a href="javascript:void(0);" onclick="cancel_request('<?php echo $appointlist[$ctr]['BookAppointment']['id'];?>','CL');">Cancel Appointment</a><br />
				<?php }?>
				<?php if($appointlist[$ctr]['BookAppointment']['appointment_for'] == 'HV') {?>
				<a href="javascript:void(0);" onclick="done_request('<?php echo $appointlist[$ctr]['BookAppointment']['id'];?>','HV');">Appointment Done</a><br /><br />
				<a href="javascript:void(0);" onclick="cancel_request('<?php echo $appointlist[$ctr]['BookAppointment']['id'];?>','HV');">Cancel Appointment</a><br />
				<?php }?>
				<?php echo $html->image('p_rocess.gif',array('width'=>60,'id'=>'process_'.$appointlist[$ctr]['BookAppointment']['id'],'style'=>'display:none;'));?>
			<?php }?>
		</td>
	</tr>
	<?php if($appointlist[$ctr]['BookAppointment']['appointment_for'] == 'CL' && $appointlist[$ctr]['BookAppointment']['status'] == 1) {?>
	<tr id="TimeSlot_<?php echo $appointlist[$ctr]['BookAppointment']['id'];?>" style="display:none;">
		<td colspan="11" style="border-bottom:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-left:1px solid #D8D8D8;">
			<script>
			var ff = jQuery.noConflict();
			ff(function(){
			ff('#slides_<?php echo $appointlist[$ctr]['BookAppointment']['id'];?>').slides({
				preload: true,
				generateNextPrev: true
			});
			});
			</script>
			<div class="slideboxDiv1">
				<div class="nextPrevBlog">You can book appointments for next 14 days</div>
          		<div id="slides_<?php echo $appointlist[$ctr]['BookAppointment']['id'];?>" style="clear:both; position:relative;">
					<div class="slides_container1">
						<div class="slideDiv">
							<div class="timeHeading1">
								<ul>
									<li><span><?php echo date('D');?></span><p><?php echo date('d M');?></p></li>
									<li><span><?php echo date('D',strtotime(" +1 days "));?></span><p><?php echo date('d M',strtotime(" +1 days "));?></p></li>
									<li><span><?php echo date('D',strtotime(" +2 days "));?></span><p><?php echo date('d M',strtotime(" +2 days "));?></p></li>
									<li><span><?php echo date('D',strtotime(" +3 days "));?></span><p><?php echo date('d M',strtotime(" +3 days "));?></p></li>
									<li><span><?php echo date('D',strtotime(" +4 days "));?></span><p><?php echo date('d M',strtotime(" +4 days "));?></p></li>
									<li><span><?php echo date('D',strtotime(" +5 days "));?></span><p><?php echo date('d M',strtotime(" +5 days "));?></p></li>
									<li><span><?php echo date('D',strtotime(" +6 days "));?></span><p><?php echo date('d M',strtotime(" +6 days "));?></p></li>
								</ul>
							</div>
							<div class="timeTableDiv1">
							<table width="100%" border="0" cellspacing="1" cellpadding="0">
								<tr>
									<td height="118" width="18%"><h3>Morning</h3></td>
									<td width="12%">
										<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td width="12%">
										<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										
									</td>
									<td width="12%">
										<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td width="12%">
										<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td width="12%">
										<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td width="12%">
										<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td width="12%">
										<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>	
								</tr>
								
								<tr>
									<td height="170" width="18%"><h3>Afternoon</h3></td>
									<td>
										<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>

										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
								</tr>
								
								<tr>
									<td height="135" width="18%"><h3>Evening</h3></td>
									<td>
										<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
								</tr>
								
								<tr>
									<td height="100" width="18%"><h3>Night</h3></td>
									<td>
										<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
							
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
								</tr>
							</table>
							</div>	
						</div>
		
						<div class="slideDiv">
							<div class="timeHeading1">
								<ul>
									<li><span><?php echo date('D',strtotime(" +7 days "));?></span><p><?php echo date('d M',strtotime(" +7 days "));?></p></li>
									<li><span><?php echo date('D',strtotime(" +8 days "));?></span><p><?php echo date('d M',strtotime(" +8 days "));?></p></li>
									<li><span><?php echo date('D',strtotime(" +9 days "));?></span><p><?php echo date('d M',strtotime(" +9 days "));?></p></li>
									<li><span><?php echo date('D',strtotime(" +10 days "));?></span><p><?php echo date('d M',strtotime(" +10 days "));?></p></li>
									<li><span><?php echo date('D',strtotime(" +11 days "));?></span><p><?php echo date('d M',strtotime(" +11 days "));?></p></li>
									<li><span><?php echo date('D',strtotime(" +12 days "));?></span><p><?php echo date('d M',strtotime(" +12 days "));?></p></li>
									<li><span><?php echo date('D',strtotime(" +13 days "));?></span><p><?php echo date('d M',strtotime(" +13 days "));?></p></li>
								</ul>
							</div>
							<div class="timeTableDiv1">
							<table width="100%" border="0" cellspacing="1" cellpadding="0">
								<tr>
									<td height="118" width="18%"><h3>Morning</h3></td>
									<td width="12%">
										<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td width="12%">
										<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										
									</td>
									<td width="12%">
										<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td width="12%">
										<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td width="12%">
										<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td width="12%">
										<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td width="12%">
										<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>	
								</tr>
								
								<tr>
									<td height="170" width="18%"><h3>Afternoon</h3></td>
									<td>
										<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>

												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
								</tr>
								
								<tr>
									<td height="135" width="18%"><h3>Evening</h3></td>
									<td>
										<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
								</tr>
								
								<tr>
									<td height="100" width="18%"><h3>Night</h3></td>
									<td>
										<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
							
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
									<td>
										<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
										<?php if($day == 1) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 2) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 3) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 4) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 5) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 6) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
										<?php if($day == 7) {foreach($appointlist[$ctr]['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
											<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
												<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
											<?php }else {?>
												<div class="av">
													<a href="<?php echo SITE_URL;?>admin/pages/change_user_time/<?php echo base64_encode($appointlist[$ctr]['BookAppointment']['id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>" style="color:#E99A09; text-decoration:none;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
												</div>
											<?php }}?>
										<?php }}?>
									</td>
								</tr>
							</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</td>
	</tr>
	<?php }}?>
	
	<tr>
		<td colspan="11" style="font-weight:bold; text-align:right;">
		<?php
			echo $this->element('pagination');
		?>
		</td>
	</tr>
	<?php
		} else {
	?>
	<tr>
		<td colspan="10" class="flash_failure" style=" float:none;">No records found.</td>
	</tr>
	<?php
		}
	?>
	
</table>

</div>
