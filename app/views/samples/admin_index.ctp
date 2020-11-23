<script type="text/javascript">
	function assign_lab(val,id) 
	{
		jQuery.ajax({
			type:'GET',
			url:siteUrl+'admin/samples/assign_lab?lab='+val+'&id='+id,
			success:function(data){
				console.log(data);
				var datum=data.split(',');
				if(datum[0] == 'error_not_updated')
				{
					alert('Lab not assigned. Please assigned again.');
					//jQuery('#process_img'+datum[1]).hide();
					window.location.href=siteUrl+'admin/samples';
				}
				else
				{
					if(datum[0] == 'Home')
					{
						var rep_text = 'Home Collection    <a href="javascript:void(0);" onclick="edit_lab('+datum[1]+');">Edit</a>';
					}
					else
					{
						var rep_text = datum[0]+'  <a href="javascript:void(0);" onclick="edit_lab('+datum[1]+');">Edit</a>';
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
	
function show_payment_div(id)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/pay_status_show?id='+id,
		success:function(data){
			var datum=data.split(',');
			var total_amt = 'Rs. '+datum[0];
			var receive_amt =  'Rs. '+datum[1];
			var balance_amt =  'Rs. '+datum[2];
			var refund_amt = 'Rs. '+datum[4];
			var anchor_link = '<a href="'+siteUrl+'admin/samples/view_detail/'+datum[3]+'">View Details</a>';
			$('#tAmtDiv').html(total_amt);
			$('#rAmtDiv').html(receive_amt);
			$('#bAmtDiv').html(balance_amt);
			$('#reAmtDiv').html(refund_amt);
			$('#anchorLink').html(anchor_link);
			$('#StatusAmtDiv').show();
			$('#pay_process_img'+id).hide();
		},
		beforeSend:function(){
			jQuery('#pay_process_img'+id).show();
		},
		
	});
}

function close_div()
{
	$('#StatusAmtDiv').hide();
}
	
function edit_lab(id)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/get_pcc?id='+id,
		dataType:"json",
		success:function(data){
			if(data.pcc_info.success == 'success')
			{
				var rep_div = '';
				rep_div +='<select name="" onchange="assign_lab(this.value,'+id+');" style="width:150px; color:#666666;">';
				rep_div +='<option value="">Assign Lab</option>';
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
function assign_agent(val,id)
{
	jQuery.ajax({
			type:'GET',
			url:siteUrl+'admin/samples/assign_agent?agent_id='+val+'&id='+id,
			
			success:function(data){
				console.log(data);
				var datum=data.split(',');
				var rep_text = '';
				if(datum[0] == 'error_not_updated')
				{
					alert('Lab not assigned. Please assigned again.');
					window.location.href=siteUrl+'admin/samples/home';
				}
				else
				{
					rep_text += datum[0]+'&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="edit_agent('+datum[1]+');">Edit</a>';
					rep_text +="<br />";
					rep_text +="<span style='padding:0px 0px 0px 10px; display:none;' id='assign_agent_"+datum[1]+"'><img src='"+siteUrl+"img/admin/p_rocess.gif' style='height:10px;'></span>";
					
					var assign_agnt = '';
					assign_agnt += '<a href="javascript:void(0);" onclick="confirm_agent_s('+id+');">Confirm</a>';
					assign_agnt += '<br /><span style="padding:0px 0px 0px 10px; display:none;" id="confirm_agent_s_'+id+'"><?php echo $html->image('admin/p_rocess.gif',array('style'=>'height:10px;'));?></span>';
					if(datum[2]!= 14 && datum[2]!= 11 && datum[2]!= 12 && datum[2]!= 5 && datum[2]!= 8 && datum[2]!= 7 && datum[2]!= 6 && datum[2]!= 9)
					{
						$("#RequestId_"+datum[1]).css("background-color", "#feffab");
						$("#orderstatus_"+datum[1]).html("Phlebo Assigned");
					}
				}
				
				jQuery("#assigning_col_"+datum[1]).html(rep_text);
				jQuery('#AgentAssigned_'+id).html(assign_agnt);
				jQuery('#assign_agent_'+id).hide();
			},
			beforeSend:function(){
				jQuery('#assign_agent_'+id).show();
			},
			
		});
}

function edit_agent(id)
{
	jQuery.ajax({
			type:'GET',
			url:siteUrl+'admin/samples/agent_list?id='+id,
			dataType:'json',
			success:function(data){
				if(data.agent_info.success == 'success')
				{
					var rep_text = "";
					if(data.agent_info.agent_list.length != 0)
					{
						rep_text +='<select onchange="assign_agent(this.value,'+data.agent_info.row_id+');" style="width:150px; color:#666666;">';
						rep_text +="<option value=''>Select Agent</option>";
						jQuery.each(data.agent_info.agent_list,function(index, value)
						{
							rep_text +='<option value="'+value.Agent.id+'">'+value.Agent.name+'</option>';
						});
						rep_text +='</select>';
						rep_text +="<br />";
						rep_text +="<span style='padding:0px 0px 0px 10px; display:none;' id='assign_agent_"+data.agent_info.row_id+"'><img src='"+siteUrl+"img/admin/p_rocess.gif' style='height:10px;'></span>";
					}
					else
					{
						var rep_text = '<a href="'+siteUrl+'admin/samples/add_agent">Please add agent</a>';
					}
				}
				jQuery("#assigning_col_"+data.agent_info.row_id).html(rep_text);
				jQuery('#assign_agent_'+id).hide();
			},
			beforeSend:function(){
				jQuery('#assign_agent_'+id).show();
			},
			
		});
}

function close_popup()
{
	var span = document.getElementsByClassName("close")[0];
	var modal = document.getElementById("myModal");
	span.onclick = function() {
	  modal.style.display = "none";
	}
}

function savephlebodetail()
{
	var name = $('#phleboname').val();
	var contact = $('#phlebocontact').val();
	var id = $('#phlebohealthid').val();
	var data = {
		name : name,
		contact : contact,
		id : id
	};
	if(contact=="" || name=="")
	{
		$('#phleboerror').html("Name And Contact can't be Empty");
	}
	else
	{
		$('#phleboerror').html("");
		jQuery.ajax({
			type:'POST',
			data : data,
			url:siteUrl+'admin/samples/savephlebodetail',
			success:function(data){
				var phlebo = data.split("@@@");
				var html = "Name : "+phlebo[1]+" <br> Contact : "+phlebo[2]+" <br> Tracking : - <br>";
				$('#ConfirmAgent_'+id).html(html);
				$('#AgentAssigned_'+id).html(html);
				var modal = document.getElementById("myModal");
				modal.style.display = "none";
				console.log(data);
			}
		});
	}
}

function confirm_agent(id)
{
	var modal = document.getElementById("myModal");
	modal.style.display = "block";
	
	$('#phlebohealthid').val(id);
	
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/get_agent_detail?id='+id,
		success:function(data){
			console.log(data);
			var phlebo = data.split("@@@");
			$("#phleboname").val(phlebo[0]);
			$("#phlebocontact").val(phlebo[1]);
			$('#confirm_agent_'+id).hide();
		},
		beforeSend:function(){
			jQuery('#confirm_agent_'+id).show();
		},
	});
}

function confirm_agent_s(id)
{
	var modal = document.getElementById("myModal");
	modal.style.display = "block";
	
	$('#phlebohealthid').val(id);
	
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/get_agent_detail?id='+id,
		success:function(data){
			console.log(data);
			var phlebo = data.split("@@@");
			$("#phleboname").val(phlebo[0]);
			$("#phlebocontact").val(phlebo[1]);
			$('#confirm_agent_'+id).hide();
		},
		beforeSend:function(){
			jQuery('#confirm_agent_'+id).show();
		},
	});
	/*jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/confirm_agent?id='+id,
		dataType:'json',
		success:function(data){
			if(data.agent_info.success == 'success')
			{
				var rep_div = '';
				rep_div +='Confirmed';
				$('#AgentAssigned_'+id).html(rep_div);
				$('#confirm_agent_s_'+id).hide();
			}
		},
		beforeSend:function(){
			jQuery('#confirm_agent_s_'+id).show();
		},
	});*/
}

function delete_row(val)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/delete_row?id='+val,
		dataType:'json',
		success:function(data){
			if(data.req_info.success == 'success')
			{
				$('#RequestId_'+val).hide();
			}
		},
		beforeSend:function(){
			jQuery('#ReqId_'+val).show();
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

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modal) {
		modal.style.display = "none";
	  }
	}
	
});
function confirm_call(ele_id,ele_val)
{
    $.ajax({
            type: "GET",
            url: siteUrl+"samples/confirm_call_status/"+ele_id+"/"+ele_val,
            dataType: 'json',
            error: function() {
                //alert('Unable to process request.');
            },
            success: function(Jdata){
                if(Jdata.status == "success")
                {
                    $('#' + ele_id).html('<img title="" alt="" src="/img/'+Jdata.img+'">');
                    $('#' + ele_id).attr('lang',Jdata.value);
                }
            }
        });
}

