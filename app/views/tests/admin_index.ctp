<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Test(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Test(s)
	<div>&nbsp;</div>
	
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<td colspan="11">
				<?php echo $form->create(null,array('url'=>'/admin/tests/index'));?>
				<table border="0" width="100%">
					<tr>
						<td width="39">
							<?php if(!empty($test_code)) {?>
							<?php echo $form->text('FilterTest.test_code',array('class'=>'input-Search','placeholder'=>'Enter Test Code','style'=>'width:200px;','value'=>$test_code));?>
							<?php } else {?>
							<?php echo $form->text('FilterTest.test_code',array('class'=>'input-Search','placeholder'=>'Enter Test Code','style'=>'width:200px;'));?>
							<?php }?>
						</td>
						<td width="39">
							<?php if(!empty($test_param)) {?>
							<?php echo $form->text('FilterTest.test_parameter',array('class'=>'input-Search','placeholder'=>'Enter Test Parameter','style'=>'width:200px;','value'=>$test_param));?>
							<?php } else {?>
							<?php echo $form->text('FilterTest.test_parameter',array('class'=>'input-Search','placeholder'=>'Enter Test Parameter','style'=>'width:200px;'));?>
							<?php }?>
						</td>
						<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
					</tr>
				</table>
				<?php echo $form->end();?>
			</td>
		</tr>
		<tr>
			<td colspan="11" style="text-align:right;"><?php
			echo $this->element('pagination');
		?></td>
		</tr>
		<tr>
			<!--<th width="5%" align="center">
				<?php
					//echo $form->checkbox('Page.main', array('onclick'=>"toggleCheck(this, '.mode-checkbox')"));
				?>
			</th>-->
			<th width="5%" style="text-align:center;"><h4>S.No.</h4></th>
			<th><h4><?php echo $paginator->sort('Sequence', 'Test.sequence', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Status', 'Test.status', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Code', 'Test.testcode', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Parameter', 'Test.test_parameter', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Sample', 'Test.sample', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Methodology', 'Test.methodology', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Schedule', 'Test.schedule', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Reporting', 'Test.reporting', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Market Price', 'Test.banner_market_mrp', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('MRP', 'Test.mrp', array('class'=>'pagination')); ?></h4></th>
                        <th><h4>Category</h4></th>
			<th><h4>Action</h4></th>
			
			
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
		<!--<td <?php //echo $class;?>>
			<input type="checkbox" name="data[Test][id][]" value="<?php //echo $testlist[$ctr]['Test']['id'];?>" class="mode-checkbox" onclick="isChecked('.mode-checkbox', '#PageMain')" />
		</td>-->
		<td <?php echo $class;?> style="text-align:center;">
			<?php										
				echo ($ctr+1);
			?>
		</td>
			<td <?php echo $class;?>><?php echo $testlist[$ctr]['Test']['sequence'];?></td>
		<?php if($testlist[$ctr]['Test']['status']==1){?>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->image('tick.png',array('title'=>'Active'));?></td>
		<?php } else {?>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->image('cross.png',array('title'=>'Inactive'));?></td>
		<?php }?>
		<td <?php echo $class;?>><?php echo $testlist[$ctr]['Test']['testcode'];?></td>
		<td <?php echo $class;?>><?php echo $testlist[$ctr]['Test']['test_parameter'];?></td>
		<td <?php echo $class;?>><?php echo $testlist[$ctr]['Test']['sample'];?></td>
		<td <?php echo $class;?>><?php echo $testlist[$ctr]['Test']['methodology'];?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $testlist[$ctr]['Test']['schedule'];?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $testlist[$ctr]['Test']['reporting'];?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $testlist[$ctr]['Test']['banner_market_mrp'];?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $testlist[$ctr]['Test']['mrp'];?></td>
                <td <?php echo $class;?> style="text-align:center;"><?php echo $testlist[$ctr]['Test']['profit_margin_category'];?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Edit',array('controller'=>'tests','action'=>'edit_test',base64_encode($testlist[$ctr]['Test']['id'])));?></td>
		
		
		
	</tr>
	<?php }?>
	<!--<tr>
		<td align="left" class="borderBottom bgDarkHeader" colspan="6">
			<strong>Edit Test Status : </strong><?php //echo $form->select('Page.mode', unserialize(ARR_ACTIONS));?>&nbsp;<?php //echo $form->submit('Apply', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>-->
	<tr>
		<td style="text-align:right;" colspan="11">
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

</div>