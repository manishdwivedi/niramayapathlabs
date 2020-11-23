<script type="text/javascript">
function print_action(val)
{
	window.location.href = 'http://www.niramayahealthcare.com/admin/samples/confirm_print_collection_detail/'+val;
}
</script>
<table border="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3" style="text-align:center;">
			<table border="0" width="100%">
				<tr>
					<td><img src="<?php echo SITE_URL;?>img/frontend/logo.png" /></td>
					<td align="right" valign="top"><a href="javascript:void(0);" onclick="print_action('<?php echo $print_id;?>');"><img src="/img/frontend/printButton.gif" /></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="3" style="text-align:center; font-weight:bold; padding:10px;">Collection Report of (<?php echo date('M d, Y',strtotime($find_detail['UserCollectionReport']['report_date']));?>)</td>
	</tr>
	<tr>
		<td style="font-weight:bold; width:175px; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-top:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;">User Name</td>
		<td style="border-right:1px solid #D8D8D8; border-top:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo $find_detail['UserCollectionReport']['admin_name'];?></td>
	</tr>
	<tr>
		<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;">Collection on</td>
		<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo date('M d, Y',strtotime($find_detail['UserCollectionReport']['report_date']));?></td>
	</tr>
	<tr>
		<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;">Total Collection</td>
		<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo 'Rs '.$find_detail['UserCollectionReport']['upper_total_amount'];?></td>
	</tr>
	<tr>
		<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;">Cash Collection</td>
		<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo 'Rs '.$find_detail['UserCollectionReport']['upper_cash_amount'];?></td>
	</tr>
	<tr>
		<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;">Cheque/DD Collection</td>
		<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo 'Rs '.$find_detail['UserCollectionReport']['upper_credit_card_amount'];?></td>
	</tr>
	<tr>
		<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;">Credit Card Collection</td>
		<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo 'Rs '.$find_detail['UserCollectionReport']['upper_cheque_amount'];?></td>
	</tr>
	<tr>
		<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;">Adj/Refund</td>
		<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo 'Rs '.$find_detail['UserCollectionReport']['adjustment_amount'];?></td>
	</tr>
	<tr>
		<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;">Total Cash Deposited</td>
		<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo 'Rs '.$find_detail['UserCollectionReport']['total_cash'];?></td>
	</tr>
	<tr>
		<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;">Total Cheque/DD Deposited</td>
		<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo 'Rs '.$find_detail['UserCollectionReport']['total_cheque'];?></td>
	</tr>
	<tr>
		<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;">Total Credit Card Deposited</td>
		<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo 'Rs '.$find_detail['UserCollectionReport']['total_credit_card'];?></td>
	</tr>
	<tr>
		<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;">Total Deposit</td>
		<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo 'Rs '.$find_detail['UserCollectionReport']['total_deposit'];?></td>
	</tr>
	<tr>
		<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;">Total Variation</td>
		<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo 'Rs '.$find_detail['UserCollectionReport']['total_variation'];?></td>
	</tr>
</table>
