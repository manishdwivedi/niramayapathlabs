<style>
.disabled { background:lightgray; }
</style>
<script type="text/javascript">
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
	$('.disabled').attr('disabled',true);
	var runner_value = $('#RunnerRunnerCharges').val();
	$('#runnerrecievedamount').attr({max : runner_value});
});

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
<div class="contentcontainer">
	<div class="headings altheading">
        <h2>Edit Runner Request</h2>
    </div>
    <div class="contentbox">
	<?php echo $this->Session->flash(); ?>
	<?php if($usertype != 'Agent') {?>
	<?php echo $html->link('Home', '/admin/runner/runner_request', array('title'=>'Home')); ?> &#187; Edit Runner Request
	<?php }?>
	
	<?php echo $form->create(null, array('url'=>'/admin/runner/edit_runner_request/'.base64_encode($this->data['Runner']['id']),'onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1')); ?>
	<?php echo $form->hidden('Health.login_type',array('value'=>$LoginType));?>
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		<tr class="daily">
			<td>
				<?php echo $form->hidden('Runner.id', array('class'=>'input-text','style'=>'width:100px;')); ?>
			</td>
		</tr>
		<tr>
			<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
		</tr>
		<!--<tr>
			<td width="15%" class="boldText">Booked By<font color="#FF0000">*</font></td>
			<td>
				<select name="data[Runner][booked_by]" id="AgentRole" class="input-text disabled" required>
					<option value="">Select PCC</option>
					<?php foreach($lab_list as $key => $val) {?>
					<option value="<?php echo $key;?>" <?php if($this->data['Runner']['booked_by']==$key) echo 'selected';?>><?php echo $val;?></option>
					<?php }?>
				</select>
				<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Serviced By<font color="#FF0000">*</font></td>
			<td>
				<select name="data[Runner][serviced_by]" id="AgentRole" class="input-text disabled" required>
					<option value="">Select PCC</option>
					<?php foreach($lab_list as $key => $val) {?>
					<option value="<?php echo $key;?>" <?php if($this->data['Runner']['serviced_by']==$key) echo 'selected';?>><?php echo $val;?></option>
					<?php }?>
				</select>
				<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>-->
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Runner Id<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.runner_request_id', array('class'=>'input-text','disabled'=>'disabled','style'=>'width:100px;background:lightgrey;')); ?>
			</td>
		</tr>
		<tr class="daily">
			<td width="15%" class="boldText">Date<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.date', array('class'=>'input-text datepicker2 disabled','style'=>'width:100px;','required')); ?>
			</td>
		</tr>
		
		<tr>
			<td width="15%" class="boldText">Time Slot</td>
			<td>
				<select name="data[Runner][time_slot]" id="agent_timeslot" class="input-text disabled" required>
					<?php foreach($time_slot as $key => $val) {?>
					<option value="<?php echo $key;?>" <?php if($this->data['Runner']['time_slot']==$key) echo 'selected';?>><?php echo $val;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Runner Charges<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.runner_charges', array('class'=>'input-text disabled','style'=>'width:100px;','onkeypress'=>'return checknum(event)','required')); ?>
			</td>
		</tr>
		<tr>
			<td colspan="2"><hr></td>
		</tr>
		<tr>
			<td colspan="2"><h3>Pickup Details</h3></td>
		</tr>
		<tr>
			<td colspan="2"><hr></td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Pickup Location</td>
			<td <?php echo $class;?>>
				<select name="data[Runner][pick_loc_id]" id="RunnerPickLocId" class="input-text disabled" style="width:235px;" required onchange="getpickloc()">
					<option value="0">Select Pick Location</option>
					<?php foreach($pick_loc as $key => $val) {?>
					<option value="<?php echo $key;?>" <?php if($this->data['Runner']['pick_loc_id']==$key) echo 'selected';?>><?php echo $val;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Pickup Location Name<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.pickup_location_name', array('class'=>'input-text disabled','required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Name<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.pickup_name', array('class'=>'input-text disabled','required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Contact<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.pickup_contact', array('class'=>'input-text disabled','maxlength'=>'10','onkeypress'=>'return checknum(event)','required'=>'required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Alternate Contact<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.pickup_alt_contact', array('class'=>'input-text disabled','maxlength'=>'10','onkeypress'=>'return checknum(event)','required'=>'required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Pincode<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.pickup_pincode', array('class'=>'input-text disabled','maxlength'=>'6','minlength'=>'6','onkeypress'=>'return checknum(event)','onkeyup'=>'getcitystate("RunnerPickup");','required'=>'required')); ?>
				<div id="msg_pin" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">City</td>
			<td>
				<select name="data[Runner][pickup_city]" id="RunnerPickupCityId" class="input-text disabled" readonly>
					<option value="">Select City</option>
					<?php foreach($city as $key => $val) {?>
					<option value="<?php echo $val['City']['id'];?>" <?php if($this->data['Runner']['pickup_city']==$val['City']['id']) echo 'selected';?>><?php echo $val['City']['name'];?></option>
					<?php }?>
				</select>
				<div id="msg9" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">State</td>
			<td>
				<select name="data[Runner][pickup_state]" id="RunnerPickupState" class="input-text disabled" readonly>
					<option value="">Select State</option>
					<?php foreach($state as $key => $val) {?>
					<option value="<?php echo $val['State']['id'];?>" <?php if($this->data['Runner']['pickup_state']==$val['State']['id']) echo 'selected';?>><?php echo $val['State']['name'];?></option>
					<?php }?>
				</select>
				<div id="msg10" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>
		<!--<tr>
			<td width="15%" class="boldText">Locality<font color="#FF0000">*</font></td>
			<td>
				<select name="data[Runner][pickup_locality]" id="RunnerPickupLocality" class="input-text disabled" required>
					<option value="">Select Locality</option>
					<?php foreach($pickupPincode as $val) {?>
					<option value="<?php echo str_replace(" ","_",$val['PincodeMaster']['locality']);?>" <?php if($this->data['Runner']['pickup_locality']==str_replace(" ","_",$val['PincodeMaster']['locality'])) echo 'selected';?>><?php echo $val['PincodeMaster']['locality'];?></option>
					<?php }?>
				</select>
				<div id="msg9" style="color:#FF0000; font-size:12px;"></div>
			</td>	
		</tr>-->
		<tr>
			<td width="15%" class="boldText">Address <font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.pickup_address', array('class'=>'input-text disabled','required')); ?>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Landmark</td>
			<td>
				<?php echo $form->text('Runner.pickup_landmark', array('class'=>'input-text disabled')); ?>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Google Location URL</td>
			<td>
				<?php echo $form->text('Runner.pickup_location', array('class'=>'input-text disabled')); ?>
			</td>
		</tr>
		<!--<tr>
			<td colspan="2"><hr></td>
		</tr>
		<tr>
			<td colspan="2"><h3>Drop Details</h3></td>
		</tr>
		<tr>
			<td colspan="2"><hr></td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Name<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.drop_name', array('class'=>'input-text disabled','required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Contact<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.drop_contact', array('class'=>'input-text disabled','maxlength'=>'10','onkeypress'=>'return checknum(event)','required'=>'required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Alternate Contact<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.drop_alt_contact', array('class'=>'input-text disabled','maxlength'=>'10','onkeypress'=>'return checknum(event)','required'=>'required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Pincode<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.drop_pincode', array('class'=>'input-text disabled','maxlength'=>'6','minlength'=>'6','onkeypress'=>'return checknum(event)','onkeyup'=>'getcitystate("RunnerDrop");','required'=>'required')); ?>
				<div id="msg_pin" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">City</td>
			<td>
				<select name="data[Runner][drop_city]" id="RunnerDropCityId" class="input-text disabled" readonly>
					<option value="">Select City</option>
					<?php foreach($city as $key => $val) {?>
					<option value="<?php echo $val['City']['id'];?>" <?php if($this->data['Runner']['drop_city']==$val['City']['id']) echo 'selected';?>><?php echo $val['City']['name'];?></option>
					<?php }?>
				</select>
				<div id="msg9" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">State</td>
			<td>
				<select name="data[Runner][drop_state]" id="RunnerDropState" class="input-text disabled" readonly>
					<option value="">Select State</option>
					<?php foreach($state as $key => $val) {?>
					<option value="<?php echo $val['State']['id'];?>" <?php if($this->data['Runner']['drop_state']==$val['State']['id']) echo 'selected';?>><?php echo $val['State']['name'];?></option>
					<?php }?>
				</select>
				<div id="msg10" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Locality<font color="#FF0000">*</font></td>
			<td>
				<select name="data[Runner][drop_locality]" id="RunnerDropLocality" class="input-text disabled" required>
					<option value="">Select Locality</option>
					<?php foreach($dropPincode as $val) {?>
					<option value="<?php echo str_replace(" ","_",$val['PincodeMaster']['locality']);?>" <?php if($this->data['Runner']['drop_locality']==str_replace(" ","_",$val['PincodeMaster']['locality'])) echo 'selected';?>><?php echo $val['PincodeMaster']['locality'];?></option>
					<?php }?>
				</select>
				<div id="msg9" style="color:#FF0000; font-size:12px;"></div>
			</td>	
		</tr>
		<tr>
			<td width="15%" class="boldText">Address <font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.drop_address', array('class'=>'input-text disabled','required')); ?>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Landmark</td>
			<td>
				<?php echo $form->text('Runner.drop_landmark', array('class'=>'input-text disabled')); ?>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Google Location URL</td>
			<td>
				<?php echo $form->text('Runner.drop_location', array('class'=>'input-text disabled')); ?>
			</td>
		</tr>-->
		<tr>
			<td width="15%" class="boldText">Drop Location</td>
			<td <?php echo $class;?>>
				<select name="data[Runner][drop_loc_id]" id="RunnerDropLocId" class="input-text disabled" style="width:135px;" required>
					<option value="0">Select Drop Location</option>
					<?php foreach($drop_loc as $key => $val) {?>
					<option value="<?php echo $key;?>" <?php if($this->data['Runner']['drop_loc_id']==$key) echo 'selected';?>><?php echo $val;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->hidden('Runner.status', array('class'=>'input-text')); ?>
			</td>
		</tr>
		<tr>
			<tr>
				<td colspan="2">
					<?php echo $form->submit('Save & Submit', array('id'=>'save_runner','div'=>false, 'class' => 'btn','style'=>'display:none')); ?>
					<button type="button" id="cancel_runner" class="btn" style="display:none" onclick="cancel();">Cancel</button>
					<?php if($this->data['Runner']['status'] < 4 || $this->data['Runner']['status'] == 10 || $this->data['Runner']['status'] == 11) { ?><button type="button" id="edit" class="btn" onclick="edit_data();">Edit</button> <?php } ?>
					<!--<?php if($this->data['Runner']['status'] < 3 ) {?><button type="button" id="reschedule_request" class="btn" onclick="reschedule();">Reschedule</button><?php } ?>-->
					<?php if($this->data['Runner']['status'] < 6 ) {?><button type="button" id="mark_cancelled" class="btn" onclick="mark_as_cancelled();">Mark as Cancelled</button><?php } ?>
					<?php if($this->data['Runner']['status'] == 6 ) {?><button type="button" id="mark_closed" class="btn" onclick="mark_as_closed();">Mark as Closed</button><?php }?>
					<div id="processing" style="display:none;color:red;font-size:large;">Data is being Processed. Kindly Wait.</div>
					<div id="success" style="display:none;color:green;font-size:large;"></div>
				</td>
			</tr>
		</tr>
	</table>
	<?php echo $form->end(); ?>
	
	<div id="runner_pickup_detail" style="display:<?php if($this->data['Runner']['status'] >= 3 && $this->data['Runner']['status'] <=6) { echo 'inline'; } else { echo 'none';}?>">
		<hr>
			<h3>Pick Up Details</h3>
		<hr>
		<?php 
		if($this->data['Runner']['status'] == 3){
			$url = '/admin/runner/runner_pickup_data/';
		}
		
		if($this->data['Runner']['status'] == 4){
			$url = '/admin/runner/runner_drop_data/';
		}
		
		if($this->data['Runner']['status'] == 5){
			$url = '/admin/runner/runner_confirm_data/';
		}
		
		?>
		<?php echo $form->create(array('url'=>$url.base64_encode($this->data['Runner']['id']),'id'=>'form9','name'=>'form9'));?>
		<?php echo $form->hidden('Health.login_action',array('value'=>'Super'));?>
		<table border="0" width="100%" style="width:950px;">
				<tr style="height:50px;font-size: 15px;">
					<td>Amount To Be Collected</td>
					<td><input type="number" value="<?php echo $this->data['Runner']['recieved_amount']; ?>" id="runnerrecievedamount" name="data[Runner_pickup][recieved_amount]" onkeypress="return checknum(event)" <?php if($this->data['Runner']['status'] >= 6 || $this->data['Runner']['recieved_amount']==$this->data['Runner']['runner_charges']) { echo "disabled"; }?>></td>
				</tr>
				<?php if($this->data['Runner']['status'] > 3 ) {?>
				<tr style="height:50px;font-size: 15px;">
					<?php if($this->data['Runner']['status'] > 3 ) {?>
					<td style="width:350px;color:green;"><?php echo "<strong>Sample Pick Up Time - </strong>".date("F j, Y, g:i a",strtotime($this->data['Runner']['pickup_datetime'])); ?></td>
					<?php } ?>
					<?php if($this->data['Runner']['status'] > 4 ) {?>
					<td style="width:350px;color:red;"><?php echo "<strong>Sample Drop Time - </strong>".date("F j, Y, g:i a",strtotime($this->data['Runner']['drop_datetime'])); ?></td>
					<?php } ?>
				</tr>
				<?php } ?>
				<tr style="font-weight:600;color:black;">
					<th style="line-height: 25px; font-size: 15px;width:350px;">Sample Type</th>
					<th style="line-height: 25px; font-size: 15px;width:350px;">No. Of Vials(Pick Up)</th>
					<th style="line-height: 25px; font-size: 15px;">No. Of Vials(Drop)</th>
				</tr>
				<?php foreach($sample_specific as $key=>$val) { ?>
					<tr style="background:<?php echo $sample_color[$key]; ?>;font-weight: 600;color:black;">
						<td><label style="padding-bottom:0px;" id="sample_type_<?php echo $val; ?>" name="sample_type[<?php echo $val; ?>]" value="<?php echo $val; ?>"><?php echo $key; ?></label></td>
						<td><input type="text" id="sample_pickup_<?php echo $val; ?>" name="pickup_sample_value[<?php echo $val; ?>]" value="<?php if(isset($pickup_sample_value[$val])) { echo $pickup_sample_value[$val]; }?>" <?php if($this->data['Runner']['status'] > 3 ) { echo 'disabled'; }?>></td>
						<td><input type="text" id="sample_drop_<?php echo $val; ?>" name="drop_sample_value[<?php echo $val; ?>]" value="<?php echo $drop_sample_value[$val];?>" <?php if($this->data['Runner']['status'] > 4 || $this->data['Runner']['status']==3 || !isset($pickup_sample_value[$val])) { echo 'disabled'; }?> <?php if(isset($pickup_sample_value[$val])) { echo 'required'; }?>></td>
				<?php }?>
				<tr style="background:red;color:black;font-weight: 600;">
					<td>
						<label style="font-weight: 600;">Others</label>
						<!--<select id="sample_others" name="sample_others">
							<option value="others"> Others </option>
							<?php foreach($sample_others as $key=>$val) { ?>
							<option value="<?php echo $val; ?>" <?php if(array_key_exists($val,$assigned_sample)) { echo 'selected="selected"'; } ?>><?php echo $key; ?></option>
							<?php } ?>
						</select>-->
					</td>
					<td><input type="text" id="sample_pickup_others" name="pickup_sample_others" value="<?php if(isset($pickup_sample_value['others'])) { echo $pickup_sample_value['others']; }?>" <?php if($this->data['Runner']['status'] > 3 ) { echo 'disabled'; }?>></td>
					<td><input type="text" id="sample_drop_others" name="drop_sample_others" value="<?php echo $drop_sample_value['others'];?>" <?php if($this->data['Runner']['status'] > 4 || $this->data['Runner']['status']==3 || !isset($pickup_sample_value['others'])) { echo 'disabled'; }?> <?php if(isset($pickup_sample_value['others'])) { echo 'required'; }?>></td>
				</tr>
				<tr>
					<td><label style="height: 100px;font-weight: 600;">Remarks</label></td>
					<td><textarea required name="pickup_remarks" <?php if($this->data['Runner']['status'] > 3 ) { echo 'disabled'; }?> style="height: 100px;width: 90%;"><?php if(isset($this->data['Runner']['pickup_remark'])) { echo $this->data['Runner']['pickup_remark']; }?></textarea></td>
					<td><textarea required name="drop_remarks" <?php if($this->data['Runner']['status'] > 4 ||  $this->data['Runner']['status']==3) { echo 'disabled'; }?> style="height: 100px;width: 90%;"><?php if(isset($this->data['Runner']['drop_remark'])) { echo $this->data['Runner']['drop_remark']; }?></textarea></td>
				</tr>
				<?php if($this->data['Runner']['status'] >= 5) { ?>
					<td><label style="height: 100px;font-weight: 600;">Confirmation Message</label></td>
					<td><textarea name="confirm_remark" <?php if($this->data['Runner']['status']>5) { echo 'disabled'; }?> style="height: 100px;width: 90%;" required><?php if(isset($this->data['Runner']['remarks'])) { echo $this->data['Runner']['remarks']; }?></textarea></td>
				<?php  } ?>
				<tr>
					<td id="sample_collected_button">
						<button type="submit" id="save_pickup" class="btn" style="display:<?php if($this->data['Runner']['status'] == 3 ) { echo 'inline'; } else { echo 'none'; }?>" >Save Pick Up Data</button>
						<button type="submit" id="save_drop" class="btn" style="display:<?php if($this->data['Runner']['status'] == 4 ) { echo 'inline'; } else { echo 'none'; }?>">Save Drop Data</button>
						<button type="submit" id="confirm_remarks" class="btn" style="display:<?php if($this->data['Runner']['status'] == 5 ) { echo 'inline'; } else { echo 'none'; }?>">Confirmed By Lab</button>
					</td>
					
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		<input type="hidden" value="pickup" id="runnerrequesttype" name="data[Runner_pickup][type]">
		<input type="hidden" value="1" id="samplecount">
		<?php echo $form->end();?>
	</div>
</div>

<script type="text/javascript">

function pickup_detail()
{
	$("#runner_pickup_detail").show();
}

function drop_detail()
{
	$("#runner_drop_detail").show();
}


function add_new_sample()
{
	var sample_html = $('#sample_data').html();
	var count = $('#samplecount').val();
	var sample_row_html = $('#sample_data_value_'+count).html();
	count++;
	var new_html = "<tr class='sample_data_value' id='sample_data_value_"+count+"'>";
		new_html +=	sample_row_html;
		new_html +=	"</tr>";
	$('#samplecount').val(count);			
	$('#sample_data').html(sample_html+new_html);
}

function add_new_drop_sample()
{
	var sample_html = $('#sample_data1').html();
	var count = $('#samplecount1').val();
	var sample_row_html = $('#sample_data_drop_value_'+count).html();
	count++;
	var new_html = "<tr class='sample_data_value' id='sample_data_drop_value_"+count+"'>";
		new_html +=	sample_row_html;
		new_html +=	"</tr>";
	$('#samplecount').val(count);			
	$('#sample_data1').html(sample_html+new_html);
}

function remove(e)
{
	var id = e.parentNode.parentNode.id;
	if(id!='sample_data_value_1')
	{
		$('#'+id).remove();
	}
	else
	{
		alert("Atleast One Sample Need To Be Submitted");
	}
}
function cancel()
{
	$('.disabled').attr('disabled',true);
	$('.disabled').css("background", "lightgray");
	$('#edit').show();
	$('#cancel_runner').hide();
	$('#save_runner').hide();
}

function edit_data()
{
	$('.disabled').attr('disabled',false);
	$('.disabled').css("background", "white");
	$('#edit').hide();
	$('#cancel_runner').show();
	$('#save_runner').show();
}

function change_type(val)
{
	if(val == 1)
	{
		$('#daily').attr('checked',true);
		$('#adhoc').attr('checked',false);
		$('.daily').show();
		$('.adhoc').hide();
	}
	else
	{
		$('#daily').attr('checked',false);
		$('#adhoc').attr('checked',true);
		$('.adhoc').show();
		$('.daily').hide();
	}
	
	
}

function mark_as_cancelled()
{
	$('#processing').show();
	$('#cancel_runner').hide();
	var runner_id = $('#RunnerId').val();
	
	jQuery.ajax({
		type:'POST',
		data : { id : runner_id, },
		url:siteUrl+'admin/runner/cancelrunner',
		success: function(response) {
			$('#success').html('Request successfully Cancelled.');
			$('#success').show();
			$('#processing').hide();
		}
	});
}

function mark_as_closed()
{
	$('#processing').show();
	$('#mark_closed').hide();
	var runner_id = $('#RunnerId').val();
	jQuery.ajax({
		type:'POST',
		data : { id : runner_id, },
		url:siteUrl+'admin/runner/closerunner',
		dataType:'json',
		success: function(response) {
			if(response['message']=='failure')
			{
				alert('Dues Pending - Rs.'+response.amount);
				$('#mark_closed').show();
				$('#processing').hide();
			}
			else{
				$('#success').html('Request successfully Closed.');
				$('#success').show();
				$('#processing').hide();
			}
		}
	});
}

function getpickloc(){
	var pick_loc_id = $('#RunnerPickLocId').val();
	console.log(pick_loc_id);
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/runner/get_loc_detail?loc_id='+pick_loc_id,
		success: function(response) {
			for (var key in response) {
				if (response.hasOwnProperty(key)) {
					$('#RunnerPickupLocationName').val(response[key]["location_name"]);
					$('#RunnerPickupName').val(response[key]["poc"]);
					$('#RunnerPickupContact').val(response[key]["contact"]);
					$('#RunnerPickupAltContact').val(response[key]["alt_contact"]);
					$('#RunnerPickupPincode').val(response[key]["pincode"]);
					$('#RunnerPickupCityId').val(response[key]["city"]);
					$('#RunnerPickupState').val(response[key]["state"]);
					$('#RunnerPickupAddress').val(response[key]["address"]);
					$('#RunnerPickupLandmark').val(response[key]["landmark"]);
					$('#RunnerPickupLocation').val(response[key]["geolocation"]);
				}
			  }
		},
	 dataType:"json"
	});
}

function getcitystate(name)
{
	var pin = $('#'+name+'Pincode').val();
	console.log(pin);
	if(pin.length==6)
	{
		document.getElementById("msg_pin").innerHTML="";
		jQuery.ajax({
			type:'GET',
			url:siteUrl+'admin/runner/getcitystate?pin='+pin,
			success: function(response) {
			console.log(response);
				$('#'+name+'CityId option[value='+response["city"]+']').attr('selected','selected');						
				$('#'+name+'State option[value='+response["state"]+']').attr('selected','selected');
				var locality_rep = '<option value="">Select Locality</option>';
				for(var i=0;i<response["locality"].length;i++)
				{
					locality_rep += '<option value='+response["locality"][i].replace(" ","_")+'>'+response['locality'][i]+'</option>';
				}
				$('#'+name+'Locality').html(locality_rep);	
			},
			 dataType:"json"
		});
		
	}
	else{
		document.getElementById("msg_pin").innerHTML="Please Enter valid Pincode";
	}
}
</script>
<?php echo $javascript->link('light/jquery.lightbox_me') ?>
<?php echo $javascript->link('light/slider') ?>