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
        <h2>Add Runner Request</h2>
    </div>
    <div class="contentbox">
	<?php echo $this->Session->flash(); ?>
	<?php if($usertype != 'Agent') {?>
	<?php echo $html->link('Home', '/admin/runner/runner_service', array('title'=>'Home')); ?> &#187; Add Runner Request
	<?php }?>
	
	<?php echo $form->create(null, array('url'=>'/admin/runner/add_new_request','onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1')); ?>
	<?php echo $form->hidden('Health.login_type',array('value'=>$LoginType));?>
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		<tr>
			<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
		</tr>
		<!--<tr>
			<td width="15%" class="boldText">Booked By<font color="#FF0000">*</font></td>
			<td>
				<select name="data[Runner][booked_by]" id="AgentRole" class="input-text"  required>
					<option value="">Select PCC</option>
					<?php foreach($lab_list as $key => $val) {?>
					<option value="<?php echo $key;?>"><?php echo $val;?></option>
					<?php }?>
				</select>
				<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Serviced By<font color="#FF0000">*</font></td>
			<td>
				<select name="data[Runner][serviced_by]" id="AgentRole" class="input-text" required>
					<option value="">Select PCC</option>
					<?php foreach($lab_list as $key => $val) {?>
					<option value="<?php echo $key;?>"><?php echo $val;?></option>
					<?php }?>
				</select>
				<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>-->
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Type</td>
			<td>
				<input class="type" id="daily" type="radio" name="data[Runner][type]" value="1" onclick="change_type(this.value);" checked/>&nbsp;&nbsp;Daily
				<input class="type" id="adhoc" type="radio" name="data[Runner][type]" value="2" onclick="change_type(this.value);" />&nbsp;&nbsp;Adhoc
			</td>
		</tr>
		<tr class="daily">
			<td width="15%" class="boldText">From Date<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.from_date', array('class'=>'input-text datepicker2','style'=>'width:100px;','required')); ?>
			</td>
		</tr>
		<tr class="daily">
			<td width="15%" class="boldText">To Date<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.to_date', array('class'=>'input-text datepicker2','style'=>'width:100px;','required')); ?>
			</td>
		</tr>
		<tr class="adhoc" style="display:none;">
			<td width="15%" class="boldText">Schedule Date<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.date', array('class'=>'input-text datepicker','style'=>'width:100px;','required')); ?>
			</td>
		</tr>
		<tr class="daily">
			<td width="15%" class="boldText">Working Days</td>
			<td>
				<?php foreach($working_day as $key => $val){ ?>
					<input type="checkbox" name="data[Runner][working_day][<?php echo $key; ?>]" value="<?php echo $key; ?>"> <?php echo $val; ?>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Time Slot</td>
			<td>
				<select name="data[Runner][time_slot]" id="agent_timeslot" class="input-text" required>
					<?php foreach($time_slot as $key => $val) {?>
					<option value="<?php echo $key;?>"><?php echo $val;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Runner Charges<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.runner_charges', array('class'=>'input-text','style'=>'width:100px;','onkeypress'=>'return checknum(event)','required')); ?>
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
			<td width="15%" class="boldText">Pickup Location<font color="#FF0000">*</font></td>
			<td <?php echo $class;?>>
				<select name="data[Runner][pick_loc_id]" id="RunnerPickLocId" class="input-text" style="width:235px;" required="required" onchange="getpickloc()">
					<option value="">Select Pick Location</option>
					<?php foreach($pick_loc as $key => $val) {?>
					<option value="<?php echo $key;?>" <?php if($runnerservicelist[$ctr]['RunnerRequest']['pick_loc_id']==$key) echo 'selected';?>><?php echo $val;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Pickup Location Name</td>
			<td>
				<?php echo $form->text('Runner.pickup_location_name', array('class'=>'input-text')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Name<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.pickup_name', array('class'=>'input-text','required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Contact<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.pickup_contact', array('class'=>'input-text','maxlength'=>'10','onkeypress'=>'return checknum(event)','required'=>'required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Alternate Contact</td>
			<td>
				<?php echo $form->text('Runner.pickup_alt_contact', array('class'=>'input-text','maxlength'=>'10','onkeypress'=>'return checknum(event)')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Pincode<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.pickup_pincode', array('class'=>'input-text','maxlength'=>'6','minlength'=>'6','onkeypress'=>'return checknum(event)','onkeyup'=>'getcitystate("RunnerPickup");','required'=>'required')); ?>
				<div id="msg_pin" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">City</td>
			<td>
				<select name="data[Runner][pickup_city]" id="RunnerPickupCityId" class="input-text" readonly>
					<option value="">Select City</option>
					<?php foreach($city as $key => $val) {?>
					<option value="<?php echo $val['City']['id'];?>"><?php echo $val['City']['name'];?></option>
					<?php }?>
				</select>
				<div id="msg9" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">State</td>
			<td>
				<select name="data[Runner][pickup_state]" id="RunnerPickupState" class="input-text" readonly>
					<option value="">Select State</option>
					<?php foreach($state as $key => $val) {?>
					<option value="<?php echo $val['State']['id'];?>"><?php echo $val['State']['name'];?></option>
					<?php }?>
				</select>
				<div id="msg10" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>
		<!--<tr>
			<td width="15%" class="boldText">Locality<font color="#FF0000">*</font></td>
			<td>
				<select name="data[Runner][pickup_locality]" id="RunnerPickupLocality" class="input-text" required>
				</select>
				<div id="msg9" style="color:#FF0000; font-size:12px;"></div>
			</td>	
		</tr>-->
		<tr>
			<td width="15%" class="boldText">Address <font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.pickup_address', array('class'=>'input-text','required')); ?>
			</td>
		</tr>
		
		<tr>
			<td width="15%" class="boldText">Landmark</td>
			<td>
				<?php echo $form->text('Runner.pickup_landmark', array('class'=>'input-text')); ?>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Google Location URL</td>
			<td>
				<?php echo $form->text('Runner.pickup_location', array('class'=>'input-text')); ?>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Drop Location</td>
			<td <?php echo $class;?>>
				<select name="data[Runner][drop_loc_id]" id="RunnerDropLocId" class="input-text" style="width:235px;" required>
					<option value="0">Select Drop Location</option>
					<?php foreach($drop_loc as $key => $val) {?>
					<option value="<?php echo $key;?>" <?php if($runnerservicelist[$ctr]['RunnerRequest']['drop_loc_id']==$key) echo 'selected';?>><?php echo $val;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->submit('Save & Submit', array('div'=>false, 'class' => 'btn','onclick'=>'')); ?></td>
		</tr>
	</table>
	<?php echo $form->end(); ?>
</div>

<script type="text/javascript">
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