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


if(document.form1.SampleName.value=='')
{
	document.getElementById("msg1").innerHTML="Please Enter Name";
	str=false;
}
if(isNaN(document.form1.SampleMobile.value))
{
	document.getElementById("msg2").innerHTML="Please Insert Numeric Mobile No.";
	str = false;
}
else if(document.form1.SampleMobile.value.length<10)
{
	document.getElementById("msg2").innerHTML="Please Insert Valid Mobile No.";
	str = false;
}
else
{}	
var validate_char= /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
if(!document.form1.SampleEmail.value.match(validate_char))
{
	document.getElementById("msg3").innerHTML="Please Enter a valid email address";
	str=false;
}
if(document.form1.SampleAddress.value=='')
{
	document.getElementById("msg4").innerHTML="Please Enter Address";
	str=false;
}
if(document.form1.SampleCityId.value=='')
{
	document.getElementById("msg5").innerHTML="Please Select City";
	str=false;
}
if(document.form1.SampleTestId.value=='')
{
	document.getElementById("msg6").innerHTML="Please Select Test";
	str=false;
}
if(document.form1.SampleSampleDate.value=='')
{
	document.getElementById("msg7").innerHTML="Please Select Date";
	str=false;
}

return str;
}
</script>

<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		minDate: 0,
		maxDate: '+30D',
		dateFormat: 'dd-mm-yy'
	});
});
</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Add Sample Request</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/users/index', array('title'=>'Home')); ?>&#187;Add Sample Request
	<?php echo $form->create(null, array('url'=>'/admin/samples/edit_request','onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1')); ?>
	<?php echo $form->hidden('Sample.id',array('value'=>$this->data['Sample']['id']));?>
	<?php echo $form->hidden('Sample.login_pass',array('value'=>$this->data['Sample']['login_pass']));?>
	<?php echo $form->hidden('Sample.add_date',array('value'=>$this->data['Sample']['add_date']));?>
	<?php echo $form->hidden('Sample.status',array('value'=>$this->data['Sample']['status']));?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Name</td>
		<td>
			<?php echo $form->text('Sample.name', array('class'=>'input-text')); ?><span class="hint-class">(Ex: Rahul Singhal) </span>
			<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Landline</td>
		<td>
			<?php echo $form->text('Sample.landline', array('class'=>'input-text')); ?><span class="hint-class"> (Ex: 011- 63456734)</span>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Mobile</td>
		<td>
			<?php echo $form->text('Sample.mobile', array('class'=>'input-text')); ?><span class="hint-class"> (Ex: 9811514367) </span>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Email</td>
		<td>
			<?php echo $form->text('Sample.email', array('class'=>'input-text')); ?><span class="hint-class">(Ex: abc@gmail.com)</span>
			<div id="msg3" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Address</td>
		<td>
			<?php echo $form->textarea('Sample.address', array('class'=>'class-textarea')); ?>
			<div id="msg4" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>City</td>
		<td>
			<select name="data[Sample][city_id]" id="SampleCityId" class="input-text">
				<option value="">Select City</option>
				<?php foreach($city as $key => $val) {?>
				<option value="<?php echo $val['City']['id'];?>" <?php if($val['City']['id'] == $this->data['Sample']['city_id']) {?> selected="selected" <?php }?>><?php echo $val['City']['name'];?></option>
				<?php }?>
			</select>
			<div id="msg5" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Test</td>
		<td>
			<select name="data[Sample][test_id]" id="SampleTestId" class="input-text">
				<option value="">Select Test</option>
				<?php foreach($tests as $key => $val) {?>
				<option value="<?php echo $val['Test']['id'];?>" <?php if($val['Test']['id'] == $this->data['Sample']['test_id']) {?> selected="selected" <?php }?>><?php echo $val['Test']['test_parameter'];?></option>
				<?php }?>
			</select>
			<div id="msg6" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">DOB</td>
		<td>
			<?php echo $form->text('Sample.DOB', array('class'=>'input-text','style'=>'width:100px;')); ?><span class="hint-class">(EX- 05-10-1987)</span>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Sample Collect Date</td>
		<td>
			<?php echo $form->text('Sample.sample_date', array('class'=>'input-text datepicker','style'=>'width:100px;')); ?>
			<div id="msg7" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	
	
	<tr>
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
			<a onclick="javascript:window.history.go(-1)" class="btn" style="color:#FFFFFF;">Cancel</a>
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>
</div>