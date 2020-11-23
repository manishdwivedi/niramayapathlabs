<style type="text/css">
body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }
</style>
<table cellspacing="0" cellpadding="0" border="0" width="650">
	<tr>
		<td valign="top">
			<p><strong>Dear <?php echo trim($data['Member']['firstName']) . ' '.  trim($data['Member']['lastName']);?></strong>,<br/>
			Thanks for registering on <?php echo WEBSITE_TITLE;?>,<br />
			
			To complete your registration, please click the following link: <?php echo $html->link('Confirm Registration', SITE_URL.'members/confirmation/code:'.$data['Member']['code']); ?>
			</p>
			<p>
			Or you may copy the following text link and enter it into your browser address bar to confirm your registration:<br />
			<?php 
			echo SITE_URL.'members/confirmation/code:'.$data['Member']['code'];
			?>
			</p>

			<p style="border:1px solid #BEBCB7; padding:13px 18px; background:#F8F7F5; ">
				Use the following values when prompted to log in:<br/>
				Username: <?php echo $data['Member']['userName']?><br/>
				Password: <?php echo $data['Member']['password1']?></p >	

			<p>Thank you<br />
			</p>
		</td>
	</tr>
</table>

