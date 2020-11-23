<script>
function message_lab()
{
	$('#LabMessage').show();
	$('#updatePayStatus').hide();
	$('#raise_ticket').hide();
	$('#specimen_d').hide();
	<?php if($this->data['Health']['message_status'] == 1) {?>
	$('#MessageDiv').show();
	<?php }?>
}

function show_payment()
{
	$('#updatePayStatus').show();
	$('#LabMessage').hide();
	$('#specimen_d').hide();
	$('#raise_ticket').hide();
}

function show_raise_ticket()
{
	$('#updatePayStatus').hide();
	$('#LabMessage').hide();
	$('#specimen_d').hide();
	$('#raise_ticket').show();
}

function specimen_detail()
{
	$('#updatePayStatus').hide();
	$('#LabMessage').hide();
	$('#raise_ticket').hide();
	$('#specimen_d').show();
}

function submit_ticket(){
	var healthId = $('#HealthRequestId').val();
	
	$data = $('#form10').serialize();
	var error=0;
	if($("#TicketTicketSampleDate1").val() == '')
	{
		$("#ticket_sample_date1_error").html("Specify Correct date");
		error++;
	}
	else
		$("#ticket_sample_date1_error").html("");
		
	if($("#TicketTickettitle").val() == '')
	{
		$("#tickettitle_error").html("Title cannot be empty");
		error++;
	}
	else
		$("#tickettitle_error").html("");
		
	if($("#TicketConcernRaised").val() == '')
	{
		$("#ticket_concern_error").html("Raised By cannot be empty");
		error++;
	}
	else
		$("#ticket_concern_error").html("");
		
	if($("#TicketEmail").val() == '')
	{
		$("#ticket_email_error").html("Email cannot be empty");
		error++;
	}
	else
		$("#ticket_email_error").html("");
	
	if($("#TicketPhone").val() == '')
	{
		$("#ticket_phone_error").html("Phone Number cannot be empty");
		error++;
	}
	else
		$("#ticket_phone_error").html("");
	
	if($("#TicketDescription").val()=='')
	{
		$("#ticket_description_error").html("description cannot be empty");
		error++;
	}
	else
		$("#ticket_description_error").html("");
	console.log(error);
	if(error==0)
	{
		return true;
	}
	else{
		return false;
	}
}

function submit_message()
{
	document.forms["form12"].submit();
}

