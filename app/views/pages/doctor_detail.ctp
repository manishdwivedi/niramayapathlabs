<?php echo $javascript->link('price_slider/slides.min.jquery1') ?>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/jquery/ui-lightness/admin/jquery-ui.css" />
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery/jquery.ui.js"></script>
<script type="text/javascript">
$(function() 
{
	function launch() 
	{
    	$('signup-Div').lightbox_me({centered: true, onLoad: function() { $('#signup-Div').find('input:first').focus()}});
    }
    $('#try-1').click(function(e) 
	{
		$("#signup-Div").lightbox_me({centered: true, onLoad: function() 
		{
			$("#signup-Div").find("input:first").focus();
		}});
		e.preventDefault(); 
	});
 	$('table tr:nth-child(even)').addClass('stripe');
});

$(function() 
{
	function launch() 
	{
    	$('signup-Div-Book').lightbox_me({centered: true, onLoad: function() { $('#signup-Div-Book').find('input:first').focus()}});
    }
    $('#book_appoint').click(function(e) 
	{
		$("#signup-Div-Book").lightbox_me({centered: true, onLoad: function() 
		{
			$("#signup-Div-Book").find("input:first").focus();
		}});
		e.preventDefault(); 
	});
 	$('table tr:nth-child(even)').addClass('stripe');
});



function hide_test()
{
	$('#signup-Div').hide();
	$('.js_lb_overlay').css({'opacity':'0'});
}

function hide_test_book()
{
	$('#signup-Div-Book').hide();
	$('.js_lb_overlay').css({'opacity':'0'});
}




function show_all_clinic()
{
	var tot_clinic = '<?php echo $doc_detail['Doctor']['clinic_count'];?>';
	for(var k=1;k<=tot_clinic;k++)
	{
		if(k == tot_clinic)
		{
			$('#DocClinic_'+k).show();
			//$('#DocClinic_'+k).addCss({'border-bottom','1px solid #D8D8D8'});
		}
		else
		{
			$('#DocClinic_'+k).show();
			$('#DocClinic_'+k).css('border-bottom','none');
		}
	}
	$('#MoreClinic').hide();
}

function alert_user()
{
	alert('If you are an existing user then logged in your account after that book apppointment with doctor otherwise click on New User Signup link in login page and register yorself as a user.');
	window.location.href = siteUrl+'pages/login_page/<?php echo base64_encode($doc_detail['Doctor']['id']);?>';
}

function show_time_slot(val)
{
	var curr_slot = document.getElementById('CurrSlot').innerHTML;
	if(curr_slot == '')
	{
		document.getElementById('CurrSlot').innerHTML = val;
		$('#PastDay_'+val).show();
	}
	if(curr_slot != '')
	{
		document.getElementById('CurrSlot').innerHTML = val;
		$('#PastDay_'+curr_slot).hide();
		$('#PastDay_'+val).show();
	}
}

function show_time_slot_single()
{
	$('#PastDay').show();
}

$(function() {
	$( ".datepicker" ).datepicker({
		minDate:0,
		dateFormat: 'dd-M-yy'
	});
	$( ".datepicker1" ).datepicker({
		minDate:0,
		maxDate:'+14 days',
		dateFormat: 'dd-M-yy'
	});
});

function validation_home()
{
	var str=true;
	document.getElementById("Msg1").innerHTML="";
	document.getElementById("Msg2").innerHTML="";
	document.getElementById("Msg3").innerHTML="";
	document.getElementById("Msg4").innerHTML="";
	document.getElementById("Msg5").innerHTML="";
	document.getElementById("Msg6").innerHTML="";
	
	
	if(document.form5.BookAppointmentPatName.value=='')
	{
		document.getElementById("Msg1").innerHTML="Please Enter Your Name";
		str=false;
	}
	if(isNaN(document.form5.BookAppointmentPatContact.value))
	{
		document.getElementById("Msg2").innerHTML="Please Enter Valid Mobile Number";
		str = false;
	}
	else if(document.form5.BookAppointmentPatContact.value.length<10)
	{
		document.getElementById("Msg2").innerHTML="Please Enter Valid Mobile Number";
    	str = false;
	}
	if(document.form5.BookAppointmentAdd1.value=='')
	{
		document.getElementById("Msg3").innerHTML="Please Enter Home Address";
		str=false;
	}
	if(document.form5.BookAppointmentAppointDate.value=='')
	{
		document.getElementById("Msg4").innerHTML="Please Enter Date";
		str=false;
	}
	if(document.form5.BookAppointmentTimeSlot.value=='')
	{
		document.getElementById("Msg5").innerHTML="Please Select Time";
		str=false;
	}
	if(document.form5.BookAppointmentReason.value=='')
	{
		document.getElementById("Msg6").innerHTML="Please Enter Appointment Reason";
		str=false;
	}
	return str;
}
</script>
<style type="text/css">
#ui-datepicker-div {z-index:999999;}
</style>
<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>
<div id="CurrSlot" style="display:none;"></div>




<div id="signup-Div"> <a id="close-one" class="close" href="javascript:void(0);" onclick="hide_test();"><?php echo $html->image('close-one.jpg');?></a>
	<div class="doc-name"><?php echo $doc_detail['Doctor']['title'].'. '.ucfirst($doc_detail['Doctor']['first_name']).' '.ucfirst($doc_detail['Doctor']['last_name']).' Description'?></div>
	<div class="doc-desc"><div class="doc-inner-div"><?php echo $doc_detail['Doctor']['own_desc'];?></div></div>
