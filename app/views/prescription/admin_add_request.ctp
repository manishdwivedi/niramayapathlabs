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

   
   
function new_patient()
{
	$('#PatientOtherInfo').show();
	$('#SearchExistPatient').hide();
	$('#MemberName').hide();
	$('#UserList').hide();
}
function show_lab(val)
{
	if(val == 1)
	{
		$('#visit_lab_1').show();
		$('#visit_lab_2').show();
		$('#visit_lab_3').show();
		$('#home_collection_1').hide();
		$('#home_collection_2').hide();
		$('#home_collection_3').hide();
		$('#home_collection_4').hide();
		$('#submit_div').show();
	}
	if(val == 2)
	{
		$('#visit_lab_1').hide();
		$('#visit_lab_2').hide();
		$('#visit_lab_3').hide();
		$('#home_collection_1').show();
		$('#home_collection_2').show();
		$('#home_collection_3').show();
		$('#home_collection_4').show();
		$('#submit_div').hide();
	}
}
</script>
<script language="JavaScript" type="text/javascript">
function validationc()
{
	var str=true;
	document.getElementById("msg1").innerHTML="";
	document.getElementById("msg2").innerHTML="";
	document.getElementById("msg3").innerHTML="";
	document.getElementById("msg5").innerHTML="";
	//document.getElementById("msg6").innerHTML="";
	document.getElementById("msg7").innerHTML="";
	document.getElementById("msg8").innerHTML="";
	document.getElementById("msg9").innerHTML="";
	document.getElementById("msg10").innerHTML="";
	document.getElementById("msg11").innerHTML="";
	document.getElementById("msg12").innerHTML="";
	document.getElementById("msg155").innerHTML="";
	document.getElementById("msg156").innerHTML="";
	
	if(document.form1.HealthName.value=='')
	{
		document.getElementById("msg1").innerHTML="Please Enter First Name";
		str=false;
	}
	if(document.form1.HealthGender.value=='')
	{
		document.getElementById("msg2").innerHTML="Please Select Gender";
		str=false;
	}
	if(document.form1.HealthAge.value=='')
	{
		document.getElementById("msg3").innerHTML="Please Enter Age";
		str=false;
	}
	if(isNaN(document.form1.HealthLandline.value))
	{
		document.getElementById("msg5").innerHTML="Please Insert Numeric Mobile No.";
		str = false;
	}
	else if(document.form1.HealthLandline.value.length<10)
	{
		document.getElementById("msg5").innerHTML="Please Insert Valid Mobile No.";
    	str = false;
	}
	
	//var validate_char= /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	//if(!document.form1.HealthEmail.value.match(validate_char))
	//{
	//	document.getElementById("msg6").innerHTML="Please Enter a valid email address";
	//	str=false;
	//}
	
	if(document.form1.HealthAddress1.value=='')
	{
		document.getElementById("msg7").innerHTML="Please Enter Address";
		str=false;
	}
	if(document.form1.HealthLocality.value=='')
	{
		document.getElementById("msg8").innerHTML="Please Enter Locality";
		str=false;
	}
	//if(document.form1.HealthCityId.value=='')
	//{
	//	document.getElementById("msg9").innerHTML="Please Select City";
	//	str=false;
	//}
	//if(document.form1.HealthState.value=='')
	//{
	//	document.getElementById("msg10").innerHTML="Please Select State";
	//	str=false;
	//}
	if(document.form1.HealthPincode.value=='')
	{
		document.getElementById("msg11").innerHTML="Please Enter Pincode";
		str=false;
	}
	if(document.form1.HealthLandmark.value=='')
	{
		document.getElementById("msg12").innerHTML="Please Enter Landmark";
		str=false;
	}
	if(document.form1.HealthDiscountAmountReason.value=='')
	{
		document.getElementById("msg155").innerHTML="Please Enter Reason/Remark";
		str=false;
	}
	if(document.form1.HealthVitalTime.value=='')
	{
		document.getElementById("msg156").innerHTML="Please Select Date";
		//str=false;
	}
	
	return str;
}

function new_add()
{
	$('#home_collection_4').hide();
	var add_line1_rep = '';
	var add_line2_rep = '';
	var locality_rep = '';
	var city_rep = '';
	var state_rep = '';
	var pincode_rep = '';
	var landmark_rep = '';
	
	add_line1_rep +='<td width="15%" class="boldText">Address</td>';
	add_line1_rep +='<td>';
	add_line1_rep +='<input type="text" name="data[Health][same_address1]" class="input-text">';
	add_line1_rep +='</td>';
	
	add_line2_rep +='<td width="15%" class="boldText">&nbsp;</td>';
	add_line2_rep +='<td>';
	add_line2_rep +='<input type="text" name="data[Health][same_address2]" class="input-text">';
	add_line2_rep +='</td>';
	
	locality_rep +='<td width="15%" class="boldText">Locality</td>';
	locality_rep +='<td>';
	locality_rep +='<select name="data[Health][same_locality]" id="HealthLocalityId" class="input-text">';
	locality_rep +=$('#HealthLocality').html();
	locality_rep +='</select></td>';
	
	city_rep +='<td width="15%" class="boldText">City</td>';
	city_rep +='<td>';
	city_rep +='<select name="data[Health][same_city]" id="HealthCity" class="input-text">';
	city_rep +=$('#HealthCityId').html();
	city_rep +='</select>';
	city_rep +='</td>';
	
	state_rep +='<td width="15%" class="boldText">State</td>';
	state_rep +='<td>';
	state_rep +='<select name="data[Health][same_state]" id="HealthStateid" class="input-text">';
	state_rep +=$('#HealthState').html();
	state_rep +='</select>';
	state_rep +='</td>';
	
	pincode_rep +='<td width="15%" class="boldText">Pincode</td>';
	pincode_rep+='<td>';
	pincode_rep +='<input type="text" id="HealthPincodeId" name="data[Health][same_pincode]" class="input-text" onkeyup="getcitystate1()">';
	pincode_rep +='</td>';
	
	landmark_rep +='<td width="15%" class="boldText">Landmark</td>';
	landmark_rep+='<td>';
	landmark_rep +='<input type="text" name="data[Health][same_landmark]" class="input-text">';
	landmark_rep +='</td>';
	
	$('#add_line1').html(add_line1_rep);
	$('#add_line2').html(add_line2_rep);
	$('#locality').html(locality_rep);
	$('#city').html(city_rep);
	$('#state').html(state_rep);
	$('#pincode').html(pincode_rep);
	$('#landmark').html(landmark_rep);
	$('#add_line1').show();
	$('#add_line2').show();
	$('#locality').show();
	$('#city').show();
	$('#state').show();
	$('#pincode').show();
	$('#submit_div').show();
}


function show_upper_add()
{
	$('#home_collection_4').hide();
	var add_line1 = document.getElementById('HealthAddress1').value;
	var add_line2 = document.getElementById('HealthAddress2').value;
	var locality = document.getElementById('HealthLocality').value;
	var city = document.getElementById('HealthCityId').value;
	var state = document.getElementById('HealthState').value;
	var pincode = document.getElementById('HealthPincode').value;
	var landmark = document.getElementById('HealthLandmark').value;
	
	var add_line1_rep = '';
	var add_line2_rep = '';
	var locality_rep = '';
	var city_rep = '';
	var state_rep = '';
	var pincode_rep = '';
	var landmark_rep = '';
	
	add_line1_rep +='<td width="15%" class="boldText">Address</td>';
	add_line1_rep +='<td>';
	add_line1_rep +='<input type="text" name="data[Health][same_address1]" value="'+add_line1+'" class="input-text">';
	add_line1_rep +='</td>';
	
	add_line2_rep +='<td width="15%" class="boldText">&nbsp;</td>';
	add_line2_rep +='<td>';
	add_line2_rep +='<input type="text" name="data[Health][same_address2]" value="'+add_line2+'" class="input-text">';
	add_line2_rep +='</td>';
	
	locality_rep +='<td width="15%" class="boldText">Locality</td>';
	locality_rep +='<td>';
	locality_rep +='<select name="data[Health][same_locality]" id="HealthLocalityId" class="input-text" readonly>';
	locality_rep +=$('#HealthLocality').html();
	locality_rep +='</select></td>';
	
	city_rep +='<td width="15%" class="boldText">City</td>';
	city_rep +='<td>';
	city_rep += '<select name="data[Health][same_city]" id="HealthCity" class="input-text" readonly>';
	city_rep += $('#HealthCityId').html();
	city_rep += '</select></td>';
	
	state_rep +='<td width="15%" class="boldText">State</td>';
	state_rep +='<td>';
	state_rep += '<select name="data[Health][same_state]" id="HealthStateid" class="input-text" readonly>';
	state_rep += $('#HealthState').html();
	state_rep += '</select></td>';
	
	pincode_rep +='<td width="15%" class="boldText">Pincode</td>';
	pincode_rep+='<td>';
	pincode_rep +='<input type="text" name="data[Health][same_pincode]" value="'+pincode+'" class="input-text">';
	pincode_rep +='</td>';
	
	landmark_rep +='<td width="15%" class="boldText">Landmark</td>';
	landmark_rep+='<td>';
	landmark_rep +='<input type="text" name="data[Health][same_landmark]" value="'+landmark+'" class="input-text">';
	landmark_rep +='</td>';
	
	$('#add_line1').html(add_line1_rep);
	$('#add_line2').html(add_line2_rep);
	$('#locality').html(locality_rep);
	$('#city').html(city_rep);
	$('#state').html(state_rep);
	$('#HealthLocalityId option[value='+locality+']').attr('selected','selected');
	$('#HealthCity option[value='+city+']').attr('selected','selected');						
	$('#HealthStateid option[value='+state+']').attr('selected','selected');
	$('#pincode').html(pincode_rep);
	$('#landmark').html(landmark_rep);
//	$('#add_line1').show();
//	$('#add_line2').show();
//	$('#locality').show();
//	$('#city').show();
//	$('#state').show();
//	$('#pincode').show();
//	$('#landmark').show();
	$('#submit_div').show();
	
}
</script>


