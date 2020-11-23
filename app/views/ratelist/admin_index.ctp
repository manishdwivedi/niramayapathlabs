<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Package Estimate</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/ratelist/index', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Package Estimate
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/ratelist/index')); ?>
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
				<th style="text-align:center;"><h4>Date</h4></th>
				<th style="text-align:center;"><h4>Contact</h4></th>
				<th style="text-align:center;"><h4>Lab Name</h4></th>
				<th style="text-align:center;"><h4>Final Quote</h4></th>
				<th style="text-align:center;"><h4>Rate List</h4></th>
				<th style="text-align:center;"><h4>Status</h4></th>
				<th style="text-align:center;"><h4>Action</h4></th>
				
				
			</tr>
		</thead>
		<?php
		if(isset($packageEstimate) && count($packageEstimate) > 0){
			$countTicket = count($packageEstimate);
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
			<td <?php echo $class;?>><?php echo $packageEstimate[$ctr]['BbEstimate']['name'];?></td>
			<td <?php echo $class;?>><?php echo date('d-m-Y',strtotime($packageEstimate[$ctr]['BbEstimate']['date']));?></td>
			<td <?php echo $class;?>><?php echo $packageEstimate[$ctr]['BbEstimate']['contact'];?></td>
			<td <?php echo $class;?>><?php echo $lab_list[$packageEstimate[$ctr]['BbEstimate']['booked_by']];?></td>
			<td <?php echo $class;?>><?php echo "Rs ".$packageEstimate[$ctr]['BbEstimate']['final_cost'];?></td>
			<td <?php echo $class;?>><?php echo $ratelist[$packageEstimate[$ctr]['BbEstimate']['pkg_rate_list']];?></td>
			<td <?php echo $class;?>><?php echo $status[$packageEstimate[$ctr]['BbEstimate']['status']]; ?></td>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Show',array('controller'=>'ratelist','action'=>'edit_estimate',base64_encode($packageEstimate[$ctr]['BbEstimate']['id'])));?></td>
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