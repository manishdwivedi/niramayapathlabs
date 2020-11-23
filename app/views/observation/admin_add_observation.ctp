<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Add Observation</h2>
    </div>
    <div class="contentbox">
		<?php echo $this->Session->flash(); ?>
		<?php echo $html->link('Home', '/admin/observation/add_observation', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Add Observation
		<div>&nbsp;</div>
		<?php echo $form->create(array('id'=>'add_obs','name'=>'add_obs','enctype'=>'multipart/form-data'));?>
		<table border="0" width="100%">
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Observation Name</label>
				</td>
				<td>
					<?php echo $form->text('Observation.observation_name', array('class'=>'input-text','style'=>'width:200px;','required'=>'required')); ?>
					<label id="name_error" style="color:#FF0000; font-size:12px; clear:both;display:none;">Name Field cannot be empty.</label>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Method</label>
				</td>
				<td>
					<?php echo $form->text('Observation.method', array('class'=>'input-text','style'=>'width:200px;','required'=>'required')); ?>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Machine</label>
				</td>
				<td>
					<select id="selectmachine" name="data[Observation][machine]" class="input-Search" style="height:35px;width:200px;" required onchange="check(this);">
						<option value="">Select Machine</option>
						<?php foreach($machinelist as $key => $val) {?>
						<option value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
				<td>
					<?php echo $form->text('customselectmachine', array('class'=>'input-text','style'=>'width:200px;display:none;')); ?>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Gender</label>
				</td>
				<td width="15%">
					<select id="selectgender" name="data[Observation][gender]" class="input-Search" style="height:35px;width:200px;" required>
						<option value="">Select Gender</option>
						<?php foreach($gender as $key => $val) {?>
						<option value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">OS / Inhouse</label>
				</td>
				<td>
					<select id="selectosinhouse" name="data[Observation][os_inhouse]" class="input-Search" style="height:35px;width:200px;" required onchange="check(this);">
						<option value="">Select OS / In House</option>
						<?php foreach($os_inhouse as $key => $val) {?>
						<option value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
				<td>
					<?php echo $form->text('customselectosinhouse', array('class'=>'input-text','style'=>'width:200px;display:none;')); ?>
				</td>
			</tr>
			
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Department</label>
				</td>
				<td>
					<select id="selectdepartment" name="data[Observation][department]" class="input-Search" style="height:35px;width:200px;" required onchange="check(this);">
						<option value="">Select Department</option>
						<?php foreach($department as $key => $val) {?>
						<option value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
				<td>
					<?php echo $form->text('customselectdepartment', array('class'=>'input-text','style'=>'width:200px;display:none;')); ?>
				</td>
			</tr>
			
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">Sample Type</label>
				</td>
				<td>
					<select id="selectsample" name="data[Observation][sample_type]" class="input-Search" style="height:35px;width:200px;" required>
						<option value="">Select Sample Type</option>
						<?php foreach($sampletype as $key => $val) {?>
						<option value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
					</select>
					<label id="email_error" style="color:#FF0000; font-size:12px; clear:both;display:none;">Email Field cannot be empty.</label>
				</td>
			</tr>
			
			<tr>
				<td width="15%">
					<label style="font-size: large; font-weight: 300;color: black;float: left;">is NABL?</label>
				</td>
				<td>
					<input type="radio" name="data[Observation][nabl]" id="ObservationNabl1" value="1" <?php if($this->data['Observation']['nabl'] == 1) {?> checked="checked" <?php }?> />&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="data[Observation][nabl]" id="ObservationNabl2" value="0" <?php if($this->data['Observation']['nabl'] == 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;No
				</td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
				<td><input id="observationsubmit" class="btn" type="submit" value="Submit"/></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>	
	<?php echo $form->end();?>
	</div>
</div>
<script>
	function check(e)
	{
		var val = $('#'+e.id).val();
		if(val=='Others')
		{
			$('#ObservationCustom'+e.id).show();
			$('#ObservationCustom'+e.id).attr('required',true);
		}
		else
		{
			$('#ObservationCustom'+e.id).hide();
			$('#ObservationCustom'+e.id).attr('required',false);
		}
	}
</script>