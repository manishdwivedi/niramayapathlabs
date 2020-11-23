<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Niramayahealth Care</title>
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
    <td style="font:bold 12px arial; padding:30px 0 10px 20px">Hi Admin,</td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20"></td>
    <td style="font:normal 12px/16px arial; text-align:justify;">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td style="font-weight:bold; border:1px solid #D9D9D9; width:150px; padding:10px;">Patient Name</td>
				<td style="border:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['name'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Gender</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['gender'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Age</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['age'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Contact NO.</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['landline'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Email Id</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['email'];?></td>
			</tr>
			<?php if(!empty($mailContent['Health']['test_id'])) {?>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Tests</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['test_id'];?></td>
			</tr>
			<?php }?>
			<?php if(!empty($mailContent['Health']['profile_id'])) {?>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Profiles</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['profile_id'];?></td>
			</tr>
			<?php }?>
			<?php if(!empty($mailContent['Health']['offer_id'])) {?>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Special Offers</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['offer_id'];?></td>
			</tr>
			<?php }?>
			<?php if(!empty($mailContent['Health']['package_id'])) {?>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Packages</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['package_id'];?></td>
			</tr>
			<?php }?>
			<?php if(!empty($mailContent['Health']['service_id'])) {?>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Patient Care Services</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['service_id'];?></td>
			</tr>
			<?php }?>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Remarks</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo nl2br($mailContent['Health']['remarks']);?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Refer by</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['remark'];?></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<?php if($mailContent['Health']['sample_date'] != 'Please select a suitable date') {?>
			<tr>
				<td colspan="2" style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-top:1px solid #D9D9D9; padding:10px 10px 10px 0; text-align:center;">Lab Details</td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Lab Location</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['city'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Visit Date</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['sample_date'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Visit Time</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['sample_time'];?></td>
			</tr>
			<?php }?>
			<?php if($mailContent['Health']['sample_date1'] != 'Please select a suitable date') {?>
			<tr>
				<td colspan="2" style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-top:1px solid #D9D9D9; padding:10px 10px 10px 0; text-align:center;">Home Collection</td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Address</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">
					<?php 
					$explode_add = explode('*',$mailContent['Health']['address']);
					if(!empty($explode_add[0]) && empty($explode_add[1]))
					{
						echo $explode_add[0];
					}
					if(!empty($explode_add[0]) && !empty($explode_add[1]))
					{
						echo $explode_add[0]."<br />".$explode_add[1];
					}
					?>
				</td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Locality</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['locality'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">City</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['city'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">State</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['state'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Pincode</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['pincode'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Landmark</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['landmark'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Sample Collect Date</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['sample_date1'];?></td>
			</tr>
			<tr>
				<td style="font-weight:bold; width:150px; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;">Sample Collect Time</td>
				<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px;"><?php echo $mailContent['Health']['sample_time1'];?></td>
			</tr>
			<?php }?>
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



