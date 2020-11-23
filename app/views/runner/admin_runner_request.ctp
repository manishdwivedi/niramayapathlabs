<script type="text/javascript">
$(function() {
	$( ".datepicker1" ).datepicker({
		maxDate: '+30D',
		dateFormat: 'dd-mm-yy'
	});

	$(".edit_agent").click(function(e){
		e.preventDefault();
		var id = e.currentTarget.id;
		var r_id = id.replace('edit_agent','');
		console.log(e.currentTarget.id);

		$('#edit_agent'+r_id).hide();
		$('#confirm_agent'+r_id).show();
		$('#runner_agent'+r_id).attr("disabled", false);
	});
});
</script>
<style>
.LabBtn {
    border-radius: 3px;
    color: #fff !important;
    display: block;
    font-size: 14px;
    font-weight: 700;
    height: 32px;
    line-height: 32px;
    text-align: center;
    text-decoration: none;
    width: auto;
    background: #b5d438;
    color: #fff;
    font-weight: 700;
    cursor: pointer;
    border: 1px solid #73b110;
}
</style>
<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Runner Request List</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/runner/runner_service', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Runner Request List
     <a class="LabBtn" style="width: 200px;float: right;margin-bottom: 5px;" href="/admin/runner/assign_routerunner">+ Assign Runner Route Wise</a>
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/runner/runner_request')); ?>
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
				<!--<td style="width:100px;">
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
				</td>-->
				<td>
                    <?php if(empty($data_req_city)) {?>
					<select name="data[Filter][city]" class="input-Search">
						<option value="">Select City</option>
						<?php foreach($city as $key => $val) {?>
						<option value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
						<option value="Home">Home Collection</option>
					</select>
					<?php } else {?>
					<select name="data[Filter][city]" class="input-Search">
						<option value="">Select City</option>
						<?php foreach($city as $key => $val) {?>
						<option value="<?php echo $key;?>" <?php if($data_req_city == $key) {?> selected="selected" <?php }?>><?php echo $val;?></option>
						<?php }?>
					</select>
					<?php }?>
				</td>
				
				<td>
                    <?php if(empty($data_req_status)) {?>
					<select name="data[Filter][status]" class="input-Search">
						<option value="">Select Status</option>
						<?php foreach($runner_status as $key => $val) {?>
						<option value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
						<option value="Home">Home Collection</option>
					</select>
					<?php } else {?>
					<select name="data[Filter][status]" class="input-Search">
						<option value="">Select Status</option>
						<?php foreach($runner_status as $key => $val) {?>
						<option value="<?php echo $key;?>" <?php if($data_req_status == $key) {?> selected="selected" <?php }?>><?php echo $val;?></option>
						<?php }?>
					</select>
					<?php }?>
				</td>
				<td>
                    <?php if(empty($data_req_runner)) {?>
					<select name="data[Filter][runner]" class="input-Search">
						<option value="">Select Runner</option>
						<?php foreach($agent_list as $key => $val) {?>
						<option value="<?php echo $key;?>"><?php echo $val;?></option>
						<?php }?>
						<option value="Home">Home Collection</option>
					</select>
					<?php } else {?>
					<select name="data[Filter][runner]" class="input-Search">
						<option value="">Select Runner</option>
						<?php foreach($agent_list as $key => $val) {?>
						<option value="<?php echo $key;?>" <?php if($data_req_runner == $key) {?> selected="selected" <?php }?>><?php echo $val;?></option>
						<?php }?>
					</select>
					<?php }?>
				</td>
				
				<td>
					<?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?>
				</td>
			</tr>
		</thead>
	</table>
	<?php echo $form->end(); ?>
	<table border="0" width="100%">
		<thead>
			<tr>
				<th width="5%" style="text-align:center;"><h4>S.No.</h4></th>
				<th width="5%" style="text-align:center;"><h4>Runner Id</h4></th>
				<th style="text-align:center;"><h4>Pick Location Name</h4></th>
				<th style="text-align:center;"><h4>Date</h4></th>
				<th style="text-align:center;"><h4>City</h4></th>
				<th style="text-align:center;"><h4>Drop Location</h4></th>
				<th style="text-align:center;"><h4>Runner</h4></th>
				<th style="text-align:center;"><h4>Created By</h4></th>
				<th style="text-align:center;"><h4>Status</h4></th>
				<th style="text-align:center;"><h4>Action</h4></th>
				
				
			</tr>
		</thead>
		<?php
		$status_color = array('1'=>'#efceff','2'=>'#cdd756','3'=>'#F5FFA1','4'=>'#A1FFB9','5'=>'#D8FF95','6'=>'#FAAC2E','7'=>'#B3F7FE','8'=>'#e5e9ff');
		if(isset($runnerservicelist) && count($runnerservicelist) > 0){
			$countTicket = count($runnerservicelist);
			for($ctr=0;$ctr<$countTicket;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					//$class = " class=\"alt\"";
				}
		?>
		
		<tr <?php echo $class;?> style="border-bottom:1px solid #666666;background-color:<?php echo $status_color[$runnerservicelist[$ctr]['RunnerRequest']['status']];?>">
			<td <?php echo $class;?> style="text-align:center;">
				<?php										
					echo ($ctr+1);
				?>
			</td>
			<td <?php echo $class;?>><?php echo $runnerservicelist[$ctr]['RunnerRequest']['runner_request_id'];?></td>
			<td <?php echo $class;?>>
				<?php echo $runnerservicelist[$ctr]['RunnerRequest']['pickup_location_name'];?>
			</td>
			<!-- Booked By - <?php echo $pcc_list[$runnerservicelist[$ctr]['RunnerRequest']['booked_by']];?> <br>
				Serviced By - <?php echo $pcc_list[$runnerservicelist[$ctr]['RunnerRequest']['serviced_by']];?> -->
			<td <?php echo $class;?>><?php echo date('d-m-Y',strtotime($runnerservicelist[$ctr]['RunnerRequest']['date']));?> <br>
				<?php echo $time_slot[$runnerservicelist[$ctr]['RunnerRequest']['time_slot']];?>
			</td>
			<td <?php echo $class;?>><?php echo $city[$runnerservicelist[$ctr]['RunnerRequest']['pickup_city']]." - ".$runnerservicelist[$ctr]['RunnerRequest']['pickup_pincode'];?></td>
			<td <?php echo $class;?>>
				<?php if(isset($runnerservicelist[$ctr]['RunnerRequest']['drop_loc_id']))
					echo $drop_loc[$runnerservicelist[$ctr]['RunnerRequest']['drop_loc_id']];
				else
					echo "-"; 
				?>
			</td>
			
			<td <?php echo $class;?>>
				<select id="runner_agent_<?php echo $runnerservicelist[$ctr]['RunnerRequest']['id'];?>" onchange="assign_agent(this.value,'<?php echo $runnerservicelist[$ctr]['RunnerRequest']['id'];?>');" style="width:140px;" <?php if($runnerservicelist[$ctr]['RunnerRequest']['id']!=0){ echo 'disabled'; }  ?>>
					<option value="0">Select Agent</option>
					<?php foreach($agent_list as $key => $val) {?>
					<option value="<?php echo $key;?>" <?php if($runnerservicelist[$ctr]['RunnerRequest']['agent_id']==$key) echo 'selected';?>><?php echo $val;?></option>
					<?php }?>
				</select>
				<input id="confirm_agent_<?php echo $runnerservicelist[$ctr]['RunnerRequest']['id'];?>" type="button" onclick="confirm_agent('<?php echo $runnerservicelist[$ctr]['RunnerRequest']['id'];?>')" value="Confirm" style="display:<?php if($runnerservicelist[$ctr]['RunnerRequest']['id']!=0){ echo 'none'; } else { echo 'inline';} ?>">
				<a href="#" class="edit_agent" id="edit_agent_<?php echo $runnerservicelist[$ctr]['RunnerRequest']['id'];?>" style="display:<?php if($runnerservicelist[$ctr]['RunnerRequest']['id']!=0){ echo 'inline'; } else { echo 'none';} ?>" >Edit</a>
			</td>
			<td <?php echo $class;?>><?php echo $users[$runnerservicelist[$ctr]['RunnerRequest']['created_by']];?></td>
			<td <?php echo $class;?>>
				<?php echo $runner_status[$runnerservicelist[$ctr]['RunnerRequest']['status']];?><br>
				<?php if(!empty($runnerservicelist[$ctr]['RunnerRequest']['runner_schedule_url'])){ ?> <a style="font-size: smaller;" href="<?php echo $runnerservicelist[$ctr]['RunnerRequest']['runner_schedule_url']; ?>" target="_blank">View Runner Schedule</a> <?php } ?>
			</td>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Show',array('controller'=>'runner','action'=>'edit_runner_request',base64_encode($runnerservicelist[$ctr]['RunnerRequest']['id'])));?></td>
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
<?php echo $form->end(); ?>
</div>
<script>
function confirm_agent(id)
{
	var agent_id = $('#runner_agent_'+id).val();
	//console.log(agent_id);
	if(agent_id!=0)
	{
		jQuery.ajax({
			type:'GET',
			url:siteUrl+'admin/runner/confirm_runner_agent?id='+id,
			success:function(data){
				console.log(data);
				alert('Runner Confirmed');
				$('#edit_agent_'+id).show();
				$('#confirm_agent_'+id).hide();
				$('#runner_agent_'+id).attr("disabled", true);
			}
		});
	}
}

function assign_agent(val,id)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/runner/assign_runner_agent?agent='+val+'&id='+id,
		success:function(data){
			alert('Runner assigned');
			//window.location.href=siteUrl+'admin/runner/runner_request';
		}
	});
}

function assign_drop(val,id)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/runner/assign_drop?drop_id='+val+'&id='+id,
		success:function(data){
			alert('Drop Location assigned');
			//window.location.href=siteUrl+'admin/runner/runner_request';
		}
	});
}

</script>