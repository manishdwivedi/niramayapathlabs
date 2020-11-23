<style type="text/css">
	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }
</style>
<table cellspacing="0" cellpadding="0" border="1" width="650">
	<tr><td valign="top" colspan="4">
			<p><b>New Order has been placed for the restaurant registered at Menureview . Details about the Customer & Restaurant are given as below :-</b> </p>
		</td></tr>
       <tr>
    	<td>Restaurant Name</td><td><?php echo $rest_info['Restaurant']['name'];?></td>
        
     </tr>  
    <tr>
    	<td>Name</td><td><?php echo $data['Checkout']['first_name'];?> <?php echo $data['Checkout']['last_name'];?></td>
        <td>Address</td><td><?php echo $data['Checkout']['street_no'];?>, <?php echo $data['Checkout']['street_name'];?>, <?php echo $data['Checkout']['cross_street_name'];?></td>
     </tr>
    <tr>
    	<td>Delivery Time</td><td><?php if($data['Checkout']['time']=="now"){echo "Now";}else{echo $data['Checkout']['later_date'];echo " at "; echo $data['Checkout']['later_time'];}?></td>
        <td>Customer Email</td><td><?php echo $data['Checkout']['email'];?></td>
     </tr> 
    <tr>
    	<td>Contact Number(Mobile)</td><td><?php echo $data['Checkout']['mobile'];?></td>
    	
        <td>Contact Number(Land Line)</td><td><?php echo $data['Checkout']['phone'];?></td>
     </tr> 
      <tr>
        <td colspan="2">Company Name</td><td colspan="2"><?php echo $data['Checkout']['company_name'];?></td>
     </tr> 
     <tr><td colspan="4">Customer Comments</td></tr>
     <tr>
        <td colspan="4"><?php echo $data['Checkout']['comments'];?></td>
     </tr>   
     <tr><td colspan="4"><strong>Order Detail</strong></td></tr>
     <tr><td colspan="4">
    	<table border="0" style="width: 250px;">
                       <?php 
					   			$sub_tot=0;
								$del_charge=0;
								$total=0;
					   			$cart_count = $session->read('Cart');
								//pr($cart_count);
								if(is_array($cart_count) && count($cart_count)>0)
								{
									foreach($cart_count as $items)
										{
											foreach($items as $key=>$item)
											{
												//pr($item);
												if(is_numeric($key))
												{?>
												<tr>
													<td nowrap="nowrap" style="vertical-align: top; text-align: right; padding: 0px 3px; width: 22px;"><strong><?php echo $item['name'];?></strong>( <?php echo $item['quan'];?> x <?php echo $number->format($item['price'],array('places'=>2));?>)</td>
													<td style="vertical-align: top; text-align: right; padding: 0px; width: 65px;"><?php $price=$item['price']*$item['quan'];echo $number->format($price,array('places'=>2));?></td>
												</tr>
												<?php $sub_tot+=$price;
                                                }
												else
												{
													$del_charge=$items['delivery_charge'];
												}
											}
										}
								}?>
                                <tr><td colspan="2"><div class="totalArea thinArea">
            <div style="float: right; width: 252px; margin-bottom: 6px;" id="cartSummaryTotal_subTotal">
            <div style="float: right; text-align: right; width: 65px;"><?php echo $number->format($sub_tot,array('places'=>2));?></div>
            <div style="float: right; display: inline; text-align: right;">Sub-total</div>
            </div>
            <div style="float: right; width: 252px; margin-bottom: 6px;" id="cartSummaryTotal_deliveryFee2">
            	<div style="float: right; text-align: right; width: 65px;"><?php echo $number->format($del_charge,array('places'=>2));?></div>
                <div style="float: right; display: inline; text-align: right;">Delivery Fee</div>
           	</div>
            <div style="float: right; width: 252px; margin-bottom: 6px;" id="cartSummaryTotal_orderTotal">
            <div style="float: right; text-align: right; width: 65px;"><?php echo $number->format($total=$sub_tot +$del_charge,array('places'=>2));?></div>
            <div style="float: right; display: inline; text-align: right;">Order total</div>
            </div>
            <div class="contentEnd"></div>
            <div class="contentEnd"></div>
                <div style="float: right; width: 252px; margin-top: 20px;" id="cartSummaryTotal_total">
                    <div style="float: right; text-align: right; width: 65px;"><?php echo $number->format($total,array('places'=>2));?></div>
                    <div style="float: right; display: inline; text-align: right;">Total Inc GST</div>
                </div>
                <div class="contentEnd"></div>
            </div></td></tr>
                    </table>
    </td></tr> 
    <tr><td colspan="4"><p><b>Thanks<br />Admin</b></p></td></tr>
</table>