</script>
<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>
<div style="width:400px; height:200px; border-radius:10px; border:1px solid #000; background-color:#FFFFFF; position:absolute; top:234px; left:565px; display:none;" id="StatusAmtDiv">
	<div style="float:left; margin:4px 0px 0px -11px; font-weight:bold; width:100%; text-align:right;" id="close_div"><a href="javascript:void(0);" onclick="close_div();" style="color:#000000;">[Close]</a></div>
	<div style="float:left; padding:10px; font-weight:bold; width:100%; text-align:center;">Payment Status</div>
	<div style="clear:both;">
		<div style="float:left; width:145px; font-weight:bold; padding:5px;">Total Amount</div>
		<div style="float:left; padding:5px;" id="tAmtDiv"></div>
	</div>
	<div style="clear:both;">
		<div style="float:left; width:145px; font-weight:bold; padding:5px;">Received Amount</div>
		<div style="float:left; padding:5px;" id="rAmtDiv"></div>
	</div>
	<div style="clear:both;">
		<div style="float:left; width:145px; font-weight:bold; padding:5px;">Balance Amount</div>
		<div style="float:left; padding:5px;" id="bAmtDiv"></div>
	</div>
	<div style="clear:both;">
		<div style="float:left; width:145px; font-weight:bold; padding:5px;">Refund Amount</div>
		<div style="float:left; padding:5px;" id="reAmtDiv"></div>
	</div>
	<div style="clear:both;">
		<div style="float:left; padding:10px 0 0 0; width:100%; text-align:center;" id="anchorLink"></div>
	</div>
