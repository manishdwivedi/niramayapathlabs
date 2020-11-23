<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>nirAmaya</title>
</head>
<body>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20"></td>
        <td width="120"><img src="<?php echo SITE_URL;?>img/frontend/logo.jpg" width="120" height="79" /></td>
        <td></td>
        <td width="235" style="font:normal 12px arial;"><table width="235" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="padding-bottom:5px;"><table width="235" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50"><b>Email</b></td>
                <td width="20">:</td>
                <td><a href="mailto:info@niramayahealthcare.com">info@niramayahealthcare.com</a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="235" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50"><b>Website</b></td>
                <td width="20">:</td>
                <td><a href="http://www.niramayahealthcare.com" target="_blank">www.niramayahealthcare.com</a></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="20"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td style="font:bold 12px arial; padding:30px 0 10px 20px">Dear Administrator,</td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20"></td>
    <td style="font:normal 12px/16px arial; text-align:justify;">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="2" style="text-align:center; font-weight:bold; font-size:15px; text-decoration:underline; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-top:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;">Appointment Request by User</td>
			</tr>
			<tr>
				<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px; width:145px;">Appoint For</td>
				<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo $EmailData['EmailData']['doctor_name'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px; width:145px;">Clinic Name</td>
				<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo $EmailData['EmailData']['clinic_name'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px; width:145px;">Patient Name</td>
				<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo $EmailData['EmailData']['pat_name'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px; width:145px;">Patient Age</td>
				<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo $EmailData['EmailData']['pat_age'].' Years';?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px; width:145px;">Patient Email</td>
				<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo $EmailData['EmailData']['pat_email'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px; width:145px;">Patient Contact No.</td>
				<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo $EmailData['EmailData']['pat_contact'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px; width:145px;">Appointment Date</td>
				<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo date('d M Y',strtotime($EmailData['EmailData']['appoint_date_req']));?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px; width:145px;">Appointment Time</td>
				<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo $EmailData['EmailData']['appoint_time'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px; width:145px;">Patient Location</td>
				<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo $EmailData['EmailData']['pat_locality'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px; width:145px;">Appointment Reason</td>
				<td style="border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:10px;"><?php echo nl2br($EmailData['EmailData']['pat_reason']);?></td>
			</tr>
		</table>
	</td>
    <td width="20"></td>
  </tr>
</table>
</td>
  </tr>
  
  
    <tr>
    <td style="border-bottom: solid 9px #77c651; font-size:0px; line-height:0px;">.</td>
  </tr>
  
</table>
</body>
</html>
<?php //exit;?>
