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
document.getElementById("msg7").innerHTML="";
document.getElementById("msg9").innerHTML="";


if(document.form1.TestTestcode.value=='')
{
	document.getElementById("msg1").innerHTML="Please Enter Value";
	str=false;
}
if(document.form1.TestTestParameter.value=='')
{
	document.getElementById("msg2").innerHTML="Please Enter Value";
	str=false;
}
if(document.form1.TestReporting.value=='')
{
	document.getElementById("msg7").innerHTML="Please Enter Value";
	str=false;
}
if(document.form1.TestMrp.value=='')
{
	document.getElementById("msg9").innerHTML="Please Enter Value";
	str=false;
}
return str;
}


</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Add Service</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; Add Service
	<?php echo $form->create(null, array('url'=>'/admin/tests/add_service','onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1','enctype'=>'multipart/form-data')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Service Code</td>
		<td>
			<?php echo $form->text('Test.testcode', array('class'=>'input-text')); ?><span class="hint-class">(EX- S1234)</span>
			<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Service Parameter</td>
		<td>
			<?php echo $form->textarea('Test.test_parameter', array('class'=>'class-textarea')); ?><span class="hint-class">(EX- Patientcare service of ECG)</span>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Service Hours</td>
		<td>
			<?php echo $form->text('Test.reporting', array('class'=>'input-text')); ?><span class="hint-class">(EX- 48 Hrs,Next Day,Same day)</span>
			<div id="msg7" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>MRP</td>
		<td>
			<?php echo $form->text('Test.mrp', array('class'=>'input-text')); ?><span class="hint-class">(EX- 3250,2575)</span>
			<div id="msg9" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Brief Description</td>
		<td>
			<?php echo $form->textarea('Test.description', array('class'=>'class-textarea','style'=>'width:400px; height:100px;')); ?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Upload PDF</td>
		<td>
			<?php echo $form->file('Test.description_pdf',array());?>
		</td>
	</tr>
        <tr>
                <td width="15%" class="boldText">Category</td>
		<td>
                    <?php e($form->select('Test.profit_margin_category', $profit_category, null, array('class'=>'','empty'=>'Select Category'),null,false))?>
                </td>
        </tr>
     <tr>
		<td width="15%" class="boldText">Status</td>
		<td>
				<select name="data[Test][status]">
				<option value="">Select One</option>
				<option value="1">Activate</option>
				<option value="2">Deactivate</option>
			</select>
		</td>
	</tr>
	<tr>
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->submit('Submit', array('div'=>false, 'class' => 'btn')); ?>
			<!--<a onclick="javascript:window.history.go(-1)" class="btn" style="color:#FFFFFF;">Cancel</a>-->
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>
</div>