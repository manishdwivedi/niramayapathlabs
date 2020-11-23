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



if(document.form1.PackagePackageCode.value=='')
{
	document.getElementById("msg1").innerHTML="Please Enter Value";
	str=false;
}
if(document.form1.PackageProfileTests.value=='')
{
	document.getElementById("msg2").innerHTML="Please Enter Value";
	str=false;
}


return str;
}
</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Add Package</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/users/index', array('title'=>'Home')); ?>&#187;Add Package
	<?php echo $form->create(null, array('url'=>'/admin/packages/add_package','onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
	</tr>
	<tr>
		<td class="boldText"><span class="error">*</span>Package Code</td>
		<td>
			<?php echo $form->text('Package.package_code', array('class'=>'input-text')); ?><span class="hint-class">(EX- P090)</span>
			<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td class="boldText"><span class="error">*</span>Profiles and Tests</td>
		<td>
			<?php echo $form->textarea('Package.profile_tests', array('class'=>'class-textarea')); ?><span class="hint-class">(EX- Diabetes Monitoring Panel)</span>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td class="boldText">Wholebody Health Checkup</td>
		<td>
			<input type="radio" name="data[Package][wholebody]" value="1"  />Yes<br />
			<input type="radio" name="data[Package][wholebody]" value="0"  />No
		</td>
	</tr>
	<tr>
		<td class="boldText">Executive Health Checkup</td>
		<td>
			<input type="radio" name="data[Package][executive]" value="1"  />Yes<br />
			<input type="radio" name="data[Package][executive]" value="0"  />No
		</td>
	</tr>
	<tr>
		<td class="boldText">Executiveplus Health Checkup</td>
		<td>
			<input type="radio" name="data[Package][executiveplus]" value="1"  />Yes<br />
			<input type="radio" name="data[Package][executiveplus]" value="0"  />No
		</td>
	</tr>
	<tr>
		<td class="boldText">Cancer Health Checkup</td>
		<td>
			<input type="radio" name="data[Package][cancer]" value="1"  />Yes<br />
			<input type="radio" name="data[Package][cancer]" value="0"  />No
		</td>
	</tr>
	
	<tr>
		<td>&nbsp;</td>
		<td>
			<?php echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
			<a onclick="javascript:window.history.go(-1)" class="btn" style="color:#FFFFFF;">Cancel</a>
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>
</div>