<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		minDate: '-7D',
		maxDate: '+30D',
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker2" ).datepicker({
		minDate: '-7D',
		maxDate: '+30D',
		dateFormat: 'dd-mm-yy'
	});
});
$(function() {
            function launch() {
                 $('signup-Div').lightbox_me({centered: true, onLoad: function() { $('#signup-Div').find('input:first').focus()}});
            }
            
			$('#HealthDiscountAmount').keyup(function(e) {
			if(e.which != 8 && isNaN(String.fromCharCode(e.which))){
				e.preventDefault();
			}
				var totaldata = $('#t_f_a_t_p_o').html();
				var total = totaldata.split(" ");
				//console.log(typeof(total[1]));
				var discount = $('#HealthDiscountAmount').val();
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
        });
		
		
$(function() {
            function launch() {
                 $('signup-Div-Profile').lightbox_me({centered: true, onLoad: function() { $('#signup-Div-Profile').find('input:first').focus()}});
            }
            
            $('#try-2').click(function(e) {
				var rep_div_new = '';
				$('#ProfileList').html(rep_div_new);
				var get_search_profile = document.getElementById('HealthSearchProfile').value;
				var getLengthTest = $('#HealthProfileId').length;
				if(getLengthTest == 0)
				{
					var sel_tests = '';
				}
				if(getLengthTest != 0)
				{
					var sel_tests = document.getElementById('HealthProfileId').value;
				}
				jQuery.ajax({
					type:'GET',
					url:siteUrl+'admin/samples/search_profile_value?testval='+get_search_profile+'&sel_test='+sel_tests,
					dataType:'json',
					success:function(data){
						if(data.test_info.success == 'success')
						{
							var getLengthTestInn = $('#HealthProfileId').length;
							if(getLengthTestInn == 0)
							{
								var selection = 'no';
							}
							if(getLengthTestInn != 0)
							{
								var selection = 'yes';
								var selected = document.getElementById('selected_profile_desc').innerHTML;
							}
							var rep_div = '';
							rep_div +='<div>';
							rep_div +='<div style="float:left; width:175px; padding:20px 10px 10px 25px;"><strong>Profile Amount :</strong> Rs. <span id="ProfileAmt">'+data.test_info.selected_amt+'</span></div>';
							rep_div +='<div style="float:left; width:220px; display:none; margin:2px 0 0 0; text-align:center;" id="ProfileProcess"><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40));?></div>';
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
							rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Profile Description</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:80px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
							rep_div +='</div>';
							if(data.test_info.search_test.length != 0)
							{
								jQuery.each(data.test_info.search_test,function(index, value)
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_profile('+value.Test.id+');" id="ProfileCheck'+value.Test.id+'" /></div>';
									rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
									rep_div +='</div>';
								});
							}
							rep_div +='</div>';
							rep_div +='<div style="clear:both; text-align:center; width:100%; padding:10px; font-size:15px;"><a href="javascript:void(0);" onclick="confirm_profile_submit();" style="color:#0066FF;">Confirm</a>&nbsp;&nbsp;&nbsp;<?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40,'style'=>'margin:0 0 -15px; display:none;','id'=>'ConfirmFinalProfile'));?></div>';
						}
						if(data.test_info.success == 'notsuccess')
						{
							var rep_div = '';
							rep_div +='<div>';
							rep_div +='<div style="float:left; width:175px; padding:20px 10px 10px 25px;"><strong>Profile Amount :</strong> Rs. <span id="ProfileAmt">'+data.test_info.selected_amt+'</span></div>';
							rep_div +='<div style="float:left; width:220px; display:none; margin:2px 0 0 0; text-align:center;" id="ProfileProcess"><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40));?></div>';
							rep_div +='</div>';
							rep_div +='<div style="float: left; height: 339px; overflow-x: hidden; overflow-y: scroll; margin:0 0 0 25px;">';
							rep_div +='<div style="float:left; margin:10px 0 0 0; clear:both;">';
							rep_div +='<div style="font-weight:bold; float:left; width:50px; text-align:center; border:1px solid #D9D9D9; height:20px; padding:10px;">Select</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Profile Description</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:80px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
							rep_div +='</div>';
							rep_div +='<div style="float:left; clear:both; width:457px; text-align:center; padding:10px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-left:1px solid #D9D9D9;">No Profile Found</div>';
							rep_div +='</div>';
						}
						
						$('#ProfileList').html(rep_div);
						$('#ProfileProcessNew').hide();
					
					},
					beforeSend:function(){
						jQuery('#ProfileProcessNew').show();
					},
					
				});
             	$("#signup-Div-Profile").lightbox_me({centered: true, onLoad: function() {
					$("#signup-Div-Profile").find("input:first").focus();
				}});
				
                e.preventDefault();
            });
 $('table tr:nth-child(even)').addClass('stripe');
        });
		
		
$(function() {
            function launch() {
                 $('signup-Div-Offer').lightbox_me({centered: true, onLoad: function() { $('#signup-Div-Offer').find('input:first').focus()}});
            }
            
            $('#try-3').click(function(e) {
				var rep_div_new = '';
				$('#OfferList').html(rep_div_new);
				var get_search_offer = document.getElementById('HealthSearchOffer').value;
				var getLengthTest = $('#HealthOfferId').length;
				if(getLengthTest == 0)
				{
					var sel_tests = '';
				}
				if(getLengthTest != 0)
				{
					var sel_tests = document.getElementById('HealthOfferId').value;
				}
				jQuery.ajax({
					type:'GET',
					url:siteUrl+'admin/samples/search_offer_value?testval='+get_search_offer+'&sel_test='+sel_tests,
					dataType:'json',
					success:function(data){
						if(data.test_info.success == 'success')
						{
							var getLengthTestInn = $('#HealthOfferId').length;
							if(getLengthTestInn == 0)
							{
								var selection = 'no';
							}
							if(getLengthTestInn != 0)
							{
								var selection = 'yes';
								var selected = document.getElementById('selected_offer_desc').innerHTML;
							}
							var rep_div = '';
							rep_div +='<div>';
							rep_div +='<div style="float:left; width:175px; padding:20px 10px 10px 25px;"><strong>Offer Amount :</strong> Rs. <span id="OfferAmt">'+data.test_info.selected_amt+'</span></div>';
							rep_div +='<div style="float:left; width:220px; display:none; margin:2px 0 0 0; text-align:center;" id="OfferProcess"><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40));?></div>';
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
							rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Special Offer Description</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:80px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
							rep_div +='</div>';
							if(data.test_info.search_test.length != 0)
							{
								jQuery.each(data.test_info.search_test,function(index, value)
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Banner.banner_mrp+'" onclick="add_offer('+value.Banner.id+');" id="OfferCheck'+value.Banner.id+'" /></div>';
									rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Banner.banner_code+' - '+value.Banner.banner_name+'</div>';
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Banner.banner_mrp+'</div>';
									rep_div +='</div>';
								});
							}
							rep_div +='</div>';
							rep_div +='<div style="clear:both; text-align:center; width:100%; padding:10px; font-size:15px;"><a href="javascript:void(0);" onclick="confirm_offer_submit();" style="color:#0066FF;">Confirm</a>&nbsp;&nbsp;&nbsp;<?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40,'style'=>'margin:0 0 -15px; display:none;','id'=>'ConfirmFinalOffer'));?></div>';
						}
						if(data.test_info.success == 'notsuccess')
						{
							var rep_div = '';
							rep_div +='<div>';
							rep_div +='<div style="float:left; width:175px; padding:20px 10px 10px 25px;"><strong>Offer Amount :</strong> Rs. <span id="OfferAmt">'+data.test_info.selected_amt+'</span></div>';
							rep_div +='<div style="float:left; width:220px; display:none; margin:2px 0 0 0; text-align:center;" id="OfferProcess"><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40));?></div>';
							rep_div +='</div>';
							rep_div +='<div style="float: left; height: 339px; overflow-x: hidden; overflow-y: scroll; margin:0 0 0 25px;">';
							rep_div +='<div style="float:left; margin:10px 0 0 0; clear:both;">';
							rep_div +='<div style="font-weight:bold; float:left; width:50px; text-align:center; border:1px solid #D9D9D9; height:20px; padding:10px;">Select</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Special Offer Description</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:80px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
							rep_div +='</div>';
							rep_div +='<div style="float:left; clear:both; width:457px; text-align:center; padding:10px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-left:1px solid #D9D9D9;">No Special Offer Found</div>';
							rep_div +='</div>';
						}
						$('#OfferList').html(rep_div);
						$('#OfferProcessNew').hide();
					
					},
					beforeSend:function(){
						jQuery('#OfferProcessNew').show();
					},
					
				});
				$("#signup-Div-Offer").lightbox_me({centered: true, onLoad: function() {
						$("#signup-Div-Offer").find("input:first").focus();
				}});
					
				e.preventDefault(); 
            });
 $('table tr:nth-child(even)').addClass('stripe');
        });
		
		
$(function() {
            function launch() {
                 $('signup-Div-Package').lightbox_me({centered: true, onLoad: function() { $('#signup-Div-Package').find('input:first').focus()}});
            }
            
            $('#try-4').click(function(e) {
				var rep_div_new = '';
				$('#PackageList').html(rep_div_new);
				var get_search_package = document.getElementById('HealthSearchPackage').value;
				var getLengthTest = $('#HealthPackageId').length;
				if(getLengthTest == 0)
				{
					var sel_tests = '';
				}
				if(getLengthTest != 0)
				{
					var sel_tests = document.getElementById('HealthPackageId').value;
				}
				jQuery.ajax({
					type:'GET',
					url:siteUrl+'admin/samples/search_package_value?testval='+get_search_package+'&sel_test='+sel_tests,
					dataType:'json',
					success:function(data){
						if(data.test_info.success == 'success')
						{
							var getLengthTestInn = $('#HealthPackageId').length;
							if(getLengthTestInn == 0)
							{
								var selection = 'no';
							}
							if(getLengthTestInn != 0)
							{
								var selection = 'yes';
								var selected = document.getElementById('selected_package_desc').innerHTML;
							}
							var rep_div = '';
							rep_div +='<div>';
							rep_div +='<div style="float:left; width:180px; padding:20px 10px 10px 25px;"><strong>Package Amount :</strong> Rs. <span id="PackageAmt">'+data.test_info.selected_amt+'</span></div>';
							rep_div +='<div style="float:left; width:220px; display:none; margin:2px 0 0 0; text-align:center;" id="PackageProcess"><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40));?></div>';
							rep_div +='</div>';
							rep_div +='<div style="float: left; height: 195px; overflow-x: hidden; margin:0 0 0 25px;">';
							if(selection == 'yes')
							{
								rep_div +='<div style="clear:both; width:457px;">';
								rep_div += selected;
								rep_div +='</div>';
							}
							rep_div +='<div style="float:left; margin:10px 0 0 0; clear:both;">';
							rep_div +='<div style="font-weight:bold; float:left; width:50px; text-align:center; border:1px solid #D9D9D9; height:20px; padding:10px;">Select</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Niramaya Packages Description</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:63px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
							rep_div +='</div>';
							if(data.test_info.search_test.length != 0)
							{
								jQuery.each(data.test_info.search_test,function(index, value)
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" /></div>';
									rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_code+'-'+value.Package.package_name+'</div>';
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
									rep_div +='</div>';
								});
							}
							rep_div +='</div>';
							rep_div +='<div style="clear:both; text-align:center; width:100%; padding:10px; font-size:15px;"><a href="javascript:void(0);" onclick="confirm_package_submit();" style="color:#0066FF;">Confirm</a>&nbsp;&nbsp;&nbsp;<?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40,'style'=>'margin:0 0 -15px; display:none;','id'=>'ConfirmFinalPackage'));?></div>';
						}
						if(data.test_info.success == 'notsuccess')
						{
							var rep_div = '';
							rep_div +='<div>';
							rep_div +='<div style="float:left; width:180px; padding:20px 10px 10px 25px;"><strong>Package Amount :</strong> Rs. <span id="PackageAmt">'+data.test_info.selected_amt+'</span></div>';
							rep_div +='<div style="float:left; width:220px; display:none; margin:2px 0 0 0; text-align:center;" id="PackageProcess"><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40));?></div>';
							rep_div +='</div>';
							rep_div +='<div style="float: left; height: 195px; overflow-x: hidden; margin:0 0 0 25px;">';
							rep_div +='<div style="float:left; margin:10px 0 0 0; clear:both;">';
							rep_div +='<div style="font-weight:bold; float:left; width:50px; text-align:center; border:1px solid #D9D9D9; height:20px; padding:10px;">Select</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Niramaya Packages Description</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:80px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
							rep_div +='</div>';
							rep_div +='<div style="float:left; clear:both; width:457px; text-align:center; padding:10px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-left:1px solid #D9D9D9;">No Niramaya Package Found</div>';
							rep_div +='</div>';
						}
						$('#PackageList').html(rep_div);
						$('#PackageProcessNew').hide();
					
					},
					beforeSend:function(){
						jQuery('#PackageProcessNew').show();
					},
					
					});
					$("#signup-Div-Package").lightbox_me({centered: true, onLoad: function() {
						$("#signup-Div-Package").find("input:first").focus();
					}});
					
					e.preventDefault(); 
			});
 $('table tr:nth-child(even)').addClass('stripe');
        });

