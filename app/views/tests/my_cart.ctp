 <?php /* MyCart */ ?>  
    <div class="book_a_test_cart">
        <div class="cardDivSecond">
            <ul>
                <li class="active"><a href="/tests/my_cart">1</a><h4>MY CART</h4></li>
                <li class="active"><a href="login.php">2</a><h4>LOGIN</h4></li>
                <li><a href="javascript:void(0)">3</a><h4>PATIENT DETAILS</h4></li>
                <li class="list"><a href="javascript:void(0)">4</a><h4>ORDER PREVIEW</h4></li>
            </ul>
        </div>
        <div class="clr"></div>
       
        <div class="order_preview newclass" id="divOrder">
            
            <div class="clr"></div>
            <div id="CartGrup">
                <div class="previewOr">
                    <div class="inner">
                        <h2>Order Preview</h2>
                        <h3>My Cart (<span id="cartATag2">2</span>)</h3>
                        <div class="locationpre">Location - <span id="spanCity">Delhi</span></div>
                        <div class="previewinnerBox">
                            <ul class="dektop">
                                <li class="imgPac"></li>
                                <li class="packOr"><strong>Package/Test Name</strong></li>
                                <li class="untill"><strong>Reporting</strong></li>
                                <li class="untill"><strong>Unit Price (<span>&#8377;</span>)</strong> </li>
                                <li class="untill"><strong>Total</strong></li>
                            </ul>
                            <div class="clr"></div>
                            <div id="CartList">
                                <?php if(count($my_cart) > 0){ $total_cart_amt=0; ?>
                                <?php foreach($my_cart as $key => $val){?>
                                <ul>
                                    <li class="imgPac"><?php echo $html->link($this->Html->tag('i', '', array('class' => 'fa fa-times')), array('controller'=>'tests','action'=>'delete_cart_test',base64_encode($val['Cart']['test_id']),base64_encode($val['Cart']['test_code']),base64_encode($val['Cart']['test_parameter']),base64_encode($val['Cart']['test_reporting']),base64_encode($val['Cart']['test_mrp'])), array('escape' => false));?></li>

                                    <li class="imgPacMobile"><?php echo $html->link( 
                                    	$this->Html->image('/img/img/delete.png',array('alt'=>'Niramaya', 'class'=>'imgMobile')),
                                         array('controller'=>'tests','action'=>'delete_cart_test',base64_encode($val['Cart']['test_id']),base64_encode($val['Cart']['test_code']),base64_encode($val['Cart']['test_parameter']),base64_encode($val['Cart']['test_reporting']),base64_encode($val['Cart']['test_mrp'])), array('escape' => false));?>
                                    </li>
                                    <li class="packOr"><?php echo $val['Cart']['test_code']." - ".$val['Cart']['test_parameter'];?></li>
                                    <li class="untill"><?php echo $val['Cart']['test_reporting'];?></li>
                                    <li class="untill"><span class="rupeeprev"><span>&#8377;</span><?php echo $val['Cart']['test_mrp'];?></span></li>
                                    <li class="totalpre"><span class="rupeeprevRed"><span>&#8377;</span><?php echo $val['Cart']['test_mrp'];?></span></li>
                                </ul>
                                <?php $total_cart_amt+=$val['Cart']['test_mrp'] ;} ?>
                               
                            </div>
                            
							<!--<ul class="list">
                                <li class="imgPac">&nbsp;</li>
                                <li class="packOrAdd">&nbsp;</li>
                                <li class="untill">&nbsp;</li>
                                <li class="totalpre mobtotal">Discount</li>
                                <li class="totalpre mobtotal"><span class="rupeeprevRed" id="TotAm"><span>&#8377;</span><?php echo $discount; ?></span>
                                </li>
                            </ul>-->
							
                            <ul class="list">
                                <li class="imgPac">&nbsp;</li>
                                <li class="packOrAdd"><a href="/tests/search">+ Add More Tests</a></li>
                                <li class="untill">&nbsp;</li>
                                <li class="totalpre mobtotal">Total Amount to be paid</li>
                                <li class="totalpre mobtotal"><span class="rupeeprevRed" id="TotAm"><span>&#8377;</span><?php echo $total_cart_amt - $discount; ?></span>
                                </li>
                            </ul>
                            
                            <?php
                           } else {?>
                          	<ul>
                                <li class="">Your Cart is Empty</li>
                                
                            </ul>
                           <?php }?>
                            <div class="priceDetail">
                                <h4>Price Details</h4>
                                <div class="greyPr">
                                    <h5>Total Cost <span class="winner" id="TotAm0"><span>&#8377;</span><?php echo $total_cart_amt; ?></span></h5>
                                    <h5>Phlebotomy Charges <span class="winner" id="ComnHCC2"><span>&#8377;</span>0</span></h5>
									<h5>Discount <span class="winner" id="ComnHCC2"><span>&#8377;</span><?php if(isset($discount)){ echo $discount; } else { echo 0; } ?></span></h5>
                                    <h6>Total Amount to be paid <span class="winner" id="TotAm2"><span>&#8377;</span><?php echo $total_cart_amt - $discount; ?></span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clr"></div>
                <div class="codeOr">
                    <div class="inner">
                        <div class="leftcode">
                        <?php if(!empty($duplicate_test) && $duplicate_test == 'yes') {?>
                        <span style="font: normal 16px italic;color:#FF0000;">This test is already added in your cart.</span>
                        <?php }?>
                        </div>
                        <div class="fixedM">
                            <div class="rightcode">
                                <a href="/tests/make_payment">
									<input type="submit" name="" value="Checkout" class="confirmDiv">
								</a>	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clr"></div>
        </div>
        <div style="clear:both"></div>
</div>
<div class="clr"></div>