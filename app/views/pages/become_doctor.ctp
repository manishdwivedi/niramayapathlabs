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
document.getElementById("msg13").innerHTML="";
document.getElementById("msg14").innerHTML="";
document.getElementById("msg15").innerHTML="";
document.getElementById("msg16").innerHTML="";

if(document.form2.DoctorFirstName.value=='')
{
	
	document.getElementById("msg1").innerHTML="Please Enter Your first name";
	str=false;
}
if(document.form2.DoctorLastName.value=='')
{
	
	document.getElementById("msg2").innerHTML="Please Enter Your last name";
	str=false;
}
if(document.form2.DoctorGender.value=='')
{
	
	document.getElementById("msg3").innerHTML="Please Select Gender";
	str=false;
}
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
if(document.form2.DoctorDay.value=='')
{
	
	document.getElementById("msg6").innerHTML="Please Select Day";
	str=false;
}
if(document.form2.DoctorMonth.value=='')
{
	
	document.getElementById("msg15").innerHTML="Please Select Month";
	str=false;
}
if(document.form2.DoctorYear.value=='')
{
	
	document.getElementById("msg16").innerHTML="Please Select Year";
	str=false;
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
if(document.form2.DoctorPhoto.value=='')
{
	
	document.getElementById("msg12").innerHTML="Please Select Photo";
	str=false;
}
if(document.form2.DoctorConsFee.value=='')
{
	
	document.getElementById("msg111").innerHTML="Please Enter Consultancy Fee for Clinic";
	str=false;
}
if(document.form2.DoctorPassword.value=='')
{
	
	document.getElementById("msg13").innerHTML="Please Enter Password";
	str=false;
}
if(document.form2.DoctorCnfPass.value=='')
{
	
	document.getElementById("msg14").innerHTML="Please Enter Confirm Password";
	str=false;
}


return str;
}
</script>