$(function() {
            function launch() {
                 $('signup-Div-Service').lightbox_me({centered: true, onLoad: function() { $('#signup-Div-Service').find('input:first').focus()}});
            }
            
            $('#try-5').click(function(e) {
				var rep_div_new = '';
				$('#ServiceList').html(rep_div_new);
				var get_search_service = document.getElementById('HealthSearchService').value;
				var getLengthTest = $('#HealthServiceId').length;
				if(getLengthTest == 0)
				{
					var sel_tests = '';
				}
				if(getLengthTest != 0)
				{
					var sel_tests = document.getElementById('HealthServiceId').value;
				}
				jQuery.ajax({
					type:'GET',
					url:siteUrl+'admin/samples/search_service_value?testval='+get_search_service+'&sel_test='+sel_tests,
					dataType:'json',
					success:function(data){
						if(data.test_info.success == 'success')
						{
							var getLengthTestInn = $('#HealthServiceId').length;
							if(getLengthTestInn == 0)
							{
								var selection = 'no';
							}
							if(getLengthTestInn != 0)
							{
								var selection = 'yes';
								var selected = document.getElementById('selected_service_desc').innerHTML;
							}
							var rep_div = '';
							rep_div +='<div>';
							rep_div +='<div style="float:left; width:180px; padding:20px 10px 10px 25px;"><strong>Service Amount :</strong> Rs. <span id="ServiceAmt">'+data.test_info.selected_amt+'</span></div>';
							rep_div +='<div style="float:left; width:220px; display:none; margin:2px 0 0 0; text-align:center;" id="ServiceProcess"><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40));?></div>';
							rep_div +='</div>';
							rep_div +='<div style="float: left; height: 295px; width:495px; overflow-x: hidden; margin:0 0 0 25px;">';
							if(selection == 'yes')
							{
								rep_div +='<div style="clear:both; width:457px;">';
								rep_div += selected;
								rep_div +='</div>';
							}
							rep_div +='<div style="float:left; margin:10px 0 0 0; clear:both;">';
							rep_div +='<div style="font-weight:bold; float:left; width:50px; text-align:center; border:1px solid #D9D9D9; height:20px; padding:10px;">Select</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:300px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Patient Care Services Description</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:63px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
							rep_div +='</div>';
							if(data.test_info.search_test.length != 0)
							{
								jQuery.each(data.test_info.search_test,function(index, value)
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_service('+value.Test.id+');" id="ServiceCheck'+value.Test.id+'" /></div>';
									rep_div +='<div style="float:left; width:300px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.test_parameter+'</div>';
									rep_div +='<div style="float:left; width:63px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
									rep_div +='</div>';
								});
							}
							rep_div +='</div>';
							rep_div +='<div style="clear:both; text-align:center; width:100%; padding:10px; font-size:15px;"><a href="javascript:void(0);" onclick="confirm_service_submit();" style="color:#0066FF;">Confirm</a>&nbsp;&nbsp;&nbsp;<?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40,'style'=>'margin:0 0 -15px; display:none;','id'=>'ConfirmFinalService'));?></div>';
						}
						if(data.test_info.success == 'notsuccess')
						{
							var rep_div = '';
							rep_div +='<div>';
							rep_div +='<div style="float:left; width:180px; padding:20px 10px 10px 25px;"><strong>Service Amount :</strong> Rs. <span id="ServiceAmt">'+data.test_info.selected_amt+'</span></div>';
							rep_div +='<div style="float:left; width:220px; display:none; margin:2px 0 0 0; text-align:center;" id="ServiceProcess"><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40));?></div>';
							rep_div +='</div>';
							rep_div +='<div style="float: left; height: 195px; overflow-x: hidden; margin:0 0 0 25px;">';
							rep_div +='<div style="float:left; margin:10px 0 0 0; clear:both;">';
							rep_div +='<div style="font-weight:bold; float:left; width:50px; text-align:center; border:1px solid #D9D9D9; height:20px; padding:10px;">Select</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Patient Care Services Description</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:80px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
							rep_div +='</div>';
							rep_div +='<div style="float:left; clear:both; width:457px; text-align:center; padding:10px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-left:1px solid #D9D9D9;">No Patient Care Services Found</div>';
							rep_div +='</div>';
						}
						$('#ServiceList').html(rep_div);
						$('#ServiceProcessNew').hide();
					
					},
					beforeSend:function(){
						jQuery('#ServiceProcessNew').show();
					},
					
					});
					$("#signup-Div-Service").lightbox_me({centered: true, onLoad: function() {
						$("#signup-Div-Service").find("input:first").focus();
					}});
					
					e.preventDefault(); 
			});
 $('table tr:nth-child(even)').addClass('stripe');
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
						test_ids +='<input type="text" name="data[Health][test_id]" value="'+datum[0]+'" id="HealthTestId">';
						test_ids +='</td>';
						$('#TestIds').html(test_ids);
					}
					else
					{
						var get_curr_ids = document.getElementById('HealthTestId').value;
						var new_test_value = get_curr_ids+','+datum[0];
						var test_ids = '';
						test_ids +='<td>';
						test_ids +='<input type="text" name="data[Health][test_id]" value="'+new_test_value+'" id="HealthTestId">';
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
						test_ids +='<input type="text" name="data[Health][test_id]" value="'+new_test_val+'" id="HealthTestId">';
						test_ids +='</td>';
						$('#TestIds').html(test_ids);
					}
					else
					{
						var get_curr_ids = document.getElementById('HealthTestId').value;
						var new_test_value = get_curr_ids+','+datum[0];
						var test_ids = '';
						test_ids +='<td>';
						test_ids +='<input type="text" name="data[Health][test_id]" value="'+new_test_value+'" id="HealthTestId">';
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
					test_ids +='<input type="text" name="data[Health][test_id]" value="'+result1+'" id="HealthTestId">';
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
				var profile_amt = $('#ProfileAmt').length;
				var offer_amt = $('#OfferAmt').length;
				var package_amt = $('#PackageAmt').length;
				var service_amt = $('#ServiceAmt').length;
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var tot_amt_t_p_o_final = 'Rs. 0';
					$('#t_f_a_t_p_o_r').hide();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = 0;
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
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
	test_ids +='<input type="text" name="data[Health][test_id]" value="'+result1+'" id="HealthTestId">';
	test_ids +='</td>';
	var f_val = parseInt(curr_tot_amt-val2);
	var sub_total = '';
	sub_total +='<input type="text" name="data[Health][total_amount]" value="'+f_val+'" id="HealthTotalAmount">';
	$('#SubTotal').html(sub_total);
	var tot_amt_t_p_o_final = 'Rs. '+parseInt(curr_tot_amt-val2);
	$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
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



function add_profile(val)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/add_profile_list?req_id='+val,
		success:function(data){
			var datum=data.split('*');
			if($('#ProfileCheck'+datum[0]).attr('checked'))
			{
				var a = parseInt(document.getElementById('ProfileAmt').innerHTML);
				if(a == 0)
				{
					var b = parseInt(datum[3]);
					$('#ProfileAmt').text(b);
					var profile_length = $('#HealthProfileId').length;
					if(profile_length == 0)
					{
						var profile_ids = '';
						profile_ids +='<td>';
						profile_ids +='<input type="text" name="data[Health][profile_id]" value="'+datum[0]+'" id="HealthProfileId">';
						profile_ids +='</td>';
						$('#ProfileIds').html(profile_ids);
					}
					if(profile_length != 0)
					{
						var get_curr_ids = document.getElementById('HealthProfileId').value;
						var new_profile_value = get_curr_ids+','+datum[0];
						var profile_ids = '';
						profile_ids +='<td>';
						profile_ids +='<input type="text" name="data[Health][profile_id]" value="'+new_profile_value+'" id="HealthProfileId">';
						profile_ids +='</td>';
						$('#ProfileIds').html(profile_ids);
					}
				}
				if(a != 0)
				{
					var b = parseInt(datum[3]);
					var c = parseInt(a+b);
					$('#ProfileAmt').text(c);
					var profile_length = $('#HealthProfileId').length;
					if(profile_length == 0)
					{
						var get_curr_ids = document.getElementById('HealthProfileId').value;
						var new_profile_val = get_curr_ids+','+datum[0];
						var profile_ids = '';
						profile_ids +='<td>';
						profile_ids +='<input type="text" name="data[Health][profile_id]" value="'+new_profile_val+'" id="HealthProfileId">';
						profile_ids +='</td>';
						$('#ProfileIds').html(profile_ids);
					}
					if(profile_length != 0)
					{
						var get_curr_ids = document.getElementById('HealthProfileId').value;
						var new_profile_value = get_curr_ids+','+datum[0];
						var profile_ids = '';
						profile_ids +='<td>';
						profile_ids +='<input type="text" name="data[Health][profile_id]" value="'+new_profile_value+'" id="HealthProfileId">';
						profile_ids +='</td>';
						$('#ProfileIds').html(profile_ids);
					}
				}
			}
			else
			{
				var a = parseInt(document.getElementById('ProfileAmt').innerHTML);
				if(a != 0)
				{
					var x = parseInt(datum[3]);
					var b = a-x;
					var c = parseInt(b);
					$('#ProfileAmt').text(c);
					var get_curr_ids = document.getElementById('HealthProfileId').value;
					var result1 = $.grep(get_curr_ids.split(','), function(v) { return v != datum[0]; }).join(',');
					var profile_ids = '';
					profile_ids +='<td>';
					profile_ids +='<input type="text" name="data[Health][profile_id]" value="'+result1+'" id="HealthProfileId">';
					profile_ids +='</td>';
					$('#ProfileIds').html(profile_ids);
				}
			}
			$('#ProfileProcess').hide();
		},
		beforeSend:function(){
			jQuery('#ProfileProcess').show();
		},
		
	});
}

function confirm_profile_submit()
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/get_all_profile',
		dataType:'json',
		success:function(data){
			if(data.test_info.success == 'success')
			{
				if(data.test_info.test_data.length != 0)
				{
					var rep_div = '';
					rep_div +='<td width="15%" class="boldText">Selected Profile(s)</td>';
					rep_div +='<td id="selected_profile_desc">';
					rep_div +='<table border="0" width="100%" style="margin:-8px 0 0 0;">';
					var h = 0;
					jQuery.each(data.test_info.test_data,function(index, value)
					{
						if(document.getElementById('selectedp'+value.Test.id))
						{
							rep_div +='<tr id="selectedp'+value.Test.id+'">';
							rep_div +='<td>';
							rep_div +=parseInt(h+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_profile('+value.Test.id+','+value.Test.mrp+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							h = parseInt(h+1);
						}
						else
						{
							if($('#ProfileCheck'+value.Test.id).attr('checked'))
							{
								rep_div +='<tr id="selectedp'+value.Test.id+'">';
								rep_div +='<td>';
								rep_div +=parseInt(h+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_profile('+value.Test.id+','+value.Test.mrp+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
								rep_div +='</td>';
								rep_div +='</tr>';
								h = parseInt(h+1);
							}	
						}
					});
					if(h == 0)
					{
						rep_div_heading_profile = 'Profile(s)';
						rep_div_link_profile = '';
						rep_div_link_profile +='Click to open Profile List';
					}
					else
					{
						rep_div_heading_profile = '';
						rep_div_link_profile = '';
						rep_div_link_profile +='Change Profile';
					}
					rep_div +='</table>';
					rep_div +='</td>';
				}
				if(h == 0)
				{
					$('#ClickProfileNew').remove();
				}
				var w = document.getElementById('ProfileCount').innerHTML;
				var ww = parseInt(w+1);
				$('#ProfileCount').html(ww);
				$('#ProfileCount').hide();
				$('#ChangeProfileHeading').html(rep_div_heading_profile);
				$('#ChangeProfileNewLink').html(rep_div_link_profile);
				$('#ClickProfileNew').html(rep_div);
				//$('#ClickProfile').hide();
				jQuery('#ConfirmFinalProfile').hide();
				$('#signup-Div-Profile').hide();
				$('.js_lb_overlay').css({'opacity':'0'});
				var test_amt = $('#TestAmt').length;
				var profile_amt = $('#ProfileAmt').length;
				var offer_amt = $('#OfferAmt').length;
				var package_amt = $('#PackageAmt').length;
				var service_amt = $('#ServiceAmt').length;
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var tot_amt_t_p_o_final = 'Rs. 0';
					$('#t_f_a_t_p_o_r').hide();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = 0;
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalProfile').show();
		},
		
	});
}

function remove_sel_profile(val,val2)
{
	var curr_tot_amt = document.getElementById('HealthTotalAmount').value;
	var get_curr_ids = document.getElementById('HealthProfileId').value;
	var result1 = $.grep(get_curr_ids.split(','), function(v) { return v != val; }).join(',');
	if(result1 == '')
	{
		var rep_text = '';
		rep_text +='No Profile Selected';	
		var ProfileAmt = 0;
		$('#ProfileAmt').html(ProfileAmt);
		
	}
	var test_ids = '';
	test_ids +='<td>';
	test_ids +='<input type="text" name="data[Health][profile_id]" value="'+result1+'" id="HealthProfileId">';
	test_ids +='</td>';
	var f_val = parseInt(curr_tot_amt-val2);
	var sub_total = '';
	sub_total +='<input type="text" name="data[Health][total_amount]" value="'+f_val+'" id="HealthTotalAmount">';
	$('#SubTotal').html(sub_total);
	var tot_amt_t_p_o_final = 'Rs. '+parseInt(curr_tot_amt-val2);
	$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
	$('#selected_profile_desc').html(rep_text);
	if(result1 != '')
	{
		var getTestAmt = document.getElementById('ProfileAmt').innerHTML;
		var NewTestAmt = parseInt(getTestAmt-val2);
		$('#ProfileAmt').html(NewTestAmt);
	}
	$('#ProfileIds').html(test_ids);
	$('#selectedp'+val).remove();
}


function add_offer(val)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/add_offer_list?req_id='+val,
		success:function(data){
			var datum=data.split('*');
			if($('#OfferCheck'+datum[0]).attr('checked'))
			{
				var a = parseInt(document.getElementById('OfferAmt').innerHTML);
				if(a == 0)
				{
					var b = parseInt(datum[3]);
					$('#OfferAmt').text(b);
					var offer_length = $('#HealthOfferId').length;
					if(offer_length == 0)
					{
						var offer_ids = '';
						offer_ids +='<td>';
						offer_ids +='<input type="text" name="data[Health][offer_id]" value="'+datum[0]+'" id="HealthOfferId">';
						offer_ids +='</td>';
						$('#OfferIds').html(offer_ids);
					}
					if(offer_length != 0)
					{
						var get_curr_ids = document.getElementById('HealthOfferId').value;
						var new_offer_value = get_curr_ids+','+datum[0];
						var offer_ids = '';
						offer_ids +='<td>';
						offer_ids +='<input type="text" name="data[Health][offer_id]" value="'+new_offer_value+'" id="HealthOfferId">';
						offer_ids +='</td>';
						$('#OfferIds').html(offer_ids);
					}
				}
				if(a != 0)
				{
					var b = parseInt(datum[3]);
					var c = parseInt(a+b);
					$('#OfferAmt').text(c);
					var offer_length = $('#HealthOfferId').length;
					if(offer_length == 0)
					{
						var get_curr_ids = document.getElementById('HealthOfferId').value;
						var new_offer_val = get_curr_ids+','+datum[0];
						var offer_ids = '';
						offer_ids +='<td>';
						offer_ids +='<input type="text" name="data[Health][offer_id]" value="'+new_offer_val+'" id="HealthOfferId">';
						offer_ids +='</td>';
						$('#OfferIds').html(offer_ids);
					}
					if(offer_length != 0)
					{
						var get_curr_ids = document.getElementById('HealthOfferId').value;
						var new_offer_value = get_curr_ids+','+datum[0];
						var offer_ids = '';
						offer_ids +='<td>';
						offer_ids +='<input type="text" name="data[Health][offer_id]" value="'+new_offer_value+'" id="HealthOfferId">';
						offer_ids +='</td>';
						$('#OfferIds').html(offer_ids);
					}
				}
			}
			else
			{
				var a = parseInt(document.getElementById('OfferAmt').innerHTML);
				if(a != 0)
				{
					var x = parseInt(datum[3]);
					var b = a-x;
					var c = parseInt(b);
					$('#OfferAmt').text(c);
					var get_curr_ids = document.getElementById('HealthOfferId').value;
					var result1 = $.grep(get_curr_ids.split(','), function(v) { return v != datum[0]; }).join(',');
					var offer_ids = '';
					offer_ids +='<td>';
					offer_ids +='<input type="text" name="data[Health][offer_id]" value="'+result1+'" id="HealthOfferId">';
					offer_ids +='</td>';
					$('#OfferIds').html(offer_ids);
				}
			}
			$('#OfferProcess').hide();
		},
		beforeSend:function(){
			jQuery('#OfferProcess').show();
		},
		
	});
}

