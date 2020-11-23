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
	
	var id = "";
	var sel_zone = $('#PickupLocationsZones').val();

	var dataString = 'id='+id+'&sel_zone='+sel_zone;
	jQuery.ajax({
		type:'POST',
		url:siteUrl+"admin/runner/zone_detail",
		data: dataString,
		cache: false,
		success: function(response) {
			console.log(response);
			if(response=='failure')
			{
				$('#msg10').show();
				$('#msg10').html("Zone Already Selected.");
			}
			else
			{
				var data = response.split('@@@@@');

				$("#selectedroutes").html(data[0]);
				$("#PickupLocationsZones").val(data[1]);	
			}					
		},
	});

	$(".observation").keyup(function() 
	{ 
		var selectedlocation = $('#PickupLocationsZones').val();
		var search = $('#RunnerRequestRoutes').val();
		var dataString = 'search='+search+'&s_z='+selectedlocation;
		console.log(search);
		if(search!=""){
			console.log("search");
			jQuery.ajax({
				type:'POST',
				url:siteUrl+"admin/runner/get_zones",
				data: dataString,
				cache: false,
				success: function(response) {
					console.log(response);
					$("#routeList").html(response);
				}
			});
		}
		else
		{
			$("#routeList").html("");
		}  
	});

	$('#routeList').change(function(){ 
		console.log($(this).val());
		var id = $(this).val();
		var sel_zone = $('#PickupLocationsZones').val();

		var dataString = 'id='+id+'&sel_zone='+sel_zone;
		jQuery.ajax({
			type:'POST',
			url:siteUrl+"admin/runner/zone_detail",
			data: dataString,
			cache: false,
			success: function(response) {
				console.log(response);
				if(response=='failure')
				{
					$('#msg10').show();
					$('#msg10').html("Zone Already Selected.");
				}
				else
				{
					var data = response.split('@@@@@');

					$("#selectedroutes").html(data[0]);
					$("#PickupLocationsZones").val(data[1]);	
				}					
			},
		});

	});

	var pin = $('#PickupLocationsPincode').val();
	document.getElementById("msg_pin").innerHTML="";
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/runner/getcitystate?pin='+pin,
		success: function(response) {
			$('#PickupLocationsCityId option[value='+response["city"]+']').attr('selected','selected');						
			$('#PickupLocationsState option[value='+response["state"]+']').attr('selected','selected');
		},
		 dataType:"json"
	});
});

