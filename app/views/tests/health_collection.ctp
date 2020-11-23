<script language="JavaScript" type="text/javascript">
function IsCharacter(sText)
{
   	var ValidChars = ' ABC?DEFGHIJKLMN?OPQRSTUVWXYZabc?defghijklmn?opqrstuvwxyz????????????????????????';
   	var IsNumber=true;
   	var Char;
 	for (i = 0; i < sText.length && IsNumber == true; i++) 
    { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
      {
         IsNumber = false;
      }
    }
   	return IsNumber;
}
function validationc()
{
var str=true;
document.getElementById("msg1").innerHTML="";
document.getElementById("msg2").innerHTML="";
document.getElementById("msg3").innerHTML="";
document.getElementById("msg8").innerHTML="";
document.getElementById("msg9").innerHTML="";
document.getElementById("msg12").innerHTML="";
document.getElementById("msg13").innerHTML="";
//document.getElementById("msg15").innerHTML="";
document.getElementById("msg102").innerHTML="";
document.getElementById("msg103").innerHTML="";
document.getElementById("msg104").innerHTML="";
document.getElementById("msg105").innerHTML="";
document.getElementById("msg106").innerHTML="";
document.getElementById("msg107").innerHTML="";
document.getElementById("msg99").innerHTML="";


if(document.form1.HealthName.value=='Please Enter Your name')
{
	document.getElementById("msg1").innerHTML="Please Enter Your name";
	str=false;
}
//else if(IsCharacter(document.form1.HealthName.value)==false)
//{
//	document.getElementById("msg1").innerHTML="Please Enter Your Valid Name";
//	str=false;
//}
if(document.form1.HealthGender.value=='')
{
	document.getElementById("msg2").innerHTML="Please Select Your gender";
	str=false;
}
if(document.form1.HealthAge.value=='Please Enter Your age')
{
	document.getElementById("msg3").innerHTML="Please Enter Your age";
	str=false;
}
else if(document.form1.HealthAge.value.length>3)
{
	document.getElementById("msg3").innerHTML="Age must be between 1 to 3 digits";
	str=false;
}
else if(isNaN(document.form1.HealthAge.value))
{
	document.getElementById("msg3").innerHTML="Please Enter Valid Age";
	str=false;
}
if(document.form1.HealthRemarks.value == 'Please enter your remarks')
{
	document.getElementById("msg9").innerHTML="Please enter your remarks";
	str=false;
}
if(document.form1.HealthRemark.value == 'Please Enter Your Refferal')
{
	document.getElementById("msg8").innerHTML="Please Enter Your Refferal";
	str=false;
}
if( document.getElementById("beforeQue1").style.display=="block")
{
	//if( ( document.form1.HealthCityLab1[0].checked == false ) && ( document.form1.HealthCityLab1[1].checked == false ) && ( document.form1.HealthCityLab1[2].checked == false ) )
//	{
//		document.getElementById("msg15").innerHTML="Please select a Lab Location";
//		str=false;
//	}
	if( document.form1.HealthSampleTime.value == '' )
	{
 		document.getElementById("msg12").innerHTML="Please select the suitable time";
		str=false;
	}
	else if(isNaN(document.form1.HealthSampleTime.value))
	{
		document.getElementById("msg12").innerHTML="Please Enter Valid sample Time";
		str=false;
	}
	if( document.form1.HealthSampleDate.value == 'Please select a suitable date')
	{
 		document.getElementById("msg13").innerHTML="Please select a suitable date";
		str=false;
	}
}

if( document.getElementById("firstQuestion").style.display=="block")
{	
	if( document.form1.HealthCityId.value == '')
	{
		document.getElementById("msg102").innerHTML="Please select city";
		str=false;
	}
	if( document.form1.HealthAddress1.value == 'Please enter your residential address')
	{
		document.getElementById("msg103").innerHTML="Please enter your residential address";
		str=false;
	}
	if( document.form1.HealthState.value == '')
	{
		document.getElementById("msg104").innerHTML="Please select state";
		str=false;
	}
	if( document.form1.HealthLocality.value == 'Please enter locality')
	{
		document.getElementById("msg105").innerHTML="Please enter locality";
		str=false;
	}
	if( document.form1.HealthPincode.value == 'Please enter pincode')
	{
		document.getElementById("msg106").innerHTML="Please enter pincode";
		str=false;
	}
	if( document.form1.HealthLandmark.value == 'Please enter your landmark')
	{
		document.getElementById("msg107").innerHTML="Please enter your landmark";
		str=false;
	}
}	
if(document.form1.HealthLandline.value=='Please Enter Your mobile number')
{
	document.getElementById("msg99").innerHTML="Please Enter Your mobile number";
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
	document.getElementById('HomeCol').innerHTML = '<input type="hidden" name="data[Health][selecttype]" value="homecollection">';
}
	
function  openQueBefore1()
{
	document.getElementById('firstQuestion').style.display='none';
	document.getElementById('beforeQue1').style.display='block';
}
 </script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/jquery/ui-lightness/admin/jquery-ui.css" />

<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery/jquery.ui.js"></script>
<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		minDate: 0,
		maxDate: '+6M',
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker1" ).datepicker({
		minDate: 0,
		maxDate: '+6M',
		dateFormat: 'dd-mm-yy'
	});
});
</script>




