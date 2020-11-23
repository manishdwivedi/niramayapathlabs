<script type="text/javascript">
function assign_lab(val,id)
	{
		jQuery.ajax({
			type:'GET',
			url:siteUrl+'admin/samples/assign_lab?lab='+val+'&id='+id,
			success:function(data){
				var datum=data.split(',');
				if(datum[0] == 'error_not_updated')
				{
					alert('Lab not assigned. Please assigned again.');
					window.location.href=siteUrl+'admin/samples/agent_view_list';
				}
				else
				{
					if(datum[0] == 'Home')
					{
						var rep_text = 'Home Collection    <a href="javascript:void(0);" onclick="edit_lab('+datum[1]+');">Edit</a>';
					}
					else
					{
						var rep_text = '';
						rep_text += datum[0]+'  <a href="javascript:void(0);" onclick="edit_lab('+datum[1]+');">Edit</a><br>';
						rep_text +='<img id="process_img'+datum[1]+'" alt="" style="display:none; height:10px;" src="<?php echo SITE_URL;?>img/admin/p_rocess.gif">';
					}
					jQuery("#assign_"+datum[1]).html(rep_text);
					jQuery('#process_img'+datum[1]).hide();
				}
			},
			beforeSend:function(){
				jQuery('#process_img'+id).show();
			},
			
		});
	}
	
