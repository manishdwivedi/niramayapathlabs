<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Tickets</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/ticket/index', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Tickets
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/samples/view_ticket')); ?>
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
				<th style="text-align:center;"><h4>Lab Name</h4></th>
				<th style="text-align:center;"><h4>Lab Code</h4></th>
				<th style="text-align:center;"><h4>Address</h4></th>
				<th style="text-align:center;"><h4>Phone Number</h4></th>
				<th style="text-align:center;"><h4>Email</h4></th>
				<th style="text-align:center;"><h4>Action</h4></th>
			</tr>
		</thead>
		<?php
		if(isset($plablist) && count($plablist) > 0){
			$countlabs = count($plablist);
			for($ctr=0;$ctr<$countlabs;$ctr++){
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
			<td <?php echo $class;?>><?php echo $plablist[$ctr]['ProcessingLabs']['name'];?></td>
			<td <?php echo $class;?>><?php echo $plablist[$ctr]['ProcessingLabs']['lab_code'];?></td>
			<td <?php echo $class;?>><?php echo $plablist[$ctr]['ProcessingLabs']['address'];?></td>
			<td <?php echo $class;?>><?php echo $plablist[$ctr]['ProcessingLabs']['phone_number'];?></td>
			<td <?php echo $class;?>><?php echo $plablist[$ctr]['ProcessingLabs']['email'];?></td>
			<td <?php echo $class;?> style="text-align:center;">
				<?php echo $html->link('Show',array('controller'=>'plab','action'=>'edit_labs',base64_encode($plablist[$ctr]['ProcessingLabs']['id'])));?>
				<?php echo $html->link('Edit Pincode List',array('controller'=>'plab','action'=>'edit_citytests',base64_encode($plablist[$ctr]['ProcessingLabs']['id'])));?>
				<?php echo $html->link('Edit Test List',array('controller'=>'plab','action'=>'edit_test',base64_encode($plablist[$ctr]['ProcessingLabs']['id'])));?>
			</td>
		</tr>
		<?php }
		}?>
		
	</table>
<?php echo $form->end(); ?>
</div>