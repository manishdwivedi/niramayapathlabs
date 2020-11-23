<script type="text/javascript">
function show_tab(val)
{
	window.location.href = siteUrl+'pages/doctor_logout';
}
</script>
<script language="JavaScript" type="text/javascript">

function validationc()
{

	var str=true;
	document.getElementById("msg4").innerHTML="";
	document.getElementById("msg5").innerHTML="";
	document.getElementById("msg7").innerHTML="";
	document.getElementById("msg8").innerHTML="";
	document.getElementById("msg9").innerHTML="";
	document.getElementById("msg10").innerHTML="";
	document.getElementById("msg11").innerHTML="";
	document.getElementById("msg111").innerHTML="";
	
	
	var validate_char= /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(!document.form2.DoctorEmail.value.match(validate_char))
	{
		document.getElementById("msg4").innerHTML="Please Enter a valid email address";
		str=false;
	}
	if(isNaN(document.form2.DoctorContact.value))
	{
		document.getElementById("msg5").innerHTML="Please Insert Numeric Contact Number";
		str = false;
	}
	else if(document.form2.DoctorContact.value.length<10)
	{
		document.getElementById("msg5").innerHTML="Please Insert Contact Number";
		str = false;
	}
	if(document.form2.DoctorAddress1.value=='')
	{
		document.getElementById("msg7").innerHTML="Please Enter Address";
		str=false;
	}
	if(document.form2.DoctorLocality.value=='')
	{
		document.getElementById("msg8").innerHTML="Please Enter Locality";
		str=false;
	}
	if(document.form2.DoctorState.value=='')
	{
		document.getElementById("msg9").innerHTML="Please Select State";
		str=false;
	}
	if(document.form2.DoctorCity.value=='')
	{
		document.getElementById("msg10").innerHTML="Please Enter City";
		str=false;
	}
	if(document.form2.DoctorZipcode.value=='')
	{
		document.getElementById("msg11").innerHTML="Please Enter Zipcode";
		str=false;
	}
	if(document.form2.DoctorConsFee.value=='')
	{
		document.getElementById("msg111").innerHTML="Please Enter Consultancy Fee for Clinic";
		str=false;
	}
	return str;
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

#bodyPart .bodyInnerDiv .formDiv .row .dot {
    float: left;
    font-weight: bold;
    margin: 18px 0 0;
    width: 25px;
}

#bodyPart .bodyInnerDiv .formDiv .row1 {
    clear: both;
    float: left;
    margin: 20px 0 0;
	width:auto;
}

#bodyPart .bodyInnerDiv form .row1 .mid {
    float: left;
    font-weight: bold;
    margin: 0;
    width: 30px;
}

