<script language="JavaScript" type="text/javascript">

function validationc()
{
var str=true;
document.getElementById("msg1").innerHTML="";
document.getElementById("msg2").innerHTML="";
document.getElementById("msg4").innerHTML="";
document.getElementById("msg5").innerHTML="";
document.getElementById("msg6").innerHTML="";
document.getElementById("msg7").innerHTML="";
document.getElementById("msg8").innerHTML="";
document.getElementById("msg9").innerHTML="";
document.getElementById("msg10").innerHTML="";
document.getElementById("msg11").innerHTML="";
document.getElementById("msg12").innerHTML="";

if(document.form1.UserFirstName.value=='')
{
	document.getElementById("msg1").innerHTML="Please Enter Your first name";
	str=false;
}
if(document.form1.UserLastName.value=='')
{
	document.getElementById("msg12").innerHTML="Please Enter Your last name";
	str=false;
}
if(document.form1.UserGender.value=='')
{
	document.getElementById("msg2").innerHTML="Please Select Gender";
	str=false;
}
if(isNaN(document.form1.UserContact.value))
{
	document.getElementById("msg4").innerHTML="Please Insert Numeric Contact Number";
	str = false;
}
else if(document.form1.UserContact.value.length<10)
{
	document.getElementById("msg4").innerHTML="Please Insert Contact Number";
    str = false;
}
if(document.form1.UserAge.value=='')
{
	document.getElementById("msg5").innerHTML="Please Enter Your age";
	str=false;
}
if(document.form1.UserAddress1.value=='')
{
	document.getElementById("msg6").innerHTML="Please Enter Address";
	str=false;
}
if(document.form1.UserLocality.value=='')
{
	document.getElementById("msg7").innerHTML="Please Enter Locality";
	str=false;
}
if(document.form1.UserCity.value=='')
{
	document.getElementById("msg8").innerHTML="Please Select City";
	str=false;
}
if(document.form1.UserState.value=='')
{
	document.getElementById("msg9").innerHTML="Please Select State";
	str=false;
}
if(document.form1.UserPincode.value=='')
{
	document.getElementById("msg10").innerHTML="Please Enter Pincode";
	str=false;
}
if(document.form1.UserLandmark.value=='')
{
	document.getElementById("msg11").innerHTML="Please Enter Landmark";
	str=false;
}	

return str;
}
</script>

<script type="text/javascript" src="<?php SITE_URL?>js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php SITE_URL?>css/jquery/ui-lightness/admin/jquery-ui.css" />

<script type="text/javascript" src="<?php SITE_URL?>js/jquery/jquery.ui.js"></script>





