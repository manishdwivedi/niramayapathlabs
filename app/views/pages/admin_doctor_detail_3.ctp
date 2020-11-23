<script type="text/javascript">
function show_time(id)
{
	var curr_slot = document.getElementById('CurrSlot').innerHTML;
	if(curr_slot == '')
	{
		document.getElementById('CurrSlot').innerHTML = id;
		$('#TimeSlot'+id).show();
	}
	if(curr_slot != '')
	{
		$('#TimeSlot'+curr_slot).hide();
		document.getElementById('CurrSlot').innerHTML = id;
		$('#TimeSlot'+id).show();
	}
}

function show_tab(val)
{
	if(val == 1)
	{
		$('#Personal1').show(); $('#Personal2').show(); $('#Personal3').show(); $('#Personal4').show(); $('#Personal5').show(); $('#Personal6').show(); $('#Personal7').show(); $('#Personal8').show(); $('#Personal9').show(); $('#Personal10').show(); $('#Personal11').show(); $('#Personal12').show(); $('#Personal13').show(); $('#Personal14').show(); $('#Personal15').show(); $('#Personal16').show();
		
		$('#Prof1').hide(); $('#Prof2').hide(); $('#Prof3').hide(); $('#Prof4').hide(); $('#Prof5').hide(); $('#Prof6').hide();
		
		$('#ClinicInfo1').hide(); $('#ClinicInfo100').hide(); $('#ClinicInfo101').hide(); $('#ClinicInfo102').hide(); $('#ClinicInfo103').hide(); $('#ClinicInfo104').hide(); $('#ClinicInfo200').hide(); $('#ClinicInfo201').hide(); $('#ClinicInfo202').hide(); $('#ClinicInfo203').hide(); $('#ClinicInfo204').hide(); $('#ClinicInfo3').hide();
	}
	if(val == 2)
	{
		$('#Prof1').show(); $('#Prof2').show(); $('#Prof3').show(); $('#Prof4').show(); $('#Prof5').show(); $('#Prof6').show();
		
		$('#Personal1').hide(); $('#Personal2').hide(); $('#Personal3').hide(); $('#Personal4').hide(); $('#Personal5').hide(); $('#Personal6').hide(); $('#Personal7').hide(); $('#Personal8').hide(); $('#Personal9').hide(); $('#Personal10').hide(); $('#Personal11').hide(); $('#Personal12').hide(); $('#Personal13').hide(); $('#Personal14').hide(); $('#Personal15').hide(); $('#Personal16').hide();
		
		$('#ClinicInfo1').hide(); $('#ClinicInfo100').hide(); $('#ClinicInfo101').hide(); $('#ClinicInfo102').hide(); $('#ClinicInfo103').hide(); $('#ClinicInfo104').hide(); $('#ClinicInfo200').hide(); $('#ClinicInfo201').hide(); $('#ClinicInfo202').hide(); $('#ClinicInfo203').hide(); $('#ClinicInfo204').hide(); $('#ClinicInfo3').hide();
	}
	if(val == 3)
	{
		$('#ClinicInfo1').show(); $('#ClinicInfo100').show(); $('#ClinicInfo101').show(); $('#ClinicInfo102').show(); $('#ClinicInfo103').show(); $('#ClinicInfo104').show(); $('#ClinicInfo200').show(); $('#ClinicInfo201').show(); $('#ClinicInfo202').show(); $('#ClinicInfo203').show(); $('#ClinicInfo204').show(); $('#ClinicInfo3').show();
		
		$('#Personal1').hide(); $('#Personal2').hide(); $('#Personal3').hide(); $('#Personal4').hide(); $('#Personal5').hide(); $('#Personal6').hide(); $('#Personal7').hide(); $('#Personal8').hide(); $('#Personal9').hide(); $('#Personal10').hide(); $('#Personal11').hide(); $('#Personal12').hide(); $('#Personal13').hide(); $('#Personal14').hide(); $('#Personal15').hide(); $('#Personal16').hide();
		
		$('#Prof1').hide(); $('#Prof2').hide(); $('#Prof3').hide(); $('#Prof4').hide(); $('#Prof5').hide(); $('#Prof6').hide();
	}
}

