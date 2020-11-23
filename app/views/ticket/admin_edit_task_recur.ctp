<style>
.writable{
	display:none;
}
</style>
<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		minDate: '-0D',
		maxDate: '+30D',
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker2" ).datepicker({
		minDate: '-0D',
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

function edit_ticket()
{
	$('.readonly').hide();
	$('.writable').show();
	var action = $('#form10').attr('action');
	var new_url = action.replace("edit_task_recur", "save_task_recur");
	$('#form10').attr('action',new_url);
}

function cancel_ticket()
{
	var action = $('#form10').attr('action');
	var new_url = action.replace("save_task_recur", "edit_task_recur");
	$('#form10').attr('action',new_url);

	$('.readonly').show();
	$('.writable').hide();
}
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Edit Ticket</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/ticket/index', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Edit Ticket
	<div>&nbsp;</div>
	<?php echo $form->create(array('url'=>'/admin/ticket/edit_task_recur/'.base64_encode($this->data['TicketRecurring']['id']),'id'=>'form10','name'=>'form10','enctype'=>'multipart/form-data'));?>
		<?php echo $form->hidden('TicketRecurring.id',array('value'=>$this->data['TicketRecurring']['id']));?>
		<table border="0" width="100%">
			<tr>
				<td width="20%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Recurring Ticket Number</label>
				</td>
				<td>
					<label style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $this->data['TicketRecurring']['ticket_id']; ?></label>
				</td>
			</tr>
			<tr>
				<td width="20%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Raised By</label>
				</td>
				<td>
					<label style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $this->data['TicketRecurring']['concern_raised']; ?></label>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Email</label>
				</td>
				<td>
					<label class="readonly" style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $this->data['TicketRecurring']['email']; ?></label>
					<div class="writable">
						<?php echo $form->text('TicketRecurring.email', array('class'=>'input-text','style'=>'width:200px;','type'=>'email','required'=>'required')); ?>
						<label id="ticket_email_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</div>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Phone Number</label>
				</td>
				<td>
					<label class="readonly" style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $this->data['TicketRecurring']['phone']; ?></label>
					<div class="writable">
						<?php echo $form->text('TicketRecurring.phone', array('class'=>'input-text','style'=>'width:200px;','onkeypress'=>'return checkphone(event)','type'=>'text','maxlength'=>'10','required'=>'required')); ?>
						<label id="ticket_phone_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</div>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Category</label>
				</td>
				<td>
					<label class="readonly" style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $category[$this->data['TicketRecurring']['category']]; ?></label>
					<div class="writable">
						<select id="category" name="data[Ticket][category]"  onchange="getcategory();" style="float:left" required>
							<option value="">Select a Category</option>
							<?php foreach($category as $key => $val) {?>
								<option value="<?php echo $key;?>" <?php if($key==$this->data['TicketRecurring']['category']) echo "selected"; ?>><?php echo $val;?></option>
							<?php }?>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Subject</label>
				</td>
				<td>
					<label class="readonly" style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $this->data['TicketRecurring']['title']; ?></label>
					<div class="writable">
						<?php echo $form->text('TicketRecurring.title', array('class'=>'input-text','style'=>'width:200px;','required'=>'required')); ?>
						<label id="tickettitle_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</div>
				</td>
			</tr>
			<tr class="recur">
				<td style="font-size: small; font-weight: 600;color: black;float: left;">From Date<font color="#FF0000">*</font></td>
				<td>
					<?php echo $form->text('TicketRecurring.from_date', array('class'=>'input-text datepicker2' ,'style'=>'width:100px;' ,'required')); ?>
					<label id="ticket_from_date_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
				</td>
			</tr>
			<tr class="recur">
				<td style="font-size: small; font-weight: 600;color: black;float: left;">To Date<font color="#FF0000">*</font></td>
				<td>
					<?php echo $form->text('TicketRecurring.to_date', array('class'=>'input-text datepicker2','style'=>'width:100px;','required')); ?>
					<label id="ticket_to_date_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Recurring Type<font color="#FF0000">*</font></label>
				</td>
				<td>
					<select id="recurring_type" name="data[Ticket][recurring_type]" style="float:left">
						<option value="">Select a Recurring Type</option>
						<?php foreach($recur_type as $key => $val) {?>
							<option <?php echo ($this->data['TicketRecurring']['recurring_type'] == $key) ? 'selected' : ''; ?> value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="20%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Priority</label>
				</td>
				<td>
					<select id="priority" name="data[TicketRecurring][priority]" style="float:left">
						<option value="">Select a Status</option>
						<?php foreach($priority as $key => $val) {?>
							<option <?php echo ($this->data['TicketRecurring']['priority'] == $key) ? 'selected' : ''; ?> value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="20%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Description</label>
				</td>
				<td>
					<?php echo $form->textarea('TicketRecurring.description', array('class'=>'input-text','rows'=>5,'cols'=>50,'style'=>'font-size:12px;')); ?>
					<label id="ticket_description_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
				</td>
			</tr>
			<tr>
				<td>
					<img>
				</td>
			</tr>
			<tr>
				<td width="20%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Image Upload</label>
				</td>
				<td>
					<?php echo $form->file('TicketRecurring.image_upload',array('class'=>'input-text'));?>
					<div id="msgReportFile" style="color:#FF0000; font-size:12px; clear:both;"></div>
				</td>
			</tr>
			<tr>
				<td style="font-size: large; font-weight: 300;color: black;float: left;">Complete By<font color="#FF0000">*</font></td>
				<td>
					<?php echo $form->text('TicketRecurring.complete_by_date', array('class'=>'input-text datepicker2' ,'style'=>'width:100px;float:left;' ,'required')); ?>
					<select id="time" name="data[TicketRecurring][complete_by]" style="float:left;margin-left:10px;width:130px;height:38px;">
						<option value="">Select a Time</option>
						<?php foreach($time as $key => $val) {?>
							<option <?php echo ($this->data['TicketRecurring']['complete_by_time'] == $val) ? 'selected' : ''; ?> value="<?php echo $val;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<span id="ticketprocessing" style="color:Red;display:none;font-size: x-small;">Ticket is Being Raised.</span>
				<span id="ticketcompleted" style="color:Green;display:none;font-size: x-small;">Ticket submitted successfully.</span>
				<td><input id="ticketsubmit" class="btn readonly" type="submit" onclick="submit_ticket()" value="Submit"/>
				<input id="ticketedit" class="btn readonly" onclick="edit_ticket()" type="button" value="Edit"/>
				<input id="ticketsave" class="btn writable" onclick="save_ticket()" type="submit" value="Save"/>
				<input id="ticketcancel" class="btn writable" onclick="cancel_ticket()" type="button" value="Cancel"/></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>	
	<?php echo $form->end();?>
</div>