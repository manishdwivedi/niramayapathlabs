<script language="JavaScript" type="text/javascript">
function validationc()
{
var str=true;
document.getElementById("msg1").innerHTML="Please Enter Patient Name.";
document.getElementById("msg2").innerHTML="Please Select Your Gender";
document.getElementById("msg3").innerHTML="Please Enter Your Age";
document.getElementById("msg4").innerHTML="Please Enter Your Address";
document.getElementById("msg5").innerHTML="Please Enter Your Contact No.";
document.getElementById("msg6").innerHTML="Please Enter Your Email ID";
document.getElementById("msg7").innerHTML="Please Select Add More Test.";
document.getElementById("msg8").innerHTML="Please write The Dr Name In case not Self.";
document.getElementById("msg9").innerHTML="Please Enter Time";
document.getElementById("msg10").innerHTML="Please Enter Date";
document.getElementById("msg11").innerHTML="Please Enter Your Address";
document.getElementById("msg12").innerHTML="Please Select Time";
document.getElementById("msg13").innerHTML="Please Enter Date";

if(document.form1.HealthName.value=='')
{
	document.getElementById("msg1").innerHTML="Please Enter Name";
	str=false;
}
if(document.form1.TestTestParameter.value=='')
{
	document.getElementById("msg2").innerHTML="Please Select Gender";
	str=false;
}
if(document.form1.HealthAge.value=='')
{
	document.getElementById("msg3").innerHTML="Please Enter Age";
	str=false;
}
if(document.form1.HealthAddress1.value=='')
{
	document.getElementById("msg4").innerHTML="Please Enter Address";
	str=false;
}
if(document.form1.HealthLandline.value=='')
{
	document.getElementById("msg5").innerHTML="Please Enter Contact No.";
	str=false;
}
if(document.form1.HealthEmail.value=='')
{
	document.getElementById("msg6").innerHTML="Please Enter Email";
	str=false;
}
if(document.form1.TestReporting.value=='')
{
	document.getElementById("msg7").innerHTML="Please Select Multiple Test name";
	str=false;
}
if(document.form1.HealthRemark.value=='')
{
	document.getElementById("msg8").innerHTML="Please Enter Refer by";
	str=false;
}
if(document.form1.HealthSampleTime1.value=='')
{
	document.getElementById("msg9").innerHTML="Please Enter Home Collection Time";
	str=false;
}
if(document.form1.HealthSampleDate1.value=='')
{
	document.getElementById("msg10").innerHTML="Please Enter Home Collection Date";
	str=false;
}
if(document.form1.HealthAddress.value=='')
{
	document.getElementById("msg11").innerHTML="Please Enter Home Collection Address";
	str=false;
}
if(document.form1.HealthSampleTime1.value=='')
{
	document.getElementById("msg12").innerHTML="Please Enter Lab Time";
	str=false;
}
if(document.form1.HealthSampleDate.value=='')
{
	document.getElementById("msg13").innerHTML="Please Enter Lab Date";
	str=false;
}

return str;
}
</script>


<script type="application/javascript">
 function showMail()
{
document.getElementById('beforeQue1').style.display='none'	
document.getElementById('firstQuestion').style.display='block';
	}
	
	function  openQueBefore1()
{
document.getElementById('firstQuestion').style.display='none';
document.getElementById('beforeQue1').style.display='block';

}
 </script>
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
          <div class="home">Home Page</div>
          <div class="bread"><?php echo $this->Html->link('Health Collection','/tests/health_collection');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
