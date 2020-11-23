<style type="text/css">
.class-textarea
{
	border: 1px solid #999999;
    border-radius: 3px 3px 3px 3px;
    color: #666666;
    margin-bottom: 5px;
    padding: 10px;
    width: 300px;
	font-size:13px;
}

.hint-class
{
	color:#999999; 
	font-size:11px; 
	padding:0 0 0 10px;
}


#signup-Div {background: #fff; border: 6px solid #727272; width:550px; height:440px; position: relative; display:none; z-index:999; border-radius:13px; }
#signup-Div-Profile {background: #fff; border: 6px solid #727272; width:550px; height:440px; position: relative; display:none; z-index:999; border-radius:13px; }
#signup-Div-Offer {background: #fff; border: 6px solid #727272; width:550px; height:440px; position: relative; display:none; z-index:999; border-radius:13px; }
#signup-Div-Package {background: #fff; border: 6px solid #727272; width:550px; height:310px; position: relative; display:none; z-index:999; border-radius:13px; }
#signup-Div-Service {background: #fff; border: 6px solid #727272; width:550px; height:404px; position: relative; display:none; z-index:999; border-radius:13px; }
#close-one {
    display: block;
    height: 23px;
    overflow: hidden;
    position: absolute;
    right: 3px;
    top: 8px;
    width: 24px;
}
</style>
<script type="text/javascript">
$(function() {
            function launch() {
                 $('signup-Div').lightbox_me({centered: true, onLoad: function() { $('#signup-Div').find('input:first').focus()}});
            }
            
			$('#PrescriptionMasterDiscountAmount').keyup(function(e) {
			console.log(e);

			if(e.which != 8 && isNaN(String.fromCharCode(e.which))){
				e.preventDefault();
				console.log(e);
			}
				var totaldata = $('#t_f_a_t_p_o').html();
				var total = totaldata.split(" ");
				console.log(total);
				//console.log(typeof(total[1]));
				var discount = $('#PrescriptionMasterDiscountAmount').val();
				//console.log(parseInt(total[1]));
				//console.log(parseInt(discount));
				//if(discount.length >= total[1].length-1)
				//{
					if(parseInt(total[1])<parseInt(discount))
					{
						//console.log("trigger");
						e.preventDefault();
						$('#discountissue').show();
						//alert("Discount Amount cannnot be greater than Total Amount");
						$('#editupdate').attr('disabled','disabled');
					}
					else
					{
						$('#discountissue').hide();
						$('#editupdate').removeAttr('disabled');
					}
				/*}
				else
				{
					$('#discountissue').hide();
					$('#editupdate').removeAttr('disabled');
				}*/
			});
			
            $('#try-1').click(function(e) {
				var rep_div_new = '';
				$('#TestList').html(rep_div_new);
				var get_search_test = document.getElementById('HealthSearchTest').value;
				var getLengthTest = $('#HealthTestId').length;
				console.log(get_search_test);
				console.log(getLengthTest);
				if(getLengthTest == 0)
				{
					var sel_tests = '';
				}
				if(getLengthTest != 0)
				{
					var sel_tests = document.getElementById('HealthTestId').value;
				}
				jQuery.ajax({
					type:'GET',
					url:siteUrl+'admin/samples/search_test_value?testval='+get_search_test+'&sel_test='+sel_tests,
					dataType:'json',
					success:function(data){
					console.log(data);
					if(data.test_info.success == 'success')
					{
						var getLengthTestInn = $('#HealthTestId').length;
						if(getLengthTestInn == 0)
						{
							var selection = 'no';
						}
						if(getLengthTestInn != 0)
						{
							var selection = 'yes';
							var selected = document.getElementById('selected_test_desc').innerHTML;
						}
						
						var rep_div = '';
						rep_div +='<div>';
						rep_div +='<div style="float:left; width:175px; padding:20px 10px 10px 25px;"><strong>Test Amount :</strong> Rs. <span id="TestAmt">'+data.test_info.selected_amt+'</span></div>';
						rep_div +='<div style="float:left; width:220px; display:none; margin:2px 0 0 0; text-align:center;" id="TestProcess"><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40));?></div>';
						rep_div +='</div>';
						rep_div +='<div style="float: left; height: 339px; overflow-x: hidden; overflow-y: scroll; margin:0 0 0 25px;">';
						if(selection == 'yes')
						{
							rep_div +='<div style="clear:both; width:457px;">';
							rep_div += selected;
							rep_div +='</div>';
						}
						rep_div +='<div style="float:left; margin:10px 0 0 0; clear:both;">';
						rep_div +='<div style="font-weight:bold; float:left; width:50px; text-align:center; border:1px solid #D9D9D9; height:20px; padding:10px;">Select</div>';
						rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Test Description</div>';
						rep_div +='<div style="font-weight:bold; float:left; width:80px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
						rep_div +='</div>';
						if(data.test_info.search_test.length != 0)
						{
							jQuery.each(data.test_info.search_test,function(index, value)
							{
								rep_div +='<div style="float:left; clear:both;">';
								rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_test('+value.Test.id+');" id="TestCheck'+value.Test.id+'" /></div>';
								rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
								rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
								rep_div +='</div>';
							});
						}
						rep_div +='</div>';
						rep_div +='<div style="clear:both; text-align:center; width:100%; padding:10px; font-size:15px;"><a href="javascript:void(0);" onclick="confirm_test_submit();" style="color:#0066FF;">Confirm</a>&nbsp;&nbsp;&nbsp;<?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40,'style'=>'margin:0 0 -15px; display:none;','id'=>'ConfirmFinalTest'));?></div>';
					}
					if(data.test_info.success == 'notsuccess')
					{
						var rep_div = '';
						rep_div +='<div>';
						rep_div +='<div style="float:left; width:175px; padding:20px 10px 10px 25px;"><strong>Test Amount :</strong> Rs. <span id="TestAmt">'+data.test_info.selected_amt+'</span></div>';
						rep_div +='<div style="float:left; width:220px; display:none; margin:2px 0 0 0; text-align:center;" id="TestProcess"><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40));?></div>';
						rep_div +='</div>';
						rep_div +='<div style="float: left; height: 339px; overflow-x: hidden; overflow-y: scroll; margin:0 0 0 25px;">';
						rep_div +='<div style="float:left; margin:10px 0 0 0; clear:both;">';
						rep_div +='<div style="font-weight:bold; float:left; width:50px; text-align:center; border:1px solid #D9D9D9; height:20px; padding:10px;">Select</div>';
						rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Test Description</div>';
						rep_div +='<div style="font-weight:bold; float:left; width:80px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
						rep_div +='</div>';
						rep_div +='<div style="float:left; clear:both; width:457px; text-align:center; padding:10px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-left:1px solid #D9D9D9;">No Test Found</div>';
						rep_div +='</div>';
					}
					$('#TestList').html(rep_div);
					$('#TestProcessNew').hide();
					
					},
					beforeSend:function(){
						jQuery('#TestProcessNew').show();
					},
					});
					$("#signup-Div").lightbox_me({centered: true, onLoad: function() {
					
					$("#signup-Div").find("input:first").focus();
				}});
				
                e.preventDefault();
            });
		$('table tr:nth-child(even)').addClass('stripe');
 
		var tests = $('#test_ids').val();
		if(tests!='')
		{
			jQuery.ajax({
				type:'POST',
				url:siteUrl+'admin/prescription/get_all_test_detail',
				data : { test_id : tests },	
				success:function(data){
					var testdata = JSON.parse(data);
					
					var ww = testdata.test_count;
					$('#TestCount').html(ww);
					$('#TestCount').hide();
					//$('#ChangeTestHeading').html(rep_div_heading);
					//$('#ChangeTestNewLink').html(rep_div_link);
					$('#ClickTestNew').html(testdata.test_info);
					//$('#ClickTest').hide();
					jQuery('#ConfirmFinalTest').hide();
					$('#signup-Div').hide();
					$('.js_lb_overlay').css({'opacity':'0'});
										
					if(testdata.total_mrp != 0)
					{
						var rep_div = '';
						rep_div ='<div style="float:left; width:175px; padding:20px 10px 10px 25px;"><strong>Test Amount :</strong> Rs. <span id="TestAmt">'+testdata.test_mrp+'</span></div>';
						$('#TestList').html(rep_div);
						var tot_amt_t_p_o_final = 'Rs. '+parseInt(testdata.total_mrp);
						$('#t_f_a_t_p_o_r').show();
						$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
						$('#PrescriptionMasterEstimateReference').val(parseInt(testdata.total_mrp));
						var total_amount = parseInt(testdata.total_mrp);
						var sub_total = '';
						sub_total +='<input type="text" name="data[PrescriptionMaster][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
						$('#SubTotal').html(sub_total);
						var test_ids = '';
						test_ids +='<td>';
						test_ids +='<input type="text" name="data[PrescriptionMaster][tests]" value="'+tests+'" id="HealthTestId">';
						test_ids +='</td>';
						$('#TestIds').html(test_ids);
					}
				}
			});
		}
    });		

