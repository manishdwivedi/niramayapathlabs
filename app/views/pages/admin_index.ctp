<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Pages</h2>
    </div>
    <div class="contentbox">
				<?php echo $this->Session->flash(); ?>
<?php

	$paginator->options(array('url' => array('id' => '')));	

?>
<?php echo $html->link('Home', '/admin/admins/index', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;<?php echo 'Manage Pages'; ?>
     <div>&nbsp;</div> <?php echo $html->link("Add Page", '/admin/pages/add/', array('title'=>'Add Page', 'class' => 'whitelink btnalt')); ?>
            
<?php echo $form->create('', array('url'=>'#')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	
	<thead>
		<th class="borderTop bgDarkHeader" width="5%" align="center">
			<?php
				echo $form->checkbox('Page.main', array('onclick'=>"toggleCheck(this, '.mode-checkbox')"));
			?>
		</th>
		<th class="borderTop bgDarkHeader" width="5%"><h4>#</h4></th>
		<th class="borderTop bgDarkHeader" width="7%"><h4><?php echo $paginator->sort('Status', 'Page.status', array('class'=>'pagination')); ?></h4></th>
		
		<th class="borderTop bgDarkHeader" width="30%"><h4><?php echo $paginator->sort('Title', 'Page.title', array('class'=>'pagination')); ?></h4></th>
		<th class="borderTop bgDarkHeader" width="30%"><h4><?php echo $paginator->sort('created', 'Page.Created', array('class'=>'pagination')); ?></h4></th>
		<th class="borderTop bgDarkHeader" width="15%">&nbsp;</th>
	</tr>
    </thead>
	<?php
		if(isset($pages) && count($pages) > 0){
			$countPages = count($pages);
			for($ctr=0;$ctr<$countPages;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
	?>
	<tr <?php echo $class;?>>
		<td<?php echo $class;?> align="center">
			<input type="checkbox" name="data[Page][id][]" value="<?php echo $pages[$ctr]['Page']['id'];?>" class="mode-checkbox" onclick="isChecked('.mode-checkbox', '#PageMain')" />
		</td>
		<td<?php echo $class;?>>
			<?php										
				echo ($ctr+1);
			?>
		</td>
		<td<?php echo $class;?> align="center">
		<?php
			if($pages[$ctr]['Page']['status'] == 1){
				echo $html->image('tick.png', array('title' => 'Active'));
			} else {
				echo $html->image('cross.png', array('title' => 'Inactive'));
			}
		?>
		</td>
		<td<?php echo $class;?>><?php 
		  if(isset($pages["$ctr"]['pagelocales'][0]['title']) && $pages["$ctr"]['pagelocales'][0]['title']!=""){	
		echo $html->link($pages["$ctr"]['pagelocales'][0]['title'], '/admin/pages/edit/'.$pages["$ctr"]['Page']['id'], array('title'=>'Click to edit item')); 
			}
			?></td>
		<td<?php echo $class;?>><?php echo $pages["$ctr"]['Page']['created']; ?></td>
	</tr>
	<?php
			}
	?>
	<tr>
		<td align="left" class="borderBottom bgDarkHeader" colspan="7">
			<?php echo $form->select('Page.mode', unserialize(ARR_ACTIONS));?>&nbsp;<?php echo $form->submit('Apply', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>
	<tr>
		<td align="left" colspan="7">
		<?php
			echo $this->element('pagination');
		?>
		</td>
	</tr>
	<?php
		} else {
	?>
	<tr>
		<td colspan="6" class="flash_failure" style=" float:none;">No pages found.</td>
	</tr>
	<?php
		}
	?>
</table>
<?php echo $form->end(); ?>
</div>