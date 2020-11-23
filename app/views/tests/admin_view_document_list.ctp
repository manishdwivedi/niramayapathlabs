<script>
function edit_lab(id)
{
	
}
</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Document Type</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/tests/view_document_list', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Document Type
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/tests/view_document_list')); ?>
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
				<th style="text-align:center;"><h4>Type</h4></th>
				<th style="text-align:center;"><h4>Length</h4></th>
				<th style="text-align:center;"><h4>Dummy Doc</h4></th>
				<th style="text-align:center;"><h4>Actions</h4></th>
			</tr>
		</thead>
		<?php
		if(isset($docs) && count($docs) > 0){
			$countDocumentTypeMaster = count($docs);
			for($ctr=0;$ctr<$countDocumentTypeMaster;$ctr++){
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
			<td <?php echo $class;?>><?php echo $docs[$ctr]['DocumentTypeMaster']['name'];?></td>
			<td <?php echo $class;?>><?php echo $type[$docs[$ctr]['DocumentTypeMaster']['doc_type']]; ?></td>
			<td <?php echo $class;?>><?php if(!empty($docs[$ctr]['DocumentTypeMaster']['length'])){ echo $docs[$ctr]['DocumentTypeMaster']['length']; } else { echo "-"; }?></td>
			<td <?php echo $class;?>><?php if(!empty($docs[$ctr]['DocumentTypeMaster']['dummy_link']) && $docs[$ctr]['DocumentTypeMaster']['doc_type']=='doc') {?>
					<a href="<?php echo urldecode($docs[$ctr]['DocumentTypeMaster']['dummy_link']); ?>" download> Download Doc</a>
				<?php } else { echo "NA"; } ?>
			</td>
			<td <?php echo $class;?>><a href="<?php echo SITE_URL."admin/tests/edit_doc/".base64_encode($docs[$ctr]['DocumentTypeMaster']['id']); ?>">Edit</a></td>
		</tr>
		<?php }
		}?>
		
	</table>
<?php echo $form->end(); ?>
</div>