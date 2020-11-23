<!-- 30-10-13 Starts -->
<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		//maxDate: 0,
		dateFormat: 'd-M-Y'
	});
});

</script>
<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Doctor(s) List</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Doctor(s) List
	<div>&nbsp;</div>
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		<thead>
		<tr>
			<td colspan="7">
				<?php echo $form->create(null,array('url'=>'/admin/pages/blackout'));?>
				<table border="0" width="100%">
					<tr>
						<td width="150">
							<?php if(!empty($uniId)) {?>
							<?php echo $form->text('FilterDoctor.unique_id',array('class'=>'input-Search','placeholder'=>'Enter Unique ID','value'=>$dob));?>
							<?php } else {?>
							<?php echo $form->text('FilterDoctor.unique_id',array('class'=>'input-Search','placeholder'=>'Enter Unique ID'));?>
							<?php }?>
						</td>
						<td width="130">
							<?php if(!empty($f_name)) {?>
							<?php echo $form->text('FilterDoctor.name',array('class'=>'input-Search','placeholder'=>'Enter First Name','value'=>$f_name));?>
							<?php } else {?>
							<?php echo $form->text('FilterDoctor.name',array('class'=>'input-Search','placeholder'=>'Enter First Name'));?>
							<?php }?>
						</td>
						<td width="130">
							<?php if(!empty($contact)) {?>
							<?php echo $form->text('FilterDoctor.contact',array('class'=>'input-Search','placeholder'=>'Enter Contact Number','value'=>$contact));?>
							<?php } else {?>
							<?php echo $form->text('FilterDoctor.contact',array('class'=>'input-Search','placeholder'=>'Enter Contact Number'));?>
							<?php }?>
						</td>
						
						<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
					</tr>
				</table>
				<?php echo $form->end();?>
			</td>
		</tr>
		<tr>
				<td colspan="14" style="font-weight:bold; text-align:right;">
				<?php
					echo $this->element('pagination');
				?>
				</td>
		</tr>
		<tr>
			
			<th style="text-align:center;"><h4>Photo</h4></th>
			<th style="text-align:center;"><h4>UniqueID</h4></th>
			<th style="text-align:center;"><h4>First Name</h4></th>
			<th style="text-align:center;"><h4>Last Name</h4></th>
			<th style="text-align:center;"><h4>Contact</h4></th>
			<th style="text-align:center;"><h4>Locality</h4></th>
			<!--<th style="text-align:center;"><h4>DOB</h4></th>-->
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
		
		<td style="text-align:center; border-bottom:1px solid #999999;"><?php echo $html->image(DOCTOR_IMAGE_SMALL_URL.$doctorlist[$ctr]['Doctor']['image']);?></td>
		<td style="text-align:center; border-bottom:1px solid #999999;"><?php echo $doctorlist[$ctr]['Doctor']['unique_id'];?></td>
		<td style="text-align:center; border-bottom:1px solid #999999;"><?php echo $doctorlist[$ctr]['Doctor']['first_name'];?></td>
		<td style="text-align:center; border-bottom:1px solid #999999;"><?php echo $doctorlist[$ctr]['Doctor']['last_name'];?></td>
		<td style="text-align:center; border-bottom:1px solid #999999;"><?php echo $doctorlist[$ctr]['Doctor']['contact'];?></td>
		<td style="text-align:center; border-bottom:1px solid #999999;"><?php echo $doctorlist[$ctr]['Doctor']['locality'];?></td>
		<td style="text-align:center; border-bottom:1px solid #999999;"><?php echo $html->link('View Clinics',array('controller'=>'pages','action'=>'view_doc_clinic',base64_encode($doctorlist[$ctr]['Doctor']['id'])));?></td>
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