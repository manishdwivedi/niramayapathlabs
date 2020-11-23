<style>
	.rupeesB{
		color:black !important;
	}
	.article_in_inner{background-color: #eee;}
	label{line-height: 3.5em; cursor: pointer;}

	#ConfirmBook{
		border-radius: 3px;
	    color: #fff;
	    display: block;
	    font-size: 17px;
	    font-weight: 700;
	    height: 40px;
	    line-height: 40px;
	    text-align: center;
	    text-decoration: none;
	    width: 120px;
	    background: #a0d64a;
	    color: #fff;
	    font-weight: 700;
	    cursor: pointer;
	    border: 1px solid #73b110;	
	}
</style>

</div>
    </div>
		</div>

    <div class="article_in_inner">
		<div class="article_in">
		<div class="preview previewD80">
			<?php
				e($form->create('payment_mode', array('id'=>'order_payment','url'=>"/tests/confirm_booking/$total_cost/$req_id",'class'=>'','style'=>'width:100%;')));
			?>
				  
		<div class="LabBtn" style="margin-bottom: 23px;float: unset;"><input type="submit" id="ConfirmBook" class="checkoutbutton" value="Continue"/></div>
		<div class="clr"></div>
		  <div class="actionBtnDiv">
		  		<div class="PriceDetailsMain" style="float: none;padding-bottom: 0px;width:100%;">

			    <div class="PriceDetails paymentGate">
			    	<h2 style="background: #a0d64a;">Select Payment Method</h2>
			        
			        <br>&nbsp;&nbsp;&nbsp;&nbsp;
			        <?php echo $form->hidden('order.discount_code',array('id'=>'orderDiscountCode')); ?>
			        <?php echo $form->hidden('order.type',array('id'=>'orderType','value'=>'razorpay')); ?>
			        <?php echo $form->input('order.payment_method',
			            array(
			                 'div' => false,
			                 'type' => 'radio',
			                 'separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
			                 'legend'=>false,
			                 'error'=>false,
			                 'options' => array('O'=>'<img src="/img/paytm_logo.png"><br>','C'=>'<img src="/img/cod_logo.png"><br><br>'),
			                 'style'=>'width:20px;',
			                 'onClick'=>'',
			                 'class'=>'',
			                 'default'=>'O'
			            )); ?>
			        <?php 
			        // 'OP'=>'<img src="/img/janaid/paytm_logo.png"><br>',
					/*e($form->submit('frontend/confirm_booking_button.jpg',array('id'=>'ConfirmBook','class'=>'class="btn"','div'=>false, 'style'=>'vertical-align:middle;margin-left:50px;padding-bottom:10px;')));*/ ?>

			    </div>
				
				<div class="PriceDetails">
					<h2 style="background: #a0d64a;">Purchase Summary</h2>
				  	<ul id="" style="font-weight:600;">
						<li>Total Price For (<?php echo $test_cart_count; ?> tests)  <div class="rupeesB"><i class="fa fa-inr"></i> <?php echo $test_amt; ?></div></li>
						<li style="padding: 0 0 0;">
							<ul>
							<?php $count = 1 ; 
							foreach($my_cart as $val) {?>
								<li style="font-size:12px;"><?php echo $count.") ".$val['Cart']['test_parameter'];?><div class="rupeesB" style="font-size:12px;"><i class="fa fa-inr"></i> <?php echo $val['Cart']['test_mrp']; ?></div></li>
							<?php $count++; } ?>
							</ul>
						</li>
						<li>Other Charges  <div class="rupeesB"><i class="fa fa-inr"></i> <span id="other_charges"><?php echo $other_charges; ?></span></div></li>
						<li>Discount  <div class="rupeesB"><i class="fa fa-inr"></i> <span id="discountd"><?php echo $discount_amt; ?></span></div></li>
						<li>Voucher  <div class="rupeesB"><i class="fa fa-inr"></i> <span id="voucherd"><?php echo $voucher_amount; ?></span></div></li>
						<li class="borderB totalAmount">Total Amount to be Paid <div class="rupeesB redColour"><i class="fa fa-inr"></i> <span id="total_amt"><?php echo $total_cost; ?></span></div></li>
					</ul>
				</div>
			</div>
        </div>
        <div class="LabBtn" style="padding-top: 23px;float: left;">
			<input type="submit" id="ConfirmBook" class="LabBtn" value="Continue"/>
		</div>
		<?php
		   e($form->end());
		?>
	</div>
</div>
<div class="clr"></div>
<br><br>