</div>

<div id="signup-Div-Book"> <a id="close-one-Book" class="close" href="javascript:void(0);" onclick="hide_test_book();"><?php echo $html->image('close-one.jpg');?></a>
	<div class="doc-name">Request for Home Visit</div>
	<div class="doc-desc">
		<?php echo $form->create(null,array('url'=>'/pages/book_appointment_home','id'=>'form5','name'=>'form5','onsubmit'=>'return validation_home(this);'));?>
		<?php echo $form->hidden('BookAppointment.doctor_id',array('value'=>$doc_detail['Doctor']['id']));?>
		<?php echo $form->hidden('BookAppointment.user_id',array('value'=>$user_detail['User']['id']));?>
		<div class="doc-inner-div" style="float:left; width:96%; height:510px;">
			<div style="clear:both;">
				<div class="book-home-visit-head">Appointment With</div>
				<div style="float:left;"><?php echo $doc_detail['Doctor']['title'].'. '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></div>
			</div>
			<div style="clear:both; height:55px;">
				<div class="book-home-visit-head">Patient Name</div>
				<div style="float:left;">
					<?php if(!empty($user_detail)) {?>
					<?php echo $form->text('BookAppointment.pat_name',array('class'=>'inptext','value'=>$user_detail['User']['first_name'].' '.$user_detail['User']['last_name']));?><br />
					<?php } else {?>
					<?php echo $form->text('BookAppointment.pat_name',array('class'=>'inptext','placeholder'=>'Please Enter Patient Name'));?><br />
					<?php }?>
					<span style="color:#FF0000; font-size:11px;" id="Msg1"></span>
				</div>
			</div>
			<div style="clear:both; height:55px;">
				<div class="book-home-visit-head">Patient Contact</div>
				<div style="float:left;">
					<?php if(!empty($user_detail)) {?>
					<?php echo $form->text('BookAppointment.pat_contact',array('class'=>'inptext','value'=>$user_detail['User']['contact']));?><br />
					<?php } else {?>
					<?php echo $form->text('BookAppointment.pat_contact',array('class'=>'inptext','placeholder'=>'Please Enter Contact Number'));?><br />
					<?php }?>
					<span style="color:#FF0000; font-size:11px;" id="Msg2"></span>
				</div>
			</div>
			<?php $expl_user_add = explode('*',$user_detail['User']['address']);?>
			<div style="clear:both; height:55px;">
				<div class="book-home-visit-head">Address</div>
				<div style="float:left;">
					<?php if(!empty($expl_user_add[0])) {?>
					<?php echo $form->text('BookAppointment.add1',array('class'=>'inptext','value'=>$expl_user_add[0]));?>
					<?php } else {?>
					<?php echo $form->text('BookAppointment.add1',array('class'=>'inptext','placeholder'=>'Enter Home Address'));?>
					<?php }?>
				</div>
			</div>
			
			<div style="clear:both; height:55px;">
				<div class="book-home-visit-head">&nbsp;</div>
				<div style="float:left;">
					<?php if(!empty($expl_user_add[1])) {?>
					<?php echo $form->text('BookAppointment.add2',array('class'=>'inptext','value'=>$expl_user_add[1]));?><br />
					<?php } else {?>
					<?php echo $form->text('BookAppointment.add2',array('class'=>'inptext','placeholder'=>'Enter Home Address'));?><br />
					<?php }?>
					<span style="color:#FF0000; font-size:11px;" id="Msg3"></span>
				</div>
			</div>
			
			<div style="clear:both; height:55px;">
				<div class="book-home-visit-head">Enter Date</div>
				<div style="float:left;">
					<?php echo $form->text('BookAppointment.appoint_date',array('class'=>'inptext datepicker','placeholder'=>'Enter Appointment Date'));?><br />
					<span style="color:#FF0000; font-size:11px;" id="Msg4"></span>
				</div>
			</div>
			
			<div style="clear:both; height:55px;">
				<div class="book-home-visit-head">Select Time</div>
				<div style="float:left;">
					<select name="data[BookAppointment][time_slot]" class="inptext" id="BookAppointmentTimeSlot">
						<option value="">Select Time</option>
						<option value="08:00 AM">08:00 AM</option>
						<option value="09:00 AM">09:00 AM</option>
						<option value="10:00 AM">10:00 AM</option>
						<option value="11:00 AM">11:00 AM</option>
						<option value="12:00 PM">12:00 PM</option>
						<option value="01:00 PM">01:00 PM</option>
						<option value="02:00 PM">02:00 PM</option>
						<option value="03:00 PM">03:00 PM</option>
						<option value="04:00 PM">04:00 PM</option>
						<option value="05:00 PM">05:00 PM</option>
						<option value="06:00 PM">06:00 PM</option>
						<option value="07:00 PM">07:00 PM</option>
						<option value="08:00 PM">08:00 PM</option>
					</select><br />
					<span style="color:#FF0000; font-size:11px;" id="Msg5"></span>
				</div>
			</div>
			
			<div style="clear:both;">
				<div class="book-home-visit-head">Appointment Reason</div>
				<div style="float:left;">
					<?php echo $form->textarea('BookAppointment.reason',array('cols'=>30,'rows'=>6,'style'=>'font-size:11px; color:#666666; border-radius:3px; border:1px solid #D9D9D9;','placeholder'=>'Enter Appointment Reason'));?><br />
					<span style="color:#FF0000; font-size:11px;" id="Msg6"></span>
				</div>
			</div>
			<div style="clear:both; height:55px;">
				<div class="book-home-visit-head">&nbsp;</div>
				<div style="float:left; margin:10px 0 0 0;"><input type="image" src="<?php echo SITE_URL;?>img/submit-button.gif" alt="Submit" /></div>
			</div>
		</div>
		<?php echo $form->end();?>
	</div>