function add_test(val)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/add_test_list?req_id='+val,
		success:function(data){
			var datum=data.split('*');
			if($('#TestCheck'+datum[0]).attr('checked'))
			{
				var a = parseInt(document.getElementById('TestAmt').innerHTML);
				if(a == 0)
				{
					var b = parseInt(datum[3]);
					$('#TestAmt').text(b);
					var test_length = $('#HealthTestId').length;
					if(test_length == 0)
					{
						var test_ids = '';
						test_ids +='<td>';
						test_ids +='<input type="text" name="data[PrescriptionMaster][tests]" value="'+datum[0]+'" id="HealthTestId">';
						test_ids +='</td>';
						$('#TestIds').html(test_ids);
					}
					else
					{
						var get_curr_ids = document.getElementById('HealthTestId').value;
						var new_test_value = get_curr_ids+','+datum[0];
						var test_ids = '';
						test_ids +='<td>';
						test_ids +='<input type="text" name="data[PrescriptionMaster][tests]" value="'+new_test_value+'" id="HealthTestId">';
						test_ids +='</td>';
						$('#TestIds').html(test_ids);
					}
				}
				if(a != 0)
				{
					var b = parseInt(datum[3]);
					var c = parseInt(a+b);
					$('#TestAmt').text(c);
					var test_length = $('#HealthTestId').length;
					if(test_length == 0)
					{
						var get_curr_ids = document.getElementById('HealthTestId').value;
						var new_test_val = get_curr_ids+','+datum[0];
						var test_ids = '';
						test_ids +='<td>';
						test_ids +='<input type="text" name="data[PrescriptionMaster][tests]" value="'+new_test_val+'" id="HealthTestId">';
						test_ids +='</td>';
						$('#TestIds').html(test_ids);
					}
					else
					{
						var get_curr_ids = document.getElementById('HealthTestId').value;
						var new_test_value = get_curr_ids+','+datum[0];
						var test_ids = '';
						test_ids +='<td>';
						test_ids +='<input type="text" name="data[PrescriptionMaster][tests]" value="'+new_test_value+'" id="HealthTestId">';
						test_ids +='</td>';
						$('#TestIds').html(test_ids);
					}
				}
			}
			else
			{
				var a = parseInt(document.getElementById('TestAmt').innerHTML);
				if(a != 0)
				{
					var x = parseInt(datum[3]);
					var b = a-x;
					var c = parseInt(b);
					$('#TestAmt').text(c);
					var get_curr_ids = document.getElementById('HealthTestId').value;
					var result1 = $.grep(get_curr_ids.split(','), function(v) { return v != datum[0]; }).join(',');
					var test_ids = '';
					test_ids +='<td>';
					test_ids +='<input type="text" name="data[PrescriptionMaster][tests]" value="'+result1+'" id="HealthTestId">';
					test_ids +='</td>';
					$('#TestIds').html(test_ids);
				}
			}
			$('#TestProcess').hide();
		},
		beforeSend:function(){
			jQuery('#TestProcess').show();
		},
		
	});
}

