<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Change Admin Email Details</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
<?php echo $html->link('Home', '/admin/admins/index', array('title'=>'Home')); ?>&#187;Change Admin Email Details
<?php echo $form->create('', array('url'=>'/admin/admins/myaccount/')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<tr>
		<td class="boldText error" colspan="2" style="text-align:right">* Required Fields</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>E-mail</td>
		<td>
			<?php echo $form->text('Admin.email', array('maxlength'=>'128', 'class'=>'input-text','value'=>$adminemail)); ?>
			<?php
				echo $form->error('Admin.email', array(
					'email'=>'Please enter valid email address'
				));
			?>
		</td>
	</tr>
    
	<tr>
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->submit('Update', array('div'=>false, 'class' => 'btn')); ?>
			<a onclick="javascript:window.history.go(-1)" class="btn" style="color:#FFFFFF;">Cancel</a>
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>
</div>