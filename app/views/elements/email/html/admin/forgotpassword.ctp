<style type="text/css">
body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }
</style>
<table cellspacing="0" cellpadding="0" border="0" width="650">
	<tr>
		<td valign="top">
			<p>Dear <strong><?php echo $user['Admin']['userName']?></strong>,<br/><br/>
			To log in to website just click <a href="<?php echo SITE_URL.'admin/';?>" style="color:#1E7EC8;">Login</a> and then enter your username and password.</p>

			<p style="border:1px solid #BEBCB7; padding:13px 18px; background:#F8F7F5; ">
				Use the following values when prompted to log in:<br/>
				<strong>Username:</strong> <?php echo $user['Admin']['userName']?><br/>
				<strong>Password:</strong> <?php echo $user['Admin']['password']?><p>		

			<p>Thanks<br />
			Admin</p>
		</td>
	</tr>
</table>