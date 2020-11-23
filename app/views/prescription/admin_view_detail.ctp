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
#signup-Div-Service {background: #fff; border: 6px solid #727272; width:550px; height:440px; position: relative; display:none; z-index:999; border-radius:13px; }
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

function reschedule()
{
	var resCheck = $("#HealthReschedule").val();
	if(resCheck!=0)
	{
		$('#HealthSampleTime1').removeAttr('disabled');
		$('#HealthSampleDate1').removeAttr('disabled');
	}
	else
	{
		$('#HealthSampleTime1').attr('disabled',true);
		$('#HealthSampleDate1').attr('disabled',true);
	}
}


$(function() {
            function launch() {
                 $('signup-Div').lightbox_me({centered: true, onLoad: function() { $('#signup-Div').find('input:first').focus()}});
            }

            
            $('#try-1').click(function(e) {
			
				var rep_div_new = '';
				$('#TestList').html(rep_div_new);
				var get_search_test = document.getElementById('HealthSearchTest').value;
				var getLengthTest = $('#HealthTestId').length;
				if(getLengthTest == 0)
				{
					var sel_tests = '<?php echo $this->data['Health']['test_id'];?>';
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
						}
						
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
						if(data.test_info.search_test.length != 0)
						{
							var selected_tests_final = data.test_info.selected_tests_req;
							var sell_test = selected_tests_final.split(',');
							jQuery.each(data.test_info.search_test,function(index, value)
							{
								if(sell_test[0] == value.Test.id)
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_test('+value.Test.id+');" id="TestCheck'+value.Test.id+'" checked="checked" /></div>';
									rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
									rep_div +='</div>';
								}
								else if(sell_test[1] == value.Test.id)
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_test('+value.Test.id+');" id="TestCheck'+value.Test.id+'" checked="checked" /></div>';
									rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
									rep_div +='</div>';
								}
								else if(sell_test[2] == value.Test.id)
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_test('+value.Test.id+');" id="TestCheck'+value.Test.id+'" checked="checked" /></div>';
									rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
									rep_div +='</div>';
								}
								else if(sell_test[3] == value.Test.id)
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_test('+value.Test.id+');" id="TestCheck'+value.Test.id+'" checked="checked" /></div>';
									rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
									rep_div +='</div>';
								}
								else if(sell_test[4] == value.Test.id)
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_test('+value.Test.id+');" id="TestCheck'+value.Test.id+'" checked="checked" /></div>';
									rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
									rep_div +='</div>';
								}
								else if(sell_test[5] == value.Test.id)
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_test('+value.Test.id+');" id="TestCheck'+value.Test.id+'" checked="checked" /></div>';
									rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
									rep_div +='</div>';
								}
								else if(sell_test[6] == value.Test.id)
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_test('+value.Test.id+');" id="TestCheck'+value.Test.id+'" checked="checked" /></div>';
									rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
									rep_div +='</div>';
								}
								else if(sell_test[7] == value.Test.id)
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_test('+value.Test.id+');" id="TestCheck'+value.Test.id+'" checked="checked" /></div>';
									rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';bp_net
									rep_div +='</div>';
								}
								else if(sell_test[8] == value.Test.id)
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_test('+value.Test.id+');" id="TestCheck'+value.Test.id+'" checked="checked" /></div>';
									rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
									rep_div +='</div>';
								}
								else if(sell_test[9] == value.Test.id)
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_test('+value.Test.id+');" id="TestCheck'+value.Test.id+'" checked="checked" /></div>';
									rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
									rep_div +='</div>';
								}
								else
								{
									rep_div +='<div style="float:left; clear:both;">';
									rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_test('+value.Test.id+');" id="TestCheck'+value.Test.id+'" /></div>';
									rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
									rep_div +='</div>';
								}
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
					var sel_tests = '<?php echo $this->data['Health']['profile_id'];?>';
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
							}
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
							if(data.test_info.search_test.length != 0)
							{
								var selected_tests_final = data.test_info.selected_tests_req;
								var sell_test = selected_tests_final.split(',');
								jQuery.each(data.test_info.search_test,function(index, value)
								{
									if(sell_test[0] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_profile('+value.Test.id+');" id="ProfileCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[1] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_profile('+value.Test.id+');" id="ProfileCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[2] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_profile('+value.Test.id+');" id="ProfileCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[3] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_profile('+value.Test.id+');" id="ProfileCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[4] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_profile('+value.Test.id+');" id="ProfileCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[5] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_profile('+value.Test.id+');" id="ProfileCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[6] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_profile('+value.Test.id+');" id="ProfileCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[7] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_profile('+value.Test.id+');" id="ProfileCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[8] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_profile('+value.Test.id+');" id="ProfileCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[9] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_profile('+value.Test.id+');" id="ProfileCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_profile('+value.Test.id+');" id="ProfileCheck'+value.Test.id+'" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.testcode+' - '+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
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
					var sel_tests = '<?php echo $this->data['Health']['offer_id'];?>';
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
							}
							var rep_div = '';
							rep_div +='<div>';
							rep_div +='<div style="float:left; width:175px; padding:20px 10px 10px 25px;"><strong>Offer Amount :</strong> Rs. <span id="OfferAmt">'+data.test_info.selected_amt+'</span></div>';
							rep_div +='<div style="float:left; width:220px; display:none; margin:2px 0 0 0; text-align:center;" id="OfferProcess"><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40));?></div>';
							rep_div +='</div>';
							rep_div +='<div style="float: left; height: 339px; overflow-x: hidden; overflow-y: scroll; margin:0 0 0 25px;">';
							
							rep_div +='<div style="float:left; margin:10px 0 0 0; clear:both;">';
							rep_div +='<div style="font-weight:bold; float:left; width:50px; text-align:center; border:1px solid #D9D9D9; height:20px; padding:10px;">Select</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Offer Description</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:80px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
							rep_div +='</div>';
							if(data.test_info.search_test.length != 0)
							{
								var selected_tests_final = data.test_info.selected_tests_req;
								var sell_test = selected_tests_final.split(',');
								jQuery.each(data.test_info.search_test,function(index, value)
								{
									if(sell_test[0] == value.Banner.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Banner.banner_mrp+'" onclick="add_offer('+value.Banner.id+');" id="OfferCheck'+value.Banner.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Banner.banner_code+' - '+value.Banner.banner_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Banner.banner_mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[1] == value.Banner.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Banner.banner_mrp+'" onclick="add_offer('+value.Banner.id+');" id="OfferCheck'+value.Banner.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Banner.banner_code+' - '+value.Banner.banner_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Banner.banner_mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[2] == value.Banner.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Banner.banner_mrp+'" onclick="add_offer('+value.Banner.id+');" id="OfferCheck'+value.Banner.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Banner.banner_code+' - '+value.Banner.banner_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Banner.banner_mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[3] == value.Banner.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Banner.banner_mrp+'" onclick="add_offer('+value.Banner.id+');" id="OfferCheck'+value.Banner.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Banner.banner_code+' - '+value.Banner.banner_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Banner.banner_mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[4] == value.Banner.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Banner.banner_mrp+'" onclick="add_offer('+value.Banner.id+');" id="OfferCheck'+value.Banner.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Banner.banner_code+' - '+value.Banner.banner_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Banner.banner_mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[5] == value.Banner.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Banner.banner_mrp+'" onclick="add_offer('+value.Banner.id+');" id="OfferCheck'+value.Banner.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Banner.banner_code+' - '+value.Banner.banner_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Banner.banner_mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[6] == value.Banner.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Banner.banner_mrp+'" onclick="add_offer('+value.Banner.id+');" id="OfferCheck'+value.Banner.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Banner.banner_code+' - '+value.Banner.banner_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Banner.banner_mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[7] == value.Banner.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Banner.banner_mrp+'" onclick="add_offer('+value.Banner.id+');" id="OfferCheck'+value.Banner.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Banner.banner_code+' - '+value.Banner.banner_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Banner.banner_mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[8] == value.Banner.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Banner.banner_mrp+'" onclick="add_offer('+value.Banner.id+');" id="OfferCheck'+value.Banner.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Banner.banner_code+' - '+value.Banner.banner_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Banner.banner_mrp+'</div>';
										rep_div +='</div>';
									}
									else
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Banner.banner_mrp+'" onclick="add_offer('+value.Banner.id+');" id="OfferCheck'+value.Banner.id+'" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Banner.banner_code+' - '+value.Banner.banner_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Banner.banner_mrp+'</div>';
										rep_div +='</div>';
									}
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
							rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Offer Description</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:80px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
							rep_div +='</div>';
							rep_div +='<div style="float:left; clear:both; width:457px; text-align:center; padding:10px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-left:1px solid #D9D9D9;">No Offer Found</div>';
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
					var sel_tests = '<?php echo $this->data['Health']['offer_id'];?>';
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
							}
							var rep_div = '';
							rep_div +='<div>';
							rep_div +='<div style="float:left; width:180px; padding:20px 10px 10px 25px;"><strong>Package Amount :</strong> Rs. <span id="PackageAmt">'+data.test_info.selected_amt+'</span></div>';
							rep_div +='<div style="float:left; width:220px; display:none; margin:2px 0 0 0; text-align:center;" id="PackageProcess"><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40));?></div>';
							rep_div +='</div>';
							rep_div +='<div style="float: left; height: 195px; overflow-x: hidden; margin:0 0 0 25px;">';
							
							rep_div +='<div style="float:left; margin:10px 0 0 0; clear:both;">';
							rep_div +='<div style="font-weight:bold; float:left; width:50px; text-align:center; border:1px solid #D9D9D9; height:20px; padding:10px;">Select</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Package Description</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:80px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
							rep_div +='</div>';
							if(data.test_info.search_test.length != 0)
							{
								var selected_tests_final = data.test_info.selected_tests_req;
								//alert(selected_tests_final);
								var sell_test = selected_tests_final.split(',');
								jQuery.each(data.test_info.search_test,function(index, value)
								{
									if(sell_test[0] == value.Package.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
										rep_div +='</div>';
									}
									if(sell_test[1] == value.Package.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
										rep_div +='</div>';
									}
									if(sell_test[2] == value.Package.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
										rep_div +='</div>';
									}
									if(sell_test[3] == value.Package.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
										rep_div +='</div>';
									}
									if(sell_test[4] == value.Package.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
										rep_div +='</div>';
									}
									if(sell_test[5] == value.Package.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
										rep_div +='</div>';
									}
									else
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_name+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
										rep_div +='</div>';
									}
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
							rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Package Description</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:80px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
							rep_div +='</div>';
							rep_div +='<div style="float:left; clear:both; width:457px; text-align:center; padding:10px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-left:1px solid #D9D9D9;">No Package Found</div>';
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

            $('#try-5').click(function(e) {
				var rep_div_new = '';
				$('#ServiceList').html(rep_div_new);
				var get_search_package = document.getElementById('HealthSearchService').value;
				var getLengthTest = $('#HealthServiceId').length;
				if(getLengthTest == 0)
				{
					var sel_tests = '<?php echo $this->data['Health']['service_id'];?>';
				}
				if(getLengthTest != 0)
				{
					var sel_tests = document.getElementById('HealthServiceId').value;
				}
				
				jQuery.ajax({
					type:'GET',
					url:siteUrl+'admin/samples/search_service_value?testval='+get_search_package+'&sel_test='+sel_tests,
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
							}
							var rep_div = '';
							rep_div +='<div>';
							rep_div +='<div style="float:left; width:180px; padding:20px 10px 10px 25px;"><strong>Service Amount :</strong> Rs. <span id="ServiceAmt">'+data.test_info.selected_amt+'</span></div>';
							rep_div +='<div style="float:left; width:220px; display:none; margin:2px 0 0 0; text-align:center;" id="ServiceProcess"><?php echo $html->image('frontend/loading.gif',array('width'=>40,'height'=>40));?></div>';
							rep_div +='</div>';
							rep_div +='<div style="float: left; height: 339px; overflow-x: hidden; margin:0 0 0 25px;">';
							
							rep_div +='<div style="float:left; margin:10px 0 0 0; clear:both;">';
							rep_div +='<div style="font-weight:bold; float:left; width:50px; text-align:center; border:1px solid #D9D9D9; height:20px; padding:10px;">Select</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Patient Care Services Description</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:80px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
							rep_div +='</div>';
							if(data.test_info.search_test.length != 0)
							{
								var selected_tests_final = data.test_info.selected_tests_req;
								var sell_test = selected_tests_final.split(',');
								jQuery.each(data.test_info.search_test,function(index, value)
								{
									if(sell_test[0] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_service('+value.Test.id+');" id="ServiceCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[1] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_service('+value.Test.id+');" id="ServiceCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[2] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_service('+value.Test.id+');" id="ServiceCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[3] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_service('+value.Test.id+');" id="ServiceCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[4] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_service('+value.Test.id+');" id="ServiceCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[5] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_service('+value.Test.id+');" id="ServiceCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[6] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_service('+value.Test.id+');" id="ServiceCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[7] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_service('+value.Test.id+');" id="ServiceCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[8] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_service('+value.Test.id+');" id="ServiceCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else if(sell_test[9] == value.Test.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_service('+value.Test.id+');" id="ServiceCheck'+value.Test.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
									else
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Test.mrp+'" onclick="add_service('+value.Test.id+');" id="ServiceCheck'+value.Test.id+'" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Test.test_parameter+'</div>';
										rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
										rep_div +='</div>';
									}
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
		
function close_payment_box()
{
	$("#updatePayStatus").hide();
}		
function show_balance_amt(id)
{
	var rec_val = document.getElementById('HealthReceiveAmt').value;
	jQuery.ajax({
			type:'GET',
			url:siteUrl+'admin/samples/calculate_balance?health_id='+id+'&rec_val='+rec_val,
			success:function(data){
				var rep_div = '';
				var rep_div_fin = '';
				rep_div +='<td width="15%" style="font-weight:bold;">Balance Amount</td>';
				rep_div +='<td>';
				rep_div +='<span style="float:left;">Rs. <input type="text" name="data[Payment][balance_amt]" value="'+data+'" class="input-text" style="width:100px;" onclick="show_balance_amt('+id+');" readonly="readonly"></span> <span style="float:left; display:none;" id="LoadingDiv"><?php echo $html->image('frontend/loading.gif',array('height:42px; width:43px;'));?></span>';
				rep_div +='</td>';
				
				$('#bAmt').html(rep_div);
				$('#bAmt').show();
				$('#LoadingDiv').hide();
			},
			beforeSend:function(){
				jQuery('#LoadingDiv').show();
			},
			
		});
}


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
					//var test_ids = '';
//					test_ids +='<td>';
//					test_ids +='<input type="text" name="data[Health][test_id]" value="'+datum[0]+'" id="HealthTestId">';
//					test_ids +='</td>';
//					$('#TestIds').html(test_ids);
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
					//var get_curr_ids = document.getElementById('HealthTestId').value;
//					var new_test_val = get_curr_ids+'*'+datum[0];
//					var test_ids = '';
//					test_ids +='<td>';
//					test_ids +='<input type="text" name="data[Health][test_id]" value="'+new_test_val+'" id="HealthTestId">';
//					test_ids +='</td>';
//					$('#TestIds').html(test_ids);
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
					var result1 = $.grep(get_curr_ids.split('*'), function(v) { return v != datum[0]; }).join('*');
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
	var curr_sel_tests = document.getElementById('HealthTestId').value;
	if ($("#HealthHomeReport1").is(":checked")) {
	   var home_report = 'Yes';
	}
	if ($("#HealthHomeReport2").is(":checked")) {
	   var home_report = 'No';
	}
	var disc_code = document.getElementById('HealthDiscountCode').value;
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/get_all_test_cnf?curr_test='+curr_sel_tests+'&req_id='+<?php echo $this->data['Health']['id'];?>+'&home_report='+home_report+'&disc_code='+disc_code,
		//url:siteUrl+'admin/samples/get_all_test',
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
					rep_div +='<td>';
					rep_div +='<table border="0" width="100%" style="margin:-8px 0 0 0;">';
					var g = 0;
					jQuery.each(data.test_info.test_data,function(index, value)
					{
						var selected_ids_tests = curr_sel_tests.split(',');
						if(selected_ids_tests[0] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_test('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[1] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_test('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[2] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_test('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[3] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_test('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[4] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_test('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[5] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_test('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[6] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_test('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[7] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_test('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[8] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_test('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[9] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_test('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						//if($('#TestCheck'+value.Test.id).attr('checked'))
//						{
//							rep_div +='<tr>';
//							rep_div +='<td>';
//							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp;
//							rep_div +='</td>';
//							rep_div +='</tr>';
//							g = parseInt(g+1);
//						}
					});
					if(g == 0)
					{
						rep_div_heading = 'Test(s)';
						rep_div_link = '';
						rep_div_link +='Click to change Tests';
					}
					else
					{
						rep_div_heading = '';
						rep_div_link = '';
						rep_div_link +='Change Test';
						$('#OldTestList').remove();
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
				$('#ChangeTestHeading').css('margin','-15px 0 0');
				$('#ChangeTestHeading').css('float','left');
				$('#ChangeTestNewLink').html(rep_div_link);
				$('#ClickTestNew').html(rep_div);
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
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+p_p+p_o+p_z+p_s);
					var sub_tot_amt = parseInt(p+p_p+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+p_t+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_tot_amt = parseInt(q+p_t+p_o+p_z+p_s);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+p_t+p_p+p_z+p_s);
					var sub_tot_amt = parseInt(r+p_t+p_p+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s+p_t+p_p+p_o+p_s);
					var sub_tot_amt = parseInt(s+p_t+p_p+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(t+p_t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(t+p_t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+p_o+p_z+p_s);
					var sub_tot_amt = parseInt(p+q+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+p_p+p_z+p_s);
					var sub_tot_amt = parseInt(p+r+p_p+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+p_p+p_o+p_s);
					var sub_tot_amt = parseInt(p+s+p_p+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(p+t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+p_t+p_z+p_s);
					var sub_tot_amt = parseInt(q+r+p_t+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+p_t+p_o+p_s);
					var sub_tot_amt = parseInt(q+s+p_t+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+t+p_t+p_o+p_z);
					var sub_tot_amt = parseInt(q+t+p_t+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+p_t+p_p+p_s);
					var sub_tot_amt = parseInt(r+s+p_t+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t+p_t+p_p+p_z);
					var sub_tot_amt = parseInt(r+t+p_t+p_p+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s+t+p_t+p_p+p_o);
					var sub_tot_amt = parseInt(s+t+p_t+p_p+p_o);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+p_z+p_s);
					var sub_tot_amt = parseInt(p+q+r+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+s+p_p+p_s);
					var sub_tot_amt = parseInt(p+r+s+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+t+p_p+p_s);
					var sub_tot_amt = parseInt(p+s+t+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+p_t+p_s);
					var sub_tot_amt = parseInt(q+r+s+p_t+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+t+p_t+p_o);
					var sub_tot_amt = parseInt(q+s+t+p_t+p_o);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+t+p_t+p_p);
					var sub_tot_amt = parseInt(r+s+t+p_t+p_p);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s+p_s);
					var sub_tot_amt = parseInt(p+q+r+s+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+t+p_t);
					var sub_tot_amt = parseInt(q+r+s+t+p_t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
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
					var sub_tot_amt = parseInt(p+q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p_t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(p_t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').hide();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalTest').show();
		},
		
	});
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
					//var profile_ids = '';
//					profile_ids +='<td>';
//					profile_ids +='<input type="text" name="data[Health][profile_id]" value="'+datum[0]+'" id="HealthProfileId">';
//					profile_ids +='</td>';
//					$('#ProfileIds').html(profile_ids);
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
					//var get_curr_ids = document.getElementById('HealthProfileId').value;
//					var new_profile_val = get_curr_ids+'*'+datum[0];
//					var profile_ids = '';
//					profile_ids +='<td>';
//					profile_ids +='<input type="text" name="data[Health][profile_id]" value="'+new_profile_val+'" id="HealthProfileId">';
//					profile_ids +='</td>';
//					$('#ProfileIds').html(profile_ids);
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
					var result1 = $.grep(get_curr_ids.split('*'), function(v) { return v != datum[0]; }).join('*');
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
	var curr_sel_profiles = document.getElementById('HealthProfileId').value;
	if ($("#HealthHomeReport1").is(":checked")) {
	   var home_report = 'Yes';
	}
	if ($("#HealthHomeReport2").is(":checked")) {
	   var home_report = 'No';
	}
	var disc_code = document.getElementById('HealthDiscountCode').value;
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/get_all_profile_cnf?curr_profile='+curr_sel_profiles+'&req_id='+<?php echo $this->data['Health']['id'];?>+'&home_report='+home_report+'&disc_code='+disc_code,
		dataType:'json',
		success:function(data){
			if(data.test_info.success == 'success')
			{
				if(data.test_info.test_data.length != 0)
				{
					var rep_div = '';
					rep_div +='<td width="15%" class="boldText">Selected Profile(s)</td>';
					rep_div +='<td>';
					rep_div +='<table border="0" width="100%" style="margin:-8px 0 0 0;">';
					var g = 0;
					jQuery.each(data.test_info.test_data,function(index, value)
					{
						var selected_ids_tests = curr_sel_profiles.split(',');
						if(selected_ids_tests[0] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_profile('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[1] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_profile('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[2] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_profile('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[3] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_profile('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[4] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_profile('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[5] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_profile('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[6] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_profile('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[7] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_profile('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[8] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_profile('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[9] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_profile('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						//if($('#ProfileCheck'+value.Test.id).attr('checked'))
//						{
//							rep_div +='<tr>';
//							rep_div +='<td>';
//							rep_div +=parseInt(g+1)+'- '+value.Test.testcode+' - '+value.Test.test_parameter+' - Rs.'+value.Test.mrp;
//							rep_div +='</td>';
//							rep_div +='</tr>';
//							g = parseInt(g+1);
//						}
					});
					if(g == 0)
					{
						rep_div_heading_profile = 'Profile(s)';
						rep_div_link_profile = '';
						rep_div_link_profile +='Click to change Profile';
					}
					else
					{
						rep_div_heading_profile = '';
						rep_div_link_profile = '';
						rep_div_link_profile +='Change Profile';
						$('#OldProfileList').remove();
					}
					rep_div +='</table>';
					rep_div +='</td>';
				}
				if(g == 0)
				{
					$('#ClickProfileNew').remove();
				}
				var w = document.getElementById('ProfileCount').innerHTML;
				var ww = parseInt(w+1);
				$('#ProfileCount').html(ww);
				$('#ProfileCount').hide();
				$('#ChangeProfileHeading').html(rep_div_heading_profile);
				$('#ChangeProfileNewLink').html(rep_div_link_profile);
				$('#ChangeProfileHeading').css('margin','-15px 0 0');
				$('#ChangeProfileHeading').css('float','left');
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
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+p_p+p_o+p_z+p_s);
					var sub_tot_amt = parseInt(p+p_p+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+p_t+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_tot_amt = parseInt(q+p_t+p_o+p_z+p_s);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+p_t+p_p+p_z+p_s);
					var sub_tot_amt = parseInt(r+p_t+p_p+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s+p_t+p_p+p_o+p_s);
					var sub_tot_amt = parseInt(s+p_t+p_p+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(t+p_t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(t+p_t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+p_o+p_z+p_s);
					var sub_tot_amt = parseInt(p+q+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+p_p+p_z+p_s);
					var sub_tot_amt = parseInt(p+r+p_p+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+p_p+p_o+p_s);
					var sub_tot_amt = parseInt(p+s+p_p+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(p+t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+p_t+p_z+p_s);
					var sub_tot_amt = parseInt(q+r+p_t+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+p_t+p_o+p_s);
					var sub_tot_amt = parseInt(q+s+p_t+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+t+p_t+p_o+p_z);
					var sub_tot_amt = parseInt(q+t+p_t+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+p_t+p_p+p_s);
					var sub_tot_amt = parseInt(r+s+p_t+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t+p_t+p_p+p_z);
					var sub_tot_amt = parseInt(r+t+p_t+p_p+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s+t+p_t+p_p+p_o);
					var sub_tot_amt = parseInt(s+t+p_t+p_p+p_o);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+p_z+p_s);
					var sub_tot_amt = parseInt(p+q+r+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+s+p_p+p_s);
					var sub_tot_amt = parseInt(p+r+s+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+t+p_p+p_s);
					var sub_tot_amt = parseInt(p+s+t+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+p_t+p_s);
					var sub_tot_amt = parseInt(q+r+s+p_t+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+t+p_t+p_o);
					var sub_tot_amt = parseInt(q+s+t+p_t+p_o);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+t+p_t+p_p);
					var sub_tot_amt = parseInt(r+s+t+p_t+p_p);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s+p_s);
					var sub_tot_amt = parseInt(p+q+r+s+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+t+p_t);
					var sub_tot_amt = parseInt(q+r+s+t+p_t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
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
					var sub_tot_amt = parseInt(p+q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p_t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(p_t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').hide();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalProfile').show();
		},
		
	});
}

function edit_specimen()
	{
		$('#HealthSpecimenDate').removeAttr('disabled');
		$('#appt-time').removeAttr('disabled');
		$('#HealthSpecimenBy').removeAttr('disabled');
		$('#HealthSpecimenRemarks').removeAttr('disabled');
		$('#specimenedit').hide();
		$('#specimensubmit').show();
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
					if(offer_length == 1)
					{
						var offer_ids = '';
						offer_ids +='<td>';
						offer_ids +='<input type="text" name="data[Health][offer_id]" value="'+datum[0]+'" id="HealthOfferId">';
						offer_ids +='</td>';
						$('#OfferIds').html(offer_ids);
					}
					if(offer_length > 1)
					{
						var get_curr_ids = document.getElementById('HealthOfferId').value;
						var new_offer_value = get_curr_ids+','+datum[0];
						var offer_ids = '';
						offer_ids +='<td>';
						offer_ids +='<input type="text" name="data[Health][offer_id]" value="'+new_offer_value+'" id="HealthOfferId">';
						offer_ids +='</td>';
						$('#OfferIds').html(offer_ids);
					}
					//var offer_ids = '';
//					offer_ids +='<td>';
//					offer_ids +='<input type="text" name="data[Health][offer_id]" value="'+datum[0]+'" id="HealthOfferId">';
//					offer_ids +='</td>';
//					$('#OfferIds').html(offer_ids);
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
					//var get_curr_ids = document.getElementById('HealthOfferId').value;
//					var new_offer_val = get_curr_ids+'*'+datum[0];
//					var offer_ids = '';
//					offer_ids +='<td>';
//					offer_ids +='<input type="text" name="data[Health][offer_id]" value="'+new_offer_val+'" id="HealthOfferId">';
//					offer_ids +='</td>';
//					$('#OfferIds').html(offer_ids);
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
					var result1 = $.grep(get_curr_ids.split('*'), function(v) { return v != datum[0]; }).join('*');
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
	var curr_sel_offers = document.getElementById('HealthOfferId').value;
	if ($("#HealthHomeReport1").is(":checked")) {
	   var home_report = 'Yes';
	}
	if ($("#HealthHomeReport2").is(":checked")) {
	   var home_report = 'No';
	}
	var disc_code = document.getElementById('HealthDiscountCode').value;
	var disc_amt = document.getElementById('HealthDiscountAmount').value;
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/get_all_offer_cnf?curr_offer='+curr_sel_offers+'&req_id='+<?php echo $this->data['Health']['id'];?>+'&home_report='+home_report+'&disc_code='+disc_code,
		dataType:'json',
		success:function(data){
			if(data.test_info.success == 'success')
			{
				if(data.test_info.test_data.length != 0)
				{
					var rep_div = '';
					rep_div +='<td width="15%" class="boldText">Selected Offer(s)</td>';
					rep_div +='<td>';
					rep_div +='<table border="0" width="100%" style="margin:-8px 0 0 0;">';
					var g = 0;
					jQuery.each(data.test_info.test_data,function(index, value)
					{
						var selected_ids_tests = curr_sel_offers.split(',');
						if(selected_ids_tests[0] == value.Banner.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Banner.banner_code+' - '+value.Banner.banner_name+' - Rs.'+value.Banner.banner_mrp+' <a href="javascript:void(0);" onclick="delete_single_offer('+<?php echo $this->data['Health']['id'];?>+','+value.Banner.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[1] == value.Banner.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Banner.banner_code+' - '+value.Banner.banner_name+' - Rs.'+value.Banner.banner_mrp+' <a href="javascript:void(0);" onclick="delete_single_offer('+<?php echo $this->data['Health']['id'];?>+','+value.Banner.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[2] == value.Banner.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Banner.banner_code+' - '+value.Banner.banner_name+' - Rs.'+value.Banner.banner_mrp+' <a href="javascript:void(0);" onclick="delete_single_offer('+<?php echo $this->data['Health']['id'];?>+','+value.Banner.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[3] == value.Banner.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Banner.banner_code+' - '+value.Banner.banner_name+' - Rs.'+value.Banner.banner_mrp+' <a href="javascript:void(0);" onclick="delete_single_offer('+<?php echo $this->data['Health']['id'];?>+','+value.Banner.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[4] == value.Banner.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Banner.banner_code+' - '+value.Banner.banner_name+' - Rs.'+value.Banner.banner_mrp+' <a href="javascript:void(0);" onclick="delete_single_offer('+<?php echo $this->data['Health']['id'];?>+','+value.Banner.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[5] == value.Banner.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Banner.banner_code+' - '+value.Banner.banner_name+' - Rs.'+value.Banner.banner_mrp+' <a href="javascript:void(0);" onclick="delete_single_offer('+<?php echo $this->data['Health']['id'];?>+','+value.Banner.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[6] == value.Banner.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Banner.banner_code+' - '+value.Banner.banner_name+' - Rs.'+value.Banner.banner_mrp+' <a href="javascript:void(0);" onclick="delete_single_offer('+<?php echo $this->data['Health']['id'];?>+','+value.Banner.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[7] == value.Banner.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Banner.banner_code+' - '+value.Banner.banner_name+' - Rs.'+value.Banner.banner_mrp+' <a href="javascript:void(0);" onclick="delete_single_offer('+<?php echo $this->data['Health']['id'];?>+','+value.Banner.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_tests[8] == value.Banner.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Banner.banner_code+' - '+value.Banner.banner_name+' - Rs.'+value.Banner.banner_mrp+' <a href="javascript:void(0);" onclick="delete_single_offer('+<?php echo $this->data['Health']['id'];?>+','+value.Banner.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						//if($('#OfferCheck'+value.Banner.id).attr('checked'))
//						{
//							rep_div +='<tr>';
//							rep_div +='<td>';
//							rep_div +=parseInt(g+1)+'- '+value.Banner.banner_code+' - '+value.Banner.banner_name+' - Rs.'+value.Banner.banner_mrp;
//							rep_div +='</td>';
//							rep_div +='</tr>';
//							g = parseInt(g+1);
//						}
					});
					if(g == 0)
					{
						rep_div_heading_offer = 'Offer(s)';
						rep_div_link_offer = '';
						rep_div_link_offer +='Click to open Offer List';
					}
					else
					{
						rep_div_heading_offer = '';
						rep_div_link_offer = '';
						rep_div_link_offer +='Change Offer';
						$('#OldOfferList').remove();
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
				$('#ChangeOfferHeading').css('margin','-15px 0 0');
				$('#ChangeOfferHeading').css('float','left');
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
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+p_p+p_o+p_z+p_s);
					var sub_tot_amt = parseInt(p+p_p+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+p_t+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_tot_amt = parseInt(q+p_t+p_o+p_z+p_s);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+p_t+p_p+p_z+p_s);
					var sub_tot_amt = parseInt(r+p_t+p_p+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s+p_t+p_p+p_o+p_s);
					var sub_tot_amt = parseInt(s+p_t+p_p+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(t+p_t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(t+p_t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+p_o+p_z+p_s);
					var sub_tot_amt = parseInt(p+q+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+p_p+p_z+p_s);
					var sub_tot_amt = parseInt(p+r+p_p+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+p_p+p_o+p_s);
					var sub_tot_amt = parseInt(p+s+p_p+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(p+t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+p_t+p_z+p_s);
					var sub_tot_amt = parseInt(q+r+p_t+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+p_t+p_o+p_s);
					var sub_tot_amt = parseInt(q+s+p_t+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+t+p_t+p_o+p_z);
					var sub_tot_amt = parseInt(q+t+p_t+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+p_t+p_p+p_s);
					var sub_tot_amt = parseInt(r+s+p_t+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t+p_t+p_p+p_z);
					var sub_tot_amt = parseInt(r+t+p_t+p_p+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s+t+p_t+p_p+p_o);
					var sub_tot_amt = parseInt(s+t+p_t+p_p+p_o);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+p_z+p_s);
					var sub_tot_amt = parseInt(p+q+r+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+s+p_p+p_s);
					var sub_tot_amt = parseInt(p+r+s+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+t+p_p+p_s);
					var sub_tot_amt = parseInt(p+s+t+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+p_t+p_s);
					var sub_tot_amt = parseInt(q+r+s+p_t+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+t+p_t+p_o);
					var sub_tot_amt = parseInt(q+s+t+p_t+p_o);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+t+p_t+p_p);
					var sub_tot_amt = parseInt(r+s+t+p_t+p_p);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s+p_s);
					var sub_tot_amt = parseInt(p+q+r+s+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+t+p_t);
					var sub_tot_amt = parseInt(q+r+s+t+p_t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
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
					var sub_tot_amt = parseInt(p+q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p_t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(p_t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').hide();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalOffer').show();
		},
		
	});
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
					//var package_ids = '';
//					package_ids +='<td>';
//					package_ids +='<input type="text" name="data[Health][package_id]" value="'+datum[0]+'" id="HealthPackageId">';
//					package_ids +='</td>';
//					$('#PackageIds').html(package_ids);
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
					//var get_curr_ids = document.getElementById('HealthPackageId').value;
//					var new_package_val = get_curr_ids+'*'+datum[0];
//					var package_ids = '';
//					package_ids +='<td>';
//					package_ids +='<input type="text" name="data[Health][package_id]" value="'+new_package_val+'" id="HealthPackageId">';
//					package_ids +='</td>';
//					$('#PackageIds').html(package_ids);
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
					var result1 = $.grep(get_curr_ids.split('*'), function(v) { return v != datum[0]; }).join('*');
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
	var curr_sel_packages = document.getElementById('HealthPackageId').value;
	if ($("#HealthHomeReport1").is(":checked")) {
	   var home_report = 'Yes';
	}
	if ($("#HealthHomeReport2").is(":checked")) {
	   var home_report = 'No';
	}
	var disc_code = document.getElementById('HealthDiscountCode').value;
	var disc_amt = document.getElementById('HealthDiscountAmount').value;
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/get_all_package_cnf?curr_pack='+curr_sel_packages+'&req_id='+<?php echo $this->data['Health']['id'];?>+'&home_report='+home_report+'&disc_code='+disc_code+'&disc_amt='+disc_amt,
		dataType:'json',
		success:function(data){
			if(data.test_info.success == 'success')
			{
				if(data.test_info.test_data.length != 0)
				{
					var rep_div = '';
					rep_div +='<td width="15%" class="boldText">Selected Package(s)</td>';
					rep_div +='<td>';
					rep_div +='<table border="0" width="100%" style="margin:-8px 0 0 0;">';
					var g = 0;
					jQuery.each(data.test_info.test_data,function(index, value)
					{
						var selected_ids_tests = curr_sel_packages.split(',');
						if(selected_ids_tests[0] == value.Package.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Package.package_name+' - Rs.'+value.Package.package_mrp+' <a href="javascript:void(0);" onclick="delete_single_package('+<?php echo $this->data['Health']['id'];?>+','+value.Package.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						if(selected_ids_tests[1] == value.Package.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Package.package_name+' - Rs.'+value.Package.package_mrp+' <a href="javascript:void(0);" onclick="delete_single_package('+<?php echo $this->data['Health']['id'];?>+','+value.Package.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						if(selected_ids_tests[2] == value.Package.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Package.package_name+' - Rs.'+value.Package.package_mrp+' <a href="javascript:void(0);" onclick="delete_single_package('+<?php echo $this->data['Health']['id'];?>+','+value.Package.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						if(selected_ids_tests[3] == value.Package.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Package.package_name+' - Rs.'+value.Package.package_mrp+' <a href="javascript:void(0);" onclick="delete_single_package('+<?php echo $this->data['Health']['id'];?>+','+value.Package.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						if(selected_ids_tests[4] == value.Package.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Package.package_name+' - Rs.'+value.Package.package_mrp+' <a href="javascript:void(0);" onclick="delete_single_package('+<?php echo $this->data['Health']['id'];?>+','+value.Package.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						if(selected_ids_tests[5] == value.Package.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Package.package_name+' - Rs.'+value.Package.package_mrp+' <a href="javascript:void(0);" onclick="delete_single_package('+<?php echo $this->data['Health']['id'];?>+','+value.Package.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						//if($('#PackageCheck'+value.Package.id).attr('checked'))
//						{
//							rep_div +='<tr>';
//							rep_div +='<td>';
//							rep_div +=parseInt(g+1)+'- '+value.Package.package_name+' - Rs.'+value.Package.package_mrp;
//							rep_div +='</td>';
//							rep_div +='</tr>';
//							g = parseInt(g+1);
//						}
					});
					if(g == 0)
					{
						rep_div_heading_package = 'Package(s)';
						rep_div_link_package = '';
						rep_div_link_package +='Click to open Package List';
					}
					else
					{
						rep_div_heading_package = '';
						rep_div_link_package = '';
						rep_div_link_package +='Change Package';
						$('#OldPackageList').remove();
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
				$('#ChangePackageHeading').css('margin','-15px 0 0');
				$('#ChangePackageHeading').css('float','left');
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
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+p_p+p_o+p_z+p_s);
					var sub_tot_amt = parseInt(p+p_p+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+p_t+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_tot_amt = parseInt(q+p_t+p_o+p_z+p_s);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+p_t+p_p+p_z+p_s);
					var sub_tot_amt = parseInt(r+p_t+p_p+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s+p_t+p_p+p_o+p_s);
					var sub_tot_amt = parseInt(s+p_t+p_p+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(t+p_t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(t+p_t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+p_o+p_z+p_s);
					var sub_tot_amt = parseInt(p+q+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+p_p+p_z+p_s);
					var sub_tot_amt = parseInt(p+r+p_p+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+p_p+p_o+p_s);
					var sub_tot_amt = parseInt(p+s+p_p+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(p+t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+p_t+p_z+p_s);
					var sub_tot_amt = parseInt(q+r+p_t+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+p_t+p_o+p_s);
					var sub_tot_amt = parseInt(q+s+p_t+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+t+p_t+p_o+p_z);
					var sub_tot_amt = parseInt(q+t+p_t+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+p_t+p_p+p_s);
					var sub_tot_amt = parseInt(r+s+p_t+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t+p_t+p_p+p_z);
					var sub_tot_amt = parseInt(r+t+p_t+p_p+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s+t+p_t+p_p+p_o);
					var sub_tot_amt = parseInt(s+t+p_t+p_p+p_o);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+p_z+p_s);
					var sub_tot_amt = parseInt(p+q+r+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+s+p_p+p_s);
					var sub_tot_amt = parseInt(p+r+s+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+t+p_p+p_s);
					var sub_tot_amt = parseInt(p+s+t+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+p_t+p_s);
					var sub_tot_amt = parseInt(q+r+s+p_t+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+t+p_t+p_o);
					var sub_tot_amt = parseInt(q+s+t+p_t+p_o);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+t+p_t+p_p);
					var sub_tot_amt = parseInt(r+s+t+p_t+p_p);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s+p_s);
					var sub_tot_amt = parseInt(p+q+r+s+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+t+p_t);
					var sub_tot_amt = parseInt(q+r+s+t+p_t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
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
					var sub_tot_amt = parseInt(p+q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p_t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(p_t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').hide();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalPackage').show();
		},
		
	});
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
					//var test_ids = '';
//					test_ids +='<td>';
//					test_ids +='<input type="text" name="data[Health][test_id]" value="'+datum[0]+'" id="HealthTestId">';
//					test_ids +='</td>';
//					$('#TestIds').html(test_ids);
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
					//var get_curr_ids = document.getElementById('HealthTestId').value;
//					var new_test_val = get_curr_ids+'*'+datum[0];
//					var test_ids = '';
//					test_ids +='<td>';
//					test_ids +='<input type="text" name="data[Health][test_id]" value="'+new_test_val+'" id="HealthTestId">';
//					test_ids +='</td>';
//					$('#TestIds').html(test_ids);
				}
			}
			else
			{
				var a = parseInt(document.getElementById('ServiceAmt').innerHTML);
				if(a != 0)
				{
					var x = parseInt(datum[3]);
					var b = a-x;
					var c = parseInt(b);
					$('#ServiceAmt').text(c);
					var get_curr_ids = document.getElementById('HealthServiceId').value;
					var result1 = $.grep(get_curr_ids.split('*'), function(v) { return v != datum[0]; }).join('*');
					var test_ids = '';
					test_ids +='<td>';
					test_ids +='<input type="text" name="data[Health][service_id]" value="'+result1+'" id="HealthServiceId">';
					test_ids +='</td>';
					$('#ServiceIds').html(test_ids);
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
	var curr_sel_services = document.getElementById('HealthServiceId').value;
	if ($("#HealthHomeReport1").is(":checked")) {
	   var home_report = 'Yes';
	}
	if ($("#HealthHomeReport2").is(":checked")) {
	   var home_report = 'No';
	}
	var disc_code = document.getElementById('HealthDiscountCode').value;
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/get_all_service_cnf?curr_service='+curr_sel_services+'&req_id='+<?php echo $this->data['Health']['id'];?>+'&home_report='+home_report+'&disc_code='+disc_code,
		dataType:'json',
		success:function(data){
			if(data.test_info.success == 'success')
			{
				if(data.test_info.test_data.length != 0)
				{
					var rep_div = '';
					rep_div +='<td width="15%" class="boldText">Selected Patient Care Services</td>';
					rep_div +='<td>';
					rep_div +='<table border="0" width="100%" style="margin:-8px 0 0 0;">';
					var g = 0;
					jQuery.each(data.test_info.test_data,function(index, value)
					{
						var selected_ids_service = curr_sel_services.split(',');
						if(selected_ids_service[0] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_service('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_service[1] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_service('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_service[2] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_service('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_service[3] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_service('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_service[4] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_service('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_service[5] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_service('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_service[6] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_service('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_service[7] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_service('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_service[8] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_service('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
						else if(selected_ids_service[9] == value.Test.id)
						{
							rep_div +='<tr>';
							rep_div +='<td>';
							rep_div +=parseInt(g+1)+'- '+value.Test.test_parameter+' - Rs.'+value.Test.mrp+' <a href="javascript:void(0);" onclick="delete_single_service('+<?php echo $this->data['Health']['id'];?>+','+value.Test.id+');" style="font-weight:bold; color:#FF0000; text-decoration:none;">[X]</a>';
							rep_div +='</td>';
							rep_div +='</tr>';
							g = parseInt(g+1);
						}
					});
					if(g == 0)
					{
						rep_div_heading_package = 'Patient Care Services';
						rep_div_link_package = '';
						rep_div_link_package +='Click to open Patient Care Services List';
					}
					else
					{
						rep_div_heading_package = '';
						rep_div_link_package = '';
						rep_div_link_package +='Change Patient Care Services';
						$('#OldServiceList').remove();
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
				$('#ChangeServiceHeading').html(rep_div_heading_package);
				$('#ChangeServiceNewLink').html(rep_div_link_package);
				$('#ChangeServiceHeading').css('margin','-15px 0 0');
				$('#ChangeServiceHeading').css('float','left');
				$('#ClickServiceNew').html(rep_div);
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
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+p_p+p_o+p_z+p_s);
					var sub_tot_amt = parseInt(p+p_p+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+p_t+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_tot_amt = parseInt(q+p_t+p_o+p_z+p_s);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+p_t+p_p+p_z+p_s);
					var sub_tot_amt = parseInt(r+p_t+p_p+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s+p_t+p_p+p_o+p_s);
					var sub_tot_amt = parseInt(s+p_t+p_p+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(t+p_t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(t+p_t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+p_o+p_z+p_s);
					var sub_tot_amt = parseInt(p+q+p_o+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+p_p+p_z+p_s);
					var sub_tot_amt = parseInt(p+r+p_p+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+p_p+p_o+p_s);
					var sub_tot_amt = parseInt(p+s+p_p+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(p+t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+p_t+p_z+p_s);
					var sub_tot_amt = parseInt(q+r+p_t+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+p_t+p_o+p_s);
					var sub_tot_amt = parseInt(q+s+p_t+p_o+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt == 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+t+p_t+p_o+p_z);
					var sub_tot_amt = parseInt(q+t+p_t+p_o+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+p_t+p_p+p_s);
					var sub_tot_amt = parseInt(r+s+p_t+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt == 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+t+p_t+p_p+p_z);
					var sub_tot_amt = parseInt(r+t+p_t+p_p+p_z);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(s+t+p_t+p_p+p_o);
					var sub_tot_amt = parseInt(s+t+p_t+p_p+p_o);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt == 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+p_z+p_s);
					var sub_tot_amt = parseInt(p+q+r+p_z+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+r+s+p_p+p_s);
					var sub_tot_amt = parseInt(p+r+s+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt == 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+s+t+p_p+p_s);
					var sub_tot_amt = parseInt(p+s+t+p_p+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+p_t+p_s);
					var sub_tot_amt = parseInt(q+r+s+p_t+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt == 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+s+t+p_t+p_o);
					var sub_tot_amt = parseInt(q+s+t+p_t+p_o);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(r+s+t+p_t+p_p);
					var sub_tot_amt = parseInt(r+s+t+p_t+p_p);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt != 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt == 0)
				{
					var p = parseInt(document.getElementById('TestAmt').innerHTML);
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p+q+r+s+p_s);
					var sub_tot_amt = parseInt(p+q+r+s+p_s);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt != 0 && offer_amt != 0 && package_amt != 0 && service_amt != 0)
				{
					var q = parseInt(document.getElementById('ProfileAmt').innerHTML);
					var r = parseInt(document.getElementById('OfferAmt').innerHTML);
					var s = parseInt(document.getElementById('PackageAmt').innerHTML);
					var t = parseInt(document.getElementById('ServiceAmt').innerHTML);
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(q+r+s+t+p_t);
					var sub_tot_amt = parseInt(q+r+s+t+p_t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
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
					var sub_tot_amt = parseInt(p+q+r+s+t);
					$('#t_f_a_t_p_o_r').show();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
				if(test_amt == 0 && profile_amt == 0 && offer_amt == 0 && package_amt == 0 && service_amt == 0)
				{
					var p_t = parseInt(document.getElementById('HealthIndiTestAmt').value);
					var p_p = parseInt(document.getElementById('HealthIndiProfileAmt').value);
					var p_o = parseInt(document.getElementById('HealthIndiOfferAmt').value);
					var p_z = parseInt(document.getElementById('HealthIndiPackageAmt').value);
					var p_s = parseInt(document.getElementById('HealthIndiServiceAmt').value);
					var tot_amt_t_p_o_final = 'Rs. '+parseInt(p_t+p_p+p_o+p_z);
					var sub_tot_amt = parseInt(p_t+p_p+p_o+p_z);
					$('#t_f_a_t_p_o_r').hide();
					$('#t_f_a_t_p_o').text(tot_amt_t_p_o_final);
					var sub_total = '';
					sub_total +='<input type="hidden" name="data[Health][total_amount]" value="'+sub_tot_amt+'">';
					$('#SubTotal').html(sub_total);
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalService').show();
		},
		
	});
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


function show_partial(val)
{
	if(val == 1)
	{
		$('#tAmt').hide();
		$('#rAmt').hide();
		$('#bAmt').hide();
		$('#eAmt').hide();
		var pay_status = '';
		pay_status +='<td>';
		pay_status += '<input type="text" name="data[Health][pay_status]" value="'+val+'">';
		pay_status +='</td>';
		$('#PayStatusDiv').html(pay_status);
	}
	if(val == 2)
	{
		$('#tAmt').show();
		$('#rAmt').show();
		$('#bAmt').show();
		$('#eAmt').show();
		var pay_status = '';
		pay_status +='<td>';
		pay_status += '<input type="text" name="data[Health][pay_status]" value="'+val+'">';
		pay_status +='</td>';
		$('#PayStatusDiv').html(pay_status);
	}
	
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
		$('#submit_div').show();
	}
}

function specimen_detail()
{
	$('#SentLabApi').hide();
	$('#BpNet').hide();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#editDetails').hide();
	$('#SampleRegister').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#SentLab').hide();
	$('#MarkClosed').hide();
	$('#ActiveLog').hide();
	$('#PatientVital').hide();
	$('#LabMessage').hide();
	$('#Samplesave').hide();
	$('#raise_ticket').hide();
	$('#specimen_d').show();
}

function show_raise_ticket()
{
	$('#SentLabApi').hide();
	$('#BpNet').hide();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#editDetails').hide();
	$('#SampleRegister').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#SentLab').hide();
	$('#MarkClosed').hide();
	$('#ActiveLog').hide();
	$('#PatientVital').hide();
	$('#LabMessage').hide();
	$('#Samplesave').hide();
	$('#specimen_d').hide();
	$('#raise_ticket').show();
}

function show_payment()
{
	$('#SentLabApi').hide();
	$('#BpNet').hide();
	$('#updatePayStatus').show();
	$('#uploadReport').hide();
	$('#editDetails').hide();
	$('#SampleRegister').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#SentLab').hide();
	$('#MarkClosed').hide();
	 $('#ActiveLog').hide();
	  $('#PatientVital').hide();
	  $('#LabMessage').hide();
	  $('#specimen_d').hide();
	  $('#raise_ticket').hide();
$('#Samplesave').hide();
}

function payment_submit()
{
	var payment_mode=$("#HealthPayMode").val();
	
	if(payment_mode == 'adjust')
	{
		var total_amt_received=parseInt($("#total_amt_received").val());
                var adj_amount=parseInt($("#HealthAdjAmt").val());
		
		if(adj_amount > total_amt_received)
		{
			alert('Refund amount can not be greater than received amount'); 
			return false;
		}
	}
	else
	{
		var tot_bal_amt = parseInt($("#HealthBalAmt").val());
		var tot_rece_amt= parseInt($("#HealthPayAmt").val());
		if(tot_rece_amt > tot_bal_amt)
		{
			alert('Received amount can not be greater than balance due'); 
			return false;
		}
		if(payment_mode == 'btcnopayment')
		{
			if(tot_bal_amt == 0)
			{
				alert('You can not receive multiple payment'); 
				return false;
			}
		}
	}
	return true;
	//document.forms["form2"].submit();
}

function submit_form_process()
{
	document.forms["form5"].submit();
}

function submit_form_reschdule()
{
	document.forms["form6"].submit();
}

// Function used to validate sent to lab action for lab ref no
function validateSentLab()
{
	var lab_ref = $("#ref_num").val();
	var regex = /^[0-9]{5,14}$/
	isValid = regex.test(lab_ref);
	if(!isValid)
	{
		$("#errmsg").html("Lab ref no - should be only number and between 5 to 14 digit in length").show();
		return false;

}
}


function submit_closed()
{
	document.forms["form9"].submit();
}

function submit_closededed()
{
	document.forms["form1121"].submit();
}



function submit_message()
{
	document.forms["form12"].submit();
}

function show_up_report(id)
{
	if(id=='p')
	{
		$('#radio2ReportType').hide();
		$('#f').hide();
		$('#p').show();
		$('#radio1ReportType').show();
	
		
	}
	if(id=='f'){
		
		$('#radio1ReportType').hide();
		$('#radio2ReportType').show();
		$('#p').hide();
		$('#f').show();
		var null_val = '';
		    $('#MessageUser').hide();
			$('#HealthReportReason').val(null_val);
	}
		$('#JsonLog').hide();
	$('#BpNet').hide();
	$('#SentLabApi').hide();
	$('#uploadReport').show();
	$('#uploadReportf').hide();
	$('#updatePayStatus').hide();
	$('#editDetails').hide();
	$('#SampleRegister').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#SentLab').hide();
	$('#raise_ticket').hide();
	$('#LabMessage').hide();
	$('#MarkClosed').hide();
		  $('#specimen_d').hide();
	  $('#raise_ticket').hide();
	 $('#ActiveLog').hide();
	  $('#PatientVital').hide();
		$('#Samplesave').hide();
	<?php if($this->data['Health']['published'] == 0) {?>
	$('#PublishReason').show();
	<?php }?>
}


function show_edit()
{
	$('#JsonLog').hide();
	$('#BpNet').hide();
	$('#SentLabApi').hide();
	$('#editDetails').show();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#SampleRegister').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#SentLab').hide();
	$('#LabMessage').hide();
	$('#MarkClosed').hide();
	 $('#ActiveLog').hide();
	  $('#PatientVital').hide();
	  $('#uploadReportf').hide();
		$('#Samplesave').hide();
			  $('#specimen_d').hide();
	  $('#raise_ticket').hide();
}

function message_lab()
{
	$('#JsonLog').hide();
	$('#BpNet').hide();
	$('#SentLabApi').hide();
	$('#LabMessage').show();
	$('#editDetails').hide();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#SampleRegister').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#SentLab').hide();
	$('#raise_ticket').hide();
	$('#MarkClosed').hide();
	 $('#ActiveLog').hide();
	 	  $('#specimen_d').hide();
	  $('#raise_ticket').hide();
	  $('#PatientVital').hide();
	  $('#uploadReportf').hide();
		$('#Samplesave').hide();	
	<?php if($this->data['Health']['message_status'] == 1) {?>
	$('#MessageDiv').show();
	<?php }?>
}

function show_form()
{
	$('#JsonLog').hide();
	$('#BpNet').hide();
	$('#ProcessRequest').show();
	$('#editDetails').hide();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#ProcessCancel').hide();
	<?php if($this->data['Health']['register_sample'] == 1) {?>
	$('#SampleRegister').show();
	<?php } else {?>
	$('#SampleRegister').hide();
	<?php }?>
	$('#SentLab').hide();
	$('#LabMessage').hide();
	$('#MarkClosed').hide();
	$('#ActiveLog').hide();
	 $('#PatientVital').hide();
	 $('#uploadReportf').hide();
	$('#Samplesave').hide();
		  $('#specimen_d').hide();
	  $('#raise_ticket').hide();
	
}

function show_cancel()
{
	$('#JsonLog').hide();
	$('#BpNet').hide();
	$('#ProcessCancel').show();
	$('#ProcessRequest').hide();
	$('#editDetails').hide();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#SampleRegister').hide();
	$('#SentLab').hide();
	$('#LabMessage').hide();
	$('#MarkClosed').hide();
	 $('#ActiveLog').hide();
	  $('#PatientVital').hide();
	  $('#uploadReportf').hide();
	$('#Samplesave').hide();
		  $('#specimen_d').hide();
	$('#raise_ticket').hide();
	$('#SentLabApi').hide();
}



function closed_stat()
{
	$('#JsonLog').hide();
	$('#BpNet').hide();
     $('#MarkClosed').show();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#editDetails').hide();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#SampleRegister').hide();
	$('#SentLab').hide();
	$('#LabMessage').hide();
	$('#ActiveLog').hide();
	 $('#PatientVital').hide();
	 $('#uploadReportf').hide();
	$('#Samplesave').hide();
		  $('#specimen_d').hide();
	  $('#raise_ticket').hide();
}
function json_log()
{
	$('#JsonLog').show();
	$('#BpNet').hide();
      $('#ActiveLog').hide();
	 $('#MarkClosed').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#editDetails').hide();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#SampleRegister').hide();
	$('#SentLab').hide();
	$('#LabMessage').hide();
	 $('#PatientVital').hide();
	 $('#uploadReportf').hide();
	$('#Samplesave').hide();	
		  $('#specimen_d').hide();
	  $('#raise_ticket').hide();
}
function active_log()
{
	$('#JsonLog').hide();
	$('#BpNet').hide();
      $('#ActiveLog').show();
	 $('#MarkClosed').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#editDetails').hide();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#SampleRegister').hide();
	$('#SentLab').hide();
	$('#LabMessage').hide();
	 $('#PatientVital').hide();
	 $('#uploadReportf').hide();
	$('#Samplesave').hide();	
		  $('#specimen_d').hide();
	$('#raise_ticket').hide();
	$('#SentLabApi').hide();
}
function show_bp_net()
{
	$('#JsonLog').hide();
	$('#Samplesave').hide();
	$('#BpNet').show();
	 $('#MarkClosed').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#editDetails').hide();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#SampleRegister').hide();
	$('#SentLab').hide();
	$('#LabMessage').hide();
	 $('#PatientVital').hide();
	 $("#ActiveLog").hide();
	 $('#uploadReportf').hide();
	 	  $('#specimen_d').hide();
	  $('#raise_ticket').hide();
}






function sample_register(val)
{
	$('#BpNet').hide();
	if(val == 1)
	{
		$('#SampleRegister').show();
		$('#ProcessCancel').hide();
		$('#ProcessRequest').show();
		$('#editDetails').hide();
		$('#updatePayStatus').hide();
		$('#uploadReport').hide();
		$('#SentLab').hide();
		$('#LabMessage').hide();
		$('#MarkClosed').hide();
		$('#uploadReportf').hide();
		$('#Samplesave').hide();
			  $('#specimen_d').hide();
	  $('#raise_ticket').hide();
	}
	else
	{
		var set_val = '';
		$('#VialCol1').val(set_val);
		$('#VialCol2').val(set_val);
		$('#VialCol3').val(set_val);
		$('#VialCol4').val(set_val);
		$('#VialCol5').val(set_val);
		$('#VialCol6').val(set_val);
		$('#VialCol7').val(set_val);
		$('#VialRemark1').val(set_val);
		$('#VialRemark2').val(set_val);
		$('#VialRemark3').val(set_val);
		$('#VialRemark4').val(set_val);
		$('#VialRemark5').val(set_val);
		$('#VialRemark6').val(set_val);
		$('#VialRemark7').val(set_val);
		$('#Samplesave').hide();
		$('#SampleRegister').hide();
		$('#ProcessCancel').hide();
		$('#ProcessRequest').show();
		$('#editDetails').hide();
		$('#updatePayStatus').hide();
		$('#uploadReport').hide();
		$('#SentLab').hide();
		$('#LabMessage').hide();
		$('#MarkClosed').hide();
			  $('#specimen_d').hide();
	}
	$('#raise_ticket').hide();
	$('#SentLabApi').hide();
}

function report_call()
{
	var id = $('#HealthRequestId').val();
	$.ajax({
		type: "POST", 		//GET or POST or PUT or DELETE verb
	    	url: "/admin/samples/get_sample_report", 		// Location of the service
	   	data: { 'id':$('#HealthRequestId').val() }, 		//Data sent to server
	    	success: function (data) {//On Successful service call
			$('#BpNet').hide();
			$('#SentLabApi').hide();
			$('#SentLab').hide();
			$('#Samplesave').show();
			$('#SampleRegister').hide();
			$('#ProcessCancel').hide();
			$('#ProcessRequest').hide();
			$('#editDetails').hide();
			$('#updatePayStatus').hide();
			$('#uploadReport').hide();
			$('#LabMessage').hide();
			$('#MarkClosed').hide();
			$('#ActiveLog').hide();
			 $('#PatientVital').hide();
			 $('#uploadReportf').hide();
			$('#save_sample').html(data);
				  $('#specimen_d').hide();
	  $('#raise_ticket').hide();
		},
        });
}
function sample_test()
{
	var id = $('#HealthRequestId').val();
	$.ajax({
		type: "POST", 		//GET or POST or PUT or DELETE verb
	    	url: "/admin/samples/get_sample_data", 		// Location of the service
	   	data: { 'id':$('#HealthRequestId').val() }, 		//Data sent to server
	    	success: function (data) {//On Successful service call
			$('#BpNet').hide();
			$('#SentLabApi').hide();
			$('#SentLab').hide();
			$('#Samplesave').show();
			$('#SampleRegister').hide();
			$('#ProcessCancel').hide();
			$('#ProcessRequest').hide();
			$('#editDetails').hide();
			$('#updatePayStatus').hide();
			$('#uploadReport').hide();
			$('#LabMessage').hide();
			$('#MarkClosed').hide();
			$('#ActiveLog').hide();
			 $('#PatientVital').hide();
			 $('#uploadReportf').hide();
			 $('#specimen_d').hide();
			$('#raise_ticket').hide();
			$('#save_sample').html(data);
	    },
        });
}
function sent_lab()
{
		$('#Samplesave').hide();
	$('#BpNet').hide();
	$('#SentLabApi').hide();
	$('#SentLab').show();
	$('#SampleRegister').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#editDetails').hide();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#LabMessage').hide();
	$('#MarkClosed').hide();
	$('#ActiveLog').hide();
	 $('#PatientVital').hide();
	 $('#uploadReportf').hide();
	 	  $('#specimen_d').hide();
	  $('#raise_ticket').hide();
}
function edit_sample_list()
{
	sent_lab_api();
	$('#sample_collected_button').show();
	$('#stl_btn').show();
	$('#result_sample').html('');

}

function sent_lab_api()
{
		$('#Samplesave').hide();
	$('#BpNet').hide();
	$('#SentLab').hide();
	$('#SentLabApi').show();
	$('#SampleRegister').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#editDetails').hide();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#LabMessage').hide();
	$('#MarkClosed').hide();
	$('#ActiveLog').hide();
	 $('#PatientVital').hide();
	 $('#uploadReportf').hide();
	 	  $('#specimen_d').hide();
	  $('#raise_ticket').hide();
}

function message_div(val)
{
	if(val == 1)
	{
		$('#MessageDiv').show();
	}
	if(val == 0)
	{
		var c = '';
		$('#HealthLabMessage').val(c)
		$('#MessageDiv').hide();
	}
}

function cancel_stat(val)
{
	if(val == 1)
	{
		$('#CancelRow').show();
	}
	else if(val == 0)
	{
		document.getElementById('HealthCancelledReason').value = '';
		$('#CancelRow').hide();
	}
}




function closed_statesde(val)
{
if(val == 1)
	{
		$('#MakeDiv').show();
	}
	if(val == 0)
	{
		var c = '';
		
		$('#MakeDiv').hide();
	}
}


function reschdule_stat(val)
{
	if(val == 1)
	{
		$('#RescheduleRow').show();
	}
	else if(val == 0)
	{
		document.getElementById('HealthNewRequestDate').value = '';
		document.getElementById('HealthNewRequestTime').value = '';
		$('#RescheduleRow').hide();
	}
}



</script>

<script language="JavaScript" type="text/javascript">
function validationc_report()
{
	var str=true;
	document.getElementById("msg1_1").innerHTML="";
	if(document.form3.HealthPatientReport.value=='')
	{
		document.getElementById("msg1_1").innerHTML="Please Select Report";
		str=false;
	}
	return str;
}
</script>

<script type="text/javascript">
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
		$('#home_collection_5').hide();
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
		$('#home_collection_5').show();
		$('#submit_div').show();
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
	
	
	
	return str;
}
</script>

<script type="text/javascript">
$(function() {
	$( ".datepicker" ).datepicker({
		minDate: '-0D',
		maxDate: '+30D',
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker2" ).datepicker({
		minDate: '-0D',
		maxDate: '+30D',
		dateFormat: 'dd-mm-yy'
	});
});

function update_refund(id)
{
	if($("#RefundStatus1").is(":checked"))
	{
		var refund_val1 = document.getElementById('RefundStatus1').value;
		var refund_value = document.getElementById('HealthBalRef').value;
		var ref_status = document.getElementById('RefundStatus1').value;
		jQuery.ajax({
			type:'GET',
			url:siteUrl+'admin/samples/update_refund?health_id='+id+'&ref_stat='+refund_value+'&refund_status='+ref_status,
			success:function(data){
				var rep_td = '';
				rep_td +='<td width="15%" class="boldText">Refund Status</td>';
				rep_td +='<td>';
				rep_td +=data;
				rep_td +='</td>';
				$('#RefundStat').html(rep_td);
				$('#LoadDiv').hide();
			},
			beforeSend:function(){
				jQuery('#LoadDiv').show();
			},
			
		});
	}
}

function show_update_span()
{
	$('#UpdateSpan').show();
}

function delete_single_test(val1,val2)
{
	var allow_test_edit = document.getElementById("allowtestedit").value;
	if(allow_test_edit == 0)
	{
		alert("You are not authorize to delete test, after sent to lab");
		return false;
	}
	var disc_code = document.getElementById('HealthDiscountCode').value;
	var all_tests = document.getElementById('HealthTestId').value;
	if ($("#HealthHomeReport1").is(":checked")) {
	   var home_report = 'Yes';
	}
	if ($("#HealthHomeReport2").is(":checked")) {
	   var home_report = 'No';
	}
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/delete_single_test?req_id='+val1+'&test_id='+val2+'&discount='+disc_code+'&all_test='+all_tests+'&home_report='+home_report,
		dataType:'json',
		success:function(data){
			if(data.test_info.success == 'success')
			{
				var new_tot_amt = 'Rs. '+data.test_info.total_amt;
				$('#t_f_a_t_p_o').html(new_tot_amt);
				$('#t_f_a_t_p_o_r').show();
				
				$('#HealthDiscountAmount').val("0");
				$('#HealthDiscountCode').val("");
				$('#HealthDiscountAmountReason').val("");
				
				if(data.test_info.new_tests.length != 0)
				{
					var tests = '';
					tests +='<td width="15%" class="boldText">Tests</td>';
					tests +='<td>';
					tests +='<table border="0" width="100%">';
					var d = 0;
					jQuery.each(data.test_info.new_tests,function(index, value)
					{
						tests +='<tr>';
						tests +='<td>';
						tests +=parseInt(d+1)+'- '+value.name+' <a href="javascript:void(0);" onclick="delete_single_test('+val1+','+value.test_id+');" style="font-weight:bold; color:#FF0000; text-decoration:none; cursor:ponter;">[X]</a>';
						tests +='</td>';
						tests +='</tr>';
						d = parseInt(d+1);
					});
					tests +='<tr>';
					tests +='</table>';
					tests +='</td>';
					$('#ClickTestNew').html(tests);
					$('#ClickTestNew').show();
					$('#ClickTest').hide();
				}
				else{
					$('#ClickTestNew').html('');
					$('#ClickTestNew').show();
					$('#ClickTest').hide();
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalPackage').show();
		},
		
	});
}

function delete_single_profile(val1,val2)
{
	var allow_test_edit = document.getElementById("allowtestedit").value;
	if(allow_test_edit == 0)
	{
		alert("You are not authorize to delete test, after sent to lab");
		return false;
	}
	
	var disc_code = document.getElementById('HealthDiscountCode').value;
	var all_tests = document.getElementById('HealthProfileId').value;
	if ($("#HealthHomeReport1").is(":checked")) {
	   var home_report = 'Yes';
	}
	if ($("#HealthHomeReport2").is(":checked")) {
	   var home_report = 'No';
	}
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/delete_single_profile?req_id='+val1+'&test_id='+val2+'&discount='+disc_code+'&all_test='+all_tests+'&home_report='+home_report,
		dataType:'json',
		success:function(data){
			if(data.test_info.success == 'success')
			{
				var new_tot_amt = 'Rs. '+data.test_info.total_amt;
				$('#t_f_a_t_p_o').html(new_tot_amt);
				$('#t_f_a_t_p_o_r').show();
				
				if(data.test_info.new_tests.length != 0)
				{
					var tests = '';
					tests +='<td width="15%" class="boldText">Profiles</td>';
					tests +='<td>';
					tests +='<table border="0" width="100%">';
					var d = 0;
					jQuery.each(data.test_info.new_tests,function(index, value)
					{
						tests +='<tr>';
						tests +='<td>';
						tests +=parseInt(d+1)+'- '+value.name+' <a href="javascript:void(0);" onclick="delete_single_profile('+val1+','+value.test_id+');" style="font-weight:bold; color:#FF0000; text-decoration:none; cursor:ponter;">[X]</a>';
						tests +='</td>';
						tests +='</tr>';
						d = parseInt(d+1);
					});
					tests +='<tr>';
					tests +='</table>';
					tests +='</td>';
					$('#ClickProfileNew').html(tests);
					$('#ClickProfileNew').show();
					$('#ClickProfile').hide();
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalPackage').show();
		},
		
	});
}

function delete_single_offer(val1,val2)
{
	var disc_code = document.getElementById('HealthDiscountCode').value;
	var all_tests = document.getElementById('HealthOfferId').value;
	if ($("#HealthHomeReport1").is(":checked")) {
	   var home_report = 'Yes';
	}
	if ($("#HealthHomeReport2").is(":checked")) {
	   var home_report = 'No';
	}
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/delete_single_offer?req_id='+val1+'&test_id='+val2+'&discount='+disc_code+'&all_test='+all_tests+'&home_report='+home_report,
		dataType:'json',
		success:function(data){
			if(data.test_info.success == 'success')
			{
				var new_tot_amt = 'Rs. '+data.test_info.total_amt;
				$('#t_f_a_t_p_o').html(new_tot_amt);
				$('#t_f_a_t_p_o_r').show();
				
				if(data.test_info.new_tests.length != 0)
				{
					var tests = '';
					tests +='<td width="15%" class="boldText">Offers</td>';
					tests +='<td>';
					tests +='<table border="0" width="100%">';
					var d = 0;
					jQuery.each(data.test_info.new_tests,function(index, value)
					{
						tests +='<tr>';
						tests +='<td>';
						tests +=parseInt(d+1)+'- '+value.name+' <a href="javascript:void(0);" onclick="delete_single_offer('+val1+','+value.test_id+');" style="font-weight:bold; color:#FF0000; text-decoration:none; cursor:ponter;">[X]</a>';
						tests +='</td>';
						tests +='</tr>';
						d = parseInt(d+1);
					});
					tests +='<tr>';
					tests +='</table>';
					tests +='</td>';
					$('#ClickOfferNew').html(tests);
					$('#ClickOfferNew').show();
					$('#ClickOffer').hide();
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalPackage').show();
		},
		
	});
}

function delete_single_package(val1,val2)
{
	var disc_code = document.getElementById('HealthDiscountCode').value;
	var all_tests = document.getElementById('HealthPackageId').value;
	var disc_amt = document.getElementById('HealthDiscountAmount').value;
	if ($("#HealthHomeReport1").is(":checked")) {
	   var home_report = 'Yes';
	}
	if ($("#HealthHomeReport2").is(":checked")) {
	   var home_report = 'No';
	}
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/delete_single_package?req_id='+val1+'&test_id='+val2+'&discount='+disc_code+'&all_test='+all_tests+'&home_report='+home_report+'&disc_amt='+disc_amt,
		dataType:'json',
		success:function(data){
			if(data.test_info.success == 'success')
			{
				var new_tot_amt = 'Rs. '+data.test_info.total_amt;
				$('#t_f_a_t_p_o').html(new_tot_amt);
				$('#t_f_a_t_p_o_r').show();
				
				if(data.test_info.new_tests.length != 0)
				{
					var tests = '';
					tests +='<td width="15%" class="boldText">Offers</td>';
					tests +='<td>';
					tests +='<table border="0" width="100%">';
					var d = 0;
					jQuery.each(data.test_info.new_tests,function(index, value)
					{
						tests +='<tr>';
						tests +='<td>';
						tests +=parseInt(d+1)+'- '+value.name+' <a href="javascript:void(0);" onclick="delete_single_package('+val1+','+value.test_id+');" style="font-weight:bold; color:#FF0000; text-decoration:none; cursor:ponter;">[X]</a>';
						tests +='</td>';
						tests +='</tr>';
						d = parseInt(d+1);
					});
					tests +='<tr>';
					tests +='</table>';
					tests +='</td>';
					$('#ClickPackageNew').html(tests);
					$('#ClickPackageNew').show();
					$('#ClickPackage').hide();
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalPackage').show();
		},
		
	});
}

function delete_single_service(val1,val2)
{
	var disc_code = document.getElementById('HealthDiscountCode').value;
	var all_tests = document.getElementById('HealthServiceId').value;
	if ($("#HealthHomeReport1").is(":checked")) {
	   var home_report = 'Yes';
	}
	if ($("#HealthHomeReport2").is(":checked")) {
	   var home_report = 'No';
	}
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'admin/samples/delete_single_service?req_id='+val1+'&service_id='+val2+'&discount='+disc_code+'&all_test='+all_tests+'&home_report='+home_report,
		dataType:'json',
		success:function(data){
			if(data.test_info.success == 'success')
			{
				var new_tot_amt = 'Rs. '+data.test_info.total_amt;
				$('#t_f_a_t_p_o').html(new_tot_amt);
				$('#t_f_a_t_p_o_r').show();
				
				if(data.test_info.new_tests.length != 0)
				{
					var tests = '';
					tests +='<td width="15%" class="boldText">Patient Care Services</td>';
					tests +='<td>';
					tests +='<table border="0" width="100%">';
					var d = 0;
					jQuery.each(data.test_info.new_tests,function(index, value)
					{
						tests +='<tr>';
						tests +='<td>';
						tests +=parseInt(d+1)+'- '+value.name+' <a href="javascript:void(0);" onclick="delete_single_service('+val1+','+value.test_id+');" style="font-weight:bold; color:#FF0000; text-decoration:none; cursor:ponter;">[X]</a>';
						tests +='</td>';
						tests +='</tr>';
						d = parseInt(d+1);
					});
					tests +='<tr>';
					tests +='</table>';
					tests +='</td>';
					$('#ClickServiceNew').html(tests);
					$('#ClickServiceNew').show();
					$('#ClickService').hide();
				}
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalService').show();
		},
		
	});
}

</script>
<?php 
$allow_test_edit=0;
if($this->data['Health']['requ_status'] < 5 || $this->data['Health']['requ_status'] == 15)/*before sent to lab*/
{
	$allow_test_edit = 1;
}	
if($session->read('Admin.userType') == 'A')	
	$allow_test_edit = 1;
?>
<input type="hidden" id="allowtestedit" value="<?php echo $allow_test_edit; ?>" />

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
        <h2>View Sample Request</h2>
    </div>
    <div class="contentbox">
			<?php echo $this->Session->flash(); ?>
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; <?php echo $html->link('Manage Sample Request(s)', '/admin/samples/index', array('title'=>'Home')); ?> &#187; View Sample Request
	
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Request Number</td>
		<td><?php echo $this->data['Health']['order_num'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Reference Number</td>
		<td>
		<?php echo $this->data['Health']['reference'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Medical Reference Number</td>
		<td>
		<?php echo $this->data['Health']['mrn_no'];?></td>
	</tr>
        <tr>
		<td width="15%" class="boldText">Booked By PCC</td>
		<td><?php echo !empty($this->data['Health']['created_by'])?$get_all_pcc_list[$this->data['Health']['created_by']]:'NPL';?></td>
	</tr>
        <tr>
		<td width="15%" class="boldText">Service By PCC</td>
		<td><?php echo isset($this->data['Health']['assigned_lab'])?$get_all_pcc_list[$this->data['Health']['assigned_lab']]:'NPL';?></td>
	</tr>
        <!--<tr>
		<td width="15%" class="boldText">Request Number</td>
		<td><?php echo $this->data['Health']['order_num'];?></td>
	</tr>-->
	<tr>
		<td width="15%" class="boldText">Patient Name</td>
		<td><?php echo $this->data['Health']['patient_name'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Gender</td>
		<td><?php echo $this->data['Health']['gender'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Age</td>
		<td><?php echo $this->data['Health']['age'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Registered Contact</td>
		<td><?php echo $this->Utility->show_mobile_hide($this->data['Health']['contact'],$this->data['Health']['book_date']); ?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Alternate Phone Number</td>
		<td><?php echo $this->data['Health']['alternate_contact']; ?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Registered Email</td>
		<td><a href="mailto:<?php echo $this->data['Health']['email'];?>"><?php echo $this->data['Health']['email'];?></a></td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Alternate Email</td>
		<td><a href="mailto:<?php echo $this->data['Health']['alternate_email'];?>"><?php echo $this->data['Health']['alternate_email'];?></a></td>
	</tr>
	
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Test Information</td>
	</tr>
	<?php if(!empty($this->data['Health']['test_names'])){?>
	<tr>
		<td width="15%" class="boldText">Test(s)</td>
		<td><?php echo $this->data['Health']['test_names'];?></td>
	</tr>
	<?php }?>
	<?php if(!empty($this->data['Health']['profile_names'])){?>
	<tr>
		<td width="15%" class="boldText">Profile(s)</td>
		<td><?php echo $this->data['Health']['profile_names'];?></td>
	</tr>
	<?php }?>
	<?php if(!empty($this->data['Health']['offer_names'])){?>
	<tr>
		<td width="15%" class="boldText">Offer(s)</td>
		<td><?php echo $this->data['Health']['offer_names'];?></td>
	</tr>
	<?php }?>
	<?php if(!empty($this->data['Health']['package_names'])){?>
	<tr>
		<td width="15%" class="boldText">Package(s)</td>
		<td><?php echo $this->data['Health']['package_names'];?></td>
	</tr>
	<?php }?>
	<?php if(!empty($this->data['Health']['service_names'])){?>
	<tr>
		<td width="15%" class="boldText">Patient Care Services</td>
		<td><?php echo $this->data['Health']['service_names'];?></td>
	</tr>
	<?php }?>
	<?php if(isset($this->data['Health']['home_report']) && $this->data['Health']['home_report'] != 0) {?>
	<tr>
		<td width="15%" class="boldText">Report Sending Info</td>
		<td><?php echo $this->data['Health']['home_info'];?></td>
	</tr>
	<?php }?>
	<tr>
		<td width="15%" class="boldText">Total Amount</td>
		<td><?php echo 'Rs. '.$this->data['Health']['total_test_amt'];?></td>
	</tr>
	
	
	
	<?php //if($this->data['Health']['balance_refund'] > 0) {?>
	<!--<tr>
		<td width="15%" class="boldText">Refund Amount</td>
		<td><?php //echo 'Rs. '.$this->data['Health']['balance_refund'];?><?php //echo $form->hidden('Health.bal_ref',array('value'=>$this->data['Health']['balance_refund']));?></td>
	</tr>-->
	<?php //if($this->data['Health']['refund_status'] == 0) {?>
	<!--<tr id="RefundStat">
		<td width="15%" class="boldText">Refund Status</td>
		<td>
			<input type="radio" name="data[Refund][status]" value="1" id="RefundStatus1" onclick="show_update_span();" />&nbsp;Refunded&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="data[Refund][status]" value="0" checked="checked" />&nbsp;Not Refunded&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="display:none;" id="UpdateSpan"><a href="javascript:void(0);" onclick="update_refund('<?php //echo $this->data['Health']['id']?>');" style="color:#0033FF;">Update</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			<?php //echo $html->image('frontend/loading.gif',array('style'=>'height:42px; width:43px; margin:-27px 0 -14px 0; display:none;','id'=>'LoadDiv'));?>
		</td>
	</tr>-->
	<?php //}?>
	<?php //if($this->data['Health']['refund_status'] == 1) {?>
	<!--<tr>
		<td width="15%" class="boldText">Refund Status</td>
		<td><?php //echo $this->data['Health']['refund_admin_name'];?></td>
	</tr>-->
	<?php //}?>
	
	<?php //}?>
	<?php if(!empty($this->data['Health']['remark'])) {?>
	<tr>
		<td width="15%" class="boldText">Remark</td>
		<td><?php echo $this->data['Health']['remark'];?></td>
	</tr>
	<?php }?>
	<?php if(!empty($this->data['Health']['adj_reason'])) {?>
	<tr>
		<td width="15%" class="boldText">Adjustment Reason</td>
		<td><?php echo $this->data['Health']['adj_reason'];?></td>
	</tr>
	<?php }?>
	<?php //if(isset($this->data['Health']['discount_id']) && $this->data['Health']['discount_id'] != 0) {?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Discount Information</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Discount Code</td>
		<td><?php if(isset($this->data['Health']['discount_code'])) { echo $this->data['Health']['discount_code']; }  else { echo "-"; } ?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Discount Amount</td>
		<td><?php if(isset($this->data['Health']['discount_amt'])) 
				{ echo $this->data['Health']['discount_amt'];} 
			elseif(isset($this->data['Health']['discount_amount']))
				{ echo "Rs. ".$this->data['Health']['discount_amount']; } 
			else
				{
					echo "0";
				}?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Description</td>
		<td><?php if(isset($this->data['Health']['discount_info'])) 
				{ echo $this->data['Health']['discount_info']; } 
			elseif(!empty($this->data['Health']['discount_amount_reason'])) 
				{ echo $this->data['Health']['discount_amount_reason']; } 
			else
				{
					echo 'Not given any reason';
				}?>
		</td>
	</tr>
	<?php //}?>
	
	<!--
	<?php if(isset($this->data['Health']['discount_amount']) && $this->data['Health']['discount_amount'] != 0) {?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Additional Discount</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Additional Discount</td>
		<td><?php echo 'Rs. '.$this->data['Health']['discount_amount'];?></td>
	</tr>
	<?php if(!empty($this->data['Health']['discount_amount_reason'])) {?>
	<tr>
		<td width="15%" class="boldText">Discount Given Reason</td>
		<td><?php echo $this->data['Health']['discount_amount_reason'];?></td>
	</tr>
	<?php } else {?>
	<tr>
		<td width="15%" class="boldText">Discount Given Reason</td>
		<td><?php echo 'Not given any reason';?></td>
	</tr>
	<?php }?>

	
	<?php }?>	-->
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Net Payable Amount</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Net Payble Amount</td>
		<td><?php echo 'Rs. '.$this->data['Health']['test_amt'];?></td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Balance Amount</td>
		<td><?php echo 'Rs. '.$this->data['Health']['balance_amt'];?></td>
	</tr>
	
	
	<?php if(!empty($this->data['Health']['receive_tracks'])) {?>
	<?php $k = 1;foreach($this->data['Health']['receive_tracks'] as $key => $val) {?>
	<tr>
		<td width="15%" class="boldText">Installment <?php echo $k;?></td>
		<?php if($val['Paytrack']['pay_mode'] == 'paymenttopcc'){?>
		<?php 
		$pay_mode = 'Payment Done To Pcc';
		?>
		<?php }?>
		<?php if($val['Paytrack']['pay_mode'] == 'cash'){?>
		<?php 
		$pay_mode = 'Cash';
		?>
		<?php }?>
		<?php if($val['Paytrack']['pay_mode'] == 'credit_card'){?>
		<?php 
		$pay_mode = 'Credit Card';
		$num = $val['Paytrack']['c_number'];
		?>
		<?php }?>
		<?php if($val['Paytrack']['pay_mode'] == 'cheque'){?>
		<?php 
		$pay_mode = 'Cheque/DD';
		$num = $val['Paytrack']['c_number'];
		?>
		<?php }?>
		<?php if($val['Paytrack']['pay_mode'] == 'adjust'){?>
		<?php 
		$pay_mode = 'Adjustment';
		?>
		<?php }?>
		<?php if($val['Paytrack']['pay_mode'] == 'btc'){?>
		<?php 
		$pay_mode = 'btc';
		?>
		<?php }?>
		<?php
			if($val['Paytrack']['pay_mode'] == 'online')
			{
				$pay_mode = 'online';

			}
		?>
		

		<td>
			<?php if($val['Paytrack']['pay_mode'] == 'paymenttopcc'){?>
			<?php echo $val['Paytrack']['remarks'];?>
			<?php }?>
			<?php if($val['Paytrack']['pay_mode'] == 'cash'){?>
			<?php echo 'Rs. '.$val['Paytrack']['pay_install'].' received by '.$val['Paytrack']['admin_receive_name'].' by '.$pay_mode.' on '.date('d-m-Y',strtotime($val['Paytrack']['admin_receive_date']));?>
			<?php }?>
			<?php if($val['Paytrack']['pay_mode'] == 'credit_card'){?>
			<?php echo 'Rs. '.$val['Paytrack']['pay_install'].' received by '.$val['Paytrack']['admin_receive_name'].' by '.$pay_mode.' ('.$num.')'.' on '.date('d-m-Y',strtotime($val['Paytrack']['admin_receive_date']));?>
			<?php }?>
			<?php if($val['Paytrack']['pay_mode'] == 'cheque'){?>
			<?php echo 'Rs. '.$val['Paytrack']['pay_install'].' received by '.$val['Paytrack']['admin_receive_name'].' by '.$pay_mode.' ('.$num.')'.' on '.date('d-m-Y',strtotime($val['Paytrack']['admin_receive_date']));?>
			<?php }?>
			<?php if($val['Paytrack']['pay_mode'] == 'adjust'){?>
			<?php echo 'Rs. '.$val['Paytrack']['pay_install'].' adjusted by '.$val['Paytrack']['admin_receive_name'].' as a '.$pay_mode.' on '.date('d-m-Y',strtotime($val['Paytrack']['admin_receive_date']));?>
			<?php }?>
			<?php if($val['Paytrack']['pay_mode'] == 'btc'){?>
			<?php echo 'Rs. '.$val['Paytrack']['pay_install'].' received as a Process Without Pay by '.$val['Paytrack']['admin_receive_name'].' on '.date('d-m-Y',strtotime($val['Paytrack']['admin_receive_date']));?>
			<?php }?>
			<?php if($val['Paytrack']['pay_mode'] == 'online'){?>
			<?php echo 'Rs. '.$val['Paytrack']['pay_install'].' received by online payment.';?>
                        <?php echo ' Reference number- '. $online_payment_details['OnlineOrder']['transaction_id']. ' on '.$online_payment_details['OnlineOrder']['date_created']; ?>
			<?php }?>
			<?php if($val['Paytrack']['pay_mode'] == 'btcnopayment'){?>
			Thank you your balance due test amount Rs.<?php echo $val['Paytrack']['pay_install'];?> has been billed to <?php echo $this->data['Health']['btc_no_payment_bill_to_company']; ?> & shall be settled by them as per contract
                        
			<?php }?>
		</td>
	</tr>
	<?php $k++;}?>
	<?php }?>
	<!-- Code Edited By Ashish Starts --> 
	<?php if(!empty($this->data['Health']['cancel_reason'])){?>
	<tr>
		<td width="15%" class="boldText">Cancelled Reason</td>
		<td><?php echo $this->data['Health']['cancel_reason'];?></td>
	</tr>
	<?php }?>
	<!-- Code Edited By Ashish Ends --> 
	<?php if((!empty($this->data['Health']['visit_lab_location']) && !empty($this->data['Health']['visit_lab_collect_time']) && !empty($this->data['Health']['visit_lab_collect_date']))) {?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Visit a Lab</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Visit Location</td>
		<td><?php echo $this->data['Health']['visit_lab_location'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Visit Time</td>
		<td><?php echo $this->data['Health']['visit_lab_collect_time'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Visit Date</td>
		<td><?php echo $this->data['Health']['visit_lab_collect_date'];?></td>
	</tr>
	<?php }?>
	
	<?php if((!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date']))) {?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Payment Instructions</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Payment Type</td>
		<td><?php echo $payment_type[$this->data['Health']['payment_type']];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Amount Collected by PCC</td>
		<td><?php echo $this->data['Health']['amount_collected'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Amount to be collected</td>
		<td><?php echo $this->data['Health']['amount_to_be_collected'];?></td>
	</tr>
	
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Prescription Url</td>
		<td><a href='<?php echo $this->data['Health']['prescription_url'];?>' target='_blank'>View</a></td>
	</tr>
	
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Home Collection</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Collection Date</td>
		<td><?php echo $this->data['Health']['home_collect_date'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Collection Time</td>
		<td><?php echo $this->data['Health']['home_collect_time'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Collection Address</td>
		<td>
			<?php 
			$exp_add_show = explode('*',$this->data['Health']['home_collect_address']);
			echo $exp_add_show[0]."<br>".$exp_add_show[1];
			?>
		</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Locality</td>
		<td><?php echo nl2br(str_replace('_',' ',$this->data['Health']['home_collect_locality']));?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">City</td>
		<td><?php echo nl2br($this->data['Health']['home_collect_city_show']);?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">State</td>
		<td><?php echo nl2br($this->data['Health']['home_collect_state_show']);?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Pincode</td>
		<td><?php echo nl2br($this->data['Health']['home_collect_pincode']);?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Landmark</td>
		<td><?php echo nl2br($this->data['Health']['home_collect_landmark']);?></td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Processing Labs</td>
	</tr>
	<tr></tr>
	<tr>
		<td width="15%" class="boldText">Processing Lab</td>
		<td>
			<input type="text" style="border:none;" id="plab_text" value="<?php if($this->data['Health']['processing_lab']!=0) echo $p_lab[$this->data['Health']['processing_lab']]; else echo'none'; ?>"/>
			<input type="button" id="plab_edit" onclick="edit_plab()" class="btn" value="Edit">
			
			<select id="p_lab" name="data[Health][processing_lab]" class="input-text" style="width:200px;display:none;">
				<?php foreach($p_lab as $key=>$val) {?>
						<option <?php echo ($this->data['Health']['processing_lab'] == $key) ? 'selected' : ''; ?> value="<?php echo $key;?>"><?php echo $val;?></option>
				<?php }?>
			</select>
			<label id="plab_message_success" style="display:none;">Processing Lab Assigned.</label>
			<label id="plab_message_failure" style="display:none;">Processing Lab Not Assigned.</label>
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Specimen Details</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Specimen Drawn Date</td>
		<td><?php echo nl2br($this->data['Health']['specimen_date']);?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Specimen Drawn Time</td>
		<td><?php echo nl2br($this->data['Health']['specimen_time']);?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Confirmed By</td>
		<td><?php echo nl2br($this->data['Health']['specimen_by']);?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Remarks</td>
		<td><?php echo nl2br($this->data['Health']['specimen_remarks']);?></td>
	</tr>
		<tr id="report_10" <?php if($this->data['Health']['requ_status'] == 5 || $this->data['Health']['requ_status'] == 12 || $this->data['Health']['requ_status'] == 7) {?> style="" <?php } else {?> style="display:none;" <?php }?>>
		<td colspan="2">
			<span id="reportprocessing" style="color:Red;display:none;font-size: x-large;">The Data is being processed.</span>
			<span id="reportcompleted" style="color:Green;display:none;font-size: x-large;">Reports successfully Completed.</span>
			<span id="reportfailed" style="color:Red;display:none;font-size: x-large;">Reports not Found.</span>
			<br>
			<input id="reportupdate" class="btn" type="button" onclick="reportupdate()" value="Report Status Update"/>
		</td>
	</tr>
	<script>
		function edit_plab()
		{
			$('#plab_text').hide();
			$('#plab_edit').hide();
			$('#p_lab').show();
		}
		
		$('#p_lab').change(function() {
			var lab_id = this.value;
			var healthId = $('#HealthRequestId').val();
			$.ajax({
				type:'POST',
				url:siteUrl+'admin/samples/save_plab',
				data : {
					labid : lab_id,
					health_id : healthId,
				},
				success:function(result){
					var selectedtext = $("#p_lab :selected").text();
					$('#plab_text').val(selectedtext);
					$('#plab_text').show();
					$('#plab_edit').show();
					$('#p_lab').hide();	
				}
			});
		});
	</script>
<?php if($this->data['Health']['requ_status'] == '6' || $this->data['Health']['requ_status']=='7') { ?>
	<tr>
		<td colspan='2'>
			<?php echo $form->submit('Email Report To Pcc', array('div'=>false, 'class' => 'btn','onclick'=>'return sendmailtopcc(this);','id'=>'emailtopcc')); ?>
			<span id="mailprocessing" style="color:Red;display:none;font-size: x-large;">Mail is being processed.</span>
			<span id="mailcompleted" style="color:Green;display:none;font-size: x-large;">Mail Process successfully Completed.</span>
		</td>
	</tr>
	<?php } }?>
	<script type="text/javascript">
		function print_detail(val1)
		{
			window.open('<?php echo SITE_URL;?>admin/samples/print_detail/'+val1,'name','height=500,width=800,scrollbars=yes');
		}
		
		function sendmailtopcc()
		{
			$('#mailprocessing').show();
			$('#emailtopcc').hide();
			var healthId = $('#HealthRequestId').val();
			$.ajax({
				type:'POST',
				url:siteUrl+'admin/samples/sendmailtopcc',
				data : {
					id : healthId,
				},
				success:function(result){
					console.log(result);
					if(result == "1")
					{
						$('#mailcompleted').show();
						$('#save_sample').html(result);
					}

					$('#mailprocessing').hide();
				}
			});
		}
		function print_detail(val1)
		{
			window.open('<?php echo SITE_URL;?>admin/samples/print_detail/'+val1,'name','height=500,width=800,scrollbars=yes');
		}
	</script>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<tr>
		<td colspan="2">
			<?php
                        if($this->data['Health']['requ_status'] != 9){
                            echo $form->submit('Edit Request', array('div'=>false, 'class' => 'btn','onclick'=>'show_edit();'));
                        } ?>&nbsp;&nbsp;&nbsp;
			<?php //echo $form->submit('Reschedule/Cancelled', array('div'=>false, 'class' => 'btn','onclick'=>'show_cancel();')); ?>&nbsp;&nbsp;&nbsp;
			<?php
                        if($this->data['Health']['requ_status'] != 9 ){
                            if(isset($this->data['Health']['rec_ins_amt']) && $this->data['Health']['rec_ins_amt'] > 0)
                            {
                                echo $form->submit('Cancelled Request', array('div'=>false, 'class' => 'btn','onclick'=>"alert('Payment received against this request, hence can not be cancelled')"));
                            }
                            else
                            {
                                echo $form->submit('Cancelled Request', array('div'=>false, 'class' => 'btn','onclick'=>'show_cancel();'));
                            }
                        }
                        ?>&nbsp;&nbsp;&nbsp;
			<?php //echo $form->submit('Sample Process', array('div'=>false, 'class' => 'btn','onclick'=>'show_form();')); ?><!--&nbsp;&nbsp;&nbsp;-->
			<?php //echo $form->submit('Patient Vital', array('div'=>false, 'class' => 'btn','onclick'=>'patient_vital();')); ?><!--&nbsp;&nbsp;&nbsp;-->

			<?php if(isset($this->data['Health']['sent_to_lab_action']) && $this->data['Health']['sent_to_lab_action'] == 'Yes') {?>
                            <?php if(isset($this->data['Health']['service_names']) && !empty($this->data['Health']['service_names']) && empty($this->data['Health']['package_names']) && empty($this->data['Health']['offer_names']) && empty($this->data['Health']['profile_names']) && empty($this->data['Health']['test_names'])){ ?>
                            <?php echo $form->submit('Close', array('div'=>false, 'class' => 'btn','onclick'=>'closed_stat();')); ?>&nbsp;&nbsp;&nbsp;
                            <?php } else { ?>
				<?php echo $form->submit('Sent to Lab', array('div'=>false, 'class' => 'btn','onclick'=>'sent_lab();')); ?>&nbsp;&nbsp;&nbsp;
				<?php if($user_type == 'A' || $user_type == 'BM') 
				echo $form->submit('Sample Review', array('div'=>false, 'class' => 'btn','onclick'=>'sample_test();')); ?>&nbsp;&nbsp;&nbsp;
				                            <?php } ?>
				<?php echo $form->submit('Sample Collected', array('div'=>false, 'class' => 'btn','onclick'=>'sent_lab_api();')); ?>&nbsp;&nbsp;&nbsp;				

			<?php }?>
			<?php echo $form->submit('Message From Lab', array('div'=>false, 'class' => 'btn','onclick'=>'message_lab();')); ?>&nbsp;&nbsp;&nbsp;
			<?php if($this->data['Health']['requ_status'] >= 5) {?>
                            <?php if(isset($this->data['Health']['service_names']) && !empty($this->data['Health']['service_names']) && empty($this->data['Health']['package_names']) && empty($this->data['Health']['offer_names']) && empty($this->data['Health']['profile_names']) && empty($this->data['Health']['test_names'])){ ?>

                            <?php } else { ?>
			<?php echo $form->submit('Upload Partial Report', array('div'=>false, 'class' => 'btn','onclick'=>'show_up_report("p");')); ?>&nbsp;&nbsp;&nbsp;
			
			<?php echo $form->submit('Upload Full Report', array('div'=>false, 'class' => 'btn','onclick'=>'show_up_report("f");')); ?>&nbsp;&nbsp;&nbsp;
                            <?php } ?>

			<?php }?>
			<?php echo $form->submit('Payment Status', array('div'=>false, 'class' => 'btn','onclick'=>'show_payment();')); ?>&nbsp;&nbsp;&nbsp;
			
			
			<?php  echo $form->submit('Activity Log', array('div'=>false, 'class' => 'btn','onclick'=>'active_log();')); echo "&nbsp;&nbsp;&nbsp";?>
			<a href="javascript:void(0);" onclick="print_detail('<?php echo $this->data['Health']['id'];?>');" style="text-decoration:none;"><?php echo $form->submit('Print Detail', array('div'=>false, 'class' => 'btn')); ?></a>
			
			
		
			
		<?php if($this->data['Health']['requ_status'] == 6) {?>
			<?php echo $form->submit('Mark as closed', array('div'=>false, 'class' => 'btn','onclick'=>'closed_stat();')); ?>&nbsp;&nbsp;&nbsp;
			<?php 	} ?>
			<?php $green = $this->Session->read(Admin.userType);
			//print_r ( $green ); exit;
			 if(($green == 'A') && ($this->data['Health']['requ_status'] == 9)) {
			echo $form->submit('Mark as closed', array('div'=>false, 'class' => 'btn','onclick'=>'closed_stat();')); ?> &nbsp;&nbsp;&nbsp;
		<?php 	} ?>
				
		<?php echo $form->submit('BP Net', array('div'=>false, 'class' => 'btn','onclick'=>'show_bp_net();')); ?>&nbsp;&nbsp;&nbsp;
		<a id="print_reciept" href="" target='_blank'><?php echo $form->submit('Print Reciept', array('div'=>false, 'class' => 'btn','onclick'=>'show_print_reciept();')); ?>&nbsp;&nbsp;&nbsp;</a>
		<?php echo $form->submit('Raise Ticket', array('div'=>false, 'class' => 'btn','onclick'=>'show_raise_ticket();')); ?>&nbsp;&nbsp;&nbsp;
		<?php echo $form->submit('Specimen Detail', array('div'=>false, 'class' => 'btn','onclick'=>'specimen_detail();')); ?>&nbsp;&nbsp;&nbsp;
		<?php  if($user_type == 'A') { echo $form->submit('Json Log', array('div'=>false, 'class' => 'btn','onclick'=>'json_log();')); echo "&nbsp;&nbsp;&nbsp";} ?>
		<input type="hidden" id="print_order_id" value="<?php echo $this->data['Health']['id'];?>">
		<input type="hidden" id="print_request_id" value="<?php echo $this->data['Health']['order_num'];?>">	
			<?php echo $form->submit('Report Testing', array('div'=>false, 'class' => 'btn','onclick'=>'report_call();','style'=>'display:none;')); ?>&nbsp;&nbsp;&nbsp;

		
		
			<?php //echo $form->submit('Edit Detail', array('div'=>false, 'class' => 'btn','onclick'=>'show_edit();')); ?><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
			<?php //echo $form->submit('Payment Status', array('div'=>false, 'class' => 'btn','onclick'=>'show_payment();')); ?><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
			<?php //echo $form->submit('Upload Report', array('div'=>false, 'class' => 'btn','onclick'=>'show_up_report();')); ?>
			
		</td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<!--Code For Inserting BMI value Starts-->
	<script type="text/javascript">
	function submit_vital()
	{
		document.forms["form112"].submit();
	}
	
	function patient_vital()
	{
		<?php if($this->data['Health']['height_opt'] == 1){?>
		jQuery('#PatHeight').show();
		<?php }?>
		<?php if($this->data['Health']['height_opt'] == 2){?>
		jQuery('#PatHeightCm').show();
		<?php }?>
		jQuery('#PatientVital').show();
		$('#uploadReport').hide();
		 $('#ActiveLog').hide();
		 $('#SentLab').hide();
	$('#SampleRegister').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#editDetails').hide();
	$('#updatePayStatus').hide();
	$('#LabMessage').hide();
	$('#MarkClosed').hide();
	$('#BpNet').hide();
		  $('#specimen_d').hide();
	  $('#raise_ticket').hide();
		 
		
		
	}
	
	
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
	<tr id="PatientVital" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/patient_vital/'.base64_encode($this->data['Health']['id']),'id'=>'form112','name'=>'form112'));?>
			<?php echo $form->hidden('Health.login_action',array('value'=>'Super'));?>
			<?php echo $form->hidden('Health.bmi_id',array('value'=>$this->data['Health']['vital_save_id']));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Patient Vital</h2></td>
				</tr>
				<tr>
					<td width="15%" class="boldText">BMI Value</td>
					<td><?php echo $this->data['Health']['bmi_value'];?></td>
				</tr>
				<tr>
					<td width="15%" class="boldText">BMI</td>
					<td><?php echo $this->data['Health']['bmi_indicator'];?></td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Patient Weight(KG)</td>
					<td>
						<?php echo $form->text('Health.pat_weight', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'Weight in KG','value'=>$this->data['Health']['weight'])); ?>
					</td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Height Option</td>
					<td>
						<input type="radio" name="data[Health][select_bmi_opt]" value="1" onclick="show_option(1);" <?php if($this->data['Health']['height_opt'] == 1){?> checked="checked" <?php }?> />&nbsp;Feet&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="data[Health][select_bmi_opt]" value="2" onclick="show_option(2);" <?php if($this->data['Health']['height_opt'] == 2){?> checked="checked" <?php }?> />&nbsp;CMs
					</td>
				</tr>
				<tr id="PatHeightCm" style="display:none;">
					<td width="15%" class="boldText">Patient Height(CM's)</td>
					<td>
						<?php echo $form->text('Health.pat_height_cms', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'CM','value'=>$this->data['Health']['height_cm'])); ?>
					</td>
				</tr>
				<tr id="PatHeight" style="display:none;">
					<td width="15%" class="boldText">Patient Height(Feet & Inch)</td>
					<td>
						<?php echo $form->text('Health.pat_height_feet', array('class'=>'input-text','style'=>'width:75px;','placeholder'=>'Feet','value'=>$this->data['Health']['height_feet'])); ?>
						<?php echo $form->text('Health.pat_height_inch', array('class'=>'input-text','style'=>'width:75px;','placeholder'=>'Inch','value'=>$this->data['Health']['height_inch'])); ?>
					</td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Blood Pressure</td>
					<td>
						<?php echo $form->text('Health.pat_systolic', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'SYS in (mmHg)','value'=>$this->data['Health']['bp_systolic'])); ?>
						<?php echo $form->text('Health.pat_diaostolic', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'DIA in (mmHg)','value'=>$this->data['Health']['bp_diastolic'])); ?>
						<?php echo $form->text('Health.pat_pulse_rate', array('class'=>'input-text','style'=>'width:100px;','placeholder'=>'Pulse/Min','value'=>$this->data['Health']['bp_pulse'])); ?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo $form->submit('Submit', array('div'=>false, 'class' => 'btn','onclick'=>'submit_vital();')); ?></td>
				</tr>
			</table>
			<?php echo $form->end();?>
		</td>
	</tr>
	<!--Code For Inserting BMI value Ends-->
	
	<tr id="ActiveLog" <?php if(!isset($showActivity) || $showActivity != '1') { ?> style="display:none;" <?php } ?> >
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/active_log/'.base64_encode($this->data['Health']['id']),'id'=>'form1121','name'=>'form1121'));?>
			<?php echo $form->hidden('Health.login_action',array('value'=>'Super'));?>
			<?php echo $form->hidden('Health.bmi_id',array('value'=>$this->data['Health']['vital_save_id']));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Activity Log</h2></td>
				</tr>
				<!--<?php //if(!empty($this->data['Health']['last_edited'])) {?>
				<tr>
					<td width="15%" class="boldText">Last Edited Name</td>
					<td><?php //echo $this->data['Health']['last_edited'];?></td>
				</tr>
				<?php //}?>
				<?php //if(!empty($this->data['Health']['last_edited_date'])) {?>
				<tr>
					<td width="15%" class="boldText">Date&Time</td>
					<td><?php //echo $this->data['Health']['last_edited_date'];?></td>
				</tr>
				<?php //}?>
				<tr>
					-->
				<tr>
			<td  colspan ="2" style="font-weight:bold;"><?php echo $this->element('pagination');?></td>
		</tr>
		
		<tr><th width="10%"><div style="text-align:center;">S.No.</div></th>
            <th width="90%"><div style="text-align:center;">Activity Log</div></th></tr>
            
		
				<?php
				$count = 0;
				echo "<br/><br/>";
				foreach($activityLog as $act)
				{	
				if(($count%2) == 1){ $class = " class=\"alt\"";}else{ $class = ""; }?>
					<tr <?php echo $class;?>><td style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php echo ($count+1);?></td>
					<td style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;"><?php   echo "<span class='boldText'>".$act['ActivityLog']['action']."</span> done by <span class='boldText'>".$act['Admin']['name']."</span> at <span class='boldText'>".date("d M, Y H:i:s", strtotime($act['ActivityLog']['created']))."</span><br/><br/>"; ?></td></tr>
				<?php $count ++;}
				?>
				<tr>
			<td colspan ="2" style="font-weight:bold;"><?php echo $this->element('pagination');?></td>
		</tr>
				<!--<tr>
					<td>&nbsp;</td>
					<td><?php //echo $form->submit('Submit', array('div'=>false, 'class' => 'btn','onclick'=>'submit_closededed();')); ?></td>
				</tr>-->
			</table>
			<?php echo $form->end();?>
		</td>
	</tr>
	
	<tr id="JsonLog" <?php if(!isset($showActivity) || $showActivity != '1') { ?> style="display:none;" <?php } ?> >
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/json_log/'.base64_encode($this->data['Health']['id']),'id'=>'form1121','name'=>'form1121'));?>
			<?php echo $form->hidden('Health.login_action',array('value'=>'Super'));?>
			<?php echo $form->hidden('Health.bmi_id',array('value'=>$this->data['Health']['vital_save_id']));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="5"><h2>Json Log</h2></td>
				</tr>
				<!--<?php //if(!empty($this->data['Health']['last_edited'])) {?>
				<tr>
					<td width="15%" class="boldText">Last Edited Name</td>
					<td><?php //echo $this->data['Health']['last_edited'];?></td>
				</tr>
				<?php //}?>
				<?php //if(!empty($this->data['Health']['last_edited_date'])) {?>
				<tr>
					<td width="15%" class="boldText">Date&Time</td>
					<td><?php //echo $this->data['Health']['last_edited_date'];?></td>
				</tr>
				<?php //}?>
				<tr>
					-->
				<tr>
		</tr>
		
		<tr><th width="10%"><div style="text-align:center;">S.No.</div></th>
		<th width="15%"><div style="text-align:center;">Date</div></th>
		<th width="15%"><div style="text-align:center;">Action.</div></th>
		<th width="30%"><div style="text-align:center;">Request data.</div></th>
		<th width="30%"><div style="text-align:center;">Response data.</div></th></tr>

				<?php
				$count = 0;
				echo "<br/><br/>";
				foreach($jsonlog as $act)
				{	
				if(($count%2) == 1){ $class = " class=\"alt\"";}else{ $class = ""; }?>
					<tr <?php echo $class;?>>
						<td width="10%" style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;">
						<?php echo ($count+1);?></td>
						<td width="15%" style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;">
						<?php   echo "<span class='boldText'>".$act['Jsondata']['date']."</span>"; ?>
						</td>
						<td width="15%" style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;">
						<?php   echo "<span class='boldText'>".$act['Jsondata']['action']."</span>"; ?>
						</td>
						<td width="30%" style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;">
						<?php   echo "<span class='boldText'>".$act['Jsondata']['request_data']."</span>"; ?>
						</td>
						<td width="30%" style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;">
						<?php   echo "<span class='boldText'>".$act['Jsondata']['response_data']."</span>"; ?>
						</td>
					</tr>
				<?php $count ++;}
				?>
				<tr>
				</tr>
				<!--<tr>
					<td>&nbsp;</td>
					<td><?php //echo $form->submit('Submit', array('div'=>false, 'class' => 'btn','onclick'=>'submit_closededed();')); ?></td>
				</tr>-->
			</table>
			<?php echo $form->end();?>
		</td>
	</tr>
	
	
	<tr id="LabMessage" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/lab_message/'.base64_encode($this->data['Health']['id']),'id'=>'form12','name'=>'form12'));?>
			<?php echo $form->hidden('Health.login_action',array('value'=>'Super'));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Lab Message</h2></td>
				</tr>
				<tr>
					<td style="font-weight:bold; width:10px;">1)</td>
					<td style="width:135px;" class="boldText">Lab Message</td>
					<td style="width:55px;"><input type="radio" name="data[Health][message_status]" value="1" <?php if($this->data['Health']['message_status'] == 1) {?> checked="checked" <?php }?> onclick="message_div(this.value);" />&nbsp;&nbsp;Yes</td>
					<td><input type="radio" name="data[Health][message_status]" value="0" <?php if($this->data['Health']['message_status'] == 0) {?> checked="checked" <?php }?> onclick="message_div(this.value);" />&nbsp;&nbsp;No</td>
				</tr>
				<tr id="MessageDiv" style="display:none;">
					<td>&nbsp;</td>
					<td class="boldText">Enter Message</td>
					<td colspan="2"><?php echo $form->textarea('Health.lab_message',array('class'=>'input-text','rows'=>5,'cols'=>30,'style'=>'font-size:12px;'));?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><?php echo $form->submit('Submit Message', array('div'=>false, 'class' => 'btn','onclick'=>'submit_message();')); ?></td>
					<td>&nbsp;</td>
				</tr>
				
				<tr></tr>
			</table>
			<?php echo $form->end();?>
			
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="5"><h2>Message Log</h2></td>
				</tr>
				<tr>
				</tr>
		
				<tr><th style="width:80px;"><div style="text-align:center;">S.No.</div></th>
				<th style="width:200px;"><div style="margin-left: 20px;">Date</div></th>
				<th><div style="margin-left: 20px;">Message</div></th></tr>

				<?php
				$count = 0;
				echo "<br/><br/>";
				foreach($lab_mm as $message)
				{	
					if(($count%2) == 1){ $class = " class=\"alt\"";}else{ $class = ""; }?>
					<tr <?php echo $class;?>>
						<td style="text-align:center; border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;">
						<?php echo ($count+1);?></td>
						<td style="border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;">
						<?php   echo "<span class='boldText' style='margin-left: 20px;'>".date('d-m-Y',strtotime($message['LabMessageMaster']['date']))."</span>"; ?>
						</td>
						<td colspan="3" style="border-left:1px solid #D8D8D8; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;">
						<?php   echo "<span class='boldText' style='margin-left: 20px;'>".$message['LabMessageMaster']['message']."</span>"; ?>
						</td>
					</tr>
				<?php $count ++;}
				?>
				<tr>
				</tr>
			</table>
			
		</td>
	</tr>
	<tr id="SentLab" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/sent_lab/'.base64_encode($this->data['Health']['id']),'id'=>'form7','name'=>'form7','onsubmit'=>'return validateSentLab(this);'));?>
			<?php echo $form->hidden('Health.request_id',array('value'=>$this->data['Health']['id']));?>
			<?php echo $form->hidden('Health.login_action',array('value'=>'Super'));?>
			<span id="labprocessing" style="color:Red;display:none;font-size: x-large;">The Data is being processed.</span>
			<span id="labcompleted" style="color:Green;display:none;font-size: x-large;">Lab Registration Id successfully Fetched.</span>
			<table id="senttolabform" border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Sent To Lab</h2></td>
					<tr><td colspan="4"><br/><br/><div style="color:#FF0000; clear:both;display:none;" id="errmsg"></div></td></tr>
				</tr>
				<?php if($this->data['Health']['dup_entry'] == 'Yes') {?>

				<tr>
					<td colspan="4" style="color:#FF0000; font-weight:bold;">Please enter unique Lab Test Registration NO. previous one is duplicate.</td>
				</tr>
				<?php }

				if(!isset($this->data['Health']['ref_num']) || $this->data['Health']['ref_num'] == ''){ ?>
				<tr>
					<td></td>
					<td><input id="autostl" class="btn" type="button" onclick="getlabregisid()" value="Get Lab Registration Id"/></td>
				</tr>
				<?php } ?>
				<tr>
					<td style="font-weight:bold; width:10px;">1)</td>
					<td style="width:150px;">Lab Test Registration NO.</td>
					<td colspan="4">
						<?php if(!empty($this->data['Health']['ref_num'])) {?>
						<?php echo $form->text('Health.ref_num',array('class'=>'input-text','value'=>$this->data['Health']['ref_num'],'id'=>'ref_num','maxlength'=>'14')); echo "&nbsp;&nbsp;<span style='color:#FF0000; clear:both;' id='errmsg'> * Lab ref no - should be only numbers.</span>";?>
						<?php } else {?>
						<?php echo $form->text('Health.ref_num',array('class'=>'input-text','id'=>'ref_num','maxlength'=>'14'));echo "&nbsp;&nbsp;<span style='color:#FF0000; clear:both;' id='errmsg'> * Lab ref no - should be only numbers.</span";?>
						<?php }?>
					</td>
				</tr>
				<tr>
					<td style="font-weight:bold; width:10px;">2)</td>
					<td style="width:135px;">Sent to Lab</td>
					<td style="width:55px;"><input type="radio" id="stl_yes" name="data[Health][sent_pathcorp]" value="1" <?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;Yes</td>
					<td><input type="radio" id="stl_no" name="data[Health][sent_pathcorp]" value="0" <?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;No</td>
				</tr>

				<tr>
					<td>&nbsp;</td>
					<td><?php echo $form->submit("Sent to Lab", array("div"=>false, "class" => "btn")); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>
			<?php echo $form->end();?>
		</td>
	</tr>
	<tr id="Samplesave" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/sent_lab_api/'.base64_encode($this->data['Health']['id']),'id'=>'saveSample','name'=>'saveSample'));?>
			<?php echo $form->hidden('Health.request_id',array('value'=>$this->data['Health']['id']));?>
			<?php echo $form->hidden('Health.login_action',array('value'=>'Super'));?>
			<input id="autostl" class="btn" type="button" onclick="autosenttolab()" value="Sample Status Update" style="display:<?php if($this->data['Health']['requ_status']== 14 ) { echo "inline";} else {echo "none";}?>"/>
			<span id="senttolabprocessing" style="color:Red;display:none;font-size: x-large;">The Data is being processed.</span>
			<span id="senttolabcompleted" style="color:Green;display:none;font-size: x-large;">Sent to Lab Process successfully Completed.</span>
			<div id="save_sample" style="font-size: larger; color: black;">
			</div>
			<?php echo $form->end();?>
		</td>
	</tr>
	<tr id="SentLabApi" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/save_stl_data/'.base64_encode($this->data['Health']['id']),'id'=>'form_save_stl','name'=>'form_save_stl'));?>
			<?php echo $form->hidden('Health.request_id',array('value'=>$this->data['Health']['id']));?>
			<?php echo $form->hidden('Health.login_action',array('value'=>'Super'));?>
			<div style="padding: 10px;">
				<label style="font-size: large; font-weight: 600;color: black;float: left;">Priority</label><select id="urgent" name="data[Health][is_urgent]" style="float:left">
					<option value="false" <?php if($this->data['Health']['is_urgent'] == 'false') echo "selected"; ?>>Regular</option>
					<option value="true" <?php if($this->data['Health']['is_urgent'] == 'true') echo "selected"; ?>>Urgent</option>
				</select>
				<div style="float:right;margin-right: 30px;">
					<label style="font-size: small; font-weight: 600;color: black;float:left;padding-right:10px;">Sample Collected Date</label>
					<input type="text" id="sample_collected_date" style="float:left;width: 90px;" name="data[Health][sample_collected_date]" value="<?php echo $this->data['Health']['sample_collected_date'];?>">
					<label style="font-size: small; font-weight: 600;color: black;float:left;padding-right:10px;">Sample Collected Time</label>
					<input type="text" id="sample_collected_time" style="float:left;width: 90px;" name="data[Health][sample_collected_time]" value="<?php echo $this->data['Health']['sample_collected_time'];?>">
				</div>
			</div>
			<table border="0" width="100%" >
				<tr style="font-weight:600;color:black;">
					<th></th>
					<th style="line-height: 25px; font-size: 15px;">Sample Type</th>
					<th style="line-height: 25px; font-size: 15px;">Bar Code</th>
				</tr>
				<?php foreach($sample_specific as $key=>$val) { ?>
				<tr style="background:<?php echo $sample_color[$key]; ?>;font-weight: 600;color:black;">
			<?php 
			$disabled = 'disabled';
			$value = '';
			$checked = '';
			if(array_key_exists($val,$assigned_sample)) {
					$checked = 'checked';
					$disabled = '';
					$value = $assigned_sample[$val]['barcode_id'];
			}?>
					<td><input type="checkbox" id="checkbox_<?php echo $val; ?>" onclick="enableTextbox(this);" <?php echo $checked;?>></td>
					<td><label style="padding-bottom:0px;" id="sample_type_<?php echo $val; ?>" name="sample_type[<?php echo $val; ?>]" value="<?php echo $val; ?>"><?php echo $key; ?></label></td>
					<td><input type="text" id="sample_barcode_<?php echo $val; ?>" name="sample_barcode[<?php echo $val; ?>]" value="<?php echo $value;?>" <?php echo $disabled;?>></td>
				<?php }?>
				<tr style="background:red;color:black;font-weight: 600;">
					<?php 
					$disabled = 'disabled';
					$value = '';
					$checked = '';
					foreach($assigned_sample as $key=>$val)
					{
						if(in_array($key, $sample_others))
						{
							$disabled = '';
							$checked = 'checked';
							$value = $assigned_sample[$key]['barcode_id'];
						}
					}
					?>
					<td><input type="checkbox" id="checkbox_others" onclick="enableTextbox(this);" <?php echo $checked;?>></td>
					<td><select id="sample_others" name="sample_others" onchange="changeBarcodeName(this)">
						<?php foreach($sample_others as $key=>$val) { ?>
						<option value="<?php echo $val; ?>" <?php if(array_key_exists($val,$assigned_sample)) { echo 'selected="selected"'; } ?>><?php echo $key; ?></option>
						<?php } ?>
					</select></td>
					<td><input type="text" id="sample_barcode_others" name="sample_barcode_others" value="<?php echo $value;?>" <?php echo $disabled;?>></td>
				</tr>
				<tr>
					<td>&nbsp;</td><td id="sample_collected_button" style="display:<?php /*if($this->data['Health']['requ_status'] >= 5 && $this->data['Health']['requ_status']<10) {*/ echo "inline";/* } */?>">
						<div id="loader"> </div><?php echo $form->submit("Submit", array("div"=>false, "class" => "btn",'id'=>'stl_btn')); ?> <div id="result_sample"></div>
						<span id="sentlabprocessing" style="color:Red;display:none;font-size: x-large;">The Data is being processed.</span>
						<span id="sentlabcompleted" style="color:Green;display:none;font-size: x-large;">Sent to Lab Process successfully Completed.</span>
						<div id="savestl" style="font-size: larger; color: black;">
						<input id="autosenttolab" class="btn" type="button" onclick="autostl()" style="display:<?php if($this->data['Health']['requ_status']== 10 ) { echo "inline";} else {echo "none";} ?>" value="Send to Labmate"/>
					</td>
					
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>
			<?php echo $form->end();?>
		</td>
	</tr>
	
	<tr id="ProcessCancel" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/request_reschdule/'.base64_encode($this->data['Health']['id']),'id'=>'form6','name'=>'form6'));?>
			<?php echo $form->hidden('Health.login_action',array('value'=>'Super'));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Cancelled Request</h2></td>
				</tr>
				<tr>
					<td style="font-weight:bold; width:10px;">1)</td>
					<td style="width:135px;">Request Cancelled</td>
					<td style="width:55px;"><input type="radio" name="data[Health][cancelled_status]" value="1" onclick="cancel_stat(this.value);" <?php if($this->data['Health']['cancelled_status'] == 1) {?> checked="checked" <?php }?> />&nbsp;&nbsp;Yes</td>
					<td><input type="radio" name="data[Health][cancelled_status]" value="0" onclick="cancel_stat(this.value);" <?php if($this->data['Health']['cancelled_status'] == 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;No</td>
				</tr>
				<tr id="CancelRow" style="display:none;">
					<td>&nbsp;</td>
					<td>Cancelled Reason</td>
					<td colspan="2">
                                            <?php //echo $form->textarea('Health.cancelled_reason',array('class'=>'input-text','rows'=>5,'cols'=>30,'style'=>'font-size:12px;'));?>
                                            <?php e($form->select('Health.cancelled_reason', Configure::read('CancelStatus'), null, array('class'=>'cancel_reason_select','empty'=>'Select Reason'),null,false))?>
                                            <br/>
                                            <?php echo $form->textarea('Health.cancelled_reason_custom',array('class'=>'input-text','rows'=>5,'cols'=>30,'style'=>'font-size:12px;display:none;'));?>
                                        </td>
				</tr>
				<tr>
					<!--<td style="font-weight:bold; width:10px;">2)</td>-->
					<!--<td style="width:135px;">Request Rescheduled</td>-->
					<!--<td style="width:55px;"><input type="radio" name="data[Health][reschduled]" value="1" onclick="reschdule_stat(this.value);" <?php if($this->data['Health']['reschduled'] == 1) {?> checked="checked" <?php }?> />&nbsp;&nbsp;Yes</td>-->
					<!--<td><input type="radio" name="data[Health][reschduled]" value="0" onclick="reschdule_stat(this.value);" <?php if($this->data['Health']['reschduled'] == 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;No</td>-->
				</tr>
				<tr>
					<td colspan="4">
						<?php if($this->data['Health']['city_idd'] == 0) {?>
						<table border="0" width="100%">
							<tr>
								<!--<td width="15%">Visit Date</td>-->
								<!--<td><?php echo $this->data['Health']['visit_lab_collect_date'];?></td>-->
							</tr>
							<tr>
								<!--<td width="15%">Visit Time</td>-->
								<!--<td><?php echo $this->data['Health']['visit_lab_collect_time'];?></td>-->
							</tr>
						</table>
						<?php }?>
						<?php if($this->data['Health']['city_idd'] != 0) {?>
						<table border="0" width="100%">
							<tr>
								<!--<td width="15%">Collection Date</td>-->
								<!--<td><?php echo $this->data['Health']['home_collect_date'];?></td>-->
							</tr>
							<tr>
								<!--<td width="15%">Collection Time</td>-->
								<!--<td><?php echo $this->data['Health']['home_collect_time'];?></td>-->
							</tr>
						</table>
						<?php }?>
					</td>
				</tr>
				<tr id="RescheduleRow" style="display:none;">
					<td colspan="4">
						<table border="0" width="100%">
							
							<tr>
								<td width="15%">Reschdule Date</td>
								<td><?php echo $form->text('Health.new_request_date',array('class'=>'input-text datepicker3'));?></td>
							</tr>
							<tr>
								<td>Reschdule Time</td>
								<td>
									<select name="data[Health][new_request_time]" style="color:#666666;" id="HealthNewRequestTime">
										<option value="">Select Time</option>
										<?php foreach($timelabs as $key => $val) {?>
										<option value="<?php echo $val['Timelab']['id'];?>"><?php echo $val['Timelab']['name'];?></option>
										<?php }?>
									</select>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo $form->submit('Update', array('div'=>false, 'class' => 'btn','onclick'=>'submit_form_reschdule();')); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>
			<?php echo $form->end();?>
		</td>
	</tr>
	
	<tr id="raise_ticket" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/ticketsubmit/'.base64_encode($this->data['Health']['id']),'id'=>'form10','name'=>'form10','enctype'=>'multipart/form-data'));?>
			<?php echo $form->hidden('Health.login_agent',array('value'=>'Super'));?>
			<?php echo $form->hidden('Health.id',array('value'=>$this->data['Health']['id']));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Ticket</h2></td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Category<font color="#FF0000">*</font></label>
					</td>
					<td>
						<select id="category" name="data[Ticket][category]" style="float:left">
							<option value="">Select a Category</option>
							<?php foreach($category as $key => $val) {?>
								<option value="<?php echo $key;?>"><?php echo $val;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Priority<font color="#FF0000">*</font></label>
					</td>
					<td>
						<select id="priority" name="data[Ticket][priority]" style="float:left">
							<option value="">Select a Category</option>
							<?php foreach($priority as $key => $val) {?>
								<option value="<?php echo $key;?>"><?php echo $val;?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Subject<font color="#FF0000">*</font></label>
					</td>
					<td>
					    <?php echo $form->text('Ticket.tickettitle', array('class'=>'input-text','style'=>'width:200px;')); ?>
						<label id="tickettitle_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Raised By<font color="#FF0000">*</font></label>
					</td>
					<td>
						<?php echo $form->text('Ticket.concern_raised', array('class'=>'input-text','style'=>'width:200px;')); ?>
						<label id="ticket_concern_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Email<font color="#FF0000">*</font></label>
					</td>
					<td>
						<?php echo $form->text('Ticket.email', array('class'=>'input-text','style'=>'width:200px;','type'=>'email')); ?>
						<label id="ticket_email_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Phone Number<font color="#FF0000">*</font></label>
					</td>
					<td>
						<?php echo $form->text('Ticket.phone', array('class'=>'input-text phone','style'=>'width:200px;','maxlength'=>'10','minlength'=>'10','type'=>'tel')); ?>
						<label id="ticket_phone_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Description<font color="#FF0000">*</font></label>
					</td>
					<td>
						<?php echo $form->textarea('Ticket.description', array('class'=>'input-text','rows'=>5,'cols'=>50,'style'=>'font-size:12px;')); ?>
						<label id="ticket_description_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Image Upload</label>
					</td>
					<td>
						<?php echo $form->file('Ticket.image_upload',array('class'=>'input-text'));?>
						<div id="msgReportFile" style="color:#FF0000; font-size:12px; clear:both;"></div>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<span id="ticketprocessing" style="color:Red;display:none;font-size: x-large;">Ticket is Being Raised.</span>
					<span id="ticketcompleted" style="color:Green;display:none;font-size: x-large;">Ticket submitted successfully.</span>
					<td><input id="ticketsubmit" class="btn" type="submit" onclick="submit_ticket()" value="Submit"/></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>	
			<?php echo $form->end();?>
		</td>
	</tr>

	<tr id="specimen_d" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/specimen_save/'.base64_encode($this->data['Health']['id']),'id'=>'form11','name'=>'form11','enctype'=>'multipart/form-data'));?>
			<?php echo $form->hidden('Health.login_agent',array('value'=>'Super'));?>
			<?php echo $form->hidden('Health.id',array('value'=>$this->data['Health']['id']));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Specimen Drawn</h2></td>
				</tr>
				<tr>
					<td width="25%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Specimen Drawn Date<font color="#FF0000">*</font></label>
					</td>
					<td>
						<?php if(!empty($this->data['Health']['specimen_date'])){
								echo $form->text('Health.specimen_date', array('readonly' => 'readonly','class'=>'input-text datepicker2','style'=>'width:100px;','value'=>$this->data['Health']['specimen_date'],'required'=>'required',"disabled"=>"true")); 
							}
							else{
								echo $form->text('Health.specimen_date', array('readonly' => 'readonly','class'=>'input-text datepicker2','style'=>'width:100px;','value'=>$this->data['Health']['specimen_date'],'required'=>'required',"disabled"=>"false")); 
							}
							?>
					</td>
				</tr>
				<tr>
					<td width="25%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Specimen Drawn Time<font color="#FF0000">*</font></label>
					</td>
					<td>
						<input id="appt-time" type="time" name="data[Health][specimen_time]" value="<?php echo $this->data['Health']['specimen_time']; ?>" required <?php if(!empty($this->data['Health']['specimen_time'])){ echo "disabled";}?>>
					</td>
				</tr>
				<tr>
					<td width="25%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Confirmed By<font color="#FF0000">*</font></label>
					</td>
					<td>
					    <?php if(!empty($this->data['Health']['specimen_by'])){ 
							echo $form->text('Health.specimen_by', array('class'=>'input-text','style'=>'width:200px;','required'=>'required',"disabled"=>"true")); 
						}
						else
						{
							echo $form->text('Health.specimen_by', array('class'=>'input-text','style'=>'width:200px;','required'=>'required',"disabled"=>"false"));
						}
						?>
						<label id="tickettitle_error" style="color:#FF0000; font-size:12px; clear:both;"></label>						
					</td>
				</tr>
				
				<tr>
					<td width="25%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Remarks<font color="#FF0000">*</font></label>
					</td>
					<td>
					    <?php if(!empty($this->data['Health']['specimen_remarks'])){ 
							echo $form->text('Health.specimen_remarks', array('class'=>'input-text','style'=>'width:200px;','required'=>'required',"disabled"=>'true')); 
						}
						else{
							echo $form->text('Health.specimen_remarks', array('class'=>'input-text','style'=>'width:200px;','required'=>'required',"disabled"=>'false')); 
						}?>
						<label id="tickettitle_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				
				<tr>
					<td>&nbsp;</td>
					<td>
						<input id="specimensubmit" class="btn" type="submit" value="Submit" style="display:<?php if(!empty($this->data['Health']['specimen_remarks'])){ echo 'none';}?>" />
						<input id="specimenedit" class="btn" type="button" value="Edit" onclick="edit_specimen();" style="display:<?php if(empty($this->data['Health']['specimen_remarks'])){ echo 'none';}?>"  />
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>	
			<?php echo $form->end();?>
		</td>
	</tr>
	
	<tr id="MarkClosed" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/mark_closed/'.base64_encode($this->data['Health']['id']),'id'=>'form9','name'=>'form9'));?>
			
			<?php echo $form->hidden('Health.login_action',array('value'=>'Super'));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Mark as closed</h2></td>
				</tr>
				
				<tr>
					<td style="font-weight:bold; width:10px;">1)</td>
					<td style="width:135px;" class="boldText">Closed this status</td>
					<td style="width:55px;"><input type="radio" name="data[Health][requ_status]" value="9" <?php if($this->data['Health']['requ_status'] == 9) {?> checked="checked" <?php }?> onclick="closed_statesde(this.value);" />&nbsp;&nbsp;Yes</td>
					<td><input type="radio" name="data[Health][requ_status]" value="6" <?php if($this->data['Health']['requ_status'] == 6) {?> checked="checked" <?php }?> onclick="closed_statesde(this.value);" />&nbsp;&nbsp;No</td>
				</tr>
				<tr id="MakeDiv" style="display:none;">
					<td>&nbsp;</td>
					<td class="boldText">Enter Message</td>
					
				</tr>
				
				<tr>
					<td>&nbsp;</td>
					
					<td><?php echo $form->submit('Update', array('div'=>false, 'class' => 'btn','onclick'=>'submit_closed();')); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>
			<?php echo $form->end();?>
		</td>
	</tr>
	
	<tr id="BpNet" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/mark_closed/'.base64_encode($this->data['Health']['id']),'id'=>'form9','name'=>'form9'));?>
			
			<?php echo $form->hidden('Health.login_action',array('value'=>'Super'));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>BP NET INVOICE</h2></td>
				</tr>
				
				<tr>
					<td style="font-weight:bold; width:10px;">1)</td>
					<td style="width:135px;" class="boldText">BP Net</td>
					<td style="width:55px;"><?php echo 'Rs. '.($this->data['Health']['test_amt'] - $bp_net);?></td>
					
				</tr>
				<tr>
					<td style="font-weight:bold; width:10px;">2)</td>
					<td style="width:135px;" class="boldText">NetBilling</td>
					<td style="width:55px;"><?php echo 'Rs. '.$this->data['Health']['netbilling'];?></td>
					
				</tr>
				
			</table>
			<?php echo $form->end();?>
		</td>
	</tr>
	
	
	
	
	
	<?php if(!empty($vial_entry)) {?>
	<script type="text/javascript">
	
	$( document ).ready(function() {
		$('#ProcessRequest').show();
		$('#HealthRegisterSample1').attr('checked','checked');
		$('#SampleRegister').show();
		<?php if($vial_entry == 'Duplicate1') {?>
		$('#UniqueInfo1').show();
		<?php }?>
		<?php if($vial_entry == 'Duplicate2') {?>
		$('#UniqueInfo2').show();
		<?php }?>
		<?php if($vial_entry == 'Duplicate3') {?>
		$('#UniqueInfo3').show();
		<?php }?>
		<?php if($vial_entry == 'Duplicate4') {?>
		$('#UniqueInfo4').show();
		<?php }?>
		<?php if($vial_entry == 'Duplicate5') {?>
		$('#UniqueInfo5').show();
		<?php }?>
		<?php if($vial_entry == 'Duplicate6') {?>
		$('#UniqueInfo6').show();
		<?php }?>
		<?php if($vial_entry == 'Duplicate7') {?>
		$('#UniqueInfo7').show();
		<?php }?>
		<?php if($this->data['Health']['dup_entry'] == 'Yes') {?>
		$('#SentLab').show();
		$('#ProcessRequest').hide();
		<?php }?>
		<?php if($this->data['Health']['dup_entry'] == 'Yes') {?>
		$('#MarkClosed').show();
		$('#ProcessRequest').hide();
		<?php }?>
	});
	</script>
	<?php }?>
	<tr id="ProcessRequest" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/process_request/'.base64_encode($this->data['Health']['id']),'id'=>'form5','name'=>'form5'));?>
			<?php if($this->data['Health']['register_sample'] == 1) {?>
			<?php echo $form->hidden('Vial.id',array('value'=>$this->data['Health']['vial_id']));?>
			<?php echo $form->hidden('Vial.created',array('value'=>$this->data['Health']['vial_created']));?>
			
			<?php }?>
			<?php echo $form->hidden('Vial.login_action',array('value'=>'Super'));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Process Request</h2></td>
				</tr>
				<tr>
					<td style="font-weight:bold; width:10px;">1)</td>
					<td style="width:135px;">Register Sample</td>
					<td style="width:55px;"><input type="radio" name="data[Health][register_sample]" id="HealthRegisterSample1" value="1" onclick="sample_register(this.value);" <?php if($this->data['Health']['register_sample'] == 1) {?> checked="checked" <?php }?> />&nbsp;&nbsp;Yes</td>
					<td><input type="radio" name="data[Health][register_sample]" id="HealthRegisterSample0" value="0" onclick="sample_register(this.value);" <?php if($this->data['Health']['register_sample'] == 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;No</td>
				</tr>
				<tr id="SampleRegister" style="display:none;">
					<td colspan="4">
						<table border="0" width="100%">
							<tr id="UniqueInfo1" style="display:none;">
								<td colspan="4" style="text-align:center; color:#FF0000;">Please enter unique VialID for Serum</td>
							</tr>
							<tr id="UniqueInfo2" style="display:none;">
								<td colspan="4" style="text-align:center; color:#FF0000;">Please enter unique VialID for EDTA</td>
							</tr>
							<tr id="UniqueInfo3" style="display:none;">
								<td colspan="4" style="text-align:center; color:#FF0000;">Please enter unique VialID for Sodium Floride (F)</td>
							</tr>
							<tr id="UniqueInfo4" style="display:none;">
								<td colspan="4" style="text-align:center; color:#FF0000;">Please enter unique VialID for Sodium Floride (PP/Random)</td>
							</tr>
							<tr id="UniqueInfo5" style="display:none;">
								<td colspan="4" style="text-align:center; color:#FF0000;">Please enter unique VialID for Urine</td>
							</tr>
							<tr id="UniqueInfo6" style="display:none;">
								<td colspan="4" style="text-align:center; color:#FF0000;">Please enter unique VialID for Other1</td>
							</tr>
							<tr id="UniqueInfo7" style="display:none;">
								<td colspan="4" style="text-align:center; color:#FF0000;">Please enter unique VialID for Other2</td>
							</tr>
							<tr>
								<td style="font-weight:bold; width:10px; border:1px solid #D9D9D9;">&nbsp;</td>
								<td style="font-weight:bold; width:200px; border-top:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">Vial Types</td>
								<td style="font-weight:bold; width:300px; border-top:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">Vial ID</td>
								<td style="font-weight:bold; border-top:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">Remarks</td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">a)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">Serum</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if(!empty($vial_entry)) {?>
										<?php echo $form->text('Health.col1',array('class'=>'input-text','value'=>$vial_enter['Health']['col1']));?>
									<?php } else {?>
										<?php if($this->data['Health']['col1'] == 'no') {?>
											<?php echo $form->text('Health.col1',array('class'=>'input-text','value'=>''));?>
										<?php } else {?>
											<?php echo $form->text('Health.col1',array('class'=>'input-text'));?>
										<?php }?>
									<?php }?>
								</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if(!empty($vial_entry)) {?>
										<?php echo $form->text('Health.remark1',array('class'=>'input-text','value'=>$vial_enter['Health']['remark1']));?>
									<?php } else {?>
										<?php echo $form->text('Health.remark1',array('class'=>'input-text'));?>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">b)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">EDTA</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if(!empty($vial_entry)) {?>
										<?php echo $form->text('Health.col2',array('class'=>'input-text','value'=>$vial_enter['Health']['col2']));?>
									<?php } else {?>
										<?php if($this->data['Health']['col2'] == 'no') {?>
											<?php echo $form->text('Health.col2',array('class'=>'input-text','value'=>''));?>
										<?php } else {?>
											<?php echo $form->text('Health.col2',array('class'=>'input-text'));?>
										<?php }?>
									<?php }?>
								</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if(!empty($vial_entry)) {?>
										<?php echo $form->text('Health.remark2',array('class'=>'input-text','value'=>$vial_enter['Health']['remark2']));?>
									<?php } else {?>
										<?php echo $form->text('Health.remark2',array('class'=>'input-text'));?>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">c)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">Sodium Floride (F)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if(!empty($vial_entry)) {?>
										<?php echo $form->text('Health.col3',array('class'=>'input-text','value'=>$vial_enter['Health']['col3']));?>
									<?php } else {?>
										<?php if($this->data['Health']['col3'] == 'no') {?>
											<?php echo $form->text('Health.col3',array('class'=>'input-text','value'=>''));?>
										<?php } else {?>
											<?php echo $form->text('Health.col3',array('class'=>'input-text'));?>
										<?php }?>
									<?php }?>
								</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if(!empty($vial_entry)) {?>
										<?php echo $form->text('Health.remark3',array('class'=>'input-text','value'=>$vial_enter['Health']['remark3']));?>
									<?php } else {?>
										<?php echo $form->text('Health.remark3',array('class'=>'input-text'));?>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">d)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">Sodium Floride (PP/Random)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if(!empty($vial_entry)) {?>
										<?php echo $form->text('Health.col4',array('class'=>'input-text','value'=>$vial_enter['Health']['col4']));?>
									<?php } else {?>
										<?php if($this->data['Health']['col4'] == 'no') {?>
											<?php echo $form->text('Health.col4',array('class'=>'input-text','value'=>''));?>
										<?php } else {?>
											<?php echo $form->text('Health.col4',array('class'=>'input-text'));?>
										<?php }?>
									<?php }?>
								</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if(!empty($vial_entry)) {?>
										<?php echo $form->text('Health.remark4',array('class'=>'input-text','value'=>$vial_enter['Health']['remark4']));?>
									<?php } else {?>
										<?php echo $form->text('Health.remark4',array('class'=>'input-text'));?>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">e)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">Urine</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if(!empty($vial_entry)) {?>
										<?php echo $form->text('Health.col5',array('class'=>'input-text','value'=>$vial_enter['Health']['col5']));?>
									<?php } else {?>
										<?php if($this->data['Health']['col5'] == 'no') {?>
											<?php echo $form->text('Health.col5',array('class'=>'input-text','value'=>''));?>
										<?php } else {?>
											<?php echo $form->text('Health.col5',array('class'=>'input-text'));?>
										<?php }?>
									<?php }?>
								</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if(!empty($vial_entry)) {?>
										<?php echo $form->text('Health.remark5',array('class'=>'input-text','value'=>$vial_enter['Health']['remark5']));?>
									<?php } else {?>
										<?php echo $form->text('Health.remark5',array('class'=>'input-text'));?>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">f)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">Other1</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if(!empty($vial_entry)) {?>
										<?php echo $form->text('Health.col6',array('class'=>'input-text','value'=>$vial_enter['Health']['col6']));?>
									<?php } else {?>
										<?php if($this->data['Health']['col6'] == 'no') {?>
											<?php echo $form->text('Health.col6',array('class'=>'input-text','value'=>''));?>
										<?php } else {?>
											<?php echo $form->text('Health.col6',array('class'=>'input-text'));?>
										<?php }?>
									<?php }?>
								</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if(!empty($vial_entry)) {?>
										<?php echo $form->text('Health.remark6',array('class'=>'input-text','value'=>$vial_enter['Health']['remark6']));?>
									<?php } else {?>
										<?php echo $form->text('Health.remark6',array('class'=>'input-text'));?>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">g)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">Other2</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if(!empty($vial_entry)) {?>
										<?php echo $form->text('Health.col7',array('class'=>'input-text','value'=>$vial_enter['Health']['col7']));?>
									<?php } else {?>
										<?php if($this->data['Health']['col7'] == 'no') {?>
											<?php echo $form->text('Health.col7',array('class'=>'input-text','value'=>''));?>
										<?php } else {?>
											<?php echo $form->text('Health.col7',array('class'=>'input-text'));?>
										<?php }?>
									<?php }?>
								</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if(!empty($vial_entry)) {?>
										<?php echo $form->text('Health.remark7',array('class'=>'input-text','value'=>$vial_enter['Health']['remark7']));?>
									<?php } else {?>
										<?php echo $form->text('Health.remark7',array('class'=>'input-text'));?>
									<?php }?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo $form->submit('Sample Process', array('div'=>false, 'class' => 'btn','onclick'=>'submit_form_process();')); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>
			<?php echo $form->end();?>
		</td>
	</tr>
	
	<?php //echo "<pre>"; print_r($this->data); exit;?>
	<?php echo $form->create(array('url'=>'/admin/samples/view_detail/'.base64_encode($this->data['Health']['id']),'id'=>'form1','name'=>'form1'));?>
	<?php echo $form->hidden('Health.id',array('value'=>$this->data['Health']['id']));?>
	<?php echo $form->hidden('Health.pay_status',array('value'=>$this->data['Health']['pay_status']));?>
	<?php echo $form->hidden('Health.patient_report',array('value'=>$this->data['Health']['patient_report']));?>
	<?php echo $form->hidden('Health.old_home_report',array('value'=>isset($this->data['Health']['home_report'])?$this->data['Health']['home_report']:''));?>
	<tr id="editDetails" style="display:none;">
		<td colspan="2">
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="2"><h2>Update Details</h2></td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Reference No.</td>
					<td>
					    <?php echo $form->text('Health.reference', array('class'=>'input-text','value'=>$this->data['Health']['reference'],'style'=>'width:100px;')); ?>
					</td>

				</tr>
				<tr>
		       			<td width="15%" class="boldText">Medical Reference No.</td>
					<td>
					    <?php echo $form->text('Health.medical_reference_number', array('class'=>'input-text','value'=>$this->data['Health']['mrn_no'],'style'=>'width:100px;')); ?>
					</td>
		       		</tr>
				<?php if($session->read('Admin.userType') == 'A'){ ?>
					<tr>
						<td width="15%" class="boldText">Booked by</td>
						<td>
							<select name="data[Health][created_by]" class="input-text">
								<option value="">Select Center</option>
								<?php foreach($pcc_list as $key => $val) {?>
										<option <?php echo ($this->data['Health']['created_by'] == $key) ? 'selected' : ''; ?> value="<?php echo $key;?>"><?php echo $val;?></option>
								<?php }?>
							</select>
						</td>
					</tr>
				<?php } ?>
				
				<?php 
				$allow_service_edit=0;
				if($this->data['Health']['requ_status'] < 5)/*before sent to lab*/
				{
					$allow_service_edit = 1;
				}	
				if($session->read('Admin.userType') == 'A')	
					$allow_service_edit = 1;
					
				if($allow_service_edit == 1){ ?> 	
					<tr>
						<td width="15%" class="boldText">Serviced by</td>
						<td>
							<select name="data[Health][assigned_lab]" class="input-text">
								<option value="">Select Center</option>
								<?php foreach($pcc_list as $key => $val) {?>
										<option <?php echo ($this->data['Health']['assigned_lab'] == $key) ? 'selected' : ''; ?>  value="<?php echo $key;?>"><?php echo $val;?></option>
								<?php }?>
							</select>
						</td>
					</tr>
				
				<?php } ?>
				
				<tr>
					<td width="15%" class="boldText">Patient Name <font color="#FF0000">*</font></td>
					<td>
						<?php echo $form->text('Health.name', array('class'=>'input-text','value'=>$this->data['Health']['patient_name'])); ?>
						<div id="msg1" style="color:#FF0000; font-size:12px;"></div>
					</td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Gender <font color="#FF0000">*</font></td>
					<td>
						<select name="data[Health][gender]" id="HealthGender" class="input-text">
							<option value="">Select Gender</option>
							<option value="1" <?php if($this->data['Health']['gender'] == 'Male') {?> selected="selected" <?php }?>>Male</option>
							<option value="2" <?php if($this->data['Health']['gender'] == 'Female') {?> selected="selected" <?php }?>>Female</option>
						</select>
						<div id="msg2" style="color:#FF0000; font-size:12px;"></div>
					</td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Age <font color="#FF0000">*</font></td>
					<td>
						<?php echo $form->text('Health.age', array('class'=>'input-text','style'=>'width:50px;')); ?>
						<div id="msg3" style="color:#FF0000; font-size:12px;"></div>
					</td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Phone Number <font color="#FF0000">*</font></td>
					<td>
						<input class ="input-text phone" name="data[Health][landline]" value="<?php echo $this->data['Health']['landline'];?>" id="HealthLandline" type="text" maxlength="10" minlength="10"/></tr>
						<div id="msg3" style="color:#FF0000; font-size:12px;"></div>
					</td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Alternate Phone Number <font color="#FF0000">*</font></td>
					<td>
						<input class ="input-text phone" name="data[User][alternate_contact]" value="<?php echo $this->data['Health']['alternate_contact'];?>" id="HealthAlternateContact" type="text" maxlength="10" minlength="10"/></tr>
						<div id="msg3" style="color:#FF0000; font-size:12px;"></div>
					</td>
				</tr>
				<tr id="SubTotal" style="display:none;"></tr>
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
				<tr id="ClickTestNew"></tr>
				<?php if(!empty($this->data['Health']['edit_test_name'])) {?>
				<tr id="ClickTest">
					<td width="15%" class="boldText" id="ChangeTestHeading">Tests</td>
					<td>
						<div id="OldTestList"><?php echo $this->data['Health']['edit_test_name'];?></div>
					</td>
				</tr>
				<?php }?>
				
				
				<?php if($allow_test_edit == 1){ ?>
				<tr>
					<td width="15%" class="boldText">Search Tests / Profiles / Services</td>
					<td>
						<div style="float:left;">
							<div style="float:left;"><?php echo $form->text('Health.search_test',array('class'=>'input-text','placeholder'=>'Search Test'));?></div>
							<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;">
							
							<a href="javascript:void(0);" id="try-1" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a>
							
							</div>
						</div>
					</td>
				</tr>
				<?php } ?>
				<tr id="ProfileCount" style="display:none;">0</tr>
				<tr id="ClickProfileNew"></tr>
				<?php if(!empty($this->data['Health']['edit_profile_name'])) {?>
				<tr id="ClickProfile">
					<td width="15%" class="boldText" id="ChangeProfileHeading">Profiles</td>
					<td>
						<div id="OldProfileList"><?php echo $this->data['Health']['edit_profile_name'];?></div>
					</td>
				</tr>
				<?php }?>
				<?php if($allow_test_edit == 1){ ?>
				<!--<tr>
					<td width="15%" class="boldText">Search Profile</td>
					<td>
						<div style="float:left;">
							<div style="float:left;"><?php echo $form->text('Health.search_profile',array('class'=>'input-text','placeholder'=>'Search Profile'));?></div>
							<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-2" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
						</div>
					</td>
				</tr>-->
				<?php } ?>
				<tr id="OfferCount" style="display:none;">0</tr>
				<tr id="ClickOfferNew"></tr>
				<?php if(!empty($this->data['Health']['edit_offer_name'])) {?>
				<tr id="ClickOffer">
					<td width="15%" class="boldText" id="ChangeOfferHeading">Offers</td>
					<td>
						<div id="OldOfferList"><?php echo $this->data['Health']['edit_offer_name'];?></div>
					</td>
				</tr>
				<?php }?>
				<?php if($allow_test_edit == 1){ ?>
				<tr>
					<td width="15%" class="boldText">Special Offer(s)</td>
					<td>
						<div style="float:left;">
							<div style="float:left;"><?php echo $form->text('Health.search_offer',array('class'=>'input-text','placeholder'=>'Search Special Offer'));?></div>
							<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-3" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
						</div>
					</td>
				</tr>
				<?php } ?>
				<tr id="PackageCount" style="display:none;">0</tr>
				<tr id="ClickPackageNew"></tr>
				<?php if(!empty($this->data['Health']['edit_package_name'])) {?>
				<tr id="ClickPackage">
					<td width="15%" class="boldText" id="ChangePackageHeading">Packages</td>
					<td>
						<div id="OldPackageList"><?php echo $this->data['Health']['edit_package_name'];?></div>
					</td>
				</tr>
				<?php }?>
				<?php if($allow_test_edit == 1){ ?>
				<tr>
					<td width="15%" class="boldText">Search Package</td>
					<td>
						<div style="float:left;">
							<div style="float:left;"><?php echo $form->text('Health.search_package',array('class'=>'input-text','placeholder'=>'Search Package'));?></div>
							<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-4" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
						</div>
					</td>
				</tr>
				<?php } ?>
				<tr id="ServiceCount" style="display:none;">0</tr>
				<tr id="ClickServiceNew"></tr>
				<?php if(!empty($this->data['Health']['edit_service_name'])) {?>
				<tr id="ClickService">
					<td width="15%" class="boldText" id="ChangeServiceHeading">Patient Care Services</td>
					<td>
						<div id="OldServiceList"><?php echo $this->data['Health']['edit_service_name'];?></div>
					</td>
				</tr>
				<?php }?>
				<?php if($allow_test_edit == 1){ ?>
				<!--<tr>
					<td width="15%" class="boldText">Search Patient Care Services</td>
					<td>
						<div style="float:left;">
							<div style="float:left;"><?php echo $form->text('Health.search_service',array('class'=>'input-text','placeholder'=>'Search Patient Care Services'));?></div>
							<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-5" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
						</div>
					</td>
				</tr>-->
				<?php }?>
				<tr>
					<td width="15%" class="boldText">Referred By</td>
					<td>
						<?php echo $form->text('Health.remark', array('class'=>'input-text','value'=>$this->data['Health']['remark'])); ?>
					</td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Discount Code</td>
					<td>
						<?php
						echo $form->text('Health.discount_code', array('class'=>'input-text','value'=>$this->data['Health']['discount_code'],'style'=>'width:100px;')); ?>
					</td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Discount Amount</td>
					<td>
						<?php
						if(!empty($this->data['Health']['discount_amount'])){$dis_amt = $this->data['Health']['discount_amount']; }else { $dis_amt = 0;}
						echo $form->text('Health.discount_amount', array('class'=>'input-text','value'=>$dis_amt,'style'=>'width:100px;')); ?>
						<div id="discountissue" style="color:red;display:none;">Discount Value cant be greater than Total Amount</div>
					</td>
				</tr>
				<tr>
					<td class="boldText">Discount Reason <br />(Only filled when Discount Amount Given otherwise leave blank)</td>
					<td>
						<?php echo $form->textarea('Health.discount_amount_reason', array('class'=>'input-text','rows'=>5,'cols'=>50,'style'=>'font-size:12px;')); ?>
					</td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Report at Home</td>
					<td>
						<input type="radio" name="data[Health][home_report]" id="HealthHomeReport1" value="1" <?php if($this->data['Health']['home_report'] == 1) {?> checked="checked" <?php }?> />&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="data[Health][home_report]" id="HealthHomeReport2" value="0" <?php if($this->data['Health']['home_report'] == 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;No
					</td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Sample Collect Status</td>
					<td> 
						<?php if(!empty($this->data['Health']['visit_lab_location']) && !empty($this->data['Health']['visit_lab_collect_time']) && !empty($this->data['Health']['visit_lab_collect_date'])) {?>
							<input type="radio" name="opt" id="visit" value="1" onclick="show_lab(this.value);" checked="checked" />Visit a Lab<br />
						<?php } else {?>
							<input type="radio" name="opt" id="visit" value="1" onclick="show_lab(this.value);" />Visit a Lab<br />
						<?php }?>
						<?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?>	
							<input type="radio" name="opt" id="home" value="2" onclick="show_lab(this.value);" checked="checked" />Home Collection<br />
						<?php } else {?>
							<input type="radio" name="opt" id="home" value="2" onclick="show_lab(this.value);" />Home Collection<br />
						<?php }?>
					</td>
				</tr>
				<tr id="visit_lab_1" <?php if(!empty($this->data['Health']['visit_lab_location']) && !empty($this->data['Health']['visit_lab_collect_time']) && !empty($this->data['Health']['visit_lab_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?> >
					<td width="15%" class="boldText">Select Center</td>
					<td>
						<?php foreach($get_all_pcc as $key => $val) {?>
						<input type="radio" name="data[Health][city]" id="HealthCityLab1" value="<?php echo $val['Lab']['id'];?>" <?php if($this->data['Health']['visit_lab_location'] == $val['Lab']['pcc_name']){?> checked="checked" <?php }?> /> <strong><?php echo $val['Lab']['pcc_name'];?></strong><br />
						<span style="margin:0px 0px 0px 24px;"><?php echo nl2br($val['Lab']['pcc_address']);?></span><br /><br />
						<?php }?>
						
					</td>
				</tr>
				<tr id="visit_lab_2" <?php if(!empty($this->data['Health']['visit_lab_location']) && !empty($this->data['Health']['visit_lab_collect_time']) && !empty($this->data['Health']['visit_lab_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?> >
					<td width="15%" class="boldText">Time</td>
					<td>
						<select name="data[Health][sample_time]" id="HealthSampleTime" class="input-text">
							<option value="">Select Time</option>
							<?php foreach($timelabs as $key => $val) {?>
							<option value="<?php echo $val['Timelab']['id'];?>" <?php if($this->data['Health']['visit_lab_collect_time'] == $val['Timelab']['name']) {?> selected="selected" <?php }?>><?php echo $val['Timelab']['name'];?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr id="visit_lab_3" <?php if(!empty($this->data['Health']['visit_lab_location']) && !empty($this->data['Health']['visit_lab_collect_time']) && !empty($this->data['Health']['visit_lab_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?> >
					<td width="15%" class="boldText">Sample Collect Date</td>
					<td>
						<?php echo $form->text('Health.sample_date', array('readonly' => 'readonly','class'=>'input-text datepicker2','style'=>'width:100px;','value'=>$this->data['Health']['visit_lab_collect_date'])); ?>
					</td>
				</tr>
				
				
				<tr id="home_collection_1" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?> >
					<td width="15%" class="boldText">&nbsp;</td>
					<td>Please select a date and time for Collection of Sample. Our representative will come to the address mention above.</td>
				</tr>
				
				<tr>
					<td width="15%" class="boldText">Reschedule / Follow Up</td>
					<td>
						<select name="data[Health][reschedule]" id="HealthReschedule" class="input-text" onchange="reschedule()">
							<option value="0">No Action</option>
							<option value="1">Reschedule</option>
							<option value="2">Follow Up</option>
						</select>
						<!--<input type="radio" class="reschedule" onclick="reschedule('HealthReschedule')" name="data[Health][reschedule]" id="HealthReschedule" value="1" checked="checked" />&nbsp;&nbsp;Reschedule&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" class="reschedule" onclick="reschedule('HealthFollowup')" name="data[Health][followup]" id="HealthFollowup" value="0" />&nbsp;&nbsp;Follow Up-->
					</td>
				</tr>
				
				<tr id="home_collection_2" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?> >
					<td width="15%" class="boldText">Time</td>
					<td>
						<select name="data[Health][sample_time1]" id="HealthSampleTime1" class="input-text" disabled>
							<option value="">Select Time</option>
							<?php foreach($timelabs as $key => $val) {?>
							<option value="<?php echo $val['Timelab']['id'];?>" <?php if($this->data['Health']['home_collect_time'] == $val['Timelab']['name']) {?> selected="selected" <?php }?>><?php echo $val['Timelab']['name'];?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr id="home_collection_3" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?> >
					<td width="15%" class="boldText">Sample Collect Date</td>
					<td>
						<?php echo $form->text('Health.sample_date1', array('disabled' => 'disabled','class'=>'input-text datepicker','style'=>'width:100px;','value'=>$this->data['Health']['home_collect_date'])); ?>
					</td>
				</tr>
				<?php $exp_add = explode('*',$this->data['Health']['home_collect_address']);?>
				<tr id="home_collection_4" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?> >
					<td width="15%" class="boldText">Address</td>
					<td>
						<?php echo $form->text('Health.address_home1', array('class'=>'input-text','value'=>$exp_add[0])); ?>
					</td>
				</tr>
				<tr id="home_collection_5" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?>>
					<td width="15%" class="boldText">&nbsp;</td>
					<td>
						<?php echo $form->text('Health.address_home2', array('class'=>'input-text','value'=>$exp_add[1])); ?>
					</td>
				</tr>
				<tr id="home_collection_9" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?>>
					<td width="15%" class="boldText">Pincode</td>
					<td>
						<?php echo $form->text('Health.home_pincode', array('class'=>'input-text','value'=>$this->data['Health']['home_collect_pincode'],'onkeyup'=>'getcitystate();')); ?>
					</td>
				</tr>
				<tr id="home_collection_6" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?>>
					<td width="15%" class="boldText">Locality</td>
					<td>
						<select name="data[Health][home_locality]" id="HealthLocality" class="input-text">
						<?php foreach($locality as $val) {?>
							<option value="<?php echo str_replace(' ','_',$val);?>" <?php if($this->data['Health']['home_locality'] == str_replace(' ','_',$val)) {?> selected="selected" <?php }?>><?php echo $val;?></option>
						<?php } ?>
						</select>
					</td>
				</tr>
				<tr id="home_collection_7" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?>>
					<td width="15%" class="boldText">City</td>
					<td>
						<select name="data[Health][home_city]" id="HealthHomeCity">
							<option value="">Select City</option>
							<?php foreach($city as $key => $val) {?>
							<option value="<?php echo $val['City']['id'];?>" <?php if($this->data['Health']['home_collect_city'] == $val['City']['id']) {?> selected="selected" <?php }?>><?php echo $val['City']['name'];?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr id="home_collection_8" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?>>
					<td width="15%" class="boldText">State</td>
					<td>
						<select name="data[Health][home_state]" id="HealthHomeState">
							<option value="">Select State</option>
							<?php foreach($state as $key => $val) {?>
							<option value="<?php echo $val['State']['id'];?>" <?php if($this->data['Health']['home_collect_state'] == $val['State']['id']) {?> selected="selected" <?php }?>><?php echo $val['State']['name'];?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				
				<tr id="home_collection_10" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?>>
					<td width="15%" class="boldText">Landmark</td>
					<td>
						<?php echo $form->text('Health.home_landmark', array('class'=>'input-text','value'=>$this->data['Health']['home_collect_landmark'])); ?>
					</td>
				</tr>
				
				<!--<tr id="submit_div" style="display:none;">
					<td width="15%">&nbsp;</td>
					<td>
						<?php //echo $form->submit('Save', array('div'=>false, 'class' => 'btn')); ?>
						<a onclick="javascript:window.history.go(-1)" class="btn" style="color:#FFFFFF;">Cancel</a>
					</td>
				</tr>-->
				<tr>
					<td><?php echo $form->submit('Update', array('div'=>false, 'class' => 'btn','id'=>'editupdate')); ?></td>
				</tr>
			</table>
		</td>
	</tr>	
	<?php echo $form->end();?>
	
	<?php echo $form->create(array('url'=>'/admin/samples/update_payment','id'=>'form2','name'=>'form2','onsubmit'=>'return payment_submit();'));?>
	<?php echo $form->hidden('Health.id',array('value'=>$this->data['Health']['id']));?>
	<tr id="PayStatusDiv" style="display:none;"></tr>
	<tr id="updatePayStatus" style="display:none;">
		<td colspan="2">
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="2"><h2>Update Payment Status</h2></td>
				</tr>
				
				<!--<tr>
					<td colspan="2">
						<input type="radio" name="data[Health][pay_status]" value="1" onclick="show_partial(this.value);" /> Full Payment Received
						<input type="radio" name="data[Health][pay_status]" value="2" onclick="show_partial(this.value);" /> Partial Payment Received
					</td>
				</tr>-->
				
				<tr>
					<td width="50%">
						<table border="0" width="100%">
							<tr>
								<td width="25%" style="font-weight:bold;">Mode of Payment</td>
								<td>
									<select name="data[Health][pay_mode]" class="input-text" style="color:#666666; width:150px;" onchange="open_tr(this.value);" id="HealthPayMode">
										<option value="">Select Mode</option>
										<option value="paymenttopcc">Payment with PCC</option>
										<option value="wallet">Wallet</option>
										<!--<option value="refund">Refund</option>-->
										<option value="cash" selected="selected">Cash</option>
										<option value="credit_card">Credit Card</option>
										<option value="cheque">Cheque/DD</option>
										<option value="adjust">Adj/Refund</option>
										<option value="btc">Process Without Pay</option>
										<option value="btcnopayment">Bill To Company</option>
									</select><br />
									<span id="PayModeNillVal" style="display:none; color:#FF0000;">Please select Payment Mode</span>
								</td>
							</tr>
							<tr id="CC" style="display:none;">
								<td width="25%" style="font-weight:bold;">Credit Card Number</td>
								<td><input type="text" name="data[Health][card_number]" class="input-text" style="width:150px;" id="HealthCardNumber"></td>
							</tr>
							<tr id="CQ" style="display:none;">
								<td width="25%" style="font-weight:bold;">Cheque/DD Number</td>
								<td><input type="text" name="data[Health][cheque_number]" class="input-text" style="width:150px;" id="HealthChequeNumber"></td>
							</tr>
							<tr>
								<td width="25%" style="font-weight:bold;">Total Amount</td>
								<td>
									Rs. <?php echo $this->data['Health']['total_test_amt'];?>
									<?php echo $form->hidden('Health.total_amt',array('value'=>$this->data['Health']['test_amt']));?>
								</td>
							</tr>
							<?php if($this->data['Health']['discount_amount_after_add'] != 0) {?>
							<tr>
								<td width="25%" style="font-weight:bold;">Discount</td>
								<td>
									Rs. <?php echo $this->data['Health']['discount_amount_after_add'];?>
								</td>
							</tr>
							<?php }?>
							<tr>
								<td width="25%" style="font-weight:bold;">Net Payable</td>
								<td>
									Rs. <?php echo $this->data['Health']['test_amt'];?>
								</td>
							</tr>
							<tr>
								<td width="25%" style="font-weight:bold;">Amount Received</td>
								<td>
									Rs. <?php echo $this->data['Health']['rec_ins_amt'];?>
									<input type="hidden" value="<?php echo $this->data['Health']['rec_ins_amt']; ?>" id="total_amt_received"/>
									<?php echo $form->hidden('Health.receive_amt',array('value'=>$this->data['Health']['receive_amt']));?>
								</td>
							</tr>
							<tr>
								<td width="25%" style="font-weight:bold;">Balance Due</td>
								<td>
									Rs. <?php echo $this->data['Health']['balance_amt'];?>
									<?php echo $form->hidden('Health.bal_amt',array('value'=>$this->data['Health']['balance_amt']));?>
								</td>
							</tr>
							<?php if($this->data['Health']['balance_refund'] == 0) {?>
							<tr id="PayRec">
								<td width="30%" style="font-weight:bold;">Payment Received</td>
								<td>Rs. <?php echo $form->text('Health.pay_amt',array('value'=>'','class'=>'input-text','style'=>'width:100px;'));?></td>
							</tr>
							<?php }?>
							<?php if($this->data['Health']['balance_refund'] != 0) {?>
							<tr>
								<td width="30%" style="font-weight:bold;">Refund Amount</td>
								<td>Rs. <?php echo $this->data['Health']['balance_refund'];?></td>
							</tr>
							<?php }?>
							<tr id="AdjPay" style="display:none;">
								<td width="30%" style="font-weight:bold;">Adj/Refund Amount</td>
								<td>Rs. <?php echo $form->text('Health.adj_amt',array('value'=>'','class'=>'input-text','style'=>'width:100px;'));?></td>
							</tr>
							<tr id="AdjRsn" style="display:none;">
								<td width="30%" style="font-weight:bold;">Adj/Refund Reason</td>
								<td><?php echo $form->textarea('Health.adj_rsn',array('value'=>'','class'=>'input-text','cols'=>30,'rows'=>5,'style'=>'font-size:12px;'));?></td>
							</tr>
							<tr id="BtcPay" style="display:none;">
								<td width="30%" style="font-weight:bold;">BTC Amount</td>
								<td>Rs. <?php echo $form->text('Health.btc_amt',array('value'=>'0','class'=>'input-text','style'=>'width:100px;','readonly'=>'readonly'));?></td>
							</tr>
							<tr id="BtcRsn" style="display:none;">
								<td width="30%" style="font-weight:bold;">Reason</td>
								<td><?php echo $form->textarea('Health.btc_rsn',array('value'=>'','class'=>'input-text','cols'=>30,'rows'=>5,'style'=>'font-size:12px;'));?></td>
							</tr>
							<tr class="BtcNoPayment" style="display:none;">
								<td width="30%" style="font-weight:bold;">Bill To Company</td>
								<td><?php echo $form->text('Health.btc_no_payment_bill_to_company',array('value'=>!empty($this->data['Health']['created_by'])?$get_all_pcc_list[$this->data['Health']['created_by']]:'NPL','class'=>'input-text','style'=>'font-size:12px;','readonly'=>'readonly'));?></td>
							</tr>
							<tr class="pay_amt" style="display:none;">
								<td width="30%" style="font-weight:bold;">Payment Amount</td>
								<td>Rs. <?php echo $form->text('Health.pcc_amt',array('value'=>'0','class'=>'input-text','style'=>'width:100px;','readonly'=>'readonly'));?></td>
							</tr>
							<!--<tr id="RefundPay" style="display:none;">
								<td width="30%" style="font-weight:bold;">Refund Amount</td>
								<td>Rs. <?php echo $form->text('Health.adj_amt',array('value'=>'','class'=>'input-text','style'=>'width:100px;'));?></td>
							</tr>-->
							<!--<tr id="WalletName" style="display:none;">
								<td width="30%" style="font-weight:bold;">Name Of Wallet</td>
								<td><?php echo $form->text('Health.adj_amt',array('value'=>'','class'=>'input-text','style'=>'width:100px;'));?></td>
							</tr>-->
							<!--<tr id="RefundMode" style="display:none;">
								<td width="30%" style="font-weight:bold;">Mode Of Refund</td>
								<td><?php echo $form->text('Health.adj_amt',array('value'=>'','class'=>'input-text','style'=>'width:100px;'));?></td>
							</tr>-->
							<!--<tr id="RefundRsn" style="display:none;">
								<td width="30%" style="font-weight:bold;">Remarks</td>
								<td><?php echo $form->textarea('Health.adj_rsn',array('value'=>'','class'=>'input-text','cols'=>30,'rows'=>5,'style'=>'font-size:12px;'));?></td>
							</tr>-->
							<tr class="forLab" style="display:none;">
								<td width="30%" style="font-weight:bold;">PCC Name</td>
								<td>
									<select name="data[Health][assigned_lab]" class="input-text">
										<option value="">Select Center</option>
										<?php foreach($pcc_list as $key => $val) {?>
												<option <?php echo ($this->data['Health']['assigned_lab'] == $key) ? 'selected' : ''; ?>  value="<?php echo $key;?>"><?php echo $val;?></option>
										<?php }?>
									</select>
								</td>
							</tr>
							<tr class="Remarks" style="display:none;">
								<td width="30%" style="font-weight:bold;">Remarks</td>
								<td><?php echo $form->textarea('Health.btc_no_payment_remark',array('value'=>'','class'=>'input-text','cols'=>30,'rows'=>3,'style'=>'font-size:12px;'));?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>
									<a href="javascript:void(0);" onclick="preview_payment();">Preview</a>
									<a href="javascript:void(0);" onclick="close_payment_box();">Close</a>
								</td>
							</tr>
						</table>
					</td>
					<td id="PreviewPayment" style="display:none;" valign="top">
						<table border="0" width="100%">
							<tr>
								<td width="25%" style="font-weight:bold;">Payment Mode</td>
								<td id="PMODE"></td>
							</tr>
							<tr style="display:none;" id="DIVCCNUM">
								<td width="30%" style="font-weight:bold;">Credit Card Number</td>
								<td id="CCNUM"></td>
							</tr>
							<tr style="display:none;" id="DIVCHQNUM">
								<td width="30%" style="font-weight:bold;">Cheque/DD Number</td>
								<td id="CHQNUM"></td>
							</tr>
							<tr>
								<td width="25%" style="font-weight:bold;">Total Amount</td>
								<td id="TAMT"></td>
							</tr>
							<tr>
								<td width="25%" style="font-weight:bold;">Received Amount</td>
								<td id="RAMT"></td>
							</tr>
							<tr>
								<td width="25%" style="font-weight:bold;">Balance Due</td>
								<td id="BAMT"></td>
							</tr>
							<tr style="display:none;" id="RFAMTDIV">
								<td width="25%" style="font-weight:bold;">Refund Amount</td>
								<td id="RFAMT"></td>
							</tr>
							<tr style="display:none;" id="ADJAMTDIV">
								<td width="30%" style="font-weight:bold;">Adj/Refund Amount</td>
								<td id="ADJAMT"></td>
							</tr>
							<tr style="display:none;" id="ADJRSNDIV">
								<td width="30%" style="font-weight:bold;">Adj/Refund Reason</td>
								<td id="ADJRSN"></td>
							</tr>
							<tr style="display:none;" id="BTCRSNDIV">
								<td width="30%" style="font-weight:bold;">BTC Reason</td>
								<td id="BTCRSN"></td>
							</tr>
							<tr>
								<td><?php echo $form->submit('Save & Submit', array('div'=>false, 'class' => 'btn','onclick'=>'')); ?></td>
								<td><a href="javascript:void(0);" onclick="hide_preview_payment();" id="hide_preview_payment" style="disply:none;text-decoration:none; color:#fff;" class="btn">Cancel</a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>	
	<?php echo $form->end();?>
	<script type="text/javascript">
	
	function getcitystate()
	{
		var pin = $('#HealthHomePincode').val();
		if(pin.length==6)
		{
			jQuery.ajax({
				type:'GET',
				url:siteUrl+'admin/samples/getcitystate?pin='+pin,
				success: function(response) {
				console.log(response);
					$('#HealthHomeCity option[value='+response["city"]+']').attr('selected','selected');						
					$('#HealthHomeState option[value='+response["state"]+']').attr('selected','selected');
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

	function open_tr(val)
	{
		if(val == 'paymenttopcc')
		{
			$('.pay_amt').show();
			$('.forLab').show();
			$('.Remarks').show();
			$('#CC').hide();
			$('#CQ').hide();
			$('#RefundMode').hide();
			$('#WalletName').hide();
			$('#RefundPay').hide();
			$('#RefundRsn').hide();
			$('#AdjPay').hide();
			$('#PayRec').hide();
			$('#AdjRsn').hide();
			$('#BtcPay').hide();
			$('#BtcRsn').hide();
			$(".BtcNoPayment").hide();
		}
		if(val == 'wallet')
		{
			$('.pay_amt').show();
			$('.forLab').hide();
			$('.Remarks').show();
			$('#CC').hide();
			$('#CQ').hide();
			$('#RefundMode').hide();
			$('#WalletName').show();
			$('#PayRec').hide();
			$('#RefundPay').hide();
			$('#RefundRsn').hide();
			$('#AdjPay').hide();
			$('#AdjRsn').hide();
			$('#BtcPay').hide();
			$('#BtcRsn').hide();
			$(".BtcNoPayment").hide();
		}
		if(val == 'refund')
		{
			$('.pay_amt').hide();
			$('.forLab').hide();
			$('#RefundPay').show();
			$('#RefundRsn').show();
			$('.Remarks').hide();
			$('#RefundMode').show();
			$('#WalletName').hide();
			$('#CC').hide();
			$('#CQ').hide();
			$('#AdjPay').hide();
			$('#PayRec').show();
			$('#AdjRsn').hide();
			$('#BtcPay').hide();
			$('#BtcRsn').hide();
			$(".BtcNoPayment").hide();
		}
		if(val == 'cash')
		{
			$('.pay_amt').hide();
			$('.forLab').hide();
			$('#RefundPay').hide();
			$('#RefundRsn').hide();
			$('.Remarks').hide();
			$('#CC').hide();
			$('#CQ').hide();
			$('#RefundMode').hide();
			$('#WalletName').hide();
			$('#AdjPay').hide();
			$('#PayRec').show();
			$('#AdjRsn').hide();
			$('#BtcPay').hide();
			$('#BtcRsn').hide();
			$(".BtcNoPayment").hide();
		}
		if(val == 'credit_card')
		{
			$('.pay_amt').hide();
			$('.forLab').hide();
			$('#RefundPay').hide();
			$('#RefundRsn').hide();
			$('.Remarks').show();
			$('#CC').show();
			$('#CQ').hide();
			$('#RefundMode').hide();
			$('#WalletName').hide();
			$('#AdjPay').hide();
			$('#PayRec').show();
			$('#AdjRsn').hide();
			$('#BtcPay').hide();
			$('#BtcRsn').hide();
			$(".BtcNoPayment").hide();
		}
		if(val == 'cheque')
		{
			$('.pay_amt').hide();
			$('.forLab').hide();
			$('#RefundPay').hide();
			$('#RefundRsn').hide();
			$('.Remarks').show();
			$('#CQ').show();
			$('#CC').hide();
			$('#RefundMode').hide();
			$('#WalletName').hide();
			$('#AdjPay').hide();
			$('#PayRec').show();
			$('#AdjRsn').hide();
			$('#BtcPay').hide();
			$('#BtcRsn').hide();
			$(".BtcNoPayment").hide();
		}
		if(val == 'adjust')
		{
			$('.pay_amt').hide();
			$('.forLab').hide();
			$('#RefundPay').hide();
			$('#RefundRsn').hide();
			$('.Remarks').hide();
			$('#AdjPay').show();
			$('#AdjRsn').show();
			$('#PayRec').hide();
			$('#CQ').hide();
			$('#CC').hide();
			$('#RefundMode').hide();
			$('#WalletName').hide();
			$('#BtcPay').hide();
			$('#BtcRsn').hide();
			$(".BtcNoPayment").hide();
		}
		if(val == 'btc')
		{
			$('.pay_amt').hide();
			$('.forLab').hide();
			$('#RefundPay').hide();
			$('#RefundRsn').hide();
			$('#AdjPay').hide();
			$('#AdjRsn').hide();
			$('#PayRec').hide();
			$('#CQ').hide();
			$('#CC').hide();
			$('#RefundMode').hide();
			$('#WalletName').hide();
			$('#BtcPay').show();
			$('#BtcRsn').show();
			$(".BtcNoPayment").hide();
		}
		if(val == 'btcnopayment')
		{
			$('.pay_amt').hide();
			$('.forLab').hide();
			$('#RefundPay').hide();
			$('#RefundRsn').hide();
			$('#AdjPay').hide();
			$('#AdjRsn').hide();
			$('#PayRec').hide();
			$('#CQ').hide();
			$('#CC').hide();
			$('#RefundMode').hide();
			$('#WalletName').hide();
			$('#BtcPay').hide();
			$('#BtcRsn').hide();
			$(".BtcNoPayment").show();
		}
	}
	
	function preview_payment()
	{
		$("#hide_preview_payment").show();
		var row_1 = parseInt(document.getElementById('HealthTotalAmt').value);
		var row_2 = parseInt(document.getElementById('HealthReceiveAmt').value);
		var row_3 = parseInt(document.getElementById('HealthBalAmt').value);
		<?php if($this->data['Health']['balance_refund'] == 0) {?>
		var row_4 = parseInt(document.getElementById('HealthPayAmt').value);
		var bal_ref_amt = parseInt(document.getElementById('HealthPayAmt').value);
		<?php }?>
		<?php if($this->data['Health']['balance_refund'] != 0) {?>
		var bal_ref_amt = '<?php echo $this->data['Health']['balance_refund'];?>';
		<?php }?>
		var row_5 = document.getElementById('HealthPayMode').value;
		var row_8 = parseInt(document.getElementById('HealthAdjAmt').value);
		var row_100 = document.getElementById('HealthAdjRsn').value;
		var row_101 = document.getElementById('HealthBtcRsn').value;
		if(row_5 == 'adjust')
		{
			
			var val_4 = 'Adjustment';
			var null_val = '';
			$('#PMODE').html(val_4);
			$('#DIVCCNUM').hide();
			$('#DIVCHQNUM').hide();
			$('#HealthCardNumber').val(null_val);
			$('#HealthChequeNumber').val(null_val);
			var rep_div_1 = 'Rs. '+parseInt(row_1);
			var rep_div_2 = 'Rs. '+parseInt(row_2+parseInt(bal_ref_amt));
			
			if(row_8 > row_3)
			{
				var rep_div_3 = 'Rs. 0';
				var rep_div_4 = 'Rs. '+parseInt(row_8-row_3);
				$('#ADJAMT').html(rep_div_4);
				$('#BAMT').html(rep_div_3);
				$('#RFAMTDIV').hide();
				$('#ADJAMTDIV').show();
			}
			if(row_8 == row_3)
			{
				var rep_div_3 = 'Rs. 0';
				$('#BAMT').html(rep_div_3);
				$('#RFAMTDIV').hide();
			}
			if(row_8 < row_3)
			{
				var rep_div_3 = 'Rs. '+parseInt(row_3-row_8);
				$('#BAMT').html(rep_div_3);
				$('#RFAMTDIV').hide();
			}
			var adj_rsn = '';
			adj_rsn +=row_100;
			$('#ADJRSN').html(adj_rsn);
			$('#ADJRSNDIV').show();
			$('#TAMT').html(rep_div_1);
			$('#RAMT').html(rep_div_2);
			$('#PreviewPayment').show();
			$('#updatePayStatus').show();
		}
		else
		{
			if(row_5 == 'cash')
			{
				var val_1 = 'Cash';
				var null_val = '';
				$('#PMODE').html(val_1);
				$('#HealthAdjRsn').val(null_val);
				$('#DIVCCNUM').hide();
				$('#DIVCHQNUM').hide();
				$('#HealthCardNumber').val(null_val);
				$('#HealthChequeNumber').val(null_val);
			}
			if(row_5 == 'credit_card')
			{
				var val_2 = 'Credit Card';
				var null_val = '';
				var row_6 = document.getElementById('HealthCardNumber').value;
				$('#PMODE').html(val_2);
				$('#HealthAdjRsn').val(null_val);
				$('#DIVCCNUM').show();
				$('#DIVCHQNUM').hide();
				$('#CCNUM').html(row_6);
				$('#HealthChequeNumber').val(null_val);
			}
			if(row_5 == 'cheque')
			{
				var val_3 = 'Cheque/DD';
				var null_val = '';
				var row_7 = document.getElementById('HealthChequeNumber').value;
				$('#PMODE').html(val_3);
				$('#HealthAdjRsn').val(null_val);
				$('#DIVCCNUM').hide();
				$('#DIVCHQNUM').show();
				$('#HealthCardNumber').val(null_val);
				$('#CHQNUM').html(row_7);
			}
			var rep_div_1 = 'Rs. '+parseInt(row_1);
			var copy_1 = parseInt(row_1);
			var rep_div_2 = 'Rs. '+parseInt(row_2+row_4);
			var copy_2 = parseInt(row_2+row_4);
			if(parseInt(row_1) > parseInt(copy_2))
			{
				var rep_div_3 = 'Rs. '+parseInt(row_1-copy_2);
				$('#BAMT').html(rep_div_3);
			}
			else
			{
				var rep_div_3 = 'Rs. '+0;
				var rep_div_4 = 'Rs. '+parseInt(copy_2-row_1);
				$('#BAMT').html(rep_div_3);
				$('#RFAMT').html(rep_div_4);
				$('#RFAMTDIV').show();
			}
			if(row_5 == 'btc')
			{
				var bal_due_amt = '<?php echo 'Rs. '.$this->data['Health']['balance_amt'];?>';
				var val_4 = 'BTC/Process Without Pay';
				var null_val = '';
				$('#PMODE').html(val_4);
				$('#DIVCCNUM').hide();
				$('#DIVCHQNUM').hide();
				$('#HealthCardNumber').val(null_val);
				$('#HealthChequeNumber').val(null_val);
				var rep_div_2 = '0';
				$('#RFAMTDIV').hide();
				var adj_rsn = '';
				$('#ADJRSNDIV').hide();
				$('#BTCRSNDIV').show();
				$('#BTCRSN').html(row_101);
				$('#BAMT').html(bal_due_amt);
			}
			if(row_5 == 'btcnopayment')
			{
				var bal_due_amt = 0;
				var val_4 = 'Bill To Company';
				var null_val = '';
				var row_101 = $("#HealthBtcNoPaymentRemark").val();
				$('#PMODE').html(val_4);
				$('#DIVCCNUM').hide();
				$('#DIVCHQNUM').hide();
				$('#HealthCardNumber').val(null_val);
				$('#HealthChequeNumber').val(null_val);
				var rep_div_2 = '<?php echo 'Rs. '.$this->data['Health']['balance_amt'];?>';;
				$('#RFAMTDIV').hide();
				var adj_rsn = '';
				$('#ADJRSNDIV').hide();
				$('#BTCRSNDIV').show();
				$('#BTCRSN').html(row_101);
				$('#BAMT').html(bal_due_amt);
				$('#HealthPayAmt').val(<?php echo $this->data['Health']['balance_amt'];?>);
				
			}
			
			$('#TAMT').html(rep_div_1);
			$('#RAMT').html(rep_div_2);
			$('#PreviewPayment').show();
			$('#updatePayStatus').show();
		}
	}
	
	//function to hide payment preview
	function hide_preview_payment()
	{
		$("#PreviewPayment").hide();
	}
	</script>
	<script type="text/javascript">
	function report_status(val)
	{
		if(val == 'partial')
		{
			jQuery('#MessageUser').show();
			jQuery('#completedTests').show();
			jQuery('#pendingTests').show();
		}
		if(val == 'full')
		{
			var null_val = '';
			jQuery('#MessageUser').hide();
			jQuery('#HealthReportReason').val(null_val);
		}
	}
	
	function report_submit()
	{
		
		var str = true;
		document.getElementById('msgReportType').innerHTML = '';
		document.getElementById('msgReportFile').innerHTML = '';
		document.getElementById('msgReportReason').innerHTML = '';
		
		if(document.form3.radio1ReportType.checked) 
		{
		   	str = true;
		}
		else
		{
			if(document.form3.radio2ReportType.checked) 
			{
				str = true;
			}
			else
			{
				document.getElementById('msgReportType').innerHTML = 'Please select report type';
				str = false;
			}
		}
		if(document.form3.HealthPatientReport.value == '')
		{
			document.getElementById('msgReportFile').innerHTML = 'Please select report';
			str = false;
		}
		if(str == true)
		{
			document.forms["form3"].submit();	
		}
		else
		{
			return str;
		}
	}
	</script>
	<?php echo $form->create(array('url'=>'/admin/samples/upload_report','id'=>'form3','name'=>'form3','enctype'=>'multipart/form-data'));?>
	<?php echo $form->hidden('Health.id',array('value'=>$this->data['Health']['id']));?>
	<?php echo $form->hidden('Health.login_agent',array('value'=>'Super'));?>
	<?php if(!empty($this->data['Health']['patient_report'])) {?>
	<?php echo $form->hidden('Health.old_patient_report',array('value'=>$this->data['Health']['patient_report']));?>
	<?php } else {?>
	<?php echo $form->hidden('Health.old_patient_report',array('value'=>''));?>
	<?php }?>
	<tr id="uploadReport" style="display:none;">
		<td colspan="2">
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="2"><h2>Upload Report</h2></td>
				</tr>
				
				<tr>
					<td width="15%" class="boldText">Report Type</td>
					<td>
						<input type="radio" name="data[Health][report_type]" value="partial" id="radio1ReportType" onclick="report_status(this.value);" <?php if($this->data['Health']['report_type'] == 'partial') {?> checked="checked"<?php } ?>  /><span id="p">&nbsp;Partial Report&nbsp;&nbsp;&nbsp;</span>
						
						<!--<?php //if($this->data['Health']['report_type'] == 'partial') {?> checked="checked" <?php //}?>-->
						<input type="radio" name="data[Health][report_type]" value="full" id="radio2ReportType" onclick="report_status(this.value);" <?php if($this->data['Health']['report_type'] == 'full') { ?> checked="checked" <?php } ?> /><span id="f">&nbsp;Full Report </span>
						<div id="msgReportType" style="color:#FF0000; font-size:12px; clear:both;"></div>
					</td>
				</tr>
				<!--marking of test, which is completed while uploading partial report-->
				<tr>
					<td valign="top">Mark Completed Test</td>
					<td>
						<ul>
						<?php foreach($partial_indi_test_reporting_status as $kay=>$val){ ?>
						<li>
							<?php 
								if($val['reporting_status'] == 1)
									e($form->checkbox('RequestTest.reporting_status_'.$val['id'], array('checked'=>true)));
								else
									e($form->checkbox('RequestTest.reporting_status_'.$val['id'], array('checked'=>false)));
								
								echo $val['test_code']." - ".$val['test_name']; ?>
						</li>
						<?php } ?>
						</ul>
					</td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Upload Report</td>
					<td>
						<?php echo $form->file('Health.patient_report',array('class'=>'input-text'));?>
						<div id="msgReportFile" style="color:#FF0000; font-size:12px; clear:both;"></div>
					</td>
				</tr>
				<?php if($this->data['Health']['report_reason'] != '') { ?>
				<tr id="MessageUser">
					<td width="15%" class="boldText">Message for User</td>
					<td>
						<textarea name="data[Health][report_reason]" id="HealthReportReason" class="input-text" rows="5" cols="30" style="font-size:12px;"><?php echo $this->data['Health']['report_reason'];?></textarea>
						<div id="msgReportReason" style="color:#FF0000; font-size:12px; clear:both;"></div>
					</td>
				</tr>
				<?php } else {?>
				<tr id="MessageUser" style="display:none;">
					<td width="15%" class="boldText">Message for User</td>
					<td>
						<textarea name="data[Health][report_reason]" id="HealthReportReason" class="input-text" rows="5" cols="30" style="font-size:12px;"></textarea>
						<div id="msgReportReason" style="color:#FF0000; font-size:12px; clear:both;"></div>
					</td>
				</tr>
				<tr id="completedTests" style="display:none;">
					<td width="15%" class="boldText">Completed Tests</td>
					<td>
						<textarea name="data[Health][compeleted_test]" id="completed_test" class="input-text" rows="5" cols="30" style="font-size:12px;"></textarea>
						<div id="msgReportReason" style="color:#FF0000; font-size:12px; clear:both;"></div>
					</td>
				</tr>
				<tr id="pendingTests" style="display:none;">
					<td width="15%" class="boldText">Pending Tests</td>
					<td>
						<textarea name="data[Health][pending_test]" id="pending_test" class="input-text" rows="5" cols="30" style="font-size:12px;"></textarea>
						<div id="msgReportReason" style="color:#FF0000; font-size:12px; clear:both;"></div>
					</td>
				</tr>
				<?php }?>
				<!--<tr>
					<td width="15%" class="boldText">Publish Report</td>
					<td>
						<input type="radio" name="data[Health][published]" value="1" onclick="publish_reason(this.value);" <?php //if($this->data['Health']['published'] == 1) {?> checked="checked" <?php //}?> />&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="data[Health][published]" value="0" onclick="publish_reason(this.value);" <?php //if($this->data['Health']['published'] == 0) {?> checked="checked" <?php //}?> />&nbsp;&nbsp;No
					</td>
				</tr>
				<tr id="PublishReason" style="display:none;">
					<td class="boldText">Reason</td>
					<td><?php //echo $form->textarea('Health.published_reason',array('class'=>'input-text','rows'=>5,'cols'=>30,'style'=>'font-size:12px;'));?></td>
				</tr>-->
				<tr>
					
					
                                        <td>&nbsp;</td>
                                        <td><?php echo $form->submit('Upload', array('div'=>false, 'class' => 'btn','onclick'=>'return report_submit(this);')); ?></td>
				</tr>
			</table>
		</td>
	</tr>




	
	<?php echo $form->end();?>
</table>

</div>
<script type="text/javascript">
function enableTextbox(e)
{
	var id=e.id;
	var id_part = id.replace('checkbox_', '');
	var disable_status =  document.getElementById('sample_barcode_'+id_part).disabled;
	if(disable_status == true)
		document.getElementById('sample_barcode_'+id_part).disabled = false;
	else
	{
		document.getElementById('sample_barcode_'+id_part).disabled = true;
		document.getElementById('sample_barcode_'+id_part).value = '';
	}
}

function changeBarcodeName(e)
{
	document.getElementById('sample_others').setAttribute('name', 'sample_barcode['+e.value+']');
	document.getElementById('sample_barcode_others').setAttribute('name', 'sample_barcode['+e.value+']');
	var sample_other_name =  document.getElementById('sample_barcode_others').name;
}

function publish_reason(val)
{
	if(val == 1)
	{
		$('#PublishReason').hide();
	}
	if(val == 0)
	{
		$('#PublishReason').show();
	}
}
function reportupdate(){
	var healthId = $('#HealthRequestId').val();
	$('#reportupdate').hide();
	$('#reportprocessing').show();
	$.ajax({
		type:'POST',
		url:siteUrl+'admin/samples/reportupdate',
		data : {
			id : healthId,
		},
		dataType:"json",
		success:function(result){
			console.log(result);
			if(result["status"] != "failed")
			{
				$('#reportcompleted').show();
			}
			else
				$('#reportfailed').show();
			$('#reportprocessing').hide();
			$('#reportupdate').show();
		}
	});
}

function autostl(){
	var healthId = $('#HealthRequestId').val();
	$('#autosenttolab').hide();
	$('#sentlabprocessing').show();
	$.ajax({
		type:'POST',
		url:siteUrl+'admin/samples/senttolab',
		data : {
			id : healthId,
		},
		dataType:"json",
		success:function(result){
			console.log(result);
			if(result["status"] != "Failed")
			{
				$('#sentlabcompleted').html(result);
				$('#sentlabcompleted').show();
				//$('#savestl').html(result);
			}
			else
			{
				$('#sentlabcompleted').html(result["response"]['Message']);
				$('#sentlabcompleted').show();
			}
			$('#sentlabprocessing').hide();
			$('#autosenttolab').show();
		}
	});
}

$('.phone').keypress(function(event){

       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
           event.preventDefault(); //stop character from entering input
       }

   });
   
function submit_ticket(){
	var healthId = $('#HealthRequestId').val();
	
	$data = $('#form10').serialize();
	var error=0;
	if($("#TicketTicketSampleDate1").val() == '')
	{
		$("#ticket_sample_date1_error").html("Specify Correct date");
		error++;
	}
	else
		$("#ticket_sample_date1_error").html("");
		
	if($("#TicketTickettitle").val() == '')
	{
		$("#tickettitle_error").html("Title cannot be empty");
		error++;
	}
	else
		$("#tickettitle_error").html("");
		
	if($("#TicketConcernRaised").val() == '')
	{
		$("#ticket_concern_error").html("Raised By cannot be empty");
		error++;
	}
	else
		$("#ticket_concern_error").html("");
		
	if($("#TicketEmail").val() == '')
	{
		$("#ticket_email_error").html("Email cannot be empty");
		error++;
	}
	else
		$("#ticket_email_error").html("");
	
	if($("#TicketPhone").val() == '')
	{
		$("#ticket_phone_error").html("Phone Number cannot be empty");
		error++;
	}
	else
		$("#ticket_phone_error").html("");
	
	if($("#TicketDescription").val()=='')
	{
		$("#ticket_description_error").html("description cannot be empty");
		error++;
	}
	else
		$("#ticket_description_error").html("");
	console.log(error);
	if(error==0)
	{
		return true;
	}
	else{
		return false;
	}
}


function autosenttolab(){
	var healthId = $('#HealthRequestId').val();
	$('#autostl').hide();
	$('#senttolabprocessing').show();
	$.ajax({
		type:'POST',
		url:siteUrl+'admin/samples/autostl',
		data : {
			id : healthId,
		},
		success:function(result){
			console.log(result);
			if(result != "Failed")
			{
				$('#senttolabcompleted').show();
				$('#save_sample').html(result);
			}
			$('#autostl').show();
			$('#senttolabprocessing').hide();
		}
	});
}

function getlabregisid(){
	var healthId = $('#HealthRequestId').val();
	$('#senttolabform').hide();
	$('#labprocessing').show();
	$.ajax({
		type:'POST',
		url:siteUrl+'admin/samples/senttolab',
		data : {
			id : healthId,
		},
		success:function(result){
			var json_data = JSON.parse(result);
			console.log(json_data);
			$('#ref_num').val(json_data.id);
			$('#senttolabform').show();
			$('#labcompleted').show();
			$('#labprocessing').hide();
		}
	});
}

function show_print_reciept(id,request_id)
{
	var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

	var print_reciept = document.getElementById('print_reciept');
	var print_order_id = document.getElementById('print_order_id').value;
	var print_request_id = document.getElementById('print_request_id').value;
	print_reciept.href = siteUrl+'tests/print_user_receipt_new/'+Base64.encode(print_order_id)+'/'+Base64.encode(print_request_id);
}

$( document ).ready(function() {
    $(".cancel_reason_select").change(function(){
        if($(this).val() == 'custom')
            $("#HealthCancelledReasonCustom").show();
        else
            $("#HealthCancelledReasonCustom").hide();
    });
});
</script>

<?php echo $javascript->link('light/jquery.lightbox_me') ?>
<?php echo $javascript->link('light/slider') ?>
