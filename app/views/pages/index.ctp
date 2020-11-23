<?php //echo $this->Html->script('home_banner/jquery-1.4.2');?>
<?php echo $this->Html->script('home_banner/jquery.cycle.all');?>
<?php echo $this->Html->script('home_banner/document');?>
<script language="JavaScript" type="text/javascript">
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
function validationc()
{
var str=true;
document.getElementById("msg1").innerHTML="";
document.getElementById("msg2").innerHTML="";
document.getElementById("msg3").innerHTML="";


if(document.form2.CallName.value=='Please Enter Your name')
{
	document.getElementById("msg1").innerHTML="Please Enter Your name";
	str=false;
}
else if(IsCharacter(document.form2.CallName.value)==false)

{

	document.getElementById("msg1").innerHTML="Please Enter Your Valid Name";

	str=false;

}
if(document.form2.CallPhone.value=='Please Enter Your Mobile No.')
{
	document.getElementById("msg2").innerHTML="Please Enter Your Mobile No.";
	str=false;
}
else if(document.form2.CallPhone.value.length<10)
{
	document.getElementById("msg2").innerHTML="Mobile no  must be contain between 10 to 15 digits only";
	str=false;
}
else if(document.form2.CallPhone.value.length>11)
{
	document.getElementById("msg2").innerHTML="Mobile no  must be contain between 10 to 15 digit only";
	str=false;
}
else if(isNaN(document.form2.CallPhone.value))
{
	document.getElementById("msg2").innerHTML="Please Enter Valid Mobile No.";
	str=false;
}

if(document.form2.CallMessage.value=='Please Enter Your Message')
{
	document.getElementById("msg3").innerHTML="Please Enter Your Message";
	str=false;

}
return str;
}
</script>

<script language="JavaScript" type="text/javascript">
function validationcc()
{
var str=true;
document.getElementById("msg11").innerHTML="";
document.getElementById("msg12").innerHTML="";
if(document.form3.LoginUsername.value=='Please Enter Email/Phone')
{
	document.getElementById("msg11").innerHTML="Please Enter Email/Phone";
	str=false;
}

if(document.form3.LoginPass.value=='password')
{
	document.getElementById("msg12").innerHTML="Please Enter Password";
	str=false;
}

return str;
}
</script>



 <script type="application/javascript">
 function showMail()
{
document.getElementById('beforeQue1').style.display='none'
document.getElementById('firstQuestion').style.display='block';
	}

	function  openQueBefore1()
{
document.getElementById('firstQuestion').style.display='none';
document.getElementById('beforeQue1').style.display='block';

}


function login_window(val)
{
	if(val == 'customer')
	{
		$('#customerLogin').show();
		$('#partnerLogin').hide();
	}
	if(val == 'partner')
	{
		$('#customerLogin').hide();
		$('#partnerLogin').show();
	}
}
 </script>
 <style type="text/css">
 	.textBox-search {
    border: 1px solid #C7C7C7;
    float: left;
    font: 11px arial;
    height: 18px;
    margin-top: 10px;
    padding: 3px 8px;
    width: 212px;
}
#bodyPart .bodyInnerDiv .cont .testimonialBox .testimonialDiv .contDiv {
    float: left;
    padding: 11px;
    width: 500px;
}
 </style>

<script type="text/javascript">
var j = jQuery.noConflict();
j(function()
{
	function launch()
	{
    	j('signup-Div-cancel').lightbox_me({centered: true, onLoad: function() { j('#signup-Div-cancel').find('input:first').focus()}});
    }
    j('#cancelAppoint').click(function(e)
	{
		j("#signup-Div-cancel").lightbox_me({centered: true, onLoad: function()
		{
			j("#signup-Div-cancel").find("input:first").focus();
		}});
		e.preventDefault();
	});
 	j('table tr:nth-child(even)').addClass('stripe');
});

j(function()
{
	function launch()
	{
    	j('signup-Div-view').lightbox_me({centered: true, onLoad: function() { j('#signup-Div-view').find('input:first').focus()}});
    }
    j('#viewAppoint').click(function(e)
	{
		j("#signup-Div-view").lightbox_me({centered: true, onLoad: function()
		{
			j("#signup-Div-view").find("input:first").focus();
		}});
		e.preventDefault();
	});
 	j('table tr:nth-child(even)').addClass('stripe');
});
function hide_test()
{
	j('#signup-Div-cancel').hide();
	j('.js_lb_overlay').css({'opacity':'0'});
}

function hide_view()
{
	j('#signup-Div-view').hide();
	j('.js_lb_overlay').css({'opacity':'0'});
}