function edit_lab(id)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/get_pcc',
		dataType:"json",
		success:function(data){
			if(data.pcc_info.success == 'success')
			{
				var rep_div = '';
				rep_div +='<select name="" onchange="assign_lab(this.value,'+id+');" style="width:120px; color:#666666;">';
				rep_div +='<option value="">Select PCC</option>';
				jQuery.each(data.pcc_info.pcc_list,function(index, value)
				{
					rep_div +='<option value="'+value.Lab.id+'">'+value.Lab.pcc_name+'</option>';
				});
				//rep_div +='<option value="Home">Home Collection</option>';
				rep_div +='</select>';
			
				rep_div +='<img id="process_img'+id+'" alt="" style="display:none; height:10px;" src="<?php echo SITE_URL;?>img/admin/p_rocess.gif">';
				jQuery('#assign_'+id).html(rep_div);
				jQuery('#process_img'+id).hide();
			}
			if(data.pcc_info.success == 'notsuccess')
			{
				var rep_div = 'No PCC Found';
				jQuery('#assign_'+id).html(rep_div);
				jQuery('#process_img'+id).hide();
			}
			
		},
		beforeSend:function(){
			jQuery('#process_img'+id).show();
		},
		
	});
}
</script>
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
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Booked Request(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Booked Request(s)
	
	<!-- 30-10-13 Starts -->
		<?php echo $form->create('Test', array('url'=>'/admin/samples/agent_view_list/first')); ?>
		<table border="0" width="100%">
			<tr>
				<td>
					<?php if(empty($data_req_from_date)) {?>
					<input type="text" name="data[Filter][req_from_date]" class="input-Search datepicker1" style="width:100px;" placeholder="From Date" />
					<?php } else {?>
					<input type="text" name="data[Filter][req_from_date]" class="input-Search datepicker1" style="width:100px;" placeholder="From Date" value="<?php echo $data_req_from_date;?>" />
					<?php }?>
				</td>
				<td>
					<?php if(empty($data_req_to_date)) {?>
					<input type="text" name="data[Filter][req_to_date]" class="input-Search datepicker1" style="width:100px;" placeholder="To Date" />
					<?php } else {?>
					<input type="text" name="data[Filter][req_to_date]" class="input-Search datepicker1" style="width:100px;" placeholder="To Date" value="<?php echo $data_req_to_date;?>" />
					<?php }?>
				</td>
				<td>
					<?php if(empty($data_req_city)) {?>
					<select name="data[Filter][req_city]" class="input-Search">
						<option value="">Select City</option>
						<?php foreach($city as $key => $val) {?>
						<option value="<?php echo $val['City']['id'];?>"><?php echo $val['City']['name'];?></option>
						<?php }?>
					</select>
					<?php } else {?>
					<select name="data[Filter][req_city]" class="input-Search">
						<option value="">Select City</option>
						<?php foreach($city as $key => $val) {?>
						<option value="<?php echo $val['City']['id'];?>" <?php if($data_req_city == $val['City']['id']) {?> selected="selected" <?php }?>><?php echo $val['City']['name'];?></option>
						<?php }?>
					</select>
					<?php }?>
				</td>
				<td>
					<?php if(empty($data_req_lab)) {?>
					<select name="data[Filter][req_lab]" class="input-Search">
						<option value="">Select PCC</option>
						<?php foreach($pcc as $key => $val) {?>
						<option value="<?php echo $val['Lab']['id'];?>"><?php echo $val['Lab']['pcc_name'];?></option>
						<?php }?>
						<option value="Home">Home Collection</option>
					</select>
					<?php } else {?>
					<select name="data[Filter][req_lab]" class="input-Search">
						<option value="">Select PCC</option>
						<?php foreach($pcc as $key => $val) {?>
						<option value="<?php echo $val['Lab']['id'];?>" <?php if($data_req_lab == $val['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $val['Lab']['pcc_name'];?></option>
						<?php }?>
						<option value="Home" <?php if($data_req_lab == 'Home') {?> selected="selected" <?php }?>>Home Collection</option>
					</select>
					<?php }?>
				</td>
				<td>
					<?php if(empty($data_req_agent)) {?>
					<select name="data[Filter][req_agent]" class="input-Search">
						<option value="">Select Agent</option>
						<?php foreach($agent_list as $key => $val) {?>
						<option value="<?php echo $val['Agent']['id'];?>"><?php echo $val['Agent']['name'];?></option>
						<?php }?>
					</select>
					<?php } else {?>
					<select name="data[Filter][req_agent]" class="input-Search">
						<option value="">Select Agent</option>
						<?php foreach($agent_list as $key => $val) {?>
						<option value="<?php echo $val['Agent']['id'];?>" <?php if($data_req_agent == $val['Agent']['id']) {?> selected="selected" <?php }?>><?php echo $val['Agent']['name'];?></option>
						<?php }?>
					</select>
					<?php }?>
				</td>
				<td>
					<?php if(empty($data_req_report)) {?>
					<select name="data[Filter][req_report]" class="input-Search" style="width:100px;">
						<option value="">Select Report Status</option>
						<option value="1">Uploaded</option>
						<option value="0">Not Uploaded</option>
						<option value="2">Partial Uploaded</option>
					</select>
					<?php } else {?>
					<select name="data[Filter][req_report]" class="input-Search" style="width:100px;">
						<option value="">Select Report Status</option>
						<option value="1" <?php if($data_req_report == 1) {?> selected="selected" <?php }?>>Uploaded</option>
						<option value="0" <?php if($data_req_report == 0) {?> selected="selected" <?php }?>>Not Uploaded</option>
						<option value="2" <?php if($data_req_report == 2) {?> selected="selected" <?php }?>>Partial Uploaded</option>
					</select>
					<?php }?>
				</td>
				<td>
					<?php if(empty($data_req_request)) {?>
					<select name="data[Filter][req_status]" class="input-Search" style="width:100px;">
						<option value="">Select Request Status</option>
						<option value="4">Sample Process</option>
						<option value="5">Sent to Lab</option>
						<option value="0">Pending</option>
						<!-- Code Edit By Ashish 05-06-14 Starts -->
						<option value="8">Cancelled</option>
						<!-- Code Edit By Ashish 05-06-14 Ends -->
						<option value="6">Report</option>
						<option value="9">closed</option>
					</select>
					<?php } else {?>
					<select name="data[Filter][req_status]" class="input-Search" style="width:100px;">
						<option value="">Select Request Status</option>
						<option value="4" <?php if($data_req_request == 4) {?> selected="selected" <?php }?>>Sample Process</option>
						<option value="5" <?php if($data_req_request == 5) {?> selected="selected" <?php }?>>Sent to Lab</option>
						<option value="0" <?php if($data_req_request == 0) {?> selected="selected" <?php }?>>Pending</option>
						<!-- Code Edit By Ashish 05-06-14 Starts -->
						<option value="8" <?php if($data_req_request == 8) {?> selected="selected" <?php }?>>Cancelled</option>
						<!-- Code Edit By Ashish 05-06-14 Ends -->
						<option value="6" <?php if($data_req_request == 6) {?> selected="selected" <?php }?>>Report</option>
						<option value="9" <?php if($data_req_request == 9) {?> selected="selected" <?php }?>>closed</option>
					</select>
					<?php }?>
				</td>
				<td>
					<?php if(!empty($data_req_pay_status)) {?>
					<select name="data[Filter][pay_status]" class="input-Search" style="width:100px;">
						<option value="">Select option</option>
						<option value="not_paid" <?php if($data_req_pay_status == 'not_paid') {?> selected="selected" <?php }?>>Not Paid</option>
						<option value="partial_paid" <?php if($data_req_pay_status == 'partial_paid') {?> selected="selected" <?php }?>>Partially Paid</option>
					</select>
					<?php } else {?>
					<select name="data[Filter][pay_status]" class="input-Search" style="width:100px;">
						<option value="">Select option</option>
						<option value="not_paid">Not Paid</option>
						<option value="partial_paid">Partially Paid</option>
					</select>
					<?php }?>
				</td>
				<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
			</tr>
		</table>
		
		<?php echo $form->end(); ?>
		<?php echo $form->create('Test', array('url'=>'/admin/samples/agent_view_list/second')); ?>
		<table border="0" width="100%">
			<tr>
				<td style="font-weight:bold; text-align:center;" colspan="8">OR</td>
			</tr>
			<tr>
				<td style="width:100px;">
					<?php if(empty($req_number)) {?>
					<input type="text" name="data[Filter][req_num]" class="input-Search" placeholder="Request Number" />
					<?php } else {?>
					<input type="text" name="data[Filter][req_num]" class="input-Search" placeholder="Request Number" value="<?php echo $req_number;?>" />
					<?php }?>
				</td>
				<td style="width:100px;">
					<?php if(empty($data_req_name)) {?>
					<input type="text" name="data[Filter][req_name]" class="input-Search" placeholder="Enter Name" />
					<?php } else {?>
					<input type="text" name="data[Filter][req_name]" class="input-Search" placeholder="Enter Name" value="<?php echo $data_req_name;?>" />
					<?php }?>
				</td>
				<td style="width:100px;">
					<?php if(empty($data_req_phone)) {?>
					<input type="text" name="data[Filter][req_phone]" class="input-Search" placeholder="Enter Phone" />
					<?php } else {?>
					<input type="text" name="data[Filter][req_phone]" class="input-Search" placeholder="Enter Phone" value="<?php echo $data_req_phone;?>" />
					<?php }?>
				</td>
				
				<td style="width:100px;">
					<?php if(empty($data_req_regis)) {?>
					<input type="text" name="data[Filter][ref_num]" class="input-Search" placeholder="Lab Test Reg.NO" />
					<?php } else {?>
					<input type="text" name="data[Filter][ref_num]" class="input-Search" placeholder="Lab Test Reg.NO" value="<?php echo $data_req_regis;?>" />
					<?php }?>
				</td>
				
				
				<td><?php echo $form->submit('Search', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
			</tr>
			<?php if(count($samplerequestlist) > 0) {?>
			<tr>
				<td colspan="13" style="text-align:right; font-weight:bold;">
				<?php
					echo $this->element('pagination');
				?>
				</td>
			</tr>
			<?php }?>
		</table>
		<?php echo $form->end(); ?>
		<!-- 30-10-13 Ends -->
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		
	<thead>
		<!--<tr>
			<td colspan="12"><strong>Search By Order No.:</strong> <?php //echo $form->text('Search.order',array('class'=>'input-text','style'=>'width:100px;'));?>&nbsp;&nbsp;<strong>Search By Name:</strong> <?php //echo $form->text('Search.name',array('class'=>'input-text','style'=>'width:200px;'));?>&nbsp;&nbsp;<?php //echo $form->submit('Search', array('div'=>false, 'class' => 'btn')); ?></td>
		</tr>-->
		<tr>
			
			<th width="5%"><h4>S.No.</h4></th>
			<th style="text-align:center; width:100px;"><h4>Test Req.No</h4></th>
			
			<th><h4><?php echo $paginator->sort('Name', 'Health.name', array('class'=>'pagination')); ?></h4></th>
			<!--<th><h4><?php //echo $paginator->sort('Email', 'Health.email', array('class'=>'pagination')); ?></h4></th>
			<th><h4><?php //echo $paginator->sort('Contact', 'Health.landline', array('class'=>'pagination')); ?></h4></th>-->
			<th><h4>City</h4></th>
			<th><h4><?php echo $paginator->sort('Locality', 'Health.city', array('class'=>'pagination')); ?></h4></th>
			<th style="text-align:center;"><h4>Date</h4></th>
			<th style="text-align:center;"><h4>Time</h4></th>
			<th style="text-align:center; width:200px;"><h4>Lab Assigned</h4></th>
			<th style="text-align:center; width:200px;"><h4>Report Status</h4></th>
			<th style="text-align:center; width:200px;"><h4>Test Amount</h4></th>
			<th style="text-align:center; width:200px;"><h4>Amount Received</h4></th>
			<th style="text-align:center;"><h4>Request Status</h4></th>
		<th style="text-align:center; width:100px;"><h4>Lab Test Reg.NO</h4></th>
			
			
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
	<!-- Code Edited By Ashish Starts-->
	<?php if($samplerequestlist[$ctr]['Health']['cancelled_status'] == 1) {?>
	<tr style="background-color:#FF4FE2;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
	<?php } else {?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 4) {?>
		<tr style="background-color:#edf572;">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 5) {?>
		<tr style="background-color:#3bf2f4;">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 6) {?>
		<tr style="background-color:#55fa35;">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 7) {?>
		<tr style="background-color:#ffff59;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 9) {?>
		<tr style="background-color:#FF0080;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] != 4 && $samplerequestlist[$ctr]['Health']['requ_status'] != 5 && $samplerequestlist[$ctr]['Health']['requ_status'] != 6 && $samplerequestlist[$ctr]['Health']['requ_status'] != 7 && $samplerequestlist[$ctr]['Health']['requ_status'] != 9) {?>
		<tr style="background-color:#ffabf4;">
		<?php }?>
	<?php }?>
	<!-- Code Edited By Ashish Ends-->	
		<td style="text-align:center; border-bottom:1px solid #666666;">
			<?php										
				echo ($ctr+1);
			?>
		</td>
		
	<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo $samplerequestlist[$ctr]['Health']['order_num'];?></td>
		<td style="border-bottom:1px solid #666666;"><?php echo $samplerequestlist[$ctr]['Health']['name'];?>
		<?php echo $samplerequestlist[$ctr]['Health']['landline'];?>
		
		</td>
		<!--<td <?php //echo $class;?>><a href="mailto:<?php //echo $samplerequestlist[$ctr]['Health']['email'];?>"><?php //echo $samplerequestlist[$ctr]['Health']['email'];?></a></td>
		<td><?php //echo $samplerequestlist[$ctr]['Health']['landline'];?></td>-->
		<td style="border-bottom:1px solid #666666;"><?php echo $samplerequestlist[$ctr]['Health']['city_name'];?></td>
		<td style="border-bottom:1px solid #666666;"><?php echo $samplerequestlist[$ctr]['Health']['locality'];?></td>
		<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo date('d-m-Y',strtotime($samplerequestlist[$ctr]['Health']['sample_req_date']));?></td>
		<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo $samplerequestlist[$ctr]['Health']['time_slot'];?></td>
		<td id="assign_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" style="text-align:center; width:200px; border-bottom:1px solid #666666;">
			<?php if(!empty($samplerequestlist[$ctr]['Health']['assigned_lab'])) {?>
				
				<?php if($samplerequestlist[$ctr]['Health']['assigned_lab'] == 'Home') {?>
					<select name="data[Health][home_request]" style="width:120px; color:#666666;" onchange="assign_lab(this.value,'<?php echo $samplerequestlist[$ctr]['Health']['id'];?>');">
						<option>Select PCC</option>
						<?php foreach($pcc_list as $key=>$val) {?>
						<option value="<?php echo $val['Lab']['id']?>"><?php echo $val['Lab']['pcc_name'];?></option>
						<?php }?>
					</select>
					<?php echo $html->image('admin/p_rocess.gif',array('id'=>'process_img'.$samplerequestlist[$ctr]['Health']['id'],'style'=>'display:none; height:10px;'));?>
				<?php } else {?>
					<?php echo $samplerequestlist[$ctr]['Health']['lab_name'];?>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="edit_lab('<?php echo $samplerequestlist[$ctr]['Health']['id'];?>');">Edit</a>
				<?php }?>
				
			<?php } else {?>
				<select name="" onchange="assign_lab(this.value,'<?php echo $samplerequestlist[$ctr]['Health']['id'];?>');" style="width:150px;">
					<option value="">Select PCC</option>
					<?php foreach($pcc as $key=>$val) {?>
					<option value="<?php echo $val['Lab']['id'];?>"><?php echo $val['Lab']['pcc_name'];?></option>
					<?php }?>
					
				</select>
			<?php }?>
			
			<?php echo $html->image('admin/p_rocess.gif',array('id'=>'process_img'.$samplerequestlist[$ctr]['Health']['id'],'style'=>'display:none; height:10px;'));?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #666666;">
			<?php if($samplerequestlist[$ctr]['Health']['patient_report'] == '') {?>
			<?php echo "Not Uploaded";?>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['patient_report'] != '') {?>
			<?php echo "Uploaded";?>
			<?php }?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo 'Rs. '.$samplerequestlist[$ctr]['Health']['bill_amount'];?></td>
		<?php 
		$amt_rec = ($samplerequestlist[$ctr]['Health']['received_amount']+$samplerequestlist[$ctr]['Health']['balance_refund']);
		?>
		<td style="text-align:center; border-bottom:1px solid #666666;">
			<?php if($samplerequestlist[$ctr]['Health']['pay_status'] == 0) {?>
			<!--<a href="javascript:void(0);" onclick="show_payment_div('<?php //echo $samplerequestlist[$ctr]['Health']['id'];?>');">--><?php echo 'Rs. '.$amt_rec;?><!--</a>-->
			<?php //echo $html->image('admin/p_rocess.gif',array('id'=>'pay_process_img'.$samplerequestlist[$ctr]['Health']['id'],'style'=>'display:none; height:10px;'));?>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['pay_status'] == 1) {?>
			<!--<a href="javascript:void(0);" onclick="show_payment_div('<?php //echo $samplerequestlist[$ctr]['Health']['id'];?>');">--><?php echo 'Rs. '.$amt_rec;?><!--</a>-->
			<?php //echo $html->image('admin/p_rocess.gif',array('id'=>'pay_process_img'.$samplerequestlist[$ctr]['Health']['id'],'style'=>'display:none; height:10px;'));?>
			<?php }?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #666666;">
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 4) {?>
			<a href="<?php echo SITE_URL;?>admin/samples/view_detail_agent/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Sample Collected</a>
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 5) {?>
			<a href="<?php echo SITE_URL;?>admin/samples/view_detail_agent/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Sent to Lab</a>
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 6) {?>
			<a href="<?php echo SITE_URL;?>admin/samples/view_detail_agent/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Report</a>
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
			
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 9) {?>
			<a href="<?php echo SITE_URL;?>admin/samples/view_detail_agent/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Closed</a>
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
			
			
			
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 7) {?>
			<a href="<?php echo SITE_URL;?>admin/samples/view_detail_agent/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Partial Report</a>
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
			<!-- Code Edited By Ashish Starts-->
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 8) {?>
			<a href="<?php echo SITE_URL;?>admin/samples/view_detail_agent/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Test Cancelled</a>
			<?php }?>
			<!-- Code Edited By Ashish Ends-->
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] != 4 && $samplerequestlist[$ctr]['Health']['requ_status'] != 5 && $samplerequestlist[$ctr]['Health']['requ_status'] != 6 && $samplerequestlist[$ctr]['Health']['requ_status'] != 7 && $samplerequestlist[$ctr]['Health']['requ_status'] != 8 && $samplerequestlist[$ctr]['Health']['requ_status'] != 9) {?>
			<a href="<?php echo SITE_URL;?>admin/samples/view_detail_agent/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Pending</a>
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo $samplerequestlist[$ctr]['Health']['ref_num'];?></td>
		
		
	</tr>
	<?php }?>
	<!--<tr>
		<td align="left" class="borderBottom bgDarkHeader" colspan="6">
			<strong>Edit Test Status : </strong><?php //echo $form->select('Page.mode', unserialize(ARR_ACTIONS));?>&nbsp;<?php //echo $form->submit('Apply', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>-->
	<tr>
		<td colspan="13" style="text-align:right; font-weight:bold;">
		<?php
			echo $this->element('pagination');
		?>
		</td>
	</tr>
	<?php
		} else {
	?>
	<tr>
		<td colspan="12" class="flash_failure" style=" float:none;">No records found.</td>
	</tr>
	<?php
		}
	?>
	
</table>

</div>