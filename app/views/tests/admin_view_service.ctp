<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Service(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Service(s)
	<div>&nbsp;</div>
	<?php echo $form->create('Test', array('url'=>'#')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<th width="5%"><h4>S.No.</h4></th>
			<th>Status</th>
			<th><h4><?php echo $paginator->sort('Code', 'Test.testcode', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Service Parameter', 'Test.test_parameter', array('class'=>'pagination')); ?></h4></th>
			<th style="text-align:center;"><h4>Description PDF</h4></th>
			<th style="text-align:center;"><h4><?php echo $paginator->sort('Service Hours', 'Test.mrp', array('class'=>'pagination')); ?></h4></th>
			<th style="text-align:center;"><h4><?php echo $paginator->sort('MRP', 'Test.mrp', array('class'=>'pagination')); ?></h4></th>
                        <th style="text-align:center;"><h4>Category</h4></th>
			<th style="text-align:center;"><h4>Action</h4></th>
			
			
		</tr>	
	</thead>
	<?php
		if(isset($testlist) && count($testlist) > 0){
			$countTests = count($testlist);
			for($ctr=0;$ctr<$countTests;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
			
	?>
	
	<tr <?php echo $class;?>>
		<td <?php echo $class;?>>
			<?php										
				echo ($ctr+1);
			?>
		</td>
		<?php if($testlist[$ctr]['Test']['status']==1){?>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->image('tick.png',array('title'=>'Active'));?></td>
		<?php } else {?>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->image('cross.png',array('title'=>'Inactive'));?></td>
		<?php }?>
		<td <?php echo $class;?>><?php echo $testlist[$ctr]['Test']['testcode'];?></td>
		<td <?php echo $class;?>><?php echo $testlist[$ctr]['Test']['test_parameter'];?></td>
		<td <?php echo $class;?> style="text-align:center;">
		<?php if($testlist[$ctr]['Test']['file_name'] != '') {?>
		<a href="<?php echo TEST_PDF_URL.$testlist[$ctr]['Test']['file_name'];?>" target="_blank" style="text-decoration:none;">View PDF</a>
		<?php } else {?>
		No Description PDF
		<?php }?>
		</td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $testlist[$ctr]['Test']['reporting'];?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $testlist[$ctr]['Test']['mrp'];?></td>
                <td <?php echo $class;?> style="text-align:center;"><?php echo $testlist[$ctr]['Test']['profit_margin_category'];?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Edit',array('controller'=>'tests','action'=>'edit_service',base64_encode($testlist[$ctr]['Test']['id'])));?></td>
		
		
		
	</tr>
	<?php }?>
	<!--<tr>
		<td align="left" class="borderBottom bgDarkHeader" colspan="6">
			<strong>Edit Service Status : </strong><?php //echo $form->select('Page.mode', unserialize(ARR_ACTIONS));?>&nbsp;<?php //echo $form->submit('Apply', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>-->
	<tr>
		<td align="left" colspan="6">
		<?php
			echo $this->element('pagination');
		?>
		</td>
	</tr>
	<?php
		} else {
	?>
	<tr>
		<td colspan="8" class="flash_failure" style=" float:none;">No records found.</td>
	</tr>
	<?php
		}
	?>
	
</table>
<?php echo $form->end(); ?>
</div>