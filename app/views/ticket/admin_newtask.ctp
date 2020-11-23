<style>
.recur {
	display:none;
}
</style>
<script>
$(function() {
	$( ".datepicker" ).datepicker({
		minDate: '+2D',
		maxDate: '+30D',
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker2" ).datepicker({
		minDate: '+1D',
		maxDate: '+30D',
		dateFormat: 'dd-mm-yy'
	});
});

function checkphone(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;
	
	if(charCode > 31 && (charCode < 48 || charCode > 57)){
		console.log('----'+charCode);
		return false;
	} else {
		if($('#ProcessingLabsPhoneNumber').val().length<10)
			return true;
		else
			return false;
	}
}

function getcategory()
{
	var category = $('#category').val();
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'ticket/get_category_detail?cat='+category,
		success:function(response){
			console.log(response.checklist);
			if(response.checklist != undefined)
			{
				$('#checklist').show();
				var checks = response.checklist.split("@@@");
				checks.forEach(mycheckFunction);
			}
			else
			{
				$('#checklist').hide();
				$('#checklistdata').html("");
			}

			if(response.required_docs != undefined)
			{
				$('#doclist').show();
				var docs = response.required_docs.split("@@@");
				docs.forEach(mydocFunction);
			}
			else
			{
				$('#doclist').hide();
				$('#doclistdata').html("");
			}
		},
		dataType:"json"
	});
}

function mycheckFunction(item, index) {
	var gethtml = $('#checklistdata').html();
  	var html = gethtml+"<li>"+item+"</li>";
  	$('#checklistdata').html(html);
}

function mydocFunction(item, index) {
  	var gethtml = $('#doclistdata').html();
  	var html = gethtml+"<li>"+item+"</li>";
  	$('#doclistdata').html(html);
}

function submit_ticket(){
	var healthId = $('#HealthRequestId').val();
	
	$data = $('#form10').serialize();
	var error=0;
	if($("#priority").val() == 'r')
	{
		if($("#TicketFromDate").val() == '')
		{
			$("#ticket_from_date_error").html("From Date cannot be Empty");
			error++;
		}

		if($("#TicketToDate").val() == '')
		{
			$("#ticket_to_date_error").html("To Date Cannot Be Empty");
			error++;
		}
	}
			
	if($("#TicketTickettitle").val() == '')
	{
		$("#tickettitle_error").html("Title cannot be empty");
		error++;
	}
	else
		$("#tickettitle_error").html("");
		
	if($("#TicketConcernRaised").val() == '')
	{
		$("#ticket_concern_error").html("Raised By cannot be empty");
		error++;
	}
	else
		$("#ticket_concern_error").html("");
		
	if($("#TicketEmail").val() == '')
	{
		$("#ticket_email_error").html("Email cannot be empty");
		error++;
	}
	else
		$("#ticket_email_error").html("");
	
	if($("#TicketPhone").val() == '')
	{
		$("#ticket_phone_error").html("Phone Number cannot be empty");
		error++;
	}
	else
		$("#ticket_phone_error").html("");
	
	if($("#TicketDescription").val()=='')
	{
		$("#ticket_description_error").html("description cannot be empty");
		error++;
	}
	else
		$("#ticket_description_error").html("");
	console.log(error);
	if(error==0)
	{
		return true;
	}
	else{
		return false;
	}
}

function check_type()
{
	var type = $('#number_type').val();
	if(type!="")
	{
		$('#TicketRequestId').attr("required",true);
		$('#TicketRequestId').show();
		$('#req_check').show();
		$('#req_error').show();
	}
	else
	{
		$('#TicketRequestId').attr("required",false);
		$('#TicketRequestId').val("");
		$('#TicketRequestId').hide();
		$('#req_check').hide();
		$('#req_error').html("");
		$('#req_error').hide();
	}
}

