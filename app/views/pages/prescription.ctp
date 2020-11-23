<style>
.flash_success{ color:green; text-align:center;}
.flash_failure{ color:red; text-align:center;}
</style>
<div class="contentcontainer">

	<div style="margin-left:25%;margin-top:20px;margin-right:25%;padding-bottom:20px;">
			<div class="headings altheading">
				<h2>Add Prescription Request</h2>
			</div>
			<div class="contentbox">
			<?php echo $this->Session->flash(); ?>	
			<?php echo $form->create(null, array('url'=>'/pages/prescription','id'=>'form1','name'=>'form1','enctype'=>'multipart/form-data')); ?>
			<?php echo $form->hidden('Health.login_type',array('value'=>$LoginType));?>
			<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%" id="PatientOtherInfo">

			<tr class="second">
				<td width="40%" class="boldText">Referred By<font color="#FF0000">*</font></td>
				<td  style=" height: 30px;">
					<?php echo $form->text('PrescriptionMaster.referred_by', array('class'=>'input-text','required'=>'required','style'=>'height: 30px;margin-bottom:10px;width:200px;')); ?>
				</td>
			</tr>
			
			<tr class="second" id="InputMemberName">
				<td width="40%" class="boldText">Patient First Name <font color="#FF0000">*</font></td>
				<td  style=" height: 30px;">
					<?php echo $form->text('PrescriptionMaster.first_name', array('class'=>'input-text','required'=>'required','style'=>'height: 30px;margin-bottom:10px;width:200px;')); ?>
				</td>
			</tr>
			
			<tr class="second" id="InputMemberName">
				<td width="40%" class="boldText">Patient Last Name <font color="#FF0000">*</font></td>
				<td  style=" height: 30px;">
					<?php echo $form->text('PrescriptionMaster.last_name', array('class'=>'input-text','required'=>'required','style'=>'height: 30px;margin-bottom:10px;width:200px;')); ?>
				</td>
			</tr>
			
			<tr class="second" id="InputMemberGender">
				<td width="40%" class="boldText">Gender of Patient <font color="#FF0000">*</font></td>
				<td  style=" height: 30px;">
					<select name="data[PrescriptionMaster][gender]" id="PrescriptionGender" class="input-text" required='required' style='height: 30px;margin-bottom:10px;width:200px;'>
						<option value="">Select Gender</option>
						<option value="1">Male</option>
						<option value="2">Female</option>
					</select>
					<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
				</td>
			</tr>
			
			<tr class="second" id="InputMemberAge">
				<td width="40%" class="boldText">Patient Age <font color="#FF0000">*</font></td>
				<td  style=" height: 30px;">
					<?php echo $form->text('PrescriptionMaster.age', array('class'=>'input-text','style'=>'width:50px;','required'=>'required','style'=>'height: 30px;margin-bottom:10px;width:200px;')); ?>
					<div id="msg3" style="color:#FF0000; font-size:12px;"></div>
				</td>
			</tr>
			
			<tr class="second" id="InputMemberContact">
				<td width="40%" class="boldText">Contact Number <font color="#FF0000">*</font></td>
				<td  style=" height: 30px;">
					<?php echo $form->text('PrescriptionMaster.contact_number', array('class'=>'input-text phone','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return checknum(event)','required'=>'required','style'=>'height: 30px;margin-bottom:10px;width:200px;')); ?>
					<div id="msg5" style="color:#FF0000; font-size:12px;"></div>
				</td>
			</tr>
			
			<tr class="second" id="InputMemberAltContact">
				<td width="40%" class="boldText">Alternate Contact Number</td>
				<td  style=" height: 30px;">
					<?php echo $form->text('PrescriptionMaster.alternate_contact', array('class'=>'input-text phone','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return checknum(event)','required'=>'required','style'=>'height: 30px;margin-bottom:10px;width:200px;')); ?>
				</td>
			</tr>
			
			<tr class="second" id="InputMemberEmail">
				<td width="40%" class="boldText">Email ID<font color="#FF0000">*</font></td>
				<td  style=" height: 30px;">
					<?php echo $form->text('PrescriptionMaster.email', array('class'=>'input-text','required'=>'required','style'=>'height: 30px;margin-bottom:10px;width:200px;')); ?>
				</td>
			</tr>
			
			<tr class="second">
				<td class="boldText">Remarks </td>
				<td  style=" height: 30px;">
					<?php echo $form->textarea('PrescriptionMaster.remarks', array('class'=>'input-text','rows'=>5,'cols'=>50,'style'=>'font-size:12px;','required'=>'required','style'=>'height: 30px;margin-bottom:10px;width:200px;')); ?>
					<div id="msg155" style="color:#FF0000; font-size:12px;"></div>
				</td>
			</tr>

			<tr class="first">
				<td width="40%" class="boldText">Prescription Files<font color="#FF0000">*</font></td>
				<td style=" height: 30px;">
					<div id="p_files" style="float:left">
						<input type="file" id="prescription_url1" name="prescription_url1" class="input-text" accept=".jpg,.png,.pdf,.PDF,.jpeg" style="margin-bottom:10px;width:200px;" required>
					</div>
					<a href="#" onclick="addmorefiles()" style="font-size:14px;float:left">+ Add More</a>
				</td>
			</tr>
			<tr class="first">
				<td width="40%">&nbsp;</td>
				<td  style=" height: 30px;">
					<div id="fileerror" style="display:none;color:red;font-size:13px;">Atleast select a Single File</div>
					<input value="Submit" type="button" name="upload_file" style="height: 30px;background: #a0d64a;color: #666;width:60px;" class="btn" id="upload" onclick="viewdetail();">
				</td>
			</tr>

			<tr class="second" id="submit_div">
				<td width="40%">&nbsp;</td>
				<td  style=" height: 30px;">
					<?php echo $form->submit('Save', array('div'=>false, 'class' => 'btn','id'=>'editupdate','style'=>'height: 30px;background: #a0d64a;color: #666;width:60px;')); ?>
					<?php echo $form->submit('Cancel', array('div'=>false, 'class' => 'btn','id'=>'editupdate','style'=>'height: 30px;background: #a0d64a;color: #666;width:60px;','onclick'=>'javascript:window.history.go(-1)')); ?>
					<!--<input text="Cancel" type="button" onclick="javascript:window.history.go(-1)" class="btn" style="height: 30px;color:#FFFFFF;background: #a0d64a;color: #666;width:60px;"/>-->
				</td>
			</tr>	



		</table>
	</div>	
