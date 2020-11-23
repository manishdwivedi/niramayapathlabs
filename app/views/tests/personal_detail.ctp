<?php ?>
<script type="text/javascript">
function show_tab(val)
{
	if(val == 'sample')
	{
		document.getElementById('SampleRequest').style.display = 'block';
	}
	
	if(val == 'loggedout')
	{
		window.location.href = siteUrl+'tests/logout';
	}
}
</script>
<div class="location_div">
<div class="centring">
<div class="graynavigation gap">
  <ul>
     <li><a href="/"><span>Home</span></a></li>
     <li class="list"> <span>Personal Details</span></li>
  </ul>
</div>
<div class="clr"></div>
<div class="teamDoctors">
<div class="doctorImg"><img src="/img/img/userdum.jpg"></div>
<div class="doctorHeading">	
	<h2><?php echo ucwords($member_detail['User']['first_name'].' '.$member_detail['User']['last_name']);?></h2>
    <?php 
	  if($member_detail['User']['gender'] == 1) {
	  $mem_gen = 'Male';
	  }
	  if($member_detail['User']['gender'] == 2) {
	  $mem_gen = 'Female';
	  }
	  ?>
    <h3>


    <p>Gender : <?php echo $mem_gen;?></p> 
    <p>DOB : <?php echo date('d-m-Y',strtotime($member_detail['User']['dob']));?>
    <p>Age : <?php echo $member_detail['User']['age'].' Years';?></p>
    <p>Contact Number : <?php echo $member_detail['User']['contact'];?></p>
    <p>Email ID : <?php echo $member_detail['User']['email'];?></p>
   </h3>
</div>

<div class="doctorHeading"  style="float: right;">	
<ul>
    <li><?php echo $html->link('My Requests',array('controller'=>'tests','action'=>'payment_history'));?></li>
    <li><?php echo $html->link('My Appointments',array('controller'=>'pages','action'=>'my_appointment'));?></li>
    <li><?php echo $html->link('Vitals',array('controller'=>'tests','action'=>'bmi_value'));?></li>
</ul>
</div>


    <div class="clr"></div>
    
    	
        
        <h2>Address infomation: </h2>
        <ul>
      <?php $explode_add = explode('*',$member_detail['User']['address']);?>
	  <?php if(!empty($explode_add[0]) && empty($explode_add[1])) {?>
        	<li><b>Address :</b><?php echo $explode_add[0];?></li>
       <?php } ?>
       <?php if(!empty($explode_add[0]) && !empty($explode_add[1])) {?> 	
        	<li><b>Address :</b><?php echo $explode_add[0]."<br>".$explode_add[1];?></li>
        
      <?php } ?>
      <li><b>Locality :</b><?php echo $member_detail['User']['locality'];?></li>
      <li><b>City :</b><?php echo $mem_city;?></li>
      <li><b>State :</b><?php echo $mem_state;?></li>
      <li><b>Pincode :</b><?php echo $member_detail['User']['pincode'];?></li>
      <li><b>Landmark :</b><?php echo $member_detail['User']['landmark'];?></li>
      </ul>
      <p class="tt">
        <?php echo $html->link('Edit Details',array('controller'=>'tests','action'=>'edit_detail'));?>
        <?php echo $html->link('Manage SubUser',array('controller'=>'tests','action'=>'manage_subuser'));?>
      </p>
<style>
.tt a{ color: #ffff;
    background: #7ecc5b;
    padding: 10px 25px;
    border-radius: 3px;
}
</style>
</div>   
</div>
</div>
<div class="clr"></div><br>