function cancel_appoint()
{
	var h = jQuery.noConflict();
	var appoint_id = document.getElementById('AppointmentCancelId').value;
	var otp_pass = document.getElementById('AppointmentOtpCancelPass').value;
	jQuery.ajax({
			type:'GET',
			url:siteUrl+'pages/cancel_valid_appoint?appoint_id='+appoint_id+'&otp='+otp_pass,
			success:function(data){
				var split_data = data.split('*');
				if(split_data[3] == 'Success')
				{
					var rep_div = '';
					rep_div +='Your Appointment with '+split_data[0]+' on '+split_data[1]+' at '+split_data[2]+' has been cancelled successfully.';
					h('#AppointMess').show();
					h('#CancelAppointSuccess').show();
					h('#CancelAppointSuccess').html(rep_div);
					h('#CancelAppointFailure').hide();
					h('#AppointId').hide();
					h('#OTPPass').hide();
					h('#CancelAppoint').hide();
					h('#process').hide();
				}
				if(split_data[3] == 'Failure')
				{
					h('#AppointMess').show();
					var rep_div = '';
					rep_div +='Your AppointmentID is not valid.';
					h('#CancelAppointFailure').show();
					h('#CancelAppointFailure').html(rep_div);
					h('#CancelAppointSuccess').hide();
					h('#process').hide();
				}
			},
			beforeSend:function(){
				h('#process').show();
			},

		});
}

