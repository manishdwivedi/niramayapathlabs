<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Language(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Language(s)
	<div>&nbsp;</div><?php echo $html->link("Add Language", array('controller'=>'locales','action'=>'add'), array('title'=>'Add Language', 'class' => 'whitelink btnalt')); ?>
	<?php echo $form->create('Locale', array('url'=>'#')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<th width="5%" align="center">
				<?php
					echo $form->checkbox('Page.main', array('onclick'=>"toggleCheck(this, '.mode-checkbox')"));
				?>
			</th>
			<th width="5%"><h4>#</h4></th>
			<th><h4><?php echo $paginator->sort('Status', 'Locale.status', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Language Title', 'Locale.title', array('class'=>'pagination')); ?></h4></th>
		</tr>	
	</thead>
	<?php
		if(isset($localelist) && count($localelist) > 0){
			$countLocales = count($localelist);
			for($ctr=0;$ctr<$countLocales;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
			
	?>
	
	<tr <?php echo $class;?>>
		<td <?php echo $class;?>>
			<input type="checkbox" name="data[Locale][id][]" value="<?php echo $localelist[$ctr]['Locale']['id'];?>" class="mode-checkbox" onclick="isChecked('.mode-checkbox', '#PageMain')" />
		</td>
		<td <?php echo $class;?>>
			<?php										
				echo ($ctr+1);
			?>
		</td>
		<?php if($localelist[$ctr]['Locale']['status']==1){?>
			<td <?php echo $class;?>><?php echo $html->image('tick.png',array('title'=>'Active'));?></td>
		<?php } else {?>
			<td <?php echo $class;?>><?php echo $html->image('cross.png',array('title'=>'Inactive'));?></td>
		<?php }?>
		<td <?php echo $class;?>><?php echo $html->link($localelist[$ctr]['Locale']['title'],array('controller'=>'locales','action'=>'edit',$localelist[$ctr]['Locale']['id']),array('title'=>'Click to Edit Item'));?></td>
	
	
	</tr>
	<?php }?>
	<tr>
		<td align="left" class="borderBottom bgDarkHeader" colspan="4">
			<?php echo $form->select('Page.mode', unserialize(ARR_ACTIONS));?>&nbsp;<?php echo $form->submit('Apply', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>
	<tr>
		<td align="left" colspan="4">
		<?php
			echo $this->element('pagination');
		?>
		</td>
	</tr>
	<?php
		} else {
	?>
	<tr>
		<td colspan="4" class="flash_failure" style=" float:none;">No Language(s) found.</td>
	</tr>
	<?php
		}
	?>
	
</table>
<?php echo $form->end(); ?>
</div>