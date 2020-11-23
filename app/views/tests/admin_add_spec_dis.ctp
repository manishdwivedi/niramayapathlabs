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
        <h2>Add Speciality & Disease</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/users/index', array('title'=>'Home')); ?>&#187;<?php echo $testParam;?>&#187;Add Speciality & Disease
	<?php echo $form->create(null, array('url'=>'/admin/tests/add_spec_dis','id'=>'form1','name'=>'form1')); ?>
	<?php echo $form->hidden('Test.insert_id',array('value'=>$test_id_dec));?>
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
					?>
					<td><input type="checkbox" name="data[Test][gender][]" value="<?php echo $val['Gender']['id'];?>" />&nbsp;&nbsp;<?php echo $val['Gender']['name'];?></td>
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
					?>
					<td><input type="checkbox" name="data[Test][age_group][]" value="<?php echo $val['AgeGroup']['id'];?>" />&nbsp;&nbsp;<?php echo $val['AgeGroup']['name']." (".$val['AgeGroup']['category'].")";?></td>
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
					?>
					<td><input type="checkbox" name="data[Test][symptoms][]" value="<?php echo $val['Symptoms']['id'];?>" />&nbsp;&nbsp;<?php echo $val['Symptoms']['name'];?></td>
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
		<td width="15%" class="boldText">Specialities</td>
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
					?>
					<td><input type="checkbox" name="data[Test][speciality][]" value="<?php echo $val['Speciality']['id'];?>" />&nbsp;&nbsp;<?php echo $val['Speciality']['name'];?></td>
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
		<td width="15%" class="boldText">Diseases</td>
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
					?>
					<td><input type="checkbox" name="data[Test][disease][]" value="<?php echo $val['Disease']['id'];?>" />&nbsp;&nbsp;<?php echo $val['Disease']['name'];?></td>
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
			<?php echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>	
</table>
<?php echo $form->end(); ?>
</div>