<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Pincode Category</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/pincode/category_list', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Pincode Category
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/pincode/category_list')); ?>
	<table border="0" width="100%">
		<thead>
			<!--<tr>
				<td style="width:100px;">
					<?php if(empty($title)) {?>
					<input type="text" name="data[Filter][title]" class="input-Search" placeholder="Enter Title" />
					<?php } else {?>
					<input type="text" name="data[Filter][title]" class="input-Search" placeholder="Enter Title" value="<?php echo $title;?>" />
					<?php }?>
				</td>
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
				<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
			</tr>-->
			<tr>
				<th width="5%" style="text-align:center;"><h4>S.No.</h4></th>
				<th style="text-align:center;"><h4>Name</h4></th>
				<th style="text-align:center;"><h4>Charges</h4></th>
				<th style="text-align:center;"><h4>No.of Pincodes Assigned</h4></th>
				<th style="text-align:center;"><h4>Action</h4></th>
			</tr>
		</thead>
		<?php
		if(isset($pin_cat) && count($pin_cat) > 0){
			$countTicket = count($pin_cat);
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
			<td <?php echo $class;?>><?php echo $pin_cat[$ctr]['PincodeCategory']['name'];?></td>
			<td <?php echo $class;?>><?php echo $pin_cat[$ctr]['PincodeCategory']['charges'];?></td>
			<td <?php echo $class;?>><?php echo $pin_cat[$ctr]['PincodeCategory']['no_of_pincode'];?></td>
			<td <?php echo $class;?> style="text-align:center;"> 
				<a href="<?php echo $html->url('/admin/pincode/upload/'.base64_encode($pin_cat[$ctr]['PincodeCategory']['id'])); ?>" title="Upload Pincode List" class="active_link">Upload Pincode List</a>
				<a href="<?php echo $html->url('/admin/pincode/download/'.base64_encode($pin_cat[$ctr]['PincodeCategory']['id'])); ?>" title="Download Pincode List" class="active_link" target="_blank">Download Pincode List</a>
			</td>
		</tr>
		<?php }
		}
		else
		{?>
		<tr>
			<td colspan="9" style="text-align:center;font-size:15px;font-weight:600;">
				No records found
			</td>
		</tr>
		<?php } ?>
	</table>
<?php echo $form->end(); ?>
</div>