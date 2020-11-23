<?php echo $javascript->link('jquery-1.4.4'); ?>
<script type="text/javascript">
function report_amt()
{
	if($('#ReportCharge').attr('checked'))
	{
		if($('#ReportCharge').attr('checked'))
		{
			var tot_cost = document.getElementById('TotAmt').innerHTML;
			var t = parseInt(tot_cost);
			var final_tot_cost = parseInt(t+50);
			var rep_div = '';
			rep_div +='<span class="WebRupee">Rs. </span><span id="TotAmt">'+final_tot_cost+'</span>';
			
			var cnf_book = '<a href="<?php echo SITE_URL;?>tests/confirm_booking/'+final_tot_cost+'/<?php echo $req_id;?>/Yes"><?php echo $html->image('frontend/confirm_booking_button.jpg');?></a>';
			
			$('#TotalCost').html(rep_div);
			$('#ChargeDesc').show();
			$('#ConfirmBook').html(cnf_book);
		}
	}
	else
	{
		if($('#DiscCode').attr('checked'))
		{
			var get_code = document.getElementById('HealthDiscountCode').value;
			var tot_cost = document.getElementById('TotAmt').innerHTML;
			jQuery.ajax({
			type:'GET',
			url:siteUrl+'tests/discount_info_id?discount_code='+get_code,
			dataType:'json',
				success:function(data){
					if(data.disc_info.success == 'success')
					{
						var f = parseInt(tot_cost);
						var d = parseInt(f-50);
			
						var rep_div = '';
						rep_div +='<span class="WebRupee">Rs. </span><span id="TotAmt">'+d+'</span>';
			
						var cnf_book = '<a href="<?php echo SITE_URL;?>tests/confirm_booking/'+d+'/<?php echo $req_id;?>/No/'+data.disc_info.discount_id+'"><?php echo $html->image('frontend/confirm_booking_button.jpg');?></a>';
						$('#ConfirmBook').html(cnf_book);
						$('#TotalCost').html(rep_div);
						jQuery('#ShowProcess').hide();
					}
				},
				beforeSend:function(){						
					jQuery('#ShowProcess').show();
				}
			});
		}
		else
		{
			var tot_cost = document.getElementById('TotAmt').innerHTML;
			var t = parseInt(tot_cost);
			var final_tot_cost = parseInt(t-50);
			var rep_div = '';
			rep_div +='<span class="WebRupee">Rs. </span><span id="TotAmt">'+final_tot_cost+'</span>';
		
			var cnf_book = '<a href="<?php echo SITE_URL;?>tests/confirm_booking/'+final_tot_cost+'/<?php echo $req_id;?>/No"><?php echo $html->image('frontend/confirm_booking_button.jpg');?></a>';
		
			$('#TotalCost').html(rep_div);
			$('#ChargeDesc').hide();
			$('#ConfirmBook').html(cnf_book);
		}
	}
}

