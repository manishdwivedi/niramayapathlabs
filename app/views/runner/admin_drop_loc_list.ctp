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
        <h2>Drop Location List</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/runner/drop_loc_list', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Drop Location List
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/runner/drop_loc_list')); ?>
	<table border="0">
		<thead>
			<tr>
				<td style="width:100px;">
					<?php if(empty($loc_name)) {?>
					<input type="text" name="data[Filter][loc_name]" class="input-Search" style="width:100px;" placeholder="Location Name" />
					<?php } else {?>
					<input type="text" name="data[Filter][loc_name]" class="input-Search" style="width:100px;" placeholder="Location Name" value="<?php echo $loc_name;?>" />
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
				<th style="text-align:center;"><h4>Location Name</h4></th>
				<th style="text-align:center;"><h4>POC Name</h4></th>
				<th style="text-align:center;"><h4>POC Contact</h4></th>
				<th style="text-align:center;"><h4>Pincode</h4></th>
				<th style="text-align:center;"><h4>Action</h4></th>
			</tr>
		</thead>
		<?php
		
		if(isset($drop_location) && count($drop_location) > 0){
			$countTicket = count($drop_location);
			for($ctr=0;$ctr<$countTicket;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
		?>
		
		<tr <?php echo $class;?> style="background-color:<?php echo $status_color[$drop_location[$ctr]['DropLocations']['status']];?>">
			<td <?php echo $class;?> style="text-align:center;">
				<?php										
					echo ($ctr+1);
				?>
			</td>
			<td <?php echo $class;?>><?php echo $drop_location[$ctr]['DropLocations']['location_name'];?></td>
			<td <?php echo $class;?>><?php echo $drop_location[$ctr]['DropLocations']['poc'];?></td>
			<td <?php echo $class;?>><?php echo $drop_location[$ctr]['DropLocations']['contact'];?></td>
			<td <?php echo $class;?>><?php echo $drop_location[$ctr]['DropLocations']['pincode'];?></td>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Show',array('controller'=>'runner','action'=>'edit_drop_loc',base64_encode($drop_location[$ctr]['DropLocations']['id'])));?></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="14" style="font-weight:bold; text-align:right;">
			<?php
				echo $this->element('pagination');
			?>
			</td>
		</tr>
		<?php }
		else
		{?>
		<tr>
			<td colspan="13" class="flash_failure" style=" float:none;">No records found.</td>
		</tr>
		<?php } ?>
	</table>
<?php echo $form->end(); ?>
</div>