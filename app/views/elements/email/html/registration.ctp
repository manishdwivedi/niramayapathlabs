<style type="text/css">
body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; background:#F2F2F2; }
</style>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
	<tr>
	<td>
		</tr>
	<tr>
	
		<td valign="top">
			<p>Dear <strong><?php echo $data['User']['first_name']?></strong>,<br/>
			Welcome to Starksuits.<br><br>
			In order to activate your account kindly click on the given link and use the following username and password to log in.

			<a href="<?php echo SITE_URL.'/users/autologin/activationKey:'.$data['User']['activation_key'] ;?>" style="color:#1E7EC8;"><?php echo SITE_URL.'/users/autologin/activationKey:'.$data['User']['activation_key'] ;?></a></p>
			<br>
			

			<p>Thanks,<br />
			Starksuits</p>
		</td>
	</tr>
</table>