function cross_check()
{
	var value = $('#TicketRequestId').val();
	var type = $('#number_type').val();

	$('#TicketRequestId').show();
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'ticket/cross_check?type='+type+'&value='+value,
		success:function(response){
			console.log(response);
			if(response.message=="success"){
				$('#req_error').css("color","green");
				$('#req_error').html(response.type+" Attached");
				$('#ticketsubmit').show();
			}
			else{
				$('#req_error').css("color","red");
				$('#req_error').html(response.type+" Not Found");
				$('#ticketsubmit').hide();
			}
		},
		dataType:"json"
	});	
}
</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Create Task</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/ticket/newtask', array('title'=>'Create Task')); ?>&nbsp;&#187;&nbsp;Create Task
	<div>&nbsp;</div>	
	<?php echo $form->create(array('url'=>'/admin/ticket/ticketsubmit/'.base64_encode($this->data['Health']['id']),'id'=>'form10','name'=>'form10','enctype'=>'multipart/form-data'));?>
	<?php echo $form->hidden('Health.id',array('value'=>$this->data['Health']['id']));?>
		<table border="0" width="100%">
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Task Type<font color="#FF0000">*</font></label>
				</td>
				<td>
					<select id="priority" name="data[Ticket][type]" style="float:left" onclick="change_type(this.value);">
						<option value="o" selected="selected" >One Time</option>
						<option value="r">Time Bounded</option>
						<option value="i">No TIme Limit</option>
					</select>
				</td>
			</tr>
			<tr class="recur">
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Recurring Type<font color="#FF0000">*</font></label>
				</td>
				<td>
					<select id="recurring_type" name="data[Ticket][recurring_type]" style="float:left">
						<option value="">Select a Recurring Type</option>
						<?php foreach($recur_type as $key => $val) {?>
							<option value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr class="recur">
				<td style="font-size: small; font-weight: 300;color: black;float: left;">From Date<font color="#FF0000">*</font></td>
				<td>
					<?php echo $form->text('Ticket.from_date', array('class'=>'input-text datepicker2' ,'style'=>'width:100px;' ,'required')); ?>
					<label id="ticket_from_date_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
				</td>
			</tr>
			<tr class="recur">
				<td style="font-size: small; font-weight: 300;color: black;float: left;">To Date<font color="#FF0000">*</font></td>
				<td>
					<?php echo $form->text('Ticket.to_date', array('class'=>'input-text datepicker2','style'=>'width:100px;','required')); ?>
					<label id="ticket_to_date_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
				</td>
			</tr>
			<tr class="non_recur">
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Req/Lab No.<font color="#FF0000">*</font></label>
				</td>
				<td>
					<select id="number_type" name="data[Ticket][number_type]" style="float:left;" onclick="check_type(this.value);">
						<option value="" selected="selected" >None</option>
						<option value="request" >Request Number</option>
						<option value="lab_no">Lab Number</option>
					</select>

					<?php echo $form->text('Ticket.request_id', array('class'=>'input-text','style'=>'width:150px;margin-left:10px;height: 10px;display:none;')); ?>
					<input id="req_check" class="btn" type="button" onclick="cross_check()" style="display:none;margin-left:10px;" value="Attach"/>
					<span id="req_error" style="font-size:14px;margin-left:20px; clear:both;margin-left:10px;"></span>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Category<font color="#FF0000">*</font></label>
				</td>
				<td>
					<select id="category" name="data[Ticket][category]"  onchange="getcategory();" style="float:left" required>
						<option value="">Select a Category</option>
						<?php foreach($category as $key => $val) {?>
							<option value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Priority<font color="#FF0000">*</font></label>
				</td>
				<td>
					<select id="priority" name="data[Ticket][priority]" style="float:left" required>
						<option value="">Select Priority</option>
						<?php foreach($priority as $key => $val) {?>
							<option value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Subject<font color="#FF0000">*</font></label>
				</td>
				<td>
					<?php echo $form->text('Ticket.tickettitle', array('class'=>'input-text','style'=>'width:200px;')); ?>
					<label id="tickettitle_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Raised By<font color="#FF0000">*</font></label>
				</td>
				<td>
					<?php echo $form->text('Ticket.concern_raised', array('class'=>'input-text','style'=>'width:200px;')); ?>
					<label id="ticket_concern_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Email<font color="#FF0000">*</font></label>
				</td>
				<td>
					<?php echo $form->text('Ticket.email', array('class'=>'input-text','style'=>'width:200px;','type'=>'email')); ?>
					<label id="ticket_email_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Phone Number<font color="#FF0000">*</font></label>
				</td>
				<td>
					<?php echo $form->text('Ticket.phone', array('class'=>'input-text','style'=>'width:200px;','onkeypress'=>'return checkphone(event)','type'=>'text','maxlength'=>'10')); ?>
					<label id="ticket_phone_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Description<font color="#FF0000">*</font></label>
				</td>
				<td>
					<?php echo $form->textarea('Ticket.description', array('class'=>'input-text','rows'=>5,'cols'=>50,'style'=>'font-size:12px;')); ?>
					<label id="ticket_description_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 300;color: black;float: left;">Image Upload</label>
				</td>
				<td>
					<?php echo $form->file('Ticket.image_upload',array('class'=>'input-text'));?>
					<div id="msgReportFile" style="color:#FF0000; font-size:12px; clear:both;"></div>
				</td>
			</tr>
			<tr>
				<td style="font-size: small; font-weight: 300;color: black;float: left;">Complete By<font color="#FF0000">*</font></td>
				<td>
					<?php echo $form->text('Ticket.complete_by_date', array('class'=>'input-text datepicker2' ,'style'=>'width:100px;float:left;','required'=>"required")); ?>
					<select id="time" name="data[Ticket][complete_by_time]" style="float:left;margin-left:10px;width:130px;height:38px;" required>
						<option value="">Select a Time</option>
						<?php foreach($time as $key => $val) {?>
							<option value="<?php echo $val;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr id="checklist" style="display:none;">
				<td style="font-size: small; font-weight: 300;color: black;float: left;">Checklist</td>
				<td id="checklistdata"></td>
			</tr>
			<tr id="doclist" style="display:none;">
				<td style="font-size: small; font-weight: 300;color: black;float: left;">Documents</td>
				<td id="doclistdata"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<span id="ticketprocessing" style="color:Red;display:none;font-size: x-small;">Ticket is Being Raised.</span>
				<span id="ticketcompleted" style="color:Green;display:none;font-size: x-small;">Ticket submitted successfully.</span>
				<td><input id="ticketsubmit" class="btn" type="submit" onclick="return submit_ticket()" value="Submit"/></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>	
	<?php echo $form->end();?>
</div>
<script>
	function change_type(val)
	{
		if(val == 'r')
		{
			$('.recur').show();
			$('.non_recur').hide();
			$('#TicketCompleteByDate').hide();
			$('#TicketCompleteByDate').attr("required",false);
		}
		else if(val == 'i')
		{
			$('.non_recur').hide();
			$('#TicketCompleteByDate').hide();
			$('#TicketCompleteByDate').attr("required",false);
		}
		else
		{
			$('.recur').hide();
			$('.non_recur').show();
			$('#TicketCompleteByDate').show();
			$('#TicketCompleteByDate').attr("required",true);
		}
	}
</script>
