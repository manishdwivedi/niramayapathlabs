<script>
$(function() {
	$( ".datepicker2" ).datepicker({
		minDate: '+1D',
		maxDate: '+30D',
		dateFormat: 'dd-mm-yy'
	});
});
</script>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Assign Runner To Routes</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/runner/runner_request', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Assign Runner To Routes
	<div >&nbsp;
		
	</div>
	
	<?php echo $form->create(null, array('url'=>'/admin/runner/assign_routerunner')); ?>
	<table border="0" width="50%">
		<tr class="daily">
			<td width="15%" class="boldText">Date<font color="#FF0000">*</font></td>
			<td>
				<?php echo $form->text('Runner.date', array('class'=>'input-text datepicker2','style'=>'width:100px;','required'=>'true')); ?>
			</td>
		</tr>
		<tr>
			<th style="width:5%;text-align:center;"><h4>S.No.</h4></th>
			<th style="text-align:center;"><h4>Zone Name</h4></th>
			<th style="text-align:center;"><h4>Runner</h4></th>
		</tr>
		<?php
		if(isset($zone) && count($zone) > 0){
			$countRunner = count($zone);
			for($ctr=0;$ctr<$countRunner;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
		?>
		
		<tr <?php echo $class;?>>
			<td <?php echo $class;?> style="width:5%;text-align:center;">
				<?php										
					echo ($ctr+1);
				?>
			</td>
			<td  style="text-align:center;" <?php echo $class;?>><?php echo $zone[$ctr]['Zone']['name']; ?></td>
			<td  style="text-align:center;width:200px;" <?php echo $class;?>>
				<select name="data[Runner][zone][<?php echo $zone[$ctr]['Zone']['id']; ?>]" id="runner_<?php echo $zone[$ctr]['Zone']['id']; ?>" style="width:150px;" required>
					<option value="">Select One</option>
					<?php foreach($agent as $key=>$val){?>
						<option value="<?php echo $key;?>"><?php echo $val; ?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<?php }
		}?>
		<tr>
			<td>
				<?php echo $form->submit('Save', array('div'=>false, 'class' => 'btn','onclick'=>'')); ?>
			</td>
		</tr>
	</table>
<?php echo $form->end(); ?>
</div>