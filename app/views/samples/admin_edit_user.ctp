<script type="text/javascript">
$(document).ready(function(){
    $("#form1").submit(function(){
        if($("#AdminPassword1").val() != $("#AdminPassword2").val())
        {
            alert("Password mismatch");
            return false;
        }
    });
});
</script>
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
	if(val != 'A' && val != 'BM' && val != 'Agent' && val != 'Home')
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
		
	}
	$('#userType').html(user_type);
	$('#labId').html(lab_id);
	$('#labType').html(lab_type);
	$('#userValue').html(lab_value);
}
$(document).ready(function() {
	var curr_user = '<?php echo $this->data['Admin']['userType'];?>';
	
	if(curr_user != 'A' && curr_user != 'BM' && curr_user != 'Agent' && curr_user != 'Home')
	{
		var val_1 = '<?php echo $this->data['Admin']['userType'];?>';
		var val_2 = '<?php echo $this->data['Admin']['labId'];?>';
		var val_3 = '<?php echo $this->data['Admin']['labType'];?>';
		var val_4 = '<?php echo $this->data['Admin']['userValue'];?>';
		var user_type = '<input type="hidden" name="data[Admin][userType]" value="'+val_1+'">';
		var lab_id = '<input type="hidden" name="data[Admin][labId]" value="'+val_2+'">';
		var lab_type = '<input type="hidden" name="data[Admin][labType]" value="'+val_3+'">';
		var lab_value = '<input type="hidden" name="data[Admin][userValue]" value="'+val_4+'">';
		
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
		
	}
	$('#userType').html(user_type);
	$('#labId').html(lab_id);
	$('#labType').html(lab_type);
	$('#userValue').html(lab_value);
});
</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Edit User</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; Edit User
	<?php echo $form->create(null, array('url'=>'/admin/samples/edit_user/'.base64_encode($this->data['Admin']['id']),'onsubmit'=>'','id'=>'form1','name'=>'form1')); ?>
	<?php echo $form->hidden('Admin.id',array('value'=>$this->data['Admin']['id']));?>
	<?php echo $form->hidden('Admin.role',array('value'=>$this->data['Admin']['role']));?>
	<?php echo $form->hidden('Admin.status',array('value'=>$this->data['Admin']['status']));?>
	<?php echo $form->hidden('Admin.created',array('value'=>$this->data['Admin']['created']));?>
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
				<option value="A" <?php if($this->data['Admin']['userType'] == 'A') {?> selected="selected" <?php }?>>Super Admin</option>
				<option value="BM" <?php if($this->data['Admin']['userType'] == 'BM') {?> selected="selected" <?php }?>>Business Manager</option>
				<option value="Agent" <?php if($this->data['Admin']['userType'] == 'Agent') {?> selected="selected" <?php }?>>Helpdesk</option>
				<?php foreach($get_pcc_list as $key => $val) {?>
				<option value="<?php echo $val['Lab']['id'];?>,<?php echo $val['Lab']['pcc_lab_name'];?>,<?php echo $val['Lab']['pcc_lab_value'];?>" <?php if($this->data['Admin']['labId'] == $val['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $val['Lab']['pcc_name'];?></option>
				<?php }?>
				<option value="Home" <?php if($this->data['Admin']['userType'] == 'Home') {?> selected="selected" <?php }?>>Home Collection</option>
				<option value="DA" <?php if($this->data['Admin']['userType'] == 'DA') {?> selected="selected" <?php }?>>Doctor Admin</option>
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
		<td width="15%" class="boldText"><span class="error">*</span>Email</td>
		<td>
			<?php echo $form->text('Admin.email', array('class'=>'input-text')); ?>
			<div id="msg5" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>

        <tr>
		<td width="15%" class="boldText"><span class="error">*</span>Password</td>
		<td>
			<?php echo $form->password('Admin.password1', array('class'=>'input-text')); ?>
			<div id="msg5" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
        <tr>
		<td width="15%" class="boldText"><span class="error">*</span>Confirm Password</td>
		<td>
			<?php echo $form->password('Admin.password2', array('class'=>'input-text')); ?>
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
