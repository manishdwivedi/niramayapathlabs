<style>
.input-text {
	width:165px;
}
</style>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage PCC(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage PCC(s)
	<div>&nbsp;</div>
	<?php echo $form->create('Lab', array('url'=>'/admin/samples/view_pcc')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<thead>
		<tr>
			<td colspan="8">
				<table border="0" width="100%">
					<tr>
						<td width="30"><?php echo $form->text('FilterPcc.name',array('class'=>'input-Search','placeholder'=>'Enter PCC Name'));?></td>
						<td width="30"><?php echo $form->text('FilterPcc.contact',array('class'=>'input-Search','placeholder'=>'Enter PCC Contact'));?></td>
						<td width="30"><?php echo $form->text('FilterPcc.email',array('class'=>'input-Search','placeholder'=>'Enter PCC Email'));?></td>
						<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!--<th width="5%" align="center">
				<?php
					echo $form->checkbox('Page.main', array('onclick'=>"toggleCheck(this, '.mode-checkbox')"));
				?>
			</th>-->
			<th width="5%" style="text-align:center;"><h4>S.No.</h4></th>
			<th style="text-align:center;"><h4><?php echo $paginator->sort('Status', 'Lab.status', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('PCC Name', 'Lab.pcc_name', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Lab Name', 'Lab.pcc_lab_name', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('PPC Code', 'Lab.pcc_lab_value', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Contact', 'Lab.pcc_contact', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('PCC Email', 'Lab.pcc_email', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('PCC Address', 'Lab.pcc_address', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Rate List Assigned', 'Lab.assigned_ratelist', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php echo $paginator->sort('Booking Patient Type', 'Lab.pcc_type', array('class'=>'pagination')); ?></h4></th>
			<th style="text-align:center;"><h4>Action</h4></th>
			
			
		</tr>	
	</thead>
	<?php
		if(isset($lablist) && count($lablist) > 0){
			$countLabs = count($lablist);
			for($ctr=0;$ctr<$countLabs;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
					}
			
	?>
	
	<tr <?php echo $class;?>>
		<!--<td <?php echo $class;?>>
			<input type="checkbox" name="data[Lab][id][]" value="<?php //echo $lablist[$ctr]['Lab']['id'];?>" class="mode-checkbox" onclick="isChecked('.mode-checkbox', '#PageMain')" />
		</td>-->
		<td <?php echo $class;?> style="text-align:center;">
			<?php										
				echo ($ctr+1);
			?>
		</td>
		<?php if($lablist[$ctr]['Lab']['status']==1){?>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->image('tick.png',array('title'=>'Active'));?></td>
		<?php } else {?>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->image('cross.png',array('title'=>'Inactive'));?></td>
		<?php }?>
		<td <?php echo $class;?>><?php echo $lablist[$ctr]['Lab']['pcc_name'];?></td>
		<td <?php echo $class;?>><?php echo $lablist[$ctr]['Lab']['pcc_lab_name'];?></td>
		<td <?php echo $class;?>><?php echo $lablist[$ctr]['Lab']['pcc_lab_value'];?></td>
		<td <?php echo $class;?>><?php echo $lablist[$ctr]['Lab']['pcc_contact'];?></td>
		<td <?php echo $class;?>><?php echo $lablist[$ctr]['Lab']['pcc_email'];?></td>
		<td <?php echo $class;?>><?php echo nl2br($lablist[$ctr]['Lab']['pcc_address']);?></td>
		<td <?php echo $class;?>>
			<select name="labRate" id="labRate" class="input-text" onchange="assign_rate(this.value,'<?php echo $lablist[$ctr]['Lab']['id'];?>');">
				<option> Select A Ratelist </option>
				<?php foreach($rate as $key => $val) {?>
				<option value="<?php echo $key;?>" <?php if($lablist[$ctr]['Lab']['ratelist']==$key) echo "selected";?>><?php echo $val;?></option>
				<?php }?>
			</select>
		</td>
		<td>
			<select name="data[Lab][pcc_type]" id="booking_p_type" class="input-text" onchange="assign_type(this.value,'<?php echo $lablist[$ctr]['Lab']['id'];?>');">
				<option> Select Booking Patient Type </option>
				<option value="individual" <?php if($lablist[$ctr]['Lab']['pcc_type']=="individual") echo "selected";?>> Individual </option>
				<option value="corporate" <?php if($lablist[$ctr]['Lab']['pcc_type']=="corporate") echo "selected";?>> Corporate </option>
			</select>
		</td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Edit',array('controller'=>'samples','action'=>'edit_pcc',base64_encode($lablist[$ctr]['Lab']['id'])));?></td>		
	</tr>
	<?php }?>
	<!--<tr>
		<td align="left" class="borderBottom bgDarkHeader" colspan="6">
			<strong>Edit PCC Status : </strong><?php //echo $form->select('Page.mode', unserialize(ARR_ACTIONS));?>&nbsp;<?php //echo $form->submit('Apply', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>-->
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
<script>
function assign_rate(val,id)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/assign_lab_rate?rate='+val+'&id='+id,
		success:function(data){
			alert('Rate List assigned');
			window.location.href=siteUrl+'admin/samples/view_pcc/';
		}
	});
}

function assign_type(val,id)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/assign_lab_type?type='+val+'&id='+id,
		success:function(data){
			console.log(data);
			alert('Type assigned');
			//window.location.href=siteUrl+'admin/samples/view_pcc/';
		}
	});
}	
</script>