<div class="contentcontainer">
    <div class="headings altheading">
        <h2>View Frontend User Detail</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; <?php echo $html->link('Manage Frontend User(s)', '/admin/samples/view_front_user', array('title'=>'Frontend Users List')); ?> &#187; View Frontend User Detail
	<?php echo $form->create('User',array('url'=>'/admin/samples/edit_user_detail/'.base64_encode($this->data['User']['id'])));?>
	<?php echo $form->hidden('User.id',array('value'=>$this->data['User']['id']));?>
	<?php echo $form->hidden('User.username',array('value'=>$this->data['User']['username']));?>
	<?php echo $form->hidden('User.passwd',array('value'=>$this->data['User']['passwd']));?>
	<?php echo $form->hidden('User.status',array('value'=>$this->data['User']['status']));?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<tr>
		<td colspan="2" style="text-align:right;"><?php echo $html->link('Edit Details',array('controller'=>'samples','action'=>'edit_user_detail',base64_encode($user['User']['id'])));?></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">First Name</td>
		<td><?php echo $form->text('User.first_name',array('class'=>'input-text'));?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Last Name</td>
		<td><?php echo $form->text('User.last_name',array('class'=>'input-text'));?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Registered Email</td>
		<td><?php echo $form->text('User.email',array('class'=>'input-text'));?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Alternate Email</td>
		<td><?php echo $form->text('User.alternate_email',array('class'=>'input-text'));?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Registered Contact</td>
		<td><?php echo $form->text('User.contact',array('class'=>'input-text'));?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Alternate Contact</td>
		<td><?php echo $form->text('User.alternate_contact',array('class'=>'input-text'));?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Gender</td>
		<td>
			<select name="data[User][gender]" class="input-text">
				<option value="">Select Gender</option>
				<option value="1" <?php if($this->data['User']['gender'] == 1) {?> selected="selected" <?php }?>>Male</option>
				<option value="2" <?php if($this->data['User']['gender'] == 2) {?> selected="selected" <?php }?>>Female</option>
			</select>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Age</td>
		<td><?php echo $form->text('User.age',array('class'=>'input-text'));?></td>
	</tr>
	<?php $expl_add = explode('*',$this->data['User']['address']);?>
	<tr>
		<td width="15%" class="boldText">Address</td>
		<td><?php echo $form->text('User.address1',array('class'=>'input-text','value'=>$expl_add[0]));?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">&nbsp;</td>
		<td><?php echo $form->text('User.address2',array('class'=>'input-text','value'=>$expl_add[1]));?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Locality</td>
		<td><?php echo $form->text('User.locality',array('class'=>'input-text'));?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">City</td>
		<td>
			<select name="data[User][city]" class="input-text">
				<option value="">Select City</option>
				<?php foreach($city as $k => $v) {?>
				<option value="<?php echo $v['City']['id'];?>" <?php if($this->data['User']['city'] == $v['City']['id']) {?> selected="selected" <?php }?>><?php echo $v['City']['name'];?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">State</td>
		<td>
			<select name="data[User][state]" class="input-text">
				<option value="">Select State</option>
				<?php foreach($state as $k => $v) {?>
				<option value="<?php echo $v['State']['id'];?>" <?php if($this->data['User']['state'] == $v['State']['id']) {?> selected="selected" <?php }?>><?php echo $v['State']['name'];?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Pincode</td>
		<td><?php echo $form->text('User.pincode',array('class'=>'input-text'));?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">landmark</td>
		<td><?php echo $form->text('User.landmark',array('class'=>'input-text'));?></td>
	</tr>
	<tr>
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->submit('Update', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>
</table>