#bodyPart .bodyInnerDiv .formDiv .row1 label {
    float: left;
    font-weight: bold;
    margin: 0;
    width: 175px;
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
        <div class="back right"><a href="<?php echo SITE_URL;?>pages/doctor_account">Back</a></div>
      </div>
      <h1>My <span class="green">Account</span></h1>
	  
    <div class="subHeading">
    <h2>Personal Details</h2>
    <ul>
    <li><?php echo $html->link('Personal Details','javascript:void(0);',array('class'=>'act'));?></li>
    <li><?php echo $html->link('Proffessional Details',array('controller'=>'pages','action'=>'proffessional_detail'));?></li>
	<li><?php echo $html->link('Clinics',array('controller'=>'pages','action'=>'clinic'));?></li>
	<li><?php echo $html->link('Appointments',array('controller'=>'pages','action'=>'appointment'));?></li>
	<li><?php echo $html->link('Home Visit Request',array('controller'=>'pages','action'=>'home_visit'));?></li>
    <li class="borderNone padRightNone"><?php echo $html->link('Logout','javascript:void(0);',array('onclick'=>'show_tab();'));?></li>
    </ul>
    
    
    
    </div>
      <?php echo $form->create(null, array('url'=>'/pages/edit_personal_doctor','id'=>'form2','name'=>'form2','class'=>'bookForm','onsubmit'=>'return validationc(this);','enctype'=>'multipart/form-data')); ?>
	  <?php echo $form->hidden('Doctor.id',array('value'=>$DoctorDetail['Doctor']['id']));?>
	 <?php echo $form->hidden('Doctor.old_image',array('value'=>$DoctorDetail['Doctor']['image']));?>
	  <div class="formDiv">
	  	<div style="width:600px; float:left;">
			<div class="row1">
			  <label>Title</label>
			  <div class="mid">:</div>
				<?php e($DoctorDetail['Doctor']['title']);?>
			</div>
			<div class="row1">
			  <label>First Name</label>
			  <div class="mid">:</div>
				<?php e($DoctorDetail['Doctor']['first_name']);?>
			</div>
			<div class="row1">
			  <label>Last Name</label>
			  <div class="mid">:</div>
				<?php e($DoctorDetail['Doctor']['last_name']);?>
			</div>
			<div class="row1">
			  <label>Gender</label>
			  <div class="mid">:</div>
				<?php if($DoctorDetail['Doctor']['gender'] == 1) {?>
				<?php echo "Male";?>
				<?php }?>
				<?php if($DoctorDetail['Doctor']['gender'] == 2) {?>
				<?php echo "Female";?>
				<?php }?>
			</div>
			<div class="row1">
			  <label>Date of birth</label>
			  <div class="mid">:</div>
			  <div class="left">
				<?php e($DoctorDetail['Doctor']['dob'])?>
			  </div>
			</div>
			<div class="row">
			  <label>E-Mail ID <font color="#FF0000">*</font></label>
			  <div class="mid">:</div>
				
				<?php echo $form->text('Doctor.email',array('value'=>$DoctorDetail['Doctor']['email']));?>
				
				<span id="msg4" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
			</div>
			<div class="row">
			  <label>Mobile Number <font color="#FF0000">*</font></label>
			  <div class="mid">:</div>
				
				<?php echo $form->text('Doctor.contact',array('value'=>$DoctorDetail['Doctor']['contact']));?>
				
				<span id="msg5" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
			</div>
			<?php $expl_add = explode('*',$DoctorDetail['Doctor']['address']);?>
			<div class="row">
			  <label>Address <font color="#FF0000">*</font></label>
			  <div class="mid">:</div>
				
				<?php echo $form->text('Doctor.address1',array('value'=>$expl_add[0]));?>
				
			</div>
			<div class="row">
			  <label>&nbsp;</label>
			  <div class="mid">:</div>
				
				<?php echo $form->text('Doctor.address2',array('value'=>$expl_add[1]));?>
				
				<span id="msg7" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
			</div>
			<div class="row">
			  <label>Locality <font color="#FF0000">*</font></label>
			  <div class="mid">:</div>
				
				<?php echo $form->text('Doctor.locality',array('value'=>$DoctorDetail['Doctor']['locality']));?>
				
				<span id="msg8" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
			</div>
			<div class="row">
			  <label>State <font color="#FF0000">*</font></label>
			  <div class="mid">:</div>
			  
				<select name="data[Doctor][state]" class="smallTextBox" id="DoctorState">
					<option value="">Select State</option>
					<?php foreach($state as $key => $val) {?>
					<option value="<?php echo $val['State']['id'];?>" <?php if($DoctorDetail['Doctor']['state'] == $val['State']['id']) {?> selected="selected" <?php }?>><?php echo $val['State']['name'];?></option>
					<?php }?>
				</select>
				
				<span id="msg9" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
			</div>
			<div class="row">
			  <label>City <font color="#FF0000">*</font></label>
			  <div class="mid">:</div>
				
				<?php echo $form->text('Doctor.city',array('value'=>$DoctorDetail['Doctor']['city']));?>
				
				<span id="msg10" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
			</div>
			<div class="row">
			  <label>Zip Code <font color="#FF0000">*</font></label>
			  <div class="mid">:</div>
				
				<?php echo $form->text('Doctor.zipcode',array('value'=>$DoctorDetail['Doctor']['zipcode']));?>
				
				<span id="msg11" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
			</div>
			<div class="row">
			  <label>Update Photo</label>
			  <div class="mid">:</div>
			  <?php echo $form->file('Doctor.photo');?>
			</div>
			<div class="row">
			  <label>Consultancy Fees (Clinic) <font color="#FF0000">*</font></label>
			  <div class="mid">:</div>
				
				<?php echo $form->text('Doctor.cons_fee',array('value'=>$DoctorDetail['Doctor']['cons_fee'],'style'=>'width:252px;'));?>
				
				<span id="msg111" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
			</div>
			<?php if($DoctorDetail['Doctor']['home_fee'] != 0) {?>
			<div class="row">
			  <label>Consultancy Fees (Home Visit)</label>
			  <div class="mid">:</div>
				<?php echo $form->text('Doctor.home_fee',array('value'=>$DoctorDetail['Doctor']['home_fee'],'style'=>'width:252px;'));?>
			</div>
			<?php }?>
			<div class="row">
			  <label>&nbsp;</label>
			  <div class="mid">&nbsp;</div>
				<input type="image" src="<?php echo SITE_URL;?>img/submit-button.gif" alt="Submit" class="btn" />
			</div>
		</div>
		<div style="float:right; vertical-align:top; width:400px;"><?php echo $html->image(DOCTOR_IMAGE_BIGSMALL_URL.$DoctorDetail['Doctor']['image'],array('alt'=>'Doctor','title'=>$DoctorDetail['Doctor']['first_name'].' '.$DoctorDetail['Doctor']['last_name'],'style'=>'float:right;'));?></div>
      <div class="bottomShadow"></div>
    </div>
	<?php echo $form->end();?>
  </div>