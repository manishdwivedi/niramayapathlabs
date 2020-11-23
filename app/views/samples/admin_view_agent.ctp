<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Agent(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/samples/view_agent', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Agent(s)
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/samples/view_agent')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<td colspan="7">
				<table border="0" width="100%">
					<tr>
						<td width="30"><?php echo $form->text('FilterAgent.name',array('class'=>'input-Search','placeholder'=>'Enter Agent Name'));?></td>
						<td width="30"><?php echo $form->text('FilterAgent.contact',array('class'=>'input-Search','placeholder'=>'Enter Agent Contact'));?></td>
						<td width="30"><?php echo $form->text('FilterAgent.email',array('class'=>'input-Search','placeholder'=>'Enter Agent Email'));?></td>
						<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="7" style="text-align:right;"><?php echo $this->element('pagination');?></td>
		</tr>
		<tr>
			<!--<th width="5%" align="center">
				<?php
					//echo $form->checkbox('Page.main', array('onclick'=>"toggleCheck(this, '.mode-checkbox')"));
				?>
			</th>-->
			<th width="5%" style="text-align:center;"><h4>S.No.</h4></th>
			<th style="text-align:center;"><h4>Status</h4></th>
			<th><h4><?php echo $paginator->sort('Name', 'Agent.name', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Email', 'Agent.email', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Contact', 'Agent.contact', array('class'=>'pagination')); ?></h4></th>
			<th><h4>Role Type</h4></th>
			<th><h4>Assigned Lab</h4></th>
			<th style="text-align:center;"><h4>Reset Password</h4></th>
			<th style="text-align:center;"><h4>Action</h4></th>
			
			
		</tr>	
	</thead>
	<?php
		if(isset($agentlist) && count($agentlist) > 0){
			$countAgents = count($agentlist);
			for($ctr=0;$ctr<$countAgents;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
			
	?>
	
	<tr <?php echo $class;?>>
		<!--<td <?php echo $class;?>>
			<input type="checkbox" name="data[Agent][id][]" value="<?php //echo $agentlist[$ctr]['Agent']['id'];?>" class="mode-checkbox" onclick="isChecked('.mode-checkbox', '#PageMain')" />
		</td>-->
		<td <?php echo $class;?> style="text-align:center;">
			<?php										
				echo ($ctr+1);
			?>
		</td>
		<?php if($agentlist[$ctr]['Agent']['status']==1){?>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->image('tick.png',array('title'=>'Active'));?></td>
		<?php } else {?>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->image('cross.png',array('title'=>'Inactive'));?></td>
		<?php }?>
		<td <?php echo $class;?>><?php echo $agentlist[$ctr]['Agent']['name'];?></td>
		<td <?php echo $class;?>><?php echo $agentlist[$ctr]['Agent']['email'];?></td>
		<td <?php echo $class;?>><?php echo $agentlist[$ctr]['Agent']['contact'];?></td>
		<td>
			<select name="data[Agent][role]" id="AgentRole" class="input-text" onchange="assign_role(this.value,'<?php echo $agentlist[$ctr]['Agent']['id'];?>');">
				<?php foreach($agent_type as $key => $val) {?>
				<option value="<?php echo $key;?>" <?php if($agentlist[$ctr]['Agent']['role']==$key) echo "selected";?>><?php echo $val;?></option>
				<?php }?>
			</select>
			<div id="msg5" style="color:#FF0000; font-size:12px;"></div>
		</td>
		<td>
			<select name="data[Agent][assigned_lab]" id="AgentAssignedLab" class="input-text" onchange="assign_lab(this.value,'<?php echo $agentlist[$ctr]['Agent']['id'];?>');">
				<option value="0">All</option>
				<?php foreach($lablist as $key => $val) {?>
				<option value="<?php echo $key;?>" <?php if($agentlist[$ctr]['Agent']['assigned_lab']==$key) echo "selected";?>><?php echo $val;?></option>
				<?php }?>
			</select>
			<div id="msg5" style="color:#FF0000; font-size:12px;"></div>
		</td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Reset Password',array('controller'=>'samples','action'=>'reset_agent_pass',base64_encode($agentlist[$ctr]['Agent']['id'])));?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Edit',array('controller'=>'samples','action'=>'edit_agent',base64_encode($agentlist[$ctr]['Agent']['id'])));?></td>
		
		
		
	</tr>
	<?php }?>
	<!--<tr>
		<td align="left" class="borderBottom bgDarkHeader" colspan="6">
			<strong>Edit Test Status : </strong><?php //echo $form->select('Page.mode', unserialize(ARR_ACTIONS));?>&nbsp;<?php //echo $form->submit('Apply', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>-->
	<tr>
		<td colspan="7" style="text-align:right;">
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
<script>
function assign_lab(val,id)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/assign_agent_lab?lab='+val+'&id='+id,
		success:function(data){
			alert('Lab assigned');
			window.location.href=siteUrl+'admin/samples/view_agent';
		}
	});
}

function assign_role(val,id)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/assign_agent_role?agent='+val+'&id='+id,
		success:function(data){
			alert('Role assigned');
			window.location.href=siteUrl+'admin/samples/view_agent';
		}
	});
}	
</script>