function send_otp()
{
	var k = jQuery.noConflict();
	var appoint_id = document.getElementById('AppointmentCancelId').value;
	jQuery.ajax({
			type:'GET',
			url:siteUrl+'pages/process_otp?appoint_id='+appoint_id,
			success:function(data){
				if(data == 'Success')
				{
					k('#OTPPass').show();
					k('#CancelAppoint').show();
					k('#OTPSend').hide();
					k('#process_otp').hide();
				}
			},
			beforeSend:function(){
				k('#process_otp').show();
			},

		});
}
</script>
<div id="signup-Div-cancel"> <a id="close-one" class="close" href="javascript:void(0);" onclick="hide_test();"><?php echo $html->image('close-one.jpg');?></a>
	<div class="doc-name">Cancel Appointment</div>
	<div class="cancel-appoint-index">If you have an appointment that you want to cancel, Fill the AppointmentID that you have earlier received via SMS.</div>
	<div class="cancel-appoint-index" style="padding:0;">
		<div class="cancel-appoint-inner" id="AppointMess" style="display:none;">
			<div class="appoint-not" id="CancelAppointSuccess"></div>
			<div class="appoint-not" id="CancelAppointFailure"></div>
		</div>
		<div class="cancel-appoint-inner" id="AppointId">
			<div class="cancel-appoint-head">Appointment ID</div>
			<div style="float:left;"><?php echo $form->text('Appointment.cancel_id',array('class'=>'cancel-input'));?></div>
		</div>
		<div class="cancel-appoint-inner" id="OTPPass" style="display:none;">
			<div class="cancel-appoint-head">Enter OTP Password</div>
			<div style="float:left;"><?php echo $form->text('Appointment.otp_cancel_pass',array('class'=>'cancel-input'));?></div>
		</div>
		<div class="cancel-appoint-inner" id="CancelAppoint" style="display:none;">
			<div class="cancel-appoint-head">&nbsp;</div>
			<div style="float:left;">
				<?php echo $html->image('change_index/verify-mobile-button.jpg',array('onclick'=>'cancel_appoint();'));?>
				<?php echo $html->image('loading.gif',array('style'=>'margin:-8px 0 -9px; display:none;','id'=>'process'));?>
			</div>
		</div>
		<div class="cancel-appoint-inner" id="OTPSend">
			<div class="cancel-appoint-head">&nbsp;</div>
			<div style="float:left;">
				<?php echo $html->image('change_index/cancel-appointment-button.jpg',array('onclick'=>'send_otp();'));?>
				<?php echo $html->image('loading.gif',array('style'=>'margin:-8px 0 -9px; display:none;','id'=>'process_otp'));?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function get_appoint_detail()
{
	var appoint_id = jQuery('#AppointmentViewId').val();
	var mob_num = jQuery('#AppointmentMobNum').val();
	jQuery.ajax({
		type:'GET',
		url:siteUrl+'pages/view_appointment?appid='+appoint_id+'&mob='+mob_num,
		dataType:'json',
		success:function(data)
		{
			if(data.success == 1)
			{
				var rep_div = '';
				rep_div +='<div class="cancel-appoint-inner" style="padding:0 0 0 10px;">';
				rep_div +='<div class="cancel-appoint-head" style="width:158px;">Appointment ID</div>';
				rep_div +='<div style="float:left; margin:10px;">'+data.appointment_detail.BookAppointment.appointment_id+'</div>';
				rep_div +='</div>';

				rep_div +='<div class="cancel-appoint-inner" style="padding:0 0 0 10px;">';
				rep_div +='<div class="cancel-appoint-head" style="width:158px;">Appointment Book For</div>';
				rep_div +='<div style="float:left; margin:10px;">'+data.appointment_detail.BookAppointment.user_name+'</div>';
				rep_div +='</div>';

				rep_div +='<div class="cancel-appoint-inner" style="padding:0 0 0 10px;">';
				rep_div +='<div class="cancel-appoint-head" style="width:158px;">Doctor Name</div>';
				rep_div +='<div style="float:left; margin:10px;">'+data.appointment_detail.BookAppointment.doctor_name+'</div>';
				rep_div +='</div>';

				rep_div +='<div class="cancel-appoint-inner" style="padding:0 0 0 10px;">';
				rep_div +='<div class="cancel-appoint-head" style="width:158px;">Clinic Name</div>';
				rep_div +='<div style="float:left; margin:10px;">'+data.appointment_detail.BookAppointment.clinic_name+'</div>';
				rep_div +='</div>';

				rep_div +='<div class="cancel-appoint-inner" style="padding:0 0 0 10px;">';
				rep_div +='<div class="cancel-appoint-head" style="width:158px;">Date</div>';
				rep_div +='<div style="float:left; margin:10px;">'+data.appointment_detail.BookAppointment.app_date+'</div>';
				rep_div +='</div>';

				rep_div +='<div class="cancel-appoint-inner" style="padding:0 0 0 10px;">';
				rep_div +='<div class="cancel-appoint-head" style="width:158px;">Day</div>';
				rep_div +='<div style="float:left; margin:10px;">'+data.appointment_detail.BookAppointment.appoint_day+'</div>';
				rep_div +='</div>';

				rep_div +='<div class="cancel-appoint-inner" style="padding:0 0 0 10px;">';
				rep_div +='<div class="cancel-appoint-head" style="width:158px;">Time</div>';
				rep_div +='<div style="float:left; margin:10px;">'+data.appointment_detail.BookAppointment.time_slot+'</div>';
				rep_div +='</div>';

				jQuery('#AppDetail').html(rep_div);
				jQuery('#AppointViewId').hide();
				jQuery('#process_view').hide();
				jQuery('#ViewAppButt').hide();
				jQuery('#ErrDetail').hide();
				jQuery('#AppointMobId').hide();
			}
			if(data.success == 0)
			{
				var rep_div = '';
				rep_div +='<div class="cancel-appoint-inner" style="padding:0 0 0 10px; text-align:center; color:#FF0000;">No Appointment Found</div>';
				jQuery('#AppointViewId').show();
				jQuery('#ErrDetail').html(rep_div);
				jQuery('#process_view').hide();
			}
			if(data.success == 2)
			{
				var rep_div = '';
				rep_div +='<div class="cancel-appoint-inner" style="padding:0 0 0 10px; text-align:center; color:#FF0000;">Please enter Appointment ID and Mobile Number</div>';
				jQuery('#AppointViewId').show();
				jQuery('#ErrDetail').html(rep_div);
				jQuery('#process_view').hide();
			}
		},
		beforeSend:function(){
			jQuery('#process_view').show();
		},
	});
}
</script>
<div id="signup-Div-view"> <a id="close-one" class="close" href="javascript:void(0);" onclick="hide_view();"><?php echo $html->image('close-one.jpg');?></a>
	<div class="doc-name">View Appointment</div>
	<div class="cancel-appoint-index">If you have an appointment that you want to view, Fill the AppointmentID that you have earlier received via SMS.</div>
	<div class="cancel-appoint-index" style="padding:0;">
		<div id="ErrDetail"></div>
		<div class="cancel-appoint-inner" id="AppointViewId">
			<div class="cancel-appoint-head">Appointment ID</div>
			<div style="float:left;"><?php echo $form->text('Appointment.view_id',array('class'=>'cancel-input'));?></div>
		</div>
		<div class="cancel-appoint-inner" id="AppointMobId">
			<div class="cancel-appoint-head">Mobile Number</div>
			<div style="float:left;"><?php echo $form->text('Appointment.mob_num',array('class'=>'cancel-input'));?></div>
		</div>
		<div id="AppDetail"></div>
		<div class="cancel-appoint-inner" id="ViewAppButt">
			<div class="cancel-appoint-head">&nbsp;</div>
			<div style="float:left;">
				<input class="rightBotton" type="submit" value="" style="cursor:pointer;" onclick="get_appoint_detail();">
				<?php echo $html->image('loading.gif',array('style'=>'margin:-8px 0 -9px; display:none;','id'=>'process_view'));?>
			</div>
		</div>
	</div>
