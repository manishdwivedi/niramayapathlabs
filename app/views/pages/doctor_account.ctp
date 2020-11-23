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
      
	  <div class="formDiv">
	  <div style="float:left; width:600px;">
	  	  <div class="row"><label>Unique ID</label><div class="dot">:</div><div class="detail"><?php echo $DoctorDetail['Doctor']['unique_id'];?></div></div>
		  <div class="row"><label>Title</label><div class="dot">:</div><div class="detail"><?php echo $DoctorDetail['Doctor']['title'].'.';?></div></div>
		  <div class="row"><label>First Name</label><div class="dot">:</div><div class="detail"><?php echo $DoctorDetail['Doctor']['first_name'];?></div></div>
		  <div class="row"><label>Last Name</label><div class="dot">:</div><div class="detail"><?php echo $DoctorDetail['Doctor']['last_name'];?></div></div>
		  <?php 
		  if($DoctorDetail['Doctor']['gender'] == 1) {
		  $mem_gen = 'Male';
		  }
		  if($DoctorDetail['Doctor']['gender'] == 2) {
		  $mem_gen = 'Female';
		  }
		  ?>
		  <div class="row"><label>Gender</label><div class="dot">:</div><div class="detail"><?php echo $mem_gen;?></div></div>
		  <div class="row"><label>DOB</label><div class="dot">:</div><div class="detail"><?php echo $DoctorDetail['Doctor']['dob'];?></div></div>
		  <div class="row"><label>Contact Number</label><div class="dot">:</div><div class="detail"><?php echo $DoctorDetail['Doctor']['contact'];?></div></div>
		  <div class="row"><label>Email ID</label><div class="dot">:</div><div class="detail"><?php echo $DoctorDetail['Doctor']['email'];?></div></div>
		  <?php $explode_add = explode('*',$DoctorDetail['Doctor']['address']);?>
		  <?php if(!empty($explode_add[0]) && empty($explode_add[1])) {?>
		  <div class="row"><label>Address</label><div class="dot">:</div><div class="detail"><?php echo $explode_add[0];?></div></div>
		  <?php }?>
		  <?php if(!empty($explode_add[0]) && !empty($explode_add[1])) {?>
		  <div class="row"><label>Address</label><div class="dot">:</div><div class="detail"><?php echo $explode_add[0]."<br>".$explode_add[1];?></div></div>
		  <?php }?>
		  
		  
		  <div class="row"><label>Locality</label><div class="dot">:</div><div class="detail"><?php echo $DoctorDetail['Doctor']['locality'];?></div></div>
		 
		  <div class="row"><label>State</label><div class="dot">:</div><div class="detail"><?php echo $DoctorDetail['Doctor']['state'];?></div></div>
		  
		  <div class="row"><label>City</label><div class="dot">:</div><div class="detail"><?php echo $DoctorDetail['Doctor']['city'];?></div></div>
		  <div class="row"><label>Zipcode</label><div class="dot">:</div><div class="detail"><?php echo $DoctorDetail['Doctor']['zipcode'];?></div></div>
		  <div class="row"><label>Consultancy Fee(Clinic)</label><div class="dot">:</div><div class="detail"><?php echo 'INR '.$DoctorDetail['Doctor']['cons_fee'];?></div></div>
		  <?php if($DoctorDetail['Doctor']['home_fee'] != 0) {?>
		  <div class="row"><label>Consultancy Fee(Home Visit)</label><div class="dot">:</div><div class="detail"><?php echo 'INR '.$DoctorDetail['Doctor']['home_fee'];?></div></div>
		  <?php }?>
		  
		  <div class="row">
		  <div class="changePass"><?php echo $html->link('Edit Personal Details',array('controller'=>'pages','action'=>'edit_personal_doctor'));?></div>
		  </div>
		</div>
		<div style="float:right; vertical-align:top; width:400px;">
		<?php echo $html->image(DOCTOR_IMAGE_BIGSMALL_URL.$DoctorDetail['Doctor']['image'],array('alt'=>'Doctor','title'=>$DoctorDetail['Doctor']['first_name'].' '.$DoctorDetail['Doctor']['last_name'],'style'=>'float:right;'));?>
		</div>
  
      
      
      
      <div class="bottomShadow"></div>
    </div>
  </div>