<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Frontend User(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Frontend User(s)
	<div>&nbsp;</div>
	
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		
	<thead>
		
		<tr>
			
			<th width="2%"><h4>S.No.</h4></th>
			<th style="text-align:center;"><h4><?php echo $paginator->sort('Name', 'User.first_name', array('class'=>'pagination')); ?></h4></th>
			<th style="text-align:center;"><h4><?php echo $paginator->sort('Email', 'User.email', array('class'=>'pagination')); ?></h4></th>
			<th style="text-align:center;"><h4><?php echo $paginator->sort('Contact', 'User.contact', array('class'=>'pagination')); ?></h4></th>
			<th style="text-align:center;"><h4><?php echo $paginator->sort('Gender', 'User.gender', array('class'=>'pagination')); ?></h4></th>
			<th style="text-align:center;"><h4><?php echo $paginator->sort('Age', 'User.age', array('class'=>'pagination')); ?></h4></th>
			<th style="text-align:center;"><h4><?php echo $paginator->sort('City', 'User.city_name', array('class'=>'pagination')); ?></h4></th>
			<th style="text-align:center;"><h4><?php echo $paginator->sort('State', 'User.state_name', array('class'=>'pagination')); ?></h4></th>
			<th style="text-align:center;"><h4>Action</h4></th>
			
			
		</tr>	
	</thead>
	<?php
		if(isset($userlist) && count($userlist) > 0){
			$countUser = count($userlist);
			for($ctr=0;$ctr<$countUser;$ctr++){
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
		<td <?php echo $class;?> style="text-align:center;"><?php echo $userlist[$ctr]['User']['first_name'].' '.$userlist[$ctr]['User']['last_name'];?></td>
		<td <?php echo $class;?> style="text-align:center;"><a href="mailto:<?php echo $userlist[$ctr]['User']['email'];?>"><?php echo $userlist[$ctr]['User']['email'];?></a></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $userlist[$ctr]['User']['contact'];?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $userlist[$ctr]['User']['gender'];?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $userlist[$ctr]['User']['age'].' Yrs';?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $userlist[$ctr]['User']['city_name'];?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $userlist[$ctr]['User']['state_name'];?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('View_Details',array('controller'=>'samples','action'=>'view_user_detail_help',base64_encode($userlist[$ctr]['User']['id'])));?></td>
		
		
		
	</tr>
	<?php }?>
	<!--<tr>
		<td align="left" class="borderBottom bgDarkHeader" colspan="6">
			<strong>Edit Test Status : </strong><?php //echo $form->select('Page.mode', unserialize(ARR_ACTIONS));?>&nbsp;<?php //echo $form->submit('Apply', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>-->
	<tr>
		<td align="left" colspan="10">
		<?php
			echo $this->element('pagination');
		?>
		</td>
	</tr>
	<?php
		} else {
	?>
	<tr>
		<td colspan="10" class="flash_failure" style=" float:none;">No records found.</td>
	</tr>
	<?php
		}
	?>
	
</table>

</div>