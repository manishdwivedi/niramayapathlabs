<style type="text/css">
body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }
</style>
<table cellspacing="0" cellpadding="0" border="0" width="650">
	<tr>
		<td valign="top">
	
			<p><strong>Dear <?php echo trim($data['Order']['shipping_first_name']).' '.trim($data['Order']['shipping_last_name']);?></strong>,<br/>
			

			<p style="border:1px solid #BEBCB7; padding:13px 18px; background:#F8F7F5; ">
				your order status:<br/>
				Status:  Completed<br/>
				Password: <?php echo $data['Order']['shippment_tracking_number']?><p>		

			<p>Thanks<br />
			Admin</p>
		</td>
	</tr>
</table>