<?php ?>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
	$(function() {
	    $(".datepicker").datepicker({
	    	minDate: '-7D',
			maxDate: '+30D',
	        dateFormat: 'dd-mm-yy'
	    });
	});
	function getcitystate()
	{
		var pin = $('#pincode').val();
		if(pin.length==6)
		{
			document.getElementById("msg11").innerHTML="";
			jQuery.ajax({
				type:'GET',
				url:siteUrl+'tests/getcitystate?pin='+pin,
				success: function(response) {
				console.log(response["error"]);
					if(response["error"]!="")
					{
						document.getElementById("msg11").innerHTML=response["error"];
						$('#make_payment').hide();
					}
					else
					{
						$('#make_payment').show();
					}
				},
				 dataType:"json"
			});
			
		}
		else{
			$('#make_payment').hide();
			document.getElementById("msg11").innerHTML="Please Enter valid Pincode";
		}
	}

	function voucher_amt()
	{
		var voucher_code = $('#voucher').val();
		
		jQuery.ajax({
			type:'GET',
			url:siteUrl+'tests/apply_voucher?voucher_code='+voucher_code,
			success:function(data){
				console.log(data);
				var test_amt = parseInt($('#t_amt').val());
				var other_charges = parseInt($('#oc_amt').val());
				var parseddata = $.parseJSON(data);
				
				if(parseddata!="error")
				{
					if(parseddata.VoucherMaster.balance_amt > test_amt + other_charges)
					{
						$("#voucherdetail").html("Voucher Balance Amount "+parseddata.VoucherMaster.balance_amt);
						$("#removeVoucher").show();
						$('#voucherd').html(test_amt+other_charges);
						$('#v_amt').val(test_amt+other_charges);
						$('#v_id').val(parseddata.VoucherMaster.voucher_code);
						$('#v_t_amt').val(parseddata.VoucherMaster.balance_amt);
						$('#total_amt').html(0);
						//$('#t_amt').val(0);
					}
					
					if(parseddata.VoucherMaster.balance_amt < test_amt + other_charges)
					{
						$("#voucherdetail").html("Voucher Balance Amount "+parseddata.VoucherMaster.balance_amt);
						$("#removeVoucher").show();
						$('#voucherd').html(parseddata.VoucherMaster.balance_amt);
						$('#v_id').val(parseddata.VoucherMaster.voucher_code);
						$('#v_amt').val(parseddata.VoucherMaster.balance_amt);
						$('#v_t_amt').val(parseddata.VoucherMaster.balance_amt);
						$('#total_amt').html((test_amt + other_charges)-parseddata.VoucherMaster.balance_amt);
						//$('#t_amt').val(parseddata.VoucherMaster.balance_amt  - test_amt + other_charges);
					}
					$('#discount').val("");
					$('#discountd').html(0);
					$('#dis_amt').val(0);
					$('#dis_id').val("");
					$("#discountdetail").html("");
					$("#removeDiscount").hide();
				}
				else
				{
					$("#voucherdetail").html("Invalid Voucher Code");
				}
			}
		});
	}
	
	function discount_amt()
	{
		var test_amt = parseInt($('#t_amt').val());
		var dis_amt = parseInt($('#dis_amt').val());
		var discount_code = $('#discount').val();
		var other_charges = parseInt($('#oc_amt').val());
		
		console.log(discount_code);
		
		jQuery.ajax({
			type:'GET',
			url:siteUrl+'tests/discount_info_only?discount_code='+discount_code+'&tot_cost='+test_amt,
			success:function(data){
				console.log(data);		
				var parseddata = $.parseJSON(data);
				if(parseddata.disc_info.success=="success")
				{
					$("#discountdetail").html(parseddata.disc_info.disc_desc);
					$("#removeDiscount").show();
					var discount_amt = test_amt - parseddata.disc_info.final_amt;
					$('#dis_amt').val(discount_amt);
					$('#dis_id').val(parseddata.disc_info.discount_id);
					$('#discountd').html(discount_amt);
					$('#total_amt').html(parseddata.disc_info.final_amt + other_charges-dis_amt);
					
					$('#voucher').val("");
					$('#v_id').val("");
					$('#voucherd').html(0);
					$('#v_amt').val(0);
					$("#voucherdetail").html("");
					$("#removeVoucher").hide();
				}
				else
				{
					$("#discountdetail").html("Invalid Discount Coupon");
					var discount_amt = test_amt - parseddata.disc_info.final_amt;
					$('#dis_amt').val(0);
					$('#dis_id').val("");
					$('#discountd').val(0);
					$('#total_amt').html(test_amt+dis_amt);
				}
			}
		});
	}
	
	function report_amt()
	{
		var voucher_amt = $('#v_t_amt').val();
		var dis_amt = parseInt($('#dis_amt').val());
		
		if($('#ReportCharge').attr('checked'))
		{
			var test_amt = parseInt($('#t_amt').val());
			var other_charges = parseInt($('#oc_amt').val());
			
			var final_tot_cost = parseInt(test_amt+other_charges+50);
			
			var rep_div = '';
			if(voucher_amt>final_tot_cost)
			{
				$('#other_charges').html(50);
				$('#total_amt').html(0);
				$('#oc_amt').val(50);
				$('#voucherd').html(final_tot_cost);
				$('#v_amt').val(final_tot_cost);
			}
			
			if(voucher_amt<final_tot_cost)
			{
				$('#other_charges').html(50);
				$('#total_amt').html(final_tot_cost-voucher_amt-dis_amt);
				$('#oc_amt').val(50);
				$('#voucherd').html(voucher_amt);
				$('#v_amt').val(voucher_amt);
			}
		}
		else
		{
			var test_amt = parseInt($('#t_amt').val());
			var other_charges = parseInt($('#oc_amt').val());
			var voucher = $('#v_amt').val();
			
			var final_tot_cost = parseInt(test_amt);
			
			var rep_div = '';
			
			$('#other_charges').html(0);
			
			if(voucher!=0)
			{
				if(voucher_amt>final_tot_cost)
				{
					$('#total_amt').html((final_tot_cost+50)-voucher);
					$('#voucherd').html(voucher-50);
					$('#v_amt').val(voucher-50);
				}
				
				if(voucher_amt<final_tot_cost)
				{
					$('#total_amt').html((final_tot_cost)-voucher);
					$('#voucherd').html(voucher);
					$('#v_amt').val(voucher);
				}
				
			}
			else
			{
				$('#total_amt').html(final_tot_cost-dis_amt);
				$('#voucherd').html(0);
				$('#v_amt').val(0);
			}
			
			$('#oc_amt').val(0);
		}
	}

	function gender(e)
	{
		$(".gender").prop("checked", false);
		$("#"+e.id).prop("checked", true);
	}
	
	function title(e)
	{
		$(".title").prop("checked", false);
		$("#"+e.id).prop("checked", true);
	}

	function checklength(e,len)
	{
		var datalength = $('#'+e.id).val();
		var check = $('#'+e.id+'mess').length;
		if(datalength.length!=len)
		{
			$('#make_payment').hide();
			if(check==0)
				$("<br><span id='"+e.id+"mess' style='color:red;'>Entered value should be of "+len+" length </span>").insertAfter('#'+e.id);
		}
		else
		{
			$("#"+e.id+"mess").remove();
			$('#make_payment').show();
		}
	}
