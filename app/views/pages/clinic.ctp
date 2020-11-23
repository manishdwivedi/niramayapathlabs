<script type="text/javascript">
function show_tab(val)
{
	window.location.href = siteUrl+'pages/doctor_logout';
}
</script>
<style type="text/css">
#bodyPart .bodyInnerDiv .formDiv .row label {
    float: left;
    font-weight: bold;
    margin: 9px 0 0;
    width: 175px;
}
#bodyPart .bodyInnerDiv .formDiv {
    float: left;
    width: 1000px;
}
</style>
	<div class="banner"><?php echo $this->Html->image('frontend/niramaya_dr_module_banner.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
  	<div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home"><a href="<?php echo SITE_URL;?>pages/index">Home Page</a></div>
          <div class="bread"><?php echo $this->Html->link($DoctorDetail['Doctor']['title'].'. '.$DoctorDetail['Doctor']['first_name'].' '.$DoctorDetail['Doctor']['last_name'].' Account','/pages/doctor_account');?></div>
        </div>
        
      </div>
      <h1>My <span class="green">Account</span></h1>
	  
    <div class="subHeading">
    <h2>Clinic Information</h2>
    <ul>
    <li><?php echo $html->link('Personal Details',array('controller'=>'pages','action'=>'doctor_account'));?></li>
	<li><?php echo $html->link('Proffessional Details',array('controller'=>'pages','action'=>'proffessional_detail'));?></li>
	<li><?php echo $html->link('Clinics','javascript:void(0);',array('class'=>'act'));?></li>
	<li><?php echo $html->link('Appointments',array('controller'=>'pages','action'=>'appointment'));?></li>
	<li><?php echo $html->link('Home Visit Request',array('controller'=>'pages','action'=>'home_visit'));?></li>
    <li class="borderNone padRightNone"><?php echo $html->link('Logout','javascript:void(0);',array('onclick'=>'show_tab();'));?></li>
    </ul>
    
    
    
    </div>
      
	  <div class="formDiv">
	  <div>
	  	<div class="clinic-info-mess">NOTE : If you want to update clinic information then delete that clinic and add new clinic.</div>
		<?php if(count($clinic_info) < 5) {?>
		<div class="add-more-clinic"><a href="<?php echo SITE_URL;?>pages/add_clinic_new">Add New Clinic</a></div>
		<?php }?>
	  </div>
		<?php if(!empty($alert_mess)) {?>
		<div style="font-weight:bold; color:#00C161;"><?php echo $alert_mess;?></div>
		<?php }?>
	  	<?php $g = 1;foreach($clinic_info as $k_key_info => $k_val_info) {?>
		<script type="text/javascript">
		$(function() 
		{
			function launch() 
			{
				$('signup-Div<?php echo $g;?>').lightbox_me({centered: true, onLoad: function() { $('#signup-Div<?php echo $g;?>').find('input:first').focus()}});
			}
			$('#try-<?php echo $g;?>').click(function(e) 
			{
				$("#signup-Div<?php echo $g;?>").lightbox_me({centered: true, onLoad: function() 
				{
					$("#signup-Div<?php echo $g;?>").find("input:first").focus();
				}});
				e.preventDefault(); 
			});
			$('table tr:nth-child(even)').addClass('stripe');
		});
		function hide_test<?php echo $g;?>()
		{
			$('#signup-Div<?php echo $g;?>').hide();
			$('.js_lb_overlay').css({'opacity':'0'});
		}
		</script>
		<style type="text/css">
		#signup-Div<?php echo $g;?> {background: #fff; border: 6px solid #727272; width:765px; height:auto; position: relative; display:none; z-index:999; border-radius:13px; }
		#close-one<?php echo $g;?> 
		{
			display: block;
			height: 23px;
			overflow: hidden;
			position: absolute;
			right: 3px;
			top: 8px;
			width: 24px;
		}
		</style>
		<div id="signup-Div<?php echo $g;?>"> <a id="close-one<?php echo $g;?>" class="close" href="javascript:void(0);" onclick="hide_test<?php echo $g;?>();"><?php echo $html->image('close-one.jpg');?></a>
			<div class="doc-name"><?php echo $k_val_info['DoctorClinic']['doctor_title'].'. '.ucfirst($k_val_info['DoctorClinic']['doctor_first_name']).' '.ucfirst($k_val_info['DoctorClinic']['doctor_last_name']).' Availability On '.$k_val_info['DoctorClinic']['clinic_name'];?></div>
			<div class="doc-desc">
				 <div class="timeHeading-doctor">
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
				  <div class="timeTableDiv-doctor">
					<table width="100%" border="0" cellspacing="1" cellpadding="0">
						<tr>
							<td height="118"><h3>Morning</h3></td>
							<td width="12%">
								<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td width="12%">
								<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								
							</td>
							<td width="12%">
								<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td width="12%">
								<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td width="12%">
								<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td width="12%">
								<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td width="12%">
								<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>	
						</tr>
						
						<tr>
							<td height="170"><h3>Afternoon</h3></td>
							<td>
								<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
						</tr>
						
						<tr>
							<td height="135"><h3>Evening</h3></td>
							<td>
								<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
						</tr>
						
						<tr>
							<td height="100"><h3>Night</h3></td>
							<td>
								<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
							<td>
								<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
								<?php if($day == 1) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 2) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 3) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 4) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 5) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 6) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
								<?php if($day == 7) {foreach($k_val_info['DoctorClinic']['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
									<div class="av"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
								<?php }}?>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	  	<div class="row">
			<label>Clinic Name<?php echo $g;?></label>
			<div class="dot">:</div>
			<div class="detail"><?php echo $k_val_info['DoctorClinic']['clinic_name'];?></div>
		</div>
	  	<div class="row">
			<label>Clinic Address<?php echo $g;?></label>
			<div class="dot">:</div>
			<div class="detail"><?php echo $k_val_info['DoctorClinic']['clinic_address1'];?></div>
		</div>
		<?php if(!empty($v['DoctorClinic']['clinic_address2'])) {?>
		<div class="row">
			<label>&nbsp;</label>
			<div class="dot">&nbsp;</div>
			<div class="detail"><?php echo $k_val_info['DoctorClinic']['clinic_address2'];?></div>
		</div>
		<?php }?>
		<div class="row">
			<label>&nbsp;</label>
			<div class="dot">&nbsp;</div>
			<div class="detail"><a href="javascript:void(0);" id="try-<?php echo $g;?>"><?php echo $html->image('change_index/view-time-slot.jpg',array('alt'=>'View Time Slot','title'=>'View Time Slot'));?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo SITE_URL;?>pages/delete_clinic/<?php echo base64_encode($k_val_info['DoctorClinic']['id']);?>"><?php echo $html->image('change_index/delete-clinic.jpg',array('alt'=>'Delete Clinic','title'=>'Delete Clinic','sytle'=>'cursor:pointer;'));?></a></div>
		</div>
		<?php $g++;}?>
  	  <div class="bottomShadow"></div>
    </div>
  </div>
<?php echo $javascript->link('light/jquery.lightbox_me') ?>
<?php echo $javascript->link('light/slider') ?>