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
        <h2>Manage Task Category</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/ticket/index', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Task Category
    <a class="LabBtn" style="width: 200px;float: right;margin-bottom: 5px;" href="/admin/ticket/add_task_category">+ Add New Task Category</a>
	<div >&nbsp;
		
	</div>
	
	<?php echo $form->create(null, array('url'=>'/admin/ticket/task_category')); ?>
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
				<th style="text-align:center;"><h4>name</h4></th>
				<th style="text-align:center;"><h4>Instructions</h4></th>
				<th style="text-align:center;"><h4>Checklist</h4></th>
				<th style="text-align:center;"><h4>Document Required</h4></th>
				<th style="text-align:center;"><h4>Action</h4></th>
			</tr>
		</thead>
		<?php
		if(isset($task_cat) && count($task_cat) > 0){
			$countTicket = count($task_cat);
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
			<td <?php echo $class;?>><?php echo $task_cat[$ctr]['TaskCategory']['name'];?></td>
			<td <?php echo $class;?>><?php if(!empty($task_cat[$ctr]['TaskCategory']['instructions'])) echo'Y'; else echo 'N';?></td>
			<td <?php echo $class;?>><?php if(!empty($task_cat[$ctr]['TaskCategory']['checklist'])) echo 'Y'; else echo 'N';?></td>
			<td <?php echo $class;?>><?php if(!empty($task_cat[$ctr]['TaskCategory']['required_docs'])) echo 'Y'; else echo 'N';?></td>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Show',array('controller'=>'Ticket','action'=>'edit_task_category',base64_encode($task_cat[$ctr]['TaskCategory']['id'])));?></td>
		</tr>
		<?php }
		}?>
		
	</table>
<?php echo $form->end(); ?>
</div>