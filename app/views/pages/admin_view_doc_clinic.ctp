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

function show_time(id)
{
	var cur_slot = document.getElementById('CurrDoc').innerHTML;
	var cur_slot_black = document.getElementById('CurrDocBlack').innerHTML;
	if(cur_slot == '')
	{
		if(cur_slot_black != '')
		{
			document.getElementById('CurrDocBlack').innerHTML = '';
			$('#BlackoutTimeSlot_'+id).hide();
		}
		document.getElementById('CurrDoc').innerHTML = id;
		$('#TimeSlot_'+id).show();
	}
	else
	{
		if(cur_slot_black != '')
		{
			document.getElementById('CurrDocBlack').innerHTML = '';
			$('#BlackoutTimeSlot_'+id).hide();
		}
		$('#TimeSlot_'+cur_slot).hide();
		document.getElementById('CurrDoc').innerHTML = id;
		$('#TimeSlot_'+id).show();
	}
}

function show_blackout(id)
{
	var cur_slot = document.getElementById('CurrDoc').innerHTML;
	var cur_slot_black = document.getElementById('CurrDocBlack').innerHTML;
	if(cur_slot_black == '')
	{
		if(cur_slot != '')
		{
			document.getElementById('CurrDoc').innerHTML = '';
			$('#TimeSlot_'+id).hide();
		}
		document.getElementById('CurrDocBlack').innerHTML = id;
		$('#BlackoutTimeSlot_'+id).show();
	}
	else
	{
		if(cur_slot != '')
		{
			document.getElementById('CurrDoc').innerHTML = '';
			$('#TimeSlot_'+id).hide();
		}
		$('#BlackoutTimeSlot_'+cur_slot_black).hide();
		document.getElementById('CurrDocBlack').innerHTML = id;
		$('#BlackoutTimeSlot_'+id).show();
	}
}

function submit_form(id)
{
	document.forms["form"+id].submit();
}

