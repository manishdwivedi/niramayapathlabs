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
									rep_div +='<div style="float:left; width:80px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Test.mrp+'</div>';
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
							rep_div +='<div style="float: left; height: 195px; overflow-x: hidden; margin:0 0 0 25px; width:495px;">';
							
							rep_div +='<div style="float:left; margin:10px 0 0 0; clear:both;">';
							rep_div +='<div style="font-weight:bold; float:left; width:50px; text-align:center; border:1px solid #D9D9D9; height:20px; padding:10px;">Select</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:285px; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9;  height:20px; padding:10px;">Package Description</div>';
							rep_div +='<div style="font-weight:bold; float:left; width:63px; text-align:center; border-top:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; height:20px; padding:10px;">Mrp</div>';
							rep_div +='</div>';
							if(data.test_info.search_test.length != 0)
							{
								var selected_tests_final = data.test_info.selected_tests_req;
								var sell_test = selected_tests_final.split(',');
								jQuery.each(data.test_info.search_test,function(index, value)
								{
									if(sell_test[0] == value.Package.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_name+'</div>';
										rep_div +='<div style="float:left; width:63px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
										rep_div +='</div>';
									}
									if(sell_test[1] == value.Package.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_name+'</div>';
										rep_div +='<div style="float:left; width:63px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
										rep_div +='</div>';
									}
									if(sell_test[2] == value.Package.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_name+'</div>';
										rep_div +='<div style="float:left; width:63px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
										rep_div +='</div>';
									}
									if(sell_test[3] == value.Package.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_name+'</div>';
										rep_div +='<div style="float:left; width:63px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
										rep_div +='</div>';
									}
									if(sell_test[4] == value.Package.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_name+'</div>';
										rep_div +='<div style="float:left; width:63px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
										rep_div +='</div>';
									}
									if(sell_test[5] == value.Package.id)
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" checked="checked" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_name+'</div>';
										rep_div +='<div style="float:left; width:63px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
										rep_div +='</div>';
									}
									else
									{
										rep_div +='<div style="float:left; clear:both;">';
										rep_div +='<div style="float:left; width:50px; text-align:center; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;"><input type="checkbox" value="'+value.Package.package_mrp+'" onclick="add_package('+value.Package.id+');" id="PackageCheck'+value.Package.id+'" /></div>';
										rep_div +='<div style="float:left; width:285px; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">'+value.Package.package_name+'</div>';
										rep_div +='<div style="float:left; width:63px; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
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

function payment_submit()
{
	document.forms["form2"].submit();
}

function report_submit()
{
	document.forms["form3"].submit();
}

function submit_form_process()
{
	document.forms["form5"].submit();
}

function submit_form_reschdule()
{
	document.forms["form6"].submit();
}

function submit_sent()
{
	document.forms["form7"].submit();
}

function submit_closededed()
{
	document.forms["form1121"].submit();
}



function show_payment()
{
	$('#updatePayStatus').show();
	$('#uploadReport').hide();
	$('#editDetails').hide();
	$('#ProcessRequest').hide();
	$('#ProcessCancel').hide();
	$('#SampleRegister').hide();
	$('#SentLab').hide();
	$('#ActiveLog').hide();
	           $('#PatientVital').hide();
}

function show_up_report()
{
	$('#uploadReport').show();
	$('#updatePayStatus').hide();
	$('#editDetails').hide();
	$('#ProcessRequest').hide();
	$('#ProcessCancel').hide();
	$('#SampleRegister').hide();
	$('#SentLab').hide();
	$('#ActiveLog').hide();
	           $('#PatientVital').hide();
}

function show_edit()
{
	$('#editDetails').show();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#ProcessRequest').hide();
	$('#ProcessCancel').hide();
	$('#SampleRegister').hide();
	$('#SentLab').hide();
	$('#ActiveLog').hide();
	           $('#PatientVital').hide();
}

function show_form()
{
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
}

function active_log()
{
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
	
}



function show_cancel()
{
	$('#ProcessCancel').show();
	$('#ProcessRequest').hide();
	$('#editDetails').hide();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#SampleRegister').hide();
	$('#SentLab').hide();
	$('#ActiveLog').hide();
	           $('#PatientVital').hide();
}

function sample_register(val)
{
	if(val == 1)
	{
		$('#SampleRegister').show();
		$('#ProcessCancel').hide();
		$('#ProcessRequest').show();
		$('#editDetails').hide();
		$('#updatePayStatus').hide();
		$('#uploadReport').hide();
		$('#SentLab').hide();
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
		
		$('#SampleRegister').hide();
		$('#ProcessCancel').hide();
		$('#ProcessRequest').show();
		$('#editDetails').hide();
		$('#updatePayStatus').hide();
		$('#uploadReport').hide();
		$('#SentLab').hide();
	}
}

function sent_lab()
{
	$('#SentLab').show();
	$('#SampleRegister').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#editDetails').hide();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#ActiveLog').hide();
	           $('#PatientVital').hide();
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
		//minDate: 0,
		//maxDate: '+6M',
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker2" ).datepicker({
		//minDate: 0,
		//maxDate: '+6M',
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker3" ).datepicker({
		//minDate: 0,
		//maxDate: '+6M',
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker4" ).datepicker({
		//minDate: 0,
		//maxDate: '+6M',
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
			}
		},
		beforeSend:function(){
			jQuery('#ConfirmFinalPackage').show();
		},
		
	});
}