<div class="banner"><?php echo $this->Html->image('frontend/niramaya_company-overview_static.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
  <!--Header:End--> 
  
  <!--Body Part:Start-->
   <div id="bodyPart" class="inner_nir_page">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home"><a href="<?php echo SITE_URL;?>pages/index">Home Page</a></div>
          <div class="bread"><?php echo $this->Html->link('Health Collection','/tests/health_collection');?></div>
        </div>
        <div class="back right"><a href="<?php print $_SERVER['HTTP_REFERER'];?>">Back</a></div>
      </div>
<h1>Booking <span class="green">Request</span></h1>
<div id="advanceSearch"><h4>Search / Book a Test</h4>
			  <?php echo $form->create(null, array('url'=>'/tests/search_keyword_home','id'=>'form1','name'=>'form1')); ?>
			  <?php echo $form->text('Search.test_search',array('placeholder'=>'Type Keyword...'));?>
			  <input type="image" src="<?php echo SITE_URL;?>img/frontend/go.jpg" class="go" style="cursor:pointer;" />
			  <div class="or">Or</div>
			  <div class="advanceSearch"><a href="<?php echo SITE_URL;?>tests/search" style="color:#EE8012;">Advance Search</a></div>
			  <?php echo $form->end();?>
		  </div>
<?php echo $this->Session->flash(); ?>
    <div class="greenText">Please Provide The Details Below</div>
	<div><a href="<?php echo SITE_URL;?>tests/book_for_self"><?php echo $html->image('frontend/book_test_for_self_button.jpg');?></a></div>
    <?php echo $form->create(null, array('url'=>'#','id'=>'form1','name'=>'form1','class'=>'bookForm','onsubmit'=>'return validationc(this);')); ?>
	
    <div id="HomeCol"></div>
	
    <div class="boxRow"><label>Patient Name</label>
    <?php echo $form->text('Health.name',array('value'=>'Please Enter Your name','onblur'=>'if(this.value=="")this.value="Please Enter Your name"',' onfocus'=>'if(this.value=="Please Enter Your name")this.value="";')); ?>
    <span id="msg1"></span>
    </div>
    <div class="boxRow"><label>Patient Gender</label>
    <select name="data[Health][gender]" class="smallSelectBox" id="HealthGender">
		<option value="">Please Select Your Gender</option>
		<?php foreach($gender as $key => $val) {?>
		<option value="<?php echo $val['Gender']['id'];?>"><?php echo $val['Gender']['name'];?></option>
		<?php }?>
	</select>  
    <label class="smalllabel">Patient Age</label>
    <?php echo $form->text('Health.age', array('class'=>'smallTextBox','value'=>'Please Enter Your age','onblur'=>'if(this.value=="")this.value="Please Enter Your age"',' onfocus'=>'if(this.value=="Please Enter Your age")this.value="";')); ?>
    <span id="msg2"></span>
    <span id="msg3" style="margin-left:437px; margin-top: -14px;"></span>
    </div>
	<div class="boxRow"><label>Contact</label>
    <?php echo $form->text('Health.landline', array('value'=>'Please Enter Your mobile number','onblur'=>'if(this.value=="")this.value="Please Enter Your mobile number"',' onfocus'=>'if(this.value=="Please Enter Your mobile number")this.value="";')); ?> 
	<span id="msg99"></span>
    </div>
    <div class="boxRow"><label>Remarks</label>
    <?php echo $form->textarea('Health.remarks', array('class'=>'textarea','value'=>'Please enter your remarks','onblur'=>'if(this.value=="")this.value="Please enter your remarks"',' onfocus'=>'if(this.value=="Please enter your remarks")this.value="";','rows'=>5,'cols'=>30)); ?> 
    <span id="msg9"></span>
	</div>
	
	<div class="boxRow"><label>Refered By</label>
    <?php echo $form->text('Health.remark', array('class'=>'smallTextBox','value'=>'Please Enter Your Refferal','onblur'=>'if(this.value=="")this.value="Please Enter Your Refferal"',' onfocus'=>'if(this.value=="Please Enter Your Refferal")this.value="";')); ?>
    <span id="msg8" style="margin-top: 30px; margin-left: -212px;"></span>
  </div>
   
   <div class="greenText01">Choose Sample collection Option</div>
   <div class="chooseDiv">
   <div class="optDiv marLeftNone"><input type="radio" name="opt" onclick="openQueBefore1();" id="visit"/><span>Visit a Lab</span></div>
   <div class="optDiv borderNone"><input type="radio" name="opt" onclick="showMail();" id="home"/><span>Home Collection</span></div>
   
   </div>
   
   <div class="formBox borderNone" id="firstQuestion" style="display:none">
   <p>Please select a date and time for Collection of Sample. Our representative will come to the address mention above.</p>
   <div class="boxRow"><label>Time</label>
   
   

   
   <?php echo $form->input('Health.sample_time1',array('type'=>'select','options'=>$time1,'empty'=>'Please select a suitable time','class'=>'smallSelectBox','label'=>false)); ?>
   <label class="smalllabel">Date</label>
   <?php echo $form->text('Health.sample_date1', array('class'=>'smallTextBox datepicker1','value'=>'Please select a suitable date','onblur'=>'if(this.value=="")this.value="Please select a suitable date"',' onfocus'=>'if(this.value=="Please select a suitable date")this.value="";')); ?>
    <span id="msg9"></span>
	<span id="msg10" style="margin-left: 154px;"></span>
    
    
    </div>
   
   
   
   
    <div class="boxRow">
    <label>Address</label>
    <?php echo $form->text('Health.address1', array('class'=>'smallTextBox','value'=>'Please enter your residential address','onblur'=>'if(this.value=="")this.value="Please enter your residential address"',' onfocus'=>'if(this.value=="Please enter your residential address")this.value="";')); ?>
    
	
	<label class="smalllabel">City</label>
    <?php echo $form->input('Health.city_id',array('type'=>'select','options'=>$city,'empty'=>'Please select city','class'=>'smallSelectBox','label'=>false)); ?>
	<span id="msg102" style="margin-left: 92px;"></span>
    </div>
	<div class="boxRow">
    <label>&nbsp;</label>
    <?php echo $form->text('Health.address2', array('class'=>'smallTextBox','value'=>'Please enter your residential address','onblur'=>'if(this.value=="")this.value="Please enter your residential address"',' onfocus'=>'if(this.value=="Please enter your residential address")this.value="";')); ?>
    
	
	<label class="smalllabel">State</label>
    <?php echo $form->input('Health.state',array('type'=>'select','options'=>$state,'empty'=>'Please select state','class'=>'smallSelectBox','label'=>false)); ?>
	<span id="msg103"></span>
	<span id="msg104" style="margin-left: 124px;"></span>
    </div>
	<div class="boxRow">
    <label>Locality</label>
    <?php echo $form->text('Health.locality', array('class'=>'smallTextBox','value'=>'Please enter locality','onblur'=>'if(this.value=="")this.value="Please enter locality"',' onfocus'=>'if(this.value=="Please enter locality")this.value="";')); ?>
    
	
	<label class="smalllabel">Pincode</label>
     <?php echo $form->text('Health.pincode', array('class'=>'smallTextBox','value'=>'Please enter pincode','onblur'=>'if(this.value=="")this.value="Please enter pincode"',' onfocus'=>'if(this.value=="Please enter pincode")this.value="";')); ?>
	 <span id="msg105"></span>
	<span id="msg106" style="margin-left: 208px;"></span>
    </div>
	<div class="boxRow">
    <label>Landmark</label>
    <?php echo $form->text('Health.landmark', array('class'=>'smallTextBox','value'=>'Please enter your landmark','onblur'=>'if(this.value=="")this.value="Please enter your landmark"',' onfocus'=>'if(this.value=="Please enter your landmark")this.value="";')); ?>
    
	
	<label class="smalllabel">&nbsp;</label>
	
	<span id="msg107" style="clear:both;"></span>
    </div>
	
    <div class="boxRow"><?php echo $form->submit('', array('div'=>false, 'class' => 'right')); ?></div> 
    <!--<div class="boxRow"><img src="common/images/submit-button.gif" class="right" alt="Submit" /></div>-->
    
    </div>
    
          
          <div id="beforeQue1" style="display:none">
           <div class="chooseDiv">
           
           
           
           
           
    <?php $f = 1; foreach($pcc as $key => $val) {?>        
   <div class="optDiv <?php if($f%2 == 0) {?>borderNone<?php }else {?>marLeftNone<?php }?>"><input type="radio" name="data[Health][city]" id="HealthCityLab1" value="<?php echo $val['Lab']['id'];?>"/><span><?php echo $val['Lab']['pcc_name'];?></span>
   <p class="addBoxIn"><?php echo nl2br($val['Lab']['pcc_address']);?></p>
   </div>
   <?php $f++;}?>           
           
   <!--<div class="optDiv marLeftNone"><input type="radio" name="data[Health][city]" id="HealthCityLab1" value="Crossing Republic"/><span>Crossing Republic</span>
   <p class="addBoxIn">Shop No. 08, LGF, Crossing Plaza,<br/>
Crossing Republic, Ghaziabad
</p>
   </div>
   <div class="optDiv borderNone"><input type="radio" name="data[Health][city]" id="HealthCityLab1" value="Indirapuram"/><span>Indirapuram</span>
   <p class="addBoxIn">Shop No. 05 & 06, Lotus Plaza, Vaibahv Khand,<br/>
Indirapuram, Ghaziabad
</p>
   
   </div>
   <div class="optDiv marLeftNone"><input type="radio" name="data[Health][city]" id="HealthCityLab1" value="Noida"/><span>Noida patient care centre</span>
   <p class="addBoxIn">Sector -31, Next to IMA House & Blood Bank,<br/>
						Noida
	</p>
   </div>
   <span1 id="msg15" style="margin-left: 26px; clear:both;"></span>-->
   </div>
  
   <div class="boxRow"><label>Time</label>
  
   
   <?php echo $form->input('Health.sample_time',array('type'=>'select','options'=>$time,'empty'=>'Please select a suitable time','class'=>'smallSelectBox','label'=>false)); ?>
    <label class="smalllabel">Date</label>
    <?php echo $form->text('Health.sample_date', array('class'=>'smallTextBox datepicker','value'=>'Please select a suitable date','onblur'=>'if(this.value=="")this.value="Please select a suitable date"',' onfocus'=>'if(this.value=="Please select a suitable date")this.value="";')); ?>
    <span id="msg12"></span>
	<span id="msg13" style="margin-left: 154px;"></span>
    
    
    </div>
  
    <!--<div class="boxRow"><img src="common/images/submit-button.gif" class="right" alt="Submit" /></div>-->
         <div class="boxRow"><?php echo $form->submit('', array('div'=>false, 'class' => 'right')); ?></div> 
    </div>
    <?php echo $form->end(); ?>
    
    <div class="right">
    <?php echo $this->Html->image('frontend/call_us_vertical.jpg',array('alt'=>'Img'))?>
    
    
    
    
    
    
       
     
          
          
          
      
      </div>
      <?php //echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
      
      
      
      </div>