<?php echo $form->end(); ?>
</div>
<style>
.second{ display:none; }
</style>
<script type="text/javascript">
	function viewdetail()
	{
		var html = $('#p_files');
		var count = html.length;
		var filecount = 0;
		
		for(var i=1;i<=count;i++)
		{
			console.log($('#prescription_url'+i).val());
			if($('#prescription_url'+i).val())
			{
				filecount = filecount+1;
			}
		}
		
		
		
		if(filecount>=1)
		{
			$('#fileerror').hide();
			$(".second").show();
			$(".first").hide();
		}
		else
		{
			$('#fileerror').show();
		}
	}
	
	function checknum(evt)
	{
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
	
	function addmorefiles()
	{
		var html = $('#p_files');
		var htmldata = $('#p_files').html();
		var count = html.length;
		count++;
		htmldata += "<br><input type='file' name='prescription_url"+count+"' id='prescription_url"+count+"' class='input-text' accept='.jpg,.png,.pdf,.PDF,.jpeg' style='margin-bottom:10px;width:200px;' required>";
		console.log(htmldata);
		$('#p_files').html(htmldata);
	}
	
	$(function(){
		$("input[type = 'submit']").click(function(){
		   var $fileUpload = $("input[type='file']");
		   if (parseInt($fileUpload.get(0).files.length) > 3){
			  alert("You are only allowed to upload a maximum of 3 files");
		   }
		});
	 });
</script>