function delete_single_profile(val1,val2)
{
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
	var all_tests = document.getElementById('HealthTestId').value;
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
	var all_tests = document.getElementById('HealthTestId').value;
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
<?php if($this->data['Health']['cancelled_status'] == 1){?>
$(document).ready(function() {
	$('#CancelRow').show();
});
<?php }?>
</script>
<div id="signup-Div"> <a id="close-one" class="close" href="javascript:void(0);" onClick="hide_test();"><?php echo $html->image('close-one.jpg');?></a>
	<div id="TestList"></div>
	<div id="TestProcessNew" style="display:none;"><?php echo $html->image('frontend/loading.gif',array('style'=>'top:190px; left:265px; position:absolute;'));?></div>
</div>
<div id="signup-Div-Profile"> <a id="close-one" class="close" href="javascript:void(0);" onClick="hide_profile();"><?php echo $html->image('close-one.jpg');?></a>
	<div id="ProfileList"></div>
	<div id="ProfileProcessNew" style="display:none;"><?php echo $html->image('frontend/loading.gif',array('style'=>'top:190px; left:265px; position:absolute;'));?></div>
</div>
<div id="signup-Div-Offer"> <a id="close-one" class="close" href="javascript:void(0);" onClick="hide_offer();"><?php echo $html->image('close-one.jpg');?></a>
	<div id="OfferList"></div>
	<div id="OfferProcessNew" style="display:none;"><?php echo $html->image('frontend/loading.gif',array('style'=>'top:190px; left:265px; position:absolute;'));?></div>
</div>
<div id="signup-Div-Package"> <a id="close-one" class="close" href="javascript:void(0);" onClick="hide_package();"><?php echo $html->image('close-one.jpg');?></a>
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
		<td width="15%" class="boldText">Contact</td>
		<td><?php echo $this->data['Health']['contact'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Email</td>
		<td><a href="mailto:<?php echo $this->data['Health']['email'];?>"><?php echo $this->data['Health']['email'];?></a></td>
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
	<?php if($this->data['Health']['home_report'] != 0) {?>
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
			<input type="radio" name="data[Refund][status]" value="1" id="RefundStatus1" onClick="show_update_span();" />&nbsp;Refunded&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="data[Refund][status]" value="0" checked="checked" />&nbsp;Not Refunded&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="display:none;" id="UpdateSpan"><a href="javascript:void(0);" onClick="update_refund('<?php //echo $this->data['Health']['id']?>');" style="color:#0033FF;">Update</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
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
	<?php if($this->data['Health']['discount_id'] != 0) {?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Discount Information</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Discount Code</td>
		<td><?php echo $this->data['Health']['discount_code'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Discount Amount</td>
		<td><?php echo $this->data['Health']['discount_amt'];?></td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Description</td>
		<td><?php echo $this->data['Health']['discount_info'];?></td>
	</tr>
	<?php }?>
	<?php if($this->data['Health']['discount_amount'] != 0) {?>
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
	<?php }?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Net Payble Amount</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Net Payble Amount</td>
		<td><?php echo 'Rs. '.$this->data['Health']['test_amt'];?></td>
	</tr>
	<?php if(!empty($this->data['Health']['receive_tracks'])) {?>
	<?php $k = 1;foreach($this->data['Health']['receive_tracks'] as $key => $val) {?>
	<tr>
		<td width="15%" class="boldText">Installment <?php echo $k;?></td>
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
		<td>
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
			<?php echo 'Rs. '.$val['Paytrack']['pay_install'].' received as a BTC/Process Without Pay by '.$val['Paytrack']['admin_receive_name'].' on '.date('d-m-Y',strtotime($val['Paytrack']['admin_receive_date']));?>
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
	<?php if($this->data['Health']['register_sample'] != 0 && $this->data['Health']['sent_pathcorp_admin'] != 0) {?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Request Information</td>
	</tr>
	
	<tr>
		<td width="15%" class="boldText">Sent to Lab</td>
		<td>Request sent to lab by <span style="font-weight:bold;"><?php echo $this->data['Health']['sent_pathcorp_admin_name'];?></span> on <span style="font-weight:bold;"><?php echo $this->data['Health']['sent_pathcorp_date'];?></span></td>
	</tr>
	<?php }?>
	
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
		<td><?php echo nl2br($this->data['Health']['home_collect_locality']);?></td>
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
	<?php }?>
	<script type="text/javascript">
		function print_detail(val1)
		{
			window.open('<?php echo SITE_URL;?>admin/samples/print_detail/'+val1,'name','height=500,width=600,scrollbars=yes');
		}
	</script>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<?php if($this->data['Health']['requ_status'] == 9){?>
	<td colspan="2">
	<a href="javascript:void(0);" onclick="print_detail('<?php echo $this->data['Health']['id'];?>');" style="text-decoration:none;"><?php echo $form->submit('Print Detail', array('div'=>false, 'class' => 'btn')); ?></a>
	</td>
	<?php }?>
	<?php if($this->data['Health']['requ_status'] != 9){?>
	<tr>
		<td colspan="2">
			<?php if($this->Session->read('Admin.userType') == 'A' && $this->data['Health']['sent_to_lab_action'] == '9' ) { } else {?>
			<?php echo $form->submit('Edit Request', array('div'=>false, 'class' => 'btn','onclick'=>'show_edit();')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php }?>
			<?php echo $form->submit('Cancelled Request', array('div'=>false, 'class' => 'btn','onclick'=>'show_cancel();')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php //echo $form->submit('Sample Process', array('div'=>false, 'class' => 'btn','onclick'=>'show_form();')); ?><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
			<?php echo $form->submit('Patient Vital', array('div'=>false, 'class' => 'btn','onclick'=>'patient_vital();')); ?>&nbsp;&nbsp;&nbsp;
			<?php if($this->data['Health']['sent_to_lab_action'] == 'Yes') {?>
			<?php echo $form->submit('Sent to Lab', array('div'=>false, 'class' => 'btn','onclick'=>'sent_lab();')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php }?>
			<?php echo $form->submit('Payment Status', array('div'=>false, 'class' => 'btn','onclick'=>'show_payment();')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
			
			<?php echo $form->submit('Activity Log', array('div'=>false, 'class' => 'btn','onclick'=>'active_log();')); ?>&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0);" onclick="print_detail('<?php echo $this->data['Health']['id'];?>');" style="text-decoration:none;"><?php echo $form->submit('Print Detail', array('div'=>false, 'class' => 'btn')); ?></a>
		</td>
	</tr>
	<?php }?>
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
	
	<tr id="ActiveLog" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/active_log/'.base64_encode($this->data['Health']['id']),'id'=>'form1121','name'=>'form1121'));?>
			<?php echo $form->hidden('Health.login_action',array('value'=>'Super'));?>
			<?php echo $form->hidden('Health.bmi_id',array('value'=>$this->data['Health']['vital_save_id']));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Activity Log</h2></td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Last Edited Name</td>
					<td><?php echo $this->data['Health']['last_edited'];?></td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Date&Time</td>
					<td><?php echo $this->data['Health']['last_edited_date'];?></td>
				</tr>
				<tr>
					
				<tr>
					<td>&nbsp;</td>
					<td><?php //echo $form->submit('Submit', array('div'=>false, 'class' => 'btn','onclick'=>'submit_closededed();')); ?></td>
				</tr>
			</table>
			<?php echo $form->end();?>
		</td>
	</tr>
	
	
	
	<tr id="SentLab" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/sent_lab/'.base64_encode($this->data['Health']['id']),'id'=>'form7','name'=>'form7'));?>
			<?php echo $form->hidden('Health.request_id',array('value'=>$this->data['Health']['id']));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Sent To Lab</h2></td>
				</tr>
				<?php if($this->data['Health']['dup_entry'] == 'Yes') {?>
				<tr>
					<td colspan="4" style="color:#FF0000; font-weight:bold;">Please enter unique Lab Test Registration NO. previous one is duplicate.</td>
				</tr>
				<?php }?>
				<tr>
					<td style="font-weight:bold; width:10px;">1)</td>
					<td style="width:150px;">Lab Test Registration NO.</td>
					<td colspan="4">
					<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
						<?php echo $form->text('Health.ref_num',array('class'=>'input-text','value'=>$this->data['Health']['ref_num'],'readonly'=>'readonly'));?>
					<?php } else {?>
						<?php if(!empty($this->data['Health']['ref_num'])) {?>
						<?php echo $form->text('Health.ref_num',array('class'=>'input-text','value'=>$this->data['Health']['ref_num']));?>
						<?php } else {?>
						<?php echo $form->text('Health.ref_num',array('class'=>'input-text'));?>
						<?php }?>
					<?php }?>
					</td>
				</tr>
				<tr>
					<td style="font-weight:bold; width:10px;">2)</td>
					<td style="width:135px;">Sent to Lab</td>
					<td style="width:55px;"><input type="radio" name="data[Health][sent_pathcorp]" value="1" <?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;Yes</td>
					<td><input type="radio" name="data[Health][sent_pathcorp]" value="0" <?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?> checked="checked" <?php }?> />&nbsp;&nbsp;No</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo $form->submit('Sent to Lab', array('div'=>false, 'class' => 'btn','onclick'=>'submit_sent();')); ?></td>
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
					<td colspan="2"><?php echo $form->textarea('Health.cancelled_reason',array('class'=>'input-text','rows'=>5,'cols'=>30,'style'=>'font-size:12px;'));?></td>
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
								<<!--td><?php echo $this->data['Health']['visit_lab_collect_date'];?></td>-->
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
									<?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?>
										<?php if(!empty($vial_entry)) {?>
											<?php echo $form->text('Health.col1',array('class'=>'input-text','value'=>$vial_enter['Health']['col1']));?>
										<?php } else {?>
											<?php if($this->data['Health']['col1'] == 'no') {?>
												<?php echo $form->text('Health.col1',array('class'=>'input-text','value'=>''));?>
											<?php } else {?>
												<?php echo $form->text('Health.col1',array('class'=>'input-text'));?>
											<?php }?>
										<?php }?>
									<?php }?>
									<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
										<?php if($this->data['Health']['col1'] == 'no') {?>
											<?php echo $form->text('Health.col1',array('class'=>'input-text','readonly'=>'readonly','value'=>''));?>
										<?php } else {?>
											<?php echo $form->text('Health.col1',array('class'=>'input-text','readonly'=>'readonly'));?>
										<?php }?>
									<?php }?>
								</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?>
										<?php if(!empty($vial_entry)) {?>
											<?php echo $form->text('Health.remark1',array('class'=>'input-text','value'=>$vial_enter['Health']['remark1']));?>
										<?php } else {?>
											<?php echo $form->text('Health.remark1',array('class'=>'input-text'));?>
										<?php }?>
									<?php }?>
									<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
										<?php echo $form->text('Health.remark1',array('class'=>'input-text','readonly'=>'readonly'));?>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">b)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">EDTA</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?>
										<?php if(!empty($vial_entry)) {?>
											<?php echo $form->text('Health.col2',array('class'=>'input-text','value'=>$vial_enter['Health']['col2']));?>
										<?php } else {?>
											<?php if($this->data['Health']['col2'] == 'no') {?>
												<?php echo $form->text('Health.col2',array('class'=>'input-text','value'=>''));?>
											<?php } else {?>
												<?php echo $form->text('Health.col2',array('class'=>'input-text'));?>
											<?php }?>
										<?php }?>
									<?php }?>
									<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
										<?php if($this->data['Health']['col2'] == 'no') {?>
											<?php echo $form->text('Health.col2',array('class'=>'input-text','readonly'=>'readonly','value'=>''));?>
										<?php } else {?>
											<?php echo $form->text('Health.col2',array('class'=>'input-text','readonly'=>'readonly'));?>
										<?php }?>
									<?php }?>
								</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?>
										<?php if(!empty($vial_entry)) {?>
											<?php echo $form->text('Health.remark2',array('class'=>'input-text','value'=>$vial_enter['Health']['remark2']));?>
										<?php } else {?>
											<?php echo $form->text('Health.remark2',array('class'=>'input-text'));?>
										<?php }?>
									<?php }?>
									<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
										<?php echo $form->text('Health.remark2',array('class'=>'input-text','readonly'=>'readonly'));?>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">c)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">Sodium Floride (F)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?>
										<?php if(!empty($vial_entry)) {?>
											<?php echo $form->text('Health.col3',array('class'=>'input-text','value'=>$vial_enter['Health']['col3']));?>
										<?php } else {?>
											<?php if($this->data['Health']['col3'] == 'no') {?>
												<?php echo $form->text('Health.col3',array('class'=>'input-text','value'=>''));?>
											<?php } else {?>
												<?php echo $form->text('Health.col3',array('class'=>'input-text'));?>
											<?php }?>
										<?php }?>
									<?php }?>
									<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
										<?php if($this->data['Health']['col3'] == 'no') {?>
											<?php echo $form->text('Health.col3',array('class'=>'input-text','readonly'=>'readonly','value'=>''));?>
										<?php } else {?>
											<?php echo $form->text('Health.col3',array('class'=>'input-text','readonly'=>'readonly'));?>
										<?php }?>
									<?php }?>
								</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?>
										<?php if(!empty($vial_entry)) {?>
											<?php echo $form->text('Health.remark3',array('class'=>'input-text','value'=>$vial_enter['Health']['remark3']));?>
										<?php } else {?>
											<?php echo $form->text('Health.remark3',array('class'=>'input-text'));?>
										<?php }?>
									<?php }?>
									<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
										<?php echo $form->text('Health.remark3',array('class'=>'input-text','readonly'=>'readonly'));?>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">d)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">Sodium Floride (PP/Random)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?>
										<?php if(!empty($vial_entry)) {?>
											<?php echo $form->text('Health.col4',array('class'=>'input-text','value'=>$vial_enter['Health']['col4']));?>
										<?php } else {?>
											<?php if($this->data['Health']['col4'] == 'no') {?>
												<?php echo $form->text('Health.col4',array('class'=>'input-text','value'=>''));?>
											<?php } else {?>
												<?php echo $form->text('Health.col4',array('class'=>'input-text'));?>
											<?php }?>
										<?php }?>
									<?php }?>
									<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
										<?php if($this->data['Health']['col4'] == 'no') {?>
											<?php echo $form->text('Health.col4',array('class'=>'input-text','readonly'=>'readonly','value'=>''));?>
										<?php } else {?>
											<?php echo $form->text('Health.col4',array('class'=>'input-text','readonly'=>'readonly'));?>
										<?php }?>
									<?php }?>
								</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?>
										<?php if(!empty($vial_entry)) {?>
											<?php echo $form->text('Health.remark4',array('class'=>'input-text','value'=>$vial_enter['Health']['remark4']));?>
										<?php } else {?>
											<?php echo $form->text('Health.remark4',array('class'=>'input-text'));?>
										<?php }?>
									<?php }?>
									<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
										<?php echo $form->text('Health.remark4',array('class'=>'input-text','readonly'=>'readonly'));?>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">e)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">Urine</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?>
										<?php if(!empty($vial_entry)) {?>
											<?php echo $form->text('Health.col5',array('class'=>'input-text','value'=>$vial_enter['Health']['col5']));?>
										<?php } else {?>
											<?php if($this->data['Health']['col5'] == 'no') {?>
												<?php echo $form->text('Health.col5',array('class'=>'input-text','value'=>''));?>
											<?php } else {?>
												<?php echo $form->text('Health.col5',array('class'=>'input-text'));?>
											<?php }?>
										<?php }?>
									<?php }?>
									<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
										<?php if($this->data['Health']['col5'] == 'no') {?>
											<?php echo $form->text('Health.col5',array('class'=>'input-text','readonly'=>'readonly','value'=>''));?>
										<?php } else {?>
											<?php echo $form->text('Health.col5',array('class'=>'input-text','readonly'=>'readonly'));?>
										<?php }?>
									<?php }?>
								</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?>
										<?php if(!empty($vial_entry)) {?>
											<?php echo $form->text('Health.remark5',array('class'=>'input-text','value'=>$vial_enter['Health']['remark5']));?>
										<?php } else {?>
											<?php echo $form->text('Health.remark5',array('class'=>'input-text'));?>
										<?php }?>
									<?php }?>
									<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
										<?php echo $form->text('Health.remark5',array('class'=>'input-text','readonly'=>'readonly'));?>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">f)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">Other1</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?>
										<?php if(!empty($vial_entry)) {?>
											<?php echo $form->text('Health.col6',array('class'=>'input-text','value'=>$vial_enter['Health']['col6']));?>
										<?php } else {?>
											<?php if($this->data['Health']['col6'] == 'no') {?>
												<?php echo $form->text('Health.col6',array('class'=>'input-text','value'=>''));?>
											<?php } else {?>
												<?php echo $form->text('Health.col6',array('class'=>'input-text'));?>
											<?php }?>
										<?php }?>
									<?php }?>
									<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
										<?php if($this->data['Health']['col6'] == 'no') {?>
											<?php echo $form->text('Health.col6',array('class'=>'input-text','readonly'=>'readonly','value'=>''));?>
										<?php } else {?>
											<?php echo $form->text('Health.col6',array('class'=>'input-text','readonly'=>'readonly'));?>
										<?php }?>
									<?php }?>
								</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?>
										<?php if(!empty($vial_entry)) {?>
											<?php echo $form->text('Health.remark6',array('class'=>'input-text','value'=>$vial_enter['Health']['remark6']));?>
										<?php } else {?>
											<?php echo $form->text('Health.remark6',array('class'=>'input-text'));?>
										<?php }?>
									<?php }?>
									<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
										<?php echo $form->text('Health.remark6',array('class'=>'input-text','readonly'=>'readonly'));?>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td style="font-weight:bold; border-left:1px solid #D9D9D9; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">g)</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">Other2</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?>
										<?php if(!empty($vial_entry)) {?>
											<?php echo $form->text('Health.col7',array('class'=>'input-text','value'=>$vial_enter['Health']['col7']));?>
										<?php } else {?>
											<?php if($this->data['Health']['col7'] == 'no') {?>
												<?php echo $form->text('Health.col7',array('class'=>'input-text','value'=>''));?>
											<?php } else {?>
												<?php echo $form->text('Health.col7',array('class'=>'input-text'));?>
											<?php }?>
										<?php }?>
									<?php }?>
									<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
										<?php if($this->data['Health']['col7'] == 'no') {?>
											<?php echo $form->text('Health.col7',array('class'=>'input-text','readonly'=>'readonly','value'=>''));?>
										<?php } else {?>
											<?php echo $form->text('Health.col7',array('class'=>'input-text','readonly'=>'readonly'));?>
										<?php }?>
									<?php }?>
								</td>
								<td style="border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; text-align:center;">
									<?php if($this->data['Health']['sent_pathcorp_admin'] == 0) {?>
										<?php if(!empty($vial_entry)) {?>
											<?php echo $form->text('Health.remark7',array('class'=>'input-text','value'=>$vial_enter['Health']['remark7']));?>
										<?php } else {?>
											<?php echo $form->text('Health.remark7',array('class'=>'input-text'));?>
										<?php }?>
									<?php }?>
									<?php if($this->data['Health']['sent_pathcorp_admin'] != 0) {?>
										<?php echo $form->text('Health.remark7',array('class'=>'input-text','readonly'=>'readonly'));?>
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
	<?php echo $form->create(array('url'=>'/admin/samples/view_patient_details/'.base64_encode($this->data['Health']['id']),'id'=>'form1','name'=>'form1'));?>
	<?php echo $form->hidden('Health.id',array('value'=>$this->data['Health']['id']));?>
	<?php echo $form->hidden('Health.pay_status',array('value'=>$this->data['Health']['pay_status']));?>
	<?php echo $form->hidden('Health.patient_report',array('value'=>$this->data['Health']['patient_report']));?>
	<?php echo $form->hidden('Health.old_home_report',array('value'=>$this->data['Health']['home_report']));?>
	<tr id="editDetails" style="display:none;">
		<td colspan="2">
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="2"><h2>Update Details</h2></td>
				</tr>
				
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
				
				<tr style="display:none;" id="t_f_a_t_p_o_r">
					<td width="15%" class="boldText">Total Amount</td>
					<td id="t_f_a_t_p_o"></td>
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
				<tr>
					<td width="15%" class="boldText">Search Tests</td>
					<td>
						<div style="float:left;">
							<div style="float:left;"><?php echo $form->text('Health.search_test',array('class'=>'input-text','placeholder'=>'Search Test'));?></div>
							<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-1" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
						</div>
					</td>
				</tr>
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
				<tr>
					<td width="15%" class="boldText">Search Profile</td>
					<td>
						<div style="float:left;">
							<div style="float:left;"><?php echo $form->text('Health.search_profile',array('class'=>'input-text','placeholder'=>'Search Profile'));?></div>
							<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-2" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
						</div>
					</td>
				</tr>
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
				<tr>
					<td width="15%" class="boldText">Search Offer</td>
					<td>
						<div style="float:left;">
							<div style="float:left;"><?php echo $form->text('Health.search_offer',array('class'=>'input-text','placeholder'=>'Search Offer'));?></div>
							<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-3" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
						</div>
					</td>
				</tr>
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
				<tr>
					<td width="15%" class="boldText">Search Package</td>
					<td>
						<div style="float:left;">
							<div style="float:left;"><?php echo $form->text('Health.search_package',array('class'=>'input-text','placeholder'=>'Search Package'));?></div>
							<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-4" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
						</div>
					</td>
				</tr>
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
				<tr>
					<td width="15%" class="boldText">Search Patient Care Services</td>
					<td>
						<div style="float:left;">
							<div style="float:left;"><?php echo $form->text('Health.search_service',array('class'=>'input-text','placeholder'=>'Search Patient Care Services'));?></div>
							<div style="float:left; width:100px; text-align:center; font-size:20px; margin:5px 0 0 0;"><a href="javascript:void(0);" id="try-5" style="color:#0066CC; text-decoration:underline;"><?php echo $html->image('frontend/go.png',array('width'=>30,'height'=>30));?></a></div>
						</div>
					</td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Referred By</td>
					<td>
						<?php echo $form->text('Health.remark', array('class'=>'input-text','value'=>$this->data['Health']['remark'])); ?>
					</td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Discount Code</td>
					<td>
						<?php echo $form->text('Health.discount_code', array('class'=>'input-text','value'=>$this->data['Health']['discount_code'],'style'=>'width:100px;')); ?>
					</td>
				</tr>
				<tr>
					<td width="15%" class="boldText">Discount Amount</td>
					<td>
						<?php echo $form->text('Health.discount_amount', array('class'=>'input-text','value'=>$this->data['Health']['discount_amount'],'style'=>'width:100px;')); ?>
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
							<input type="radio" name="opt" id="visit" value="1" onClick="show_lab(this.value);" checked="checked" />Visit a Lab<br />
						<?php } else {?>
							<input type="radio" name="opt" id="visit" value="1" onClick="show_lab(this.value);" />Visit a Lab<br />
						<?php }?>
						<?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date']) && !empty($this->data['Health']['home_collect_address'])) {?>	
							<input type="radio" name="opt" id="home" value="2" onClick="show_lab(this.value);" checked="checked" />Home Collection<br />
						<?php } else {?>
							<input type="radio" name="opt" id="home" value="2" onClick="show_lab(this.value);" />Home Collection<br />
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
						<?php echo $form->text('Health.sample_date', array('class'=>'input-text datepicker2','style'=>'width:100px;','value'=>$this->data['Health']['visit_lab_collect_date'])); ?>
					</td>
				</tr>
				
				
				<tr id="home_collection_1" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?> >
					<td width="15%" class="boldText">&nbsp;</td>
					<td>Please select a date and time for Collection of Sample. Our representative will come to the address mention above.</td>
				</tr>
				<tr id="home_collection_2" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?> >
					<td width="15%" class="boldText">Time</td>
					<td>
						<select name="data[Health][sample_time1]" id="HealthSampleTime1" class="input-text">
							<option value="">Select Test</option>
							<?php foreach($timelabs as $key => $val) {?>
							<option value="<?php echo $val['Timelab']['id'];?>" <?php if($this->data['Health']['home_collect_time'] == $val['Timelab']['name']) {?> selected="selected" <?php }?>><?php echo $val['Timelab']['name'];?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr id="home_collection_3" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?> >
					<td width="15%" class="boldText">Sample Collect Date</td>
					<td>
						<?php echo $form->text('Health.sample_date1', array('class'=>'input-text datepicker','style'=>'width:100px;','value'=>$this->data['Health']['home_collect_date'])); ?>
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
				<tr id="home_collection_6" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?>>
					<td width="15%" class="boldText">Locality</td>
					<td>
						<?php echo $form->text('Health.home_locality', array('class'=>'input-text','value'=>$this->data['Health']['home_collect_locality'])); ?>
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
				<tr id="home_collection_9" <?php if(!empty($this->data['Health']['home_collect_time']) && !empty($this->data['Health']['home_collect_date'])) {?> style="" <?php } else {?> style="display:none;" <?php }?>>
					<td width="15%" class="boldText">Pincode</td>
					<td>
						<?php echo $form->text('Health.home_pincode', array('class'=>'input-text','value'=>$this->data['Health']['home_collect_pincode'])); ?>
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
						<a onClick="javascript:window.history.go(-1)" class="btn" style="color:#FFFFFF;">Cancel</a>
					</td>
				</tr>-->
				<tr>
					<td><?php echo $form->submit('Update', array('div'=>false, 'class' => 'btn')); ?></td>
				</tr>
			</table>
		</td>
	</tr>	
	<?php echo $form->end();?>
	
	<?php echo $form->create(array('url'=>'/admin/samples/update_payment','id'=>'form2','name'=>'form2'));?>
	<?php echo $form->hidden('Health.id',array('value'=>$this->data['Health']['id']));?>
	<?php echo $form->hidden('Health.action_url',array('value'=>'admin_view_patient_details'));?>
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
										<option value="cash" selected="selected">Cash</option>
										<option value="credit_card">Credit Card</option>
										<option value="cheque">Cheque/DD</option>
										<option value="adjust">Adj/Refund</option>
										<option value="btc">BTC/Process Without Pay</option>
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
								<td width="25%" style="font-weight:bold;">Received Amount</td>
								<td>
									Rs. <?php echo $this->data['Health']['rec_ins_amt'];?>
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
								<td>Rs. <?php echo $form->text('Health.adj_amt',array('value'=>'0','class'=>'input-text','style'=>'width:100px;','readonly'=>'readonly'));?></td>
							</tr>
							<tr id="BtcRsn" style="display:none;">
								<td width="30%" style="font-weight:bold;">Reason</td>
								<td><?php echo $form->textarea('Health.btc_rsn',array('value'=>'','class'=>'input-text','cols'=>30,'rows'=>5,'style'=>'font-size:12px;'));?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><a href="javascript:void(0);" onclick="preview_payment();">Preview</a></td>
							</tr>
						</table>
					</td>
					<td id="PreviewPayment" style="display:none; vertical-align:top;">
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
								<td colspan="2"><?php echo $form->submit('Save & Submit', array('div'=>false, 'class' => 'btn','onclick'=>'payment_submit();')); ?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>	
	<?php echo $form->end();?>
	<script type="text/javascript">
	function open_tr(val)
	{
		if(val == 'cash')
		{
			$('#CC').hide();
			$('#CQ').hide();
			$('#AdjPay').hide();
			$('#PayRec').show();
			$('#AdjRsn').hide();
			$('#BtcPay').hide();
			$('#BtcRsn').hide();
		}
		if(val == 'credit_card')
		{
			$('#CC').show();
			$('#CQ').hide();
			$('#AdjPay').hide();
			$('#PayRec').show();
			$('#AdjRsn').hide();
			$('#BtcPay').hide();
			$('#BtcRsn').hide();
		}
		if(val == 'cheque')
		{
			$('#CQ').show();
			$('#CC').hide();
			$('#AdjPay').hide();
			$('#PayRec').show();
			$('#AdjRsn').hide();
			$('#BtcPay').hide();
			$('#BtcRsn').hide();
		}
		if(val == 'adjust')
		{
			$('#AdjPay').show();
			$('#AdjRsn').show();
			$('#PayRec').hide();
			$('#CQ').hide();
			$('#CC').hide();
			$('#BtcPay').hide();
			$('#BtcRsn').hide();
		}
		if(val == 'btc')
		{
			$('#AdjPay').hide();
			$('#AdjRsn').hide();
			$('#PayRec').hide();
			$('#CQ').hide();
			$('#CC').hide();
			$('#BtcPay').show();
			$('#BtcRsn').show();
		}
	}
	
	function preview_payment()
	{
		
		var row_1 = parseInt(document.getElementById('HealthTotalAmt').value);
		var row_2 = parseInt(document.getElementById('HealthReceiveAmt').value);
		var row_3 = parseInt(document.getElementById('HealthBalAmt').value);
		<?php if($this->data['Health']['balance_refund'] == 0) {?>
		var row_4 = parseInt(document.getElementById('HealthPayAmt').value);
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
			
			$('#TAMT').html(rep_div_1);
			$('#RAMT').html(rep_div_2);
			$('#PreviewPayment').show();
			$('#updatePayStatus').show();
		}
	}
	</script>
	
	<?php echo $form->create(array('url'=>'/admin/samples/upload_report','id'=>'form3','name'=>'form3','enctype'=>'multipart/form-data','onsubmit'=>'return validationc_report(this);'));?>
	<?php echo $form->hidden('Health.id',array('value'=>$this->data['Health']['id']));?>
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
					<td width="15%" class="boldText">Upload Report</td>
					<td>
						<?php echo $form->file('Health.patient_report',array('class'=>'input-text'));?>
						<div id="msg1_1" style="color:#FF0000; font-size:12px; clear:both;"></div>
					</td>
				</tr>
				<tr>
					<td><?php echo $form->submit('Upload', array('div'=>false, 'class' => 'btn','onclick'=>'report_submit();')); ?></td>
				</tr>
			</table>
		</td>
	</tr>	
	<?php echo $form->end();?>
</table>

</div>

<?php echo $javascript->link('light/jquery.lightbox_me') ?>
<?php echo $javascript->link('light/slider') ?>