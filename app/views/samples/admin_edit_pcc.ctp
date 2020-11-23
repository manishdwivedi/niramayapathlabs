<style type="text/css">

.td { 
	border-bottom-style: solid;
    border-width: thin;
    border-color: black;
}

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

function assign()
{
	$('#pincode_list').show();
}

function hide_pin()
{
	$('#pincode_list').hide();
}

function notification()
{
	var checkBox = document.getElementById("LabSendPushNotification");
	
	if (checkBox.checked == true){
		$('#LabCallUrlNotification').removeAttr('disabled');
		$('#LabCallUrlNotification').css('background','white');
		
		$('#LabAuthCodeNotification').removeAttr('disabled');
		$('#LabAuthCodeNotification').css('background','white');
    } else {
		$('#LabCallUrlNotification').attr('disabled','true');
		$('#LabCallUrlNotification').css('background','lightgray');
		
		$('#LabAuthCodeNotification').attr('disabled','true');
		$('#LabAuthCodeNotification').css('background','lightgray');
    }
}

function branch()
{
	var client_type = document.getElementById("LabClientType").value;
	
	if (client_type == "B"){
		$('#parent_lab').removeAttr('disabled');
		$('#parent_lab').css('background','white');
    } else {
		$('#parent_lab').attr('disabled','true');
		$('#parent_lab').css('background','lightgray');
    }
}

