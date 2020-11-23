<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Banner(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Banner(s)
	<div>&nbsp;</div>
	<?php echo $form->create('Banner', array('url'=>'#')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<th width="5%" align="center">
				<?php
					echo $form->checkbox('Page.main', array('onclick'=>"toggleCheck(this, '.mode-checkbox')"));
				?>
			</th>
			<th width="5%"><h4>S.No.</h4></th>
			<th width="5%"><h4>Sequence</h4></th>
			<th style="text-align:center;"><h4><?php echo $paginator->sort('Status', 'Banner.status', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Banner Name', 'Banner.banner_name', array('class'=>'pagination')); ?></h4></th>
                        <th width="5%"><h4>Banner Code</h4></th>
                        <th width="5%"><h4>Market Price</h4></th>
						<th width="5%"><h4>MRP</h4></th>
                        <th width="5%"><h4>Category</h4></th>
			<th style="text-align:center;"><h4>Action</h4></th>
			
			
		</tr>	
	</thead>
	<?php
		if(isset($bannerlist) && count($bannerlist) > 0){
			$countBanners = count($bannerlist);
			for($ctr=0;$ctr<$countBanners;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
			
	?>
	
	<tr <?php echo $class;?>>
		<td <?php echo $class;?>>
			<input type="checkbox" name="data[Banner][id][]" value="<?php echo $bannerlist[$ctr]['Banner']['id'];?>" class="mode-checkbox" onclick="isChecked('.mode-checkbox', '#PageMain')" />
		</td>
		<td <?php echo $class;?>>
			<?php										
				echo ($ctr+1);
			?>
		</td>
		<td>
		<?php echo $bannerlist[$ctr]['Banner']['sequence']; ?>
		</td>
		<?php if($bannerlist[$ctr]['Banner']['status']==1){?>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->image('tick.png',array('title'=>'Active'));?></td>
		<?php } else {?>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->image('cross.png',array('title'=>'Inactive'));?></td>
		<?php }?>
		<td <?php echo $class;?>><?php echo $bannerlist[$ctr]['Banner']['banner_name'];?></td>
                <td><?php echo $bannerlist[$ctr]['Banner']['banner_code'] ; ?></td>
				<td><?php echo $bannerlist[$ctr]['Banner']['banner_market_mrp'] ; ?></td>
                <td><?php echo $bannerlist[$ctr]['Banner']['banner_mrp'] ; ?></td>
                <td><?php echo $bannerlist[$ctr]['Banner']['profit_margin_category'] ; ?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Edit',array('controller'=>'banners','action'=>'edit',base64_encode($bannerlist[$ctr]['Banner']['id'])));?></td>
		
		
		
	</tr>
	<?php }?>
	<tr>
		<td align="left" class="borderBottom bgDarkHeader" colspan="6">
			<strong>Edit Test Status : </strong><?php echo $form->select('Page.mode', unserialize(ARR_ACTIONS));?>&nbsp;<?php echo $form->submit('Apply', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>
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