</div>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Manage Sample Request(s)</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Manage Sample Request(s)
	<div>&nbsp;</div>
	<?php echo $form->create('Test', array('url'=>'/admin/samples/index/first')); ?>
	<!-- 30-10-13 Starts -->
		<table border="0" width="90%">
			<tr>
				<td>
					<?php if(empty($data_req_from_date)) {?>
					<input autocomplete="off" type="text" name="data[Filter][req_from_date]" class="input-Search datepicker1" style="width:100px;" placeholder="From Date" />
					<?php } else {?>
					<input autocomplete="off" type="text" name="data[Filter][req_from_date]" class="input-Search datepicker1" style="width:100px;" placeholder="From Date" value="<?php echo $data_req_from_date;?>" />
					<?php }?>
				</td>
				<td>
					<?php if(empty($data_req_to_date)) {?>
					<input autocomplete="off" type="text" name="data[Filter][req_to_date]" class="input-Search datepicker1" style="width:100px;" placeholder="To Date" />
					<?php } else {?>
					<input autocomplete="off" type="text" name="data[Filter][req_to_date]" class="input-Search datepicker1" style="width:100px;" placeholder="To Date" value="<?php echo $data_req_to_date;?>" />
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
				<?php if(!isset($pccLab)) {?>
					<td>
						<?php if(empty($data_req_lab1)) {?>
						<select name="data[Filter][req_lab1]" class="input-Search">
							<option value="">Select Booked By PCC</option>
							<?php foreach($pcc as $key => $val) {?>
							<option value="<?php echo $val['Lab']['id'];?>"><?php echo $val['Lab']['pcc_name'];?></option>
							<?php }?>
							<option value="Home">Home Collection</option>
						</select>
						<?php } else {?>
						<select name="data[Filter][req_lab1]" class="input-Search">
							<option value="">Select Booked By PCC</option>
							<?php foreach($pcc as $key => $val) {?>
							<option value="<?php echo $val['Lab']['id'];?>" <?php if($data_req_lab1 == $val['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $val['Lab']['pcc_name'];?></option>
							<?php }?>
							<option value="Home" <?php if($data_req_lab1 == 'Home') {?> selected="selected" <?php }?>>Home Collection</option>
						</select>
						<?php }?>
	                                </td>
	                                <td>
	                                        <?php if(empty($data_req_lab)) {?>
						<select name="data[Filter][req_lab]" class="input-Search">
							<option value="">Select Service By PCC</option>
							<?php foreach($pcc as $key => $val) {?>
							<option value="<?php echo $val['Lab']['id'];?>"><?php echo $val['Lab']['pcc_name'];?></option>
							<?php }?>
							<option value="Home">Home Collection</option>
						</select>
						<?php } else {?>
						<select name="data[Filter][req_lab]" class="input-Search">
							<option value="">Select Service By PCC</option>
							<?php foreach($pcc as $key => $val) {?>
							<option value="<?php echo $val['Lab']['id'];?>" <?php if($data_req_lab == $val['Lab']['id']) {?> selected="selected" <?php }?>><?php echo $val['Lab']['pcc_name'];?></option>
							<?php }?>
							<option value="Home" <?php if($data_req_lab == 'Home') {?> selected="selected" <?php }?>>Home Collection</option>
						</select>
						<?php }?>
					</td>
			</tr>
            <tr>
            <?php } ?>
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
						<option value="0">New booking</option>
						<option value="15">API New Booking</option>
						<option value="18">Booking Confirmed</option>
						<option value="1">Slot Not Available</option>
						<option value="2">Slot Blocked</option>
						<option value="4">Phlebo Assigned</option>
						<option value="19">Phlebo Confirmed</option>
						<option value="20">Phlebo Tracking</option>
						<option value="16">Specimen Drawn</option>
						<option value="21">Specimen On Hold</option>
						<option value="3">Follow Up</option>
						<option value="13">Rescheduled</option>
						<option value="10">Sample Collected</option>
						<option value="14">Reg. in LIS</option>
						<option value="11">Sample Rejected</option>
						<option value="12">Partial Sent To Lab</option>
						<option value="5">Sent to Lab</option>
						<!-- Code Edit By Ashish 05-06-14 Starts -->
						<option value="8">Cancelled</option>
						<option value="23">Rejection Requested</option>
						<option value="22">Cxl Req by Phlebo</option>
						<option value="7">Partial Report</option>
						<option value="6">Report</option>
						<option value="17">Partial Closed</option>
						<option value="9">closed</option>
						
						<!-- Code Edit By Ashish 05-06-14 Ends -->
					</select>
					<?php } else {?>
					<select name="data[Filter][req_status]" class="input-Search" style="width:100px;">
						<option value="">Select Request Status</option>
						<option value="0" <?php if($data_req_request == 0) {?> selected="selected" <?php }?>>New booking</option>
						<option value="15" <?php if($data_req_request == 15) {?> selected="selected" <?php }?>>API New Booking</option>
						<option value="18" <?php if($data_req_request == 18) {?> selected="selected" <?php }?>>Booking Confirmed</option>
						<option value="1" <?php if($data_req_request == 1) {?> selected="selected" <?php }?>>Slot Not Available</option>
						<option value="2" <?php if($data_req_request == 2) {?> selected="selected" <?php }?>>Slot Blocked</option>
						<option value="4" <?php if($data_req_request == 4) {?> selected="selected" <?php }?>>Phlebo Assigned</option>
						<option value="19" <?php if($data_req_request == 19) {?> selected="selected" <?php }?>>Phlebo Confirmed</option>
						<option value="20" <?php if($data_req_request == 20) {?> selected="selected" <?php }?>>Phlebo Tracking</option>
						<option value="16" <?php if($data_req_request == 16) {?> selected="selected" <?php }?>>Specimen Drawn</option>
						<option value="21" <?php if($data_req_request == 21) {?> selected="selected" <?php }?>>Specimen On Hold</option>
						<option value="3" <?php if($data_req_request == 3) {?> selected="selected" <?php }?>>Follow Up</option>
						<option value="13" <?php if($data_req_request == 13) {?> selected="selected" <?php }?>>Rescheduled</option>
						<option value="10" <?php if($data_req_request == 10) {?> selected="selected" <?php }?>>Sample Collected</option>
						<option value="14" <?php if($data_req_request == 14) {?> selected="selected" <?php }?>>Reg. in LIS</option>
						<option value="11" <?php if($data_req_request == 11) {?> selected="selected" <?php }?>>Sample Rejected</option>
						<option value="12" <?php if($data_req_request == 12) {?> selected="selected" <?php }?>>Partial Sent To Lab</option>
						<option value="5" <?php if($data_req_request == 5) {?> selected="selected" <?php }?>>Sent to Lab</option>
						
						<!-- Code Edit By Ashish 05-06-14 Starts -->
						<option value="23" <?php if($data_req_request == 23) {?> selected="selected" <?php }?>>Rejection Requested</option>						
						<option value="22" <?php if($data_req_request == 22) {?> selected="selected" <?php }?>>Cxl Req by Phlebo</option>
						<option value="8" <?php if($data_req_request == 8) {?> selected="selected" <?php }?>>Cancelled</option>
						<!-- Code Edit By Ashish 05-06-14 Ends -->
						<option value="7" <?php if($data_req_request == 7) {?> selected="selected" <?php }?>>Partial Report</option>
						<option value="6" <?php if($data_req_request == 6) {?> selected="selected" <?php }?>>Report</option>
						<option value="17" <?php if($data_req_request == 17) {?> selected="selected" <?php }?>>Partial Closed</option>
						<option value="9" <?php if($data_req_request == 9) {?> selected="selected" <?php }?>>Closed</option>
						
						
					</select>
					<?php }?>
				</td>
				<td>
					<?php if(!empty($data_req_pay_status)) {?>
					<select name="data[Filter][pay_status]" class="input-Search" style="width:100px;">
						<option value="">All (Paid)</option>
						<option value="balance_due" <?php if($data_req_pay_status == 'balance_due') {?> selected="selected" <?php }?>>Balance Due</option>
						<option value="fully_paid" <?php if($data_req_pay_status == 'fully_paid') {?> selected="selected" <?php }?>>Fully Paid</option>
					</select>
					<?php } else {?>
					<select name="data[Filter][pay_status]" class="input-Search" style="width:100px;">
						<option value="">All (Paid)</option>
						<option value="balance_due">Balance Due</option>
						<option value="partial_paid">Fully Paid</option>
					</select>
					<?php }?>
				</td>
				<td>
					<?php if(!empty($data_req_source)) {?>
					<select name="data[Filter][source]" class="input-Search" style="width:100px;">
						<option value="">All (Source)</option>
						<option value="lis_sync" <?php if($data_req_source == 'lis_sync') {?> selected="selected" <?php }?>>LIS Sync</option>
						<option value="without_lis" <?php if($data_req_source == 'without_lis') {?> selected="selected" <?php }?>>W/O LIS Sync</option>
						
					</select>
					<?php } else {?>
					<select name="data[Filter][source]" class="input-Search" style="width:100px;">
						<option value="">All (Source)</option>
						<option value="lis_sync">LIS Sync</option>
						<option value="without_lis">W/O LIS Sync</option>
					</select>
					<?php }?>
				</td>
				<td><?php echo $form->submit('Filter', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
			</tr>
			
		</table>
		
		<?php echo $form->end(); ?>
		<?php echo $form->create('Test', array('url'=>'/admin/samples/index/second')); ?>
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
				
				<td style="width:100px;">
					<?php if(empty($reference)) {?>
					<input type="text" name="data[Filter][reference]" class="input-Search" placeholder="Reference No." />
					<?php } else {?>
					<input type="text" name="data[Filter][reference]" class="input-Search" placeholder="Reference No." value="<?php echo $reference;?>" />
					<?php }?>
				</td>
				
				<td style="width:100px;">
					<?php if(empty($mrn)) {?>
					<input type="text" name="data[Filter][mrn]" class="input-Search" placeholder="Enter MRN number" />
					<?php } else {?>
					<input type="text" name="data[Filter][mrn]" class="input-Search" placeholder="Enter MRN number" value="<?php echo $mrn;?>" />
					<?php }?>
				</td>
				<td style="width:100px;">
					<?php if(empty($barcode)) {?>
					<input type="text" name="data[Filter][barcode]" class="input-Search" placeholder="Enter Barcode number" />
					<?php } else {?>
					<input type="text" name="data[Filter][barcode]" class="input-Search" placeholder="Enter Barcode Number" value="<?php echo $barcode;?>" />
					<?php }?>
				</td>
				<td><?php echo $form->submit('Search', array('div'=>false, 'class' => 'btn','style'=>'padding:0 2px; height:20px;')); ?></td>
			</tr>
			<?php if(count($samplerequestlist) > 0) {?>
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
		<!-- 30-10-13 Ends -->
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
		
	<thead>
		<!--<tr>
			<td colspan="12"><strong>Search By Request No:</strong> <?php //echo $form->text('Search.order',array('class'=>'input-text','style'=>'width:100px;'));?>&nbsp;&nbsp;<strong>Search By Name:</strong> <?php //echo $form->text('Search.name',array('class'=>'input-text','style'=>'width:200px;'));?>&nbsp;&nbsp;<?php //echo $form->submit('Search', array('div'=>false, 'class' => 'btn')); ?></td>
		</tr>-->
		<tr>
			
			<th width="2%"><h4>S.No.</h4></th>
			<th style="text-align:center; width:100px;"><h4>Test Req.No</h4></th>
		    <th><h4><?php echo $paginator->sort('Name', 'Health.name', array('class'=>'pagination')); ?></h4></th>
					
			<th style="text-align:center;"><h4>Date</h4></th>
			<th style="text-align:center;"><h4>Time</h4></th>
            <th style="text-align:center; width:150px;"><h4>Booked By</h4></th>
			<th style="text-align:center; width:150px;"><h4>serviced By</h4></th>
			<!--<th style="text-align:center; width:200px;"><h4>Processing Lab</h4></th>-->
			<th style="text-align:center;"><h4>Phlebo Assigned</h4></th>
			<th style="text-align:center;width:200px;""><h4>Phlebo Details</h4></th>
			<th style="text-align:center;"><h4>City</h4></th>
			<!--<th><h4><?php echo $paginator->sort('Locality', 'Health.locality', array('class'=>'pagination')); ?></h4></th>-->

			<th style="text-align:center; width:100px;"><h4>Report Status</h4></th>
			<th style="text-align:center;"><h4>Request Status</h4></th>
			<!--<th style="text-align:center; width:75px;"><h4>Test Amount</h4></th>-->
			<th style="text-align:center; width:100px;"><h4>Lab Test Reg.NO</h4></th>
			<th style="text-align:center; width:75px;"><h4>Balance due</h4></th>
			<th style="text-align:center;"><h4>Message from Lab</h4></th>
			<!--<?php if($userType == 'A') {?>
			<th style="text-align:center;"><h4>Delete</h4></th>
            <?php }?>
                        <th style="text-align:center;"><h4>Call Status</h4></th>-->
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
	<tr style="background-color:#efceff;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
	<?php } else {?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 15) {?>
		<tr style="background-color:#cdd756;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 18) {?>
		<tr id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 1) {?>
		<tr style="background-color:#F5FFA1;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 2) {?>
		<tr style="background-color:#A1FFB9;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 3) {?>
		<tr style="background-color:#D8FF95;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 16) {?>
		<tr style="background-color:#FAAC2E;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 19) {?>
		<tr style="background-color:#FCF3CF;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 20) {?>
		<tr style="background-color:#70B1FE;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 21) {?>
		<tr style="background-color:#F2F4F4;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 22) {?>
		<tr style="background-color:#FAD7A0;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 23) {?>
		<tr style="background-color:#A2D9CE;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 4) {?>
		<tr style="background-color:#B3F7FE;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 5) {?>
		<tr style="background-color:#e5e9ff;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 6) {?>
		<tr style="background-color:#e5ffc0;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 7) {?>
		<tr style="background-color:#fdff71;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 17) {?>
		<tr style="background-color:white;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>		
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 9) {?>
		<tr style="background-color:#d4ffea;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 10) {?>
		<tr style="background-color:#ffd7ad;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 14) {?>
		<tr style="background-color:#88c7b7;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 11) {?>
		<tr style="background-color:#E7DC9F;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 12) {?>
		<tr style="background-color:#AA9AFF;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 13) {?>
		<tr style="background-color:#FFA0AB;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
		<?php if($samplerequestlist[$ctr]['Health']['requ_status'] != 4 && $samplerequestlist[$ctr]['Health']['requ_status'] != 5 && $samplerequestlist[$ctr]['Health']['requ_status'] != 6 && $samplerequestlist[$ctr]['Health']['requ_status'] != 7 && $samplerequestlist[$ctr]['Health']['requ_status'] != 9 && $samplerequestlist[$ctr]['Health']['requ_status'] != 10 && $samplerequestlist[$ctr]['Health']['requ_status'] != 11 && $samplerequestlist[$ctr]['Health']['requ_status'] != 12 && $samplerequestlist[$ctr]['Health']['requ_status'] != 13 && $samplerequestlist[$ctr]['Health']['requ_status'] != 14 && $samplerequestlist[$ctr]['Health']['requ_status'] != 15 && $samplerequestlist[$ctr]['Health']['requ_status'] != 16 && $samplerequestlist[$ctr]['Health']['requ_status'] != 1 && $samplerequestlist[$ctr]['Health']['requ_status'] != 2 && $samplerequestlist[$ctr]['Health']['requ_status'] != 3 && $samplerequestlist[$ctr]['Health']['requ_status'] != 17 && $samplerequestlist[$ctr]['Health']['requ_status'] != 18 && $samplerequestlist[$ctr]['Health']['requ_status'] != 19 && $samplerequestlist[$ctr]['Health']['requ_status'] != 20 && $samplerequestlist[$ctr]['Health']['requ_status'] != 21 && $samplerequestlist[$ctr]['Health']['requ_status'] != 22 && $samplerequestlist[$ctr]['Health']['requ_status'] != 23) {?>
		<tr style="background-color:#ffe4ef;" id="RequestId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
		<?php }?>
	<?php }?>	
	<!-- Code Edited By Ashish Ends-->	
		<td style="text-align:center; border-bottom:1px solid #666666;">
			<?php										
				echo ($ctr+1);
			?>
		</td>
		
		<td style="text-align:center; border-bottom:1px solid #666666;">
			<?php echo $samplerequestlist[$ctr]['Health']['order_num'];?>
			<br><b><?php echo $samplerequestlist[$ctr]['Health']['source'];?></b>
			<?php if($samplerequestlist[$ctr]['Health']['ticket_raised']==1){?>
				<br><div style="font-size:9px;background-color: red;line-height: 20px;width: 20px;border-radius: 10px;margin-left: 20px;margin-top: 5px;">
					<a target="_blank" style="color: white;text-decoration: none;" href="<?php echo "https://www.niramayahealthcare.com/admin/ticket/edit_ticket/".base64_encode($samplerequestlist[$ctr]['Health']['ticket_id']); ?>">TR</a>
				</div>
			<?php } ?>
		</td>
		
		<td style="border-bottom:1px solid #666666;"><?php echo $samplerequestlist[$ctr]['Health']['name'];?>
		<?php //echo $samplerequestlist[$ctr]['Health']['landline'];?><?php echo $this->Utility->show_mobile_hide($samplerequestlist[$ctr]['Health']['landline'],$samplerequestlist[$ctr]['Health']['sample_req_date']); ?>
		</td>
	
		<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo date('d-m-Y',strtotime($samplerequestlist[$ctr]['Health']['sample_req_date']));?></td>
		<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo $samplerequestlist[$ctr]['Health']['time_slot'];?></td>
		<td id="booked_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" style="text-align:center; width:200px; border-bottom:1px solid #666666;">
                <?php 
                    if(isset($samplerequestlist[$ctr]['Health']['created_by']) && $samplerequestlist[$ctr]['Health']['created_by'] == 0) {
                        echo "NPL";
                    }
                    else
                    { 
                        echo isset($samplerequestlist[$ctr]['Health']['created_by'])?$pcc_list[$samplerequestlist[$ctr]['Health']['created_by']]:"";
                    }
                ?>
                </td>
                <td id="assign_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" style="text-align:center; width:200px; border-bottom:1px solid #666666;">
			<?php if(!empty($samplerequestlist[$ctr]['Health']['assigned_lab'])) {?>
				<?php
					$allow_service_edit=0;
					if($samplerequestlist[$ctr]['Health']['requ_status'] < 5)/*before sent to lab*/
					{
						$allow_service_edit = 1;
					}	
					if($session->read('Admin.userType') == 'A')	
						$allow_service_edit = 1;
				?>
				
				<?php if($samplerequestlist[$ctr]['Health']['assigned_lab'] == 'Home') {?>
					<?php echo "Home Collection";?>&nbsp;&nbsp;
					<?php if($allow_service_edit == 1){ ?>
						<a href="javascript:void(0);" onclick="edit_lab('<?php echo $samplerequestlist[$ctr]['Health']['id'];?>');">Edit</a>
					<?php } ?>
				<?php } else {?>
					<?php echo $samplerequestlist[$ctr]['Health']['assigned_lab'];?>&nbsp;&nbsp;
					<?php if($allow_service_edit == 1){ ?>
						<a href="javascript:void(0);" onclick="edit_lab('<?php echo $samplerequestlist[$ctr]['Health']['id'];?>');">Edit</a>
					<?php } ?>
				<?php }?>
				
				
			<?php } else {?>
				<select name="" onchange="assign_lab(this.value,'<?php echo $samplerequestlist[$ctr]['Health']['id'];?>');" style="width:150px;">
					<option value="">Assign Lab</option>
					<?php foreach($samplerequestlist[$ctr]['Health']['lab_list'] as $key=>$val) {?>
					<option value="<?php echo $key;?>"><?php echo $val;?></option>
					<?php }?>
					<!--<option value="Home">Home Collection</option>-->
				</select>
			<?php }?>
			
			<?php echo $html->image('admin/p_rocess.gif',array('id'=>'process_img'.$samplerequestlist[$ctr]['Health']['id'],'style'=>'display:none; height:10px;'));?>
		</td>
		<!--<td>
			<?php echo $plab[$samplerequestlist[$ctr]['Health']['processing_lab']]; ?>
		</td>-->
		<?php
			$allow_agent_edit=0;
			if($samplerequestlist[$ctr]['Health']['requ_status'] < 5 || $samplerequestlist[$ctr]['Health']['requ_status'] == 15 || $samplerequestlist[$ctr]['Health']['requ_status'] == 16 ||$samplerequestlist[$ctr]['Health']['requ_status'] == 13 || $samplerequestlist[$ctr]['Health']['requ_status'] == 10 || $samplerequestlist[$ctr]['Health']['requ_status'] == 11 || $samplerequestlist[$ctr]['Health']['requ_status'] == 12)/*before sent to lab*/
			{
				$allow_agent_edit = 1;
			}	
			if($session->read('Admin.userType') == 'A')	
				$allow_agent_edit = 1;
		?>
		<?php if($samplerequestlist[$ctr]['Health']['agent_name'] != 'No') {?>
			<td id="assigning_col_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" style="text-align:center; border-bottom:1px solid #666666;">
				<?php echo $samplerequestlist[$ctr]['Health']['agent_name'];?>&nbsp;&nbsp;&nbsp;
				<?php if($allow_agent_edit == 1){ ?>
				<a href="javascript:void(0);" onclick="edit_agent('<?php echo $samplerequestlist[$ctr]['Health']['id'];?>');">Edit</a>
				<?php } ?>
				<br />
				<span style="padding:0px 0px 0px 39px; display:none;" id="assign_agent_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>"><?php echo $html->image('admin/p_rocess.gif',array('style'=>'height:10px;'));?></span>
			</td>
		<?php } else {?>
			<td id="assigning_col_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" style="text-align:center; border-bottom:1px solid #666666;">
				<select onchange="assign_agent(this.value,'<?php echo $samplerequestlist[$ctr]['Health']['id'];?>');" style="width:150px; color:#666666;">
					<option value="">Select Agent</option>
					<?php foreach($agent_list as $key => $val) {?>
					<option value="<?php echo $val['Agent']['id'];?>"><?php echo $val['Agent']['name'];?></option>
					<?php }?>
				</select><br />
				<span style="padding:0px 0px 0px 10px; display:none;" id="assign_agent_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>"><?php echo $html->image('admin/p_rocess.gif',array('style'=>'height:10px;'));?></span>
			</td>
		<?php }?>
		
		<?php if($samplerequestlist[$ctr]['Health']['agent_name'] != 'No') {?>
			<?php if($samplerequestlist[$ctr]['Health']['agent_confirm'] == 0) {?>
			<td style="text-align:center; border-bottom:1px solid #666666;" id="ConfirmAgent_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">
				<?php if(in_array($samplerequestlist[$ctr]['Health']['requ_status'],array(0,15,18,1,2,4,13,3))) { ?> 
					<a href="javascript:void(0);" onclick="confirm_agent('<?php echo $samplerequestlist[$ctr]['Health']['id'];?>');">Confirm</a><br /> 
				<?php } else {?>
					Name : <?php echo $samplerequestlist[$ctr]['Health']['phlebo_name'];?> <br>
					Contact : <?php echo $samplerequestlist[$ctr]['Health']['phlebo_contact'];?> <br>
					Tracking : <?php echo $samplerequestlist[$ctr]['Health']['phlebo_tracking'];?> <br>
					<a href="javascript:void(0);" onclick="confirm_agent('<?php echo $samplerequestlist[$ctr]['Health']['id'];?>');">Edit</a><br /> 
				<?php } ?>
				<span style="padding:0px 0px 0px 10px; display:none;" id="confirm_agent_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>"><?php echo $html->image('admin/p_rocess.gif',array('style'=>'height:10px;'));?></span>
			</td>
			<?php }
			?>
			<?php if($samplerequestlist[$ctr]['Health']['agent_confirm'] == 1) {?>
				<td id="AgentAssigned_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" <?php echo $class;?> style="text-align:center; border-bottom:1px solid #666666;">
					Name : <?php echo $samplerequestlist[$ctr]['Health']['phlebo_name'];?> <br>
					Contact : <?php echo $samplerequestlist[$ctr]['Health']['phlebo_contact'];?> <br>
					Tracking : <?php echo $samplerequestlist[$ctr]['Health']['phlebo_tracking'];?> <br>
					<a href="javascript:void(0);" onclick="confirm_agent('<?php echo $samplerequestlist[$ctr]['Health']['id'];?>');">Edit</a><br /> 
				</td>
			<?php }?>
		<?php } else {?>
		<td style="text-align:center; border-bottom:1px solid #666666;" id="AgentAssigned_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>">Assign Agent<br /><span style="padding:0px 0px 0px 10px; display:none;" id="confirm_agent_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>"><?php echo $html->image('admin/p_rocess.gif',array('style'=>'height:10px;'));?></span></td>
		<?php }  ?>
		
		<td style="border-bottom:1px solid #666666;"><?php echo $samplerequestlist[$ctr]['Health']['city'];?></td>
		<!--<td style="border-bottom:1px solid #666666;"><?php echo str_replace('_'," ",$samplerequestlist[$ctr]['Health']['locality']);?></td>-->
			
		<td style="text-align:center; border-bottom:1px solid #666666;">
			<?php if($samplerequestlist[$ctr]['Health']['patient_report'] == '') {?>
			<?php echo "Not Uploaded";?>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['patient_report'] != '') {?>
			<?php echo "Uploaded"."<br />";?>
			<!--<a href="<?php echo PATIENT_REPORT_URL.$samplerequestlist[$ctr]['Health']['patient_report'];?>" target="_blank" style="color:#0066CC;">View</a>-->
                        <br/>
                        <?php if($userType == 'A' || $userType == 'BM'){ ?>
                        	<a href="<?php echo SITE_URL;?>tests/view_report/<?php echo base64_encode(str_replace("?","@@@@",$samplerequestlist[$ctr]['Health']['patient_report']));?>" target="_blank" onclick="window.alert('Balance Due - <?php
                            $amt_rec1 = ($samplerequestlist[$ctr]['Health']['total_amount']-$samplerequestlist[$ctr]['Health']['received_amount']);
                            echo $amt_rec1; ?>');">Custom</a>
                            <br>
                            <?php if(!empty($samplerequestlist[$ctr]['Health']['smart_report']))
                        	{ ?>
                            	<a href="<?php echo $samplerequestlist[$ctr]['Health']['smart_report'];?>" target="_blank" onclick="window.alert('Balance Due - <?php
                                $amt_rec1 = ($samplerequestlist[$ctr]['Health']['total_amount']-$samplerequestlist[$ctr]['Health']['received_amount']);
                                echo $amt_rec1; ?>');">Smart</a>
                                <br>
                            <?php } ?>
                            <a href="<?php echo SITE_URL;?>home/print_report/<?php echo base64_encode(str_replace("?","@@@@",$samplerequestlist[$ctr]['Health']['patient_report']));?>" target="_blank" onclick="window.alert('Balance Due - <?php
                            $amt_rec2 = ($samplerequestlist[$ctr]['Health']['total_amount']-$samplerequestlist[$ctr]['Health']['received_amount']);
                            echo $amt_rec2; ?>');">W/o Header</a><br>
							<?php if(!empty($samplerequestlist[$ctr]['Health']['patient_report_with_header'])) { ?>
								<a href="<?php echo $samplerequestlist[$ctr]['Health']['patient_report_with_header'];?>" target="_blank" onclick="window.alert('Balance Due - <?php
								$amt_rec1 = ($samplerequestlist[$ctr]['Health']['total_amount']-$samplerequestlist[$ctr]['Health']['received_amount']);
								echo $amt_rec1; ?>');">W/ Header</a> 
							<?php } ?>
                        <?php } else { ?>


                            <?php
                            $amt_rec1 = ($samplerequestlist[$ctr]['Health']['total_amount']-$samplerequestlist[$ctr]['Health']['received_amount']);
                            if($amt_rec1 > 0)
                            { ?>
                                <a href="javascript:void(0);" onclick="window.alert('Balance Due - <?php
                                echo $amt_rec1; ?>');">Custom</a>

                                <a href="javascript:void(0);" onclick="window.alert('Balance Due - <?php
                                echo $amt_rec1; ?>');">W/o Header</a>

                            <?php }
                            else
                            { ?>
                               	<a href="<?php echo SITE_URL;?>tests/view_report/<?php echo base64_encode(str_replace("?","@@@@",$samplerequestlist[$ctr]['Health']['patient_report']));?>" target="_blank" onclick="window.alert('Balance Due - <?php
                                $amt_rec1 = ($samplerequestlist[$ctr]['Health']['total_amount']-$samplerequestlist[$ctr]['Health']['received_amount']);
                                echo $amt_rec1; ?>');">Custom</a>
                                <br>
	                            <?php if(!empty($samplerequestlist[$ctr]['Health']['smart_report']))
                        		{ ?>
	                            	<a href="<?php echo $samplerequestlist[$ctr]['Health']['smart_report'];?>" target="_blank" onclick="window.alert('Balance Due - <?php
	                                $amt_rec1 = ($samplerequestlist[$ctr]['Health']['total_amount']-$samplerequestlist[$ctr]['Health']['received_amount']);
	                                echo $amt_rec1; ?>');">Smart</a>
	                                <br>
	                            <?php } ?>
                                <a href="<?php echo SITE_URL;?>home/print_report/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['patient_report']);?>" target="_blank" onclick="window.alert('Balance Due - <?php
                                $amt_rec2 = ($samplerequestlist[$ctr]['Health']['total_amount']-$samplerequestlist[$ctr]['Health']['received_amount']);
                                echo $amt_rec2; ?>');">W/o Header</a>
								<?php if(!empty($samplerequestlist[$ctr]['Health']['patient_report_with_header'])) { ?>
									<a href="<?php echo $samplerequestlist[$ctr]['Health']['patient_report_with_header'];?>" target="_blank" onclick="window.alert('Balance Due - <?php
									$amt_rec1 = ($samplerequestlist[$ctr]['Health']['total_amount']-$samplerequestlist[$ctr]['Health']['received_amount']);
									echo $amt_rec1; ?>');">W/ Header</a> 
								<?php } ?>
                            	<?php
                            }
                            ?>

                        <?php } ?>
                        
					<?php }?>
		</td>
		<td style="text-align:center; border-bottom:1px solid #666666;">
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 1) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Slot Not Available</a>
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 2) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Slot Blocked</a>
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 3) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Follow Up</a>
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 4) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Phlebo Assigned</a>
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 5) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Sent to Lab</a>
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 6) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Report</a>
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 9) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Closed</a>
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 7) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Partial Report</a>
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
			<!-- Code Edited By Ashish Starts-->
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 8) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Test Cancelled</a>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 10) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Sample Collected</a>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 11) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Sample Rejected</a>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 12) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Partial Sent To Lab</a>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 13) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Rescheduled</a>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 14) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Reg. in LIS</a>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 15) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">API New Booking</a>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 16) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Specimen Drawn</a>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 17) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Partial Closed</a>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 18) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Booking Confirmed</a>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 19) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Phlebo Confirmed</a>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 20) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Phlebo Tracking</a>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 21) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Specimen On Hold</a>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 22) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Cxl Req by Phlebo</a>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] == 23) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">Rejection Requested</a>
			<?php }?>
			<!-- Code Edited By Ashish Ends-->
			<?php if($samplerequestlist[$ctr]['Health']['requ_status'] != 4 && $samplerequestlist[$ctr]['Health']['requ_status'] != 5 && $samplerequestlist[$ctr]['Health']['requ_status'] != 6 && $samplerequestlist[$ctr]['Health']['requ_status'] != 7 && $samplerequestlist[$ctr]['Health']['requ_status'] != 8 && $samplerequestlist[$ctr]['Health']['requ_status'] != 9 && $samplerequestlist[$ctr]['Health']['requ_status'] != 10&& $samplerequestlist[$ctr]['Health']['requ_status'] != 11&& $samplerequestlist[$ctr]['Health']['requ_status'] != 12&& $samplerequestlist[$ctr]['Health']['requ_status'] != 13&& $samplerequestlist[$ctr]['Health']['requ_status'] != 14&& $samplerequestlist[$ctr]['Health']['requ_status'] != 15&& $samplerequestlist[$ctr]['Health']['requ_status'] != 16 && $samplerequestlist[$ctr]['Health']['requ_status'] != 1 && $samplerequestlist[$ctr]['Health']['requ_status'] != 2 && $samplerequestlist[$ctr]['Health']['requ_status'] != 3 && $samplerequestlist[$ctr]['Health']['requ_status'] != 17 && $samplerequestlist[$ctr]['Health']['requ_status'] != 18 && $samplerequestlist[$ctr]['Health']['requ_status'] != 19 && $samplerequestlist[$ctr]['Health']['requ_status'] != 20 && $samplerequestlist[$ctr]['Health']['requ_status'] != 21 && $samplerequestlist[$ctr]['Health']['requ_status'] != 22 && $samplerequestlist[$ctr]['Health']['requ_status'] != 23) {?>
			<a id="orderstatus_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" href="<?php echo SITE_URL;?>admin/samples/view_detail/<?php echo base64_encode($samplerequestlist[$ctr]['Health']['id']);?>">New booking</a>
		
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) {?>
			<?php echo $html->image('admin/envelope.jpg',array('width'=>'20','height'=>'10'));?>
			<?php }?>
			<?php }?>
			<?php //echo $html->link('View_Details',array('controller'=>'samples','action'=>'view_detail',base64_encode($samplerequestlist[$ctr]['Health']['id'])));?>
		</td>
		<!--<?php if($samplerequestlist[$ctr]['Health']['bill_amount'] != 0) {?>
		<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo 'Rs. '.$samplerequestlist[$ctr]['Health']['bill_amount'];?></td>
		<?php } 
		if($samplerequestlist[$ctr]['Health']['cancelled_status'] != 1)
		{
		if($samplerequestlist[$ctr]['Health']['bill_amount'] == 0 && $samplerequestlist[$ctr]['Health']['discount_id'] != 12) {?>
		<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo 'New booking';?></td>
		<?php } 
		if($samplerequestlist[$ctr]['Health']['bill_amount'] == 0 && $samplerequestlist[$ctr]['Health']['discount_id'] == 12) {?>
		<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo 'Rs. 0';?></td>
		<?php }} else {?>
		<td style="text-align:center; border-bottom:1px solid #666666;"><?php //echo 'Rs. 0';?></td>
		<?php }?>
		<?php 
		$amt_rec = ($samplerequestlist[$ctr]['Health']['received_amount']+$samplerequestlist[$ctr]['Health']['balance_refund']);
		?>-->
		
		<td style="text-align:center; border-bottom:1px solid #666666;"><?php echo $samplerequestlist[$ctr]['Health']['ref_num'];?></td>
		<td style="text-align:center; border-bottom:1px solid #666666;">
			<?php 
			echo $p_type[$samplerequestlist[$ctr]['Health']['payment_type']]."<br>";
			if($samplerequestlist[$ctr]['Health']['payment_type']==3)
				$amt_rec1 = $samplerequestlist[$ctr]['Health']['balance_amount'];
			else
				$amt_rec1 = ($samplerequestlist[$ctr]['Health']['total_amount']-$samplerequestlist[$ctr]['Health']['received_amount']);
			if($samplerequestlist[$ctr]['Health']['pay_status'] == 0) {?>
			<!--<a href="javascript:void(0);" onclick="show_payment_div('<?php //echo $samplerequestlist[$ctr]['Health']['id'];?>');">--><?php echo 'Rs. '.$amt_rec1;?><!--</a>-->
			<?php //echo $html->image('admin/p_rocess.gif',array('id'=>'pay_process_img'.$samplerequestlist[$ctr]['Health']['id'],'style'=>'display:none; height:10px;'));?>
			<?php }?>
			<?php if($samplerequestlist[$ctr]['Health']['pay_status'] == 1) {?>
			<!--<a href="javascript:void(0);" onclick="show_payment_div('<?php //echo $samplerequestlist[$ctr]['Health']['id'];?>');">--><?php echo 'Rs. '.$amt_rec1;?><!--</a>-->
			<?php //echo $html->image('admin/p_rocess.gif',array('id'=>'pay_process_img'.$samplerequestlist[$ctr]['Health']['id'],'style'=>'display:none; height:10px;'));?>
			<?php }?>
		</td>
		
		<td style="text-align:center; border-bottom:1px solid #666666;">
			<?php if(!empty($samplerequestlist[$ctr]['Health']['lab_message'])) 
					echo $samplerequestlist[$ctr]['Health']['lab_message'];
				else
					echo "-";?>
		</td>
		<!--<?php if($userType == 'A') {?>
		<td style="text-align:center; border-bottom:1px solid #666666;"><a href="javascript:void(0);" onclick="delete_row(<?php echo $samplerequestlist[$ctr]['Health']['id'];?>);"><?php echo $html->image('cross.png',array('alt'=>'Delete Row','title'=>'Delete Row'));?></a><br /><span id="ReqId_<?php echo $samplerequestlist[$ctr]['Health']['id'];?>" style="display:none;"><?php echo $html->image('admin/p_rocess.gif',array('style'=>'height:5px; width:30px;'));?></span></td>
		<?php }?>
		
        <td style="text-align:center; border-bottom:1px solid #666666;">
            <?php
            if($samplerequestlist[$ctr]['Health']['call_confirm_status'] == 1)
                echo $html->link($html->image('call_confirmed.png', array('border'=>0, 'alt'=>'','width'=>'32px;')),'javascript:void(0);' , array('escape'=>false, 'title'=>'','lang'=>$samplerequestlist[$ctr]['Health']['call_confirm_status'],'onclick'=>"confirm_call(this.id,this.getAttribute('lang'))",'id'=>'confirm_'.$samplerequestlist[$ctr]['Health']['id']));
            else
                echo $html->link($html->image('call_not_confirmed.png', array('border'=>0, 'alt'=>'','width'=>'32px;')),'javascript:void(0);' , array('escape'=>false, 'title'=>'','lang'=>$samplerequestlist[$ctr]['Health']['call_confirm_status'],'onclick'=>"confirm_call(this.id,this.getAttribute('lang'))",'id'=>'confirm_'.$samplerequestlist[$ctr]['Health']['id']));
            ?>
        </td>-->
		
	</tr>
	<?php }?>
	<!--<tr>
		<td align="left" class="borderBottom bgDarkHeader" colspan="6">
			<strong>Edit Test Status : </strong><?php //echo $form->select('Page.mode', unserialize(ARR_ACTIONS));?>&nbsp;<?php //echo $form->submit('Apply', array('div'=>false, 'class' => 'btn')); ?>
		</td>
	</tr>-->
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
		<td colspan="13" class="flash_failure" style=" float:none;">No records found.</td>
	</tr>
	<?php
		}
	?>
	