function validationc()
{

var str=true;
document.getElementById("msg1").innerHTML="";
document.getElementById("msg2").innerHTML="";
document.getElementById("msg3").innerHTML="";

if(document.form1.LabPccName.value=='')
{
	document.getElementById("msg1").innerHTML="Please enter PCC name";
	str=false;
}
if(document.form1.LabPccAddress.value=='')
{
	document.getElementById("msg2").innerHTML="Please enter PCC address";
	str=false;
}
var validate_char= /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
var validate_num = /^[0]?[789]\d{9}$/;
if(!document.form1.LabPccReportEmail.value.match(validate_char))
{
document.getElementById("msg3").innerHTML="Please Enter a valid email address";
str=false;
}
if(!document.form1.LabPccReportContact.value.match(validate_num))
{
	document.getElementById("msg200").innerHTML="Please enter PCC contact number";
	str=false;
}

if(!document.form1.LabPccCustomerServiceEmail.value.match(validate_char))
{
	document.getElementById("mesg3").innerHTML="Please Enter a valid email address";
	str=false;
}
if(!document.form1.LabPccCustomerServiceNumber.value.match(validate_num))
{
	document.getElementById("mesg200").innerHTML="Please enter PCC contact number";
	str=false;
}

if(document.form1.ApiAuthorization.value.length < 8 )
{
	document.getElementById("msgAuth").innerHTML="Authorization Code must be atleast 8 characters long";
	str=false;
}

return str;
}
</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Edit PCC</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; Edit PCC
	<?php echo $form->create(null, array('url'=>'/admin/samples/edit_pcc/'.base64_encode($this->data['Lab']['id']),'onsubmit'=>'return validationc();','id'=>'form1','name'=>'form1','enctype'=>'multipart/form-data')); ?>
	<?php echo $form->hidden('Lab.id',array('value'=>$this->data['Lab']['id']));?>
	<?php echo $form->hidden('Lab.status',array('value'=>$this->data['Lab']['status']));?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>PCC Name</td>
		<td>
			<?php echo $form->text('Lab.pcc_name', array('class'=>'input-text')); ?>
			<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	
	
	
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Lab Name</td>
		<td>
			<?php echo $form->text('Lab.pcc_lab_name', array('class'=>'input-text')); ?>
			<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>PCC Code</td>
		<td>
			<?php echo $form->text('Lab.pcc_lab_value', array('class'=>'input-text')); ?>
			<div id="msg200" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>PCC Reporting Email</td>
		<td>
			<?php echo $form->text('Lab.pcc_email', array('class'=>'input-text')); ?>
			<div id="msg3" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>PCC Contact</td>
		<td>
			<?php echo $form->text('Lab.pcc_contact', array('class'=>'input-text','onkeypress'=>'return checknum(event)')); ?>
			<div id="msg200" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>PCC Customer Service Email</td>
		<td>
			<?php echo $form->text('Lab.pcc_customer_service_email', array('class'=>'input-text')); ?>
			<div id="mesg3" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>PCC Customer Service Contact</td>
		<td>
			<?php echo $form->text('Lab.pcc_customer_service_number', array('class'=>'input-text','onkeypress'=>'return checknum(event)')); ?>
			<div id="mesg200" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>MIS Report Email</td>
		<td>
			<?php echo $form->text('Lab.mis_report_email', array('class'=>'input-text')); ?><span style="margin-left:10px;">(Add Email seperated by comma except for main PCC Email)</span>
			<div id="mesg3" style="color:#FF0000; font-size:12px;"></div>
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
		<td width="15%" class="boldText"><span class="error">*</span>PCC Address</td>
		<td>
			<?php echo $form->textarea('Lab.pcc_address', array('class'=>'input-text','rows'=>5,'cols'=>30,'style'=>'font-size:12px;')); ?>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Center Id</td>
		<td>
			<?php echo $form->text('Lab.center_id', array('class'=>'input-text')); ?>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Registration Number</td>
		<td>
			<?php echo $form->text('Lab.registration_number', array('class'=>'input-text')); ?>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error"></span>Lab Authorization Code</td>
		<td>
			<?php echo $form->text('Api.authorization', array('class'=>'input-text')); ?><span style="margin-left:10px;">(Authurization Code should be minimum 8 Character alphanumeric)</span>
			<div id="msgAuth" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>API KEY</td>
		<td>
			<?php echo $form->text('Lab.api_key', array('class'=>'input-text')); ?>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>API User</td>
		<td>
			<?php echo $form->text('Lab.api_user', array('class'=>'input-text')); ?>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Send Status Notification To PCC</td>
		<td>
			<?php echo $form->checkbox('Lab.send_push_notification', array('class'=>'','onclick'=>'notification()')); ?>
			<div id="" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Call URL for Notification</td>
		<td>
			<?php echo $form->text('Lab.call_url_notification', array('class'=>'input-text','disabled'=>'true','style'=>'background:lightgray;')); ?>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Authorization Code for Notification</td>
		<td>
			<?php echo $form->text('Lab.auth_code_notification', array('class'=>'input-text','disabled'=>'true','style'=>'background:lightgray;')); ?>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Serviced By API</td>
		<td>
			<select name="data[Lab][serviced_by_api]" id="labRate" class="input-text">
				<option> Select Serviced API </option>
				<?php foreach($serviceapi as $key => $val) {?>
				<option value="<?php echo $key;?>" <?php if($this->data['Lab']['serviced_by_api']==$key) echo "selected";?>><?php echo $val;?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Client Type</td>
		<td>
			<select name="data[Lab][client_type]" id="LabClientType" class="input-text" onchange="branch()" required>
				<option value=""> Select Type </option>
				<option value="B" <?php if($this->data['Lab']['client_type']=='B') echo "selected"; ?>>Branch</option>
				<option value="C" <?php if($this->data['Lab']['client_type']=='C') echo "selected"; ?>>Client</option>
			</select>
			<div id="msg_ctype" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Branch PCC</td>
		<td>
			<select name="data[Lab][parent_pcc_id]" id="parent_lab" class="input-text" <?php if($this->data['Lab']['client_type']=='C') echo 'disabled'; ?> style="background:<?php if($this->data['Lab']['client_type']=='C') echo 'lightgray'; ?>" required>
				<option value=""> Select a PCC </option>
				<?php foreach($lablist as $key => $val) {?>
				<option value="<?php echo $key;?>" <?php if($this->data['Lab']['parent_pcc_id']==$key) echo "selected"; ?>><?php echo $val;?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Booking Patient Type</td>
		<td>
			<select name="data[Lab][pcc_type]" id="booking_p_type" class="input-text">
				<option value=""> Select Booking Patient Type </option>
				<option value="individual" <?php if($this->data['Lab']['pcc_type']=="individual") echo "selected";?>> Individual </option>
				<option value="corporate" <?php if($this->data['Lab']['pcc_type']=="corporate") echo "selected";?>> Corporate </option>
			</select>
		</td>
	</tr>
    <tr>
		<td width="15%" class="boldText"><span class="error">*</span>Show in frontend</td>
		<td>
			<?php echo $form->checkbox('Lab.show_to_world', array('class'=>'')); ?>
			<div id="" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Send Daily Request Report</td>
		<td>
			<?php echo $form->checkbox('Lab.send_daily_request_report', array('class'=>'')); ?>
			<div id="" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
    <tr>
		<td width="15%" class="boldText"><span class="error">*</span>Send Report To PCC</td>
		<td>
			<?php echo $form->checkbox('Lab.send_report_mail', array('class'=>'')); ?>
			<div id="" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Mail Report To Patient and CC to Pcc</td>
		<td>
			<?php echo $form->checkbox('Lab.send_report_mail_patient', array('class'=>'')); ?>
			<div id="" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
    <tr>
		<td width="15%" class="boldText"><span class="error">*</span>Send SMS For New Request</td>
		<td>
			<?php echo $form->checkbox('Lab.send_sms_to_patient', array('class'=>'')); ?>
			<div id="" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Report Upload SMS</td>
		<td>
			<?php echo $form->checkbox('Lab.report_upload_sms', array('class'=>'')); ?>
			<div id="" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Confirm Agent SMS</td>
		<td>
			<?php echo $form->checkbox('Lab.confirm_agent_sms', array('class'=>'')); ?>
			<div id="" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Auto Assign Phlebo</td>
		<td>
			<?php echo $form->checkbox('Lab.auto_assign_phlebo', array('class'=>'')); ?>
			<div id="" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Auto BTC Orders</td>
		<td>
			<?php echo $form->checkbox('Lab.auto_btc', array('class'=>'')); ?>
			<div id="" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Auto Smart Reports</td>
		<td>
			<?php echo $form->checkbox('Lab.auto_smart_report', array('class'=>'')); ?>
			<div id="" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
    <tr>
		<td width="15%" class="boldText"><span class="error">*</span>Use Custom Header</td>
		<td>
			<?php echo $form->checkbox('Lab.custom_header_status', array('class'=>'')); ?>
			<div id="" style="color:#FF0000; font-size:12px;"></div>
			<?php echo $form->file('Lab.custom_header',array('class'=>'input-text'));?>
		</td>
	</tr>
    <tr>
		<td width="15%" class="boldText"><span class="error">*</span>Custom Header File</td>
		<td class="boldText" name="custom_header_name"><?php echo $this->data['Lab']['custom_header']; ?></td>
	</tr>
	<tr>
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->submit('Update', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>

<hr></hr>
<input type="button" id="assigned_pincode" onclick="assign()" class="btn" value="Asssign Pincode">
<div id="pincode_list" style="display:none;">
	<?php echo $form->create(array('url'=>'/admin/samples/lab_pincode/'.base64_encode($this->data['Lab']['id']),'id'=>'form_pin','name'=>'form_pin','enctype'=>'multipart/form-data'));?>
		<table border="0" width="100%">
			<tr>
				<td class="headings altheading" style="border:0;" colspan="4"><h2>Pincode List Upload</h2></td>
			</tr>
			<tr>
				<td><input type="hidden" name="category" id="category" value="<?php echo $id; ?>"></td>
			</tr>
			<tr>
				<td width="100px;">Select file</td>
				<td><input type="file" name="file" id="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" class="btn" name="submit" />
					<input type="button" class="btn" name="cancel" value="Cancel" onclick="hide_pin();"/>
				</td>
			</tr>
		</table>
	</form>
	</br>
	</br>
	<label style="color:red;font-size:11px;">*Uploaded Excel Format</label>
	<table style="border-radius: 5px;border-style: solid;border-width: thin;">
		<tr>
			<th class="td" style="border-width: thin;">Pincode</th>
		</tr>
		<tr>
			<td class="td" style="border-width: thin;">110001</td>
		</tr>
		<tr>
			<td class="td" style="border-width: thin;">110002</td>
		</tr>
		<tr>
			<td style="border-width: thin;">110003</td>
		</tr>
	</table>
</div> 

</div>
<script>
$(document).ready(function() {
	$('#LabCustomHeader').hide();
    //set initial state.
    $('#LabCustomHeaderStatus').change(function() {
        if($(this).is(":checked")) {
            $('#LabCustomHeader').show();
        }
		else
		{
			$('#LabCustomHeader').hide();
		}
    });	
});
</script>

