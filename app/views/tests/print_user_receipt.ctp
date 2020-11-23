<table border="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
	<tr>
		<td colspan="4"><img src="<?php echo SITE_URL;?>img/frontend/logo.png" width="100" /></td>
	</tr>
	<tr>
		<td align="left" width="60%" colspan="2">
			<?php foreach($pcc_list as $key => $val) {?>
				<?php if($req_detail['Health']['city'] == $val['Lab']['id']) {?>
				<strong>nirAmaya Pathlabs Private Limited - <?php echo $val['Lab']['pcc_name'];?></strong><br />
				<?php echo nl2br($val['Lab']['pcc_address']);?><br />
				<strong>PHONE :</strong> +919555009009<br />
				<strong>PATIENT NAME :</strong> <?php echo $req_detail['Health']['name'];?>
				<?php }?>
			<?php }?>
			<?php if($req_detail['Health']['city'] == '') {?>
			<strong>nirAmaya Pathlabs Private Limited - Home Collection</strong><br />
			Sample Collect Date : <?php echo $req_detail['Health']['sample_date1'];?><br />
			Sample Collect Time : <?php echo $home_collection_time;?><br />
			PHONE : +919555009009<br />
			PATIENT NAME : <?php echo $req_detail['Health']['name'];?>
			<?php }?>
		</td>
		<td align="right" width="40%" colspan="2">
			<table border="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
				<tr>
					<td align="right">Order No.</td>
					<td>:</td>
					<td><?php echo $dec_order_id;?></td>
				</tr>
				<tr>
					<td align="right">Date</td>
					<td>:</td>
					<td><?php echo date('d-m-Y',strtotime($req_detail['Health']['s_date']));?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4"><hr /></td>
	</tr>
	<tr>
		<td style="font-weight:bold; text-align:center;">S.No.</td>
		<td style="font-weight:bold;">Description</td>
		<td style="font-weight:bold; width:100px;">Unit Cost</td>
		<td style="font-weight:bold; width:100px;">Amount</td>
	</tr>
	<tr>
		<td colspan="4"><hr /></td>
	</tr>
	<?php $k = 1;foreach($req_detail['Health']['tests'] as $key => $val) {?>
	<tr>
		<td style="text-align:center;" valign="top"><?php echo $k;?></td>
		<td><?php echo $val['test_code'].' - '.$val['test_parameter'];?></td>
		<td><?php echo $val['test_mrp'];?></td>
		<td><?php echo $val['test_mrp'];?></td>
	</tr>
	<?php $k++;}?>
	<tr>
		<td colspan="4"><hr /></td>
	</tr>
	
	<tr>
		<td colspan="3" align="right" style="font-weight:bold;">Total Amount :</td>
		<td style="font-weight:bold;"><?php echo $req_detail['Health']['grand_total'];?></td>
	</tr>
	
	<?php if($req_detail['Health']['home_report'] != 0) {?>
	<tr>
		<td colspan="3" align="right" style="font-weight:bold;">Report at Home Charges :</td>
		<td style="font-weight:bold;"><?php echo $req_detail['Health']['home_report_charge'];?></td>
	</tr>
	<?php }?>
	<?php if($req_detail['Health']['discount_id'] != 0) {?>
	<tr>
		<td colspan="3" align="right" style="font-weight:bold;"><?php echo $req_detail['Health']['discount_name'];?> :</td>
		<td style="font-weight:bold;"><?php echo $req_detail['Health']['discount_amt'];?></td>
	</tr>
	<?php }?>
	<?php if($req_detail['Health']['add_discount'] == 'Yes') {?>
	<tr>
		<td colspan="3" align="right" style="font-weight:bold;">Additional Discount :</td>
		<td style="font-weight:bold;"><?php echo $req_detail['Health']['discount_amount'];?></td>
	</tr>
	<?php }?>
	<tr>
		<td colspan="3" align="right" style="font-weight:bold;">Net Payable :</td>
		<td style="font-weight:bold;"><?php echo $req_detail['Health']['total_amount'];?></td>
	</tr>
	<!--01-04014 Starts-->
	<tr>
		<td colspan="3" align="right" style="font-weight:bold;">Amount Received :</td>
		<td style="font-weight:bold;"><?php echo $req_detail['Health']['total_rec_amt'];?></td>
	</tr>
	<!--01-04014 Ends-->
	<!--<tr>
		<td colspan="3" align="right" style="font-weight:bold;">Amount Received :</td>
		<td style="font-weight:bold;"><?php //echo ($req_detail['Health']['received_amount']+$req_detail['Health']['balance_refund']);?></td>
	</tr>-->
	<?php //if($req_detail['Health']['refund_status'] == 0 && $req_detail['Health']['balance_refund'] > 0) {?>
	<!--<tr>
		<td colspan="3" align="right" style="font-weight:bold;">Refunded Amount :</td>
		<td style="font-weight:bold;"><?php echo '-'.$req_detail['Health']['balance_refund'];?></td>
	</tr>-->
	<?php //}?>
	<?php if($req_detail['Health']['adj_amt'] != 0) {?>
	<tr>
		<td colspan="3" align="right" style="font-weight:bold;">Adj/Refund :</td>
		<td style="font-weight:bold;"><?php echo $req_detail['Health']['adj_amt'];?></td>
	</tr>
	<?php }?>
	<?php if($req_detail['Health']['received_amount'] == 0) {?>
	<tr>
		<td colspan="3" align="right" style="font-weight:bold;">Balance Due :</td>
		<td style="font-weight:bold;"><?php echo $req_detail['Health']['total_amount'];?></td>
	</tr>
	<?php }?>
	<?php if($req_detail['Health']['received_amount'] != 0) {?>
	<tr>
		<td colspan="3" align="right" style="font-weight:bold;">Balance Due :</td>
		<td style="font-weight:bold;"><?php echo $req_detail['Health']['balance_amount'];?></td>
	</tr>
	<?php }?>
	
</table>
<?php 
echo "<script>";
echo "window.print();";
echo "</script>";
?>