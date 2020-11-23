<style type="text/css">
.class-textarea
{
	border: 1px solid #999999;
    border-radius: 3px 3px 3px 3px;
    color: #666666;
    margin-bottom: 5px;
    padding: 10px;
    width: 300px;
	font-size:13px;
}

.hint-class
{
	color:#999999; 
	font-size:11px; 
	padding:0 0 0 10px;
}
</style>

<script language="JavaScript" type="text/javascript">
function validationc()
{
	var str=true;
	document.getElementById("msg1").innerHTML="";
	document.getElementById("msg2").innerHTML="";
	document.getElementById("msg3").innerHTML="";
	document.getElementById("msg5").innerHTML="";
	document.getElementById("msg6").innerHTML="";
	
	
	if(document.form1.HealthName.value=='')
	{
		document.getElementById("msg1").innerHTML="Please Enter First Name";
		str=false;
	}
	if(document.form1.HealthGender.value=='')
	{
		document.getElementById("msg2").innerHTML="Please Select Gender";
		str=false;
	}
	if(document.form1.HealthAge.value=='')
	{
		document.getElementById("msg3").innerHTML="Please Enter Age";
		str=false;
	}
	if(isNaN(document.form1.HealthLandline.value))
	{
		document.getElementById("msg5").innerHTML="Please Insert Numeric Mobile No.";
		str = false;
	}
	else if(document.form1.HealthLandline.value.length<10)
	{
		document.getElementById("msg5").innerHTML="Please Insert Valid Mobile No.";
    	str = false;
	}
	else{}
	var validate_char= /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(!document.form1.HealthEmail.value.match(validate_char))
	{
		document.getElementById("msg6").innerHTML="Please Enter a valid email address";
		str=false;
	}
	
	
	return str;
}
</script>


