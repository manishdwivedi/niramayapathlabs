<script type="text/javascript">
function popup()
{
	var print_count = document.getElementById('print_count').innerHTML;
	if(print_count == '')
	{
		document.getElementById('print_count').innerHTML = 1;
		window.open('<?php echo SITE_URL;?>admin/samples/print_list','name','height=500,width=600,scrollbars=yes');
	}
	else
	{
		window.location.href=siteUrl+'admin/samples/home/SG9tZQ==/Assign';
	}
}
</script>
<?php 
//if(isset($options) && $options!="")
//{
//	$paginator->options=array('url'=>$options);
//}
?>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Sample Request(s)</h2>
    </div>
    <div class="contentbox">
	<?php echo $this->Session->flash(); ?>
	<?php if(!empty($req_type)) {?>		
    <?php echo $html->link('Home', '/admin/samples/home/'.base64_encode('Home').'/'.$req_type, array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Sample Request(s)
	<?php } else {?>
	<?php echo $html->link('Home', '/admin/samples/home/'.base64_encode('Home').'/New', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Sample Request(s)
	<?php }?>
	<div>&nbsp;</div>
<div id="print_count" style="display:none;"></div>
	<?php echo $form->create('Test', array('url'=>'/admin/samples/filter_page')); ?>
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		
	<thead>
		
		<tr>
			<td colspan="9">
				<table border="0" width="100%">
					<tr>
						<td style="font-weight:bold; text-align:left; width:200px;">Filter Requests</td>
						<td style="text-align:right; width:100px;">
							<?php if(!empty($agent_id)) {?>
							<select name="data[Filter][agent_id]" id="FilterAgentId" class="input-text" style="width:150px;">
								<option value="">Select Agent</option>
								<?php foreach($agent_list as $key => $val) {?>
								<option value="<?php echo $val['Agent']['id'];?>" <?php if($val['Agent']['id'] == $agent_id) {?> selected="selected" <?php }?>><?php echo $val['Agent']['name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[Filter][agent_id]" id="FilterAgentId" class="input-text" style="width:150px;">
								<option value="">Select Agent</option>
								<?php foreach($agent_list as $key => $val) {?>
								<option value="<?php echo $val['Agent']['id'];?>"><?php echo $val['Agent']['name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
						<td style="text-align:right; width:100px;">
							<?php if(!empty($city_id)) {?>
							<select name="data[Filter][city_id]" id="FilterCityId" class="input-text" style="width:150px;">
								<option value="">Select City</option>
								<?php foreach($city as $key => $val) {?>
								<option value="<?php echo $val['City']['id'];?>" <?php if($val['City']['id'] == $city_id) {?> selected="selected" <?php }?>><?php echo $val['City']['name'];?></option>
								<?php }?>
							</select>
							<?php } else {?>
							<select name="data[Filter][city_id]" id="FilterCityId" class="input-text" style="width:150px;">
								<option value="">Select City</option>
								<?php foreach($city as $key => $val) {?>
								<option value="<?php echo $val['City']['id'];?>"><?php echo $val['City']['name'];?></option>
								<?php }?>
							</select>
							<?php }?>
						</td>
						<td style="text-align:right; width:100px;">
							<?php if(!empty($from_date)) {?>
								<?php echo $form->text('Filter.from_date', array('class'=>'input-text datepicker1','value'=>$from_date,'onblur'=>'if(this.value=="")this.value="'.$from_date.'"',' onfocus'=>'if(this.value=="'.$from_date.'")this.value="";','style'=>'width:150px;')); ?>
							<?php } else {?>
								<?php echo $form->text('Filter.from_date', array('class'=>'input-text datepicker1','value'=>'From Date','onblur'=>'if(this.value=="")this.value="From Date"',' onfocus'=>'if(this.value=="From Date")this.value="";','style'=>'width:150px;')); ?>
							<?php }?>
						</td>
						<td style="text-align:right; width:100px;">
							<?php if(!empty($to_date)) {?>
								<?php echo $form->text('Filter.to_date', array('class'=>'input-text datepicker2','value'=>$to_date,'onblur'=>'if(this.value=="")this.value="'.$to_date.'"',' onfocus'=>'if(this.value=="'.$to_date.'")this.value="";','style'=>'width:150px;')); ?>
							<?php } else {?>
								<?php echo $form->text('Filter.to_date', array('class'=>'input-text datepicker2','value'=>'To Date','onblur'=>'if(this.value=="")this.value="To Date"',' onfocus'=>'if(this.value=="To Date")this.value="";','style'=>'width:150px;')); ?>
							<?php }?>
						</td>
						<td style="text-align:left; width:100px;"><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn')); ?></td>
						<td style="text-align:left; width:100px;"><?php echo $html->link($html->image('admin/print.jpg',array('alt'=>'print','title'=>'Print List','style'=>'width:60px; height:46px;')),'javascript:void(0);',array('escape'=>false,'onclick'=>'popup();'));?></td>
						<?php if(!empty($agent_id)) {?>
						<td style="text-align:left; width:100px;"><?php echo $html->link($html->image('admin/mail_send.png',array('alt'=>'print','title'=>'Email Send','style'=>'width:60px; height:46px;')),array('controller'=>'samples','action'=>'send_email_agent',$agent_id),array('escape'=>false));?></td>
						<?php }?>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<th width="5%"><h4>S.No.</h4></th>
			<th><h4>Patient Name</h4></th>
			<th><h4>Address</h4></th>
			<th><h4>City</h4></th>
			<th><h4>Contact</h4></th>
			<th style="text-align:center;"><h4>Collection Date</h4></th>
			<th style="text-align:center;"><h4>Assign Agent</h4></th>
			<th style="text-align:center;"><h4>Report Status</h4></th>
			<th style="text-align:center;"><h4>Collection</h4></th>
		</tr>	
	</thead>
	<?php
		if(isset($samplerequestlist) && count($samplerequestlist) > 0){
			$countRequest = count($samplerequestlist);
			for($ctr=0;$ctr<$countRequest;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
			
	?>
	
	<tr <?php echo $class;?>>
		
		<td <?php echo $class;?> style="text-align:center;">
			<?php										
				echo ($ctr+1);
			?>
		</td>
		
		<td <?php echo $class;?>><?php echo $html->link($samplerequestlist[$ctr]['Health']['name'],array('controller'=>'samples','action'=>'view_pat_details',base64_encode($samplerequestlist[$ctr]['Health']['id'])));?></td>
		<td <?php echo $class;?>><?php echo $samplerequestlist[$ctr]['Health']['address1'];?></td>
		<td <?php echo $class;?>><?php echo $samplerequestlist[$ctr]['Health']['city_name'];?></td>
		<td <?php echo $class;?>><?php echo $samplerequestlist[$ctr]['Health']['landline'];?></td>
		<td <?php echo $class;?> style="text-align:center;"><?php echo $samplerequestlist[$ctr]['Health']['sample_date1'];?></td>
		<?php if($samplerequestlist[$ctr]['Health']['agent_name'] != 'No') {?>
			<td <?php echo $class;?> id="assigning_col_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" style="text-align:center;">
				<?php echo $samplerequestlist[$ctr]['Health']['agent_name'];?>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="edit_agent('<?php echo $samplerequestlist[$ctr]['Health']['id'];?>');">Edit</a><br />
				<span style="padding:0px 0px 0px 39px; display:none;" id="assign_agent_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>"><?php echo $html->image('admin/p_rocess.gif',array('style'=>'height:10px;'));?></span>
			</td>
		<?php } else {?>
			<td <?php echo $class;?> id="assigning_col_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" style="text-align:center;">
				<select onchange="assign_agent(this.value,'<?php echo $samplerequestlist[$ctr]['Health']['id'];?>');" style="width:150px;">
					<option value="">Select Agent</option>
					<?php foreach($agent_list as $key => $val) {?>
					<option value="<?php echo $val['Agent']['id'];?>"><?php echo $val['Agent']['name'];?></option>
					<?php }?>
				</select><br />
				<span style="padding:0px 0px 0px 10px; display:none;" id="assign_agent_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>"><?php echo $html->image('admin/p_rocess.gif',array('style'=>'height:10px;'));?></span>
			</td>
		<?php }?>
		<?php if(empty($samplerequestlist[$ctr]['Health']['patient_report'])) {?>
			<td <?php echo $class;?> style="text-align:center;">Not Uploaded</td>
		<?php } if(!empty($samplerequestlist[$ctr]['Health']['patient_report'])) {?>
			<td <?php echo $class;?> style="text-align:center;">Uploaded</td>
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['print_status'] == 0) {?>
			<td <?php echo $class;?> style="text-align:center;">New</td>
		<?php } if($samplerequestlist[$ctr]['Health']['print_status'] == 1) {?>
			<td <?php echo $class;?> style="text-align:center;"><?php echo $html->link('In Process',array('controller'=>'samples','action'=>'request_status',base64_encode($samplerequestlist[$ctr]['Health']['id'])));?></td>
		<?php } if($samplerequestlist[$ctr]['Health']['print_status'] == 2) {?>
			<td <?php echo $class;?> style="text-align:center;">Done&nbsp;&nbsp;<?php echo $html->link('Edit',array('controller'=>'samples','action'=>'request_status',base64_encode($samplerequestlist[$ctr]['Health']['id'])));?></td>
		<?php }?>
	</tr>
	<?php }?>
	<!--<tr>
		<td align="left" class="borderBottom bgDarkHeader" colspan="6">
			<strong>Edit Test Status : </strong><?php //echo $form->select('Page.mode', unserialize(ARR_ACTIONS));?>&nbsp;<?php //echo $form->submit('Apply', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>-->
	<!--<tr>
		<td align="left" colspan="6">
		<?php
			//echo $this->element('pagination');
		?>
		</td>
	</tr>-->
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