<h1>Book <span class="green">A Test</span></h1>
<?php echo $this->Session->flash(); ?>
    <div class="greenText">You have opted for <b><?php echo strtoupper($test_name);?></b></div>
    <?php echo $form->create(null, array('url'=>'#','id'=>'form1','name'=>'form1','class'=>'bookForm','onsubmit'=>'return validationc(this);')); ?>
    
    
    
    <div class="boxRow"><label>Patient Name</label>
    <?php echo $form->text('Health.name', array('value'=>'Please Enter Patient Name.','onblur'=>'if(this.value=="")this.value="Please Enter Patient Name."',' onfocus'=>'if(this.value=="Please Enter Patient Name.")this.value="";')); ?>
    <div id="msg1" style="color:#FF0000; font-size:12px;"></div>
    </div>
    <div class="boxRow"><label>Select Gender</label>
    <select name="data[Health][gender]" class="smallSelectBox">
				<option value="">Please Select Your Gender</option>
				<?php foreach($gender as $key => $val) {?>
				<option value="<?php echo $val['Gender']['id'];?>"><?php echo $val['Gender']['name'];?></option>
				<?php }?>
			</select>  
    <div id="msg2" style="color:#FF0000; font-size:12px;"></div>
    
    
    
    
    
    <label class="smalllabel">Age</label>
    <?php echo $form->text('Health.age', array('class'=>'smallTextBox','value'=>'Please Enter Your Age','onblur'=>'if(this.value=="")this.value="Please Enter Your Age"',' onfocus'=>'if(this.value=="Please Enter Your Age")this.value="";')); ?>
    <div id="msg3" style="color:#FF0000; font-size:12px;"></div>
    </div>
    <div class="boxRow"><label>Address</label>
    <?php echo $form->textarea('Health.address1', array('value'=>'Please Enter Your Address','onblur'=>'if(this.value=="")this.value="Please Enter Your Address"',' onfocus'=>'if(this.value=="Please Enter Your Address")this.value="";')); ?>
    <div id="msg4" style="color:#FF0000; font-size:12px;"></div>
    </div>
    <div class="boxRow"><label>Contact Number</label>
    <?php echo $form->text('Health.landline', array('class'=>'smallTextBox','value'=>'Please Enter Your Contact No.','onblur'=>'if(this.value=="")this.value="Please Enter Your Contact No."',' onfocus'=>'if(this.value=="Please Enter Your Contact No.")this.value="";')); ?>
    <div id="msg5" style="color:#FF0000; font-size:12px;"></div>
    <label class="smalllabel">Email ID</label>
    <?php echo $form->text('Health.email', array('class'=>'smallTextBox','value'=>'Please Enter Your Email ID','onblur'=>'if(this.value=="")this.value="Please Enter Your Email ID"',' onfocus'=>'if(this.value=="Please Enter Your Email ID")this.value="";')); ?>
      <div id="msg6" style="color:#FF0000; font-size:12px;"></div>
    </div>
    <div class="boxRow"><label>Add more test to list</label>
    <select name="data[Health][test_id][]" multiple="multiple" style="height:70px;">
				<option value="">Please Select Add More Test.</option>
				<?php foreach($tests as $key => $val) {?>
				<option value="<?php echo $val['Test']['id'];?>"><?php echo $val['Test']['test_parameter'];?></option>
				<?php }?>
			</select>  
    <div id="msg7" style="color:#FF0000; font-size:12px;"></div>
    
    
      
    
    </div>
    <div class="boxRow"><label>Refered By</label>
    <?php echo $form->text('Health.remark', array('value'=>'Please write The Dr Name In case not Self.','onblur'=>'if(this.value=="")this.value="Please write The Dr Name In case not Self."',' onfocus'=>'if(this.value=="Please write The Dr Name In case not Self.")this.value="";')); ?>
    <div id="msg8" style="color:#FF0000; font-size:12px;"></div>
  </div>
   
   <div class="greenText01">Choose Sample collection Option</div>
   <div class="chooseDiv">
   <div class="optDiv marLeftNone"><input type="radio" name="opt" onclick="openQueBefore1();"/><span>Visit a Lab</span></div>
   <div class="optDiv borderNone"><input type="radio" name="opt" onclick="showMail();"/><span>Home Collection</span></div>
   
   </div>
   
   <div class="formBox borderNone" id="firstQuestion" style="display:none">
   <p>Please select a date and time for Collection of Sample. Our representative will come to the address mention above.</p>
   <div class="boxRow"><label>Time</label>
   <?php echo $form->text('Health.sample_time1', array('class'=>'smallTextBox','value'=>'Please Enter Time','onblur'=>'if(this.value=="")this.value="Please Enter Time"',' onfocus'=>'if(this.value=="Please Enter Time")this.value="";')); ?>
   <div id="msg9" style="color:#FF0000; font-size:12px;"></div>
   <!--<select name="data[Health][sample_time1]" class="smallSelectBox">
				<option value="">Please Select Time</option>
				<?php foreach($times as $key => $val) {?>
				<option value="<?php echo $val['Timelab']['id'];?>"><?php echo $val['Timelab']['name'];?></option>
				<?php }?>
			</select>  -->
    
    <label class="smalllabel">Date</label>
    <?php echo $form->text('Health.sample_date1', array('class'=>'smallTextBox','value'=>'Please Enter Date','onblur'=>'if(this.value=="")this.value="Please Enter Date"',' onfocus'=>'if(this.value=="Please Enter Date")this.value="";')); ?>
    <div id="msg10" style="color:#FF0000; font-size:12px;"></div>
    
    
    </div>
   
   
   
   
    <div class="boxRow">
    <label>Address</label>
    <?php echo $form->textarea('Health.address', array('value'=>'Please Enter Your Address','onblur'=>'if(this.value=="")this.value="Please Enter Your Address"',' onfocus'=>'if(this.value=="Please Enter Your Address")this.value="";')); ?>
    <div id="msg11" style="color:#FF0000; font-size:12px;"></div>
    </div>
    <div class="boxRow"><?php echo $form->submit('', array('div'=>false, 'class' => 'right')); ?></div> 
    <!--<div class="boxRow"><img src="common/images/submit-button.gif" class="right" alt="Submit" /></div>-->
    
    </div>
    
          
          <div id="beforeQue1" style="display:none">
           <div class="chooseDiv">
           
           
           
           
           
           
           
   <div class="optDiv marLeftNone"><input type="radio" name="data[Health][city]" id="HealthCityLab1" value="Crossing Republic"/><span>Crossing Republic</span>
   <p class="addBoxIn">Shop No. 08, LGF, Crossing Plaza,<br/>
