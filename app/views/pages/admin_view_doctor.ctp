
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
        <h2>Manage Doctor(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Doctor(s)
	<div>&nbsp;</div>
	<?php echo $form->create('Test', array('url'=>'/admin/pages/view_doctor')); ?>
	
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
				<?php if(!empty($helpdesk_verified)) {?>
					<select name="data[Doctorsearch][help_verify]" class="input-Search">
						<option value="">Helpdesk Verified</option>
						<option value="1" <?php if($helpdesk_verified == 1) {?> selected="selected" <?php }?>>Verified</option>
						<option value="0" <?php if($helpdesk_verified == 0) {?> selected="selected" <?php }?>>Not Verified</option>
					</select>
				<?php } else {?>
					<select name="data[Doctorsearch][help_verify]" class="input-Search">
						<option value="">Helpdesk Verified</option>
						<option value="1">Verified</option>
						<option value="0">Not Verified</option>
					</select>
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
			<td>
				<?php if(!empty($featured)) {?>
					<select name="data[Doctorsearch][featured]" class="input-Search">
						<option value="">Featured Doctor</option>
						<option value="1" <?php if($featured == 1) {?> selected="selected" <?php }?>>Featured</option>
						<option value="0" <?php if($featured == 0) {?> selected="selected" <?php }?>>Not Featured</option>
					</select>
				<?php } else {?>
					<select name="data[Doctorsearch][featured]" class="input-Search">
						<option value="">Featured Doctor</option>
						<option value="1">Featured</option>
						<option value="0">Not Featured</option>
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
	<tr id="FeaturedMess_<?php echo $doctorlist[$ctr]['Doctor']['id'];?>" style="display:none;">
		<td style="text-align:center; border-bottom:1px solid #999999; border-right:1px solid #999999; border-left:1px solid #999999; font-weight:bold; color:#FF0000;" colspan="14">
			Please remove any one doctor from featured list because you can mark only 2 doctors as featured doctors.
		</td>
	</tr>
	<tr id="FeaturedMessNone_<?php echo $doctorlist[$ctr]['Doctor']['id'];?>" style="display:none;">
		<td style="text-align:center; border-bottom:1px solid #999999; border-right:1px solid #999999; border-left:1px solid #999999; font-weight:bold; color:#FF0000;" colspan="14">
			Please first verify the doctors then mark any 2 doctors as featured doctors.
		</td>
	</tr>
	<tr id="VerifyDocMess_<?php echo $doctorlist[$ctr]['Doctor']['id'];?>" style="display:none;"></tr>
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
		<!--<td style="text-align:center; border-bottom:1px solid #999999;" id="Helpverify_<?php //echo $doctorlist[$ctr]['Doctor']['id'];?>">
			<?php //if($doctorlist[$ctr]['Doctor']['status'] == 1) {?>
			<?php //echo $html->image('tick_icon.png');?>
			<?php //} else {?>
			<?php //echo $html->image('cross_icon.png');?>
			<?php //}?><br />
			<input type="radio" value="1" name="data[Doctor][verify_<?php //echo $doctorlist[$ctr]['Doctor']['id'];?>]"id="VerifyDoc_<?php //echo $doctorlist[$ctr]['Doctor']['id'];?>" <?php //if($doctorlist[$ctr]['Doctor']['status'] == 1) {?> checked="checked" <?php //}?> onclick="doctor_verify('<?php //echo $doctorlist[$ctr]['Doctor']['id'];?>',this.value);" />&nbsp;Yes&nbsp;&nbsp;
			<input type="radio" value="0" name="data[Doctor][verify_<?php //echo $doctorlist[$ctr]['Doctor']['id'];?>]" id="VerifyDocSec_<?php //echo $doctorlist[$ctr]['Doctor']['id'];?>" <?php //if($doctorlist[$ctr]['Doctor']['status'] == 0) {?> checked="checked" <?php //}?> onclick="doctor_verify('<?php //echo $doctorlist[$ctr]['Doctor']['id'];?>',this.value);" />&nbsp;No<br />
			<?php //echo $html->image('p_rocess.gif',array('width'=>50,'id'=>'DocVerify_'.$doctorlist[$ctr]['Doctor']['id'],'style'=>'display:none;'));?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #999999;" id="Featured_<?php //echo $doctorlist[$ctr]['Doctor']['id'];?>">
			<?php //if($doctorlist[$ctr]['Doctor']['featured'] == 1) {?>
			<?php //echo $html->image('tick_icon.png');?>
			<?php //} else {?>
			<?php //echo $html->image('cross_icon.png');?>
			<?php //}?><br />
			<input type="radio" value="1" name="data[Doctor][feature_<?php //echo $doctorlist[$ctr]['Doctor']['id'];?>]" <?php //if($doctorlist[$ctr]['Doctor']['featured'] == 1) {?> checked="checked" <?php //}?> onclick="feature_doctor('<?php //echo $doctorlist[$ctr]['Doctor']['id'];?>',this.value);" id="FeatureRadio_<?php //echo $doctorlist[$ctr]['Doctor']['id'];?>" />&nbsp;Yes&nbsp;&nbsp;
			<input type="radio" value="0" name="data[Doctor][feature_<?php //echo $doctorlist[$ctr]['Doctor']['id'];?>]" <?php //if($doctorlist[$ctr]['Doctor']['featured'] == 0) {?> checked="checked" <?php //}?> onclick="feature_doctor('<?php //echo $doctorlist[$ctr]['Doctor']['id'];?>',this.value);" id="FeatureRadioSec_<?php //echo $doctorlist[$ctr]['Doctor']['id'];?>" />&nbsp;No<br />
			<?php //echo $html->image('p_rocess.gif',array('width'=>50,'id'=>'DocFeature_'.$doctorlist[$ctr]['Doctor']['id'],'style'=>'display:none;'));?>
		</td>-->
		<td style="text-align:center; border-bottom:1px solid #999999;"><?php echo $html->link('View Detail',array('controller'=>'pages','action'=>'doctor_detail',base64_encode($doctorlist[$ctr]['Doctor']['id'])));?></td>
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