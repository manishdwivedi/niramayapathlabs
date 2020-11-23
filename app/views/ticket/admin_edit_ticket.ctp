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

function check_req()
{
	var value = $('#TicketRequestId').val();
	console.log(value);
	if(value!="")
	{
		jQuery.ajax({
			type:'GET',
			url:siteUrl+'ticket/cross_check?type=request&value='+value,
			success:function(response){
				console.log(response);
				if(response.message=="success"){
					$('#req_error').css("color","green");
					$('#req_error').html(response.type+" Attached");
					$('#ticketsave').show();
				}
				else{
					$('#req_error').css("color","red");
					$('#req_error').html(response.type+" Not Found");
					$('#ticketsave').hide();
				}
			},
			dataType:"json"
		});	
	}
	else
	{
		$('#req_error').html("");
		$('#ticketsave').show();
	}
}

function check_lab()
{
	var value = $('#TicketLabNo').val();

	if(value!="")
	{
		jQuery.ajax({
			type:'GET',
			url:siteUrl+'ticket/cross_check?type=lab_no&value='+value,
			success:function(response){
				console.log(response);
				if(response.message=="success"){
					$('#lab_error').css("color","green");
					$('#lab_error').html(response.type+" Attached");
					$('#ticketave').show();
				}
				else{
					$('#lab_error').css("color","red");
					$('#lab_error').html(response.type+" Not Found");
					$('#ticketsave').hide();
				}
			},
			dataType:"json"
		});	
	}
	else
	{
		$('#lab_error').html("");
		$('#ticketsave').show();
	}
}

function edit_ticket()
{
	$('.readonly').hide();
	$('.writable').show();
	var action = $('#form10').attr('action');
	var new_url = action.replace("edit_ticket", "save_ticket");
	$('#form10').attr('action',new_url);
}