</script>  
  <div class="article_in_inner">
    <div class="article_in listno">
      <section class="NewpreviewBox">    
      <div class="clr"></div>
      
      <div class="NewpreviewInner">
 	  <form id="patientdetail" method="post">     
		  <div class="webinar_main">
			<?php echo $this->Session->flash(); ?>
			<ul>
			  <li>
				<div class="orderBox">
				  <h2>Patient Details </h2>
				  <div class="informationBox">
					
					<ul>
					  <li>
						<div class="left"></div>
						<div class="right redio_patientDiv"> 
						<table class="radiobtnp redio_patientDiv">
										<tr>
										<td><input name="title" id="mr" class="title" onclick="title(this)" type="radio" name="prefixN" value="1" checked="checked" /><label>Mr.</label></td>
										<td><input name="title" id="ms" onclick="title(this)" class="colorchnge title" type="radio" name="prefixN" value="2" /><label>Ms.</label></span></td>
										<td><input name="title" id="mrs" onclick="title(this)" class="colorchnge title" input type="radio" name="prefixN" value="3" /><label>Mrs.</label></span></td>
									</tr>
								 </table>
						</div>
					  </li>
					  <li>
						<div class="left">Patient Name </div>
						<div class="right"> 
						  <input name="firstname" type="text" value="<?php if(isset($prescription['PrescriptionMaster']['first_name'])) { echo $prescription['PrescriptionMaster']['first_name']; }?>" maxlength="25" id="txtFName" class="field1" placeholder="First Name" required />
						   <input name="lastname" type="text" value="<?php if(isset($prescription['PrescriptionMaster']['last_name'])) { echo $prescription['PrescriptionMaster']['last_name']; }?>" maxlength="25" id="txtLName" class="field1" placeholder="Last Name" required />
						  
						</div>
					  </li>
					  <li>
						<div class="left">Gender</div>
						<div class="right">
							<table class="radiobtnp">
								<tr>
									<td><input name="gender" class="gender" id="male" type="radio" value="1" onclick="gender(this)" <?php if(isset($prescription['PrescriptionMaster']['gender']) && $prescription['PrescriptionMaster']['gender']==1) { echo 'checked'; }?>/><label>Male</label></td>
									<td><span class="colorchnge"><input name="gender" class="gender" id="female" type="radio" value="2" onclick="gender(this)" <?php if(isset($prescription['PrescriptionMaster']['gender']) && $prescription['PrescriptionMaster']['gender']==2) { echo 'checked'; }?> /><label>Female</label></span></td>
								</tr>
							</table>
						
						</div>
					  </li>
					  <li>
						<div class="left">Email</div>
						<div class="right">
						  <input name="email" type="text" value="<?php if(isset($prescription['PrescriptionMaster']['email'])) { echo $prescription['PrescriptionMaster']['email']; }?>" maxlength="50" class="field1" placeholder="Email" required />
						  
						</div>
					  </li>
					  <li>
						<div class="left">Age</div>
						<div class="right">
						  <input name="age" type="number" value="<?php if(isset($prescription['PrescriptionMaster']['age'])) { echo $prescription['PrescriptionMaster']['age']; }?>" maxlength="10"  class="DOB" placeholder="Enter Age"  required />
						</div>
					  </li>
					  <li>
						<div class="left">Mobile No</div>
						<div class="right">
						  <input name="mobile" text="Mobile No *" class="field2" value="" placeholder="+91" />
						  <input name="mobile" type="text" value="<?php if(isset($prescription['PrescriptionMaster']['contact_number'])) { echo $prescription['PrescriptionMaster']['contact_number']; }?>" maxlength="10" class="field3" placeholder="Enter Mobile No." required />
						  
						</div>
					  </li>
					  <li>
						<div class="left" >Address</div>
						<div class="right">
						   <textarea name="address" value="" rows="5" class="field1" placeholder="Location" required style="width:260px;"></textarea>
						</div>
					  </li>
					  <li>
						<div class="left" >Pincode</div>
						<div class="right">
						   <input id="pincode" name="pincode" type="number" value="" maxlength="6" class="field1" placeholder="Pincode" required onkeyup="getcitystate();" />
						   <div id="msg11" style="color:#FF0000; font-size:12px;"></div>
						</div>
					  </li>
					  <li>
						<div class="left">Preferred Date </div>
						<div class="right">
						  <input name="date" value="" class="DOB datepicker" placeholder="Enter Preferred Date" required />
						</div>
					  </li>
					  <li>
						<div class="left">Preferred Slot </div>
						<div class="right">
						  <select name="time" style="width:270px;">
							<?php foreach($timelab as $key=>$val) {?>
								<option value="<?php echo $key;?>" ><?php echo $val;?></option>
							<?php } ?>
						  </select>
						</div>
					  </li>
 					  <li style="min-height: 0px;margin-top: 10px;">
					  	<hr>
					  </li>
					  <li style="min-height: 30px;text-align: center;padding-top: inherit;">
					  	<h3>Required Documents</h3>
					  </li>
						<?php
						if(!empty($doc_list)){ 
							foreach($doc_list as $val) {
								?>
								<li>
								<div class="left" style="width: 200px;"><?php echo $val['document_type_master']['name']; ?></div>
								<div class="right"> 

								<?php 
									$type = "";
									$length = !empty($val['document_type_master']['length'])? $val['document_type_master']['length']:"";
									$accept="";
									if($val['document_type_master']['doc_type']=="doc")
									{
										echo $form->file('DocumentTypeMaster.'.str_replace(" ","_",$val['document_type_master']['name']),array('class'=>'input-text','style'=>'width:200px;','accept'=>'.doc,.docx,.xls,.xlsx,.pdf,.PDF','required'));
									}
									if($val['document_type_master']['doc_type']=="number")
									{
										echo $form->text('DocumentTypeMaster.'.str_replace(" ","_",$val['document_type_master']['name']), array('type'=>'number','class'=>'field1','style'=>'width:200px;','onkeyup'=>'checklength(this,'.$length.')'));
									}
									if($val['document_type_master']['doc_type']=="text")
									{ 
										echo $form->text('DocumentTypeMaster.'.str_replace(" ","_",$val['document_type_master']['name']), array('type'=>'text','class'=>'field1','style'=>'width:200px;','onkeyup'=>'checklength(this,'.$length.')'));
									}
								?>
								</div>
							  </li>
							<?php } 
						}
						else
						{?>
							<li>No Document Required</li>
						<?php }
						?>
					</ul>
				  </div>
				</div>
			  </li>
			</ul>
		  </div>
		  
		  <div>
			<div class="PriceDetailsMain">
				<div class="PriceDetails" style="font-size:13px;">
					<ul id="">
						<b>Have Voucher</b>
						<li>
							<input name="voucher" type="text" value="" maxlength="25" id="voucher" class="field1" placeholder=" Voucher " style="height:25px;"/>
							<input type="button" class="btn" value="Apply" style="display:inline;margin:0px;height:32px;width: 50px;line-height: 34px;font-size: 11px;" onclick="voucher_amt();"/>
							<br><label style="color:red;font-size:11px;" id="voucherdetail"></label><a href="#" style="display:none;font-size:11px;" id="removeVoucher" > Remove</a>
						</li>
						<b>Have Discount Code</b>
						<li>
							<input name="discount" type="text" value="" maxlength="25" id="discount" class="field1" placeholder=" Discount " style="height:25px;"/>
							<input type="button" class="btn" value="Apply" style="display:inline;margin:0px;height:32px;width: 50px;line-height: 34px;font-size: 11px;" onclick="discount_amt();"/>
							<br><label style="color:red;font-size:11px;" id="discountdetail"></label><a href="#" style="display:none;font-size:11px;" id="removeDiscount" > Remove</a>
						</li>
						<li style="font-size:12px;">
							<input type="checkbox" value="1" id="ReportCharge" onclick="report_amt();" /> Rs. 50 Courier Charges (for report delivery acros India with in 48 to 72 hrs for final report published)<br />
						</li>
  				    </ul>
				</div>
				<div class="PriceDetails">
					  <h2>Price Details</h2>
					  <ul id="">
							<li>Total Price For (<?php echo $test_cart_count; ?> tests)  <div class="rupeesB">&#8377; <?php echo $total_amt; ?></div></li>
							<li style="padding: 0 0 0;">
								<ul>
								<?php $count = 1 ; 
								foreach($testname as $val) {?>
									<li style="font-size:12px;"><?php echo $count.") ".$val[0];?><div class="rupeesB" style="font-size:12px;">&#8377; <?php echo $val[1]; ?></div></li>
								<?php $count++; } ?>
								</ul>
							</li>
							<li>Other Charges  <div class="rupeesB">&#8377; <span id="other_charges">0</span></div></li>
							<li>Discount  <div class="rupeesB">&#8377; <span id="discountd">0</span></div></li>
							<li>Voucher  <div class="rupeesB">&#8377; <span id="voucherd">0</span></div></li>
							<li class="borderB totalAmount">Total Amount to be Paid <div class="rupeesB redColour"> &#8377; <span id="total_amt"><?php echo $total_amt; ?></span></div></li>
						  </ul>
				</div>
				<div class="clr"></div>
				<input type="hidden" name="other_charges" id="oc_amt" value="0"/>
				<input type="hidden" name="discount" id="dis_amt" value="0"/>
				<input type="hidden" name="discountid" id="dis_id" value=""/>
				<input type="hidden" name="voucher" id="v_amt" value="0"/>
				<input type="hidden" name="voucherid" id="v_id" value=""/>
				<input type="hidden" name="voucher_total" id="v_t_amt" value="0"/>
				<input type="hidden" name="total" id="t_amt" value="<?php echo $total_amt; ?>"/>
				<input type="submit" id="make_payment" class="btn" value="Make Payment"/>
			</div>
		  </div>
	  </form>
      </div>
      
  </section>
  </div>
  </div>
   <div class="clr"></div>
