<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/jquery/ui-lightness/admin/jquery-ui.css" />
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery/jquery.ui.js"></script>
<script type="text/javascript">
function show_tab(val)
{
	window.location.href = siteUrl+'pages/doctor_logout';
}

function validationc()
{
	var str = true;
	document.getElementById('msg1').innerHTML = '';
	document.getElementById('msg2').innerHTML = '';
	document.getElementById('msg3').innerHTML = '';
	
	if(document.form2.DoctorOldPassword.value=='')
	{
		document.getElementById("msg1").innerHTML="Please Enter Old Password";
		str=false;
	}
	if(document.form2.DoctorNewPassword.value=='')
	{
		document.getElementById("msg2").innerHTML="Please Enter New Password";
		str=false;
	}
	if(document.form2.DoctorConfirmPassword.value=='')
	{
		document.getElementById("msg3").innerHTML="Please Enter Confirm Password";
		str=false;
	}
	return str;
}

function check_val()
{
	document.getElementById('msg3').innerHTML = '';
	var new_pass = document.getElementById('DoctorNewPassword').value;
	var cnf_pass = document.getElementById('DoctorConfirmPassword').value;
	
	if(new_pass == cnf_pass)
	{
		document.getElementById("msg3").innerHTML="New Password and Confirm Password Matched";
	}
	else
	{
		document.getElementById("msg3").innerHTML="New Password and Confirm Password Did Not Matched";
	}
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
<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>
	<div class="banner"><?php echo $this->Html->image('frontend/niramaya_dr_module_banner.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
  	<!--Body Part:Start-->
  <div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home"><a href="<?php echo SITE_URL;?>pages/index">Home Page</a></div>
          <div class="bread">Change Password</div>
        </div>
        
      </div>
      <h1>CHANGE <span class="green">PASSWORD</span></h1>
      
      <div class="appoint"><h3>Change Password</h3>
      <dl>
      <dt><?php echo $html->link('Personal Details',array('controller'=>'pages','action'=>'doctor_account'));?></dt>
<dt><?php echo $html->link('Proffessional Details',array('controller'=>'pages','action'=>'proffessional_detail'));?></dt>
<dt><?php echo $html->link('Clinics',array('controller'=>'pages','action'=>'clinic'));?></dt>
<dt><?php echo $html->link('Appointments',array('controller'=>'pages','action'=>'appointment'));?></dt>
<dt><?php echo $html->link('Home Visit Request',array('controller'=>'pages','action'=>'home_visit'));?></dt>
<dt class="lastAct"><?php echo $html->link('Logout','javascript:void(0);',array('onclick'=>'show_tab();'));?></dt>

      
      </dl>
      
      </div>
	  
      <?php echo $form->create(null, array('url'=>'/pages/doctor_change_password','id'=>'form2','name'=>'form2','class'=>'bookForm','onsubmit'=>'return validationc(this);','enctype'=>'multipart/form-data')); ?>
	  <?php echo $form->hidden('Doctor.id',array('value'=>$doctor_id));?>
	  <?php echo $form->hidden('Doctor.old_pass',array('value'=>$old_pass));?>
         <div class="formDiv">
		 	<?php if(!empty($alert_mess)) {?>
		 	<div class="row" style="margin:0;">
				<p style="color:#FF0000; border-bottom:none;"><?php echo $alert_mess;?></p>
			</div>
			<?php }?>
		 	<div class="row">
			  <label>Old Password <font color="#FF0000">*</font></label>
			  <div class="mid">:</div>
				<?php echo $form->password('Doctor.old_password',array('value'=>$DoctorDetail['Doctor']['first_name']));?>
				<span id="msg1" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
			</div>
			<div class="row">
			  <label>New Password <font color="#FF0000">*</font></label>
			  <div class="mid">:</div>
				<?php echo $form->password('Doctor.new_password',array('value'=>$DoctorDetail['Doctor']['first_name']));?>
				<span id="msg2" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
			</div>
			<div class="row">
			  <label>Confirm Password <font color="#FF0000">*</font></label>
			  <div class="mid">:</div>
				<?php echo $form->password('Doctor.confirm_password',array('value'=>$DoctorDetail['Doctor']['first_name'],'onkeyup'=>'check_val();'));?>
				<span id="msg3" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
			</div>
			<div class="row">
			  <label>&nbsp;</label>
			  <div class="mid">&nbsp;</div>
				<input type="image" src="<?php echo SITE_URL;?>img/submit-button.gif" alt="Submit" class="btn" style="margin:0;" />
			</div>
		 </div>
      <?php echo $form->end();?>
      
      <div class="bottomShadow"></div>
    </div>
  </div>
  <!--Body Part:End--> 