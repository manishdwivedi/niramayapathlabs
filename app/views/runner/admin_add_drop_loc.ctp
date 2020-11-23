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
        <h2>Add New Drop Location</h2>
    </div>
    <div class="contentbox">
	<?php echo $this->Session->flash(); ?>
	<?php if($usertype != 'Agent') {?>
	<?php echo $html->link('Home', '/admin/runner/add_drop_loc', array('title'=>'Home')); ?> &#187; Add New Drop Location
	<?php }?>
	
	<?php echo $form->create(null, array('url'=>'/admin/runner/add_drop_loc','onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1')); ?>
	<?php echo $form->hidden('Health.login_type',array('value'=>$LoginType));?>
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		<tr>
			<td colspan="2"><h3>Drop Location Details</h3></td>
		</tr>
		<tr>
			<td colspan="2"><hr></td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Location Name<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('DropLocations.location_name', array('class'=>'input-text','required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">POC Name<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('DropLocations.poc', array('class'=>'input-text','required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">POC Contact<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('DropLocations.contact', array('class'=>'input-text','maxlength'=>'10','onkeypress'=>'return checknum(event)','required'=>'required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Alternate Contact</td>
			<td>
				<?php echo $form->text('DropLocations.alt_contact', array('class'=>'input-text','maxlength'=>'10','onkeypress'=>'return checknum(event)')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Pincode<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('DropLocations.pincode', array('class'=>'input-text','maxlength'=>'6','minlength'=>'6','onkeypress'=>'return checknum(event)','onkeyup'=>'getcitystate("DropLocations");','required'=>'required')); ?>
				<div id="msg_pin" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">City</td>
			<td>
				<select name="data[DropLocations][city]" id="DropLocationsCityId" class="input-text" disabled>
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
				<select name="data[DropLocations][state]" id="DropLocationsState" class="input-text" disabled>
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
				<select name="data[DropLocations][locality]" id="DropLocationsLocality" class="input-text" required>
				</select>
				<div id="msg9" style="color:#FF0000; font-size:12px;"></div>
			</td>	
		</tr>-->
		<tr>
			<td width="15%" class="boldText">Address <font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('DropLocations.address', array('class'=>'input-text','required')); ?>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Landmark</td>
			<td>
				<?php echo $form->text('DropLocations.landmark', array('class'=>'input-text')); ?>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Google Location URL</td>
			<td>
				<?php echo $form->text('DropLocations.geolocation', array('class'=>'input-text')); ?>
			</td>
		</tr>
		
		<tr>
			<tr>
				<td><?php echo $form->submit('Save & Submit', array('div'=>false, 'class' => 'btn','onclick'=>'')); ?></td>
			</tr>
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