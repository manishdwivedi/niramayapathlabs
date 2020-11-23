
<!-- 30-10-13 Starts -->
<script type="text/javascript">
$(function() {
	$( ".datepicker1" ).datepicker({
		//maxDate: 0,
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker2" ).datepicker({
		//maxDate: 0,
		dateFormat: 'dd-mm-yy'
	});
	
});

</script>
<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>
<div id="CurrDoc" style="display:none;"></div>
<div id="VerifyDoc" style="display:none;"></div>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Featured Doctor(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Featured Doctor(s)
	<div>&nbsp;</div>
	<?php echo $form->create('Test', array('url'=>'/admin/pages/view_featured_doctor')); ?>
	
	<table border="0" width="100%">
		<tr>
			<td>
				<?php if(!empty($first_name)) {?>
					<?php echo $form->text('Doctorsearch.f_name',array('class'=>'input-Search','value'=>$first_name));?>
				<?php } else {?>
					<?php echo $form->text('Doctorsearch.f_name',array('class'=>'input-Search','placeholder'=>'First Name'));?>
				<?php }?>
			</td>
			<td>
				<?php if(!empty($last_name)) {?>
					<?php echo $form->text('Doctorsearch.l_name',array('class'=>'input-Search','value'=>$last_name));?>
				<?php } else {?>
					<?php echo $form->text('Doctorsearch.l_name',array('class'=>'input-Search','placeholder'=>'Last Name'));?>
				<?php }?>
			</td>
			<td>
				<?php if(!empty($email)) {?>
					<?php echo $form->text('Doctorsearch.email',array('class'=>'input-Search','value'=>$email));?>
				<?php } else {?>
					<?php echo $form->text('Doctorsearch.email',array('class'=>'input-Search','placeholder'=>'Email'));?>
				<?php }?>
			</td>
			<td>
				<?php if(!empty($phn_number)) {?>
					<?php echo $form->text('Doctorsearch.contact',array('class'=>'input-Search','value'=>$phn_number));?>
				<?php } else {?>
					<?php echo $form->text('Doctorsearch.contact',array('class'=>'input-Search','placeholder'=>'Phone Number'));?>
				<?php }?>
			</td>
			<td>
				<?php if(!empty($email_verified)) {?>
					<select name="data[Doctorsearch][email_verify]" class="input-Search">
						<option value="">Email Verified</option>
						<option value="1" <?php if($email_verified == 1) {?> selected="selected" <?php }?>>Verified</option>
						<option value="0" <?php if($email_verified == 0) {?> selected="selected" <?php }?>>Not Verified</option>
					</select>
				<?php } else {?>
					<select name="data[Doctorsearch][email_verify]" class="input-Search">
						<option value="">Email Verified</option>
						<option value="1">Verified</option>
						<option value="0">Not Verified</option>
					</select>
				<?php }?>
			</td>
			<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
		</tr>
	</table>
	
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<td colspan="14" style="font-weight:bold; text-align:right;">
			<?php
				echo $this->element('pagination');
			?>
			</td>
		</tr>
		<tr>
			
			<th style="text-align:center;"><h4>Photo</h4></th>
			<th style="text-align:center;"><h4>Name</h4></th>
			<th style="text-align:center;"><h4>Contact</h4></th>
			<th style="text-align:center;"><h4>Locality</h4></th>
			<th style="text-align:center;"><h4>Email Verify</h4></th>
			<th style="text-align:center;"><h4>Helpdesk Verify</h4></th>
			<th style="text-align:center;"><h4>Doctor Featured</h4></th>
			<th style="text-align:center;"><h4>Admin Featured</h4></th>
			<th style="text-align:center;"><h4>Action</h4></th>
		</tr>	
	</thead>
	<?php
		if(isset($doctorlist) && count($doctorlist) > 0){
			$countDoctor = count($doctorlist);
			for($ctr=0;$ctr<$countDoctor;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
	?>
	
	<tr>
		
		<td style="text-align:center; border-bottom:1px solid #999999;">
			<?php if(!empty($doctorlist[$ctr]['Doctor']['image'])) {?>
				<?php echo $html->image(DOCTOR_IMAGE_SMALL_URL.$doctorlist[$ctr]['Doctor']['image'],array('width'=>100));?>
			<?php } else {?>
				<?php if($doctorlist[$ctr]['Doctor']['gender'] == 1) {?>
					<?php echo $html->image('frontend/default_male.jpg',array('width'=>100));?>
				<?php }?>
				<?php if($doctorlist[$ctr]['Doctor']['gender'] == 2) {?>
					<?php echo $html->image('frontend/default_female.jpg',array('width'=>100));?>
				<?php }?>
			<?php }?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #999999;"><?php echo $doctorlist[$ctr]['Doctor']['title'].' '.$doctorlist[$ctr]['Doctor']['first_name'].' '.$doctorlist[$ctr]['Doctor']['last_name'];?></td>
		<td style="text-align:center; border-bottom:1px solid #999999;"><?php echo $doctorlist[$ctr]['Doctor']['contact'];?></td>
		<td style="text-align:center; border-bottom:1px solid #999999;"><?php echo $doctorlist[$ctr]['Doctor']['locality'];?></td>
		<td style="text-align:center; border-bottom:1px solid #999999;">
			<?php if($doctorlist[$ctr]['Doctor']['email_confirm'] == 1) {?>
			<?php echo $html->image('tick_icon.png');?>
			<?php } else {?>
			<?php echo $html->image('cross_icon.png');?>
			<?php }?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #999999;">
			<?php if($doctorlist[$ctr]['Doctor']['status'] == 1) {?>
			<?php echo $html->image('verified-dr-icon.png');?>
			<?php } else {?>
			<?php echo $html->image('non-verified-dr-icon.png');?>
			<?php }?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #999999;">
			<?php if($doctorlist[$ctr]['Doctor']['featured'] == 1) {?>
			<?php echo $html->image('featured-dr-icon.png');?>
			<?php } else {?>
			<?php echo $html->image('non-featured-dr-icon.png');?>
			<?php }?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #999999;">
			<?php if($doctorlist[$ctr]['Doctor']['admin_featured'] == 1) {?>
			<?php echo $html->image('featured-dr-icon.png');?>
			<?php } else {?>
			<?php echo $html->image('non-featured-dr-icon.png');?>
			<?php }?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #999999;"><?php echo $html->link('View Detail',array('controller'=>'pages','action'=>'doctor_detail_3',base64_encode($doctorlist[$ctr]['Doctor']['id'])));?></td>
	</tr>
	<?php }?>
	
	<tr>
		<td colspan="14" style="font-weight:bold; text-align:right;">
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