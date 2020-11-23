<style>
.input-Search {
	background:none;
	height:25px;
	font-size:13px;
}
</style>
<script type="text/javascript">
$(function() {
	$( ".datepicker1" ).datepicker({
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
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Tickets</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/ticket/index', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Tickets
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/ticket/index')); ?>
	<table border="0" width="100%">
		<thead>
			<tr>
				<td style="width:100px;" colspan="9">
					<select name="data[Filter][date_type]" style="background:white;width: 130px;margin-top: 10px;margin-left: 10px;">
						<option value="creation" <?php if($data_date_type=='creation') echo "selected"; ?>>Creation Date</option>
						<option value="complete_by" <?php if($data_date_type=='complete_by') echo "selected"; ?>>To be Completed</option>
					</select>

					<?php if(empty($data_req_from_date)) {?>
					<input type="text" name="data[Filter][req_from_date]" class="input-Search datepicker1" style="width:100px;margin-top: 10px;margin-left: 10px;" placeholder="From Date" />
					<?php } else {?>
					<input type="text" name="data[Filter][req_from_date]" class="input-Search datepicker1" style="width:100px;margin-top: 10px;margin-left: 10px;" placeholder="From Date" value="<?php echo $data_req_from_date;?>" />
					<?php }?>
				
					<?php if(empty($data_req_to_date)) {?>
					<input type="text" name="data[Filter][req_to_date]" class="input-Search datepicker1" style="width:100px;margin-top: 10px;margin-left: 10px;" placeholder="To Date" />
					<?php } else {?>
					<input type="text" name="data[Filter][req_to_date]" class="input-Search datepicker1" style="width:100px;margin-top: 10px;margin-left: 10px;" placeholder="To Date" value="<?php echo $data_req_to_date;?>" />
					<?php }?>
				
					<?php if(empty($req_no)) {?>
					<input type="text" name="data[Filter][req_no]" class="input-Search" placeholder="Enter Request No" style="margin-top: 10px;margin-left: 10px;"/>
					<?php } else {?>
					<input type="text" name="data[Filter][req_no]" class="input-Search" placeholder="Enter Request No" value="<?php echo $req_no;?>" style="margin-top: 10px;margin-left: 10px;" />
					<?php }?>

					<?php if(empty($lab_no)) {?>
					<input type="text" name="data[Filter][lab_no]" class="input-Search" placeholder="Enter Lab No" style="margin-top: 10px;margin-left: 10px;"/>
					<?php } else {?>
					<input type="text" name="data[Filter][lab_no]" class="input-Search" placeholder="Enter Lab No" style="margin-top: 10px;margin-left: 10px;" value="<?php echo $lab_no;?>" />
					<?php }?>

					<?php if(empty($ticket_no)) {?>
					<input type="text" name="data[Filter][ticket_no]" class="input-Search" placeholder="Enter Ticket No" style="margin-top: 10px;margin-left: 10px;"/>
					<?php } else {?>
					<input type="text" name="data[Filter][ticket_no]" class="input-Search" placeholder="Enter Ticket No" value="<?php echo $ticket_no;?>" style="margin-top: 10px;margin-left: 10px;"/>
					<?php }?>
				
					<select name="data[Filter][category]" style="background:white;margin-top: 10px;margin-left: 10px;" placeholder="Category" style="">
						<option value="">Select a Category</option>
						<?php foreach($category as $key=>$val) { ?>
							<option value="<?php echo $key; ?>" <?php if($key==$data_category) echo "selected"; ?>><?php echo $val; ?></option>
						<?php } ?>
					</select>

					<select name="data[Filter][status]" style="background:white;margin-top: 10px;margin-left: 10px;width:135px;" placeholder="Status">
						<option value="">Select a Status</option>
						<?php foreach($status as $key=>$val) { ?>
							<option value="<?php echo $key; ?>" <?php if($key==$status_s) echo "selected"; ?>><?php echo $val; ?></option>
						<?php } ?>
					</select>
					<br>
					<select name="data[Filter][assigned_to]" style="background:white;margin-top: 10px;margin-left: 10px;" placeholder="Assigned To" >
						<option value="">Select a Assigned To</option>
						<?php foreach($users as $key=>$val) { ?>
							<option value="<?php echo $key; ?>" <?php if($key==$assigned_to) echo "selected"; ?>><?php echo $val; ?></option>
						<?php } ?>
					</select>
				
					<select name="data[Filter][priority]" style="background:white;width: 140px;margin-top: 10px;margin-left: 10px;" placeholder="Priority">
						<option value="">Select a Priority</option>
						<?php foreach($priority as $key=>$val) { ?>
							<option value="<?php echo $key; ?>" <?php if($key==$data_priority) echo "selected"; ?>><?php echo $val; ?></option>
						<?php } ?>
					</select>
					<?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height: 30px;width: 50px;margin-left: 10px;')); ?>
				</td>
			</tr>
			<?php if(count($ticketlist) > 0) {?>
			<tr>
				<td colspan="14" style="font-weight:bold; text-align:right;">
				<?php
					echo $this->element('pagination');
				?>
				</td>
			</tr>
			<?php }?>
			<tr>
				<th width="10%" style="text-align:center;"><h4>Ticket No.</h4></th>
				<th style="text-align:center;"><h4>Subject</h4></th>
				<th style="text-align:center;"><h4><span style="color:red;">Request</span>/<span style="color:green;">Lab Number</span></h4></th>
				<th style="text-align:center;"><h4>Date</h4></th>
				<th style="text-align:center;"><h4>Category</h4></th>
				<th style="text-align:center;"><h4>Created By</h4></th>
				<th style="text-align:center;"><h4>Priority</h4></th>
				<th style="text-align:center;"><h4>Assigned To</h4></th>
				<th style="text-align:center;"><h4>Status</h4></th>
			</tr>
		</thead>
		<?php
		if(isset($ticketlist) && count($ticketlist) > 0){
			$countTicket = count($ticketlist);
			for($ctr=0;$ctr<$countTicket;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
		?>
		
		<tr <?php echo $class;?>>
			<td <?php echo $class;?> style="text-align:center;">
				<?php										
					echo $ticketlist[$ctr]['Ticket']['ticket_id'];
				?>
			</td>
			<td <?php echo $class;?>><?php echo $ticketlist[$ctr]['Ticket']['title'];?></td>
			<td <?php echo $class;?>><h4><?php echo '<span style="color:red;">'.$ticketlist[$ctr]['Ticket']['request_id'].'</span>/<span style="color:green;" >'.$ticketlist[$ctr]['Ticket']['lab_no']."</span>";?></h4></td>
			<td <?php echo $class;?>><?php echo date('d-m-Y',strtotime($ticketlist[$ctr]['Ticket']['date']));?></td>
			<td <?php echo $class;?>><?php echo $category[$ticketlist[$ctr]['Ticket']['category']];?></td>
			<td <?php echo $class;?>><?php echo $ticketlist[$ctr]['Ticket']['created_by'];?></td>
			<td <?php echo $class;?>><?php echo $priority[$ticketlist[$ctr]['Ticket']['priority']];?></td>
			<td <?php echo $class;?>><?php if(!empty($ticketlist[$ctr]['Ticket']['assigned_to'])){ echo $users[$ticketlist[$ctr]['Ticket']['assigned_to']];} else { echo "-"; }?></td>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link($status[$ticketlist[$ctr]['Ticket']['status']],array('controller'=>'ticket','action'=>'edit_ticket',base64_encode($ticketlist[$ctr]['Ticket']['id'])));?></td>
		</tr>
		<?php }
		}?>
		<?php if(count($ticketlist) > 0) {?>
			<tr>
				<td colspan="14" style="font-weight:bold; text-align:right;">
				<?php
					echo $this->element('pagination');
				?>
				</td>
			</tr>
			<?php }?>
	</table>
<?php echo $form->end(); ?>
</div>