</script>
<div id="CurrSlot" style="display:none;"></div>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>View Featured Doctor Details</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; <?php echo $html->link('Manage Doctors(s)', '/admin/pages/view_featured_doctor', array('title'=>'View Featured Doctor')); ?> &#187; View Featured Doctor Details
	
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table border="0" width="100%">
							<tr>
								<td colspan="2" style="padding:10px; font-weight:bold; font-size:15px;"><?php echo $get_doctor_detail['Doctor']['title'].' '.$get_doctor_detail['Doctor']['first_name'].' '.$get_doctor_detail['Doctor']['last_name'].' Details';?></td>
							</tr>
							<tr>
								<td colspan="2">
									<table border="0" width="100%" cellpadding="0" cellpadding="2">
										<tr height="30">
											<td style="background:#D8D8D8; font-weight:bold; text-align:center;"><a href="javascript:void(0);" style="text-decoration:none;" onclick="show_tab(1);">Personal Details</a></td>
											<td style="background:#D8D8D8; font-weight:bold; text-align:center;"><a href="javascript:void(0);" style="text-decoration:none;" onclick="show_tab(2);">Proffessional Details</a></td>
											<td style="background:#D8D8D8; font-weight:bold; text-align:center;"><a href="javascript:void(0);" style="text-decoration:none;" onclick="show_tab(3);">Clinic Information(s)</a></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr id="Personal1">
								<td colspan="2" style="font-weight:bold; text-decoration:underline;">Personal Details</td>
							</tr>
							<tr id="Personal2">
								<td width="26%" class="boldText">Title</td>
								<td><?php echo $get_doctor_detail['Doctor']['title'].'.';?></td>
							</tr>
							<tr id="Personal3">
								<td width="26%" class="boldText">First Name</td>
								<td><?php echo $get_doctor_detail['Doctor']['first_name'];?></td>
							</tr>
							<tr id="Personal4">
								<td width="26%" class="boldText">Last Name</td>
								<td><?php echo $get_doctor_detail['Doctor']['last_name'];?></td>
							</tr>
							<tr id="Personal5">
								<td width="26%" class="boldText">Gender</td>
								<td><?php echo $get_doctor_detail['Doctor']['gender'];?></td>
							</tr>
							<tr id="Personal6">
								<td width="26%" class="boldText">Email</td>
								<td><?php echo $get_doctor_detail['Doctor']['email'];?></td>
							</tr>
							<tr id="Personal7">
								<td width="26%" class="boldText">Contact</td>
								<td><?php echo $get_doctor_detail['Doctor']['contact'];?></td>
							</tr>
							<tr id="Personal8">
								<td width="26%" class="boldText">Consultancy Fee(clinic)</td>
								<td><?php echo 'INR '.$get_doctor_detail['Doctor']['cons_fee'];?></td>
							</tr>
							<?php if($get_doctor_detail['Doctor']['home_fee'] != 0) {?>
							<tr id="Personal9">
								<td width="26%" class="boldText">Consultancy Fee(home visit)</td>
								<td><?php echo 'INR '.$get_doctor_detail['Doctor']['home_fee'];?></td>
							</tr>
							<?php }?>
							<tr id="Personal10">
								<td width="26%" class="boldText">DOB</td>
								<td><?php echo $get_doctor_detail['Doctor']['dob'];?></td>
							</tr>
							<tr id="Personal11">
								<td width="26%" class="boldText">Address</td>
								<td><?php echo $get_doctor_detail['Doctor']['address1'];?></td>
							</tr>
							<?php if(!empty($get_doctor_detail['Doctor']['address2'])){?>
							<tr id="Personal12">
								<td width="26%" class="boldText">&nbsp;</td>
								<td><?php echo $get_doctor_detail['Doctor']['address2'];?></td>
							</tr>
							<?php }?>
							<tr id="Personal13">
								<td width="26%" class="boldText">Locality</td>
								<td><?php echo $get_doctor_detail['Doctor']['locality'];?></td>
							</tr>
							<tr id="Personal14">
								<td width="26%" class="boldText">State</td>
								<td><?php echo $get_doctor_detail['Doctor']['state'];?></td>
							</tr>
							<tr id="Personal15">
								<td width="26%" class="boldText">City</td>
								<td><?php echo $get_doctor_detail['Doctor']['city'];?></td>
							</tr>
							<tr id="Personal16">
								<td width="26%" class="boldText">Zipcode</td>
								<td><?php echo $get_doctor_detail['Doctor']['zipcode'];?></td>
							</tr>
							
							<tr id="Prof1" style="display:none;">
								<td colspan="2" style="font-weight:bold; text-decoration:underline;">Proffessional Details</td>
							</tr>
							<tr id="Prof2" style="display:none;">
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr id="Prof3" style="display:none;">
								<td style="vertical-align:top;">
									<table border="0" width="100%" cellpadding="0" cellspacing="0">
										<tr>
											<td width="15%" class="boldText" style="text-decoration:underline;">Service(s) :</td>
										</tr>
										<?php if(!empty($get_doctor_detail['Doctor']['service1']) || !empty($get_doctor_detail['Doctor']['service2']) || !empty($get_doctor_detail['Doctor']['service3']) || !empty($get_doctor_detail['Doctor']['service4']) || !empty($get_doctor_detail['Doctor']['service5'])){?>
											<?php if(!empty($get_doctor_detail['Doctor']['service1'])) {?>
											<tr>
												<td><strong>1-</strong> <?php echo $get_doctor_detail['Doctor']['service1'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['service2'])) {?>
											<tr>
												<td><strong>2-</strong> <?php echo $get_doctor_detail['Doctor']['service2'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['service3'])) {?>
											<tr>
												<td><strong>3-</strong> <?php echo $get_doctor_detail['Doctor']['service3'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['service4'])) {?>
											<tr>
												<td><strong>4-</strong> <?php echo $get_doctor_detail['Doctor']['service4'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['service5'])) {?>
											<tr>
												<td><strong>5-</strong> <?php echo $get_doctor_detail['Doctor']['service5'];?></td>
											</tr>
											<?php }?>
										<?php } else {?>
										<tr>
											<td>No Services Found</td>
										</tr>
										<?php }?>
									</table>
								</td>
								<td style="padding:0 0 0 300px; vertical-align:top;">
									<table border="0" width="100%" cellpadding="0" cellspacing="0">
										<tr>
											<td width="15%" class="boldText" style="text-decoration:underline;">Specialization(s) :</td>
										</tr>
										<?php if(!empty($get_doctor_detail['Doctor']['special1']) || !empty($get_doctor_detail['Doctor']['special2']) || !empty($get_doctor_detail['Doctor']['special3']) || !empty($get_doctor_detail['Doctor']['special4']) || !empty($get_doctor_detail['Doctor']['special5'])) {?>
											<?php if(!empty($get_doctor_detail['Doctor']['special1'])) {?>
											<tr>
												<td><strong>1-</strong> <?php echo $get_doctor_detail['Doctor']['special1'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['special2'])) {?>
											<tr>
												<td><strong>2-</strong> <?php echo $get_doctor_detail['Doctor']['special2'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['special3'])) {?>
											<tr>
												<td><strong>3-</strong> <?php echo $get_doctor_detail['Doctor']['special3'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['special4'])) {?>
											<tr>
												<td><strong>4-</strong> <?php echo $get_doctor_detail['Doctor']['special4'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['special5'])) {?>
											<tr>
												<td><strong>5-</strong> <?php echo $get_doctor_detail['Doctor']['special5'];?></td>
											</tr>
											<?php }?>
										<?php } else {?>
										<tr>
												<td>No Specializations Found</td>
											</tr>
										<?php }?>
									</table>
								</td>
							</tr>
							<tr id="Prof4" style="display:none;">
								<td style="vertical-align:top;">
									<table border="0" width="100%" cellpadding="0" cellspacing="0">
										<tr>
											<td width="15%" class="boldText" style="text-decoration:underline;">Education(s) :</td>
										</tr>
										<?php if(!empty($get_doctor_detail['Doctor']['education1']) || !empty($get_doctor_detail['Doctor']['education2']) || !empty($get_doctor_detail['Doctor']['education3']) || !empty($get_doctor_detail['Doctor']['education4']) || !empty($get_doctor_detail['Doctor']['education5'])){?>
											<?php if(!empty($get_doctor_detail['Doctor']['education1'])) {?>
											<tr>
												<td><strong>1-</strong> <?php echo $get_doctor_detail['Doctor']['education1'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['education2'])) {?>
											<tr>
												<td><strong>2-</strong> <?php echo $get_doctor_detail['Doctor']['education2'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['education3'])) {?>
											<tr>
												<td><strong>3-</strong> <?php echo $get_doctor_detail['Doctor']['education3'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['education4'])) {?>
											<tr>
												<td><strong>4-</strong> <?php echo $get_doctor_detail['Doctor']['education4'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['education5'])) {?>
											<tr>
												<td><strong>5-</strong> <?php echo $get_doctor_detail['Doctor']['education5'];?></td>
											</tr>
											<?php }?>
										<?php } else {?>
										<tr>
											<td>No Education Found</td>
										</tr>
										<?php }?>
									</table>
								</td>
								<td style="padding:0 0 0 300px; vertical-align:top;">
									<table border="0" width="100%" cellpadding="0" cellspacing="0">
										<tr>
											<td width="15%" class="boldText" style="text-decoration:underline;">Experience(s) :</td>
										</tr>
										<?php if(!empty($get_doctor_detail['Doctor']['experience1']) || !empty($get_doctor_detail['Doctor']['experience2']) || !empty($get_doctor_detail['Doctor']['experience3']) || !empty($get_doctor_detail['Doctor']['experience4']) || !empty($get_doctor_detail['Doctor']['experience5'])) {?>
											<?php if(!empty($get_doctor_detail['Doctor']['experience1'])) {?>
											<tr>
												<td><strong>1-</strong> <?php echo $get_doctor_detail['Doctor']['experience1'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['experience2'])) {?>
											<tr>
												<td><strong>2-</strong> <?php echo $get_doctor_detail['Doctor']['experience2'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['experience3'])) {?>
											<tr>
												<td><strong>3-</strong> <?php echo $get_doctor_detail['Doctor']['experience3'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['experience4'])) {?>
											<tr>
												<td><strong>4-</strong> <?php echo $get_doctor_detail['Doctor']['experience4'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['experience5'])) {?>
											<tr>
												<td><strong>5-</strong> <?php echo $get_doctor_detail['Doctor']['experience5'];?></td>
											</tr>
											<?php }?>
										<?php } else {?>
										<tr>
												<td>No Experience Found</td>
											</tr>
										<?php }?>
									</table>
								</td>
							</tr>
							<tr id="Prof5" style="display:none;">
								<td style="vertical-align:top;">
									<table border="0" width="100%" cellpadding="0" cellspacing="0">
										<tr>
											<td width="15%" class="boldText" style="text-decoration:underline;">Award(s) & Recognition(s) :</td>
										</tr>
										<?php if(!empty($get_doctor_detail['Doctor']['award1']) || !empty($get_doctor_detail['Doctor']['award2']) || !empty($get_doctor_detail['Doctor']['award3']) || !empty($get_doctor_detail['Doctor']['award4']) || !empty($get_doctor_detail['Doctor']['award5'])){?>
											<?php if(!empty($get_doctor_detail['Doctor']['award1'])) {?>
											<tr>
												<td><strong>1-</strong> <?php echo $get_doctor_detail['Doctor']['award1'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['award2'])) {?>
											<tr>
												<td><strong>2-</strong> <?php echo $get_doctor_detail['Doctor']['award2'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['award3'])) {?>
											<tr>
												<td><strong>3-</strong> <?php echo $get_doctor_detail['Doctor']['award3'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['award4'])) {?>
											<tr>
												<td><strong>4-</strong> <?php echo $get_doctor_detail['Doctor']['award4'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['award5'])) {?>
											<tr>
												<td><strong>5-</strong> <?php echo $get_doctor_detail['Doctor']['award5'];?></td>
											</tr>
											<?php }?>
										<?php } else {?>
										<tr>
											<td>No Awards & Recognitions Found</td>
										</tr>
										<?php }?>
									</table>
								</td>
								<td style="padding:0 0 0 300px; vertical-align:top;">
									<table border="0" width="100%" cellpadding="0" cellspacing="0">
										<tr>
											<td width="15%" class="boldText" style="text-decoration:underline;">Membership(s) :</td>
										</tr>
										<?php if(!empty($get_doctor_detail['Doctor']['member1']) || !empty($get_doctor_detail['Doctor']['member2']) || !empty($get_doctor_detail['Doctor']['member3']) || !empty($get_doctor_detail['Doctor']['member4']) || !empty($get_doctor_detail['Doctor']['member5'])) {?>
											<?php if(!empty($get_doctor_detail['Doctor']['member1'])) {?>
											<tr>
												<td><strong>1-</strong> <?php echo $get_doctor_detail['Doctor']['member1'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['member2'])) {?>
											<tr>
												<td><strong>2-</strong> <?php echo $get_doctor_detail['Doctor']['member2'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['member3'])) {?>
											<tr>
												<td><strong>3-</strong> <?php echo $get_doctor_detail['Doctor']['member3'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['member4'])) {?>
											<tr>
												<td><strong>4-</strong> <?php echo $get_doctor_detail['Doctor']['member4'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['member5'])) {?>
											<tr>
												<td><strong>5-</strong> <?php echo $get_doctor_detail['Doctor']['member5'];?></td>
											</tr>
											<?php }?>
										<?php } else {?>
										<tr>
												<td>No Memberships Found</td>
											</tr>
										<?php }?>
									</table>
								</td>
							</tr>
							<tr id="Prof6" style="display:none;">
								<td style="vertical-align:top;">
									<table border="0" width="100%" cellpadding="0" cellspacing="0">
										<tr>
											<td width="15%" class="boldText" style="text-decoration:underline;">Registration(s) :</td>
										</tr>
										<?php if(!empty($get_doctor_detail['Doctor']['registration1']) || !empty($get_doctor_detail['Doctor']['registration2']) || !empty($get_doctor_detail['Doctor']['registration3']) || !empty($get_doctor_detail['Doctor']['registration4']) || !empty($get_doctor_detail['Doctor']['registration5'])){?>
											<?php if(!empty($get_doctor_detail['Doctor']['registration1'])) {?>
											<tr>
												<td><strong>1-</strong> <?php echo $get_doctor_detail['Doctor']['registration1'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['registration2'])) {?>
											<tr>
												<td><strong>2-</strong> <?php echo $get_doctor_detail['Doctor']['registration2'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['registration3'])) {?>
											<tr>
												<td><strong>3-</strong> <?php echo $get_doctor_detail['Doctor']['registration3'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['registration4'])) {?>
											<tr>
												<td><strong>4-</strong> <?php echo $get_doctor_detail['Doctor']['registration4'];?></td>
											</tr>
											<?php }?>
											<?php if(!empty($get_doctor_detail['Doctor']['registration5'])) {?>
											<tr>
												<td><strong>5-</strong> <?php echo $get_doctor_detail['Doctor']['registration5'];?></td>
											</tr>
											<?php }?>
										<?php } else {?>
										<tr>
											<td>No Registrations Found</td>
										</tr>
										<?php }?>
									</table>
								</td>
							</tr>
							
							
							<tr id="ClinicInfo1" style="display:none;">
								<td colspan="2" style="font-weight:bold; text-decoration:underline;">Clinic Information(s)</td>
							</tr>
							<?php $f = 1; $ff = 100; $hh = 200;foreach($get_clinic_detail as $key => $val) { ?>
							<?php $expl_clinic_add = explode('*',$val['DoctorClinic']['clinic_address']); if(!empty($expl_clinic_add[0])){$address1 = $expl_clinic_add[0];} if(!empty($expl_clinic_add[1])){$address2 = $expl_clinic_add[1];}?>
							<tr id="ClinicInfo<?php echo $ff;?>" style="display:none;">
								<td width="1%"><strong><?php echo $f;?>-</strong></td>
								<td><a href="javascript:void(0);" onclick="show_time(<?php echo $f;?>);" style="color:#0099FF;"><?php echo $val['DoctorClinic']['clinic_name'];?></a></td>
							</tr>
							<tr id="ClinicInfo<?php echo $hh;?>" style="display:none;">
								<td width="1%">&nbsp;</td>
								<td><?php echo $address1;?><?php if(!empty($address2)) {?><br /><?php echo $address2;?><?php }?></td>
							</tr>
							<tr id="TimeSlot<?php echo $f;?>" style="display:none;">
								<td colspan="2">
									<div class="timeHeading2">
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
									  <div class="timeTableDiv2">
										<table width="100%" border="0" cellspacing="1" cellpadding="0">
											<tr>
												<td height="118" width="7%"><h3>Morning</h3></td>
												<td width="7%">
													<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td width="7%">
													<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													
												</td>
												<td width="7%">
													<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td width="7%">
													<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td width="7%">
													<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td width="7%">
													<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td width="7%">
													<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>	
											</tr>
											
											<tr>
												<td height="170" width="7%"><h3>Afternoon</h3></td>
												<td>
													<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
			
			
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
											</tr>
											
											<tr>
												<td height="135" width="7%"><h3>Evening</h3></td>
												<td>
													<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
											</tr>
											
											<tr>
												<td height="100" width="7%"><h3>Night</h3></td>
												<td>
													<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
												<td>
													<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
													<?php if($day == 1) {foreach($val['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 2) {foreach($val['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 3) {foreach($val['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 4) {foreach($val['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 5) {foreach($val['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 6) {foreach($val['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
													<?php if($day == 7) {foreach($val['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
														<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
													<?php }}?>
												</td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
							<?php $f++; $ff++; $hh++;}?>
						</table>
					</td>
					<td style="text-align:right; vertical-align:top;">
						<?php if(!empty($get_doctor_detail['Doctor']['image'])) {?>
							<?php echo $html->image(DOCTOR_IMAGE_SMALL_URL.$get_doctor_detail['Doctor']['image'],array('style'=>'border:1px solid #999999;'));?>
						<?php } else {?>
							<?php if($get_doctor_detail['Doctor']['gender'] == 'Male') {?>
								<?php echo $html->image('frontend/default_male.jpg',array('width'=>120,'style'=>'border:1px solid #999999;'));?>
							<?php }?>
							<?php if($get_doctor_detail['Doctor']['gender'] == 'Female') {?>
								<?php echo $html->image('frontend/default_female.jpg',array('width'=>120,'style'=>'border:1px solid #999999;'));?>
							<?php }?>
						<?php }?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<?php if( $get_doctor_detail['Doctor']['admin_featured'] == 1) {?>
			<?php echo $form->submit('Unfeature Doctor', array('div'=>false, 'class' => 'btn','onclick'=>'unfeature_doctor('.$get_doctor_detail['Doctor']['id'].');')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php }?>
			
		</td>
	</tr>
	<?php //echo $form->end();?>
</table>
Activate/Deactivate Doctor Clinic: 
<?php
if($get_clinic_detail[0]['DoctorClinic']['status'] == 1)
{ ?>
<input type="checkbox" name="doctor_clinic_activate_deactivate" id="doctor_clinic_activate_deactivate" onclick="update_doctor_clinic_status()" checked="<?php echo $get_clinic_detail[0]['DoctorClinic']['status']; ?>"/>
<?php } else { ?>
<input type="checkbox" name="doctor_clinic_activate_deactivate" id="doctor_clinic_activate_deactivate" onclick="update_doctor_clinic_status()"/>
<?php } ?>
</div>

<script type="text/javascript">
function unfeature_doctor(val)
{
	window.location.href=siteUrl+"admin/pages/unfeature_doctor/"+val;
}
function update_doctor_clinic_status()
{
	var n = $( "#doctor_clinic_activate_deactivate:checked" ).length;
	window.location.href=siteUrl+"admin/pages/doctor_clinic_acti_deacti/"+n+"/"+<?php echo $get_clinic_detail[0]['DoctorClinic']['id']; ?>;
}
</script>

<?php echo $javascript->link('light/jquery.lightbox_me') ?>
<?php echo $javascript->link('light/slider') ?>