<div class="banner"><?php echo $this->Html->image('frontend/niramaya_dr_module_banner.jpg',array('alt'=>'Banner'))?></div>
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
          <div class="bread"><?php echo $this->Html->link('Become Doctor','/pages/become_doctor');?></div>
        </div>
        
      </div>
      <h1>Doctor <span class="green">Registration</span></h1>
	  <div style="clear:both; padding:10px 10px 10px 0;">Join the Niramaya Panel of Doctors and be seen by New Patients to offer your services through highly engaging Tools like the Appointment Scheduler.</div>
	  <div style="clear:both; padding:10px 10px 10px 0;">This is a 3 Step Registration, for you to showcase your Qualifications and competencies to the prospective Patients.</div>
	  <div style="color:#FF0000; clear:both;">Fields in * are mandatory Fields</div>
	<?php if(!empty($messg)) {?>
	<span style="color:#FF0000;"><?php echo $messg; ?></span>
	<?php }?>
      <?php echo $form->create(null, array('url'=>'/pages/become_doctor','id'=>'form2','name'=>'form2','class'=>'bookForm','onsubmit'=>'return validationc(this);','enctype'=>'multipart/form-data')); ?>
        <h1>Personal Details</h1>
		<div class="row">
          <label>Title</label>
          <div class="mid">:</div>
		  	<?php if(!empty($DoctorDetail)) {?>
			<select name="data[Doctor][title]" class="smallTextBox" style="width:50px;">
				<option value="Dr" <?php if($DoctorDetail['Doctor']['title'] == 'Dr') {?> selected="selected" <?php }?>>Dr</option>
				<option value="Mr" <?php if($DoctorDetail['Doctor']['title'] == 'Mr') {?> selected="selected" <?php }?>>Mr</option>
				<option value="Mrs" <?php if($DoctorDetail['Doctor']['title'] == 'Mrs') {?> selected="selected" <?php }?>>Mrs</option>
				<option value="Ms" <?php if($DoctorDetail['Doctor']['title'] == 'Ms') {?> selected="selected" <?php }?>>Ms</option>
			</select>
			<?php } else {?>
          	<select name="data[Doctor][title]" class="smallTextBox" style="width:50px;">
				<option value="Dr">Dr</option>
				<option value="Mr">Mr</option>
				<option value="Mrs">Mrs</option>
				<option value="Ms">Ms</option>
			</select>
			<?php }?>
		</div>
        <div class="row">
          <label>First Name <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          	<?php if(!empty($DoctorDetail)) {?>
			<?php echo $form->text('Doctor.first_name',array('value'=>$DoctorDetail['Doctor']['first_name']));?>
			<?php } else {?>
			<?php echo $form->text('Doctor.first_name',array('placeholder'=>'Enter First Name'));?>
			<?php }?>
			<span id="msg1" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
        </div>
        <div class="row">
          <label>Last Name <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          	<?php if(!empty($DoctorDetail)) {?>
			<?php echo $form->text('Doctor.last_name',array('value'=>$DoctorDetail['Doctor']['last_name']));?>
			<?php } else {?>
			<?php echo $form->text('Doctor.last_name',array('placeholder'=>'Enter Last Name'));?>
			<?php }?>
			<span id="msg2" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
        </div>
        <div class="row">
          <label>Gender <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          	<?php if(!empty($DoctorDetail)) {?>
			<select name="data[Doctor][gender]" class="smallTextBox" id="DoctorGender">
				<option value="">Select Gender</option>
				<option value="1" <?php if($DoctorDetail['Doctor']['gender'] == 1) {?> selected="selected" <?php }?>>Male</option>
				<option value="2" <?php if($DoctorDetail['Doctor']['gender'] == 2) {?> selected="selected" <?php }?>>Female</option>
			</select>
			<?php } else {?>
			<select name="data[Doctor][gender]" class="smallTextBox" id="DoctorGender">
				<option value="">Select Gender</option>
				<option value="1">Male</option>
				<option value="2">Female</option>
			</select>
			<?php }?>
			<span id="msg3" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
        </div>
        <div class="row">
          <label>E-Mail ID <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          	<?php if(!empty($DoctorDetail)) {?>
			<?php echo $form->text('Doctor.email',array('value'=>$DoctorDetail['Doctor']['email']));?>
			<?php } else {?>
			<?php echo $form->text('Doctor.email',array('placeholder'=>'Enter E-mail ID'));?>
			<?php }?>
			<span id="msg4" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
        </div>
        <div class="row">
          <label>Mobile Number <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
			<?php if(!empty($DoctorDetail)) {?>
			<?php echo $form->text('Doctor.contact',array('value'=>$DoctorDetail['Doctor']['contact']));?>
			<?php } else {?>
			<?php echo $form->text('Doctor.contact',array('placeholder'=>'Enter Mobile Number'));?>
			<?php }?>
			<span id="msg5" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
        </div>
        <div class="row">
          <label>Date of birth <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          <div class="left">
		  	<?php if(!empty($DoctorDetail)) {?>
			<select name="data[Doctor][day]" id="DoctorDay" class="widdob marLeftNone">
				<option value="">Day</option>
				<option value="01" <?php if($DoctorDetail['Doctor']['day'] == '01') {?> selected="selected" <?php }?>>01</option>
				<option value="02" <?php if($DoctorDetail['Doctor']['day'] == '02') {?> selected="selected" <?php }?>>02</option>
				<option value="03" <?php if($DoctorDetail['Doctor']['day'] == '03') {?> selected="selected" <?php }?>>03</option>
				<option value="04" <?php if($DoctorDetail['Doctor']['day'] == '04') {?> selected="selected" <?php }?>>04</option>
				<option value="05" <?php if($DoctorDetail['Doctor']['day'] == '05') {?> selected="selected" <?php }?>>05</option>
				<option value="06" <?php if($DoctorDetail['Doctor']['day'] == '06') {?> selected="selected" <?php }?>>06</option>
				<option value="07" <?php if($DoctorDetail['Doctor']['day'] == '07') {?> selected="selected" <?php }?>>07</option>
				<option value="08" <?php if($DoctorDetail['Doctor']['day'] == '08') {?> selected="selected" <?php }?>>08</option>
				<option value="09" <?php if($DoctorDetail['Doctor']['day'] == '09') {?> selected="selected" <?php }?>>09</option>
				<option value="10" <?php if($DoctorDetail['Doctor']['day'] == '10') {?> selected="selected" <?php }?>>10</option>
				<option value="11" <?php if($DoctorDetail['Doctor']['gedaynder'] == '11') {?> selected="selected" <?php }?>>11</option>
				<option value="12" <?php if($DoctorDetail['Doctor']['day'] == '12') {?> selected="selected" <?php }?>>12</option>
				<option value="13" <?php if($DoctorDetail['Doctor']['day'] == '13') {?> selected="selected" <?php }?>>13</option>
				<option value="14" <?php if($DoctorDetail['Doctor']['day'] == '14') {?> selected="selected" <?php }?>>14</option>
				<option value="15" <?php if($DoctorDetail['Doctor']['day'] == '15') {?> selected="selected" <?php }?>>15</option>
				<option value="16" <?php if($DoctorDetail['Doctor']['day'] == '16') {?> selected="selected" <?php }?>>16</option>
				<option value="17" <?php if($DoctorDetail['Doctor']['day'] == '17') {?> selected="selected" <?php }?>>17</option>
				<option value="18" <?php if($DoctorDetail['Doctor']['day'] == '18') {?> selected="selected" <?php }?>>18</option>
				<option value="19" <?php if($DoctorDetail['Doctor']['day'] == '19') {?> selected="selected" <?php }?>>19</option>
				<option value="20" <?php if($DoctorDetail['Doctor']['day'] == '20') {?> selected="selected" <?php }?>>20</option>
				<option value="21" <?php if($DoctorDetail['Doctor']['day'] == '21') {?> selected="selected" <?php }?>>21</option>
				<option value="22" <?php if($DoctorDetail['Doctor']['day'] == '22') {?> selected="selected" <?php }?>>22</option>
				<option value="23" <?php if($DoctorDetail['Doctor']['day'] == '23') {?> selected="selected" <?php }?>>23</option>
				<option value="24" <?php if($DoctorDetail['Doctor']['day'] == '24') {?> selected="selected" <?php }?>>24</option>
				<option value="25" <?php if($DoctorDetail['Doctor']['day'] == '25') {?> selected="selected" <?php }?>>25</option>
				<option value="26" <?php if($DoctorDetail['Doctor']['day'] == '26') {?> selected="selected" <?php }?>>26</option>
				<option value="27" <?php if($DoctorDetail['Doctor']['day'] == '27') {?> selected="selected" <?php }?>>27</option>
				<option value="28" <?php if($DoctorDetail['Doctor']['day'] == '28') {?> selected="selected" <?php }?>>28</option>
				<option value="29" <?php if($DoctorDetail['Doctor']['day'] == '29') {?> selected="selected" <?php }?>>29</option>
				<option value="30" <?php if($DoctorDetail['Doctor']['day'] == '30') {?> selected="selected" <?php }?>>30</option>
				<option value="31" <?php if($DoctorDetail['Doctor']['day'] == '31') {?> selected="selected" <?php }?>>31</option>
			</select>
			<select name="data[Doctor][month]" id="DoctorMonth" class="widdob">
				<option value="">Month</option>
				<option value="Jan" <?php if($DoctorDetail['Doctor']['month'] == 'Jan') {?> selected="selected" <?php }?>>Jan</option>
				<option value="Feb" <?php if($DoctorDetail['Doctor']['month'] == 'Feb') {?> selected="selected" <?php }?>>Feb</option>
				<option value="Mar" <?php if($DoctorDetail['Doctor']['month'] == 'Mar') {?> selected="selected" <?php }?>>Mar</option>
				<option value="Apr" <?php if($DoctorDetail['Doctor']['month'] == 'Apr') {?> selected="selected" <?php }?>>Apr</option>
				<option value="May" <?php if($DoctorDetail['Doctor']['month'] == 'May') {?> selected="selected" <?php }?>>May</option>
				<option value="Jun" <?php if($DoctorDetail['Doctor']['month'] == 'Jun') {?> selected="selected" <?php }?>>Jun</option>
				<option value="Jul" <?php if($DoctorDetail['Doctor']['month'] == 'Jul') {?> selected="selected" <?php }?>>Jul</option>
				<option value="Aug" <?php if($DoctorDetail['Doctor']['month'] == 'Aug') {?> selected="selected" <?php }?>>Aug</option>
				<option value="Sep" <?php if($DoctorDetail['Doctor']['month'] == 'Sep') {?> selected="selected" <?php }?>>Sep</option>
				<option value="Oct" <?php if($DoctorDetail['Doctor']['month'] == 'Oct') {?> selected="selected" <?php }?>>Oct</option>
				<option value="Nov" <?php if($DoctorDetail['Doctor']['month'] == 'Nov') {?> selected="selected" <?php }?>>Nov</option>
				<option value="Dec" <?php if($DoctorDetail['Doctor']['month'] == 'Dec') {?> selected="selected" <?php }?>>Dec</option>
			</select>
			<select name="data[Doctor][year]" id="DoctorYear" class="widdob">
				<option value="">Year</option>
				<?php for($i=1950;$i<=2050;$i++){?>
				<option value="<?php echo $i;?>" <?php if($DoctorDetail['Doctor']['year'] == $i) {?> selected="selected" <?php }?>><?php echo $i;?></option>
				<?php }?>
			</select>
			<?php } else {?>
			<select name="data[Doctor][day]" id="DoctorDay" class="widdob marLeftNone">
				<option value="">Day</option>
				<option value="01">01</option>
				<option value="02">02</option>
				<option value="03">03</option>
				<option value="04">04</option>
				<option value="05">05</option>
				<option value="06">06</option>
				<option value="07">07</option>
				<option value="08">08</option>
				<option value="09">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
			</select>
			<select name="data[Doctor][month]" id="DoctorMonth" class="widdob">
				<option value="">Month</option>
				<option value="Jan">Jan</option>
				<option value="Feb">Feb</option>
				<option value="Mar">Mar</option>
				<option value="Apr">Apr</option>
				<option value="May">May</option>
				<option value="Jun">Jun</option>
				<option value="Jul">Jul</option>
				<option value="Aug">Aug</option>
				<option value="Sep">Sep</option>
				<option value="Oct">Oct</option>
				<option value="Nov">Nov</option>
				<option value="Dec">Dec</option>
			</select>
			<select name="data[Doctor][year]" id="DoctorYear" class="widdob">
				<option value="">Year</option>
				<?php for($i=1950;$i<=2050;$i++){?>
				<option value="<?php echo $i;?>"><?php echo $i;?></option>
				<?php }?>
			</select>
			<?php }?>
            <span id="msg6" style="color:#ff0000; float:left; clear:both;"></span>
			<span id="msg15" style="color:#ff0000; float:left; clear:both;"></span>
			<span id="msg16" style="color:#ff0000; float:left; clear:both;"></span>
          </div>
        </div>
        <div class="row marbot">
          <label>Address <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          	<?php if(!empty($DoctorDetail)) {?>
			<?php echo $form->text('Doctor.address1',array('value'=>$DoctorDetail['Doctor']['address1']));?>
			<?php } else {?>
			<?php echo $form->text('Doctor.address1',array('placeholder'=>'Enter Address'));?>
			<?php }?>
        </div>
		<div class="row marbot">
          <label>&nbsp;</label>
          <div class="mid">:</div>
          	<?php if(!empty($DoctorDetail)) {?>
			<?php echo $form->text('Doctor.address2',array('value'=>$DoctorDetail['Doctor']['address2']));?>
			<?php } else {?>
			<?php echo $form->text('Doctor.address2',array('placeholder'=>'Enter Address'));?>
			<?php }?>
			<span id="msg7" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
        </div>
        <div class="row">
          <label>Locality <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
			<?php if(!empty($DoctorDetail)) {?>
			<?php echo $form->text('Doctor.locality',array('value'=>$DoctorDetail['Doctor']['locality']));?>
			<?php } else {?>
			<?php echo $form->text('Doctor.locality',array('placeholder'=>'Enter Locality'));?>
			<?php }?>
			<span id="msg8" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
        </div>
        <div class="row">
          <label>State <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          	<?php if(!empty($DoctorDetail)) {?>
			<select name="data[Doctor][state]" class="smallTextBox" id="DoctorState">
				<option value="">Select State</option>
				<?php foreach($state as $key => $val) {?>
				<option value="<?php echo $val['State']['id'];?>" <?php if($DoctorDetail['Doctor']['state'] == $val['State']['id']) {?> selected="selected" <?php }?>><?php echo $val['State']['name'];?></option>
				<?php }?>
			</select>
			<?php } else {?>
			<select name="data[Doctor][state]" class="smallTextBox" id="DoctorState">
				<option value="">Select State</option>
				<?php foreach($state as $key => $val) {?>
				<option value="<?php echo $val['State']['id'];?>"><?php echo $val['State']['name'];?></option>
				<?php }?>
			</select>
			<?php }?>
			<span id="msg9" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
        </div>
        <div class="row">
          <label>City <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          	<?php if(!empty($DoctorDetail)) {?>
			<?php echo $form->text('Doctor.city',array('value'=>$DoctorDetail['Doctor']['city']));?>
			<?php } else {?>
			<?php echo $form->text('Doctor.city',array('placeholder'=>'Enter City'));?>
			<?php }?>
			<span id="msg10" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
        </div>
        <div class="row">
          <label>Zip Code <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          	<?php if(!empty($DoctorDetail)) {?>
			<?php echo $form->text('Doctor.zipcode',array('value'=>$DoctorDetail['Doctor']['zipcode']));?>
			<?php } else {?>
			<?php echo $form->text('Doctor.zipcode',array('placeholder'=>'Enter Zip Code'));?>
			<?php }?>
			<span id="msg11" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
        </div>
        <div class="row">
          <label>Photo <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          <?php echo $form->file('Doctor.photo');?>
		  <span id="msg12" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
        </div>
		<div class="row">
          <label>Consultancy Fees (Clinic) <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          	<?php if(!empty($DoctorDetail)) {?>
			<?php echo $form->text('Doctor.cons_fee',array('value'=>$DoctorDetail['Doctor']['cons_fee'],'style'=>'width:252px;'));?>
			<?php } else {?>
			<?php echo $form->text('Doctor.cons_fee',array('placeholder'=>'Enter Consultancy Fees for Clinic (Ex.100,200)','style'=>'width:252px;'));?>
			<?php }?>
			<span id="msg111" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
        </div>
		<div class="row">
          <label>Consultancy Fees (Home Visit)</label>
          <div class="mid">:</div>
          	<?php if(!empty($DoctorDetail)) {?>
			<?php echo $form->text('Doctor.home_fee',array('value'=>$DoctorDetail['Doctor']['home_fee'],'style'=>'width:252px;'));?>
			<?php } else {?>
			<?php echo $form->text('Doctor.home_fee',array('placeholder'=>'Enter Consultancy Fees for Home Visit (Ex.100,200)','style'=>'width:252px;'));?>
			<?php }?>
		</div>
        <div class="row">
          <label>Password <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          <?php echo $form->password('Doctor.password',array('placeholder'=>'Enter Password'));?>
		  <span id="msg13" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
        </div>
        <div class="row">
          <label>Confirm Password <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          <?php echo $form->password('Doctor.cnf_pass',array('placeholder'=>'Enter Confirm Password'));?>
		  <span id="msg14" style="color:#ff0000; float:left; clear:both; padding:0 0 0 210px;"></span>
          <input type="image" src="<?php echo SITE_URL;?>img/next-button.jpg" alt="Next" class="btn" />
        </div>
        
         
        
       
      <?php echo $form->end();?>
      <div class="bottomShadow"></div>
    </div>
  </div>