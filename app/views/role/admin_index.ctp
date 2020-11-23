<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage User(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage User(s)
	<div>&nbsp;</div>
	<?php echo $form->create('Admin', array('url'=>'#')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<th width="5%" align="center">
				<?php
					echo $form->checkbox('Page.main', array('onclick'=>"toggleCheck(this, '.mode-checkbox')"));
				?>
			</th>
			<th width="5%"><h4>S.No.</h4></th>
			<th style="text-align:center;"><h4><?php echo $paginator->sort('Status', 'Banner.status', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('User Type', 'Admin.userType', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Name', 'Admin.name', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Username', 'Admin.userName', array('class'=>'pagination')); ?></h4></th>
			<th style="text-align:center;"><h4>Action</h4></th>
			
			
		</tr>	
	</thead>
	<?php
		if(isset($userlist) && count($userlist) > 0){
			$countUsers = count($userlist);
			for($ctr=0;$ctr<$countUsers;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
			
	?>
	
	<tr <?php echo $class;?>>
		<td <?php echo $class;?>>
			<input type="checkbox" name="data[Admin][id][]" value="<?php echo $userlist[$ctr]['Admin']['id'];?>" class="mode-checkbox" onclick="isChecked('.mode-checkbox', '#PageMain')" />
		</td>
		<td <?php echo $class;?>>
			<?php										
				echo ($ctr+1);
			?>
		</td>
		<?php if($userlist[$ctr]['Admin']['status']==1){?>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->image('tick.png',array('title'=>'Active'));?></td>
		<?php } else {?>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->image('cross.png',array('title'=>'Inactive'));?></td>
		<?php }?>
		<td <?php echo $class;?>>
			<?php if($userlist[$ctr]['Admin']['userType'] == 'A') { echo "Super Admin"; }?>
			<?php if($userlist[$ctr]['Admin']['userType'] == 'BM') { echo "Business Manager"; }?>
			<?php if($userlist[$ctr]['Admin']['userType'] == 'Agent') { echo "Helpdesk User"; }?>
			<?php if($userlist[$ctr]['Admin']['userType'] == 'Home') { echo "Home Collection"; }?>
			<?php if($userlist[$ctr]['Admin']['userType'] == 'DA') { echo "Doctor Admin"; }?>
			<?php if($userlist[$ctr]['Admin']['userType'] != 'A' && $userlist[$ctr]['Admin']['userType'] != 'BM' && $userlist[$ctr]['Admin']['userType'] != 'Agent' && $userlist[$ctr]['Admin']['userType'] != 'Home' && $userlist[$ctr]['Admin']['userType'] != 'DA'){ echo $userlist[$ctr]['Admin']['userType'].' User'; }?>
		</td>
		<td <?php echo $class;?>><?php echo $userlist[$ctr]['Admin']['name'];?></td>
		<td <?php echo $class;?>><?php echo $userlist[$ctr]['Admin']['userName'];?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Edit',array('controller'=>'samples','action'=>'edit_user',base64_encode($userlist[$ctr]['Admin']['id'])));?></td>
		
		
		
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