<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		minDate: 0,
		maxDate: '+6M',
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker2" ).datepicker({
		minDate: 0,
		maxDate: '+6M',
		dateFormat: 'dd-mm-yy'
	});
});
</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>TRF Form</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/samples/index', array('title'=>'Home')); ?>&#187;Add Sample Request
	<?php echo $form->create(null, array('url'=>'/admin/samples/trf_form','id'=>'form1','name'=>'form1')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Patient Name <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.name', array('class'=>'input-text')); ?>
			<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Gender <font color="#FF0000">*</font></td>
		<td>
			<select name="data[Health][gender]" id="HealthGender" class="input-text">
				<option value="">Select Gender</option>
				<option value="1">Male</option>
				<option value="2">Female</option>
			</select>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Age <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.age', array('class'=>'input-text','style'=>'width:50px;')); ?>
			<div id="msg3" style="color:#FF0000; font-size:12px;"></div>

		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Address</td>
		<td>
			<?php echo $form->textarea('Health.address1', array('class'=>'class-textarea')); ?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Contact Number <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.landline', array('class'=>'input-text')); ?>
			<div id="msg5" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Email ID <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.email', array('class'=>'input-text')); ?>
			<div id="msg6" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<!--<tr>
		<td width="15%" class="boldText">Remarks</td>
		<td>
			<?php //echo $form->textarea('Health.remarks', array('class'=>'class-textarea')); ?>
		</td>
	</tr>-->
	<tr>
		<td width="15%" class="boldText">Tests</td>
		<td>
			<select name="data[Health][test_id][]" id="HealthTestId" class="input-text" multiple="multiple">
				<option value="">Select Test</option>
				<?php foreach($tests as $key => $val) {?>
				<option value="<?php echo $val['Test']['id'];?>"><?php echo $val['Test']['test_parameter'];?></option>
				<?php }?>
			</select>
			
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Profiles</td>
		<td>
			<select name="data[Health][profile_id][]" id="HealthProfileId" class="input-text" multiple="multiple">
				<option value="">Select Profile</option>
				<?php foreach($profiles as $key => $val) {?>
				<option value="<?php echo $val['Test']['id'];?>"><?php echo $val['Test']['test_parameter'];?></option>
				<?php }?>
			</select>
			
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Referred By</td>
		<td>
			<?php echo $form->text('Health.remark', array('class'=>'input-text')); ?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Sample Collect Status</td>
		<td>
			<input type="radio" name="opt" id="visit" value="1" onclick="show_lab(this.value);" />Visit a Lab<br />
			<input type="radio" name="opt" id="home" value="2" onclick="show_lab(this.value);" />Home Collection<br />
		</td>
	</tr>
	<tr id="visit_lab_1" style="display:none;">
		<td width="15%" class="boldText">Select Center</td>
		<td>
			<input type="radio" name="data[Health][city]" id="HealthCityLab1" value="Crossing Republic" /> <strong>Crossing Republic</strong><br />
			<span style="margin:0px 0px 0px 24px;">Shop No. 08, LGF, Crossing Plaza,</span><br />
			<span style="margin:0px 0px 0px 24px;">Crossing Republic, Ghaziabad</span><br /><br />
			
			<input type="radio" name="data[Health][city]" id="HealthCityLab1" value="Indirapuram" /> <strong>Indirapuram</strong><br />
			<span style="margin:0px 0px 0px 24px;">Shop No. 05 & 06, Lotus Plaza, Vaibahv Khand,</span><br />
			<span style="margin:0px 0px 0px 24px;">Indirapuram, Ghaziabad</span><br /><br />
			
			<input type="radio" name="data[Health][city]" id="HealthCityLab1" value="Noida"/><strong>Noida patient care centre</strong><br />
			<span style="margin:0px 0px 0px 24px;">Sector -31, Next to IMA House & Blood Bank,</span><br />
			<span style="margin:0px 0px 0px 24px;">Noida</span>
		</td>
	</tr>
	<tr id="visit_lab_2" style="display:none;">
		<td width="15%" class="boldText">Time</td>
		<td>
			<select name="data[Health][sample_time]" id="HealthSampleTime" class="input-text">
				<option value="">Select Test</option>
				<?php foreach($timelabs as $key => $val) {?>
				<option value="<?php echo $val['Timelab']['id'];?>"><?php echo $val['Timelab']['name'];?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr id="visit_lab_3" style="display:none;">
		<td width="15%" class="boldText">Sample Collect Date</td>
		<td>
			<?php echo $form->text('Health.sample_date', array('class'=>'input-text datepicker2','style'=>'width:100px;')); ?>
		</td>
	</tr>
	
	
	<tr id="home_collection_1" style="display:none;">
		<td width="15%" class="boldText">&nbsp;</td>
		<td>Please select a date and time for Collection of Sample. Our representative will come to the address mention above.</td>
	</tr>
	<tr id="home_collection_2" style="display:none;">
		<td width="15%" class="boldText">Time</td>
		<td>
			<select name="data[Health][sample_time1]" id="HealthSampleTime1" class="input-text">
				<option value="">Select Test</option>
				<?php foreach($timelabs as $key => $val) {?>
				<option value="<?php echo $val['Timelab']['id'];?>"><?php echo $val['Timelab']['name'];?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr id="home_collection_3" style="display:none;">
		<td width="15%" class="boldText">Sample Collect Date</td>
		<td>
			<?php echo $form->text('Health.sample_date1', array('class'=>'input-text datepicker','style'=>'width:100px;')); ?>
		</td>
	</tr>
	<tr id="home_collection_4" style="display:none;">
		<td width="15%" class="boldText">Address</td>
		<td>
			<?php echo $form->textarea('Health.address', array('class'=>'class-textarea')); ?>
		</td>
	</tr>
	
	<tr id="submit_div" style="display:none;">
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
			<a onclick="javascript:window.history.go(-1)" class="btn" style="color:#FFFFFF;">Cancel</a>
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>
</div>