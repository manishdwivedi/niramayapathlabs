<script language="JavaScript" type="text/javascript">
	$(function(){
		$(".observation").keyup(function() 
		{ 
			var selectedlocation = $('#ZonePickupLocation').val();
			var search = $('#RunnerRequestZonelocations').val();
			var dataString = 'search='+search+'&s_l='+selectedlocation;
			console.log(search);
			if(search!=""){
				console.log("search");
				jQuery.ajax({
					type:'POST',
					url:siteUrl+"admin/runner/get_location",
					data: dataString,
					cache: false,
					success: function(response) {
						$("#locationList").html(response);
					}
				});
			}
			else
			{
				$("#locationList").html("");
			}  
		});

		$('#locationList').change(function(){ 
			var id = $(this).val();
			var sel_loc = $('#ZonePickupLocation').val();

			var dataString = 'id='+id+'&sel_loc='+sel_loc;
			jQuery.ajax({
				type:'POST',
				url:siteUrl+"admin/runner/loc_detail",
				data: dataString,
				cache: false,
				success: function(response) {
					if(response=='failure')
					{
						$('#msg10').show();
						$('#msg10').html("Location Already Selected.");
					}
					else
					{
						var data = response.split('@@@@@');

						$("#selectedlocation").html(data[0]);
						$("#ZonePickupLocation").val(data[1]);	
					}					
				},
			});

		});
	});

	function delete_loc(id)
	{
		var sel_loc = $('#ZonePickupLocation').val();
		var locations = sel_loc.split(',');
		locations.splice($.inArray(id.toString(), locations),1);

		$('#loc'+id).remove();
		var newloc = locations.join(',');
		$('#ZonePickupLocation').val(newloc);
		
		value="";
		var sel_loc = $('#ZonePickupLocation').val();
		var dataString = 'id='+value+'&sel_loc='+sel_loc;

		jQuery.ajax({
			type:'POST',
			url:siteUrl+"admin/runner/loc_detail",
			data: dataString,
			cache: false,
			success: function(response) {
				if(response=='failure')
				{
					$('#msg10').show();
					$('#msg10').html("Location Already Selected.");
				}
				else
				{
					var data = response.split('@@@@@');

					$("#selectedlocation").html(data[0]);
					$("#ZonePickupLocation").val(data[1]);	
				}					
			},
		});
	}
</script>

<div class="contentcontainer">
	<div class="headings altheading">
        <h2>Add New Route</h2>
    </div>
    <div class="contentbox">
	<?php echo $this->Session->flash(); ?>
	<?php if($usertype != 'Agent') {?>
	<?php echo $html->link('Home', '/admin/runner/zone_list', array('title'=>'Home')); ?> &#187; Add New Route
	<?php }?>
	
	<?php echo $form->create(null, array('url'=>'/admin/runner/add_route','id'=>'form1','name'=>'form1')); ?>
	<?php echo $form->hidden('Health.login_type',array('value'=>$LoginType));?>
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Route Name<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Zone.name', array('class'=>'input-text','required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Description<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Zone.description', array('class'=>'input-text','required')); ?>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Shift<font color="#FF0000">*</font></td>
			<td>
				<select id='data[Zone][time_of_day]' name='data[Zone][time_of_day]' style="width:323px;" required>
					<option value="">Select The Shift</option>
					<option value="morning">Morning</option>
					<option value="evening">Evening</option>
				</select>
			</td>
		</tr>
		<tr style="height: 40px;">
			<td width="15%" class="boldText">Pickup Location<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('zonelocations', array('class'=>'input-text observation')); ?>
				<br>
				<select id='locationList' multiple style="width:323px;margin-top: 20px;"></select><br><br>
				<div id="msg10" style="color:#FF0000; font-size:15px;margin-bottom: 10px;"></div>
				<b style="font-size:15px;">Selected Locations</b><br>
				<div id="selectedlocation" style="margin-top: 10px;"></div>
				<br>
				<?php echo $form->text('Zone.pickup_location', array('class'=>'class-textarea','style'=>'display:none;')); ?>
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