function set_disc()
{
	if($('#ReportCharge').attr('checked'))
	{
		var get_code = document.getElementById('HealthDiscountCode').value;
		if(get_code != '')
		{
			var tot_cost = '<?php echo $total_cost;?>';
			jQuery.ajax({
			type:'GET',
			url:siteUrl+'tests/discount_info_only?discount_code='+get_code+'&tot_cost='+tot_cost,
			dataType:'json',
				success:function(data){
					if(data.disc_info.success == 'success')
					{

						var rep_div = '';
						var f = parseInt(data.disc_info.final_amt);
						var g = parseInt(f+50);
						rep_div +='<span class="WebRupee">Rs. </span><span id="TotAmt">'+g+'</span>';
					
						var rep_div_1 = '';
						rep_div_1 +=data.disc_info.disc_desc+'</div>';
						
						if(data.disc_info.disc_type == 'P')
						{
							var rep_div_2 = '';
							rep_div_2 +='<div class="price">'+data.disc_info.less_amt+'</div>';
						}
						if(data.disc_info.disc_type == 'R')
						{
							var rep_div_2 = '';
							rep_div_2 +='<div class="price"><span class="WebRupee">Rs. </span>'+data.disc_info.less_amt+'</div>';
						}
						
						var cnf_book = '<a href="<?php echo SITE_URL;?>tests/confirm_booking/'+g+'/<?php echo $req_id;?>/Yes/'+data.disc_info.discount_id+'"><?php echo $html->image('frontend/confirm_booking_button.jpg');?></a>';
						
						$('#Descr').html(rep_div_1);
						$('#LessAmt').html(rep_div_2);
						$('#TotalCost').html(rep_div);
						$('#ChargeDesc').show();
						$('#DiscountDesc').show();
						$('#ConfirmBook').html(cnf_book);
						jQuery('#NotValidSpan').hide();	
						jQuery('#ShowProcess').hide();
					}
					if(data.disc_info.success == 'notsuccess')
					{
						jQuery('#NotValidSpan').show();	
						jQuery('#ShowProcess').hide();	
					}
				},
				beforeSend:function(){						
					jQuery('#ShowProcess').show();
				}
			});
		}
	}
	else
	{
		var get_code = document.getElementById('HealthDiscountCode').value;
		if(get_code != '')
		{
			var tot_cost = '<?php echo $total_cost;?>';
			jQuery.ajax({
			type:'GET',
			url:siteUrl+'tests/discount_info_only?discount_code='+get_code+'&tot_cost='+tot_cost,
			dataType:'json',
				success:function(data){
					if(data.disc_info.success == 'success')
					{
                                            /*append discount code section for online payment*/
                                            $("#orderDiscountCode").val(get_code);
                                            $("#orderDiscountAmt").val(parseInt(data.disc_info.final_amt));
                                            

						var rep_div = '';
						rep_div +='<span class="WebRupee">Rs. </span><span id="TotAmt">'+data.disc_info.final_amt+'</span>';
					
						var rep_div_1 = '';
						rep_div_1 +=data.disc_info.disc_desc+'</div>';
						
						if(data.disc_info.disc_type == 'P')
						{
							var rep_div_2 = '';
							rep_div_2 +='<div class="price">'+data.disc_info.less_amt+'</div>';
						}
						if(data.disc_info.disc_type == 'R')
						{
							var rep_div_2 = '';
							rep_div_2 +='<div class="price"><span class="WebRupee">Rs. </span>'+data.disc_info.less_amt+'</div>';
						}
						
						var cnf_book = '<a href="<?php echo SITE_URL;?>tests/confirm_booking/'+data.disc_info.final_amt+'/<?php echo $req_id;?>/No/'+data.disc_info.discount_id+'"><?php echo $html->image('frontend/confirm_booking_button.jpg');?></a>';
						
						$('#Descr').html(rep_div_1);
						$('#LessAmt').html(rep_div_2);
						$('#TotalCost').html(rep_div);
						$('#ChargeDesc').hide();
						$('#DiscountDesc').show();
						$('#ConfirmBook').html(cnf_book);
						jQuery('#NotValidSpan').hide();	
						jQuery('#ShowProcess').hide();
					}
					if(data.disc_info.success == 'notsuccess')
					{
						jQuery('#NotValidSpan').show();	
						jQuery('#ShowProcess').hide();	
					}
				},
				beforeSend:function(){						
					jQuery('#ShowProcess').show();
				},
			});
		}
	}
}

