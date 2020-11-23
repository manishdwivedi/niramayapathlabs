<script type="text/javascript">
function address_div(val)
{
	if(val == 'CL')
	{
		var null_val = '';
		$('#HomeFeeAdd1').hide();
		$('#HomeFeeAdd2').hide();
		$('#BookAppointmentAdd1').val(null_val);
		$('#BookAppointmentAdd2').val(null_val);
	}
	if(val == 'HV')
	{
		$('#HomeFeeAdd1').show();
		$('#HomeFeeAdd2').show();
	}
}

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
document.getElementById("msg4").innerHTML="";

if(document.form1.BookAppointmentPatName.value=='')
{
	document.getElementById("msg1").innerHTML="Please Enter Your Name";
	str=false;
}
else if(IsCharacter(document.form1.BookAppointmentPatName.value)==false)
{
	document.getElementById("msg1").innerHTML="Please Enter Valid Name";
	str=false;
}
if(isNaN(document.form1.BookAppointmentPatContact.value))
{
	document.getElementById("msg2").innerHTML="Please Enter Numeric Mobile Number";
	str = false;
}
else if(document.form1.BookAppointmentPatContact.value.length<10)
{
	document.getElementById("msg2").innerHTML="Please Enter Valid Mobile Number";
    str = false;
}
if(document.form1.BookAppointmentReason.value=='')
{
	document.getElementById("msg4").innerHTML="Please Enter Appointment Reason";
	str=false;
}
return str;
}
</script>
<?php 
	if(isset($options) && $options!="")
	{
		$paginator->options=array('url'=>$options);
	}
?>
<div class="banner"><?php echo $this->Html->image('frontend/niramaya_dr_module_banner.jpg',array('alt'=>'Banner'))?></div>
      </div>
    </div>
  </div>
