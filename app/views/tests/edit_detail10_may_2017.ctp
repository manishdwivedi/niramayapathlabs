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

function open_pass()
{
	if(ChangePassCheck.checked == 1)
	{
		$('#ChangePass').toggle('slow');
	}
	if(ChangePassCheck.checked == 0)
	{
		$('#ChangePass').toggle('slow');
	}
}
</script>
	<div class="banner"><?php echo $this->Html->image('frontend/niramaya_company-overview_static.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
  	<div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home"><a href="<?php echo SITE_URL;?>pages/index">Home Page</a></div>
          <div class="bread"><?php echo $this->Html->link('My Cart','/tests/personal_detail');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
      <h1>My <span class="green">Account</span></h1>
	  <div id="advanceSearch"><h4>Search / Book a Test</h4>
			  <?php echo $form->create(null, array('url'=>'/tests/search_keyword_home','id'=>'form1','name'=>'form1')); ?>
			  <?php echo $form->text('Search.test_search',array('placeholder'=>'Type Keyword...'));?>
			  <input type="image" src="<?php echo SITE_URL;?>img/frontend/go.jpg" class="go" style="cursor:pointer;" />
			  <div class="or">Or</div>
			  <div class="advanceSearch"><a href="<?php echo SITE_URL;?>tests/search" style="color:#EE8012;">Advance Search</a></div>
			  <?php echo $form->end();?>
		  </div>
    <div class="subHeading">
    <h2>Personal Details</h2>
    <ul>
    <li><?php echo $html->link('Personal Details',array('controller'=>'tests','action'=>'personal_detail'),array('class'=>'act'));?></li>
    
    <!--<li><?php //echo $html->link('My Requests',array('controller'=>'tests','action'=>'my_request'));?></li>
    <li><?php //echo $html->link('My Reports',array('controller'=>'tests','action'=>'my_report'));?></li>-->
	<li><?php echo $html->link('My Requests',array('controller'=>'tests','action'=>'payment_history'));?></li>
	<li><?php echo $html->link('My Appointments',array('controller'=>'pages','action'=>'my_appointment'));?></li>
	<li><?php echo $html->link('Vitals',array('controller'=>'tests','action'=>'bmi_value'));?></li>
    <li class="borderNone padRightNone"><?php echo $html->link('Logout','javascript:void(0);',array('onclick'=>'show_tab("loggedout");'));?></li>
    </ul>
    
    
    
    </div>
	  <?php echo $form->create('ChangePassword',array('url'=>'#'));?>
	  <?php echo $form->hidden('User.id',array('value'=>$member_detail['User']['id']));?>
	  
      <div class="formDiv">
	  <?php if(!empty($mess_fail) && empty($mess_succ_pass) && empty($mess_succ)) {?>
	  <div style="color:#FF0000;"><?php echo $mess_fail;?></div>
	  <?php }?>
	  <?php if(empty($mess_fail) && !empty($mess_succ_pass) && empty($mess_succ)) {?>
	  <div style="color:green;"><?php echo $mess_succ_pass;?></div>
	  <?php }?>
	  <?php if(empty($mess_fail) && empty($mess_succ_pass) && !empty($mess_succ)) {?>
	  <div style="color:green;"><?php echo $mess_succ;?></div>
	  <?php }?>
	  <div class="row"><label>First Name</label><div class="dot">:</div><div class="detail" style="margin:0;"><?php echo $form->text('User.first_name',array('value'=>$member_detail['User']['first_name']));?></div></div>
	  <div class="row"><label>Last Name</label><div class="dot">:</div><div class="detail" style="margin:0;"><?php echo $form->text('User.last_name',array('value'=>$member_detail['User']['last_name']));?></div></div>
	  <div class="row"><label>Gender</label><div class="dot">:</div>
	  	<input type="radio" name="data[User][gender]" value="1" <?php if($member_detail['User']['gender'] == 1) {?> checked="checked" <?php }?> />&nbsp;Male&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="radio" name="data[User][gender]" value="2" <?php if($member_detail['User']['gender'] == 2) {?> checked="checked" <?php }?> />&nbsp;Female
	  </div>
      <div class="row"><label>Age</label><div class="dot">:</div><?php echo $form->text('User.age',array('value'=>$member_detail['User']['age']));?></div>
      <div class="row"><label>Contact Number</label><div class="dot">:</div><?php echo $form->text('User.contact',array('value'=>$member_detail['User']['contact']));?></div>
      <div class="row"><label>Email ID</label><div class="dot">:</div><?php echo $form->text('User.email',array('value'=>$member_detail['User']['email']));?></div>
	  <?php $explode_add = explode('*',$member_detail['User']['address']);?>
	  <?php if(!empty($explode_add[0]) && empty($explode_add[1])) {?>
	  <div class="row"><label>Address</label><div class="dot">:</div><?php echo $form->text('User.address1',array('value'=>$explode_add[0]));?></div>
	  <div class="row"><label>&nbsp;</label><div class="dot">:</div><?php echo $form->text('User.address2',array('value'=>$member_detail['User']['email']));?></div>
	  <?php }?>
	  <?php if(!empty($explode_add[0]) && !empty($explode_add[1])) {?>
	  <div class="row"><label>Address</label><div class="dot">:</div><?php echo $form->text('User.address1',array('value'=>$explode_add[0]));?></div>
	  <div class="row"><label>&nbsp;</label><div class="dot">:</div><?php echo $form->text('User.address2',array('value'=>$explode_add[1]));?></div>
	  <?php }?>
	  
	  <div class="row"><label>Locality</label><div class="dot">:</div><?php echo $form->text('User.locality',array('value'=>$member_detail['User']['locality']));?></div>
	  <div class="row"><label>City</label><div class="dot">:</div>
	  	<select name="data[User][city]" class="smallSelectBox" id="UserCity" style="color:#666; border: 1px solid #D9D9D9; border-radius: 3px 3px 3px 3px; color: #666666; float: left; font: 11px arial; height: 25px; padding: 3px; width: 257px;">
			<option value="">Please Select City</option>
			<?php foreach($city as $key => $val) {?>
			<option value="<?php echo $val['City']['id'];?>" <?php if($member_detail['User']['city'] == $val['City']['id']) {?> selected="selected" <?php }?>><?php echo $val['City']['name'];?></option>
			<?php }?>
		</select>
	  </div>
	  <div class="row"><label>State</label><div class="dot">:</div>
	  	<select name="data[User][state]" class="smallSelectBox" id="UserState" style="color:#666; border: 1px solid #D9D9D9; border-radius: 3px 3px 3px 3px; color: #666666; float: left; font: 11px arial; height: 25px; padding: 3px; width: 257px;">
			<option value="">Please Select State</option>
			<?php foreach($state as $key => $val) {?>
			<option value="<?php echo $val['State']['id'];?>" <?php if($member_detail['User']['state'] == $val['State']['id']) {?> selected="selected" <?php }?>><?php echo $val['State']['name'];?></option>
			<?php }?>
		</select> 
	  </div>
	  <div class="row"><label>Pincode</label><div class="dot">:</div><?php echo $form->text('User.pincode',array('value'=>$member_detail['User']['pincode']));?></div>
	  <div class="row"><label>Landmark</label><div class="dot">:</div><?php echo $form->text('User.landmark',array('value'=>$member_detail['User']['landmark']));?></div>
      
      <div class="row"><input name="" type="checkbox" id="ChangePassCheck" onclick="open_pass();" /> 
      <div class="changePass">Change Password</div>
      </div>
      <div id="ChangePass" <?php if(empty($mess_fail) && !empty($mess_succ_pass) && empty($mess_succ)) {?> style="display:block;" <?php } else {?> style="display:none;" <?php }?>>
      	<div class="row"><label>Old Password</label><div class="dot">:</div><?php echo $form->password('User.old_pass_user',array('value'=>'','placeholder'=>'Enter Old Password'));?></div>
      	<div class="row"><label>New Password</label><div class="dot">:</div><?php echo $form->password('User.new_pass',array('value'=>'','placeholder'=>'Enter New Password'));?></div>
      	<div class="row"><label>Confirm Password</label><div class="dot">:</div><?php echo $form->password('User.conf_pass',array('value'=>'','placeholder'=>'Enter Confirm Password'));?></div>
	  </div>
	  <div style="clear:both;">
      <input type="image" src="<?php echo SITE_URL;?>img/frontend/submit-button.gif" alt="Submit" style="float:right; margin:15px 0 0;" />
	  </div>
	  </div>
	  <?php echo $form->end();?>
  </div>