function discount_code()
{
	if($('#DiscCode').attr('checked'))
	{
		var get_code = document.getElementById('HealthDiscountCode').value;
		if(get_code != '')
		{
			var tot_cost = '<?php echo $total_cost;?>';
			jQuery.ajax({
			type:'GET',
			url:siteUrl+'tests/discount_info_only?discount_code='+get_code+'&tot_cost='+tot_cost,
			dataType:'json',
				success:function(data){
					if(data.disc_info.success == 'success')
					{
						var rep_div = '';
						rep_div +='<span class="WebRupee">Rs. </span><span id="TotAmt">'+data.disc_info.final_amt+'</span>';
					
						var rep_div_1 = '';
						rep_div_1 +=data.disc_info.disc_desc+'</div>';
						
						if(data.disc_info.disc_type == 'P')
						{
							var rep_div_2 = '';
							rep_div_2 +='<div class="price">'+data.disc_info.less_amt+'</div>';
						}
						if(data.disc_info.disc_type == 'R')
						{
							var rep_div_2 = '';
							rep_div_2 +='<div class="price"><span class="WebRupee">Rs. </span>'+data.disc_info.less_amt+'</div>';
						}
						
						var cnf_book = '<a href="<?php echo SITE_URL;?>tests/confirm_booking/'+data.disc_info.final_amt+'/<?php echo $req_id;?>/No/'+data.disc_info.discount_id+'"><?php echo $html->image('frontend/confirm_booking_button.jpg');?></a>';
						
						$('#Descr').html(rep_div_1);
						$('#LessAmt').html(rep_div_2);
						$('#TotalCost').html(rep_div);
						$('#ChargeDesc').hide();
						$('#DiscountDesc').show();
						$('#ConfirmBook').html(cnf_book);
						jQuery('#ShowProcess').hide();
					}
				},
				beforeSend:function(){						
					jQuery('#ShowProcess').show();
				},
			});
		}
		else
		{
			$('#DiscountCode').show();
		}
	}
	else
	{
		if($('#ReportCharge').attr('checked'))
		{
			var get_code = document.getElementById('HealthDiscountCode').value;
			if(get_code != '')
			{
				var tot_cost = document.getElementById('TotAmt').innerHTML;
				jQuery.ajax({
				type:'GET',
				url:siteUrl+'tests/discount_info_uncheck?discount_code='+get_code+'&tot_cost='+tot_cost,
				dataType:'json',
					success:function(data){
						if(data.disc_info.success == 'success')
						{
							var rep_div = '';
							var y = parseInt(data.disc_info.final_amt);
							var z = parseInt(y);
							rep_div +='<span class="WebRupee">Rs. </span><span id="TotAmt">'+z+'</span>';
						
							var rep_div_1 = '';
							rep_div_1 +=data.disc_info.disc_desc+'</div>';
							
							if(data.disc_info.disc_type == 'P')
							{
								var rep_div_2 = '';
								rep_div_2 +='<div class="price">'+data.disc_info.less_amt+'</div>';
							}
							if(data.disc_info.disc_type == 'R')
							{
								var rep_div_2 = '';
								rep_div_2 +='<div class="price"><span class="WebRupee">Rs. </span>'+data.disc_info.less_amt+'</div>';
							}
							
							var cnf_book = '<a href="<?php echo SITE_URL;?>tests/confirm_booking/'+z+'/<?php echo $req_id;?>/Yes"><?php echo $html->image('frontend/confirm_booking_button.jpg');?></a>';
							
							var b = '';
							$('#HealthDiscountCode').val(b);
							
							$('#Descr').html(rep_div_1);
							$('#LessAmt').html(rep_div_2);
							$('#TotalCost').html(rep_div);
							$('#ChargeDesc').show();
							$('#DiscountDesc').hide();
							$('#DiscountCode').hide();
							$('#ConfirmBook').html(cnf_book);
							jQuery('#ShowProcess').hide();
						}
					},
					beforeSend:function(){						
						jQuery('#ShowProcess').show();
					},
				});
			}
		}
		else
		{
			
			var get_code = document.getElementById('HealthDiscountCode').value;
			if(get_code != '')
			{
				var tot_cost = document.getElementById('TotAmt').innerHTML;
				jQuery.ajax({
				type:'GET',
				url:siteUrl+'tests/discount_info_unck?discount_code='+get_code+'&tot_cost='+tot_cost,
				dataType:'json',
					success:function(data){
						if(data.disc_info.success == 'success')
						{
							var rep_div = '';
							rep_div +='<span class="WebRupee">Rs. </span><span id="TotAmt">'+data.disc_info.final_amt+'</span>';
						
							var rep_div_1 = '';
							rep_div_1 +=data.disc_info.disc_desc+'</div>';
							
							if(data.disc_info.disc_type == 'P')
							{
								var rep_div_2 = '';
								rep_div_2 +='<div class="price">'+data.disc_info.less_amt+'</div>';
							}
							if(data.disc_info.disc_type == 'R')
							{
								var rep_div_2 = '';
								rep_div_2 +='<div class="price"><span class="WebRupee">Rs. </span>'+data.disc_info.less_amt+'</div>';
							}
							
							var cnf_book = '<a href="<?php echo SITE_URL;?>tests/confirm_booking/'+data.disc_info.final_amt+'/<?php echo $req_id;?>/No"><?php echo $html->image('frontend/confirm_booking_button.jpg');?></a>';
							
							var b = '';
							$('#HealthDiscountCode').val(b);
							
							$('#Descr').html(rep_div_1);
							$('#LessAmt').html(rep_div_2);
							$('#TotalCost').html(rep_div);
							$('#ChargeDesc').hide();
							$('#DiscountDesc').hide();
							$('#DiscountCode').hide();
							$('#ConfirmBook').html(cnf_book);
						}
						jQuery('#ShowProcess').hide();
					},
					beforeSend:function(){						
						jQuery('#ShowProcess').show();
					},
				});
			}
		}
	}
}
</script>