function preview_payment()
	{
		$("#hide_preview_payment").show();
		var row_1 = parseInt(document.getElementById('HealthTotalAmt').value);
		var row_2 = parseInt(document.getElementById('HealthReceiveAmt').value);
		var row_3 = parseInt(document.getElementById('HealthBalAmt').value);
		<?php if($this->data['Health']['balance_refund'] == 0) {?>
		var row_4 = parseInt(document.getElementById('HealthPayAmt').value);
		var bal_ref_amt = parseInt(document.getElementById('HealthPayAmt').value);
		<?php }?>
		<?php if($this->data['Health']['balance_refund'] != 0) {?>
		var bal_ref_amt = '<?php echo $this->data['Health']['balance_refund'];?>';
		<?php }?>
		var row_5 = document.getElementById('HealthPayMode').value;
		var row_8 = parseInt(document.getElementById('HealthAdjAmt').value);
		var row_100 = document.getElementById('HealthAdjRsn').value;
		var row_101 = document.getElementById('HealthBtcRsn').value;
		if(row_5 == 'adjust')
		{
			
			var val_4 = 'Adjustment';
			var null_val = '';
			$('#PMODE').html(val_4);
			$('#DIVCCNUM').hide();
			$('#DIVCHQNUM').hide();
			$('#HealthCardNumber').val(null_val);
			$('#HealthChequeNumber').val(null_val);
			var rep_div_1 = 'Rs. '+parseInt(row_1);
			var rep_div_2 = 'Rs. '+parseInt(row_2+parseInt(bal_ref_amt));
			
			if(row_8 > row_3)
			{
				var rep_div_3 = 'Rs. 0';
				var rep_div_4 = 'Rs. '+parseInt(row_8-row_3);
				$('#ADJAMT').html(rep_div_4);
				$('#BAMT').html(rep_div_3);
				$('#RFAMTDIV').hide();
				$('#ADJAMTDIV').show();
			}
			if(row_8 == row_3)
			{
				var rep_div_3 = 'Rs. 0';
				$('#BAMT').html(rep_div_3);
				$('#RFAMTDIV').hide();
			}
			if(row_8 < row_3)
			{
				var rep_div_3 = 'Rs. '+parseInt(row_3-row_8);
				$('#BAMT').html(rep_div_3);
				$('#RFAMTDIV').hide();
			}
			var adj_rsn = '';
			adj_rsn +=row_100;
			$('#ADJRSN').html(adj_rsn);
			$('#ADJRSNDIV').show();
			$('#TAMT').html(rep_div_1);
			$('#RAMT').html(rep_div_2);
			$('#PreviewPayment').show();
			$('#updatePayStatus').show();
		}
		else
		{
			if(row_5 == 'cash')
			{
				var val_1 = 'Cash';
				var null_val = '';
				$('#PMODE').html(val_1);
				$('#HealthAdjRsn').val(null_val);
				$('#DIVCCNUM').hide();
				$('#DIVCHQNUM').hide();
				$('#HealthCardNumber').val(null_val);
				$('#HealthChequeNumber').val(null_val);
			}
			if(row_5 == 'credit_card')
			{
				var val_2 = 'Credit Card';
				var null_val = '';
				var row_6 = document.getElementById('HealthCardNumber').value;
				$('#PMODE').html(val_2);
				$('#HealthAdjRsn').val(null_val);
				$('#DIVCCNUM').show();
				$('#DIVCHQNUM').hide();
				$('#CCNUM').html(row_6);
				$('#HealthChequeNumber').val(null_val);
			}
			if(row_5 == 'cheque')
			{
				var val_3 = 'Cheque/DD';
				var null_val = '';
				var row_7 = document.getElementById('HealthChequeNumber').value;
				$('#PMODE').html(val_3);
				$('#HealthAdjRsn').val(null_val);
				$('#DIVCCNUM').hide();
				$('#DIVCHQNUM').show();
				$('#HealthCardNumber').val(null_val);
				$('#CHQNUM').html(row_7);
			}
			var rep_div_1 = 'Rs. '+parseInt(row_1);
			var copy_1 = parseInt(row_1);
			var rep_div_2 = 'Rs. '+parseInt(row_2+row_4);
			var copy_2 = parseInt(row_2+row_4);
			if(parseInt(row_1) > parseInt(copy_2))
			{
				var rep_div_3 = 'Rs. '+parseInt(row_1-copy_2);
				$('#BAMT').html(rep_div_3);
			}
			else
			{
				var rep_div_3 = 'Rs. '+0;
				var rep_div_4 = 'Rs. '+parseInt(copy_2-row_1);
				$('#BAMT').html(rep_div_3);
				$('#RFAMT').html(rep_div_4);
				$('#RFAMTDIV').show();
			}
			if(row_5 == 'btc')
			{
				var bal_due_amt = '<?php echo 'Rs. '.$this->data['Health']['balance_amt'];?>';
				var val_4 = 'BTC/Process Without Pay';
				var null_val = '';
				$('#PMODE').html(val_4);
				$('#DIVCCNUM').hide();
				$('#DIVCHQNUM').hide();
				$('#HealthCardNumber').val(null_val);
				$('#HealthChequeNumber').val(null_val);
				var rep_div_2 = '0';
				$('#RFAMTDIV').hide();
				var adj_rsn = '';
				$('#ADJRSNDIV').hide();
				$('#BTCRSNDIV').show();
				$('#BTCRSN').html(row_101);
				$('#BAMT').html(bal_due_amt);
			}
			if(row_5 == 'btcnopayment')
			{
				var bal_due_amt = 0;
				var val_4 = 'Bill To Company';
				var null_val = '';
				var row_101 = $("#HealthBtcNoPaymentRemark").val();
				$('#PMODE').html(val_4);
				$('#DIVCCNUM').hide();
				$('#DIVCHQNUM').hide();
				$('#HealthCardNumber').val(null_val);
				$('#HealthChequeNumber').val(null_val);
				var rep_div_2 = '<?php echo 'Rs. '.$this->data['Health']['balance_amt'];?>';;
				$('#RFAMTDIV').hide();
				var adj_rsn = '';
				$('#ADJRSNDIV').hide();
				$('#BTCRSNDIV').show();
				$('#BTCRSN').html(row_101);
				$('#BAMT').html(bal_due_amt);
				$('#HealthPayAmt').val(<?php echo $this->data['Health']['balance_amt'];?>);
				
			}
			
			$('#TAMT').html(rep_div_1);
			$('#RAMT').html(rep_div_2);
			$('#PreviewPayment').show();
			$('#updatePayStatus').show();
		}
	}
	
	//function to hide payment preview
	function hide_preview_payment()
	{
		$("#PreviewPayment").hide();
	}
	
	function show_print_reciept(id,request_id)
	{
		var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

		var print_reciept = document.getElementById('print_reciept');
		var print_order_id = document.getElementById('print_order_id').value;
		var print_request_id = document.getElementById('print_request_id').value;
		print_reciept.href = siteUrl+'tests/print_user_receipt_new/'+Base64.encode(print_order_id)+'/'+Base64.encode(print_request_id);
	}