</div>


<div class="banner"><?php echo $this->Html->image('frontend/niramaya_dr_module_banner.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
<div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home"><a href="<?php echo SITE_URL;?>pages/index">Home Page</a></div>
          <div class="bread">Doctor Profile</div>
          
        </div>
        
      </div>
      <h1>Doctor <span class="green">Profile</span> <?php if($doc_detail['Doctor']['admin_featured'] == 1) {?><?php echo $html->image('featured-dr-icon.png',array('style'=>'margin:0 0 -25px;'));?><?php }?></h1>
      <div class="findDoctorDiv">
        
		<div class="topPanelDoc marTopNone">
          <div class="docDetails">
            <div class="imgbox">
				<?php if(!empty($doc_detail['Doctor']['image'])) {?>
				<?php echo $html->image(DOCTOR_IMAGE_BIGSMALL_URL.$doc_detail['Doctor']['image'],array('alt'=>'Doctor','title'=>$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name']));?>
				<?php } else {?>
					<?php if($doc_detail['Doctor']['gender'] == 1) {?>
						<?php echo $html->image('frontend/default_male.jpg',array('alt'=>'Doctor','title'=>$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'],'height'=>126,'width'=>131))?>
					<?php } else {?>
						<?php echo $html->image('frontend/default_female.jpg',array('alt'=>'Doctor','title'=>$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'],'height'=>126,'width'=>131))?>
					<?php }?>
				<?php }?>
			</div>
            <div class="headerDiv">
              <h2><?php echo $doc_detail['Doctor']['title'].'. '.ucfirst($doc_detail['Doctor']['first_name']).' '.ucfirst($doc_detail['Doctor']['last_name']);?></h2>
              <h3><?php echo $doc_detail['Doctor']['special_name'];?></h3>
            </div>
			<?php if($doc_detail['Doctor']['doc_desc_count'] > 320) {?>
            <?php echo substr($doc_detail['Doctor']['own_desc'],0,200);?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javscript:void(0);" id="try-1">read more...</a>
			<?php } else {?>
			<?php echo $doc_detail['Doctor']['own_desc'];?>
			<?php }?>
            
          </div>
          <div class="docServices">
				<h1 class="serIcon">Services</h1>
				<dl>
					<?php if(!empty($doc_detail['Doctor']['service1'])) {?>				
					<dt><?php echo $doc_detail['Doctor']['service1'];?></dt>
					<?php }?>
					<?php if(!empty($doc_detail['Doctor']['service2'])) {?>				
					<dt><?php echo $doc_detail['Doctor']['service2'];?></dt>
					<?php }?>
					<?php if(!empty($doc_detail['Doctor']['service3'])) {?>				
					<dt><?php echo $doc_detail['Doctor']['service3'];?></dt>
					<?php }?>
					<?php if(!empty($doc_detail['Doctor']['service4'])) {?>				
					<dt><?php echo $doc_detail['Doctor']['service4'];?></dt>
					<?php }?>
					<?php if(!empty($doc_detail['Doctor']['service5'])) {?>				
					<dt><?php echo $doc_detail['Doctor']['service5'];?></dt>
					<?php }?>              
				</dl>
			  </div>
        </div>
        
		<?php //if($doc_detail['Doctor']['clinic_count'] > 1) {?>
		<?php //echo "<pre>"; print_r($doc_detail['Doctor']['clinic_info']); exit;?>
		<?php $b = 1;foreach($doc_detail['Doctor']['clinic_info'] as $k_cln_info => $k_val_info) {?>
		<script type="text/javascript">
		function hide_request_appoint<?php echo $b;?>()
		{
			$('#signup-Div-Request<?php echo $b;?>').hide();
			$('.js_lb_overlay').css({'opacity':'0'});
		}
		
		$(function() 
		{
			function launch() 
			{
				$('signup-Div-Request<?php echo $b;?>').lightbox_me({centered: true, onLoad: function() { $('#signup-Div-Request<?php echo $b;?>').find('input:first').focus()}});
			}
			$('#request_appoint<?php echo $b;?>').click(function(e) 
			{
				$("#signup-Div-Request<?php echo $b;?>").lightbox_me({centered: true, onLoad: function() 
				{
					$("#signup-Div-Request<?php echo $b;?>").find("input:first").focus();
				}});
				e.preventDefault(); 
			});
			$('table tr:nth-child(even)').addClass('stripe');
		});
		
		function IsCharacter(sText)
		{
			var ValidChars = ' ABC?DEFGHIJKLMN?OPQRSTUVWXYZabc?defghijklmn?opqrstuvwxyz????????????????????????';
			var IsNumber=true;
			var Char;
			for (i = 0; i < sText.length && IsNumber == true; i++) 
			{ 
				Char = sText.charAt(i); 
				if (ValidChars.indexOf(Char) == -1) 
				{
					IsNumber = false;
				}
			}
			return IsNumber;
		}
		function validation_request<?php echo $b;?>()
		{
			var str = true;
			document.getElementById('MsgName<?php echo $b;?>').innerHTML = '';
			document.getElementById('MsgAge<?php echo $b;?>').innerHTML = '';
			document.getElementById('MsgEmail<?php echo $b;?>').innerHTML = '';
			document.getElementById('MsgContact<?php echo $b;?>').innerHTML = '';
			document.getElementById('MsgAppointDate<?php echo $b;?>').innerHTML = '';
			document.getElementById('MsgTime<?php echo $b;?>').innerHTML = '';
			document.getElementById('MsgLocation<?php echo $b;?>').innerHTML = '';
			document.getElementById('MsgAppointReason<?php echo $b;?>').innerHTML = '';
			if(document.formrequest<?php echo $b;?>.RequestAppointmentPatName<?php echo $b;?>.value == '')
			{
				document.getElementById("MsgName<?php echo $b;?>").innerHTML="Please Enter Name";
				str=false;
			}
			else if(IsCharacter(document.formrequest<?php echo $b;?>.RequestAppointmentPatName<?php echo $b;?>.value)==false)
			{
				document.getElementById("MsgName<?php echo $b;?>").innerHTML="Please Enter Valid Name";
				str=false;
			}
			if(document.formrequest<?php echo $b;?>.RequestAppointmentPatAge<?php echo $b;?>.value == '')
			{
				document.getElementById("MsgAge<?php echo $b;?>").innerHTML="Please Enter Age";
				str=false;
			}
			else if(isNaN(document.formrequest<?php echo $b;?>.RequestAppointmentPatAge<?php echo $b;?>.value))
			{
				document.getElementById("MsgAge<?php echo $b;?>").innerHTML="Please Enter Valid Age";
				str=false;
			}
			var validate_char= /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
			if(!document.formrequest<?php echo $b;?>.RequestAppointmentPatEmail<?php echo $b;?>.value.match(validate_char))
			{
				document.getElementById("MsgEmail<?php echo $b;?>").innerHTML="Please Enter a valid email address";
				str=false;
			}
			if(document.formrequest<?php echo $b;?>.RequestAppointmentPatContact<?php echo $b;?>.value == '')
			{
				document.getElementById("MsgContact<?php echo $b;?>").innerHTML="Please Enter Contact Number";
				str=false;
			}
			else if(isNaN(document.formrequest<?php echo $b;?>.RequestAppointmentPatContact<?php echo $b;?>.value))
			{
				document.getElementById("MsgContact<?php echo $b;?>").innerHTML="Please Enter Valid Contact Number";
				str=false;
			}
			if(document.formrequest<?php echo $b;?>.RequestAppointmentAppointDateReq<?php echo $b;?>.value == '')
			{
				document.getElementById("MsgAppointDate<?php echo $b;?>").innerHTML="Please Select Appointment Date";
				str=false;
			}
			if(document.formrequest<?php echo $b;?>.RequestAppointmentAppointTimeHh<?php echo $b;?>.value == '')
			{
				document.getElementById("MsgTime<?php echo $b;?>").innerHTML="Please Select Appointment Time Hour";
				str=false;
			}
			if(document.formrequest<?php echo $b;?>.RequestAppointmentAppointTimeSs<?php echo $b;?>.value == '')
			{
				document.getElementById("MsgTimeSs<?php echo $b;?>").innerHTML="Please Select Appointment Time Second";
				str=false;
			}
			if(document.formrequest<?php echo $b;?>.RequestAppointmentPatLocality<?php echo $b;?>.value == '')
			{
				document.getElementById("MsgLocation<?php echo $b;?>").innerHTML="Please Enter your Location";
				str=false;
			}
			if(document.formrequest<?php echo $b;?>.RequestAppointmentPatReason<?php echo $b;?>.value == '')
			{
				document.getElementById("MsgAppointReason<?php echo $b;?>").innerHTML="Please Enter Appointment Reason";
				str=false;
			}
			return str;
		}
		</script>
		<style type="text/css">
		#signup-Div-Request<?php echo $b;?> {background: #fff; border: 6px solid #727272; width:600px; height:640px; position: relative; display:none; z-index:999; border-radius:13px; }
		#close-one-Request<?php echo $b;?>{display: block; height: 23px; overflow: hidden; position: absolute; right: 3px; top: 8px; width: 24px;}
		</style>
		<div id="signup-Div-Request<?php echo $b;?>"> <a id="close-one-Request<?php echo $b;?>" class="close" href="javascript:void(0);" onclick="hide_request_appoint<?php echo $b;?>();"><?php echo $html->image('close-one.jpg');?></a>
		<div class="doc-name">Request for Appointment</div>
		<div class="doc-desc">
			<?php echo $form->create(null,array('url'=>'/pages/book_appointment_request/'.$b,'id'=>'formrequest'.$b,'name'=>'formrequest'.$b,'onsubmit'=>'return validation_request'.$b.'(this);'));?>
			<?php echo $form->hidden('RequestAppointment.doctor_id',array('value'=>$doc_detail['Doctor']['id']));?>
			<?php echo $form->hidden('RequestAppointment.clinic_id',array('value'=>$k_val_info['Clinic_id']));?>
			<div class="doc-inner-div" style="float:left; width:96%; height:550px;">
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">Patient Name</div>
					<div style="float:left;">
						<?php if(!empty($user_detail)) {?>
						<?php echo $form->text('RequestAppointment.pat_name'.$b,array('class'=>'inptext','value'=>$user_detail['User']['first_name'].' '.$user_detail['User']['last_name']));?><br />
						<?php } else {?>
						<?php echo $form->text('RequestAppointment.pat_name'.$b,array('class'=>'inptext','placeholder'=>'Please Enter Patient Name'));?><br />
						<?php }?>
						<span style="color:#FF0000; font-size:11px;" id="MsgName<?php echo $b;?>"></span>
					</div>
				</div>
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">Patient Age</div>
					<div style="float:left;">
						<?php if(!empty($user_detail)) {?>
						<?php echo $form->text('RequestAppointment.pat_age'.$b,array('class'=>'inptext','value'=>$user_detail['User']['age']));?><br />
						<?php } else {?>
						<?php echo $form->text('RequestAppointment.pat_age'.$b,array('class'=>'inptext','placeholder'=>'Please Enter Age'));?><br />
						<?php }?>
						<span style="color:#FF0000; font-size:11px;" id="MsgAge<?php echo $b;?>"></span>
					</div>
				</div>
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">Patient Email</div>
					<div style="float:left;">
						<?php if(!empty($user_detail)) {?>
						<?php echo $form->text('RequestAppointment.pat_email'.$b,array('class'=>'inptext','value'=>$user_detail['User']['email']));?><br />
						<?php } else {?>
						<?php echo $form->text('RequestAppointment.pat_email'.$b,array('class'=>'inptext','placeholder'=>'Please Enter Email'));?><br />
						<?php }?>
						<span style="color:#FF0000; font-size:11px;" id="MsgEmail<?php echo $b;?>"></span>
					</div>
				</div>
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">Patient Contact No.</div>
					<div style="float:left;">
						<?php if(!empty($user_detail)) {?>
						<?php echo $form->text('RequestAppointment.pat_contact'.$b,array('class'=>'inptext','value'=>$user_detail['User']['contact']));?><br />
						<?php } else {?>
						<?php echo $form->text('RequestAppointment.pat_contact'.$b,array('class'=>'inptext','placeholder'=>'Please Enter Contact No.'));?><br />
						<?php }?>
						<span style="color:#FF0000; font-size:11px;" id="MsgContact<?php echo $b;?>"></span>
					</div>
				</div>
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">Appointment Date</div>
					<div style="float:left;">
						<?php echo $form->text('RequestAppointment.appoint_date_req'.$b,array('class'=>'inptext datepicker1','placeholder'=>'Please Select Date'));?><br />
						<span style="color:#FF0000; font-size:11px;" id="MsgAppointDate<?php echo $b;?>"></span>
					</div>
				</div>
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">Appointment Time</div>
					<div style="float:left;">
						<select name="data[RequestAppointment][appoint_time_hh<?php echo $b;?>]" class="inptext" style="width:55px;" id="RequestAppointmentAppointTimeHh<?php echo $b;?>">
							<option value="">HH</option>
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
						</select>
						<select name="data[RequestAppointment][appoint_time_ss<?php echo $b;?>]" class="inptext" style="width:55px;" id="RequestAppointmentAppointTimeSs<?php echo $b;?>">
							<option value="">SS</option>
							<?php for($ss=0;$ss<=60;$ss++){?>
							<?php if($ss <= 9) {?>
							<option value="<?php echo '0'.$ss;?>"><?php echo '0'.$ss;?></option>
							<?php } else {?>
							<option value="<?php echo $ss;?>"><?php echo $ss;?></option>
							<?php }?>
							<?php }?>
						</select>
						<select name="data[RequestAppointment][appoint_time_sl<?php echo $b;?>]" class="inptext" style="width:55px;" id="RequestAppointmentAppointTimeSl<?php echo $b;?>">
							<option value="AM">AM</option>
							<option value="PM">PM</option>
						</select>
						<br />
						<span style="color:#FF0000; font-size:11px;" id="MsgTime<?php echo $b;?>"></span><br />
						<span style="color:#FF0000; font-size:11px;" id="MsgTimeSs<?php echo $b;?>"></span>
					</div>
				</div>
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">Location</div>
					<div style="float:left;">
						<?php if(!empty($user_detail)) {?>
						<?php echo $form->text('RequestAppointment.pat_locality'.$b,array('class'=>'inptext','value'=>$user_detail['User']['locality']));?><br />
						<?php } else {?>
						<?php echo $form->text('RequestAppointment.pat_locality'.$b,array('class'=>'inptext','placeholder'=>'Please Enter Location'));?><br />
						<?php }?>
						<span style="color:#FF0000; font-size:11px;" id="MsgLocation<?php echo $b;?>"></span>
					</div>
				</div>
				<div style="clear:both;">
					<div class="book-home-visit-head">Appointment Reason</div>
					<div style="float:left;">
						<?php echo $form->textarea('RequestAppointment.pat_reason'.$b,array('cols'=>30,'rows'=>6,'style'=>'font-size:11px; color:#666666; border-radius:3px; border:1px solid #D9D9D9;','placeholder'=>'Enter Appointment Reason'));?><br />
						<span style="color:#FF0000; font-size:11px;" id="MsgAppointReason<?php echo $b;?>"></span>
					</div>
				</div>
				<div style="clear:both; height:55px;">
					<div class="book-home-visit-head">&nbsp;</div>
					<div style="float:left; margin:10px 0 0 0;"><input type="image" src="<?php echo SITE_URL;?>img/submit-button.gif" alt="Submit" /></div>
				</div>
			</div>
			<?php echo $form->end();?>
		</div>
	</div>
		
		<script>
			  $(function(){
				$('#slides_<?php echo $b;?>').slides({
					preload: true,
					generateNextPrev: true
				});
			  });
			  </script>
		<div class="topPanelDoc" id="DocClinic_<?php echo $b;?>" <?php if($b > 1) {?> style="display:none;" <?php }?>>
		  <div class="docDetails" style="text-align:left;">
		  	<h4><?php echo $k_val_info['Clinic_name'];?></h4>
            <div class="detDiv">
			  
			  <div class="add">
                <h3><?php echo $doc_detail['Doctor']['title'].'. '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></h3>
                <p><?php echo $k_val_info['Clinic_address1'];?><br/>
                  <?php echo $k_val_info['Clinic_address2'];?></p>
				 
				  <?php if($b == 1) { if($doc_detail['Doctor']['clinic_count'] > 1) {?>
				  <div class="more-clinic" onclick="show_all_clinic();" id="MoreClinic"><a href="javascript:void(0);"><?php echo $html->image('change_index/more-clinics-btn.png');?></a></div>
				  <?php }}?>
			  </div>
			  
			  <div class="time" style="border-left:none;">
					<div class="timeDiv">
					  <h4>
						<?php if(!empty($k_val_info['day1'])){?>
							<?php echo $k_val_info['day1'].' ';?>
						<?php }?>
						<?php if(!empty($k_val_info['day2'])){?>
							<?php echo $k_val_info['day2'].' ';?>
						<?php }?>
						<?php if(!empty($k_val_info['day3'])){?>
							<?php echo $k_val_info['day3'].' ';?>
						<?php }?>
						<?php if(!empty($k_val_info['day4'])){?>
							<?php echo $k_val_info['day4'].' ';?>
						<?php }?>
						<?php if(!empty($k_val_info['day5'])){?>
							<?php echo $k_val_info['day5'].' ';?>
						<?php }?>
						<?php if(!empty($k_val_info['day6'])){?>
							<?php echo $k_val_info['day6'].' ';?>
						<?php }?>
						<?php if(!empty($k_val_info['day7'])){?>
							<?php echo $k_val_info['day7'].' ';?>
						<?php }?>
					  </h4>
					  <p><?php echo $k_val_info['clinic_s_time'].' - ';?><?php echo $k_val_info['clinic_e_time'];?></p>
					</div>
				  </div>
				  <div class="priceDiv">
					<div class="inrRs">INR - <?php echo $doc_detail['Doctor']['cons_fee'];?></div>
					<?php if($doc_detail['Doctor']['appointment_activation'] == 1) {?>
					<a href="javascript:void(0);" onclick="show_time_slot(<?php echo $b;?>);"><?php echo $html->image('book-appointment-button.jpg',array('class'=>'right','alt'=>'Request Appointment','class'=>'appbtn'))?></a>
					<?php } else {?>
					<a href="javascript:void(0);" id="request_appoint<?php echo $b;?>"><?php echo $html->image('change_index/request-appointment-1.jpg',array('class'=>'right','alt'=>'Request Appointment','class'=>'appbtn'))?></a>
					<?php }?>
					<?php if($b == 1) {?>
					<a href="javascript:void(0);" id="book_appoint"><?php echo $html->image('change_index/request-home-visit.jpg',array('class'=>'right','alt'=>'Request Home Visit','class'=>'appbtn'))?></a>
					<?php }?>
					<?php if(!empty($book_appoint)) {?>
					<div class="home-mess">Request send for home visit</div>
					<?php }?>
				  </div>
				  
            </div>
			
		</div>
		<?php if($b == 1) {?>
		 <div class="docServices">
			<h1 class="eduIcon">Education</h1>
			<dl>
			  <dt class="edu">BVSc - Agra Univeristy</dt>
			  <dt class="edu">MVSc - Agra Univeristy</dt>
			  <dt class="edu">MBBS - M G M Medical College, Jamshedpur, 2000</dt>
			  <dt class="edu">MD - Pathology & Microbiology - nagpur university, 2005</dt>
			</dl>
		  </div> 
		  <?php }?>
         
		  <!-- Doctor Time Slots Clinic-->
		  <div class="slideboxDiv1" id="PastDay_<?php echo $b;?>" style="display:none;">
		  <div class="nextPrevBlog">You can book appointments for next 14 days</div>
          	<div id="slides_<?php echo $b;?>" style="clear:both; position:relative;">
				<div class="slides_container1">
					<div class="slideDiv">
						
		  <div class="timeHeading1">
        	<ul>
				<li><span><?php echo date('D');?></span><p><?php echo date('d M');?></p></li>
				<li><span><?php echo date('D',strtotime(" +1 days "));?></span><p><?php echo date('d M',strtotime(" +1 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +2 days "));?></span><p><?php echo date('d M',strtotime(" +2 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +3 days "));?></span><p><?php echo date('d M',strtotime(" +3 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +4 days "));?></span><p><?php echo date('d M',strtotime(" +4 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +5 days "));?></span><p><?php echo date('d M',strtotime(" +5 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +6 days "));?></span><p><?php echo date('d M',strtotime(" +6 days "));?></p></li>
				<!--<li><a href="javascript:void(0);" onclick="open_future(<?php //echo $vv['Doctor']['id']?>);">Next</a></li>-->
            </ul>
          </div>
		  <script type="text/javascript">
		  function show_alert(val)
		  {
			  var currAlert = document.getElementById('CurrAlertBox').innerHTML;
			  if(currAlert == '')
			  {
				  document.getElementById('CurrAlertBox').innerHTML = val;
				  document.getElementById('AlertBox'+val).style.display = 'block';
			  }
			  else
			  {
				  document.getElementById('AlertBox'+currAlert).style.display = 'none';
				  document.getElementById('AlertBox'+val).style.display = 'block';
				  document.getElementById('CurrAlertBox').innerHTML = val;
			  }
		  }
		  function close_alert(val)
		  {
			  document.getElementById('AlertBox'+val).style.display = 'none';
		  }
		
		  function show_alert_second(val)
		  {
			  var currAlertSecond = document.getElementById('CurrAlertBoxSecond').innerHTML;
			  if(currAlertSecond == '')
			  {
				  document.getElementById('CurrAlertBoxSecond').innerHTML = val;
				  document.getElementById('AlertBoxSecond'+val).style.display = 'block';
			  }
			  else
			  {
				  document.getElementById('AlertBoxSecond'+currAlertSecond).style.display = 'none';
				  document.getElementById('AlertBoxSecond'+val).style.display = 'block';
				  document.getElementById('CurrAlertBoxSecond').innerHTML = val;
			  }
		  }
		  function close_alert_second(val)
		  {
			  document.getElementById('AlertBoxSecond'+val).style.display = 'none';
		  }
		  </script>
		  <div id="CurrAlertBox" style="display:none;"></div>
		  <div id="CurrAlertBoxSecond" style="display:none;"></div>
		  <div class="timeTableDiv1">
        	<table width="100%" border="0" cellspacing="1" cellpadding="0">
  				<tr>
    				<td width="18%" height="118"><h3>Morning</h3></td>
					<td width="12%">
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>	
				</tr>
				
				<tr>
    				<td width="18%" height="170"><h3>Afternoon</h3></td>
					<td width="12%">
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
				</tr>
				
				<tr>
    				<td width="18%" height="135"><h3>Evening</h3></td>
					<td width="12%">
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
				</tr>
				
				<tr>
    				<td width="18%" height="100"><h3>Night</h3></td>
					<td width="12%">
						<?php $t_day = date('D');if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d')) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d'),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y');?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d'));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +1 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +1 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +1 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +1 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +1 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +2 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +2 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +2 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +2 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +2 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +3 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +3 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +3 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +3 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +3 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +4 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +4 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +4 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +4 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +4 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +5 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +5 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +5 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +5 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +5 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +6 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +6 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +6 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBox<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +6 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +6 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
				</tr>
			</table>
		</div>
						
					</div>
		
					<div class="slideDiv">
						
		  <div class="timeHeading1">
        	<ul>
				<li><span><?php echo date('D',strtotime(" +7 days "));?></span><p><?php echo date('d M',strtotime(" +7 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +8 days "));?></span><p><?php echo date('d M',strtotime(" +8 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +9 days "));?></span><p><?php echo date('d M',strtotime(" +9 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +10 days "));?></span><p><?php echo date('d M',strtotime(" +10 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +11 days "));?></span><p><?php echo date('d M',strtotime(" +11 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +12 days "));?></span><p><?php echo date('d M',strtotime(" +12 days "));?></p></li>
				<li><span><?php echo date('D',strtotime(" +13 days "));?></span><p><?php echo date('d M',strtotime(" +13 days "));?></p></li>
				<!--<li><a href="javascript:void(0);" onclick="open_future(<?php //echo $vv['Doctor']['id']?>);">Next</a></li>-->
            </ul>
          </div>
		  <div class="timeTableDiv1">
        	<table width="100%" border="0" cellspacing="1" cellpadding="0">
  				<tr>
    				<td width="18%" height="118"><h3>Morning</h3></td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_mor1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_mor2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_mor3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_mor4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_mor5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_mor6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_mor7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>	
				</tr>
				
				<tr>
    				<td width="18%" height="170"><h3>Afternoon</h3></td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_aft1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_aft2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_aft3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_aft4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_aft5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_aft6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_aft7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
				</tr>
				
				<tr>
    				<td width="18%" height="135"><h3>Evening</h3></td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_evn1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_evn2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_evn3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_evn4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_evn5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_evn6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_evn7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
				</tr>
				
				<tr>
    				<td width="18%" height="100"><h3>Night</h3></td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +7 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +7 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +7 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +7 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +7 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +8 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +8 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +8 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +8 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +8 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +9 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +9 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +9 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +9 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +9 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +10 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +10 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +10 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +10 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +10 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +11 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +11 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +11 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +11 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +11 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +12 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +12 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +12 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +12 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +12 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
					<td width="12%">
						<?php $t_day = date('D',strtotime(" +13 days "));if($t_day=='Mon'){$day = 1;}if($t_day=='Tue'){$day = 2;}if($t_day=='Wed'){$day = 3;}if($t_day=='Thu'){$day = 4;}if($t_day=='Fri'){$day = 5;}if($t_day=='Sat'){$day = 6;}if($t_day=='Sun'){$day = 7;}?>
						<?php if($day == 1) {foreach($k_val_info['clinic_timing_ngt1'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 2) {foreach($k_val_info['clinic_timing_ngt2'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 3) {foreach($k_val_info['clinic_timing_ngt3'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 4) {foreach($k_val_info['clinic_timing_ngt4'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 5) {foreach($k_val_info['clinic_timing_ngt5'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 6) {foreach($k_val_info['clinic_timing_ngt6'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
						<?php if($day == 7) {foreach($k_val_info['clinic_timing_ngt7'] as $key_clinic_time => $val_clinic_time) {?>
							<?php if($val_clinic_time['ClinicTime']['blackout_date'] == date('Y-m-d',strtotime(" +13 days "))) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php } else {if(in_array(date('Y-m-d',strtotime(" +13 days ")),$val_clinic_time['ClinicTime']['booked_date'])) {?>
								<div class="noav"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></div>
							<?php }else {?>
								<div class="av">
									<a href="javascript:void(0);" onclick="show_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');" style="color:#E99A09;"><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></a>
								</div>
								<div class="alert-box-mess-detail" id="AlertBoxSecond<?php echo $val_clinic_time['ClinicTime']['id'];?>">
									<div style="text-align:center;">Are you sure to book appointment with <strong><?php echo $doc_detail['Doctor']['title'].' '.$doc_detail['Doctor']['first_name'].' '.$doc_detail['Doctor']['last_name'];?></strong> on <strong><?php echo date('d-M-Y',strtotime(" +13 days "));?></strong> at <strong><?php echo $val_clinic_time['ClinicTime']['time_slot'];?></strong></div>
									<div style="text-align:center; padding:25px;">
										<a href="<?php echo SITE_URL;?>pages/book_appointment/<?php echo base64_encode($doc_detail['Doctor']['id']);?>/<?php echo base64_encode($k_val_info['Clinic_id']);?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['time_slot']);?>/<?php echo base64_encode($t_day);?>/<?php echo base64_encode(date('Y-m-d',strtotime(" +13 days ")));?>/<?php echo base64_encode($val_clinic_time['ClinicTime']['id']);?>"><?php echo $html->image('change_index/confirm-button.jpg');?></a>
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="close_alert_second('<?php echo $val_clinic_time['ClinicTime']['id'];?>');"><?php echo $html->image('change_index/cancel-button.jpg');?></a>
									</div>
								</div>
							<?php }}?>
						<?php }}?>
					</td>
				</tr>
			</table>
		</div>
						
					</div>
				</div>
       		</div>
          </div>
		  <!-- Doctor Time Slots Clinic Ends-->
        </div>
		<?php $b++;}?>
		
        <div class="topPanelDoc borderNone">
          <div class="docDetailsLeft">
            <div class="speDiv marTopNone">
              <h3 class="speicon">Specialization</h3>
              <dl>
                <?php if(!empty($doc_detail['Doctor']['spec1'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['spec1'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['spec2'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['spec2'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['spec3'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['spec3'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['spec4'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['spec4'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['spec5'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['spec5'];?></dt>
				<?php }?>
              </dl>
            </div>
            <div class="speDiv">
              <h3 class="expicon">Experience</h3>
              <dl>
                <?php if(!empty($doc_detail['Doctor']['experience1'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['experience1'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['experience2'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['experience2'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['experience3'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['experience3'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['experience4'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['experience4'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['experience5'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['experience5'];?></dt>
				<?php }?>
              </dl>
            </div>
            <div class="speDiv">
              <h3 class="awdicon">Awards and Recognitions</h3>
              <dl>
                <?php if(!empty($doc_detail['Doctor']['award1'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['award1'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['award2'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['award2'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['award3'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['award3'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['award4'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['award4'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['award5'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['award5'];?></dt>
				<?php }?>
				<?php if(empty($doc_detail['Doctor']['award1']) && empty($doc_detail['Doctor']['award2']) && empty($doc_detail['Doctor']['award3']) && empty($doc_detail['Doctor']['award4']) && empty($doc_detail['Doctor']['award5'])) {?>
				<dt>No Awards and Recognitions</dt>
				<?php }?>
              </dl>
            </div>
          </div>
          <div class="speDivright">
		  
		  
		  	
		  
            <div class="speDiv marTopNone">
              <h3 class="memicon">Memberships</h3>
              <dl>
                <?php if(!empty($doc_detail['Doctor']['member1'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['member1'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['member2'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['member2'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['member3'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['member3'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['member4'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['member4'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['member5'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['member5'];?></dt>
				<?php }?>
				<?php if(empty($doc_detail['Doctor']['member1']) && empty($doc_detail['Doctor']['member2']) && empty($doc_detail['Doctor']['member3']) && empty($doc_detail['Doctor']['member4']) && empty($doc_detail['Doctor']['member5'])) {?>
				<dt>No Memberships</dt>
				<?php }?>
              </dl>
            </div>
            <div class="speDiv">
              <h3 class="regicon">Registrations</h3>
              <dl>
                <?php if(!empty($doc_detail['Doctor']['registration1'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['registration1'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['registration2'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['registration2'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['registration3'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['registration3'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['registration4'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['registration4'];?></dt>
				<?php }?>
				<?php if(!empty($doc_detail['Doctor']['registration5'])) {?>				
				<dt><?php echo $doc_detail['Doctor']['registration5'];?></dt>
				<?php }?>
				<?php if(empty($doc_detail['Doctor']['registration1']) && empty($doc_detail['Doctor']['registration2']) && empty($doc_detail['Doctor']['registration3']) && empty($doc_detail['Doctor']['registration4']) && empty($doc_detail['Doctor']['registration5'])) {?>
				<dt>No Registrations</dt>
				<?php }?>
              </dl>
            </div>
          </div>
        </div>
      </div>
      <div class="bottomShadow"></div>
    </div>
  </div>
<?php echo $javascript->link('light/jquery.lightbox_me') ?>
<?php echo $javascript->link('light/slider') ?>