function submit_form_unblack()
{
	document.forms["unblackform"+id].submit();
}
</script>
<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>
<div id="CurrDoc" style="display:none;"></div>
<div id="CurrDocBlack" style="display:none;"></div>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>View Doctor Clinic(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;View Doctor Clinic(s)
	<div>&nbsp;</div>
	
	
	
	
	<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
		<thead>
		
		<tr>
			<th style="text-align:center;"><h4>S.No.</h4></th>
			<th style="text-align:center;"><h4>Clinic Name</h4></th>
			<th style="text-align:center;"><h4>Clinic Address</h4></th>
			<th style="text-align:center;"><h4>Availability</h4></th>
			<th style="text-align:center;"><h4>Timing</h4></th>
			<th style="text-align:center;"><h4>Action</h4></th>
		</tr>	
	</thead>
	<?php
		if(isset($get_clinic) && count($get_clinic) > 0){
			$countDoctorClinic = count($get_clinic);
			for($ctr=0;$ctr<$countDoctorClinic;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
	?>
	
	<tr>
		<td style="text-align:center; border-bottom:1px solid #999999; border-right:1px solid #999999; border-left:1px solid #999999;"><?php echo ($ctr+1);?></td>
		<td style="border-bottom:1px solid #999999; border-right:1px solid #999999;"><?php echo $get_clinic[$ctr]['DoctorClinic']['clinic_name'];?></td>
		<?php $expl_add = explode('*',$get_clinic[$ctr]['DoctorClinic']['clinic_address']);?>
		<td style="border-bottom:1px solid #999999; border-right:1px solid #999999;">
			<?php echo $expl_add[0]; if(!empty($expl_add[1])) {?><br /><?php echo $expl_add[1];}?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #999999; border-right:1px solid #999999;">
			<?php if(!empty($get_clinic[$ctr]['DoctorClinic']['day1'])){?>
			<?php echo "<span style='font-weight:bold;'>MO |</span>";?>
			<?php }?>
			<?php if(!empty($get_clinic[$ctr]['DoctorClinic']['day2'])){?>
			<?php echo "<span style='font-weight:bold;'>TU |</span>";?>
			<?php }?>
			<?php if(!empty($get_clinic[$ctr]['DoctorClinic']['day3'])){?>
			<?php echo "<span style='font-weight:bold;'>WE |</span>";?>
			<?php }?>
			<?php if(!empty($get_clinic[$ctr]['DoctorClinic']['day4'])){?>
			<?php echo "<span style='font-weight:bold;'>TH |</span>";?>
			<?php }?>
			<?php if(!empty($get_clinic[$ctr]['DoctorClinic']['day5'])){?>
			<?php echo "<span style='font-weight:bold;'>FR |</span>";?>
			<?php }?>
			<?php if(!empty($get_clinic[$ctr]['DoctorClinic']['day6'])){?>
			<?php echo "<span style='font-weight:bold;'>SA |</span>";?>
			<?php }?>
			<?php if(!empty($get_clinic[$ctr]['DoctorClinic']['day7'])){?>
			<?php echo "<span style='font-weight:bold;'>SU</span>";?>
			<?php }?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #999999; border-right:1px solid #999999;">
			<?php echo $get_clinic[$ctr]['DoctorClinic']['clinic_s_time'].' - '.$get_clinic[$ctr]['DoctorClinic']['clinic_e_time'];?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #999999; border-right:1px solid #999999;">
			<a href="javascript:void(0);" onClick="show_time(<?php echo $get_clinic[$ctr]['DoctorClinic']['id'];?>);">Blackout Time Slot(s)</a>
			<?php //if($get_clinic[$ctr]['DoctorClinic']['blackout'] == 'Yes') {?>
			<!--<br><br>
			<a href="javascript:void(0);" onClick="show_blackout(<?php //echo $get_clinic[$ctr]['DoctorClinic']['id'];?>);">Reset Blackout Time Slot(s)</a>-->
			<?php //}?>
		</td>
	</tr>
	<tr id="TimeSlot_<?php echo $get_clinic[$ctr]['DoctorClinic']['id'];?>" style="display:none;">
		<td style="border-bottom:1px solid #999999; border-right:1px solid #999999; border-left:1px solid #999999;" colspan="6">
			<?php echo $form->create(null,array('url'=>'/admin/pages/blackout_time/'.$get_clinic[$ctr]['DoctorClinic']['id'],'id'=>'form'.$get_clinic[$ctr]['DoctorClinic']['id'],'name'=>'form'.$get_clinic[$ctr]['DoctorClinic']['id']));?>
			<?php echo $form->hidden('CheckDoctor.doctor_id_'.$get_clinic[$ctr]['DoctorClinic']['id'],array('value'=>$get_clinic[$ctr]['DoctorClinic']['doctor_id']));?>
			<?php echo $form->hidden('CheckDoctor.clinic_id_'.$get_clinic[$ctr]['DoctorClinic']['id'],array('value'=>$get_clinic[$ctr]['DoctorClinic']['id']));?>
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
					<td width="11%">
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td width="11%">
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						
					</td>
					<td width="11%">
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td width="11%">
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td width="11%">
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td width="11%">
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td width="11%">
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>	
				</tr>
				
				<tr>
					<td height="170" width="18%"><h3>Afternoon</h3></td>
					<td>
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
				</tr>
				
				<tr>
					<td height="135" width="18%"><h3>Evening</h3></td>
					<td>
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
				</tr>
				
				<tr>
					<td height="100" width="18%"><h3>Night</h3></td>
					<td>
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d');?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
			
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +1 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +2 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +3 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +4 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +5 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {?>
								<div class="av" style="background:none;"><input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="<?php echo date('Y-m-d',strtotime(" +6 days "));?>" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
				</tr>
			</table>
			</div>	
			<?php echo $form->submit('Submit', array('div'=>false, 'class' => 'btn','style'=>'margin:10px 0 0 0;','onclick'=>'submit_form('.$get_clinic[$ctr]['DoctorClinic']['id'].');')); ?>
			<?php echo $form->end();?>			
		</td>
	</tr>
	<tr id="BlackoutTimeSlot_<?php echo $get_clinic[$ctr]['DoctorClinic']['id'];?>" style="display:none;">
		<td style="border-bottom:1px solid #999999; border-right:1px solid #999999; border-left:1px solid #999999;" colspan="6">
			<?php echo $form->create(null,array('url'=>'/admin/pages/unblackout_time/'.$get_clinic[$ctr]['DoctorClinic']['id'],'id'=>'unblackform'.$get_clinic[$ctr]['DoctorClinic']['id'],'name'=>'unblackform'.$get_clinic[$ctr]['DoctorClinic']['id']));?>
			<?php echo $form->hidden('CheckDoctorId.doctor_id_'.$get_clinic[$ctr]['DoctorClinic']['id'],array('value'=>$get_clinic[$ctr]['DoctorClinic']['doctor_id']));?>
			<?php echo $form->hidden('CheckDoctorId.clinic_id_'.$get_clinic[$ctr]['DoctorClinic']['id'],array('value'=>$get_clinic[$ctr]['DoctorClinic']['id']));?>
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
					<td width="11%">
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td width="11%">
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						
					</td>
					<td width="11%">
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td width="11%">
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td width="11%">
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td width="11%">
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td width="11%">
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>	
				</tr>
				
				<tr>
					<td height="170" width="18%"><h3>Afternoon</h3></td>
					<td>
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
				</tr>
				
				<tr>
					<td height="135" width="18%"><h3>Evening</h3></td>
					<td>
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
				</tr>
				
				<tr>
					<td height="100" width="18%"><h3>Night</h3></td>
					<td>
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
			
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
					<td>
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 2) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 3) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 4) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 5) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 6) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
						<?php if($day == 7) {foreach($get_clinic[$ctr]['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
							<div class="noav" style="background:none;">
								<input type="checkbox" name="data[ClinicTime][<?php echo $val_clinic_time['ClinicTime']['id'];?>]" value="1" />&nbsp;<?php echo $val_clinic_time['ClinicTime']['time_slot'];?>
							</div>
							<?php } else {?>
							<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }?>
						<?php }}?>
					</td>
				</tr>
			</table>
			</div>	
			<?php echo $form->submit('Submit', array('div'=>false, 'class' => 'btn','style'=>'margin:10px 0 0 0;','onclick'=>'submit_form_unblack('.$get_clinic[$ctr]['DoctorClinic']['id'].');')); ?>
			<?php echo $form->end();?>			
		</td>
	</tr>
	<?php }?>
	
	
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