</script>
<div class="contentcontainer">
<div class="headings altheading">
        <h2>View Sample Request</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; <?php echo $html->link('Assigned Request(s)', '/admin/samples/agent_page', array('title'=>'Home')); ?> &#187; View Sample Request
	
	
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Request Number</td>
		<td><?php echo $this->data['Health']['order_num'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Patient Name</td>
		<td><?php echo $this->data['Health']['patient_name'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Gender</td>
		<td><?php echo $this->data['Health']['gender'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Age</td>
		<td><?php echo $this->data['Health']['age'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Contact</td>
		<td><?php echo $this->data['Health']['contact']; ?></td>
			</tr>
	<tr>
		<td width="15%" class="boldText">Email</td>
		<td><a href="mailto:<?php echo $this->data['Health']['email']; ?>"><?php echo $this->data['Health']['email']; ?>
		
		</a></td>
	</tr>
	
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Test Information</td>
	</tr>
	<?php if(!empty($this->data['Health']['test_names'])){?>
	<tr>
		<td width="15%" class="boldText">Test(s)</td>
		<td><?php echo $this->data['Health']['test_names'];?></td>
	</tr>
	<?php }?>
	<?php if(!empty($this->data['Health']['profile_names'])){?>
	<tr>
		<td width="15%" class="boldText">Profile(s)</td>
		<td><?php echo $this->data['Health']['profile_names'];?></td>
	</tr>
	<?php }?>
	<?php if(!empty($this->data['Health']['offer_names'])){?>
	<tr>
		<td width="15%" class="boldText">Offer(s)</td>
		<td><?php echo $this->data['Health']['offer_names'];?></td>
	</tr>
	<?php }?>
	<?php if(!empty($this->data['Health']['package_names'])){?>
	<tr>
		<td width="15%" class="boldText">Package(s)</td>
		<td><?php echo $this->data['Health']['package_names'];?></td>
	</tr>
	<?php }?>
	<tr>
		<td width="15%" class="boldText">Amount</td>
		<td><?php echo 'Rs. '.$this->data['Health']['test_amt'];?></td>
	</tr>
	<?php if(!empty($this->data['Health']['receive_tracks'])) {?>
	<?php $k = 1;foreach($this->data['Health']['receive_tracks'] as $key => $val) {?>
	<tr>
		<td width="15%" class="boldText">Installment <?php echo $k;?></td>
		<td><?php echo 'Rs. '.$val['Paytrack']['pay_install'].' received by '.$val['Paytrack']['admin_receive_name'].' on '.date('d-m-Y',strtotime($val['Paytrack']['admin_receive_date']));?></td>
	</tr>
	<?php $k++;}?>
	<?php }?>
	
	<?php if($this->data['Health']['balance_refund'] > 0) {?>
	<tr>
		<td width="15%" class="boldText">Refund Amount</td>
		<td><?php echo 'Rs. '.$this->data['Health']['balance_refund'];?><?php echo $form->hidden('Health.bal_ref',array('value'=>$this->data['Health']['balance_refund']));?></td>
	</tr>
	<?php if($this->data['Health']['refund_status'] == 0) {?>
	<tr id="RefundStat">
		<td width="15%" class="boldText">Refund Status</td>
		<td>
			<input type="radio" name="data[Refund][status]" value="1" id="RefundStatus1" onClick="show_update_span();" />&nbsp;Refunded&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="data[Refund][status]" value="0" checked="checked" />&nbsp;Not Refunded&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="display:none;" id="UpdateSpan"><a href="javascript:void(0);" onClick="update_refund('<?php echo $this->data['Health']['id']?>');" style="color:#0033FF;">Update</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			<?php echo $html->image('frontend/loading.gif',array('style'=>'height:42px; width:43px; margin:-27px 0 -14px 0; display:none;','id'=>'LoadDiv'));?>
		</td>
	</tr>
	<?php }?>
	<?php if($this->data['Health']['refund_status'] == 1) {?>
	<tr>
		<td width="15%" class="boldText">Refund Status</td>
		<td><?php echo $this->data['Health']['refund_admin_name'];?></td>
	</tr>
	<?php }?>
	
	<?php }?>
	<tr>
		<td width="15%" class="boldText">Remark</td>
		<td><?php echo $this->data['Health']['remark'];?></td>
	</tr>
	<?php if($this->data['Health']['discount_id'] != 0) {?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Discount Information</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Discount Code</td>
		<td><?php echo $this->data['Health']['discount_code'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Discount Amount</td>
		<td><?php echo $this->data['Health']['discount_amt'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Description</td>
		<td><?php echo $this->data['Health']['discount_info'];?></td>
	</tr>
	<?php }?>
	<?php if($this->data['Health']['discount_amount'] != 0) {?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Additional Discount</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Additional Discount</td>
		<td><?php echo 'Rs. '.$this->data['Health']['discount_amount'];?></td>
	</tr>
	<?php if(!empty($this->data['Health']['discount_amount_reason'])) {?>
	<tr>
		<td width="15%" class="boldText">Discount Given Reason</td>
		<td><?php echo $this->data['Health']['discount_amount_reason'];?></td>
	</tr>
	<?php } else {?>
	<tr>
		<td width="15%" class="boldText">Discount Given Reason</td>
		<td><?php echo 'Not given any reason';?></td>
	</tr>
	<?php }?>
	<?php }?>
	<?php if((!empty($this->data['Health']['visit_lab_location']) && !empty($this->data['Health']['visit_lab_collect_time']) && !empty($this->data['Health']['visit_lab_collect_date']))) {?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Visit a Lab</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Visit Location</td>
		<td><?php echo $this->data['Health']['visit_lab_location'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Visit Time</td>
		<td><?php echo $this->data['Health']['visit_lab_collect_time'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Visit Date</td>
		<td><?php echo $this->data['Health']['visit_lab_collect_date'];?></td>
	</tr>
	<?php }?>
	
	<?php if((!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date']))) {?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Home Collection</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Collection Date</td>
		<td><?php echo $this->data['Health']['home_collect_date'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Collection Time</td>
		<td><?php echo $this->data['Health']['home_collect_time'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Collection Address</td>
		<td>
			<?php 
			$exp_add_show = explode('*',$this->data['Health']['home_collect_address']);
			echo $exp_add_show[0]."<br>".$exp_add_show[1];
			?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Locality</td>
		<td><?php echo nl2br($this->data['Health']['home_collect_locality']);?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">City</td>
		<td><?php echo nl2br($this->data['Health']['home_collect_city_show']);?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">State</td>
		<td><?php echo nl2br($this->data['Health']['home_collect_state_show']);?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Pincode</td>
		<td><?php echo nl2br($this->data['Health']['home_collect_pincode']);?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Landmark</td>
		<td><?php echo nl2br($this->data['Health']['home_collect_landmark']);?></td>
	</tr>
	<?php }?>
	<script type="text/javascript">
		function print_detail(val1)
		{
			window.open('<?php echo SITE_URL;?>admin/samples/print_detail/'+val1,'name','height=500,width=600,scrollbars=yes');
		}
	</script>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<tr>
		<td colspan="2">
			<a href="javascript:void(0);" onclick="print_detail('<?php echo $this->data['Health']['id'];?>');" style="text-decoration:none;"><?php echo $form->submit('Print Detail', array('div'=>false, 'class' => 'btn')); ?></a>
			<?php echo $form->submit('Message From Lab', array('div'=>false, 'class' => 'btn','onclick'=>'message_lab();')); ?>&nbsp;&nbsp;&nbsp;
			<?php echo $form->submit('Payment Status', array('div'=>false, 'class' => 'btn','onclick'=>'show_payment();')); ?>&nbsp;&nbsp;&nbsp;
			<a id="print_reciept" href="" target='_blank'><?php echo $form->submit('Print Reciept', array('div'=>false, 'class' => 'btn','onclick'=>'show_print_reciept();')); ?>&nbsp;&nbsp;&nbsp;</a>
			<?php echo $form->submit('Raise Ticket', array('div'=>false, 'class' => 'btn','onclick'=>'show_raise_ticket();')); ?>&nbsp;&nbsp;&nbsp;
			<?php echo $form->submit('Specimen Detail', array('div'=>false, 'class' => 'btn','onclick'=>'specimen_detail();')); ?>&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<tr id="LabMessage" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/lab_message/'.base64_encode($this->data['Health']['id']),'id'=>'form12','name'=>'form12'));?>
			<?php echo $form->hidden('Health.action_url',array('value'=>'admin_view_agent_detailing'));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Lab Message</h2></td>
				</tr>
				<tr>
					<td style="font-weight:bold; width:10px;">1)</td>
					<td style="width:135px;" class="boldText">Lab Message</td>
					<td style="width:55px;"><input type="radio" name="data[Health][message_status]" value="1" <?php if($this->data['Health']['message_status'] == 1) {?> checked="checked" <?php }?> onclick="message_div(this.value);" />&nbsp;&nbsp;Yes</td>
					<td><input type="radio" name="data[Health][message_status]" value="0" <?php if($this->data['Health']['message_status'] == 0) {?> checked="checked" <?php }?> onclick="message_div(this.value);" />&nbsp;&nbsp;No</td>
				</tr>
				<tr id="MessageDiv" style="display:none;">
					<td>&nbsp;</td>
					<td class="boldText">Enter Message</td>
					<td colspan="2"><?php echo $form->textarea('Health.lab_message',array('class'=>'input-text','rows'=>5,'cols'=>30,'style'=>'font-size:12px;'));?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><?php echo $form->submit('Submit Message', array('div'=>false, 'class' => 'btn','onclick'=>'submit_message();')); ?></td>
					<td>&nbsp;</td>
				</tr>
				
				<tr></tr>
			</table>
			<?php echo $form->end();?>
			
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="5"><h2>Message Log</h2></td>
				</tr>
				<tr>
				</tr>
		
				<tr><th style="width:80px;"><div style="text-align:center;">S.No.</div></th>
				<th style="width:200px;"><div style="margin-left: 20px;">Date</div></th>
				<th><div style="margin-left: 20px;">Message</div></th></tr>

				<?php
				$count = 0;
				echo "<br/><br/>";
				foreach($lab_mm as $message)
				{	
					if(($count%2) == 1){ $class = " class=\"alt\"";}else{ $class = ""; }?>
					<tr <?php echo $class;?>>
						<td style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;">
						<?php echo ($count+1);?></td>
						<td style="border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;">
						<?php   echo "<span class='boldText' style='margin-left: 20px;'>".date('d-m-Y',strtotime($message['LabMessageMaster']['date']))."</span>"; ?>
						</td>
						<td colspan="3" style="border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;">
						<?php   echo "<span class='boldText' style='margin-left: 20px;'>".$message['LabMessageMaster']['message']."</span>"; ?>
						</td>
					</tr>
				<?php $count ++;}
				?>
				<tr>
				</tr>
			</table>
			
		</td>
	</tr>
	<tr id="raise_ticket" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/ticketsubmit/'.base64_encode($this->data['Health']['id']),'id'=>'form10','name'=>'form10','enctype'=>'multipart/form-data'));?>
			<?php echo $form->hidden('Health.action_url',array('value'=>'admin_view_agent_detailing'));?>
			<?php echo $form->hidden('Health.id',array('value'=>$this->data['Health']['id']));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Ticket</h2></td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Category<font color="#FF0000">*</font></label>
					</td>
					<td>
						<select id="category" name="data[Ticket][category]" style="float:left">
							<option value="">Select a Category</option>
							<?php foreach($category as $key => $val) {?>
								<option value="<?php echo $key;?>"><?php echo $val;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Priority<font color="#FF0000">*</font></label>
					</td>
					<td>
						<select id="priority" name="data[Ticket][priority]" style="float:left">
							<option value="">Select a Category</option>
							<?php foreach($priority as $key => $val) {?>
								<option value="<?php echo $key;?>"><?php echo $val;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Subject<font color="#FF0000">*</font></label>
					</td>
					<td>
					    <?php echo $form->text('Ticket.tickettitle', array('class'=>'input-text','style'=>'width:200px;')); ?>
						<label id="tickettitle_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Raised By<font color="#FF0000">*</font></label>
					</td>
					<td>
						<?php echo $form->text('Ticket.concern_raised', array('class'=>'input-text','style'=>'width:200px;')); ?>
						<label id="ticket_concern_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Email<font color="#FF0000">*</font></label>
					</td>
					<td>
						<?php echo $form->text('Ticket.email', array('class'=>'input-text','style'=>'width:200px;','type'=>'email')); ?>
						<label id="ticket_email_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Phone Number<font color="#FF0000">*</font></label>
					</td>
					<td>
						<?php echo $form->text('Ticket.phone', array('class'=>'input-text phone','style'=>'width:200px;','maxlength'=>'10','minlength'=>'10','type'=>'tel')); ?>
						<label id="ticket_phone_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Description<font color="#FF0000">*</font></label>
					</td>
					<td>
						<?php echo $form->textarea('Ticket.description', array('class'=>'input-text','rows'=>5,'cols'=>50,'style'=>'font-size:12px;')); ?>
						<label id="ticket_description_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Image Upload</label>
					</td>
					<td>
						<?php echo $form->file('Ticket.image_upload',array('class'=>'input-text'));?>
						<div id="msgReportFile" style="color:#FF0000; font-size:12px; clear:both;"></div>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<span id="ticketprocessing" style="color:Red;display:none;font-size: x-large;">Ticket is Being Raised.</span>
					<span id="ticketcompleted" style="color:Green;display:none;font-size: x-large;">Ticket submitted successfully.</span>
					<td><input id="ticketsubmit" class="btn" type="submit" onclick="submit_ticket()" value="Submit"/></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>	
			<?php echo $form->end();?>
		</td>
	</tr>
	<tr id="specimen_d" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/specimen_save/'.base64_encode($this->data['Health']['id']),'id'=>'form11','name'=>'form11','enctype'=>'multipart/form-data'));?>
			<?php echo $form->hidden('Health.action_url',array('value'=>'admin_view_agent_detailing'));?>
			<?php echo $form->hidden('Health.id',array('value'=>$this->data['Health']['id']));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Specimen Drawn</h2></td>
				</tr>
				<tr>
					<td width="25%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Specimen Drawn Date<font color="#FF0000">*</font></label>
					</td>
					<td>
						<?php if(!empty($this->data['Health']['specimen_date'])){
								echo $form->text('Health.specimen_date', array('readonly' => 'readonly','class'=>'input-text datepicker2','style'=>'width:100px;','value'=>$this->data['Health']['specimen_date'],'required'=>'required',"disabled"=>"true")); 
							}
							else{
								echo $form->text('Health.specimen_date', array('readonly' => 'readonly','class'=>'input-text datepicker2','style'=>'width:100px;','value'=>$this->data['Health']['specimen_date'],'required'=>'required',"disabled"=>"false")); 
							}
							?>
					</td>
				</tr>
				<tr>
					<td width="25%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Specimen Drawn Time<font color="#FF0000">*</font></label>
					</td>
					<td>
						<input id="appt-time" type="time" name="data[Health][specimen_time]" value="<?php echo $this->data['Health']['specimen_time']; ?>" required <?php if(!empty($this->data['Health']['specimen_time'])){ echo "disabled";}?>>
					</td>
				</tr>
				<tr>
					<td width="25%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Confirmed By<font color="#FF0000">*</font></label>
					</td>
					<td>
					    <?php if(!empty($this->data['Health']['specimen_by'])){ 
							echo $form->text('Health.specimen_by', array('class'=>'input-text','style'=>'width:200px;','required'=>'required',"disabled"=>"true")); 
						}
						else
						{
							echo $form->text('Health.specimen_by', array('class'=>'input-text','style'=>'width:200px;','required'=>'required',"disabled"=>"false"));
						}
						?>
						<label id="tickettitle_error" style="color:#FF0000; font-size:12px; clear:both;"></label>						
					</td>
				</tr>
				
				<tr>
					<td width="25%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Remarks<font color="#FF0000">*</font></label>
					</td>
					<td>
					    <?php if(!empty($this->data['Health']['specimen_remarks'])){ 
							echo $form->text('Health.specimen_remarks', array('class'=>'input-text','style'=>'width:200px;','required'=>'required',"disabled"=>'true')); 
						}
						else{
							echo $form->text('Health.specimen_remarks', array('class'=>'input-text','style'=>'width:200px;','required'=>'required',"disabled"=>'false')); 
						}?>
						<label id="tickettitle_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				
				<tr>
					<td>&nbsp;</td>
					<td>
						<input id="specimensubmit" class="btn" type="submit" value="Submit" style="display:<?php if(!empty($this->data['Health']['specimen_remarks'])){ echo 'none';}?>" />
						<input id="specimenedit" class="btn" type="button" value="Edit" onclick="edit_specimen();" style="display:<?php if(empty($this->data['Health']['specimen_remarks'])){ echo 'none';}?>"  />
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>	
			<?php echo $form->end();?>
		</td>
	</tr>
		<?php echo $form->create(array('url'=>'/admin/samples/update_payment','id'=>'form2','name'=>'form2','onsubmit'=>'return payment_submit();'));?>
	<?php echo $form->hidden('Health.id',array('value'=>$this->data['Health']['id']));?>
	<?php echo $form->hidden('Health.action_url',array('value'=>'admin_view_agent_detailing'));?>
	<tr id="PayStatusDiv" style="display:none;"></tr>
	<tr id="updatePayStatus" style="display:none;">
		<td colspan="2">
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="2"><h2>Update Payment Status</h2></td>
				</tr>
				
				<!--<tr>
					<td colspan="2">
						<input type="radio" name="data[Health][pay_status]" value="1" onclick="show_partial(this.value);" /> Full Payment Received
						<input type="radio" name="data[Health][pay_status]" value="2" onclick="show_partial(this.value);" /> Partial Payment Received
					</td>
				</tr>-->
				
				<tr>
					<td width="50%">
						<table border="0" width="100%">
							<tr>
								<td width="25%" style="font-weight:bold;">Mode of Payment</td>
								<td>
									<select name="data[Health][pay_mode]" class="input-text" style="color:#666666; width:150px;" onchange="open_tr(this.value);" id="HealthPayMode">
										<option value="">Select Mode</option>
										<option value="paymenttopcc">Payment with PCC</option>
										<option value="wallet">Wallet</option>
										<!--<option value="refund">Refund</option>-->
										<option value="cash" selected="selected">Cash</option>
										<option value="credit_card">Credit Card</option>
										<option value="cheque">Cheque/DD</option>
										<option value="adjust">Adj/Refund</option>
										<option value="btc">Process Without Pay</option>
										<option value="btcnopayment">Bill To Company</option>
									</select><br />
									<span id="PayModeNillVal" style="display:none; color:#FF0000;">Please select Payment Mode</span>
								</td>
							</tr>
							<tr id="CC" style="display:none;">
								<td width="25%" style="font-weight:bold;">Credit Card Number</td>
								<td><input type="text" name="data[Health][card_number]" class="input-text" style="width:150px;" id="HealthCardNumber"></td>
							</tr>
							<tr id="CQ" style="display:none;">
								<td width="25%" style="font-weight:bold;">Cheque/DD Number</td>
								<td><input type="text" name="data[Health][cheque_number]" class="input-text" style="width:150px;" id="HealthChequeNumber"></td>
							</tr>
							<tr>
								<td width="25%" style="font-weight:bold;">Total Amount</td>
								<td>
									Rs. <?php echo $this->data['Health']['total_test_amt'];?>
									<?php echo $form->hidden('Health.total_amt',array('value'=>$this->data['Health']['test_amt']));?>
								</td>
							</tr>
							<?php if($this->data['Health']['discount_amount_after_add'] != 0) {?>
							<tr>
								<td width="25%" style="font-weight:bold;">Discount</td>
								<td>
									Rs. <?php echo $this->data['Health']['discount_amount_after_add'];?>
								</td>
							</tr>
							<?php }?>
							<tr>
								<td width="25%" style="font-weight:bold;">Net Payable</td>
								<td>
									Rs. <?php echo $this->data['Health']['test_amt'];?>
								</td>
							</tr>
							<tr>
								<td width="25%" style="font-weight:bold;">Amount Received</td>
								<td>
									Rs. <?php echo $this->data['Health']['rec_ins_amt'];?>
									<input type="hidden" value="<?php echo $this->data['Health']['rec_ins_amt']; ?>" id="total_amt_received"/>
									<?php echo $form->hidden('Health.receive_amt',array('value'=>$this->data['Health']['receive_amt']));?>
								</td>
							</tr>
							<tr>
								<td width="25%" style="font-weight:bold;">Balance Due</td>
								<td>
									Rs. <?php echo $this->data['Health']['balance_amt'];?>
									<?php echo $form->hidden('Health.bal_amt',array('value'=>$this->data['Health']['balance_amt']));?>
								</td>
							</tr>
							<?php if($this->data['Health']['balance_refund'] == 0) {?>
							<tr id="PayRec">
								<td width="30%" style="font-weight:bold;">Payment Received</td>
								<td>Rs. <?php echo $form->text('Health.pay_amt',array('value'=>'','class'=>'input-text','style'=>'width:100px;'));?></td>
							</tr>
							<?php }?>
							<?php if($this->data['Health']['balance_refund'] != 0) {?>
							<tr>
								<td width="30%" style="font-weight:bold;">Refund Amount</td>
								<td>Rs. <?php echo $this->data['Health']['balance_refund'];?></td>
							</tr>
							<?php }?>
							<tr id="AdjPay" style="display:none;">
								<td width="30%" style="font-weight:bold;">Adj/Refund Amount</td>
								<td>Rs. <?php echo $form->text('Health.adj_amt',array('value'=>'','class'=>'input-text','style'=>'width:100px;'));?></td>
							</tr>
							<tr id="AdjRsn" style="display:none;">
								<td width="30%" style="font-weight:bold;">Adj/Refund Reason</td>
								<td><?php echo $form->textarea('Health.adj_rsn',array('value'=>'','class'=>'input-text','cols'=>30,'rows'=>5,'style'=>'font-size:12px;'));?></td>
							</tr>
							<tr id="BtcPay" style="display:none;">
								<td width="30%" style="font-weight:bold;">BTC Amount</td>
								<td>Rs. <?php echo $form->text('Health.btc_amt',array('value'=>'0','class'=>'input-text','style'=>'width:100px;','readonly'=>'readonly'));?></td>
							</tr>
							<tr id="BtcRsn" style="display:none;">
								<td width="30%" style="font-weight:bold;">Reason</td>
								<td><?php echo $form->textarea('Health.btc_rsn',array('value'=>'','class'=>'input-text','cols'=>30,'rows'=>5,'style'=>'font-size:12px;'));?></td>
							</tr>
							<tr class="BtcNoPayment" style="display:none;">
								<td width="30%" style="font-weight:bold;">Bill To Company</td>
								<td><?php echo $form->text('Health.btc_no_payment_bill_to_company',array('value'=>!empty($this->data['Health']['created_by'])?$get_all_pcc_list[$this->data['Health']['created_by']]:'NPL','class'=>'input-text','style'=>'font-size:12px;','readonly'=>'readonly'));?></td>
							</tr>
							<tr class="pay_amt" style="display:none;">
								<td width="30%" style="font-weight:bold;">Payment Amount</td>
								<td>Rs. <?php echo $form->text('Health.pcc_amt',array('value'=>'0','class'=>'input-text','style'=>'width:100px;','readonly'=>'readonly'));?></td>
							</tr>
							<!--<tr id="RefundPay" style="display:none;">
								<td width="30%" style="font-weight:bold;">Refund Amount</td>
								<td>Rs. <?php echo $form->text('Health.adj_amt',array('value'=>'','class'=>'input-text','style'=>'width:100px;'));?></td>
							</tr>-->
							<!--<tr id="WalletName" style="display:none;">
								<td width="30%" style="font-weight:bold;">Name Of Wallet</td>
								<td><?php echo $form->text('Health.adj_amt',array('value'=>'','class'=>'input-text','style'=>'width:100px;'));?></td>
							</tr>-->
							<!--<tr id="RefundMode" style="display:none;">
								<td width="30%" style="font-weight:bold;">Mode Of Refund</td>
								<td><?php echo $form->text('Health.adj_amt',array('value'=>'','class'=>'input-text','style'=>'width:100px;'));?></td>
							</tr>-->
							<!--<tr id="RefundRsn" style="display:none;">
								<td width="30%" style="font-weight:bold;">Remarks</td>
								<td><?php echo $form->textarea('Health.adj_rsn',array('value'=>'','class'=>'input-text','cols'=>30,'rows'=>5,'style'=>'font-size:12px;'));?></td>
							</tr>-->
							<tr class="forLab" style="display:none;">
								<td width="30%" style="font-weight:bold;">PCC Name</td>
								<td>
									<select name="data[Health][assigned_lab]" class="input-text">
										<option value="">Select Center</option>
										<?php foreach($pcc_list as $key => $val) {?>
												<option <?php echo ($this->data['Health']['assigned_lab'] == $key) ? 'selected' : ''; ?>  value="<?php echo $key;?>"><?php echo $val;?></option>
										<?php }?>
									</select>
								</td>
							</tr>
							<tr class="Remarks" style="display:none;">
								<td width="30%" style="font-weight:bold;">Remarks</td>
								<td><?php echo $form->textarea('Health.btc_no_payment_remark',array('value'=>'','class'=>'input-text','cols'=>30,'rows'=>3,'style'=>'font-size:12px;'));?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>
									<a href="javascript:void(0);" onclick="preview_payment();">Preview</a>
									<a href="javascript:void(0);" onclick="close_payment_box();">Close</a>
								</td>
							</tr>
						</table>
					</td>
					<td id="PreviewPayment" style="display:none;" valign="top">
						<table border="0" width="100%">
							<tr>
								<td width="25%" style="font-weight:bold;">Payment Mode</td>
								<td id="PMODE"></td>
							</tr>
							<tr style="display:none;" id="DIVCCNUM">
								<td width="30%" style="font-weight:bold;">Credit Card Number</td>
								<td id="CCNUM"></td>
							</tr>
							<tr style="display:none;" id="DIVCHQNUM">
								<td width="30%" style="font-weight:bold;">Cheque/DD Number</td>
								<td id="CHQNUM"></td>
							</tr>
							<tr>
								<td width="25%" style="font-weight:bold;">Total Amount</td>
								<td id="TAMT"></td>
							</tr>
							<tr>
								<td width="25%" style="font-weight:bold;">Received Amount</td>
								<td id="RAMT"></td>
							</tr>
							<tr>
								<td width="25%" style="font-weight:bold;">Balance Due</td>
								<td id="BAMT"></td>
							</tr>
							<tr style="display:none;" id="RFAMTDIV">
								<td width="25%" style="font-weight:bold;">Refund Amount</td>
								<td id="RFAMT"></td>
							</tr>
							<tr style="display:none;" id="ADJAMTDIV">
								<td width="30%" style="font-weight:bold;">Adj/Refund Amount</td>
								<td id="ADJAMT"></td>
							</tr>
							<tr style="display:none;" id="ADJRSNDIV">
								<td width="30%" style="font-weight:bold;">Adj/Refund Reason</td>
								<td id="ADJRSN"></td>
							</tr>
							<tr style="display:none;" id="BTCRSNDIV">
								<td width="30%" style="font-weight:bold;">BTC Reason</td>
								<td id="BTCRSN"></td>
							</tr>
							<tr>
								<td><?php echo $form->submit('Save & Submit', array('div'=>false, 'class' => 'btn','onclick'=>'')); ?></td>
								<td><a href="javascript:void(0);" onclick="hide_preview_payment();" id="hide_preview_payment" style="disply:none;text-decoration:none; color:#fff;" class="btn">Cancel</a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>	
	<?php echo $form->end();?>
	<tr>
		<td>
			<input type="hidden" id="print_order_id" value="<?php echo $this->data['Health']['id'];?>">
			<input type="hidden" id="print_request_id" value="<?php echo $this->data['Health']['order_num'];?>">	
		</td>
	</tr>
	</table>
</div>