<div id="bodyPart">
    <div class="bodyInnerDiv">
      <div class="breadcrumbs">
        <div class="left">
          <div class="home"><a href="<?php echo SITE_URL;?>pages/index">Home Page</a></div>
          <div class="bread"><a href="<?php echo SITE_URL;?>pages/doctor_detail/<?php echo base64_encode($doctor['Doctor']['id']);?>"><?php echo $doctor['Doctor']['title'].' '.$doctor['Doctor']['first_name'].' '.$doctor['Doctor']['last_name'];?></a></div>
          <div class="bread">Book Appointment</div>
        </div>
        
      </div>
      <h1>Book <span class="green">Appointment</span></h1>
	  <div>
	  <div>
	  	<?php echo $form->create('null',array('url'=>'/pages/book_appointment/'.$doc_id.'/'.$clinic_id.'/'.$clinic_time.'/'.$day.'/'.$date.'/'.$clinitime_id,'class'=>'bookForm','id'=>'form1','name'=>'form1','onsubmit'=>'return validationc(this);','style'=>'clear:both;'));?>
        
	  	<?php echo $form->hidden('BookAppointment.doctor_id',array('value'=>base64_decode($doc_id)));?>
	  	<?php echo $form->hidden('BookAppointment.doctor_clinic_id',array('value'=>base64_decode($clinic_id)));?>
	  	<?php echo $form->hidden('BookAppointment.clinic_time',array('value'=>base64_decode($clinic_time)));?>
	  	<?php echo $form->hidden('BookAppointment.clinictime_id',array('value'=>base64_decode($clinitime_id)));?>
	  	<?php echo $form->hidden('BookAppointment.day',array('value'=>base64_decode($day)));?>
	  	<?php echo $form->hidden('BookAppointment.date',array('value'=>base64_decode($date)));?>
        <?php if(!empty($user_detail)) {?>
		<?php echo $form->hidden('BookAppointment.user_id',array('value'=>$user_detail['User']['id']));?>
        <?php } else {?>
        <?php echo $form->hidden('BookAppointment.user_id',array('value'=>0));?>
        <?php }?>
	  	  
		  <div class="boxRow" style="color:#FF0000; display:none;" id="SetMess"><?php echo $set_mess;?></div>
		  <div class="boxRow" style="color:#FF0000; display:none;" id="SetFMess">OTP Password did not match</div>
		  <?php if(empty($set_mess)) {?>
			  <div class="boxRow">
				<label style="width:200px; margin:0; font-weight:bold;">Appointment With</label>
				<?php echo $doctor['Doctor']['title'].'. '.$doctor['Doctor']['first_name'].' '.$doctor['Doctor']['last_name'];?>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:0; font-weight:bold;">Clinic Name</label>
				<?php echo $doc_clinic['DoctorClinic']['clinic_name'];?>
			  </div>
			  <?php $expl_add = explode('*',$doc_clinic['DoctorClinic']['clinic_address']);?>
			  <div class="boxRow">
				<label style="width:200px; margin:0; font-weight:bold;">Clinic Address</label>
				<?php echo $expl_add[0];?>
			  </div>
			  <?php if(!empty($expl_add[1])) {?>
			  <div class="boxRow">
				<label style="width:200px; margin:0; font-weight:bold;">&nbsp;</label>
				<?php echo $expl_add[1];?>
			  </div>
			  <?php }?>
			  <div class="boxRow">
				<label style="width:200px; margin:0; font-weight:bold;">Appointment Time</label>
				<?php echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>".$app_time."</span>";?></span>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:0; font-weight:bold;">Appointment Day</label>
				<?php if($app_day == 'Mon') {echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>"."Monday"."</span>";}?>
				<?php if($app_day == 'Tue') {echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>"."Tuesday"."</span>";}?>
				<?php if($app_day == 'Wed') {echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>"."Wednesday"."</span>";}?>
				<?php if($app_day == 'Thu') {echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>"."Thursday"."</span>";}?>
				<?php if($app_day == 'Fri') {echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>"."Friday"."</span>";}?>
				<?php if($app_day == 'Sat') {echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>"."Saturday"."</span>";}?>
				<?php if($app_day == 'Sun') {echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>"."Sunday"."</span>";}?>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:0; font-weight:bold;">Appointment Date</label>
				<?php echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>".date('d-M-Y',strtotime($app_date))."</span>";?>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:-2px 0 0 0; font-weight:bold;">Consultancy Fee(Clinic)</label>
				<?php echo 'INR '.$doctor['Doctor']['cons_fee'];?>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:0; font-weight:bold;">Patient Name <font color="#FF0000">*</font></label>
                <?php if(!empty($user_detail['User']['first_name'])) {?>
				<?php echo $form->text('BookAppointment.pat_name',array('class'=>'smallTextBox','value'=>$user_detail['User']['first_name'].' '.$user_detail['User']['last_name'],'style'=>'font-style:normal;'));?>
                <?php } else {?>
                <?php echo $form->text('BookAppointment.pat_name',array('class'=>'smallTextBox','style'=>'font-style:normal;'));?>
                <?php }?>
				<span id="msg1" style="color:#FF0000; clear:both; padding:0 0 0 65px;"></span>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:0; font-weight:bold;">Mobile No. <font color="#FF0000">*</font></label>
                <?php if(!empty($user_detail['User']['contact'])) {?>
                <?php echo $form->text('BookAppointment.pat_contact',array('class'=>'smallTextBox','value'=>$user_detail['User']['contact'],'style'=>'font-style:normal;'));?>
                <?php } else {?>
                <?php echo $form->text('BookAppointment.pat_contact',array('class'=>'smallTextBox','style'=>'font-style:normal;'));?>
                <?php }?> 
				<span id="msg2" style="color:#FF0000; clear:both; padding:0 0 0 65px;"></span>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:0; font-weight:bold;">Appointment Reason <font color="#FF0000">*</font></label>
				<?php echo $form->textarea('BookAppointment.reason',array('class'=>'smallTextBox','rows'=>5,'cols'=>30,'style'=>'font-style:normal; color:#666666;'));?>
				<span id="msg4" style="color:#FF0000; clear:both; padding:0 0 0 65px;"></span>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:0;">&nbsp;</label>
				<?php echo $form->submit('', array('div'=>false, 'class' => 'right','style'=>'float:left !important; cursor:pointer;')); ?>
			  </div>
			  
		  <?php } else {?>
          	  <div class="boxRow" id="AppointId" style="display:none;">
				<label style="width:200px; margin:0; font-weight:bold;">Appointment Id</label>
				<?php echo $p_appoint_id;?>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:0; font-weight:bold;">Appointment With</label>
				<?php echo $doctor['Doctor']['title'].'. '.$doctor['Doctor']['first_name'].' '.$doctor['Doctor']['last_name'];?>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:0; font-weight:bold;">Clinic Name</label>
				<?php echo $doc_clinic['DoctorClinic']['clinic_name'];?>
			  </div>
			  <?php $expl_add = explode('*',$doc_clinic['DoctorClinic']['clinic_address']);?>
			  <div class="boxRow">
				<label style="width:200px; margin:0; font-weight:bold;">Clinic Address</label>
				<?php echo $expl_add[0];?>
			  </div>
			  <?php if(!empty($expl_add[1])) {?>
			  <div class="boxRow">
				<label style="width:200px; margin:0; font-weight:bold;">*nbsp;</label>
				<?php echo $expl_add[1];?>
			  </div>
			  <?php }?>
			  <div class="boxRow">
				<label style="width:200px; margin:-3px 0 0 0; font-weight:bold;">Appointment Time</label>
				<?php echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>".$app_time."</span>";?>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:-3px 0 0 0; font-weight:bold;">Appointment Day</label>
				<?php if($app_day == 'Mon') {echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>"."Monday"."</span>";}?>
				<?php if($app_day == 'Tue') {echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>"."Tuesday"."</span>";}?>
				<?php if($app_day == 'Wed') {echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>"."Wednesday"."</span>";}?>
				<?php if($app_day == 'Thu') {echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>"."Thursday"."</span>";}?>
				<?php if($app_day == 'Fri') {echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>"."Friday"."</span>";}?>
				<?php if($app_day == 'Sat') {echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>"."Saturday"."</span>";}?>
				<?php if($app_day == 'Sun') {echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>"."Sunday"."</span>";}?>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:-3px 0 0 0; font-weight:bold;">Appointment Date</label>
				<?php echo "<span style='color:#68B323; font-weight:bold; font-size:12px; margin:0;'>".date('d-M-Y',strtotime($app_date))."</span>";?>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:-3px 0 0 0; font-weight:bold;">Patient Name</label>
				<?php echo $p_name_booked;?>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:-3px 0 0 0; font-weight:bold;">Mobile No.</label>
				<?php echo $p_contact_booked;?>
			  </div>
			  <div class="boxRow">
				<label style="width:200px; margin:-3px 0 0 0; font-weight:bold;">Consultany Fee(Clinic)</label>
				<?php echo 'INR '.$doctor['Doctor']['cons_fee'];?>
			  </div>
			  <?php if($doctor['Doctor']['home_fee'] != 0) {?>
			  <div class="boxRow">
				<label style="width:200px; margin:-3px 0 0 0; font-weight:bold;">Consultany Fee(Home Visit)</label>
				<?php echo 'INR '.$doctor['Doctor']['home_fee'];?>
			  </div>

			  <?php }?>
			 
			  <div class="boxRow">
				<label style="width:200px; margin:-3px 0 0 0; font-weight:bold;">Appointment Reason</label>
				<?php echo $p_reason_booked;?>
			  </div>
			  <div class="boxRow" id="OTPDiv">
			  	<label style="width:200px; margin:0;">Enter OTP Password</label>
				<?php echo $form->text('BookAppointment.OTP',array('class'=>'smallTextBox','style'=>'font-style:normal;'));?>
			  </div>
			  <div class="boxRow" id="OTPSubmitDiv">
				<label style="width:200px; margin:0;">&nbsp;</label>
				<?php echo $html->image('frontend/submit-button.gif',array('class' => 'right','id'=>'SubmitOTPImg','style'=>'float:left !important; cursor:pointer;','onclick'=>'enter_validation('.$last_id.');'));?>
				<?php echo $html->image('loading.gif',array('style'=>'margin:10px 0 0 0; display:none;','id'=>'process'));?>
			  </div>
			  <div class="boxRow" id="BookedMess" style="display:none;">
			  	<span style="margin: 0px 0px 0px 200px; font-size: 13px; font-weight: bold; color: rgb(5, 186, 59);">Your appointment has been booked. Login to <a href="<?php echo SITE_URL?>pages/appoint_customer_login" style="color:#0033FF; text-decoration:underline;">My Account</a> and manage your Appointments.</span>
			  </div>
			  <div class="boxRow" id="BookedMessNot" style="display:none;">
			  	<label style="width:200px; margin:0;">&nbsp;</label>
				<span style="margin: 0px 0px 0px 200px; font-size: 13px; font-weight: bold; color: #FF0000;">Your Appointment did not booked. Please try again later.</span>
			  </div>

			  <script type="text/javascript">
			  function enter_validation(val)
			  {
			  	var otp = document.getElementById('BookAppointmentOTP').value;
				if(otp != '')
				{
			  		jQuery.ajax({
						type:'GET',
						url:siteUrl+'pages/validate_appoint?id='+val+'&otp='+otp,
						success:function(data){
							var split_data = data.split('_');
							if(split_data[0] == 'Success')
							{
								var null_val = '';
								$('#AppointId').show();
								$('#BookedMess').show();
								$('#BookedMessNot').hide();
								$('#OTPDiv').hide();
								$('#BookAppointmentOTP').val(null_val);

							}
							if(split_data[0] == 'Failure')
							{
								$('#BookedMess').hide();
								$('#BookedMessNot').show();

							}
							$('#process').hide();
							$('#OTPSubmitDiv').hide;
							$('#SubmitOTPImg').hide();
						},
						beforeSend:function(){
							jQuery('#process').show();
						},
						
					});
				}
				else
				{
					alert('Please Enter OTP Send on Your Mobile.');
				}
			  }
			  </script>
		  <?php }?>
		  <?php echo $form->end();?>
	  </div>
	  
	  <div class="clinic-info">
	  	<?php $k = 1;foreach($all_doc_clinic as $all_k => $all_v){?>
		<div class="clinic-info-inner <?php if($k > 1) {?>mar-top<?php }?>">
			<div style="clear:both;">
				<div class="clinic-info-head">Clinic Name</div>
				<div class="clinic-info-head-second"><?php echo $all_v['DoctorClinic']['clinic_name'];?></div>
			</div>
			<?php $expl_add = explode('*',$all_v['DoctorClinic']['clinic_address']);?>
			<div style="clear:both;">
				<div class="clinic-info-head">Clinic Address</div>
				<div class="clinic-info-head-second"><?php echo $expl_add[0];?></div>
			</div>
			<?php if(!empty($expl_add[1])) {?>
			<div style="clear:both;">
				<div class="clinic-info-head">&nbsp;</div>
				<div class="clinic-info-head-second"><?php echo $expl_add[1];?></div>
			</div>
			<?php }?>
		</div>
		<?php $k++;}?>
	  </div>
	  </div>
	  
	  
	  
      <div class="bottomShadow"></div>
    </div>
  </div>
