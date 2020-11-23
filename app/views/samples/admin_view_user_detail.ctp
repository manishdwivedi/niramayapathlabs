<div class="contentcontainer">
    <div class="headings altheading">
        <h2>View Frontend User Detail</h2>
    </div>
    <div class="contentbox">
			
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; <?php echo $html->link('Manage Frontend User(s)', '/admin/samples/view_front_user', array('title'=>'Frontend Users List')); ?> &#187; View Frontend User Detail<br />
	<?php echo $this->Session->flash(); ?>
	
	
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<tr>
		<td colspan="2" style="text-align:right;"><?php echo $html->link('Edit Details',array('controller'=>'samples','action'=>'edit_user_detail',base64_encode($user['User']['id'])));?> | <?php echo $html->link('Reset Password',array('controller'=>'samples','action'=>'reset_pass',base64_encode($user['User']['id'])));?></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">First Name</td>
		<td><?php echo $user['User']['first_name'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Last Name</td>
		<td><?php echo $user['User']['last_name'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Registered Email</td>
		<td><?php echo $user['User']['email'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Alternate Email</td>
		<td><?php echo $user['User']['alternate_email'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Registered Contact</td>
		<td><?php echo $user['User']['contact'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Alternate Contact</td>
		<td><?php echo $user['User']['alternate_contact'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Password</td>
		<td><?php echo $user['User']['passwd'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Gender</td>
		<td><?php echo $user['User']['gender'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Age</td>
		<td><?php echo $user['User']['age'].' Yrs';?></td>
	</tr>
	<?php $expl_add = explode('*',$user['User']['address']);?>
	<tr>
		<td width="15%" class="boldText">Address</td>
		<td><?php echo $expl_add[0].'<br />'.$expl_add[1];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Locality</td>
		<td><?php echo $user['User']['locality'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">City</td>
		<td><?php echo $user['User']['city_name'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">State</td>
		<td><?php echo $user['User']['state_name'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Pincode</td>
		<td><?php echo $user['User']['pincode'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">landmark</td>
		<td><?php echo $user['User']['landmark'];?></td>
	</tr>
</table>