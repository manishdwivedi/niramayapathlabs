<table border="0" width="100%">
	<?php if(!empty($tests) && empty($profiles) && empty($offers)) {?>
	<tr>
		<td colspan="3">Booked Test(s) Details :</td>
	</tr>
	<?php }?>
	<?php if(empty($tests) && !empty($profiles) && empty($offers)) {?>
	<tr>
		<td colspan="3">Booked Profile(s) Details :</td>
	</tr>
	<?php }?>
	<?php if(empty($tests) && empty($profiles) && !empty($offers)) {?>
	<tr>
		<td colspan="3">Booked Offer(s) Details :</td>
	</tr>
	<?php }?>
	<?php if(!empty($tests) && !empty($profiles) && empty($offers)) {?>
	<tr>
		<td colspan="3">Booked Test(s) & Profile(s) Details :</td>
	</tr>
	<?php }?>
	<?php if(!empty($tests) && empty($profiles) && !empty($offers)) {?>
	<tr>
		<td colspan="3">Booked Test(s) & Offer(s) Details :</td>
	</tr>
	<?php }?>
	<?php if(empty($tests) && !empty($profiles) && !empty($offers)) {?>
	<tr>
		<td colspan="3">Booked Profile(s) & Offer(s) Details :</td>
	</tr>
	<?php }?>
	<?php if(!empty($tests) && !empty($profiles) && !empty($offers)) {?>
	<tr>
		<td colspan="3">Booked Test(s),Profile(s) & Offer(s) Details :</td>
	</tr>
	<?php }?>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3">Thank you for choosing nirAmaya Healthcare</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:12px;">Request No.</td>
		<td style="font-weight:bold;">:</td>
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><?php echo $order_id;?></td>
	</tr>
	<tr>
		<td style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:12px;">Name</td>
		<td style="font-weight:bold;">:</td>
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><?php echo $first_name;?></td>
	</tr>
	<?php if(!empty($tests)) {?>
	<tr>
		<td style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:12px;">Test(s)</td>
		<td style="font-weight:bold;">:</td>
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><?php echo $tests;?></td>
	</tr>
	<?php }?>
	<?php if(!empty($profiles)) {?>
	<tr>
		<td style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:12px;">Profile(s)</td>
		<td style="font-weight:bold;">:</td>
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><?php echo $profiles;?></td>
	</tr>
	<?php }?>
	<?php if(!empty($offers)) {?>
	<tr>
		<td style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:12px;">Offer(s)</td>
		<td style="font-weight:bold;">:</td>
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><?php echo $offers;?></td>
	</tr>
	<?php }?>
	<tr>
		<td style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:12px;">Total Amout</td>
		<td style="font-weight:bold;">:</td>
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><?php echo 'Rs. '.$sub_total;?></td>
	</tr>
</table>
<?php //exit;?>
