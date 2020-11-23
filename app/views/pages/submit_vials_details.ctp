<style>
.d-table {
  min-width: 300px;
  min-height: 300px;
  background: lightgrey;
  display: block;
}

.d-table ul {
  list-style-type: none;
}

.d-column li {
  padding: 0px;
  display: inline-block;
  background: grey;
  width: 50px;
  height: 20px;
}

.d-row li {
  padding: 0px;
  display: inline-block;
  width: 50px;
  height: 20px;
}

.LabBtn {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 15px;
  border-radius: 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

#runnercontainer
{
	padding-left:32%;padding-right:32%;padding-top: 10px;padding-bottom: 10px;
}
.headings {
	font-size:12px;
}
.contentbox
{
	font-size:11px;
}
.boldtext {
	width : 150px;
}
@media only screen and (max-width: 600px) {
	#runnercontainer {
	padding-left:2%;padding-right:2%;padding-top: 10px;padding-bottom: 10px;
	}
	.headings{
	font-size:10px;
	}
	.contentbox
	{
		font-size:9px;
	}
	.boldtext {
		width : 75px;
	}
}

</style>
<div class="contentcontainer">

		<div id="runner_pickup_detail" style="display:<?php if($this->data['Runner']['status'] >= 3 && $this->data['Runner']['status'] <=6) { echo 'inline'; } else { echo 'none';}?>">
		<hr>
			<h3 style="text-align: -webkit-center;font-size: x-large;">Pick Up Details</h3>
		<hr>
		<?php 
		if($this->data['Runner']['status'] == 3){
			$url = '/pages/runner_pickup_data/';
		}
		
		if($this->data['Runner']['status'] == 4){
			$url = '/pages/runner_drop_data/';
		}
		
		if($this->data['Runner']['status'] == 5){
			$url = '/pages/runner_confirm_data/';
		}
		
		?>
		<?php echo $form->create(array('url'=>$url.base64_encode($this->data['Runner']['id']),'id'=>'form9','name'=>'form9','style'=>'text-align: -webkit-center;'));?>
		<?php echo $form->hidden('Health.login_action',array('value'=>'Super'));?>
		<div style="margin-top:20px;max-width:950px;text-align: left;">
			<label style="font-size:large;width:60px;height:25px;font-weight:600;">Pick Up Charges To Be Collected</label>
			<input style="width:60px;height:25px;" type="number" value="<?php echo $this->data['Runner']['recieved_amount']; ?>" id="runnerrecievedamount" name="data[Runner_pickup][recieved_amount]" onkeypress="return checknum(event)" <?php if($this->data['Runner']['status'] >= 6 || $this->data['Runner']['recieved_amount']==$this->data['Runner']['runner_charges']) { echo "disabled"; }?>>
		</div>
		<div style="max-width:950px;text-align: left;">
			<label style="font-size:large;width:60px;height:25px;font-weight:600;">Runner Id - </label>
			<label style="font-size:large;width:60px;height:25px;"><?php echo $this->data['Runner']['runner_request_id']; ?></label>
		</div>
		<div style="max-width:950px;text-align: left;">
			<label style="font-size:large;width:60px;height:25px;font-weight:600;">Pick Up Name - </label>
			<label style="font-size:large;width:60px;height:25px;"><?php echo $this->data['Runner']['pickup_location_name']; ?></label>
		</div>
		<div style="max-width:950px;text-align: left;">
			<label>* - No. of vials</label>
		</div>
				<div class="d-table" style="max-width:600px;text-align: left;">
			<?php if($this->data['Runner']['status'] > 3 ) {?>
				<?php if($this->data['Runner']['status'] > 3 ) {?>
					<ul class="d-column" style="height:50px;font-size: 15px;background:white;">
						<li colspan="3" style="width:100%;color:green;background:white;"><?php echo "<sulong>Sample Pick Up Time - </sulong>".date("F j, Y, g:i a",strtotime($this->data['Runner']['pickup_datetime'])); ?></li>
					</ul>
				<?php } ?>
				<?php if($this->data['Runner']['status'] > 4 ) {?>
					<ul style="height:50px;font-size: 15px;background:white;">
						<li colspan="3" style="width:100%;color:red;background:white;"><?php echo "<sulong>Sample Drop Time - </sulong>".date("F j, Y, g:i a",strtotime($this->data['Runner']['drop_datetime'])); ?></li>
					</ul>
				<?php } ?>
			<?php } ?>
			<ul class="d-row" style="font-weight:600;color:black;font-size:600;">
				<li style="padding-left:10px;line-height: 50px; font-size: 12px;width:45%;">Sample Type</li>
				<li style="line-height: 50px; font-size: 12px;width:25%;">Pick Up *</li>
				<li style="line-height: 50px; font-size: 12px;width:25%">Drop *</li>
			</ul>
			<?php foreach($sample_specific as $key=>$val) { ?>
				<ul class="d-row" style="background:<?php echo $sample_color[$key]; ?>;font-weight: 600;color:black;height:40px;">
					<li style="width:45%;"><label style="padding-bottom:0px;padding-left:10px;font-size:12px;" id="sample_type_<?php echo $val; ?>" name="sample_type[<?php echo $val; ?>]" value="<?php echo $val; ?>"><?php echo $key; ?></label></li>
					<li style="width:25%;"><input style="height: 25px;margin-top:5px;width:50px;border-style: double;" type="text" id="sample_pickup_<?php echo $val; ?>" name="pickup_sample_value[<?php echo $val; ?>]" value="<?php if(isset($pickup_sample_value[$val])) { echo $pickup_sample_value[$val]; }?>" <?php if($this->data['Runner']['status'] > 3 ) { echo 'disabled'; }?>></li>
					<li style="width:25%;"><input style="height: 25px;margin-top:5px;width:50px;border-style: double;" type="text" id="sample_drop_<?php echo $val; ?>" name="drop_sample_value[<?php echo $val; ?>]" value="<?php echo $drop_sample_value[$val];?>" <?php if($this->data['Runner']['status'] > 4 || $this->data['Runner']['status']==3 || !isset($pickup_sample_value[$val])) { echo 'disabled'; }?> <?php if(isset($pickup_sample_value[$val])) { echo 'required'; }?>></li>
				</ul>
			<?php }?>
			<ul class="d-row" style="background:red;color:black;font-weight: 600;height:40px;">
				<li style="width:45%;">
					<label style="font-weight: 600;margin-left:10px;">Others</label>
				</li>
				<li style="width:25%;"><input style="height: 25px;margin-top:5px;width:50px;border-style: double;" type="text" id="sample_pickup_others" name="pickup_sample_others" value="<?php if(isset($pickup_sample_value['others'])) { echo $pickup_sample_value['others']; }?>" <?php if($this->data['Runner']['status'] > 3 ) { echo 'disabled'; }?>></li>
				<li style="width:25%;"><input style="height: 25px;margin-top:5px;width:50px;border-style: double;" type="text" id="sample_drop_others" name="drop_sample_others" value="<?php echo $drop_sample_value['others'];?>" <?php if($this->data['Runner']['status'] > 4 || $this->data['Runner']['status']==3 || !isset($pickup_sample_value['others'])) { echo 'disabled'; }?> <?php if(isset($pickup_sample_value['others'])) { echo 'required'; }?>></li>
			</ul>
			<ul class="d-row">
				<li style="width:45%;"><label style="height: 100px;font-weight: 600;">Pickup Remarks</label></li>
				<li colspan="2" style="width:50%;"><textarea required name="pickup_remarks" <?php if($this->data['Runner']['status'] > 3 ) { echo 'disabled'; }?> style="height: 100px;width: 90%;border-style: double;margin-top:5px;"><?php if(isset($this->data['Runner']['pickup_remark'])) { echo $this->data['Runner']['pickup_remark']; }?></textarea></li>
			</ul>
			<ul class="d-row">
				<li style="width:45%;"><label style="height: 100px;font-weight: 600;">Drop Remarks</label></li>
				<li colspan="2" style="width:50%;"><textarea required name="drop_remarks" <?php if($this->data['Runner']['status'] > 4 ||  $this->data['Runner']['status']==3) { echo 'disabled'; }?> style="height: 100px;width: 90%;border-style: double;"><?php if(isset($this->data['Runner']['drop_remark'])) { echo $this->data['Runner']['drop_remark']; }?></textarea></li>
			</ul>
			<ul class="d-row">
				<li id="sample_collected_button">
					<button type="submit" id="save_pickup" class="LabBtn" style="width:150px;display:<?php if($this->data['Runner']['status'] == 3 ) { echo 'inline'; } else { echo 'none'; }?>" >Save Pick Up Data</button>
					<button type="submit" id="save_drop" class="LabBtn" style="width:150px;display:<?php if($this->data['Runner']['status'] == 4 ) { echo 'inline'; } else { echo 'none'; }?>">Save Drop Data</button>
				</li>
				
				<li>&nbsp;</li>
				<li>&nbsp;</li>
			</ul>
		</div>
		<input type="hidden" value="pickup" id="runnerrequesttype" name="data[Runner_pickup][type]">
		<input type="hidden" value="1" id="samplecount">
		<?php echo $form->end();?>
	</div>	
</div>