</div>
 <div class="packagesInnerDiv">
      <div class="leftBox" id="customerLogin" style="display:none;">
        <div class="innerDiv">
          <h1><span class="green">Customer</span> Login</h1>
		  <span style="float:right;"><a href="<?php SITE_URL?>tests/become_member" style="text-decoration:none; color:#000000;">New User SignUp</a></span>
          <!--<p>Be the first to know about latest updates and offers from Niramaya.</p>-->
            <?php
			/*if(!empty($bm_msg))
			{
			?>
			<div style="color: #000;"><?php echo $bm_msg;?></div>
			<?php
			}
			?>
          <?php echo $form->create(null, array('url'=>'/pages/index/become_form','id'=>'form3','name'=>'form3','class'=>'marTopNone','onsubmit'=>'return validationcc(this);')); ?>

            <?php echo $form->text('Become.name', array('class'=>'textBox','value'=>'Please Enter Your name','onblur'=>'if(this.value=="")this.value="Please Enter Your name"',' onfocus'=>'if(this.value=="Please Enter Your name")this.value="";')); ?>
            <span id="msg11"></span>
                        <?php echo $form->text('Become.email', array('class'=>'textBox','value'=>'Please Enter Your email','onblur'=>'if(this.value=="")this.value="Please Enter Your email"',' onfocus'=>'if(this.value=="Please Enter Your email")this.value="";')); ?>
                        <span id="msg12"></span>
						<input type="image" src="/Niramayahealthcare/img/frontend/submit-button.gif" class="rightBotton">
            <?php //echo $form->submit('', array('div'=>false, 'class' => 'rightBotton')); ?>
                    <?php echo $form->end();*/ ?>
            <!--<p>Existing User login with the details sent on your email while ordering Test/Profile.</p>-->
			<p>Use your emailID or mobile number as your username</p>

			<?php echo $form->create(null, array('url'=>'/pages/login','id'=>'form3','name'=>'form3','class'=>'marTopNone','onsubmit'=>'return validationcc(this);')); ?>

            <?php echo $form->text('Login.username', array('class'=>'textBox','value'=>'Please Enter Email/Phone','onblur'=>'if(this.value=="")this.value="Please Enter Email/Phone"',' onfocus'=>'if(this.value=="Please Enter Email/Phone")this.value="";')); ?>
			<span id="msg11"></span>
			<?php echo $form->password('Login.pass', array('class'=>'textBox','value'=>'password','onblur'=>'if(this.value=="")this.value="password"',' onfocus'=>'if(this.value=="password")this.value="";')); ?>
			<script type="text/javascript">
			function show_tooltip(val)
			{
				if(val == 0)
				{
					document.getElementById('tooltip1').style.display = 'none';
				}
				if(val == 1)
				{
					document.getElementById('tooltip1').style.display = 'block';
				}
			}
			</script>
			<div class="info">
				<a href="javascript:void(0);" onmouseover="show_tooltip(1);" onmouseout="show_tooltip(0);"><?php echo $html->image('frontend/infoicon.jpg',array('alt'=>'!','id'=>'info'));?></a>
            	<div class="tooltip" id="tooltip1"><div class="arrow"></div><p>Your password is a combination of the first alphabet of your name and last 4 digit of your mobile number.</p></div>
			</div>
			<span id="msg12"></span>
			<span style="float:left; padding:5px 0 0; color:#68B323; font-size:12px;">
				<a href="javascript:void(0);" onclick="login_window('partner');">
					<?php echo $html->image('frontend/social/e-reporting-icon.jpg',array('width'=>18,'style'=>'margin:0 0 -5px;'));?> View Report
				</a>
				<br/>
				<?php echo $html->link('Forgot password',array('controller'=>'users','action'=>'forgot_password'),array('escape'=>false,'style'=>'float:left;margin-top:5px;')); ?>
			</span>


			<input type="image" src="<?php SITE_URL?>img/frontend/submit-button.gif" class="rightBotton">

			<?php echo $form->end(); ?>

        </div>
      </div>
	  <div class="leftBox" id="partnerLogin">
        <div class="innerDiv">
          <h1><span class="green">View</span> Report</h1>
		  <!--<span style="float:right;"><a href="<?php //SITE_URL?>tests/become_member" style="text-decoration:none; color:#000000;">New User SignUp</a></span>-->

			<form method="post" action="<?php echo SITE_URL;?>pages/login_report">
				<p>Use your registered Phone No. as username and Test RequestID as password</p>
				<input type="text" name="data[ViewReport][username]" class="textBox" placeholder="Enter Username" />
				<input type="password" name="data[ViewReport][password]" class="textBox" placeholder="Enter Request No." />
				<span style="float:left; padding:20px 0 0; color:#68B323; font-size:14px;"><a href="javascript:void(0);" onclick="login_window('customer');">Customer Login</a></span><input type="image" src="<?php echo SITE_URL;?>img/frontend/submit-button.gif" class="rightBotton">
			</form>

			<!--<form method="post" action="http://50.62.136.174/SignIn.aspx">
			 	<input type="text" name="username" class="textBox" placeholder="Enter Username" />
				<input type="password" name="password" class="textBox" placeholder="********" />
			<span style="float:left; padding:20px 0 0; color:#68B323; font-size:14px;"><a href="javascript:void(0);" onclick="login_window('customer');">Customer Login</a></span><input type="image" src="<?php //SITE_URL?>img/frontend/submit-button.gif" class="rightBotton">

			</form>-->

        </div>
      </div>
      <div class="leftBox leftPost">
        <div class="innerDiv">
          <h1><span class="green">Niramaya</span> Packages</h1>
          <p>Packages specially designed for your lifestyle needs</p>
          <ul>
            <li><?php echo $this->Html->link('nirAmaya Health Check Ups','/packagelists/package');?></li>
            <li><?php echo $this->Html->link('nirAmaya Special Offers','/tests/offers');?></li>
            <li><?php echo $this->Html->link('nirAmaya Patient Care','/tests/services');?></li>
            <li class="borderNone"><?php echo $this->Html->link('Corporate Health Check Ups','/tests/health_check_up_corporate');?></li>
          </ul>
        </div>
      </div>
	  <?php echo $form->create(null, array('url'=>'/tests/search_keyword_home','id'=>'form1','name'=>'form1','class'=>'marTopNone')); ?>

      <div class="rightPart">
        <div class="box">
          <!--<h1>Book your Test / Profile</h1>-->
		  <h1>Search Tests/Packages/Services & Book</h1>
          <div class="testBox">
            <!--<div class="opt">
              <div class="heading">
                <input type="radio" class="radioBtn" name="opt1" onclick="showMail();" checked="checked"/>
                <h6>Test</h6>
              </div>
              <p>Book individual tests</p>
            </div>-->
            <!--<div class="opt borderNone">
              <div class="heading">
                <input type="radio" class="radioBtn" name="opt1" onclick="openQueBefore1();"/>
                <h6>Profile</h6>
              </div>
              <p>Profiles(consist of multiple tests)</p>
            </div>-->
            <!--<select name="data[Sample][test_id]" class="selectBox" multiple="multiple" size="10">
				<option value="">Select Test</option>
				<?php //foreach($tests as $key => $val) {?>
				<option value="<?php //echo $val['Test']['id'];?>"><?php //echo $val['Test']['test_parameter'];?></option>
				<?php //}?>
			</select>-->
             <!--<div  id="firstQuestion" style="display:block">


            <select name="data[Sample][test_id]" class="selectBox" style="width:300px">
				<option value="">Select Test</option>
				<?php //foreach($tests as $key => $val) {?>
				<option value="<?php //echo $val['Test']['id'];?>"><?php //echo $val['Test']['test_parameter'];?></option>
				<?php //}?>
			</select>

            <?php //echo $this->Html->link(,'/tests/health_collection', array('escape' => false));?>

            <?php //echo $form->submit('frontend/go_button.jpg',array('alt'=>'Go','style'=>'margin-top: 10px; margin-left: 15px;'));?>
            <?php //echo $form->submit('', array('div'=>false, 'class' => 'right1')); ?>


            </div>-->
			<div style="padding:0 0 0 10px;">
			<span style="float:left; padding:15px 19px 0 0; font-weight:bold;">OR</span>
			<?php echo $form->text('Search.test_search',array('class'=>'textBox-search','placeholder'=>'Type a Keyword'));?>
			<?php echo $form->submit('frontend/go_button.jpg',array('alt'=>'Go','style'=>'margin-top: 10px; margin-left: 15px;'));?>
			</div>
            <!--<div id="beforeQue1" class="disNone" style="display:none">
            <select name="data[Profile][test_id]" class="selectBox" style="width:300px">
				<option value="">Select Profile</option>
				<?php //foreach($profiles as $key => $val) {?>
				<option value="<?php //echo $val['Test']['id'];?>"><?php //echo $val['Test']['test_parameter'];?></option>
				<?php //}?>
			</select>

            <?php //echo $this->Html->link($this->Html->image('frontend/go_button.jpg', array('alt'=>'Go','style'=>'margin-top: 10px; margin-left: 15px;')),'/tests/health_collection', array('escape' => false));?>
            <?php //echo $form->submit('frontend/go_button.jpg',array('alt'=>'Go','style'=>'margin-top: 10px; margin-left: 15px;'));?>

            <?php //echo $form->submit('', array('div'=>false, 'class' => 'right1')); ?>
            <?php echo $form->end(); ?>

            </div>-->


          </div>
		  <!--<div style="text-align:center; font-size:15px; font-weight:bold; padding:78px 0 0 0;">OR</div>
		  <div style="text-align:center; padding:7px 0 0 0;"><a href="<?php //echo SITE_URL;?>tests/search" style="color:#EE8012;">Advance Search</a></div>-->
        </div>
      </div>
	  </form>
    </div>
  </div>
  <!--Banner Part:End-->

  <!--Body Part:Start-->
  <div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="cont">
      <div class="leftPanelBox">


        <div class="leftPart">
        <h1 style="margin-bottom:8px;">Special offers of the <span class="green">Month</span></h1>
        <div style="clear:both;"></div>
			<div class="banner_sec">
				<div id="slider">
					<?php foreach($show_banner as $key => $val) {?>
					<div class="show_carousal"><?php echo $this->Html->link($this->Html->image(OFFER_IMAGE_THUMB_URL.$val['Banner']['banner_image'], array('alt'=>'Banner','width'=>522,'height'=>265)),'/tests/offers', array('escape' => false));?></div>
					<?php }?>
				</div>
			</div>
		</div>
        <div class="abtNir">
        <h3>About <span class="green">Niramaya</span></h3>
        <?php echo $html->image('frontend/about-us-img.gif',array('alt'=>'About Us'));?>Niramaya Healthcare is an elite Diagnostic and Wellness service provider with presence in the National Capital Region of Delhi. It was started by a group of professionals with the motto of "Affordable, Accurate and Accredited diagnostic at your footstep". Niramaya Healthcare has gone beyond the concept of 'need based' testing by promoting the concept of Preventive Healthcare.  <span class="readMore right"><?php echo $this->Html->link('Read More','/pages/company_overview');?></span> </div>

        <!--our clients start here-->
        	<div class="docDiv">
			<h1 style="font-size:25px;">Our <span class="green">Clients</span></h1>
			<div style="border: 1px solid #DBDBDB; float: left; margin: 10px 0 0; padding-bottom: 13px; width: 522px;">
			  <div id="logoParade" class="logoParade">
				<div class="scrollWrapper">
					<div  class="scrollableArea">
                                                <?php echo $html->image('scroll_image/xzeo-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/shipa-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/pure-software-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/mata-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/lbf-travel-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/imegy-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/finoit-logo.jpg');?>

                                                <?php echo $html->image('scroll_image/compunnel-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/droom-logo.png');?>
                                                <?php echo $html->image('scroll_image/fashion_you-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/jaarwis-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/prateek-logo.png');?>
                                                <?php echo $html->image('scroll_image/xavient-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/polyplex-logo.gif');?>


                                                <?php echo $html->image('scroll_image/yoma-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/path-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/minda-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/infopro-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/egis-india-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/dixon-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/artech-logo.jpg');?>

                                                <?php echo $html->image('scroll_image/haier-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/extramarks-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/ebix-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/axiss-dental-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/ashiana-housing-logo.jpg');?>


                                                <?php echo $html->image('scroll_image/center-for-eyesight-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/docomo-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/emaar-mgf-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/hdfc-securities-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/punj-Lloyd-logo.jpg');?>
                                                <?php echo $html->image('scroll_image/axtria-logo.jpg');?>&nbsp;&nbsp;
                                                <?php echo $html->image('scroll_image/bureau-veritas-logo.jpg');?>&nbsp;&nbsp;
                                                <?php echo $html->image('scroll_image/infotech-logo.jpg');?>&nbsp;&nbsp;
                                                <?php echo $html->image('scroll_image/inter-globe-logo.jpg');?>&nbsp;&nbsp;
                                                <?php echo $html->image('scroll_image/q3-technologies-logo.jpg');?>&nbsp;&nbsp;
                                                <?php echo $html->image('scroll_image/ranbaxy-logo.jpg');?>&nbsp;&nbsp;
                                                <?php echo $html->image('scroll_image/steria-logo.jpg');?>&nbsp;&nbsp;
                                                <?php echo $html->image('scroll_image/tech-ahead-logo.jpg');?>&nbsp;&nbsp;
                                                <?php echo $html->image('scroll_image/wood-group-psn-logo.jpg');?>&nbsp;&nbsp;


                                                <?php echo $html->image('scroll_image/aricent-logo.jpg');?>&nbsp;&nbsp;
                                                <?php echo $html->image('scroll_image/crowne-plaza-logo.jpg');?>&nbsp;&nbsp;
                                                <?php echo $html->image('scroll_image/dhfl-logo.jpg');?>&nbsp;&nbsp;
                                                <?php echo $html->image('scroll_image/rate-gain-logo.jpg');?>&nbsp;&nbsp;


						<?php echo $html->image('scroll_image/edifecs-logo.jpg');?>&nbsp;&nbsp;
						<?php echo $html->image('scroll_image/mosaic-hotels-logo.jpg');?>&nbsp;&nbsp;
						<?php echo $html->image('scroll_image/park-plaza-logo.jpg');?>&nbsp;&nbsp;
						<?php echo $html->image('scroll_image/pl-engineering-logo.jpg');?>&nbsp;&nbsp;
						<?php echo $html->image('scroll_image/sandhar-logo.jpg');?>&nbsp;&nbsp;

						<?php echo $html->image('scroll_image/logo-1.jpg');?>&nbsp;&nbsp;
					   <?php //echo $html->image('scroll_image/logo-2.jpg');?>&nbsp;&nbsp;
                       <?php echo $html->image('scroll_image/logo-47.jpg');?>&nbsp;&nbsp;
					   <?php echo $html->image('scroll_image/logo-101.jpg');?>&nbsp;&nbsp;
					   <?php echo $html->image('scroll_image/logo-102.jpg');?>&nbsp;&nbsp;
					    <?php echo $html->image('scroll_image/logo-96.jpg');?>&nbsp;&nbsp;
						<?php echo $html->image('scroll_image/logo-100.jpg');?>&nbsp;&nbsp;
					    <?php echo $html->image('scroll_image/logo-97.jpg');?>&nbsp;&nbsp;
					    <?php echo $html->image('scroll_image/logo-64.jpg');?>&nbsp;&nbsp;
					  <?php echo $html->image('scroll_image/logo-58.png');?>&nbsp;&nbsp;
					  <?php echo $html->image('scroll_image/logo-89.jpg');?>&nbsp;&nbsp;
					  <?php echo $html->image('scroll_image/logo-90.jpg');?>&nbsp;&nbsp;
				      <?php echo $html->image('scroll_image/logo-50.jpg');?>&nbsp;&nbsp;
					  <?php echo $html->image('scroll_image/logo-51.jpg');?>&nbsp;&nbsp;
					  <?php echo $html->image('scroll_image/logo-41.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-3.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-4.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-6.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-7.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-8.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-9.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-10.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-11.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-12.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-13.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-14.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-15.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-16.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-17.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-18.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-19.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-20.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-21.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-22.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-23.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-24.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-25.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-26.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-28.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-29.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-30.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-31.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-32.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-33.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-34.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-36.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-37.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-38.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/logo-40.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/luxor-logo.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/mercer-logo.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/casio-logo.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/tecnova-logo.jpg');?>&nbsp;&nbsp;
					<?php echo $html->image('scroll_image/ebizon-logo.jpg');?>&nbsp;&nbsp;
            <?php echo $html->image('scroll_image/hytechpro-logo.jpg');?>&nbsp;&nbsp;
            <?php echo $html->image('scroll_image/morpho-logo.jpg');?>&nbsp;&nbsp;
            <?php echo $html->image('scroll_image/nai-disha-free-education-society-logo.jpg');?>&nbsp;&nbsp;
            <?php echo $html->image('scroll_image/radikal-rice-logo.jpg');?>





					</div>
				</div>
			</div>
		</div>
		</div>

        <!--our clients end here-->

        <div class="testimonialBox">
          <h1>News & <span class="green">Updates</span></h1>
          <div class="demo1" style="height:241px;">
      			<div>
                                <div>
                                        <p style="text-align:left;">nirAmaya PathLabs corporate camp @ IGT, Gurgaon on 16th & 17th June'15</p>
                                </div>
                                <div>
                                        <p style="text-align:left;">nirAmaya PathLabs corporate camp @ Imergy, Gurgaon on 16th June'15</p>
                                </div>
                                <div>
                                        <p style="text-align:left;">nirAmaya PathLabs corporate camp @ LBF Travel, Gurgaon on 11th, 12th & June'15</p>
                                </div>
                                <div>
                                        <p style="text-align:left;">nirAmaya PathLabs corporate camp @ Hytech Pro, Noida on 22nd & 23rd June'15</p>
                                </div>
                                <div>
                                        <p style="text-align:left;">nirAmaya PathLabs corporate camp @ Exzeo Software, Noida on 24th & 25th June'15</p>
                                </div>
                                <div>
                                        <p style="text-align:left;">nirAmaya PathLabs corporate camp @ Shipra Group, Noida on 26th June'15</p>
                                </div>
                                <div>
                                        <p style="text-align:left;">nirAmaya PathLabs corporate camp @ TechAhead, Noida on 30th June & 1st July'15</p>
                                </div>

                                <div>
                                        <p style="text-align:left;">nirAmaya PathLabs corporate camp @ Smart Cube, Noida on 22nd , 23th & 24th April'15</p>
                                </div>
                                <div>
                                        <p style="text-align:left;">nirAmaya PathLabs corporate camp @ Edifecs, Gurgaon on 28th April'15</p>
                                </div>
                                <div>
                                        <p style="text-align:left;">nirAmaya PathLabs corporate camp @ UEM, Noida on 29th & 30th April'15</p>
                                </div>
                                <div>
                                        <p style="text-align:left;">nirAmaya PathLabs corporate camp @ Infogain, Noida on 29th & 30th April'15</p>
                                </div>
                                <div>
                                        <p style="text-align:left;">nirAmaya PathLabs corporate camp @ Jaarwis, Gurgaon on 5th May'15</p>
                                </div>
                                <div>
                                        <p style="text-align:left;">nirAmaya PathLabs corporate camp @ Compunnel, Noida on 11th , 12th & 13th May'15</p>
                                </div>
                                <div>
                                        <p style="text-align:left;">nirAmaya PathLabs corporate camp @ TPF, Noida on 13th May'15</p>
                                </div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ RightWave, Noida on 17th March'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Egis India, Faridabad on 18th & 20th March'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Haier, New Delhi on 19th March'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Mercer, Noida and Gurgaon from 23rd to 25th March'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Rockwell Automation, Noida on 24th March'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Edifecs, Gurgaon on 25th March'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Sapient, Gurgaon on 26th, 27th & 31st March'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ EbizOn, Noida on 31st March'15</p>
        			</div>


                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Radikal Group, Saket on 21tst February'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Optimus Info, Noida on 23rd February'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Xchanging, Gurgaon on 25th February'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Luxor, Noida and Gurgaon from 1st to 4th March'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Mercer, Gurgaon on 9th & 10th March'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ MothersonSumi, Noida on 13th & 14th March'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Morpho, Noida on 13th March'15</p>
        			</div>



                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ R-Systems, Noida on 4th February'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Ashiana Housing, New Delhi on 10th February'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ EBIX, Noida on 12th & 13th February'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Sapient, Noida on 16th & 17th February'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Sopra, Noida on 18th & 19th February'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ G-Cube, Noida on 18th & 19th February'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Virtual Employee, Noida on 20th & 24th February'15</p>
        			</div>

                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ CYIENT, Noida from 5th to 8th January'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Tata Tel, Noida on 13th January'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Emaar MGF, Gurgaon on 15th & 16th January15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ HDFC Securities, Noida on 17th January15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs Residents camp in association with Centre for Sight @ Centre for Sight, Gurgaon 19th January'15</p>
        			</div>
                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Kellton Tech, Gurgaon on 20th & 21st January'15</p>
        			</div>


                                <div>
          				<p style="text-align:left;">nirAmaya PathLabs corporate camp @ Punj Lloyd, Gurgaon on 21st & 22nd January'15</p>
        			</div>




      			</div>
    		</div>
        </div>




        </div>
        <div class="right">

            <div class="callBack">
                <h1 style="font-size:22px;margin-bottom: 11px;">Affordable Preventive Healthcare <span class="green">for All</span></h1>
                <div style="border:1px solid #dbdbdb;clear:both;">
                    <?php e($html->image('Specia-Offers-Banner-Dengue-Home-Page.jpg',array('width'=>'100%'))); ?>
                    <div class="action" style="margin-top:10px;display: table; width:100%;">
                        <div style="float:right;"><?php e($html->link($html->image('book-now-button.png'),array('controller'=>'tests','action'=>'my_cart',276),array('escape'=>false))); ?></div>
                        <div style="float:left;"><?php //e($html->link($html->image('more-details-button.png'),array('controller'=>'pages','action'=>'affordable_preventive_healthcare'),array('escape'=>false))); ?></div>
                    </div>
                </div>
            </div>
            <div style="clear:both;line-height: 25px;"></div>
            <div class="callBack">
                <h1 style="font-size:22px;margin-top:25px;margin-bottom: 11px;">Health Checkup Today for Healthy <span class="green">Tomorrow</span></h1>
                <div style="border:1px solid #dbdbdb;clear:both;">
                    <?php e($html->image('Niramaya_Vital_Health_Checkup_Home_Page_Banner_.jpg',array('width'=>'100%'))); ?>
                    <div class="action" style="margin-top:10px;display: table; width:100%;">
                        <div style="float:right;"><?php e($html->link($html->image('book-now-button.png'),array('controller'=>'tests','action'=>'my_cart',10,'package'),array('escape'=>false))); ?></div>
                        <div style="float:left;"><?php e($html->link($html->image('more-details-button.png'),array('controller'=>'pages','action'=>'health_checkup_today_for_healthy_tomorrow'),array('escape'=>false))); ?></div>
                    </div>
                </div>
            </div>



		<div class="docDiv"><a href="https://www.facebook.com/NiramayaHealthcare/app_826421200705943" target="_blank"><?php echo $html->image('frontend/niramaya-bmi-banner.jpg');?></a></div>
		<!--<div class="docDiv"><a href="https://www.facebook.com/NiramayaHealthcare/app_731260830238838" target="_blank"><?php echo $html->image('frontend/niramaya_discount-code-banner.jpg');?></a></div>-->
             <div style="clear:both;line-height: 25px;"></div>
            <div class="callBack">
                <h1 style="font-size:22px;margin-bottom: 11px;">Affordable Preventive Healthcare <span class="green">for All</span></h1>
                <div style="border:1px solid #dbdbdb;clear:both;">
                    <?php e($html->image('fever_home_banner_for_offer.jpg',array('width'=>'100%'))); ?>
                    <div class="action" style="margin-top:10px;display: table; width:100%;">
                        <div style="float:right;"><?php e($html->link($html->image('book-now-button.png'),array('controller'=>'tests','action'=>'offers'),array('escape'=>false))); ?></div>
                        <div style="float:left;"><?php //e($html->link($html->image('more-details-button.png'),array('controller'=>'pages','action'=>'affordable_preventive_healthcare'),array('escape'=>false))); ?></div>
                    </div>
                </div>
            </div>


        </div>
      </div>

    </div>
  </div>
<?php echo $javascript->link('light/jquery.lightbox_me') ?>