<script>
$( "#removeVoucher" ).click(function( event ) {
	event.preventDefault();
	var voucher_amt = parseInt($("#v_amt").val());
	var other_charges = parseInt($('#oc_amt').val());
	var total_amt = parseInt($("#t_amt").val());
	
	var amt = total_amt+other_charges;
	
	$("#voucherd").html(0);
	$("#total_amt").html(amt);
	$('#voucher').val("");
	$('#v_id').val("");
	$('#v_amt').val(0);
	$('#v_t_amt').val(0);
	$("#voucherdetail").html("");
	$("#removeVoucher").hide();
});

$( "#removeDiscount" ).click(function( event ) {
	event.preventDefault();
	var dis_amt = parseInt($("#dis_amt").val());
	var other_charges = parseInt($('#oc_amt').val());
	var total_amt = parseInt($("#t_amt").val());
	
	var amt = total_amt+other_charges;
	
	$("#discountd").html(0);
	$("#total_amt").html(amt);
	$('#discount').val("");
	$('#dis_id').val("");
	$('#dis_amt').val(0);
	$("#discountdetail").html("");
	$("#removeDiscount").hide();
});
</script>
<?php echo $javascript->link('light/jquery.lightbox_me') ?>
<?php echo $javascript->link('light/slider') ?>