Crossing Republic, Ghaziabad
</p>
   </div>
   <div class="optDiv borderNone"><input type="radio" name="data[Health][city]" id="HealthCityLab2" value="Indirapuram"/><span>Indirapuram</span>
   <p class="addBoxIn">Shop No. 05 & 06, Lotus Plaza, Vaibahv Khand,<br/>
Indirapuram, Ghaziabad
</p>
   
   </div>
   
   </div>
  
   <div class="boxRow"><label>Time</label>
   <select name="data[Health][sample_time]" class="smallSelectBox">
				<option value="">Please Select Time</option>
				<?php foreach($time as $key => $val) {?>
				<option value="<?php echo $val['Time']['id'];?>"><?php echo $val['Time']['name'];?></option>
				<?php }?>
			</select>  
    <div id="msg12" style="color:#FF0000; font-size:12px;"></div>
    <label class="smalllabel">Date</label>
    <?php echo $form->text('Health.sample_date', array('class'=>'smallTextBox','value'=>'Please Enter Date','onblur'=>'if(this.value=="")this.value="Please Enter Date"',' onfocus'=>'if(this.value=="Please Enter Date")this.value="";')); ?>
    
    <div id="msg13" style="color:#FF0000; font-size:12px;"></div>
    
    </div>
  
    <!--<div class="boxRow"><img src="common/images/submit-button.gif" class="right" alt="Submit" /></div>-->
         <div class="boxRow"><?php echo $form->submit('', array('div'=>false, 'class' => 'right')); ?></div> 
    </div>
    <?php echo $form->end(); ?>
    
    <div class="right" style="position: absolute; left: 900px; top: 332px;">
    <?php echo $this->Html->image('frontend/call_us_vertical.jpg',array('alt'=>'Img'))?>
    
    
    
    
    
    
       
     
          
          
          
      
      </div>
      <?php //echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
      
      
      
      </div>