<style type="text/css">
.class-textarea
{
	border: 1px solid #999999;
    border-radius: 3px 3px 3px 3px;
    color: #666666;
    margin-bottom: 5px;
    padding: 10px;
    width: 300px;
	font-size:13px;
}

.hint-class
{
	color:#999999; 
	font-size:11px; 
	padding:0 0 0 10px;
}
</style>



<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Edit Speciality & Disease</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; <?php echo $html->link('Manage Test(s)', '/admin/tests/index', array('title'=>'Manage Test(s)')); ?> &#187; <?php echo $html->link(ucwords($testParam), array('controller'=>'tests','action'=>'edit_test',base64_encode($dec_test_id)), array('title'=>ucwords($testParam))); ?> &#187; Edit Speciality & Disease
	<?php echo $form->create(null, array('url'=>'/admin/tests/edit_spec_dise','id'=>'form1','name'=>'form1')); ?>
	<?php echo $form->hidden('Test.insert_id',array('value'=>$dec_test_id));?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">Edit Specialities and Diseases of (<?php echo $testParam.' - '.$testCode;?>)</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr id="GenderDiv">
		<td width="15%" class="boldText">For Gender</td>
		<td>
			<table border="0" width="100%">
				<?php
				$row = 0;
				$column = 2;
				foreach($gender as $key => $val)
				{
					if($row % $column == 0) 
					{
						echo '<tr>';
					}
					if (in_array($val['Gender']['id'], $this->data['Test']['gender']))
					{
						$val_check = 'Yes';
					}
					else
					{
						$val_check = 'No';
					}
					
					
					?>
					<td><input type="checkbox" name="data[Test][gender][]" value="<?php echo $val['Gender']['id'];?>" <?php if($val_check == 'Yes') {?> checked="checked" <?php }?> />&nbsp;&nbsp;<?php echo $val['Gender']['name'];?></td>
					<?php 
					$row++;
					if($row % $column == 0) 
					{
						echo '</tr>';
					}
				}
				?>
			</table>
		</td>
	</tr>
	<tr id="AgeDiv">
		<td width="15%" class="boldText">For Age Group</td>
		<td>
			<table border="0" width="100%">
				<?php
				$row = 0;
				$column = 3;
				foreach($agegroup as $key => $val)
				{
					if($row % $column == 0) 
					{
						echo '<tr>';
					}
					if (in_array($val['AgeGroup']['id'], $this->data['Test']['age_group']))
					{
						$val_check = 'Yes';
					}
					else
					{
						$val_check = 'No';
					}
					
					
					?>
					<td><input type="checkbox" name="data[Test][age_group][]" value="<?php echo $val['AgeGroup']['id'];?>" <?php if($val_check == 'Yes') {?> checked="checked" <?php }?> />&nbsp;&nbsp;<?php echo $val['AgeGroup']['name']." (".$val['AgeGroup']['category'].")";?></td>
					<?php 
					$row++;
					if($row % $column == 0) 
					{
						echo '</tr>';
					}
				}
				?>
			</table>
		</td>
	</tr>
	<tr id="SymptomDiv">
		<td width="15%" class="boldText">For Symptoms</td>
		<td>
			<table border="0" width="100%">
				<?php
				$row = 0;
				$column = 3;
				foreach($symptoms as $key => $val)
				{
					if($row % $column == 0) 
					{
						echo '<tr>';
					}
					if (in_array($val['Symptoms']['id'], $this->data['Test']['symptoms']))
					{
						$val_check = 'Yes';
					}
					else
					{
						$val_check = 'No';
					}
					
					
					?>
					<td><input type="checkbox" name="data[Test][symptoms][]" value="<?php echo $val['Symptoms']['id'];?>" <?php if($val_check == 'Yes') {?> checked="checked" <?php }?> />&nbsp;&nbsp;<?php echo $val['Symptoms']['name'];?></td>
					<?php 
					$row++;
					if($row % $column == 0) 
					{
						echo '</tr>';
					}
				}
				?>
			</table>
		</td>
	</tr>
	<tr id="SpecialityDiv">
		<td width="15%" class="boldText">For Organs</td>
		<td>
			<table border="0" width="100%">
				<?php
				$row = 0;
				$column = 3;
				foreach($speciality as $key => $val)
				{
					if($row % $column == 0) 
					{
						echo '<tr>';
					}
					if (in_array($val['Speciality']['id'], $this->data['Test']['speciality']))
					{
						$val_check = 'Yes';
					}
					else
					{
						$val_check = 'No';
					}
					
					
					?>
					<td><input type="checkbox" name="data[Test][speciality][]" value="<?php echo $val['Speciality']['id'];?>" <?php if($val_check == 'Yes') {?> checked="checked" <?php }?> />&nbsp;&nbsp;<?php echo $val['Speciality']['name'];?></td>
					<?php 
					$row++;
					if($row % $column == 0) 
					{
						echo '</tr>';
					}
				}
				?>
			</table>
		</td>
	</tr>
	<tr id="DiseaseDiv">
		<td width="15%" class="boldText">For Condition</td>
		<td>
			<table border="0" width="100%">
				<?php
				$row = 0;
				$column = 2;
				foreach($disease as $key => $val)
				{
					if($row % $column == 0) 
					{
						echo '<tr>';
					}
					if (in_array($val['Disease']['id'], $this->data['Test']['disease']))
					{
						$val_check = 'Yes';
					}
					else
					{
						$val_check = 'No';
					}
					?>
					<td><input type="checkbox" name="data[Test][disease][]" value="<?php echo $val['Disease']['id'];?>" <?php if($val_check == 'Yes') {?> checked="checked" <?php }?> />&nbsp;&nbsp;<?php echo $val['Disease']['name'];?></td>
					<?php 
					$row++;
					if($row % $column == 0) 
					{
						echo '</tr>';
					}
				}
				?>
			</table>
		</td>
	</tr>
	
	<tr>
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->submit('Update', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>
</div>