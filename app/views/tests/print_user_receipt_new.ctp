<div class="wrapper">
    <div class="container">
        <table width="700px" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
            <tbody>
                <tr>
                    <td style="padding:30px 0px;">
                        <div class="logo"><img src="<?php echo SITE_URL;?>img/frontend/nhcare_new_logo.png" title="Niramaya Pathlab"/></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="address" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                        <tbody>
                            <tr>
                                <td style="padding-left:25px;">
                                    <h4>Customer Details</h4>
                                    <p><?php echo $req_detail['Health']['name']; ?>, <?php echo ($req_detail['Health']['gender']==1) ? 'Male':'Female'; ?>, <?php echo $req_detail['Health']['age']." Yrs"; ?></p>
                                    <!--<p><?php echo !empty($req_detail['Health']['address']) ? $req_detail['Health']['address'] : $req_detail['Health']['address1']; ?></p>-->
                                    <p>Phone: <?php echo $req_detail['Health']['landline']; ?></p>
                                </td>
                                <td style="width:50%;">
                                    <h4 style="margin-top:-22px;"><?php echo $pcc_list['Lab']['pcc_name']; ?></h4>
                                    <?php if(isset($pcc_list['Lab']['id']) && !empty($pcc_list['Lab']['id'])){ ?>
                                        <!--<p><?php echo $pcc_list['Lab']['pcc_name']; ?></p>-->
                                        <!--<p><?php echo $pcc_list['Lab']['pcc_address']; ?></p>-->
                                        <p>Phone: <?php echo $pcc_list['Lab']['pcc_contact']; ?></p>
                                    <?php } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
                <tr style="margin-top:20px; display:block;">
                    <td style="width:700px;">
                        <table class="donation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                        <tbody>
                            <tr>
                                <td style="padding-left:25px;">
                                    <h4>Net Testing Charges</h4>
                                    <ul>
                                        <li>Order ID: <span><?php echo $dec_order_id;?></span></li>
                                        <li>Order Date: <span><?php echo $req_detail['Health']['sample_date1'];?></span></li> 
                                    </ul>
                                </td>
                                <td style="background:#2e86a8; width:50%;">
                                    <div class="price-div">
                                        <div class="amount"><span class="inr-icon">&#x20B9;</span><?php echo $req_detail['Health']['total_amount'];?></div>
                                        <p>Net Payable amount after discounts</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
                <tr style=" display:block; margin-top:15px; margin-bottom: 10px;">
                    <td style=" width:700px; padding:0px 20px 0px 20px;">
                        <table class="details" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                            <tbody>
                                <tr class="divider">
                                    
                                        <th style="width:300px">Test Name</th><br>
                                        <th>Test Code</th>
                                        <th>Test MRP</th>
                                        <th>Qty</th>
                                        <th>Test MRP</th>
                                    
                                </tr>
                                <?php $k = 1;foreach($req_detail['Health']['tests'] as $key => $val) {?>
                                <tr class="values">
                                    <td style="width:300px"><?php echo $val['test_parameter']; ?></td>
                                    <td><?php echo $val['test_code']; ?></td>
                                    <td><span class="icon-rup">&#x20B9;</span> <?php echo $val['test_mrp'];?></td>
                                    <td>1</td>
                                    <td><span class="icon-rup">&#x20B9;</span> <?php echo $val['test_mrp'];?></td>
                                </tr>
                                <?php $k++;}?>
                                
                                
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0px 24px 0px 20px;">
                        <table class="subtotal" width="49%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; float:right;">
                            <tbody>
                                <tr>

                                    <td style="width:100px">Sample Collection Charges</td>
                                    <td><span class="icon-rup"></span>Free</td>
                                    
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom:10px;">Subtotal</td>
                                    <td style="padding-bottom:10px;"><span class="icon-rup">&#x20B9;</span><?php echo $req_detail['Health']['grand_total'];?></td>
                                </tr>
                                <tr style="">
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom:10px;">Discounts (if any)</td>
                                    <td style="padding-bottom:10px;"><span class="icon-rup">&#x20B9;</span>
                                    <?php 
                                    if($req_detail['Health']['discount_id'] != 0)
                                        echo $req_detail['Health']['discount_name'];
                                    if($req_detail['Health']['add_discount'] == 'Yes')
                                        echo $req_detail['Health']['discount_amount'];
                                    ?>
                                                                
                                </tr>
                                <tr>
                                    <td style="padding-top:10px;">Total Net payable</td>
                                    <td style="padding-top:10px;"><span class="icon-rup">&#x20B9;</span> <?php echo $req_detail['Health']['total_amount'];?></td>
                                </tr>
                                
                                <tr>
                                    <td style="padding-top:10px;">Total Payment Received</td>
                                    <td style="padding-top:10px;"><span class="icon-rup">&#x20B9;</span> <?php echo $req_detail['Health']['total_rec_amt'];?></td>
                                </tr>
                                <tr>
                                    <td style="padding-top:10px;">Balance Due</td>
                                    <td style="padding-top:10px;"><span class="icon-rup">&#x20B9;</span>
                                        <?php 
                                        if($req_detail['Health']['received_amount'] == 0)
                                        {
                                            echo $req_detail['Health']['total_amount'];
                                        }
                                        else
                                        {
                                            echo $req_detail['Health']['balance_amount'];
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                
                <tr style=" display:block; margin-top:15px; border-top:4px solid #2E86A8;">
                    <td>
                        <table class="footer" width="100%" cellpadding="0" cellspacing="0" style=" border-collapse:collapse;">
                            <tbody>
                                <tr>
                                    <td>
                                        <ul class="footer-list">
                                            <li><strong>Payment method</strong></li>
                                            <li>For assistance call : +91-9555-009-009</li>
                                            <li>Email : helpline@niramayapathlabs.com</li>
                                        </ul>
                                    </td>
                                    <td>
                                        <p><strong>Niramaya Pathlabs Pvt. Ltd.</strong></p>
                                        <p>Lab & Corporate Office – B4, New Multan Nagar, Rothak Road, Paschim Vihar, New Delhi 110056 <br/>CIN- U85100DL2014PTC264599 I Contact : 011-42870035,E-Mail : accounts@niramayapathlabs.com</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
</div>

<style type="text/css">
@charset "utf-8";
/* CSS Document */

*{ margin:0px; padding:0px; box-sizing:border-box;}
body{ margin:0px; padding:0px; box-sizing:border-box; color:#757575; font-family:Arial, Helvetica, sans-serif; background:#f7f7f7;}

h1, h2, h3, h4, h5, h6{ font-weight:normal;}
img {  height: auto;  width: 100%;}

.wrapper {  height: auto;  overflow: hidden;  width: 100%;}
.wrapper .container{ width:700px; height:auto; margin:0 auto; background:#fff; overflow:hidden;}

.logo {  height: 100px;  margin: 0 auto;  text-align: center;  width: 700px;}
.logo img {  height: 100%;  width: auto;}

.address h4 {  font-size: 19px;  font-weight: bold;  margin-bottom: 5px;}
.address tr td p{ line-height:22px; font-size: 14px;}

.donation tr td h4{ font-size:27px; color:#757575; font-weight:bold; font-family:Arial, Helvetica, sans-serif;}
.donation tr td ul li {  line-height: 24px;  list-style: outside none none;}

.price-div {  color: #fff;  height: 155px;  padding: 0 25px 0 40px;}
.price-div .amount {  font-family: arial; font-size: 47px;  font-weight: bold;}
.price-div .amount span{ margin-right:10px;}
.price-div .amount + p {  font-size: 18px;}

.divider{ border-bottom:4px solid #a4a4a4; width:100%;}
.divider th{ padding-bottom:10px; text-align:left; padding-right:20px;}
.divider th:last-child{ text-align:right; padding-right:0px;}

.values {  border-bottom: 1px solid #e7e7e7;}
.values td{ padding:10px 0px; padding-right:20px;}
.values td:last-child{ text-align:right; padding-right:0px;}

.subtotal tr td:last-child{ text-align:right;}


ol.list {  padding-left: 24px;}
.list > li {  line-height: 22px;}

.footer tr td{ text-align:center; width:50%;   line-height: 20px;  padding: 5px 47px;}
.footer-list li {  list-style: outside none none;}

.line{ width:100%; height:auto; border-bottom:3px solid #e7e7e7;}


</style>

<?php 
echo "<script>";
echo "window.print();";
echo "</script>";
?>