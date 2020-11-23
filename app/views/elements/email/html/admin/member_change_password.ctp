<style type="text/css">
body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }
</style>
<table cellspacing="0" cellpadding="0" border="0" width="650">
	<tr>
		<td valign="top">
			<p><strong>Dear <?php echo trim($data['Member']['firstName']).' '.trim($data['Member']['lastName']);?></strong>,<br/>
			To log in website just click <?php echo $html->link('Login', SITE_URL.'admin/admins/login'); ?> and then enter your e-mail address and password.</p>

			<p style="border:1px solid #BEBCB7; padding:13px 18px; background:#F8F7F5; ">
				Use the following values when prompted to log in:<br/>
				User name: <?php echo $data['Member']['userName']?><br/>
				Password: <?php echo $data['Member']['password1']?><p>		

			<p>Thanks<br />
			Admin</p>
		</td>
	</tr>
</table>