</table>
<label style="color:red;font-size:12px;">*TR - Ticket Raised</label>
</div>
<div id="myModal" class="modal">
  
  <!-- Modal content -->
  <div class="modal-content" style="width:350px;padding:0px;">
	<div class="modal-header" style="height:40px;">
		<span class="close" onclick="close_popup();">&times;</span>
		<h2 style="margin-top:10px;">Phlebo Details</h2>
	</div>
	<div class="modal-body" style="margin-top:15px;padding-left:20px;">
		<div style="width:100%;"><label style="width:30%;font-size:13px;display:inline;">Name</label> <input style="width:70%;height:25px;font-size:13px;" type="text" id="phleboname" value="" class="input-Search" required /></div><br><br>
		<div style="width:100%;"><label style="width:30%;font-size:13px;display:inline;">Phone</label> <input maxlength="10" minlength="10" onkeypress="return checknum(event)" style="width:70%;height:25px;font-size:13px;" type="text" id="phlebocontact" value="" class="input-Search" required /></div><br>
		<span style="color:red;" id="phleboerror"></span><br>
		<input type="hidden" id="phlebohealthid" value="" />
		<input class="btn" type="button" name="save" value="Submit" onclick="savephlebodetail()" style="margin-bottom:20px;"/>
	</div>
  </div>

</div>
<script>
function checknum(evt)
{
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}
	return true;
}
</script>
<style>
.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>