function confirm_offer_submit()
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/get_all_offer',
		dataType:'json',
		success:function(data){
			if(data.test_info.success == 'success')
			{
				if(data.test_info.test_data.length != 0)
				{
					var rep_div = '';
					rep_div +='<td width="15%" class="boldText">Selected Special Offer(s)</td>';
					rep_div +='<td id="selected_offer_desc">';
					rep_div +='<table border="0" width="100%" style="margin:-8px 0 0 0;">';
					var g = 0;
					jQuery.each(data.test_info.test_data,function(index, value)
					{
						if(document.getElementById('selectedo'+value.Banner.id))
						{
							rep_div +='<tr id="selectedo'+value.Banner.id+'">';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Banner.banner_code+' - '+value.Banner.banner_name+' - Rs.'+value.Banner.banner_mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_offer('+value.Banner.id+','+value.Banner.banner_mrp+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else
						{
							if($('#OfferCheck'+value.Banner.id).attr('checked'))
							{
								rep_div +='<tr id="selectedo'+value.Banner.id+'">';
								rep_div +='<td>';
								rep_div +=parseInt(g+1)+'- '+value.Banner.banner_code+' - '+value.Banner.banner_name+' - Rs.'+value.Banner.banner_mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_offer('+value.Banner.id+','+value.Banner.banner_mrp+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
								rep_div +='</td>';
								rep_div +='</tr>';
								g = parseInt(g+1);
							}	
						}
					});
					if(g == 0)
					{
						rep_div_heading_offer = 'Special Offer(s)';
						rep_div_link_offer = '';
						rep_div_link_offer +='Click to open Special Offer List';
					}
					else
					{
						rep_div_heading_offer = '';
						rep_div_link_offer = '';
						rep_div_link_offer +='Change Special Offer';
					}
					rep_div +='</table>';
					rep_div +='</td>';
				}
				if(g == 0)
				{
					$('#ClickOfferNew').remove();
				}
				var w = document.getElementById('OfferCount').innerHTML;
				var ww = parseInt(w+1);
				$('#OfferCount').html(ww);
				$('#OfferCount').hide();
				$('#ChangeOfferHeading').html(rep_div_heading_offer);
				$('#ChangeOfferNewLink').html(rep_div_link_offer);
				$('#ClickOfferNew').html(rep_div);
				//$('#ClickOffer').hide();
				jQuery('#ConfirmFinalOffer').hide();
				$('#signup-Div-Offer').hide();
				$('.js_lb_overlay').css({'opacity':'0'});
				var test_amt = $('#TestAmt').length;
				var profile_amt = $('#ProfileAmt').length;
				var offer_amt = $('#OfferAmt').length;
				var package_amt = $('#PackageAmt').length;
				var service_amt = $('#ServiceAmt').length;
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var tot_amt_t_p_o_final = 'Rs. 0';
					$('#t_f_a_t_p_o_r').hide();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = 0;
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalOffer').show();
		},
		
	});
}

function remove_sel_offer(val,val2)
{
	var curr_tot_amt = document.getElementById('HealthTotalAmount').value;
	var get_curr_ids = document.getElementById('HealthOfferId').value;
	var result1 = $.grep(get_curr_ids.split(','), function(v) { return v != val; }).join(',');
	if(result1 == '')
	{
		var rep_text = '';
		rep_text +='No Special Offer Selected';	
		var OfferAmt = 0;
		$('#OfferAmt').html(NewTestAmt);
		
	}
	var test_ids = '';
	test_ids +='<td>';
	test_ids +='<input type="text" name="data[Health][offer_id]" value="'+result1+'" id="HealthOfferId">';
	test_ids +='</td>';
	var f_val = parseInt(curr_tot_amt-val2);
	var sub_total = '';
	sub_total +='<input type="text" name="data[Health][total_amount]" value="'+f_val+'" id="HealthTotalAmount">';
	$('#SubTotal').html(sub_total);
	var tot_amt_t_p_o_final = 'Rs. '+parseInt(curr_tot_amt-val2);
	$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
	$('#selected_offer_desc').html(rep_text);
	if(result1 != '')
	{
		var getTestAmt = document.getElementById('OfferAmt').innerHTML;
		var NewTestAmt = parseInt(getTestAmt-val2);
		$('#OfferAmt').html(NewTestAmt);
	}
	$('#OfferIds').html(test_ids);
	$('#selectedo'+val).remove();
}

function add_package(val)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/add_package_list?req_id='+val,
		success:function(data){
			var datum=data.split('*');
			if($('#PackageCheck'+datum[0]).attr('checked'))
			{
				var a = parseInt(document.getElementById('PackageAmt').innerHTML);
				if(a == 0)
				{
					var b = parseInt(datum[2]);
					$('#PackageAmt').text(b);
					var package_length = $('#HealthPackageId').length;
					if(package_length == 0)
					{
						var package_ids = '';
						package_ids +='<td>';
						package_ids +='<input type="text" name="data[Health][package_id]" value="'+datum[0]+'" id="HealthPackageId">';
						package_ids +='</td>';
						$('#PackageIds').html(package_ids);
					}
					if(package_length != 0)
					{
						var get_curr_ids = document.getElementById('HealthPackageId').value;
						var new_package_value = get_curr_ids+','+datum[0];
						var package_ids = '';
						package_ids +='<td>';
						package_ids +='<input type="text" name="data[Health][package_id]" value="'+new_package_value+'" id="HealthPackageId">';
						package_ids +='</td>';
						$('#PackageIds').html(package_ids);
					}
				}
				if(a != 0)
				{
					var b = parseInt(datum[2]);
					var c = parseInt(a+b);
					$('#PackageAmt').text(c);
					var package_length = $('#HealthPackageId').length;
					if(package_length == 0)
					{
						var get_curr_ids = document.getElementById('HealthPackageId').value;
						var new_package_val = get_curr_ids+','+datum[0];
						var package_ids = '';
						package_ids +='<td>';
						package_ids +='<input type="text" name="data[Health][package_id]" value="'+new_package_val+'" id="HealthPackageId">';
						package_ids +='</td>';
						$('#PackageIds').html(package_ids);
					}
					if(package_length != 0)
					{
						var get_curr_ids = document.getElementById('HealthPackageId').value;
						var new_package_value = get_curr_ids+','+datum[0];
						var package_ids = '';
						package_ids +='<td>';
						package_ids +='<input type="text" name="data[Health][package_id]" value="'+new_package_value+'" id="HealthPackageId">';
						package_ids +='</td>';
						$('#PackageIds').html(package_ids);
					}
				}
			}
			else
			{
				var a = parseInt(document.getElementById('PackageAmt').innerHTML);
				if(a != 0)
				{
					var x = parseInt(datum[2]);
					var b = a-x;
					var c = parseInt(b);
					$('#PackageAmt').text(c);
					var get_curr_ids = document.getElementById('HealthPackageId').value;
					var result1 = $.grep(get_curr_ids.split(','), function(v) { return v != datum[0]; }).join(',');
					var package_ids = '';
					package_ids +='<td>';
					package_ids +='<input type="text" name="data[Health][package_id]" value="'+result1+'" id="HealthPackageId">';
					package_ids +='</td>';
					$('#PackageIds').html(package_ids);
				}
			}
			$('#PackageProcess').hide();
		},
		beforeSend:function(){
			jQuery('#PackageProcess').show();
		},
		
	});
}

