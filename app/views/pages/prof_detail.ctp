<script type="text/javascript">
function show_tab(val)
{
	window.location.href = siteUrl+'pages/doctor_logout';
}
</script>
<script type="text/javascript">
function validationc()
{
	var str=true;
	document.getElementById("msg1").innerHTML="";
	document.getElementById("msg3").innerHTML="";
	document.getElementById("msg4").innerHTML="";
	document.getElementById("msg5").innerHTML="";
	
	if(document.form2.DoctorService1.value=='')
	{
		document.getElementById("msg1").innerHTML="Please Enter Atleast One Service";
		str=false;
	}
	if(document.form2.DoctorEducation1.value=='')
	{
		document.getElementById("msg3").innerHTML="Please Enter Atleast One Education";
		str=false;
	}
	if(document.form2.DoctorExperience1.value=='')
	{
		document.getElementById("msg4").innerHTML="Please Enter Atleast One Experience";
		str=false;
	}
	if(document.form2.DoctorOwnDesc.value=='')
	{
		document.getElementById("msg5").innerHTML="Please Enter Something About Yourself";
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
          <div class="bread"><?php echo $this->Html->link($this->data['Doctor']['title'].' '.$this->data['Doctor']['first_name'].' '.$this->data['Doctor']['last_name'],'/pages/doctor_account');?></div>
        </div>
        
      </div>
      <h1>My <span class="green">Account</span></h1>
	  <div class="subHeading">
		<h2>Professional Details</h2>
		<ul>
		<li><?php echo $html->link('Personal Details',array('controller'=>'pages','action'=>'doctor_account'));?></li>
		<li><?php echo $html->link('Proffessional Details','javascript:void(0);',array('class'=>'act'));?></li>
		<li><?php echo $html->link('Clinics',array('controller'=>'pages','action'=>'clinic'));?></li>
		<li><?php echo $html->link('Appointments',array('controller'=>'pages','action'=>'appointment'));?></li>
		<li><?php echo $html->link('Home Visit Request',array('controller'=>'pages','action'=>'home_visit'));?></li>
		<li class="borderNone padRightNone"><?php echo $html->link('Logout','javascript:void(0);',array('onclick'=>'show_tab();'));?></li>
		</ul>
		
		
		
		</div>
	  <div style="color:#FF0000; clear:both; padding:10px 0 20px 0;">Fields in * are mandatory Fields</div>

      <?php echo $form->create(null, array('url'=>'/pages/prof_detail','id'=>'form2','name'=>'form2','onsubmit'=>'return validationc(this);')); ?>
	  <?php echo $form->hidden('Doctor.id',array('value'=>$this->data['Doctor']['id']));?>
        <div class="leftDivOne marTopNone">
        <div class="rowNext">
          <label>Services <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          <div class="rightDivForm">
          	<?php echo $form->text('Doctor.service1',array('placeholder'=>'Please Enter Your Services','class'=>'marTopNone'));?>
           	<?php echo $form->text('Doctor.service2',array('placeholder'=>'Please Enter Your Services'));?>
            <?php echo $form->text('Doctor.service3',array('placeholder'=>'Please Enter Your Services'));?>
            <?php echo $form->text('Doctor.service4',array('placeholder'=>'Please Enter Your Services'));?>
            <?php echo $form->text('Doctor.service5',array('placeholder'=>'Please Enter Your Services'));?>
          	<span id="msg1" style="color:#FF0000; float:left; clear:both;"></span>
          </div>
          
        </div>
        <div class="rowNext right">
          <label>Specializations <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          <div class="rightDivForm">
          	<select name="data[Doctor][specialization][]" multiple="multiple" class="smallTextBox" id="DoctorSpecialization">
				<option value="">Select max 5 Specialities</option>
				<?php foreach($specialization as $key => $val){?>
				<option value="<?php echo $val['Specialization']['id'];?>" <?php if(($this->data['Doctor']['special'][0] == $val['Specialization']['id']) || ($this->data['Doctor']['special'][1] == $val['Specialization']['id']) || ($this->data['Doctor']['special'][2] == $val['Specialization']['id']) || ($this->data['Doctor']['special'][3] == $val['Specialization']['id']) || ($this->data['Doctor']['special'][4] == $val['Specialization']['id'])) {?> selected="selected" <?php }?>><?php echo $val['Specialization']['drop_down_name'];?></option>
				<?php }?>
			</select>
          	
          </div>
          
        </div>
        </div>
        
        
         <div class="leftDivOne">
        <div class="rowNext">
          <label>Education <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          <div class="rightDivForm">
          	<?php echo $form->text('Doctor.education1',array('placeholder'=>'Please Enter Your Education','class'=>'marTopNone'));?>
           	<?php echo $form->text('Doctor.education2',array('placeholder'=>'Please Enter Your Education'));?>
           	<?php echo $form->text('Doctor.education3',array('placeholder'=>'Please Enter Your Education'));?>
            <?php echo $form->text('Doctor.education4',array('placeholder'=>'Please Enter Your Education'));?>
            <?php echo $form->text('Doctor.education5',array('placeholder'=>'Please Enter Your Education'));?>
          	<span id="msg3" style="color:#FF0000; float:left; clear:both;"></span>
          </div>
          
        </div>
        <div class="rowNext right">
          <label>Experience <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          <div class="rightDivForm">
          	<?php echo $form->text('Doctor.experience1',array('placeholder'=>'Please Enter Your Experience','class'=>'marTopNone'));?>
           	<?php echo $form->text('Doctor.experience2',array('placeholder'=>'Please Enter Your Experience'));?>
            <?php echo $form->text('Doctor.experience3',array('placeholder'=>'Please Enter Your Experience'));?>
            <?php echo $form->text('Doctor.experience4',array('placeholder'=>'Please Enter Your Experience'));?>
            <?php echo $form->text('Doctor.experience5',array('placeholder'=>'Please Enter Your Experience'));?>
          	<span id="msg4" style="color:#FF0000; float:left; clear:both;"></span>
          </div>
          
        </div>
        </div>
        
         <div class="leftDivOne">
        <div class="rowNext">
          <label>Awards &amp; Recognitions  </label>
          <div class="mid">:</div>
          <div class="rightDivForm">
          	<?php echo $form->text('Doctor.award1',array('placeholder'=>'Please Enter Your Awards and Recognitions','class'=>'marTopNone'));?>
           	<?php echo $form->text('Doctor.award2',array('placeholder'=>'Please Enter Your Awards and Recognitions'));?>
            <?php echo $form->text('Doctor.award3',array('placeholder'=>'Please Enter Your Awards and Recognitions'));?>
            <?php echo $form->text('Doctor.award4',array('placeholder'=>'Please Enter Your Awards and Recognitions'));?>
            <?php echo $form->text('Doctor.award5',array('placeholder'=>'Please Enter Your Awards and Recognitions'));?>
          	
          </div>
          
        </div>        
        <div class="rowNext right">
          <label>Memberships </label>
          <div class="mid">:</div>
          <div class="rightDivForm">
          	<?php echo $form->text('Doctor.member1',array('placeholder'=>'Please Enter Your Memberships','class'=>'marTopNone'));?>
			<?php echo $form->text('Doctor.member2',array('placeholder'=>'Please Enter Your Memberships'));?>
            <?php echo $form->text('Doctor.member3',array('placeholder'=>'Please Enter Your Memberships'));?>
            <?php echo $form->text('Doctor.member4',array('placeholder'=>'Please Enter Your Memberships'));?>
            <?php echo $form->text('Doctor.member5',array('placeholder'=>'Please Enter Your Memberships'));?>
          	
          </div>
          
        </div>
        </div>
        
 <div class="leftDivOne">       
<div class="rowNext">
          <label>Registrations</label>
          <div class="mid">:</div>
          <div class="rightDivForm">
          	<?php echo $form->text('Doctor.registration1',array('placeholder'=>'Please Enter Your Registrations','class'=>'marTopNone'));?>
           	<?php echo $form->text('Doctor.registration2',array('placeholder'=>'Please Enter Your Registrations'));?>
            <?php echo $form->text('Doctor.registration3',array('placeholder'=>'Please Enter Your Registrations'));?>
            <?php echo $form->text('Doctor.registration4',array('placeholder'=>'Please Enter Your Registrations'));?>
            <?php echo $form->text('Doctor.registration5',array('placeholder'=>'Please Enter Your Registrations'));?>
          	
          </div>
          
        </div>
  <div class="rowNext right">
          <label>Description <font color="#FF0000">*</font></label>
          <div class="mid">:</div>
          <div class="rightDivForm">
          	<?php echo $form->textarea('Doctor.own_desc',array('placeholder'=>'Please Enter About Yourself'));?>
          	<span id="msg5" style="color:#FF0000; float:left; clear:both;"></span>
          </div>
          
        </div>      
        
 </div>       
        
        <input type="image" src="<?php echo SITE_URL;?>img/submit-button.gif" alt="Submit" class="btn" />
     
      <?php echo $form->end();?>
      <div class="bottomShadow"></div>
    </div>
  </div>