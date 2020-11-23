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
document.getElementById("msg4").innerHTML="";
document.getElementById("msg5").innerHTML="";



if(document.form1.UserFor.value=='')
{
	document.getElementById("msg1").innerHTML="Please select user for";
	str=false;
}
if(document.form1.AdminName.value=='')
{
	document.getElementById("msg2").innerHTML="Please enter name";
	str=false;
}
if(document.form1.AdminUserName.value=='')
{
	document.getElementById("msg3").innerHTML="Please enter login username";
	str=false;
}
if(document.form1.AdminPassword.value=='')
{
	document.getElementById("msg4").innerHTML="Please enter login password";
	str=false;
}
var validate_char= /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
if(!document.form1.AdminEmail.value.match(validate_char))
{
document.getElementById("msg5").innerHTML="Please enter a valid email address";
str=false;
}

return str;
}

function set_lab_value(val)
{
	if(val != 'A' && val != 'BM' && val != 'Agent' && val != 'Home' && val != 'DA')
	{
		var datum = val.split(',');
		var user_type = '<input type="hidden" name="data[Admin][userType]" value="'+datum[2]+'">';
		var lab_id = '<input type="hidden" name="data[Admin][labId]" value="'+datum[0]+'">';
		var lab_type = '<input type="hidden" name="data[Admin][labType]" value="'+datum[1]+'">';
		var lab_value = '<input type="hidden" name="data[Admin][userValue]" value="'+datum[2]+'">';
		
	}
	else
	{
		if(val == 'A')
		{
			var user_type = '<input type="hidden" name="data[Admin][userType]" value="A">';
			var lab_id = '<input type="hidden" name="data[Admin][labId]" value="0">';
			var lab_type = '<input type="hidden" name="data[Admin][labType]" value="">';
			var lab_value = '<input type="hidden" name="data[Admin][userValue]" value="">';
		}
		if(val == 'BM')
		{
			var user_type = '<input type="hidden" name="data[Admin][userType]" value="BM">';
			var lab_id = '<input type="hidden" name="data[Admin][labId]" value="0">';
			var lab_type = '<input type="hidden" name="data[Admin][labType]" value="">';
			var lab_value = '<input type="hidden" name="data[Admin][userValue]" value="">';
		}
		if(val == 'Agent')
		{
			var user_type = '<input type="hidden" name="data[Admin][userType]" value="Agent">';
			var lab_id = '<input type="hidden" name="data[Admin][labId]" value="0">';
			var lab_type = '<input type="hidden" name="data[Admin][labType]" value="">';
			var lab_value = '<input type="hidden" name="data[Admin][userValue]" value="">';
		}
		if(val == 'Home')
		{
			var user_type = '<input type="hidden" name="data[Admin][userType]" value="Home">';
			var lab_id = '<input type="hidden" name="data[Admin][labId]" value="'+datum[0]+'">';
			var lab_type = '<input type="hidden" name="data[Admin][labType]" value="Home">';
			var lab_value = '<input type="hidden" name="data[Admin][userValue]" value="Home">';
		}
		if(val == 'DA')
		{
			var user_type = '<input type="hidden" name="data[Admin][userType]" value="DA">';
			var lab_id = '<input type="hidden" name="data[Admin][labId]" value="0">';
			var lab_type = '<input type="hidden" name="data[Admin][labType]" value="">';
			var lab_value = '<input type="hidden" name="data[Admin][userValue]" value="">';
		}
		
	}
	$('#userType').html(user_type);
	$('#labId').html(lab_id);
	$('#labType').html(lab_type);
	$('#userValue').html(lab_value);
}
</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Create New User</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; Create New User
	<?php echo $form->create(null, array('url'=>'/admin/samples/add_user','onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1')); ?>
	<div id="LabValue" style="display:none;">
		<div id="userType"></div>
		<div id="labId"></div>
		<div id="labType"></div>
		<div id="userValue"></div>
	</div>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>User For</td>
		<td>
			<select name="" onchange="set_lab_value(this.value);" style="color:#666666;" id="UserFor">
				<option value="">Select One</option>
				<option value="A">Super Admin</option>
				<option value="BM">Business Manager</option>
				<!--<option value="Agent">Helpdesk</option>-->
				<option value="D">DeActivated</option>
				<?php foreach($get_pcc_list as $key => $val) {?>
				<option value="<?php echo $val['Lab']['id'];?>,<?php echo $val['Lab']['pcc_lab_name'];?>,<?php echo $val['Lab']['pcc_lab_value'];?>"><?php echo $val['Lab']['pcc_name'];?></option>
				<?php }?>
				<!--<option value="Home">Home Collection</option>-->
				<option value="DA">Doctor Admin</option>
			</select>
			<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Name</td>
		<td>
			<?php echo $form->text('Admin.name', array('class'=>'input-text')); ?>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Login Username</td>
		<td>
			<?php echo $form->text('Admin.userName', array('class'=>'input-text')); ?>
			<div id="msg3" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Login Password</td>
		<td>
			<?php echo $form->text('Admin.password', array('class'=>'input-text')); ?>
			<div id="msg4" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Email</td>
		<td>
			<?php echo $form->text('Admin.email', array('class'=>'input-text')); ?>
			<div id="msg5" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	
	
	<tr>
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>
</div>