function confirm_package_submit()
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/get_all_package',
		dataType:'json',
		success:function(data){
			if(data.test_info.success == 'success')
			{
				if(data.test_info.test_data.length != 0)
				{
					var rep_div = '';
					rep_div +='<td width="15%" class="boldText">Selected Niramaya Package(s)</td>';
					rep_div +='<td id="selected_package_desc">';
					rep_div +='<table border="0" width="100%" style="margin:-8px 0 0 0;">';
					var g = 0;
					jQuery.each(data.test_info.test_data,function(index, value)
					{
						var h = document.getElementById('HealthPackageId').value;
						var pack_sel_count = h.split(',');
						if(pack_sel_count[0] == value.Package.id)
						{
							rep_div +='<tr id="selectedpack'+g+'">';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Package.package_code+' - '+value.Package.package_name+' - Rs.'+value.Package.package_mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_package('+g+','+value.Package.package_mrp+','+value.Package.id+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						if(pack_sel_count[1] == value.Package.id)
						{
							rep_div +='<tr id="selectedpack'+g+'">';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Package.package_code+' - '+value.Package.package_name+' - Rs.'+value.Package.package_mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_package('+g+','+value.Package.package_mrp+','+value.Package.id+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						if(pack_sel_count[2] == value.Package.id)
						{
							rep_div +='<tr id="selectedpack'+g+'">';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Package.package_code+' - '+value.Package.package_name+' - Rs.'+value.Package.package_mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_package('+g+','+value.Package.package_mrp+','+value.Package.id+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						if(pack_sel_count[3] == value.Package.id)
						{
							rep_div +='<tr id="selectedpack'+g+'">';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Package.package_code+' - '+value.Package.package_name+' - Rs.'+value.Package.package_mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_package('+g+','+value.Package.package_mrp+','+value.Package.id+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						if(pack_sel_count[4] == value.Package.id)
						{
							rep_div +='<tr id="selectedpack'+g+'">';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Package.package_code+' - '+value.Package.package_name+' - Rs.'+value.Package.package_mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_package('+g+','+value.Package.package_mrp+','+value.Package.id+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						//if(document.getElementById('selectedpack'+value.Package.id))
//						{
//							rep_div +='<tr id="selectedpack"'+value.Package.id+'>';
//							rep_div +='<td>';
//							rep_div +=parseInt(g+1)+'- '+value.Package.package_name+' - Rs.'+value.Package.package_mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_package('+value.Package.id+','+value.Package.package_mrp+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
//							rep_div +='</td>';
//							rep_div +='</tr>';
//							g = parseInt(g+1);
//						}
//						else
//						{
//							if($('#PackageCheck'+value.Package.id).attr('checked'))
//							{
//								rep_div +='<tr id="selectedpack'+value.Package.id+'">';
//								rep_div +='<td>';
//								rep_div +=parseInt(g+1)+'- '+value.Package.package_name+' - Rs.'+value.Package.package_mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_package('+value.Package.id+','+value.Package.package_mrp+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
//								rep_div +='</td>';
//								rep_div +='</tr>';
//								g = parseInt(g+1);
//							}	
//						}
					});
					if(g == 0)
					{
						rep_div_heading_package = 'Niramaya Package(s)';
						rep_div_link_package = '';
						rep_div_link_package +='Click to open Niramaya Package List';
					}
					else
					{
						rep_div_heading_package = '';
						rep_div_link_package = '';
						rep_div_link_package +='Change Niramaya Package';
					}
					rep_div +='</table>';
					rep_div +='</td>';
				}
				if(g == 0)
				{
					$('#ClickPackageNew').remove();
				}
				var w = document.getElementById('PackageCount').innerHTML;
				var ww = parseInt(w+1);
				$('#PackageCount').html(ww);
				$('#PackageCount').hide();
				$('#ChangePackageHeading').html(rep_div_heading_package);
				$('#ChangePackageNewLink').html(rep_div_link_package);
				$('#ClickPackageNew').html(rep_div);
				jQuery('#ConfirmFinalPackage').hide();
				$('#signup-Div-Package').hide();
				$('.js_lb_overlay').css({'opacity':'0'});
				var test_amt = $('#TestAmt').length;
				var profile_amt = $('#ProfileAmt').length;
				var offer_amt = $('#OfferAmt').length;
				var package_amt = $('#PackageAmt').length;
				var service_amt = $('#ServiceAmt').length;
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var tot_amt_t_p_o_final = 'Rs. 0';
					$('#t_f_a_t_p_o_r').hide();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = 0;
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalPackage').show();
		},
		
	});
}


function remove_sel_package(val,val2,val3)
{
	var curr_tot_amt = document.getElementById('HealthTotalAmount').value;
	var get_curr_ids = document.getElementById('HealthPackageId').value;
	var result1 = get_curr_ids.split(',');
	var arr = '';
	var i = 0;
	result1 = result1.sort();
	jQuery.each(result1,function(index, value)
	{
		if((value == val3) && (i == val))
		{
			i = parseInt(i+1);
		}
		else
		{
			if(i == 0)
			{
				arr = value;
			}
			else
			{
				arr = arr+','+value;
			}
			i = parseInt(i+1);
		}
	});
	//alert('hiiiiiiiiiii');
	result1 = arr;
	//alert(result1);
	if(result1 == '')
	{
		var rep_text = '';
		rep_text +='No Niramaya Package Selected';	
		var PackageAmt = 0;
		$('#PackageAmt').html(NewTestAmt);
	}
	var test_ids = '';
	test_ids +='<td>';
	test_ids +='<input type="text" name="data[Health][package_id]" value="'+result1+'" id="HealthPackageId">';
	test_ids +='</td>';
	var f_val = parseInt(curr_tot_amt-val2);
	var sub_total = '';
	sub_total +='<input type="text" name="data[Health][total_amount]" value="'+f_val+'" id="HealthTotalAmount">';
	$('#SubTotal').html(sub_total);
	var tot_amt_t_p_o_final = 'Rs. '+parseInt(curr_tot_amt-val2);
	$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
	$('#selected_package_desc').html(rep_text);
	if(result1 != '')
	{
		var getTestAmt = document.getElementById('PackageAmt').innerHTML;
		var NewTestAmt = parseInt(getTestAmt-val2);
		$('#PackageAmt').html(NewTestAmt);
	}
	$('#PackageIds').html(test_ids);
	$('#selectedpack'+val).remove();
}

function add_service(val)
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/add_service_list?req_id='+val,
		success:function(data){
			var datum=data.split('*');
			
			
			if($('#ServiceCheck'+datum[0]).attr('checked'))
			{
				var a = parseInt(document.getElementById('ServiceAmt').innerHTML);
				
				if(a == 0)
				{
					
					var b = parseInt(datum[3]);
					$('#ServiceAmt').text(b);
					var test_length = $('#HealthServiceId').length;
					if(test_length == 0)
					{
						var test_ids = '';
						test_ids +='<td>';
						test_ids +='<input type="text" name="data[Health][service_id]" value="'+datum[0]+'" id="HealthServiceId">';
						test_ids +='</td>';
						$('#ServiceIds').html(test_ids);
					}
					else
					{
						var get_curr_ids = document.getElementById('HealthServiceId').value;
						var new_test_value = get_curr_ids+','+datum[0];
						var test_ids = '';
						test_ids +='<td>';
						test_ids +='<input type="text" name="data[Health][service_id]" value="'+new_test_value+'" id="HealthServiceId">';
						test_ids +='</td>';
						$('#ServiceIds').html(test_ids);
					}
				}
				if(a != 0)
				{
					
					var b = parseInt(datum[3]);
					var c = parseInt(a+b);
					$('#ServiceAmt').text(c);
					var test_length = $('#HealthServiceId').length;
					if(test_length == 0)
					{
						var get_curr_ids = document.getElementById('HealthServiceId').value;
						var new_test_val = get_curr_ids+','+datum[0];
						var test_ids = '';
						test_ids +='<td>';
						test_ids +='<input type="text" name="data[Health][service_id]" value="'+new_test_val+'" id="HealthServiceId">';
						test_ids +='</td>';
						$('#ServiceIds').html(test_ids);
					}
					else
					{
						var get_curr_ids = document.getElementById('HealthServiceId').value;
						var new_test_value = get_curr_ids+','+datum[0];
						var test_ids = '';
						test_ids +='<td>';
						test_ids +='<input type="text" name="data[Health][service_id]" value="'+new_test_value+'" id="HealthServiceId">';
						test_ids +='</td>';
						$('#ServiceIds').html(test_ids);
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
					test_ids +='<input type="text" name="data[Health][test_id]" value="'+result1+'" id="HealthTestId">';
					test_ids +='</td>';
					$('#TestIds').html(test_ids);
				}
			}
			$('#ServiceProcess').hide();
		},
		beforeSend:function(){
			jQuery('#ServiceProcess').show();
		},
		
	});
}

function confirm_service_submit()
{
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/get_all_service',
		dataType:'json',
		success:function(data){
			if(data.test_info.success == 'success')
			{
				if(data.test_info.test_data.length != 0)
				{
					var rep_div = '';
					rep_div +='<td width="15%" class="boldText">Selected Patient Care Services</td>';
					rep_div +='<td id="selected_service_desc">';
					rep_div +='<table border="0" width="100%" style="margin:-8px 0 0 0;">';
					var g = 0;
					jQuery.each(data.test_info.test_data,function(index, value)
					{
						if(document.getElementById('selected'+value.Test.id))
						{
							rep_div +='<tr id="selected'+value.Test.id+'">';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_service('+value.Test.id+','+value.Test.mrp+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else
						{
							if($('#ServiceCheck'+value.Test.id).attr('checked'))
							{
								rep_div +='<tr id="selected'+value.Test.id+'">';
								rep_div +='<td>';
								rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+'&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_sel_service('+value.Test.id+','+value.Test.mrp+');" style="color:#FF0000; font-weight:bold; text-decoration:none;">[X]</a>';
								rep_div +='</td>';
								rep_div +='</tr>';
								g = parseInt(g+1);
							}
						
						}
					});
					if(g == 0)
					{
						rep_div_heading = 'Patient Care Services';
						rep_div_link = '';
						rep_div_link +='Click to open Patient Care Services List';
					}
					else
					{
						rep_div_heading = '';
						rep_div_link = '';
						rep_div_link +='Change Patient Care Services';
					}
					rep_div +='</table>';
					rep_div +='</td>';
				}
				if(g == 0)
				{
					$('#ClickServiceNew').remove();
				}
				var w = document.getElementById('ServiceCount').innerHTML;
				var ww = parseInt(w+1);
				$('#ServiceCount').html(ww);
				$('#ServiceCount').hide();
				$('#ChangeServiceHeading').html(rep_div_heading);
				$('#ChangeServiceNewLink').html(rep_div_link);
				$('#ClickServiceNew').html(rep_div);
				//$('#ClickTest').hide();
				jQuery('#ConfirmFinalService').hide();
				$('#signup-Div-Service').hide();
				$('.js_lb_overlay').css({'opacity':'0'});
				var test_amt = $('#TestAmt').length;
				var profile_amt = $('#ProfileAmt').length;
				var offer_amt = $('#OfferAmt').length;
				var package_amt = $('#PackageAmt').length;
				var service_amt = $('#ServiceAmt').length;
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r+s);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(q+r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = parseInt(p+q+r+s+t);
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var tot_amt_t_p_o_final = 'Rs. 0';
					$('#t_f_a_t_p_o_r').hide();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var total_amount = 0;
					var sub_total = '';
					sub_total +='<input type="text" name="data[Health][total_amount]" value="'+total_amount+'" id="HealthTotalAmount">';
					$('#SubTotal').html(sub_total);
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalService').show();
		},
		
	});
}

function remove_sel_service(val,val2)
{
	var curr_tot_amt = document.getElementById('HealthTotalAmount').value;
	var get_curr_ids = document.getElementById('HealthServiceId').value;
	var result1 = $.grep(get_curr_ids.split(','), function(v) { return v != val; }).join(',');
	if(result1 == '')
	{
		var rep_text = '';
		rep_text +='No Patient Care Services Selected';	
		var TestAmt = 0;
		$('#ServiceAmt').html(ServiceAmt);
	}
	var test_ids = '';
	test_ids +='<td>';
	test_ids +='<input type="text" name="data[Health][service_id]" value="'+result1+'" id="HealthServiceId">';
	test_ids +='</td>';
	var f_val = parseInt(curr_tot_amt-val2);
	var sub_total = '';
	sub_total +='<input type="text" name="data[Health][total_amount]" value="'+f_val+'" id="HealthTotalAmount">';
	$('#SubTotal').html(sub_total);
	var tot_amt_t_p_o_final = 'Rs. '+parseInt(curr_tot_amt-val2);
	$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
	$('#selected_service_desc').html(rep_text);
	if(result1 != '')
	{
		var getTestAmt = document.getElementById('ServiceAmt').innerHTML;
		var NewTestAmt = parseInt(getTestAmt-val2);
		$('#ServiceAmt').html(NewTestAmt);
	}
	$('#ServiceIds').html(test_ids);
	$('#selected'+val).remove();
}


function search_user()
{
	var search_val = document.getElementById('HealthUser').value;
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/search_user?req_val='+search_val,
		dataType:'json',
		success:function(data){
			if(data.user_info.success == 'success')
			{
				var rep_div = '';
				if(data.user_info.user_list.length != 0)
				{
					rep_div +='<td width="15%" class="boldText">&nbsp;</td>';
					rep_div +='<td>';
					rep_div +='<table border="0" width="100%">';
					
					jQuery.each(data.user_info.user_list,function(index, value)
					{
						rep_div +='<tr>';
						rep_div +='<td>';
						rep_div +='<input type="radio" name="data[Health][username]" value="'+value.User.id+'" id="HealthUsername'+index+'">&nbsp;&nbsp;'+value.User.name+' - '+value.User.email+' - '+value.User.contact+' - '+value.User.age;
						rep_div +='</td>';
						rep_div +='</tr>';
					});
					rep_div +='<tr>';
					rep_div +='<td>';
					rep_div +='<a href="javascript:void(0);" onclick="get_user_detail('+data.user_info.user_list.length+');" style="color:#0066CC;">Confirm</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="new_patient();" style="color:#0066CC;">New Patient</a>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40,'style'=>'margin:0 0 -13px; display:none;','id'=>'ConfirmImage'));?>';
					rep_div +='</td>';
					rep_div +='</tr>';
					rep_div +='<tr id="RadioChecked" style="display:none;">';
					rep_div +='</tr>';
					rep_div +='</table>';
					rep_div +='</td>';
					$('#UserList').show();
					$('#UserList').html(rep_div);
					$('#SearchUserImg').hide();
				}
			}
			if(data.user_info.success == 'notsuccess')
			{
				var rep_div = '';
				rep_div +='<td width="15%" class="boldText">&nbsp;</td>';
				rep_div +='<td style="color:#FF0000;">No User Found&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="new_patient();" style="color:#0066CC;">New Patient</a></td>';
				$('#UserList').show();
				$('#UserList').html(rep_div);
				$('#SearchUserImg').hide();
			}
			if(data.user_info.success == 'notsuccessnull')
			{
				var rep_div = '';
				rep_div +='<td width="15%" class="boldText">&nbsp;</td>';
				rep_div +='<td style="color:#FF0000;">Please enter name OR email OR mobile for search user</td>';
				$('#UserList').show();
				$('#UserList').html(rep_div);
				$('#SearchUserImg').hide();
			}
		},
		beforeSend:function(){
			jQuery('#SearchUserImg').show();
		},
		
	});
}


function get_user_detail(val)
{
	for (var i=0; i < val; i++)
	{
		if ($("#HealthUsername"+i).is(":checked")) 
		{
			var user_id = document.getElementById('HealthUsername'+i).value;
			jQuery.ajax({
				type:'GET',
				url:siteUrl+'admin/samples/get_user_detail?user_id='+user_id,
				dataType:'json',
				success:function(data){
					//Code For Inserting BMI value Starts
					jQuery('#PatWeight').hide();
					jQuery('#PatHeightOpt').hide();
					jQuery('#PatHeightCm').hide();
					jQuery('#PatHeight').hide();
					jQuery('#PatBPSystolic').hide();
					jQuery('#PatBPTime').hide();
					jQuery('#PatientBpDate').hide();
					jQuery('#VitalHeadInfo').hide();
					//Code For Inserting BMI value Ends
					if(data.user_info.success == 'success')
					{
						var currentdate = new Date(); 
						var refdatetime = currentdate.getDate() + ""
			                + (currentdate.getMonth()+1)  + "" 
			                + currentdate.getFullYear() + ""  
			                + currentdate.getHours() + ""  
			                + currentdate.getMinutes() + "" 
			                + currentdate.getSeconds();

						var InputMemberName = '';
						var InputMemberGender = '';
						var InputMemberAge = '';
						var InputMemberContact = '';
						var InputMemberEmail = '';
						var InputMemberAltContact = '';
						var InputMemberAltEmail = '';
						var InputMemberAddress1 = '';
						var InputMemberAddress2 = '';
						var InputMemberLocality = '';
						var InputMemberCity = '';
						var InputMemberState = '';
						var InputMemberPincode = '';
						var InputMemberLandmark = '';
						var InputMemberMrn='';
						var InputMemberReference='';
						
						InputMemberMrn +='<td width="15%" class="boldText">Medical Record NO</td>';
						InputMemberMrn +='<td>';
						InputMemberMrn +='<input type="text" name="data[Health][medical_reference_number]" class="input-text" id="HealthMedicalReferenceNumber" style="color:#666666;" value="'+data.user_info.user_data.User.id+'">';
						InputMemberMrn +='<div id="msg1" style="color:#FF0000; font-size:12px;"></div>';
						InputMemberMrn +='</td>';
						$('#InputMemberMrn').html(InputMemberMrn);

						InputMemberReference +='<td width="15%" class="boldText">Reference No.</td>';
						InputMemberReference +='<td>';
						InputMemberReference +='<input type="text" name="data[Health][reference]" class="input-text" id="HealthReference" style="color:#666666;" value="'+data.user_info.user_data.User.id+'-'+refdatetime+'">';
						InputMemberReference +='<div id="msg1" style="color:#FF0000; font-size:12px;"></div>';
						InputMemberReference +='</td>';
						$('#InputMemberReference').html(InputMemberReference);

						InputMemberName +='<td width="15%" class="boldText">Patient Name <font color="#FF0000">*</font></td>';
						InputMemberName +='<td>';
						InputMemberName +='<input type="text" name="data[Health][name]" class="input-text" id="HealthName" style="color:#666666;" value="'+data.user_info.user_data.User.name+'">';
						InputMemberName +='<div id="msg1" style="color:#FF0000; font-size:12px;"></div>';
						InputMemberName +='</td>';
						$('#InputMemberName').html(InputMemberName);
						
						InputMemberGender +='<td width="15%" class="boldText">Gender of Patient <font color="#FF0000">*</font></td>';
						InputMemberGender +='<td>';
						InputMemberGender +='<select name="data[Health][gender]" id="HealthGender" class="input-text">';
						InputMemberGender +='<option value="">Select Gender</option>';
						if(data.user_info.user_data.User.gender == 1)
						{
							InputMemberGender +='<option value="1" selected="selected">Male</option>';
							InputMemberGender +='<option value="2">Female</option>';
						}
						if(data.user_info.user_data.User.gender == 2)
						{
							InputMemberGender +='<option value="1">Male</option>';
							InputMemberGender +='<option value="2" selected="selected">Female</option>';
						}
						InputMemberGender +='</select>';
						InputMemberGender +='<div id="msg2" style="color:#FF0000; font-size:12px;"></div>';
						InputMemberGender +='</td>';
						$('#InputMemberGender').html(InputMemberGender);
						
						InputMemberAge +='<td width="15%" class="boldText">Patient Age <font color="#FF0000">*</font></td>';
						InputMemberAge +='<td>';
						InputMemberAge +='<input type="text" name="data[Health][age]" class="input-text" id="HealthAge" style="width:50px;" value="'+data.user_info.user_data.User.age+'">';
						InputMemberAge +='<div id="msg3" style="color:#FF0000; font-size:12px;"></div>';
						InputMemberAge +='</td>';
						$('#InputMemberAge').html(InputMemberAge);
						
						InputMemberContact +='<td width="15%" class="boldText">Contact Number <font color="#FF0000">*</font></td>';
						InputMemberContact +='<td>';
						InputMemberContact +='<input type="text" name="data[Health][landline]" class="input-text phone" onkeypress="return checknum(event)" maxlength="10" minlength="10" id="HealthLandline" style="color:#666666;" value="'+data.user_info.user_data.User.contact+'">';
						InputMemberContact +='<div id="msg5" style="color:#FF0000; font-size:12px;"></div>';
						InputMemberContact +='</td>';
						$('#InputMemberContact').html(InputMemberContact);
						
						InputMemberAltContact +='<td width="15%" class="boldText">Alternate Contact Number <font color="#FF0000"></font></td>';
						InputMemberAltContact +='<td>';
						InputMemberAltContact +='<input type="text" name="data[Health][alternate_contact]" class="input-text phone" onkeypress="return checknum(event)" maxlength="10" minlength="10" id="HealthAltLandline" style="color:#666666;" value="'+data.user_info.user_data.User.alternate_contact+'">';
						InputMemberAltContact +='</td>';
						$('#InputMemberAltContact').html(InputMemberAltContact);
						
						InputMemberEmail +='<td width="15%" class="boldText">Email ID <font color="#FF0000">*</font></td>';
						InputMemberEmail +='<td>';
						InputMemberEmail +='<input type="text" name="data[Health][email]" class="input-text" id="HealthEmail" style="color:#666666;" value="'+data.user_info.user_data.User.email+'">';
						InputMemberEmail +='</td>';
						$('#InputMemberEmail').html(InputMemberEmail);
						
						InputMemberAltEmail +='<td width="15%" class="boldText">Alternate Email ID <font color="#FF0000"></font></td>';
						InputMemberAltEmail +='<td>';
						InputMemberAltEmail +='<input type="text" name="data[Health][alternate_email]" class="input-text" id="HealthAltEmail" style="color:#666666;" value="'+data.user_info.user_data.User.alternate_email+'">';
						InputMemberAltEmail +='</td>';
						$('#InputMemberAltEmail').html(InputMemberAltEmail);
						
						InputMemberAddress1 +='<td width="15%" class="boldText">Address <font color="#FF0000">*</font></td>';
						InputMemberAddress1 +='<td>';
						InputMemberAddress1 +='<input type="text" name="data[Health][address1]" class="input-text" id="HealthAddress1" value="'+data.user_info.add_line1+'"';
						InputMemberAddress1 +='</td>';
						$('#InputMemberAddress1').html(InputMemberAddress1);
						
						InputMemberAddress2 +='<td width="15%" class="boldText">&nbsp;</td>';
						InputMemberAddress2 +='<td>';
						InputMemberAddress2 +='<input type="text" name="data[Health][address2]" class="input-text" id="HealthAddress2" style="color:#666666;" value="'+data.user_info.add_line2+'">';
						InputMemberAddress2 +='<div id="msg7" style="color:#FF0000; font-size:12px;"></div>';
						InputMemberAddress2 +='</td>';
						$('#InputMemberAddress2').html(InputMemberAddress2);
						
											
						$('#HealthCityId option[value='+data.user_info.user_data.User.city+']').attr('selected','selected');						
						$('#HealthState option[value='+data.user_info.user_data.User.state+']').attr('selected','selected');
						
						InputMemberPincode +='<td width="15%" class="boldText">Pincode <font color="#FF0000">*</font></td>';
						InputMemberPincode +='<td>';
						InputMemberPincode +='<input onkeyup="getcitystate();" type="text" name="data[Health][pincode]" class="input-text" id="HealthPincode" style="color:#666666;" value="'+data.user_info.user_data.User.pincode+'">';
						InputMemberPincode +='<div id="msg11" style="color:#FF0000; font-size:12px;"></div>';
						InputMemberPincode +='</td>';
						$('#InputMemberPincode').html(InputMemberPincode);
						
						InputMemberLandmark +='<td width="15%" class="boldText">Landmark <font color="#FF0000">*</font></td>';
						InputMemberLandmark +='<td>';
						InputMemberLandmark +='<input type="text" name="data[Health][landmark]" class="input-text" id="HealthLandmark" style="color:#666666;" value="'+data.user_info.user_data.User.landmark+'">';
						InputMemberLandmark +='<div id="msg12" style="color:#FF0000; font-size:12px;"></div>';
						InputMemberLandmark +='</td>';
						$('#InputMemberLandmark').html(InputMemberLandmark);
						
						var user_id = '';
						user_id +='<td>';
						user_id +='<input type="hidden" name="data[Health][user_id]" value="'+data.user_info.user_data.User.id+'">';
						user_id +='</td>';
						
						$('#PatientOtherInfo').show();
						$('#MemberName').hide();	
						$('#UserList').html(user_id);
						$('#UserList').hide();
						$('#ConfirmImage').hide();	
						$('#SearchExistPatient').hide();
					}
				},
				beforeSend:function(){
					jQuery('#ConfirmImage').show();
				},
				
			});
		}
	}
}
function getcitystate()
{
	var pin = $('#HealthPincode').val();
	if(pin.length==6)
	{
		document.getElementById("msg11").innerHTML="";
		jQuery.ajax({
			type:'GET',
			url:siteUrl+'admin/samples/getcitystate?pin='+pin,
			success: function(response) {
			console.log(response);
				$('#HealthCityId option[value='+response["city"]+']').attr('selected','selected');						
				$('#HealthState option[value='+response["state"]+']').attr('selected','selected');
				var locality_rep = '<option value="">Select Locality</option>';
				for(var i=0;i<response["locality"].length;i++)
				{
					locality_rep += '<option value='+response["locality"][i].replace(" ","_")+'>'+response['locality'][i]+'</option>';
				}
				$('#HealthLocality').html(locality_rep);	
			},
			 dataType:"json"
		});
		
	}
	else{
		document.getElementById("msg11").innerHTML="Please Enter valid Pincode";
	}
}

function getcitystate1()
{
	var pin = $('#HealthPincodeId').val();
	if(pin.length==6)
	{
		document.getElementById("msg11").innerHTML="";
		jQuery.ajax({
			type:'GET',
			url:siteUrl+'admin/samples/getcitystate?pin='+pin,
			success: function(response) {
			console.log(response);
				$('#HealthCity option[value='+response["city"]+']').attr('selected','selected');						
				$('#HealthStateid option[value='+response["state"]+']').attr('selected','selected');
				var locality_rep = '<option value="">Select Locality</option>';
				for(var i=0;i<response["locality"].length;i++)
				{
					locality_rep += '<option value='+response["locality"][i].replace(" ","_")+'>'+response['locality'][i]+'</option>';
				}
				$('#HealthLocalityId').html(locality_rep);	
			},
			 dataType:"json"
		});
		
	}
	else{
		document.getElementById("msg11").innerHTML="Please Enter valid Pincode";
	}
}

function hide_test()
{
	$('#signup-Div').hide();
	$('.js_lb_overlay').css({'opacity':'0'});
}

function hide_profile()
{
	$('#signup-Div-Profile').hide();
	$('.js_lb_overlay').css({'opacity':'0'});
}

function hide_offer()
{
	$('#signup-Div-Offer').hide();
	$('.js_lb_overlay').css({'opacity':'0'});
}

function hide_package()
{
	$('#signup-Div-Package').hide();
	$('.js_lb_overlay').css({'opacity':'0'});
}

function hide_service()
{
	$('#signup-Div-Service').hide();
	$('.js_lb_overlay').css({'opacity':'0'});
}

</script>
<div id="signup-Div"> <a id="close-one" class="close" href="javascript:void(0);" onclick="hide_test();"><?php echo $html->image('close-one.jpg');?></a>
	<div id="TestList"></div>
	<div id="TestProcessNew" style="display:none;"><?php echo $html->image('frontend/loading.gif',array('style'=>'top:190px; left:265px; position:absolute;'));?></div>
</div>
<div id="signup-Div-Profile"> <a id="close-one" class="close" href="javascript:void(0);" onclick="hide_profile();"><?php echo $html->image('close-one.jpg');?></a>
	<div id="ProfileList"></div>
	<div id="ProfileProcessNew" style="display:none;"><?php echo $html->image('frontend/loading.gif',array('style'=>'top:190px; left:265px; position:absolute;'));?></div>
</div>
<div id="signup-Div-Offer"> <a id="close-one" class="close" href="javascript:void(0);" onclick="hide_offer();"><?php echo $html->image('close-one.jpg');?></a>
	<div id="OfferList"></div>
	<div id="OfferProcessNew" style="display:none;"><?php echo $html->image('frontend/loading.gif',array('style'=>'top:190px; left:265px; position:absolute;'));?></div>
</div>
<div id="signup-Div-Package"> <a id="close-one" class="close" href="javascript:void(0);" onclick="hide_package();"><?php echo $html->image('close-one.jpg');?></a>
	<div id="PackageList"></div>
	<div id="PackageProcessNew" style="display:none;"><?php echo $html->image('frontend/loading.gif',array('style'=>'top:115px; left:265px; position:absolute;'));?></div>
</div>
<div id="signup-Div-Service"> <a id="close-one" class="close" href="javascript:void(0);" onclick="hide_service();"><?php echo $html->image('close-one.jpg');?></a>
	<div id="ServiceList"></div>
	<div id="ServiceProcessNew" style="display:none;"><?php echo $html->image('frontend/loading.gif',array('style'=>'top:115px; left:265px; position:absolute;'));?></div>
</div>


<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Add Sample Request</h2>
    </div>
    <div class="contentbox">
	<?php echo $this->Session->flash(); ?>
	<?php if($usertype != 'Agent') {?>
	<?php echo $html->link('Home', '/admin/samples/index', array('title'=>'Home')); ?> &#187; Add Sample Request
	<?php }?>
	
	<?php echo $form->create(null, array('url'=>'/admin/prescription/add_request','onsubmit'=>'return validationc(this);','id'=>'form1','name'=>'form1')); ?>
	<?php echo $form->hidden('Health.login_type',array('value'=>$LoginType));?>
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
	<tr>
		<td class="boldText error" colspan="2" style="text-align:right;">* Required Fields</td>
	</tr>

	<tr id="UserList"></tr>
	</table>
	<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%" id="PatientOtherInfo">
        <!--booking on behalf of other-->
        <?php
            $admin_u_type = $session->read('Admin.userType');
            if(($admin_u_type == 'A') || ($admin_u_type == 'BM'))
            { ?>
            <tr>
                    <td width="15%" class="boldText">Booking on behalf of</td>
                    <td>
                        <select name="data[Health][created_by]" id="HealthCreatedBy" class="input-text">
                            <option value="">Select Center</option>
                            <?php foreach($pcc_list as $key => $val) {?>
                                    <option value="<?php echo $val['Lab']['id'];?>" <?php if($this->data[Health][created_by]== $val['Lab']['id']) { echo "selected";}?> ><?php echo $val['Lab']['pcc_name'];?> <?php //echo nl2br($val['Lab']['pcc_address']);?></option>
                            <?php }?>
                        </select>
                            <br />
							<div id="msg13" style="color:#FF0000; font-size:12px;"></div>
                    </td>

            </tr>
        <?php } ?>
	<tr id="InputMemberMrn">
                <td width="15%" class="boldText">Medical Record NO</td>
                <td>
                    <?php echo $form->text('Health.medical_reference_number', array('class'=>'input-text')); ?>
                </td>
	</tr>
	<tr id="InputMemberReference">
                <td width="15%" class="boldText">Reference No.</td>
                <td>
                    <?php echo $form->text('Health.reference', array('class'=>'input-text')); ?>
                </td>

        </tr>
        <tr>
                <td width="15%" class="boldText">Booking on behalf of other user</td>
                <td>
                    <select name="data[Health][created_by_agent]" id="HealthCreatedByAgent" class="input-text">
                        <option value="">Select User</option>
                        <?php foreach($agents_booked as $key => $val) {?>

                                <option value="<?php echo $key;?>"><?php echo $val;?></option>
                        <?php }?>
                    </select>
                        <br />
						<div id="msg14" style="color:#FF0000; font-size:12px;"></div>
                </td>

        </tr>
    <!--end here-->
	<tr id="InputMemberName">
		<td width="15%" class="boldText">Patient Name <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.name', array('class'=>'input-text')); ?>
			<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="InputMemberGender">
		<td width="15%" class="boldText">Gender of Patient <font color="#FF0000">*</font></td>
		<td>
			<select name="data[Health][gender]" id="HealthGender" class="input-text">
				<option value="">Select Gender</option>
				<option value="1" <?php if($this->data[Health][gender]== $val['Lab']['id']) { echo "selected";}?>>Male</option>
				<option value="2" <?php if($this->data[Health][gender]== $val['Lab']['id']) { echo "selected";}?>>Female</option>
			</select>
			<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="InputMemberAge">
		<td width="15%" class="boldText">Patient Age <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.age', array('class'=>'input-text','style'=>'width:50px;')); ?>
			<div id="msg3" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	
	<tr id="InputMemberContact">
		<td width="15%" class="boldText">Contact Number <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.landline', array('class'=>'input-text phone','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return checknum(event)')); ?>
			<div id="msg5" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	
	<tr id="InputMemberAltContact">
		<td width="15%" class="boldText">Alternate Contact Number <font color="#FF0000"></font></td>
		<td>
			<?php echo $form->text('Health.alternate_contact', array('class'=>'input-text phone','maxlength'=>'10','minlength'=>'10','onkeypress'=>'return checknum(event)')); ?>
		</td>
	</tr>
	
	<tr id="InputMemberEmail">
		<td width="15%" class="boldText">Email ID</td>
		<td>
			<?php echo $form->text('Health.email', array('class'=>'input-text')); ?>
			<!--<div id="msg6" style="color:#FF0000; font-size:12px;"></div>-->
		</td>
	</tr>
	
	<tr id="InputMemberAltEmail">
		<td width="15%" class="boldText">Alternate Email ID</td>
		<td>
			<?php echo $form->text('Health.alternate_email', array('class'=>'input-text')); ?>
			<!--<div id="msg6" style="color:#FF0000; font-size:12px;"></div>-->
		</td>
	</tr>
	
	<tr id="InputMemberAddress1">
		<td width="15%" class="boldText">Address <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.address1', array('class'=>'input-text')); ?>
		</td>
	</tr>
	<tr id="InputMemberAddress2">
		<td width="15%" class="boldText">&nbsp;</td>
		<td>
			<?php echo $form->text('Health.address2', array('class'=>'input-text')); ?>
			<div id="msg7" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="InputMemberPincode">
		<td width="15%" class="boldText">Pincode <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.pincode', array('class'=>'input-text','onkeyup'=>'getcitystate();')); ?>
			<div id="msg11" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="InputMemberLocality">
		<td width="15%" class="boldText">Locality</td>
		<td>
			<select name="data[Health][locality]" id="HealthLocality" class="input-text">
			</select>
			<div id="msg9" style="color:#FF0000; font-size:12px;"></div>
		</td>	
	</tr>
	<tr id="InputMemberCity">
		<td width="15%" class="boldText">City</td>
		<td>
			<select name="data[Health][city_id]" id="HealthCityId" class="input-text" readonly>
				<option value="">Select City</option>
				<?php foreach($city as $key => $val) {?>
				<option value="<?php echo $val['City']['id'];?>"><?php echo $val['City']['name'];?></option>
				<?php }?>
			</select>
			<div id="msg9" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="InputMemberState">
		<td width="15%" class="boldText">State</td>
		<td>
			<select name="data[Health][state]" id="HealthState" class="input-text" readonly>
				<option value="">Select State</option>
				<?php foreach($state as $key => $val) {?>
				<option value="<?php echo $val['State']['id'];?>"><?php echo $val['State']['name'];?></option>
				<?php }?>
			</select>
			<div id="msg10" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="InputMemberLandmark">
		<td width="15%" class="boldText">Landmark <font color="#FF0000">*</font></td>
		<td>
			<?php echo $form->text('Health.landmark', array('class'=>'input-text')); ?>
			<div id="msg12" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<!--<tr id="VitalHeadInfo">
		<td colspan="2" style="font-weight:bold; text-decoration:underline; background-color:#999999; color:#FFFFFF; text-align:center;">Patient Vitals Monitoring BP & BMI</td>
	</tr>
	<script type="text/javascript">
	function show_option(val)
	{
		if(val == 1)
		{
			var null_val = '';
			jQuery('#HealthPatHeightCms').val(null_val);
			jQuery('#PatHeightCm').hide();
			jQuery('#PatHeight').show();
		}
		if(val == 2)
		{
			var null_val = '';
			jQuery('#HealthPatHeightFeet').val(null_val);
			jQuery('#HealthPatHeightInch').val(null_val);
			jQuery('#PatHeightCm').show();
			jQuery('#PatHeight').hide();
		}
	}
	</script>
	<!--Code For Inserting BMI value Starts-->
	<!--<tr id="PatWeight">
		<td width="15%" class="boldText">Patient Weight(KG)</td>
		<td>
			<?php //echo $form->text('Health.pat_weight', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'Weight in KG')); ?>
		</td>
	</tr>
	<tr id="PatHeightOpt">
		<td width="15%" class="boldText">Height Option</td>
		<td>
			<input type="radio" name="data[Health][select_bmi_opt]" value="1" onclick="show_option(1);" />&nbsp;Feet&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="data[Health][select_bmi_opt]" value="2" onclick="show_option(2);" />&nbsp;CMs
		</td>
	</tr>
	<tr id="PatHeightCm" style="display:none;">
		<td width="15%" class="boldText">Patient Height(CM's)</td>
		<td>
			<?php //echo $form->text('Health.pat_height_cms', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'CM')); ?>
		</td>
	</tr>
	<tr id="PatHeight" style="display:none;">
		<td width="15%" class="boldText">Patient Height(Feet & Inch)</td>
		<td>
			<?php //echo $form->text('Health.pat_height_feet', array('class'=>'input-text','style'=>'width:75px;','placeholder'=>'Feet')); ?>
			<?php //echo $form->text('Health.pat_height_inch', array('class'=>'input-text','style'=>'width:75px;','placeholder'=>'Inch')); ?>
		</td>
	</tr>
	<tr id="PatBPSystolic">
		<td width="15%" class="boldText">Blood Pressure</td>
		<td>
			<?php //echo $form->text('Health.pat_systolic', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'SYS in (mmHg)')); ?>
			<?php //echo $form->text('Health.pat_diaostolic', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'DIA in (mmHg)')); ?>
			<?php //echo $form->text('Health.pat_pulse_rate', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'Pulse/Min')); ?>
		</td>
	</tr>
	<tr id="PatientBpDate">
		<td width="15%" class="boldText">Enter Date</td>
		<td><?php //echo $form->text('Health.vital_time', array('class'=>'input-text datepicker2','style'=>'width:100px;')); ?>
		<div id="msg156" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<tr id="PatBPTime">
		<td width="15%" class="boldText">Enter Time</td>
		<td>
			<select name="data[Health][pat_bp_time_hr]" class="input-text" style="width:75px;">
				<option value="">Hr</option>
				<option value="01">01</option>
				<option value="02">02</option>
				<option value="03">03</option>
				<option value="04">04</option>
				<option value="05">05</option>
				<option value="06">06</option>
				<option value="07">07</option>
				<option value="08">08</option>
				<option value="09">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
			</select>
			<select name="data[Health][pat_bp_time_sec]" class="input-text" style="width:75px;">
				<option value="">Sec</option>
				<?php for($i=1;$i<=60;$i++){?>
				<?php if($i<=9){?>
				<option value="<?php echo '0'.$i;?>"><?php echo '0'.$i;?></option>
				<?php } else {?>
				<option value="<?php echo $i;?>"><?php echo $i;?></option>
				<?php }?>
				<?php }?>
			</select>
		</td>
	</tr>
	
	-->
	<!--Code For Inserting BMI value Ends-->
	<tr id="SubTotal" style="display:none;">
		<td><input type="text" name="data[Health][total_amount]" value="<?php echo $this->data['Health']['total_test_amt']; ?>" id="HealthTotalAmount"/></td>
	</tr>
	<tr style="display:none;"><input type="hidden" name="data[Health][indi_test_amt]" value="<?php echo $this->data['Health']['indi_test_amt'];?>" id="HealthIndiTestAmt" /></tr>
	<tr style="display:none;"><input type="hidden" name="data[Health][indi_profile_amt]" value="<?php echo $this->data['Health']['indi_profile_amt'];?>" id="HealthIndiProfileAmt" /></tr>
	<tr style="display:none;"><input type="hidden" name="data[Health][indi_offer_amt]" value="<?php echo $this->data['Health']['indi_offer_amt'];?>" id="HealthIndiOfferAmt" /></tr>
	<tr style="display:none;"><input type="hidden" name="data[Health][indi_package_amt]" value="<?php echo $this->data['Health']['indi_package_amt'];?>" id="HealthIndiPackageAmt" /></tr>
	<tr style="display:none;"><input type="hidden" name="data[Health][indi_service_amt]" value="<?php echo $this->data['Health']['indi_service_amt'];?>" id="HealthIndiServiceAmt" /></tr>
					
	<tr id="TestIds" style="display:none;"><input type="hidden" name="data[Health][test_id]" value="<?php echo str_replace('*',',',$this->data['Health']['test_sel_ids']);?>" id="HealthTestId" /></tr>
	<tr id="ProfileIds" style="display:none;"><input type="hidden" name="data[Health][profile_id]" value="<?php echo str_replace('*',',',$this->data['Health']['profile_sel_ids']);?>" id="HealthProfileId" /></tr>
	<tr id="OfferIds" style="display:none;"><input type="hidden" name="data[Health][offer_id]" value="<?php echo str_replace('*',',',$this->data['Health']['offer_sel_ids']);?>" id="HealthOfferId" /></tr>
	<tr id="PackageIds" style="display:none;"><input type="hidden" name="data[Health][package_id]" value="<?php echo str_replace('*',',',$this->data['Health']['package_sel_ids']);?>" id="HealthPackageId" /></tr>
	<tr id="ServiceIds" style="display:none;"><input type="hidden" name="data[Health][service_id]" value="<?php echo str_replace('*',',',$this->data['Health']['service_sel_ids']);?>" id="HealthServiceId" /></tr>
	
	<tr id="t_f_a_t_p_o_r">
		<td width="15%" class="boldText">Total Amount</td>
		<td id="t_f_a_t_p_o">Rs. <?php echo $this->data['Health']['total_test_amt']; ?></td>
	</tr>
	
	<tr id="TestCount" style="display:none;">0</tr>
	<tr id="ClickTestNew"><?php echo $this->data['Health']['test_name'];?> ?></tr>
	<?php if(!empty($this->data['Health']['edit_test_name'])) {?>
	<tr id="ClickTest">
		<td width="15%" class="boldText" id="ChangeTestHeading">Tests</td>
		<td>
			<div id="OldTestList"><?php echo $this->data['Health']['edit_test_name'];?></div>
		</td>
	</tr>
	<?php }?>
	
	<tr id="ClickTest">
		<td width="15%" class="boldText" id="ChangeTestHeading">Test(s) / Profile(s) / Service(s)</td>
		<td>
			<div style="float:left;">
				<div style="float:left;"><?php echo $form->text('Health.search_test',array('class'=>'input-text','placeholder'=>'Search Test'));?></div>
				<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-1" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
			</div>
		</td>
	</tr>
	<tr id="ProfileCount" style="display:none;">0</tr>
	<tr id="ClickProfileNew"></tr>
	<!--<tr id="ClickProfile">
		<td width="15%" class="boldText" id="ChangeProfileHeading">Profile(s)</td>
		<td>
			<div style="float:left;">
				<div style="float:left;"><?php echo $form->text('Health.search_profile',array('class'=>'input-text','placeholder'=>'Search Profile'));?></div>
				<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-2" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
			</div>
		</td>
	</tr>-->
	<tr id="OfferCount" style="display:none;">0</tr>
	<tr id="ClickOfferNew"></tr>
	
	<!-- enbale  Special Offer by ravin  -->
	<tr id="ClickOffer">
		<td width="15%" class="boldText" id="ChangeOfferHeading">Special Offer(s)</td>
		<td>
			<div style="float:left;">
				<div style="float:left;"><?php echo $form->text('Health.search_offer',array('class'=>'input-text','placeholder'=>'Search Special Offer'));?></div>
				<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-3" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
			</div>
		</td>
	</tr>
	<tr id="PackageCount" style="display:none;">0</tr>
	<tr id="ClickPackageNew"></tr>
	<tr id="ClickPackage">
		<td width="15%" class="boldText" id="ChangePackageHeading">Niramaya Package(s)</td>
		<td>
			<div style="float:left;">
				<div style="float:left;"><?php echo $form->text('Health.search_package',array('class'=>'input-text','placeholder'=>'Search Niramaya Package'));?></div>
				<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-4" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
			</div>
		</td>
	</tr>
	<tr id="ServiceCount" style="display:none;">0</tr>
	<tr id="ClickServiceNew"></tr>
	<!--<tr id="ClickService">
		<td width="15%" class="boldText" id="ChangeServiceHeading">Patient Care Services</td>
		<td>
			<div style="float:left;">
				<div style="float:left;"><?php echo $form->text('Health.search_service',array('class'=>'input-text','placeholder'=>'Search Patient Care Services'));?></div>
				<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-5" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
			</div>
		</td>
	</tr>-->
	
	<tr>
		<td width="15%" class="boldText">Discount Code</td>
		<td>
			<?php echo $form->text('Health.discount', array('class'=>'input-text','style'=>'width:100px;')); ?><br />
			<!--<strong>1)</strong> <span style="color:#0066FF;">60PLUS</span> <strong>-</strong> Senior Citizen Discount (10%)<br /> 
			<strong>2)</strong> <span style="color:#0066FF;">NHCARD</span> <strong>-</strong> nirAmaya Healthcare Card Discount (10%)<br /> 
			<strong>3)</strong> <span style="color:#0066FF;">ADP159</span> <strong>-</strong> Additional Basic Health Check-up Discount (Rs.299)<br /> 
			<strong>4)</strong> <span style="color:#0066FF;">ADP160</span> <strong>-</strong> Additional Whole-body Health Check-up Discount (Rs.419)<br /> 
			<strong>5)</strong> <span style="color:#0066FF;">ADP161</span> <strong>-</strong> Additional Executive Health Check-up Discount (Rs.749)<br /> 
			<strong>6)</strong> <span style="color:#0066FF;">10CORP</span> <strong>-</strong> Corporate Discount (10%)<br /> 
			<strong>7)</strong> <span style="color:#0066FF;">15CORP</span> <strong>-</strong> Corporate Discount (15%)<br /> 
			<strong>8)</strong> <span style="color:#0066FF;">GovEmp</span> <strong>-</strong> Government Employee Discount (10%)<br /> 
			<strong>9)</strong> <span style="color:#0066FF;">EmpNhc</span> <strong>-</strong> nirAmaya Healthcare  Employee Discount (30%)<br /> 
			<strong>10)</strong> <span style="color:#0066FF;">NhcCSR</span> <strong>-</strong> Corporate Social Responsibility Discount (25%)<br /> 
			<strong>11)</strong> <span style="color:#0066FF;">ereport</span> <strong>-</strong> eReporting discount (2%)<br />  
			<strong>12)</strong> <span style="color:#0066FF;">Comp100</span> <strong>-</strong> Complementary Discount (100%)-->
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Discount Amount</td>
		<td>
			<?php echo $form->text('Health.discount_amount', array('class'=>'input-text','style'=>'width:100px;')); ?>
			<div id="discountissue" style="color:red;display:none;">Discount Value cant be greater than Total Amount</div>
		</td>
	</tr>
	<tr>
		<td class="boldText">Discount Reason/Remark <font color="#FF0000">*</font><!-- <br />(Only filled when Discount Amount Given otherwise leave blank)--></td>
		<td>
			<?php echo $form->textarea('Health.discount_amount_reason', array('class'=>'input-text','rows'=>5,'cols'=>50,'style'=>'font-size:12px;')); ?>
			<div id="msg155" style="color:#FF0000; font-size:12px;"></div>
		</td>
	</tr>
	<!new changes-->
	<!--<tr>
		<td width="15%" class="boldText">Sent Report at Home</td>
		<td>
			<input type="radio" name="data[Health][home_report]" value="1" />&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="data[Health][home_report]" value="0" />&nbsp;&nbsp;No
		</td>
	</tr>-->
        <!-- end -->
	<tr>
		<td width="15%" class="boldText">Referred By</td>
		<td>
			<?php echo $form->text('Health.remark', array('class'=>'input-text')); ?>
		</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Sample Collect Status</td>
		<td>
			<!--<input type="radio" name="opt" id="visit" value="1" onclick="show_lab(this.value);" />Visit a Lab<br />-->
			<input type="radio" name="opt" id="home" value="2" onclick="show_lab(this.value);" />Home Collection<br />
		</td>
	</tr>
	<tr id="visit_lab_1" style="display:none;">
		<td width="15%" class="boldText">Select Center</td>
		<td>
                    <select name="data[Health][city]" id="HealthCityLab1" class="input-text">
                        <option value="">Select Center</option>
			<?php foreach($pcc_list as $key => $val) {?>
				<!--<input type="radio" name="data[Health][city]" id="HealthCityLab1" value="<?php echo $val['Lab']['id'];?>" /> <strong><?php echo $val['Lab']['pcc_name'];?></strong><br />
				<span style="margin:0px 0px 0px 24px;"><?php echo nl2br($val['Lab']['pcc_address']);?></span><br />
                                -->
                                <option value="<?php echo $val['Lab']['id'];?>"><?php echo $val['Lab']['pcc_name'];?> <?php //echo nl2br($val['Lab']['pcc_address']);?></option>
			<?php }?>
                    </select>
			<br />
		</td>
			
	</tr>
	<tr id="visit_lab_2" style="display:none;">
		<td width="15%" class="boldText">Time</td>
		<td>
			<select name="data[Health][sample_time]" id="HealthSampleTime" class="input-text">
				<option value="">Select Time</option>
				<?php foreach($timelabs as $key => $val) {?>
				<option value="<?php echo $val['Timelab']['id'];?>"><?php echo $val['Timelab']['name'];?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr id="visit_lab_3" style="display:none;">
		<td width="15%" class="boldText">Sample Collect Date</td>
		<td>
			<?php echo $form->text('Health.sample_date', array('class'=>'input-text datepicker2','style'=>'width:100px;')); ?>
		</td>
	</tr>
	
	
	<tr id="home_collection_1" style="display:none;">
		<td width="15%" class="boldText">&nbsp;</td>
		<td>Please select a date and time for Collection of Sample. Our representative will come to the address mention above.</td>
	</tr>
	<tr id="home_collection_2" style="display:none;">
		<td width="15%" class="boldText">Time</td>
		<td>
			<select name="data[Health][sample_time1]" id="HealthSampleTime1" class="input-text">
				<option value="">Select Time</option>
				<?php foreach($timelabs as $key => $val) {?>
				<option value="<?php echo $val['Timelab']['id'];?>"><?php echo $val['Timelab']['name'];?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr id="home_collection_3" style="display:none;">
		<td width="15%" class="boldText">Sample Collect Date</td>
		<td>
			<?php echo $form->text('Health.sample_date1', array('class'=>'input-text datepicker','style'=>'width:100px;')); ?>
		</td>
	</tr>
	
	<tr id="add_line1" style="display:none;"></tr>
	<tr id="add_line2" style="display:none;"></tr>
	<tr id="pincode" style="display:none;"></tr>	
	<tr id="locality" style="display:none;"></tr>
	<tr id="city" style="display:none;"></tr>
	<tr id="state" style="display:none;"></tr>

	<tr id="landmark" style="display:none;"></tr>
	
	<tr id="home_collection_4" style="display:none;">
		<td>&nbsp;</td>
		<td><a href="javascript:void(0);" onclick="show_upper_add();">Same as Above Address</a> | <a href="javascript:void(0);" onclick="new_add();">New Address</a></td>
	</tr>

	<tr id="submit_div" style="display:none;">
		<td width="15%">&nbsp;</td>
		<td>
			<?php echo $form->submit('Save', array('div'=>false, 'class' => 'btn','id'=>'editupdate')); ?>
			<a onclick="javascript:window.history.go(-1)" class="btn" style="color:#FFFFFF;">Cancel</a>
		</td>
	</tr>	



</table>
<?php echo $form->end(); ?>
</div>
<script type="text/javascript">

	function checknum(evt)
	{
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}

</script>
<?php echo $javascript->link('light/jquery.lightbox_me') ?>
<?php echo $javascript->link('light/slider') ?>