<div class="banner"><?php echo $this->Html->image('frontend/niramaya_company-overview_static.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
  <!--Header:End--> 
  
  <!--Body Part:Start-->
  <div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home"><a href="<?php echo SITE_URL;?>pages/index">Home Page</a></div>
          <div class="bread"><?php echo $this->Html->link('Health Collection','/tests/health_collection');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
<h1>Become <span class="green">A Member</span></h1>
<div id="advanceSearch"><h4>Search / Book a Test</h4>
			  <?php echo $form->create(null, array('url'=>'/tests/search_keyword_home','id'=>'form1','name'=>'form1')); ?>
			  <?php echo $form->text('Search.test_search',array('placeholder'=>'Type Keyword...'));?>
			  <input type="image" src="<?php echo SITE_URL;?>img/frontend/go.jpg" class="go" style="cursor:pointer;" />
			  <div class="or">Or</div>
			  <div class="advanceSearch"><a href="<?php echo SITE_URL;?>tests/search" style="color:#EE8012;">Advance Search</a></div>
			  <?php echo $form->end();?>
		  </div>
<div style="color:#FF0000; clear:both;">Fields in * are mandatory Fields</div>
<span style="color:#FF0000;"><?php echo $this->Session->flash(); ?></span>
    <!--<div class="greenText">You have opted for <b><?php //echo $test_name; if(!empty($test_code)) { echo ' - '.$test_code; } if(!empty($test_mrp)) { echo ' - Rs. '.$test_mrp; }?></b></div>-->
    <?php echo $form->create(null, array('url'=>'/tests/become_member','id'=>'form1','name'=>'form1','class'=>'bookForm','onsubmit'=>'return validationc(this);')); ?>
	
    <div class="boxRow"><label>First Name <font color="#FF0000">*</font></label>
	<?php echo $form->text('User.first_name',array('class'=>'smallTextBox'));?>
    <?php //echo $form->text('User.first_name',array('class'=>'smallTextBox','value'=>'Please Enter Your first name','onblur'=>'if(this.value=="")this.value="Please Enter Your first name"',' onfocus'=>'if(this.value=="Please Enter Your first name")this.value="";')); ?>
    <span id="msg1" style="clear:both;"></span>
    </div>
	 <div class="boxRow"><label>Last Name <font color="#FF0000">*</font></label>
	 <?php echo $form->text('User.last_name',array('class'=>'smallTextBox'));?>
    <?php //echo $form->text('User.last_name',array('class'=>'smallTextBox','value'=>'Please Enter Your last name','onblur'=>'if(this.value=="")this.value="Please Enter Your last name"',' onfocus'=>'if(this.value=="Please Enter Your last name")this.value="";')); ?>
    <span id="msg12" style="clear:both;"></span>
    </div>
    <div class="boxRow"><label>Select Gender <font color="#FF0000">*</font></label>
    <select name="data[User][gender]" class="smallSelectBox" id="UserGender">
		<option value="">Please Select Your Gender</option>
		<?php foreach($gender as $key => $val) {?>
		<option value="<?php echo $val['Gender']['id'];?>" <?php if($this->data['User']['gender'] == $val['Gender']['id']) {?> selected="selected" <?php }?>><?php echo $val['Gender']['name'];?></option>
		<?php }?>
	</select>  
	<span id="msg2" style="clear:both;"></span>
    </div>
    
    
    
    
    <div class="boxRow"><label>Age <font color="#FF0000">*</font></label>
	<?php echo $form->text('User.age',array('class'=>'smallTextBox'));?>
    <?php //echo $form->text('User.age', array('class'=>'smallTextBox','value'=>'Please Enter Your age','onblur'=>'if(this.value=="")this.value="Please Enter Your age"',' onfocus'=>'if(this.value=="Please Enter Your age")this.value="";')); ?>
    <span id="msg5" style="clear:both;"></span>
    
    </div>
    
    <div class="boxRow"><label>Contact Number <font color="#FF0000">*</font></label>
	<?php echo $form->text('User.contact',array('class'=>'smallTextBox'));?>
    <?php //echo $form->text('User.contact', array('class'=>'smallTextBox','value'=>'Please Enter Your Phone No.','onblur'=>'if(this.value=="")this.value="Please Enter Your Phone No."',' onfocus'=>'if(this.value=="Please Enter Your Phone No.")this.value="";')); ?>
	<span id="msg4" style="clear:both;"></span>
    </div>
	<div class="boxRow"><label>Email ID</label>
	<?php echo $form->text('User.email',array('class'=>'smallTextBox'));?>
    <?php //echo $form->text('User.email', array('class'=>'smallTextBox','value'=>'Please Enter Your Email Id','onblur'=>'if(this.value=="")this.value="Please Enter Your Email Id"',' onfocus'=>'if(this.value=="Please Enter Your Email Id")this.value="";')); ?>
    
    </div>
	
	
	<div class="boxRow"><label>Address <font color="#FF0000">*</font></label>
	<?php echo $form->text('User.address1',array('class'=>'smallTextBox'));?>
    <?php //echo $form->text('User.address1', array('class'=>'smallTextBox','value'=>'Please Enter Address','onblur'=>'if(this.value=="")this.value="Please Enter Address"',' onfocus'=>'if(this.value=="Please Enter Address")this.value="";')); ?>
    
    </div>
	<div class="boxRow"><label>&nbsp;</label>
	<?php echo $form->text('User.address2',array('class'=>'smallTextBox'));?>
    <?php //echo $form->text('User.address2', array('class'=>'smallTextBox','value'=>'Please Enter Address','onblur'=>'if(this.value=="")this.value="Please Enter Address"',' onfocus'=>'if(this.value=="Please Enter Address")this.value="";')); ?>
    <span id="msg6" style="clear:both;"></span>
    </div>
	<div class="boxRow"><label>Locality <font color="#FF0000">*</font></label>
	<?php echo $form->text('User.locality',array('class'=>'smallTextBox'));?>
    <?php //echo $form->text('User.locality', array('class'=>'smallTextBox','value'=>'Please Enter Locality','onblur'=>'if(this.value=="")this.value="Please Enter Locality"',' onfocus'=>'if(this.value=="Please Enter Locality")this.value="";')); ?>
    <span id="msg7" style="clear:both;"></span>
    </div>
	<div class="boxRow"><label>City <font color="#FF0000">*</font></label>
    <select name="data[User][city]" class="smallSelectBox" id="UserCity">
		<option value="">Please Select City</option>
		<?php foreach($city as $key => $val) {?>
		<option value="<?php echo $val['City']['id'];?>" <?php if($this->data['User']['city'] == $val['City']['id']) {?> selected="selected" <?php }?>><?php echo $val['City']['name'];?></option>
		<?php }?>
	</select>  
	<span id="msg8" style="clear:both;"></span>
    </div>
	<div class="boxRow"><label>State <font color="#FF0000">*</font></label>
    <select name="data[User][state]" class="smallSelectBox" id="UserState">
		<option value="">Please Select State</option>
		<?php foreach($state as $key => $val) {?>
		<option value="<?php echo $val['State']['id'];?>" <?php if($this->data['User']['state'] == $val['State']['id']) {?> selected="selected" <?php }?>><?php echo $val['State']['name'];?></option>
		<?php }?>
	</select>  
	<span id="msg9" style="clear:both;"></span>
    </div>
	<div class="boxRow"><label>Pincode <font color="#FF0000">*</font></label>
	<?php echo $form->text('User.pincode',array('class'=>'smallTextBox'));?>
    <?php //echo $form->text('User.pincode', array('class'=>'smallTextBox','value'=>'Please Enter Pincode','onblur'=>'if(this.value=="")this.value="Please Enter Pincode"',' onfocus'=>'if(this.value=="Please Enter Pincode")this.value="";')); ?>
    <span id="msg10" style="clear:both;"></span>
    </div>
	<div class="boxRow"><label>Landmark <font color="#FF0000">*</font></label>
	<?php echo $form->text('User.landmark',array('class'=>'smallTextBox'));?>
    <?php //echo $form->text('User.landmark', array('class'=>'smallTextBox','value'=>'Please Enter Landmark','onblur'=>'if(this.value=="")this.value="Please Enter Landmark"',' onfocus'=>'if(this.value=="Please Enter Landmark")this.value="";')); ?>
    <span id="msg11" style="clear:both;"></span>
    </div>
	
	<div class="boxRow">
	<label>&nbsp;</label>
	<?php echo $form->submit('', array('div'=>false, 'class' => 'right','style'=>'float:left !important; cursor:pointer;')); ?>
	</div> 
	
	<?php echo $form->end(); ?>
    
    <div class="right">
    <?php echo $this->Html->image('frontend/call_us_vertical.jpg',array('alt'=>'Img'))?>
    
    
    
    
    
    
       
     
          
          
          
      
      </div>
      <?php //echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
      
      
      
      </div>