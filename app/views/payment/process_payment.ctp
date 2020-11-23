<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <body>
        <br/><br/><br/>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top" align="center">
                        Niramaya Healthcare - Processing Your Order
              </td>
            </tr>
            <tr>
                <td valign="top" align="center">
                    <span style="font-size:18px;"><?php e($html->image('ajax-loader.gif'));?> <br> Redirecting...</span>
                </td>
            </tr>
            <tr>
                <td valign="top" align="center">
                    <strong>Please wait while we take you to the payment page.</strong>
                </td>
            </tr>
        </table>


        <form name="ecom" method="post" action="<?php echo Configure::read('DirectPaySubmitUrl'); ?>">
        <input type="hidden" name="requestparameter" value="<?php echo $requestParameter; ?>">
        <input type="hidden" name="billingDtls" value="<?php echo $billingDtls; ?>">
        <input type="hidden" name="shippingDtls" value="<?php echo $shippingDtls; ?>">
        <input type="hidden" name="merchantId" value ="<?php echo Configure::read('DirectPay.mid'); ?>"/>
        <!--<input type="submit" name="submit" value="Submit">-->
        </form>
    </body>
</html>
<script type="text/javascript">
    window.onload=function(){
          document.forms["ecom"].submit();
    }
</script>