<?php echo $html->css('layout');?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<?php echo $javascript->link('price_slider/slides.min.jquery1') ?>
	  <script>
			  $(function(){
				$('#slides').slides({
					preload: true,
					generateNextPrev: true
				});
			  });
			  </script>
      
      
       
		<!-- Doctor Time Slots Clinic-->
		  <div class="slideboxDiv1">
          	<div id="slides">
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
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av">
											<?php echo $html->link($val_clinic_time['ClinicTime']['time_slot'],array('controller'=>'pages','action'=>'change_user_time',base64_encode($get_detail['BookAppointment']['id']),base64_encode($val_clinic_time['ClinicTime']['time_slot']),base64_encode($t_day),base64_encode(date('Y-m-d'))),array('style'=>'color:#E99A09;'));?>
										</div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td width="12%">
									<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									
								</td>
								<td width="12%">
									<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td width="12%">
									<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td width="12%">
									<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td width="12%">
									<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td width="12%">
									<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>	
							</tr>
							
							<tr>
								<td height="170" width="18%"><h3>Afternoon</h3></td>
								<td>
									<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
						
						
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
							</tr>
							
							<tr>
								<td height="135" width="18%"><h3>Evening</h3></td>
								<td>
									<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
							</tr>
							
							<tr>
								<td height="100" width="18%"><h3>Night</h3></td>
								<td>
									<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
						
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
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
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td width="12%">
									<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									
								</td>
								<td width="12%">
									<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td width="12%">
									<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td width="12%">
									<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td width="12%">
									<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td width="12%">
									<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>	
							</tr>
							
							<tr>
								<td height="170" width="18%"><h3>Afternoon</h3></td>
								<td>
									<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
						
						
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
							</tr>
							
							<tr>
								<td height="135" width="18%"><h3>Evening</h3></td>
								<td>
									<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
							</tr>
							
							<tr>
								<td height="100" width="18%"><h3>Night</h3></td>
								<td>
									<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
						
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
								<td>
									<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
									<?php if($day == 1) {foreach($get_detail['BookAppointment']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 2) {foreach($get_detail['BookAppointment']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 3) {foreach($get_detail['BookAppointment']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 4) {foreach($get_detail['BookAppointment']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 5) {foreach($get_detail['BookAppointment']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 6) {foreach($get_detail['BookAppointment']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
									<?php if($day == 7) {foreach($get_detail['BookAppointment']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
										<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
									<?php }}?>
								</td>
							</tr>
						</table>
						</div>	
					</div>
				</div>
       		</div>
          </div>
		  <!-- Doctor Time Slots Clinic Ends-->
        
     