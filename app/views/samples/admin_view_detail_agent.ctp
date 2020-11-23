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
</script>
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
										rep_div +='<div style="float:left; width:63x; text-align:center; border-right:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; height:20px; padding:10px;">Rs. '+value.Package.package_mrp+'</div>';
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

function delete_single_test(val1,val2)
{
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
	var all_tests = document.getElementById('HealthProfileId').value;
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
	var all_tests = document.getElementById('HealthProfileId').value;
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
<script type="text/javascript">
function message_lab()
{
	$('#raise_ticket').hide();
	$('#LabMessage').show();
	$('#editDetails').hide();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#SampleRegister').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#SentLab').hide();
	$('#MarkClosed').hide();
	$('#ActiveLog').hide();
	 $('#PatientVital').hide();
	
	<?php if($this->data['Health']['message_status'] == 1) {?>
	$('#MessageDiv').show();
	<?php }?>
}

function show_up_report()
{
	$('#uploadReport').show();
	$('#updatePayStatus').hide();
	$('#editDetails').hide();
	$('#SampleRegister').hide();
	$('#ProcessCancel').hide();
	$('#ProcessRequest').hide();
	$('#SentLab').hide();
	$('#LabMessage').hide();
	$('#MarkClosed').hide();
	$('#ActiveLog').hide();
	 $('#PatientVital').hide();
	 $('#raise_ticket').hide();
	<?php if($this->data['Health']['published'] == 0) {?>
	$('#PublishReason').show();
	<?php }?>
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

function show_edit()
{
	$('#editDetails').show();
	$('#updatePayStatus').hide();
	$('#uploadReport').hide();
	$('#ProcessRequest').hide();
	$('#ProcessCancel').hide();
	$('#SampleRegister').hide();
	$('#SentLab').hide();
	$('#MarkClosed').hide();
	$('#ActiveLog').hide();
	 $('#PatientVital').hide();
	$('#raise_ticket').hide();
}

function report_submit()
{
	document.forms["form3"].submit();
}
function submit_message()
{
	document.forms["form12"].submit();
}
function submit_edit()
{
	document.forms["form1"].submit();
}

function submit_closed()
{
	document.forms["form9"].submit();
}

function submit_closededed()
{
	document.forms["form1121"].submit();
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
    <?php echo $html->link('Home', '/admin', array('title'=>'Home')); ?> &#187; <?php echo $html->link('Booked Request(s)', '/admin/samples/agent_view_list', array('title'=>'Home')); ?> &#187; View Sample Request
	
	
<table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">

	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="boldText">Patient Name</td>
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
	
	
	<?php if($this->data['Health']['balance_refund'] > 0) {?>
	<tr>
		<td width="15%" class="boldText">Refund Amount</td>
		<td><?php echo 'Rs. '.$this->data['Health']['balance_refund'];?><?php echo $form->hidden('Health.bal_ref',array('value'=>$this->data['Health']['balance_refund']));?></td>
	</tr>
	<?php if($this->data['Health']['refund_status'] == 0) {?>
	<tr id="RefundStat">
		<td width="15%" class="boldText">Refund Status</td>
		<td>
			<input type="radio" name="data[Refund][status]" value="1" id="RefundStatus1" onClick="show_update_span();" />&nbsp;Refunded&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="data[Refund][status]" value="0" checked="checked" />&nbsp;Not Refunded&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="display:none;" id="UpdateSpan"><a href="javascript:void(0);" onClick="update_refund('<?php echo $this->data['Health']['id']?>');" style="color:#0033FF;">Update</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			<?php echo $html->image('frontend/loading.gif',array('style'=>'height:42px; width:43px; margin:-27px 0 -14px 0; display:none;','id'=>'LoadDiv'));?>
		</td>
	</tr>
	<?php }?>
	<?php if($this->data['Health']['refund_status'] == 1) {?>
	<tr>
		<td width="15%" class="boldText">Refund Status</td>
		<td><?php echo $this->data['Health']['refund_admin_name'];?></td>
	</tr>
	<?php }?>
	
	<?php }?>
	<tr>
		<td width="15%" class="boldText">Remark</td>
		<td><?php echo $this->data['Health']['remark'];?></td>
	</tr>
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
		<td width="15%" class="boldText" colspan="2" style="text-decoration:underline;">Net Payable Amount</td>
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
		function show_cancel()
		{
			$('#ProcessCancel').show();
			$('#ProcessRequest').hide();
			$('#editDetails').hide();
			$('#updatePayStatus').hide();
			$('#uploadReport').hide();
			$('#SampleRegister').hide();
			$('#SentLab').hide();
			$('#MarkClosed').hide();
			$('#LabMessage').hide();
			$('#ActiveLog').hide();
	           $('#PatientVital').hide();
			   $('#raise_ticket').hide();
		}
		
		function closed_stat()
{
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
	$('#raise_ticket').hide();
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
	$('#raise_ticket').show();
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
	$('#raise_ticket').hide();
}

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
		
	if($("#TicketDescription").val()=='')
	{
		$("#ticket_description_error").html("description cannot be empty");
		error++;
	}
	else
		$("#ticket_description_error").html("");
	if(error==0)
	{
		return true;
	}
	else{
		return false;
	}
}

		
		
		
		
		
		
		function cancel_stat(val)
		{
			if(val == 1)
			{
				$('#CancelRow').show();
			}
			if(val == 0)
			{
				var inner_val = '';
				$('#HealthCancelledReason').val(inner_val);
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

		
		
		
		
		
		function submit_form_cancel()
		{
			document.forms["form18"].submit();
		}
		
		$( document ).ready(function() {
			<?php if($this->data['Health']['cancelled_status'] == 1) {?>
				$('#CancelRow').show();
			<?php }?>
		});
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
			<?php echo $form->submit('Edit Request', array('div'=>false, 'class' => 'btn','onclick'=>'show_edit();')); ?>&nbsp;&nbsp;&nbsp;
			<?php echo $form->submit('Patient Vital', array('div'=>false, 'class' => 'btn','onclick'=>'patient_vital();')); ?>&nbsp;&nbsp;&nbsp;
			<?php //echo $form->submit('Cancelled', array('div'=>false, 'class' => 'btn','onclick'=>'show_cancel();')); ?>&nbsp;&nbsp;&nbsp;
			<?php echo $form->submit('Request Cancelled', array('div'=>false, 'class' => 'btn','onclick'=>'show_cancel();')); ?>&nbsp;&nbsp;&nbsp;
			<?php echo $form->submit('Message From Lab', array('div'=>false, 'class' => 'btn','onclick'=>'message_lab();')); ?>&nbsp;&nbsp;&nbsp;
			<?php if($this->data['Health']['requ_status'] >= 5) {?>
			<?php echo $form->submit('Upload Report', array('div'=>false, 'class' => 'btn','onclick'=>'show_up_report();')); ?>&nbsp;&nbsp;&nbsp;
			<?php }?>
			
			
			
			<?php echo $form->submit('Activity Log', array('div'=>false, 'class' => 'btn','onclick'=>'active_log();')); ?>&nbsp;&nbsp;&nbsp;
			
			<a href="javascript:void(0);" onclick="print_detail('<?php echo $this->data['Health']['id'];?>');" style="text-decoration:none;"><?php echo $form->submit('Print Detail', array('div'=>false, 'class' => 'btn')); ?></a>
			<?php echo $form->submit('Raise Ticket', array('div'=>false, 'class' => 'btn','onclick'=>'show_raise_ticket();')); ?>&nbsp;&nbsp;&nbsp;
				<?php if($this->data['Health']['requ_status'] >= 6) {?>
			<?php echo $form->submit('Mark as closed', array('div'=>false, 'class' => 'btn','onclick'=>'closed_stat();')); ?>&nbsp;&nbsp;&nbsp;
		
				<?php }?>
				
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
	
	
	<tr id="ProcessCancel" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/cancel_reason/'.base64_encode($this->data['Health']['id']),'id'=>'form18','name'=>'form18'));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Request Cancelled</h2></td>
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
					<td>&nbsp;</td>
					<td><?php echo $form->submit('Update', array('div'=>false, 'class' => 'btn','onclick'=>'submit_form_cancel();')); ?></td>
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
	
	<tr id="raise_ticket" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/ticketsubmit/'.base64_encode($this->data['Health']['id']),'id'=>'form10','name'=>'form10','enctype'=>'multipart/form-data'));?>
			
			<?php echo $form->hidden('Health.id',array('value'=>$this->data['Health']['id']));?>
			<table border="0" width="100%">
				<tr>
					<td class="headings altheading" style="border:0;" colspan="4"><h2>Ticket</h2></td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Category</label>
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
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Date</label>
					</td>
					<td>
						<?php echo $form->text('Ticket.ticket_sample_date1', array('readonly' => 'readonly','class'=>'input-text datepicker','style'=>'width:100px;')); ?>
						<label id="ticket_sample_date1_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Title</label>
					</td>
					<td>
					    <?php echo $form->text('Ticket.tickettitle', array('class'=>'input-text','style'=>'width:200px;')); ?>
						<label id="tickettitle_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Concern Raised By</label>
					</td>
					<td>
						<?php echo $form->text('Ticket.concern_raised', array('class'=>'input-text','style'=>'width:200px;')); ?>
						<label id="ticket_concern_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Email</label>
					</td>
					<td>
						<?php echo $form->text('Ticket.email', array('class'=>'input-text','style'=>'width:200px;')); ?>
						<label id="ticket_email_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Phone Number</label>
					</td>
					<td>
						<?php echo $form->text('Ticket.phone', array('class'=>'input-text','style'=>'width:200px;')); ?>
						<label id="ticket_phone_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
					</td>
				</tr>
				<tr>
					<td width="15%">
						<label style="font-size: large; font-weight: 300;color: black;float: left;">Description</label>
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
		
	<tr id="LabMessage" style="display:none;">
		<td colspan="2">
			<?php echo $form->create(array('url'=>'/admin/samples/lab_message/'.base64_encode($this->data['Health']['id']),'id'=>'form12','name'=>'form12'));?>
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
			</table>
			<?php echo $form->end();?>
		</td>
	</tr>
	<?php echo $form->create(array('url'=>'/admin/samples/upload_report','id'=>'form3','name'=>'form3','enctype'=>'multipart/form-data'));?>
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
					<td><?php echo $form->submit('Upload', array('div'=>false, 'class' => 'btn','onclick'=>'report_submit();')); ?></td>
				</tr>
			</table>
		</td>
	</tr>	
	<?php echo $form->end();?>
	
	<?php echo $form->create(array('url'=>'/admin/samples/view_detail_agent/'.base64_encode($this->data['Health']['id']),'id'=>'form1','name'=>'form1'));?>
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
					<td class="boldText">Discount Reason</td>
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
				<tr>
					<td><?php echo $form->submit('Update', array('div'=>false, 'class' => 'btn','onclick'=>'submit_edit();')); ?></td>
				</tr>
			</table>
		</td>
	</tr>	
	<?php echo $form->end();?>
	</table>
</div>
<script type="text/javascript">
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
</script>
<?php echo $javascript->link('light/jquery.lightbox_me'); ?>
<?php echo $javascript->link('light/slider'); ?>