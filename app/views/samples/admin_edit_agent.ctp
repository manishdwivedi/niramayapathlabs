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
	
	
	if(document.form1.AgentName.value=='')
	{
		document.getElementById("msg1").innerHTML="Please enter agent name";
		str=false;
	}
	var validate_char= /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(!document.form1.AgentEmail.value.match(validate_char))
	{
		document.getElementById("msg2").innerHTML="Please enter valid email address";
		str=false;
	}
	if(isNaN(document.form1.AgentContact.value))
	{
		document.getElementById("msg3").innerHTML="Please Insert Numeric Mobile No.";
		str = false;
	}
	else if(document.form1.AgentContact.value.length<10)
	{
		document.getElementById("msg3").innerHTML="Please Insert Valid Mobile No.";
    	str = false;
	}
	if(document.form1.AgentAddress.value=='')
	{
		document.getElementById("msg4").innerHTML="Please enter address";
		str=false;
	}
	if(document.form1.AgentCity.value=='')
	{
		document.getElementById("msg5").innerHTML="Please select city";
		str=false;
	}
	if(document.form1.AgentUsername.value=='')
	{
		document.getElementById("msg100").innerHTML="Please enter agent login username";
		str=false;
	}
	return str;
}
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Edit Agent</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; <?php echo $html->link('Manage Agent(s)', '/admin', array('title'=>'Manage Agent(s)')); ?> &#187; Edit Agent
	<?php echo $form->create(null, array('url'=>'/admin/samples/edit_agent','onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1','enctype'=>'multipart/form-data')); ?>
	<?php echo $form->hidden('Agent.id',array('value'=>$this->data['Agent']['id']));?>
	<?php echo $form->hidden('Agent.status',array('value'=>$this->data['Agent']['status']));?>
	<?php echo $form->hidden('Agent.add_date',array('value'=>$this->data['Agent']['add_date']));?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Agent Name <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Agent.name', array('class'=>'input-text')); ?>
			<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Login Username <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Agent.username', array('class'=>'input-text')); ?>
			<div id="msg100" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Role<font color="#FF0000">*</font></td>
		<td>
			<select name="data[Agent][role]" id="AgentRole" class="input-text">
				<?php foreach($agent_type as $key => $val) {?>
				<option value="<?php echo $key;?>" <?php if($this->data['Agent']['role']==$key) echo "selected";?>><?php echo $val;?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Email <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Agent.email', array('class'=>'input-text')); ?>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Contact <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Agent.contact', array('class'=>'input-text','onkeypress'=>'return checknum(event)')); ?>
			<div id="msg3" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<script type="text/javascript">

		function checknum(evt)
		{
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;
		}

	</script>
	<tr>
		<td width="15%" class="boldText">Address <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->textarea('Agent.address', array('class'=>'class-textarea')); ?>
			<div id="msg4" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">City <font color="#FF0000">*</font></td>
		<td>
			<select name="data[Agent][city]" id="AgentCity" class="input-text">
				<option value="">Select City</option>
				<?php foreach($city_list as $key => $val) {?>
				<option value="<?php echo $val['City']['id'];?>" <?php if($this->data['Agent']['city'] == $val['City']['id']) {?> selected="selected" <?php }?>><?php echo $val['City']['name'];?></option>
				<?php }?>
			</select>
			<div id="msg5" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
        <tr>
		<td width="15%" class="boldText">Status <font color="#FF0000">*</font></td>
		<td>
			<select name="data[Agent][status]" id="AgentStatus" class="input-text">
				<?php if($this->data['Agent']['status'] == 1){ ?>
                                    <option selected value="1">Active</option>
                                    <option value="2">Deactive</option>
                                <?php } else { ?>
                                    <option value="1">Active</option>
                                    <option selected value="2">Deactive</option>
                                <?php } ?>
                        </select>

		</td>
	</tr>
	<tr>
		<td colspan="3">
			<div class="headings altheading">
				<h2>Add Document</h2>
			</div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Photo</td>
		<td>
			<?php if(!empty($this->data['AgentDoc']['display_pic'])){ ?>
			<a target="_blank" href="/files/agent_doc/<?php echo $this->data['AgentDoc']['display_pic']; ?>" id="display_pic">View</a>
			<?php } else
			 { echo "No Document"; }
			 ?>
			<input type="button" onclick="show_upload('display_pic')" name="Change" value="Change" class="btn" style="margin-left:20px;" id="display_pic_change">
			<input id="display_pic_upload" type="file" style="display:none;" name="data[AgentDoc][display_pic]" class="input-text" accept=".jpg,.png,.jpeg">
			<input type="button" onclick="hide_upload('display_pic')" name="Cancel" value="Cancel" class="btn" style="display:none;margin-left:20px;" id="display_pic_cancel">
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Educational Qualification</td>
		<td>
			<?php if(!empty($this->data['AgentDoc']['metric_doc'])){
			$metric_doc = explode(',',$this->data['AgentDoc']['metric_doc']);
			foreach($metric_doc as $val) { ?>
			<a target="_blank" href="/files/agent_doc/<?php echo $val; ?>" id="metric_doc">View</a>
			<?php } } else
			 { echo "No Document"; }
			 ?>
			<input type="button" onclick="show_upload('metric_doc')" name="Change" value="Change" class="btn" style="margin-left:20px;" id="metric_doc_change">
			<input id="metric_doc_upload" type="file" style="display:none;" name="data[AgentDoc][metric_doc][]" class="input-text" accept=".jpg,.png,.pdf,.PDF,.jpeg" multiple>
			<input type="button" onclick="hide_upload('metric_doc')" name="Cancel" value="Cancel" class="btn" style="display:none;margin-left:20px;" id="metric_doc_cancel">
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">KYC</td>
		<td>
			<?php if(!empty($this->data['AgentDoc']['intermediate_doc'])){
			$intermediate_doc = explode(',',$this->data['AgentDoc']['intermediate_doc']);
			foreach($intermediate_doc as $val) { ?>
			<a target="_blank" href="/files/agent_doc/<?php echo $val; ?>" id="intermediate_doc">View</a>
			<?php } } else
			 { echo "No Document"; }
			 ?>
			<input type="button" onclick="show_upload('intermediate_doc')" name="Change" value="Change" class="btn" style="margin-left:20px;" id="intermediate_doc_change">
			<input id="intermediate_doc_upload" type="file" style="display:none;" name="data[AgentDoc][intermediate_doc][]" class="input-text" accept=".jpg,.png,.pdf,.PDF,.jpeg" multiple>
			<input type="button" onclick="hide_upload('intermediate_doc')" name="Cancel" value="Cancel" class="btn" style="display:none;margin-left:20px;" id="intermediate_doc_cancel">
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Experience</td>
		<td>
			<?php if(!empty($this->data['AgentDoc']['experience_doc'])){
			$experience_doc = explode(',',$this->data['AgentDoc']['experience_doc']);
			foreach($experience_doc as $val) { ?>
			<a target="_blank" href="/files/agent_doc/<?php echo $this->data['AgentDoc']['experience_doc']; ?>" id="experience_doc">View</a>
			 <?php } } else
			 { echo "No Document"; }
			 ?>
			<input type="button" onclick="show_upload('experience_doc')" name="Change" value="Change" class="btn" style="margin-left:20px;" id="experience_doc_change">
			<input id="experience_doc_upload" type="file" style="display:none;" name="data[AgentDoc][experience_doc][]" class="input-text" accept=".jpg,.png,.pdf,.PDF,.jpeg" multiple>
			<input type="button" onclick="hide_upload('experience_doc')" name="Cancel" value="Cancel" class="btn" style="display:none;margin-left:20px;" id="experience_doc_cancel">
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>
</div>
<script>
function show_upload(e)
{
	$('#'+e).hide();
	$('#'+e+"_change").hide();
	$('#'+e+"_upload").show();
	$('#'+e+"_cancel").show();
}

function hide_upload(e)
{
	$('#'+e).show();
	$('#'+e+"_change").show();
	$('#'+e+"_upload").hide();
	$('#'+e+"_cancel").hide();
}

</script>