function confirm_test_submit()
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/get_all_test',
		dataType:'json',
		success:function(data){
			if(data.test_info.success == 'success')
			{
				$('#HealthDiscountAmount').val("0");
				$('#HealthDiscountCode').val("");
				$('#HealthDiscountAmountReason').val("");
				
				if(data.test_info.test_data.length != 0)
				{
					var rep_div = '';
					rep_div +='<td width="15%" class="boldText">Selected Test(s)</td>';
					rep_div +='<td id="selected_test_desc">';
					rep_div +='<table border="0" width="100%" style="margin:-8px 0 0 0;">';
					var g = 0;
					jQuery.each(data.test_info.test_data,function(index, value)
					{
						if(document.getElementById('selected'+value.Test.id))
						{
							rep_div +='<tr id="selected'+value.Test.id+'">';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_test('+value.Test.id+','+value.Test.mrp+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else
						{
							if($('#TestCheck'+value.Test.id).attr('checked'))
							{
								rep_div +='<tr id="selected'+value.Test.id+'">';
								rep_div +='<td>';
								rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_test('+value.Test.id+','+value.Test.mrp+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
								rep_div +='</td>';
								rep_div +='</tr>';
								g = parseInt(g+1);
							}
						
						}
					});
					if(g == 0)
					{
						rep_div_heading = 'Test(s)';
						rep_div_link = '';
						rep_div_link +='Click to open Test List';
					}
					else
					{
						rep_div_heading = '';
						rep_div_link = '';
						rep_div_link +='Change Test';
					}
					rep_div +='</table>';
					rep_div +='</td>';
				}
				if(g == 0)
				{
					$('#ClickTestNew').remove();
				}
				var w = document.getElementById('TestCount').innerHTML;
				var ww = parseInt(w+1);
				$('#TestCount').html(ww);
				$('#TestCount').hide();
				$('#ChangeTestHeading').html(rep_div_heading);
				$('#ChangeTestNewLink').html(rep_div_link);
				$('#ClickTestNew').html(rep_div);
				//$('#ClickTest').hide();
				jQuery('#ConfirmFinalTest').hide();
				$('#signup-Div').hide();
				$('.js_lb_overlay').css({'opacity':'0'});
				var test_amt = $('#TestAmt').length;
				
				if(test_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					$('#PrescriptionMasterEstimateReference').val(parseInt(p));
					var total_amount = parseInt(p);
					var sub_total = '';
					sub_total +='<input type="text" name="data[PrescriptionMaster][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalTest').show();
		},
		
	});
}

function remove_sel_test(val,val2)
{
	var curr_tot_amt = document.getElementById('HealthTotalAmount').value;
	var get_curr_ids = document.getElementById('HealthTestId').value;
	var result1 = $.grep(get_curr_ids.split(','), function(v) { return v != val; }).join(',');
	if(result1 == '')
	{
		var rep_text = '';
		rep_text +='No Test Selected';	
		var TestAmt = 0;
		$('#TestAmt').html(TestAmt);
	}
	
	$('#HealthDiscountAmount').val("0");
	$('#HealthDiscountCode').val("");
	$('#HealthDiscountAmountReason').val("");
	
	var test_ids = '';
	test_ids +='<td>';
	test_ids +='<input type="text" name="data[PrescriptionMaster][tests]" value="'+result1+'" id="HealthTestId">';
	test_ids +='</td>';
	var f_val = parseInt(curr_tot_amt-val2);
	var sub_total = '';
	sub_total +='<input type="text" name="data[PrescriptionMaster][total_amount]" value="'+f_val+'" id="HealthTotalAmount">';
	$('#SubTotal').html(sub_total);
	var tot_amt_t_p_o_final = 'Rs. '+parseInt(curr_tot_amt-val2);
	$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
	$('#PrescriptionMasterEstimateReference').val(parseInt(curr_tot_amt-val2));
	$('#selected_test_desc').html(rep_text);
	if(result1 != '')
	{
		var getTestAmt = document.getElementById('TestAmt').innerHTML;
		var NewTestAmt = parseInt(getTestAmt-val2);
		$('#TestAmt').html(NewTestAmt);
	}
	$('#TestIds').html(test_ids);
	$('#selected'+val).remove();
}

function hide_test()
{
	$('#signup-Div').hide();
	$('.js_lb_overlay').css({'opacity':'0'});
}

</script>

<div id="signup-Div"> <a id="close-one" class="close" href="javascript:void(0);" onclick="hide_test();"><?php echo $html->image('close-one.jpg');?></a>
	<div id="TestList"></div>
	<div id="TestProcessNew" style="display:none;"><?php echo $html->image('frontend/loading.gif',array('style'=>'top:190px; left:265px; position:absolute;'));?></div>
</div>

<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Add Prescription Request</h2>
    </div>
    <div class="contentbox">
	<?php echo $this->Session->flash(); ?>
	<?php if($usertype != 'Agent') {?>
	<?php echo $html->link('Home', '/admin/prescription/index', array('title'=>'Home')); ?> &#187; Add Estimate
	<?php }?>
	
	<?php echo $form->create(null, array('url'=>'/admin/prescription/add_prescription','id'=>'form1','name'=>'form1','enctype'=>'multipart/form-data')); ?>
	<?php echo $form->hidden('Health.login_type',array('value'=>$LoginType));?>
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%" id="PatientOtherInfo">
	
	<tr>
		<td width="15%" class="boldText">Medical Reference Number </td>
		<td>
			<?php echo $form->text('PrescriptionMaster.mrn', array('class'=>'input-text')); ?>
		</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Referred By <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('PrescriptionMaster.referred_by', array('class'=>'input-text','required'=>'required')); ?>
		</td>
	</tr>
	
	<tr id="InputMemberName">
		<td width="15%" class="boldText">Booked By<font color="#FF0000">*</font></td>
		<td>
			<select name="data[PrescriptionMaster][created_by]" class="input-Search" style="width: 300px;height: 35px;font-size:14px;" required>
				<option style="font-size:14px;" value="">Select PCC</option>
				<?php foreach($labList as $key => $val) {?>
				<option style="font-size:14px;" value="<?php echo $val['Lab']['id'];?>" <?php if($val['Lab']['id']=='31') echo "selected"; ?> ><?php echo $val['Lab']['pcc_name'];?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	
	<tr id="InputMemberName">
		<td width="15%" class="boldText">Patient First Name <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('PrescriptionMaster.first_name', array('class'=>'input-text','required'=>'required')); ?>
		</td>
	</tr>
	
	<tr id="InputMemberName">
		<td width="15%" class="boldText">Patient Last Name <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('PrescriptionMaster.last_name', array('class'=>'input-text','required'=>'required')); ?>
		</td>
	</tr>
	
	<tr id="InputMemberGender">
		<td width="15%" class="boldText">Gender of Patient <font color="#FF0000">*</font></td>
		<td>
			<select name="data[PrescriptionMaster][gender]" id="PrescriptionGender" class="input-text",'required'=>'required'>
				<option value="">Select Gender</option>
				<option value="1">Male</option>
				<option value="2">Female</option>
			</select>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	
	<tr id="InputMemberAge">
		<td width="15%" class="boldText">Patient Age <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('PrescriptionMaster.age', array('class'=>'input-text','style'=>'width:50px;','required'=>'required')); ?>
			<div id="msg3" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	
	<tr id="InputMemberContact">
		<td width="15%" class="boldText">Contact Number <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('PrescriptionMaster.contact_number', array('class'=>'input-text phone','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return checknum(event)','required'=>'required')); ?>
			<div id="msg5" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	
	<tr id="InputMemberAltContact">
		<td width="15%" class="boldText">Alternate Contact Number </td>
		<td>
			<?php echo $form->text('PrescriptionMaster.alternate_contact', array('class'=>'input-text phone','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return checknum(event)')); ?>
		</td>
	</tr>
	
	<tr id="InputMemberEmail">
		<td width="15%" class="boldText">Email ID<font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('PrescriptionMaster.email', array('class'=>'input-text','required'=>'required')); ?>
		</td>
	</tr>
	
	<tr>
		<td class="boldText">Remarks</td>
		<td>
			<?php echo $form->textarea('PrescriptionMaster.remarks', array('class'=>'input-text','rows'=>5,'cols'=>50,'style'=>'font-size:12px;')); ?>
			<div id="msg155" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>

	<tr>
		<td width="15%" class="boldText">Prescription Files</td>
		<td>
			<input type="file" name="prescription_url[]" class="input-text" multiple="multiple" accept=".jpg,.png,.pdf,.PDF,.jpeg">
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Prescription Estimate</td>
		<td>
			<?php echo $form->text('PrescriptionMaster.estimate_reference', array('class'=>'input-text','required'=>'required','readonly'=>'readonly')); ?>
		</td>
	</tr>
	
	<tr>
		<td colspan="2" style="font-weight:bold; text-decoration:underline; background-color:#999999; color:#FFFFFF; text-align:center;">Tests Informations</td>
	</tr>
	<tr id="TestIds" style="display:none;"></tr>

	<tr style="display:none;" id="t_f_a_t_p_o_r">
		<td width="15%" class="boldText">Total Amount</td>
		<td id="t_f_a_t_p_o"></td>
	</tr>
	<tr id="SubTotal" style="display:none;"></tr>
	<tr id="TestCount" style="display:none;">0</tr>
	<tr id="ClickTestNew"></tr>
	<tr id="ClickTest">
		<td width="15%" class="boldText" id="ChangeTestHeading">Test(s) / Profile(s) / Service(s)</td>
		<td>
			<div style="float:left;">
				<div style="float:left;">
					<?php echo $form->text('Health.search_test',array('class'=>'input-text','placeholder'=>'Search Test'));?>
					<br>
					<span id="test_error" style="display:none;color:red">Atleast One Tests should be selected</span>
				</div>
				<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-1" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
			</div>
		</td>
	</tr>
	<tr>
		<td><input type="hidden" id="test_ids" value="<?php echo $this->data['PrescriptionMaster']['tests']; ?>" required/></td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Discount Amount</td>
		<td>
			<?php echo $form->text('PrescriptionMaster.discount_amount', array('class'=>'input-text','style'=>'width:100px;','value'=>'0')); ?>
			<div id="discountissue" style="color:red;display:none;">Discount Value cant be greater than Total Amount</div>
		</td>
	</tr>
	<tr>
		<td class="boldText">Discount Reason/Remark<!-- <br />(Only filled when Discount Amount Given otherwise leave blank)--></td>
		<td>
			<?php echo $form->textarea('PrescriptionMaster.discount_amount_reason', array('class'=>'input-text','rows'=>5,'cols'=>50,'style'=>'font-size:12px;')); ?>
			<div id="msg155" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	
	<tr id="submit_div">
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->button('Save', array('div'=>false, 'class' => 'btn','id'=>'save','type'=>'button','onclick'=>'submitdata(this);')); ?>
			<a onclick="javascript:window.history.go(-1)" class="btn" style="color:#FFFFFF;">Cancel</a>
		</td>
	</tr>	



</table>
<?php echo $form->end(); ?>
</div>
<script type="text/javascript">
	
	function submitdata(type)
	{
		//console.log(type.id);
		var tests = $('#TestIds').html();
		if(tests=='')
		{
			$('#test_error').show();
		}
		else
		{
			$('#test_error').hide();
			$("#submit_type").val(type.id);
			$("#form1").submit();
		}
	}
	
	function checknum(evt)
	{
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
	$(function(){
		$("input[type = 'submit']").click(function(){
		   var $fileUpload = $("input[type='file']");
		   if (parseInt($fileUpload.get(0).files.length) > 3){
			  alert("You are only allowed to upload a maximum of 3 files");
		   }
		});
	 });
</script>
<?php echo $javascript->link('light/jquery.lightbox_me') ?>
<?php echo $javascript->link('light/slider') ?>