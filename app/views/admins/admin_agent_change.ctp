<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Change Password</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; Change Password
	<?php echo $form->create('', array('url'=>'/admin/admins/agent_change')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Current Password</td>
		<td>
			<?php echo $form->password('User.password', array('maxlength'=>'16', 'class'=>'input-text')); ?>
			<?php
				echo $form->error('User.password', array(
					'between'=>'Please enter password between 6-16 characters long',
					'isPassword'=>'Invalid current password'
				));
			?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>New Password</td>
		<td>
			<?php echo $form->password('User.new_password', array('maxlength'=>'16', 'class'=>'input-text')); ?>
			<?php
				echo $form->error('User.new_password', array(
					'between'=>'Please enter password between 6-16 characters long',
					//'alphaNumeric'=>'Password should contains alphanumeric characters',
					'equalTo'=>'New Password and confirm password are not same'
				));
			?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText"><span class="error">*</span>Confirm Password</td>
		<td>
			<?php echo $form->password('User.confirm_password', array('maxlength'=>'16', 'class'=>'input-text')); ?>
			<?php
				echo $form->error('User.confirm_password', array(
					'between'=>'Please enter password between 6-16 characters long'
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