function cancel_ticket()
{
	var action = $('#form10').attr('action');
	var new_url = action.replace("save_ticket", "edit_ticket");
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
	<?php echo $form->create(array('url'=>'/admin/ticket/edit_ticket/'.base64_encode($this->data['Ticket']['id']), 'id'=>'form10','name'=>'form10','enctype'=>'multipart/form-data','method'=>'POST'));?>
		<?php echo $form->hidden('Ticket.id',array('value'=>$this->data['Ticket']['id']));?>
		<table border="0" width="100%">
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Ticket Number</label>
				</td>
				<td>
					<label style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $this->data['Ticket']['ticket_id']; ?></label>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Raised By</label>
				</td>
				<td>
					<label style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $this->data['Ticket']['concern_raised']; ?></label>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Created On</label>
				</td>
				<td>
					<label style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $this->data['Ticket']['date']; ?></label>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style='font-size: small; font-weight: 600;color: black;float: left;'>Request No</label>
				</td>
				<td>
					<label class="readonly" style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $this->data['Ticket']['request_id']; ?></label>
					<div class="writable">
						<?php echo $form->text('Ticket.request_id', array('class'=>'input-text','style'=>'width:150px;height: 10px;')); ?>
						<input id="req_check" class="btn" type="button" onclick="check_req()" value="Attach"/>
						<span id="req_error" style="font-size:14px;margin-left:20px; clear:both;"></span>
					</div>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style='font-size: small; font-weight: 600;color: black;float: left;'>Lab No</label>
				</td>
				<td>
					<label class="readonly" style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $this->data['Ticket']['lab_no']; ?></label>
					<div class="writable">
						<?php echo $form->text('Ticket.lab_no', array('class'=>'input-text','style'=>'width:150px;height: 10px;')); ?>
						<input id="lab_check" class="btn" type="button" onclick="check_lab()" value="Attach"/>
						<span id="lab_error" style="font-size:14px;margin-left:20px; clear:both;"></span>
					</div>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Email</label>
				</td>
				<td>
					<label class="readonly" style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $this->data['Ticket']['email']; ?></label>
					<div class="writable">
						<?php echo $form->text('Ticket.email', array('class'=>'input-text','style'=>'width:200px;','type'=>'email','required'=>'required')); ?>
						<label id="ticket_email_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</div>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Phone Number</label>
				</td>
				<td>
					<label class="readonly" style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $this->data['Ticket']['phone']; ?></label>
					<div class="writable">
						<?php echo $form->text('Ticket.phone', array('class'=>'input-text','style'=>'width:200px;','onkeypress'=>'return checkphone(event)','type'=>'text','maxlength'=>'10','required'=>'required')); ?>
						<label id="ticket_phone_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</div>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Category</label>
				</td>
				<td>
					<label class="readonly" style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $category[$this->data['Ticket']['category']]; ?></label>
					<div class="writable">
						<select id="category" name="data[Ticket][category]"  onchange="getcategory();" style="float:left" required>
							<option value="">Select a Category</option>
							<?php foreach($category as $key => $val) {?>
								<option value="<?php echo $key;?>" <?php if($key==$this->data['Ticket']['category']) echo "selected"; ?>><?php echo $val;?></option>
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
					<label class="readonly" style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $this->data['Ticket']['title']; ?></label>
					<div class="writable">
						<?php echo $form->text('Ticket.title', array('class'=>'input-text','style'=>'width:200px;','required'=>'required')); ?>
						<label id="tickettitle_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</div>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Priority</label>
				</td>
				<td>
					<select id="priority" name="data[Ticket][priority]" style="float:left">
						<option value="">Select a Status</option>
						<?php foreach($priority as $key => $val) {?>
							<option <?php echo ($this->data['Ticket']['priority'] == $key) ? 'selected' : ''; ?> value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Assigned To</label>
				</td>
				<td>
					<select id="assigned_to" name="data[Ticket][assigned_to]" style="float:left">
						<option value="">Select a Status</option>
						<?php foreach($users as $key => $val) {?>
							<option <?php echo ($this->data['Ticket']['assigned_to'] == $key) ? 'selected' : ''; ?> value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Description</label>
				</td>
				<td>
					<?php echo $form->textarea('Ticket.description', array('class'=>'input-text','rows'=>5,'cols'=>50,'style'=>'font-size:12px;')); ?>
					<label id="ticket_description_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Status</label>
				</td>
				<td>
					<select id="status" name="data[Ticket][status]" style="float:left">
						<option value="">Select a Status</option>
						<?php foreach($status as $key => $val) {?>
							<option <?php echo ($this->data['Ticket']['status'] == $key) ? 'selected' : ''; ?> value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td>
					<img>
				</td>
			</tr>
			<tr>
				<td width="10%">
					<label style="font-size: small; font-weight: 600;color: black;float: left;">Image Upload</label>
				</td>
				<td>
					<?php echo $form->file('Ticket.image_upload',array('class'=>'input-text','style'=>'width:200px;'));?>
					<div id="msgReportFile" style="color:#FF0000; font-size:12px; clear:both;"></div>
				</td>
			</tr>
			<tr>
				<td style="font-size: small; font-weight: 600;color: black;float: left;">Complete By<font color="#FF0000">*</font></td>
				<td>
					<?php echo $form->text('Ticket.complete_by_date', array('class'=>'input-text datepicker2' ,'style'=>'width:100px;float:left;' ,'required')); ?>
					<select id="time" name="data[Ticket][complete_by_time]" style="float:left;margin-left:10px;width:130px;height:38px;">
						<option value="">Select a Time</option>
						<?php foreach($time as $key => $val) {?>
							<option <?php echo (trim($this->data['Ticket']['complete_by_time']) == trim($val)) ? 'selected' : ''; ?> value="<?php echo $val;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<?php if(!empty($this->data['Ticket']['checklist'])){ ?>
			<tr class="readonly">
				<td colspan="2"><hr></td>
			</tr>
			<tr class="readonly">
				<td colspan="2" style="font-size: large; font-weight: 600;color: black;">Checklist</td>
			</tr>
			<?php if(count($this->data['Ticket']['check_list'])>0) { foreach($this->data['Ticket']['check_list'] as $key=>$val) {
				$check = explode('#',$checks[$key]);
				$checked = "";
				?>
				<tr class="readonly">
					<td colspan="2" style="font-size: small; font-weight: 600;color: black;"><?php echo $val;?>
						<?php
						if($check[1]==1)
							echo $form->checkbox('Ticket.check.'.$key, array('class'=>'input-text','style'=>'margin-left:10px;width:200px;','checked'=>'checked'));
						else
							echo $form->checkbox('Ticket.check.'.$key, array('class'=>'input-text','style'=>'margin-left:10px;width:200px;',$checked));
						?>
					</td>
				</tr>
			<?php } }
			else
			{ ?>
				<tr class="readonly"><td colspan="2">none</td></tr>
			<?php } }
			if(!empty($this->data['Ticket']['documents'])){
			?>
			<tr class="readonly">
				<td colspan="2"><hr></td>
			</tr>
			<tr class="readonly">
				<td style="font-size: large; font-weight: 600;color: black;" colspan="2">Required Documents</td>
			</tr>
			<?php if(count($this->data['Ticket']['docs'])>0) {
			foreach($this->data['Ticket']['docs'] as $key=>$val) {
				$documents = explode('#',$docs[$key]);
				?>
				<tr class="readonly">
					<td style="font-size: small; font-weight: 600;color: black;" colspan="2"><?php echo $val;?> 
						<?php
						if(isset($documents[1])){?>
							<a href="<?php echo "/files/ticket/".$documents[1]; ?>" target="_blank">View Uploaded Doc </a>		 
						<?php }
						else
							echo $form->file('Ticket.doc.'.$key, array('class'=>'input-text','style'=>'margin-left:10px;width:200px;','required'=>'required')); 
						?>
					</td>
				</tr>
			<?php } 
			} 
			else
			{ ?>
				<tr class="readonly"><td colspan="2">none</td></tr>
			<?php } }?>
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
	<div class="headings altheading">
        <h2>Ticket Activity Log</h2>
    </div>
	<div>
		<table border="0" width="100%">
			<tr>
				<th width="30px">S No.</th>
				<th width="105px">Date</th>
				<th>Assigned To </th>
				<th>Description</th>
				<th>View Attachment</th>
			</tr>
			<?php $act_count =1; 
			foreach($ticket_activity as $val) {?>
			<tr>
				<td>
					<label style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $act_count; ?></label>
				</td>
				<td>
					<label style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo date('d-m-Y h:i:s',strtotime($val['TicketTracking']['date'])); ?></label>
				</td>
				<td>
					<label style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $users[$val['TicketTracking']['assigned_to']]; ?></label>
				</td>
				<td>
					<label style="font-size: small; font-weight: 300;color: black;float: left;"><?php echo $val['TicketTracking']['description']; ?></label>
				</td>
				
				<td>
					<?php echo file_exists("/files/ticket/".$val['TicketTracking']['img_url']);	?>
					<a href="<?php echo "/files/ticket/".$val['TicketTracking']['img_url']; ?>" target="_blank">View Doc</label>
				</td>
			</tr>
			<?php $act_count++; } ?>
		</table>	
	</div>
</div>
