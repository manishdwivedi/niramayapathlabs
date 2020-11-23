
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
	<?php echo $form->create('Test', array('url'=>'/admin/samples/index/first')); ?>
	
	
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
			<th style="text-align:center;"><h4>First Name</h4></th>
			<th style="text-align:center;"><h4>Last Name</h4></th>
			<th style="text-align:center;"><h4>Contact</h4></th>
			<th style="text-align:center;"><h4>Locality</h4></th>
			<th style="text-align:center;"><h4>Email Verify</h4></th>
			<th style="text-align:center;"><h4>Helpdesk Verify</h4></th>
			<th style="text-align:center;"><h4>Appointment Activate</h4></th>
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
		<td style="text-align:center; border-bottom:1px solid #999999;"><?php echo $doctorlist[$ctr]['Doctor']['first_name'];?></td>
		<td style="text-align:center; border-bottom:1px solid #999999;"><?php echo $doctorlist[$ctr]['Doctor']['last_name'];?></td>
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
			<?php if($doctorlist[$ctr]['Doctor']['appointment_activation'] == 1) {?>
			<?php echo $html->image('tick_icon.png');?>
			<?php } else {?>
			<?php echo $html->image('cross_icon.png');?>
			<?php }?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #999999;">
			<?php if($doctorlist[$ctr]['Doctor']['appointment_activation'] == 1) {?>
				<?php if(!empty($param_page)) {?>
					<?php echo $html->link('Deactivate',array('controller'=>'pages','action'=>'deactivate_appoint',base64_encode($doctorlist[$ctr]['Doctor']['id']),$param_page));?>
				<?php } else {?>
					<?php echo $html->link('Deactivate',array('controller'=>'pages','action'=>'deactivate_appoint',base64_encode($doctorlist[$ctr]['Doctor']['id'])));?>
				<?php }?>
			<?php } else {?>
				<?php if(!empty($param_page)) {?>
					<?php echo $html->link('Activate',array('controller'=>'pages','action'=>'activate_appoint',base64_encode($doctorlist[$ctr]['Doctor']['id']),$param_page));?>
				<?php } else {?>
					<?php echo $html->link('Activate',array('controller'=>'pages','action'=>'activate_appoint',base64_encode($doctorlist[$ctr]['Doctor']['id'])));?>
				<?php }?>
			<?php }?>
		</td>
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