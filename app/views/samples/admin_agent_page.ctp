
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Assigned Request(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Assigned Request(s)
	<div>&nbsp;</div>
	<?php echo $form->create('Test', array('url'=>'/admin/samples/agent_view_list')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		
	<thead>
		
		<tr>
			
			<th width="5%"><h4>S.No.</h4></th>
			<th style="text-align:center;"><h4>Date</h4></th>
			<th style="text-align:center; width:100px;"><h4>RequestNo.</h4></th>
			<th><h4><?php echo $paginator->sort('Name', 'Health.name', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Contact', 'Health.landline', array('class'=>'pagination')); ?></h4></th>
			<th><h4>Request Status</h4></th>
			<th><h4>City</h4></th>
			
			<th style="text-align:center;"><h4>Action</h4></th>
			
			
		</tr>	
	</thead>
	<?php
		if(isset($samplerequestlist) && count($samplerequestlist) > 0){
			$countRequest = count($samplerequestlist);
			for($ctr=0;$ctr<$countRequest;$ctr++){
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
		<td <?php echo $class;?> style="text-align:center;"><?php echo date('d-m-Y',strtotime($samplerequestlist[$ctr]['Health']['sample_req_date']));?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $samplerequestlist[$ctr]['Health']['order_num'];?></td>
		<td <?php echo $class;?>><?php echo $samplerequestlist[$ctr]['Health']['name'];?></td>
		<td <?php echo $class;?>><?php echo $this->Utility->show_mobile_hide($samplerequestlist[$ctr]['Health']['landline'],$samplerequestlist[$ctr]['Health']['book_date']); ?></td>
		<td <?php echo $class;?>><?php echo $samplerequestlist[$ctr]['Health']['request_status'];?></td>
		<td <?php echo $class;?>><?php echo $samplerequestlist[$ctr]['Health']['city_name'];?></td>
		
		<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('View_Details',array('controller'=>'samples','action'=>'view_agent_detailing',base64_encode($samplerequestlist[$ctr]['Health']['id'])));?></td>
		
		
		
	</tr>
	<?php }?>
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