<table border="0" width="100%" style="font-family:arial; font-size:12px;">
	<tr>
		<td colspan="2"><?php echo ucwords($this->data['Health']['patient_name']);?> Details</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Request Number</td>
		<td><?php echo $this->data['Health']['req_num'];?></td>
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
		<td><?php echo $this->Utility->show_mobile_hide($this->data['Health']['contact'],$this->data['Health']['visit_lab_collect_date']); ?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Email</td>
		<td><?php echo $this->Utility->show_mobile_hide($this->data['Health']['email'],$this->data['Health']['visit_lab_collect_date']); ?></td>
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
	<?php if(!empty($this->data['Health']['service_names'])){?>
	<tr>
		<td width="15%" class="boldText">Patient Care Services</td>
		<td><?php echo $this->data['Health']['service_names'];?></td>
	</tr>
	<?php }?>
	<?php if($this->data['Health']['home_report'] != 0) {?>
	<tr>
		<td width="15%" class="boldText">Report Sending Info</td>
		<td><?php echo $this->data['Health']['home_info'];?></td>
	</tr>
	<?php }?>
	<tr>
		<td width="15%" class="boldText">Total Amount</td>
		<td><?php echo 'Rs. '.$this->data['Health']['total_test_amt'];?></td>
	</tr>
	<?php if(!empty($sample_type)){ ?>
		<tr>
			<td width="15%" class="boldText">Sample Type To Be Collected</td>
			<td><?php foreach($sample_type as $val){ echo $val['sample_type_master']['shortname']."<br>"; }?></td>
		</tr>
	<?php } ?>
	<?php //if(!empty($this->data['Health']['receive_tracks'])) {?>
	<?php //$k = 1;foreach($this->data['Health']['receive_tracks'] as $key => $val) {?>
	<!--<tr>
		<td width="15%" class="boldText">Installment <?php //echo $k;?></td>
		<td><?php //echo 'Rs. '.$val['Paytrack']['pay_install'].' received by '.$val['Paytrack']['admin_receive_name'].' on '.date('d-m-Y',strtotime($val['Paytrack']['admin_receive_date']));?></td>
	</tr>-->
	<?php //$k++;}?>
	<?php //}?>
	
	<?php //if($this->data['Health']['balance_refund'] > 0) {?>
	<!--<tr>
		<td width="15%" class="boldText">Refund Amount</td>
		<td><?php //echo 'Rs. '.$this->data['Health']['balance_refund'];?><?php //echo $form->hidden('Health.bal_ref',array('value'=>$this->data['Health']['balance_refund']));?></td>
	</tr>-->
	<?php //if($this->data['Health']['refund_status'] == 0) {?>
	<!--<tr id="RefundStat">
		<td width="15%" class="boldText">Refund Status</td>
		<td>
			<input type="radio" name="data[Refund][status]" value="1" id="RefundStatus1" onClick="show_update_span();" />&nbsp;Refunded&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="data[Refund][status]" value="0" checked="checked" />&nbsp;Not Refunded&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="display:none;" id="UpdateSpan"><a href="javascript:void(0);" onClick="update_refund('<?php //echo $this->data['Health']['id']?>');" style="color:#0033FF;">Update</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			<?php //echo $html->image('frontend/loading.gif',array('style'=>'height:42px; width:43px; margin:-27px 0 -14px 0; display:none;','id'=>'LoadDiv'));?>
		</td>
	</tr>-->
	<?php //}?>
	<?php //if($this->data['Health']['refund_status'] == 1) {?>
	<!--<tr>
		<td width="15%" class="boldText">Refund Status</td>
		<td><?php //echo $this->data['Health']['refund_admin_name'];?></td>
	</tr>-->
	<?php //}?>
	
	<?php //}?>
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
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Net Payable Amount</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Net Payble Amount</td>
		<td><?php echo 'Rs. '.$this->data['Health']['test_amt'];?></td>
	</tr>
	
	<?php if(!empty($this->data['Health']['receive_tracks'])) {?>
	<?php $k = 1;foreach($this->data['Health']['receive_tracks'] as $key => $val) {?>
	<tr>
		<td width="15%" class="boldText">Installment <?php echo $k;?></td>
		<?php if($val['Paytrack']['pay_mode'] == 'cash'){?>
		<?php 
		$pay_mode = 'Cash';
		?>
		<?php }?>
		<?php if($val['Paytrack']['pay_mode'] == 'credit_card'){?>
		<?php 
		$pay_mode = 'Credit Card';
		$num = $val['Paytrack']['c_number'];
		?>
		<?php }?>
		<?php if($val['Paytrack']['pay_mode'] == 'cheque'){?>
		<?php 
		$pay_mode = 'Cheque/DD';
		$num = $val['Paytrack']['c_number'];
		?>
		<?php }?>
		<?php if($val['Paytrack']['pay_mode'] == 'adjust'){?>
		<?php 
		$pay_mode = 'Adjustment';
		?>
		<?php }?>
		<?php if($val['Paytrack']['pay_mode'] == 'btc'){?>
		<?php 
		$pay_mode = 'btc';
		?>
		<?php }?>
		<td>
			<?php if($val['Paytrack']['pay_mode'] == 'cash'){?>
			<?php echo 'Rs. '.$val['Paytrack']['pay_install'].' received by '.$val['Paytrack']['admin_receive_name'].' by '.$pay_mode.' on '.date('d-m-Y',strtotime($val['Paytrack']['admin_receive_date']));?>
			<?php }?>
			<?php if($val['Paytrack']['pay_mode'] == 'credit_card'){?>
			<?php echo 'Rs. '.$val['Paytrack']['pay_install'].' received by '.$val['Paytrack']['admin_receive_name'].' by '.$pay_mode.' ('.$num.')'.' on '.date('d-m-Y',strtotime($val['Paytrack']['admin_receive_date']));?>
			<?php }?>
			<?php if($val['Paytrack']['pay_mode'] == 'cheque'){?>
			<?php echo 'Rs. '.$val['Paytrack']['pay_install'].' received by '.$val['Paytrack']['admin_receive_name'].' by '.$pay_mode.' ('.$num.')'.' on '.date('d-m-Y',strtotime($val['Paytrack']['admin_receive_date']));?>
			<?php }?>
			<?php if($val['Paytrack']['pay_mode'] == 'adjust'){?>
			<?php echo 'Rs. '.$val['Paytrack']['pay_install'].' adjusted by '.$val['Paytrack']['admin_receive_name'].' as a '.$pay_mode.' on '.date('d-m-Y',strtotime($val['Paytrack']['admin_receive_date']));?>

			<?php }?>
			<?php if($val['Paytrack']['pay_mode'] == 'btc'){?>
			<?php echo 'Rs. '.$val['Paytrack']['pay_install'].' received as a BTC/Process Without Pay by '.$val['Paytrack']['admin_receive_name'].' on '.date('d-m-Y',strtotime($val['Paytrack']['admin_receive_date']));?>
			<?php }?>
		</td>
	</tr>
	<?php $k++;}?>
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
</table>
<?php 
echo "<script>";
echo "window.print();";
echo "</script>";
?>