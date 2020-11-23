<script>
$(function() {
	$( ".datepicker1" ).datepicker({
		//maxDate: 0,
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker2" ).datepicker({
		//maxDate: 0,
		dateFormat: 'dd-mm-yy'
	});
	
});
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Prescription Request(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
		<?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Prescription Request(s)
		<div>&nbsp;</div>
		<?php echo $form->create(null, array('url'=>'/admin/prescription/index')); ?>	
		<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
			
		<thead>
			<tr>
				<td>
					<?php if(empty($data_req_from_date)) {?>
					<input type="text" name="data[Filter][req_from_date]" class="input-Search datepicker1" style="width:100px;" placeholder="From Date" />
					<?php } else {?>
					<input type="text" name="data[Filter][req_from_date]" class="input-Search datepicker1" style="width:100px;" placeholder="From Date" value="<?php echo $data_req_from_date;?>" />
					<?php }?>
				</td>
				<td>
					<?php if(empty($data_req_to_date)) {?>
					<input type="text" name="data[Filter][req_to_date]" class="input-Search datepicker1" style="width:100px;" placeholder="To Date" />
					<?php } else {?>
					<input type="text" name="data[Filter][req_to_date]" class="input-Search datepicker1" style="width:100px;" placeholder="To Date" value="<?php echo $data_req_to_date;?>" />
					<?php }?>
				</td>
				<td>
					<select name="data[Filter][req_status]" class="input-Search" style="width:100px;">
						<option value="">Select Request Status</option>
						<?php foreach($status as $key=>$val) { ?>
							<option value="<?php echo $key; ?>" <?php if($req_status==$key){echo "selected";}?>><?php echo $val;?></option>
						<?php }?>
					</select>
				</td>
				<td>
					<?php if(empty($data_follow_up_date)) {?>
					<input type="text" name="data[Filter][follow_up_date]" class="input-Search datepicker1" style="width:100px;" placeholder="Follow Up Date" />
					<?php } else {?>
					<input type="text" name="data[Filter][follow_up_date]" class="input-Search datepicker1" style="width:100px;" placeholder="To Date" value="<?php echo $data_follow_up_date;?>" />
					<?php }?>
				</td>
				<td style="width:100px;">
					<?php if(empty($name)) {?>
					<input type="text" name="data[Filter][name]" class="input-Search" placeholder="Enter Name" />
					<?php } else {?>
					<input type="text" name="data[Filter][name]" class="input-Search" placeholder="Enter Name" value="<?php echo $name;?>" />
					<?php }?>
				</td>
				<td style="width:100px;">
					<?php if(empty($contact)) {?>
					<input type="text" name="data[Filter][contact]" class="input-Search" placeholder="Enter Phone Number" />
					<?php } else {?>
					<input type="text" name="data[Filter][contact]" class="input-Search" placeholder="Enter Phone Number" value="<?php echo $contact;?>" />
					<?php }?>
				</td>
				<td style="width:100px;">
					<?php if(empty($email)) {?>
					<input type="text" name="data[Filter][email]" class="input-Search" placeholder="Enter Email" />
					<?php } else {?>
					<input type="text" name="data[Filter][email]" class="input-Search" placeholder="Enter Email" value="<?php echo $email;?>" />
					<?php }?>
				</td>
				<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
			</tr>
			<tr>
				
				<th style="text-align:center; width:30px;"><h4>S No.</h4></th>
				<th style="text-align:center; width:100px;"><h4>Prescription Id</h4></th>
				<th style="text-align:center; width:100px;"><h4>Enquiry Date</h4></th>
				<th style="text-align:center; width:100px;"><h4>Follow Up Date</h4></th>
				<th style="text-align:center;"><h4>Name</h4></th>
				<th style="text-align:center;"><h4>Gender</h4></th>
				<th style="text-align:center;"><h4>Age</h4></th>
				<th style="text-align:center; width:150px;"><h4>Contact Number</h4></th>
				<th style="text-align:center; width:200px;"><h4>Email</h4></th>
				<th style="text-align:center;"><h4>Referred By</h4></th>
				<th style="text-align:center;"><h4>Status</h4></th>
				<th style="text-align:center;"><h4>Order Id</h4></th>
				<th style="text-align:center;"><h4>Edit</h4></th>
				<th style="text-align:center;"><h4>Remarks</h4></th>
			</tr>
			
		</thead>
		<?php
			if(isset($prescription) && count($prescription) > 0){
				$countRequest = count($samplerequestlist);
				$count = 1;
				foreach($prescription as $key){?>
					<?php if($key['PrescriptionMaster']['status'] == 1) {?>
					<tr style="background-color:#cdd756;" id="Pres_<?php echo $key['PrescriptionMaster']['id'];?>">
					<?php }?>
					<?php if($key['PrescriptionMaster']['status'] == 2) {?>
					<tr style="background-color:#F5FFA1;" id="Pres_<?php echo $key['PrescriptionMaster']['id'];?>">
					<?php }?>
					<?php if($key['PrescriptionMaster']['status'] == 3) {?>
					<tr style="background-color:#A1FFB9;" id="Pres_<?php echo $key['PrescriptionMaster']['id'];?>">
					<?php }?>
					<?php if($key['PrescriptionMaster']['status'] == 4) {?>
					<tr style="background-color:#66FFFF;" id="Pres_<?php echo $key['PrescriptionMaster']['id'];?>">
					<?php }?>
					<?php if($key['PrescriptionMaster']['status'] == 5) {?>
					<tr style="background-color:#FFFD66;" id="Pres_<?php echo $key['PrescriptionMaster']['id'];?>">
					<?php }?>
					<?php if($key['PrescriptionMaster']['status'] == 6) {?>
					<tr style="background-color:#FF6B66;" id="Pres_<?php echo $key['PrescriptionMaster']['id'];?>">
					<?php }?>
						<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo $count; ?></td>
						<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo $key['PrescriptionMaster']['prescription_id']; ?></td>
						<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo date('d-m-Y',strtotime($key['PrescriptionMaster']['date'])); ?></td>
						<td style="text-align:center; border-bottom:1px solid #666666;"><?php if(!empty($key['PrescriptionMaster']['follow_date'])){ echo date('d-m-Y',strtotime($key['PrescriptionMaster']['follow_date']));?> <br> <?php echo $key['PrescriptionMaster']['follow_time']; } else {echo "-";}?></td>
						<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo $key['PrescriptionMaster']['first_name']." ".$key['PrescriptionMaster']['last_name']; ?></td>
						<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo $gender[$key['PrescriptionMaster']['gender']]; ?></td>
						<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo $key['PrescriptionMaster']['age']; ?></td>
						<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo $key['PrescriptionMaster']['contact_number']; ?></td>
						<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo $key['PrescriptionMaster']['email']; ?></td>
						<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo $key['PrescriptionMaster']['referred_by']; ?></td>
						<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo $status[$key['PrescriptionMaster']['status']]; ?></td>
						<td style="text-align:center; border-bottom:1px solid #666666;">
							<?php if(!empty($key['PrescriptionMaster']['order_id'])) { ?>
								<a target="_blank" href="<?php echo SITE_URL.'admin/samples/view_detail/'.base64_encode($key['PrescriptionMaster']['request_id']);?>">
									<?php echo $key['PrescriptionMaster']['order_id']; ?>
								</a> <?php 
							} 
							else { 
								echo "-"; 
							}?>
						</td>
						<td style="text-align:center; border-bottom:1px solid #666666;"><a href="<?php echo SITE_URL.'admin/prescription/edit_prescription/'.base64_encode($key['PrescriptionMaster']['id']);?>">
							<?php if($key['PrescriptionMaster']['status'] == 3) {
									echo "Show";
								}	
								else{
									echo "Edit";
								}
							?>
						</a></td>
						<td style="text-align:center; border-bottom:1px solid #666666;"><?php if(!empty($key['PrescriptionMaster']['follow_remarks'])){ echo $key['PrescriptionMaster']['follow_remarks']; } else {echo "-";}?></td>
					</tr>
				<?php 
					$count++;
				} ?>
		<?php
			} else {
		?>
		<tr>
			<td colspan="13" class="flash_failure" style=" float:none;">No records found.</td>
		</tr>
		<?php
			}
		?>
		<tr>
			<td colspan="11" style="font-weight:bold; text-align:right;">
			<?php
				echo $this->element('pagination');
			?>
			</td>
		</tr>
		
	</table>
	<?php echo $form->end(); ?>
	</div>
</div>