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
                <td>info@niramayahealthcare.com</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="235" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50"><b>Website</b></td>
                <td width="20">:</td>
                <td>www.niramayahealthcare.com</td>
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
    <td style="font:normal 12px/16px arial; text-align:justify;"><strong>Your City -</strong><?php echo $mailContent['Book']['cityname'];?></td>
    <td width="20"></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td style="font:bold 12px arial; padding:10px 0px 10px 20px;">Your Date -<?php echo $mailContent['Book']['date'];?></td>
  </tr>
  <tr>
    <td style="font:bold 12px arial; padding:10px 0px 10px 20px;">Your Time -<?php echo $mailContent['Book']['time'];?></td>
  </tr>
  
  
    <tr>
    <td style="border-bottom: solid 9px #77c651; font-size:0px; line-height:0px;">.</td>
  </tr>
  
</table>
</body>
</html>