</div>
    </div>
		</div>

    <div class="article_in_inner" style="padding-bottom: 60px;">
		<div class="article_in">
		<div class="preview">
		<div class="preBox2"><h1>Booking <span class="green">Summary</span></h1></div>
		<div class="pacakgeBox list" style="border:1px solid #e3dfe0">			
			<?php if($collectType == 'Visit a Lab') {?>
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="50%" valign="top">
						<table border="0" width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td style="font-weight:bold; border:1px solid #D9D9D9; padding:10px;">Order Id</td>
								<td style="border-top:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $order_id;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border:1px solid #D9D9D9; padding:10px;">Patient Name</td>
								<td style="border-top:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $pat_name;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Patient Age</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $pat_age;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Patient Mobile</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $pat_contact;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Request Type</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collectType;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Lab Centre</td>
								<?php if($labType == 'Crossing Republic') {?>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;">
									Shop No. 08, LGF, Crossing Plaza,<br />
									Crossing Republic, Ghaziabad
								</td>
								<?php }?>
								<?php if($labType == 'Indirapuram') {?>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;">
									Shop No. 05 & 06, Lotus Plaza, Vaibahv Khand,<br />
									Indirapuram, Ghaziabad
								</td>
								<?php }?>
								<?php if($labType == 'Noida') {?>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;">
									Sector -31, Next to IMA House & Blood Bank,<br />
									Noida
								</td>
								<?php }?>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Visit Time</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $visit_time;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Visit Date</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $visit_date;?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<?php }?>
			<?php if($collectType == 'Home Collection') {?>
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="50%" valign="top">
						<table border="0" width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td style="font-weight:bold; border:1px solid #D9D9D9; padding:10px;">Order Id</td>
								<td style="border-top:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $order_id;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border:1px solid #D9D9D9; padding:10px;">Patient Name</td>
								<td style="border-top:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $pat_name;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Patient Age</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $pat_age;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Patient Mobile</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $pat_contact;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Request Type</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collectType;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Sample Collect Time</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collect_time;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Sample Collect Date</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collect_date;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Sample Collect Address</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo str_replace('*',' ',$collect_address);?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Locality</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collect_locality;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">City</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collect_city;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">State</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $state_name;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Pincode</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collect_pincode;?></td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding:10px;">Landmark</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; padding:10px; color:#666666;"><?php echo $collect_landmark;?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<?php }?>
		</div>
		<div class="clr"></div>
		
        <div class="tableDiv" >
       	
        <table width="100%" border="0" cellspacing="1" cellpadding="0" style="padding:10px;">
          <tr>
          <th width="20" class="thDiv" style="font-weight:bold; border:1px solid #D9D9D9; padding:10px;"><span>S.No.</span></th>
			<th width="70" class="thDiv" style="font-weight:bold; border:1px solid #D9D9D9; padding:10px;"><span>Code</span></th>
            <th width="530" class="thDiv" style="font-weight:bold; border:1px solid #D9D9D9; padding:10px;"><span>Description</span></th>
			<th width="135" class="thDiv" style="font-weight:bold; border:1px solid #D9D9D9; padding:10px;"><span style="margin:0 0 0 34px;">Reporting</span></th>
			<th class="thDiv" width="135" style="font-weight:bold; border:1px solid #D9D9D9; padding:10px;"><span style="margin:0 0 0 34px;">Price</span></th>
            </tr>
           <?php if(count($my_cart) > 0){?>
            <?php $i = 1;foreach($my_cart as $key => $val){?>
			<tr>
          		<td style="font-weight:bold; border:1px solid #D9D9D9; padding:10px;"><?php echo $i;?></td>
          		<td style="font-weight:bold; border:1px solid #D9D9D9; padding:10px;"><?php echo $val['Cart']['test_code'];?></td>
          		<td style="text-align:left; border:1px solid #D9D9D9; padding-left:10px;"><?php echo $val['Cart']['test_parameter'];?></td>
          		<td style="font-weight:bold; border:1px solid #D9D9D9; padding:10px;"><?php echo $val['Cart']['test_reporting'];?></td>

          		<td style="font-weight:bold; border:1px solid #D9D9D9; padding:10px;"><div class="price"><span class="WebRupee">Rs. </span><?php echo $val['Cart']['test_mrp'];?></div></td>
          	</tr>
          <?php $i++;}?>
		  	<!--<tr>
				<td colspan="5" style="text-align:left; padding-left:10px; color: #000000; font: 13px arial; text-shadow: 1px 1px 0 #999999;">
					<input type="checkbox" value="1" id="ReportCharge" onclick="report_amt();" /> Rs. 50 Courier Charges (For Report Delivery in 48 HRs of Reporting within Delhi NCR)<br />
					<input type="checkbox" value="1" id="DiscCode" onclick="discount_code();" /> Do you have any Discount Code
				</td>
			</tr>
			<tr id="DiscountCode" style="display:none;">
				<td colspan="4" style="text-align:right; padding-right:10px; color: #000000; font: 17px arial; text-shadow: 1px 1px 0 #999999;">Enter Discount Code</td>
				<td><span style="color:#FF0000; display:none;" id="NotValidSpan">Not Valid</span><br /><input type="text" name="" id="HealthDiscountCode" class="input-text" style="border:1px solid #666666; width:100px; height:30px; border-radius:5px;" /><br /><a href="javascript:void(0);" onclick="set_disc();">Confirm</a></td>
			</tr>
			<tr id="DiscountDesc" <?php if(!isset($prescription['PrescriptionMaster']['discount_amount'])){ echo 'style="display:none"';}?>>
				<td colspan="4" style="text-align:right; padding-right:10px; color: #000000; font: 17px arial; text-shadow: 1px 1px 0 #999999;" id="Descr">
					<?php if(isset($prescription['PrescriptionMaster']['discount_amount'])){ echo 'Discount Amount';}?>
				</td>
				<td id="LessAmt">
					<?php if(isset($prescription['PrescriptionMaster']['discount_amount'])){ ?>
						<div class="price">Rs. <?php echo $prescription['PrescriptionMaster']['discount_amount']; ?></div>
					<?php } else { ?>
						<div class="price"><span class="WebRupee">Rs. </span>50</div>		
					<?php } ?>
				</td>
			</tr>
			<tr id="ChargeDesc" style="display:none;">
				<td colspan="4" style="text-align:right; padding-right:10px; color: #000000; font: 17px arial; text-shadow: 1px 1px 0 #999999;">Report Sent at Home Charges</td>
				<td><div class="price"><span class="WebRupee">Rs. </span>50</div></td>
			</tr>-->
			
			<tr>
				<td colspan="4" style="text-align:right; padding-right:10px; color: #000000; font: 17px arial; text-shadow: 1px 1px 0 #999999;">Total Test Amount</td>
				<td><div class="price" id="TotalCost"><span class="WebRupee">Rs. </span><span id="TestAmt"><?php echo $test_amt;?></span></div></td>
			</tr>
			<?php if($voucher_code!="") {?>
			<tr>
				<td colspan="4" style="text-align:right; padding-right:10px; color: #000000; font: 17px arial; text-shadow: 1px 1px 0 #999999;">Voucher Code</td>
				<td><div class="price" id="TotalCost"><span class="WebRupee"> </span><span id="VoucherCode"><?php echo $voucher_code;?></span></div></td>
			</tr>
			<?php } 
			if($voucher_amount!=0){
			?>
			<tr>
				<td colspan="4" style="text-align:right; padding-right:10px; color: #000000; font: 17px arial; text-shadow: 1px 1px 0 #999999;">Voucher Amount Redeemed</td>
				<td><div class="price" id="TotalCost"><span class="WebRupee">Rs. </span><span id="VoucherAmount"><?php echo $voucher_amount;?></span></div></td>
			</tr>
			<?php } 
			if($other_charges!=0){
			?>
			<tr>
				<td colspan="4" style="text-align:right; padding-right:10px; color: #000000; font: 17px arial; text-shadow: 1px 1px 0 #999999;">Other Charges</td>
				<td><div class="price" id="TotalCost"><span class="WebRupee">Rs. </span><span id="OtherCharges"><?php echo $other_charges;?></span></div></td>
			</tr>
			<?php } 
			if($discount_amt!=0){
			?>
			<tr>
				<td colspan="4" style="text-align:right; padding-right:10px; color: #000000; font: 17px arial; text-shadow: 1px 1px 0 #999999;">Discount Amount</td>
				<td><div class="price" id="TotalCost"><span class="WebRupee">Rs. </span><span id="DisAmt"><?php echo $discount_amt;?></span></div></td>
			</tr>
			<?php } ?>
			<tr>
				<td colspan="4" style="text-align:right; padding-right:10px; color: #000000; font: 17px arial; text-shadow: 1px 1px 0 #999999;">Total Cost</td>
				<td><div class="price" id="TotalCost"><span class="WebRupee">Rs. </span><span id="TotAmt"><?php echo $total_cost;?></span></div></td>
			</tr>
		  <?php
		  } else {?>
		  	
		  <tr>
		  	<td style="text-align:center;" colspan="5">Your Cart is Empty</td>
		  </tr>
		  <?php }?>
		  </table>
		  </div>
		  <div class="actionBtnDiv">
                      <?php
                       // if($_SERVER['REMOTE_ADDR'] == '111.91.230.29')
                        //{
                            e($form->create('payment_mode', array('url'=>"/tests/confirm_booking/$total_cost/$req_id",'class'=>'','style'=>'width:100%')));
                            ?>
                          
                            <div class="fl">
                                <label style='margin-right:35px;'><strong>Payment Method</strong></label>
                                <?php //echo $form->hidden('order.discount_code',array('id'=>'orderDiscountCode')); ?>
                                <?php //echo $form->hidden('order.discount_amt',array('id'=>'orderDiscountAmt')); ?>
                                <?php echo $form->input('order.payment_method',
                                    array(
                                         'div' => false,
                                         'type' => 'radio',
                                         'separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                                         'legend'=>false,
                                         'error'=>false,
                                         'options' => array('O'=>'<b>Online</b>','C'=>'<b>COD</b>'),
                                         'style'=>'width:20px;',
                                         'onClick'=>'',
                                         'class'=>'',
                                         'default'=>'O'
                                    )); ?>
                                <?php 
								e($form->submit('frontend/confirm_booking_button.jpg',array('id'=>'ConfirmBook','class'=>'','div'=>false,'style'=>'vertical-align:middle;margin-left:50px;'))); ?>
								
                            </div>
                            <?php

                            e($form->end());
                       // }
                        //else
                        //{
                            ?>
				</div>
         </div>
	</div>
</div>
<div class="clr"></div>
<br><br>