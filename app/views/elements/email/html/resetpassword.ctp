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
    <td style="font:bold 12px arial; padding:30px 0 10px 20px">Dear <?php echo $user['User']['name'];?>, <br/><br/> Greetings from Niramaya Healthcare!</td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20"></td>
    <td style="font:normal 12px/16px arial; text-align:justify;">Click on the following link to set a new password: <a href="<?php echo SITE_URL.'users/reset_password/'.$email;?>" style="color:#1E7EC8;">RESET PASSWORD</a><br />Please contact us if you have any questions or need further assistance</td>
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
