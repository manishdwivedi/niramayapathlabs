<table border="0" width="100%">
	<tr>
		<td>Hello <?php echo $doctor_f_name.' '.$doctor_l_name.',';?></td>
	</tr>
	<tr>
		<td>Thankyou for registering yourself as a doctor.</td>
	</tr>
	<tr>
		<td style="font-weight:bold;">Confirmation Link :</td>
	</tr>
	<tr>
		<td><a href="<?php echo SITE_URL;?>pages/doctor_email_confirm/<?php echo $doctor_id;?>/<?php echo $doctor_pass;?>" target="_blank"><?php echo SITE_URL;?>pages/doctor_email_confirm/<?php echo $doctor_id;?>/<?php echo $doctor_pass;?></a></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Regards,<br />Niramayahealthcare</td>
	</tr>
</table>
