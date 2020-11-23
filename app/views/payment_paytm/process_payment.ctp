
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


        <form name="ecom" method="post" action="https://www.niramayahealthcare.com/PaytmKit/pgRedirect.php">
        <input type="hidden" name="REQUEST_TYPE" value="DEFAULT">
        <input type="hidden" name="MID" value="<?php echo Configure::read('PayTM.mid'); ?>">
        <input type="hidden" name="ORDER_ID" value="<?php echo Configure::read('PayTM.order_number'); ?>">
        <input type="hidden" name="CUST_ID" value ="<?php echo $patient_data['Health']['user_id']; ?>"/>
        <input type="hidden" name="INDUSTRY_TYPE_ID" value ="<?php echo Configure::read('PayTM.industry_type_id'); ?>"/>
        <input type="hidden" name="CHANNEL_ID" value ="<?php echo Configure::read('PayTM.channel_id'); ?>"/>
        <input type="hidden" name="TXN_AMOUNT" value ="<?php echo Configure::read('PayTM.amount'); ?>"/>
        <input type="hidden" name="WEBSITE" value ="<?php echo Configure::read('PayTM.website'); ?>"/>
        <input type="hidden" name="CHECKSUMHASH" value ="<?php echo $checksum; ?>"/>
        

        </form>
        <script type="text/javascript">
                document.ecom.submit();
        </script>
    </body>
</html>