function delete_loc(id)
{
	var sel_zone = $('#PickupLocationsZones').val();
	var locations = sel_zone.split(',');
	locations.splice($.inArray(id.toString(), locations),1);

	$('#loc'+id).remove();
	var newloc = locations.join(',');
	$('#PickupLocationsZones').val(newloc);
	
	value="";
	var sel_zone = $('#PickupLocationsZones').val();
	var dataString = 'id='+value+'&sel_zone='+sel_zone;

	jQuery.ajax({
		type:'POST',
		url:siteUrl+"admin/runner/zone_detail",
		data: dataString,
		cache: false,
		success: function(response) {
			if(response=='failure')
			{
				$('#msg10').show();
				$('#msg10').html("Zone Already Selected.");
			}
			else
			{
				var data = response.split('@@@@@');

				$("#selectedroutes").html(data[0]);
				$("#PickupLocationsZones").val(data[1]);	
			}					
		},
	});
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
</script>
<div class="contentcontainer">
	<div class="headings altheading">
        <h2>Edit Pickup Location</h2>
    </div>
    <div class="contentbox">
	<?php echo $this->Session->flash(); ?>
	<?php if($usertype != 'Agent') {?>
	<?php echo $html->link('Home', '/admin/runner/edit_pick_loc', array('title'=>'Home')); ?> &#187; Edit Pickup Location
	<?php }?>
	
	<?php echo $form->create(null, array('url'=>'/admin/runner/edit_drop_loc/'.base64_encode($this->data['PickupLocations']['id']),'onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1')); ?>
	<?php echo $form->hidden('Health.login_type',array('value'=>$LoginType));?>
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		<tr>
			<td colspan="2"><h3>Pickup Location Details</h3></td>
		</tr>
		<tr>
			<td colspan="2"><hr></td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Location Name<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('PickupLocations.location_name', array('class'=>'input-text disabled','required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Routes<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('routes', array('class'=>'input-text disabled observation')); ?>
				<br>
				<select id='routeList' class="disabled" multiple style="width:323px;margin-top: 20px;"></select><br><br>
				<div id="msg10" style="color:#FF0000; font-size:15px;margin-bottom: 10px;"></div>
				<b style="font-size:15px;">Selected Routes</b><br>
				<div id="selectedroutes" style="margin-top: 10px;"></div>
				<br>
				<?php echo $form->text('PickupLocations.zones', array('class'=>'class-textarea','style'=>'display:none;')); ?>
			</td>
		</tr>		
		<tr style="height: 40px;">
			<td width="15%" class="boldText">POC Name<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('PickupLocations.poc', array('class'=>'input-text disabled','required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">POC Contact<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('PickupLocations.contact', array('class'=>'input-text disabled','maxlength'=>'10','onkeypress'=>'return checknum(event)','required'=>'required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Alternate Contact</td>
			<td>
				<?php echo $form->text('PickupLocations.alt_contact', array('class'=>'input-text disabled','maxlength'=>'10','onkeypress'=>'return checknum(event)')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Pincode<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('PickupLocations.pincode', array('class'=>'input-text disabled','maxlength'=>'6','minlength'=>'6','onkeypress'=>'return checknum(event)','onkeyup'=>'getcitystate("PickupLocations");','required'=>'required')); ?>
				<div id="msg_pin" style="color:#FF0000; font-size:12px;"></div>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">City</td>
			<td>
				<select name="data[PickupLocations][city]" id="PickupLocationsCityId" class="input-text" disabled>
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
				<select name="data[PickupLocations][state]" id="PickupLocationsState" class="input-text" disabled>
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
				<select name="data[PickupLocations][locality]" id="PickupLocationsLocality" class="input-text disabled" required>
					<?php foreach($locality_array as $key => $val) {?>
						<option value="<?php echo $key;?>"<?php if($key==$this->data['PickupLocations']['locality']) echo "selected";?>><?php echo $val;?></option>
					<?php }?>
				</select>
				<div id="msg9" style="color:#FF0000; font-size:12px;"></div>
			</td>	
		</tr>-->
		<tr>
			<td width="15%" class="boldText">Address <font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('PickupLocations.address', array('class'=>'input-text disabled','required')); ?>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Landmark</td>
			<td>
				<?php echo $form->text('PickupLocations.landmark', array('class'=>'input-text disabled')); ?>
			</td>
		</tr>
		<tr>
			<td width="15%" class="boldText">Google Location URL</td>
			<td>
				<?php echo $form->text('PickupLocations.geolocation', array('class'=>'input-text disabled')); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->submit('Save & Submit', array('id'=>'save_drop','div'=>false, 'class' => 'btn','style'=>'display:none')); ?>
				<button type="button" id="cancel_drop" class="btn" style="display:none" onclick="cancel();">Cancel</button>
				<button type="button" id="edit" class="btn" onclick="edit_data();">Edit</button>
			</td>
		</tr>
	</table>
	<?php echo $form->end(); ?>
</div>

<script type="text/javascript">
function cancel()
{
	$('.disabled').attr('disabled',true);
	$('.disabled').css("background", "lightgray");
	$('#edit').show();
	$('#cancel_drop').hide();
	$('#save_drop').hide();
}

function edit_data()
{
	$('.disabled').attr('disabled',false);
	$('.disabled').css("background", "white");
	$('#edit').hide();
	$('#cancel_drop').show();
	$('#save_drop').show();
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