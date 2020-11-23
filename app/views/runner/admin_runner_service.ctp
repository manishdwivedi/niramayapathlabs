<script type="text/javascript">
$(function() {
	$( ".datepicker1" ).datepicker({
		maxDate: '+30D',
		dateFormat: 'dd-mm-yy'
	});
});
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Runner Service List</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/runner/runner_service', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Runner Service List
	<div>&nbsp;</div>
	<!--<?php echo $form->create(null, array('url'=>'/admin/runner/runner_service')); ?>
	<table border="0">
		<thead>
			<tr>
				<td style="width:100px;">
					<?php if(empty($data_req_from_date)) {?>
					<input type="text" name="data[Filter][req_from_date]" class="input-Search datepicker1" style="width:100px;" placeholder="From Date" />
					<?php } else {?>
					<input type="text" name="data[Filter][req_from_date]" class="input-Search datepicker1" style="width:100px;" placeholder="From Date" value="<?php echo $data_req_from_date;?>" />
					<?php }?>
				</td>
				<td style="width:100px;">
					<?php if(empty($data_req_to_date)) {?>
					<input type="text" name="data[Filter][req_to_date]" class="input-Search datepicker1" style="width:100px;" placeholder="To Date" />
					<?php } else {?>
					<input type="text" name="data[Filter][req_to_date]" class="input-Search datepicker1" style="width:100px;" placeholder="To Date" value="<?php echo $data_req_to_date;?>" />
					<?php }?>
				</td>
				<td style="width:100px;">
					<?php if(empty($data_req_lab1)) {?>
					<select name="data[Filter][req_lab1]" class="input-Search">
						<option value="">Select Booked By PCC</option>
						<?php foreach($pcc_list as $key => $val) {?>
						<option value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
						<option value="Home">Home Collection</option>
					</select>
					<?php } else {?>
					<select name="data[Filter][req_lab1]" class="input-Search">
						<option value="">Select Booked By PCC</option>
						<?php foreach($pcc_list as $key => $val) {?>
						<option value="<?php echo $key;?>" <?php if($data_req_lab1 == $key) {?> selected="selected" <?php }?>><?php echo $val;?></option>
						<?php }?>
						<option value="Home" <?php if($data_req_lab1 == 'Home') {?> selected="selected" <?php }?>>Home Collection</option>
					</select>
					<?php }?>
				</td>
				<td>
                    <?php if(empty($data_req_lab)) {?>
					<select name="data[Filter][req_lab]" class="input-Search">
						<option value="">Select Service By PCC</option>
						<?php foreach($pcc_list as $key => $val) {?>
						<option value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
						<option value="Home">Home Collection</option>
					</select>
					<?php } else {?>
					<select name="data[Filter][req_lab]" class="input-Search">
						<option value="">Select Service By PCC</option>
						<?php foreach($pcc_list as $key => $val) {?>
						<option value="<?php echo $key;?>" <?php if($data_req_lab == $key) {?> selected="selected" <?php }?>><?php echo $val;?></option>
						<?php }?>
						<option value="Home" <?php if($data_req_lab == 'Home') {?> selected="selected" <?php }?>>Home Collection</option>
					</select>
					<?php }?>
				</td>
				<td>
					<?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?>
				</td>
			</tr>
		</thead>
	</table>
	<?php echo $form->end(); ?>-->
	<table border="0" width="100%">
		<thead>
			<tr>
				<th width="5%" style="text-align:center;"><h4>S.No.</h4></th>
				<th style="text-align:center;"><h4>Pickup Location</h4></th>
				<th style="text-align:center;"><h4>Drop Location</h4></th>
				<th style="text-align:center;"><h4>From Date</h4></th>
				<th style="text-align:center;"><h4>To Date</h4></th>
				<th style="text-align:center;"><h4>Time Slot</h4></th>
				<th style="text-align:center;"><h4>Created By</h4></th>
				<th style="text-align:center;"><h4>Action</h4></th>
				
				
			</tr>
		</thead>
		<?php
		if(isset($runnerservicelist) && count($runnerservicelist) > 0){
			$countTicket = count($runnerservicelist);
			for($ctr=0;$ctr<$countTicket;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
		?>
		
		<tr <?php echo $class;?>>
			<td <?php echo $class;?> style="text-align:center;">
				<?php										
					echo ($ctr+1);
				?>
			</td>
			<td <?php echo $class;?>><?php if(!empty($runnerservicelist[$ctr]['RunnerService']['pick_loc_id'])) { echo $pick_loc[$runnerservicelist[$ctr]['RunnerService']['pick_loc_id']]; } else { echo $runnerservicelist[$ctr]['RunnerService']['pickup_location_name']; }?></td>
			<td <?php echo $class;?>><?php if(!empty($runnerservicelist[$ctr]['RunnerService']['drop_loc_id'])) { echo $drop_loc[$runnerservicelist[$ctr]['RunnerService']['drop_loc_id']]; } else { echo "-"; }?></td>
			<td <?php echo $class;?>><?php echo date('d-m-Y',strtotime($runnerservicelist[$ctr]['RunnerService']['from_date']));?></td>
			<td <?php echo $class;?>><?php echo date('d-m-Y',strtotime($runnerservicelist[$ctr]['RunnerService']['to_date']));?></td>
			<td <?php echo $class;?>><?php echo $time_slot[$runnerservicelist[$ctr]['RunnerService']['time_slot']];?></td>
			<td <?php echo $class;?>><?php echo $users[$runnerservicelist[$ctr]['RunnerService']['created_by']];?></td>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Show',array('controller'=>'runner','action'=>'edit_runner_service',base64_encode($runnerservicelist[$ctr]['RunnerService']['id'])));?></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="14" style="font-weight:bold; text-align:right;">
			<?php
				echo $this->element('pagination');
			?>
			</td>
		</tr>
		<?php }else{?>
		<tr>
			<td colspan="13" class="flash_failure" style=" float:none;">No records found.</td>
		</tr>
		<?php  } ?>
	</table>
</div>