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
        <h2>Manage Recurring Tasks</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin/ticket/index', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Recurring Tasks
	<div>&nbsp;</div>
	<?php echo $form->create(null, array('url'=>'/admin/samples/view_ticket')); ?>
	<table border="0" width="100%">
		<thead>
			<tr>
				<td style="width:100px;">
					<?php if(empty($data_req_from_date)) {?>
					<input type="text" name="data[Filter][req_from_date]" class="input-Search datepicker1" style="width:100px;" placeholder="From Date" />
					<?php } else {?>
					<input type="text" name="data[Filter][req_from_date]" class="input-Search datepicker1" style="width:100px;" placeholder="From Date" value="<?php echo $data_req_from_date;?>" />
					<?php }?>
				</td>
				<td style="width:100px;">
					<?php if(empty($data_req_to_date)) {?>
					<input type="text" name="data[Filter][req_to_date]" class="input-Search datepicker1" style="width:100px;" placeholder="To Date" />
					<?php } else {?>
					<input type="text" name="data[Filter][req_to_date]" class="input-Search datepicker1" style="width:100px;" placeholder="To Date" value="<?php echo $data_req_to_date;?>" />
					<?php }?>
				</td>
				<td style="width:100px;">
					<?php if(empty($title)) {?>
					<input type="text" name="data[Filter][title]" class="input-Search" style="width:100px;" placeholder="Enter Subject" />
					<?php } else {?>
					<input type="text" name="data[Filter][title]" class="input-Search" style="width:100px;" placeholder="Enter Subject" value="<?php echo $title;?>" />
					<?php }?>
				</td>
				<td>
					<select name="data[Filter][category]" style="background:white;" placeholder="Category">
						<option value="">Select a Category</option>
						<?php foreach($category as $key=>$val) { ?>
							<option value="<?php echo $key; ?>" <?php if($key==$data_category) echo "selected"; ?>><?php echo $val; ?></option>
						<?php } ?>
					</select>
				</td>
				<td>
					<select name="data[Filter][priority]" style="background:white;" placeholder="Priority">
						<option value="">Select a Priority</option>
						<?php foreach($priority as $key=>$val) { ?>
							<option value="<?php echo $key; ?>" <?php if($key==$data_priority) echo "selected"; ?>><?php echo $val; ?></option>
						<?php } ?>
					</select>
				</td>
				<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
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
				<th style="text-align:center;"><h4>From Date</h4></th>
				<th style="text-align:center;"><h4>To Date</h4></th>
				<th style="text-align:center;"><h4>Category</h4></th>
				<th style="text-align:center;"><h4>Created By</h4></th>
				<th style="text-align:center;"><h4>Priority</h4></th>
				<th style="text-align:center;"><h4>Concern Raised By</h4></th>
				<th style="text-align:center;"><h4>Recurring Type</h4></th>
				<th style="text-align:center;"><h4>Action</h4></th>
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
					echo $ticketlist[$ctr]['TicketRecurring']['ticket_id'];
				?>
			</td>
			<td <?php echo $class;?>><?php echo $ticketlist[$ctr]['TicketRecurring']['title'];?></td>
			<td <?php echo $class;?>><?php if(date('d-m-Y',strtotime($ticketlist[$ctr]['TicketRecurring']['from_date']))=="30-11--0001") { echo "-"; } else
			{	
				echo date('d-m-Y',strtotime($ticketlist[$ctr]['TicketRecurring']['from_date']));
			}?></td>
			<td <?php echo $class;?>><?php if(date('d-m-Y',strtotime($ticketlist[$ctr]['TicketRecurring']['to_date']))=="30-11--0001") { echo "-"; } else
			{	
				echo date('d-m-Y',strtotime($ticketlist[$ctr]['TicketRecurring']['to_date']));
			}?></td>
			<td <?php echo $class;?>><?php echo $category[$ticketlist[$ctr]['TicketRecurring']['category']];?></td>
			<td <?php echo $class;?>><?php echo $ticketlist[$ctr]['TicketRecurring']['created_by'];?></td>
			<td <?php echo $class;?>><?php echo $priority[$ticketlist[$ctr]['TicketRecurring']['priority']];?></td>
			<td <?php echo $class;?>><?php echo $ticketlist[$ctr]['TicketRecurring']['concern_raised'];?></td>
			<td <?php echo $class;?>><?php echo $recur_type[$ticketlist[$ctr]['TicketRecurring']['recurring_type']];?></td>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('Show',array('controller'=>'Ticket','action'=>'edit_task_recur',base64_encode($ticketlist[$ctr]['TicketRecurring']['id'])));?></td>
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