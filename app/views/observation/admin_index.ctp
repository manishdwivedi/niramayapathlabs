<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Observations</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/observation/index', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Observations
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/observation/index')); ?>
	<table border="0" width="100%">
		<thead>
			<tr>
				<td style="width:100px;">
					<?php if(empty($title)) {?>
					<input type="text" name="data[Filter][title]" class="input-Search" placeholder="Enter Title" />
					<?php } else {?>
					<input type="text" name="data[Filter][title]" class="input-Search" placeholder="Enter Title" value="<?php echo $title;?>" />
					<?php }?>
				</td>
				<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
			</tr>
			<tr>
				<th width="5%" style="text-align:center;"><h4>S.No.</h4></th>
				<th style="text-align:center;"><h4>Observation Name</h4></th>
				<th style="text-align:center;"><h4>Method</h4></th>
				<th style="text-align:center;"><h4>Machine</h4></th>
				<th style="text-align:center;"><h4>Gender</h4></th>
				<th style="text-align:center;"><h4>OS / InHouse</h4></th>
				<th style="text-align:center;"><h4>Department</h4></th>
				<th style="text-align:center;"><h4>Sample Type</h4></th>				
				<th style="text-align:center;"><h4>Action</h4></th>				
			</tr>
		</thead>
		<?php
		if(isset($observation) && count($observation) > 0){
			$countTicket = count($observation);
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
			<td <?php echo $class;?>><?php echo $observation[$ctr]['Observation']['name'];?></td>
			<td <?php echo $class;?>><?php echo $observation[$ctr]['Observation']['method']; ?></td>
			<td <?php echo $class;?>><?php echo $observation[$ctr]['Observation']['machine'];?></td>
			<td <?php echo $class;?>><?php echo $observation[$ctr]['Observation']['gender'];?></td>
			<td <?php echo $class;?>><?php echo $observation[$ctr]['Observation']['os_inhouse'];?></td>
			<td <?php echo $class;?>><?php echo $observation[$ctr]['Observation']['department'];?></td>
			<td <?php echo $class;?>><?php echo $observation[$ctr]['Observation']['sample_type'];?></td>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Edit',array('controller'=>'observation','action'=>'edit_observation',base64_encode($observation[$ctr]['Observation']['id'])));?></td>
		</tr>
		<?php }
		}?>
		<?php if(count($observation) > 0) {?>
			<tr>
				<td colspan="14" style="font-weight:bold; text-align:right;">
				<?php
					echo $this->element('pagination');
				?>
				</td>
			</tr>
			<?php }?>
	</table>
<?php echo $form->end(); ?>
</div>