<script>
	function edit_agent()
	{
		$('.edit').hide();
		$('.cancel').show();
	}

	function cancel_agent()
	{
		$('.edit').show();
		$('.cancel').hide();
	}
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
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Route</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/runner/Route', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Route
    <a class="LabBtn" style="width: 200px;float: right;margin-bottom: 5px;" href="/admin/runner/add_route">+ Add New Route</a>
	<div >&nbsp;
		
	</div>
	
	<?php echo $form->create(null, array('url'=>'/admin/runner/route_listegory')); ?>
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
				<th style="text-align:center;"><h4>Route Id</h4></th>
				<th style="text-align:center;"><h4>Name</h4></th>
				<th style="text-align:center;"><h4>Locations</h4></th>
				<th style="text-align:center;"><h4>Runner</h4></th>
				<th style="text-align:center;width:200px;"><h4>Shift</h4></th>
				<th style="text-align:center;width:100px;"><h4>Status</h4></th>
				<th style="text-align:center;"><h4>Action</h4></th>
			</tr>
		</thead>
		<?php
		if(isset($zone) && count($zone) > 0){
			$countRunner = count($zone);
			for($ctr=0;$ctr<$countRunner;$ctr++){
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
			<td  style="text-align:center;" <?php echo $class;?>><?php echo $zone[$ctr]['Zone']['zone_id'];?></td>
			<td  style="text-align:center;" <?php echo $class;?>><?php echo $zone[$ctr]['Zone']['name']; ?></td>
			<td  style="text-align:center;" <?php echo $class;?>><?php echo $zone[$ctr]['Zone']['location_name']; ?></td>
			<td  style="text-align:center;" <?php echo $class;?>><?php echo $agent[$zone[$ctr]['Zone']['runner_id']]; ?></td>
			<td  style="text-align:center;width:200px;" <?php echo $class;?>><?php echo $zone[$ctr]['Zone']['time_of_day']; ?></td>
			<td  style="text-align:center;width:100px;" <?php echo $class;?>>
				<?php 
					if($zone[$ctr]['Zone']['status']=="1")
					{
						echo "<a class='LabBtn' style='width: 100px;float: right;margin-bottom: 5px;' href='#'>Active</a>";
					}
					else
					{
						echo "<a class='LabBtn' style='background: RED;width: 100px;float: right;margin-bottom: 5px;' href='#'>Deactive</a>";
					}
				?>
			</td>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Show',array('controller'=>'Runner','action'=>'edit_route',base64_encode($zone[$ctr]['Zone']['id'])));?></td>
		</tr>
		<?php }
		}?>
		
	</table>
<?php echo $form->end(); ?>
</div>